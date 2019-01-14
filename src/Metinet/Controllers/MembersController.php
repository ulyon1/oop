<?php

namespace Metinet\Controllers;

use Metinet\Core\Http\Request;
use Metinet\Core\Http\Response;

class MembersController
{
    public function profile(Request $request): Response
    {
        return new Response('Hello member!');
    }
}
