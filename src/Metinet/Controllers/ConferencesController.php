<?php

namespace Metinet\Controllers;

use Metinet\Core\Http\Request;
use Metinet\Core\Http\Response;
use Metinet\Domain\Conference;
use Metinet\Domain\ConferenceDetails;
use Metinet\Domain\Date;
use Metinet\Domain\Location;
use Metinet\Domain\PostalAddress;

class ConferencesController
{
    public function viewConferences(Request $request): Response
    {
        $conferences[] = new Conference(
            new ConferenceDetails(
                'Découvrez docker avec le LP Metinet',
                'Curabitur sit amet varius mauris. Aliquam a metus ut risus laoreet rhoncus. Donec eu massa bibendum massa rutrum auctor. Quisque placerat leo sed nulla malesuada hendrerit.',
                ['docker', 'virtualization']
            ),
            Date::fromAtomFormat('2019-02-01'),
            new Location('Amphi demi-lune', new PostalAddress('71, rue Peter Fink', '01000', 'Bourg-en-Bresse', 'France'))
        );

        return new Response($this->render('conferences/list.html.twig', ['conferences' => $conferences]), 200);
    }

    private function render(string $templatePath, array $context = []): string
    {
        return $this->getTwigEnvironment()->render($templatePath, $context);
    }

    private function getTwigEnvironment(): \Twig_Environment
    {
        $loader = new \Twig_Loader_Filesystem(dirname(dirname(dirname(__DIR__))).'/views');
        $twig = new \Twig_Environment($loader, ['debug' => true]);
        $twig->addExtension(new \Twig_Extensions_Extension_Date());
        $twig->addExtension(new \Twig_Extension_Debug());

        return $twig;
    }
}
