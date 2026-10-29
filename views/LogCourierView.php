<?php

namespace Mitral2022\DSN2;

// Page object
$LogCourierView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
    <script>
        var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
        ew.deepAssign(ew.vars, {
            tables: {
                log_courier: currentTable
            }
        });
        var currentForm, currentPageID;
        var flog_courierview;
        loadjs.ready(["wrapper", "head"], function() {
            var $ = jQuery;
            // Form object
            flog_courierview = new ew.Form("flog_courierview", "view");
            currentPageID = ew.PAGE_ID = "view";
            currentForm = flog_courierview;
            loadjs.done("flog_courierview");
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
<form name="flog_courierview" id="flog_courierview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
    <?php if (Config("CHECK_TOKEN")) { ?>
        <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
        <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
    <?php } ?>
    <input type="hidden" name="t" value="log_courier">
    <input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
    <table class="table table-striped table-bordered table-hover table-sm ew-view-table">
        <?php if ($Page->id->Visible) { // id 
        ?>
            <tr id="r_id" <?= $Page->id->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_log_courier_id"><?= $Page->id->caption() ?></span></td>
                <td data-name="id" <?= $Page->id->cellAttributes() ?>>
                    <span id="el_log_courier_id">
                        <span<?= $Page->id->viewAttributes() ?>>
                            <?= $Page->id->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->awb->Visible) { // awb 
        ?>
            <tr id="r_awb" <?= $Page->awb->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_log_courier_awb"><?= $Page->awb->caption() ?></span></td>
                <td data-name="awb" <?= $Page->awb->cellAttributes() ?>>
                    <span id="el_log_courier_awb">
                        <span<?= $Page->awb->viewAttributes() ?>>
                            <?= $Page->awb->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->kurir->Visible) { // kurir 
        ?>
            <tr id="r_kurir" <?= $Page->kurir->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_log_courier_kurir"><?= $Page->kurir->caption() ?></span></td>
                <td data-name="kurir" <?= $Page->kurir->cellAttributes() ?>>
                    <span id="el_log_courier_kurir">
                        <span<?= $Page->kurir->viewAttributes() ?>>
                            <?= $Page->kurir->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->req_type->Visible) { // req_type 
        ?>
            <tr id="r_req_type" <?= $Page->req_type->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_log_courier_req_type"><?= $Page->req_type->caption() ?></span></td>
                <td data-name="req_type" <?= $Page->req_type->cellAttributes() ?>>
                    <span id="el_log_courier_req_type">
                        <span<?= $Page->req_type->viewAttributes() ?>>
                            <?= $Page->req_type->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->datetime->Visible) { // datetime 
        ?>
            <tr id="r_datetime" <?= $Page->datetime->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_log_courier_datetime"><?= $Page->datetime->caption() ?></span></td>
                <td data-name="datetime" <?= $Page->datetime->cellAttributes() ?>>
                    <span id="el_log_courier_datetime">
                        <span<?= $Page->datetime->viewAttributes() ?>>
                            <?= $Page->datetime->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->parameter->Visible) { // parameter 
        ?>
            <tr id="r_parameter" <?= $Page->parameter->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_log_courier_parameter"><?= $Page->parameter->caption() ?></span></td>
                <td data-name="parameter" <?= $Page->parameter->cellAttributes() ?>>
                    <span id="el_log_courier_parameter">
                        <span<?= $Page->parameter->viewAttributes() ?>>
                            <?= $Page->parameter->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->_response->Visible) { // response 
        ?>
            <tr id="r__response" <?= $Page->_response->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_log_courier__response"><?= $Page->_response->caption() ?></span></td>
                <td data-name="_response" <?= $Page->_response->cellAttributes() ?>>
                    <span id="el_log_courier__response">
                        <span<?= $Page->_response->viewAttributes() ?>>
                            <?= $Page->_response->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->_content->Visible) { // content 
        ?>
            <tr id="r__content" <?= $Page->_content->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_log_courier__content"><?= $Page->_content->caption() ?></span></td>
                <td data-name="_content" <?= $Page->_content->cellAttributes() ?>>
                    <span id="el_log_courier__content">
                        <span<?= $Page->_content->viewAttributes() ?>>
                            <?= $Page->_content->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->text_query->Visible) { // text_query 
        ?>
            <tr id="r_text_query" <?= $Page->text_query->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_log_courier_text_query"><?= $Page->text_query->caption() ?></span></td>
                <td data-name="text_query" <?= $Page->text_query->cellAttributes() ?>>
                    <span id="el_log_courier_text_query">
                        <span<?= $Page->text_query->viewAttributes() ?>>
                            <?= $Page->text_query->getViewValue() ?>
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