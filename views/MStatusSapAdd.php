<?php

namespace Mitral2022\DSN2;

// Page object
$MStatusSapAdd = &$Page;
?>
<script>
    var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
    ew.deepAssign(ew.vars, {
        tables: {
            m_status_sap: currentTable
        }
    });
    var currentForm, currentPageID;
    var fm_status_sapadd;
    loadjs.ready(["wrapper", "head"], function() {
        var $ = jQuery;
        // Form object
        fm_status_sapadd = new ew.Form("fm_status_sapadd", "add");
        currentPageID = ew.PAGE_ID = "add";
        currentForm = fm_status_sapadd;

        // Add fields
        var fields = currentTable.fields;
        fm_status_sapadd.addFields([
            ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null, ew.Validators.integer], fields.status.isInvalid],
            ["keterangan", [fields.keterangan.visible && fields.keterangan.required ? ew.Validators.required(fields.keterangan.caption) : null], fields.keterangan.isInvalid]
        ]);

        // Form_CustomValidate
        fm_status_sapadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
            // Your custom validation code here, return false if invalid.
            return true;
        }

        // Use JavaScript validation or not
        fm_status_sapadd.validateRequired = ew.CLIENT_VALIDATE;

        // Dynamic selection lists
        loadjs.done("fm_status_sapadd");
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
<form name="fm_status_sapadd" id="fm_status_sapadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
    <?php if (Config("CHECK_TOKEN")) { ?>
        <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
        <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
    <?php } ?>
    <input type="hidden" name="t" value="m_status_sap">
    <input type="hidden" name="action" id="action" value="insert">
    <input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
    <input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
    <div class="ew-add-div"><!-- page* -->
        <?php if ($Page->status->Visible) { // status 
        ?>
            <div id="r_status" <?= $Page->status->rowAttributes() ?>>
                <label id="elh_m_status_sap_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
                <div class="<?= $Page->RightColumnClass ?>">
                    <div<?= $Page->status->cellAttributes() ?>>
                        <span id="el_m_status_sap_status">
                            <input type="<?= $Page->status->getInputTextType() ?>" name="x_status" id="x_status" data-table="m_status_sap" data-field="x_status" value="<?= $Page->status->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>" <?= $Page->status->editAttributes() ?> aria-describedby="x_status_help">
                            <?= $Page->status->getCustomMessage() ?>
                            <div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
                        </span>
                </div>
            </div>
    </div>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan 
?>
    <div id="r_keterangan" <?= $Page->keterangan->rowAttributes() ?>>
        <label id="elh_m_status_sap_keterangan" for="x_keterangan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->keterangan->caption() ?><?= $Page->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->keterangan->cellAttributes() ?>>
                <span id="el_m_status_sap_keterangan">
                    <input type="<?= $Page->keterangan->getInputTextType() ?>" name="x_keterangan" id="x_keterangan" data-table="m_status_sap" data-field="x_keterangan" value="<?= $Page->keterangan->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->keterangan->getPlaceHolder()) ?>" <?= $Page->keterangan->editAttributes() ?> aria-describedby="x_keterangan_help">
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
        ew.addEventHandlers("m_status_sap");
    });
</script>
<script>
    loadjs.ready("load", function() {
        // Write your table-specific startup script here, no need to add script tags.
    });
</script>