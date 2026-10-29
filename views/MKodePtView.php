<?php

namespace Mitral2022\DSN2;

// Page object
$MKodePtView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
    <script>
        var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
        ew.deepAssign(ew.vars, {
            tables: {
                m_kode_pt: currentTable
            }
        });
        var currentForm, currentPageID;
        var fm_kode_ptview;
        loadjs.ready(["wrapper", "head"], function() {
            var $ = jQuery;
            // Form object
            fm_kode_ptview = new ew.Form("fm_kode_ptview", "view");
            currentPageID = ew.PAGE_ID = "view";
            currentForm = fm_kode_ptview;
            loadjs.done("fm_kode_ptview");
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
<form name="fm_kode_ptview" id="fm_kode_ptview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
    <?php if (Config("CHECK_TOKEN")) { ?>
        <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
        <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
    <?php } ?>
    <input type="hidden" name="t" value="m_kode_pt">
    <input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
    <table class="table table-striped table-bordered table-hover table-sm ew-view-table">
        <?php if ($Page->id->Visible) { // id 
        ?>
            <tr id="r_id" <?= $Page->id->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_kode_pt_id"><?= $Page->id->caption() ?></span></td>
                <td data-name="id" <?= $Page->id->cellAttributes() ?>>
                    <span id="el_m_kode_pt_id">
                        <span<?= $Page->id->viewAttributes() ?>>
                            <?= $Page->id->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->nama->Visible) { // nama 
        ?>
            <tr id="r_nama" <?= $Page->nama->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_kode_pt_nama"><?= $Page->nama->caption() ?></span></td>
                <td data-name="nama" <?= $Page->nama->cellAttributes() ?>>
                    <span id="el_m_kode_pt_nama">
                        <span<?= $Page->nama->viewAttributes() ?>>
                            <?= $Page->nama->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->nama_lengkap->Visible) { // nama_lengkap 
        ?>
            <tr id="r_nama_lengkap" <?= $Page->nama_lengkap->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_kode_pt_nama_lengkap"><?= $Page->nama_lengkap->caption() ?></span></td>
                <td data-name="nama_lengkap" <?= $Page->nama_lengkap->cellAttributes() ?>>
                    <span id="el_m_kode_pt_nama_lengkap">
                        <span<?= $Page->nama_lengkap->viewAttributes() ?>>
                            <?= $Page->nama_lengkap->getViewValue() ?>
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