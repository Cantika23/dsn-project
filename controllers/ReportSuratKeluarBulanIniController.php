<?php

namespace Mitral2022\DSN2;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Report_Surat_Keluar_Bulan_Ini controller
 */
class ReportSuratKeluarBulanIniController extends ControllerBase
{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ReportSuratKeluarBulanIniSummary");
    }
}
