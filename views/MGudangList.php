<?php

namespace Mitral2022\DSN2;

// Page object
$MGudangList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
    <script>
        var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
        ew.deepAssign(ew.vars, {
            tables: {
                m_gudang: currentTable
            }
        });
        var currentForm, currentPageID;
        var fm_gudanglist;
        loadjs.ready(["wrapper", "head"], function() {
            var $ = jQuery;
            // Form object
            fm_gudanglist = new ew.Form("fm_gudanglist", "list");
            currentPageID = ew.PAGE_ID = "list";
            currentForm = fm_gudanglist;
            fm_gudanglist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

            // Dynamic selection lists
            fm_gudanglist.lists.nama = <?= $Page->nama->toClientList($Page) ?>;
            fm_gudanglist.lists.keterangan = <?= $Page->keterangan->toClientList($Page) ?>;
            loadjs.done("fm_gudanglist");
        });
        var fm_gudangsrch, currentSearchForm, currentAdvancedSearchForm;
        loadjs.ready(["wrapper", "head"], function() {
            var $ = jQuery;
            // Form object for search
            fm_gudangsrch = new ew.Form("fm_gudangsrch", "list");
            currentSearchForm = fm_gudangsrch;

            // Add fields
            var fields = currentTable.fields;
            fm_gudangsrch.addFields([
                ["nama", [], fields.nama.isInvalid],
                ["keterangan", [], fields.keterangan.isInvalid]
            ]);

            // Validate form
            fm_gudangsrch.validate = function() {
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
            fm_gudangsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
                // Your custom validation code here, return false if invalid.
                return true;
            }

            // Use JavaScript validation or not
            fm_gudangsrch.validateRequired = ew.CLIENT_VALIDATE;

            // Dynamic selection lists
            fm_gudangsrch.lists.nama = <?= $Page->nama->toClientList($Page) ?>;
            fm_gudangsrch.lists.keterangan = <?= $Page->keterangan->toClientList($Page) ?>;

            // Filters
            fm_gudangsrch.filterList = <?= $Page->getFilterList() ?>;
            loadjs.done("fm_gudangsrch");
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
        <form name="fm_gudangsrch" id="fm_gudangsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
            <div id="fm_gudangsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
                <input type="hidden" name="cmd" value="search">
                <input type="hidden" name="t" value="m_gudang">
                <div class="ew-extended-search container-fluid">
                    <div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
                        <?php
                        // Render search row
                        $Page->RowType = ROWTYPE_SEARCH;
                        $Page->resetAttributes();
                        $Page->renderRow();
                        ?>
                        <?php if ($Page->nama->Visible) { // nama 
                        ?>
                            <?php
                            if (!$Page->nama->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_nama" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->nama->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_nama" name="x_nama[]" class="form-control ew-select<?= $Page->nama->isInvalidClass() ?>" data-select2-id="fm_gudangsrch_x_nama" data-table="m_gudang" data-field="x_nama" data-caption="<?= HtmlEncode(RemoveHtml($Page->nama->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->nama->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->nama->getPlaceHolder()) ?>" <?= $Page->nama->editAttributes() ?>>
                                    <?= $Page->nama->selectOptionListHtml("x_nama", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->nama->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fm_gudangsrch", function() {
                                        var options = {
                                            name: "x_nama",
                                            selectId: "fm_gudangsrch_x_nama",
                                            ajax: {
                                                id: "x_nama",
                                                form: "fm_gudangsrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.m_gudang.fields.nama.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->keterangan->Visible) { // keterangan 
                        ?>
                            <?php
                            if (!$Page->keterangan->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_keterangan" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->keterangan->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_keterangan" name="x_keterangan[]" class="form-control ew-select<?= $Page->keterangan->isInvalidClass() ?>" data-select2-id="fm_gudangsrch_x_keterangan" data-table="m_gudang" data-field="x_keterangan" data-caption="<?= HtmlEncode(RemoveHtml($Page->keterangan->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->keterangan->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->keterangan->getPlaceHolder()) ?>" <?= $Page->keterangan->editAttributes() ?>>
                                    <?= $Page->keterangan->selectOptionListHtml("x_keterangan", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->keterangan->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fm_gudangsrch", function() {
                                        var options = {
                                            name: "x_keterangan",
                                            selectId: "fm_gudangsrch_x_keterangan",
                                            ajax: {
                                                id: "x_keterangan",
                                                form: "fm_gudangsrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.m_gudang.fields.keterangan.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                    </div><!-- /.row -->
                    <div class="row mb-0">
                        <div class="col-sm-auto px-0 pe-sm-2">
                            <div class="ew-basic-search input-group">
                                <input type="search" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control ew-basic-search-keyword" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
                                <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="ew-basic-search-type" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
                                <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                                    <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fm_gudangsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fm_gudangsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fm_gudangsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fm_gudangsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
    <div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_gudang">
        <form name="fm_gudanglist" id="fm_gudanglist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
            <?php if (Config("CHECK_TOKEN")) { ?>
                <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
                <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
            <?php } ?>
            <input type="hidden" name="t" value="m_gudang">
            <div id="gmp_m_gudang" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
                <?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
                    <table id="tbl_m_gudanglist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
                                <?php if ($Page->nama->Visible) { // nama 
                                ?>
                                    <th data-name="nama" class="<?= $Page->nama->headerCellClass() ?>">
                                        <div id="elh_m_gudang_nama" class="m_gudang_nama"><?= $Page->renderFieldHeader($Page->nama) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->keterangan->Visible) { // keterangan 
                                ?>
                                    <th data-name="keterangan" class="<?= $Page->keterangan->headerCellClass() ?>">
                                        <div id="elh_m_gudang_keterangan" class="m_gudang_keterangan"><?= $Page->renderFieldHeader($Page->keterangan) ?></div>
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
                                        "id" => "r" . $Page->RowCount . "_m_gudang",
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
                                        <?php if ($Page->nama->Visible) { // nama 
                                        ?>
                                            <td data-name="nama" <?= $Page->nama->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_m_gudang_nama" class="el_m_gudang_nama">
                                                    <span<?= $Page->nama->viewAttributes() ?>>
                                                        <?= $Page->nama->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->keterangan->Visible) { // keterangan 
                                        ?>
                                            <td data-name="keterangan" <?= $Page->keterangan->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_m_gudang_keterangan" class="el_m_gudang_keterangan">
                                                    <span<?= $Page->keterangan->viewAttributes() ?>>
                                                        <?= $Page->keterangan->getViewValue() ?>
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
            ew.addEventHandlers("m_gudang");
        });
    </script>
    <script>
        loadjs.ready("load", function() {
            // Write your table-specific startup script here, no need to add script tags.
        });
    </script>
<?php } ?>