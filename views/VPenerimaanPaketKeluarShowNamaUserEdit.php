<?php

namespace Mitral2022\DSN2;

// Page object
$VPenerimaanPaketKeluarShowNamaUserEdit = &$Page;
?>
<script>
    var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
    ew.deepAssign(ew.vars, {
        tables: {
            v_penerimaan_paket_keluar_show_nama_user: currentTable
        }
    });
    var currentForm, currentPageID;
    var fv_penerimaan_paket_keluar_show_nama_useredit;
    loadjs.ready(["wrapper", "head"], function() {
        var $ = jQuery;
        // Form object
        fv_penerimaan_paket_keluar_show_nama_useredit = new ew.Form("fv_penerimaan_paket_keluar_show_nama_useredit", "edit");
        currentPageID = ew.PAGE_ID = "edit";
        currentForm = fv_penerimaan_paket_keluar_show_nama_useredit;

        // Add fields
        var fields = currentTable.fields;
        fv_penerimaan_paket_keluar_show_nama_useredit.addFields([
            ["NoDokumen", [fields.NoDokumen.visible && fields.NoDokumen.required ? ew.Validators.required(fields.NoDokumen.caption) : null], fields.NoDokumen.isInvalid],
            ["NoPaket", [fields.NoPaket.visible && fields.NoPaket.required ? ew.Validators.required(fields.NoPaket.caption) : null], fields.NoPaket.isInvalid],
            ["JenisDokumen", [fields.JenisDokumen.visible && fields.JenisDokumen.required ? ew.Validators.required(fields.JenisDokumen.caption) : null, ew.Validators.integer], fields.JenisDokumen.isInvalid],
            ["Penerima", [fields.Penerima.visible && fields.Penerima.required ? ew.Validators.required(fields.Penerima.caption) : null], fields.Penerima.isInvalid],
            ["NoHPPenerima", [fields.NoHPPenerima.visible && fields.NoHPPenerima.required ? ew.Validators.required(fields.NoHPPenerima.caption) : null], fields.NoHPPenerima.isInvalid],
            ["EmailPenerima", [fields.EmailPenerima.visible && fields.EmailPenerima.required ? ew.Validators.required(fields.EmailPenerima.caption) : null], fields.EmailPenerima.isInvalid],
            ["Status", [fields.Status.visible && fields.Status.required ? ew.Validators.required(fields.Status.caption) : null, ew.Validators.integer], fields.Status.isInvalid],
            ["TanggalTerima", [fields.TanggalTerima.visible && fields.TanggalTerima.required ? ew.Validators.required(fields.TanggalTerima.caption) : null, ew.Validators.datetime(fields.TanggalTerima.clientFormatPattern)], fields.TanggalTerima.isInvalid],
            ["MetodePengiriman", [fields.MetodePengiriman.visible && fields.MetodePengiriman.required ? ew.Validators.required(fields.MetodePengiriman.caption) : null, ew.Validators.integer], fields.MetodePengiriman.isInvalid],
            ["NamaEkspedisiMessenger", [fields.NamaEkspedisiMessenger.visible && fields.NamaEkspedisiMessenger.required ? ew.Validators.required(fields.NamaEkspedisiMessenger.caption) : null], fields.NamaEkspedisiMessenger.isInvalid],
            ["NoAWB", [fields.NoAWB.visible && fields.NoAWB.required ? ew.Validators.required(fields.NoAWB.caption) : null], fields.NoAWB.isInvalid],
            ["PIC", [fields.PIC.visible && fields.PIC.required ? ew.Validators.required(fields.PIC.caption) : null], fields.PIC.isInvalid],
            ["BuktiPenerimaan", [fields.BuktiPenerimaan.visible && fields.BuktiPenerimaan.required ? ew.Validators.required(fields.BuktiPenerimaan.caption) : null], fields.BuktiPenerimaan.isInvalid],
            ["NamaPenerima", [fields.NamaPenerima.visible && fields.NamaPenerima.required ? ew.Validators.required(fields.NamaPenerima.caption) : null], fields.NamaPenerima.isInvalid],
            ["StatusSAP", [fields.StatusSAP.visible && fields.StatusSAP.required ? ew.Validators.required(fields.StatusSAP.caption) : null, ew.Validators.integer], fields.StatusSAP.isInvalid]
        ]);

        // Form_CustomValidate
        fv_penerimaan_paket_keluar_show_nama_useredit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
            // Your custom validation code here, return false if invalid.
            //var metodePengiriman = $("#x_jenis_pengirim").val();

            //if(metodePengiriman == '2'){
            //	$('#x_no_awb').val('');
            //}
            return true;
        }

        // Use JavaScript validation or not
        fv_penerimaan_paket_keluar_show_nama_useredit.validateRequired = ew.CLIENT_VALIDATE;

        // Dynamic selection lists
        loadjs.done("fv_penerimaan_paket_keluar_show_nama_useredit");
    });
</script>
<script>
    loadjs.ready("head", function() {
        // Client script
        // Write your table-specific client script here, no need to add script tags.
        $('#r_status_sap').hide();
        $('#x_id_user').select2({
            disabled: true
        });
        $('#x_created_date').readonly(true).css({
            'background-color': '#eeeeee'
        });
        var statusSap = $('#x_status_sap').val();
        var metodePengiriman = $("#x_jenis_pengirim").val();
        if (statusSap === '3') {
            $('#x_no_dokumen').readonly(true).css({
                'background-color': '#eeeeee'
            });
            $('#x_tanggal_terima').readonly(true).css({
                'background-color': '#eeeeee'
            });
            $('#x_nama_penerima').readonly(true).css({
                'background-color': '#eeeeee'
            });
            $('#x_no_hp_penerima').readonly(true).css({
                'background-color': '#eeeeee'
            });
            $('#x_email_penerima').readonly(true).css({
                'background-color': '#eeeeee'
            });
            $('#x_tujuan_penerima').readonly(true).css({
                'background-color': '#eeeeee'
            });

            // dropdown
            $('#x_status').select2({
                disabled: true
            });
            // dropdown
            $('#x_jenis_dokumen').select2({
                disabled: true
            });

            // dropdown
            $('#x_jenis_pengirim').select2({
                disabled: true
            });
            if (metodePengiriman === "2") {
                // input text
                $('#x_nama_kurir').prop('disabled', true);
            } else {
                // dropdown
                $('#x_nama_kurir').select2({
                    disabled: true
                });
            }
            $('#x_no_awb').readonly(true).css({
                'background-color': '#eeeeee'
            });
            $('#x_no_paket').readonly(true).css({
                'background-color': '#eeeeee'
            });
        } else if (statusSap === '2') {
            // dropdown
            $('#x_jenis_pengirim').select2({
                disabled: true
            });
            var ekspedisiOrMessenger = $("#x_nama_kurir").val();
            if (metodePengiriman === '2') {
                $("#elh_penerimaan_paket_keluar_nama_kurir").text("Nama Messenger");
                $("#el_penerimaan_paket_keluar_nama_kurir").html('<input type="text" name="x_nama_kurir" id="x_nama_kurir" data-table="penerimaan_paket_keluar" data-field="x_nama_kurir" value="' + ekspedisiOrMessenger + '" size="30" maxlength="255" placeholder="Nama Messenger" class="form-control" aria-describedby="x_nama_kurir_help">');
                $('#r_no_awb').hide();

                // input text
                $('#x_nama_kurir').prop('disabled', true);
            } else {
                $("#elh_penerimaan_paket_keluar_nama_kurir").text("Nama Ekspedisi");
                $("#el_penerimaan_paket_keluar_nama_kurir").html(`<select name="x_nama_kurir" id="x_nama_kurir" data-table="penerimaan_paket_keluar" data-field="x_nama_kurir" class="form-control" aria-describedby="x_nama_kurir_help">
    															<option value="JNE" ' + (ekspedisiOrMessenger == "JNE" ? "selected" : "") + '>JNE</option>
    															<option value="TIKI" ' + (ekspedisiOrMessenger == "TIKI" ? "selected" : "") + '>TIKI</option>
    														</select>`);

                // dropdown
                $('#x_nama_kurir').select2({
                    disabled: true
                });
            }

            // dropdown
            $('#x_status').select2({
                disabled: true
            });
            var tanggalTerima = $('#x_tanggal_terima').val();
            if (tanggalTerima != '') {
                $('#x_tanggal_terima').readonly(true).css({
                    'background-color': '#eeeeee'
                });
            }
            $('#x_no_awb').readonly(true).css({
                'background-color': '#eeeeee'
            });
        } else {
            var ekspedisiOrMessenger = $("#x_nama_kurir").val();
            if (metodePengiriman === '2') {
                $("#elh_penerimaan_paket_keluar_nama_kurir").text("Nama Messenger");
                $("#el_penerimaan_paket_keluar_nama_kurir").html('<input type="text" name="x_nama_kurir" id="x_nama_kurir" data-table="penerimaan_paket_keluar" data-field="x_nama_kurir" value="' + ekspedisiOrMessenger + '" size="30" maxlength="255" placeholder="Nama Messenger" class="form-control" aria-describedby="x_nama_kurir_help">');
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
                var ekspedisiOrMessenger = $("#x_nama_kurir").val();
                if ($(this).val() === '2') {
                    $("#elh_penerimaan_paket_keluar_nama_kurir").text("Nama Messenger");
                    $("#el_penerimaan_paket_keluar_nama_kurir").html('<input type="text" name="x_nama_kurir" id="x_nama_kurir" data-table="penerimaan_paket_keluar" data-field="x_nama_kurir" value="' + ekspedisiOrMessenger + '" size="30" maxlength="255" placeholder="Nama Messenger" class="form-control" aria-describedby="x_nama_kurir_help">');
                    $('#r_no_awb').hide();
                } else if ($(this).val() === '1') {
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
            });
        }
    });
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fv_penerimaan_paket_keluar_show_nama_useredit" id="fv_penerimaan_paket_keluar_show_nama_useredit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
    <?php if (Config("CHECK_TOKEN")) { ?>
        <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
        <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
    <?php } ?>
    <input type="hidden" name="t" value="v_penerimaan_paket_keluar_show_nama_user">
    <input type="hidden" name="action" id="action" value="update">
    <input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
    <input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
    <div class="ew-edit-div"><!-- page* -->
        <?php if ($Page->NoDokumen->Visible) { // No Dokumen 
        ?>
            <div id="r_NoDokumen" <?= $Page->NoDokumen->rowAttributes() ?>>
                <label id="elh_v_penerimaan_paket_keluar_show_nama_user_NoDokumen" for="x_NoDokumen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NoDokumen->caption() ?><?= $Page->NoDokumen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
                <div class="<?= $Page->RightColumnClass ?>">
                    <div<?= $Page->NoDokumen->cellAttributes() ?>>
                        <span id="el_v_penerimaan_paket_keluar_show_nama_user_NoDokumen">
                            <input type="<?= $Page->NoDokumen->getInputTextType() ?>" name="x_NoDokumen" id="x_NoDokumen" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_NoDokumen" value="<?= $Page->NoDokumen->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->NoDokumen->getPlaceHolder()) ?>" <?= $Page->NoDokumen->editAttributes() ?> aria-describedby="x_NoDokumen_help">
                            <?= $Page->NoDokumen->getCustomMessage() ?>
                            <div class="invalid-feedback"><?= $Page->NoDokumen->getErrorMessage() ?></div>
                        </span>
                </div>
            </div>
    </div>
<?php } ?>
<?php if ($Page->NoPaket->Visible) { // No Paket 
?>
    <div id="r_NoPaket" <?= $Page->NoPaket->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_NoPaket" for="x_NoPaket" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NoPaket->caption() ?><?= $Page->NoPaket->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->NoPaket->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_NoPaket">
                    <input type="<?= $Page->NoPaket->getInputTextType() ?>" name="x_NoPaket" id="x_NoPaket" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_NoPaket" value="<?= $Page->NoPaket->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->NoPaket->getPlaceHolder()) ?>" <?= $Page->NoPaket->editAttributes() ?> aria-describedby="x_NoPaket_help">
                    <?= $Page->NoPaket->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->NoPaket->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->JenisDokumen->Visible) { // Jenis Dokumen 
?>
    <div id="r_JenisDokumen" <?= $Page->JenisDokumen->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_JenisDokumen" for="x_JenisDokumen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->JenisDokumen->caption() ?><?= $Page->JenisDokumen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->JenisDokumen->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_JenisDokumen">
                    <input type="<?= $Page->JenisDokumen->getInputTextType() ?>" name="x_JenisDokumen" id="x_JenisDokumen" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_JenisDokumen" value="<?= $Page->JenisDokumen->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->JenisDokumen->getPlaceHolder()) ?>" <?= $Page->JenisDokumen->editAttributes() ?> aria-describedby="x_JenisDokumen_help">
                    <?= $Page->JenisDokumen->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->JenisDokumen->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->Penerima->Visible) { // Penerima 
?>
    <div id="r_Penerima" <?= $Page->Penerima->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_Penerima" for="x_Penerima" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Penerima->caption() ?><?= $Page->Penerima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->Penerima->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_Penerima">
                    <input type="<?= $Page->Penerima->getInputTextType() ?>" name="x_Penerima" id="x_Penerima" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_Penerima" value="<?= $Page->Penerima->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->Penerima->getPlaceHolder()) ?>" <?= $Page->Penerima->editAttributes() ?> aria-describedby="x_Penerima_help">
                    <?= $Page->Penerima->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->Penerima->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->NoHPPenerima->Visible) { // No HP Penerima 
?>
    <div id="r_NoHPPenerima" <?= $Page->NoHPPenerima->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_NoHPPenerima" for="x_NoHPPenerima" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NoHPPenerima->caption() ?><?= $Page->NoHPPenerima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->NoHPPenerima->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_NoHPPenerima">
                    <input type="<?= $Page->NoHPPenerima->getInputTextType() ?>" name="x_NoHPPenerima" id="x_NoHPPenerima" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_NoHPPenerima" value="<?= $Page->NoHPPenerima->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->NoHPPenerima->getPlaceHolder()) ?>" <?= $Page->NoHPPenerima->editAttributes() ?> aria-describedby="x_NoHPPenerima_help">
                    <?= $Page->NoHPPenerima->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->NoHPPenerima->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->EmailPenerima->Visible) { // Email Penerima 
?>
    <div id="r_EmailPenerima" <?= $Page->EmailPenerima->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_EmailPenerima" for="x_EmailPenerima" class="<?= $Page->LeftColumnClass ?>"><?= $Page->EmailPenerima->caption() ?><?= $Page->EmailPenerima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->EmailPenerima->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_EmailPenerima">
                    <input type="<?= $Page->EmailPenerima->getInputTextType() ?>" name="x_EmailPenerima" id="x_EmailPenerima" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_EmailPenerima" value="<?= $Page->EmailPenerima->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->EmailPenerima->getPlaceHolder()) ?>" <?= $Page->EmailPenerima->editAttributes() ?> aria-describedby="x_EmailPenerima_help">
                    <?= $Page->EmailPenerima->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->EmailPenerima->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->Status->Visible) { // Status 
?>
    <div id="r_Status" <?= $Page->Status->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_Status" for="x_Status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Status->caption() ?><?= $Page->Status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->Status->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_Status">
                    <input type="<?= $Page->Status->getInputTextType() ?>" name="x_Status" id="x_Status" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_Status" value="<?= $Page->Status->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->Status->getPlaceHolder()) ?>" <?= $Page->Status->editAttributes() ?> aria-describedby="x_Status_help">
                    <?= $Page->Status->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->Status->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->TanggalTerima->Visible) { // Tanggal Terima 
?>
    <div id="r_TanggalTerima" <?= $Page->TanggalTerima->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_TanggalTerima" for="x_TanggalTerima" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TanggalTerima->caption() ?><?= $Page->TanggalTerima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->TanggalTerima->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_TanggalTerima">
                    <input type="<?= $Page->TanggalTerima->getInputTextType() ?>" name="x_TanggalTerima" id="x_TanggalTerima" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_TanggalTerima" value="<?= $Page->TanggalTerima->EditValue ?>" placeholder="<?= HtmlEncode($Page->TanggalTerima->getPlaceHolder()) ?>" <?= $Page->TanggalTerima->editAttributes() ?> aria-describedby="x_TanggalTerima_help">
                    <?= $Page->TanggalTerima->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->TanggalTerima->getErrorMessage() ?></div>
                    <?php if (!$Page->TanggalTerima->ReadOnly && !$Page->TanggalTerima->Disabled && !isset($Page->TanggalTerima->EditAttrs["readonly"]) && !isset($Page->TanggalTerima->EditAttrs["disabled"])) { ?>
                        <script>
                            loadjs.ready(["fv_penerimaan_paket_keluar_show_nama_useredit", "datetimepicker"], function() {
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
                                ew.createDateTimePicker("fv_penerimaan_paket_keluar_show_nama_useredit", "x_TanggalTerima", jQuery.extend(true, {
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
<?php if ($Page->MetodePengiriman->Visible) { // Metode Pengiriman 
?>
    <div id="r_MetodePengiriman" <?= $Page->MetodePengiriman->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_MetodePengiriman" for="x_MetodePengiriman" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MetodePengiriman->caption() ?><?= $Page->MetodePengiriman->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->MetodePengiriman->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_MetodePengiriman">
                    <input type="<?= $Page->MetodePengiriman->getInputTextType() ?>" name="x_MetodePengiriman" id="x_MetodePengiriman" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_MetodePengiriman" value="<?= $Page->MetodePengiriman->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->MetodePengiriman->getPlaceHolder()) ?>" <?= $Page->MetodePengiriman->editAttributes() ?> aria-describedby="x_MetodePengiriman_help">
                    <?= $Page->MetodePengiriman->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->MetodePengiriman->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->NamaEkspedisiMessenger->Visible) { // Nama Ekspedisi/Messenger 
?>
    <div id="r_NamaEkspedisiMessenger" <?= $Page->NamaEkspedisiMessenger->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_NamaEkspedisiMessenger" for="x_NamaEkspedisiMessenger" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NamaEkspedisiMessenger->caption() ?><?= $Page->NamaEkspedisiMessenger->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->NamaEkspedisiMessenger->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_NamaEkspedisiMessenger">
                    <input type="<?= $Page->NamaEkspedisiMessenger->getInputTextType() ?>" name="x_NamaEkspedisiMessenger" id="x_NamaEkspedisiMessenger" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_NamaEkspedisiMessenger" value="<?= $Page->NamaEkspedisiMessenger->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->NamaEkspedisiMessenger->getPlaceHolder()) ?>" <?= $Page->NamaEkspedisiMessenger->editAttributes() ?> aria-describedby="x_NamaEkspedisiMessenger_help">
                    <?= $Page->NamaEkspedisiMessenger->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->NamaEkspedisiMessenger->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->NoAWB->Visible) { // No AWB 
?>
    <div id="r_NoAWB" <?= $Page->NoAWB->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_NoAWB" for="x_NoAWB" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NoAWB->caption() ?><?= $Page->NoAWB->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->NoAWB->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_NoAWB">
                    <input type="<?= $Page->NoAWB->getInputTextType() ?>" name="x_NoAWB" id="x_NoAWB" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_NoAWB" value="<?= $Page->NoAWB->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->NoAWB->getPlaceHolder()) ?>" <?= $Page->NoAWB->editAttributes() ?> aria-describedby="x_NoAWB_help">
                    <?= $Page->NoAWB->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->NoAWB->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->PIC->Visible) { // PIC 
?>
    <div id="r_PIC" <?= $Page->PIC->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_PIC" for="x_PIC" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PIC->caption() ?><?= $Page->PIC->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->PIC->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_PIC">
                    <input type="<?= $Page->PIC->getInputTextType() ?>" name="x_PIC" id="x_PIC" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_PIC" value="<?= $Page->PIC->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->PIC->getPlaceHolder()) ?>" <?= $Page->PIC->editAttributes() ?> aria-describedby="x_PIC_help">
                    <?= $Page->PIC->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->PIC->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->BuktiPenerimaan->Visible) { // Bukti Penerimaan 
?>
    <div id="r_BuktiPenerimaan" <?= $Page->BuktiPenerimaan->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_BuktiPenerimaan" for="x_BuktiPenerimaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->BuktiPenerimaan->caption() ?><?= $Page->BuktiPenerimaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->BuktiPenerimaan->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_BuktiPenerimaan">
                    <input type="<?= $Page->BuktiPenerimaan->getInputTextType() ?>" name="x_BuktiPenerimaan" id="x_BuktiPenerimaan" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_BuktiPenerimaan" value="<?= $Page->BuktiPenerimaan->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->BuktiPenerimaan->getPlaceHolder()) ?>" <?= $Page->BuktiPenerimaan->editAttributes() ?> aria-describedby="x_BuktiPenerimaan_help">
                    <?= $Page->BuktiPenerimaan->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->BuktiPenerimaan->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->NamaPenerima->Visible) { // Nama Penerima 
?>
    <div id="r_NamaPenerima" <?= $Page->NamaPenerima->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_NamaPenerima" for="x_NamaPenerima" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NamaPenerima->caption() ?><?= $Page->NamaPenerima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->NamaPenerima->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_NamaPenerima">
                    <input type="<?= $Page->NamaPenerima->getInputTextType() ?>" name="x_NamaPenerima" id="x_NamaPenerima" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_NamaPenerima" value="<?= $Page->NamaPenerima->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->NamaPenerima->getPlaceHolder()) ?>" <?= $Page->NamaPenerima->editAttributes() ?> aria-describedby="x_NamaPenerima_help">
                    <?= $Page->NamaPenerima->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->NamaPenerima->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->StatusSAP->Visible) { // Status SAP 
?>
    <div id="r_StatusSAP" <?= $Page->StatusSAP->rowAttributes() ?>>
        <label id="elh_v_penerimaan_paket_keluar_show_nama_user_StatusSAP" for="x_StatusSAP" class="<?= $Page->LeftColumnClass ?>"><?= $Page->StatusSAP->caption() ?><?= $Page->StatusSAP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->StatusSAP->cellAttributes() ?>>
                <span id="el_v_penerimaan_paket_keluar_show_nama_user_StatusSAP">
                    <input type="<?= $Page->StatusSAP->getInputTextType() ?>" name="x_StatusSAP" id="x_StatusSAP" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_StatusSAP" value="<?= $Page->StatusSAP->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->StatusSAP->getPlaceHolder()) ?>" <?= $Page->StatusSAP->editAttributes() ?> aria-describedby="x_StatusSAP_help">
                    <?= $Page->StatusSAP->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->StatusSAP->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
</div><!-- /page* -->
<input type="hidden" data-table="v_penerimaan_paket_keluar_show_nama_user" data-field="x_ID" data-hidden="1" name="x_ID" id="x_ID" value="<?= HtmlEncode($Page->ID->CurrentValue) ?>">
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
        ew.addEventHandlers("v_penerimaan_paket_keluar_show_nama_user");
    });
</script>
<script>
    loadjs.ready("load", function() {
        // Write your table-specific startup script here, no need to add script tags.
    });
</script>