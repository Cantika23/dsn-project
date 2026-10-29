<?php

namespace Mitral2022\DSN2;

// Page object
$MNotifikasiExpiredDelete = &$Page;
?>
<script>
    var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
    ew.deepAssign(ew.vars, {
        tables: {
            m_notifikasi_expired: currentTable
        }
    });
    var currentForm, currentPageID;
    var fm_notifikasi_expireddelete;
    loadjs.ready(["wrapper", "head"], function() {
        var $ = jQuery;
        // Form object
        fm_notifikasi_expireddelete = new ew.Form("fm_notifikasi_expireddelete", "delete");
        currentPageID = ew.PAGE_ID = "delete";
        currentForm = fm_notifikasi_expireddelete;
        loadjs.done("fm_notifikasi_expireddelete");
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
<form name="fm_notifikasi_expireddelete" id="fm_notifikasi_expireddelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
    <?php if (Config("CHECK_TOKEN")) { ?>
        <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
        <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
    <?php } ?>
    <input type="hidden" name="t" value="m_notifikasi_expired">
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
                        <?php if ($Page->jenis_dokumen->Visible) { // jenis_dokumen 
                        ?>
                            <th class="<?= $Page->jenis_dokumen->headerCellClass() ?>"><span id="elh_m_notifikasi_expired_jenis_dokumen" class="m_notifikasi_expired_jenis_dokumen"><?= $Page->jenis_dokumen->caption() ?></span></th>
                        <?php } ?>
                        <?php if ($Page->interval->Visible) { // interval 
                        ?>
                            <th class="<?= $Page->interval->headerCellClass() ?>"><span id="elh_m_notifikasi_expired_interval" class="m_notifikasi_expired_interval"><?= $Page->interval->caption() ?></span></th>
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
                            <?php if ($Page->jenis_dokumen->Visible) { // jenis_dokumen 
                            ?>
                                <td<?= $Page->jenis_dokumen->cellAttributes() ?>>
                                    <span id="el<?= $Page->RowCount ?>_m_notifikasi_expired_jenis_dokumen" class="el_m_notifikasi_expired_jenis_dokumen">
                                        <span<?= $Page->jenis_dokumen->viewAttributes() ?>>
                                            <?= $Page->jenis_dokumen->getViewValue() ?>
                                    </span>
                                    </span>
                                    </td>
                                <?php } ?>
                                <?php if ($Page->interval->Visible) { // interval 
                                ?>
                                    <td<?= $Page->interval->cellAttributes() ?>>
                                        <span id="el<?= $Page->RowCount ?>_m_notifikasi_expired_interval" class="el_m_notifikasi_expired_interval">
                                            <span<?= $Page->interval->viewAttributes() ?>>
                                                <?= $Page->interval->getViewValue() ?>
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