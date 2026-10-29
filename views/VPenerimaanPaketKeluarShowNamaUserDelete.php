<?php

namespace Mitral2022\DSN2;

// Page object
$VPenerimaanPaketKeluarShowNamaUserDelete = &$Page;
?>
<script>
        var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
        ew.deepAssign(ew.vars, {
                tables: {
                        v_penerimaan_paket_keluar_show_nama_user: currentTable
                }
        });
        var currentForm, currentPageID;
        var fv_penerimaan_paket_keluar_show_nama_userdelete;
        loadjs.ready(["wrapper", "head"], function() {
                var $ = jQuery;
                // Form object
                fv_penerimaan_paket_keluar_show_nama_userdelete = new ew.Form("fv_penerimaan_paket_keluar_show_nama_userdelete", "delete");
                currentPageID = ew.PAGE_ID = "delete";
                currentForm = fv_penerimaan_paket_keluar_show_nama_userdelete;
                loadjs.done("fv_penerimaan_paket_keluar_show_nama_userdelete");
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
<form name="fv_penerimaan_paket_keluar_show_nama_userdelete" id="fv_penerimaan_paket_keluar_show_nama_userdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
        <?php if (Config("CHECK_TOKEN")) { ?>
                <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
                <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
        <?php } ?>
        <input type="hidden" name="t" value="v_penerimaan_paket_keluar_show_nama_user">
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
                                                <?php if ($Page->no_dokumen_no_paket->Visible) { // no_dokumen_no_paket 
                                                ?>
                                                        <th class="<?= $Page->no_dokumen_no_paket->headerCellClass() ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_no_dokumen_no_paket" class="v_penerimaan_paket_keluar_show_nama_user_no_dokumen_no_paket"><?= $Page->no_dokumen_no_paket->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->JenisDokumen->Visible) { // Jenis Dokumen 
                                                ?>
                                                        <th class="<?= $Page->JenisDokumen->headerCellClass() ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_JenisDokumen" class="v_penerimaan_paket_keluar_show_nama_user_JenisDokumen"><?= $Page->JenisDokumen->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->Penerima->Visible) { // Penerima 
                                                ?>
                                                        <th class="<?= $Page->Penerima->headerCellClass() ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_Penerima" class="v_penerimaan_paket_keluar_show_nama_user_Penerima"><?= $Page->Penerima->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->NoHPPenerima->Visible) { // No HP Penerima 
                                                ?>
                                                        <th class="<?= $Page->NoHPPenerima->headerCellClass() ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_NoHPPenerima" class="v_penerimaan_paket_keluar_show_nama_user_NoHPPenerima"><?= $Page->NoHPPenerima->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->EmailPenerima->Visible) { // Email Penerima 
                                                ?>
                                                        <th class="<?= $Page->EmailPenerima->headerCellClass() ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_EmailPenerima" class="v_penerimaan_paket_keluar_show_nama_user_EmailPenerima"><?= $Page->EmailPenerima->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->ID->Visible) { // ID 
                                                ?>
                                                        <th class="<?= $Page->ID->headerCellClass() ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_ID" class="v_penerimaan_paket_keluar_show_nama_user_ID"><?= $Page->ID->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->Status->Visible) { // Status 
                                                ?>
                                                        <th class="<?= $Page->Status->headerCellClass() ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_Status" class="v_penerimaan_paket_keluar_show_nama_user_Status"><?= $Page->Status->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->TanggalTerima->Visible) { // Tanggal Terima 
                                                ?>
                                                        <th class="<?= $Page->TanggalTerima->headerCellClass() ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_TanggalTerima" class="v_penerimaan_paket_keluar_show_nama_user_TanggalTerima"><?= $Page->TanggalTerima->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->MetodePengiriman->Visible) { // Metode Pengiriman 
                                                ?>
                                                        <th class="<?= $Page->MetodePengiriman->headerCellClass() ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_MetodePengiriman" class="v_penerimaan_paket_keluar_show_nama_user_MetodePengiriman"><?= $Page->MetodePengiriman->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->NamaEkspedisiMessenger->Visible) { // Nama Ekspedisi/Messenger 
                                                ?>
                                                        <th class="<?= $Page->NamaEkspedisiMessenger->headerCellClass() ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_NamaEkspedisiMessenger" class="v_penerimaan_paket_keluar_show_nama_user_NamaEkspedisiMessenger"><?= $Page->NamaEkspedisiMessenger->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->NoAWB->Visible) { // No AWB 
                                                ?>
                                                        <th class="<?= $Page->NoAWB->headerCellClass() ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_NoAWB" class="v_penerimaan_paket_keluar_show_nama_user_NoAWB"><?= $Page->NoAWB->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->PIC->Visible) { // PIC 
                                                ?>
                                                        <th class="<?= $Page->PIC->headerCellClass() ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_PIC" class="v_penerimaan_paket_keluar_show_nama_user_PIC"><?= $Page->PIC->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->CreatedDate->Visible) { // Created Date 
                                                ?>
                                                        <th class="<?= $Page->CreatedDate->headerCellClass() ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_CreatedDate" class="v_penerimaan_paket_keluar_show_nama_user_CreatedDate"><?= $Page->CreatedDate->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->BuktiPenerimaan->Visible) { // Bukti Penerimaan 
                                                ?>
                                                        <th class="<?= $Page->BuktiPenerimaan->headerCellClass() ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_BuktiPenerimaan" class="v_penerimaan_paket_keluar_show_nama_user_BuktiPenerimaan"><?= $Page->BuktiPenerimaan->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->NamaPenerima->Visible) { // Nama Penerima 
                                                ?>
                                                        <th class="<?= $Page->NamaPenerima->headerCellClass() ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_NamaPenerima" class="v_penerimaan_paket_keluar_show_nama_user_NamaPenerima"><?= $Page->NamaPenerima->caption() ?></span></th>
                                                <?php } ?>
                                                <?php if ($Page->StatusSAP->Visible) { // Status SAP 
                                                ?>
                                                        <th class="<?= $Page->StatusSAP->headerCellClass() ?>"><span id="elh_v_penerimaan_paket_keluar_show_nama_user_StatusSAP" class="v_penerimaan_paket_keluar_show_nama_user_StatusSAP"><?= $Page->StatusSAP->caption() ?></span></th>
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
                                                        <?php if ($Page->no_dokumen_no_paket->Visible) { // no_dokumen_no_paket 
                                                        ?>
                                                                <td<?= $Page->no_dokumen_no_paket->cellAttributes() ?>>
                                                                        <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_no_dokumen_no_paket" class="el_v_penerimaan_paket_keluar_show_nama_user_no_dokumen_no_paket">
                                                                                <span<?= $Page->no_dokumen_no_paket->viewAttributes() ?>>
                                                                                        <?= $Page->no_dokumen_no_paket->getViewValue() ?>
                                                                        </span>
                                                                        </span>
                                                                        </td>
                                                                <?php } ?>
                                                                <?php if ($Page->JenisDokumen->Visible) { // Jenis Dokumen 
                                                                ?>
                                                                        <td<?= $Page->JenisDokumen->cellAttributes() ?>>
                                                                                <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_JenisDokumen" class="el_v_penerimaan_paket_keluar_show_nama_user_JenisDokumen">
                                                                                        <span<?= $Page->JenisDokumen->viewAttributes() ?>>
                                                                                                <?= $Page->JenisDokumen->getViewValue() ?>
                                                                                </span>
                                                                                </span>
                                                                                </td>
                                                                        <?php } ?>
                                                                        <?php if ($Page->Penerima->Visible) { // Penerima 
                                                                        ?>
                                                                                <td<?= $Page->Penerima->cellAttributes() ?>>
                                                                                        <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_Penerima" class="el_v_penerimaan_paket_keluar_show_nama_user_Penerima">
                                                                                                <span<?= $Page->Penerima->viewAttributes() ?>>
                                                                                                        <?= $Page->Penerima->getViewValue() ?>
                                                                                        </span>
                                                                                        </span>
                                                                                        </td>
                                                                                <?php } ?>
                                                                                <?php if ($Page->NoHPPenerima->Visible) { // No HP Penerima 
                                                                                ?>
                                                                                        <td<?= $Page->NoHPPenerima->cellAttributes() ?>>
                                                                                                <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_NoHPPenerima" class="el_v_penerimaan_paket_keluar_show_nama_user_NoHPPenerima">
                                                                                                        <span<?= $Page->NoHPPenerima->viewAttributes() ?>>
                                                                                                                <?= $Page->NoHPPenerima->getViewValue() ?>
                                                                                                </span>
                                                                                                </span>
                                                                                                </td>
                                                                                        <?php } ?>
                                                                                        <?php if ($Page->EmailPenerima->Visible) { // Email Penerima 
                                                                                        ?>
                                                                                                <td<?= $Page->EmailPenerima->cellAttributes() ?>>
                                                                                                        <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_EmailPenerima" class="el_v_penerimaan_paket_keluar_show_nama_user_EmailPenerima">
                                                                                                                <span<?= $Page->EmailPenerima->viewAttributes() ?>>
                                                                                                                        <?= $Page->EmailPenerima->getViewValue() ?>
                                                                                                        </span>
                                                                                                        </span>
                                                                                                        </td>
                                                                                                <?php } ?>
                                                                                                <?php if ($Page->ID->Visible) { // ID 
                                                                                                ?>
                                                                                                        <td<?= $Page->ID->cellAttributes() ?>>
                                                                                                                <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_ID" class="el_v_penerimaan_paket_keluar_show_nama_user_ID">
                                                                                                                        <span<?= $Page->ID->viewAttributes() ?>>
                                                                                                                                <?= $Page->ID->getViewValue() ?>
                                                                                                                </span>
                                                                                                                </span>
                                                                                                                </td>
                                                                                                        <?php } ?>
                                                                                                        <?php if ($Page->Status->Visible) { // Status 
                                                                                                        ?>
                                                                                                                <td<?= $Page->Status->cellAttributes() ?>>
                                                                                                                        <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_Status" class="el_v_penerimaan_paket_keluar_show_nama_user_Status">
                                                                                                                                <span<?= $Page->Status->viewAttributes() ?>>
                                                                                                                                        <?= $Page->Status->getViewValue() ?>
                                                                                                                        </span>
                                                                                                                        </span>
                                                                                                                        </td>
                                                                                                                <?php } ?>
                                                                                                                <?php if ($Page->TanggalTerima->Visible) { // Tanggal Terima 
                                                                                                                ?>
                                                                                                                        <td<?= $Page->TanggalTerima->cellAttributes() ?>>
                                                                                                                                <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_TanggalTerima" class="el_v_penerimaan_paket_keluar_show_nama_user_TanggalTerima">
                                                                                                                                        <span<?= $Page->TanggalTerima->viewAttributes() ?>>
                                                                                                                                                <?= $Page->TanggalTerima->getViewValue() ?>
                                                                                                                                </span>
                                                                                                                                </span>
                                                                                                                                </td>
                                                                                                                        <?php } ?>
                                                                                                                        <?php if ($Page->MetodePengiriman->Visible) { // Metode Pengiriman 
                                                                                                                        ?>
                                                                                                                                <td<?= $Page->MetodePengiriman->cellAttributes() ?>>
                                                                                                                                        <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_MetodePengiriman" class="el_v_penerimaan_paket_keluar_show_nama_user_MetodePengiriman">
                                                                                                                                                <span<?= $Page->MetodePengiriman->viewAttributes() ?>>
                                                                                                                                                        <?= $Page->MetodePengiriman->getViewValue() ?>
                                                                                                                                        </span>
                                                                                                                                        </span>
                                                                                                                                        </td>
                                                                                                                                <?php } ?>
                                                                                                                                <?php if ($Page->NamaEkspedisiMessenger->Visible) { // Nama Ekspedisi/Messenger 
                                                                                                                                ?>
                                                                                                                                        <td<?= $Page->NamaEkspedisiMessenger->cellAttributes() ?>>
                                                                                                                                                <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_NamaEkspedisiMessenger" class="el_v_penerimaan_paket_keluar_show_nama_user_NamaEkspedisiMessenger">
                                                                                                                                                        <span<?= $Page->NamaEkspedisiMessenger->viewAttributes() ?>>
                                                                                                                                                                <?= $Page->NamaEkspedisiMessenger->getViewValue() ?>
                                                                                                                                                </span>
                                                                                                                                                </span>
                                                                                                                                                </td>
                                                                                                                                        <?php } ?>
                                                                                                                                        <?php if ($Page->NoAWB->Visible) { // No AWB 
                                                                                                                                        ?>
                                                                                                                                                <td<?= $Page->NoAWB->cellAttributes() ?>>
                                                                                                                                                        <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_NoAWB" class="el_v_penerimaan_paket_keluar_show_nama_user_NoAWB">
                                                                                                                                                                <span<?= $Page->NoAWB->viewAttributes() ?>>
                                                                                                                                                                        <?= $Page->NoAWB->getViewValue() ?>
                                                                                                                                                        </span>
                                                                                                                                                        </span>
                                                                                                                                                        </td>
                                                                                                                                                <?php } ?>
                                                                                                                                                <?php if ($Page->PIC->Visible) { // PIC 
                                                                                                                                                ?>
                                                                                                                                                        <td<?= $Page->PIC->cellAttributes() ?>>
                                                                                                                                                                <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_PIC" class="el_v_penerimaan_paket_keluar_show_nama_user_PIC">
                                                                                                                                                                        <span<?= $Page->PIC->viewAttributes() ?>>
                                                                                                                                                                                <?= $Page->PIC->getViewValue() ?>
                                                                                                                                                                </span>
                                                                                                                                                                </span>
                                                                                                                                                                </td>
                                                                                                                                                        <?php } ?>
                                                                                                                                                        <?php if ($Page->CreatedDate->Visible) { // Created Date 
                                                                                                                                                        ?>
                                                                                                                                                                <td<?= $Page->CreatedDate->cellAttributes() ?>>
                                                                                                                                                                        <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_CreatedDate" class="el_v_penerimaan_paket_keluar_show_nama_user_CreatedDate">
                                                                                                                                                                                <span<?= $Page->CreatedDate->viewAttributes() ?>>
                                                                                                                                                                                        <?= $Page->CreatedDate->getViewValue() ?>
                                                                                                                                                                        </span>
                                                                                                                                                                        </span>
                                                                                                                                                                        </td>
                                                                                                                                                                <?php } ?>
                                                                                                                                                                <?php if ($Page->BuktiPenerimaan->Visible) { // Bukti Penerimaan 
                                                                                                                                                                ?>
                                                                                                                                                                        <td<?= $Page->BuktiPenerimaan->cellAttributes() ?>>
                                                                                                                                                                                <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_BuktiPenerimaan" class="el_v_penerimaan_paket_keluar_show_nama_user_BuktiPenerimaan">
                                                                                                                                                                                        <span<?= $Page->BuktiPenerimaan->viewAttributes() ?>>
                                                                                                                                                                                                <?= $Page->BuktiPenerimaan->getViewValue() ?>
                                                                                                                                                                                </span>
                                                                                                                                                                                </span>
                                                                                                                                                                                </td>
                                                                                                                                                                        <?php } ?>
                                                                                                                                                                        <?php if ($Page->NamaPenerima->Visible) { // Nama Penerima 
                                                                                                                                                                        ?>
                                                                                                                                                                                <td<?= $Page->NamaPenerima->cellAttributes() ?>>
                                                                                                                                                                                        <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_NamaPenerima" class="el_v_penerimaan_paket_keluar_show_nama_user_NamaPenerima">
                                                                                                                                                                                                <span<?= $Page->NamaPenerima->viewAttributes() ?>>
                                                                                                                                                                                                        <?= $Page->NamaPenerima->getViewValue() ?>
                                                                                                                                                                                        </span>
                                                                                                                                                                                        </span>
                                                                                                                                                                                        </td>
                                                                                                                                                                                <?php } ?>
                                                                                                                                                                                <?php if ($Page->StatusSAP->Visible) { // Status SAP 
                                                                                                                                                                                ?>
                                                                                                                                                                                        <td<?= $Page->StatusSAP->cellAttributes() ?>>
                                                                                                                                                                                                <span id="el<?= $Page->RowCount ?>_v_penerimaan_paket_keluar_show_nama_user_StatusSAP" class="el_v_penerimaan_paket_keluar_show_nama_user_StatusSAP">
                                                                                                                                                                                                        <span<?= $Page->StatusSAP->viewAttributes() ?>>
                                                                                                                                                                                                                <?= $Page->StatusSAP->getViewValue() ?>
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