<?php

namespace Mitral2022\DSN2;

// Page object
$FilingDokumen2Delete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { filing_dokumen2: currentTable } });
var currentForm, currentPageID;
var ffiling_dokumen2delete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ffiling_dokumen2delete = new ew.Form("ffiling_dokumen2delete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = ffiling_dokumen2delete;
    loadjs.done("ffiling_dokumen2delete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="ffiling_dokumen2delete" id="ffiling_dokumen2delete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="filing_dokumen2">
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
<?php if ($Page->no_box->Visible) { // no_box ?>
        <th class="<?= $Page->no_box->headerCellClass() ?>"><span id="elh_filing_dokumen2_no_box" class="filing_dokumen2_no_box"><?= $Page->no_box->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kode_pt->Visible) { // kode_pt ?>
        <th class="<?= $Page->kode_pt->headerCellClass() ?>"><span id="elh_filing_dokumen2_kode_pt" class="filing_dokumen2_kode_pt"><?= $Page->kode_pt->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kode_department->Visible) { // kode_department ?>
        <th class="<?= $Page->kode_department->headerCellClass() ?>"><span id="elh_filing_dokumen2_kode_department" class="filing_dokumen2_kode_department"><?= $Page->kode_department->caption() ?></span></th>
<?php } ?>
<?php if ($Page->lokasi->Visible) { // lokasi ?>
        <th class="<?= $Page->lokasi->headerCellClass() ?>"><span id="elh_filing_dokumen2_lokasi" class="filing_dokumen2_lokasi"><?= $Page->lokasi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_dokumen->Visible) { // nama_dokumen ?>
        <th class="<?= $Page->nama_dokumen->headerCellClass() ?>"><span id="elh_filing_dokumen2_nama_dokumen" class="filing_dokumen2_nama_dokumen"><?= $Page->nama_dokumen->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tahun_pembuatan_dokumen->Visible) { // tahun_pembuatan_dokumen ?>
        <th class="<?= $Page->tahun_pembuatan_dokumen->headerCellClass() ?>"><span id="elh_filing_dokumen2_tahun_pembuatan_dokumen" class="filing_dokumen2_tahun_pembuatan_dokumen"><?= $Page->tahun_pembuatan_dokumen->caption() ?></span></th>
<?php } ?>
<?php if ($Page->deskripsi->Visible) { // deskripsi ?>
        <th class="<?= $Page->deskripsi->headerCellClass() ?>"><span id="elh_filing_dokumen2_deskripsi" class="filing_dokumen2_deskripsi"><?= $Page->deskripsi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_filing_dokumen2_id" class="filing_dokumen2_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->no_gudang->Visible) { // no_gudang ?>
        <th class="<?= $Page->no_gudang->headerCellClass() ?>"><span id="elh_filing_dokumen2_no_gudang" class="filing_dokumen2_no_gudang"><?= $Page->no_gudang->caption() ?></span></th>
<?php } ?>
<?php if ($Page->no_rak->Visible) { // no_rak ?>
        <th class="<?= $Page->no_rak->headerCellClass() ?>"><span id="elh_filing_dokumen2_no_rak" class="filing_dokumen2_no_rak"><?= $Page->no_rak->caption() ?></span></th>
<?php } ?>
<?php if ($Page->file->Visible) { // file ?>
        <th class="<?= $Page->file->headerCellClass() ?>"><span id="elh_filing_dokumen2_file" class="filing_dokumen2_file"><?= $Page->file->caption() ?></span></th>
<?php } ?>
<?php if ($Page->masa_berlaku->Visible) { // masa_berlaku ?>
        <th class="<?= $Page->masa_berlaku->headerCellClass() ?>"><span id="elh_filing_dokumen2_masa_berlaku" class="filing_dokumen2_masa_berlaku"><?= $Page->masa_berlaku->caption() ?></span></th>
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
<?php if ($Page->no_box->Visible) { // no_box ?>
        <td<?= $Page->no_box->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_filing_dokumen2_no_box" class="el_filing_dokumen2_no_box">
<span<?= $Page->no_box->viewAttributes() ?>>
<?= $Page->no_box->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kode_pt->Visible) { // kode_pt ?>
        <td<?= $Page->kode_pt->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_filing_dokumen2_kode_pt" class="el_filing_dokumen2_kode_pt">
<span<?= $Page->kode_pt->viewAttributes() ?>>
<?= $Page->kode_pt->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kode_department->Visible) { // kode_department ?>
        <td<?= $Page->kode_department->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_filing_dokumen2_kode_department" class="el_filing_dokumen2_kode_department">
<span<?= $Page->kode_department->viewAttributes() ?>>
<?= $Page->kode_department->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->lokasi->Visible) { // lokasi ?>
        <td<?= $Page->lokasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_filing_dokumen2_lokasi" class="el_filing_dokumen2_lokasi">
<span<?= $Page->lokasi->viewAttributes() ?>>
<?= $Page->lokasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_dokumen->Visible) { // nama_dokumen ?>
        <td<?= $Page->nama_dokumen->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_filing_dokumen2_nama_dokumen" class="el_filing_dokumen2_nama_dokumen">
<span<?= $Page->nama_dokumen->viewAttributes() ?>>
<?= $Page->nama_dokumen->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tahun_pembuatan_dokumen->Visible) { // tahun_pembuatan_dokumen ?>
        <td<?= $Page->tahun_pembuatan_dokumen->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_filing_dokumen2_tahun_pembuatan_dokumen" class="el_filing_dokumen2_tahun_pembuatan_dokumen">
<span<?= $Page->tahun_pembuatan_dokumen->viewAttributes() ?>>
<?= $Page->tahun_pembuatan_dokumen->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->deskripsi->Visible) { // deskripsi ?>
        <td<?= $Page->deskripsi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_filing_dokumen2_deskripsi" class="el_filing_dokumen2_deskripsi">
<span<?= $Page->deskripsi->viewAttributes() ?>>
<?= $Page->deskripsi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->id->Visible) { // id ?>
        <td<?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_filing_dokumen2_id" class="el_filing_dokumen2_id">
<span<?= $Page->id->viewAttributes() ?>><a
		class="btn btn-secondary"
		target="_blank" href="views/Printcode.php?param1=
		<?php echo urlencode(CurrentPage()->id->CurrentValue) ?>">
		PRINT
</a>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->no_gudang->Visible) { // no_gudang ?>
        <td<?= $Page->no_gudang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_filing_dokumen2_no_gudang" class="el_filing_dokumen2_no_gudang">
<span<?= $Page->no_gudang->viewAttributes() ?>>
<?= $Page->no_gudang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->no_rak->Visible) { // no_rak ?>
        <td<?= $Page->no_rak->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_filing_dokumen2_no_rak" class="el_filing_dokumen2_no_rak">
<span<?= $Page->no_rak->viewAttributes() ?>>
<?= $Page->no_rak->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->file->Visible) { // file ?>
        <td<?= $Page->file->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_filing_dokumen2_file" class="el_filing_dokumen2_file">
<span>
<?= GetFileViewTag($Page->file, $Page->file->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->masa_berlaku->Visible) { // masa_berlaku ?>
        <td<?= $Page->masa_berlaku->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_filing_dokumen2_masa_berlaku" class="el_filing_dokumen2_masa_berlaku">
<span<?= $Page->masa_berlaku->viewAttributes() ?>>
<?= $Page->masa_berlaku->getViewValue() ?></span>
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
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
