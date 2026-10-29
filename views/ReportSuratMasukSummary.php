<?php

namespace Mitral2022\DSN2;

// Page object
$ReportSuratMasukSummary = &$Page;
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
    <script>
        var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
        ew.deepAssign(ew.vars, {
            tables: {
                Report_Surat_Masuk: currentTable
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
                while ($Page->GroupCount <= count($Page->GroupRecords) && $Page->GroupCount <= $Page->DisplayGroups) {
                ?>
                    <?php
                    // Show header
                    if ($Page->ShowHeader) {
                    ?>
                        <?php if ($Page->GroupCount > 1) { ?>
                            </tbody>
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
            <?= $Page->PageBreakContent ?>
        <?php } ?>
        <div class="<?php if (!$Page->isExport("word") && !$Page->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid" <?= $Page->ReportTableStyle ?>>
            <!-- Report grid (begin) -->
            <div id="gmp_Report_Surat_Masuk" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
                <table class="<?= $Page->ReportTableClass ?>">
                    <thead>
                        <!-- Table header -->
                        <tr class="ew-table-header">
                            <?php if ($Page->nama_dokumen->Visible) { ?>
                                <?php if ($Page->nama_dokumen->ShowGroupHeaderAsRow) { ?>
                                    <th data-name="nama_dokumen">&nbsp;</th>
                                <?php } else { ?>
                                    <th data-name="nama_dokumen" class="<?= $Page->nama_dokumen->headerCellClass() ?>">
                                        <div class="Report_Surat_Masuk_nama_dokumen"><?= $Page->renderFieldHeader($Page->nama_dokumen) ?></div>
                                    </th>
                                <?php } ?>
                            <?php } ?>
                            <?php if ($Page->monthname->Visible) { ?>
                                <th data-name="monthname" class="<?= $Page->monthname->headerCellClass() ?>">
                                    <div class="Report_Surat_Masuk_monthname"><?= $Page->renderFieldHeader($Page->monthname) ?></div>
                                </th>
                            <?php } ?>
                            <?php if ($Page->nama_penerima->Visible) { ?>
                                <th data-name="nama_penerima" class="<?= $Page->nama_penerima->headerCellClass() ?>">
                                    <div class="Report_Surat_Masuk_nama_penerima"><?= $Page->renderFieldHeader($Page->nama_penerima) ?></div>
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

                    // Build detail SQL
                    $where = DetailFilterSql($Page->nama_dokumen, $Page->getSqlFirstGroupField(), $Page->nama_dokumen->groupValue(), $Page->Dbid);
                    if ($Page->PageFirstGroupFilter != "") {
                        $Page->PageFirstGroupFilter .= " OR ";
                    }
                    $Page->PageFirstGroupFilter .= $where;
                    if ($Page->Filter != "") {
                        $where = "($Page->Filter) AND ($where)";
                    }
                    $sql = $Page->buildReportSql($Page->getSqlSelect(), $Page->getSqlFrom(), $Page->getSqlWhere(), $Page->getSqlGroupBy(), $Page->getSqlHaving(), $Page->getSqlOrderBy(), $where, $Page->Sort);
                    $rs = $sql->execute();
                    $Page->DetailRecords = $rs ? $rs->fetchAll() : [];
                    $Page->DetailRecordCount = count($Page->DetailRecords);
                    $Page->setGroupCount($Page->DetailRecordCount, $Page->GroupCount);

                    // Load detail records
                    $Page->nama_dokumen->Records = &$Page->DetailRecords;
                    $Page->nama_dokumen->LevelBreak = true; // Set field level break
                    $Page->GroupCounter[1] = $Page->GroupCount;
                    $Page->nama_dokumen->getCnt($Page->nama_dokumen->Records); // Get record count
                    $Page->setGroupCount($Page->nama_dokumen->Count, $Page->GroupCounter[1]);
                    ?>
                    <?php if ($Page->nama_dokumen->Visible && $Page->nama_dokumen->ShowGroupHeaderAsRow) { ?>
                        <?php
                        // Render header row
                        $Page->resetAttributes();
                        $Page->RowType = ROWTYPE_TOTAL;
                        $Page->RowTotalType = ROWTOTAL_GROUP;
                        $Page->RowTotalSubType = ROWTOTAL_HEADER;
                        $Page->RowGroupLevel = 1;
                        $Page->renderRow();
                        ?>
                        <tr<?= $Page->rowAttributes(); ?>>
                            <?php if ($Page->nama_dokumen->Visible) { ?>
                                <?php $Page->nama_dokumen->CellAttrs->appendClass("ew-rpt-grp-caret"); ?>
                                <td data-field="nama_dokumen" <?= $Page->nama_dokumen->cellAttributes(); ?>><i class="ew-group-toggle fas fa-caret-down"></i></td>
                                <?php $Page->nama_dokumen->CellAttrs->removeClass("ew-rpt-grp-caret"); ?>
                            <?php } ?>
                            <td data-field="nama_dokumen" colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>" <?= $Page->nama_dokumen->cellAttributes() ?>>
                                <span class="ew-summary-caption Report_Surat_Masuk_nama_dokumen"><?= $Page->renderFieldHeader($Page->nama_dokumen) ?></span><?= $Language->phrase("SummaryColon") ?><span<?= $Page->nama_dokumen->viewAttributes() ?>><?= $Page->nama_dokumen->GroupViewValue ?></span>
                                    <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?= $Language->phrase("RptCnt") ?></span><?= $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?= FormatNumber($Page->nama_dokumen->Count, Config("DEFAULT_NUMBER_FORMAT")) ?></span>)</span>
                            </td>
                            </tr>
                        <?php } ?>
                        <?php
                        $Page->RecordCount = 0; // Reset record count
                        foreach ($Page->nama_dokumen->Records as $record) {
                            $Page->RecordCount++;
                            $Page->RecordIndex++;
                            $Page->loadRowValues($record);
                        ?>
                            <?php
                            // Render detail row
                            $Page->resetAttributes();
                            $Page->RowType = ROWTYPE_DETAIL;
                            $Page->renderRow();
                            ?>
                            <tr<?= $Page->rowAttributes(); ?>>
                                <?php if ($Page->nama_dokumen->Visible) { ?>
                                    <?php if ($Page->nama_dokumen->ShowGroupHeaderAsRow) { ?>
                                        <td data-field="nama_dokumen" <?= $Page->nama_dokumen->cellAttributes() ?>></td>
                                    <?php } else { ?>
                                        <td data-field="nama_dokumen" <?= $Page->nama_dokumen->cellAttributes() ?>>
                                            <span<?= $Page->nama_dokumen->viewAttributes() ?>><?= $Page->nama_dokumen->GroupViewValue ?></span>
                                        </td>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($Page->monthname->Visible) { ?>
                                    <td data-field="monthname" <?= $Page->monthname->cellAttributes() ?>>
                                        <span<?= $Page->monthname->viewAttributes() ?>>
                                            <?= $Page->monthname->getViewValue() ?></span>
                                    </td>
                                <?php } ?>
                                <?php if ($Page->nama_penerima->Visible) { ?>
                                    <td data-field="nama_penerima" <?= $Page->nama_penerima->cellAttributes() ?>>
                                        <span<?= $Page->nama_penerima->viewAttributes() ?>>
                                            <?= $Page->nama_penerima->getViewValue() ?></span>
                                    </td>
                                <?php } ?>
                                </tr>
                            <?php
                        }
                            ?>
                        <?php

                        // Next group
                        $Page->loadGroupRowValues();

                        // Show header if page break
                        if ($Page->isExport()) {
                            $Page->ShowHeader = ($Page->ExportPageBreakCount == 0) ? false : ($Page->GroupCount % $Page->ExportPageBreakCount == 0);
                        }

                        // Page_Breaking server event
                        if ($Page->ShowHeader) {
                            $Page->pageBreaking($Page->ShowHeader, $Page->PageBreakContent);
                        }
                        $Page->GroupCount++;
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
                        <?php if ($Page->nama_dokumen->ShowCompactSummaryFooter) { ?>
                            <tr<?= $Page->rowAttributes() ?>>
                                <td colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?= $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?= $Language->phrase("RptCnt") ?></span><?= $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?= FormatNumber($Page->TotalCount, Config("DEFAULT_NUMBER_FORMAT")) ?></span>)</span></td>
                                </tr>
                                <tr<?= $Page->rowAttributes() ?>>
                                    <?php if ($Page->GroupColumnCount > 0) { ?>
                                        <td colspan="<?= $Page->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"></td>
                                    <?php } ?>
                                    <?php if ($Page->monthname->Visible) { ?>
                                        <td data-field="monthname" <?= $Page->monthname->cellAttributes() ?>><span class="ew-aggregate-caption"><?= $Language->phrase("RptCnt") ?></span><?= $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value">
                                                <span<?= $Page->monthname->viewAttributes() ?>><?= $Page->monthname->CntViewValue ?>
                                            </span></span></td>
                                    <?php } ?>
                                    <?php if ($Page->nama_penerima->Visible) { ?>
                                        <td data-field="nama_penerima" <?= $Page->nama_penerima->cellAttributes() ?>><span class="ew-aggregate-caption"><?= $Language->phrase("RptSum") ?></span><?= $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value">
                                                <span<?= $Page->nama_penerima->viewAttributes() ?>><?= $Page->nama_penerima->SumViewValue ?>
                                            </span></span><br><span class="ew-aggregate-caption"><?= $Language->phrase("RptAvg") ?></span><?= $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value">
                                                <span<?= $Page->nama_penerima->viewAttributes() ?>><?= $Page->nama_penerima->AvgViewValue ?>
                                            </span></span><br><span class="ew-aggregate-caption"><?= $Language->phrase("RptMin") ?></span><?= $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value">
                                                <span<?= $Page->nama_penerima->viewAttributes() ?>><?= $Page->nama_penerima->MinViewValue ?>
                                            </span></span><br><span class="ew-aggregate-caption"><?= $Language->phrase("RptMax") ?></span><?= $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value">
                                                <span<?= $Page->nama_penerima->viewAttributes() ?>><?= $Page->nama_penerima->MaxViewValue ?>
                                            </span></span><br><span class="ew-aggregate-caption"><?= $Language->phrase("RptCnt") ?></span><?= $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value">
                                                <span<?= $Page->nama_penerima->viewAttributes() ?>><?= $Page->nama_penerima->CntViewValue ?>
                                            </span></span></td>
                                    <?php } ?>
                                    </tr>
                                <?php } else { ?>
                                    <tr<?= $Page->rowAttributes() ?>>
                                        <td colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?= $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?= FormatNumber($Page->TotalCount, Config("DEFAULT_NUMBER_FORMAT")) ?><?= $Language->phrase("RptDtlRec") ?>)</span></td>
                                        </tr>
                                        <tr<?= $Page->rowAttributes() ?>>
                                            <?php if ($Page->GroupColumnCount > 0) { ?>
                                                <td colspan="<?= $Page->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?= $Language->phrase("RptSum") ?></td>
                                            <?php } ?>
                                            <?php if ($Page->monthname->Visible) { ?>
                                                <td data-field="monthname" <?= $Page->monthname->cellAttributes() ?>></td>
                                            <?php } ?>
                                            <?php if ($Page->nama_penerima->Visible) { ?>
                                                <td data-field="nama_penerima" <?= $Page->nama_penerima->cellAttributes() ?>>
                                                    <span<?= $Page->nama_penerima->viewAttributes() ?>>
                                                        <?= $Page->nama_penerima->SumViewValue ?></span>
                                                </td>
                                            <?php } ?>
                                            </tr>
                                            <tr<?= $Page->rowAttributes() ?>>
                                                <?php if ($Page->GroupColumnCount > 0) { ?>
                                                    <td colspan="<?= $Page->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?= $Language->phrase("RptAvg") ?></td>
                                                <?php } ?>
                                                <?php if ($Page->monthname->Visible) { ?>
                                                    <td data-field="monthname" <?= $Page->monthname->cellAttributes() ?>></td>
                                                <?php } ?>
                                                <?php if ($Page->nama_penerima->Visible) { ?>
                                                    <td data-field="nama_penerima" <?= $Page->nama_penerima->cellAttributes() ?>>
                                                        <span<?= $Page->nama_penerima->viewAttributes() ?>>
                                                            <?= $Page->nama_penerima->AvgViewValue ?></span>
                                                    </td>
                                                <?php } ?>
                                                </tr>
                                                <tr<?= $Page->rowAttributes() ?>>
                                                    <?php if ($Page->GroupColumnCount > 0) { ?>
                                                        <td colspan="<?= $Page->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?= $Language->phrase("RptMin") ?></td>
                                                    <?php } ?>
                                                    <?php if ($Page->monthname->Visible) { ?>
                                                        <td data-field="monthname" <?= $Page->monthname->cellAttributes() ?>></td>
                                                    <?php } ?>
                                                    <?php if ($Page->nama_penerima->Visible) { ?>
                                                        <td data-field="nama_penerima" <?= $Page->nama_penerima->cellAttributes() ?>>
                                                            <span<?= $Page->nama_penerima->viewAttributes() ?>>
                                                                <?= $Page->nama_penerima->MinViewValue ?></span>
                                                        </td>
                                                    <?php } ?>
                                                    </tr>
                                                    <tr<?= $Page->rowAttributes() ?>>
                                                        <?php if ($Page->GroupColumnCount > 0) { ?>
                                                            <td colspan="<?= $Page->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?= $Language->phrase("RptMax") ?></td>
                                                        <?php } ?>
                                                        <?php if ($Page->monthname->Visible) { ?>
                                                            <td data-field="monthname" <?= $Page->monthname->cellAttributes() ?>></td>
                                                        <?php } ?>
                                                        <?php if ($Page->nama_penerima->Visible) { ?>
                                                            <td data-field="nama_penerima" <?= $Page->nama_penerima->cellAttributes() ?>>
                                                                <span<?= $Page->nama_penerima->viewAttributes() ?>>
                                                                    <?= $Page->nama_penerima->MaxViewValue ?></span>
                                                            </td>
                                                        <?php } ?>
                                                        </tr>
                                                        <tr<?= $Page->rowAttributes() ?>>
                                                            <?php if ($Page->GroupColumnCount > 0) { ?>
                                                                <td colspan="<?= $Page->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?= $Language->phrase("RptCnt") ?></td>
                                                            <?php } ?>
                                                            <?php if ($Page->monthname->Visible) { ?>
                                                                <td data-field="monthname" <?= $Page->monthname->cellAttributes() ?>>
                                                                    <span<?= $Page->monthname->viewAttributes() ?>>
                                                                        <?= $Page->monthname->CntViewValue ?></span>
                                                                </td>
                                                            <?php } ?>
                                                            <?php if ($Page->nama_penerima->Visible) { ?>
                                                                <td data-field="nama_penerima" <?= $Page->nama_penerima->cellAttributes() ?>>
                                                                    <span<?= $Page->nama_penerima->viewAttributes() ?>>
                                                                        <?= $Page->nama_penerima->CntViewValue ?></span>
                                                                </td>
                                                            <?php } ?>
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
                $Page->JumlahPaketSuratMasukBulanIni->PageBreakType = "before"; // Page break type
                $Page->JumlahPaketSuratMasukBulanIni->PageBreak = $Page->ExportChartPageBreak;
                $Page->JumlahPaketSuratMasukBulanIni->PageBreakContent = $Page->PageBreakContent;
            }

            // Set up chart drilldown
            $Page->JumlahPaketSuratMasukBulanIni->DrillDownInPanel = $Page->DrillDownInPanel;
            $Page->JumlahPaketSuratMasukBulanIni->render("ew-chart-bottom");
        }
        ?>
        <?php if (!$DashboardReport && !$Page->isExport("email") && !$Page->DrillDown && $Page->JumlahPaketSuratMasukBulanIni->hasData()) { ?>
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