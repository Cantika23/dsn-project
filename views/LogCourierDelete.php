<?php

namespace Mitral2022\DSN2;

// Page object
$LogCourierDelete = &$Page;
?>
<script>
        var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
        ew.deepAssign(ew.vars, {
                tables: {
                        log_courier: currentTable
                }
        });
        var currentForm, currentPageID;
        var flog_courierdelete;
        loadjs.ready(["wrapper", "head"], function() {
                var $ = jQuery;
                // Form object
                flog_courierdelete = new ew.Form("flog_courierdelete", "delete");
                currentPageID = ew.PAGE_ID = "delete";
                currentForm = flog_courierdelete;
                loadjs.done("flog_courierdelete");
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
<form name="flog_courierdelete" id="flog_courierdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
        <?php if (Config("CHECK_TOKEN")) { ?>
                <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
                <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
        <?php } ?>
        <input type="hidden" name="t" value="log_courier">
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
                                                <?php if ($Page->awb->Visible) { // awb 
                                                ?>
                                                        <th class="<?= $Page->awb->headerCellClass() ?>"><span id="elh_log_courier_awb" class="log_courier_awb"><?= $Page->awb->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->kurir->Visible) { // kurir 
                                                ?>
                                                        <th class="<?= $Page->kurir->headerCellClass() ?>"><span id="elh_log_courier_kurir" class="log_courier_kurir"><?= $Page->kurir->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->req_type->Visible) { // req_type 
                                                ?>
                                                        <th class="<?= $Page->req_type->headerCellClass() ?>"><span id="elh_log_courier_req_type" class="log_courier_req_type"><?= $Page->req_type->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->datetime->Visible) { // datetime 
                                                ?>
                                                        <th class="<?= $Page->datetime->headerCellClass() ?>"><span id="elh_log_courier_datetime" class="log_courier_datetime"><?= $Page->datetime->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->parameter->Visible) { // parameter 
                                                ?>
                                                        <th class="<?= $Page->parameter->headerCellClass() ?>"><span id="elh_log_courier_parameter" class="log_courier_parameter"><?= $Page->parameter->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->_response->Visible) { // response 
                                                ?>
                                                        <th class="<?= $Page->_response->headerCellClass() ?>"><span id="elh_log_courier__response" class="log_courier__response"><?= $Page->_response->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->_content->Visible) { // content 
                                                ?>
                                                        <th class="<?= $Page->_content->headerCellClass() ?>"><span id="elh_log_courier__content" class="log_courier__content"><?= $Page->_content->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->text_query->Visible) { // text_query 
                                                ?>
                                                        <th class="<?= $Page->text_query->headerCellClass() ?>"><span id="elh_log_courier_text_query" class="log_courier_text_query"><?= $Page->text_query->caption() ?></span></th>
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
                                                        <?php if ($Page->awb->Visible) { // awb 
                                                        ?>
                                                                <td<?= $Page->awb->cellAttributes() ?>>
                                                                        <span id="el<?= $Page->RowCount ?>_log_courier_awb" class="el_log_courier_awb">
                                                                                <span<?= $Page->awb->viewAttributes() ?>>
                                                                                        <?= $Page->awb->getViewValue() ?>
                                                                        </span>
                                                                        </span>
                                                                        </td>
                                                                <?php } ?>
                                                                <?php if ($Page->kurir->Visible) { // kurir 
                                                                ?>
                                                                        <td<?= $Page->kurir->cellAttributes() ?>>
                                                                                <span id="el<?= $Page->RowCount ?>_log_courier_kurir" class="el_log_courier_kurir">
                                                                                        <span<?= $Page->kurir->viewAttributes() ?>>
                                                                                                <?= $Page->kurir->getViewValue() ?>
                                                                                </span>
                                                                                </span>
                                                                                </td>
                                                                        <?php } ?>
                                                                        <?php if ($Page->req_type->Visible) { // req_type 
                                                                        ?>
                                                                                <td<?= $Page->req_type->cellAttributes() ?>>
                                                                                        <span id="el<?= $Page->RowCount ?>_log_courier_req_type" class="el_log_courier_req_type">
                                                                                                <span<?= $Page->req_type->viewAttributes() ?>>
                                                                                                        <?= $Page->req_type->getViewValue() ?>
                                                                                        </span>
                                                                                        </span>
                                                                                        </td>
                                                                                <?php } ?>
                                                                                <?php if ($Page->datetime->Visible) { // datetime 
                                                                                ?>
                                                                                        <td<?= $Page->datetime->cellAttributes() ?>>
                                                                                                <span id="el<?= $Page->RowCount ?>_log_courier_datetime" class="el_log_courier_datetime">
                                                                                                        <span<?= $Page->datetime->viewAttributes() ?>>
                                                                                                                <?= $Page->datetime->getViewValue() ?>
                                                                                                </span>
                                                                                                </span>
                                                                                                </td>
                                                                                        <?php } ?>
                                                                                        <?php if ($Page->parameter->Visible) { // parameter 
                                                                                        ?>
                                                                                                <td<?= $Page->parameter->cellAttributes() ?>>
                                                                                                        <span id="el<?= $Page->RowCount ?>_log_courier_parameter" class="el_log_courier_parameter">
                                                                                                                <span<?= $Page->parameter->viewAttributes() ?>>
                                                                                                                        <?= $Page->parameter->getViewValue() ?>
                                                                                                        </span>
                                                                                                        </span>
                                                                                                        </td>
                                                                                                <?php } ?>
                                                                                                <?php if ($Page->_response->Visible) { // response 
                                                                                                ?>
                                                                                                        <td<?= $Page->_response->cellAttributes() ?>>
                                                                                                                <span id="el<?= $Page->RowCount ?>_log_courier__response" class="el_log_courier__response">
                                                                                                                        <span<?= $Page->_response->viewAttributes() ?>>
                                                                                                                                <?= $Page->_response->getViewValue() ?>
                                                                                                                </span>
                                                                                                                </span>
                                                                                                                </td>
                                                                                                        <?php } ?>
                                                                                                        <?php if ($Page->_content->Visible) { // content 
                                                                                                        ?>
                                                                                                                <td<?= $Page->_content->cellAttributes() ?>>
                                                                                                                        <span id="el<?= $Page->RowCount ?>_log_courier__content" class="el_log_courier__content">
                                                                                                                                <span<?= $Page->_content->viewAttributes() ?>>
                                                                                                                                        <?= $Page->_content->getViewValue() ?>
                                                                                                                        </span>
                                                                                                                        </span>
                                                                                                                        </td>
                                                                                                                <?php } ?>
                                                                                                                <?php if ($Page->text_query->Visible) { // text_query 
                                                                                                                ?>
                                                                                                                        <td<?= $Page->text_query->cellAttributes() ?>>
                                                                                                                                <span id="el<?= $Page->RowCount ?>_log_courier_text_query" class="el_log_courier_text_query">
                                                                                                                                        <span<?= $Page->text_query->viewAttributes() ?>>
                                                                                                                                                <?= $Page->text_query->getViewValue() ?>
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