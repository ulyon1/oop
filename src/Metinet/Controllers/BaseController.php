<?php

namespace Metinet\Controllers;

use Metinet\Core\DependencyManager;
use Metinet\Core\Http\Response;

abstract class BaseController
{
    protected $dependencyManager;

    public function __construct(DependencyManager $dependencyManager)
    {
        $this->dependencyManager = $dependencyManager;
    }

    public function renderResponse(string $template, array $context = []): Response
    {
        return new Response($this->render($template, $context));
    }

    public function render(string $template, array $context = []): string
    {
        return $this->dependencyManager->getTwig()->render($template, $context);
    }

    public function redirect(string $path): Response
    {
        return $this->temporaryRedirect($path);
    }

    public function temporaryRedirect(string $path): Response
    {
        return new Response('', 303, ['location' => $path]);
    }

    public function permanentRedirect(string $path): Response
    {
        return new Response('', 301, ['location' => $path]);
    }
}
