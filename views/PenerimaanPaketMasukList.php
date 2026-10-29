<?php

namespace Mitral2022\DSN2;

// Page object
$PenerimaanPaketMasukList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
    <script>
        var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
        ew.deepAssign(ew.vars, {
            tables: {
                penerimaan_paket_masuk: currentTable
            }
        });
        var currentForm, currentPageID;
        var fpenerimaan_paket_masuklist;
        loadjs.ready(["wrapper", "head"], function() {
            var $ = jQuery;
            // Form object
            fpenerimaan_paket_masuklist = new ew.Form("fpenerimaan_paket_masuklist", "list");
            currentPageID = ew.PAGE_ID = "list";
            currentForm = fpenerimaan_paket_masuklist;
            fpenerimaan_paket_masuklist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

            // Dynamic selection lists
            fpenerimaan_paket_masuklist.lists.no_dokumen_no_paket = <?= $Page->no_dokumen_no_paket->toClientList($Page) ?>;
            fpenerimaan_paket_masuklist.lists.jenis_dokumen = <?= $Page->jenis_dokumen->toClientList($Page) ?>;
            fpenerimaan_paket_masuklist.lists.nama_pengirim = <?= $Page->nama_pengirim->toClientList($Page) ?>;
            fpenerimaan_paket_masuklist.lists.nama_penerima = <?= $Page->nama_penerima->toClientList($Page) ?>;
            fpenerimaan_paket_masuklist.lists.email_penerima = <?= $Page->email_penerima->toClientList($Page) ?>;
            fpenerimaan_paket_masuklist.lists.no_hp_penerima = <?= $Page->no_hp_penerima->toClientList($Page) ?>;
            fpenerimaan_paket_masuklist.lists.status = <?= $Page->status->toClientList($Page) ?>;
            fpenerimaan_paket_masuklist.lists.tanggal_terima = <?= $Page->tanggal_terima->toClientList($Page) ?>;
            fpenerimaan_paket_masuklist.lists.bukti_penerimaan = <?= $Page->bukti_penerimaan->toClientList($Page) ?>;
            fpenerimaan_paket_masuklist.lists.diterima_oleh = <?= $Page->diterima_oleh->toClientList($Page) ?>;
            fpenerimaan_paket_masuklist.lists.id_user = <?= $Page->id_user->toClientList($Page) ?>;
            fpenerimaan_paket_masuklist.lists.created_date = <?= $Page->created_date->toClientList($Page) ?>;
            fpenerimaan_paket_masuklist.lists.update_by = <?= $Page->update_by->toClientList($Page) ?>;
            loadjs.done("fpenerimaan_paket_masuklist");
        });
        var fpenerimaan_paket_masuksrch, currentSearchForm, currentAdvancedSearchForm;
        loadjs.ready(["wrapper", "head"], function() {
            var $ = jQuery;
            // Form object for search
            fpenerimaan_paket_masuksrch = new ew.Form("fpenerimaan_paket_masuksrch", "list");
            currentSearchForm = fpenerimaan_paket_masuksrch;

            // Add fields
            var fields = currentTable.fields;
            fpenerimaan_paket_masuksrch.addFields([
                ["no_dokumen_no_paket", [], fields.no_dokumen_no_paket.isInvalid],
                ["jenis_dokumen", [], fields.jenis_dokumen.isInvalid],
                ["nama_pengirim", [], fields.nama_pengirim.isInvalid],
                ["nama_penerima", [], fields.nama_penerima.isInvalid],
                ["email_penerima", [], fields.email_penerima.isInvalid],
                ["no_hp_penerima", [], fields.no_hp_penerima.isInvalid],
                ["status", [], fields.status.isInvalid],
                ["tanggal_terima", [], fields.tanggal_terima.isInvalid],
                ["bukti_penerimaan", [], fields.bukti_penerimaan.isInvalid],
                ["diterima_oleh", [], fields.diterima_oleh.isInvalid],
                ["id_user", [], fields.id_user.isInvalid],
                ["created_date", [], fields.created_date.isInvalid],
                ["update_by", [], fields.update_by.isInvalid]
            ]);

            // Validate form
            fpenerimaan_paket_masuksrch.validate = function() {
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
            fpenerimaan_paket_masuksrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
                // Your custom validation code here, return false if invalid.
                return true;
            }

            // Use JavaScript validation or not
            fpenerimaan_paket_masuksrch.validateRequired = ew.CLIENT_VALIDATE;

            // Dynamic selection lists
            fpenerimaan_paket_masuksrch.lists.no_dokumen_no_paket = <?= $Page->no_dokumen_no_paket->toClientList($Page) ?>;
            fpenerimaan_paket_masuksrch.lists.jenis_dokumen = <?= $Page->jenis_dokumen->toClientList($Page) ?>;
            fpenerimaan_paket_masuksrch.lists.nama_pengirim = <?= $Page->nama_pengirim->toClientList($Page) ?>;
            fpenerimaan_paket_masuksrch.lists.nama_penerima = <?= $Page->nama_penerima->toClientList($Page) ?>;
            fpenerimaan_paket_masuksrch.lists.email_penerima = <?= $Page->email_penerima->toClientList($Page) ?>;
            fpenerimaan_paket_masuksrch.lists.no_hp_penerima = <?= $Page->no_hp_penerima->toClientList($Page) ?>;
            fpenerimaan_paket_masuksrch.lists.status = <?= $Page->status->toClientList($Page) ?>;
            fpenerimaan_paket_masuksrch.lists.tanggal_terima = <?= $Page->tanggal_terima->toClientList($Page) ?>;
            fpenerimaan_paket_masuksrch.lists.bukti_penerimaan = <?= $Page->bukti_penerimaan->toClientList($Page) ?>;
            fpenerimaan_paket_masuksrch.lists.diterima_oleh = <?= $Page->diterima_oleh->toClientList($Page) ?>;
            fpenerimaan_paket_masuksrch.lists.id_user = <?= $Page->id_user->toClientList($Page) ?>;
            fpenerimaan_paket_masuksrch.lists.created_date = <?= $Page->created_date->toClientList($Page) ?>;
            fpenerimaan_paket_masuksrch.lists.update_by = <?= $Page->update_by->toClientList($Page) ?>;

            // Filters
            fpenerimaan_paket_masuksrch.filterList = <?= $Page->getFilterList() ?>;
            loadjs.done("fpenerimaan_paket_masuksrch");
        });
    </script>
    <script>
        loadjs.ready("head", function() {
            // Client script
            // Write your table-specific client script here, no need to add script tags.
            $("#elh_penerimaan_paket_masuk_sequence").text("Nomor Urut");
            $("#elh_penerimaan_paket_masuk_id_user .ew-table-header-caption").text('PIC');
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
        <form name="fpenerimaan_paket_masuksrch" id="fpenerimaan_paket_masuksrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
            <div id="fpenerimaan_paket_masuksrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
                <input type="hidden" name="cmd" value="search">
                <input type="hidden" name="t" value="penerimaan_paket_masuk">
                <div class="ew-extended-search container-fluid">
                    <div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
                        <?php
                        // Render search row
                        $Page->RowType = ROWTYPE_SEARCH;
                        $Page->resetAttributes();
                        $Page->renderRow();
                        ?>
                        <?php if ($Page->no_dokumen_no_paket->Visible) { // no_dokumen_no_paket 
                        ?>
                            <?php
                            if (!$Page->no_dokumen_no_paket->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_no_dokumen_no_paket" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->no_dokumen_no_paket->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_no_dokumen_no_paket" name="x_no_dokumen_no_paket[]" class="form-control ew-select<?= $Page->no_dokumen_no_paket->isInvalidClass() ?>" data-select2-id="fpenerimaan_paket_masuksrch_x_no_dokumen_no_paket" data-table="penerimaan_paket_masuk" data-field="x_no_dokumen_no_paket" data-caption="<?= HtmlEncode(RemoveHtml($Page->no_dokumen_no_paket->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->no_dokumen_no_paket->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->no_dokumen_no_paket->getPlaceHolder()) ?>" <?= $Page->no_dokumen_no_paket->editAttributes() ?>>
                                    <?= $Page->no_dokumen_no_paket->selectOptionListHtml("x_no_dokumen_no_paket", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->no_dokumen_no_paket->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fpenerimaan_paket_masuksrch", function() {
                                        var options = {
                                            name: "x_no_dokumen_no_paket",
                                            selectId: "fpenerimaan_paket_masuksrch_x_no_dokumen_no_paket",
                                            ajax: {
                                                id: "x_no_dokumen_no_paket",
                                                form: "fpenerimaan_paket_masuksrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.penerimaan_paket_masuk.fields.no_dokumen_no_paket.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->jenis_dokumen->Visible) { // jenis_dokumen 
                        ?>
                            <?php
                            if (!$Page->jenis_dokumen->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_jenis_dokumen" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->jenis_dokumen->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_jenis_dokumen" name="x_jenis_dokumen[]" class="form-control ew-select<?= $Page->jenis_dokumen->isInvalidClass() ?>" data-select2-id="fpenerimaan_paket_masuksrch_x_jenis_dokumen" data-table="penerimaan_paket_masuk" data-field="x_jenis_dokumen" data-caption="<?= HtmlEncode(RemoveHtml($Page->jenis_dokumen->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->jenis_dokumen->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->jenis_dokumen->getPlaceHolder()) ?>" <?= $Page->jenis_dokumen->editAttributes() ?>>
                                    <?= $Page->jenis_dokumen->selectOptionListHtml("x_jenis_dokumen", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->jenis_dokumen->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fpenerimaan_paket_masuksrch", function() {
                                        var options = {
                                            name: "x_jenis_dokumen",
                                            selectId: "fpenerimaan_paket_masuksrch_x_jenis_dokumen",
                                            ajax: {
                                                id: "x_jenis_dokumen",
                                                form: "fpenerimaan_paket_masuksrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.penerimaan_paket_masuk.fields.jenis_dokumen.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->nama_pengirim->Visible) { // nama_pengirim 
                        ?>
                            <?php
                            if (!$Page->nama_pengirim->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_nama_pengirim" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->nama_pengirim->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_nama_pengirim" name="x_nama_pengirim[]" class="form-control ew-select<?= $Page->nama_pengirim->isInvalidClass() ?>" data-select2-id="fpenerimaan_paket_masuksrch_x_nama_pengirim" data-table="penerimaan_paket_masuk" data-field="x_nama_pengirim" data-caption="<?= HtmlEncode(RemoveHtml($Page->nama_pengirim->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->nama_pengirim->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->nama_pengirim->getPlaceHolder()) ?>" <?= $Page->nama_pengirim->editAttributes() ?>>
                                    <?= $Page->nama_pengirim->selectOptionListHtml("x_nama_pengirim", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->nama_pengirim->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fpenerimaan_paket_masuksrch", function() {
                                        var options = {
                                            name: "x_nama_pengirim",
                                            selectId: "fpenerimaan_paket_masuksrch_x_nama_pengirim",
                                            ajax: {
                                                id: "x_nama_pengirim",
                                                form: "fpenerimaan_paket_masuksrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.penerimaan_paket_masuk.fields.nama_pengirim.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->nama_penerima->Visible) { // nama_penerima 
                        ?>
                            <?php
                            if (!$Page->nama_penerima->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_nama_penerima" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->nama_penerima->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_nama_penerima" name="x_nama_penerima[]" class="form-control ew-select<?= $Page->nama_penerima->isInvalidClass() ?>" data-select2-id="fpenerimaan_paket_masuksrch_x_nama_penerima" data-table="penerimaan_paket_masuk" data-field="x_nama_penerima" data-caption="<?= HtmlEncode(RemoveHtml($Page->nama_penerima->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->nama_penerima->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->nama_penerima->getPlaceHolder()) ?>" <?= $Page->nama_penerima->editAttributes() ?>>
                                    <?= $Page->nama_penerima->selectOptionListHtml("x_nama_penerima", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->nama_penerima->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fpenerimaan_paket_masuksrch", function() {
                                        var options = {
                                            name: "x_nama_penerima",
                                            selectId: "fpenerimaan_paket_masuksrch_x_nama_penerima",
                                            ajax: {
                                                id: "x_nama_penerima",
                                                form: "fpenerimaan_paket_masuksrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.penerimaan_paket_masuk.fields.nama_penerima.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->email_penerima->Visible) { // email_penerima 
                        ?>
                            <?php
                            if (!$Page->email_penerima->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_email_penerima" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->email_penerima->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_email_penerima" name="x_email_penerima[]" class="form-control ew-select<?= $Page->email_penerima->isInvalidClass() ?>" data-select2-id="fpenerimaan_paket_masuksrch_x_email_penerima" data-table="penerimaan_paket_masuk" data-field="x_email_penerima" data-caption="<?= HtmlEncode(RemoveHtml($Page->email_penerima->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->email_penerima->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->email_penerima->getPlaceHolder()) ?>" <?= $Page->email_penerima->editAttributes() ?>>
                                    <?= $Page->email_penerima->selectOptionListHtml("x_email_penerima", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->email_penerima->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fpenerimaan_paket_masuksrch", function() {
                                        var options = {
                                            name: "x_email_penerima",
                                            selectId: "fpenerimaan_paket_masuksrch_x_email_penerima",
                                            ajax: {
                                                id: "x_email_penerima",
                                                form: "fpenerimaan_paket_masuksrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.penerimaan_paket_masuk.fields.email_penerima.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->no_hp_penerima->Visible) { // no_hp_penerima 
                        ?>
                            <?php
                            if (!$Page->no_hp_penerima->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_no_hp_penerima" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->no_hp_penerima->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_no_hp_penerima" name="x_no_hp_penerima[]" class="form-control ew-select<?= $Page->no_hp_penerima->isInvalidClass() ?>" data-select2-id="fpenerimaan_paket_masuksrch_x_no_hp_penerima" data-table="penerimaan_paket_masuk" data-field="x_no_hp_penerima" data-caption="<?= HtmlEncode(RemoveHtml($Page->no_hp_penerima->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->no_hp_penerima->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->no_hp_penerima->getPlaceHolder()) ?>" <?= $Page->no_hp_penerima->editAttributes() ?>>
                                    <?= $Page->no_hp_penerima->selectOptionListHtml("x_no_hp_penerima", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->no_hp_penerima->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fpenerimaan_paket_masuksrch", function() {
                                        var options = {
                                            name: "x_no_hp_penerima",
                                            selectId: "fpenerimaan_paket_masuksrch_x_no_hp_penerima",
                                            ajax: {
                                                id: "x_no_hp_penerima",
                                                form: "fpenerimaan_paket_masuksrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.penerimaan_paket_masuk.fields.no_hp_penerima.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->status->Visible) { // status 
                        ?>
                            <?php
                            if (!$Page->status->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_status" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->status->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_status" name="x_status[]" class="form-control ew-select<?= $Page->status->isInvalidClass() ?>" data-select2-id="fpenerimaan_paket_masuksrch_x_status" data-table="penerimaan_paket_masuk" data-field="x_status" data-caption="<?= HtmlEncode(RemoveHtml($Page->status->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->status->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>" <?= $Page->status->editAttributes() ?>>
                                    <?= $Page->status->selectOptionListHtml("x_status", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->status->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fpenerimaan_paket_masuksrch", function() {
                                        var options = {
                                            name: "x_status",
                                            selectId: "fpenerimaan_paket_masuksrch_x_status",
                                            ajax: {
                                                id: "x_status",
                                                form: "fpenerimaan_paket_masuksrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.penerimaan_paket_masuk.fields.status.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->tanggal_terima->Visible) { // tanggal_terima 
                        ?>
                            <?php
                            if (!$Page->tanggal_terima->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_tanggal_terima" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->tanggal_terima->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_tanggal_terima" name="x_tanggal_terima[]" class="form-control ew-select<?= $Page->tanggal_terima->isInvalidClass() ?>" data-select2-id="fpenerimaan_paket_masuksrch_x_tanggal_terima" data-table="penerimaan_paket_masuk" data-field="x_tanggal_terima" data-caption="<?= HtmlEncode(RemoveHtml($Page->tanggal_terima->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->tanggal_terima->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->tanggal_terima->getPlaceHolder()) ?>" <?= $Page->tanggal_terima->editAttributes() ?>>
                                    <?= $Page->tanggal_terima->selectOptionListHtml("x_tanggal_terima", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->tanggal_terima->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fpenerimaan_paket_masuksrch", function() {
                                        var options = {
                                            name: "x_tanggal_terima",
                                            selectId: "fpenerimaan_paket_masuksrch_x_tanggal_terima",
                                            ajax: {
                                                id: "x_tanggal_terima",
                                                form: "fpenerimaan_paket_masuksrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.penerimaan_paket_masuk.fields.tanggal_terima.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->bukti_penerimaan->Visible) { // bukti_penerimaan 
                        ?>
                            <?php
                            if (!$Page->bukti_penerimaan->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_bukti_penerimaan" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->bukti_penerimaan->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_bukti_penerimaan" name="x_bukti_penerimaan[]" class="form-control ew-select<?= $Page->bukti_penerimaan->isInvalidClass() ?>" data-select2-id="fpenerimaan_paket_masuksrch_x_bukti_penerimaan" data-table="penerimaan_paket_masuk" data-field="x_bukti_penerimaan" data-caption="<?= HtmlEncode(RemoveHtml($Page->bukti_penerimaan->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->bukti_penerimaan->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->bukti_penerimaan->getPlaceHolder()) ?>" <?= $Page->bukti_penerimaan->editAttributes() ?>>
                                    <?= $Page->bukti_penerimaan->selectOptionListHtml("x_bukti_penerimaan", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->bukti_penerimaan->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fpenerimaan_paket_masuksrch", function() {
                                        var options = {
                                            name: "x_bukti_penerimaan",
                                            selectId: "fpenerimaan_paket_masuksrch_x_bukti_penerimaan",
                                            ajax: {
                                                id: "x_bukti_penerimaan",
                                                form: "fpenerimaan_paket_masuksrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.penerimaan_paket_masuk.fields.bukti_penerimaan.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->diterima_oleh->Visible) { // diterima_oleh 
                        ?>
                            <?php
                            if (!$Page->diterima_oleh->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_diterima_oleh" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->diterima_oleh->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_diterima_oleh" name="x_diterima_oleh[]" class="form-control ew-select<?= $Page->diterima_oleh->isInvalidClass() ?>" data-select2-id="fpenerimaan_paket_masuksrch_x_diterima_oleh" data-table="penerimaan_paket_masuk" data-field="x_diterima_oleh" data-caption="<?= HtmlEncode(RemoveHtml($Page->diterima_oleh->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->diterima_oleh->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->diterima_oleh->getPlaceHolder()) ?>" <?= $Page->diterima_oleh->editAttributes() ?>>
                                    <?= $Page->diterima_oleh->selectOptionListHtml("x_diterima_oleh", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->diterima_oleh->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fpenerimaan_paket_masuksrch", function() {
                                        var options = {
                                            name: "x_diterima_oleh",
                                            selectId: "fpenerimaan_paket_masuksrch_x_diterima_oleh",
                                            ajax: {
                                                id: "x_diterima_oleh",
                                                form: "fpenerimaan_paket_masuksrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.penerimaan_paket_masuk.fields.diterima_oleh.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->id_user->Visible) { // id_user 
                        ?>
                            <?php
                            if (!$Page->id_user->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_id_user" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->id_user->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_id_user" name="x_id_user[]" class="form-control ew-select<?= $Page->id_user->isInvalidClass() ?>" data-select2-id="fpenerimaan_paket_masuksrch_x_id_user" data-table="penerimaan_paket_masuk" data-field="x_id_user" data-caption="<?= HtmlEncode(RemoveHtml($Page->id_user->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->id_user->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->id_user->getPlaceHolder()) ?>" <?= $Page->id_user->editAttributes() ?>>
                                    <?= $Page->id_user->selectOptionListHtml("x_id_user", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->id_user->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fpenerimaan_paket_masuksrch", function() {
                                        var options = {
                                            name: "x_id_user",
                                            selectId: "fpenerimaan_paket_masuksrch_x_id_user",
                                            ajax: {
                                                id: "x_id_user",
                                                form: "fpenerimaan_paket_masuksrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.penerimaan_paket_masuk.fields.id_user.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->created_date->Visible) { // created_date 
                        ?>
                            <?php
                            if (!$Page->created_date->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_created_date" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->created_date->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_created_date" name="x_created_date[]" class="form-control ew-select<?= $Page->created_date->isInvalidClass() ?>" data-select2-id="fpenerimaan_paket_masuksrch_x_created_date" data-table="penerimaan_paket_masuk" data-field="x_created_date" data-caption="<?= HtmlEncode(RemoveHtml($Page->created_date->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->created_date->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->created_date->getPlaceHolder()) ?>" <?= $Page->created_date->editAttributes() ?>>
                                    <?= $Page->created_date->selectOptionListHtml("x_created_date", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->created_date->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fpenerimaan_paket_masuksrch", function() {
                                        var options = {
                                            name: "x_created_date",
                                            selectId: "fpenerimaan_paket_masuksrch_x_created_date",
                                            ajax: {
                                                id: "x_created_date",
                                                form: "fpenerimaan_paket_masuksrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.penerimaan_paket_masuk.fields.created_date.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->update_by->Visible) { // update_by 
                        ?>
                            <?php
                            if (!$Page->update_by->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_update_by" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->update_by->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_update_by" name="x_update_by[]" class="form-control ew-select<?= $Page->update_by->isInvalidClass() ?>" data-select2-id="fpenerimaan_paket_masuksrch_x_update_by" data-table="penerimaan_paket_masuk" data-field="x_update_by" data-caption="<?= HtmlEncode(RemoveHtml($Page->update_by->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->update_by->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->update_by->getPlaceHolder()) ?>" <?= $Page->update_by->editAttributes() ?>>
                                    <?= $Page->update_by->selectOptionListHtml("x_update_by", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->update_by->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fpenerimaan_paket_masuksrch", function() {
                                        var options = {
                                            name: "x_update_by",
                                            selectId: "fpenerimaan_paket_masuksrch_x_update_by",
                                            ajax: {
                                                id: "x_update_by",
                                                form: "fpenerimaan_paket_masuksrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.penerimaan_paket_masuk.fields.update_by.filterOptions);
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
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fpenerimaan_paket_masuksrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fpenerimaan_paket_masuksrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fpenerimaan_paket_masuksrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fpenerimaan_paket_masuksrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
    <div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> penerimaan_paket_masuk">
        <form name="fpenerimaan_paket_masuklist" id="fpenerimaan_paket_masuklist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
            <?php if (Config("CHECK_TOKEN")) { ?>
                <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
                <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
            <?php } ?>
            <input type="hidden" name="t" value="penerimaan_paket_masuk">
            <div id="gmp_penerimaan_paket_masuk" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
                <?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
                    <table id="tbl_penerimaan_paket_masuklist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
                                <?php if ($Page->no_dokumen_no_paket->Visible) { // no_dokumen_no_paket 
                                ?>
                                    <th data-name="no_dokumen_no_paket" class="<?= $Page->no_dokumen_no_paket->headerCellClass() ?>">
                                        <div id="elh_penerimaan_paket_masuk_no_dokumen_no_paket" class="penerimaan_paket_masuk_no_dokumen_no_paket"><?= $Page->renderFieldHeader($Page->no_dokumen_no_paket) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->jenis_dokumen->Visible) { // jenis_dokumen 
                                ?>
                                    <th data-name="jenis_dokumen" class="<?= $Page->jenis_dokumen->headerCellClass() ?>">
                                        <div id="elh_penerimaan_paket_masuk_jenis_dokumen" class="penerimaan_paket_masuk_jenis_dokumen"><?= $Page->renderFieldHeader($Page->jenis_dokumen) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->nama_pengirim->Visible) { // nama_pengirim 
                                ?>
                                    <th data-name="nama_pengirim" class="<?= $Page->nama_pengirim->headerCellClass() ?>">
                                        <div id="elh_penerimaan_paket_masuk_nama_pengirim" class="penerimaan_paket_masuk_nama_pengirim"><?= $Page->renderFieldHeader($Page->nama_pengirim) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->nama_penerima->Visible) { // nama_penerima 
                                ?>
                                    <th data-name="nama_penerima" class="<?= $Page->nama_penerima->headerCellClass() ?>">
                                        <div id="elh_penerimaan_paket_masuk_nama_penerima" class="penerimaan_paket_masuk_nama_penerima"><?= $Page->renderFieldHeader($Page->nama_penerima) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->email_penerima->Visible) { // email_penerima 
                                ?>
                                    <th data-name="email_penerima" class="<?= $Page->email_penerima->headerCellClass() ?>">
                                        <div id="elh_penerimaan_paket_masuk_email_penerima" class="penerimaan_paket_masuk_email_penerima"><?= $Page->renderFieldHeader($Page->email_penerima) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->no_hp_penerima->Visible) { // no_hp_penerima 
                                ?>
                                    <th data-name="no_hp_penerima" class="<?= $Page->no_hp_penerima->headerCellClass() ?>">
                                        <div id="elh_penerimaan_paket_masuk_no_hp_penerima" class="penerimaan_paket_masuk_no_hp_penerima"><?= $Page->renderFieldHeader($Page->no_hp_penerima) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->status->Visible) { // status 
                                ?>
                                    <th data-name="status" class="<?= $Page->status->headerCellClass() ?>">
                                        <div id="elh_penerimaan_paket_masuk_status" class="penerimaan_paket_masuk_status"><?= $Page->renderFieldHeader($Page->status) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->tanggal_terima->Visible) { // tanggal_terima 
                                ?>
                                    <th data-name="tanggal_terima" class="<?= $Page->tanggal_terima->headerCellClass() ?>">
                                        <div id="elh_penerimaan_paket_masuk_tanggal_terima" class="penerimaan_paket_masuk_tanggal_terima"><?= $Page->renderFieldHeader($Page->tanggal_terima) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->bukti_penerimaan->Visible) { // bukti_penerimaan 
                                ?>
                                    <th data-name="bukti_penerimaan" class="<?= $Page->bukti_penerimaan->headerCellClass() ?>">
                                        <div id="elh_penerimaan_paket_masuk_bukti_penerimaan" class="penerimaan_paket_masuk_bukti_penerimaan"><?= $Page->renderFieldHeader($Page->bukti_penerimaan) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->diterima_oleh->Visible) { // diterima_oleh 
                                ?>
                                    <th data-name="diterima_oleh" class="<?= $Page->diterima_oleh->headerCellClass() ?>">
                                        <div id="elh_penerimaan_paket_masuk_diterima_oleh" class="penerimaan_paket_masuk_diterima_oleh"><?= $Page->renderFieldHeader($Page->diterima_oleh) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->id_user->Visible) { // id_user 
                                ?>
                                    <th data-name="id_user" class="<?= $Page->id_user->headerCellClass() ?>" style="white-space: nowrap;">
                                        <div id="elh_penerimaan_paket_masuk_id_user" class="penerimaan_paket_masuk_id_user"><?= $Page->renderFieldHeader($Page->id_user) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->created_date->Visible) { // created_date 
                                ?>
                                    <th data-name="created_date" class="<?= $Page->created_date->headerCellClass() ?>">
                                        <div id="elh_penerimaan_paket_masuk_created_date" class="penerimaan_paket_masuk_created_date"><?= $Page->renderFieldHeader($Page->created_date) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->update_by->Visible) { // update_by 
                                ?>
                                    <th data-name="update_by" class="<?= $Page->update_by->headerCellClass() ?>">
                                        <div id="elh_penerimaan_paket_masuk_update_by" class="penerimaan_paket_masuk_update_by"><?= $Page->renderFieldHeader($Page->update_by) ?></div>
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
                                        "id" => "r" . $Page->RowCount . "_penerimaan_paket_masuk",
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
                                        <?php if ($Page->no_dokumen_no_paket->Visible) { // no_dokumen_no_paket 
                                        ?>
                                            <td data-name="no_dokumen_no_paket" <?= $Page->no_dokumen_no_paket->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_penerimaan_paket_masuk_no_dokumen_no_paket" class="el_penerimaan_paket_masuk_no_dokumen_no_paket">
                                                    <span<?= $Page->no_dokumen_no_paket->viewAttributes() ?>>
                                                        <?= $Page->no_dokumen_no_paket->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->jenis_dokumen->Visible) { // jenis_dokumen 
                                        ?>
                                            <td data-name="jenis_dokumen" <?= $Page->jenis_dokumen->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_penerimaan_paket_masuk_jenis_dokumen" class="el_penerimaan_paket_masuk_jenis_dokumen">
                                                    <span<?= $Page->jenis_dokumen->viewAttributes() ?>>
                                                        <?= $Page->jenis_dokumen->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->nama_pengirim->Visible) { // nama_pengirim 
                                        ?>
                                            <td data-name="nama_pengirim" <?= $Page->nama_pengirim->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_penerimaan_paket_masuk_nama_pengirim" class="el_penerimaan_paket_masuk_nama_pengirim">
                                                    <span<?= $Page->nama_pengirim->viewAttributes() ?>>
                                                        <?= $Page->nama_pengirim->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->nama_penerima->Visible) { // nama_penerima 
                                        ?>
                                            <td data-name="nama_penerima" <?= $Page->nama_penerima->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_penerimaan_paket_masuk_nama_penerima" class="el_penerimaan_paket_masuk_nama_penerima">
                                                    <span<?= $Page->nama_penerima->viewAttributes() ?>>
                                                        <?= $Page->nama_penerima->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->email_penerima->Visible) { // email_penerima 
                                        ?>
                                            <td data-name="email_penerima" <?= $Page->email_penerima->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_penerimaan_paket_masuk_email_penerima" class="el_penerimaan_paket_masuk_email_penerima">
                                                    <span<?= $Page->email_penerima->viewAttributes() ?>>
                                                        <?= $Page->email_penerima->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->no_hp_penerima->Visible) { // no_hp_penerima 
                                        ?>
                                            <td data-name="no_hp_penerima" <?= $Page->no_hp_penerima->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_penerimaan_paket_masuk_no_hp_penerima" class="el_penerimaan_paket_masuk_no_hp_penerima">
                                                    <span<?= $Page->no_hp_penerima->viewAttributes() ?>>
                                                        <?= $Page->no_hp_penerima->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->status->Visible) { // status 
                                        ?>
                                            <td data-name="status" <?= $Page->status->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_penerimaan_paket_masuk_status" class="el_penerimaan_paket_masuk_status">
                                                    <span<?= $Page->status->viewAttributes() ?>>
                                                        <?= $Page->status->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->tanggal_terima->Visible) { // tanggal_terima 
                                        ?>
                                            <td data-name="tanggal_terima" <?= $Page->tanggal_terima->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_penerimaan_paket_masuk_tanggal_terima" class="el_penerimaan_paket_masuk_tanggal_terima">
                                                    <span<?= $Page->tanggal_terima->viewAttributes() ?>>
                                                        <?= $Page->tanggal_terima->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->bukti_penerimaan->Visible) { // bukti_penerimaan 
                                        ?>
                                            <td data-name="bukti_penerimaan" <?= $Page->bukti_penerimaan->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_penerimaan_paket_masuk_bukti_penerimaan" class="el_penerimaan_paket_masuk_bukti_penerimaan">
                                                    <span>
                                                        <?= GetFileViewTag($Page->bukti_penerimaan, $Page->bukti_penerimaan->getViewValue(), false) ?>
                                                    </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->diterima_oleh->Visible) { // diterima_oleh 
                                        ?>
                                            <td data-name="diterima_oleh" <?= $Page->diterima_oleh->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_penerimaan_paket_masuk_diterima_oleh" class="el_penerimaan_paket_masuk_diterima_oleh">
                                                    <span<?= $Page->diterima_oleh->viewAttributes() ?>>
                                                        <?= $Page->diterima_oleh->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->id_user->Visible) { // id_user 
                                        ?>
                                            <td data-name="id_user" <?= $Page->id_user->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_penerimaan_paket_masuk_id_user" class="el_penerimaan_paket_masuk_id_user">
                                                    <span<?= $Page->id_user->viewAttributes() ?>>
                                                        <?= $Page->id_user->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->created_date->Visible) { // created_date 
                                        ?>
                                            <td data-name="created_date" <?= $Page->created_date->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_penerimaan_paket_masuk_created_date" class="el_penerimaan_paket_masuk_created_date">
                                                    <span<?= $Page->created_date->viewAttributes() ?>>
                                                        <?= $Page->created_date->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->update_by->Visible) { // update_by 
                                        ?>
                                            <td data-name="update_by" <?= $Page->update_by->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_penerimaan_paket_masuk_update_by" class="el_penerimaan_paket_masuk_update_by">
                                                    <span<?= $Page->update_by->viewAttributes() ?>>
                                                        <?= $Page->update_by->getViewValue() ?>
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
            ew.addEventHandlers("penerimaan_paket_masuk");
        });
    </script>
    <script>
        loadjs.ready("load", function() {
            // Write your table-specific startup script here, no need to add script tags.
        });
    </script>
<?php } ?>