<?php

namespace Mitral2022\DSN2;

// Page object
$VPenerimaanPaketKeluarShowNamaUserList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
    <script>
        var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
        ew.deepAssign(ew.vars, {
            tables: {
                v_penerimaan_paket_keluar_show_nama_user: currentTable
            }
        });
        var currentForm, currentPageID;
        var fv_penerimaan_paket_keluar_show_nama_userlist;
        loadjs.ready(["wrapper", "head"], function() {
            var $ = jQuery;
            // Form object
            fv_penerimaan_paket_keluar_show_nama_userlist = new ew.Form("fv_penerimaan_paket_keluar_show_nama_userlist", "list");
            currentPageID = ew.PAGE_ID = "list";
            currentForm = fv_penerimaan_paket_keluar_show_nama_userlist;
            fv_penerimaan_paket_keluar_show_nama_userlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";

            // Dynamic selection lists
            fv_penerimaan_paket_keluar_show_nama_userlist.lists.no_dokumen_no_paket = <?= $Page->no_dokumen_no_paket->toClientList($Page) ?>;
            fv_penerimaan_paket_keluar_show_nama_userlist.lists.jenis_dokumen = <?= $Page->jenis_dokumen->toClientList($Page) ?>;
            fv_penerimaan_paket_keluar_show_nama_userlist.lists.tujuan_penerima = <?= $Page->tujuan_penerima->toClientList($Page) ?>;
            fv_penerimaan_paket_keluar_show_nama_userlist.lists.no_hp_penerima = <?= $Page->no_hp_penerima->toClientList($Page) ?>;
            fv_penerimaan_paket_keluar_show_nama_userlist.lists.email_penerima = <?= $Page->email_penerima->toClientList($Page) ?>;
            fv_penerimaan_paket_keluar_show_nama_userlist.lists.status = <?= $Page->status->toClientList($Page) ?>;
            fv_penerimaan_paket_keluar_show_nama_userlist.lists.tanggal_terima = <?= $Page->tanggal_terima->toClientList($Page) ?>;
            fv_penerimaan_paket_keluar_show_nama_userlist.lists.jenis_pengirim = <?= $Page->jenis_pengirim->toClientList($Page) ?>;
            fv_penerimaan_paket_keluar_show_nama_userlist.lists.nama_kurir = <?= $Page->nama_kurir->toClientList($Page) ?>;
            fv_penerimaan_paket_keluar_show_nama_userlist.lists.no_awb = <?= $Page->no_awb->toClientList($Page) ?>;
            fv_penerimaan_paket_keluar_show_nama_userlist.lists.employee_name = <?= $Page->employee_name->toClientList($Page) ?>;
            fv_penerimaan_paket_keluar_show_nama_userlist.lists.created_date = <?= $Page->created_date->toClientList($Page) ?>;
            fv_penerimaan_paket_keluar_show_nama_userlist.lists.bukti_penerimaan = <?= $Page->bukti_penerimaan->toClientList($Page) ?>;
            fv_penerimaan_paket_keluar_show_nama_userlist.lists.nama_penerima = <?= $Page->nama_penerima->toClientList($Page) ?>;
            fv_penerimaan_paket_keluar_show_nama_userlist.lists.status_sap = <?= $Page->status_sap->toClientList($Page) ?>;
            loadjs.done("fv_penerimaan_paket_keluar_show_nama_userlist");
        });
        var fv_penerimaan_paket_keluar_show_nama_usersrch, currentSearchForm, currentAdvancedSearchForm;
        loadjs.ready(["wrapper", "head"], function() {
            var $ = jQuery;
            // Form object for search
            fv_penerimaan_paket_keluar_show_nama_usersrch = new ew.Form("fv_penerimaan_paket_keluar_show_nama_usersrch", "list");
            currentSearchForm = fv_penerimaan_paket_keluar_show_nama_usersrch;

            // Add fields
            var fields = currentTable.fields;
            fv_penerimaan_paket_keluar_show_nama_usersrch.addFields([
                ["no_dokumen_no_paket", [], fields.no_dokumen_no_paket.isInvalid],
                ["jenis_dokumen", [], fields.jenis_dokumen.isInvalid],
                ["tujuan_penerima", [], fields.tujuan_penerima.isInvalid],
                ["no_hp_penerima", [], fields.no_hp_penerima.isInvalid],
                ["email_penerima", [], fields.email_penerima.isInvalid],
                ["id", [], fields.id.isInvalid],
                ["status", [], fields.status.isInvalid],
                ["tanggal_terima", [], fields.tanggal_terima.isInvalid],
                ["jenis_pengirim", [], fields.jenis_pengirim.isInvalid],
                ["nama_kurir", [], fields.nama_kurir.isInvalid],
                ["no_awb", [], fields.no_awb.isInvalid],
                ["employee_name", [], fields.employee_name.isInvalid],
                ["created_date", [], fields.created_date.isInvalid],
                ["bukti_penerimaan", [], fields.bukti_penerimaan.isInvalid],
                ["nama_penerima", [], fields.nama_penerima.isInvalid],
                ["status_sap", [], fields.status_sap.isInvalid]
            ]);

            // Validate form
            fv_penerimaan_paket_keluar_show_nama_usersrch.validate = function() {
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
            fv_penerimaan_paket_keluar_show_nama_usersrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
                // Your custom validation code here, return false if invalid.
                return true;
            }

            // Use JavaScript validation or not
            fv_penerimaan_paket_keluar_show_nama_usersrch.validateRequired = ew.CLIENT_VALIDATE;

            // Dynamic selection lists
            fv_penerimaan_paket_keluar_show_nama_usersrch.lists.no_dokumen_no_paket = <?= $Page->no_dokumen_no_paket->toClientList($Page) ?>;
            fv_penerimaan_paket_keluar_show_nama_usersrch.lists.jenis_dokumen = <?= $Page->jenis_dokumen->toClientList($Page) ?>;
            fv_penerimaan_paket_keluar_show_nama_usersrch.lists.tujuan_penerima = <?= $Page->tujuan_penerima->toClientList($Page) ?>;
            fv_penerimaan_paket_keluar_show_nama_usersrch.lists.no_hp_penerima = <?= $Page->no_hp_penerima->toClientList($Page) ?>;
            fv_penerimaan_paket_keluar_show_nama_usersrch.lists.email_penerima = <?= $Page->email_penerima->toClientList($Page) ?>;
            fv_penerimaan_paket_keluar_show_nama_usersrch.lists.status = <?= $Page->status->toClientList($Page) ?>;
            fv_penerimaan_paket_keluar_show_nama_usersrch.lists.tanggal_terima = <?= $Page->tanggal_terima->toClientList($Page) ?>;
            fv_penerimaan_paket_keluar_show_nama_usersrch.lists.jenis_pengirim = <?= $Page->jenis_pengirim->toClientList($Page) ?>;
            fv_penerimaan_paket_keluar_show_nama_usersrch.lists.nama_kurir = <?= $Page->nama_kurir->toClientList($Page) ?>;
            fv_penerimaan_paket_keluar_show_nama_usersrch.lists.no_awb = <?= $Page->no_awb->toClientList($Page) ?>;
            fv_penerimaan_paket_keluar_show_nama_usersrch.lists.employee_name = <?= $Page->employee_name->toClientList($Page) ?>;
            fv_penerimaan_paket_keluar_show_nama_usersrch.lists.created_date = <?= $Page->created_date->toClientList($Page) ?>;
            fv_penerimaan_paket_keluar_show_nama_usersrch.lists.bukti_penerimaan = <?= $Page->bukti_penerimaan->toClientList($Page) ?>;
            fv_penerimaan_paket_keluar_show_nama_usersrch.lists.nama_penerima = <?= $Page->nama_penerima->toClientList($Page) ?>;
            fv_penerimaan_paket_keluar_show_nama_usersrch.lists.status_sap = <?= $Page->status_sap->toClientList($Page) ?>;

            // Filters
            fv_penerimaan_paket_keluar_show_nama_usersrch.filterList = <?= $Page->getFilterList() ?>;
            loadjs.done("fv_penerimaan_paket_keluar_show_nama_usersrch");
        });
    </script>
    <script>
        loadjs.ready("head", function() {
            // Client script
            // Write your table-specific client script here, no need to add script tags.
            $("#elh_v_penerimaan_paket_keluar_show_nama_user_sequence").text("Nomor Urut");

            // Loop through each table row
            $('#tbl_v_penerimaan_paket_keluar_show_nama_userlist tr').each(function(index) {
                // Get the ID from the data cell
                var id = $(this).find('.el_v_penerimaan_paket_keluar_show_nama_user_id').text();

                // Create a Bootstrap button link with the dynamic param1 attribute
                var buttonHtml = '<a href="views/TujuanPenerima.php?param1=' + id + '" class="btn btn-secondary" target="_blank">PRINT</a>';

                // Replace the content of the column with the button link
                $(this).find('.el_v_penerimaan_paket_keluar_show_nama_user_id').html(buttonHtml);
            });
            var btnCheckCourier = $('<button>', {
                'name': 'btn-check-courier',
                'id': 'btn-check-courier',
                'class': 'btn btn-success',
                'text': 'Get Tanggal Terima'
            }).css({
                'margin-left': '10px'
            });
            $("#btn-submit").after(btnCheckCourier);

            // var parent_url = ew.PATH_BASE;
            $("#btn-check-courier").on('click', function(event) {
                event.preventDefault();
                $.ajax({
                    type: "GET",
                    url: 'https://gs.dsngroup.co.id/automate/main_process.php',
                    // url: 'http://localhost/cekresi/main_process.php',         
                    success: function(data) {
                        if (data != null) {
                            ew.alert("Status: " + data["status"] + "\nMessage: " + data["message"]);
                            $('.ew-swal2-confirm-button').click(function() {
                                //window.location.href = parent_url + 'penerimaanpaketkeluarlist';
                                location.reload();
                            });
                        }
                        // Handle the data returned from the server
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        // Handle the error
                        console.error("Error: " + errorThrown);
                    }
                });
            });
            var btnSyncSAP = $('<button>', {
                'name': 'btn-sync-sap',
                'id': 'btn-sync-sap',
                'class': 'btn btn-warning',
                'text': 'Sync with SAP'
            }).css({
                'margin-left': '10px'
            });
            $("#btn-check-courier").after(btnSyncSAP);
            var urls = [
                'https://devapps.dsngroup.co.id/interface_gs/api/get/sap',
                'https://gs.dsngroup.co.id/automate/curl_get_interface/main_process.php',
                // 'https://gs.dsngroup.co.id/automate/main_process.php',
                'https://gs.dsngroup.co.id/automate/send_json_to_interface/main_process.php',
                'https://devapps.dsngroup.co.id/interface_gs/api/send/sap'
            ];

            function executeRequestsSequentially(urls, index) {
                if (index < urls.length) {
                    $.ajax({
                        type: "GET",
                        url: urls[index]
                    }).then(function(response) {
                        console.log("Request to " + urls[index] + " succeeded:", response);
                        executeRequestsSequentially(urls, index + 1); // Make the next request
                    }).catch(function(xhr, textStatus, errorThrown) {
                        console.error("Request to " + urls[index] + " failed:", errorThrown);
                        executeRequestsSequentially(urls, index + 1); // Make the next request
                    });
                } else {
                    console.log("All AJAX requests are done!");
                    ew.alert("Data synced with SAP");
                    $('.ew-swal2-confirm-button').click(function() {
                        //window.location.href = parent_url + 'penerimaanpaketkeluarlist';
                        location.reload();
                    });
                }
            }
            $("#btn-sync-sap").on('click', function(event) {
                event.preventDefault();
                console.log("Button sync with SAP clicked!");
                executeRequestsSequentially(urls, 0); // Start executing requests
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
        <form name="fv_penerimaan_paket_keluar_show_nama_usersrch" id="fv_penerimaan_paket_keluar_show_nama_usersrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
            <div id="fv_penerimaan_paket_keluar_show_nama_usersrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
                <input type="hidden" name="cmd" value="search">
                <input type="hidden" name="t" value="v_penerimaan_paket_keluar_show_nama_user">
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
                                <select id="x_no_dokumen_no_paket" name="x_no_dokumen_no_paket[]" class="form-control ew-select<?= $Page->no_dokumen_no_paket->isInvalidClass() ?>" data-select2-id="fv_penerimaan_paket_keluar_show_nama_usersrch_x_no_dokumen_no_paket" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_no_dokumen_no_paket" data-caption="<?= HtmlEncode(RemoveHtml($Page->no_dokumen_no_paket->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->no_dokumen_no_paket->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->no_dokumen_no_paket->getPlaceHolder()) ?>" <?= $Page->no_dokumen_no_paket->editAttributes() ?>>
                                    <?= $Page->no_dokumen_no_paket->selectOptionListHtml("x_no_dokumen_no_paket", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->no_dokumen_no_paket->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fv_penerimaan_paket_keluar_show_nama_usersrch", function() {
                                        var options = {
                                            name: "x_no_dokumen_no_paket",
                                            selectId: "fv_penerimaan_paket_keluar_show_nama_usersrch_x_no_dokumen_no_paket",
                                            ajax: {
                                                id: "x_no_dokumen_no_paket",
                                                form: "fv_penerimaan_paket_keluar_show_nama_usersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.v_penerimaan_paket_keluar_show_nama_user.fields.no_dokumen_no_paket.filterOptions);
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
                                <select id="x_jenis_dokumen" name="x_jenis_dokumen[]" class="form-control ew-select<?= $Page->jenis_dokumen->isInvalidClass() ?>" data-select2-id="fv_penerimaan_paket_keluar_show_nama_usersrch_x_jenis_dokumen" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_jenis_dokumen" data-caption="<?= HtmlEncode(RemoveHtml($Page->jenis_dokumen->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->jenis_dokumen->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->jenis_dokumen->getPlaceHolder()) ?>" <?= $Page->jenis_dokumen->editAttributes() ?>>
                                    <?= $Page->jenis_dokumen->selectOptionListHtml("x_jenis_dokumen", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->jenis_dokumen->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fv_penerimaan_paket_keluar_show_nama_usersrch", function() {
                                        var options = {
                                            name: "x_jenis_dokumen",
                                            selectId: "fv_penerimaan_paket_keluar_show_nama_usersrch_x_jenis_dokumen",
                                            ajax: {
                                                id: "x_jenis_dokumen",
                                                form: "fv_penerimaan_paket_keluar_show_nama_usersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.v_penerimaan_paket_keluar_show_nama_user.fields.jenis_dokumen.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->tujuan_penerima->Visible) { // tujuan_penerima 
                        ?>
                            <?php
                            if (!$Page->tujuan_penerima->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_tujuan_penerima" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->tujuan_penerima->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_tujuan_penerima" name="x_tujuan_penerima[]" class="form-control ew-select<?= $Page->tujuan_penerima->isInvalidClass() ?>" data-select2-id="fv_penerimaan_paket_keluar_show_nama_usersrch_x_tujuan_penerima" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_tujuan_penerima" data-caption="<?= HtmlEncode(RemoveHtml($Page->tujuan_penerima->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->tujuan_penerima->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->tujuan_penerima->getPlaceHolder()) ?>" <?= $Page->tujuan_penerima->editAttributes() ?>>
                                    <?= $Page->tujuan_penerima->selectOptionListHtml("x_tujuan_penerima", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->tujuan_penerima->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fv_penerimaan_paket_keluar_show_nama_usersrch", function() {
                                        var options = {
                                            name: "x_tujuan_penerima",
                                            selectId: "fv_penerimaan_paket_keluar_show_nama_usersrch_x_tujuan_penerima",
                                            ajax: {
                                                id: "x_tujuan_penerima",
                                                form: "fv_penerimaan_paket_keluar_show_nama_usersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.v_penerimaan_paket_keluar_show_nama_user.fields.tujuan_penerima.filterOptions);
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
                                <select id="x_no_hp_penerima" name="x_no_hp_penerima[]" class="form-control ew-select<?= $Page->no_hp_penerima->isInvalidClass() ?>" data-select2-id="fv_penerimaan_paket_keluar_show_nama_usersrch_x_no_hp_penerima" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_no_hp_penerima" data-caption="<?= HtmlEncode(RemoveHtml($Page->no_hp_penerima->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->no_hp_penerima->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->no_hp_penerima->getPlaceHolder()) ?>" <?= $Page->no_hp_penerima->editAttributes() ?>>
                                    <?= $Page->no_hp_penerima->selectOptionListHtml("x_no_hp_penerima", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->no_hp_penerima->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fv_penerimaan_paket_keluar_show_nama_usersrch", function() {
                                        var options = {
                                            name: "x_no_hp_penerima",
                                            selectId: "fv_penerimaan_paket_keluar_show_nama_usersrch_x_no_hp_penerima",
                                            ajax: {
                                                id: "x_no_hp_penerima",
                                                form: "fv_penerimaan_paket_keluar_show_nama_usersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.v_penerimaan_paket_keluar_show_nama_user.fields.no_hp_penerima.filterOptions);
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
                                <select id="x_email_penerima" name="x_email_penerima[]" class="form-control ew-select<?= $Page->email_penerima->isInvalidClass() ?>" data-select2-id="fv_penerimaan_paket_keluar_show_nama_usersrch_x_email_penerima" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_email_penerima" data-caption="<?= HtmlEncode(RemoveHtml($Page->email_penerima->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->email_penerima->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->email_penerima->getPlaceHolder()) ?>" <?= $Page->email_penerima->editAttributes() ?>>
                                    <?= $Page->email_penerima->selectOptionListHtml("x_email_penerima", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->email_penerima->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fv_penerimaan_paket_keluar_show_nama_usersrch", function() {
                                        var options = {
                                            name: "x_email_penerima",
                                            selectId: "fv_penerimaan_paket_keluar_show_nama_usersrch_x_email_penerima",
                                            ajax: {
                                                id: "x_email_penerima",
                                                form: "fv_penerimaan_paket_keluar_show_nama_usersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.v_penerimaan_paket_keluar_show_nama_user.fields.email_penerima.filterOptions);
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
                                <select id="x_status" name="x_status[]" class="form-control ew-select<?= $Page->status->isInvalidClass() ?>" data-select2-id="fv_penerimaan_paket_keluar_show_nama_usersrch_x_status" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_status" data-caption="<?= HtmlEncode(RemoveHtml($Page->status->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->status->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>" <?= $Page->status->editAttributes() ?>>
                                    <?= $Page->status->selectOptionListHtml("x_status", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->status->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fv_penerimaan_paket_keluar_show_nama_usersrch", function() {
                                        var options = {
                                            name: "x_status",
                                            selectId: "fv_penerimaan_paket_keluar_show_nama_usersrch_x_status",
                                            ajax: {
                                                id: "x_status",
                                                form: "fv_penerimaan_paket_keluar_show_nama_usersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.v_penerimaan_paket_keluar_show_nama_user.fields.status.filterOptions);
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
                                <select id="x_tanggal_terima" name="x_tanggal_terima[]" class="form-control ew-select<?= $Page->tanggal_terima->isInvalidClass() ?>" data-select2-id="fv_penerimaan_paket_keluar_show_nama_usersrch_x_tanggal_terima" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_tanggal_terima" data-caption="<?= HtmlEncode(RemoveHtml($Page->tanggal_terima->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->tanggal_terima->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->tanggal_terima->getPlaceHolder()) ?>" <?= $Page->tanggal_terima->editAttributes() ?>>
                                    <?= $Page->tanggal_terima->selectOptionListHtml("x_tanggal_terima", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->tanggal_terima->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fv_penerimaan_paket_keluar_show_nama_usersrch", function() {
                                        var options = {
                                            name: "x_tanggal_terima",
                                            selectId: "fv_penerimaan_paket_keluar_show_nama_usersrch_x_tanggal_terima",
                                            ajax: {
                                                id: "x_tanggal_terima",
                                                form: "fv_penerimaan_paket_keluar_show_nama_usersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.v_penerimaan_paket_keluar_show_nama_user.fields.tanggal_terima.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->jenis_pengirim->Visible) { // jenis_pengirim 
                        ?>
                            <?php
                            if (!$Page->jenis_pengirim->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_jenis_pengirim" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->jenis_pengirim->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_jenis_pengirim" name="x_jenis_pengirim[]" class="form-control ew-select<?= $Page->jenis_pengirim->isInvalidClass() ?>" data-select2-id="fv_penerimaan_paket_keluar_show_nama_usersrch_x_jenis_pengirim" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_jenis_pengirim" data-caption="<?= HtmlEncode(RemoveHtml($Page->jenis_pengirim->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->jenis_pengirim->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->jenis_pengirim->getPlaceHolder()) ?>" <?= $Page->jenis_pengirim->editAttributes() ?>>
                                    <?= $Page->jenis_pengirim->selectOptionListHtml("x_jenis_pengirim", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->jenis_pengirim->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fv_penerimaan_paket_keluar_show_nama_usersrch", function() {
                                        var options = {
                                            name: "x_jenis_pengirim",
                                            selectId: "fv_penerimaan_paket_keluar_show_nama_usersrch_x_jenis_pengirim",
                                            ajax: {
                                                id: "x_jenis_pengirim",
                                                form: "fv_penerimaan_paket_keluar_show_nama_usersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.v_penerimaan_paket_keluar_show_nama_user.fields.jenis_pengirim.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->nama_kurir->Visible) { // nama_kurir 
                        ?>
                            <?php
                            if (!$Page->nama_kurir->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_nama_kurir" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->nama_kurir->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_nama_kurir" name="x_nama_kurir[]" class="form-control ew-select<?= $Page->nama_kurir->isInvalidClass() ?>" data-select2-id="fv_penerimaan_paket_keluar_show_nama_usersrch_x_nama_kurir" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_nama_kurir" data-caption="<?= HtmlEncode(RemoveHtml($Page->nama_kurir->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->nama_kurir->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->nama_kurir->getPlaceHolder()) ?>" <?= $Page->nama_kurir->editAttributes() ?>>
                                    <?= $Page->nama_kurir->selectOptionListHtml("x_nama_kurir", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->nama_kurir->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fv_penerimaan_paket_keluar_show_nama_usersrch", function() {
                                        var options = {
                                            name: "x_nama_kurir",
                                            selectId: "fv_penerimaan_paket_keluar_show_nama_usersrch_x_nama_kurir",
                                            ajax: {
                                                id: "x_nama_kurir",
                                                form: "fv_penerimaan_paket_keluar_show_nama_usersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.v_penerimaan_paket_keluar_show_nama_user.fields.nama_kurir.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->no_awb->Visible) { // no_awb 
                        ?>
                            <?php
                            if (!$Page->no_awb->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_no_awb" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->no_awb->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_no_awb" name="x_no_awb[]" class="form-control ew-select<?= $Page->no_awb->isInvalidClass() ?>" data-select2-id="fv_penerimaan_paket_keluar_show_nama_usersrch_x_no_awb" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_no_awb" data-caption="<?= HtmlEncode(RemoveHtml($Page->no_awb->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->no_awb->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->no_awb->getPlaceHolder()) ?>" <?= $Page->no_awb->editAttributes() ?>>
                                    <?= $Page->no_awb->selectOptionListHtml("x_no_awb", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->no_awb->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fv_penerimaan_paket_keluar_show_nama_usersrch", function() {
                                        var options = {
                                            name: "x_no_awb",
                                            selectId: "fv_penerimaan_paket_keluar_show_nama_usersrch_x_no_awb",
                                            ajax: {
                                                id: "x_no_awb",
                                                form: "fv_penerimaan_paket_keluar_show_nama_usersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.v_penerimaan_paket_keluar_show_nama_user.fields.no_awb.filterOptions);
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
                                <select id="x_employee_name" name="x_employee_name[]" class="form-control ew-select<?= $Page->employee_name->isInvalidClass() ?>" data-select2-id="fv_penerimaan_paket_keluar_show_nama_usersrch_x_employee_name" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_employee_name" data-caption="<?= HtmlEncode(RemoveHtml($Page->employee_name->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->employee_name->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->employee_name->getPlaceHolder()) ?>" <?= $Page->employee_name->editAttributes() ?>>
                                    <?= $Page->employee_name->selectOptionListHtml("x_employee_name", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->employee_name->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fv_penerimaan_paket_keluar_show_nama_usersrch", function() {
                                        var options = {
                                            name: "x_employee_name",
                                            selectId: "fv_penerimaan_paket_keluar_show_nama_usersrch_x_employee_name",
                                            ajax: {
                                                id: "x_employee_name",
                                                form: "fv_penerimaan_paket_keluar_show_nama_usersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.v_penerimaan_paket_keluar_show_nama_user.fields.employee_name.filterOptions);
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
                                <select id="x_created_date" name="x_created_date[]" class="form-control ew-select<?= $Page->created_date->isInvalidClass() ?>" data-select2-id="fv_penerimaan_paket_keluar_show_nama_usersrch_x_created_date" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_created_date" data-caption="<?= HtmlEncode(RemoveHtml($Page->created_date->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->created_date->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->created_date->getPlaceHolder()) ?>" <?= $Page->created_date->editAttributes() ?>>
                                    <?= $Page->created_date->selectOptionListHtml("x_created_date", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->created_date->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fv_penerimaan_paket_keluar_show_nama_usersrch", function() {
                                        var options = {
                                            name: "x_created_date",
                                            selectId: "fv_penerimaan_paket_keluar_show_nama_usersrch_x_created_date",
                                            ajax: {
                                                id: "x_created_date",
                                                form: "fv_penerimaan_paket_keluar_show_nama_usersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.v_penerimaan_paket_keluar_show_nama_user.fields.created_date.filterOptions);
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
                                <select id="x_bukti_penerimaan" name="x_bukti_penerimaan[]" class="form-control ew-select<?= $Page->bukti_penerimaan->isInvalidClass() ?>" data-select2-id="fv_penerimaan_paket_keluar_show_nama_usersrch_x_bukti_penerimaan" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_bukti_penerimaan" data-caption="<?= HtmlEncode(RemoveHtml($Page->bukti_penerimaan->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->bukti_penerimaan->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->bukti_penerimaan->getPlaceHolder()) ?>" <?= $Page->bukti_penerimaan->editAttributes() ?>>
                                    <?= $Page->bukti_penerimaan->selectOptionListHtml("x_bukti_penerimaan", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->bukti_penerimaan->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fv_penerimaan_paket_keluar_show_nama_usersrch", function() {
                                        var options = {
                                            name: "x_bukti_penerimaan",
                                            selectId: "fv_penerimaan_paket_keluar_show_nama_usersrch_x_bukti_penerimaan",
                                            ajax: {
                                                id: "x_bukti_penerimaan",
                                                form: "fv_penerimaan_paket_keluar_show_nama_usersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.v_penerimaan_paket_keluar_show_nama_user.fields.bukti_penerimaan.filterOptions);
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
                                <select id="x_nama_penerima" name="x_nama_penerima[]" class="form-control ew-select<?= $Page->nama_penerima->isInvalidClass() ?>" data-select2-id="fv_penerimaan_paket_keluar_show_nama_usersrch_x_nama_penerima" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_nama_penerima" data-caption="<?= HtmlEncode(RemoveHtml($Page->nama_penerima->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->nama_penerima->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->nama_penerima->getPlaceHolder()) ?>" <?= $Page->nama_penerima->editAttributes() ?>>
                                    <?= $Page->nama_penerima->selectOptionListHtml("x_nama_penerima", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->nama_penerima->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fv_penerimaan_paket_keluar_show_nama_usersrch", function() {
                                        var options = {
                                            name: "x_nama_penerima",
                                            selectId: "fv_penerimaan_paket_keluar_show_nama_usersrch_x_nama_penerima",
                                            ajax: {
                                                id: "x_nama_penerima",
                                                form: "fv_penerimaan_paket_keluar_show_nama_usersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.v_penerimaan_paket_keluar_show_nama_user.fields.nama_penerima.filterOptions);
                                        ew.createFilter(options);
                                    });
                                </script>
                            </div><!-- /.col-sm-auto -->
                        <?php } ?>
                        <?php if ($Page->status_sap->Visible) { // status_sap 
                        ?>
                            <?php
                            if (!$Page->status_sap->UseFilter) {
                                $Page->SearchColumnCount++;
                            }
                            ?>
                            <div id="xs_status_sap" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->status_sap->UseFilter ? " ew-filter-field" : "" ?>">
                                <select id="x_status_sap" name="x_status_sap[]" class="form-control ew-select<?= $Page->status_sap->isInvalidClass() ?>" data-select2-id="fv_penerimaan_paket_keluar_show_nama_usersrch_x_status_sap" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_status_sap" data-caption="<?= HtmlEncode(RemoveHtml($Page->status_sap->caption())) ?>" data-filter="true" multiple size="1" data-value-separator="<?= $Page->status_sap->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->status_sap->getPlaceHolder()) ?>" <?= $Page->status_sap->editAttributes() ?>>
                                    <?= $Page->status_sap->selectOptionListHtml("x_status_sap", true) ?>
                                </select>
                                <div class="invalid-feedback"><?= $Page->status_sap->getErrorMessage(false) ?></div>
                                <script>
                                    loadjs.ready("fv_penerimaan_paket_keluar_show_nama_usersrch", function() {
                                        var options = {
                                            name: "x_status_sap",
                                            selectId: "fv_penerimaan_paket_keluar_show_nama_usersrch_x_status_sap",
                                            ajax: {
                                                id: "x_status_sap",
                                                form: "fv_penerimaan_paket_keluar_show_nama_usersrch",
                                                limit: ew.FILTER_PAGE_SIZE,
                                                data: {
                                                    ajax: "filter"
                                                }
                                            }
                                        };
                                        options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.v_penerimaan_paket_keluar_show_nama_user.fields.status_sap.filterOptions);
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
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fv_penerimaan_paket_keluar_show_nama_usersrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fv_penerimaan_paket_keluar_show_nama_usersrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fv_penerimaan_paket_keluar_show_nama_usersrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                                    <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fv_penerimaan_paket_keluar_show_nama_usersrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
    <div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> v_penerimaan_paket_keluar_show_nama_user">
        <form name="fv_penerimaan_paket_keluar_show_nama_userlist" id="fv_penerimaan_paket_keluar_show_nama_userlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
            <?php if (Config("CHECK_TOKEN")) { ?>
                <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
                <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
            <?php } ?>
            <input type="hidden" name="t" value="v_penerimaan_paket_keluar_show_nama_user">
            <div id="gmp_v_penerimaan_paket_keluar_show_nama_user" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
                <?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
                    <table id="tbl_v_penerimaan_paket_keluar_show_nama_userlist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
                                        <div id="elh_v_penerimaan_paket_keluar_show_nama_user_no_dokumen_no_paket" class="v_penerimaan_paket_keluar_show_nama_user_no_dokumen_no_paket"><?= $Page->renderFieldHeader($Page->no_dokumen_no_paket) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->jenis_dokumen->Visible) { // jenis_dokumen 
                                ?>
                                    <th data-name="jenis_dokumen" class="<?= $Page->jenis_dokumen->headerCellClass() ?>">
                                        <div id="elh_v_penerimaan_paket_keluar_show_nama_user_jenis_dokumen" class="v_penerimaan_paket_keluar_show_nama_user_jenis_dokumen"><?= $Page->renderFieldHeader($Page->jenis_dokumen) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->tujuan_penerima->Visible) { // tujuan_penerima 
                                ?>
                                    <th data-name="tujuan_penerima" class="<?= $Page->tujuan_penerima->headerCellClass() ?>">
                                        <div id="elh_v_penerimaan_paket_keluar_show_nama_user_tujuan_penerima" class="v_penerimaan_paket_keluar_show_nama_user_tujuan_penerima"><?= $Page->renderFieldHeader($Page->tujuan_penerima) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->no_hp_penerima->Visible) { // no_hp_penerima 
                                ?>
                                    <th data-name="no_hp_penerima" class="<?= $Page->no_hp_penerima->headerCellClass() ?>">
                                        <div id="elh_v_penerimaan_paket_keluar_show_nama_user_no_hp_penerima" class="v_penerimaan_paket_keluar_show_nama_user_no_hp_penerima"><?= $Page->renderFieldHeader($Page->no_hp_penerima) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->email_penerima->Visible) { // email_penerima 
                                ?>
                                    <th data-name="email_penerima" class="<?= $Page->email_penerima->headerCellClass() ?>">
                                        <div id="elh_v_penerimaan_paket_keluar_show_nama_user_email_penerima" class="v_penerimaan_paket_keluar_show_nama_user_email_penerima"><?= $Page->renderFieldHeader($Page->email_penerima) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->id->Visible) { // id 
                                ?>
                                    <th data-name="id" class="<?= $Page->id->headerCellClass() ?>" style="white-space: nowrap;">
                                        <div id="elh_v_penerimaan_paket_keluar_show_nama_user_id" class="v_penerimaan_paket_keluar_show_nama_user_id"><?= $Page->renderFieldHeader($Page->id) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->status->Visible) { // status 
                                ?>
                                    <th data-name="status" class="<?= $Page->status->headerCellClass() ?>">
                                        <div id="elh_v_penerimaan_paket_keluar_show_nama_user_status" class="v_penerimaan_paket_keluar_show_nama_user_status"><?= $Page->renderFieldHeader($Page->status) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->tanggal_terima->Visible) { // tanggal_terima 
                                ?>
                                    <th data-name="tanggal_terima" class="<?= $Page->tanggal_terima->headerCellClass() ?>">
                                        <div id="elh_v_penerimaan_paket_keluar_show_nama_user_tanggal_terima" class="v_penerimaan_paket_keluar_show_nama_user_tanggal_terima"><?= $Page->renderFieldHeader($Page->tanggal_terima) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->jenis_pengirim->Visible) { // jenis_pengirim 
                                ?>
                                    <th data-name="jenis_pengirim" class="<?= $Page->jenis_pengirim->headerCellClass() ?>">
                                        <div id="elh_v_penerimaan_paket_keluar_show_nama_user_jenis_pengirim" class="v_penerimaan_paket_keluar_show_nama_user_jenis_pengirim"><?= $Page->renderFieldHeader($Page->jenis_pengirim) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->nama_kurir->Visible) { // nama_kurir 
                                ?>
                                    <th data-name="nama_kurir" class="<?= $Page->nama_kurir->headerCellClass() ?>">
                                        <div id="elh_v_penerimaan_paket_keluar_show_nama_user_nama_kurir" class="v_penerimaan_paket_keluar_show_nama_user_nama_kurir"><?= $Page->renderFieldHeader($Page->nama_kurir) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->no_awb->Visible) { // no_awb 
                                ?>
                                    <th data-name="no_awb" class="<?= $Page->no_awb->headerCellClass() ?>">
                                        <div id="elh_v_penerimaan_paket_keluar_show_nama_user_no_awb" class="v_penerimaan_paket_keluar_show_nama_user_no_awb"><?= $Page->renderFieldHeader($Page->no_awb) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->employee_name->Visible) { // employee_name 
                                ?>
                                    <th data-name="employee_name" class="<?= $Page->employee_name->headerCellClass() ?>">
                                        <div id="elh_v_penerimaan_paket_keluar_show_nama_user_employee_name" class="v_penerimaan_paket_keluar_show_nama_user_employee_name"><?= $Page->renderFieldHeader($Page->employee_name) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->created_date->Visible) { // created_date 
                                ?>
                                    <th data-name="created_date" class="<?= $Page->created_date->headerCellClass() ?>">
                                        <div id="elh_v_penerimaan_paket_keluar_show_nama_user_created_date" class="v_penerimaan_paket_keluar_show_nama_user_created_date"><?= $Page->renderFieldHeader($Page->created_date) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->bukti_penerimaan->Visible) { // bukti_penerimaan 
                                ?>
                                    <th data-name="bukti_penerimaan" class="<?= $Page->bukti_penerimaan->headerCellClass() ?>">
                                        <div id="elh_v_penerimaan_paket_keluar_show_nama_user_bukti_penerimaan" class="v_penerimaan_paket_keluar_show_nama_user_bukti_penerimaan"><?= $Page->renderFieldHeader($Page->bukti_penerimaan) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->nama_penerima->Visible) { // nama_penerima 
                                ?>
                                    <th data-name="nama_penerima" class="<?= $Page->nama_penerima->headerCellClass() ?>">
                                        <div id="elh_v_penerimaan_paket_keluar_show_nama_user_nama_penerima" class="v_penerimaan_paket_keluar_show_nama_user_nama_penerima"><?= $Page->renderFieldHeader($Page->nama_penerima) ?></div>
                                    </th>
                                <?php } ?>
                                <?php if ($Page->status_sap->Visible) { // status_sap 
                                ?>
                                    <th data-name="status_sap" class="<?= $Page->status_sap->headerCellClass() ?>">
                                        <div id="elh_v_penerimaan_paket_keluar_show_nama_user_status_sap" class="v_penerimaan_paket_keluar_show_nama_user_status_sap"><?= $Page->renderFieldHeader($Page->status_sap) ?></div>
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
                                        "id" => "r" . $Page->RowCount . "_v_penerimaan_paket_keluar_show_nama_user",
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
                                                <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_no_dokumen_no_paket" class="el_v_penerimaan_paket_keluar_show_nama_user_no_dokumen_no_paket">
                                                    <span<?= $Page->no_dokumen_no_paket->viewAttributes() ?>>
                                                        <?= $Page->no_dokumen_no_paket->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->jenis_dokumen->Visible) { // jenis_dokumen 
                                        ?>
                                            <td data-name="jenis_dokumen" <?= $Page->jenis_dokumen->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_jenis_dokumen" class="el_v_penerimaan_paket_keluar_show_nama_user_jenis_dokumen">
                                                    <span<?= $Page->jenis_dokumen->viewAttributes() ?>>
                                                        <?= $Page->jenis_dokumen->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->tujuan_penerima->Visible) { // tujuan_penerima 
                                        ?>
                                            <td data-name="tujuan_penerima" <?= $Page->tujuan_penerima->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_tujuan_penerima" class="el_v_penerimaan_paket_keluar_show_nama_user_tujuan_penerima">
                                                    <span<?= $Page->tujuan_penerima->viewAttributes() ?>>
                                                        <?= $Page->tujuan_penerima->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->no_hp_penerima->Visible) { // no_hp_penerima 
                                        ?>
                                            <td data-name="no_hp_penerima" <?= $Page->no_hp_penerima->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_no_hp_penerima" class="el_v_penerimaan_paket_keluar_show_nama_user_no_hp_penerima">
                                                    <span<?= $Page->no_hp_penerima->viewAttributes() ?>>
                                                        <?= $Page->no_hp_penerima->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->email_penerima->Visible) { // email_penerima 
                                        ?>
                                            <td data-name="email_penerima" <?= $Page->email_penerima->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_email_penerima" class="el_v_penerimaan_paket_keluar_show_nama_user_email_penerima">
                                                    <span<?= $Page->email_penerima->viewAttributes() ?>>
                                                        <?= $Page->email_penerima->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->id->Visible) { // id 
                                        ?>
                                            <td data-name="id" <?= $Page->id->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_id" class="el_v_penerimaan_paket_keluar_show_nama_user_id">
                                                    <span<?= $Page->id->viewAttributes() ?>>
                                                        <?= $Page->id->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->status->Visible) { // status 
                                        ?>
                                            <td data-name="status" <?= $Page->status->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_status" class="el_v_penerimaan_paket_keluar_show_nama_user_status">
                                                    <span<?= $Page->status->viewAttributes() ?>>
                                                        <?= $Page->status->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->tanggal_terima->Visible) { // tanggal_terima 
                                        ?>
                                            <td data-name="tanggal_terima" <?= $Page->tanggal_terima->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_tanggal_terima" class="el_v_penerimaan_paket_keluar_show_nama_user_tanggal_terima">
                                                    <span<?= $Page->tanggal_terima->viewAttributes() ?>>
                                                        <?= $Page->tanggal_terima->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->jenis_pengirim->Visible) { // jenis_pengirim 
                                        ?>
                                            <td data-name="jenis_pengirim" <?= $Page->jenis_pengirim->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_jenis_pengirim" class="el_v_penerimaan_paket_keluar_show_nama_user_jenis_pengirim">
                                                    <span<?= $Page->jenis_pengirim->viewAttributes() ?>>
                                                        <?= $Page->jenis_pengirim->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->nama_kurir->Visible) { // nama_kurir 
                                        ?>
                                            <td data-name="nama_kurir" <?= $Page->nama_kurir->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_nama_kurir" class="el_v_penerimaan_paket_keluar_show_nama_user_nama_kurir">
                                                    <span<?= $Page->nama_kurir->viewAttributes() ?>>
                                                        <?= $Page->nama_kurir->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->no_awb->Visible) { // no_awb 
                                        ?>
                                            <td data-name="no_awb" <?= $Page->no_awb->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_no_awb" class="el_v_penerimaan_paket_keluar_show_nama_user_no_awb">
                                                    <span<?= $Page->no_awb->viewAttributes() ?>>
                                                        <?= $Page->no_awb->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->employee_name->Visible) { // employee_name 
                                        ?>
                                            <td data-name="employee_name" <?= $Page->employee_name->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_employee_name" class="el_v_penerimaan_paket_keluar_show_nama_user_employee_name">
                                                    <span<?= $Page->employee_name->viewAttributes() ?>>
                                                        <?= $Page->employee_name->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->created_date->Visible) { // created_date 
                                        ?>
                                            <td data-name="created_date" <?= $Page->created_date->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_created_date" class="el_v_penerimaan_paket_keluar_show_nama_user_created_date">
                                                    <span<?= $Page->created_date->viewAttributes() ?>>
                                                        <?= $Page->created_date->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->bukti_penerimaan->Visible) { // bukti_penerimaan 
                                        ?>
                                            <td data-name="bukti_penerimaan" <?= $Page->bukti_penerimaan->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_bukti_penerimaan" class="el_v_penerimaan_paket_keluar_show_nama_user_bukti_penerimaan">
                                                    <span>
                                                        <?= GetFileViewTag($Page->bukti_penerimaan, $Page->bukti_penerimaan->getViewValue(), false) ?>
                                                    </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->nama_penerima->Visible) { // nama_penerima 
                                        ?>
                                            <td data-name="nama_penerima" <?= $Page->nama_penerima->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_nama_penerima" class="el_v_penerimaan_paket_keluar_show_nama_user_nama_penerima">
                                                    <span<?= $Page->nama_penerima->viewAttributes() ?>>
                                                        <?= $Page->nama_penerima->getViewValue() ?>
                                                </span>
                                                </span>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Page->status_sap->Visible) { // status_sap 
                                        ?>
                                            <td data-name="status_sap" <?= $Page->status_sap->cellAttributes() ?>>
                                                <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_status_sap" class="el_v_penerimaan_paket_keluar_show_nama_user_status_sap">
                                                    <span<?= $Page->status_sap->viewAttributes() ?>>
                                                        <?= $Page->status_sap->getViewValue() ?>
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
            ew.addEventHandlers("v_penerimaan_paket_keluar_show_nama_user");
        });
    </script>
    <script>
        loadjs.ready("load", function() {
            // Write your table-specific startup script here, no need to add script tags.
        });
    </script>
<?php } ?>