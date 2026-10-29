<?php

namespace Mitral2022\DSN2;

// Page object
$VPenerimaanPaketKeluarShowNamaUserView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
    <script>
        var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
        ew.deepAssign(ew.vars, {
            tables: {
                v_penerimaan_paket_keluar_show_nama_user: currentTable
            }
        });
        var currentForm, currentPageID;
        var fv_penerimaan_paket_keluar_show_nama_userview;
        loadjs.ready(["wrapper", "head"], function() {
            var $ = jQuery;
            // Form object
            fv_penerimaan_paket_keluar_show_nama_userview = new ew.Form("fv_penerimaan_paket_keluar_show_nama_userview", "view");
            currentPageID = ew.PAGE_ID = "view";
            currentForm = fv_penerimaan_paket_keluar_show_nama_userview;
            loadjs.done("fv_penerimaan_paket_keluar_show_nama_userview");
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
<form name="fv_penerimaan_paket_keluar_show_nama_userview" id="fv_penerimaan_paket_keluar_show_nama_userview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
    <?php if (Config("CHECK_TOKEN")) { ?>
        <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
        <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
    <?php } ?>
    <input type="hidden" name="t" value="v_penerimaan_paket_keluar_show_nama_user">
    <input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
    <table class="table table-striped table-bordered table-hover table-sm ew-view-table">
        <?php if ($Page->NoDokumen->Visible) { // No Dokumen 
        ?>
            <tr id="r_NoDokumen" <?= $Page->NoDokumen->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_NoDokumen"><?= $Page->NoDokumen->caption() ?></span></td>
                <td data-name="NoDokumen" <?= $Page->NoDokumen->cellAttributes() ?>>
                    <span id="el_v_penerimaan_paket_keluar_show_nama_user_NoDokumen">
                        <span<?= $Page->NoDokumen->viewAttributes() ?>>
                            <?= $Page->NoDokumen->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->NoPaket->Visible) { // No Paket 
        ?>
            <tr id="r_NoPaket" <?= $Page->NoPaket->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_NoPaket"><?= $Page->NoPaket->caption() ?></span></td>
                <td data-name="NoPaket" <?= $Page->NoPaket->cellAttributes() ?>>
                    <span id="el_v_penerimaan_paket_keluar_show_nama_user_NoPaket">
                        <span<?= $Page->NoPaket->viewAttributes() ?>>
                            <?= $Page->NoPaket->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->JenisDokumen->Visible) { // Jenis Dokumen 
        ?>
            <tr id="r_JenisDokumen" <?= $Page->JenisDokumen->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_JenisDokumen"><?= $Page->JenisDokumen->caption() ?></span></td>
                <td data-name="JenisDokumen" <?= $Page->JenisDokumen->cellAttributes() ?>>
                    <span id="el_v_penerimaan_paket_keluar_show_nama_user_JenisDokumen">
                        <span<?= $Page->JenisDokumen->viewAttributes() ?>>
                            <?= $Page->JenisDokumen->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->Penerima->Visible) { // Penerima 
        ?>
            <tr id="r_Penerima" <?= $Page->Penerima->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_Penerima"><?= $Page->Penerima->caption() ?></span></td>
                <td data-name="Penerima" <?= $Page->Penerima->cellAttributes() ?>>
                    <span id="el_v_penerimaan_paket_keluar_show_nama_user_Penerima">
                        <span<?= $Page->Penerima->viewAttributes() ?>>
                            <?= $Page->Penerima->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->NoHPPenerima->Visible) { // No HP Penerima 
        ?>
            <tr id="r_NoHPPenerima" <?= $Page->NoHPPenerima->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_NoHPPenerima"><?= $Page->NoHPPenerima->caption() ?></span></td>
                <td data-name="NoHPPenerima" <?= $Page->NoHPPenerima->cellAttributes() ?>>
                    <span id="el_v_penerimaan_paket_keluar_show_nama_user_NoHPPenerima">
                        <span<?= $Page->NoHPPenerima->viewAttributes() ?>>
                            <?= $Page->NoHPPenerima->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->EmailPenerima->Visible) { // Email Penerima 
        ?>
            <tr id="r_EmailPenerima" <?= $Page->EmailPenerima->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_EmailPenerima"><?= $Page->EmailPenerima->caption() ?></span></td>
                <td data-name="EmailPenerima" <?= $Page->EmailPenerima->cellAttributes() ?>>
                    <span id="el_v_penerimaan_paket_keluar_show_nama_user_EmailPenerima">
                        <span<?= $Page->EmailPenerima->viewAttributes() ?>>
                            <?= $Page->EmailPenerima->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->ID->Visible) { // ID 
        ?>
            <tr id="r_ID" <?= $Page->ID->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_ID"><?= $Page->ID->caption() ?></span></td>
                <td data-name="ID" <?= $Page->ID->cellAttributes() ?>>
                    <span id="el_v_penerimaan_paket_keluar_show_nama_user_ID">
                        <span<?= $Page->ID->viewAttributes() ?>>
                            <?= $Page->ID->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->Status->Visible) { // Status 
        ?>
            <tr id="r_Status" <?= $Page->Status->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_Status"><?= $Page->Status->caption() ?></span></td>
                <td data-name="Status" <?= $Page->Status->cellAttributes() ?>>
                    <span id="el_v_penerimaan_paket_keluar_show_nama_user_Status">
                        <span<?= $Page->Status->viewAttributes() ?>>
                            <?= $Page->Status->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->TanggalTerima->Visible) { // Tanggal Terima 
        ?>
            <tr id="r_TanggalTerima" <?= $Page->TanggalTerima->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_TanggalTerima"><?= $Page->TanggalTerima->caption() ?></span></td>
                <td data-name="TanggalTerima" <?= $Page->TanggalTerima->cellAttributes() ?>>
                    <span id="el_v_penerimaan_paket_keluar_show_nama_user_TanggalTerima">
                        <span<?= $Page->TanggalTerima->viewAttributes() ?>>
                            <?= $Page->TanggalTerima->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->MetodePengiriman->Visible) { // Metode Pengiriman 
        ?>
            <tr id="r_MetodePengiriman" <?= $Page->MetodePengiriman->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_MetodePengiriman"><?= $Page->MetodePengiriman->caption() ?></span></td>
                <td data-name="MetodePengiriman" <?= $Page->MetodePengiriman->cellAttributes() ?>>
                    <span id="el_v_penerimaan_paket_keluar_show_nama_user_MetodePengiriman">
                        <span<?= $Page->MetodePengiriman->viewAttributes() ?>>
                            <?= $Page->MetodePengiriman->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->NamaEkspedisiMessenger->Visible) { // Nama Ekspedisi/Messenger 
        ?>
            <tr id="r_NamaEkspedisiMessenger" <?= $Page->NamaEkspedisiMessenger->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_NamaEkspedisiMessenger"><?= $Page->NamaEkspedisiMessenger->caption() ?></span></td>
                <td data-name="NamaEkspedisiMessenger" <?= $Page->NamaEkspedisiMessenger->cellAttributes() ?>>
                    <span id="el_v_penerimaan_paket_keluar_show_nama_user_NamaEkspedisiMessenger">
                        <span<?= $Page->NamaEkspedisiMessenger->viewAttributes() ?>>
                            <?= $Page->NamaEkspedisiMessenger->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->NoAWB->Visible) { // No AWB 
        ?>
            <tr id="r_NoAWB" <?= $Page->NoAWB->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_NoAWB"><?= $Page->NoAWB->caption() ?></span></td>
                <td data-name="NoAWB" <?= $Page->NoAWB->cellAttributes() ?>>
                    <span id="el_v_penerimaan_paket_keluar_show_nama_user_NoAWB">
                        <span<?= $Page->NoAWB->viewAttributes() ?>>
                            <?= $Page->NoAWB->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->PIC->Visible) { // PIC 
        ?>
            <tr id="r_PIC" <?= $Page->PIC->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_PIC"><?= $Page->PIC->caption() ?></span></td>
                <td data-name="PIC" <?= $Page->PIC->cellAttributes() ?>>
                    <span id="el_v_penerimaan_paket_keluar_show_nama_user_PIC">
                        <span<?= $Page->PIC->viewAttributes() ?>>
                            <?= $Page->PIC->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->IDUser->Visible) { // ID User 
        ?>
            <tr id="r_IDUser" <?= $Page->IDUser->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_IDUser"><?= $Page->IDUser->caption() ?></span></td>
                <td data-name="IDUser" <?= $Page->IDUser->cellAttributes() ?>>
                    <span id="el_v_penerimaan_paket_keluar_show_nama_user_IDUser">
                        <span<?= $Page->IDUser->viewAttributes() ?>>
                            <?= $Page->IDUser->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->CreatedDate->Visible) { // Created Date 
        ?>
            <tr id="r_CreatedDate" <?= $Page->CreatedDate->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_CreatedDate"><?= $Page->CreatedDate->caption() ?></span></td>
                <td data-name="CreatedDate" <?= $Page->CreatedDate->cellAttributes() ?>>
                    <span id="el_v_penerimaan_paket_keluar_show_nama_user_CreatedDate">
                        <span<?= $Page->CreatedDate->viewAttributes() ?>>
                            <?= $Page->CreatedDate->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->BuktiPenerimaan->Visible) { // Bukti Penerimaan 
        ?>
            <tr id="r_BuktiPenerimaan" <?= $Page->BuktiPenerimaan->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_BuktiPenerimaan"><?= $Page->BuktiPenerimaan->caption() ?></span></td>
                <td data-name="BuktiPenerimaan" <?= $Page->BuktiPenerimaan->cellAttributes() ?>>
                    <span id="el_v_penerimaan_paket_keluar_show_nama_user_BuktiPenerimaan">
                        <span<?= $Page->BuktiPenerimaan->viewAttributes() ?>>
                            <?= $Page->BuktiPenerimaan->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->NamaPenerima->Visible) { // Nama Penerima 
        ?>
            <tr id="r_NamaPenerima" <?= $Page->NamaPenerima->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_NamaPenerima"><?= $Page->NamaPenerima->caption() ?></span></td>
                <td data-name="NamaPenerima" <?= $Page->NamaPenerima->cellAttributes() ?>>
                    <span id="el_v_penerimaan_paket_keluar_show_nama_user_NamaPenerima">
                        <span<?= $Page->NamaPenerima->viewAttributes() ?>>
                            <?= $Page->NamaPenerima->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->StatusSAP->Visible) { // Status SAP 
        ?>
            <tr id="r_StatusSAP" <?= $Page->StatusSAP->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_StatusSAP"><?= $Page->StatusSAP->caption() ?></span></td>
                <td data-name="StatusSAP" <?= $Page->StatusSAP->cellAttributes() ?>>
                    <span id="el_v_penerimaan_paket_keluar_show_nama_user_StatusSAP">
                        <span<?= $Page->StatusSAP->viewAttributes() ?>>
                            <?= $Page->StatusSAP->getViewValue() ?>
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