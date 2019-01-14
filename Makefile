DOCKER = docker
DOCKER_COMPOSE = docker-compose
EXEC_PHP = $(DOCKER_COMPOSE) exec php
COMPOSER = $(EXEC_PHP) composer

.DEFAULT_GOAL := help
.PHONY: help
.PHONY: build kill install restart start stop clean
.PHONY: test
.PHONY: lint phploc pdepend phpmd phpcs phpcpd phpdcd phpmetrics


help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

##
## Project
## -------
##

build:
	$(DOCKER_COMPOSE) pull --quiet --ignore-pull-failures
	$(DOCKER_COMPOSE) build --pull

install: build start deps ## Install and start the project

reinstall: stop clean install

start: ## Start the project
	$(DOCKER_COMPOSE) up -d --remove-orphans --no-recreate

stop: ## Stop the project
	$(DOCKER_COMPOSE) stop

restart: stop start ## Stop and start a fresh install of the project

kill:
	$(DOCKER_COMPOSE) kill
	$(DOCKER_COMPOSE) down --volumes --remove-orphans

clean: kill clear ## Clear and remove dependencies
	rm -rf vendor/ node_modules/

clear: ## Remove all the cache, the logs, the sessions, docker volumes, etc.
	rm -rf var/cache/*
	rm -rf var/sessions/*
	rm -rf var/logs/*
	rm -rf var/.php_cs.cache

deps: composer_packages

composer_packages: composer.lock
	$(COMPOSER) install -n

composer.lock: composer.json
	@echo compose.lock is not up to date.

##
## Utils
## -----
##

mysql-cli: ## Run mysql-cli
	$(DOCKER_COMPOSE) exec mysql mysql

php-sh: ## Connect to console container
	$(DOCKER_COMPOSE) exec php /bin/sh

##
## Tests
## -----
##

test: deps ## Run tests
	$(EXEC_PHP) bin/simple-phpunit

##
## Quality assurance
## -----------------
##

QA = docker run --rm -v `pwd`:/project mykiwi/phaudit:7.3
ARTEFACTS = var/artefacts

phploc: ## PHPLoc (https://github.com/sebastianbergmann/phploc)
	$(QA) phploc src/

pdepend: artefacts ## PHP_Depend (https://pdepend.org)
	$(QA) pdepend \
		--summary-xml=$(ARTEFACTS)/pdepend_summary.xml \
		--jdepend-chart=$(ARTEFACTS)/pdepend_jdepend.svg \
		--overview-pyramid=$(ARTEFACTS)/pdepend_pyramid.svg \
		src/

phpmd: ## PHP Mess Detector (https://phpmd.org)
	$(QA) phpmd src text .phpmd.xml

phpcs: ## PHP_CodeSnifer (https://github.com/squizlabs/PHP_CodeSniffer)
	$(QA) phpcs -v --standard=.phpcs.xml src

phpcpd: ## PHP Copy/Paste Detector (https://github.com/sebastianbergmann/phpcpd)
	$(QA) phpcpd src

phpdcd: ## PHP Dead Code Detector (https://github.com/sebastianbergmann/phpdcd)
	$(QA) phpdcd src

phpmetrics: artefacts ## PhpMetrics (http://www.phpmetrics.org)
	$(QA) phpmetrics --report-html=$(ARTEFACTS)/phpmetrics src

php-cs-fixer: ## php-cs-fixer (http://cs.sensiolabs.org)
	$(QA) php-cs-fixer fix --dry-run --using-cache=no --verbose --diff

apply-php-cs-fixer: ## apply php-cs-fixer fixes
	$(QA) php-cs-fixer fix --using-cache=no --verbose --diff

artefacts:
	mkdir -p $(ARTEFACTS)

lint: lint-php ## Run linters

lint-php:
	$(EXEC_PHP)
