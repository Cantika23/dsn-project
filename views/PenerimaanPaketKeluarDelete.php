<?php

namespace Mitral2022\DSN2;

// Page object
$PenerimaanPaketKeluarDelete = &$Page;
?>
<script>
        var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
        ew.deepAssign(ew.vars, {
                tables: {
                        penerimaan_paket_keluar: currentTable
                }
        });
        var currentForm, currentPageID;
        var fpenerimaan_paket_keluardelete;
        loadjs.ready(["wrapper", "head"], function() {
                var $ = jQuery;
                // Form object
                fpenerimaan_paket_keluardelete = new ew.Form("fpenerimaan_paket_keluardelete", "delete");
                currentPageID = ew.PAGE_ID = "delete";
                currentForm = fpenerimaan_paket_keluardelete;
                loadjs.done("fpenerimaan_paket_keluardelete");
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
<form name="fpenerimaan_paket_keluardelete" id="fpenerimaan_paket_keluardelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
        <?php if (Config("CHECK_TOKEN")) { ?>
                <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
                <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
        <?php } ?>
        <input type="hidden" name="t" value="penerimaan_paket_keluar">
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
                                                <?php if ($Page->status_sap->Visible) { // status_sap 
                                                ?>
                                                        <th class="<?= $Page->status_sap->headerCellClass() ?>"><span id="elh_penerimaan_paket_keluar_status_sap" class="penerimaan_paket_keluar_status_sap"><?= $Page->status_sap->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->tanggal_paket_keluar->Visible) { // tanggal_paket_keluar ?>
                                                        <th class="<?= $Page->tanggal_paket_keluar->headerCellClass() ?>"><span id="elh_penerimaan_paket_keluar_tanggal_paket_keluar" class="penerimaan_paket_keluar_tanggal_paket_keluar"><?= $Page->tanggal_paket_keluar->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->jenis_dokumen->Visible) { // jenis_dokumen 
                                                ?>
                                                        <th class="<?= $Page->jenis_dokumen->headerCellClass() ?>"><span id="elh_penerimaan_paket_keluar_jenis_dokumen" class="penerimaan_paket_keluar_jenis_dokumen"><?= $Page->jenis_dokumen->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->no_dokumen_no_paket->Visible) { // no_dokumen_no_paket 
                                                ?>
                                                        <th class="<?= $Page->no_dokumen_no_paket->headerCellClass() ?>"><span id="elh_penerimaan_paket_keluar_no_dokumen_no_paket" class="penerimaan_paket_keluar_no_dokumen_no_paket"><?= $Page->no_dokumen_no_paket->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->tujuan_penerima->Visible) { // tujuan_penerima 
                                                ?>
                                                        <th class="<?= $Page->tujuan_penerima->headerCellClass() ?>"><span id="elh_penerimaan_paket_keluar_tujuan_penerima" class="penerimaan_paket_keluar_tujuan_penerima"><?= $Page->tujuan_penerima->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->no_hp_penerima->Visible) { // no_hp_penerima 
                                                ?>
                                                        <th class="<?= $Page->no_hp_penerima->headerCellClass() ?>"><span id="elh_penerimaan_paket_keluar_no_hp_penerima" class="penerimaan_paket_keluar_no_hp_penerima"><?= $Page->no_hp_penerima->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->email_penerima->Visible) { // email_penerima 
                                                ?>
                                                        <th class="<?= $Page->email_penerima->headerCellClass() ?>"><span id="elh_penerimaan_paket_keluar_email_penerima" class="penerimaan_paket_keluar_email_penerima"><?= $Page->email_penerima->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->id->Visible) { // id 
                                                ?>
                                                        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_penerimaan_paket_keluar_id" class="penerimaan_paket_keluar_id"><?= $Page->id->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->status->Visible) { // status 
                                                ?>
                                                        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_penerimaan_paket_keluar_status" class="penerimaan_paket_keluar_status"><?= $Page->status->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->tanggal_terima->Visible) { // tanggal_terima 
                                                ?>
                                                        <th class="<?= $Page->tanggal_terima->headerCellClass() ?>"><span id="elh_penerimaan_paket_keluar_tanggal_terima" class="penerimaan_paket_keluar_tanggal_terima"><?= $Page->tanggal_terima->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->jenis_pengirim->Visible) { // jenis_pengirim 
                                                ?>
                                                        <th class="<?= $Page->jenis_pengirim->headerCellClass() ?>"><span id="elh_penerimaan_paket_keluar_jenis_pengirim" class="penerimaan_paket_keluar_jenis_pengirim"><?= $Page->jenis_pengirim->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->nama_kurir->Visible) { // nama_kurir 
                                                ?>
                                                        <th class="<?= $Page->nama_kurir->headerCellClass() ?>"><span id="elh_penerimaan_paket_keluar_nama_kurir" class="penerimaan_paket_keluar_nama_kurir"><?= $Page->nama_kurir->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->no_awb->Visible) { // no_awb 
                                                ?>
                                                        <th class="<?= $Page->no_awb->headerCellClass() ?>"><span id="elh_penerimaan_paket_keluar_no_awb" class="penerimaan_paket_keluar_no_awb"><?= $Page->no_awb->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->id_user->Visible) { // id_user 
                                                ?>
                                                        <th class="<?= $Page->id_user->headerCellClass() ?>"><span id="elh_penerimaan_paket_keluar_id_user" class="penerimaan_paket_keluar_id_user"><?= $Page->id_user->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->bukti_penerimaan->Visible) { // bukti_penerimaan 
                                                ?>
                                                        <th class="<?= $Page->bukti_penerimaan->headerCellClass() ?>"><span id="elh_penerimaan_paket_keluar_bukti_penerimaan" class="penerimaan_paket_keluar_bukti_penerimaan"><?= $Page->bukti_penerimaan->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->nama_penerima->Visible) { // nama_penerima 
                                                ?>
                                                        <th class="<?= $Page->nama_penerima->headerCellClass() ?>"><span id="elh_penerimaan_paket_keluar_nama_penerima" class="penerimaan_paket_keluar_nama_penerima"><?= $Page->nama_penerima->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->perihal_dokumen_paket->Visible) { // perihal_dokumen_paket ?>
                                                        <th class="<?= $Page->perihal_dokumen_paket->headerCellClass() ?>"><span id="elh_penerimaan_paket_keluar_perihal_dokumen_paket" class="penerimaan_paket_keluar_perihal_dokumen_paket"><?= $Page->perihal_dokumen_paket->caption() ?></span></th>
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
                                                        <?php if ($Page->status_sap->Visible) { // status_sap 
                                                        ?>
                                                                <td<?= $Page->status_sap->cellAttributes() ?>>
                                                                        <span id="el<?= $Page->RowCount ?>_penerimaan_paket_keluar_status_sap" class="el_penerimaan_paket_keluar_status_sap">
                                                                                <span<?= $Page->status_sap->viewAttributes() ?>>
                                                                                        <?= $Page->status_sap->getViewValue() ?>
                                                                        </span>
                                                                        </span>
                                                                        </td>
                                                                <?php } ?>
                                                                
                                                        <?php if ($Page->tanggal_paket_keluar->Visible) { // tanggal_paket_keluar ?>
                                                                <td<?= $Page->tanggal_paket_keluar->cellAttributes() ?>>
                                                                <span id="el<?= $Page->RowCount ?>_penerimaan_paket_keluar_tanggal_paket_keluar" class="el_penerimaan_paket_keluar_tanggal_paket_keluar">
                                                                        <span<?= $Page->tanggal_paket_keluar->viewAttributes() ?>>
                                                                        <?= $Page->tanggal_paket_keluar->getViewValue() ?>
                                                                        </span>
                                                                        </span>
                                                                </td>
                                                                <?php } ?>
                                                                <?php if ($Page->no_dokumen_no_paket->Visible) { // no_dokumen_no_paket 
                                                                ?>
                                                                        <td<?= $Page->no_dokumen_no_paket->cellAttributes() ?>>
                                                                                <span id="el<?= $Page->RowCount ?>_penerimaan_paket_keluar_no_dokumen_no_paket" class="el_penerimaan_paket_keluar_no_dokumen_no_paket">
                                                                                        <span<?= $Page->no_dokumen_no_paket->viewAttributes() ?>>
                                                                                                <?= $Page->no_dokumen_no_paket->getViewValue() ?>
                                                                                </span>
                                                                                </span>
                                                                                </td>
                                                                        <?php } ?>
                                                                        <?php if ($Page->jenis_dokumen->Visible) { // jenis_dokumen 
                                                                        ?>
                                                                                <td<?= $Page->jenis_dokumen->cellAttributes() ?>>
                                                                                        <span id="el<?= $Page->RowCount ?>_penerimaan_paket_keluar_jenis_dokumen" class="el_penerimaan_paket_keluar_jenis_dokumen">
                                                                                                <span<?= $Page->jenis_dokumen->viewAttributes() ?>>
                                                                                                        <?= $Page->jenis_dokumen->getViewValue() ?>
                                                                                        </span>
                                                                                        </span>
                                                                                        </td>
                                                                                <?php } ?>
                                                                                <?php if ($Page->tujuan_penerima->Visible) { // tujuan_penerima 
                                                                                ?>
                                                                                        <td<?= $Page->tujuan_penerima->cellAttributes() ?>>
                                                                                                <span id="el<?= $Page->RowCount ?>_penerimaan_paket_keluar_tujuan_penerima" class="el_penerimaan_paket_keluar_tujuan_penerima">
                                                                                                        <span<?= $Page->tujuan_penerima->viewAttributes() ?>>
                                                                                                                <?= $Page->tujuan_penerima->getViewValue() ?>
                                                                                                </span>
                                                                                                </span>
                                                                                                </td>
                                                                                        <?php } ?>
                                                                                        <?php if ($Page->no_hp_penerima->Visible) { // no_hp_penerima 
                                                                                        ?>
                                                                                                <td<?= $Page->no_hp_penerima->cellAttributes() ?>>
                                                                                                        <span id="el<?= $Page->RowCount ?>_penerimaan_paket_keluar_no_hp_penerima" class="el_penerimaan_paket_keluar_no_hp_penerima">
                                                                                                                <span<?= $Page->no_hp_penerima->viewAttributes() ?>>
                                                                                                                        <?= $Page->no_hp_penerima->getViewValue() ?>
                                                                                                        </span>
                                                                                                        </span>
                                                                                                        </td>
                                                                                                <?php } ?>
                                                                                                <?php if ($Page->email_penerima->Visible) { // email_penerima 
                                                                                                ?>
                                                                                                        <td<?= $Page->email_penerima->cellAttributes() ?>>
                                                                                                                <span id="el<?= $Page->RowCount ?>_penerimaan_paket_keluar_email_penerima" class="el_penerimaan_paket_keluar_email_penerima">
                                                                                                                        <span<?= $Page->email_penerima->viewAttributes() ?>>
                                                                                                                                <?= $Page->email_penerima->getViewValue() ?>
                                                                                                                </span>
                                                                                                                </span>
                                                                                                                </td>
                                                                                                        <?php } ?>
                                                                                                        <?php if ($Page->id->Visible) { // id 
                                                                                                        ?>
                                                                                                                <td<?= $Page->id->cellAttributes() ?>>
                                                                                                                        <span id="el<?= $Page->RowCount ?>_penerimaan_paket_keluar_id" class="el_penerimaan_paket_keluar_id">
                                                                                                                                <span<?= $Page->id->viewAttributes() ?>>
                                                                                                                                        <?= $Page->id->getViewValue() ?>
                                                                                                                        </span>
                                                                                                                        </span>
                                                                                                                        </td>
                                                                                                                <?php } ?>
                                                                                                                <?php if ($Page->status->Visible) { // status 
                                                                                                                ?>
                                                                                                                        <td<?= $Page->status->cellAttributes() ?>>
                                                                                                                                <span id="el<?= $Page->RowCount ?>_penerimaan_paket_keluar_status" class="el_penerimaan_paket_keluar_status">
                                                                                                                                        <span<?= $Page->status->viewAttributes() ?>>
                                                                                                                                                <?= $Page->status->getViewValue() ?>
                                                                                                                                </span>
                                                                                                                                </span>
                                                                                                                                </td>
                                                                                                                        <?php } ?>
                                                                                                                        <?php if ($Page->tanggal_terima->Visible) { // tanggal_terima 
                                                                                                                        ?>
                                                                                                                                <td<?= $Page->tanggal_terima->cellAttributes() ?>>
                                                                                                                                        <span id="el<?= $Page->RowCount ?>_penerimaan_paket_keluar_tanggal_terima" class="el_penerimaan_paket_keluar_tanggal_terima">
                                                                                                                                                <span<?= $Page->tanggal_terima->viewAttributes() ?>>
                                                                                                                                                        <?= $Page->tanggal_terima->getViewValue() ?>
                                                                                                                                        </span>
                                                                                                                                        </span>
                                                                                                                                        </td>
                                                                                                                                <?php } ?>
                                                                                                                                <?php if ($Page->jenis_pengirim->Visible) { // jenis_pengirim 
                                                                                                                                ?>
                                                                                                                                        <td<?= $Page->jenis_pengirim->cellAttributes() ?>>
                                                                                                                                                <span id="el<?= $Page->RowCount ?>_penerimaan_paket_keluar_jenis_pengirim" class="el_penerimaan_paket_keluar_jenis_pengirim">
                                                                                                                                                        <span<?= $Page->jenis_pengirim->viewAttributes() ?>>
                                                                                                                                                                <?= $Page->jenis_pengirim->getViewValue() ?>
                                                                                                                                                </span>
                                                                                                                                                </span>
                                                                                                                                                </td>
                                                                                                                                        <?php } ?>
                                                                                                                                        <?php if ($Page->nama_kurir->Visible) { // nama_kurir 
                                                                                                                                        ?>
                                                                                                                                                <td<?= $Page->nama_kurir->cellAttributes() ?>>
                                                                                                                                                        <span id="el<?= $Page->RowCount ?>_penerimaan_paket_keluar_nama_kurir" class="el_penerimaan_paket_keluar_nama_kurir">
                                                                                                                                                                <span<?= $Page->nama_kurir->viewAttributes() ?>>
                                                                                                                                                                        <?= $Page->nama_kurir->getViewValue() ?>
                                                                                                                                                        </span>
                                                                                                                                                        </span>
                                                                                                                                                        </td>
                                                                                                                                                <?php } ?>
                                                                                                                                                <?php if ($Page->no_awb->Visible) { // no_awb 
                                                                                                                                                ?>
                                                                                                                                                        <td<?= $Page->no_awb->cellAttributes() ?>>
                                                                                                                                                                <span id="el<?= $Page->RowCount ?>_penerimaan_paket_keluar_no_awb" class="el_penerimaan_paket_keluar_no_awb">
                                                                                                                                                                        <span<?= $Page->no_awb->viewAttributes() ?>>
                                                                                                                                                                                <?= $Page->no_awb->getViewValue() ?>
                                                                                                                                                                </span>
                                                                                                                                                                </span>
                                                                                                                                                                </td>
                                                                                                                                                        <?php } ?>
                                                                                                                                                        <?php if ($Page->id_user->Visible) { // id_user 
                                                                                                                                                        ?>
                                                                                                                                                                <td<?= $Page->id_user->cellAttributes() ?>>
                                                                                                                                                                        <span id="el<?= $Page->RowCount ?>_penerimaan_paket_keluar_id_user" class="el_penerimaan_paket_keluar_id_user">
                                                                                                                                                                                <span<?= $Page->id_user->viewAttributes() ?>>
                                                                                                                                                                                        <?= $Page->id_user->getViewValue() ?>
                                                                                                                                                                        </span>
                                                                                                                                                                        </span>
                                                                                                                                                                        </td>
                                                                                                                                                                <?php } ?>
                                                                                                                                                                <?php if ($Page->bukti_penerimaan->Visible) { // bukti_penerimaan 
                                                                                                                                                                ?>
                                                                                                                                                                        <td<?= $Page->bukti_penerimaan->cellAttributes() ?>>
                                                                                                                                                                                <span id="el<?= $Page->RowCount ?>_penerimaan_paket_keluar_bukti_penerimaan" class="el_penerimaan_paket_keluar_bukti_penerimaan">
                                                                                                                                                                                        <span>
                                                                                                                                                                                                <?= GetFileViewTag($Page->bukti_penerimaan, $Page->bukti_penerimaan->getViewValue(), false) ?>
                                                                                                                                                                                        </span>
                                                                                                                                                                                </span>
                                                                                                                                                                                </td>
                                                                                                                                                                        <?php } ?>
                                                                                                                                                                        <?php if ($Page->nama_penerima->Visible) { // nama_penerima 
                                                                                                                                                                        ?>
                                                                                                                                                                                <td<?= $Page->nama_penerima->cellAttributes() ?>>
                                                                                                                                                                                        <span id="el<?= $Page->RowCount ?>_penerimaan_paket_keluar_nama_penerima" class="el_penerimaan_paket_keluar_nama_penerima">
                                                                                                                                                                                                <span<?= $Page->nama_penerima->viewAttributes() ?>>
                                                                                                                                                                                                        <?= $Page->nama_penerima->getViewValue() ?>
                                                                                                                                                                                        </span>
                                                                                                                                                                                        </span>
                                                                                                                                                                                        </td>
                                                                                                                                                                                <?php } ?>
                                                            <?php if ($Page->perihal_dokumen_paket->Visible) { // perihal_dokumen_paket ?>
                                                                    <td<?= $Page->perihal_dokumen_paket->cellAttributes() ?>>
                                                            <span id="el<?= $Page->RowCount ?>_penerimaan_paket_keluar_perihal_dokumen_paket" class="el_penerimaan_paket_keluar_perihal_dokumen_paket">
                                                            <span<?= $Page->perihal_dokumen_paket->viewAttributes() ?>>
                                                            <?= $Page->perihal_dokumen_paket->getViewValue() ?></span>
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