<?php

namespace Mitral2022\DSN2;

// Page object
$Report1Summary = &$Page;
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
    <script>
        var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
        ew.deepAssign(ew.vars, {
            tables: {
                Report1: currentTable
            }
        });
        var currentForm, currentPageID;
        var fReport1srch, currentSearchForm, currentAdvancedSearchForm;
        loadjs.ready(["wrapper", "head"], function() {
            var $ = jQuery;
            // Form object for search
            fReport1srch = new ew.Form("fReport1srch", "summary");
            currentSearchForm = fReport1srch;
            currentPageID = ew.PAGE_ID = "summary";

            // Add fields
            var fields = currentTable.fields;
            fReport1srch.addFields([
                ["no_dokumen", [], fields.no_dokumen.isInvalid],
                ["tanggal_terima", [], fields.tanggal_terima.isInvalid],
                ["nama_penerima", [], fields.nama_penerima.isInvalid],
                ["no_hp_penerima", [], fields.no_hp_penerima.isInvalid],
                ["email_penerima", [], fields.email_penerima.isInvalid],
                ["tujuan_penerima", [], fields.tujuan_penerima.isInvalid]
            ]);

            // Validate form
            fReport1srch.validate = function() {
                if (!this.validateRequired)
                    return true; // Ignore validation
                var fobj = this.getForm();

                // Validate fields
                if (!this.validateFields())
                    return false;

                // Call Form_CustomValidate event
                if (!this.customValidate(fobj)) {
                    this.focus();
                    return false;
                }
                return true;
            }

            // Form_CustomValidate
            fReport1srch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
                // Your custom validation code here, return false if invalid.
                return true;
            }

            // Use JavaScript validation or not
            fReport1srch.validateRequired = ew.CLIENT_VALIDATE;

            // Dynamic selection lists
            fReport1srch.lists.id_user = <?= $Page->id_user->toClientList($Page) ?>;
            fReport1srch.lists.no_paket = <?= $Page->no_paket->toClientList($Page) ?>;

            // Filters
            fReport1srch.filterList = <?= $Page->getFilterList() ?>;
            loadjs.done("fReport1srch");
        });
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
    <?php if ($Page->ShowCurrentFilter) { ?>
        <?php $Page->showFilterList() ?>
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
                    <?php if ($Security->canSearch()) { ?>
                        <?php if (!$Page->isExport() && !$Page->CurrentAction && $Page->hasSearchFields()) { ?>
                            <form name="fReport1srch" id="fReport1srch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
                                <div id="fReport1srch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
                                    <input type="hidden" name="cmd" value="search">
                                    <input type="hidden" name="t" value="Report1">
                                    <div class="ew-extended-search container-fluid">
                                        <div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
                                            <?php
                                            // Render search row
                                            $Page->RowType = ROWTYPE_SEARCH;
                                            $Page->resetAttributes();
                                            $Page->renderRow();
                                            ?>
                                            <?php if ($Page->id_user->Visible) { // id_user 
                                            ?>
                                                <?php
                                                if (!$Page->id_user->UseFilter) {
                                                    $Page->SearchColumnCount++;
                                                }
                                                ?>
                                                <div id="xs_id_user" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->id_user->UseFilter ? " ew-filter-field" : "" ?>">
                                                    <select id="x_id_user" name="x_id_user[]" class="form-control ew-select<?= $Page->id_user->isInvalidClass() ?>" data-select2-id="fReport1srch_x_id_user" data-table="Report1" data-field="x_id_user" data-caption="<?= HtmlEncode(RemoveHtml($Page->id_user->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->id_user->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->id_user->getPlaceHolder()) ?>" <?= $Page->id_user->editAttributes() ?>>
                                                        <?= $Page->id_user->selectOptionListHtml("x_id_user", true) ?>
                                                    </select>
                                                    <div class="invalid-feedback"><?= $Page->id_user->getErrorMessage() ?></div>
                                                    <script>
                                                        loadjs.ready("fReport1srch", function() {
                                                            var options = {
                                                                name: "x_id_user",
                                                                selectId: "fReport1srch_x_id_user",
                                                                ajax: {
                                                                    id: "x_id_user",
                                                                    form: "fReport1srch",
                                                                    limit: ew.FILTER_PAGE_SIZE,
                                                                    data: {
                                                                        ajax: "filter"
                                                                    }
                                                                }
                                                            };
                                                            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.Report1.fields.id_user.filterOptions);
                                                            ew.createFilter(options);
                                                        });
                                                    </script>
                                                </div><!-- /.col-sm-auto -->
                                            <?php } ?>
                                            <?php if ($Page->no_paket->Visible) { // no_paket 
                                            ?>
                                                <?php
                                                if (!$Page->no_paket->UseFilter) {
                                                    $Page->SearchColumnCount++;
                                                }
                                                ?>
                                                <div id="xs_no_paket" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->no_paket->UseFilter ? " ew-filter-field" : "" ?>">
                                                    <select id="x_no_paket" name="x_no_paket[]" class="form-control ew-select<?= $Page->no_paket->isInvalidClass() ?>" data-select2-id="fReport1srch_x_no_paket" data-table="Report1" data-field="x_no_paket" data-caption="<?= HtmlEncode(RemoveHtml($Page->no_paket->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->no_paket->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->no_paket->getPlaceHolder()) ?>" <?= $Page->no_paket->editAttributes() ?>>
                                                        <?= $Page->no_paket->selectOptionListHtml("x_no_paket", true) ?>
                                                    </select>
                                                    <div class="invalid-feedback"><?= $Page->no_paket->getErrorMessage() ?></div>
                                                    <script>
                                                        loadjs.ready("fReport1srch", function() {
                                                            var options = {
                                                                name: "x_no_paket",
                                                                selectId: "fReport1srch_x_no_paket",
                                                                ajax: {
                                                                    id: "x_no_paket",
                                                                    form: "fReport1srch",
                                                                    limit: ew.FILTER_PAGE_SIZE,
                                                                    data: {
                                                                        ajax: "filter"
                                                                    }
                                                                }
                                                            };
                                                            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.Report1.fields.no_paket.filterOptions);
                                                            ew.createFilter(options);
                                                        });
                                                    </script>
                                                </div><!-- /.col-sm-auto -->
                                            <?php } ?>
                                            <?php if ($Page->SearchColumnCount > 0) { ?>
                                                <div class="col-sm-auto mb-3">
                                                    <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
                                                </div>
                                            <?php } ?>
                                        </div><!-- /.row -->
                                    </div><!-- /.ew-extended-search -->
                                </div><!-- /.ew-search-panel -->
                            </form>
                        <?php } ?>
                    <?php } ?>
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
                            <div id="gmp_Report1" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
                                <table class="<?= $Page->ReportTableClass ?>">
                                    <thead>
                                        <!-- Table header -->
                                        <tr class="ew-table-header">
                                            <?php if ($Page->no_dokumen->Visible) { ?>
                                                <th data-name="no_dokumen" class="<?= $Page->no_dokumen->headerCellClass() ?>">
                                                    <div class="Report1_no_dokumen"><?= $Page->renderFieldHeader($Page->no_dokumen) ?></div>
                                                </th>
                                            <?php } ?>
                                            <?php if ($Page->tanggal_terima->Visible) { ?>
                                                <th data-name="tanggal_terima" class="<?= $Page->tanggal_terima->headerCellClass() ?>">
                                                    <div class="Report1_tanggal_terima"><?= $Page->renderFieldHeader($Page->tanggal_terima) ?></div>
                                                </th>
                                            <?php } ?>
                                            <?php if ($Page->nama_penerima->Visible) { ?>
                                                <th data-name="nama_penerima" class="<?= $Page->nama_penerima->headerCellClass() ?>">
                                                    <div class="Report1_nama_penerima"><?= $Page->renderFieldHeader($Page->nama_penerima) ?></div>
                                                </th>
                                            <?php } ?>
                                            <?php if ($Page->no_hp_penerima->Visible) { ?>
                                                <th data-name="no_hp_penerima" class="<?= $Page->no_hp_penerima->headerCellClass() ?>">
                                                    <div class="Report1_no_hp_penerima"><?= $Page->renderFieldHeader($Page->no_hp_penerima) ?></div>
                                                </th>
                                            <?php } ?>
                                            <?php if ($Page->email_penerima->Visible) { ?>
                                                <th data-name="email_penerima" class="<?= $Page->email_penerima->headerCellClass() ?>">
                                                    <div class="Report1_email_penerima"><?= $Page->renderFieldHeader($Page->email_penerima) ?></div>
                                                </th>
                                            <?php } ?>
                                            <?php if ($Page->tujuan_penerima->Visible) { ?>
                                                <th data-name="tujuan_penerima" class="<?= $Page->tujuan_penerima->headerCellClass() ?>">
                                                    <div class="Report1_tujuan_penerima"><?= $Page->renderFieldHeader($Page->tujuan_penerima) ?></div>
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
                                        <?php if ($Page->tujuan_penerima->Visible) { ?>
                                            <td data-field="tujuan_penerima" <?= $Page->tujuan_penerima->cellAttributes() ?>>
                                                <span<?= $Page->tujuan_penerima->viewAttributes() ?>>
                                                    <?= $Page->tujuan_penerima->getViewValue() ?></span>
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
                    $Page->JumlahPenerimaanPaketSuratKeluar->PageBreakType = "before"; // Page break type
                    $Page->JumlahPenerimaanPaketSuratKeluar->PageBreak = $Page->ExportChartPageBreak;
                    $Page->JumlahPenerimaanPaketSuratKeluar->PageBreakContent = $Page->PageBreakContent;
                }

                // Set up chart drilldown
                $Page->JumlahPenerimaanPaketSuratKeluar->DrillDownInPanel = $Page->DrillDownInPanel;
                $Page->JumlahPenerimaanPaketSuratKeluar->render("ew-chart-bottom");
            }
            ?>
            <?php if (!$DashboardReport && !$Page->isExport("email") && !$Page->DrillDown && $Page->JumlahPenerimaanPaketSuratKeluar->hasData()) { ?>
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