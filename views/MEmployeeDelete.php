<?php

namespace Mitral2022\DSN2;

// Page object
$MEmployeeDelete = &$Page;
?>
<script>
        var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
        ew.deepAssign(ew.vars, {
                tables: {
                        m_employee: currentTable
                }
        });
        var currentForm, currentPageID;
        var fm_employeedelete;
        loadjs.ready(["wrapper", "head"], function() {
                var $ = jQuery;
                // Form object
                fm_employeedelete = new ew.Form("fm_employeedelete", "delete");
                currentPageID = ew.PAGE_ID = "delete";
                currentForm = fm_employeedelete;
                loadjs.done("fm_employeedelete");
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
<form name="fm_employeedelete" id="fm_employeedelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
        <?php if (Config("CHECK_TOKEN")) { ?>
                <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
                <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
        <?php } ?>
        <input type="hidden" name="t" value="m_employee">
        <input type="hidden" name="action" id="action" value="delete">
        <?php foreach ($Page->RecKeys as $key) { ?>
                <?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
                <input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
        <?php } ?>
        <div class="card ew-card ew-grid">
                <div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
                        <table class="table table-bordered table-hover table-sm ew-table">
                                <thead>
                                        <tr class="ew-table-header">
                                                <?php if ($Page->orgname->Visible) { // orgname 
                                                ?>
                                                        <th class="<?= $Page->orgname->headerCellClass() ?>"><span id="elh_m_employee_orgname" class="m_employee_orgname"><?= $Page->orgname->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->nik->Visible) { // nik 
                                                ?>
                                                        <th class="<?= $Page->nik->headerCellClass() ?>"><span id="elh_m_employee_nik" class="m_employee_nik"><?= $Page->nik->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->company_name->Visible) { // company_name 
                                                ?>
                                                        <th class="<?= $Page->company_name->headerCellClass() ?>"><span id="elh_m_employee_company_name" class="m_employee_company_name"><?= $Page->company_name->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->_email->Visible) { // email 
                                                ?>
                                                        <th class="<?= $Page->_email->headerCellClass() ?>"><span id="elh_m_employee__email" class="m_employee__email"><?= $Page->_email->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->employee_name->Visible) { // employee_name 
                                                ?>
                                                        <th class="<?= $Page->employee_name->headerCellClass() ?>"><span id="elh_m_employee_employee_name" class="m_employee_employee_name"><?= $Page->employee_name->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->company_code->Visible) { // company_code 
                                                ?>
                                                        <th class="<?= $Page->company_code->headerCellClass() ?>"><span id="elh_m_employee_company_code" class="m_employee_company_code"><?= $Page->company_code->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->organization_name->Visible) { // organization_name 
                                                ?>
                                                        <th class="<?= $Page->organization_name->headerCellClass() ?>"><span id="elh_m_employee_organization_name" class="m_employee_organization_name"><?= $Page->organization_name->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->phone1->Visible) { // phone1 
                                                ?>
                                                        <th class="<?= $Page->phone1->headerCellClass() ?>"><span id="elh_m_employee_phone1" class="m_employee_phone1"><?= $Page->phone1->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->phone2->Visible) { // phone2 
                                                ?>
                                                        <th class="<?= $Page->phone2->headerCellClass() ?>"><span id="elh_m_employee_phone2" class="m_employee_phone2"><?= $Page->phone2->caption() ?></span></th>
                                                <?php } ?>
                                        </tr>
                                </thead>
                                <tbody>
                                        <?php
                                        $Page->RecordCount = 0;
                                        $i = 0;
                                        while (!$Page->Recordset->EOF) {
                                                $Page->RecordCount++;
                                                $Page->RowCount++;

                                                // Set row properties
                                                $Page->resetAttributes();
                                                $Page->RowType = ROWTYPE_VIEW; // View

                                                // Get the field contents
                                                $Page->loadRowValues($Page->Recordset);

                                                // Render row
                                                $Page->renderRow();
                                        ?>
                                                <tr <?= $Page->rowAttributes() ?>>
                                                        <?php if ($Page->orgname->Visible) { // orgname 
                                                        ?>
                                                                <td<?= $Page->orgname->cellAttributes() ?>>
                                                                        <span id="el<?= $Page->RowCount ?>_m_employee_orgname" class="el_m_employee_orgname">
                                                                                <span<?= $Page->orgname->viewAttributes() ?>>
                                                                                        <?= $Page->orgname->getViewValue() ?>
                                                                        </span>
                                                                        </span>
                                                                        </td>
                                                                <?php } ?>
                                                                <?php if ($Page->nik->Visible) { // nik 
                                                                ?>
                                                                        <td<?= $Page->nik->cellAttributes() ?>>
                                                                                <span id="el<?= $Page->RowCount ?>_m_employee_nik" class="el_m_employee_nik">
                                                                                        <span<?= $Page->nik->viewAttributes() ?>>
                                                                                                <?= $Page->nik->getViewValue() ?>
                                                                                </span>
                                                                                </span>
                                                                                </td>
                                                                        <?php } ?>
                                                                        <?php if ($Page->company_name->Visible) { // company_name 
                                                                        ?>
                                                                                <td<?= $Page->company_name->cellAttributes() ?>>
                                                                                        <span id="el<?= $Page->RowCount ?>_m_employee_company_name" class="el_m_employee_company_name">
                                                                                                <span<?= $Page->company_name->viewAttributes() ?>>
                                                                                                        <?= $Page->company_name->getViewValue() ?>
                                                                                        </span>
                                                                                        </span>
                                                                                        </td>
                                                                                <?php } ?>
                                                                                <?php if ($Page->_email->Visible) { // email 
                                                                                ?>
                                                                                        <td<?= $Page->_email->cellAttributes() ?>>
                                                                                                <span id="el<?= $Page->RowCount ?>_m_employee__email" class="el_m_employee__email">
                                                                                                        <span<?= $Page->_email->viewAttributes() ?>>
                                                                                                                <?= $Page->_email->getViewValue() ?>
                                                                                                </span>
                                                                                                </span>
                                                                                                </td>
                                                                                        <?php } ?>
                                                                                        <?php if ($Page->employee_name->Visible) { // employee_name 
                                                                                        ?>
                                                                                                <td<?= $Page->employee_name->cellAttributes() ?>>
                                                                                                        <span id="el<?= $Page->RowCount ?>_m_employee_employee_name" class="el_m_employee_employee_name">
                                                                                                                <span<?= $Page->employee_name->viewAttributes() ?>>
                                                                                                                        <?= $Page->employee_name->getViewValue() ?>
                                                                                                        </span>
                                                                                                        </span>
                                                                                                        </td>
                                                                                                <?php } ?>
                                                                                                <?php if ($Page->company_code->Visible) { // company_code 
                                                                                                ?>
                                                                                                        <td<?= $Page->company_code->cellAttributes() ?>>
                                                                                                                <span id="el<?= $Page->RowCount ?>_m_employee_company_code" class="el_m_employee_company_code">
                                                                                                                        <span<?= $Page->company_code->viewAttributes() ?>>
                                                                                                                                <?= $Page->company_code->getViewValue() ?>
                                                                                                                </span>
                                                                                                                </span>
                                                                                                                </td>
                                                                                                        <?php } ?>
                                                                                                        <?php if ($Page->organization_name->Visible) { // organization_name 
                                                                                                        ?>
                                                                                                                <td<?= $Page->organization_name->cellAttributes() ?>>
                                                                                                                        <span id="el<?= $Page->RowCount ?>_m_employee_organization_name" class="el_m_employee_organization_name">
                                                                                                                                <span<?= $Page->organization_name->viewAttributes() ?>>
                                                                                                                                        <?= $Page->organization_name->getViewValue() ?>
                                                                                                                        </span>
                                                                                                                        </span>
                                                                                                                        </td>
                                                                                                                <?php } ?>
                                                                                                                <?php if ($Page->phone1->Visible) { // phone1 
                                                                                                                ?>
                                                                                                                        <td<?= $Page->phone1->cellAttributes() ?>>
                                                                                                                                <span id="el<?= $Page->RowCount ?>_m_employee_phone1" class="el_m_employee_phone1">
                                                                                                                                        <span<?= $Page->phone1->viewAttributes() ?>>
                                                                                                                                                <?= $Page->phone1->getViewValue() ?>
                                                                                                                                </span>
                                                                                                                                </span>
                                                                                                                                </td>
                                                                                                                        <?php } ?>
                                                                                                                        <?php if ($Page->phone2->Visible) { // phone2 
                                                                                                                        ?>
                                                                                                                                <td<?= $Page->phone2->cellAttributes() ?>>
                                                                                                                                        <span id="el<?= $Page->RowCount ?>_m_employee_phone2" class="el_m_employee_phone2">
                                                                                                                                                <span<?= $Page->phone2->viewAttributes() ?>>
                                                                                                                                                        <?= $Page->phone2->getViewValue() ?>
                                                                                                                                        </span>
                                                                                                                                        </span>
                                                                                                                                        </td>
                                                                                                                                <?php } ?>
                                                </tr>
                                        <?php
                                                $Page->Recordset->moveNext();
                                        }
                                        $Page->Recordset->close();
                                        ?>
                                </tbody>
                        </table>
                </div>
        </div>
        <div>
                <button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
                <button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
        </div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
        loadjs.ready("load", function() {
                // Write your table-specific startup script here, no need to add script tags.
        });
</script>