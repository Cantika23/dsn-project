<?php

namespace Mitral2022\DSN2;

// Page object
$UserView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
    <script>
        var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
        ew.deepAssign(ew.vars, {
            tables: {
                user: currentTable
            }
        });
        var currentForm, currentPageID;
        var fuserview;
        loadjs.ready(["wrapper", "head"], function() {
            var $ = jQuery;
            // Form object
            fuserview = new ew.Form("fuserview", "view");
            currentPageID = ew.PAGE_ID = "view";
            currentForm = fuserview;
            loadjs.done("fuserview");
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
<form name="fuserview" id="fuserview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
    <?php if (Config("CHECK_TOKEN")) { ?>
        <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
        <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
    <?php } ?>
    <input type="hidden" name="t" value="user">
    <input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
    <table class="table table-striped table-bordered table-hover table-sm ew-view-table">
        <?php if ($Page->id->Visible) { // id 
        ?>
            <tr id="r_id" <?= $Page->id->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_user_id"><?= $Page->id->caption() ?></span></td>
                <td data-name="id" <?= $Page->id->cellAttributes() ?>>
                    <span id="el_user_id">
                        <span<?= $Page->id->viewAttributes() ?>>
                            <?= $Page->id->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->nama_user->Visible) { // nama_user 
        ?>
            <tr id="r_nama_user" <?= $Page->nama_user->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_user_nama_user"><?= $Page->nama_user->caption() ?></span></td>
                <td data-name="nama_user" <?= $Page->nama_user->cellAttributes() ?>>
                    <span id="el_user_nama_user">
                        <span<?= $Page->nama_user->viewAttributes() ?>>
                            <?= $Page->nama_user->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->_username->Visible) { // username 
        ?>
            <tr id="r__username" <?= $Page->_username->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_user__username"><?= $Page->_username->caption() ?></span></td>
                <td data-name="_username" <?= $Page->_username->cellAttributes() ?>>
                    <span id="el_user__username">
                        <span<?= $Page->_username->viewAttributes() ?>>
                            <?= $Page->_username->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->_password->Visible) { // password 
        ?>
            <tr id="r__password" <?= $Page->_password->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_user__password"><?= $Page->_password->caption() ?></span></td>
                <td data-name="_password" <?= $Page->_password->cellAttributes() ?>>
                    <span id="el_user__password">
                        <span<?= $Page->_password->viewAttributes() ?>>
                            <?= $Page->_password->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->_email->Visible) { // email 
        ?>
            <tr id="r__email" <?= $Page->_email->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_user__email"><?= $Page->_email->caption() ?></span></td>
                <td data-name="_email" <?= $Page->_email->cellAttributes() ?>>
                    <span id="el_user__email">
                        <span<?= $Page->_email->viewAttributes() ?>>
                            <?= $Page->_email->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->level->Visible) { // level 
        ?>
            <tr id="r_level" <?= $Page->level->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_user_level"><?= $Page->level->caption() ?></span></td>
                <td data-name="level" <?= $Page->level->cellAttributes() ?>>
                    <span id="el_user_level">
                        <span<?= $Page->level->viewAttributes() ?>>
                            <?= $Page->level->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->id_pegawai->Visible) { // id_pegawai 
        ?>
            <tr id="r_id_pegawai" <?= $Page->id_pegawai->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_user_id_pegawai"><?= $Page->id_pegawai->caption() ?></span></td>
                <td data-name="id_pegawai" <?= $Page->id_pegawai->cellAttributes() ?>>
                    <span id="el_user_id_pegawai">
                        <span<?= $Page->id_pegawai->viewAttributes() ?>>
                            <?= $Page->id_pegawai->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->npk->Visible) { // npk 
        ?>
            <tr id="r_npk" <?= $Page->npk->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_user_npk"><?= $Page->npk->caption() ?></span></td>
                <td data-name="npk" <?= $Page->npk->cellAttributes() ?>>
                    <span id="el_user_npk">
                        <span<?= $Page->npk->viewAttributes() ?>>
                            <?= $Page->npk->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->dept->Visible) { // dept 
        ?>
            <tr id="r_dept" <?= $Page->dept->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_user_dept"><?= $Page->dept->caption() ?></span></td>
                <td data-name="dept" <?= $Page->dept->cellAttributes() ?>>
                    <span id="el_user_dept">
                        <span<?= $Page->dept->viewAttributes() ?>>
                            <?= $Page->dept->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->phone->Visible) { // phone 
        ?>
            <tr id="r_phone" <?= $Page->phone->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_user_phone"><?= $Page->phone->caption() ?></span></td>
                <td data-name="phone" <?= $Page->phone->cellAttributes() ?>>
                    <span id="el_user_phone">
                        <span<?= $Page->phone->viewAttributes() ?>>
                            <?= $Page->phone->getViewValue() ?>
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