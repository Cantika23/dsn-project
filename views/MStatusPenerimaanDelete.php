<?php

namespace Mitral2022\DSN2;

// Page object
$MStatusPenerimaanDelete = &$Page;
?>
<script>
    var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
    ew.deepAssign(ew.vars, {
        tables: {
            m_status_penerimaan: currentTable
        }
    });
    var currentForm, currentPageID;
    var fm_status_penerimaandelete;
    loadjs.ready(["wrapper", "head"], function() {
        var $ = jQuery;
        // Form object
        fm_status_penerimaandelete = new ew.Form("fm_status_penerimaandelete", "delete");
        currentPageID = ew.PAGE_ID = "delete";
        currentForm = fm_status_penerimaandelete;
        loadjs.done("fm_status_penerimaandelete");
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
<form name="fm_status_penerimaandelete" id="fm_status_penerimaandelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
    <?php if (Config("CHECK_TOKEN")) { ?>
        <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
        <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
    <?php } ?>
    <input type="hidden" name="t" value="m_status_penerimaan">
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
                        <?php if ($Page->status->Visible) { // status 
                        ?>
                            <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_m_status_penerimaan_status" class="m_status_penerimaan_status"><?= $Page->status->caption() ?></span></th>
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
                            <?php if ($Page->status->Visible) { // status 
                            ?>
                                <td<?= $Page->status->cellAttributes() ?>>
                                    <span id="el<?= $Page->RowCount ?>_m_status_penerimaan_status" class="el_m_status_penerimaan_status">
                                        <span<?= $Page->status->viewAttributes() ?>>
                                            <?= $Page->status->getViewValue() ?>
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