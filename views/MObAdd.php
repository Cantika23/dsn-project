<?php

namespace Mitral2022\DSN2;

// Page object
$MObAdd = &$Page;
?>
<script>
    var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
    ew.deepAssign(ew.vars, {
        tables: {
            m_ob: currentTable
        }
    });
    var currentForm, currentPageID;
    var fm_obadd;
    loadjs.ready(["wrapper", "head"], function() {
        var $ = jQuery;
        // Form object
        fm_obadd = new ew.Form("fm_obadd", "add");
        currentPageID = ew.PAGE_ID = "add";
        currentForm = fm_obadd;

        // Add fields
        var fields = currentTable.fields;
        fm_obadd.addFields([
            ["nama_ob", [fields.nama_ob.visible && fields.nama_ob.required ? ew.Validators.required(fields.nama_ob.caption) : null], fields.nama_ob.isInvalid]
        ]);

        // Form_CustomValidate
        fm_obadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
            // Your custom validation code here, return false if invalid.
            return true;
        }

        // Use JavaScript validation or not
        fm_obadd.validateRequired = ew.CLIENT_VALIDATE;

        // Dynamic selection lists
        loadjs.done("fm_obadd");
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
<form name="fm_obadd" id="fm_obadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
    <?php if (Config("CHECK_TOKEN")) { ?>
        <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
        <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
    <?php } ?>
    <input type="hidden" name="t" value="m_ob">
    <input type="hidden" name="action" id="action" value="insert">
    <input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
    <input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
    <div class="ew-add-div"><!-- page* -->
        <?php if ($Page->nama_ob->Visible) { // nama_ob 
        ?>
            <div id="r_nama_ob" <?= $Page->nama_ob->rowAttributes() ?>>
                <label id="elh_m_ob_nama_ob" for="x_nama_ob" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_ob->caption() ?><?= $Page->nama_ob->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
                <div class="<?= $Page->RightColumnClass ?>">
                    <div<?= $Page->nama_ob->cellAttributes() ?>>
                        <span id="el_m_ob_nama_ob">
                            <input type="<?= $Page->nama_ob->getInputTextType() ?>" name="x_nama_ob" id="x_nama_ob" data-table="m_ob" data-field="x_nama_ob" value="<?= $Page->nama_ob->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->nama_ob->getPlaceHolder()) ?>" <?= $Page->nama_ob->editAttributes() ?> aria-describedby="x_nama_ob_help">
                            <?= $Page->nama_ob->getCustomMessage() ?>
                            <div class="invalid-feedback"><?= $Page->nama_ob->getErrorMessage() ?></div>
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
        ew.addEventHandlers("m_ob");
    });
</script>
<script>
    loadjs.ready("load", function() {
        // Write your table-specific startup script here, no need to add script tags.
    });
</script>