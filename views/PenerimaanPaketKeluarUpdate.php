<?php

namespace Mitral2022\DSN2;

// Page object
$PenerimaanPaketKeluarUpdate = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { penerimaan_paket_keluar: currentTable } });
var currentForm, currentPageID;
var fpenerimaan_paket_keluarupdate;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpenerimaan_paket_keluarupdate = new ew.Form("fpenerimaan_paket_keluarupdate", "update");
    currentPageID = ew.PAGE_ID = "update";
    currentForm = fpenerimaan_paket_keluarupdate;

    // Add fields
    var fields = currentTable.fields;
    fpenerimaan_paket_keluarupdate.addFields([
        ["nopaketnodkumen", [fields.nopaketnodkumen.visible && fields.nopaketnodkumen.required ? ew.Validators.required(fields.nopaketnodkumen.caption) : null], fields.nopaketnodkumen.isInvalid],
        ["no_dokumen", [fields.no_dokumen.visible && fields.no_dokumen.required ? ew.Validators.required(fields.no_dokumen.caption) : null], fields.no_dokumen.isInvalid],
        ["no_paket", [fields.no_paket.visible && fields.no_paket.required ? ew.Validators.required(fields.no_paket.caption) : null], fields.no_paket.isInvalid],
        ["jenis_dokumen", [fields.jenis_dokumen.visible && fields.jenis_dokumen.required ? ew.Validators.required(fields.jenis_dokumen.caption) : null], fields.jenis_dokumen.isInvalid],
        ["tujuan_penerima", [fields.tujuan_penerima.visible && fields.tujuan_penerima.required ? ew.Validators.required(fields.tujuan_penerima.caption) : null], fields.tujuan_penerima.isInvalid],
        ["no_hp_penerima", [fields.no_hp_penerima.visible && fields.no_hp_penerima.required ? ew.Validators.required(fields.no_hp_penerima.caption) : null], fields.no_hp_penerima.isInvalid],
        ["email_penerima", [fields.email_penerima.visible && fields.email_penerima.required ? ew.Validators.required(fields.email_penerima.caption) : null], fields.email_penerima.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
        ["tanggal_terima", [fields.tanggal_terima.visible && fields.tanggal_terima.required ? ew.Validators.required(fields.tanggal_terima.caption) : null, ew.Validators.datetime(fields.tanggal_terima.clientFormatPattern), ew.Validators.selected], fields.tanggal_terima.isInvalid],
        ["jenis_pengirim", [fields.jenis_pengirim.visible && fields.jenis_pengirim.required ? ew.Validators.required(fields.jenis_pengirim.caption) : null], fields.jenis_pengirim.isInvalid],
        ["nama_kurir", [fields.nama_kurir.visible && fields.nama_kurir.required ? ew.Validators.required(fields.nama_kurir.caption) : null], fields.nama_kurir.isInvalid],
        ["no_awb", [fields.no_awb.visible && fields.no_awb.required ? ew.Validators.required(fields.no_awb.caption) : null], fields.no_awb.isInvalid],
        ["bukti_penerimaan", [fields.bukti_penerimaan.visible && fields.bukti_penerimaan.required ? ew.Validators.fileRequired(fields.bukti_penerimaan.caption) : null], fields.bukti_penerimaan.isInvalid],
        ["nama_penerima", [fields.nama_penerima.visible && fields.nama_penerima.required ? ew.Validators.required(fields.nama_penerima.caption) : null], fields.nama_penerima.isInvalid],
        ["id_user", [fields.id_user.visible && fields.id_user.required ? ew.Validators.required(fields.id_user.caption) : null], fields.id_user.isInvalid],
        ["created_date", [fields.created_date.visible && fields.created_date.required ? ew.Validators.required(fields.created_date.caption) : null], fields.created_date.isInvalid]
    ]);

    // Form_CustomValidate
    fpenerimaan_paket_keluarupdate.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpenerimaan_paket_keluarupdate.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fpenerimaan_paket_keluarupdate.lists.jenis_dokumen = <?= $Page->jenis_dokumen->toClientList($Page) ?>;
    fpenerimaan_paket_keluarupdate.lists.status = <?= $Page->status->toClientList($Page) ?>;
    fpenerimaan_paket_keluarupdate.lists.jenis_pengirim = <?= $Page->jenis_pengirim->toClientList($Page) ?>;
    loadjs.done("fpenerimaan_paket_keluarupdate");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fpenerimaan_paket_keluarupdate" id="fpenerimaan_paket_keluarupdate" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="penerimaan_paket_keluar">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div id="tbl_penerimaan_paket_keluarupdate" class="ew-update-div"><!-- page -->
    <?php if (!$Page->isConfirm()) { // Confirm page ?>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" name="u" id="u" data-ew-action="select-all"><label class="form-check-label" for="u"><?= $Language->phrase("SelectAll") ?></label>
    </div>
    <?php } ?>
<?php if ($Page->nopaketnodkumen->Visible && (!$Page->isConfirm() || $Page->nopaketnodkumen->multiUpdateSelected())) { // nopaketnodkumen ?>
    <div id="r_nopaketnodkumen"<?= $Page->nopaketnodkumen->rowAttributes() ?>>
        <label for="x_nopaketnodkumen" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_nopaketnodkumen" id="u_nopaketnodkumen" class="form-check-input ew-multi-select" value="1"<?= $Page->nopaketnodkumen->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_nopaketnodkumen"><?= $Page->nopaketnodkumen->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->nopaketnodkumen->cellAttributes() ?>>
                <span id="el_penerimaan_paket_keluar_nopaketnodkumen">
                <textarea data-table="penerimaan_paket_keluar" data-field="x_nopaketnodkumen" name="x_nopaketnodkumen" id="x_nopaketnodkumen" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->nopaketnodkumen->getPlaceHolder()) ?>"<?= $Page->nopaketnodkumen->editAttributes() ?> aria-describedby="x_nopaketnodkumen_help"><?= $Page->nopaketnodkumen->EditValue ?></textarea>
                <?= $Page->nopaketnodkumen->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->nopaketnodkumen->getErrorMessage() ?></div>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->no_dokumen->Visible && (!$Page->isConfirm() || $Page->no_dokumen->multiUpdateSelected())) { // no_dokumen ?>
    <div id="r_no_dokumen"<?= $Page->no_dokumen->rowAttributes() ?>>
        <label for="x_no_dokumen" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_no_dokumen" id="u_no_dokumen" class="form-check-input ew-multi-select" value="1"<?= $Page->no_dokumen->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_no_dokumen"><?= $Page->no_dokumen->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->no_dokumen->cellAttributes() ?>>
                <span id="el_penerimaan_paket_keluar_no_dokumen">
                <input type="<?= $Page->no_dokumen->getInputTextType() ?>" name="x_no_dokumen" id="x_no_dokumen" data-table="penerimaan_paket_keluar" data-field="x_no_dokumen" value="<?= $Page->no_dokumen->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->no_dokumen->getPlaceHolder()) ?>"<?= $Page->no_dokumen->editAttributes() ?> aria-describedby="x_no_dokumen_help">
                <?= $Page->no_dokumen->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->no_dokumen->getErrorMessage() ?></div>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->no_paket->Visible && (!$Page->isConfirm() || $Page->no_paket->multiUpdateSelected())) { // no_paket ?>
    <div id="r_no_paket"<?= $Page->no_paket->rowAttributes() ?>>
        <label for="x_no_paket" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_no_paket" id="u_no_paket" class="form-check-input ew-multi-select" value="1"<?= $Page->no_paket->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_no_paket"><?= $Page->no_paket->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->no_paket->cellAttributes() ?>>
                <span id="el_penerimaan_paket_keluar_no_paket">
                <input type="<?= $Page->no_paket->getInputTextType() ?>" name="x_no_paket" id="x_no_paket" data-table="penerimaan_paket_keluar" data-field="x_no_paket" value="<?= $Page->no_paket->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->no_paket->getPlaceHolder()) ?>"<?= $Page->no_paket->editAttributes() ?> aria-describedby="x_no_paket_help">
                <?= $Page->no_paket->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->no_paket->getErrorMessage() ?></div>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->jenis_dokumen->Visible && (!$Page->isConfirm() || $Page->jenis_dokumen->multiUpdateSelected())) { // jenis_dokumen ?>
    <div id="r_jenis_dokumen"<?= $Page->jenis_dokumen->rowAttributes() ?>>
        <label for="x_jenis_dokumen" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_jenis_dokumen" id="u_jenis_dokumen" class="form-check-input ew-multi-select" value="1"<?= $Page->jenis_dokumen->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_jenis_dokumen"><?= $Page->jenis_dokumen->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->jenis_dokumen->cellAttributes() ?>>
                <span id="el_penerimaan_paket_keluar_jenis_dokumen">
                    <select
                        id="x_jenis_dokumen"
                        name="x_jenis_dokumen"
                        class="form-select ew-select<?= $Page->jenis_dokumen->isInvalidClass() ?>"
                        data-select2-id="fpenerimaan_paket_keluarupdate_x_jenis_dokumen"
                        data-table="penerimaan_paket_keluar"
                        data-field="x_jenis_dokumen"
                        data-value-separator="<?= $Page->jenis_dokumen->displayValueSeparatorAttribute() ?>"
                        data-placeholder="<?= HtmlEncode($Page->jenis_dokumen->getPlaceHolder()) ?>"
                        <?= $Page->jenis_dokumen->editAttributes() ?>>
                        <?= $Page->jenis_dokumen->selectOptionListHtml("x_jenis_dokumen") ?>
                    </select>
                    <?= $Page->jenis_dokumen->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->jenis_dokumen->getErrorMessage() ?></div>
                <?= $Page->jenis_dokumen->Lookup->getParamTag($Page, "p_x_jenis_dokumen") ?>
                <script>
                loadjs.ready("fpenerimaan_paket_keluarupdate", function() {
                    var options = { name: "x_jenis_dokumen", selectId: "fpenerimaan_paket_keluarupdate_x_jenis_dokumen" },
                        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
                    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
                    if (fpenerimaan_paket_keluarupdate.lists.jenis_dokumen.lookupOptions.length) {
                        options.data = { id: "x_jenis_dokumen", form: "fpenerimaan_paket_keluarupdate" };
                    } else {
                        options.ajax = { id: "x_jenis_dokumen", form: "fpenerimaan_paket_keluarupdate", limit: ew.LOOKUP_PAGE_SIZE };
                    }
                    options.minimumResultsForSearch = Infinity;
                    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.penerimaan_paket_keluar.fields.jenis_dokumen.selectOptions);
                    ew.createSelect(options);
                });
                </script>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->tujuan_penerima->Visible && (!$Page->isConfirm() || $Page->tujuan_penerima->multiUpdateSelected())) { // tujuan_penerima ?>
    <div id="r_tujuan_penerima"<?= $Page->tujuan_penerima->rowAttributes() ?>>
        <label for="x_tujuan_penerima" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_tujuan_penerima" id="u_tujuan_penerima" class="form-check-input ew-multi-select" value="1"<?= $Page->tujuan_penerima->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_tujuan_penerima"><?= $Page->tujuan_penerima->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->tujuan_penerima->cellAttributes() ?>>
                <span id="el_penerimaan_paket_keluar_tujuan_penerima">
                <textarea data-table="penerimaan_paket_keluar" data-field="x_tujuan_penerima" name="x_tujuan_penerima" id="x_tujuan_penerima" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->tujuan_penerima->getPlaceHolder()) ?>"<?= $Page->tujuan_penerima->editAttributes() ?> aria-describedby="x_tujuan_penerima_help"><?= $Page->tujuan_penerima->EditValue ?></textarea>
                <?= $Page->tujuan_penerima->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->tujuan_penerima->getErrorMessage() ?></div>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->no_hp_penerima->Visible && (!$Page->isConfirm() || $Page->no_hp_penerima->multiUpdateSelected())) { // no_hp_penerima ?>
    <div id="r_no_hp_penerima"<?= $Page->no_hp_penerima->rowAttributes() ?>>
        <label for="x_no_hp_penerima" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_no_hp_penerima" id="u_no_hp_penerima" class="form-check-input ew-multi-select" value="1"<?= $Page->no_hp_penerima->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_no_hp_penerima"><?= $Page->no_hp_penerima->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->no_hp_penerima->cellAttributes() ?>>
                <span id="el_penerimaan_paket_keluar_no_hp_penerima">
                <input type="<?= $Page->no_hp_penerima->getInputTextType() ?>" name="x_no_hp_penerima" id="x_no_hp_penerima" data-table="penerimaan_paket_keluar" data-field="x_no_hp_penerima" value="<?= $Page->no_hp_penerima->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->no_hp_penerima->getPlaceHolder()) ?>"<?= $Page->no_hp_penerima->editAttributes() ?> aria-describedby="x_no_hp_penerima_help">
                <?= $Page->no_hp_penerima->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->no_hp_penerima->getErrorMessage() ?></div>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->email_penerima->Visible && (!$Page->isConfirm() || $Page->email_penerima->multiUpdateSelected())) { // email_penerima ?>
    <div id="r_email_penerima"<?= $Page->email_penerima->rowAttributes() ?>>
        <label for="x_email_penerima" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_email_penerima" id="u_email_penerima" class="form-check-input ew-multi-select" value="1"<?= $Page->email_penerima->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_email_penerima"><?= $Page->email_penerima->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->email_penerima->cellAttributes() ?>>
                <span id="el_penerimaan_paket_keluar_email_penerima">
                <input type="<?= $Page->email_penerima->getInputTextType() ?>" name="x_email_penerima" id="x_email_penerima" data-table="penerimaan_paket_keluar" data-field="x_email_penerima" value="<?= $Page->email_penerima->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->email_penerima->getPlaceHolder()) ?>"<?= $Page->email_penerima->editAttributes() ?> aria-describedby="x_email_penerima_help">
                <?= $Page->email_penerima->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->email_penerima->getErrorMessage() ?></div>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible && (!$Page->isConfirm() || $Page->status->multiUpdateSelected())) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label for="x_status" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_status" id="u_status" class="form-check-input ew-multi-select" value="1"<?= $Page->status->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_status"><?= $Page->status->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->status->cellAttributes() ?>>
                <span id="el_penerimaan_paket_keluar_status">
                    <select
                        id="x_status"
                        name="x_status"
                        class="form-select ew-select<?= $Page->status->isInvalidClass() ?>"
                        data-select2-id="fpenerimaan_paket_keluarupdate_x_status"
                        data-table="penerimaan_paket_keluar"
                        data-field="x_status"
                        data-value-separator="<?= $Page->status->displayValueSeparatorAttribute() ?>"
                        data-placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>"
                        <?= $Page->status->editAttributes() ?>>
                        <?= $Page->status->selectOptionListHtml("x_status") ?>
                    </select>
                    <?= $Page->status->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
                <?= $Page->status->Lookup->getParamTag($Page, "p_x_status") ?>
                <script>
                loadjs.ready("fpenerimaan_paket_keluarupdate", function() {
                    var options = { name: "x_status", selectId: "fpenerimaan_paket_keluarupdate_x_status" },
                        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
                    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
                    if (fpenerimaan_paket_keluarupdate.lists.status.lookupOptions.length) {
                        options.data = { id: "x_status", form: "fpenerimaan_paket_keluarupdate" };
                    } else {
                        options.ajax = { id: "x_status", form: "fpenerimaan_paket_keluarupdate", limit: ew.LOOKUP_PAGE_SIZE };
                    }
                    options.minimumResultsForSearch = Infinity;
                    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.penerimaan_paket_keluar.fields.status.selectOptions);
                    ew.createSelect(options);
                });
                </script>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->tanggal_terima->Visible && (!$Page->isConfirm() || $Page->tanggal_terima->multiUpdateSelected())) { // tanggal_terima ?>
    <div id="r_tanggal_terima"<?= $Page->tanggal_terima->rowAttributes() ?>>
        <label for="x_tanggal_terima" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_tanggal_terima" id="u_tanggal_terima" class="form-check-input ew-multi-select" value="1"<?= $Page->tanggal_terima->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_tanggal_terima"><?= $Page->tanggal_terima->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->tanggal_terima->cellAttributes() ?>>
                <span id="el_penerimaan_paket_keluar_tanggal_terima">
                <input type="<?= $Page->tanggal_terima->getInputTextType() ?>" name="x_tanggal_terima" id="x_tanggal_terima" data-table="penerimaan_paket_keluar" data-field="x_tanggal_terima" value="<?= $Page->tanggal_terima->EditValue ?>" placeholder="<?= HtmlEncode($Page->tanggal_terima->getPlaceHolder()) ?>"<?= $Page->tanggal_terima->editAttributes() ?> aria-describedby="x_tanggal_terima_help">
                <?= $Page->tanggal_terima->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->tanggal_terima->getErrorMessage() ?></div>
                <?php if (!$Page->tanggal_terima->ReadOnly && !$Page->tanggal_terima->Disabled && !isset($Page->tanggal_terima->EditAttrs["readonly"]) && !isset($Page->tanggal_terima->EditAttrs["disabled"])) { ?>
                <script>
                loadjs.ready(["fpenerimaan_paket_keluarupdate", "datetimepicker"], function () {
                    let format = "<?= DateFormat(1) ?>",
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
                    ew.createDateTimePicker("fpenerimaan_paket_keluarupdate", "x_tanggal_terima", jQuery.extend(true, {"useCurrent":false}, options));
                });
                </script>
                <?php } ?>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->jenis_pengirim->Visible && (!$Page->isConfirm() || $Page->jenis_pengirim->multiUpdateSelected())) { // jenis_pengirim ?>
    <div id="r_jenis_pengirim"<?= $Page->jenis_pengirim->rowAttributes() ?>>
        <label for="x_jenis_pengirim" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_jenis_pengirim" id="u_jenis_pengirim" class="form-check-input ew-multi-select" value="1"<?= $Page->jenis_pengirim->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_jenis_pengirim"><?= $Page->jenis_pengirim->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->jenis_pengirim->cellAttributes() ?>>
                <span id="el_penerimaan_paket_keluar_jenis_pengirim">
                    <select
                        id="x_jenis_pengirim"
                        name="x_jenis_pengirim"
                        class="form-select ew-select<?= $Page->jenis_pengirim->isInvalidClass() ?>"
                        data-select2-id="fpenerimaan_paket_keluarupdate_x_jenis_pengirim"
                        data-table="penerimaan_paket_keluar"
                        data-field="x_jenis_pengirim"
                        data-value-separator="<?= $Page->jenis_pengirim->displayValueSeparatorAttribute() ?>"
                        data-placeholder="<?= HtmlEncode($Page->jenis_pengirim->getPlaceHolder()) ?>"
                        <?= $Page->jenis_pengirim->editAttributes() ?>>
                        <?= $Page->jenis_pengirim->selectOptionListHtml("x_jenis_pengirim") ?>
                    </select>
                    <?= $Page->jenis_pengirim->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->jenis_pengirim->getErrorMessage() ?></div>
                <?= $Page->jenis_pengirim->Lookup->getParamTag($Page, "p_x_jenis_pengirim") ?>
                <script>
                loadjs.ready("fpenerimaan_paket_keluarupdate", function() {
                    var options = { name: "x_jenis_pengirim", selectId: "fpenerimaan_paket_keluarupdate_x_jenis_pengirim" },
                        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
                    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
                    if (fpenerimaan_paket_keluarupdate.lists.jenis_pengirim.lookupOptions.length) {
                        options.data = { id: "x_jenis_pengirim", form: "fpenerimaan_paket_keluarupdate" };
                    } else {
                        options.ajax = { id: "x_jenis_pengirim", form: "fpenerimaan_paket_keluarupdate", limit: ew.LOOKUP_PAGE_SIZE };
                    }
                    options.minimumResultsForSearch = Infinity;
                    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.penerimaan_paket_keluar.fields.jenis_pengirim.selectOptions);
                    ew.createSelect(options);
                });
                </script>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->nama_kurir->Visible && (!$Page->isConfirm() || $Page->nama_kurir->multiUpdateSelected())) { // nama_kurir ?>
    <div id="r_nama_kurir"<?= $Page->nama_kurir->rowAttributes() ?>>
        <label for="x_nama_kurir" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_nama_kurir" id="u_nama_kurir" class="form-check-input ew-multi-select" value="1"<?= $Page->nama_kurir->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_nama_kurir"><?= $Page->nama_kurir->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->nama_kurir->cellAttributes() ?>>
                <span id="el_penerimaan_paket_keluar_nama_kurir">
                <input type="<?= $Page->nama_kurir->getInputTextType() ?>" name="x_nama_kurir" id="x_nama_kurir" data-table="penerimaan_paket_keluar" data-field="x_nama_kurir" value="<?= $Page->nama_kurir->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->nama_kurir->getPlaceHolder()) ?>"<?= $Page->nama_kurir->editAttributes() ?> aria-describedby="x_nama_kurir_help">
                <?= $Page->nama_kurir->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->nama_kurir->getErrorMessage() ?></div>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->no_awb->Visible && (!$Page->isConfirm() || $Page->no_awb->multiUpdateSelected())) { // no_awb ?>
    <div id="r_no_awb"<?= $Page->no_awb->rowAttributes() ?>>
        <label for="x_no_awb" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_no_awb" id="u_no_awb" class="form-check-input ew-multi-select" value="1"<?= $Page->no_awb->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_no_awb"><?= $Page->no_awb->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->no_awb->cellAttributes() ?>>
                <span id="el_penerimaan_paket_keluar_no_awb">
                <input type="<?= $Page->no_awb->getInputTextType() ?>" name="x_no_awb" id="x_no_awb" data-table="penerimaan_paket_keluar" data-field="x_no_awb" value="<?= $Page->no_awb->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->no_awb->getPlaceHolder()) ?>"<?= $Page->no_awb->editAttributes() ?> aria-describedby="x_no_awb_help">
                <?= $Page->no_awb->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->no_awb->getErrorMessage() ?></div>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->bukti_penerimaan->Visible && (!$Page->isConfirm() || $Page->bukti_penerimaan->multiUpdateSelected())) { // bukti_penerimaan ?>
    <div id="r_bukti_penerimaan"<?= $Page->bukti_penerimaan->rowAttributes() ?>>
        <label class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_bukti_penerimaan" id="u_bukti_penerimaan" class="form-check-input ew-multi-select" value="1"<?= $Page->bukti_penerimaan->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_bukti_penerimaan"><?= $Page->bukti_penerimaan->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->bukti_penerimaan->cellAttributes() ?>>
                <span id="el_penerimaan_paket_keluar_bukti_penerimaan">
                <div id="fd_x_bukti_penerimaan" class="fileinput-button ew-file-drop-zone">
                    <input type="file" class="form-control ew-file-input" title="<?= $Page->bukti_penerimaan->title() ?>" data-table="penerimaan_paket_keluar" data-field="x_bukti_penerimaan" name="x_bukti_penerimaan" id="x_bukti_penerimaan" lang="<?= CurrentLanguageID() ?>"<?= $Page->bukti_penerimaan->editAttributes() ?> aria-describedby="x_bukti_penerimaan_help"<?= ($Page->bukti_penerimaan->ReadOnly || $Page->bukti_penerimaan->Disabled) ? " disabled" : "" ?>>
                    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
                </div>
                <?= $Page->bukti_penerimaan->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->bukti_penerimaan->getErrorMessage() ?></div>
                <input type="hidden" name="fn_x_bukti_penerimaan" id= "fn_x_bukti_penerimaan" value="<?= $Page->bukti_penerimaan->Upload->FileName ?>">
                <input type="hidden" name="fa_x_bukti_penerimaan" id= "fa_x_bukti_penerimaan" value="<?= (Post("fa_x_bukti_penerimaan") == "0") ? "0" : "1" ?>">
                <input type="hidden" name="fs_x_bukti_penerimaan" id= "fs_x_bukti_penerimaan" value="255">
                <input type="hidden" name="fx_x_bukti_penerimaan" id= "fx_x_bukti_penerimaan" value="<?= $Page->bukti_penerimaan->UploadAllowedFileExt ?>">
                <input type="hidden" name="fm_x_bukti_penerimaan" id= "fm_x_bukti_penerimaan" value="<?= $Page->bukti_penerimaan->UploadMaxFileSize ?>">
                <table id="ft_x_bukti_penerimaan" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->nama_penerima->Visible && (!$Page->isConfirm() || $Page->nama_penerima->multiUpdateSelected())) { // nama_penerima ?>
    <div id="r_nama_penerima"<?= $Page->nama_penerima->rowAttributes() ?>>
        <label for="x_nama_penerima" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_nama_penerima" id="u_nama_penerima" class="form-check-input ew-multi-select" value="1"<?= $Page->nama_penerima->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_nama_penerima"><?= $Page->nama_penerima->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->nama_penerima->cellAttributes() ?>>
                <span id="el_penerimaan_paket_keluar_nama_penerima">
                <input type="<?= $Page->nama_penerima->getInputTextType() ?>" name="x_nama_penerima" id="x_nama_penerima" data-table="penerimaan_paket_keluar" data-field="x_nama_penerima" value="<?= $Page->nama_penerima->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->nama_penerima->getPlaceHolder()) ?>"<?= $Page->nama_penerima->editAttributes() ?> aria-describedby="x_nama_penerima_help">
                <?= $Page->nama_penerima->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->nama_penerima->getErrorMessage() ?></div>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->id_user->Visible && (!$Page->isConfirm() || $Page->id_user->multiUpdateSelected())) { // id_user ?>
    <div id="r_id_user"<?= $Page->id_user->rowAttributes() ?>>
        <label for="x_id_user" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_id_user" id="u_id_user" class="form-check-input ew-multi-select" value="1"<?= $Page->id_user->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_id_user"><?= $Page->id_user->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->id_user->cellAttributes() ?>>
            </div>
        </div>
    </div>
<?php } ?>
</div><!-- /page -->
<?php if (!$Page->IsModal) { ?>
    <div class="row"><!-- buttons .row -->
        <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("UpdateBtn") ?></button>
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
    ew.addEventHandlers("penerimaan_paket_keluar");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
