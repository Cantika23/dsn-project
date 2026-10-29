<?php

namespace Mitral2022\DSN2;

// Page object
$MEmployeeView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
    <script>
        var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
        ew.deepAssign(ew.vars, {
            tables: {
                m_employee: currentTable
            }
        });
        var currentForm, currentPageID;
        var fm_employeeview;
        loadjs.ready(["wrapper", "head"], function() {
            var $ = jQuery;
            // Form object
            fm_employeeview = new ew.Form("fm_employeeview", "view");
            currentPageID = ew.PAGE_ID = "view";
            currentForm = fm_employeeview;
            loadjs.done("fm_employeeview");
        });
    </script>
    <script>
        loadjs.ready("head", function() {
            // Write your table-specific client script here, no need to add script tags.
        });
    </script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
    <div class="btn-toolbar ew-toolbar">
        <?php $Page->ExportOptions->render("body") ?>
        <?php $Page->OtherOptions->render("body") ?>
    </div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fm_employeeview" id="fm_employeeview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
    <?php if (Config("CHECK_TOKEN")) { ?>
        <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
        <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
    <?php } ?>
    <input type="hidden" name="t" value="m_employee">
    <input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
    <table class="table table-striped table-bordered table-hover table-sm ew-view-table">
        <?php if ($Page->id->Visible) { // id 
        ?>
            <tr id="r_id" <?= $Page->id->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_employee_id"><?= $Page->id->caption() ?></span></td>
                <td data-name="id" <?= $Page->id->cellAttributes() ?>>
                    <span id="el_m_employee_id">
                        <span<?= $Page->id->viewAttributes() ?>>
                            <?= $Page->id->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->orgname->Visible) { // orgname 
        ?>
            <tr id="r_orgname" <?= $Page->orgname->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_employee_orgname"><?= $Page->orgname->caption() ?></span></td>
                <td data-name="orgname" <?= $Page->orgname->cellAttributes() ?>>
                    <span id="el_m_employee_orgname">
                        <span<?= $Page->orgname->viewAttributes() ?>>
                            <?= $Page->orgname->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->nik->Visible) { // nik 
        ?>
            <tr id="r_nik" <?= $Page->nik->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_employee_nik"><?= $Page->nik->caption() ?></span></td>
                <td data-name="nik" <?= $Page->nik->cellAttributes() ?>>
                    <span id="el_m_employee_nik">
                        <span<?= $Page->nik->viewAttributes() ?>>
                            <?= $Page->nik->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->company_name->Visible) { // company_name 
        ?>
            <tr id="r_company_name" <?= $Page->company_name->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_employee_company_name"><?= $Page->company_name->caption() ?></span></td>
                <td data-name="company_name" <?= $Page->company_name->cellAttributes() ?>>
                    <span id="el_m_employee_company_name">
                        <span<?= $Page->company_name->viewAttributes() ?>>
                            <?= $Page->company_name->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->_email->Visible) { // email 
        ?>
            <tr id="r__email" <?= $Page->_email->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_employee__email"><?= $Page->_email->caption() ?></span></td>
                <td data-name="_email" <?= $Page->_email->cellAttributes() ?>>
                    <span id="el_m_employee__email">
                        <span<?= $Page->_email->viewAttributes() ?>>
                            <?= $Page->_email->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->employee_name->Visible) { // employee_name 
        ?>
            <tr id="r_employee_name" <?= $Page->employee_name->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_employee_employee_name"><?= $Page->employee_name->caption() ?></span></td>
                <td data-name="employee_name" <?= $Page->employee_name->cellAttributes() ?>>
                    <span id="el_m_employee_employee_name">
                        <span<?= $Page->employee_name->viewAttributes() ?>>
                            <?= $Page->employee_name->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->company_code->Visible) { // company_code 
        ?>
            <tr id="r_company_code" <?= $Page->company_code->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_employee_company_code"><?= $Page->company_code->caption() ?></span></td>
                <td data-name="company_code" <?= $Page->company_code->cellAttributes() ?>>
                    <span id="el_m_employee_company_code">
                        <span<?= $Page->company_code->viewAttributes() ?>>
                            <?= $Page->company_code->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->organization_name->Visible) { // organization_name 
        ?>
            <tr id="r_organization_name" <?= $Page->organization_name->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_employee_organization_name"><?= $Page->organization_name->caption() ?></span></td>
                <td data-name="organization_name" <?= $Page->organization_name->cellAttributes() ?>>
                    <span id="el_m_employee_organization_name">
                        <span<?= $Page->organization_name->viewAttributes() ?>>
                            <?= $Page->organization_name->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->phone1->Visible) { // phone1 
        ?>
            <tr id="r_phone1" <?= $Page->phone1->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_employee_phone1"><?= $Page->phone1->caption() ?></span></td>
                <td data-name="phone1" <?= $Page->phone1->cellAttributes() ?>>
                    <span id="el_m_employee_phone1">
                        <span<?= $Page->phone1->viewAttributes() ?>>
                            <?= $Page->phone1->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->phone2->Visible) { // phone2 
        ?>
            <tr id="r_phone2" <?= $Page->phone2->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_employee_phone2"><?= $Page->phone2->caption() ?></span></td>
                <td data-name="phone2" <?= $Page->phone2->cellAttributes() ?>>
                    <span id="el_m_employee_phone2">
                        <span<?= $Page->phone2->viewAttributes() ?>>
                            <?= $Page->phone2->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
    </table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
    <script>
        loadjs.ready("load", function() {
            // Write your table-specific startup script here, no need to add script tags.
        });
    </script>
<?php } ?>