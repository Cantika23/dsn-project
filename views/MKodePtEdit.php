<?php

namespace Mitral2022\DSN2;

// Page object
$MKodePtEdit = &$Page;
?>
<script>
    var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
    ew.deepAssign(ew.vars, {
        tables: {
            m_kode_pt: currentTable
        }
    });
    var currentForm, currentPageID;
    var fm_kode_ptedit;
    loadjs.ready(["wrapper", "head"], function() {
        var $ = jQuery;
        // Form object
        fm_kode_ptedit = new ew.Form("fm_kode_ptedit", "edit");
        currentPageID = ew.PAGE_ID = "edit";
        currentForm = fm_kode_ptedit;

        // Add fields
        var fields = currentTable.fields;
        fm_kode_ptedit.addFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["nama", [fields.nama.visible && fields.nama.required ? ew.Validators.required(fields.nama.caption) : null], fields.nama.isInvalid],
            ["nama_lengkap", [fields.nama_lengkap.visible && fields.nama_lengkap.required ? ew.Validators.required(fields.nama_lengkap.caption) : null], fields.nama_lengkap.isInvalid]
        ]);

        // Form_CustomValidate
        fm_kode_ptedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
            // Your custom validation code here, return false if invalid.
            return true;
        }

        // Use JavaScript validation or not
        fm_kode_ptedit.validateRequired = ew.CLIENT_VALIDATE;

        // Dynamic selection lists
        loadjs.done("fm_kode_ptedit");
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
<form name="fm_kode_ptedit" id="fm_kode_ptedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
    <?php if (Config("CHECK_TOKEN")) { ?>
        <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
        <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
    <?php } ?>
    <input type="hidden" name="t" value="m_kode_pt">
    <input type="hidden" name="action" id="action" value="update">
    <input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
    <input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
    <div class="ew-edit-div"><!-- page* -->
        <?php if ($Page->id->Visible) { // id 
        ?>
            <div id="r_id" <?= $Page->id->rowAttributes() ?>>
                <label id="elh_m_kode_pt_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
                <div class="<?= $Page->RightColumnClass ?>">
                    <div<?= $Page->id->cellAttributes() ?>>
                        <span id="el_m_kode_pt_id">
                            <span<?= $Page->id->viewAttributes() ?>>
                                <input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>">
                        </span>
                        </span>
                        <input type="hidden" data-table="m_kode_pt" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
                </div>
            </div>
    </div>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama 
?>
    <div id="r_nama" <?= $Page->nama->rowAttributes() ?>>
        <label id="elh_m_kode_pt_nama" for="x_nama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama->caption() ?><?= $Page->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->nama->cellAttributes() ?>>
                <span id="el_m_kode_pt_nama">
                    <input type="<?= $Page->nama->getInputTextType() ?>" name="x_nama" id="x_nama" data-table="m_kode_pt" data-field="x_nama" value="<?= $Page->nama->EditValue ?>" size="30" maxlength="4" placeholder="<?= HtmlEncode($Page->nama->getPlaceHolder()) ?>" <?= $Page->nama->editAttributes() ?> aria-describedby="x_nama_help">
                    <?= $Page->nama->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->nama->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->nama_lengkap->Visible) { // nama_lengkap 
?>
    <div id="r_nama_lengkap" <?= $Page->nama_lengkap->rowAttributes() ?>>
        <label id="elh_m_kode_pt_nama_lengkap" for="x_nama_lengkap" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_lengkap->caption() ?><?= $Page->nama_lengkap->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->nama_lengkap->cellAttributes() ?>>
                <span id="el_m_kode_pt_nama_lengkap">
                    <input type="<?= $Page->nama_lengkap->getInputTextType() ?>" name="x_nama_lengkap" id="x_nama_lengkap" data-table="m_kode_pt" data-field="x_nama_lengkap" value="<?= $Page->nama_lengkap->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->nama_lengkap->getPlaceHolder()) ?>" <?= $Page->nama_lengkap->editAttributes() ?> aria-describedby="x_nama_lengkap_help">
                    <?= $Page->nama_lengkap->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->nama_lengkap->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
</div><!-- /page* -->
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
        ew.addEventHandlers("m_kode_pt");
    });
</script>
<script>
    loadjs.ready("load", function() {
        // Write your table-specific startup script here, no need to add script tags.
    });
</script>