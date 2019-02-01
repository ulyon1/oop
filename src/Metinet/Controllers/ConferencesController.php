<?php

namespace Metinet\Controllers;

use Metinet\Core\Http\Request;
use Metinet\Core\Http\Response;
use Metinet\Domain\Attendee;
use Metinet\Domain\Conference;
use Metinet\Domain\ConferenceDetails;
use Metinet\Domain\Date;
use Metinet\Domain\Email;
use Metinet\Domain\Location;
use Metinet\Domain\PhoneNumber;
use Metinet\Domain\PostalAddress;
use Metinet\Domain\Price;
use Metinet\Domain\RegistrationRule;
use Metinet\Domain\Time;
use Metinet\Domain\TimeSlot;

class ConferencesController extends BaseController
{
    public function viewConferences(Request $request): Response
    {
        /** @var Conference[] $conferences */
        $conferences[] = $conference = new Conference(
            new ConferenceDetails(
                'Découvrez docker avec le LP Metinet',
                'Curabitur sit amet varius mauris. Aliquam a metus ut risus laoreet rhoncus. Donec eu massa bibendum massa rutrum auctor. Quisque placerat leo sed nulla malesuada hendrerit.',
                ['docker', 'virtualization']
            ),
            Date::fromAtomFormat('2019-02-01'),
            new TimeSlot(Time::fromString('14:00'), Time::fromString('16:00')),
            new Location('Amphi demi-lune', new PostalAddress('71, rue Peter Fink', '01000', 'Bourg-en-Bresse', 'France')),
            20,
            RegistrationRule::allowExternalPeopleToRegisterToConference(Price::inLowestSubunit(1000, 'EUR', 100))
        );

        $conferences[] = new Conference(
            new ConferenceDetails(
                'Découvrez la POO avec le LP Metinet',
                'Curabitur sit amet varius mauris. Aliquam a metus ut risus laoreet rhoncus. Donec eu massa bibendum massa rutrum auctor. Quisque placerat leo sed nulla malesuada hendrerit.',
                ['oop', 'design-patterns']
            ),
            Date::fromAtomFormat('2019-03-10'),
            new TimeSlot(Time::fromString('18:30'), Time::fromString('20:00')),
            new Location('Cafeteria', new PostalAddress('71, rue Peter Fink', '01000', 'Bourg-en-Bresse', 'France')),
            19,
            RegistrationRule::reservedToStudent()
        );

        $conference->register(
            new Attendee('Boris', 'Guéry', new Email('guery.b@gmail.com'), new PhoneNumber('+33686830312'))
        );

        $this->dependencyManager->getLogger()->log('Attendee just registered');

        $conference->register(
            new Attendee('John', 'Doe', new Email('john.doe@example.com'), new PhoneNumber('+1999555555998'))
        );

        return new Response($this->render('conferences/list.html.twig', ['conferences' => $conferences]), 200);
    }
}
