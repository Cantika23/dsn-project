<?php

namespace Mitral2022\DSN2;

// Page object
$MJenisDokumenAdd = &$Page;
?>
<script>
    var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
    ew.deepAssign(ew.vars, {
        tables: {
            m_jenis_dokumen: currentTable
        }
    });
    var currentForm, currentPageID;
    var fm_jenis_dokumenadd;
    loadjs.ready(["wrapper", "head"], function() {
        var $ = jQuery;
        // Form object
        fm_jenis_dokumenadd = new ew.Form("fm_jenis_dokumenadd", "add");
        currentPageID = ew.PAGE_ID = "add";
        currentForm = fm_jenis_dokumenadd;

        // Add fields
        var fields = currentTable.fields;
        fm_jenis_dokumenadd.addFields([
            ["jenis_dokumen", [fields.jenis_dokumen.visible && fields.jenis_dokumen.required ? ew.Validators.required(fields.jenis_dokumen.caption) : null], fields.jenis_dokumen.isInvalid]
        ]);

        // Form_CustomValidate
        fm_jenis_dokumenadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
            // Your custom validation code here, return false if invalid.
            return true;
        }

        // Use JavaScript validation or not
        fm_jenis_dokumenadd.validateRequired = ew.CLIENT_VALIDATE;

        // Dynamic selection lists
        loadjs.done("fm_jenis_dokumenadd");
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
<form name="fm_jenis_dokumenadd" id="fm_jenis_dokumenadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
    <?php if (Config("CHECK_TOKEN")) { ?>
        <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
        <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
    <?php } ?>
    <input type="hidden" name="t" value="m_jenis_dokumen">
    <input type="hidden" name="action" id="action" value="insert">
    <input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
    <input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
    <div class="ew-add-div"><!-- page* -->
        <?php if ($Page->jenis_dokumen->Visible) { // jenis_dokumen 
        ?>
            <div id="r_jenis_dokumen" <?= $Page->jenis_dokumen->rowAttributes() ?>>
                <label id="elh_m_jenis_dokumen_jenis_dokumen" for="x_jenis_dokumen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenis_dokumen->caption() ?><?= $Page->jenis_dokumen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
                <div class="<?= $Page->RightColumnClass ?>">
                    <div<?= $Page->jenis_dokumen->cellAttributes() ?>>
                        <span id="el_m_jenis_dokumen_jenis_dokumen">
                            <input type="<?= $Page->jenis_dokumen->getInputTextType() ?>" name="x_jenis_dokumen" id="x_jenis_dokumen" data-table="m_jenis_dokumen" data-field="x_jenis_dokumen" value="<?= $Page->jenis_dokumen->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->jenis_dokumen->getPlaceHolder()) ?>" <?= $Page->jenis_dokumen->editAttributes() ?> aria-describedby="x_jenis_dokumen_help">
                            <?= $Page->jenis_dokumen->getCustomMessage() ?>
                            <div class="invalid-feedback"><?= $Page->jenis_dokumen->getErrorMessage() ?></div>
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
        ew.addEventHandlers("m_jenis_dokumen");
    });
</script>
<script>
    loadjs.ready("load", function() {
        // Write your table-specific startup script here, no need to add script tags.
    });
</script>