<?php

namespace Mitral2022\DSN2;

// Page object
$MNotifikasiExpiredView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
    <script>
        var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
        ew.deepAssign(ew.vars, {
            tables: {
                m_notifikasi_expired: currentTable
            }
        });
        var currentForm, currentPageID;
        var fm_notifikasi_expiredview;
        loadjs.ready(["wrapper", "head"], function() {
            var $ = jQuery;
            // Form object
            fm_notifikasi_expiredview = new ew.Form("fm_notifikasi_expiredview", "view");
            currentPageID = ew.PAGE_ID = "view";
            currentForm = fm_notifikasi_expiredview;
            loadjs.done("fm_notifikasi_expiredview");
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
<form name="fm_notifikasi_expiredview" id="fm_notifikasi_expiredview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
    <?php if (Config("CHECK_TOKEN")) { ?>
        <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
        <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
    <?php } ?>
    <input type="hidden" name="t" value="m_notifikasi_expired">
    <input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
    <table class="table table-striped table-bordered table-hover table-sm ew-view-table">
        <?php if ($Page->id->Visible) { // id 
        ?>
            <tr id="r_id" <?= $Page->id->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_notifikasi_expired_id"><?= $Page->id->caption() ?></span></td>
                <td data-name="id" <?= $Page->id->cellAttributes() ?>>
                    <span id="el_m_notifikasi_expired_id">
                        <span<?= $Page->id->viewAttributes() ?>>
                            <?= $Page->id->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->jenis_dokumen->Visible) { // jenis_dokumen 
        ?>
            <tr id="r_jenis_dokumen" <?= $Page->jenis_dokumen->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_notifikasi_expired_jenis_dokumen"><?= $Page->jenis_dokumen->caption() ?></span></td>
                <td data-name="jenis_dokumen" <?= $Page->jenis_dokumen->cellAttributes() ?>>
                    <span id="el_m_notifikasi_expired_jenis_dokumen">
                        <span<?= $Page->jenis_dokumen->viewAttributes() ?>>
                            <?= $Page->jenis_dokumen->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->interval->Visible) { // interval 
        ?>
            <tr id="r_interval" <?= $Page->interval->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_notifikasi_expired_interval"><?= $Page->interval->caption() ?></span></td>
                <td data-name="interval" <?= $Page->interval->cellAttributes() ?>>
                    <span id="el_m_notifikasi_expired_interval">
                        <span<?= $Page->interval->viewAttributes() ?>>
                            <?= $Page->interval->getViewValue() ?>
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