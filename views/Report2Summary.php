<?php

namespace Mitral2022\DSN2;

// Page object
$Report2Summary = &$Page;
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
    <script>
        var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
        ew.deepAssign(ew.vars, {
            tables: {
                Report2: currentTable
            }
        });
        var currentForm, currentPageID;
    </script>
    <script>
        loadjs.ready("head", function() {
            // Write your table-specific client script here, no need to add script tags.
        });
    </script>
<?php } ?>
<a id="top"></a>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
    <!-- Content Container -->
    <div id="ew-report" class="ew-report container-fluid">
    <?php } ?>
    <div class="btn-toolbar ew-toolbar">
        <?php
        if (!$Page->DrillDownInPanel) {
            $Page->ExportOptions->render("body");
            $Page->SearchOptions->render("body");
            $Page->FilterOptions->render("body");
        }
        ?>
    </div>
    <?php $Page->showPageHeader(); ?>
    <?php
    $Page->showMessage();
    ?>
    <?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
        <div class="row">
        <?php } ?>
        <?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
            <!-- Center Container -->
            <div id="ew-center" class="<?= $Page->CenterContentClass ?>">
            <?php } ?>
            <!-- Summary report (begin) -->
            <div id="report_summary">
                <?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
                <?php } ?>
                <?php
                while ($Page->RecordCount < count($Page->DetailRecords) && $Page->RecordCount < $Page->DisplayGroups) {
                ?>
                    <?php
                    // Show header
                    if ($Page->ShowHeader) {
                    ?>
                        <div class="<?php if (!$Page->isExport("word") && !$Page->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid" <?= $Page->ReportTableStyle ?>>
                            <!-- Report grid (begin) -->
                            <div id="gmp_Report2" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
                                <table class="<?= $Page->ReportTableClass ?>">
                                    <thead>
                                        <!-- Table header -->
                                        <tr class="ew-table-header">
                                            <?php if ($Page->no_dokumen->Visible) { ?>
                                                <th data-name="no_dokumen" class="<?= $Page->no_dokumen->headerCellClass() ?>">
                                                    <div class="Report2_no_dokumen"><?= $Page->renderFieldHeader($Page->no_dokumen) ?></div>
                                                </th>
                                            <?php } ?>
                                            <?php if ($Page->tanggal_terima->Visible) { ?>
                                                <th data-name="tanggal_terima" class="<?= $Page->tanggal_terima->headerCellClass() ?>">
                                                    <div class="Report2_tanggal_terima"><?= $Page->renderFieldHeader($Page->tanggal_terima) ?></div>
                                                </th>
                                            <?php } ?>
                                            <?php if ($Page->nama_penerima->Visible) { ?>
                                                <th data-name="nama_penerima" class="<?= $Page->nama_penerima->headerCellClass() ?>">
                                                    <div class="Report2_nama_penerima"><?= $Page->renderFieldHeader($Page->nama_penerima) ?></div>
                                                </th>
                                            <?php } ?>
                                            <?php if ($Page->jenis_dokumen->Visible) { ?>
                                                <th data-name="jenis_dokumen" class="<?= $Page->jenis_dokumen->headerCellClass() ?>">
                                                    <div class="Report2_jenis_dokumen"><?= $Page->renderFieldHeader($Page->jenis_dokumen) ?></div>
                                                </th>
                                            <?php } ?>
                                            <?php if ($Page->no_hp_penerima->Visible) { ?>
                                                <th data-name="no_hp_penerima" class="<?= $Page->no_hp_penerima->headerCellClass() ?>">
                                                    <div class="Report2_no_hp_penerima"><?= $Page->renderFieldHeader($Page->no_hp_penerima) ?></div>
                                                </th>
                                            <?php } ?>
                                            <?php if ($Page->email_penerima->Visible) { ?>
                                                <th data-name="email_penerima" class="<?= $Page->email_penerima->headerCellClass() ?>">
                                                    <div class="Report2_email_penerima"><?= $Page->renderFieldHeader($Page->email_penerima) ?></div>
                                                </th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if ($Page->TotalGroups == 0) {
                                        break; // Show header only
                                    }
                                    $Page->ShowHeader = false;
                                } // End show header
                                    ?>
                                    <?php
                                    $Page->loadRowValues($Page->DetailRecords[$Page->RecordCount]);
                                    $Page->RecordCount++;
                                    $Page->RecordIndex++;
                                    ?>
                                    <?php
                                    // Render detail row
                                    $Page->resetAttributes();
                                    $Page->RowType = ROWTYPE_DETAIL;
                                    $Page->renderRow();
                                    ?>
                                    <tr<?= $Page->rowAttributes(); ?>>
                                        <?php if ($Page->no_dokumen->Visible) { ?>
                                            <td data-field="no_dokumen" <?= $Page->no_dokumen->cellAttributes() ?>>
                                                <span<?= $Page->no_dokumen->viewAttributes() ?>>
                                                    <?= $Page->no_dokumen->getViewValue() ?></span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->tanggal_terima->Visible) { ?>
                                            <td data-field="tanggal_terima" <?= $Page->tanggal_terima->cellAttributes() ?>>
                                                <span<?= $Page->tanggal_terima->viewAttributes() ?>>
                                                    <?= $Page->tanggal_terima->getViewValue() ?></span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->nama_penerima->Visible) { ?>
                                            <td data-field="nama_penerima" <?= $Page->nama_penerima->cellAttributes() ?>>
                                                <span<?= $Page->nama_penerima->viewAttributes() ?>>
                                                    <?= $Page->nama_penerima->getViewValue() ?></span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->jenis_dokumen->Visible) { ?>
                                            <td data-field="jenis_dokumen" <?= $Page->jenis_dokumen->cellAttributes() ?>>
                                                <span<?= $Page->jenis_dokumen->viewAttributes() ?>>
                                                    <?= $Page->jenis_dokumen->getViewValue() ?></span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->no_hp_penerima->Visible) { ?>
                                            <td data-field="no_hp_penerima" <?= $Page->no_hp_penerima->cellAttributes() ?>>
                                                <span<?= $Page->no_hp_penerima->viewAttributes() ?>>
                                                    <?= $Page->no_hp_penerima->getViewValue() ?></span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->email_penerima->Visible) { ?>
                                            <td data-field="email_penerima" <?= $Page->email_penerima->cellAttributes() ?>>
                                                <span<?= $Page->email_penerima->viewAttributes() ?>>
                                                    <?= $Page->email_penerima->getViewValue() ?></span>
                                            </td>
                                        <?php } ?>
                                        </tr>
                                    <?php
                                } // End while
                                    ?>
                                    <?php if ($Page->TotalGroups > 0) { ?>
                                    </tbody>
                                    <tfoot>
                                        <?php
                                        $Page->resetAttributes();
                                        $Page->RowType = ROWTYPE_TOTAL;
                                        $Page->RowTotalType = ROWTOTAL_GRAND;
                                        $Page->RowTotalSubType = ROWTOTAL_FOOTER;
                                        $Page->RowAttrs["class"] = "ew-rpt-grand-summary";
                                        $Page->renderRow();
                                        ?>
                                        <?php if ($Page->ShowCompactSummaryFooter) { ?>
                                            <tr<?= $Page->rowAttributes() ?>>
                                                <td colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?= $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?= $Language->phrase("RptCnt") ?></span><?= $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?= FormatNumber($Page->TotalCount, Config("DEFAULT_NUMBER_FORMAT")) ?></span>)</span></td>
                                                </tr>
                                            <?php } else { ?>
                                                <tr<?= $Page->rowAttributes() ?>>
                                                    <td colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?= $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?= FormatNumber($Page->TotalCount, Config("DEFAULT_NUMBER_FORMAT")) ?><?= $Language->phrase("RptDtlRec") ?>)</span></td>
                                                    </tr>
                                                <?php } ?>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.ew-grid-middle-panel -->
                            <!-- Report grid (end) -->
                            <?php if (!$Page->isExport() && !($Page->DrillDown && $Page->TotalGroups > 0)) { ?>
                                <!-- Bottom pager -->
                                <div class="card-footer ew-grid-lower-panel">
                                    <form name="ew-pager-form" class="ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
                                        <?= $Page->Pager->render() ?>
                                    </form>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- /.ew-grid -->
                    <?php } ?>
            </div>
            <!-- /#report-summary -->
            <!-- Summary report (end) -->
            <?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
            </div>
            <!-- /#ew-center -->
        <?php } ?>
        <?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
        </div>
        <!-- /.row -->
    <?php } ?>
    <?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
        <!-- Bottom Container -->
        <div class="row">
            <div id="ew-bottom" class="<?= $Page->BottomContentClass ?>">
            <?php } ?>
            <?php
            if (!$DashboardReport) {
                // Set up page break
                if (($Page->isExport("print") || $Page->isExport("pdf") || $Page->isExport("email") || $Page->isExport("excel") && Config("USE_PHPEXCEL") || $Page->isExport("word") && Config("USE_PHPWORD")) && $Page->ExportChartPageBreak) {
                    // Page_Breaking server event
                    $Page->pageBreaking($Page->ExportChartPageBreak, $Page->PageBreakContent);

                    // Set up chart page break
                    $Page->JumlahPenerimaanPaketSuratMasuk->PageBreakType = "before"; // Page break type
                    $Page->JumlahPenerimaanPaketSuratMasuk->PageBreak = $Page->ExportChartPageBreak;
                    $Page->JumlahPenerimaanPaketSuratMasuk->PageBreakContent = $Page->PageBreakContent;
                }

                // Set up chart drilldown
                $Page->JumlahPenerimaanPaketSuratMasuk->DrillDownInPanel = $Page->DrillDownInPanel;
                $Page->JumlahPenerimaanPaketSuratMasuk->render("ew-chart-bottom");
            }
            ?>
            <?php if (!$DashboardReport && !$Page->isExport("email") && !$Page->DrillDown && $Page->JumlahPenerimaanPaketSuratMasuk->hasData()) { ?>
                <?php if (!$Page->isExport()) { ?>
                    <div class="mb-3"><a class="ew-top-link" data-ew-action="scroll-top"><?= $Language->phrase("Top") ?></a></div>
                <?php } ?>
            <?php } ?>
            <?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
            </div>
        </div>
        <!-- /#ew-bottom -->
    <?php } ?>
    <?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
    </div>
    <!-- /.ew-report -->
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
    <script>
        loadjs.ready("load", function() {
            // Write your table-specific startup script here, no need to add script tags.
        });
    </script>
<?php } ?>