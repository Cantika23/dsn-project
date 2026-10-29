<?php

namespace Mitral2022\DSN2;

// Page object
$PenerimaanPaketKeluarView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
    <script>
        var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
        ew.deepAssign(ew.vars, {
            tables: {
                penerimaan_paket_keluar: currentTable
            }
        });
        var currentForm, currentPageID;
        var fpenerimaan_paket_keluarview;
        loadjs.ready(["wrapper", "head"], function() {
            var $ = jQuery;
            // Form object
            fpenerimaan_paket_keluarview = new ew.Form("fpenerimaan_paket_keluarview", "view");
            currentPageID = ew.PAGE_ID = "view";
            currentForm = fpenerimaan_paket_keluarview;
            loadjs.done("fpenerimaan_paket_keluarview");
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
<form name="fpenerimaan_paket_keluarview" id="fpenerimaan_paket_keluarview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
    <?php if (Config("CHECK_TOKEN")) { ?>
        <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
        <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
    <?php } ?>
    <input type="hidden" name="t" value="penerimaan_paket_keluar">
    <input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
    <table class="table table-striped table-bordered table-hover table-sm ew-view-table">
        <?php if ($Page->status_sap->Visible) { // status_sap 
        ?>
            <tr id="r_status_sap" <?= $Page->status_sap->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_keluar_status_sap"><?= $Page->status_sap->caption() ?></span></td>
                <td data-name="status_sap" <?= $Page->status_sap->cellAttributes() ?>>
                    <span id="el_penerimaan_paket_keluar_status_sap">
                        <span<?= $Page->status_sap->viewAttributes() ?>>
                            <?= $Page->status_sap->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->tanggal_paket_keluar->Visible) { // tanggal_paket_keluar ?>
            <tr id="r_tanggal_paket_keluar"<?= $Page->tanggal_paket_keluar->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_keluar_tanggal_paket_keluar"><?= $Page->tanggal_paket_keluar->caption() ?></span></td>
                <td data-name="tanggal_paket_keluar"<?= $Page->tanggal_paket_keluar->cellAttributes() ?>>
        <span id="el_penerimaan_paket_keluar_tanggal_paket_keluar">
        <span<?= $Page->tanggal_paket_keluar->viewAttributes() ?>>
        <?= $Page->tanggal_paket_keluar->getViewValue() ?></span>
        </span>
        </td>
            </tr>
        <?php } ?>
        <?php if ($Page->no_dokumen_no_paket->Visible) { // no_dokumen_no_paket 
        ?>
            <tr id="r_no_dokumen_no_paket" <?= $Page->no_dokumen_no_paket->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_keluar_no_dokumen_no_paket"><?= $Page->no_dokumen_no_paket->caption() ?></span></td>
                <td data-name="no_dokumen_no_paket" <?= $Page->no_dokumen_no_paket->cellAttributes() ?>>
                    <span id="el_penerimaan_paket_keluar_no_dokumen_no_paket">
                        <span<?= $Page->no_dokumen_no_paket->viewAttributes() ?>>
                            <?= $Page->no_dokumen_no_paket->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->no_dokumen->Visible) { // no_dokumen 
        ?>
            <tr id="r_no_dokumen" <?= $Page->no_dokumen->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_keluar_no_dokumen"><?= $Page->no_dokumen->caption() ?></span></td>
                <td data-name="no_dokumen" <?= $Page->no_dokumen->cellAttributes() ?>>
                    <span id="el_penerimaan_paket_keluar_no_dokumen">
                        <span<?= $Page->no_dokumen->viewAttributes() ?>>
                            <?= $Page->no_dokumen->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->no_paket->Visible) { // no_paket 
        ?>
            <tr id="r_no_paket" <?= $Page->no_paket->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_keluar_no_paket"><?= $Page->no_paket->caption() ?></span></td>
                <td data-name="no_paket" <?= $Page->no_paket->cellAttributes() ?>>
                    <span id="el_penerimaan_paket_keluar_no_paket">
                        <span<?= $Page->no_paket->viewAttributes() ?>>
                            <?= $Page->no_paket->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->jenis_dokumen->Visible) { // jenis_dokumen 
        ?>
            <tr id="r_jenis_dokumen" <?= $Page->jenis_dokumen->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_keluar_jenis_dokumen"><?= $Page->jenis_dokumen->caption() ?></span></td>
                <td data-name="jenis_dokumen" <?= $Page->jenis_dokumen->cellAttributes() ?>>
                    <span id="el_penerimaan_paket_keluar_jenis_dokumen">
                        <span<?= $Page->jenis_dokumen->viewAttributes() ?>>
                            <?= $Page->jenis_dokumen->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->tujuan_penerima->Visible) { // tujuan_penerima 
        ?>
            <tr id="r_tujuan_penerima" <?= $Page->tujuan_penerima->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_keluar_tujuan_penerima"><?= $Page->tujuan_penerima->caption() ?></span></td>
                <td data-name="tujuan_penerima" <?= $Page->tujuan_penerima->cellAttributes() ?>>
                    <span id="el_penerimaan_paket_keluar_tujuan_penerima">
                        <span<?= $Page->tujuan_penerima->viewAttributes() ?>>
                            <?= $Page->tujuan_penerima->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->no_hp_penerima->Visible) { // no_hp_penerima 
        ?>
            <tr id="r_no_hp_penerima" <?= $Page->no_hp_penerima->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_keluar_no_hp_penerima"><?= $Page->no_hp_penerima->caption() ?></span></td>
                <td data-name="no_hp_penerima" <?= $Page->no_hp_penerima->cellAttributes() ?>>
                    <span id="el_penerimaan_paket_keluar_no_hp_penerima">
                        <span<?= $Page->no_hp_penerima->viewAttributes() ?>>
                            <?= $Page->no_hp_penerima->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->email_penerima->Visible) { // email_penerima 
        ?>
            <tr id="r_email_penerima" <?= $Page->email_penerima->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_keluar_email_penerima"><?= $Page->email_penerima->caption() ?></span></td>
                <td data-name="email_penerima" <?= $Page->email_penerima->cellAttributes() ?>>
                    <span id="el_penerimaan_paket_keluar_email_penerima">
                        <span<?= $Page->email_penerima->viewAttributes() ?>>
                            <?= $Page->email_penerima->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->status->Visible) { // status 
        ?>
            <tr id="r_status" <?= $Page->status->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_keluar_status"><?= $Page->status->caption() ?></span></td>
                <td data-name="status" <?= $Page->status->cellAttributes() ?>>
                    <span id="el_penerimaan_paket_keluar_status">
                        <span<?= $Page->status->viewAttributes() ?>>
                            <?= $Page->status->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->tanggal_terima->Visible) { // tanggal_terima 
        ?>
            <tr id="r_tanggal_terima" <?= $Page->tanggal_terima->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_keluar_tanggal_terima"><?= $Page->tanggal_terima->caption() ?></span></td>
                <td data-name="tanggal_terima" <?= $Page->tanggal_terima->cellAttributes() ?>>
                    <span id="el_penerimaan_paket_keluar_tanggal_terima">
                        <span<?= $Page->tanggal_terima->viewAttributes() ?>>
                            <?= $Page->tanggal_terima->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->jenis_pengirim->Visible) { // jenis_pengirim 
        ?>
            <tr id="r_jenis_pengirim" <?= $Page->jenis_pengirim->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_keluar_jenis_pengirim"><?= $Page->jenis_pengirim->caption() ?></span></td>
                <td data-name="jenis_pengirim" <?= $Page->jenis_pengirim->cellAttributes() ?>>
                    <span id="el_penerimaan_paket_keluar_jenis_pengirim">
                        <span<?= $Page->jenis_pengirim->viewAttributes() ?>>
                            <?= $Page->jenis_pengirim->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->nama_kurir->Visible) { // nama_kurir 
        ?>
            <tr id="r_nama_kurir" <?= $Page->nama_kurir->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_keluar_nama_kurir"><?= $Page->nama_kurir->caption() ?></span></td>
                <td data-name="nama_kurir" <?= $Page->nama_kurir->cellAttributes() ?>>
                    <span id="el_penerimaan_paket_keluar_nama_kurir">
                        <span<?= $Page->nama_kurir->viewAttributes() ?>>
                            <?= $Page->nama_kurir->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->no_awb->Visible) { // no_awb 
        ?>
            <tr id="r_no_awb" <?= $Page->no_awb->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_keluar_no_awb"><?= $Page->no_awb->caption() ?></span></td>
                <td data-name="no_awb" <?= $Page->no_awb->cellAttributes() ?>>
                    <span id="el_penerimaan_paket_keluar_no_awb">
                        <span<?= $Page->no_awb->viewAttributes() ?>>
                            <?= $Page->no_awb->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->bukti_penerimaan->Visible) { // bukti_penerimaan 
        ?>
            <tr id="r_bukti_penerimaan" <?= $Page->bukti_penerimaan->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_keluar_bukti_penerimaan"><?= $Page->bukti_penerimaan->caption() ?></span></td>
                <td data-name="bukti_penerimaan" <?= $Page->bukti_penerimaan->cellAttributes() ?>>
                    <span id="el_penerimaan_paket_keluar_bukti_penerimaan">
                        <span>
                            <?= GetFileViewTag($Page->bukti_penerimaan, $Page->bukti_penerimaan->getViewValue(), false) ?>
                        </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->nama_penerima->Visible) { // nama_penerima 
        ?>
            <tr id="r_nama_penerima" <?= $Page->nama_penerima->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_keluar_nama_penerima"><?= $Page->nama_penerima->caption() ?></span></td>
                <td data-name="nama_penerima" <?= $Page->nama_penerima->cellAttributes() ?>>
                    <span id="el_penerimaan_paket_keluar_nama_penerima">
                        <span<?= $Page->nama_penerima->viewAttributes() ?>>
                            <?= $Page->nama_penerima->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->perihal_dokumen_paket->Visible) { // perihal_dokumen_paket ?>
            <tr id="r_perihal_dokumen_paket"<?= $Page->perihal_dokumen_paket->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_keluar_perihal_dokumen_paket"><?= $Page->perihal_dokumen_paket->caption() ?></span></td>
                <td data-name="perihal_dokumen_paket"<?= $Page->perihal_dokumen_paket->cellAttributes() ?>>
        <span id="el_penerimaan_paket_keluar_perihal_dokumen_paket">
        <span<?= $Page->perihal_dokumen_paket->viewAttributes() ?>>
        <?= $Page->perihal_dokumen_paket->getViewValue() ?></span>
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