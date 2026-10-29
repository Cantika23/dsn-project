<?php

namespace Mitral2022\DSN2;

// Table
$user = Container("user");
?>
<?php if ($user->Visible) { ?>
        <div class="ew-master-div">
                <table id="tbl_usermaster" class="table ew-view-table ew-master-table ew-vertical">
                        <tbody>
                                <?php if ($user->id->Visible) { // id 
                                ?>
                                        <tr id="r_id" <?= $user->id->rowAttributes() ?>>
                                                <td class="<?= $user->TableLeftColumnClass ?>"><?= $user->id->caption() ?></td>
                                                <td<?= $user->id->cellAttributes() ?>>
                                                        <span id="el_user_id">
                                                                <span<?= $user->id->viewAttributes() ?>>
                                                                        <?= $user->id->getViewValue() ?>
                                                        </span>
                                                        </span>
                                                        </td>
                                        </tr>
                                <?php } ?>
                                <?php if ($user->_username->Visible) { // username 
                                ?>
                                        <tr id="r__username" <?= $user->_username->rowAttributes() ?>>
                                                <td class="<?= $user->TableLeftColumnClass ?>"><?= $user->_username->caption() ?></td>
                                                <td<?= $user->_username->cellAttributes() ?>>
                                                        <span id="el_user__username">
                                                                <span<?= $user->_username->viewAttributes() ?>>
                                                                        <?= $user->_username->getViewValue() ?>
                                                        </span>
                                                        </span>
                                                        </td>
                                        </tr>
                                <?php } ?>
                                <?php if ($user->nama_user->Visible) { // nama_user 
                                ?>
                                        <tr id="r_nama_user" <?= $user->nama_user->rowAttributes() ?>>
                                                <td class="<?= $user->TableLeftColumnClass ?>"><?= $user->nama_user->caption() ?></td>
                                                <td<?= $user->nama_user->cellAttributes() ?>>
                                                        <span id="el_user_nama_user">
                                                                <span<?= $user->nama_user->viewAttributes() ?>>
                                                                        <?= $user->nama_user->getViewValue() ?>
                                                        </span>
                                                        </span>
                                                        </td>
                                        </tr>
                                <?php } ?>
                                <?php if ($user->_password->Visible) { // password 
                                ?>
                                        <tr id="r__password" <?= $user->_password->rowAttributes() ?>>
                                                <td class="<?= $user->TableLeftColumnClass ?>"><?= $user->_password->caption() ?></td>
                                                <td<?= $user->_password->cellAttributes() ?>>
                                                        <span id="el_user__password">
                                                                <span<?= $user->_password->viewAttributes() ?>>
                                                                        <?= $user->_password->getViewValue() ?>
                                                        </span>
                                                        </span>
                                                        </td>
                                        </tr>
                                <?php } ?>
                                <?php if ($user->_email->Visible) { // email 
                                ?>
                                        <tr id="r__email" <?= $user->_email->rowAttributes() ?>>
                                                <td class="<?= $user->TableLeftColumnClass ?>"><?= $user->_email->caption() ?></td>
                                                <td<?= $user->_email->cellAttributes() ?>>
                                                        <span id="el_user__email">
                                                                <span<?= $user->_email->viewAttributes() ?>>
                                                                        <?= $user->_email->getViewValue() ?>
                                                        </span>
                                                        </span>
                                                        </td>
                                        </tr>
                                <?php } ?>
                                <?php if ($user->level->Visible) { // level 
                                ?>
                                        <tr id="r_level" <?= $user->level->rowAttributes() ?>>
                                                <td class="<?= $user->TableLeftColumnClass ?>"><?= $user->level->caption() ?></td>
                                                <td<?= $user->level->cellAttributes() ?>>
                                                        <span id="el_user_level">
                                                                <span<?= $user->level->viewAttributes() ?>>
                                                                        <?= $user->level->getViewValue() ?>
                                                        </span>
                                                        </span>
                                                        </td>
                                        </tr>
                                <?php } ?>
                                <?php if ($user->npk->Visible) { // npk 
                                ?>
                                        <tr id="r_npk" <?= $user->npk->rowAttributes() ?>>
                                                <td class="<?= $user->TableLeftColumnClass ?>"><?= $user->npk->caption() ?></td>
                                                <td<?= $user->npk->cellAttributes() ?>>
                                                        <span id="el_user_npk">
                                                                <span<?= $user->npk->viewAttributes() ?>>
                                                                        <?= $user->npk->getViewValue() ?>
                                                        </span>
                                                        </span>
                                                        </td>
                                        </tr>
                                <?php } ?>
                                <?php if ($user->dept->Visible) { // dept 
                                ?>
                                        <tr id="r_dept" <?= $user->dept->rowAttributes() ?>>
                                                <td class="<?= $user->TableLeftColumnClass ?>"><?= $user->dept->caption() ?></td>
                                                <td<?= $user->dept->cellAttributes() ?>>
                                                        <span id="el_user_dept">
                                                                <span<?= $user->dept->viewAttributes() ?>>
                                                                        <?= $user->dept->getViewValue() ?>
                                                        </span>
                                                        </span>
                                                        </td>
                                        </tr>
                                <?php } ?>
                                <?php if ($user->id_pegawai->Visible) { // id_pegawai 
                                ?>
                                        <tr id="r_id_pegawai" <?= $user->id_pegawai->rowAttributes() ?>>
                                                <td class="<?= $user->TableLeftColumnClass ?>"><?= $user->id_pegawai->caption() ?></td>
                                                <td<?= $user->id_pegawai->cellAttributes() ?>>
                                                        <span id="el_user_id_pegawai">
                                                                <span<?= $user->id_pegawai->viewAttributes() ?>>
                                                                        <?= $user->id_pegawai->getViewValue() ?>
                                                        </span>
                                                        </span>
                                                        </td>
                                        </tr>
                                <?php } ?>
                                <?php if ($user->phone->Visible) { // phone 
                                ?>
                                        <tr id="r_phone" <?= $user->phone->rowAttributes() ?>>
                                                <td class="<?= $user->TableLeftColumnClass ?>"><?= $user->phone->caption() ?></td>
                                                <td<?= $user->phone->cellAttributes() ?>>
                                                        <span id="el_user_phone">
                                                                <span<?= $user->phone->viewAttributes() ?>>
                                                                        <?= $user->phone->getViewValue() ?>
                                                        </span>
                                                        </span>
                                                        </td>
                                        </tr>
                                <?php } ?>
                        </tbody>
                </table>
        </div>
<?php } ?>