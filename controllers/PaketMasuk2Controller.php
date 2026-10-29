<?php

namespace Mitral2022\DSN2;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * PaketMasuk2 controller
 */
class PaketMasuk2Controller extends ControllerBase
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PaketMasuk2Summary");
    }
}
