<?php

namespace Mitral2022\DSN2;

// Page object
$MJenisPengirimDelete = &$Page;
?>
<script>
    var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
    ew.deepAssign(ew.vars, {
        tables: {
            m_jenis_pengirim: currentTable
        }
    });
    var currentForm, currentPageID;
    var fm_jenis_pengirimdelete;
    loadjs.ready(["wrapper", "head"], function() {
        var $ = jQuery;
        // Form object
        fm_jenis_pengirimdelete = new ew.Form("fm_jenis_pengirimdelete", "delete");
        currentPageID = ew.PAGE_ID = "delete";
        currentForm = fm_jenis_pengirimdelete;
        loadjs.done("fm_jenis_pengirimdelete");
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
<form name="fm_jenis_pengirimdelete" id="fm_jenis_pengirimdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
    <?php if (Config("CHECK_TOKEN")) { ?>
        <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
        <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
    <?php } ?>
    <input type="hidden" name="t" value="m_jenis_pengirim">
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
                        <?php if ($Page->jenis_pengirim->Visible) { // jenis_pengirim 
                        ?>
                            <th class="<?= $Page->jenis_pengirim->headerCellClass() ?>"><span id="elh_m_jenis_pengirim_jenis_pengirim" class="m_jenis_pengirim_jenis_pengirim"><?= $Page->jenis_pengirim->caption() ?></span></th>
                        <?php } ?>
                        <?php if ($Page->keterangan->Visible) { // keterangan 
                        ?>
                            <th class="<?= $Page->keterangan->headerCellClass() ?>"><span id="elh_m_jenis_pengirim_keterangan" class="m_jenis_pengirim_keterangan"><?= $Page->keterangan->caption() ?></span></th>
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
                            <?php if ($Page->jenis_pengirim->Visible) { // jenis_pengirim 
                            ?>
                                <td<?= $Page->jenis_pengirim->cellAttributes() ?>>
                                    <span id="el<?= $Page->RowCount ?>_m_jenis_pengirim_jenis_pengirim" class="el_m_jenis_pengirim_jenis_pengirim">
                                        <span<?= $Page->jenis_pengirim->viewAttributes() ?>>
                                            <?= $Page->jenis_pengirim->getViewValue() ?>
                                    </span>
                                    </span>
                                    </td>
                                <?php } ?>
                                <?php if ($Page->keterangan->Visible) { // keterangan 
                                ?>
                                    <td<?= $Page->keterangan->cellAttributes() ?>>
                                        <span id="el<?= $Page->RowCount ?>_m_jenis_pengirim_keterangan" class="el_m_jenis_pengirim_keterangan">
                                            <span<?= $Page->keterangan->viewAttributes() ?>>
                                                <?= $Page->keterangan->getViewValue() ?>
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