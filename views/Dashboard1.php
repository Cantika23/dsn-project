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
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Jumlah Paket/Surat Masuk Bulan Ini</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        $Report_Paket_Masuk = Container("Report_Paket_Masuk");

                        if ($Report_Paket_Masuk && isset($Report_Paket_Masuk->JumlahPaketSuratMasukBulanIni) && $Report_Paket_Masuk->JumlahPaketSuratMasukBulanIni) {
                            $Report_Paket_Masuk->JumlahPaketSuratMasukBulanIni->Width = 300;
                            $Report_Paket_Masuk->JumlahPaketSuratMasukBulanIni->Height = 300;
                            $Report_Paket_Masuk->JumlahPaketSuratMasukBulanIni->setParameter("clickurl", "reportpaketmasuk");
                            $Report_Paket_Masuk->JumlahPaketSuratMasukBulanIni->DrillDownUrl = "";
                            $Report_Paket_Masuk->JumlahPaketSuratMasukBulanIni->render("ew-chart-top");
                        } else {
                            echo '<div class="alert alert-warning">Chart tidak tersedia</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Jumlah Paket/Surat Keluar Bulan Ini</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        $Report_Paket_Keluar = Container("Report_Paket_Keluar");

                        if ($Report_Paket_Keluar && isset($Report_Paket_Keluar->JumlahPaketSuratMasukBulanIni) && $Report_Paket_Keluar->JumlahPaketSuratMasukBulanIni) {
                            $Report_Paket_Keluar->JumlahPaketSuratKeluarBulanIni->Width = 300;
                            $Report_Paket_Keluar->JumlahPaketSuratKeluarBulanIni->Height = 300;
                            $Report_Paket_Keluar->JumlahPaketSuratKeluarBulanIni->setParameter("clickurl", "reportpaketmasuk");
                            $Report_Paket_Keluar->JumlahPaketSuratKeluarBulanIni->DrillDownUrl = "";
                            $Report_Paket_Keluar->JumlahPaketSuratKeluarBulanIni->render("ew-chart-top");
                        } else {
                            echo '<div class="alert alert-warning">Chart tidak tersedia</div>';
                        }
                        ?>
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