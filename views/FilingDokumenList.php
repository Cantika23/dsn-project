<?php

namespace Mitral2022\DSN2;

// Page object
$FilingDokumenList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
    <script>
        var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
        ew.deepAssign(ew.vars, {
            tables: {
                filing_dokumen: currentTable
            }
        });
        var currentForm, currentPageID;
        var ffiling_dokumenlist;
        loadjs.ready(["wrapper", "head"], function() {
            var $ = jQuery;
            // Form object
            ffiling_dokumenlist = new ew.Form("ffiling_dokumenlist", "list");
            currentPageID = ew.PAGE_ID = "list";
            currentForm = ffiling_dokumenlist;
            ffiling_dokumenlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

            // Dynamic selection lists
            ffiling_dokumenlist.lists.no_box = <?= $Page->no_box->toClientList($Page) ?>;
            ffiling_dokumenlist.lists.kode_pt = <?= $Page->kode_pt->toClientList($Page) ?>;
            ffiling_dokumenlist.lists.kode_department = <?= $Page->kode_department->toClientList($Page) ?>;
            ffiling_dokumenlist.lists.lokasi = <?= $Page->lokasi->toClientList($Page) ?>;
            ffiling_dokumenlist.lists.nama_dokumen = <?= $Page->nama_dokumen->toClientList($Page) ?>;
            ffiling_dokumenlist.lists.tahun_pembuatan_dokumen = <?= $Page->tahun_pembuatan_dokumen->toClientList($Page) ?>;
            ffiling_dokumenlist.lists.deskripsi = <?= $Page->deskripsi->toClientList($Page) ?>;
            ffiling_dokumenlist.lists.no_gudang = <?= $Page->no_gudang->toClientList($Page) ?>;
            ffiling_dokumenlist.lists.no_rak = <?= $Page->no_rak->toClientList($Page) ?>;
            ffiling_dokumenlist.lists.file = <?= $Page->file->toClientList($Page) ?>;
            ffiling_dokumenlist.lists.masa_berlaku = <?= $Page->masa_berlaku->toClientList($Page) ?>;
            loadjs.done("ffiling_dokumenlist");
        });
        var ffiling_dokumensrch, currentSearchForm, currentAdvancedSearchForm;
        loadjs.ready(["wrapper", "head"], function() {
            var $ = jQuery;
            // Form object for search
            ffiling_dokumensrch = new ew.Form("ffiling_dokumensrch", "list");
            currentSearchForm = ffiling_dokumensrch;

            // Add fields
            var fields = currentTable.fields;
            ffiling_dokumensrch.addFields([
                ["no_box", [], fields.no_box.isInvalid],
                ["kode_pt", [], fields.kode_pt.isInvalid],
                ["kode_department", [], fields.kode_department.isInvalid],
                ["lokasi", [], fields.lokasi.isInvalid],
                ["nama_dokumen", [], fields.nama_dokumen.isInvalid],
                ["tahun_pembuatan_dokumen", [], fields.tahun_pembuatan_dokumen.isInvalid],
                ["deskripsi", [], fields.deskripsi.isInvalid],
                ["id", [], fields.id.isInvalid],
                ["no_gudang", [], fields.no_gudang.isInvalid],
                ["no_rak", [], fields.no_rak.isInvalid],
                ["file", [], fields.file.isInvalid],
                ["masa_berlaku", [], fields.masa_berlaku.isInvalid]
            ]);

            // Validate form
            ffiling_dokumensrch.validate = function() {
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
            ffiling_dokumensrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
                // Your custom validation code here, return false if invalid.
                return true;
            }

            // Use JavaScript validation or not
            ffiling_dokumensrch.validateRequired = ew.CLIENT_VALIDATE;

            // Dynamic selection lists
            ffiling_dokumensrch.lists.no_box = <?= $Page->no_box->toClientList($Page) ?>;
            ffiling_dokumensrch.lists.kode_pt = <?= $Page->kode_pt->toClientList($Page) ?>;
            ffiling_dokumensrch.lists.kode_department = <?= $Page->kode_department->toClientList($Page) ?>;
            ffiling_dokumensrch.lists.lokasi = <?= $Page->lokasi->toClientList($Page) ?>;
            ffiling_dokumensrch.lists.nama_dokumen = <?= $Page->nama_dokumen->toClientList($Page) ?>;
            ffiling_dokumensrch.lists.tahun_pembuatan_dokumen = <?= $Page->tahun_pembuatan_dokumen->toClientList($Page) ?>;
            ffiling_dokumensrch.lists.deskripsi = <?= $Page->deskripsi->toClientList($Page) ?>;
            ffiling_dokumensrch.lists.no_gudang = <?= $Page->no_gudang->toClientList($Page) ?>;
            ffiling_dokumensrch.lists.no_rak = <?= $Page->no_rak->toClientList($Page) ?>;
            ffiling_dokumensrch.lists.file = <?= $Page->file->toClientList($Page) ?>;
            ffiling_dokumensrch.lists.masa_berlaku = <?= $Page->masa_berlaku->toClientList($Page) ?>;

            // Filters
            ffiling_dokumensrch.filterList = <?= $Page->getFilterList() ?>;
            loadjs.done("ffiling_dokumensrch");
        });
    </script>
    <script>
        loadjs.ready("head", function() {
            // Client script
            // Write your table-specific client script here, no need to add script tags.
            $("#elh_filing_dokumen_sequence").text("Nomor Urut");
            $('#tbl_filing_dokumenlist tr').each(function(index) {
                // Get the ID from the data cell
                var id = $(this).find('.el_filing_dokumen_id').text();

                // Create a Bootstrap button link with the dynamic param1 attribute
                var buttonHtml = '<a class="btn btn-secondary" target="_blank" href="views/Printcode.php?param1=' + id + '">PRINT</a>';

                // Replace the content of the column with the button link
                $(this).find('.el_filing_dokumen_id').html(buttonHtml);
            });
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
        <form name="ffiling_dokumensrch" id="ffiling_dokumensrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
            <div id="ffiling_dokumensrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
                <input type="hidden" name="cmd" value="search">
                <input type="hidden" name="t" value="filing_dokumen">
                <div class="ew-extended-search container-fluid">
                    <div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
                        <?php
                        // Render search row
                        $Page->RowType = ROWTYPE_SEARCH;
                        $Page->resetAttributes();
                        $Page->renderRow();
                        ?>
                        <?php if ($Page->no_box->Visible) { // no_box 
                        ?>
                            <?php
                            if (!$Page->no_box->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_no_box" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->no_box->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_no_box" name="x_no_box[]" class="form-control ew-select<?= $Page->no_box->isInvalidClass() ?>" data-select2-id="ffiling_dokumensrch_x_no_box" data-table="filing_dokumen" data-field="x_no_box" data-caption="<?= HtmlEncode(RemoveHtml($Page->no_box->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->no_box->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->no_box->getPlaceHolder()) ?>" <?= $Page->no_box->editAttributes() ?>>
                                    <?= $Page->no_box->selectOptionListHtml("x_no_box", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->no_box->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("ffiling_dokumensrch", function() {
                                        var options = {
                                            name: "x_no_box",
                                            selectId: "ffiling_dokumensrch_x_no_box",
                                            ajax: {
                                                id: "x_no_box",
                                                form: "ffiling_dokumensrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.filing_dokumen.fields.no_box.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->kode_pt->Visible) { // kode_pt 
                        ?>
                            <?php
                            if (!$Page->kode_pt->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_kode_pt" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->kode_pt->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_kode_pt" name="x_kode_pt[]" class="form-control ew-select<?= $Page->kode_pt->isInvalidClass() ?>" data-select2-id="ffiling_dokumensrch_x_kode_pt" data-table="filing_dokumen" data-field="x_kode_pt" data-caption="<?= HtmlEncode(RemoveHtml($Page->kode_pt->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->kode_pt->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->kode_pt->getPlaceHolder()) ?>" <?= $Page->kode_pt->editAttributes() ?>>
                                    <?= $Page->kode_pt->selectOptionListHtml("x_kode_pt", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->kode_pt->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("ffiling_dokumensrch", function() {
                                        var options = {
                                            name: "x_kode_pt",
                                            selectId: "ffiling_dokumensrch_x_kode_pt",
                                            ajax: {
                                                id: "x_kode_pt",
                                                form: "ffiling_dokumensrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.filing_dokumen.fields.kode_pt.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->kode_department->Visible) { // kode_department 
                        ?>
                            <?php
                            if (!$Page->kode_department->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_kode_department" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->kode_department->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_kode_department" name="x_kode_department[]" class="form-control ew-select<?= $Page->kode_department->isInvalidClass() ?>" data-select2-id="ffiling_dokumensrch_x_kode_department" data-table="filing_dokumen" data-field="x_kode_department" data-caption="<?= HtmlEncode(RemoveHtml($Page->kode_department->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->kode_department->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->kode_department->getPlaceHolder()) ?>" <?= $Page->kode_department->editAttributes() ?>>
                                    <?= $Page->kode_department->selectOptionListHtml("x_kode_department", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->kode_department->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("ffiling_dokumensrch", function() {
                                        var options = {
                                            name: "x_kode_department",
                                            selectId: "ffiling_dokumensrch_x_kode_department",
                                            ajax: {
                                                id: "x_kode_department",
                                                form: "ffiling_dokumensrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.filing_dokumen.fields.kode_department.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->lokasi->Visible) { // lokasi 
                        ?>
                            <?php
                            if (!$Page->lokasi->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_lokasi" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->lokasi->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_lokasi" name="x_lokasi[]" class="form-control ew-select<?= $Page->lokasi->isInvalidClass() ?>" data-select2-id="ffiling_dokumensrch_x_lokasi" data-table="filing_dokumen" data-field="x_lokasi" data-caption="<?= HtmlEncode(RemoveHtml($Page->lokasi->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->lokasi->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->lokasi->getPlaceHolder()) ?>" <?= $Page->lokasi->editAttributes() ?>>
                                    <?= $Page->lokasi->selectOptionListHtml("x_lokasi", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->lokasi->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("ffiling_dokumensrch", function() {
                                        var options = {
                                            name: "x_lokasi",
                                            selectId: "ffiling_dokumensrch_x_lokasi",
                                            ajax: {
                                                id: "x_lokasi",
                                                form: "ffiling_dokumensrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.filing_dokumen.fields.lokasi.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->nama_dokumen->Visible) { // nama_dokumen 
                        ?>
                            <?php
                            if (!$Page->nama_dokumen->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_nama_dokumen" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->nama_dokumen->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_nama_dokumen" name="x_nama_dokumen[]" class="form-control ew-select<?= $Page->nama_dokumen->isInvalidClass() ?>" data-select2-id="ffiling_dokumensrch_x_nama_dokumen" data-table="filing_dokumen" data-field="x_nama_dokumen" data-caption="<?= HtmlEncode(RemoveHtml($Page->nama_dokumen->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->nama_dokumen->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->nama_dokumen->getPlaceHolder()) ?>" <?= $Page->nama_dokumen->editAttributes() ?>>
                                    <?= $Page->nama_dokumen->selectOptionListHtml("x_nama_dokumen", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->nama_dokumen->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("ffiling_dokumensrch", function() {
                                        var options = {
                                            name: "x_nama_dokumen",
                                            selectId: "ffiling_dokumensrch_x_nama_dokumen",
                                            ajax: {
                                                id: "x_nama_dokumen",
                                                form: "ffiling_dokumensrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.filing_dokumen.fields.nama_dokumen.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->tahun_pembuatan_dokumen->Visible) { // tahun_pembuatan_dokumen 
                        ?>
                            <?php
                            if (!$Page->tahun_pembuatan_dokumen->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_tahun_pembuatan_dokumen" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->tahun_pembuatan_dokumen->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_tahun_pembuatan_dokumen" name="x_tahun_pembuatan_dokumen[]" class="form-control ew-select<?= $Page->tahun_pembuatan_dokumen->isInvalidClass() ?>" data-select2-id="ffiling_dokumensrch_x_tahun_pembuatan_dokumen" data-table="filing_dokumen" data-field="x_tahun_pembuatan_dokumen" data-caption="<?= HtmlEncode(RemoveHtml($Page->tahun_pembuatan_dokumen->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->tahun_pembuatan_dokumen->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->tahun_pembuatan_dokumen->getPlaceHolder()) ?>" <?= $Page->tahun_pembuatan_dokumen->editAttributes() ?>>
                                    <?= $Page->tahun_pembuatan_dokumen->selectOptionListHtml("x_tahun_pembuatan_dokumen", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->tahun_pembuatan_dokumen->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("ffiling_dokumensrch", function() {
                                        var options = {
                                            name: "x_tahun_pembuatan_dokumen",
                                            selectId: "ffiling_dokumensrch_x_tahun_pembuatan_dokumen",
                                            ajax: {
                                                id: "x_tahun_pembuatan_dokumen",
                                                form: "ffiling_dokumensrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.filing_dokumen.fields.tahun_pembuatan_dokumen.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->deskripsi->Visible) { // deskripsi 
                        ?>
                            <?php
                            if (!$Page->deskripsi->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_deskripsi" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->deskripsi->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_deskripsi" name="x_deskripsi[]" class="form-control ew-select<?= $Page->deskripsi->isInvalidClass() ?>" data-select2-id="ffiling_dokumensrch_x_deskripsi" data-table="filing_dokumen" data-field="x_deskripsi" data-caption="<?= HtmlEncode(RemoveHtml($Page->deskripsi->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->deskripsi->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->deskripsi->getPlaceHolder()) ?>" <?= $Page->deskripsi->editAttributes() ?>>
                                    <?= $Page->deskripsi->selectOptionListHtml("x_deskripsi", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->deskripsi->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("ffiling_dokumensrch", function() {
                                        var options = {
                                            name: "x_deskripsi",
                                            selectId: "ffiling_dokumensrch_x_deskripsi",
                                            ajax: {
                                                id: "x_deskripsi",
                                                form: "ffiling_dokumensrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.filing_dokumen.fields.deskripsi.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->no_gudang->Visible) { // no_gudang 
                        ?>
                            <?php
                            if (!$Page->no_gudang->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_no_gudang" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->no_gudang->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_no_gudang" name="x_no_gudang[]" class="form-control ew-select<?= $Page->no_gudang->isInvalidClass() ?>" data-select2-id="ffiling_dokumensrch_x_no_gudang" data-table="filing_dokumen" data-field="x_no_gudang" data-caption="<?= HtmlEncode(RemoveHtml($Page->no_gudang->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->no_gudang->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->no_gudang->getPlaceHolder()) ?>" <?= $Page->no_gudang->editAttributes() ?>>
                                    <?= $Page->no_gudang->selectOptionListHtml("x_no_gudang", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->no_gudang->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("ffiling_dokumensrch", function() {
                                        var options = {
                                            name: "x_no_gudang",
                                            selectId: "ffiling_dokumensrch_x_no_gudang",
                                            ajax: {
                                                id: "x_no_gudang",
                                                form: "ffiling_dokumensrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.filing_dokumen.fields.no_gudang.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->no_rak->Visible) { // no_rak 
                        ?>
                            <?php
                            if (!$Page->no_rak->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_no_rak" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->no_rak->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_no_rak" name="x_no_rak[]" class="form-control ew-select<?= $Page->no_rak->isInvalidClass() ?>" data-select2-id="ffiling_dokumensrch_x_no_rak" data-table="filing_dokumen" data-field="x_no_rak" data-caption="<?= HtmlEncode(RemoveHtml($Page->no_rak->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->no_rak->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->no_rak->getPlaceHolder()) ?>" <?= $Page->no_rak->editAttributes() ?>>
                                    <?= $Page->no_rak->selectOptionListHtml("x_no_rak", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->no_rak->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("ffiling_dokumensrch", function() {
                                        var options = {
                                            name: "x_no_rak",
                                            selectId: "ffiling_dokumensrch_x_no_rak",
                                            ajax: {
                                                id: "x_no_rak",
                                                form: "ffiling_dokumensrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.filing_dokumen.fields.no_rak.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->file->Visible) { // file 
                        ?>
                            <?php
                            if (!$Page->file->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_file" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->file->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_file" name="x_file[]" class="form-control ew-select<?= $Page->file->isInvalidClass() ?>" data-select2-id="ffiling_dokumensrch_x_file" data-table="filing_dokumen" data-field="x_file" data-caption="<?= HtmlEncode(RemoveHtml($Page->file->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->file->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->file->getPlaceHolder()) ?>" <?= $Page->file->editAttributes() ?>>
                                    <?= $Page->file->selectOptionListHtml("x_file", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->file->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("ffiling_dokumensrch", function() {
                                        var options = {
                                            name: "x_file",
                                            selectId: "ffiling_dokumensrch_x_file",
                                            ajax: {
                                                id: "x_file",
                                                form: "ffiling_dokumensrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.filing_dokumen.fields.file.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->masa_berlaku->Visible) { // masa_berlaku 
                        ?>
                            <?php
                            if (!$Page->masa_berlaku->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_masa_berlaku" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->masa_berlaku->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_masa_berlaku" name="x_masa_berlaku[]" class="form-control ew-select<?= $Page->masa_berlaku->isInvalidClass() ?>" data-select2-id="ffiling_dokumensrch_x_masa_berlaku" data-table="filing_dokumen" data-field="x_masa_berlaku" data-caption="<?= HtmlEncode(RemoveHtml($Page->masa_berlaku->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->masa_berlaku->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->masa_berlaku->getPlaceHolder()) ?>" <?= $Page->masa_berlaku->editAttributes() ?>>
                                    <?= $Page->masa_berlaku->selectOptionListHtml("x_masa_berlaku", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->masa_berlaku->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("ffiling_dokumensrch", function() {
                                        var options = {
                                            name: "x_masa_berlaku",
                                            selectId: "ffiling_dokumensrch_x_masa_berlaku",
                                            ajax: {
                                                id: "x_masa_berlaku",
                                                form: "ffiling_dokumensrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.filing_dokumen.fields.masa_berlaku.filterOptions);
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
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="ffiling_dokumensrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="ffiling_dokumensrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="ffiling_dokumensrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="ffiling_dokumensrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
    <div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> filing_dokumen">
        <form name="ffiling_dokumenlist" id="ffiling_dokumenlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
            <?php if (Config("CHECK_TOKEN")) { ?>
                <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
                <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
            <?php } ?>
            <input type="hidden" name="t" value="filing_dokumen">
            <div id="gmp_filing_dokumen" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
                <?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
                    <table id="tbl_filing_dokumenlist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
                                <?php if ($Page->no_box->Visible) { // no_box 
                                ?>
                                    <th data-name="no_box" class="<?= $Page->no_box->headerCellClass() ?>">
                                        <div id="elh_filing_dokumen_no_box" class="filing_dokumen_no_box"><?= $Page->renderFieldHeader($Page->no_box) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->kode_pt->Visible) { // kode_pt 
                                ?>
                                    <th data-name="kode_pt" class="<?= $Page->kode_pt->headerCellClass() ?>">
                                        <div id="elh_filing_dokumen_kode_pt" class="filing_dokumen_kode_pt"><?= $Page->renderFieldHeader($Page->kode_pt) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->kode_department->Visible) { // kode_department 
                                ?>
                                    <th data-name="kode_department" class="<?= $Page->kode_department->headerCellClass() ?>">
                                        <div id="elh_filing_dokumen_kode_department" class="filing_dokumen_kode_department"><?= $Page->renderFieldHeader($Page->kode_department) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->lokasi->Visible) { // lokasi 
                                ?>
                                    <th data-name="lokasi" class="<?= $Page->lokasi->headerCellClass() ?>">
                                        <div id="elh_filing_dokumen_lokasi" class="filing_dokumen_lokasi"><?= $Page->renderFieldHeader($Page->lokasi) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->nama_dokumen->Visible) { // nama_dokumen 
                                ?>
                                    <th data-name="nama_dokumen" class="<?= $Page->nama_dokumen->headerCellClass() ?>">
                                        <div id="elh_filing_dokumen_nama_dokumen" class="filing_dokumen_nama_dokumen"><?= $Page->renderFieldHeader($Page->nama_dokumen) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->tahun_pembuatan_dokumen->Visible) { // tahun_pembuatan_dokumen 
                                ?>
                                    <th data-name="tahun_pembuatan_dokumen" class="<?= $Page->tahun_pembuatan_dokumen->headerCellClass() ?>">
                                        <div id="elh_filing_dokumen_tahun_pembuatan_dokumen" class="filing_dokumen_tahun_pembuatan_dokumen"><?= $Page->renderFieldHeader($Page->tahun_pembuatan_dokumen) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->deskripsi->Visible) { // deskripsi 
                                ?>
                                    <th data-name="deskripsi" class="<?= $Page->deskripsi->headerCellClass() ?>">
                                        <div id="elh_filing_dokumen_deskripsi" class="filing_dokumen_deskripsi"><?= $Page->renderFieldHeader($Page->deskripsi) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->id->Visible) { // id 
                                ?>
                                    <th data-name="id" class="<?= $Page->id->headerCellClass() ?>" style="white-space: nowrap;">
                                        <div id="elh_filing_dokumen_id" class="filing_dokumen_id"><?= $Page->renderFieldHeader($Page->id) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->no_gudang->Visible) { // no_gudang 
                                ?>
                                    <th data-name="no_gudang" class="<?= $Page->no_gudang->headerCellClass() ?>">
                                        <div id="elh_filing_dokumen_no_gudang" class="filing_dokumen_no_gudang"><?= $Page->renderFieldHeader($Page->no_gudang) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->no_rak->Visible) { // no_rak 
                                ?>
                                    <th data-name="no_rak" class="<?= $Page->no_rak->headerCellClass() ?>">
                                        <div id="elh_filing_dokumen_no_rak" class="filing_dokumen_no_rak"><?= $Page->renderFieldHeader($Page->no_rak) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->file->Visible) { // file 
                                ?>
                                    <th data-name="file" class="<?= $Page->file->headerCellClass() ?>">
                                        <div id="elh_filing_dokumen_file" class="filing_dokumen_file"><?= $Page->renderFieldHeader($Page->file) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->masa_berlaku->Visible) { // masa_berlaku 
                                ?>
                                    <th data-name="masa_berlaku" class="<?= $Page->masa_berlaku->headerCellClass() ?>">
                                        <div id="elh_filing_dokumen_masa_berlaku" class="filing_dokumen_masa_berlaku"><?= $Page->renderFieldHeader($Page->masa_berlaku) ?></div>
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
                                        "id" => "r" . $Page->RowCount . "_filing_dokumen",
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
                                        <?php if ($Page->no_box->Visible) { // no_box 
                                        ?>
                                            <td data-name="no_box" <?= $Page->no_box->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_filing_dokumen_no_box" class="el_filing_dokumen_no_box">
                                                    <span<?= $Page->no_box->viewAttributes() ?>>
                                                        <?= $Page->no_box->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->kode_pt->Visible) { // kode_pt 
                                        ?>
                                            <td data-name="kode_pt" <?= $Page->kode_pt->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_filing_dokumen_kode_pt" class="el_filing_dokumen_kode_pt">
                                                    <span<?= $Page->kode_pt->viewAttributes() ?>>
                                                        <?= $Page->kode_pt->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->kode_department->Visible) { // kode_department 
                                        ?>
                                            <td data-name="kode_department" <?= $Page->kode_department->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_filing_dokumen_kode_department" class="el_filing_dokumen_kode_department">
                                                    <span<?= $Page->kode_department->viewAttributes() ?>>
                                                        <?= $Page->kode_department->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->lokasi->Visible) { // lokasi 
                                        ?>
                                            <td data-name="lokasi" <?= $Page->lokasi->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_filing_dokumen_lokasi" class="el_filing_dokumen_lokasi">
                                                    <span<?= $Page->lokasi->viewAttributes() ?>>
                                                        <?= $Page->lokasi->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->nama_dokumen->Visible) { // nama_dokumen 
                                        ?>
                                            <td data-name="nama_dokumen" <?= $Page->nama_dokumen->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_filing_dokumen_nama_dokumen" class="el_filing_dokumen_nama_dokumen">
                                                    <span<?= $Page->nama_dokumen->viewAttributes() ?>>
                                                        <?= $Page->nama_dokumen->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->tahun_pembuatan_dokumen->Visible) { // tahun_pembuatan_dokumen 
                                        ?>
                                            <td data-name="tahun_pembuatan_dokumen" <?= $Page->tahun_pembuatan_dokumen->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_filing_dokumen_tahun_pembuatan_dokumen" class="el_filing_dokumen_tahun_pembuatan_dokumen">
                                                    <span<?= $Page->tahun_pembuatan_dokumen->viewAttributes() ?>>
                                                        <?= $Page->tahun_pembuatan_dokumen->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->deskripsi->Visible) { // deskripsi 
                                        ?>
                                            <td data-name="deskripsi" <?= $Page->deskripsi->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_filing_dokumen_deskripsi" class="el_filing_dokumen_deskripsi">
                                                    <span<?= $Page->deskripsi->viewAttributes() ?>>
                                                        <?= $Page->deskripsi->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->id->Visible) { // id 
                                        ?>
                                            <td data-name="id" <?= $Page->id->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_filing_dokumen_id" class="el_filing_dokumen_id">
                                                    <span<?= $Page->id->viewAttributes() ?>>
                                                        <?= $Page->id->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->no_gudang->Visible) { // no_gudang 
                                        ?>
                                            <td data-name="no_gudang" <?= $Page->no_gudang->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_filing_dokumen_no_gudang" class="el_filing_dokumen_no_gudang">
                                                    <span<?= $Page->no_gudang->viewAttributes() ?>>
                                                        <?= $Page->no_gudang->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->no_rak->Visible) { // no_rak 
                                        ?>
                                            <td data-name="no_rak" <?= $Page->no_rak->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_filing_dokumen_no_rak" class="el_filing_dokumen_no_rak">
                                                    <span<?= $Page->no_rak->viewAttributes() ?>>
                                                        <?= $Page->no_rak->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->file->Visible) { // file 
                                        ?>
                                            <td data-name="file" <?= $Page->file->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_filing_dokumen_file" class="el_filing_dokumen_file">
                                                    <span>
                                                        <?= GetFileViewTag($Page->file, $Page->file->getViewValue(), false) ?>
                                                    </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->masa_berlaku->Visible) { // masa_berlaku 
                                        ?>
                                            <td data-name="masa_berlaku" <?= $Page->masa_berlaku->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_filing_dokumen_masa_berlaku" class="el_filing_dokumen_masa_berlaku">
                                                    <span<?= $Page->masa_berlaku->viewAttributes() ?>>
                                                        <?= $Page->masa_berlaku->getViewValue() ?>
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
            ew.addEventHandlers("filing_dokumen");
        });
    </script>
    <script>
        loadjs.ready("load", function() {
            // Write your table-specific startup script here, no need to add script tags.
        });
    </script>
<?php } ?>