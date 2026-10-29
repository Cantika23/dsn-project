<?php

namespace Mitral2022\DSN2;

// Page object
$Reportpaketkeluar2List = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
    <script>
        var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
        ew.deepAssign(ew.vars, {
            tables: {
                reportpaketkeluar2: currentTable
            }
        });
        var currentForm, currentPageID;
        var freportpaketkeluar2list;
        loadjs.ready(["wrapper", "head"], function() {
            var $ = jQuery;
            // Form object
            freportpaketkeluar2list = new ew.Form("freportpaketkeluar2list", "list");
            currentPageID = ew.PAGE_ID = "list";
            currentForm = freportpaketkeluar2list;
            freportpaketkeluar2list.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
            loadjs.done("freportpaketkeluar2list");
        });
        var freportpaketkeluar2srch, currentSearchForm, currentAdvancedSearchForm;
        loadjs.ready(["wrapper", "head"], function() {
            var $ = jQuery;
            // Form object for search
            freportpaketkeluar2srch = new ew.Form("freportpaketkeluar2srch", "list");
            currentSearchForm = freportpaketkeluar2srch;

            // Dynamic selection lists

            // Filters
            freportpaketkeluar2srch.filterList = <?= $Page->getFilterList() ?>;
            loadjs.done("freportpaketkeluar2srch");
        });
    </script>
    <script>
        loadjs.ready("head", function() {
            // Write your table-specific client script here, no need to add script tags.
        });
    </script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
    <div class="btn-toolbar ew-toolbar">
        <?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
            <?php $Page->ExportOptions->render("body") ?>
        <?php } ?>
        <?php if ($Page->ImportOptions->visible()) { ?>
            <?php $Page->ImportOptions->render("body") ?>
        <?php } ?>
        <?php if ($Page->SearchOptions->visible()) { ?>
            <?php $Page->SearchOptions->render("body") ?>
        <?php } ?>
        <?php if ($Page->FilterOptions->visible()) { ?>
            <?php $Page->FilterOptions->render("body") ?>
        <?php } ?>
    </div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if ($Security->canSearch()) { ?>
    <?php if (!$Page->isExport() && !$Page->CurrentAction && $Page->hasSearchFields()) { ?>
        <form name="freportpaketkeluar2srch" id="freportpaketkeluar2srch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
            <div id="freportpaketkeluar2srch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
                <input type="hidden" name="cmd" value="search">
                <input type="hidden" name="t" value="reportpaketkeluar2">
                <div class="ew-extended-search container-fluid">
                    <div class="row mb-0">
                        <div class="col-sm-auto px-0 pe-sm-2">
                            <div class="ew-basic-search input-group">
                                <input type="search" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control ew-basic-search-keyword" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
                                <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="ew-basic-search-type" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
                                <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                                    <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="freportpaketkeluar2srch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="freportpaketkeluar2srch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="freportpaketkeluar2srch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="freportpaketkeluar2srch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-auto mb-3">
                            <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
                        </div>
                    </div>
                </div><!-- /.ew-extended-search -->
            </div><!-- /.ew-search-panel -->
        </form>
    <?php } ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
    <div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> reportpaketkeluar2">
        <form name="freportpaketkeluar2list" id="freportpaketkeluar2list" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
            <?php if (Config("CHECK_TOKEN")) { ?>
                <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
                <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
            <?php } ?>
            <input type="hidden" name="t" value="reportpaketkeluar2">
            <div id="gmp_reportpaketkeluar2" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
                <?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
                    <table id="tbl_reportpaketkeluar2list" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
                        <thead>
                            <tr class="ew-table-header">
                                <?php
                                // Header row
                                $Page->RowType = ROWTYPE_HEADER;

                                // Render list options
                                $Page->renderListOptions();

                                // Render list options (header, left)
                                $Page->ListOptions->render("header", "left");
                                ?>
                                <?php if ($Page->monthname->Visible) { // monthname 
                                ?>
                                    <th data-name="monthname" class="<?= $Page->monthname->headerCellClass() ?>">
                                        <div id="elh_reportpaketkeluar2_monthname" class="reportpaketkeluar2_monthname"><?= $Page->renderFieldHeader($Page->monthname) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->nama_penerima->Visible) { // nama_penerima 
                                ?>
                                    <th data-name="nama_penerima" class="<?= $Page->nama_penerima->headerCellClass() ?>">
                                        <div id="elh_reportpaketkeluar2_nama_penerima" class="reportpaketkeluar2_nama_penerima"><?= $Page->renderFieldHeader($Page->nama_penerima) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->nama_dokumen->Visible) { // nama_dokumen 
                                ?>
                                    <th data-name="nama_dokumen" class="<?= $Page->nama_dokumen->headerCellClass() ?>">
                                        <div id="elh_reportpaketkeluar2_nama_dokumen" class="reportpaketkeluar2_nama_dokumen"><?= $Page->renderFieldHeader($Page->nama_dokumen) ?></div>
                                    </th>
                                <?php } ?>
                                <?php
                                // Render list options (header, right)
                                $Page->ListOptions->render("header", "right");
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($Page->ExportAll && $Page->isExport()) {
                                $Page->StopRecord = $Page->TotalRecords;
                            } else {
                                // Set the last record to display
                                if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
                                    $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
                                } else {
                                    $Page->StopRecord = $Page->TotalRecords;
                                }
                            }
                            $Page->RecordCount = $Page->StartRecord - 1;
                            if ($Page->Recordset && !$Page->Recordset->EOF) {
                                // Nothing to do
                            } elseif ($Page->isGridAdd() && !$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
                                $Page->StopRecord = $Page->GridAddRowCount;
                            }

                            // Initialize aggregate
                            $Page->RowType = ROWTYPE_AGGREGATEINIT;
                            $Page->resetAttributes();
                            $Page->renderRow();
                            while ($Page->RecordCount < $Page->StopRecord) {
                                $Page->RecordCount++;
                                if ($Page->RecordCount >= $Page->StartRecord) {
                                    $Page->RowCount++;

                                    // Set up key count
                                    $Page->KeyCount = $Page->RowIndex;

                                    // Init row class and style
                                    $Page->resetAttributes();
                                    $Page->CssClass = "";
                                    if ($Page->isGridAdd()) {
                                        $Page->loadRowValues(); // Load default values
                                        $Page->OldKey = "";
                                        $Page->setKey($Page->OldKey);
                                    } else {
                                        $Page->loadRowValues($Page->Recordset); // Load row values
                                        if ($Page->isGridEdit()) {
                                            $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                                            $Page->setKey($Page->OldKey);
                                        }
                                    }
                                    $Page->RowType = ROWTYPE_VIEW; // Render view

                                    // Set up row attributes
                                    $Page->RowAttrs->merge([
                                        "data-rowindex" => $Page->RowCount,
                                        "id" => "r" . $Page->RowCount . "_reportpaketkeluar2",
                                        "data-rowtype" => $Page->RowType,
                                        "class" => ($Page->RowCount % 2 != 1) ? "ew-table-alt-row" : "",
                                    ]);
                                    if ($Page->isAdd() && $Page->RowType == ROWTYPE_ADD || $Page->isEdit() && $Page->RowType == ROWTYPE_EDIT) { // Inline-Add/Edit row
                                        $Page->RowAttrs->appendClass("table-active");
                                    }

                                    // Render row
                                    $Page->renderRow();

                                    // Render list options
                                    $Page->renderListOptions();
                            ?>
                                    <tr <?= $Page->rowAttributes() ?>>
                                        <?php
                                        // Render list options (body, left)
                                        $Page->ListOptions->render("body", "left", $Page->RowCount);
                                        ?>
                                        <?php if ($Page->monthname->Visible) { // monthname 
                                        ?>
                                            <td data-name="monthname" <?= $Page->monthname->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_reportpaketkeluar2_monthname" class="el_reportpaketkeluar2_monthname">
                                                    <span<?= $Page->monthname->viewAttributes() ?>>
                                                        <?= $Page->monthname->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->nama_penerima->Visible) { // nama_penerima 
                                        ?>
                                            <td data-name="nama_penerima" <?= $Page->nama_penerima->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_reportpaketkeluar2_nama_penerima" class="el_reportpaketkeluar2_nama_penerima">
                                                    <span<?= $Page->nama_penerima->viewAttributes() ?>>
                                                        <?= $Page->nama_penerima->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->nama_dokumen->Visible) { // nama_dokumen 
                                        ?>
                                            <td data-name="nama_dokumen" <?= $Page->nama_dokumen->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_reportpaketkeluar2_nama_dokumen" class="el_reportpaketkeluar2_nama_dokumen">
                                                    <span<?= $Page->nama_dokumen->viewAttributes() ?>>
                                                        <?= $Page->nama_dokumen->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php
                                        // Render list options (body, right)
                                        $Page->ListOptions->render("body", "right", $Page->RowCount);
                                        ?>
                                    </tr>
                            <?php
                                }
                                if (!$Page->isGridAdd()) {
                                    $Page->Recordset->moveNext();
                                }
                            }
                            ?>
                        </tbody>
                    </table><!-- /.ew-table -->
                <?php } ?>
            </div><!-- /.ew-grid-middle-panel -->
            <?php if (!$Page->CurrentAction) { ?>
                <input type="hidden" name="action" id="action" value="">
            <?php } ?>
        </form><!-- /.ew-list-form -->
        <?php
        // Close recordset
        if ($Page->Recordset) {
            $Page->Recordset->close();
        }
        ?>
        <?php if (!$Page->isExport()) { ?>
            <div class="card-footer ew-grid-lower-panel">
                <?php if (!$Page->isGridAdd()) { ?>
                    <form name="ew-pager-form" class="ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
                        <?= $Page->Pager->render() ?>
                    </form>
                <?php } ?>
                <div class="ew-list-other-options">
                    <?php $Page->OtherOptions->render("body", "bottom") ?>
                </div>
            </div>
        <?php } ?>
    </div><!-- /.ew-grid -->
<?php } else { ?>
    <div class="ew-list-other-options">
        <?php $Page->OtherOptions->render("body") ?>
    </div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
    <script>
        // Field event handlers
        loadjs.ready("head", function() {
            ew.addEventHandlers("reportpaketkeluar2");
        });
    </script>
    <script>
        loadjs.ready("load", function() {
            // Write your table-specific startup script here, no need to add script tags.
        });
    </script>
<?php } ?>