<?php

namespace Mitral2022\DSN2;

// Page object
$MEmployeeList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
    <script>
        var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
        ew.deepAssign(ew.vars, {
            tables: {
                m_employee: currentTable
            }
        });
        var currentForm, currentPageID;
        var fm_employeelist;
        loadjs.ready(["wrapper", "head"], function() {
            var $ = jQuery;
            // Form object
            fm_employeelist = new ew.Form("fm_employeelist", "list");
            currentPageID = ew.PAGE_ID = "list";
            currentForm = fm_employeelist;
            fm_employeelist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

            // Dynamic selection lists
            fm_employeelist.lists.orgname = <?= $Page->orgname->toClientList($Page) ?>;
            fm_employeelist.lists.nik = <?= $Page->nik->toClientList($Page) ?>;
            fm_employeelist.lists.company_name = <?= $Page->company_name->toClientList($Page) ?>;
            fm_employeelist.lists._email = <?= $Page->_email->toClientList($Page) ?>;
            fm_employeelist.lists.employee_name = <?= $Page->employee_name->toClientList($Page) ?>;
            fm_employeelist.lists.company_code = <?= $Page->company_code->toClientList($Page) ?>;
            fm_employeelist.lists.organization_name = <?= $Page->organization_name->toClientList($Page) ?>;
            fm_employeelist.lists.phone1 = <?= $Page->phone1->toClientList($Page) ?>;
            fm_employeelist.lists.phone2 = <?= $Page->phone2->toClientList($Page) ?>;
            loadjs.done("fm_employeelist");
        });
        var fm_employeesrch, currentSearchForm, currentAdvancedSearchForm;
        loadjs.ready(["wrapper", "head"], function() {
            var $ = jQuery;
            // Form object for search
            fm_employeesrch = new ew.Form("fm_employeesrch", "list");
            currentSearchForm = fm_employeesrch;

            // Add fields
            var fields = currentTable.fields;
            fm_employeesrch.addFields([
                ["orgname", [], fields.orgname.isInvalid],
                ["nik", [], fields.nik.isInvalid],
                ["company_name", [], fields.company_name.isInvalid],
                ["_email", [], fields._email.isInvalid],
                ["employee_name", [], fields.employee_name.isInvalid],
                ["company_code", [], fields.company_code.isInvalid],
                ["organization_name", [], fields.organization_name.isInvalid],
                ["phone1", [], fields.phone1.isInvalid],
                ["phone2", [], fields.phone2.isInvalid]
            ]);

            // Validate form
            fm_employeesrch.validate = function() {
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
            fm_employeesrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
                // Your custom validation code here, return false if invalid.
                return true;
            }

            // Use JavaScript validation or not
            fm_employeesrch.validateRequired = ew.CLIENT_VALIDATE;

            // Dynamic selection lists
            fm_employeesrch.lists.orgname = <?= $Page->orgname->toClientList($Page) ?>;
            fm_employeesrch.lists.nik = <?= $Page->nik->toClientList($Page) ?>;
            fm_employeesrch.lists.company_name = <?= $Page->company_name->toClientList($Page) ?>;
            fm_employeesrch.lists._email = <?= $Page->_email->toClientList($Page) ?>;
            fm_employeesrch.lists.employee_name = <?= $Page->employee_name->toClientList($Page) ?>;
            fm_employeesrch.lists.company_code = <?= $Page->company_code->toClientList($Page) ?>;
            fm_employeesrch.lists.organization_name = <?= $Page->organization_name->toClientList($Page) ?>;
            fm_employeesrch.lists.phone1 = <?= $Page->phone1->toClientList($Page) ?>;
            fm_employeesrch.lists.phone2 = <?= $Page->phone2->toClientList($Page) ?>;

            // Filters
            fm_employeesrch.filterList = <?= $Page->getFilterList() ?>;
            loadjs.done("fm_employeesrch");
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
        <form name="fm_employeesrch" id="fm_employeesrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
            <div id="fm_employeesrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
                <input type="hidden" name="cmd" value="search">
                <input type="hidden" name="t" value="m_employee">
                <div class="ew-extended-search container-fluid">
                    <div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
                        <?php
                        // Render search row
                        $Page->RowType = ROWTYPE_SEARCH;
                        $Page->resetAttributes();
                        $Page->renderRow();
                        ?>
                        <?php if ($Page->orgname->Visible) { // orgname 
                        ?>
                            <?php
                            if (!$Page->orgname->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_orgname" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->orgname->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_orgname" name="x_orgname[]" class="form-control ew-select<?= $Page->orgname->isInvalidClass() ?>" data-select2-id="fm_employeesrch_x_orgname" data-table="m_employee" data-field="x_orgname" data-caption="<?= HtmlEncode(RemoveHtml($Page->orgname->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->orgname->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->orgname->getPlaceHolder()) ?>" <?= $Page->orgname->editAttributes() ?>>
                                    <?= $Page->orgname->selectOptionListHtml("x_orgname", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->orgname->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fm_employeesrch", function() {
                                        var options = {
                                            name: "x_orgname",
                                            selectId: "fm_employeesrch_x_orgname",
                                            ajax: {
                                                id: "x_orgname",
                                                form: "fm_employeesrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.m_employee.fields.orgname.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->nik->Visible) { // nik 
                        ?>
                            <?php
                            if (!$Page->nik->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_nik" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->nik->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_nik" name="x_nik[]" class="form-control ew-select<?= $Page->nik->isInvalidClass() ?>" data-select2-id="fm_employeesrch_x_nik" data-table="m_employee" data-field="x_nik" data-caption="<?= HtmlEncode(RemoveHtml($Page->nik->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->nik->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->nik->getPlaceHolder()) ?>" <?= $Page->nik->editAttributes() ?>>
                                    <?= $Page->nik->selectOptionListHtml("x_nik", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->nik->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fm_employeesrch", function() {
                                        var options = {
                                            name: "x_nik",
                                            selectId: "fm_employeesrch_x_nik",
                                            ajax: {
                                                id: "x_nik",
                                                form: "fm_employeesrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.m_employee.fields.nik.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->company_name->Visible) { // company_name 
                        ?>
                            <?php
                            if (!$Page->company_name->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_company_name" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->company_name->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_company_name" name="x_company_name[]" class="form-control ew-select<?= $Page->company_name->isInvalidClass() ?>" data-select2-id="fm_employeesrch_x_company_name" data-table="m_employee" data-field="x_company_name" data-caption="<?= HtmlEncode(RemoveHtml($Page->company_name->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->company_name->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->company_name->getPlaceHolder()) ?>" <?= $Page->company_name->editAttributes() ?>>
                                    <?= $Page->company_name->selectOptionListHtml("x_company_name", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->company_name->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fm_employeesrch", function() {
                                        var options = {
                                            name: "x_company_name",
                                            selectId: "fm_employeesrch_x_company_name",
                                            ajax: {
                                                id: "x_company_name",
                                                form: "fm_employeesrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.m_employee.fields.company_name.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->_email->Visible) { // email 
                        ?>
                            <?php
                            if (!$Page->_email->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs__email" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->_email->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x__email" name="x__email[]" class="form-control ew-select<?= $Page->_email->isInvalidClass() ?>" data-select2-id="fm_employeesrch_x__email" data-table="m_employee" data-field="x__email" data-caption="<?= HtmlEncode(RemoveHtml($Page->_email->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->_email->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->_email->getPlaceHolder()) ?>" <?= $Page->_email->editAttributes() ?>>
                                    <?= $Page->_email->selectOptionListHtml("x__email", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->_email->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fm_employeesrch", function() {
                                        var options = {
                                            name: "x__email",
                                            selectId: "fm_employeesrch_x__email",
                                            ajax: {
                                                id: "x__email",
                                                form: "fm_employeesrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.m_employee.fields._email.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->employee_name->Visible) { // employee_name 
                        ?>
                            <?php
                            if (!$Page->employee_name->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_employee_name" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->employee_name->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_employee_name" name="x_employee_name[]" class="form-control ew-select<?= $Page->employee_name->isInvalidClass() ?>" data-select2-id="fm_employeesrch_x_employee_name" data-table="m_employee" data-field="x_employee_name" data-caption="<?= HtmlEncode(RemoveHtml($Page->employee_name->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->employee_name->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->employee_name->getPlaceHolder()) ?>" <?= $Page->employee_name->editAttributes() ?>>
                                    <?= $Page->employee_name->selectOptionListHtml("x_employee_name", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->employee_name->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fm_employeesrch", function() {
                                        var options = {
                                            name: "x_employee_name",
                                            selectId: "fm_employeesrch_x_employee_name",
                                            ajax: {
                                                id: "x_employee_name",
                                                form: "fm_employeesrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.m_employee.fields.employee_name.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->company_code->Visible) { // company_code 
                        ?>
                            <?php
                            if (!$Page->company_code->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_company_code" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->company_code->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_company_code" name="x_company_code[]" class="form-control ew-select<?= $Page->company_code->isInvalidClass() ?>" data-select2-id="fm_employeesrch_x_company_code" data-table="m_employee" data-field="x_company_code" data-caption="<?= HtmlEncode(RemoveHtml($Page->company_code->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->company_code->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->company_code->getPlaceHolder()) ?>" <?= $Page->company_code->editAttributes() ?>>
                                    <?= $Page->company_code->selectOptionListHtml("x_company_code", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->company_code->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fm_employeesrch", function() {
                                        var options = {
                                            name: "x_company_code",
                                            selectId: "fm_employeesrch_x_company_code",
                                            ajax: {
                                                id: "x_company_code",
                                                form: "fm_employeesrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.m_employee.fields.company_code.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->organization_name->Visible) { // organization_name 
                        ?>
                            <?php
                            if (!$Page->organization_name->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_organization_name" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->organization_name->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_organization_name" name="x_organization_name[]" class="form-control ew-select<?= $Page->organization_name->isInvalidClass() ?>" data-select2-id="fm_employeesrch_x_organization_name" data-table="m_employee" data-field="x_organization_name" data-caption="<?= HtmlEncode(RemoveHtml($Page->organization_name->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->organization_name->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->organization_name->getPlaceHolder()) ?>" <?= $Page->organization_name->editAttributes() ?>>
                                    <?= $Page->organization_name->selectOptionListHtml("x_organization_name", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->organization_name->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fm_employeesrch", function() {
                                        var options = {
                                            name: "x_organization_name",
                                            selectId: "fm_employeesrch_x_organization_name",
                                            ajax: {
                                                id: "x_organization_name",
                                                form: "fm_employeesrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.m_employee.fields.organization_name.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->phone1->Visible) { // phone1 
                        ?>
                            <?php
                            if (!$Page->phone1->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_phone1" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->phone1->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_phone1" name="x_phone1[]" class="form-control ew-select<?= $Page->phone1->isInvalidClass() ?>" data-select2-id="fm_employeesrch_x_phone1" data-table="m_employee" data-field="x_phone1" data-caption="<?= HtmlEncode(RemoveHtml($Page->phone1->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->phone1->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->phone1->getPlaceHolder()) ?>" <?= $Page->phone1->editAttributes() ?>>
                                    <?= $Page->phone1->selectOptionListHtml("x_phone1", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->phone1->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fm_employeesrch", function() {
                                        var options = {
                                            name: "x_phone1",
                                            selectId: "fm_employeesrch_x_phone1",
                                            ajax: {
                                                id: "x_phone1",
                                                form: "fm_employeesrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.m_employee.fields.phone1.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->phone2->Visible) { // phone2 
                        ?>
                            <?php
                            if (!$Page->phone2->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_phone2" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->phone2->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_phone2" name="x_phone2[]" class="form-control ew-select<?= $Page->phone2->isInvalidClass() ?>" data-select2-id="fm_employeesrch_x_phone2" data-table="m_employee" data-field="x_phone2" data-caption="<?= HtmlEncode(RemoveHtml($Page->phone2->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->phone2->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->phone2->getPlaceHolder()) ?>" <?= $Page->phone2->editAttributes() ?>>
                                    <?= $Page->phone2->selectOptionListHtml("x_phone2", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->phone2->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fm_employeesrch", function() {
                                        var options = {
                                            name: "x_phone2",
                                            selectId: "fm_employeesrch_x_phone2",
                                            ajax: {
                                                id: "x_phone2",
                                                form: "fm_employeesrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.m_employee.fields.phone2.filterOptions);
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
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fm_employeesrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fm_employeesrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fm_employeesrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fm_employeesrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
    <div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_employee">
        <form name="fm_employeelist" id="fm_employeelist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
            <?php if (Config("CHECK_TOKEN")) { ?>
                <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
                <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
            <?php } ?>
            <input type="hidden" name="t" value="m_employee">
            <div id="gmp_m_employee" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
                <?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
                    <table id="tbl_m_employeelist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
                                <?php if ($Page->orgname->Visible) { // orgname 
                                ?>
                                    <th data-name="orgname" class="<?= $Page->orgname->headerCellClass() ?>">
                                        <div id="elh_m_employee_orgname" class="m_employee_orgname"><?= $Page->renderFieldHeader($Page->orgname) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->nik->Visible) { // nik 
                                ?>
                                    <th data-name="nik" class="<?= $Page->nik->headerCellClass() ?>">
                                        <div id="elh_m_employee_nik" class="m_employee_nik"><?= $Page->renderFieldHeader($Page->nik) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->company_name->Visible) { // company_name 
                                ?>
                                    <th data-name="company_name" class="<?= $Page->company_name->headerCellClass() ?>">
                                        <div id="elh_m_employee_company_name" class="m_employee_company_name"><?= $Page->renderFieldHeader($Page->company_name) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->_email->Visible) { // email 
                                ?>
                                    <th data-name="_email" class="<?= $Page->_email->headerCellClass() ?>">
                                        <div id="elh_m_employee__email" class="m_employee__email"><?= $Page->renderFieldHeader($Page->_email) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->employee_name->Visible) { // employee_name 
                                ?>
                                    <th data-name="employee_name" class="<?= $Page->employee_name->headerCellClass() ?>">
                                        <div id="elh_m_employee_employee_name" class="m_employee_employee_name"><?= $Page->renderFieldHeader($Page->employee_name) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->company_code->Visible) { // company_code 
                                ?>
                                    <th data-name="company_code" class="<?= $Page->company_code->headerCellClass() ?>">
                                        <div id="elh_m_employee_company_code" class="m_employee_company_code"><?= $Page->renderFieldHeader($Page->company_code) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->organization_name->Visible) { // organization_name 
                                ?>
                                    <th data-name="organization_name" class="<?= $Page->organization_name->headerCellClass() ?>">
                                        <div id="elh_m_employee_organization_name" class="m_employee_organization_name"><?= $Page->renderFieldHeader($Page->organization_name) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->phone1->Visible) { // phone1 
                                ?>
                                    <th data-name="phone1" class="<?= $Page->phone1->headerCellClass() ?>">
                                        <div id="elh_m_employee_phone1" class="m_employee_phone1"><?= $Page->renderFieldHeader($Page->phone1) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->phone2->Visible) { // phone2 
                                ?>
                                    <th data-name="phone2" class="<?= $Page->phone2->headerCellClass() ?>">
                                        <div id="elh_m_employee_phone2" class="m_employee_phone2"><?= $Page->renderFieldHeader($Page->phone2) ?></div>
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
                                        "id" => "r" . $Page->RowCount . "_m_employee",
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
                                        <?php if ($Page->orgname->Visible) { // orgname 
                                        ?>
                                            <td data-name="orgname" <?= $Page->orgname->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_m_employee_orgname" class="el_m_employee_orgname">
                                                    <span<?= $Page->orgname->viewAttributes() ?>>
                                                        <?= $Page->orgname->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->nik->Visible) { // nik 
                                        ?>
                                            <td data-name="nik" <?= $Page->nik->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_m_employee_nik" class="el_m_employee_nik">
                                                    <span<?= $Page->nik->viewAttributes() ?>>
                                                        <?= $Page->nik->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->company_name->Visible) { // company_name 
                                        ?>
                                            <td data-name="company_name" <?= $Page->company_name->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_m_employee_company_name" class="el_m_employee_company_name">
                                                    <span<?= $Page->company_name->viewAttributes() ?>>
                                                        <?= $Page->company_name->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->_email->Visible) { // email 
                                        ?>
                                            <td data-name="_email" <?= $Page->_email->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_m_employee__email" class="el_m_employee__email">
                                                    <span<?= $Page->_email->viewAttributes() ?>>
                                                        <?= $Page->_email->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->employee_name->Visible) { // employee_name 
                                        ?>
                                            <td data-name="employee_name" <?= $Page->employee_name->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_m_employee_employee_name" class="el_m_employee_employee_name">
                                                    <span<?= $Page->employee_name->viewAttributes() ?>>
                                                        <?= $Page->employee_name->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->company_code->Visible) { // company_code 
                                        ?>
                                            <td data-name="company_code" <?= $Page->company_code->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_m_employee_company_code" class="el_m_employee_company_code">
                                                    <span<?= $Page->company_code->viewAttributes() ?>>
                                                        <?= $Page->company_code->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->organization_name->Visible) { // organization_name 
                                        ?>
                                            <td data-name="organization_name" <?= $Page->organization_name->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_m_employee_organization_name" class="el_m_employee_organization_name">
                                                    <span<?= $Page->organization_name->viewAttributes() ?>>
                                                        <?= $Page->organization_name->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->phone1->Visible) { // phone1 
                                        ?>
                                            <td data-name="phone1" <?= $Page->phone1->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_m_employee_phone1" class="el_m_employee_phone1">
                                                    <span<?= $Page->phone1->viewAttributes() ?>>
                                                        <?= $Page->phone1->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->phone2->Visible) { // phone2 
                                        ?>
                                            <td data-name="phone2" <?= $Page->phone2->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_m_employee_phone2" class="el_m_employee_phone2">
                                                    <span<?= $Page->phone2->viewAttributes() ?>>
                                                        <?= $Page->phone2->getViewValue() ?>
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
            ew.addEventHandlers("m_employee");
        });
    </script>
    <script>
        loadjs.ready("load", function() {
            // Write your table-specific startup script here, no need to add script tags.
        });
    </script>
<?php } ?>