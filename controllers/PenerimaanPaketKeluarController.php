<?php

namespace Mitral2022\DSN2;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class PenerimaanPaketKeluarController extends ControllerBase
{
    // list
    public function list(Request $request, Response $response, array $args): Response
    {
        //return $this->runPage($request, $response, $args, "PenerimaanPaketKeluarList");
         try {
            return $this->runPage($request, $response, $args, "PenerimaanPaketKeluarList");
        } catch (\Throwable $e) {
            // Menampilkan pesan error
            $errorMessage = "Error data: " . $e->getMessage();
            $errorTrace = $e->getTraceAsString();
    
            // Log error ke file atau tampilkan di response
            error_log($errorMessage . "\n" . $errorTrace);
    
            // Tampilkan error dalam response
            $response->getBody()->write($errorMessage);
            return $response->withStatus(500); // 500 = Internal Server Error
        }
    }

    // add
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PenerimaanPaketKeluarAdd");
    }

    // view
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PenerimaanPaketKeluarView");
    }

    // edit
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PenerimaanPaketKeluarEdit");
    }

    // delete
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PenerimaanPaketKeluarDelete");
    }
}
