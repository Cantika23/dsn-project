<?php

namespace Mitral2022\DSN2;

// Page object
$MKodePtDelete = &$Page;
?>
<script>
    var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
    ew.deepAssign(ew.vars, {
        tables: {
            m_kode_pt: currentTable
        }
    });
    var currentForm, currentPageID;
    var fm_kode_ptdelete;
    loadjs.ready(["wrapper", "head"], function() {
        var $ = jQuery;
        // Form object
        fm_kode_ptdelete = new ew.Form("fm_kode_ptdelete", "delete");
        currentPageID = ew.PAGE_ID = "delete";
        currentForm = fm_kode_ptdelete;
        loadjs.done("fm_kode_ptdelete");
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
<form name="fm_kode_ptdelete" id="fm_kode_ptdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
    <?php if (Config("CHECK_TOKEN")) { ?>
        <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
        <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
    <?php } ?>
    <input type="hidden" name="t" value="m_kode_pt">
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
                        <?php if ($Page->id->Visible) { // id 
                        ?>
                            <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_m_kode_pt_id" class="m_kode_pt_id"><?= $Page->id->caption() ?></span></th>
                        <?php } ?>
                        <?php if ($Page->nama->Visible) { // nama 
                        ?>
                            <th class="<?= $Page->nama->headerCellClass() ?>"><span id="elh_m_kode_pt_nama" class="m_kode_pt_nama"><?= $Page->nama->caption() ?></span></th>
                        <?php } ?>
                        <?php if ($Page->nama_lengkap->Visible) { // nama_lengkap 
                        ?>
                            <th class="<?= $Page->nama_lengkap->headerCellClass() ?>"><span id="elh_m_kode_pt_nama_lengkap" class="m_kode_pt_nama_lengkap"><?= $Page->nama_lengkap->caption() ?></span></th>
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
                            <?php if ($Page->id->Visible) { // id 
                            ?>
                                <td<?= $Page->id->cellAttributes() ?>>
                                    <span id="el<?= $Page->RowCount ?>_m_kode_pt_id" class="el_m_kode_pt_id">
                                        <span<?= $Page->id->viewAttributes() ?>>
                                            <?= $Page->id->getViewValue() ?>
                                    </span>
                                    </span>
                                    </td>
                                <?php } ?>
                                <?php if ($Page->nama->Visible) { // nama 
                                ?>
                                    <td<?= $Page->nama->cellAttributes() ?>>
                                        <span id="el<?= $Page->RowCount ?>_m_kode_pt_nama" class="el_m_kode_pt_nama">
                                            <span<?= $Page->nama->viewAttributes() ?>>
                                                <?= $Page->nama->getViewValue() ?>
                                        </span>
                                        </span>
                                        </td>
                                    <?php } ?>
                                    <?php if ($Page->nama_lengkap->Visible) { // nama_lengkap 
                                    ?>
                                        <td<?= $Page->nama_lengkap->cellAttributes() ?>>
                                            <span id="el<?= $Page->RowCount ?>_m_kode_pt_nama_lengkap" class="el_m_kode_pt_nama_lengkap">
                                                <span<?= $Page->nama_lengkap->viewAttributes() ?>>
                                                    <?= $Page->nama_lengkap->getViewValue() ?>
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