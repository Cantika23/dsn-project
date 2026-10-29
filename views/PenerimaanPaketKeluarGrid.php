<?php

namespace Mitral2022\DSN2;

// Set up and run Grid object
$Grid = Container("PenerimaanPaketKeluarGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
    <script>
        var fpenerimaan_paket_keluargrid;
        loadjs.ready(["wrapper", "head"], function() {
            var $ = jQuery;
            // Form object
            fpenerimaan_paket_keluargrid = new ew.Form("fpenerimaan_paket_keluargrid", "grid");
            fpenerimaan_paket_keluargrid.formKeyCountName = "<?= $Grid->FormKeyCountName ?>";

            // Add fields
            var currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
            ew.deepAssign(ew.vars, {
                tables: {
                    penerimaan_paket_keluar: currentTable
                }
            });
            var fields = currentTable.fields;
            fpenerimaan_paket_keluargrid.addFields([
                ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
                ["no_dokumen", [fields.no_dokumen.visible && fields.no_dokumen.required ? ew.Validators.required(fields.no_dokumen.caption) : null], fields.no_dokumen.isInvalid],
                ["no_paket", [fields.no_paket.visible && fields.no_paket.required ? ew.Validators.required(fields.no_paket.caption) : null], fields.no_paket.isInvalid],
                ["jenis_dokumen", [fields.jenis_dokumen.visible && fields.jenis_dokumen.required ? ew.Validators.required(fields.jenis_dokumen.caption) : null], fields.jenis_dokumen.isInvalid],
                ["tujuan_penerima", [fields.tujuan_penerima.visible && fields.tujuan_penerima.required ? ew.Validators.required(fields.tujuan_penerima.caption) : null], fields.tujuan_penerima.isInvalid],
                ["no_hp_penerima", [fields.no_hp_penerima.visible && fields.no_hp_penerima.required ? ew.Validators.required(fields.no_hp_penerima.caption) : null], fields.no_hp_penerima.isInvalid],
                ["email_penerima", [fields.email_penerima.visible && fields.email_penerima.required ? ew.Validators.required(fields.email_penerima.caption) : null], fields.email_penerima.isInvalid],
                ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
                ["tanggal_terima", [fields.tanggal_terima.visible && fields.tanggal_terima.required ? ew.Validators.required(fields.tanggal_terima.caption) : null, ew.Validators.datetime(fields.tanggal_terima.clientFormatPattern)], fields.tanggal_terima.isInvalid],
                ["jenis_pengirim", [fields.jenis_pengirim.visible && fields.jenis_pengirim.required ? ew.Validators.required(fields.jenis_pengirim.caption) : null], fields.jenis_pengirim.isInvalid],
                ["nama_kurir", [fields.nama_kurir.visible && fields.nama_kurir.required ? ew.Validators.required(fields.nama_kurir.caption) : null], fields.nama_kurir.isInvalid],
                ["no_awb", [fields.no_awb.visible && fields.no_awb.required ? ew.Validators.required(fields.no_awb.caption) : null], fields.no_awb.isInvalid],
                ["id_user", [fields.id_user.visible && fields.id_user.required ? ew.Validators.required(fields.id_user.caption) : null, ew.Validators.integer], fields.id_user.isInvalid],
                ["bukti_penerimaan", [fields.bukti_penerimaan.visible && fields.bukti_penerimaan.required ? ew.Validators.fileRequired(fields.bukti_penerimaan.caption) : null], fields.bukti_penerimaan.isInvalid],
                ["nama_penerima", [fields.nama_penerima.visible && fields.nama_penerima.required ? ew.Validators.required(fields.nama_penerima.caption) : null], fields.nama_penerima.isInvalid],
                ["status_sap", [fields.status_sap.visible && fields.status_sap.required ? ew.Validators.required(fields.status_sap.caption) : null, ew.Validators.integer], fields.status_sap.isInvalid]
            ]);

            // Check empty row
            fpenerimaan_paket_keluargrid.emptyRow = function(rowIndex) {
                var fobj = this.getForm(),
                    fields = [
                        ["no_dokumen", false],
                        ["no_paket", false],
                        ["jenis_dokumen", false],
                        ["tujuan_penerima", false],
                        ["no_hp_penerima", false],
                        ["email_penerima", false],
                        ["status", false],
                        ["tanggal_terima", false],
                        ["jenis_pengirim", false],
                        ["nama_kurir", false],
                        ["no_awb", false],
                        ["id_user", false],
                        ["bukti_penerimaan", false],
                        ["nama_penerima", false],
                        ["status_sap", false]
                    ];
                if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
                    return false;
                return true;
            }

            // Form_CustomValidate
            fpenerimaan_paket_keluargrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
                // Your custom validation code here, return false if invalid.
                return true;
            }

            // Use JavaScript validation or not
            fpenerimaan_paket_keluargrid.validateRequired = ew.CLIENT_VALIDATE;

            // Dynamic selection lists
            fpenerimaan_paket_keluargrid.lists.jenis_dokumen = <?= $Grid->jenis_dokumen->toClientList($Grid) ?>;
            fpenerimaan_paket_keluargrid.lists.status = <?= $Grid->status->toClientList($Grid) ?>;
            fpenerimaan_paket_keluargrid.lists.jenis_pengirim = <?= $Grid->jenis_pengirim->toClientList($Grid) ?>;
            fpenerimaan_paket_keluargrid.lists.nama_kurir = <?= $Grid->nama_kurir->toClientList($Grid) ?>;
            loadjs.done("fpenerimaan_paket_keluargrid");
        });
    </script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
    <div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> penerimaan_paket_keluar">
        <div id="fpenerimaan_paket_keluargrid" class="ew-form ew-list-form">
            <div id="gmp_penerimaan_paket_keluar" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
                <table id="tbl_penerimaan_paket_keluargrid" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
                    <thead>
                        <tr class="ew-table-header">
                            <?php
                            // Header row
                            $Grid->RowType = ROWTYPE_HEADER;

                            // Render list options
                            $Grid->renderListOptions();

                            // Render list options (header, left)
                            $Grid->ListOptions->render("header", "left");
                            ?>
                            <?php if ($Grid->id->Visible) { // id 
                            ?>
                                <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>" style="white-space: nowrap;">
                                    <div id="elh_penerimaan_paket_keluar_id" class="penerimaan_paket_keluar_id"><?= $Grid->renderFieldHeader($Grid->id) ?></div>
                                </th>
                            <?php } ?>
                            <?php if ($Grid->no_dokumen->Visible) { // no_dokumen 
                            ?>
                                <th data-name="no_dokumen" class="<?= $Grid->no_dokumen->headerCellClass() ?>">
                                    <div id="elh_penerimaan_paket_keluar_no_dokumen" class="penerimaan_paket_keluar_no_dokumen"><?= $Grid->renderFieldHeader($Grid->no_dokumen) ?></div>
                                </th>
                            <?php } ?>
                            <?php if ($Grid->no_paket->Visible) { // no_paket 
                            ?>
                                <th data-name="no_paket" class="<?= $Grid->no_paket->headerCellClass() ?>">
                                    <div id="elh_penerimaan_paket_keluar_no_paket" class="penerimaan_paket_keluar_no_paket"><?= $Grid->renderFieldHeader($Grid->no_paket) ?></div>
                                </th>
                            <?php } ?>
                            <?php if ($Grid->jenis_dokumen->Visible) { // jenis_dokumen 
                            ?>
                                <th data-name="jenis_dokumen" class="<?= $Grid->jenis_dokumen->headerCellClass() ?>">
                                    <div id="elh_penerimaan_paket_keluar_jenis_dokumen" class="penerimaan_paket_keluar_jenis_dokumen"><?= $Grid->renderFieldHeader($Grid->jenis_dokumen) ?></div>
                                </th>
                            <?php } ?>
                            <?php if ($Grid->tujuan_penerima->Visible) { // tujuan_penerima 
                            ?>
                                <th data-name="tujuan_penerima" class="<?= $Grid->tujuan_penerima->headerCellClass() ?>">
                                    <div id="elh_penerimaan_paket_keluar_tujuan_penerima" class="penerimaan_paket_keluar_tujuan_penerima"><?= $Grid->renderFieldHeader($Grid->tujuan_penerima) ?></div>
                                </th>
                            <?php } ?>
                            <?php if ($Grid->no_hp_penerima->Visible) { // no_hp_penerima 
                            ?>
                                <th data-name="no_hp_penerima" class="<?= $Grid->no_hp_penerima->headerCellClass() ?>">
                                    <div id="elh_penerimaan_paket_keluar_no_hp_penerima" class="penerimaan_paket_keluar_no_hp_penerima"><?= $Grid->renderFieldHeader($Grid->no_hp_penerima) ?></div>
                                </th>
                            <?php } ?>
                            <?php if ($Grid->email_penerima->Visible) { // email_penerima 
                            ?>
                                <th data-name="email_penerima" class="<?= $Grid->email_penerima->headerCellClass() ?>">
                                    <div id="elh_penerimaan_paket_keluar_email_penerima" class="penerimaan_paket_keluar_email_penerima"><?= $Grid->renderFieldHeader($Grid->email_penerima) ?></div>
                                </th>
                            <?php } ?>
                            <?php if ($Grid->status->Visible) { // status 
                            ?>
                                <th data-name="status" class="<?= $Grid->status->headerCellClass() ?>">
                                    <div id="elh_penerimaan_paket_keluar_status" class="penerimaan_paket_keluar_status"><?= $Grid->renderFieldHeader($Grid->status) ?></div>
                                </th>
                            <?php } ?>
                            <?php if ($Grid->tanggal_terima->Visible) { // tanggal_terima 
                            ?>
                                <th data-name="tanggal_terima" class="<?= $Grid->tanggal_terima->headerCellClass() ?>">
                                    <div id="elh_penerimaan_paket_keluar_tanggal_terima" class="penerimaan_paket_keluar_tanggal_terima"><?= $Grid->renderFieldHeader($Grid->tanggal_terima) ?></div>
                                </th>
                            <?php } ?>
                            <?php if ($Grid->jenis_pengirim->Visible) { // jenis_pengirim 
                            ?>
                                <th data-name="jenis_pengirim" class="<?= $Grid->jenis_pengirim->headerCellClass() ?>">
                                    <div id="elh_penerimaan_paket_keluar_jenis_pengirim" class="penerimaan_paket_keluar_jenis_pengirim"><?= $Grid->renderFieldHeader($Grid->jenis_pengirim) ?></div>
                                </th>
                            <?php } ?>
                            <?php if ($Grid->nama_kurir->Visible) { // nama_kurir 
                            ?>
                                <th data-name="nama_kurir" class="<?= $Grid->nama_kurir->headerCellClass() ?>">
                                    <div id="elh_penerimaan_paket_keluar_nama_kurir" class="penerimaan_paket_keluar_nama_kurir"><?= $Grid->renderFieldHeader($Grid->nama_kurir) ?></div>
                                </th>
                            <?php } ?>
                            <?php if ($Grid->no_awb->Visible) { // no_awb 
                            ?>
                                <th data-name="no_awb" class="<?= $Grid->no_awb->headerCellClass() ?>">
                                    <div id="elh_penerimaan_paket_keluar_no_awb" class="penerimaan_paket_keluar_no_awb"><?= $Grid->renderFieldHeader($Grid->no_awb) ?></div>
                                </th>
                            <?php } ?>
                            <?php if ($Grid->id_user->Visible) { // id_user 
                            ?>
                                <th data-name="id_user" class="<?= $Grid->id_user->headerCellClass() ?>">
                                    <div id="elh_penerimaan_paket_keluar_id_user" class="penerimaan_paket_keluar_id_user"><?= $Grid->renderFieldHeader($Grid->id_user) ?></div>
                                </th>
                            <?php } ?>
                            <?php if ($Grid->bukti_penerimaan->Visible) { // bukti_penerimaan 
                            ?>
                                <th data-name="bukti_penerimaan" class="<?= $Grid->bukti_penerimaan->headerCellClass() ?>">
                                    <div id="elh_penerimaan_paket_keluar_bukti_penerimaan" class="penerimaan_paket_keluar_bukti_penerimaan"><?= $Grid->renderFieldHeader($Grid->bukti_penerimaan) ?></div>
                                </th>
                            <?php } ?>
                            <?php if ($Grid->nama_penerima->Visible) { // nama_penerima 
                            ?>
                                <th data-name="nama_penerima" class="<?= $Grid->nama_penerima->headerCellClass() ?>">
                                    <div id="elh_penerimaan_paket_keluar_nama_penerima" class="penerimaan_paket_keluar_nama_penerima"><?= $Grid->renderFieldHeader($Grid->nama_penerima) ?></div>
                                </th>
                            <?php } ?>
                            <?php if ($Grid->status_sap->Visible) { // status_sap 
                            ?>
                                <th data-name="status_sap" class="<?= $Grid->status_sap->headerCellClass() ?>" style="white-space: nowrap;">
                                    <div id="elh_penerimaan_paket_keluar_status_sap" class="penerimaan_paket_keluar_status_sap"><?= $Grid->renderFieldHeader($Grid->status_sap) ?></div>
                                </th>
                            <?php } ?>
                            <?php
                            // Render list options (header, right)
                            $Grid->ListOptions->render("header", "right");
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $Grid->StartRecord = 1;
                        $Grid->StopRecord = $Grid->TotalRecords; // Show all records

                        // Restore number of post back records
                        if ($CurrentForm && ($Grid->isConfirm() || $Grid->EventCancelled)) {
                            $CurrentForm->Index = -1;
                            if ($CurrentForm->hasValue($Grid->FormKeyCountName) && ($Grid->isGridAdd() || $Grid->isGridEdit() || $Grid->isConfirm())) {
                                $Grid->KeyCount = $CurrentForm->getValue($Grid->FormKeyCountName);
                                $Grid->StopRecord = $Grid->StartRecord + $Grid->KeyCount - 1;
                            }
                        }
                        $Grid->RecordCount = $Grid->StartRecord - 1;
                        if ($Grid->Recordset && !$Grid->Recordset->EOF) {
                            // Nothing to do
                        } elseif ($Grid->isGridAdd() && !$Grid->AllowAddDeleteRow && $Grid->StopRecord == 0) {
                            $Grid->StopRecord = $Grid->GridAddRowCount;
                        }

                        // Initialize aggregate
                        $Grid->RowType = ROWTYPE_AGGREGATEINIT;
                        $Grid->resetAttributes();
                        $Grid->renderRow();
                        while ($Grid->RecordCount < $Grid->StopRecord) {
                            $Grid->RecordCount++;
                            if ($Grid->RecordCount >= $Grid->StartRecord) {
                                $Grid->RowCount++;
                                if ($Grid->isAdd() || $Grid->isGridAdd() || $Grid->isGridEdit() || $Grid->isConfirm()) {
                                    $Grid->RowIndex++;
                                    $CurrentForm->Index = $Grid->RowIndex;
                                    if ($CurrentForm->hasValue($Grid->FormActionName) && ($Grid->isConfirm() || $Grid->EventCancelled)) {
                                        $Grid->RowAction = strval($CurrentForm->getValue($Grid->FormActionName));
                                    } elseif ($Grid->isGridAdd()) {
                                        $Grid->RowAction = "insert";
                                    } else {
                                        $Grid->RowAction = "";
                                    }
                                }

                                // Set up key count
                                $Grid->KeyCount = $Grid->RowIndex;

                                // Init row class and style
                                $Grid->resetAttributes();
                                $Grid->CssClass = "";
                                if ($Grid->isGridAdd()) {
                                    if ($Grid->CurrentMode == "copy") {
                                        $Grid->loadRowValues($Grid->Recordset); // Load row values
                                        $Grid->OldKey = $Grid->getKey(true); // Get from CurrentValue
                                    } else {
                                        $Grid->loadRowValues(); // Load default values
                                        $Grid->OldKey = "";
                                    }
                                } else {
                                    $Grid->loadRowValues($Grid->Recordset); // Load row values
                                    $Grid->OldKey = $Grid->getKey(true); // Get from CurrentValue
                                }
                                $Grid->setKey($Grid->OldKey);
                                $Grid->RowType = ROWTYPE_VIEW; // Render view
                                if ($Grid->isGridAdd()) { // Grid add
                                    $Grid->RowType = ROWTYPE_ADD; // Render add
                                }
                                if ($Grid->isGridAdd() && $Grid->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) { // Insert failed
                                    $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
                                }
                                if ($Grid->isGridEdit()) { // Grid edit
                                    if ($Grid->EventCancelled) {
                                        $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
                                    }
                                    if ($Grid->RowAction == "insert") {
                                        $Grid->RowType = ROWTYPE_ADD; // Render add
                                    } else {
                                        $Grid->RowType = ROWTYPE_EDIT; // Render edit
                                    }
                                }
                                if ($Grid->isGridEdit() && ($Grid->RowType == ROWTYPE_EDIT || $Grid->RowType == ROWTYPE_ADD) && $Grid->EventCancelled) { // Update failed
                                    $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
                                }
                                if ($Grid->RowType == ROWTYPE_EDIT) { // Edit row
                                    $Grid->EditRowCount++;
                                }
                                if ($Grid->isConfirm()) { // Confirm row
                                    $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
                                }

                                // Set up row attributes
                                $Grid->RowAttrs->merge([
                                    "data-rowindex" => $Grid->RowCount,
                                    "id" => "r" . $Grid->RowCount . "_penerimaan_paket_keluar",
                                    "data-rowtype" => $Grid->RowType,
                                    "class" => ($Grid->RowCount % 2 != 1) ? "ew-table-alt-row" : "",
                                ]);
                                if ($Grid->isAdd() && $Grid->RowType == ROWTYPE_ADD || $Grid->isEdit() && $Grid->RowType == ROWTYPE_EDIT) { // Inline-Add/Edit row
                                    $Grid->RowAttrs->appendClass("table-active");
                                }

                                // Render row
                                $Grid->renderRow();

                                // Render list options
                                $Grid->renderListOptions();

                                // Skip delete row / empty row for confirm page
                                if (
                                    $Page->RowAction != "delete" &&
                                    $Page->RowAction != "insertdelete" &&
                                    !($Page->RowAction == "insert" && $Page->isConfirm() && $Page->emptyRow())
                                ) {
                        ?>
                                    <tr <?= $Grid->rowAttributes() ?>>
                                        <?php
                                        // Render list options (body, left)
                                        $Grid->ListOptions->render("body", "left", $Grid->RowCount);
                                        ?>
                                        <?php if ($Grid->id->Visible) { // id 
                                        ?>
                                            <td data-name="id" <?= $Grid->id->cellAttributes() ?>>
                                                <?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_id" class="el_penerimaan_paket_keluar_id"></span>
                                                    <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_id" class="el_penerimaan_paket_keluar_id">
                                                        <span<?= $Grid->id->viewAttributes() ?>>
                                                            <input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->EditValue))) ?>">
                                                    </span>
                                                    </span>
                                                    <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_id" class="el_penerimaan_paket_keluar_id">
                                                        <span<?= $Grid->id->viewAttributes() ?>>
                                                            <?= $Grid->id->getViewValue() ?>
                                                    </span>
                                                    </span>
                                                    <?php if ($Grid->isConfirm()) { ?>
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_id" data-hidden="1" name="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_id" id="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_id" data-hidden="1" name="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_id" id="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                        <?php } else { ?>
                                            <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
                                        <?php } ?>
                                        <?php if ($Grid->no_dokumen->Visible) { // no_dokumen 
                                        ?>
                                            <td data-name="no_dokumen" <?= $Grid->no_dokumen->cellAttributes() ?>>
                                                <?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_no_dokumen" class="el_penerimaan_paket_keluar_no_dokumen">
                                                        <input type="<?= $Grid->no_dokumen->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_no_dokumen" id="x<?= $Grid->RowIndex ?>_no_dokumen" data-table="penerimaan_paket_keluar" data-field="x_no_dokumen" value="<?= $Grid->no_dokumen->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->no_dokumen->getPlaceHolder()) ?>" <?= $Grid->no_dokumen->editAttributes() ?>>
                                                        <div class="invalid-feedback"><?= $Grid->no_dokumen->getErrorMessage() ?></div>
                                                    </span>
                                                    <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_no_dokumen" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_dokumen" id="o<?= $Grid->RowIndex ?>_no_dokumen" value="<?= HtmlEncode($Grid->no_dokumen->OldValue) ?>">
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_no_dokumen" class="el_penerimaan_paket_keluar_no_dokumen">
                                                        <input type="<?= $Grid->no_dokumen->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_no_dokumen" id="x<?= $Grid->RowIndex ?>_no_dokumen" data-table="penerimaan_paket_keluar" data-field="x_no_dokumen" value="<?= $Grid->no_dokumen->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->no_dokumen->getPlaceHolder()) ?>" <?= $Grid->no_dokumen->editAttributes() ?>>
                                                        <div class="invalid-feedback"><?= $Grid->no_dokumen->getErrorMessage() ?></div>
                                                    </span>
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_no_dokumen" class="el_penerimaan_paket_keluar_no_dokumen">
                                                        <span<?= $Grid->no_dokumen->viewAttributes() ?>>
                                                            <?= $Grid->no_dokumen->getViewValue() ?>
                                                    </span>
                                                    </span>
                                                    <?php if ($Grid->isConfirm()) { ?>
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_no_dokumen" data-hidden="1" name="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_no_dokumen" id="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_no_dokumen" value="<?= HtmlEncode($Grid->no_dokumen->FormValue) ?>">
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_no_dokumen" data-hidden="1" name="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_no_dokumen" id="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_no_dokumen" value="<?= HtmlEncode($Grid->no_dokumen->OldValue) ?>">
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Grid->no_paket->Visible) { // no_paket 
                                        ?>
                                            <td data-name="no_paket" <?= $Grid->no_paket->cellAttributes() ?>>
                                                <?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_no_paket" class="el_penerimaan_paket_keluar_no_paket">
                                                        <input type="<?= $Grid->no_paket->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_no_paket" id="x<?= $Grid->RowIndex ?>_no_paket" data-table="penerimaan_paket_keluar" data-field="x_no_paket" value="<?= $Grid->no_paket->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->no_paket->getPlaceHolder()) ?>" <?= $Grid->no_paket->editAttributes() ?>>
                                                        <div class="invalid-feedback"><?= $Grid->no_paket->getErrorMessage() ?></div>
                                                    </span>
                                                    <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_no_paket" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_paket" id="o<?= $Grid->RowIndex ?>_no_paket" value="<?= HtmlEncode($Grid->no_paket->OldValue) ?>">
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_no_paket" class="el_penerimaan_paket_keluar_no_paket">
                                                        <input type="<?= $Grid->no_paket->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_no_paket" id="x<?= $Grid->RowIndex ?>_no_paket" data-table="penerimaan_paket_keluar" data-field="x_no_paket" value="<?= $Grid->no_paket->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->no_paket->getPlaceHolder()) ?>" <?= $Grid->no_paket->editAttributes() ?>>
                                                        <div class="invalid-feedback"><?= $Grid->no_paket->getErrorMessage() ?></div>
                                                    </span>
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_no_paket" class="el_penerimaan_paket_keluar_no_paket">
                                                        <span<?= $Grid->no_paket->viewAttributes() ?>>
                                                            <?= $Grid->no_paket->getViewValue() ?>
                                                    </span>
                                                    </span>
                                                    <?php if ($Grid->isConfirm()) { ?>
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_no_paket" data-hidden="1" name="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_no_paket" id="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_no_paket" value="<?= HtmlEncode($Grid->no_paket->FormValue) ?>">
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_no_paket" data-hidden="1" name="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_no_paket" id="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_no_paket" value="<?= HtmlEncode($Grid->no_paket->OldValue) ?>">
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Grid->jenis_dokumen->Visible) { // jenis_dokumen 
                                        ?>
                                            <td data-name="jenis_dokumen" <?= $Grid->jenis_dokumen->cellAttributes() ?>>
                                                <?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_jenis_dokumen" class="el_penerimaan_paket_keluar_jenis_dokumen">
                                                        <select id="x<?= $Grid->RowIndex ?>_jenis_dokumen" name="x<?= $Grid->RowIndex ?>_jenis_dokumen" class="form-select ew-select<?= $Grid->jenis_dokumen->isInvalidClass() ?>" data-select2-id="fpenerimaan_paket_keluargrid_x<?= $Grid->RowIndex ?>_jenis_dokumen" data-table="penerimaan_paket_keluar" data-field="x_jenis_dokumen" data-value-separator="<?= $Grid->jenis_dokumen->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Grid->jenis_dokumen->getPlaceHolder()) ?>" <?= $Grid->jenis_dokumen->editAttributes() ?>>
                                                            <?= $Grid->jenis_dokumen->selectOptionListHtml("x{$Grid->RowIndex}_jenis_dokumen") ?>
                                                        </select>
                                                        <div class="invalid-feedback"><?= $Grid->jenis_dokumen->getErrorMessage() ?></div>
                                                        <?= $Grid->jenis_dokumen->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_jenis_dokumen") ?>
                                                        <script>
                                                            loadjs.ready("fpenerimaan_paket_keluargrid", function() {
                                                                var options = {
                                                                        name: "x<?= $Grid->RowIndex ?>_jenis_dokumen",
                                                                        selectId: "fpenerimaan_paket_keluargrid_x<?= $Grid->RowIndex ?>_jenis_dokumen"
                                                                    },
                                                                    el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
                                                                options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
                                                                if (fpenerimaan_paket_keluargrid.lists.jenis_dokumen.lookupOptions.length) {
                                                                    options.data = {
                                                                        id: "x<?= $Grid->RowIndex ?>_jenis_dokumen",
                                                                        form: "fpenerimaan_paket_keluargrid"
                                                                    };
                                                                } else {
                                                                    options.ajax = {
                                                                        id: "x<?= $Grid->RowIndex ?>_jenis_dokumen",
                                                                        form: "fpenerimaan_paket_keluargrid",
                                                                        limit: ew.LOOKUP_PAGE_SIZE
                                                                    };
                                                                }
                                                                options.minimumResultsForSearch = Infinity;
                                                                options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.penerimaan_paket_keluar.fields.jenis_dokumen.selectOptions);
                                                                ew.createSelect(options);
                                                            });
                                                        </script>
                                                    </span>
                                                    <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_jenis_dokumen" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jenis_dokumen" id="o<?= $Grid->RowIndex ?>_jenis_dokumen" value="<?= HtmlEncode($Grid->jenis_dokumen->OldValue) ?>">
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_jenis_dokumen" class="el_penerimaan_paket_keluar_jenis_dokumen">
                                                        <select id="x<?= $Grid->RowIndex ?>_jenis_dokumen" name="x<?= $Grid->RowIndex ?>_jenis_dokumen" class="form-select ew-select<?= $Grid->jenis_dokumen->isInvalidClass() ?>" data-select2-id="fpenerimaan_paket_keluargrid_x<?= $Grid->RowIndex ?>_jenis_dokumen" data-table="penerimaan_paket_keluar" data-field="x_jenis_dokumen" data-value-separator="<?= $Grid->jenis_dokumen->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Grid->jenis_dokumen->getPlaceHolder()) ?>" <?= $Grid->jenis_dokumen->editAttributes() ?>>
                                                            <?= $Grid->jenis_dokumen->selectOptionListHtml("x{$Grid->RowIndex}_jenis_dokumen") ?>
                                                        </select>
                                                        <div class="invalid-feedback"><?= $Grid->jenis_dokumen->getErrorMessage() ?></div>
                                                        <?= $Grid->jenis_dokumen->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_jenis_dokumen") ?>
                                                        <script>
                                                            loadjs.ready("fpenerimaan_paket_keluargrid", function() {
                                                                var options = {
                                                                        name: "x<?= $Grid->RowIndex ?>_jenis_dokumen",
                                                                        selectId: "fpenerimaan_paket_keluargrid_x<?= $Grid->RowIndex ?>_jenis_dokumen"
                                                                    },
                                                                    el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
                                                                options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
                                                                if (fpenerimaan_paket_keluargrid.lists.jenis_dokumen.lookupOptions.length) {
                                                                    options.data = {
                                                                        id: "x<?= $Grid->RowIndex ?>_jenis_dokumen",
                                                                        form: "fpenerimaan_paket_keluargrid"
                                                                    };
                                                                } else {
                                                                    options.ajax = {
                                                                        id: "x<?= $Grid->RowIndex ?>_jenis_dokumen",
                                                                        form: "fpenerimaan_paket_keluargrid",
                                                                        limit: ew.LOOKUP_PAGE_SIZE
                                                                    };
                                                                }
                                                                options.minimumResultsForSearch = Infinity;
                                                                options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.penerimaan_paket_keluar.fields.jenis_dokumen.selectOptions);
                                                                ew.createSelect(options);
                                                            });
                                                        </script>
                                                    </span>
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_jenis_dokumen" class="el_penerimaan_paket_keluar_jenis_dokumen">
                                                        <span<?= $Grid->jenis_dokumen->viewAttributes() ?>>
                                                            <?= $Grid->jenis_dokumen->getViewValue() ?>
                                                    </span>
                                                    </span>
                                                    <?php if ($Grid->isConfirm()) { ?>
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_jenis_dokumen" data-hidden="1" name="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_jenis_dokumen" id="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_jenis_dokumen" value="<?= HtmlEncode($Grid->jenis_dokumen->FormValue) ?>">
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_jenis_dokumen" data-hidden="1" name="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_jenis_dokumen" id="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_jenis_dokumen" value="<?= HtmlEncode($Grid->jenis_dokumen->OldValue) ?>">
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Grid->tujuan_penerima->Visible) { // tujuan_penerima 
                                        ?>
                                            <td data-name="tujuan_penerima" <?= $Grid->tujuan_penerima->cellAttributes() ?>>
                                                <?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_tujuan_penerima" class="el_penerimaan_paket_keluar_tujuan_penerima">
                                                        <textarea data-table="penerimaan_paket_keluar" data-field="x_tujuan_penerima" name="x<?= $Grid->RowIndex ?>_tujuan_penerima" id="x<?= $Grid->RowIndex ?>_tujuan_penerima" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->tujuan_penerima->getPlaceHolder()) ?>" <?= $Grid->tujuan_penerima->editAttributes() ?>><?= $Grid->tujuan_penerima->EditValue ?></textarea>
                                                        <div class="invalid-feedback"><?= $Grid->tujuan_penerima->getErrorMessage() ?></div>
                                                    </span>
                                                    <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_tujuan_penerima" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tujuan_penerima" id="o<?= $Grid->RowIndex ?>_tujuan_penerima" value="<?= HtmlEncode($Grid->tujuan_penerima->OldValue) ?>">
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_tujuan_penerima" class="el_penerimaan_paket_keluar_tujuan_penerima">
                                                        <textarea data-table="penerimaan_paket_keluar" data-field="x_tujuan_penerima" name="x<?= $Grid->RowIndex ?>_tujuan_penerima" id="x<?= $Grid->RowIndex ?>_tujuan_penerima" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->tujuan_penerima->getPlaceHolder()) ?>" <?= $Grid->tujuan_penerima->editAttributes() ?>><?= $Grid->tujuan_penerima->EditValue ?></textarea>
                                                        <div class="invalid-feedback"><?= $Grid->tujuan_penerima->getErrorMessage() ?></div>
                                                    </span>
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_tujuan_penerima" class="el_penerimaan_paket_keluar_tujuan_penerima">
                                                        <span<?= $Grid->tujuan_penerima->viewAttributes() ?>>
                                                            <?= $Grid->tujuan_penerima->getViewValue() ?>
                                                    </span>
                                                    </span>
                                                    <?php if ($Grid->isConfirm()) { ?>
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_tujuan_penerima" data-hidden="1" name="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_tujuan_penerima" id="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_tujuan_penerima" value="<?= HtmlEncode($Grid->tujuan_penerima->FormValue) ?>">
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_tujuan_penerima" data-hidden="1" name="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_tujuan_penerima" id="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_tujuan_penerima" value="<?= HtmlEncode($Grid->tujuan_penerima->OldValue) ?>">
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Grid->no_hp_penerima->Visible) { // no_hp_penerima 
                                        ?>
                                            <td data-name="no_hp_penerima" <?= $Grid->no_hp_penerima->cellAttributes() ?>>
                                                <?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_no_hp_penerima" class="el_penerimaan_paket_keluar_no_hp_penerima">
                                                        <input type="<?= $Grid->no_hp_penerima->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_no_hp_penerima" id="x<?= $Grid->RowIndex ?>_no_hp_penerima" data-table="penerimaan_paket_keluar" data-field="x_no_hp_penerima" value="<?= $Grid->no_hp_penerima->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->no_hp_penerima->getPlaceHolder()) ?>" <?= $Grid->no_hp_penerima->editAttributes() ?>>
                                                        <div class="invalid-feedback"><?= $Grid->no_hp_penerima->getErrorMessage() ?></div>
                                                    </span>
                                                    <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_no_hp_penerima" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_hp_penerima" id="o<?= $Grid->RowIndex ?>_no_hp_penerima" value="<?= HtmlEncode($Grid->no_hp_penerima->OldValue) ?>">
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_no_hp_penerima" class="el_penerimaan_paket_keluar_no_hp_penerima">
                                                        <input type="<?= $Grid->no_hp_penerima->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_no_hp_penerima" id="x<?= $Grid->RowIndex ?>_no_hp_penerima" data-table="penerimaan_paket_keluar" data-field="x_no_hp_penerima" value="<?= $Grid->no_hp_penerima->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->no_hp_penerima->getPlaceHolder()) ?>" <?= $Grid->no_hp_penerima->editAttributes() ?>>
                                                        <div class="invalid-feedback"><?= $Grid->no_hp_penerima->getErrorMessage() ?></div>
                                                    </span>
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_no_hp_penerima" class="el_penerimaan_paket_keluar_no_hp_penerima">
                                                        <span<?= $Grid->no_hp_penerima->viewAttributes() ?>>
                                                            <?= $Grid->no_hp_penerima->getViewValue() ?>
                                                    </span>
                                                    </span>
                                                    <?php if ($Grid->isConfirm()) { ?>
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_no_hp_penerima" data-hidden="1" name="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_no_hp_penerima" id="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_no_hp_penerima" value="<?= HtmlEncode($Grid->no_hp_penerima->FormValue) ?>">
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_no_hp_penerima" data-hidden="1" name="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_no_hp_penerima" id="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_no_hp_penerima" value="<?= HtmlEncode($Grid->no_hp_penerima->OldValue) ?>">
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Grid->email_penerima->Visible) { // email_penerima 
                                        ?>
                                            <td data-name="email_penerima" <?= $Grid->email_penerima->cellAttributes() ?>>
                                                <?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_email_penerima" class="el_penerimaan_paket_keluar_email_penerima">
                                                        <input type="<?= $Grid->email_penerima->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_email_penerima" id="x<?= $Grid->RowIndex ?>_email_penerima" data-table="penerimaan_paket_keluar" data-field="x_email_penerima" value="<?= $Grid->email_penerima->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->email_penerima->getPlaceHolder()) ?>" <?= $Grid->email_penerima->editAttributes() ?>>
                                                        <div class="invalid-feedback"><?= $Grid->email_penerima->getErrorMessage() ?></div>
                                                    </span>
                                                    <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_email_penerima" data-hidden="1" name="o<?= $Grid->RowIndex ?>_email_penerima" id="o<?= $Grid->RowIndex ?>_email_penerima" value="<?= HtmlEncode($Grid->email_penerima->OldValue) ?>">
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_email_penerima" class="el_penerimaan_paket_keluar_email_penerima">
                                                        <input type="<?= $Grid->email_penerima->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_email_penerima" id="x<?= $Grid->RowIndex ?>_email_penerima" data-table="penerimaan_paket_keluar" data-field="x_email_penerima" value="<?= $Grid->email_penerima->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->email_penerima->getPlaceHolder()) ?>" <?= $Grid->email_penerima->editAttributes() ?>>
                                                        <div class="invalid-feedback"><?= $Grid->email_penerima->getErrorMessage() ?></div>
                                                    </span>
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_email_penerima" class="el_penerimaan_paket_keluar_email_penerima">
                                                        <span<?= $Grid->email_penerima->viewAttributes() ?>>
                                                            <?= $Grid->email_penerima->getViewValue() ?>
                                                    </span>
                                                    </span>
                                                    <?php if ($Grid->isConfirm()) { ?>
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_email_penerima" data-hidden="1" name="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_email_penerima" id="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_email_penerima" value="<?= HtmlEncode($Grid->email_penerima->FormValue) ?>">
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_email_penerima" data-hidden="1" name="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_email_penerima" id="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_email_penerima" value="<?= HtmlEncode($Grid->email_penerima->OldValue) ?>">
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Grid->status->Visible) { // status 
                                        ?>
                                            <td data-name="status" <?= $Grid->status->cellAttributes() ?>>
                                                <?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_status" class="el_penerimaan_paket_keluar_status">
                                                        <select id="x<?= $Grid->RowIndex ?>_status" name="x<?= $Grid->RowIndex ?>_status" class="form-select ew-select<?= $Grid->status->isInvalidClass() ?>" data-select2-id="fpenerimaan_paket_keluargrid_x<?= $Grid->RowIndex ?>_status" data-table="penerimaan_paket_keluar" data-field="x_status" data-value-separator="<?= $Grid->status->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Grid->status->getPlaceHolder()) ?>" <?= $Grid->status->editAttributes() ?>>
                                                            <?= $Grid->status->selectOptionListHtml("x{$Grid->RowIndex}_status") ?>
                                                        </select>
                                                        <div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
                                                        <?= $Grid->status->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_status") ?>
                                                        <script>
                                                            loadjs.ready("fpenerimaan_paket_keluargrid", function() {
                                                                var options = {
                                                                        name: "x<?= $Grid->RowIndex ?>_status",
                                                                        selectId: "fpenerimaan_paket_keluargrid_x<?= $Grid->RowIndex ?>_status"
                                                                    },
                                                                    el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
                                                                options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
                                                                if (fpenerimaan_paket_keluargrid.lists.status.lookupOptions.length) {
                                                                    options.data = {
                                                                        id: "x<?= $Grid->RowIndex ?>_status",
                                                                        form: "fpenerimaan_paket_keluargrid"
                                                                    };
                                                                } else {
                                                                    options.ajax = {
                                                                        id: "x<?= $Grid->RowIndex ?>_status",
                                                                        form: "fpenerimaan_paket_keluargrid",
                                                                        limit: ew.LOOKUP_PAGE_SIZE
                                                                    };
                                                                }
                                                                options.minimumResultsForSearch = Infinity;
                                                                options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.penerimaan_paket_keluar.fields.status.selectOptions);
                                                                ew.createSelect(options);
                                                            });
                                                        </script>
                                                    </span>
                                                    <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_status" data-hidden="1" name="o<?= $Grid->RowIndex ?>_status" id="o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_status" class="el_penerimaan_paket_keluar_status">
                                                        <select id="x<?= $Grid->RowIndex ?>_status" name="x<?= $Grid->RowIndex ?>_status" class="form-select ew-select<?= $Grid->status->isInvalidClass() ?>" data-select2-id="fpenerimaan_paket_keluargrid_x<?= $Grid->RowIndex ?>_status" data-table="penerimaan_paket_keluar" data-field="x_status" data-value-separator="<?= $Grid->status->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Grid->status->getPlaceHolder()) ?>" <?= $Grid->status->editAttributes() ?>>
                                                            <?= $Grid->status->selectOptionListHtml("x{$Grid->RowIndex}_status") ?>
                                                        </select>
                                                        <div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
                                                        <?= $Grid->status->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_status") ?>
                                                        <script>
                                                            loadjs.ready("fpenerimaan_paket_keluargrid", function() {
                                                                var options = {
                                                                        name: "x<?= $Grid->RowIndex ?>_status",
                                                                        selectId: "fpenerimaan_paket_keluargrid_x<?= $Grid->RowIndex ?>_status"
                                                                    },
                                                                    el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
                                                                options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
                                                                if (fpenerimaan_paket_keluargrid.lists.status.lookupOptions.length) {
                                                                    options.data = {
                                                                        id: "x<?= $Grid->RowIndex ?>_status",
                                                                        form: "fpenerimaan_paket_keluargrid"
                                                                    };
                                                                } else {
                                                                    options.ajax = {
                                                                        id: "x<?= $Grid->RowIndex ?>_status",
                                                                        form: "fpenerimaan_paket_keluargrid",
                                                                        limit: ew.LOOKUP_PAGE_SIZE
                                                                    };
                                                                }
                                                                options.minimumResultsForSearch = Infinity;
                                                                options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.penerimaan_paket_keluar.fields.status.selectOptions);
                                                                ew.createSelect(options);
                                                            });
                                                        </script>
                                                    </span>
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_status" class="el_penerimaan_paket_keluar_status">
                                                        <span<?= $Grid->status->viewAttributes() ?>>
                                                            <?= $Grid->status->getViewValue() ?>
                                                    </span>
                                                    </span>
                                                    <?php if ($Grid->isConfirm()) { ?>
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_status" data-hidden="1" name="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_status" id="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->FormValue) ?>">
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_status" data-hidden="1" name="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_status" id="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Grid->tanggal_terima->Visible) { // tanggal_terima 
                                        ?>
                                            <td data-name="tanggal_terima" <?= $Grid->tanggal_terima->cellAttributes() ?>>
                                                <?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_tanggal_terima" class="el_penerimaan_paket_keluar_tanggal_terima">
                                                        <input type="<?= $Grid->tanggal_terima->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tanggal_terima" id="x<?= $Grid->RowIndex ?>_tanggal_terima" data-table="penerimaan_paket_keluar" data-field="x_tanggal_terima" value="<?= $Grid->tanggal_terima->EditValue ?>" placeholder="<?= HtmlEncode($Grid->tanggal_terima->getPlaceHolder()) ?>" <?= $Grid->tanggal_terima->editAttributes() ?>>
                                                        <div class="invalid-feedback"><?= $Grid->tanggal_terima->getErrorMessage() ?></div>
                                                        <?php if (!$Grid->tanggal_terima->ReadOnly && !$Grid->tanggal_terima->Disabled && !isset($Grid->tanggal_terima->EditAttrs["readonly"]) && !isset($Grid->tanggal_terima->EditAttrs["disabled"])) { ?>
                                                            <script>
                                                                loadjs.ready(["fpenerimaan_paket_keluargrid", "datetimepicker"], function() {
                                                                    let format = "<?= DateFormat(0) ?>",
                                                                        options = {
                                                                            localization: {
                                                                                locale: ew.LANGUAGE_ID,
                                                                                numberingSystem: ew.getNumberingSystem()
                                                                            },
                                                                            display: {
                                                                                format,
                                                                                components: {
                                                                                    hours: !!format.match(/h/i),
                                                                                    minutes: !!format.match(/m/),
                                                                                    seconds: !!format.match(/s/i)
                                                                                },
                                                                                icons: {
                                                                                    previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                                                                                    next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
                                                                                }
                                                                            }
                                                                        };
                                                                    ew.createDateTimePicker("fpenerimaan_paket_keluargrid", "x<?= $Grid->RowIndex ?>_tanggal_terima", jQuery.extend(true, {
                                                                        "useCurrent": false
                                                                    }, options));
                                                                });
                                                            </script>
                                                        <?php } ?>
                                                    </span>
                                                    <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_tanggal_terima" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tanggal_terima" id="o<?= $Grid->RowIndex ?>_tanggal_terima" value="<?= HtmlEncode($Grid->tanggal_terima->OldValue) ?>">
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_tanggal_terima" class="el_penerimaan_paket_keluar_tanggal_terima">
                                                        <input type="<?= $Grid->tanggal_terima->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tanggal_terima" id="x<?= $Grid->RowIndex ?>_tanggal_terima" data-table="penerimaan_paket_keluar" data-field="x_tanggal_terima" value="<?= $Grid->tanggal_terima->EditValue ?>" placeholder="<?= HtmlEncode($Grid->tanggal_terima->getPlaceHolder()) ?>" <?= $Grid->tanggal_terima->editAttributes() ?>>
                                                        <div class="invalid-feedback"><?= $Grid->tanggal_terima->getErrorMessage() ?></div>
                                                        <?php if (!$Grid->tanggal_terima->ReadOnly && !$Grid->tanggal_terima->Disabled && !isset($Grid->tanggal_terima->EditAttrs["readonly"]) && !isset($Grid->tanggal_terima->EditAttrs["disabled"])) { ?>
                                                            <script>
                                                                loadjs.ready(["fpenerimaan_paket_keluargrid", "datetimepicker"], function() {
                                                                    let format = "<?= DateFormat(0) ?>",
                                                                        options = {
                                                                            localization: {
                                                                                locale: ew.LANGUAGE_ID,
                                                                                numberingSystem: ew.getNumberingSystem()
                                                                            },
                                                                            display: {
                                                                                format,
                                                                                components: {
                                                                                    hours: !!format.match(/h/i),
                                                                                    minutes: !!format.match(/m/),
                                                                                    seconds: !!format.match(/s/i)
                                                                                },
                                                                                icons: {
                                                                                    previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                                                                                    next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
                                                                                }
                                                                            }
                                                                        };
                                                                    ew.createDateTimePicker("fpenerimaan_paket_keluargrid", "x<?= $Grid->RowIndex ?>_tanggal_terima", jQuery.extend(true, {
                                                                        "useCurrent": false
                                                                    }, options));
                                                                });
                                                            </script>
                                                        <?php } ?>
                                                    </span>
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_tanggal_terima" class="el_penerimaan_paket_keluar_tanggal_terima">
                                                        <span<?= $Grid->tanggal_terima->viewAttributes() ?>>
                                                            <?= $Grid->tanggal_terima->getViewValue() ?>
                                                    </span>
                                                    </span>
                                                    <?php if ($Grid->isConfirm()) { ?>
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_tanggal_terima" data-hidden="1" name="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_tanggal_terima" id="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_tanggal_terima" value="<?= HtmlEncode($Grid->tanggal_terima->FormValue) ?>">
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_tanggal_terima" data-hidden="1" name="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_tanggal_terima" id="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_tanggal_terima" value="<?= HtmlEncode($Grid->tanggal_terima->OldValue) ?>">
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Grid->jenis_pengirim->Visible) { // jenis_pengirim 
                                        ?>
                                            <td data-name="jenis_pengirim" <?= $Grid->jenis_pengirim->cellAttributes() ?>>
                                                <?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_jenis_pengirim" class="el_penerimaan_paket_keluar_jenis_pengirim">
                                                        <select id="x<?= $Grid->RowIndex ?>_jenis_pengirim" name="x<?= $Grid->RowIndex ?>_jenis_pengirim" class="form-select ew-select<?= $Grid->jenis_pengirim->isInvalidClass() ?>" data-select2-id="fpenerimaan_paket_keluargrid_x<?= $Grid->RowIndex ?>_jenis_pengirim" data-table="penerimaan_paket_keluar" data-field="x_jenis_pengirim" data-value-separator="<?= $Grid->jenis_pengirim->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Grid->jenis_pengirim->getPlaceHolder()) ?>" <?= $Grid->jenis_pengirim->editAttributes() ?>>
                                                            <?= $Grid->jenis_pengirim->selectOptionListHtml("x{$Grid->RowIndex}_jenis_pengirim") ?>
                                                        </select>
                                                        <div class="invalid-feedback"><?= $Grid->jenis_pengirim->getErrorMessage() ?></div>
                                                        <?= $Grid->jenis_pengirim->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_jenis_pengirim") ?>
                                                        <script>
                                                            loadjs.ready("fpenerimaan_paket_keluargrid", function() {
                                                                var options = {
                                                                        name: "x<?= $Grid->RowIndex ?>_jenis_pengirim",
                                                                        selectId: "fpenerimaan_paket_keluargrid_x<?= $Grid->RowIndex ?>_jenis_pengirim"
                                                                    },
                                                                    el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
                                                                options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
                                                                if (fpenerimaan_paket_keluargrid.lists.jenis_pengirim.lookupOptions.length) {
                                                                    options.data = {
                                                                        id: "x<?= $Grid->RowIndex ?>_jenis_pengirim",
                                                                        form: "fpenerimaan_paket_keluargrid"
                                                                    };
                                                                } else {
                                                                    options.ajax = {
                                                                        id: "x<?= $Grid->RowIndex ?>_jenis_pengirim",
                                                                        form: "fpenerimaan_paket_keluargrid",
                                                                        limit: ew.LOOKUP_PAGE_SIZE
                                                                    };
                                                                }
                                                                options.minimumResultsForSearch = Infinity;
                                                                options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.penerimaan_paket_keluar.fields.jenis_pengirim.selectOptions);
                                                                ew.createSelect(options);
                                                            });
                                                        </script>
                                                    </span>
                                                    <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_jenis_pengirim" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jenis_pengirim" id="o<?= $Grid->RowIndex ?>_jenis_pengirim" value="<?= HtmlEncode($Grid->jenis_pengirim->OldValue) ?>">
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_jenis_pengirim" class="el_penerimaan_paket_keluar_jenis_pengirim">
                                                        <select id="x<?= $Grid->RowIndex ?>_jenis_pengirim" name="x<?= $Grid->RowIndex ?>_jenis_pengirim" class="form-select ew-select<?= $Grid->jenis_pengirim->isInvalidClass() ?>" data-select2-id="fpenerimaan_paket_keluargrid_x<?= $Grid->RowIndex ?>_jenis_pengirim" data-table="penerimaan_paket_keluar" data-field="x_jenis_pengirim" data-value-separator="<?= $Grid->jenis_pengirim->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Grid->jenis_pengirim->getPlaceHolder()) ?>" <?= $Grid->jenis_pengirim->editAttributes() ?>>
                                                            <?= $Grid->jenis_pengirim->selectOptionListHtml("x{$Grid->RowIndex}_jenis_pengirim") ?>
                                                        </select>
                                                        <div class="invalid-feedback"><?= $Grid->jenis_pengirim->getErrorMessage() ?></div>
                                                        <?= $Grid->jenis_pengirim->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_jenis_pengirim") ?>
                                                        <script>
                                                            loadjs.ready("fpenerimaan_paket_keluargrid", function() {
                                                                var options = {
                                                                        name: "x<?= $Grid->RowIndex ?>_jenis_pengirim",
                                                                        selectId: "fpenerimaan_paket_keluargrid_x<?= $Grid->RowIndex ?>_jenis_pengirim"
                                                                    },
                                                                    el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
                                                                options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
                                                                if (fpenerimaan_paket_keluargrid.lists.jenis_pengirim.lookupOptions.length) {
                                                                    options.data = {
                                                                        id: "x<?= $Grid->RowIndex ?>_jenis_pengirim",
                                                                        form: "fpenerimaan_paket_keluargrid"
                                                                    };
                                                                } else {
                                                                    options.ajax = {
                                                                        id: "x<?= $Grid->RowIndex ?>_jenis_pengirim",
                                                                        form: "fpenerimaan_paket_keluargrid",
                                                                        limit: ew.LOOKUP_PAGE_SIZE
                                                                    };
                                                                }
                                                                options.minimumResultsForSearch = Infinity;
                                                                options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.penerimaan_paket_keluar.fields.jenis_pengirim.selectOptions);
                                                                ew.createSelect(options);
                                                            });
                                                        </script>
                                                    </span>
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_jenis_pengirim" class="el_penerimaan_paket_keluar_jenis_pengirim">
                                                        <span<?= $Grid->jenis_pengirim->viewAttributes() ?>>
                                                            <?= $Grid->jenis_pengirim->getViewValue() ?>
                                                    </span>
                                                    </span>
                                                    <?php if ($Grid->isConfirm()) { ?>
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_jenis_pengirim" data-hidden="1" name="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_jenis_pengirim" id="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_jenis_pengirim" value="<?= HtmlEncode($Grid->jenis_pengirim->FormValue) ?>">
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_jenis_pengirim" data-hidden="1" name="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_jenis_pengirim" id="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_jenis_pengirim" value="<?= HtmlEncode($Grid->jenis_pengirim->OldValue) ?>">
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Grid->nama_kurir->Visible) { // nama_kurir 
                                        ?>
                                            <td data-name="nama_kurir" <?= $Grid->nama_kurir->cellAttributes() ?>>
                                                <?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_nama_kurir" class="el_penerimaan_paket_keluar_nama_kurir">
                                                        <select id="x<?= $Grid->RowIndex ?>_nama_kurir" name="x<?= $Grid->RowIndex ?>_nama_kurir" class="form-select ew-select<?= $Grid->nama_kurir->isInvalidClass() ?>" data-select2-id="fpenerimaan_paket_keluargrid_x<?= $Grid->RowIndex ?>_nama_kurir" data-table="penerimaan_paket_keluar" data-field="x_nama_kurir" data-value-separator="<?= $Grid->nama_kurir->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Grid->nama_kurir->getPlaceHolder()) ?>" <?= $Grid->nama_kurir->editAttributes() ?>>
                                                            <?= $Grid->nama_kurir->selectOptionListHtml("x{$Grid->RowIndex}_nama_kurir") ?>
                                                        </select>
                                                        <div class="invalid-feedback"><?= $Grid->nama_kurir->getErrorMessage() ?></div>
                                                        <script>
                                                            loadjs.ready("fpenerimaan_paket_keluargrid", function() {
                                                                var options = {
                                                                        name: "x<?= $Grid->RowIndex ?>_nama_kurir",
                                                                        selectId: "fpenerimaan_paket_keluargrid_x<?= $Grid->RowIndex ?>_nama_kurir"
                                                                    },
                                                                    el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
                                                                options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
                                                                if (fpenerimaan_paket_keluargrid.lists.nama_kurir.lookupOptions.length) {
                                                                    options.data = {
                                                                        id: "x<?= $Grid->RowIndex ?>_nama_kurir",
                                                                        form: "fpenerimaan_paket_keluargrid"
                                                                    };
                                                                } else {
                                                                    options.ajax = {
                                                                        id: "x<?= $Grid->RowIndex ?>_nama_kurir",
                                                                        form: "fpenerimaan_paket_keluargrid",
                                                                        limit: ew.LOOKUP_PAGE_SIZE
                                                                    };
                                                                }
                                                                options.minimumResultsForSearch = Infinity;
                                                                options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.penerimaan_paket_keluar.fields.nama_kurir.selectOptions);
                                                                ew.createSelect(options);
                                                            });
                                                        </script>
                                                    </span>
                                                    <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_nama_kurir" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nama_kurir" id="o<?= $Grid->RowIndex ?>_nama_kurir" value="<?= HtmlEncode($Grid->nama_kurir->OldValue) ?>">
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_nama_kurir" class="el_penerimaan_paket_keluar_nama_kurir">
                                                        <select id="x<?= $Grid->RowIndex ?>_nama_kurir" name="x<?= $Grid->RowIndex ?>_nama_kurir" class="form-select ew-select<?= $Grid->nama_kurir->isInvalidClass() ?>" data-select2-id="fpenerimaan_paket_keluargrid_x<?= $Grid->RowIndex ?>_nama_kurir" data-table="penerimaan_paket_keluar" data-field="x_nama_kurir" data-value-separator="<?= $Grid->nama_kurir->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Grid->nama_kurir->getPlaceHolder()) ?>" <?= $Grid->nama_kurir->editAttributes() ?>>
                                                            <?= $Grid->nama_kurir->selectOptionListHtml("x{$Grid->RowIndex}_nama_kurir") ?>
                                                        </select>
                                                        <div class="invalid-feedback"><?= $Grid->nama_kurir->getErrorMessage() ?></div>
                                                        <script>
                                                            loadjs.ready("fpenerimaan_paket_keluargrid", function() {
                                                                var options = {
                                                                        name: "x<?= $Grid->RowIndex ?>_nama_kurir",
                                                                        selectId: "fpenerimaan_paket_keluargrid_x<?= $Grid->RowIndex ?>_nama_kurir"
                                                                    },
                                                                    el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
                                                                options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
                                                                if (fpenerimaan_paket_keluargrid.lists.nama_kurir.lookupOptions.length) {
                                                                    options.data = {
                                                                        id: "x<?= $Grid->RowIndex ?>_nama_kurir",
                                                                        form: "fpenerimaan_paket_keluargrid"
                                                                    };
                                                                } else {
                                                                    options.ajax = {
                                                                        id: "x<?= $Grid->RowIndex ?>_nama_kurir",
                                                                        form: "fpenerimaan_paket_keluargrid",
                                                                        limit: ew.LOOKUP_PAGE_SIZE
                                                                    };
                                                                }
                                                                options.minimumResultsForSearch = Infinity;
                                                                options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.penerimaan_paket_keluar.fields.nama_kurir.selectOptions);
                                                                ew.createSelect(options);
                                                            });
                                                        </script>
                                                    </span>
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_nama_kurir" class="el_penerimaan_paket_keluar_nama_kurir">
                                                        <span<?= $Grid->nama_kurir->viewAttributes() ?>>
                                                            <?= $Grid->nama_kurir->getViewValue() ?>
                                                    </span>
                                                    </span>
                                                    <?php if ($Grid->isConfirm()) { ?>
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_nama_kurir" data-hidden="1" name="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_nama_kurir" id="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_nama_kurir" value="<?= HtmlEncode($Grid->nama_kurir->FormValue) ?>">
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_nama_kurir" data-hidden="1" name="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_nama_kurir" id="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_nama_kurir" value="<?= HtmlEncode($Grid->nama_kurir->OldValue) ?>">
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Grid->no_awb->Visible) { // no_awb 
                                        ?>
                                            <td data-name="no_awb" <?= $Grid->no_awb->cellAttributes() ?>>
                                                <?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_no_awb" class="el_penerimaan_paket_keluar_no_awb">
                                                        <input type="<?= $Grid->no_awb->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_no_awb" id="x<?= $Grid->RowIndex ?>_no_awb" data-table="penerimaan_paket_keluar" data-field="x_no_awb" value="<?= $Grid->no_awb->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->no_awb->getPlaceHolder()) ?>" <?= $Grid->no_awb->editAttributes() ?>>
                                                        <div class="invalid-feedback"><?= $Grid->no_awb->getErrorMessage() ?></div>
                                                    </span>
                                                    <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_no_awb" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_awb" id="o<?= $Grid->RowIndex ?>_no_awb" value="<?= HtmlEncode($Grid->no_awb->OldValue) ?>">
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_no_awb" class="el_penerimaan_paket_keluar_no_awb">
                                                        <input type="<?= $Grid->no_awb->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_no_awb" id="x<?= $Grid->RowIndex ?>_no_awb" data-table="penerimaan_paket_keluar" data-field="x_no_awb" value="<?= $Grid->no_awb->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->no_awb->getPlaceHolder()) ?>" <?= $Grid->no_awb->editAttributes() ?>>
                                                        <div class="invalid-feedback"><?= $Grid->no_awb->getErrorMessage() ?></div>
                                                    </span>
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_no_awb" class="el_penerimaan_paket_keluar_no_awb">
                                                        <span<?= $Grid->no_awb->viewAttributes() ?>>
                                                            <?= $Grid->no_awb->getViewValue() ?>
                                                    </span>
                                                    </span>
                                                    <?php if ($Grid->isConfirm()) { ?>
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_no_awb" data-hidden="1" name="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_no_awb" id="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_no_awb" value="<?= HtmlEncode($Grid->no_awb->FormValue) ?>">
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_no_awb" data-hidden="1" name="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_no_awb" id="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_no_awb" value="<?= HtmlEncode($Grid->no_awb->OldValue) ?>">
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Grid->id_user->Visible) { // id_user 
                                        ?>
                                            <td data-name="id_user" <?= $Grid->id_user->cellAttributes() ?>>
                                                <?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record 
                                                ?>
                                                    <?php if ($Grid->id_user->getSessionValue() != "") { ?>
                                                        <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_id_user" class="el_penerimaan_paket_keluar_id_user">
                                                            <span<?= $Grid->id_user->viewAttributes() ?>>
                                                                <input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id_user->getDisplayValue($Grid->id_user->ViewValue))) ?>">
                                                        </span>
                                                        </span>
                                                        <input type="hidden" id="x<?= $Grid->RowIndex ?>_id_user" name="x<?= $Grid->RowIndex ?>_id_user" value="<?= HtmlEncode(FormatNumber($Grid->id_user->CurrentValue, $Grid->id_user->formatPattern())) ?>" data-hidden="1">
                                                    <?php } else { ?>
                                                        <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_id_user" class="el_penerimaan_paket_keluar_id_user">
                                                            <input type="<?= $Grid->id_user->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_id_user" id="x<?= $Grid->RowIndex ?>_id_user" data-table="penerimaan_paket_keluar" data-field="x_id_user" value="<?= $Grid->id_user->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->id_user->getPlaceHolder()) ?>" <?= $Grid->id_user->editAttributes() ?>>
                                                            <div class="invalid-feedback"><?= $Grid->id_user->getErrorMessage() ?></div>
                                                        </span>
                                                    <?php } ?>
                                                    <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_id_user" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id_user" id="o<?= $Grid->RowIndex ?>_id_user" value="<?= HtmlEncode($Grid->id_user->OldValue) ?>">
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record 
                                                ?>
                                                    <?php if ($Grid->id_user->getSessionValue() != "") { ?>
                                                        <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_id_user" class="el_penerimaan_paket_keluar_id_user">
                                                            <span<?= $Grid->id_user->viewAttributes() ?>>
                                                                <input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id_user->getDisplayValue($Grid->id_user->ViewValue))) ?>">
                                                        </span>
                                                        </span>
                                                        <input type="hidden" id="x<?= $Grid->RowIndex ?>_id_user" name="x<?= $Grid->RowIndex ?>_id_user" value="<?= HtmlEncode(FormatNumber($Grid->id_user->CurrentValue, $Grid->id_user->formatPattern())) ?>" data-hidden="1">
                                                    <?php } else { ?>
                                                        <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_id_user" class="el_penerimaan_paket_keluar_id_user">
                                                            <input type="<?= $Grid->id_user->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_id_user" id="x<?= $Grid->RowIndex ?>_id_user" data-table="penerimaan_paket_keluar" data-field="x_id_user" value="<?= $Grid->id_user->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->id_user->getPlaceHolder()) ?>" <?= $Grid->id_user->editAttributes() ?>>
                                                            <div class="invalid-feedback"><?= $Grid->id_user->getErrorMessage() ?></div>
                                                        </span>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_id_user" class="el_penerimaan_paket_keluar_id_user">
                                                        <span<?= $Grid->id_user->viewAttributes() ?>>
                                                            <?= $Grid->id_user->getViewValue() ?>
                                                    </span>
                                                    </span>
                                                    <?php if ($Grid->isConfirm()) { ?>
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_id_user" data-hidden="1" name="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_id_user" id="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_id_user" value="<?= HtmlEncode($Grid->id_user->FormValue) ?>">
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_id_user" data-hidden="1" name="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_id_user" id="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_id_user" value="<?= HtmlEncode($Grid->id_user->OldValue) ?>">
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Grid->bukti_penerimaan->Visible) { // bukti_penerimaan 
                                        ?>
                                            <td data-name="bukti_penerimaan" <?= $Grid->bukti_penerimaan->cellAttributes() ?>>
                                                <?php if ($Grid->RowAction == "insert") { // Add record 
                                                ?>
                                                    <?php if (!$Grid->isConfirm()) { ?>
                                                        <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_bukti_penerimaan" class="el_penerimaan_paket_keluar_bukti_penerimaan">
                                                            <div id="fd_x<?= $Grid->RowIndex ?>_bukti_penerimaan" class="fileinput-button ew-file-drop-zone">
                                                                <input type="file" class="form-control ew-file-input" title="<?= $Grid->bukti_penerimaan->title() ?>" data-table="penerimaan_paket_keluar" data-field="x_bukti_penerimaan" name="x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="x<?= $Grid->RowIndex ?>_bukti_penerimaan" lang="<?= CurrentLanguageID() ?>" <?= $Grid->bukti_penerimaan->editAttributes() ?><?= ($Grid->bukti_penerimaan->ReadOnly || $Grid->bukti_penerimaan->Disabled) ? " disabled" : "" ?>>
                                                                <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
                                                            </div>
                                                            <div class="invalid-feedback"><?= $Grid->bukti_penerimaan->getErrorMessage() ?></div>
                                                            <input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fn_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="<?= $Grid->bukti_penerimaan->Upload->FileName ?>">
                                                            <input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fa_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="0">
                                                            <input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fs_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="255">
                                                            <input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fx_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="<?= $Grid->bukti_penerimaan->UploadAllowedFileExt ?>">
                                                            <input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fm_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="<?= $Grid->bukti_penerimaan->UploadMaxFileSize ?>">
                                                            <table id="ft_x<?= $Grid->RowIndex ?>_bukti_penerimaan" class="table table-sm float-start ew-upload-table">
                                                                <tbody class="files"></tbody>
                                                            </table>
                                                        </span>
                                                    <?php } else { ?>
                                                        <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_bukti_penerimaan" class="el_penerimaan_paket_keluar_bukti_penerimaan">
                                                            <div id="fd_x<?= $Grid->RowIndex ?>_bukti_penerimaan">
                                                                <input type="file" class="form-control ew-file-input d-none" title="<?= $Grid->bukti_penerimaan->title() ?>" data-table="penerimaan_paket_keluar" data-field="x_bukti_penerimaan" name="x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="x<?= $Grid->RowIndex ?>_bukti_penerimaan" lang="<?= CurrentLanguageID() ?>" <?= $Grid->bukti_penerimaan->editAttributes() ?>>
                                                            </div>
                                                            <div class="invalid-feedback"><?= $Grid->bukti_penerimaan->getErrorMessage() ?></div>
                                                            <input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fn_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="<?= $Grid->bukti_penerimaan->Upload->FileName ?>">
                                                            <input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fa_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="0">
                                                            <input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fs_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="255">
                                                            <input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fx_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="<?= $Grid->bukti_penerimaan->UploadAllowedFileExt ?>">
                                                            <input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fm_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="<?= $Grid->bukti_penerimaan->UploadMaxFileSize ?>">
                                                            <table id="ft_x<?= $Grid->RowIndex ?>_bukti_penerimaan" class="table table-sm float-start ew-upload-table">
                                                                <tbody class="files"></tbody>
                                                            </table>
                                                        </span>
                                                    <?php } ?>
                                                    <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_bukti_penerimaan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_bukti_penerimaan" id="o<?= $Grid->RowIndex ?>_bukti_penerimaan" value="<?= HtmlEncode($Grid->bukti_penerimaan->OldValue) ?>">
                                                <?php } elseif ($Grid->RowType == ROWTYPE_VIEW) { // View record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_bukti_penerimaan" class="el_penerimaan_paket_keluar_bukti_penerimaan">
                                                        <span>
                                                            <?= GetFileViewTag($Grid->bukti_penerimaan, $Grid->bukti_penerimaan->getViewValue(), false) ?>
                                                        </span>
                                                    </span>
                                                <?php } else { // Edit record 
                                                ?>
                                                    <?php if (!$Grid->isConfirm()) { ?>
                                                        <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_bukti_penerimaan" class="el_penerimaan_paket_keluar_bukti_penerimaan">
                                                            <div id="fd_x<?= $Grid->RowIndex ?>_bukti_penerimaan">
                                                                <input type="file" class="form-control ew-file-input d-none" title="<?= $Grid->bukti_penerimaan->title() ?>" data-table="penerimaan_paket_keluar" data-field="x_bukti_penerimaan" name="x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="x<?= $Grid->RowIndex ?>_bukti_penerimaan" lang="<?= CurrentLanguageID() ?>" <?= $Grid->bukti_penerimaan->editAttributes() ?>>
                                                            </div>
                                                            <div class="invalid-feedback"><?= $Grid->bukti_penerimaan->getErrorMessage() ?></div>
                                                            <input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fn_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="<?= $Grid->bukti_penerimaan->Upload->FileName ?>">
                                                            <input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fa_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="<?= (Post("fa_x<?= $Grid->RowIndex ?>_bukti_penerimaan") == "0") ? "0" : "1" ?>">
                                                            <input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fs_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="255">
                                                            <input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fx_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="<?= $Grid->bukti_penerimaan->UploadAllowedFileExt ?>">
                                                            <input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fm_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="<?= $Grid->bukti_penerimaan->UploadMaxFileSize ?>">
                                                            <table id="ft_x<?= $Grid->RowIndex ?>_bukti_penerimaan" class="table table-sm float-start ew-upload-table">
                                                                <tbody class="files"></tbody>
                                                            </table>
                                                        </span>
                                                    <?php } else { ?>
                                                        <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_bukti_penerimaan" class="el_penerimaan_paket_keluar_bukti_penerimaan">
                                                            <div id="fd_x<?= $Grid->RowIndex ?>_bukti_penerimaan">
                                                                <input type="file" class="form-control ew-file-input d-none" title="<?= $Grid->bukti_penerimaan->title() ?>" data-table="penerimaan_paket_keluar" data-field="x_bukti_penerimaan" name="x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="x<?= $Grid->RowIndex ?>_bukti_penerimaan" lang="<?= CurrentLanguageID() ?>" <?= $Grid->bukti_penerimaan->editAttributes() ?>>
                                                            </div>
                                                            <div class="invalid-feedback"><?= $Grid->bukti_penerimaan->getErrorMessage() ?></div>
                                                            <input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fn_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="<?= $Grid->bukti_penerimaan->Upload->FileName ?>">
                                                            <input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fa_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="<?= (Post("fa_x<?= $Grid->RowIndex ?>_bukti_penerimaan") == "0") ? "0" : "1" ?>">
                                                            <input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fs_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="255">
                                                            <input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fx_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="<?= $Grid->bukti_penerimaan->UploadAllowedFileExt ?>">
                                                            <input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fm_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="<?= $Grid->bukti_penerimaan->UploadMaxFileSize ?>">
                                                            <table id="ft_x<?= $Grid->RowIndex ?>_bukti_penerimaan" class="table table-sm float-start ew-upload-table">
                                                                <tbody class="files"></tbody>
                                                            </table>
                                                        </span>
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Grid->nama_penerima->Visible) { // nama_penerima 
                                        ?>
                                            <td data-name="nama_penerima" <?= $Grid->nama_penerima->cellAttributes() ?>>
                                                <?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_nama_penerima" class="el_penerimaan_paket_keluar_nama_penerima">
                                                        <input type="<?= $Grid->nama_penerima->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_nama_penerima" id="x<?= $Grid->RowIndex ?>_nama_penerima" data-table="penerimaan_paket_keluar" data-field="x_nama_penerima" value="<?= $Grid->nama_penerima->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->nama_penerima->getPlaceHolder()) ?>" <?= $Grid->nama_penerima->editAttributes() ?>>
                                                        <div class="invalid-feedback"><?= $Grid->nama_penerima->getErrorMessage() ?></div>
                                                    </span>
                                                    <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_nama_penerima" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nama_penerima" id="o<?= $Grid->RowIndex ?>_nama_penerima" value="<?= HtmlEncode($Grid->nama_penerima->OldValue) ?>">
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_nama_penerima" class="el_penerimaan_paket_keluar_nama_penerima">
                                                        <input type="<?= $Grid->nama_penerima->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_nama_penerima" id="x<?= $Grid->RowIndex ?>_nama_penerima" data-table="penerimaan_paket_keluar" data-field="x_nama_penerima" value="<?= $Grid->nama_penerima->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->nama_penerima->getPlaceHolder()) ?>" <?= $Grid->nama_penerima->editAttributes() ?>>
                                                        <div class="invalid-feedback"><?= $Grid->nama_penerima->getErrorMessage() ?></div>
                                                    </span>
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_nama_penerima" class="el_penerimaan_paket_keluar_nama_penerima">
                                                        <span<?= $Grid->nama_penerima->viewAttributes() ?>>
                                                            <?= $Grid->nama_penerima->getViewValue() ?>
                                                    </span>
                                                    </span>
                                                    <?php if ($Grid->isConfirm()) { ?>
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_nama_penerima" data-hidden="1" name="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_nama_penerima" id="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_nama_penerima" value="<?= HtmlEncode($Grid->nama_penerima->FormValue) ?>">
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_nama_penerima" data-hidden="1" name="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_nama_penerima" id="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_nama_penerima" value="<?= HtmlEncode($Grid->nama_penerima->OldValue) ?>">
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                        <?php } ?>
                                        <?php if ($Grid->status_sap->Visible) { // status_sap 
                                        ?>
                                            <td data-name="status_sap" <?= $Grid->status_sap->cellAttributes() ?>>
                                                <?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_status_sap" class="el_penerimaan_paket_keluar_status_sap">
                                                        <input type="<?= $Grid->status_sap->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_status_sap" id="x<?= $Grid->RowIndex ?>_status_sap" data-table="penerimaan_paket_keluar" data-field="x_status_sap" value="<?= $Grid->status_sap->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->status_sap->getPlaceHolder()) ?>" <?= $Grid->status_sap->editAttributes() ?>>
                                                        <div class="invalid-feedback"><?= $Grid->status_sap->getErrorMessage() ?></div>
                                                    </span>
                                                    <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_status_sap" data-hidden="1" name="o<?= $Grid->RowIndex ?>_status_sap" id="o<?= $Grid->RowIndex ?>_status_sap" value="<?= HtmlEncode($Grid->status_sap->OldValue) ?>">
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_status_sap" class="el_penerimaan_paket_keluar_status_sap">
                                                        <input type="<?= $Grid->status_sap->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_status_sap" id="x<?= $Grid->RowIndex ?>_status_sap" data-table="penerimaan_paket_keluar" data-field="x_status_sap" value="<?= $Grid->status_sap->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->status_sap->getPlaceHolder()) ?>" <?= $Grid->status_sap->editAttributes() ?>>
                                                        <div class="invalid-feedback"><?= $Grid->status_sap->getErrorMessage() ?></div>
                                                    </span>
                                                <?php } ?>
                                                <?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record 
                                                ?>
                                                    <span id="el<?= $Grid->RowCount ?>_penerimaan_paket_keluar_status_sap" class="el_penerimaan_paket_keluar_status_sap">
                                                        <span<?= $Grid->status_sap->viewAttributes() ?>>
                                                            <?= $Grid->status_sap->getViewValue() ?>
                                                    </span>
                                                    </span>
                                                    <?php if ($Grid->isConfirm()) { ?>
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_status_sap" data-hidden="1" name="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_status_sap" id="fpenerimaan_paket_keluargrid$x<?= $Grid->RowIndex ?>_status_sap" value="<?= HtmlEncode($Grid->status_sap->FormValue) ?>">
                                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_status_sap" data-hidden="1" name="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_status_sap" id="fpenerimaan_paket_keluargrid$o<?= $Grid->RowIndex ?>_status_sap" value="<?= HtmlEncode($Grid->status_sap->OldValue) ?>">
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                        <?php } ?>
                                        <?php
                                        // Render list options (body, right)
                                        $Grid->ListOptions->render("body", "right", $Grid->RowCount);
                                        ?>
                                    </tr>
                                    <?php if ($Grid->RowType == ROWTYPE_ADD || $Grid->RowType == ROWTYPE_EDIT) { ?>
                                        <script>
                                            loadjs.ready(["fpenerimaan_paket_keluargrid", "load"], () => fpenerimaan_paket_keluargrid.updateLists(<?= $Grid->RowIndex ?>));
                                        </script>
                                    <?php } ?>
                        <?php
                                }
                            } // End delete row checking
                            if (!$Grid->isGridAdd() || $Grid->CurrentMode == "copy")
                                if (!$Grid->Recordset->EOF) {
                                    $Grid->Recordset->moveNext();
                                }
                        }
                        ?>
                        <?php
                        if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy" || $Grid->CurrentMode == "edit") {
                            $Grid->RowIndex = '$rowindex$';
                            $Grid->loadRowValues();

                            // Set row properties
                            $Grid->resetAttributes();
                            $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_penerimaan_paket_keluar", "data-rowtype" => ROWTYPE_ADD]);
                            $Grid->RowAttrs->appendClass("ew-template");

                            // Reset previous form error if any
                            $Grid->resetFormError();

                            // Render row
                            $Grid->RowType = ROWTYPE_ADD;
                            $Grid->renderRow();

                            // Render list options
                            $Grid->renderListOptions();
                            $Grid->StartRowCount = 0;
                        ?>
                            <tr <?= $Grid->rowAttributes() ?>>
                                <?php
                                // Render list options (body, left)
                                $Grid->ListOptions->render("body", "left", $Grid->RowIndex);
                                ?>
                                <?php if ($Grid->id->Visible) { // id 
                                ?>
                                    <td data-name="id">
                                        <?php if (!$Grid->isConfirm()) { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_id" class="el_penerimaan_paket_keluar_id"></span>
                                        <?php } else { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_id" class="el_penerimaan_paket_keluar_id">
                                                <span<?= $Grid->id->viewAttributes() ?>>
                                                    <input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->ViewValue))) ?>">
                                            </span>
                                            </span>
                                            <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
                                        <?php } ?>
                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
                                    </td>
                                <?php } ?>
                                <?php if ($Grid->no_dokumen->Visible) { // no_dokumen 
                                ?>
                                    <td data-name="no_dokumen">
                                        <?php if (!$Grid->isConfirm()) { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_no_dokumen" class="el_penerimaan_paket_keluar_no_dokumen">
                                                <input type="<?= $Grid->no_dokumen->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_no_dokumen" id="x<?= $Grid->RowIndex ?>_no_dokumen" data-table="penerimaan_paket_keluar" data-field="x_no_dokumen" value="<?= $Grid->no_dokumen->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->no_dokumen->getPlaceHolder()) ?>" <?= $Grid->no_dokumen->editAttributes() ?>>
                                                <div class="invalid-feedback"><?= $Grid->no_dokumen->getErrorMessage() ?></div>
                                            </span>
                                        <?php } else { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_no_dokumen" class="el_penerimaan_paket_keluar_no_dokumen">
                                                <span<?= $Grid->no_dokumen->viewAttributes() ?>>
                                                    <input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_dokumen->getDisplayValue($Grid->no_dokumen->ViewValue))) ?>">
                                            </span>
                                            </span>
                                            <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_no_dokumen" data-hidden="1" name="x<?= $Grid->RowIndex ?>_no_dokumen" id="x<?= $Grid->RowIndex ?>_no_dokumen" value="<?= HtmlEncode($Grid->no_dokumen->FormValue) ?>">
                                        <?php } ?>
                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_no_dokumen" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_dokumen" id="o<?= $Grid->RowIndex ?>_no_dokumen" value="<?= HtmlEncode($Grid->no_dokumen->OldValue) ?>">
                                    </td>
                                <?php } ?>
                                <?php if ($Grid->no_paket->Visible) { // no_paket 
                                ?>
                                    <td data-name="no_paket">
                                        <?php if (!$Grid->isConfirm()) { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_no_paket" class="el_penerimaan_paket_keluar_no_paket">
                                                <input type="<?= $Grid->no_paket->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_no_paket" id="x<?= $Grid->RowIndex ?>_no_paket" data-table="penerimaan_paket_keluar" data-field="x_no_paket" value="<?= $Grid->no_paket->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->no_paket->getPlaceHolder()) ?>" <?= $Grid->no_paket->editAttributes() ?>>
                                                <div class="invalid-feedback"><?= $Grid->no_paket->getErrorMessage() ?></div>
                                            </span>
                                        <?php } else { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_no_paket" class="el_penerimaan_paket_keluar_no_paket">
                                                <span<?= $Grid->no_paket->viewAttributes() ?>>
                                                    <input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_paket->getDisplayValue($Grid->no_paket->ViewValue))) ?>">
                                            </span>
                                            </span>
                                            <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_no_paket" data-hidden="1" name="x<?= $Grid->RowIndex ?>_no_paket" id="x<?= $Grid->RowIndex ?>_no_paket" value="<?= HtmlEncode($Grid->no_paket->FormValue) ?>">
                                        <?php } ?>
                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_no_paket" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_paket" id="o<?= $Grid->RowIndex ?>_no_paket" value="<?= HtmlEncode($Grid->no_paket->OldValue) ?>">
                                    </td>
                                <?php } ?>
                                <?php if ($Grid->jenis_dokumen->Visible) { // jenis_dokumen 
                                ?>
                                    <td data-name="jenis_dokumen">
                                        <?php if (!$Grid->isConfirm()) { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_jenis_dokumen" class="el_penerimaan_paket_keluar_jenis_dokumen">
                                                <select id="x<?= $Grid->RowIndex ?>_jenis_dokumen" name="x<?= $Grid->RowIndex ?>_jenis_dokumen" class="form-select ew-select<?= $Grid->jenis_dokumen->isInvalidClass() ?>" data-select2-id="fpenerimaan_paket_keluargrid_x<?= $Grid->RowIndex ?>_jenis_dokumen" data-table="penerimaan_paket_keluar" data-field="x_jenis_dokumen" data-value-separator="<?= $Grid->jenis_dokumen->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Grid->jenis_dokumen->getPlaceHolder()) ?>" <?= $Grid->jenis_dokumen->editAttributes() ?>>
                                                    <?= $Grid->jenis_dokumen->selectOptionListHtml("x{$Grid->RowIndex}_jenis_dokumen") ?>
                                                </select>
                                                <div class="invalid-feedback"><?= $Grid->jenis_dokumen->getErrorMessage() ?></div>
                                                <?= $Grid->jenis_dokumen->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_jenis_dokumen") ?>
                                                <script>
                                                    loadjs.ready("fpenerimaan_paket_keluargrid", function() {
                                                        var options = {
                                                                name: "x<?= $Grid->RowIndex ?>_jenis_dokumen",
                                                                selectId: "fpenerimaan_paket_keluargrid_x<?= $Grid->RowIndex ?>_jenis_dokumen"
                                                            },
                                                            el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
                                                        options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
                                                        if (fpenerimaan_paket_keluargrid.lists.jenis_dokumen.lookupOptions.length) {
                                                            options.data = {
                                                                id: "x<?= $Grid->RowIndex ?>_jenis_dokumen",
                                                                form: "fpenerimaan_paket_keluargrid"
                                                            };
                                                        } else {
                                                            options.ajax = {
                                                                id: "x<?= $Grid->RowIndex ?>_jenis_dokumen",
                                                                form: "fpenerimaan_paket_keluargrid",
                                                                limit: ew.LOOKUP_PAGE_SIZE
                                                            };
                                                        }
                                                        options.minimumResultsForSearch = Infinity;
                                                        options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.penerimaan_paket_keluar.fields.jenis_dokumen.selectOptions);
                                                        ew.createSelect(options);
                                                    });
                                                </script>
                                            </span>
                                        <?php } else { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_jenis_dokumen" class="el_penerimaan_paket_keluar_jenis_dokumen">
                                                <span<?= $Grid->jenis_dokumen->viewAttributes() ?>>
                                                    <span class="form-control-plaintext"><?= $Grid->jenis_dokumen->getDisplayValue($Grid->jenis_dokumen->ViewValue) ?></span>
                                            </span>
                                            </span>
                                            <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_jenis_dokumen" data-hidden="1" name="x<?= $Grid->RowIndex ?>_jenis_dokumen" id="x<?= $Grid->RowIndex ?>_jenis_dokumen" value="<?= HtmlEncode($Grid->jenis_dokumen->FormValue) ?>">
                                        <?php } ?>
                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_jenis_dokumen" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jenis_dokumen" id="o<?= $Grid->RowIndex ?>_jenis_dokumen" value="<?= HtmlEncode($Grid->jenis_dokumen->OldValue) ?>">
                                    </td>
                                <?php } ?>
                                <?php if ($Grid->tujuan_penerima->Visible) { // tujuan_penerima 
                                ?>
                                    <td data-name="tujuan_penerima">
                                        <?php if (!$Grid->isConfirm()) { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_tujuan_penerima" class="el_penerimaan_paket_keluar_tujuan_penerima">
                                                <textarea data-table="penerimaan_paket_keluar" data-field="x_tujuan_penerima" name="x<?= $Grid->RowIndex ?>_tujuan_penerima" id="x<?= $Grid->RowIndex ?>_tujuan_penerima" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->tujuan_penerima->getPlaceHolder()) ?>" <?= $Grid->tujuan_penerima->editAttributes() ?>><?= $Grid->tujuan_penerima->EditValue ?></textarea>
                                                <div class="invalid-feedback"><?= $Grid->tujuan_penerima->getErrorMessage() ?></div>
                                            </span>
                                        <?php } else { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_tujuan_penerima" class="el_penerimaan_paket_keluar_tujuan_penerima">
                                                <span<?= $Grid->tujuan_penerima->viewAttributes() ?>>
                                                    <?= $Grid->tujuan_penerima->ViewValue ?>
                                            </span>
                                            </span>
                                            <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_tujuan_penerima" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tujuan_penerima" id="x<?= $Grid->RowIndex ?>_tujuan_penerima" value="<?= HtmlEncode($Grid->tujuan_penerima->FormValue) ?>">
                                        <?php } ?>
                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_tujuan_penerima" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tujuan_penerima" id="o<?= $Grid->RowIndex ?>_tujuan_penerima" value="<?= HtmlEncode($Grid->tujuan_penerima->OldValue) ?>">
                                    </td>
                                <?php } ?>
                                <?php if ($Grid->no_hp_penerima->Visible) { // no_hp_penerima 
                                ?>
                                    <td data-name="no_hp_penerima">
                                        <?php if (!$Grid->isConfirm()) { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_no_hp_penerima" class="el_penerimaan_paket_keluar_no_hp_penerima">
                                                <input type="<?= $Grid->no_hp_penerima->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_no_hp_penerima" id="x<?= $Grid->RowIndex ?>_no_hp_penerima" data-table="penerimaan_paket_keluar" data-field="x_no_hp_penerima" value="<?= $Grid->no_hp_penerima->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Grid->no_hp_penerima->getPlaceHolder()) ?>" <?= $Grid->no_hp_penerima->editAttributes() ?>>
                                                <div class="invalid-feedback"><?= $Grid->no_hp_penerima->getErrorMessage() ?></div>
                                            </span>
                                        <?php } else { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_no_hp_penerima" class="el_penerimaan_paket_keluar_no_hp_penerima">
                                                <span<?= $Grid->no_hp_penerima->viewAttributes() ?>>
                                                    <input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_hp_penerima->getDisplayValue($Grid->no_hp_penerima->ViewValue))) ?>">
                                            </span>
                                            </span>
                                            <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_no_hp_penerima" data-hidden="1" name="x<?= $Grid->RowIndex ?>_no_hp_penerima" id="x<?= $Grid->RowIndex ?>_no_hp_penerima" value="<?= HtmlEncode($Grid->no_hp_penerima->FormValue) ?>">
                                        <?php } ?>
                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_no_hp_penerima" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_hp_penerima" id="o<?= $Grid->RowIndex ?>_no_hp_penerima" value="<?= HtmlEncode($Grid->no_hp_penerima->OldValue) ?>">
                                    </td>
                                <?php } ?>
                                <?php if ($Grid->email_penerima->Visible) { // email_penerima 
                                ?>
                                    <td data-name="email_penerima">
                                        <?php if (!$Grid->isConfirm()) { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_email_penerima" class="el_penerimaan_paket_keluar_email_penerima">
                                                <input type="<?= $Grid->email_penerima->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_email_penerima" id="x<?= $Grid->RowIndex ?>_email_penerima" data-table="penerimaan_paket_keluar" data-field="x_email_penerima" value="<?= $Grid->email_penerima->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->email_penerima->getPlaceHolder()) ?>" <?= $Grid->email_penerima->editAttributes() ?>>
                                                <div class="invalid-feedback"><?= $Grid->email_penerima->getErrorMessage() ?></div>
                                            </span>
                                        <?php } else { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_email_penerima" class="el_penerimaan_paket_keluar_email_penerima">
                                                <span<?= $Grid->email_penerima->viewAttributes() ?>>
                                                    <input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->email_penerima->getDisplayValue($Grid->email_penerima->ViewValue))) ?>">
                                            </span>
                                            </span>
                                            <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_email_penerima" data-hidden="1" name="x<?= $Grid->RowIndex ?>_email_penerima" id="x<?= $Grid->RowIndex ?>_email_penerima" value="<?= HtmlEncode($Grid->email_penerima->FormValue) ?>">
                                        <?php } ?>
                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_email_penerima" data-hidden="1" name="o<?= $Grid->RowIndex ?>_email_penerima" id="o<?= $Grid->RowIndex ?>_email_penerima" value="<?= HtmlEncode($Grid->email_penerima->OldValue) ?>">
                                    </td>
                                <?php } ?>
                                <?php if ($Grid->status->Visible) { // status 
                                ?>
                                    <td data-name="status">
                                        <?php if (!$Grid->isConfirm()) { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_status" class="el_penerimaan_paket_keluar_status">
                                                <select id="x<?= $Grid->RowIndex ?>_status" name="x<?= $Grid->RowIndex ?>_status" class="form-select ew-select<?= $Grid->status->isInvalidClass() ?>" data-select2-id="fpenerimaan_paket_keluargrid_x<?= $Grid->RowIndex ?>_status" data-table="penerimaan_paket_keluar" data-field="x_status" data-value-separator="<?= $Grid->status->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Grid->status->getPlaceHolder()) ?>" <?= $Grid->status->editAttributes() ?>>
                                                    <?= $Grid->status->selectOptionListHtml("x{$Grid->RowIndex}_status") ?>
                                                </select>
                                                <div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
                                                <?= $Grid->status->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_status") ?>
                                                <script>
                                                    loadjs.ready("fpenerimaan_paket_keluargrid", function() {
                                                        var options = {
                                                                name: "x<?= $Grid->RowIndex ?>_status",
                                                                selectId: "fpenerimaan_paket_keluargrid_x<?= $Grid->RowIndex ?>_status"
                                                            },
                                                            el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
                                                        options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
                                                        if (fpenerimaan_paket_keluargrid.lists.status.lookupOptions.length) {
                                                            options.data = {
                                                                id: "x<?= $Grid->RowIndex ?>_status",
                                                                form: "fpenerimaan_paket_keluargrid"
                                                            };
                                                        } else {
                                                            options.ajax = {
                                                                id: "x<?= $Grid->RowIndex ?>_status",
                                                                form: "fpenerimaan_paket_keluargrid",
                                                                limit: ew.LOOKUP_PAGE_SIZE
                                                            };
                                                        }
                                                        options.minimumResultsForSearch = Infinity;
                                                        options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.penerimaan_paket_keluar.fields.status.selectOptions);
                                                        ew.createSelect(options);
                                                    });
                                                </script>
                                            </span>
                                        <?php } else { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_status" class="el_penerimaan_paket_keluar_status">
                                                <span<?= $Grid->status->viewAttributes() ?>>
                                                    <span class="form-control-plaintext"><?= $Grid->status->getDisplayValue($Grid->status->ViewValue) ?></span>
                                            </span>
                                            </span>
                                            <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_status" data-hidden="1" name="x<?= $Grid->RowIndex ?>_status" id="x<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->FormValue) ?>">
                                        <?php } ?>
                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_status" data-hidden="1" name="o<?= $Grid->RowIndex ?>_status" id="o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
                                    </td>
                                <?php } ?>
                                <?php if ($Grid->tanggal_terima->Visible) { // tanggal_terima 
                                ?>
                                    <td data-name="tanggal_terima">
                                        <?php if (!$Grid->isConfirm()) { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_tanggal_terima" class="el_penerimaan_paket_keluar_tanggal_terima">
                                                <input type="<?= $Grid->tanggal_terima->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tanggal_terima" id="x<?= $Grid->RowIndex ?>_tanggal_terima" data-table="penerimaan_paket_keluar" data-field="x_tanggal_terima" value="<?= $Grid->tanggal_terima->EditValue ?>" placeholder="<?= HtmlEncode($Grid->tanggal_terima->getPlaceHolder()) ?>" <?= $Grid->tanggal_terima->editAttributes() ?>>
                                                <div class="invalid-feedback"><?= $Grid->tanggal_terima->getErrorMessage() ?></div>
                                                <?php if (!$Grid->tanggal_terima->ReadOnly && !$Grid->tanggal_terima->Disabled && !isset($Grid->tanggal_terima->EditAttrs["readonly"]) && !isset($Grid->tanggal_terima->EditAttrs["disabled"])) { ?>
                                                    <script>
                                                        loadjs.ready(["fpenerimaan_paket_keluargrid", "datetimepicker"], function() {
                                                            let format = "<?= DateFormat(0) ?>",
                                                                options = {
                                                                    localization: {
                                                                        locale: ew.LANGUAGE_ID,
                                                                        numberingSystem: ew.getNumberingSystem()
                                                                    },
                                                                    display: {
                                                                        format,
                                                                        components: {
                                                                            hours: !!format.match(/h/i),
                                                                            minutes: !!format.match(/m/),
                                                                            seconds: !!format.match(/s/i)
                                                                        },
                                                                        icons: {
                                                                            previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                                                                            next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
                                                                        }
                                                                    }
                                                                };
                                                            ew.createDateTimePicker("fpenerimaan_paket_keluargrid", "x<?= $Grid->RowIndex ?>_tanggal_terima", jQuery.extend(true, {
                                                                "useCurrent": false
                                                            }, options));
                                                        });
                                                    </script>
                                                <?php } ?>
                                            </span>
                                        <?php } else { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_tanggal_terima" class="el_penerimaan_paket_keluar_tanggal_terima">
                                                <span<?= $Grid->tanggal_terima->viewAttributes() ?>>
                                                    <input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tanggal_terima->getDisplayValue($Grid->tanggal_terima->ViewValue))) ?>">
                                            </span>
                                            </span>
                                            <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_tanggal_terima" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tanggal_terima" id="x<?= $Grid->RowIndex ?>_tanggal_terima" value="<?= HtmlEncode($Grid->tanggal_terima->FormValue) ?>">
                                        <?php } ?>
                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_tanggal_terima" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tanggal_terima" id="o<?= $Grid->RowIndex ?>_tanggal_terima" value="<?= HtmlEncode($Grid->tanggal_terima->OldValue) ?>">
                                    </td>
                                <?php } ?>
                                <?php if ($Grid->jenis_pengirim->Visible) { // jenis_pengirim 
                                ?>
                                    <td data-name="jenis_pengirim">
                                        <?php if (!$Grid->isConfirm()) { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_jenis_pengirim" class="el_penerimaan_paket_keluar_jenis_pengirim">
                                                <select id="x<?= $Grid->RowIndex ?>_jenis_pengirim" name="x<?= $Grid->RowIndex ?>_jenis_pengirim" class="form-select ew-select<?= $Grid->jenis_pengirim->isInvalidClass() ?>" data-select2-id="fpenerimaan_paket_keluargrid_x<?= $Grid->RowIndex ?>_jenis_pengirim" data-table="penerimaan_paket_keluar" data-field="x_jenis_pengirim" data-value-separator="<?= $Grid->jenis_pengirim->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Grid->jenis_pengirim->getPlaceHolder()) ?>" <?= $Grid->jenis_pengirim->editAttributes() ?>>
                                                    <?= $Grid->jenis_pengirim->selectOptionListHtml("x{$Grid->RowIndex}_jenis_pengirim") ?>
                                                </select>
                                                <div class="invalid-feedback"><?= $Grid->jenis_pengirim->getErrorMessage() ?></div>
                                                <?= $Grid->jenis_pengirim->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_jenis_pengirim") ?>
                                                <script>
                                                    loadjs.ready("fpenerimaan_paket_keluargrid", function() {
                                                        var options = {
                                                                name: "x<?= $Grid->RowIndex ?>_jenis_pengirim",
                                                                selectId: "fpenerimaan_paket_keluargrid_x<?= $Grid->RowIndex ?>_jenis_pengirim"
                                                            },
                                                            el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
                                                        options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
                                                        if (fpenerimaan_paket_keluargrid.lists.jenis_pengirim.lookupOptions.length) {
                                                            options.data = {
                                                                id: "x<?= $Grid->RowIndex ?>_jenis_pengirim",
                                                                form: "fpenerimaan_paket_keluargrid"
                                                            };
                                                        } else {
                                                            options.ajax = {
                                                                id: "x<?= $Grid->RowIndex ?>_jenis_pengirim",
                                                                form: "fpenerimaan_paket_keluargrid",
                                                                limit: ew.LOOKUP_PAGE_SIZE
                                                            };
                                                        }
                                                        options.minimumResultsForSearch = Infinity;
                                                        options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.penerimaan_paket_keluar.fields.jenis_pengirim.selectOptions);
                                                        ew.createSelect(options);
                                                    });
                                                </script>
                                            </span>
                                        <?php } else { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_jenis_pengirim" class="el_penerimaan_paket_keluar_jenis_pengirim">
                                                <span<?= $Grid->jenis_pengirim->viewAttributes() ?>>
                                                    <span class="form-control-plaintext"><?= $Grid->jenis_pengirim->getDisplayValue($Grid->jenis_pengirim->ViewValue) ?></span>
                                            </span>
                                            </span>
                                            <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_jenis_pengirim" data-hidden="1" name="x<?= $Grid->RowIndex ?>_jenis_pengirim" id="x<?= $Grid->RowIndex ?>_jenis_pengirim" value="<?= HtmlEncode($Grid->jenis_pengirim->FormValue) ?>">
                                        <?php } ?>
                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_jenis_pengirim" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jenis_pengirim" id="o<?= $Grid->RowIndex ?>_jenis_pengirim" value="<?= HtmlEncode($Grid->jenis_pengirim->OldValue) ?>">
                                    </td>
                                <?php } ?>
                                <?php if ($Grid->nama_kurir->Visible) { // nama_kurir 
                                ?>
                                    <td data-name="nama_kurir">
                                        <?php if (!$Grid->isConfirm()) { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_nama_kurir" class="el_penerimaan_paket_keluar_nama_kurir">
                                                <select id="x<?= $Grid->RowIndex ?>_nama_kurir" name="x<?= $Grid->RowIndex ?>_nama_kurir" class="form-select ew-select<?= $Grid->nama_kurir->isInvalidClass() ?>" data-select2-id="fpenerimaan_paket_keluargrid_x<?= $Grid->RowIndex ?>_nama_kurir" data-table="penerimaan_paket_keluar" data-field="x_nama_kurir" data-value-separator="<?= $Grid->nama_kurir->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Grid->nama_kurir->getPlaceHolder()) ?>" <?= $Grid->nama_kurir->editAttributes() ?>>
                                                    <?= $Grid->nama_kurir->selectOptionListHtml("x{$Grid->RowIndex}_nama_kurir") ?>
                                                </select>
                                                <div class="invalid-feedback"><?= $Grid->nama_kurir->getErrorMessage() ?></div>
                                                <script>
                                                    loadjs.ready("fpenerimaan_paket_keluargrid", function() {
                                                        var options = {
                                                                name: "x<?= $Grid->RowIndex ?>_nama_kurir",
                                                                selectId: "fpenerimaan_paket_keluargrid_x<?= $Grid->RowIndex ?>_nama_kurir"
                                                            },
                                                            el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
                                                        options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
                                                        if (fpenerimaan_paket_keluargrid.lists.nama_kurir.lookupOptions.length) {
                                                            options.data = {
                                                                id: "x<?= $Grid->RowIndex ?>_nama_kurir",
                                                                form: "fpenerimaan_paket_keluargrid"
                                                            };
                                                        } else {
                                                            options.ajax = {
                                                                id: "x<?= $Grid->RowIndex ?>_nama_kurir",
                                                                form: "fpenerimaan_paket_keluargrid",
                                                                limit: ew.LOOKUP_PAGE_SIZE
                                                            };
                                                        }
                                                        options.minimumResultsForSearch = Infinity;
                                                        options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.penerimaan_paket_keluar.fields.nama_kurir.selectOptions);
                                                        ew.createSelect(options);
                                                    });
                                                </script>
                                            </span>
                                        <?php } else { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_nama_kurir" class="el_penerimaan_paket_keluar_nama_kurir">
                                                <span<?= $Grid->nama_kurir->viewAttributes() ?>>
                                                    <span class="form-control-plaintext"><?= $Grid->nama_kurir->getDisplayValue($Grid->nama_kurir->ViewValue) ?></span>
                                            </span>
                                            </span>
                                            <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_nama_kurir" data-hidden="1" name="x<?= $Grid->RowIndex ?>_nama_kurir" id="x<?= $Grid->RowIndex ?>_nama_kurir" value="<?= HtmlEncode($Grid->nama_kurir->FormValue) ?>">
                                        <?php } ?>
                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_nama_kurir" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nama_kurir" id="o<?= $Grid->RowIndex ?>_nama_kurir" value="<?= HtmlEncode($Grid->nama_kurir->OldValue) ?>">
                                    </td>
                                <?php } ?>
                                <?php if ($Grid->no_awb->Visible) { // no_awb 
                                ?>
                                    <td data-name="no_awb">
                                        <?php if (!$Grid->isConfirm()) { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_no_awb" class="el_penerimaan_paket_keluar_no_awb">
                                                <input type="<?= $Grid->no_awb->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_no_awb" id="x<?= $Grid->RowIndex ?>_no_awb" data-table="penerimaan_paket_keluar" data-field="x_no_awb" value="<?= $Grid->no_awb->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->no_awb->getPlaceHolder()) ?>" <?= $Grid->no_awb->editAttributes() ?>>
                                                <div class="invalid-feedback"><?= $Grid->no_awb->getErrorMessage() ?></div>
                                            </span>
                                        <?php } else { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_no_awb" class="el_penerimaan_paket_keluar_no_awb">
                                                <span<?= $Grid->no_awb->viewAttributes() ?>>
                                                    <input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->no_awb->getDisplayValue($Grid->no_awb->ViewValue))) ?>">
                                            </span>
                                            </span>
                                            <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_no_awb" data-hidden="1" name="x<?= $Grid->RowIndex ?>_no_awb" id="x<?= $Grid->RowIndex ?>_no_awb" value="<?= HtmlEncode($Grid->no_awb->FormValue) ?>">
                                        <?php } ?>
                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_no_awb" data-hidden="1" name="o<?= $Grid->RowIndex ?>_no_awb" id="o<?= $Grid->RowIndex ?>_no_awb" value="<?= HtmlEncode($Grid->no_awb->OldValue) ?>">
                                    </td>
                                <?php } ?>
                                <?php if ($Grid->id_user->Visible) { // id_user 
                                ?>
                                    <td data-name="id_user">
                                        <?php if (!$Grid->isConfirm()) { ?>
                                            <?php if ($Grid->id_user->getSessionValue() != "") { ?>
                                                <span id="el$rowindex$_penerimaan_paket_keluar_id_user" class="el_penerimaan_paket_keluar_id_user">
                                                    <span<?= $Grid->id_user->viewAttributes() ?>>
                                                        <input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id_user->getDisplayValue($Grid->id_user->ViewValue))) ?>">
                                                </span>
                                                </span>
                                                <input type="hidden" id="x<?= $Grid->RowIndex ?>_id_user" name="x<?= $Grid->RowIndex ?>_id_user" value="<?= HtmlEncode(FormatNumber($Grid->id_user->CurrentValue, $Grid->id_user->formatPattern())) ?>" data-hidden="1">
                                            <?php } else { ?>
                                                <span id="el$rowindex$_penerimaan_paket_keluar_id_user" class="el_penerimaan_paket_keluar_id_user">
                                                    <input type="<?= $Grid->id_user->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_id_user" id="x<?= $Grid->RowIndex ?>_id_user" data-table="penerimaan_paket_keluar" data-field="x_id_user" value="<?= $Grid->id_user->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->id_user->getPlaceHolder()) ?>" <?= $Grid->id_user->editAttributes() ?>>
                                                    <div class="invalid-feedback"><?= $Grid->id_user->getErrorMessage() ?></div>
                                                </span>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_id_user" class="el_penerimaan_paket_keluar_id_user">
                                                <span<?= $Grid->id_user->viewAttributes() ?>>
                                                    <input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id_user->getDisplayValue($Grid->id_user->ViewValue))) ?>">
                                            </span>
                                            </span>
                                            <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_id_user" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id_user" id="x<?= $Grid->RowIndex ?>_id_user" value="<?= HtmlEncode($Grid->id_user->FormValue) ?>">
                                        <?php } ?>
                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_id_user" data-hidden="1" name="o<?= $Grid->RowIndex ?>_id_user" id="o<?= $Grid->RowIndex ?>_id_user" value="<?= HtmlEncode($Grid->id_user->OldValue) ?>">
                                    </td>
                                <?php } ?>
                                <?php if ($Grid->bukti_penerimaan->Visible) { // bukti_penerimaan 
                                ?>
                                    <td data-name="bukti_penerimaan">
                                        <?php if (!$Grid->isConfirm()) { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_bukti_penerimaan" class="el_penerimaan_paket_keluar_bukti_penerimaan">
                                                <div id="fd_x<?= $Grid->RowIndex ?>_bukti_penerimaan" class="fileinput-button ew-file-drop-zone">
                                                    <input type="file" class="form-control ew-file-input" title="<?= $Grid->bukti_penerimaan->title() ?>" data-table="penerimaan_paket_keluar" data-field="x_bukti_penerimaan" name="x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="x<?= $Grid->RowIndex ?>_bukti_penerimaan" lang="<?= CurrentLanguageID() ?>" <?= $Grid->bukti_penerimaan->editAttributes() ?><?= ($Grid->bukti_penerimaan->ReadOnly || $Grid->bukti_penerimaan->Disabled) ? " disabled" : "" ?>>
                                                    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
                                                </div>
                                                <div class="invalid-feedback"><?= $Grid->bukti_penerimaan->getErrorMessage() ?></div>
                                                <input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fn_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="<?= $Grid->bukti_penerimaan->Upload->FileName ?>">
                                                <input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fa_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="0">
                                                <input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fs_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="255">
                                                <input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fx_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="<?= $Grid->bukti_penerimaan->UploadAllowedFileExt ?>">
                                                <input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fm_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="<?= $Grid->bukti_penerimaan->UploadMaxFileSize ?>">
                                                <table id="ft_x<?= $Grid->RowIndex ?>_bukti_penerimaan" class="table table-sm float-start ew-upload-table">
                                                    <tbody class="files"></tbody>
                                                </table>
                                            </span>
                                        <?php } else { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_bukti_penerimaan" class="el_penerimaan_paket_keluar_bukti_penerimaan">
                                                <div id="fd_x<?= $Grid->RowIndex ?>_bukti_penerimaan">
                                                    <input type="file" class="form-control ew-file-input d-none" title="<?= $Grid->bukti_penerimaan->title() ?>" data-table="penerimaan_paket_keluar" data-field="x_bukti_penerimaan" name="x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="x<?= $Grid->RowIndex ?>_bukti_penerimaan" lang="<?= CurrentLanguageID() ?>" <?= $Grid->bukti_penerimaan->editAttributes() ?>>
                                                </div>
                                                <div class="invalid-feedback"><?= $Grid->bukti_penerimaan->getErrorMessage() ?></div>
                                                <input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fn_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="<?= $Grid->bukti_penerimaan->Upload->FileName ?>">
                                                <input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fa_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="0">
                                                <input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fs_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="255">
                                                <input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fx_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="<?= $Grid->bukti_penerimaan->UploadAllowedFileExt ?>">
                                                <input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_bukti_penerimaan" id="fm_x<?= $Grid->RowIndex ?>_bukti_penerimaan" value="<?= $Grid->bukti_penerimaan->UploadMaxFileSize ?>">
                                                <table id="ft_x<?= $Grid->RowIndex ?>_bukti_penerimaan" class="table table-sm float-start ew-upload-table">
                                                    <tbody class="files"></tbody>
                                                </table>
                                            </span>
                                        <?php } ?>
                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_bukti_penerimaan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_bukti_penerimaan" id="o<?= $Grid->RowIndex ?>_bukti_penerimaan" value="<?= HtmlEncode($Grid->bukti_penerimaan->OldValue) ?>">
                                    </td>
                                <?php } ?>
                                <?php if ($Grid->nama_penerima->Visible) { // nama_penerima 
                                ?>
                                    <td data-name="nama_penerima">
                                        <?php if (!$Grid->isConfirm()) { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_nama_penerima" class="el_penerimaan_paket_keluar_nama_penerima">
                                                <input type="<?= $Grid->nama_penerima->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_nama_penerima" id="x<?= $Grid->RowIndex ?>_nama_penerima" data-table="penerimaan_paket_keluar" data-field="x_nama_penerima" value="<?= $Grid->nama_penerima->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->nama_penerima->getPlaceHolder()) ?>" <?= $Grid->nama_penerima->editAttributes() ?>>
                                                <div class="invalid-feedback"><?= $Grid->nama_penerima->getErrorMessage() ?></div>
                                            </span>
                                        <?php } else { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_nama_penerima" class="el_penerimaan_paket_keluar_nama_penerima">
                                                <span<?= $Grid->nama_penerima->viewAttributes() ?>>
                                                    <input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->nama_penerima->getDisplayValue($Grid->nama_penerima->ViewValue))) ?>">
                                            </span>
                                            </span>
                                            <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_nama_penerima" data-hidden="1" name="x<?= $Grid->RowIndex ?>_nama_penerima" id="x<?= $Grid->RowIndex ?>_nama_penerima" value="<?= HtmlEncode($Grid->nama_penerima->FormValue) ?>">
                                        <?php } ?>
                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_nama_penerima" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nama_penerima" id="o<?= $Grid->RowIndex ?>_nama_penerima" value="<?= HtmlEncode($Grid->nama_penerima->OldValue) ?>">
                                    </td>
                                <?php } ?>
                                <?php if ($Grid->status_sap->Visible) { // status_sap 
                                ?>
                                    <td data-name="status_sap">
                                        <?php if (!$Grid->isConfirm()) { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_status_sap" class="el_penerimaan_paket_keluar_status_sap">
                                                <input type="<?= $Grid->status_sap->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_status_sap" id="x<?= $Grid->RowIndex ?>_status_sap" data-table="penerimaan_paket_keluar" data-field="x_status_sap" value="<?= $Grid->status_sap->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->status_sap->getPlaceHolder()) ?>" <?= $Grid->status_sap->editAttributes() ?>>
                                                <div class="invalid-feedback"><?= $Grid->status_sap->getErrorMessage() ?></div>
                                            </span>
                                        <?php } else { ?>
                                            <span id="el$rowindex$_penerimaan_paket_keluar_status_sap" class="el_penerimaan_paket_keluar_status_sap">
                                                <span<?= $Grid->status_sap->viewAttributes() ?>>
                                                    <input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->status_sap->getDisplayValue($Grid->status_sap->ViewValue))) ?>">
                                            </span>
                                            </span>
                                            <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_status_sap" data-hidden="1" name="x<?= $Grid->RowIndex ?>_status_sap" id="x<?= $Grid->RowIndex ?>_status_sap" value="<?= HtmlEncode($Grid->status_sap->FormValue) ?>">
                                        <?php } ?>
                                        <input type="hidden" data-table="penerimaan_paket_keluar" data-field="x_status_sap" data-hidden="1" name="o<?= $Grid->RowIndex ?>_status_sap" id="o<?= $Grid->RowIndex ?>_status_sap" value="<?= HtmlEncode($Grid->status_sap->OldValue) ?>">
                                    </td>
                                <?php } ?>
                                <?php
                                // Render list options (body, right)
                                $Grid->ListOptions->render("body", "right", $Grid->RowIndex);
                                ?>
                                <script>
                                    loadjs.ready(["fpenerimaan_paket_keluargrid", "load"], () => fpenerimaan_paket_keluargrid.updateLists(<?= $Grid->RowIndex ?>, true));
                                </script>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table><!-- /.ew-table -->
            </div><!-- /.ew-grid-middle-panel -->
            <?php if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy") { ?>
                <input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
                <?= $Grid->MultiSelectKey ?>
            <?php } ?>
            <?php if ($Grid->CurrentMode == "edit") { ?>
                <input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
                <?= $Grid->MultiSelectKey ?>
            <?php } ?>
            <?php if ($Grid->CurrentMode == "") { ?>
                <input type="hidden" name="action" id="action" value="">
            <?php } ?>
            <input type="hidden" name="detailpage" value="fpenerimaan_paket_keluargrid">
        </div><!-- /.ew-list-form -->
        <?php
        // Close recordset
        if ($Grid->Recordset) {
            $Grid->Recordset->close();
        }
        ?>
        <?php if ($Grid->ShowOtherOptions) { ?>
            <div class="card-footer ew-grid-lower-panel">
                <?php $Grid->OtherOptions->render("body", "bottom") ?>
            </div>
        <?php } ?>
    </div><!-- /.ew-grid -->
<?php } else { ?>
    <div class="ew-list-other-options">
        <?php $Grid->OtherOptions->render("body") ?>
    </div>
<?php } ?>
<?php if (!$Grid->isExport()) { ?>
    <script>
        // Field event handlers
        loadjs.ready("head", function() {
            ew.addEventHandlers("penerimaan_paket_keluar");
        });
    </script>
    <script>
        loadjs.ready("load", function() {
            // Write your table-specific startup script here, no need to add script tags.
        });
    </script>
<?php } ?>