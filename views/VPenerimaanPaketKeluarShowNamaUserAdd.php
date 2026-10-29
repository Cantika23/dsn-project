<?php

namespace Mitral2022\DSN2;

// Page object
$VPenerimaanPaketKeluarShowNamaUserAdd = &$Page;
?>
<script>
    var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
    ew.deepAssign(ew.vars, {
        tables: {
            v_penerimaan_paket_keluar_show_nama_user: currentTable
        }
    });
    var currentForm, currentPageID;
    var fv_penerimaan_paket_keluar_show_nama_useradd;
    loadjs.ready(["wrapper", "head"], function() {
        var $ = jQuery;
        // Form object
        fv_penerimaan_paket_keluar_show_nama_useradd = new ew.Form("fv_penerimaan_paket_keluar_show_nama_useradd", "add");
        currentPageID = ew.PAGE_ID = "add";
        currentForm = fv_penerimaan_paket_keluar_show_nama_useradd;

        // Add fields
        var fields = currentTable.fields;
        fv_penerimaan_paket_keluar_show_nama_useradd.addFields([
            ["no_dokumen_no_paket", [fields.no_dokumen_no_paket.visible && fields.no_dokumen_no_paket.required ? ew.Validators.required(fields.no_dokumen_no_paket.caption) : null], fields.no_dokumen_no_paket.isInvalid],
            ["no_dokumen", [fields.no_dokumen.visible && fields.no_dokumen.required ? ew.Validators.required(fields.no_dokumen.caption) : null], fields.no_dokumen.isInvalid],
            ["no_paket", [fields.no_paket.visible && fields.no_paket.required ? ew.Validators.required(fields.no_paket.caption) : null], fields.no_paket.isInvalid],
            ["jenis_dokumen", [fields.jenis_dokumen.visible && fields.jenis_dokumen.required ? ew.Validators.required(fields.jenis_dokumen.caption) : null], fields.jenis_dokumen.isInvalid],
            ["tujuan_penerima", [fields.tujuan_penerima.visible && fields.tujuan_penerima.required ? ew.Validators.required(fields.tujuan_penerima.caption) : null], fields.tujuan_penerima.isInvalid],
            ["no_hp_penerima", [fields.no_hp_penerima.visible && fields.no_hp_penerima.required ? ew.Validators.required(fields.no_hp_penerima.caption) : null], fields.no_hp_penerima.isInvalid],
            ["email_penerima", [fields.email_penerima.visible && fields.email_penerima.required ? ew.Validators.required(fields.email_penerima.caption) : null], fields.email_penerima.isInvalid],
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null, ew.Validators.integer], fields.id.isInvalid],
            ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
            ["tanggal_terima", [fields.tanggal_terima.visible && fields.tanggal_terima.required ? ew.Validators.required(fields.tanggal_terima.caption) : null, ew.Validators.datetime(fields.tanggal_terima.clientFormatPattern)], fields.tanggal_terima.isInvalid],
            ["jenis_pengirim", [fields.jenis_pengirim.visible && fields.jenis_pengirim.required ? ew.Validators.required(fields.jenis_pengirim.caption) : null], fields.jenis_pengirim.isInvalid],
            ["nama_kurir", [fields.nama_kurir.visible && fields.nama_kurir.required ? ew.Validators.required(fields.nama_kurir.caption) : null], fields.nama_kurir.isInvalid],
            ["no_awb", [fields.no_awb.visible && fields.no_awb.required ? ew.Validators.required(fields.no_awb.caption) : null], fields.no_awb.isInvalid],
            ["employee_name", [fields.employee_name.visible && fields.employee_name.required ? ew.Validators.required(fields.employee_name.caption) : null], fields.employee_name.isInvalid],
            ["id_user", [fields.id_user.visible && fields.id_user.required ? ew.Validators.required(fields.id_user.caption) : null], fields.id_user.isInvalid],
            ["created_date", [fields.created_date.visible && fields.created_date.required ? ew.Validators.required(fields.created_date.caption) : null], fields.created_date.isInvalid],
            ["bukti_penerimaan", [fields.bukti_penerimaan.visible && fields.bukti_penerimaan.required ? ew.Validators.fileRequired(fields.bukti_penerimaan.caption) : null], fields.bukti_penerimaan.isInvalid],
            ["nama_penerima", [fields.nama_penerima.visible && fields.nama_penerima.required ? ew.Validators.required(fields.nama_penerima.caption) : null], fields.nama_penerima.isInvalid],
            ["status_sap", [fields.status_sap.visible && fields.status_sap.required ? ew.Validators.required(fields.status_sap.caption) : null, ew.Validators.integer], fields.status_sap.isInvalid]
        ]);

        // Form_CustomValidate
        fv_penerimaan_paket_keluar_show_nama_useradd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
            // Your custom validation code here, return false if invalid.
            return true;
        }

        // Use JavaScript validation or not
        fv_penerimaan_paket_keluar_show_nama_useradd.validateRequired = ew.CLIENT_VALIDATE;

        // Dynamic selection lists
        fv_penerimaan_paket_keluar_show_nama_useradd.lists.jenis_dokumen = <?= $Page->jenis_dokumen->toClientList($Page) ?>;
        fv_penerimaan_paket_keluar_show_nama_useradd.lists.status = <?= $Page->status->toClientList($Page) ?>;
        fv_penerimaan_paket_keluar_show_nama_useradd.lists.jenis_pengirim = <?= $Page->jenis_pengirim->toClientList($Page) ?>;
        loadjs.done("fv_penerimaan_paket_keluar_show_nama_useradd");
    });
</script>
<script>
    loadjs.ready("head", function() {
        // Client script
        // Write your table-specific client script here, no need to add script tags.
        var metodePengiriman = $("#x_jenis_pengirim").val();
        var ekspedisiOrMessenger = $("#x_nama_kurir").val();
        if (metodePengiriman === '2') {
            $("#elh_v_penerimaan_paket_keluar_show_nama_user_nama_kurir").text("Nama Messenger");
            $("#el_v_penerimaan_paket_keluar_show_nama_user_nama_kurir").html('<input type="text" name="x_nama_kurir" id="x_nama_kurir" data-table="penerimaan_paket_keluar" data-field="x_nama_kurir" value="' + ekspedisiOrMessenger + '" size="30" maxlength="255" placeholder="Nama Messenger" class="form-control" aria-describedby="x_nama_kurir_help">');
            $('#r_no_awb').hide();
        } else if (metodePengiriman === '1') {
            $("#elh_penerimaan_paket_keluar_nama_kurir").text("Nama Ekspedisi");
            $("#el_penerimaan_paket_keluar_nama_kurir").html(`<select name="x_nama_kurir" id="x_nama_kurir" data-table="penerimaan_paket_keluar" data-field="x_nama_kurir" class="form-control" aria-describedby="x_nama_kurir_help">
    															<option value="JNE" ' + (ekspedisiOrMessenger == "JNE" ? "selected" : "") + '>JNE</option>
    															<option value="TIKI" ' + (ekspedisiOrMessenger == "TIKI" ? "selected" : "") + '>TIKI</option>
    														</select>`);
            $("#x_nama_kurir").select2({
                placeholder: "Nama Ekspedisi",
                allowClear: true,
                width: 'style',
                minimumResultsForSearch: Infinity // Disable the search box
            }).val(ekspedisiOrMessenger).trigger('change');
            $('.select2-selection.select2-selection--single').css({
                'padding-right': '50px !important'
            });
            $('#r_no_awb').show();
        }
        $("#x_jenis_pengirim").on('change', function() {
            ekspedisiOrMessenger = $("#x_nama_kurir").val();
            if ($(this).val() === '2') {
                $("#elh_v_penerimaan_paket_keluar_show_nama_user_nama_kurir").text("Nama Messenger");
                $("#el_v_penerimaan_paket_keluar_show_nama_user_nama_kurir").html('<input type="text" name="x_nama_kurir" id="x_nama_kurir" data-table="penerimaan_paket_keluar" data-field="x_nama_kurir" value="' + ekspedisiOrMessenger + '" size="30" maxlength="255" placeholder="Nama Messenger" class="form-control" aria-describedby="x_nama_kurir_help">');
                $('#r_no_awb').hide();
            } else if ($(this).val() === '1') {
                $("#elh_v_penerimaan_paket_keluar_show_nama_user_nama_kurir").text("Nama Ekspedisi");
                $("#el_v_penerimaan_paket_keluar_show_nama_user_nama_kurir").html(`<select name="x_nama_kurir" id="x_nama_kurir" data-table="penerimaan_paket_keluar" data-field="x_nama_kurir" class="form-control" aria-describedby="x_nama_kurir_help">
    															<option value="JNE" ' + (ekspedisiOrMessenger == "JNE" ? "selected" : "") + '>JNE</option>
    															<option value="TIKI" ' + (ekspedisiOrMessenger == "TIKI" ? "selected" : "") + '>TIKI</option>
    														  </select>`);
                $("#x_nama_kurir").select2({
                    placeholder: "Nama Ekspedisi",
                    allowClear: true,
                    width: 'style',
                    minimumResultsForSearch: Infinity // Disable the search box
                }).val(ekspedisiOrMessenger).trigger('change');
                $('.select2-selection.select2-selection--single').css({
                    'padding-right': '50px !important'
                });
                $('#r_no_awb').show();
            }
        });
    });
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fv_penerimaan_paket_keluar_show_nama_useradd" id="fv_penerimaan_paket_keluar_show_nama_useradd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
    <?php if (Config("CHECK_TOKEN")) { ?>
        <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
        <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
    <?php } ?>
    <input type="hidden" name="t" value="v_penerimaan_paket_keluar_show_nama_user">
    <input type="hidden" name="action" id="action" value="insert">
    <input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
    <input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
    <div class="ew-add-div"><!-- page* -->
        <?php if ($Page->no_dokumen_no_paket->Visible) { // no_dokumen_no_paket 
        ?>
            <div id="r_no_dokumen_no_paket" <?= $Page->no_dokumen_no_paket->rowAttributes() ?>>
                <label id="elh_v_penerimaan_paket_keluar_show_nama_user_no_dokumen_no_paket" for="x_no_dokumen_no_paket" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_dokumen_no_paket->caption() ?><?= $Page->no_dokumen_no_paket->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
                <div class="<?= $Page->RightColumnClass ?>">
                    <div<?= $Page->no_dokumen_no_paket->cellAttributes() ?>>
                        <span id="el_v_penerimaan_paket_keluar_show_nama_user_no_dokumen_no_paket">
                            <textarea data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_no_dokumen_no_paket" name="x_no_dokumen_no_paket" id="x_no_dokumen_no_paket" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->no_dokumen_no_paket->getPlaceHolder()) ?>" <?= $Page->no_dokumen_no_paket->editAttributes() ?> aria-describedby="x_no_dokumen_no_paket_help"><?= $Page->no_dokumen_no_paket->EditValue ?></textarea>
                            <?= $Page->no_dokumen_no_paket->getCustomMessage() ?>
                            <div class="invalid-feedback"><?= $Page->no_dokumen_no_paket->getErrorMessage() ?></div>
                        </span>
                </div>
            </div>
    </div>
<?php } ?>
<?php if ($Page->no_dokumen->Visible) { // no_dokumen 
?>
    <div id="r_no_dokumen" <?= $Page->no_dokumen->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_no_dokumen" for="x_no_dokumen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_dokumen->caption() ?><?= $Page->no_dokumen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->no_dokumen->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_no_dokumen">
                    <input type="<?= $Page->no_dokumen->getInputTextType() ?>" name="x_no_dokumen" id="x_no_dokumen" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_no_dokumen" value="<?= $Page->no_dokumen->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->no_dokumen->getPlaceHolder()) ?>" <?= $Page->no_dokumen->editAttributes() ?> aria-describedby="x_no_dokumen_help">
                    <?= $Page->no_dokumen->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->no_dokumen->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->no_paket->Visible) { // no_paket 
?>
    <div id="r_no_paket" <?= $Page->no_paket->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_no_paket" for="x_no_paket" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_paket->caption() ?><?= $Page->no_paket->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->no_paket->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_no_paket">
                    <input type="<?= $Page->no_paket->getInputTextType() ?>" name="x_no_paket" id="x_no_paket" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_no_paket" value="<?= $Page->no_paket->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->no_paket->getPlaceHolder()) ?>" <?= $Page->no_paket->editAttributes() ?> aria-describedby="x_no_paket_help">
                    <?= $Page->no_paket->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->no_paket->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->jenis_dokumen->Visible) { // jenis_dokumen 
?>
    <div id="r_jenis_dokumen" <?= $Page->jenis_dokumen->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_jenis_dokumen" for="x_jenis_dokumen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenis_dokumen->caption() ?><?= $Page->jenis_dokumen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->jenis_dokumen->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_jenis_dokumen">
                    <select id="x_jenis_dokumen" name="x_jenis_dokumen" class="form-select ew-select<?= $Page->jenis_dokumen->isInvalidClass() ?>" data-select2-id="fv_penerimaan_paket_keluar_show_nama_useradd_x_jenis_dokumen" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_jenis_dokumen" data-value-separator="<?= $Page->jenis_dokumen->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->jenis_dokumen->getPlaceHolder()) ?>" <?= $Page->jenis_dokumen->editAttributes() ?>>
                        <?= $Page->jenis_dokumen->selectOptionListHtml("x_jenis_dokumen") ?>
                    </select>
                    <?= $Page->jenis_dokumen->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->jenis_dokumen->getErrorMessage() ?></div>
                    <?= $Page->jenis_dokumen->Lookup->getParamTag($Page, "p_x_jenis_dokumen") ?>
                    <script>
                        loadjs.ready("fv_penerimaan_paket_keluar_show_nama_useradd", function() {
                            var options = {
                                    name: "x_jenis_dokumen",
                                    selectId: "fv_penerimaan_paket_keluar_show_nama_useradd_x_jenis_dokumen"
                                },
                                el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
                            options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
                            if (fv_penerimaan_paket_keluar_show_nama_useradd.lists.jenis_dokumen.lookupOptions.length) {
                                options.data = {
                                    id: "x_jenis_dokumen",
                                    form: "fv_penerimaan_paket_keluar_show_nama_useradd"
                                };
                            } else {
                                options.ajax = {
                                    id: "x_jenis_dokumen",
                                    form: "fv_penerimaan_paket_keluar_show_nama_useradd",
                                    limit: ew.LOOKUP_PAGE_SIZE
                                };
                            }
                            options.minimumResultsForSearch = Infinity;
                            options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.v_penerimaan_paket_keluar_show_nama_user.fields.jenis_dokumen.selectOptions);
                            ew.createSelect(options);
                        });
                    </script>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->tujuan_penerima->Visible) { // tujuan_penerima 
?>
    <div id="r_tujuan_penerima" <?= $Page->tujuan_penerima->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_tujuan_penerima" for="x_tujuan_penerima" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tujuan_penerima->caption() ?><?= $Page->tujuan_penerima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->tujuan_penerima->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_tujuan_penerima">
                    <input type="<?= $Page->tujuan_penerima->getInputTextType() ?>" name="x_tujuan_penerima" id="x_tujuan_penerima" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_tujuan_penerima" value="<?= $Page->tujuan_penerima->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->tujuan_penerima->getPlaceHolder()) ?>" <?= $Page->tujuan_penerima->editAttributes() ?> aria-describedby="x_tujuan_penerima_help">
                    <?= $Page->tujuan_penerima->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->tujuan_penerima->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->no_hp_penerima->Visible) { // no_hp_penerima 
?>
    <div id="r_no_hp_penerima" <?= $Page->no_hp_penerima->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_no_hp_penerima" for="x_no_hp_penerima" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_hp_penerima->caption() ?><?= $Page->no_hp_penerima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->no_hp_penerima->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_no_hp_penerima">
                    <input type="<?= $Page->no_hp_penerima->getInputTextType() ?>" name="x_no_hp_penerima" id="x_no_hp_penerima" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_no_hp_penerima" value="<?= $Page->no_hp_penerima->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->no_hp_penerima->getPlaceHolder()) ?>" <?= $Page->no_hp_penerima->editAttributes() ?> aria-describedby="x_no_hp_penerima_help">
                    <?= $Page->no_hp_penerima->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->no_hp_penerima->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->email_penerima->Visible) { // email_penerima 
?>
    <div id="r_email_penerima" <?= $Page->email_penerima->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_email_penerima" for="x_email_penerima" class="<?= $Page->LeftColumnClass ?>"><?= $Page->email_penerima->caption() ?><?= $Page->email_penerima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->email_penerima->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_email_penerima">
                    <input type="<?= $Page->email_penerima->getInputTextType() ?>" name="x_email_penerima" id="x_email_penerima" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_email_penerima" value="<?= $Page->email_penerima->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->email_penerima->getPlaceHolder()) ?>" <?= $Page->email_penerima->editAttributes() ?> aria-describedby="x_email_penerima_help">
                    <?= $Page->email_penerima->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->email_penerima->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->id->Visible) { // id 
?>
    <div id="r_id" <?= $Page->id->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_id" for="x_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->id->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_id">
                    <input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_id" value="<?= $Page->id->EditValue ?>" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>" <?= $Page->id->editAttributes() ?> aria-describedby="x_id_help">
                    <?= $Page->id->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->id->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status 
?>
    <div id="r_status" <?= $Page->status->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->status->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_status">
                    <select id="x_status" name="x_status" class="form-select ew-select<?= $Page->status->isInvalidClass() ?>" data-select2-id="fv_penerimaan_paket_keluar_show_nama_useradd_x_status" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_status" data-value-separator="<?= $Page->status->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>" <?= $Page->status->editAttributes() ?>>
                        <?= $Page->status->selectOptionListHtml("x_status") ?>
                    </select>
                    <?= $Page->status->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
                    <?= $Page->status->Lookup->getParamTag($Page, "p_x_status") ?>
                    <script>
                        loadjs.ready("fv_penerimaan_paket_keluar_show_nama_useradd", function() {
                            var options = {
                                    name: "x_status",
                                    selectId: "fv_penerimaan_paket_keluar_show_nama_useradd_x_status"
                                },
                                el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
                            options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
                            if (fv_penerimaan_paket_keluar_show_nama_useradd.lists.status.lookupOptions.length) {
                                options.data = {
                                    id: "x_status",
                                    form: "fv_penerimaan_paket_keluar_show_nama_useradd"
                                };
                            } else {
                                options.ajax = {
                                    id: "x_status",
                                    form: "fv_penerimaan_paket_keluar_show_nama_useradd",
                                    limit: ew.LOOKUP_PAGE_SIZE
                                };
                            }
                            options.minimumResultsForSearch = Infinity;
                            options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.v_penerimaan_paket_keluar_show_nama_user.fields.status.selectOptions);
                            ew.createSelect(options);
                        });
                    </script>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->tanggal_terima->Visible) { // tanggal_terima 
?>
    <div id="r_tanggal_terima" <?= $Page->tanggal_terima->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_tanggal_terima" for="x_tanggal_terima" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tanggal_terima->caption() ?><?= $Page->tanggal_terima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->tanggal_terima->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_tanggal_terima">
                    <input type="<?= $Page->tanggal_terima->getInputTextType() ?>" name="x_tanggal_terima" id="x_tanggal_terima" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_tanggal_terima" value="<?= $Page->tanggal_terima->EditValue ?>" placeholder="<?= HtmlEncode($Page->tanggal_terima->getPlaceHolder()) ?>" <?= $Page->tanggal_terima->editAttributes() ?> aria-describedby="x_tanggal_terima_help">
                    <?= $Page->tanggal_terima->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->tanggal_terima->getErrorMessage() ?></div>
                    <?php if (!$Page->tanggal_terima->ReadOnly && !$Page->tanggal_terima->Disabled && !isset($Page->tanggal_terima->EditAttrs["readonly"]) && !isset($Page->tanggal_terima->EditAttrs["disabled"])) { ?>
                        <script>
                            loadjs.ready(["fv_penerimaan_paket_keluar_show_nama_useradd", "datetimepicker"], function() {
                                let format = "<?= DateFormat(0) ?>",
                                    options = {
                                        localization: {
                                            locale: ew.LANGUAGE_ID,
                                            numberingSystem: ew.getNumberingSystem()
                                        },
                                        display: {
                                            format,
                                            components: {
                                                hours: !!format.match(/h/i),
                                                minutes: !!format.match(/m/),
                                                seconds: !!format.match(/s/i)
                                            },
                                            icons: {
                                                previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                                                next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
                                            }
                                        }
                                    };
                                ew.createDateTimePicker("fv_penerimaan_paket_keluar_show_nama_useradd", "x_tanggal_terima", jQuery.extend(true, {
                                    "useCurrent": false
                                }, options));
                            });
                        </script>
                    <?php } ?>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->jenis_pengirim->Visible) { // jenis_pengirim 
?>
    <div id="r_jenis_pengirim" <?= $Page->jenis_pengirim->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_jenis_pengirim" for="x_jenis_pengirim" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenis_pengirim->caption() ?><?= $Page->jenis_pengirim->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->jenis_pengirim->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_jenis_pengirim">
                    <select id="x_jenis_pengirim" name="x_jenis_pengirim" class="form-select ew-select<?= $Page->jenis_pengirim->isInvalidClass() ?>" data-select2-id="fv_penerimaan_paket_keluar_show_nama_useradd_x_jenis_pengirim" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_jenis_pengirim" data-value-separator="<?= $Page->jenis_pengirim->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->jenis_pengirim->getPlaceHolder()) ?>" <?= $Page->jenis_pengirim->editAttributes() ?>>
                        <?= $Page->jenis_pengirim->selectOptionListHtml("x_jenis_pengirim") ?>
                    </select>
                    <?= $Page->jenis_pengirim->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->jenis_pengirim->getErrorMessage() ?></div>
                    <?= $Page->jenis_pengirim->Lookup->getParamTag($Page, "p_x_jenis_pengirim") ?>
                    <script>
                        loadjs.ready("fv_penerimaan_paket_keluar_show_nama_useradd", function() {
                            var options = {
                                    name: "x_jenis_pengirim",
                                    selectId: "fv_penerimaan_paket_keluar_show_nama_useradd_x_jenis_pengirim"
                                },
                                el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
                            options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
                            if (fv_penerimaan_paket_keluar_show_nama_useradd.lists.jenis_pengirim.lookupOptions.length) {
                                options.data = {
                                    id: "x_jenis_pengirim",
                                    form: "fv_penerimaan_paket_keluar_show_nama_useradd"
                                };
                            } else {
                                options.ajax = {
                                    id: "x_jenis_pengirim",
                                    form: "fv_penerimaan_paket_keluar_show_nama_useradd",
                                    limit: ew.LOOKUP_PAGE_SIZE
                                };
                            }
                            options.minimumResultsForSearch = Infinity;
                            options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.v_penerimaan_paket_keluar_show_nama_user.fields.jenis_pengirim.selectOptions);
                            ew.createSelect(options);
                        });
                    </script>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->nama_kurir->Visible) { // nama_kurir 
?>
    <div id="r_nama_kurir" <?= $Page->nama_kurir->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_nama_kurir" for="x_nama_kurir" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_kurir->caption() ?><?= $Page->nama_kurir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->nama_kurir->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_nama_kurir">
                    <input type="<?= $Page->nama_kurir->getInputTextType() ?>" name="x_nama_kurir" id="x_nama_kurir" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_nama_kurir" value="<?= $Page->nama_kurir->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->nama_kurir->getPlaceHolder()) ?>" <?= $Page->nama_kurir->editAttributes() ?> aria-describedby="x_nama_kurir_help">
                    <?= $Page->nama_kurir->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->nama_kurir->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->no_awb->Visible) { // no_awb 
?>
    <div id="r_no_awb" <?= $Page->no_awb->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_no_awb" for="x_no_awb" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_awb->caption() ?><?= $Page->no_awb->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->no_awb->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_no_awb">
                    <input type="<?= $Page->no_awb->getInputTextType() ?>" name="x_no_awb" id="x_no_awb" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_no_awb" value="<?= $Page->no_awb->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->no_awb->getPlaceHolder()) ?>" <?= $Page->no_awb->editAttributes() ?> aria-describedby="x_no_awb_help">
                    <?= $Page->no_awb->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->no_awb->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->employee_name->Visible) { // employee_name 
?>
    <div id="r_employee_name" <?= $Page->employee_name->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_employee_name" for="x_employee_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_name->caption() ?><?= $Page->employee_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->employee_name->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_employee_name">
                    <input type="<?= $Page->employee_name->getInputTextType() ?>" name="x_employee_name" id="x_employee_name" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_employee_name" value="<?= $Page->employee_name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->employee_name->getPlaceHolder()) ?>" <?= $Page->employee_name->editAttributes() ?> aria-describedby="x_employee_name_help">
                    <?= $Page->employee_name->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->employee_name->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->bukti_penerimaan->Visible) { // bukti_penerimaan 
?>
    <div id="r_bukti_penerimaan" <?= $Page->bukti_penerimaan->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_bukti_penerimaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bukti_penerimaan->caption() ?><?= $Page->bukti_penerimaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->bukti_penerimaan->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_bukti_penerimaan">
                    <div id="fd_x_bukti_penerimaan" class="fileinput-button ew-file-drop-zone">
                        <input type="file" class="form-control ew-file-input" title="<?= $Page->bukti_penerimaan->title() ?>" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_bukti_penerimaan" name="x_bukti_penerimaan" id="x_bukti_penerimaan" lang="<?= CurrentLanguageID() ?>" <?= $Page->bukti_penerimaan->editAttributes() ?> aria-describedby="x_bukti_penerimaan_help" <?= ($Page->bukti_penerimaan->ReadOnly || $Page->bukti_penerimaan->Disabled) ? " disabled" : "" ?>>
                        <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
                    </div>
                    <?= $Page->bukti_penerimaan->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->bukti_penerimaan->getErrorMessage() ?></div>
                    <input type="hidden" name="fn_x_bukti_penerimaan" id="fn_x_bukti_penerimaan" value="<?= $Page->bukti_penerimaan->Upload->FileName ?>">
                    <input type="hidden" name="fa_x_bukti_penerimaan" id="fa_x_bukti_penerimaan" value="0">
                    <input type="hidden" name="fs_x_bukti_penerimaan" id="fs_x_bukti_penerimaan" value="255">
                    <input type="hidden" name="fx_x_bukti_penerimaan" id="fx_x_bukti_penerimaan" value="<?= $Page->bukti_penerimaan->UploadAllowedFileExt ?>">
                    <input type="hidden" name="fm_x_bukti_penerimaan" id="fm_x_bukti_penerimaan" value="<?= $Page->bukti_penerimaan->UploadMaxFileSize ?>">
                    <table id="ft_x_bukti_penerimaan" class="table table-sm float-start ew-upload-table">
                        <tbody class="files"></tbody>
                    </table>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->nama_penerima->Visible) { // nama_penerima 
?>
    <div id="r_nama_penerima" <?= $Page->nama_penerima->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_nama_penerima" for="x_nama_penerima" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_penerima->caption() ?><?= $Page->nama_penerima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->nama_penerima->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_nama_penerima">
                    <input type="<?= $Page->nama_penerima->getInputTextType() ?>" name="x_nama_penerima" id="x_nama_penerima" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_nama_penerima" value="<?= $Page->nama_penerima->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->nama_penerima->getPlaceHolder()) ?>" <?= $Page->nama_penerima->editAttributes() ?> aria-describedby="x_nama_penerima_help">
                    <?= $Page->nama_penerima->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->nama_penerima->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->status_sap->Visible) { // status_sap 
?>
    <div id="r_status_sap" <?= $Page->status_sap->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_status_sap" for="x_status_sap" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status_sap->caption() ?><?= $Page->status_sap->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->status_sap->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_status_sap">
                    <input type="<?= $Page->status_sap->getInputTextType() ?>" name="x_status_sap" id="x_status_sap" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_status_sap" value="<?= $Page->status_sap->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->status_sap->getPlaceHolder()) ?>" <?= $Page->status_sap->editAttributes() ?> aria-describedby="x_status_sap_help">
                    <?= $Page->status_sap->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->status_sap->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
    <div class="row"><!-- buttons .row -->
        <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
            <button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
            <button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
        </div><!-- /buttons offset -->
    </div><!-- /buttons .row -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
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