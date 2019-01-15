<?php

namespace Metinet\Controllers;

use Metinet\Core\Http\Request;
use Metinet\Core\Http\Response;
use Metinet\Domain\Conference;

class ConferencesController
{
    public function viewConferences(Request $request): Response
    {
        $conferences[] = new Conference(
            'Découvrez la programmation orientée objet',
            'Pellentesque id metus quam. Curabitur laoreet, nibh ac feugiat eleifend, est mauris facilisis erat, in ultricies dolor nulla auctor tortor. Nunc dignissim ex erat. Ut eu consequat libero.',
            new \DateTimeImmutable('+1 MONTH', new \DateTimeZone('UTC'))
        );

        $conferences[] = new Conference(
            'Découvrez docker avec le LP Metinet',
            'Curabitur sit amet varius mauris. Aliquam a metus ut risus laoreet rhoncus. Donec eu massa bibendum massa rutrum auctor. Quisque placerat leo sed nulla malesuada hendrerit.',
            new \DateTimeImmutable('+1 YEAR', new \DateTimeZone('UTC'))
        );

        $content = '';

        foreach ($conferences as $conference) {
            [$title, $desc, $date] =
            [
                $conference->getTitle(),
                $conference->getDescription(),
                $conference->getDate()->format(DATE_ATOM),
            ];
            $content .=<<<CONF
<section>
<h1>${title}<time>${date}</time></h1>
<p>${desc}</p>
</section>
CONF;

        }

        return new Response($content, 200);
    }
}
