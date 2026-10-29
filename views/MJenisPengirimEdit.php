<?php

namespace Mitral2022\DSN2;

// Page object
$MJenisPengirimEdit = &$Page;
?>
<script>
    var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
    ew.deepAssign(ew.vars, {
        tables: {
            m_jenis_pengirim: currentTable
        }
    });
    var currentForm, currentPageID;
    var fm_jenis_pengirimedit;
    loadjs.ready(["wrapper", "head"], function() {
        var $ = jQuery;
        // Form object
        fm_jenis_pengirimedit = new ew.Form("fm_jenis_pengirimedit", "edit");
        currentPageID = ew.PAGE_ID = "edit";
        currentForm = fm_jenis_pengirimedit;

        // Add fields
        var fields = currentTable.fields;
        fm_jenis_pengirimedit.addFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["jenis_pengirim", [fields.jenis_pengirim.visible && fields.jenis_pengirim.required ? ew.Validators.required(fields.jenis_pengirim.caption) : null], fields.jenis_pengirim.isInvalid],
            ["keterangan", [fields.keterangan.visible && fields.keterangan.required ? ew.Validators.required(fields.keterangan.caption) : null], fields.keterangan.isInvalid]
        ]);

        // Form_CustomValidate
        fm_jenis_pengirimedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
            // Your custom validation code here, return false if invalid.
            return true;
        }

        // Use JavaScript validation or not
        fm_jenis_pengirimedit.validateRequired = ew.CLIENT_VALIDATE;

        // Dynamic selection lists
        loadjs.done("fm_jenis_pengirimedit");
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
<form name="fm_jenis_pengirimedit" id="fm_jenis_pengirimedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
    <?php if (Config("CHECK_TOKEN")) { ?>
        <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
        <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
    <?php } ?>
    <input type="hidden" name="t" value="m_jenis_pengirim">
    <input type="hidden" name="action" id="action" value="update">
    <input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
    <input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
    <div class="ew-edit-div"><!-- page* -->
        <?php if ($Page->id->Visible) { // id 
        ?>
            <div id="r_id" <?= $Page->id->rowAttributes() ?>>
                <label id="elh_m_jenis_pengirim_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
                <div class="<?= $Page->RightColumnClass ?>">
                    <div<?= $Page->id->cellAttributes() ?>>
                        <span id="el_m_jenis_pengirim_id">
                            <span<?= $Page->id->viewAttributes() ?>>
                                <input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>">
                        </span>
                        </span>
                        <input type="hidden" data-table="m_jenis_pengirim" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
                </div>
            </div>
    </div>
<?php } ?>
<?php if ($Page->jenis_pengirim->Visible) { // jenis_pengirim 
?>
    <div id="r_jenis_pengirim" <?= $Page->jenis_pengirim->rowAttributes() ?>>
        <label id="elh_m_jenis_pengirim_jenis_pengirim" for="x_jenis_pengirim" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenis_pengirim->caption() ?><?= $Page->jenis_pengirim->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->jenis_pengirim->cellAttributes() ?>>
                <span id="el_m_jenis_pengirim_jenis_pengirim">
                    <input type="<?= $Page->jenis_pengirim->getInputTextType() ?>" name="x_jenis_pengirim" id="x_jenis_pengirim" data-table="m_jenis_pengirim" data-field="x_jenis_pengirim" value="<?= $Page->jenis_pengirim->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->jenis_pengirim->getPlaceHolder()) ?>" <?= $Page->jenis_pengirim->editAttributes() ?> aria-describedby="x_jenis_pengirim_help">
                    <?= $Page->jenis_pengirim->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->jenis_pengirim->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan 
?>
    <div id="r_keterangan" <?= $Page->keterangan->rowAttributes() ?>>
        <label id="elh_m_jenis_pengirim_keterangan" for="x_keterangan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->keterangan->caption() ?><?= $Page->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->keterangan->cellAttributes() ?>>
                <span id="el_m_jenis_pengirim_keterangan">
                    <input type="<?= $Page->keterangan->getInputTextType() ?>" name="x_keterangan" id="x_keterangan" data-table="m_jenis_pengirim" data-field="x_keterangan" value="<?= $Page->keterangan->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->keterangan->getPlaceHolder()) ?>" <?= $Page->keterangan->editAttributes() ?> aria-describedby="x_keterangan_help">
                    <?= $Page->keterangan->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->keterangan->getErrorMessage() ?></div>
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
        ew.addEventHandlers("m_jenis_pengirim");
    });
</script>
<script>
    loadjs.ready("load", function() {
        // Write your table-specific startup script here, no need to add script tags.
    });
</script>