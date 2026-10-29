<?php

namespace Mitral2022\DSN2;

// Page object
$MEmployeeAdd = &$Page;
?>
<script>
    var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
    ew.deepAssign(ew.vars, {
        tables: {
            m_employee: currentTable
        }
    });
    var currentForm, currentPageID;
    var fm_employeeadd;
    loadjs.ready(["wrapper", "head"], function() {
        var $ = jQuery;
        // Form object
        fm_employeeadd = new ew.Form("fm_employeeadd", "add");
        currentPageID = ew.PAGE_ID = "add";
        currentForm = fm_employeeadd;

        // Add fields
        var fields = currentTable.fields;
        fm_employeeadd.addFields([
            ["orgname", [fields.orgname.visible && fields.orgname.required ? ew.Validators.required(fields.orgname.caption) : null], fields.orgname.isInvalid],
            ["nik", [fields.nik.visible && fields.nik.required ? ew.Validators.required(fields.nik.caption) : null], fields.nik.isInvalid],
            ["company_name", [fields.company_name.visible && fields.company_name.required ? ew.Validators.required(fields.company_name.caption) : null], fields.company_name.isInvalid],
            ["_email", [fields._email.visible && fields._email.required ? ew.Validators.required(fields._email.caption) : null], fields._email.isInvalid],
            ["employee_name", [fields.employee_name.visible && fields.employee_name.required ? ew.Validators.required(fields.employee_name.caption) : null], fields.employee_name.isInvalid],
            ["company_code", [fields.company_code.visible && fields.company_code.required ? ew.Validators.required(fields.company_code.caption) : null], fields.company_code.isInvalid],
            ["organization_name", [fields.organization_name.visible && fields.organization_name.required ? ew.Validators.required(fields.organization_name.caption) : null], fields.organization_name.isInvalid],
            ["phone1", [fields.phone1.visible && fields.phone1.required ? ew.Validators.required(fields.phone1.caption) : null], fields.phone1.isInvalid],
            ["phone2", [fields.phone2.visible && fields.phone2.required ? ew.Validators.required(fields.phone2.caption) : null], fields.phone2.isInvalid]
        ]);

        // Form_CustomValidate
        fm_employeeadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
            // Your custom validation code here, return false if invalid.
            return true;
        }

        // Use JavaScript validation or not
        fm_employeeadd.validateRequired = ew.CLIENT_VALIDATE;

        // Dynamic selection lists
        loadjs.done("fm_employeeadd");
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
<form name="fm_employeeadd" id="fm_employeeadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
    <?php if (Config("CHECK_TOKEN")) { ?>
        <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
        <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
    <?php } ?>
    <input type="hidden" name="t" value="m_employee">
    <input type="hidden" name="action" id="action" value="insert">
    <input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
    <input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
    <div class="ew-add-div"><!-- page* -->
        <?php if ($Page->orgname->Visible) { // orgname 
        ?>
            <div id="r_orgname" <?= $Page->orgname->rowAttributes() ?>>
                <label id="elh_m_employee_orgname" for="x_orgname" class="<?= $Page->LeftColumnClass ?>"><?= $Page->orgname->caption() ?><?= $Page->orgname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
                <div class="<?= $Page->RightColumnClass ?>">
                    <div<?= $Page->orgname->cellAttributes() ?>>
                        <span id="el_m_employee_orgname">
                            <input type="<?= $Page->orgname->getInputTextType() ?>" name="x_orgname" id="x_orgname" data-table="m_employee" data-field="x_orgname" value="<?= $Page->orgname->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->orgname->getPlaceHolder()) ?>" <?= $Page->orgname->editAttributes() ?> aria-describedby="x_orgname_help">
                            <?= $Page->orgname->getCustomMessage() ?>
                            <div class="invalid-feedback"><?= $Page->orgname->getErrorMessage() ?></div>
                        </span>
                </div>
            </div>
    </div>
<?php } ?>
<?php if ($Page->nik->Visible) { // nik 
?>
    <div id="r_nik" <?= $Page->nik->rowAttributes() ?>>
        <label id="elh_m_employee_nik" for="x_nik" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nik->caption() ?><?= $Page->nik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->nik->cellAttributes() ?>>
                <span id="el_m_employee_nik">
                    <input type="<?= $Page->nik->getInputTextType() ?>" name="x_nik" id="x_nik" data-table="m_employee" data-field="x_nik" value="<?= $Page->nik->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->nik->getPlaceHolder()) ?>" <?= $Page->nik->editAttributes() ?> aria-describedby="x_nik_help">
                    <?= $Page->nik->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->nik->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->company_name->Visible) { // company_name 
?>
    <div id="r_company_name" <?= $Page->company_name->rowAttributes() ?>>
        <label id="elh_m_employee_company_name" for="x_company_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->company_name->caption() ?><?= $Page->company_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->company_name->cellAttributes() ?>>
                <span id="el_m_employee_company_name">
                    <input type="<?= $Page->company_name->getInputTextType() ?>" name="x_company_name" id="x_company_name" data-table="m_employee" data-field="x_company_name" value="<?= $Page->company_name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->company_name->getPlaceHolder()) ?>" <?= $Page->company_name->editAttributes() ?> aria-describedby="x_company_name_help">
                    <?= $Page->company_name->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->company_name->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->_email->Visible) { // email 
?>
    <div id="r__email" <?= $Page->_email->rowAttributes() ?>>
        <label id="elh_m_employee__email" for="x__email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_email->caption() ?><?= $Page->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->_email->cellAttributes() ?>>
                <span id="el_m_employee__email">
                    <input type="<?= $Page->_email->getInputTextType() ?>" name="x__email" id="x__email" data-table="m_employee" data-field="x__email" value="<?= $Page->_email->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_email->getPlaceHolder()) ?>" <?= $Page->_email->editAttributes() ?> aria-describedby="x__email_help">
                    <?= $Page->_email->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->_email->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->employee_name->Visible) { // employee_name 
?>
    <div id="r_employee_name" <?= $Page->employee_name->rowAttributes() ?>>
        <label id="elh_m_employee_employee_name" for="x_employee_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_name->caption() ?><?= $Page->employee_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->employee_name->cellAttributes() ?>>
                <span id="el_m_employee_employee_name">
                    <input type="<?= $Page->employee_name->getInputTextType() ?>" name="x_employee_name" id="x_employee_name" data-table="m_employee" data-field="x_employee_name" value="<?= $Page->employee_name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->employee_name->getPlaceHolder()) ?>" <?= $Page->employee_name->editAttributes() ?> aria-describedby="x_employee_name_help">
                    <?= $Page->employee_name->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->employee_name->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->company_code->Visible) { // company_code 
?>
    <div id="r_company_code" <?= $Page->company_code->rowAttributes() ?>>
        <label id="elh_m_employee_company_code" for="x_company_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->company_code->caption() ?><?= $Page->company_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->company_code->cellAttributes() ?>>
                <span id="el_m_employee_company_code">
                    <input type="<?= $Page->company_code->getInputTextType() ?>" name="x_company_code" id="x_company_code" data-table="m_employee" data-field="x_company_code" value="<?= $Page->company_code->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->company_code->getPlaceHolder()) ?>" <?= $Page->company_code->editAttributes() ?> aria-describedby="x_company_code_help">
                    <?= $Page->company_code->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->company_code->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->organization_name->Visible) { // organization_name 
?>
    <div id="r_organization_name" <?= $Page->organization_name->rowAttributes() ?>>
        <label id="elh_m_employee_organization_name" for="x_organization_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->organization_name->caption() ?><?= $Page->organization_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->organization_name->cellAttributes() ?>>
                <span id="el_m_employee_organization_name">
                    <input type="<?= $Page->organization_name->getInputTextType() ?>" name="x_organization_name" id="x_organization_name" data-table="m_employee" data-field="x_organization_name" value="<?= $Page->organization_name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->organization_name->getPlaceHolder()) ?>" <?= $Page->organization_name->editAttributes() ?> aria-describedby="x_organization_name_help">
                    <?= $Page->organization_name->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->organization_name->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->phone1->Visible) { // phone1 
?>
    <div id="r_phone1" <?= $Page->phone1->rowAttributes() ?>>
        <label id="elh_m_employee_phone1" for="x_phone1" class="<?= $Page->LeftColumnClass ?>"><?= $Page->phone1->caption() ?><?= $Page->phone1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->phone1->cellAttributes() ?>>
                <span id="el_m_employee_phone1">
                    <input type="<?= $Page->phone1->getInputTextType() ?>" name="x_phone1" id="x_phone1" data-table="m_employee" data-field="x_phone1" value="<?= $Page->phone1->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->phone1->getPlaceHolder()) ?>" <?= $Page->phone1->editAttributes() ?> aria-describedby="x_phone1_help">
                    <?= $Page->phone1->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->phone1->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->phone2->Visible) { // phone2 
?>
    <div id="r_phone2" <?= $Page->phone2->rowAttributes() ?>>
        <label id="elh_m_employee_phone2" for="x_phone2" class="<?= $Page->LeftColumnClass ?>"><?= $Page->phone2->caption() ?><?= $Page->phone2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->phone2->cellAttributes() ?>>
                <span id="el_m_employee_phone2">
                    <input type="<?= $Page->phone2->getInputTextType() ?>" name="x_phone2" id="x_phone2" data-table="m_employee" data-field="x_phone2" value="<?= $Page->phone2->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->phone2->getPlaceHolder()) ?>" <?= $Page->phone2->editAttributes() ?> aria-describedby="x_phone2_help">
                    <?= $Page->phone2->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->phone2->getErrorMessage() ?></div>
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
        ew.addEventHandlers("m_employee");
    });
</script>
<script>
    loadjs.ready("load", function() {
        // Write your table-specific startup script here, no need to add script tags.
    });
</script>