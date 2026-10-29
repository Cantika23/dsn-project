<?php

namespace Mitral2022\DSN2;

// Dashboard Page object
$Dashboard1 = $Page;
?>
<script>
    var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
    ew.deepAssign(ew.vars, {
        tables: {
            Dashboard1: currentTable
        }
    });
    var currentForm, currentPageID;
    var fDashboard1dashboard;
    loadjs.ready(["wrapper", "head"], function() {
        var $ = jQuery;
        // Form object
        fDashboard1dashboard = new ew.Form("fDashboard1dashboard", "dashboard");
        currentPageID = ew.PAGE_ID = "dashboard";
        currentForm = fDashboard1dashboard;
        loadjs.done("fDashboard1dashboard");
    });
</script>
<script>
    loadjs.ready("head", function() {
        // Write your table-specific client script here, no need to add script tags.
    });
</script>
<!-- Content Container -->
<div id="ew-report" class="ew-report">
    <div class="btn-toolbar ew-toolbar"></div>
    <?php $Page->showPageHeader(); ?>
    <?php
    $Page->showMessage();
    ?>
    <!-- Dashboard Container -->
    <div id="ew-dashboard" class="container-fluid ew-dashboard">
        <div class="row">
            <div class="col-lg-6 mw-40">
                <div class="card">
                    <h3 class="card-header">Jumlah Paket/Surat Masuk Bulan Ini</h3>
                    <div class="card-body">
                        <center>
                            <?php
                            $paketMasuk = Container("paketMasuk");
                            $paketMasuk->chartPaketMasuk->Width = 300;
                            $paketMasuk->chartPaketMasuk->Height = 300;
                            $paketMasuk->chartPaketMasuk->setParameter("clickurl", "paketmasuk"); // Add click URL
                            $paketMasuk->chartPaketMasuk->DrillDownUrl = ""; // No drill down for dashboard
                            $paketMasuk->chartPaketMasuk->render("ew-chart-top");
                            ?>
                        </center>
                    </div>
                </div>
                <div class="col-lg-12 mw-40">
                    <div class="card">
                        <h3 class="card-header">Jumlah Filling Dokumen Bulan Ini</h3>
                        <div class="card-body">
                            <center>
                                <?php
                                $filingDokumen = Container("filingDokumen");
                                $filingDokumen->filingdokumen->Width = 300;
                                $filingDokumen->filingdokumen->Height = 300;
                                $filingDokumen->filingdokumen->setParameter("clickurl", "filingdokumen"); // Add click URL
                                $filingDokumen->filingdokumen->DrillDownUrl = ""; // No drill down for dashboard
                                $filingDokumen->filingdokumen->render("ew-chart-top");
                                ?>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mw-40">
                <div class="card">
                    <h3 class="card-header">Jumlah Paket/Surat Keluar Bulan Ini</h3>
                    <div class="card-body">
                        <center>
                            <?php
                            $paketKeluar = Container("paketKeluar");
                            $paketKeluar->chartPaketKeluar->Width = 300;
                            $paketKeluar->chartPaketKeluar->Height = 300;
                            $paketKeluar->chartPaketKeluar->setParameter("clickurl", "paketkeluar"); // Add click URL
                            $paketKeluar->chartPaketKeluar->DrillDownUrl = ""; // No drill down for dashboard
                            $paketKeluar->chartPaketKeluar->render("ew-chart-top");
                            ?>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.ew-dashboard -->
</div>
<!-- /.ew-report -->
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
    loadjs.ready("load", function() {
        // Write your table-specific startup script here, no need to add script tags.
    });
</script>