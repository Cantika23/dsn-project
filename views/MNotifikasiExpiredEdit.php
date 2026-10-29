<?php

namespace Mitral2022\DSN2;

// Page object
$MNotifikasiExpiredEdit = &$Page;
?>
<script>
    var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
    ew.deepAssign(ew.vars, {
        tables: {
            m_notifikasi_expired: currentTable
        }
    });
    var currentForm, currentPageID;
    var fm_notifikasi_expirededit;
    loadjs.ready(["wrapper", "head"], function() {
        var $ = jQuery;
        // Form object
        fm_notifikasi_expirededit = new ew.Form("fm_notifikasi_expirededit", "edit");
        currentPageID = ew.PAGE_ID = "edit";
        currentForm = fm_notifikasi_expirededit;

        // Add fields
        var fields = currentTable.fields;
        fm_notifikasi_expirededit.addFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["jenis_dokumen", [fields.jenis_dokumen.visible && fields.jenis_dokumen.required ? ew.Validators.required(fields.jenis_dokumen.caption) : null, ew.Validators.integer], fields.jenis_dokumen.isInvalid],
            ["interval", [fields.interval.visible && fields.interval.required ? ew.Validators.required(fields.interval.caption) : null], fields.interval.isInvalid]
        ]);

        // Form_CustomValidate
        fm_notifikasi_expirededit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
            // Your custom validation code here, return false if invalid.
            return true;
        }

        // Use JavaScript validation or not
        fm_notifikasi_expirededit.validateRequired = ew.CLIENT_VALIDATE;

        // Dynamic selection lists
        loadjs.done("fm_notifikasi_expirededit");
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
<form name="fm_notifikasi_expirededit" id="fm_notifikasi_expirededit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
    <?php if (Config("CHECK_TOKEN")) { ?>
        <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
        <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
    <?php } ?>
    <input type="hidden" name="t" value="m_notifikasi_expired">
    <input type="hidden" name="action" id="action" value="update">
    <input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
    <input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
    <div class="ew-edit-div"><!-- page* -->
        <?php if ($Page->id->Visible) { // id 
        ?>
            <div id="r_id" <?= $Page->id->rowAttributes() ?>>
                <label id="elh_m_notifikasi_expired_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
                <div class="<?= $Page->RightColumnClass ?>">
                    <div<?= $Page->id->cellAttributes() ?>>
                        <span id="el_m_notifikasi_expired_id">
                            <span<?= $Page->id->viewAttributes() ?>>
                                <input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>">
                        </span>
                        </span>
                        <input type="hidden" data-table="m_notifikasi_expired" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
                </div>
            </div>
    </div>
<?php } ?>
<?php if ($Page->jenis_dokumen->Visible) { // jenis_dokumen 
?>
    <div id="r_jenis_dokumen" <?= $Page->jenis_dokumen->rowAttributes() ?>>
        <label id="elh_m_notifikasi_expired_jenis_dokumen" for="x_jenis_dokumen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenis_dokumen->caption() ?><?= $Page->jenis_dokumen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->jenis_dokumen->cellAttributes() ?>>
                <span id="el_m_notifikasi_expired_jenis_dokumen">
                    <input type="<?= $Page->jenis_dokumen->getInputTextType() ?>" name="x_jenis_dokumen" id="x_jenis_dokumen" data-table="m_notifikasi_expired" data-field="x_jenis_dokumen" value="<?= $Page->jenis_dokumen->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->jenis_dokumen->getPlaceHolder()) ?>" <?= $Page->jenis_dokumen->editAttributes() ?> aria-describedby="x_jenis_dokumen_help">
                    <?= $Page->jenis_dokumen->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->jenis_dokumen->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->interval->Visible) { // interval 
?>
    <div id="r_interval" <?= $Page->interval->rowAttributes() ?>>
        <label id="elh_m_notifikasi_expired_interval" for="x_interval" class="<?= $Page->LeftColumnClass ?>"><?= $Page->interval->caption() ?><?= $Page->interval->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->interval->cellAttributes() ?>>
                <span id="el_m_notifikasi_expired_interval">
                    <input type="<?= $Page->interval->getInputTextType() ?>" name="x_interval" id="x_interval" data-table="m_notifikasi_expired" data-field="x_interval" value="<?= $Page->interval->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->interval->getPlaceHolder()) ?>" <?= $Page->interval->editAttributes() ?> aria-describedby="x_interval_help">
                    <?= $Page->interval->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->interval->getErrorMessage() ?></div>
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
        ew.addEventHandlers("m_notifikasi_expired");
    });
</script>
<script>
    loadjs.ready("load", function() {
        // Write your table-specific startup script here, no need to add script tags.
    });
</script>