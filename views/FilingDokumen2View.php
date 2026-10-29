<?php

namespace Mitral2022\DSN2;

// Page object
$FilingDokumen2View = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { filing_dokumen2: currentTable } });
var currentForm, currentPageID;
var ffiling_dokumen2view;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ffiling_dokumen2view = new ew.Form("ffiling_dokumen2view", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = ffiling_dokumen2view;
    loadjs.done("ffiling_dokumen2view");
});
</script>
<script>
loadjs.ready("head", function () {
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
<form name="ffiling_dokumen2view" id="ffiling_dokumen2view" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="filing_dokumen2">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->no_box->Visible) { // no_box ?>
    <tr id="r_no_box"<?= $Page->no_box->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_filing_dokumen2_no_box"><?= $Page->no_box->caption() ?></span></td>
        <td data-name="no_box"<?= $Page->no_box->cellAttributes() ?>>
<span id="el_filing_dokumen2_no_box">
<span<?= $Page->no_box->viewAttributes() ?>>
<?= $Page->no_box->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode_pt->Visible) { // kode_pt ?>
    <tr id="r_kode_pt"<?= $Page->kode_pt->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_filing_dokumen2_kode_pt"><?= $Page->kode_pt->caption() ?></span></td>
        <td data-name="kode_pt"<?= $Page->kode_pt->cellAttributes() ?>>
<span id="el_filing_dokumen2_kode_pt">
<span<?= $Page->kode_pt->viewAttributes() ?>>
<?= $Page->kode_pt->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode_department->Visible) { // kode_department ?>
    <tr id="r_kode_department"<?= $Page->kode_department->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_filing_dokumen2_kode_department"><?= $Page->kode_department->caption() ?></span></td>
        <td data-name="kode_department"<?= $Page->kode_department->cellAttributes() ?>>
<span id="el_filing_dokumen2_kode_department">
<span<?= $Page->kode_department->viewAttributes() ?>>
<?= $Page->kode_department->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lokasi->Visible) { // lokasi ?>
    <tr id="r_lokasi"<?= $Page->lokasi->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_filing_dokumen2_lokasi"><?= $Page->lokasi->caption() ?></span></td>
        <td data-name="lokasi"<?= $Page->lokasi->cellAttributes() ?>>
<span id="el_filing_dokumen2_lokasi">
<span<?= $Page->lokasi->viewAttributes() ?>>
<?= $Page->lokasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_dokumen->Visible) { // nama_dokumen ?>
    <tr id="r_nama_dokumen"<?= $Page->nama_dokumen->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_filing_dokumen2_nama_dokumen"><?= $Page->nama_dokumen->caption() ?></span></td>
        <td data-name="nama_dokumen"<?= $Page->nama_dokumen->cellAttributes() ?>>
<span id="el_filing_dokumen2_nama_dokumen">
<span<?= $Page->nama_dokumen->viewAttributes() ?>>
<?= $Page->nama_dokumen->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tahun_pembuatan_dokumen->Visible) { // tahun_pembuatan_dokumen ?>
    <tr id="r_tahun_pembuatan_dokumen"<?= $Page->tahun_pembuatan_dokumen->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_filing_dokumen2_tahun_pembuatan_dokumen"><?= $Page->tahun_pembuatan_dokumen->caption() ?></span></td>
        <td data-name="tahun_pembuatan_dokumen"<?= $Page->tahun_pembuatan_dokumen->cellAttributes() ?>>
<span id="el_filing_dokumen2_tahun_pembuatan_dokumen">
<span<?= $Page->tahun_pembuatan_dokumen->viewAttributes() ?>>
<?= $Page->tahun_pembuatan_dokumen->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->deskripsi->Visible) { // deskripsi ?>
    <tr id="r_deskripsi"<?= $Page->deskripsi->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_filing_dokumen2_deskripsi"><?= $Page->deskripsi->caption() ?></span></td>
        <td data-name="deskripsi"<?= $Page->deskripsi->cellAttributes() ?>>
<span id="el_filing_dokumen2_deskripsi">
<span<?= $Page->deskripsi->viewAttributes() ?>>
<?= $Page->deskripsi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->no_rak->Visible) { // no_rak ?>
    <tr id="r_no_rak"<?= $Page->no_rak->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_filing_dokumen2_no_rak"><?= $Page->no_rak->caption() ?></span></td>
        <td data-name="no_rak"<?= $Page->no_rak->cellAttributes() ?>>
<span id="el_filing_dokumen2_no_rak">
<span<?= $Page->no_rak->viewAttributes() ?>>
<?= $Page->no_rak->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->file->Visible) { // file ?>
    <tr id="r_file"<?= $Page->file->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_filing_dokumen2_file"><?= $Page->file->caption() ?></span></td>
        <td data-name="file"<?= $Page->file->cellAttributes() ?>>
<span id="el_filing_dokumen2_file">
<span>
<?= GetFileViewTag($Page->file, $Page->file->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->masa_berlaku->Visible) { // masa_berlaku ?>
    <tr id="r_masa_berlaku"<?= $Page->masa_berlaku->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_filing_dokumen2_masa_berlaku"><?= $Page->masa_berlaku->caption() ?></span></td>
        <td data-name="masa_berlaku"<?= $Page->masa_berlaku->cellAttributes() ?>>
<span id="el_filing_dokumen2_masa_berlaku">
<span<?= $Page->masa_berlaku->viewAttributes() ?>>
<?= $Page->masa_berlaku->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_date->Visible) { // created_date ?>
    <tr id="r_created_date"<?= $Page->created_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_filing_dokumen2_created_date"><?= $Page->created_date->caption() ?></span></td>
        <td data-name="created_date"<?= $Page->created_date->cellAttributes() ?>>
<span id="el_filing_dokumen2_created_date">
<span<?= $Page->created_date->viewAttributes() ?>>
<?= $Page->created_date->getViewValue() ?></span>
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
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
