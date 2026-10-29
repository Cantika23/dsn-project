<?php

namespace Mitral2022\DSN2;

// Page object
$UserList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
    <script>
        var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
        ew.deepAssign(ew.vars, {
            tables: {
                user: currentTable
            }
        });
        var currentForm, currentPageID;
        var fuserlist;
        loadjs.ready(["wrapper", "head"], function() {
            var $ = jQuery;
            // Form object
            fuserlist = new ew.Form("fuserlist", "list");
            currentPageID = ew.PAGE_ID = "list";
            currentForm = fuserlist;
            fuserlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

            // Dynamic selection lists
            fuserlist.lists.nama_user = <?= $Page->nama_user->toClientList($Page) ?>;
            fuserlist.lists._username = <?= $Page->_username->toClientList($Page) ?>;
            fuserlist.lists._password = <?= $Page->_password->toClientList($Page) ?>;
            fuserlist.lists._email = <?= $Page->_email->toClientList($Page) ?>;
            fuserlist.lists.level = <?= $Page->level->toClientList($Page) ?>;
            fuserlist.lists.id_pegawai = <?= $Page->id_pegawai->toClientList($Page) ?>;
            fuserlist.lists.npk = <?= $Page->npk->toClientList($Page) ?>;
            fuserlist.lists.dept = <?= $Page->dept->toClientList($Page) ?>;
            fuserlist.lists.phone = <?= $Page->phone->toClientList($Page) ?>;
            loadjs.done("fuserlist");
        });
        var fusersrch, currentSearchForm, currentAdvancedSearchForm;
        loadjs.ready(["wrapper", "head"], function() {
            var $ = jQuery;
            // Form object for search
            fusersrch = new ew.Form("fusersrch", "list");
            currentSearchForm = fusersrch;

            // Add fields
            var fields = currentTable.fields;
            fusersrch.addFields([
                ["nama_user", [], fields.nama_user.isInvalid],
                ["_username", [], fields._username.isInvalid],
                ["_password", [], fields._password.isInvalid],
                ["_email", [], fields._email.isInvalid],
                ["level", [], fields.level.isInvalid],
                ["id_pegawai", [], fields.id_pegawai.isInvalid],
                ["npk", [], fields.npk.isInvalid],
                ["dept", [], fields.dept.isInvalid],
                ["phone", [], fields.phone.isInvalid]
            ]);

            // Validate form
            fusersrch.validate = function() {
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
            fusersrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
                // Your custom validation code here, return false if invalid.
                return true;
            }

            // Use JavaScript validation or not
            fusersrch.validateRequired = ew.CLIENT_VALIDATE;

            // Dynamic selection lists
            fusersrch.lists.nama_user = <?= $Page->nama_user->toClientList($Page) ?>;
            fusersrch.lists._username = <?= $Page->_username->toClientList($Page) ?>;
            fusersrch.lists._password = <?= $Page->_password->toClientList($Page) ?>;
            fusersrch.lists._email = <?= $Page->_email->toClientList($Page) ?>;
            fusersrch.lists.level = <?= $Page->level->toClientList($Page) ?>;
            fusersrch.lists.id_pegawai = <?= $Page->id_pegawai->toClientList($Page) ?>;
            fusersrch.lists.npk = <?= $Page->npk->toClientList($Page) ?>;
            fusersrch.lists.dept = <?= $Page->dept->toClientList($Page) ?>;
            fusersrch.lists.phone = <?= $Page->phone->toClientList($Page) ?>;

            // Filters
            fusersrch.filterList = <?= $Page->getFilterList() ?>;
            loadjs.done("fusersrch");
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
        <form name="fusersrch" id="fusersrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
            <div id="fusersrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
                <input type="hidden" name="cmd" value="search">
                <input type="hidden" name="t" value="user">
                <div class="ew-extended-search container-fluid">
                    <div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
                        <?php
                        // Render search row
                        $Page->RowType = ROWTYPE_SEARCH;
                        $Page->resetAttributes();
                        $Page->renderRow();
                        ?>
                        <?php if ($Page->nama_user->Visible) { // nama_user 
                        ?>
                            <?php
                            if (!$Page->nama_user->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_nama_user" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->nama_user->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_nama_user" name="x_nama_user[]" class="form-control ew-select<?= $Page->nama_user->isInvalidClass() ?>" data-select2-id="fusersrch_x_nama_user" data-table="user" data-field="x_nama_user" data-caption="<?= HtmlEncode(RemoveHtml($Page->nama_user->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->nama_user->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->nama_user->getPlaceHolder()) ?>" <?= $Page->nama_user->editAttributes() ?>>
                                    <?= $Page->nama_user->selectOptionListHtml("x_nama_user", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->nama_user->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fusersrch", function() {
                                        var options = {
                                            name: "x_nama_user",
                                            selectId: "fusersrch_x_nama_user",
                                            ajax: {
                                                id: "x_nama_user",
                                                form: "fusersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.user.fields.nama_user.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->_username->Visible) { // username 
                        ?>
                            <?php
                            if (!$Page->_username->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs__username" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->_username->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x__username" name="x__username[]" class="form-control ew-select<?= $Page->_username->isInvalidClass() ?>" data-select2-id="fusersrch_x__username" data-table="user" data-field="x__username" data-caption="<?= HtmlEncode(RemoveHtml($Page->_username->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->_username->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->_username->getPlaceHolder()) ?>" <?= $Page->_username->editAttributes() ?>>
                                    <?= $Page->_username->selectOptionListHtml("x__username", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->_username->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fusersrch", function() {
                                        var options = {
                                            name: "x__username",
                                            selectId: "fusersrch_x__username",
                                            ajax: {
                                                id: "x__username",
                                                form: "fusersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.user.fields._username.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->_password->Visible) { // password 
                        ?>
                            <?php
                            if (!$Page->_password->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs__password" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->_password->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x__password" name="x__password[]" class="form-control ew-select<?= $Page->_password->isInvalidClass() ?>" data-select2-id="fusersrch_x__password" data-table="user" data-field="x__password" data-caption="<?= HtmlEncode(RemoveHtml($Page->_password->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->_password->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->_password->getPlaceHolder()) ?>" <?= $Page->_password->editAttributes() ?>>
                                    <?= $Page->_password->selectOptionListHtml("x__password", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->_password->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fusersrch", function() {
                                        var options = {
                                            name: "x__password",
                                            selectId: "fusersrch_x__password",
                                            ajax: {
                                                id: "x__password",
                                                form: "fusersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.user.fields._password.filterOptions);
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
                                <select id="x__email" name="x__email[]" class="form-control ew-select<?= $Page->_email->isInvalidClass() ?>" data-select2-id="fusersrch_x__email" data-table="user" data-field="x__email" data-caption="<?= HtmlEncode(RemoveHtml($Page->_email->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->_email->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->_email->getPlaceHolder()) ?>" <?= $Page->_email->editAttributes() ?>>
                                    <?= $Page->_email->selectOptionListHtml("x__email", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->_email->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fusersrch", function() {
                                        var options = {
                                            name: "x__email",
                                            selectId: "fusersrch_x__email",
                                            ajax: {
                                                id: "x__email",
                                                form: "fusersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.user.fields._email.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->level->Visible) { // level 
                        ?>
                            <?php
                            if (!$Page->level->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_level" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->level->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_level" name="x_level[]" class="form-control ew-select<?= $Page->level->isInvalidClass() ?>" data-select2-id="fusersrch_x_level" data-table="user" data-field="x_level" data-caption="<?= HtmlEncode(RemoveHtml($Page->level->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->level->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->level->getPlaceHolder()) ?>" <?= $Page->level->editAttributes() ?>>
                                    <?= $Page->level->selectOptionListHtml("x_level", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->level->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fusersrch", function() {
                                        var options = {
                                            name: "x_level",
                                            selectId: "fusersrch_x_level",
                                            ajax: {
                                                id: "x_level",
                                                form: "fusersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.user.fields.level.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->id_pegawai->Visible) { // id_pegawai 
                        ?>
                            <?php
                            if (!$Page->id_pegawai->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_id_pegawai" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->id_pegawai->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_id_pegawai" name="x_id_pegawai[]" class="form-control ew-select<?= $Page->id_pegawai->isInvalidClass() ?>" data-select2-id="fusersrch_x_id_pegawai" data-table="user" data-field="x_id_pegawai" data-caption="<?= HtmlEncode(RemoveHtml($Page->id_pegawai->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->id_pegawai->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->id_pegawai->getPlaceHolder()) ?>" <?= $Page->id_pegawai->editAttributes() ?>>
                                    <?= $Page->id_pegawai->selectOptionListHtml("x_id_pegawai", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->id_pegawai->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fusersrch", function() {
                                        var options = {
                                            name: "x_id_pegawai",
                                            selectId: "fusersrch_x_id_pegawai",
                                            ajax: {
                                                id: "x_id_pegawai",
                                                form: "fusersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.user.fields.id_pegawai.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->npk->Visible) { // npk 
                        ?>
                            <?php
                            if (!$Page->npk->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_npk" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->npk->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_npk" name="x_npk[]" class="form-control ew-select<?= $Page->npk->isInvalidClass() ?>" data-select2-id="fusersrch_x_npk" data-table="user" data-field="x_npk" data-caption="<?= HtmlEncode(RemoveHtml($Page->npk->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->npk->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->npk->getPlaceHolder()) ?>" <?= $Page->npk->editAttributes() ?>>
                                    <?= $Page->npk->selectOptionListHtml("x_npk", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->npk->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fusersrch", function() {
                                        var options = {
                                            name: "x_npk",
                                            selectId: "fusersrch_x_npk",
                                            ajax: {
                                                id: "x_npk",
                                                form: "fusersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.user.fields.npk.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->dept->Visible) { // dept 
                        ?>
                            <?php
                            if (!$Page->dept->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_dept" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->dept->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_dept" name="x_dept[]" class="form-control ew-select<?= $Page->dept->isInvalidClass() ?>" data-select2-id="fusersrch_x_dept" data-table="user" data-field="x_dept" data-caption="<?= HtmlEncode(RemoveHtml($Page->dept->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->dept->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->dept->getPlaceHolder()) ?>" <?= $Page->dept->editAttributes() ?>>
                                    <?= $Page->dept->selectOptionListHtml("x_dept", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->dept->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fusersrch", function() {
                                        var options = {
                                            name: "x_dept",
                                            selectId: "fusersrch_x_dept",
                                            ajax: {
                                                id: "x_dept",
                                                form: "fusersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.user.fields.dept.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->phone->Visible) { // phone 
                        ?>
                            <?php
                            if (!$Page->phone->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_phone" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->phone->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_phone" name="x_phone[]" class="form-control ew-select<?= $Page->phone->isInvalidClass() ?>" data-select2-id="fusersrch_x_phone" data-table="user" data-field="x_phone" data-caption="<?= HtmlEncode(RemoveHtml($Page->phone->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->phone->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->phone->getPlaceHolder()) ?>" <?= $Page->phone->editAttributes() ?>>
                                    <?= $Page->phone->selectOptionListHtml("x_phone", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->phone->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fusersrch", function() {
                                        var options = {
                                            name: "x_phone",
                                            selectId: "fusersrch_x_phone",
                                            ajax: {
                                                id: "x_phone",
                                                form: "fusersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.user.fields.phone.filterOptions);
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
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fusersrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fusersrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fusersrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fusersrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
    <div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> user">
        <form name="fuserlist" id="fuserlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
            <?php if (Config("CHECK_TOKEN")) { ?>
                <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
                <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
            <?php } ?>
            <input type="hidden" name="t" value="user">
            <div id="gmp_user" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
                <?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
                    <table id="tbl_userlist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
                                <?php if ($Page->nama_user->Visible) { // nama_user 
                                ?>
                                    <th data-name="nama_user" class="<?= $Page->nama_user->headerCellClass() ?>">
                                        <div id="elh_user_nama_user" class="user_nama_user"><?= $Page->renderFieldHeader($Page->nama_user) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->_username->Visible) { // username 
                                ?>
                                    <th data-name="_username" class="<?= $Page->_username->headerCellClass() ?>">
                                        <div id="elh_user__username" class="user__username"><?= $Page->renderFieldHeader($Page->_username) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->_password->Visible) { // password 
                                ?>
                                    <th data-name="_password" class="<?= $Page->_password->headerCellClass() ?>">
                                        <div id="elh_user__password" class="user__password"><?= $Page->renderFieldHeader($Page->_password) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->_email->Visible) { // email 
                                ?>
                                    <th data-name="_email" class="<?= $Page->_email->headerCellClass() ?>">
                                        <div id="elh_user__email" class="user__email"><?= $Page->renderFieldHeader($Page->_email) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->level->Visible) { // level 
                                ?>
                                    <th data-name="level" class="<?= $Page->level->headerCellClass() ?>">
                                        <div id="elh_user_level" class="user_level"><?= $Page->renderFieldHeader($Page->level) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->id_pegawai->Visible) { // id_pegawai 
                                ?>
                                    <th data-name="id_pegawai" class="<?= $Page->id_pegawai->headerCellClass() ?>">
                                        <div id="elh_user_id_pegawai" class="user_id_pegawai"><?= $Page->renderFieldHeader($Page->id_pegawai) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->npk->Visible) { // npk 
                                ?>
                                    <th data-name="npk" class="<?= $Page->npk->headerCellClass() ?>">
                                        <div id="elh_user_npk" class="user_npk"><?= $Page->renderFieldHeader($Page->npk) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->dept->Visible) { // dept 
                                ?>
                                    <th data-name="dept" class="<?= $Page->dept->headerCellClass() ?>">
                                        <div id="elh_user_dept" class="user_dept"><?= $Page->renderFieldHeader($Page->dept) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->phone->Visible) { // phone 
                                ?>
                                    <th data-name="phone" class="<?= $Page->phone->headerCellClass() ?>">
                                        <div id="elh_user_phone" class="user_phone"><?= $Page->renderFieldHeader($Page->phone) ?></div>
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
                                        "id" => "r" . $Page->RowCount . "_user",
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
                                        <?php if ($Page->nama_user->Visible) { // nama_user 
                                        ?>
                                            <td data-name="nama_user" <?= $Page->nama_user->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_user_nama_user" class="el_user_nama_user">
                                                    <span<?= $Page->nama_user->viewAttributes() ?>>
                                                        <?= $Page->nama_user->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->_username->Visible) { // username 
                                        ?>
                                            <td data-name="_username" <?= $Page->_username->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_user__username" class="el_user__username">
                                                    <span<?= $Page->_username->viewAttributes() ?>>
                                                        <?= $Page->_username->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->_password->Visible) { // password 
                                        ?>
                                            <td data-name="_password" <?= $Page->_password->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_user__password" class="el_user__password">
                                                    <span<?= $Page->_password->viewAttributes() ?>>
                                                        <?= $Page->_password->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->_email->Visible) { // email 
                                        ?>
                                            <td data-name="_email" <?= $Page->_email->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_user__email" class="el_user__email">
                                                    <span<?= $Page->_email->viewAttributes() ?>>
                                                        <?= $Page->_email->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->level->Visible) { // level 
                                        ?>
                                            <td data-name="level" <?= $Page->level->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_user_level" class="el_user_level">
                                                    <span<?= $Page->level->viewAttributes() ?>>
                                                        <?= $Page->level->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->id_pegawai->Visible) { // id_pegawai 
                                        ?>
                                            <td data-name="id_pegawai" <?= $Page->id_pegawai->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_user_id_pegawai" class="el_user_id_pegawai">
                                                    <span<?= $Page->id_pegawai->viewAttributes() ?>>
                                                        <?= $Page->id_pegawai->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->npk->Visible) { // npk 
                                        ?>
                                            <td data-name="npk" <?= $Page->npk->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_user_npk" class="el_user_npk">
                                                    <span<?= $Page->npk->viewAttributes() ?>>
                                                        <?= $Page->npk->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->dept->Visible) { // dept 
                                        ?>
                                            <td data-name="dept" <?= $Page->dept->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_user_dept" class="el_user_dept">
                                                    <span<?= $Page->dept->viewAttributes() ?>>
                                                        <?= $Page->dept->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->phone->Visible) { // phone 
                                        ?>
                                            <td data-name="phone" <?= $Page->phone->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_user_phone" class="el_user_phone">
                                                    <span<?= $Page->phone->viewAttributes() ?>>
                                                        <?= $Page->phone->getViewValue() ?>
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
            ew.addEventHandlers("user");
        });
    </script>
    <script>
        loadjs.ready("load", function() {
            // Write your table-specific startup script here, no need to add script tags.
        });
    </script>
<?php } ?>