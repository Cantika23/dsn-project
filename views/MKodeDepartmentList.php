<?php

namespace Mitral2022\DSN2;

// Page object
$MKodeDepartmentList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
    <script>
        var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
        ew.deepAssign(ew.vars, {
            tables: {
                m_kode_department: currentTable
            }
        });
        var currentForm, currentPageID;
        var fm_kode_departmentlist;
        loadjs.ready(["wrapper", "head"], function() {
            var $ = jQuery;
            // Form object
            fm_kode_departmentlist = new ew.Form("fm_kode_departmentlist", "list");
            currentPageID = ew.PAGE_ID = "list";
            currentForm = fm_kode_departmentlist;
            fm_kode_departmentlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

            // Dynamic selection lists
            fm_kode_departmentlist.lists.nama = <?= $Page->nama->toClientList($Page) ?>;
            fm_kode_departmentlist.lists.nama_lengkap = <?= $Page->nama_lengkap->toClientList($Page) ?>;
            loadjs.done("fm_kode_departmentlist");
        });
        var fm_kode_departmentsrch, currentSearchForm, currentAdvancedSearchForm;
        loadjs.ready(["wrapper", "head"], function() {
            var $ = jQuery;
            // Form object for search
            fm_kode_departmentsrch = new ew.Form("fm_kode_departmentsrch", "list");
            currentSearchForm = fm_kode_departmentsrch;

            // Add fields
            var fields = currentTable.fields;
            fm_kode_departmentsrch.addFields([
                ["nama", [], fields.nama.isInvalid],
                ["nama_lengkap", [], fields.nama_lengkap.isInvalid]
            ]);

            // Validate form
            fm_kode_departmentsrch.validate = function() {
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
            fm_kode_departmentsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
                // Your custom validation code here, return false if invalid.
                return true;
            }

            // Use JavaScript validation or not
            fm_kode_departmentsrch.validateRequired = ew.CLIENT_VALIDATE;

            // Dynamic selection lists
            fm_kode_departmentsrch.lists.nama = <?= $Page->nama->toClientList($Page) ?>;
            fm_kode_departmentsrch.lists.nama_lengkap = <?= $Page->nama_lengkap->toClientList($Page) ?>;

            // Filters
            fm_kode_departmentsrch.filterList = <?= $Page->getFilterList() ?>;
            loadjs.done("fm_kode_departmentsrch");
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
        <form name="fm_kode_departmentsrch" id="fm_kode_departmentsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
            <div id="fm_kode_departmentsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
                <input type="hidden" name="cmd" value="search">
                <input type="hidden" name="t" value="m_kode_department">
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
                                <select id="x_nama" name="x_nama[]" class="form-control ew-select<?= $Page->nama->isInvalidClass() ?>" data-select2-id="fm_kode_departmentsrch_x_nama" data-table="m_kode_department" data-field="x_nama" data-caption="<?= HtmlEncode(RemoveHtml($Page->nama->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->nama->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->nama->getPlaceHolder()) ?>" <?= $Page->nama->editAttributes() ?>>
                                    <?= $Page->nama->selectOptionListHtml("x_nama", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->nama->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fm_kode_departmentsrch", function() {
                                        var options = {
                                            name: "x_nama",
                                            selectId: "fm_kode_departmentsrch_x_nama",
                                            ajax: {
                                                id: "x_nama",
                                                form: "fm_kode_departmentsrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.m_kode_department.fields.nama.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->nama_lengkap->Visible) { // nama_lengkap 
                        ?>
                            <?php
                            if (!$Page->nama_lengkap->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_nama_lengkap" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->nama_lengkap->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_nama_lengkap" name="x_nama_lengkap[]" class="form-control ew-select<?= $Page->nama_lengkap->isInvalidClass() ?>" data-select2-id="fm_kode_departmentsrch_x_nama_lengkap" data-table="m_kode_department" data-field="x_nama_lengkap" data-caption="<?= HtmlEncode(RemoveHtml($Page->nama_lengkap->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->nama_lengkap->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->nama_lengkap->getPlaceHolder()) ?>" <?= $Page->nama_lengkap->editAttributes() ?>>
                                    <?= $Page->nama_lengkap->selectOptionListHtml("x_nama_lengkap", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->nama_lengkap->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fm_kode_departmentsrch", function() {
                                        var options = {
                                            name: "x_nama_lengkap",
                                            selectId: "fm_kode_departmentsrch_x_nama_lengkap",
                                            ajax: {
                                                id: "x_nama_lengkap",
                                                form: "fm_kode_departmentsrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.m_kode_department.fields.nama_lengkap.filterOptions);
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
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fm_kode_departmentsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fm_kode_departmentsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fm_kode_departmentsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fm_kode_departmentsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
    <div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_kode_department">
        <form name="fm_kode_departmentlist" id="fm_kode_departmentlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
            <?php if (Config("CHECK_TOKEN")) { ?>
                <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
                <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
            <?php } ?>
            <input type="hidden" name="t" value="m_kode_department">
            <div id="gmp_m_kode_department" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
                <?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
                    <table id="tbl_m_kode_departmentlist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
                                        <div id="elh_m_kode_department_nama" class="m_kode_department_nama"><?= $Page->renderFieldHeader($Page->nama) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->nama_lengkap->Visible) { // nama_lengkap 
                                ?>
                                    <th data-name="nama_lengkap" class="<?= $Page->nama_lengkap->headerCellClass() ?>">
                                        <div id="elh_m_kode_department_nama_lengkap" class="m_kode_department_nama_lengkap"><?= $Page->renderFieldHeader($Page->nama_lengkap) ?></div>
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
                                        "id" => "r" . $Page->RowCount . "_m_kode_department",
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
                                                <span id="el<?= $Page->RowCount ?>_m_kode_department_nama" class="el_m_kode_department_nama">
                                                    <span<?= $Page->nama->viewAttributes() ?>>
                                                        <?= $Page->nama->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->nama_lengkap->Visible) { // nama_lengkap 
                                        ?>
                                            <td data-name="nama_lengkap" <?= $Page->nama_lengkap->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_m_kode_department_nama_lengkap" class="el_m_kode_department_nama_lengkap">
                                                    <span<?= $Page->nama_lengkap->viewAttributes() ?>>
                                                        <?= $Page->nama_lengkap->getViewValue() ?>
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
            ew.addEventHandlers("m_kode_department");
        });
    </script>
    <script>
        loadjs.ready("load", function() {
            // Write your table-specific startup script here, no need to add script tags.
        });
    </script>
<?php } ?>