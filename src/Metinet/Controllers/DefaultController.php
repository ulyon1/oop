<?php

namespace Metinet\Controllers;

use Metinet\Core\Http\Request;
use Metinet\Core\Http\Response;

class DefaultController
{
    public function sayHello(Request $request) {
        $name = $request->getQuery()->get('name');
        if (null === $name) {
            throw new \Exception("I don't say Hello to anonymous, introduce yourself first!");
        }

        return new Response(sprintf('<p>Hello <b>%s</b></p>', htmlspecialchars($name, ENT_QUOTES, 'UTF-8')));
    }

    public function about() {
        return new Response('À propos');
    }

    public function signup() {
        return new Response('Inscription');
    }
}
