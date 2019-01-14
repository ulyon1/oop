<?php

namespace Metinet\Core\Controller;

class UnableToResolveController extends \Exception
{
    public static function controllerNotFound(string $controller): self
    {
        return new self(sprintf('Controller "%s" not found', $controller));
    }

    public static function actionNotFoundInController(string $action, string $controller): self
    {
        return new self(sprintf('Action "%s" not found in Controller "%s"', $action, $controller));
    }
}
