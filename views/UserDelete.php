<?php

namespace Mitral2022\DSN2;

// Page object
$UserDelete = &$Page;
?>
<script>
        var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
        ew.deepAssign(ew.vars, {
                tables: {
                        user: currentTable
                }
        });
        var currentForm, currentPageID;
        var fuserdelete;
        loadjs.ready(["wrapper", "head"], function() {
                var $ = jQuery;
                // Form object
                fuserdelete = new ew.Form("fuserdelete", "delete");
                currentPageID = ew.PAGE_ID = "delete";
                currentForm = fuserdelete;
                loadjs.done("fuserdelete");
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
<form name="fuserdelete" id="fuserdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
        <?php if (Config("CHECK_TOKEN")) { ?>
                <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
                <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
        <?php } ?>
        <input type="hidden" name="t" value="user">
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
                                                <?php if ($Page->nama_user->Visible) { // nama_user 
                                                ?>
                                                        <th class="<?= $Page->nama_user->headerCellClass() ?>"><span id="elh_user_nama_user" class="user_nama_user"><?= $Page->nama_user->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->_username->Visible) { // username 
                                                ?>
                                                        <th class="<?= $Page->_username->headerCellClass() ?>"><span id="elh_user__username" class="user__username"><?= $Page->_username->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->_password->Visible) { // password 
                                                ?>
                                                        <th class="<?= $Page->_password->headerCellClass() ?>"><span id="elh_user__password" class="user__password"><?= $Page->_password->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->_email->Visible) { // email 
                                                ?>
                                                        <th class="<?= $Page->_email->headerCellClass() ?>"><span id="elh_user__email" class="user__email"><?= $Page->_email->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->level->Visible) { // level 
                                                ?>
                                                        <th class="<?= $Page->level->headerCellClass() ?>"><span id="elh_user_level" class="user_level"><?= $Page->level->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->id_pegawai->Visible) { // id_pegawai 
                                                ?>
                                                        <th class="<?= $Page->id_pegawai->headerCellClass() ?>"><span id="elh_user_id_pegawai" class="user_id_pegawai"><?= $Page->id_pegawai->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->npk->Visible) { // npk 
                                                ?>
                                                        <th class="<?= $Page->npk->headerCellClass() ?>"><span id="elh_user_npk" class="user_npk"><?= $Page->npk->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->dept->Visible) { // dept 
                                                ?>
                                                        <th class="<?= $Page->dept->headerCellClass() ?>"><span id="elh_user_dept" class="user_dept"><?= $Page->dept->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->phone->Visible) { // phone 
                                                ?>
                                                        <th class="<?= $Page->phone->headerCellClass() ?>"><span id="elh_user_phone" class="user_phone"><?= $Page->phone->caption() ?></span></th>
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
                                                        <?php if ($Page->nama_user->Visible) { // nama_user 
                                                        ?>
                                                                <td<?= $Page->nama_user->cellAttributes() ?>>
                                                                        <span id="el<?= $Page->RowCount ?>_user_nama_user" class="el_user_nama_user">
                                                                                <span<?= $Page->nama_user->viewAttributes() ?>>
                                                                                        <?= $Page->nama_user->getViewValue() ?>
                                                                        </span>
                                                                        </span>
                                                                        </td>
                                                                <?php } ?>
                                                                <?php if ($Page->_username->Visible) { // username 
                                                                ?>
                                                                        <td<?= $Page->_username->cellAttributes() ?>>
                                                                                <span id="el<?= $Page->RowCount ?>_user__username" class="el_user__username">
                                                                                        <span<?= $Page->_username->viewAttributes() ?>>
                                                                                                <?= $Page->_username->getViewValue() ?>
                                                                                </span>
                                                                                </span>
                                                                                </td>
                                                                        <?php } ?>
                                                                        <?php if ($Page->_password->Visible) { // password 
                                                                        ?>
                                                                                <td<?= $Page->_password->cellAttributes() ?>>
                                                                                        <span id="el<?= $Page->RowCount ?>_user__password" class="el_user__password">
                                                                                                <span<?= $Page->_password->viewAttributes() ?>>
                                                                                                        <?= $Page->_password->getViewValue() ?>
                                                                                        </span>
                                                                                        </span>
                                                                                        </td>
                                                                                <?php } ?>
                                                                                <?php if ($Page->_email->Visible) { // email 
                                                                                ?>
                                                                                        <td<?= $Page->_email->cellAttributes() ?>>
                                                                                                <span id="el<?= $Page->RowCount ?>_user__email" class="el_user__email">
                                                                                                        <span<?= $Page->_email->viewAttributes() ?>>
                                                                                                                <?= $Page->_email->getViewValue() ?>
                                                                                                </span>
                                                                                                </span>
                                                                                                </td>
                                                                                        <?php } ?>
                                                                                        <?php if ($Page->level->Visible) { // level 
                                                                                        ?>
                                                                                                <td<?= $Page->level->cellAttributes() ?>>
                                                                                                        <span id="el<?= $Page->RowCount ?>_user_level" class="el_user_level">
                                                                                                                <span<?= $Page->level->viewAttributes() ?>>
                                                                                                                        <?= $Page->level->getViewValue() ?>
                                                                                                        </span>
                                                                                                        </span>
                                                                                                        </td>
                                                                                                <?php } ?>
                                                                                                <?php if ($Page->id_pegawai->Visible) { // id_pegawai 
                                                                                                ?>
                                                                                                        <td<?= $Page->id_pegawai->cellAttributes() ?>>
                                                                                                                <span id="el<?= $Page->RowCount ?>_user_id_pegawai" class="el_user_id_pegawai">
                                                                                                                        <span<?= $Page->id_pegawai->viewAttributes() ?>>
                                                                                                                                <?= $Page->id_pegawai->getViewValue() ?>
                                                                                                                </span>
                                                                                                                </span>
                                                                                                                </td>
                                                                                                        <?php } ?>
                                                                                                        <?php if ($Page->npk->Visible) { // npk 
                                                                                                        ?>
                                                                                                                <td<?= $Page->npk->cellAttributes() ?>>
                                                                                                                        <span id="el<?= $Page->RowCount ?>_user_npk" class="el_user_npk">
                                                                                                                                <span<?= $Page->npk->viewAttributes() ?>>
                                                                                                                                        <?= $Page->npk->getViewValue() ?>
                                                                                                                        </span>
                                                                                                                        </span>
                                                                                                                        </td>
                                                                                                                <?php } ?>
                                                                                                                <?php if ($Page->dept->Visible) { // dept 
                                                                                                                ?>
                                                                                                                        <td<?= $Page->dept->cellAttributes() ?>>
                                                                                                                                <span id="el<?= $Page->RowCount ?>_user_dept" class="el_user_dept">
                                                                                                                                        <span<?= $Page->dept->viewAttributes() ?>>
                                                                                                                                                <?= $Page->dept->getViewValue() ?>
                                                                                                                                </span>
                                                                                                                                </span>
                                                                                                                                </td>
                                                                                                                        <?php } ?>
                                                                                                                        <?php if ($Page->phone->Visible) { // phone 
                                                                                                                        ?>
                                                                                                                                <td<?= $Page->phone->cellAttributes() ?>>
                                                                                                                                        <span id="el<?= $Page->RowCount ?>_user_phone" class="el_user_phone">
                                                                                                                                                <span<?= $Page->phone->viewAttributes() ?>>
                                                                                                                                                        <?= $Page->phone->getViewValue() ?>
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