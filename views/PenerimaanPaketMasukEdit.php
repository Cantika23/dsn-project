<?php

namespace Mitral2022\DSN2;

// Page object
$PenerimaanPaketMasukEdit = &$Page;
?>
<script>
    var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
    ew.deepAssign(ew.vars, {
        tables: {
            penerimaan_paket_masuk: currentTable
        }
    });
    var currentForm, currentPageID;
    var fpenerimaan_paket_masukedit;
    loadjs.ready(["wrapper", "head"], function() {
        var $ = jQuery;
        // Form object
        fpenerimaan_paket_masukedit = new ew.Form("fpenerimaan_paket_masukedit", "edit");
        currentPageID = ew.PAGE_ID = "edit";
        currentForm = fpenerimaan_paket_masukedit;

        // Add fields
        var fields = currentTable.fields;
        fpenerimaan_paket_masukedit.addFields([
            ["no_dokumen", [fields.no_dokumen.visible && fields.no_dokumen.required ? ew.Validators.required(fields.no_dokumen.caption) : null], fields.no_dokumen.isInvalid],
            ["no_paket", [fields.no_paket.visible && fields.no_paket.required ? ew.Validators.required(fields.no_paket.caption) : null], fields.no_paket.isInvalid],
            ["jenis_dokumen", [fields.jenis_dokumen.visible && fields.jenis_dokumen.required ? ew.Validators.required(fields.jenis_dokumen.caption) : null], fields.jenis_dokumen.isInvalid],
            ["nama_pengirim", [fields.nama_pengirim.visible && fields.nama_pengirim.required ? ew.Validators.required(fields.nama_pengirim.caption) : null], fields.nama_pengirim.isInvalid],
            ["keterangan", [fields.keterangan.visible && fields.keterangan.required ? ew.Validators.required(fields.keterangan.caption) : null], fields.keterangan.isInvalid],
            ["nama_penerima", [fields.nama_penerima.visible && fields.nama_penerima.required ? ew.Validators.required(fields.nama_penerima.caption) : null], fields.nama_penerima.isInvalid],
            ["email_penerima", [fields.email_penerima.visible && fields.email_penerima.required ? ew.Validators.required(fields.email_penerima.caption) : null], fields.email_penerima.isInvalid],
            ["no_hp_penerima", [fields.no_hp_penerima.visible && fields.no_hp_penerima.required ? ew.Validators.required(fields.no_hp_penerima.caption) : null], fields.no_hp_penerima.isInvalid],
            ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
            ["tanggal_terima", [fields.tanggal_terima.visible && fields.tanggal_terima.required ? ew.Validators.required(fields.tanggal_terima.caption) : null, ew.Validators.datetime(fields.tanggal_terima.clientFormatPattern)], fields.tanggal_terima.isInvalid],
            ["bukti_penerimaan", [fields.bukti_penerimaan.visible && fields.bukti_penerimaan.required ? ew.Validators.fileRequired(fields.bukti_penerimaan.caption) : null], fields.bukti_penerimaan.isInvalid],
            ["diterima_oleh", [fields.diterima_oleh.visible && fields.diterima_oleh.required ? ew.Validators.required(fields.diterima_oleh.caption) : null], fields.diterima_oleh.isInvalid]
        ]);

        // Form_CustomValidate
        fpenerimaan_paket_masukedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
            // Your custom validation code here, return false if invalid.
            return true;
        }

        // Use JavaScript validation or not
        fpenerimaan_paket_masukedit.validateRequired = ew.CLIENT_VALIDATE;

        // Dynamic selection lists
        fpenerimaan_paket_masukedit.lists.jenis_dokumen = <?= $Page->jenis_dokumen->toClientList($Page) ?>;
        fpenerimaan_paket_masukedit.lists.nama_penerima = <?= $Page->nama_penerima->toClientList($Page) ?>;
        fpenerimaan_paket_masukedit.lists.status = <?= $Page->status->toClientList($Page) ?>;
        loadjs.done("fpenerimaan_paket_masukedit");
    });
</script>
<script>
    loadjs.ready("head", function() {
        // Write your table-specific client script here, no need to add script tags.
    });
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fpenerimaan_paket_masukedit" id="fpenerimaan_paket_masukedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
    <?php if (Config("CHECK_TOKEN")) { ?>
        <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
        <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
    <?php } ?>
    <input type="hidden" name="t" value="penerimaan_paket_masuk">
    <input type="hidden" name="action" id="action" value="update">
    <input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
    <input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
    <div class="ew-edit-div"><!-- page* -->
        <?php if ($Page->no_dokumen->Visible) { // no_dokumen 
        ?>
            <div id="r_no_dokumen" <?= $Page->no_dokumen->rowAttributes() ?>>
                <label id="elh_penerimaan_paket_masuk_no_dokumen" for="x_no_dokumen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_dokumen->caption() ?><?= $Page->no_dokumen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
                <div class="<?= $Page->RightColumnClass ?>">
                    <div<?= $Page->no_dokumen->cellAttributes() ?>>
                        <span id="el_penerimaan_paket_masuk_no_dokumen">
                            <input type="<?= $Page->no_dokumen->getInputTextType() ?>" name="x_no_dokumen" id="x_no_dokumen" data-table="penerimaan_paket_masuk" data-field="x_no_dokumen" value="<?= $Page->no_dokumen->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->no_dokumen->getPlaceHolder()) ?>" <?= $Page->no_dokumen->editAttributes() ?> aria-describedby="x_no_dokumen_help">
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
        <label id="elh_penerimaan_paket_masuk_no_paket" for="x_no_paket" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_paket->caption() ?><?= $Page->no_paket->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->no_paket->cellAttributes() ?>>
                <span id="el_penerimaan_paket_masuk_no_paket">
                    <input type="<?= $Page->no_paket->getInputTextType() ?>" name="x_no_paket" id="x_no_paket" data-table="penerimaan_paket_masuk" data-field="x_no_paket" value="<?= $Page->no_paket->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->no_paket->getPlaceHolder()) ?>" <?= $Page->no_paket->editAttributes() ?> aria-describedby="x_no_paket_help">
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
        <label id="elh_penerimaan_paket_masuk_jenis_dokumen" for="x_jenis_dokumen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenis_dokumen->caption() ?><?= $Page->jenis_dokumen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->jenis_dokumen->cellAttributes() ?>>
                <span id="el_penerimaan_paket_masuk_jenis_dokumen">
                    <select id="x_jenis_dokumen" name="x_jenis_dokumen" class="form-select ew-select<?= $Page->jenis_dokumen->isInvalidClass() ?>" data-select2-id="fpenerimaan_paket_masukedit_x_jenis_dokumen" data-table="penerimaan_paket_masuk" data-field="x_jenis_dokumen" data-value-separator="<?= $Page->jenis_dokumen->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->jenis_dokumen->getPlaceHolder()) ?>" <?= $Page->jenis_dokumen->editAttributes() ?>>
                        <?= $Page->jenis_dokumen->selectOptionListHtml("x_jenis_dokumen") ?>
                    </select>
                    <?= $Page->jenis_dokumen->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->jenis_dokumen->getErrorMessage() ?></div>
                    <?= $Page->jenis_dokumen->Lookup->getParamTag($Page, "p_x_jenis_dokumen") ?>
                    <script>
                        loadjs.ready("fpenerimaan_paket_masukedit", function() {
                            var options = {
                                    name: "x_jenis_dokumen",
                                    selectId: "fpenerimaan_paket_masukedit_x_jenis_dokumen"
                                },
                                el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
                            options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
                            if (fpenerimaan_paket_masukedit.lists.jenis_dokumen.lookupOptions.length) {
                                options.data = {
                                    id: "x_jenis_dokumen",
                                    form: "fpenerimaan_paket_masukedit"
                                };
                            } else {
                                options.ajax = {
                                    id: "x_jenis_dokumen",
                                    form: "fpenerimaan_paket_masukedit",
                                    limit: ew.LOOKUP_PAGE_SIZE
                                };
                            }
                            options.minimumResultsForSearch = Infinity;
                            options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.penerimaan_paket_masuk.fields.jenis_dokumen.selectOptions);
                            ew.createSelect(options);
                        });
                    </script>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->nama_pengirim->Visible) { // nama_pengirim 
?>
    <div id="r_nama_pengirim" <?= $Page->nama_pengirim->rowAttributes() ?>>
        <label id="elh_penerimaan_paket_masuk_nama_pengirim" for="x_nama_pengirim" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_pengirim->caption() ?><?= $Page->nama_pengirim->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->nama_pengirim->cellAttributes() ?>>
                <span id="el_penerimaan_paket_masuk_nama_pengirim">
                    <input type="<?= $Page->nama_pengirim->getInputTextType() ?>" name="x_nama_pengirim" id="x_nama_pengirim" data-table="penerimaan_paket_masuk" data-field="x_nama_pengirim" value="<?= $Page->nama_pengirim->EditValue ?>" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->nama_pengirim->getPlaceHolder()) ?>" <?= $Page->nama_pengirim->editAttributes() ?> aria-describedby="x_nama_pengirim_help">
                    <?= $Page->nama_pengirim->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->nama_pengirim->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan 
?>
    <div id="r_keterangan" <?= $Page->keterangan->rowAttributes() ?>>
        <label id="elh_penerimaan_paket_masuk_keterangan" for="x_keterangan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->keterangan->caption() ?><?= $Page->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->keterangan->cellAttributes() ?>>
                <span id="el_penerimaan_paket_masuk_keterangan">
                    <textarea data-table="penerimaan_paket_masuk" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->keterangan->getPlaceHolder()) ?>" <?= $Page->keterangan->editAttributes() ?> aria-describedby="x_keterangan_help"><?= $Page->keterangan->EditValue ?></textarea>
                    <?= $Page->keterangan->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->keterangan->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->nama_penerima->Visible) { // nama_penerima 
?>
    <div id="r_nama_penerima" <?= $Page->nama_penerima->rowAttributes() ?>>
        <label id="elh_penerimaan_paket_masuk_nama_penerima" for="x_nama_penerima" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_penerima->caption() ?><?= $Page->nama_penerima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->nama_penerima->cellAttributes() ?>>
                <span id="el_penerimaan_paket_masuk_nama_penerima">
                    <select id="x_nama_penerima" name="x_nama_penerima" class="form-select ew-select<?= $Page->nama_penerima->isInvalidClass() ?>" data-select2-id="fpenerimaan_paket_masukedit_x_nama_penerima" data-table="penerimaan_paket_masuk" data-field="x_nama_penerima" data-value-separator="<?= $Page->nama_penerima->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->nama_penerima->getPlaceHolder()) ?>" <?= $Page->nama_penerima->editAttributes() ?>>
                        <?= $Page->nama_penerima->selectOptionListHtml("x_nama_penerima") ?>
                    </select>
                    <?= $Page->nama_penerima->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->nama_penerima->getErrorMessage() ?></div>
                    <?= $Page->nama_penerima->Lookup->getParamTag($Page, "p_x_nama_penerima") ?>
                    <script>
                        loadjs.ready("fpenerimaan_paket_masukedit", function() {
                            var options = {
                                    name: "x_nama_penerima",
                                    selectId: "fpenerimaan_paket_masukedit_x_nama_penerima"
                                },
                                el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
                            options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
                            if (fpenerimaan_paket_masukedit.lists.nama_penerima.lookupOptions.length) {
                                options.data = {
                                    id: "x_nama_penerima",
                                    form: "fpenerimaan_paket_masukedit"
                                };
                            } else {
                                options.ajax = {
                                    id: "x_nama_penerima",
                                    form: "fpenerimaan_paket_masukedit",
                                    limit: ew.LOOKUP_PAGE_SIZE
                                };
                            }
                            options.minimumInputLength = ew.selectMinimumInputLength;
                            options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.penerimaan_paket_masuk.fields.nama_penerima.selectOptions);
                            ew.createSelect(options);
                        });
                    </script>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->email_penerima->Visible) { // email_penerima 
?>
    <div id="r_email_penerima" <?= $Page->email_penerima->rowAttributes() ?>>
        <label id="elh_penerimaan_paket_masuk_email_penerima" for="x_email_penerima" class="<?= $Page->LeftColumnClass ?>"><?= $Page->email_penerima->caption() ?><?= $Page->email_penerima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->email_penerima->cellAttributes() ?>>
                <span id="el_penerimaan_paket_masuk_email_penerima">
                    <input type="<?= $Page->email_penerima->getInputTextType() ?>" name="x_email_penerima" id="x_email_penerima" data-table="penerimaan_paket_masuk" data-field="x_email_penerima" value="<?= $Page->email_penerima->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->email_penerima->getPlaceHolder()) ?>" <?= $Page->email_penerima->editAttributes() ?> aria-describedby="x_email_penerima_help">
                    <?= $Page->email_penerima->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->email_penerima->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->no_hp_penerima->Visible) { // no_hp_penerima 
?>
    <div id="r_no_hp_penerima" <?= $Page->no_hp_penerima->rowAttributes() ?>>
        <label id="elh_penerimaan_paket_masuk_no_hp_penerima" for="x_no_hp_penerima" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_hp_penerima->caption() ?><?= $Page->no_hp_penerima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->no_hp_penerima->cellAttributes() ?>>
                <span id="el_penerimaan_paket_masuk_no_hp_penerima">
                    <input type="<?= $Page->no_hp_penerima->getInputTextType() ?>" name="x_no_hp_penerima" id="x_no_hp_penerima" data-table="penerimaan_paket_masuk" data-field="x_no_hp_penerima" value="<?= $Page->no_hp_penerima->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->no_hp_penerima->getPlaceHolder()) ?>" <?= $Page->no_hp_penerima->editAttributes() ?> aria-describedby="x_no_hp_penerima_help">
                    <?= $Page->no_hp_penerima->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->no_hp_penerima->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status 
?>
    <div id="r_status" <?= $Page->status->rowAttributes() ?>>
        <label id="elh_penerimaan_paket_masuk_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->status->cellAttributes() ?>>
                <span id="el_penerimaan_paket_masuk_status">
                    <select id="x_status" name="x_status" class="form-select ew-select<?= $Page->status->isInvalidClass() ?>" data-select2-id="fpenerimaan_paket_masukedit_x_status" data-table="penerimaan_paket_masuk" data-field="x_status" data-value-separator="<?= $Page->status->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>" <?= $Page->status->editAttributes() ?>>
                        <?= $Page->status->selectOptionListHtml("x_status") ?>
                    </select>
                    <?= $Page->status->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
                    <?= $Page->status->Lookup->getParamTag($Page, "p_x_status") ?>
                    <script>
                        loadjs.ready("fpenerimaan_paket_masukedit", function() {
                            var options = {
                                    name: "x_status",
                                    selectId: "fpenerimaan_paket_masukedit_x_status"
                                },
                                el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
                            options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
                            if (fpenerimaan_paket_masukedit.lists.status.lookupOptions.length) {
                                options.data = {
                                    id: "x_status",
                                    form: "fpenerimaan_paket_masukedit"
                                };
                            } else {
                                options.ajax = {
                                    id: "x_status",
                                    form: "fpenerimaan_paket_masukedit",
                                    limit: ew.LOOKUP_PAGE_SIZE
                                };
                            }
                            options.minimumResultsForSearch = Infinity;
                            options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.penerimaan_paket_masuk.fields.status.selectOptions);
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
        <label id="elh_penerimaan_paket_masuk_tanggal_terima" for="x_tanggal_terima" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tanggal_terima->caption() ?><?= $Page->tanggal_terima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->tanggal_terima->cellAttributes() ?>>
                <span id="el_penerimaan_paket_masuk_tanggal_terima">
                    <input type="<?= $Page->tanggal_terima->getInputTextType() ?>" name="x_tanggal_terima" id="x_tanggal_terima" data-table="penerimaan_paket_masuk" data-field="x_tanggal_terima" value="<?= $Page->tanggal_terima->EditValue ?>" placeholder="<?= HtmlEncode($Page->tanggal_terima->getPlaceHolder()) ?>" <?= $Page->tanggal_terima->editAttributes() ?> aria-describedby="x_tanggal_terima_help">
                    <?= $Page->tanggal_terima->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->tanggal_terima->getErrorMessage() ?></div>
                    <?php if (!$Page->tanggal_terima->ReadOnly && !$Page->tanggal_terima->Disabled && !isset($Page->tanggal_terima->EditAttrs["readonly"]) && !isset($Page->tanggal_terima->EditAttrs["disabled"])) { ?>
                        <script>
                            loadjs.ready(["fpenerimaan_paket_masukedit", "datetimepicker"], function() {
                                let format = "<?= "dd-MM-yyyy HH:mm:ss" ?>",
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
                                ew.createDateTimePicker("fpenerimaan_paket_masukedit", "x_tanggal_terima", jQuery.extend(true, {
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
<?php if ($Page->bukti_penerimaan->Visible) { // bukti_penerimaan 
?>
    <div id="r_bukti_penerimaan" <?= $Page->bukti_penerimaan->rowAttributes() ?>>
        <label id="elh_penerimaan_paket_masuk_bukti_penerimaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bukti_penerimaan->caption() ?><?= $Page->bukti_penerimaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->bukti_penerimaan->cellAttributes() ?>>
                <span id="el_penerimaan_paket_masuk_bukti_penerimaan">
                    <div id="fd_x_bukti_penerimaan" class="fileinput-button ew-file-drop-zone">
                        <input type="file" class="form-control ew-file-input" title="<?= $Page->bukti_penerimaan->title() ?>" data-table="penerimaan_paket_masuk" data-field="x_bukti_penerimaan" name="x_bukti_penerimaan" id="x_bukti_penerimaan" lang="<?= CurrentLanguageID() ?>" <?= $Page->bukti_penerimaan->editAttributes() ?> aria-describedby="x_bukti_penerimaan_help" <?= ($Page->bukti_penerimaan->ReadOnly || $Page->bukti_penerimaan->Disabled) ? " disabled" : "" ?>>
                        <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
                    </div>
                    <?= $Page->bukti_penerimaan->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->bukti_penerimaan->getErrorMessage() ?></div>
                    <input type="hidden" name="fn_x_bukti_penerimaan" id="fn_x_bukti_penerimaan" value="<?= $Page->bukti_penerimaan->Upload->FileName ?>">
                    <input type="hidden" name="fa_x_bukti_penerimaan" id="fa_x_bukti_penerimaan" value="<?= (Post("fa_x_bukti_penerimaan") == "0") ? "0" : "1" ?>">
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
<?php if ($Page->diterima_oleh->Visible) { // diterima_oleh 
?>
    <div id="r_diterima_oleh" <?= $Page->diterima_oleh->rowAttributes() ?>>
        <label id="elh_penerimaan_paket_masuk_diterima_oleh" for="x_diterima_oleh" class="<?= $Page->LeftColumnClass ?>"><?= $Page->diterima_oleh->caption() ?><?= $Page->diterima_oleh->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->diterima_oleh->cellAttributes() ?>>
                <span id="el_penerimaan_paket_masuk_diterima_oleh">
                    <input type="<?= $Page->diterima_oleh->getInputTextType() ?>" name="x_diterima_oleh" id="x_diterima_oleh" data-table="penerimaan_paket_masuk" data-field="x_diterima_oleh" value="<?= $Page->diterima_oleh->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->diterima_oleh->getPlaceHolder()) ?>" <?= $Page->diterima_oleh->editAttributes() ?> aria-describedby="x_diterima_oleh_help">
                    <?= $Page->diterima_oleh->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->diterima_oleh->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
</div><!-- /page* -->
<input type="hidden" data-table="penerimaan_paket_masuk" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
<?php if (!$Page->IsModal) { ?>
    <div class="row"><!-- buttons .row -->
        <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
            <button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
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
        ew.addEventHandlers("penerimaan_paket_masuk");
    });
</script>
<script>
    loadjs.ready("load", function() {
        // Startup script
        // Write your table-specific startup script here, no need to add script tags.
        $("#x_nama_penerima").change(function() {
            //	console.log(ew.getApiUrl(["view", "user", $(this).val()]));
            $.get(ew.getApiUrl(["view", "user", $(this).val()]), function(res) { // Get response from API
                if (res && res.success) {
                    var row = res["user"];
                    $("#x_email_penerima").val(row["email"]);
                    $("#x_no_hp_penerima").val(row["phone"]); // isi hasil ke field target
                    console.log(row);
                } else {
                    ew.alert(res.failureMessage);
                }
            });
        });
    });
</script>