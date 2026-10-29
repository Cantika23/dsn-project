<?php

namespace Mitral2022\DSN2;

// Page object
$PenerimaanPaketMasukView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
    <script>
        var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
        ew.deepAssign(ew.vars, {
            tables: {
                penerimaan_paket_masuk: currentTable
            }
        });
        var currentForm, currentPageID;
        var fpenerimaan_paket_masukview;
        loadjs.ready(["wrapper", "head"], function() {
            var $ = jQuery;
            // Form object
            fpenerimaan_paket_masukview = new ew.Form("fpenerimaan_paket_masukview", "view");
            currentPageID = ew.PAGE_ID = "view";
            currentForm = fpenerimaan_paket_masukview;
            loadjs.done("fpenerimaan_paket_masukview");
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
<form name="fpenerimaan_paket_masukview" id="fpenerimaan_paket_masukview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
    <?php if (Config("CHECK_TOKEN")) { ?>
        <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
        <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
    <?php } ?>
    <input type="hidden" name="t" value="penerimaan_paket_masuk">
    <input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
    <table class="table table-striped table-bordered table-hover table-sm ew-view-table">
        <?php if ($Page->id->Visible) { // id 
        ?>
            <tr id="r_id" <?= $Page->id->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_masuk_id"><?= $Page->id->caption() ?></span></td>
                <td data-name="id" <?= $Page->id->cellAttributes() ?>>
                    <span id="el_penerimaan_paket_masuk_id">
                        <span<?= $Page->id->viewAttributes() ?>>
                            <?= $Page->id->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->no_dokumen_no_paket->Visible) { // no_dokumen_no_paket 
        ?>
            <tr id="r_no_dokumen_no_paket" <?= $Page->no_dokumen_no_paket->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_masuk_no_dokumen_no_paket"><?= $Page->no_dokumen_no_paket->caption() ?></span></td>
                <td data-name="no_dokumen_no_paket" <?= $Page->no_dokumen_no_paket->cellAttributes() ?>>
                    <span id="el_penerimaan_paket_masuk_no_dokumen_no_paket">
                        <span<?= $Page->no_dokumen_no_paket->viewAttributes() ?>>
                            <?= $Page->no_dokumen_no_paket->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->jenis_dokumen->Visible) { // jenis_dokumen 
        ?>
            <tr id="r_jenis_dokumen" <?= $Page->jenis_dokumen->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_masuk_jenis_dokumen"><?= $Page->jenis_dokumen->caption() ?></span></td>
                <td data-name="jenis_dokumen" <?= $Page->jenis_dokumen->cellAttributes() ?>>
                    <span id="el_penerimaan_paket_masuk_jenis_dokumen">
                        <span<?= $Page->jenis_dokumen->viewAttributes() ?>>
                            <?= $Page->jenis_dokumen->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->nama_pengirim->Visible) { // nama_pengirim 
        ?>
            <tr id="r_nama_pengirim" <?= $Page->nama_pengirim->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_masuk_nama_pengirim"><?= $Page->nama_pengirim->caption() ?></span></td>
                <td data-name="nama_pengirim" <?= $Page->nama_pengirim->cellAttributes() ?>>
                    <span id="el_penerimaan_paket_masuk_nama_pengirim">
                        <span<?= $Page->nama_pengirim->viewAttributes() ?>>
                            <?= $Page->nama_pengirim->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->keterangan->Visible) { // keterangan 
        ?>
            <tr id="r_keterangan" <?= $Page->keterangan->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_masuk_keterangan"><?= $Page->keterangan->caption() ?></span></td>
                <td data-name="keterangan" <?= $Page->keterangan->cellAttributes() ?>>
                    <span id="el_penerimaan_paket_masuk_keterangan">
                        <span<?= $Page->keterangan->viewAttributes() ?>>
                            <?= $Page->keterangan->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->nama_penerima->Visible) { // nama_penerima 
        ?>
            <tr id="r_nama_penerima" <?= $Page->nama_penerima->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_masuk_nama_penerima"><?= $Page->nama_penerima->caption() ?></span></td>
                <td data-name="nama_penerima" <?= $Page->nama_penerima->cellAttributes() ?>>
                    <span id="el_penerimaan_paket_masuk_nama_penerima">
                        <span<?= $Page->nama_penerima->viewAttributes() ?>>
                            <?= $Page->nama_penerima->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->email_penerima->Visible) { // email_penerima 
        ?>
            <tr id="r_email_penerima" <?= $Page->email_penerima->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_masuk_email_penerima"><?= $Page->email_penerima->caption() ?></span></td>
                <td data-name="email_penerima" <?= $Page->email_penerima->cellAttributes() ?>>
                    <span id="el_penerimaan_paket_masuk_email_penerima">
                        <span<?= $Page->email_penerima->viewAttributes() ?>>
                            <?= $Page->email_penerima->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->no_hp_penerima->Visible) { // no_hp_penerima 
        ?>
            <tr id="r_no_hp_penerima" <?= $Page->no_hp_penerima->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_masuk_no_hp_penerima"><?= $Page->no_hp_penerima->caption() ?></span></td>
                <td data-name="no_hp_penerima" <?= $Page->no_hp_penerima->cellAttributes() ?>>
                    <span id="el_penerimaan_paket_masuk_no_hp_penerima">
                        <span<?= $Page->no_hp_penerima->viewAttributes() ?>>
                            <?= $Page->no_hp_penerima->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->status->Visible) { // status 
        ?>
            <tr id="r_status" <?= $Page->status->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_masuk_status"><?= $Page->status->caption() ?></span></td>
                <td data-name="status" <?= $Page->status->cellAttributes() ?>>
                    <span id="el_penerimaan_paket_masuk_status">
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
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_masuk_tanggal_terima"><?= $Page->tanggal_terima->caption() ?></span></td>
                <td data-name="tanggal_terima" <?= $Page->tanggal_terima->cellAttributes() ?>>
                    <span id="el_penerimaan_paket_masuk_tanggal_terima">
                        <span<?= $Page->tanggal_terima->viewAttributes() ?>>
                            <?= $Page->tanggal_terima->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->bukti_penerimaan->Visible) { // bukti_penerimaan 
        ?>
            <tr id="r_bukti_penerimaan" <?= $Page->bukti_penerimaan->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_masuk_bukti_penerimaan"><?= $Page->bukti_penerimaan->caption() ?></span></td>
                <td data-name="bukti_penerimaan" <?= $Page->bukti_penerimaan->cellAttributes() ?>>
                    <span id="el_penerimaan_paket_masuk_bukti_penerimaan">
                        <span>
                            <?= GetFileViewTag($Page->bukti_penerimaan, $Page->bukti_penerimaan->getViewValue(), false) ?>
                        </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->diterima_oleh->Visible) { // diterima_oleh 
        ?>
            <tr id="r_diterima_oleh" <?= $Page->diterima_oleh->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_masuk_diterima_oleh"><?= $Page->diterima_oleh->caption() ?></span></td>
                <td data-name="diterima_oleh" <?= $Page->diterima_oleh->cellAttributes() ?>>
                    <span id="el_penerimaan_paket_masuk_diterima_oleh">
                        <span<?= $Page->diterima_oleh->viewAttributes() ?>>
                            <?= $Page->diterima_oleh->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->created_date->Visible) { // created_date 
        ?>
            <tr id="r_created_date" <?= $Page->created_date->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_masuk_created_date"><?= $Page->created_date->caption() ?></span></td>
                <td data-name="created_date" <?= $Page->created_date->cellAttributes() ?>>
                    <span id="el_penerimaan_paket_masuk_created_date">
                        <span<?= $Page->created_date->viewAttributes() ?>>
                            <?= $Page->created_date->getViewValue() ?>
                    </span>
                    </span>
                </td>
            </tr>
        <?php } ?>
        <?php if ($Page->update_by->Visible) { // update_by 
        ?>
            <tr id="r_update_by" <?= $Page->update_by->rowAttributes() ?>>
                <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penerimaan_paket_masuk_update_by"><?= $Page->update_by->caption() ?></span></td>
                <td data-name="update_by" <?= $Page->update_by->cellAttributes() ?>>
                    <span id="el_penerimaan_paket_masuk_update_by">
                        <span<?= $Page->update_by->viewAttributes() ?>>
                            <?= $Page->update_by->getViewValue() ?>
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