<?php

namespace Mitral2022\DSN2;

// Page object
$LogCourierList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
    <script>
        var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
        ew.deepAssign(ew.vars, {
            tables: {
                log_courier: currentTable
            }
        });
        var currentForm, currentPageID;
        var flog_courierlist;
        loadjs.ready(["wrapper", "head"], function() {
            var $ = jQuery;
            // Form object
            flog_courierlist = new ew.Form("flog_courierlist", "list");
            currentPageID = ew.PAGE_ID = "list";
            currentForm = flog_courierlist;
            flog_courierlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

            // Dynamic selection lists
            flog_courierlist.lists.awb = <?= $Page->awb->toClientList($Page) ?>;
            flog_courierlist.lists.kurir = <?= $Page->kurir->toClientList($Page) ?>;
            flog_courierlist.lists.req_type = <?= $Page->req_type->toClientList($Page) ?>;
            flog_courierlist.lists.datetime = <?= $Page->datetime->toClientList($Page) ?>;
            flog_courierlist.lists.parameter = <?= $Page->parameter->toClientList($Page) ?>;
            flog_courierlist.lists._response = <?= $Page->_response->toClientList($Page) ?>;
            flog_courierlist.lists._content = <?= $Page->_content->toClientList($Page) ?>;
            flog_courierlist.lists.text_query = <?= $Page->text_query->toClientList($Page) ?>;
            loadjs.done("flog_courierlist");
        });
        var flog_couriersrch, currentSearchForm, currentAdvancedSearchForm;
        loadjs.ready(["wrapper", "head"], function() {
            var $ = jQuery;
            // Form object for search
            flog_couriersrch = new ew.Form("flog_couriersrch", "list");
            currentSearchForm = flog_couriersrch;

            // Add fields
            var fields = currentTable.fields;
            flog_couriersrch.addFields([
                ["awb", [], fields.awb.isInvalid],
                ["kurir", [], fields.kurir.isInvalid],
                ["req_type", [], fields.req_type.isInvalid],
                ["datetime", [], fields.datetime.isInvalid],
                ["parameter", [], fields.parameter.isInvalid],
                ["_response", [], fields._response.isInvalid],
                ["_content", [], fields._content.isInvalid],
                ["text_query", [], fields.text_query.isInvalid]
            ]);

            // Validate form
            flog_couriersrch.validate = function() {
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
            flog_couriersrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
                // Your custom validation code here, return false if invalid.
                return true;
            }

            // Use JavaScript validation or not
            flog_couriersrch.validateRequired = ew.CLIENT_VALIDATE;

            // Dynamic selection lists
            flog_couriersrch.lists.awb = <?= $Page->awb->toClientList($Page) ?>;
            flog_couriersrch.lists.kurir = <?= $Page->kurir->toClientList($Page) ?>;
            flog_couriersrch.lists.req_type = <?= $Page->req_type->toClientList($Page) ?>;
            flog_couriersrch.lists.datetime = <?= $Page->datetime->toClientList($Page) ?>;
            flog_couriersrch.lists.parameter = <?= $Page->parameter->toClientList($Page) ?>;
            flog_couriersrch.lists._response = <?= $Page->_response->toClientList($Page) ?>;
            flog_couriersrch.lists._content = <?= $Page->_content->toClientList($Page) ?>;
            flog_couriersrch.lists.text_query = <?= $Page->text_query->toClientList($Page) ?>;

            // Filters
            flog_couriersrch.filterList = <?= $Page->getFilterList() ?>;
            loadjs.done("flog_couriersrch");
        });
    </script>
    <script>
        loadjs.ready("head", function() {
            // Client script
            // Write your table-specific client script here, no need to add script tags.
            $("#elh_log_courier_sequence").text("Nomor Urut");
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
        <form name="flog_couriersrch" id="flog_couriersrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
            <div id="flog_couriersrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
                <input type="hidden" name="cmd" value="search">
                <input type="hidden" name="t" value="log_courier">
                <div class="ew-extended-search container-fluid">
                    <div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
                        <?php
                        // Render search row
                        $Page->RowType = ROWTYPE_SEARCH;
                        $Page->resetAttributes();
                        $Page->renderRow();
                        ?>
                        <?php if ($Page->awb->Visible) { // awb 
                        ?>
                            <?php
                            if (!$Page->awb->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_awb" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->awb->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_awb" name="x_awb[]" class="form-control ew-select<?= $Page->awb->isInvalidClass() ?>" data-select2-id="flog_couriersrch_x_awb" data-table="log_courier" data-field="x_awb" data-caption="<?= HtmlEncode(RemoveHtml($Page->awb->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->awb->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->awb->getPlaceHolder()) ?>" <?= $Page->awb->editAttributes() ?>>
                                    <?= $Page->awb->selectOptionListHtml("x_awb", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->awb->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("flog_couriersrch", function() {
                                        var options = {
                                            name: "x_awb",
                                            selectId: "flog_couriersrch_x_awb",
                                            ajax: {
                                                id: "x_awb",
                                                form: "flog_couriersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.log_courier.fields.awb.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->kurir->Visible) { // kurir 
                        ?>
                            <?php
                            if (!$Page->kurir->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_kurir" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->kurir->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_kurir" name="x_kurir[]" class="form-control ew-select<?= $Page->kurir->isInvalidClass() ?>" data-select2-id="flog_couriersrch_x_kurir" data-table="log_courier" data-field="x_kurir" data-caption="<?= HtmlEncode(RemoveHtml($Page->kurir->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->kurir->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->kurir->getPlaceHolder()) ?>" <?= $Page->kurir->editAttributes() ?>>
                                    <?= $Page->kurir->selectOptionListHtml("x_kurir", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->kurir->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("flog_couriersrch", function() {
                                        var options = {
                                            name: "x_kurir",
                                            selectId: "flog_couriersrch_x_kurir",
                                            ajax: {
                                                id: "x_kurir",
                                                form: "flog_couriersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.log_courier.fields.kurir.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->req_type->Visible) { // req_type 
                        ?>
                            <?php
                            if (!$Page->req_type->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_req_type" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->req_type->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_req_type" name="x_req_type[]" class="form-control ew-select<?= $Page->req_type->isInvalidClass() ?>" data-select2-id="flog_couriersrch_x_req_type" data-table="log_courier" data-field="x_req_type" data-caption="<?= HtmlEncode(RemoveHtml($Page->req_type->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->req_type->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->req_type->getPlaceHolder()) ?>" <?= $Page->req_type->editAttributes() ?>>
                                    <?= $Page->req_type->selectOptionListHtml("x_req_type", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->req_type->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("flog_couriersrch", function() {
                                        var options = {
                                            name: "x_req_type",
                                            selectId: "flog_couriersrch_x_req_type",
                                            ajax: {
                                                id: "x_req_type",
                                                form: "flog_couriersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.log_courier.fields.req_type.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->datetime->Visible) { // datetime 
                        ?>
                            <?php
                            if (!$Page->datetime->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_datetime" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->datetime->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_datetime" name="x_datetime[]" class="form-control ew-select<?= $Page->datetime->isInvalidClass() ?>" data-select2-id="flog_couriersrch_x_datetime" data-table="log_courier" data-field="x_datetime" data-caption="<?= HtmlEncode(RemoveHtml($Page->datetime->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->datetime->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->datetime->getPlaceHolder()) ?>" <?= $Page->datetime->editAttributes() ?>>
                                    <?= $Page->datetime->selectOptionListHtml("x_datetime", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->datetime->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("flog_couriersrch", function() {
                                        var options = {
                                            name: "x_datetime",
                                            selectId: "flog_couriersrch_x_datetime",
                                            ajax: {
                                                id: "x_datetime",
                                                form: "flog_couriersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.log_courier.fields.datetime.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->parameter->Visible) { // parameter 
                        ?>
                            <?php
                            if (!$Page->parameter->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_parameter" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->parameter->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_parameter" name="x_parameter[]" class="form-control ew-select<?= $Page->parameter->isInvalidClass() ?>" data-select2-id="flog_couriersrch_x_parameter" data-table="log_courier" data-field="x_parameter" data-caption="<?= HtmlEncode(RemoveHtml($Page->parameter->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->parameter->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->parameter->getPlaceHolder()) ?>" <?= $Page->parameter->editAttributes() ?>>
                                    <?= $Page->parameter->selectOptionListHtml("x_parameter", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->parameter->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("flog_couriersrch", function() {
                                        var options = {
                                            name: "x_parameter",
                                            selectId: "flog_couriersrch_x_parameter",
                                            ajax: {
                                                id: "x_parameter",
                                                form: "flog_couriersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.log_courier.fields.parameter.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->_response->Visible) { // response 
                        ?>
                            <?php
                            if (!$Page->_response->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs__response" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->_response->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x__response" name="x__response[]" class="form-control ew-select<?= $Page->_response->isInvalidClass() ?>" data-select2-id="flog_couriersrch_x__response" data-table="log_courier" data-field="x__response" data-caption="<?= HtmlEncode(RemoveHtml($Page->_response->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->_response->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->_response->getPlaceHolder()) ?>" <?= $Page->_response->editAttributes() ?>>
                                    <?= $Page->_response->selectOptionListHtml("x__response", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->_response->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("flog_couriersrch", function() {
                                        var options = {
                                            name: "x__response",
                                            selectId: "flog_couriersrch_x__response",
                                            ajax: {
                                                id: "x__response",
                                                form: "flog_couriersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.log_courier.fields._response.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->_content->Visible) { // content 
                        ?>
                            <?php
                            if (!$Page->_content->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs__content" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->_content->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x__content" name="x__content[]" class="form-control ew-select<?= $Page->_content->isInvalidClass() ?>" data-select2-id="flog_couriersrch_x__content" data-table="log_courier" data-field="x__content" data-caption="<?= HtmlEncode(RemoveHtml($Page->_content->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->_content->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->_content->getPlaceHolder()) ?>" <?= $Page->_content->editAttributes() ?>>
                                    <?= $Page->_content->selectOptionListHtml("x__content", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->_content->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("flog_couriersrch", function() {
                                        var options = {
                                            name: "x__content",
                                            selectId: "flog_couriersrch_x__content",
                                            ajax: {
                                                id: "x__content",
                                                form: "flog_couriersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.log_courier.fields._content.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->text_query->Visible) { // text_query 
                        ?>
                            <?php
                            if (!$Page->text_query->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_text_query" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->text_query->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_text_query" name="x_text_query[]" class="form-control ew-select<?= $Page->text_query->isInvalidClass() ?>" data-select2-id="flog_couriersrch_x_text_query" data-table="log_courier" data-field="x_text_query" data-caption="<?= HtmlEncode(RemoveHtml($Page->text_query->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->text_query->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->text_query->getPlaceHolder()) ?>" <?= $Page->text_query->editAttributes() ?>>
                                    <?= $Page->text_query->selectOptionListHtml("x_text_query", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->text_query->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("flog_couriersrch", function() {
                                        var options = {
                                            name: "x_text_query",
                                            selectId: "flog_couriersrch_x_text_query",
                                            ajax: {
                                                id: "x_text_query",
                                                form: "flog_couriersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.log_courier.fields.text_query.filterOptions);
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
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="flog_couriersrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="flog_couriersrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="flog_couriersrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="flog_couriersrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
    <div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> log_courier">
        <form name="flog_courierlist" id="flog_courierlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
            <?php if (Config("CHECK_TOKEN")) { ?>
                <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
                <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
            <?php } ?>
            <input type="hidden" name="t" value="log_courier">
            <div id="gmp_log_courier" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
                <?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
                    <table id="tbl_log_courierlist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
                                <?php if ($Page->awb->Visible) { // awb 
                                ?>
                                    <th data-name="awb" class="<?= $Page->awb->headerCellClass() ?>">
                                        <div id="elh_log_courier_awb" class="log_courier_awb"><?= $Page->renderFieldHeader($Page->awb) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->kurir->Visible) { // kurir 
                                ?>
                                    <th data-name="kurir" class="<?= $Page->kurir->headerCellClass() ?>">
                                        <div id="elh_log_courier_kurir" class="log_courier_kurir"><?= $Page->renderFieldHeader($Page->kurir) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->req_type->Visible) { // req_type 
                                ?>
                                    <th data-name="req_type" class="<?= $Page->req_type->headerCellClass() ?>">
                                        <div id="elh_log_courier_req_type" class="log_courier_req_type"><?= $Page->renderFieldHeader($Page->req_type) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->datetime->Visible) { // datetime 
                                ?>
                                    <th data-name="datetime" class="<?= $Page->datetime->headerCellClass() ?>">
                                        <div id="elh_log_courier_datetime" class="log_courier_datetime"><?= $Page->renderFieldHeader($Page->datetime) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->parameter->Visible) { // parameter 
                                ?>
                                    <th data-name="parameter" class="<?= $Page->parameter->headerCellClass() ?>">
                                        <div id="elh_log_courier_parameter" class="log_courier_parameter"><?= $Page->renderFieldHeader($Page->parameter) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->_response->Visible) { // response 
                                ?>
                                    <th data-name="_response" class="<?= $Page->_response->headerCellClass() ?>">
                                        <div id="elh_log_courier__response" class="log_courier__response"><?= $Page->renderFieldHeader($Page->_response) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->_content->Visible) { // content 
                                ?>
                                    <th data-name="_content" class="<?= $Page->_content->headerCellClass() ?>">
                                        <div id="elh_log_courier__content" class="log_courier__content"><?= $Page->renderFieldHeader($Page->_content) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->text_query->Visible) { // text_query 
                                ?>
                                    <th data-name="text_query" class="<?= $Page->text_query->headerCellClass() ?>">
                                        <div id="elh_log_courier_text_query" class="log_courier_text_query"><?= $Page->renderFieldHeader($Page->text_query) ?></div>
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
                                        "id" => "r" . $Page->RowCount . "_log_courier",
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
                                        <?php if ($Page->awb->Visible) { // awb 
                                        ?>
                                            <td data-name="awb" <?= $Page->awb->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_log_courier_awb" class="el_log_courier_awb">
                                                    <span<?= $Page->awb->viewAttributes() ?>>
                                                        <?= $Page->awb->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->kurir->Visible) { // kurir 
                                        ?>
                                            <td data-name="kurir" <?= $Page->kurir->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_log_courier_kurir" class="el_log_courier_kurir">
                                                    <span<?= $Page->kurir->viewAttributes() ?>>
                                                        <?= $Page->kurir->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->req_type->Visible) { // req_type 
                                        ?>
                                            <td data-name="req_type" <?= $Page->req_type->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_log_courier_req_type" class="el_log_courier_req_type">
                                                    <span<?= $Page->req_type->viewAttributes() ?>>
                                                        <?= $Page->req_type->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->datetime->Visible) { // datetime 
                                        ?>
                                            <td data-name="datetime" <?= $Page->datetime->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_log_courier_datetime" class="el_log_courier_datetime">
                                                    <span<?= $Page->datetime->viewAttributes() ?>>
                                                        <?= $Page->datetime->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->parameter->Visible) { // parameter 
                                        ?>
                                            <td data-name="parameter" <?= $Page->parameter->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_log_courier_parameter" class="el_log_courier_parameter">
                                                    <span<?= $Page->parameter->viewAttributes() ?>>
                                                        <?= $Page->parameter->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->_response->Visible) { // response 
                                        ?>
                                            <td data-name="_response" <?= $Page->_response->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_log_courier__response" class="el_log_courier__response">
                                                    <span<?= $Page->_response->viewAttributes() ?>>
                                                        <?= $Page->_response->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->_content->Visible) { // content 
                                        ?>
                                            <td data-name="_content" <?= $Page->_content->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_log_courier__content" class="el_log_courier__content">
                                                    <span<?= $Page->_content->viewAttributes() ?>>
                                                        <?= $Page->_content->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->text_query->Visible) { // text_query 
                                        ?>
                                            <td data-name="text_query" <?= $Page->text_query->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_log_courier_text_query" class="el_log_courier_text_query">
                                                    <span<?= $Page->text_query->viewAttributes() ?>>
                                                        <?= $Page->text_query->getViewValue() ?>
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
            ew.addEventHandlers("log_courier");
        });
    </script>
    <script>
        loadjs.ready("load", function() {
            // Write your table-specific startup script here, no need to add script tags.
        });
    </script>
<?php } ?>