<?php

namespace Mitral2022\DSN2;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * landingpage controller
 */
class LandingpageController extends ControllerBase
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {

        // echo "ini page";die();
        return $this->runPage($request, $response, $args, "Landingpage");
    }
}
