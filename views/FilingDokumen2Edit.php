<?php

namespace Mitral2022\DSN2;

// Page object
$FilingDokumen2Edit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { filing_dokumen2: currentTable } });
var currentForm, currentPageID;
var ffiling_dokumen2edit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ffiling_dokumen2edit = new ew.Form("ffiling_dokumen2edit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = ffiling_dokumen2edit;

    // Add fields
    var fields = currentTable.fields;
    ffiling_dokumen2edit.addFields([
        ["no_box", [fields.no_box.visible && fields.no_box.required ? ew.Validators.required(fields.no_box.caption) : null], fields.no_box.isInvalid],
        ["kode_pt", [fields.kode_pt.visible && fields.kode_pt.required ? ew.Validators.required(fields.kode_pt.caption) : null], fields.kode_pt.isInvalid],
        ["kode_department", [fields.kode_department.visible && fields.kode_department.required ? ew.Validators.required(fields.kode_department.caption) : null], fields.kode_department.isInvalid],
        ["lokasi", [fields.lokasi.visible && fields.lokasi.required ? ew.Validators.required(fields.lokasi.caption) : null], fields.lokasi.isInvalid],
        ["nama_dokumen", [fields.nama_dokumen.visible && fields.nama_dokumen.required ? ew.Validators.required(fields.nama_dokumen.caption) : null], fields.nama_dokumen.isInvalid],
        ["tahun_pembuatan_dokumen", [fields.tahun_pembuatan_dokumen.visible && fields.tahun_pembuatan_dokumen.required ? ew.Validators.required(fields.tahun_pembuatan_dokumen.caption) : null, ew.Validators.integer], fields.tahun_pembuatan_dokumen.isInvalid],
        ["deskripsi", [fields.deskripsi.visible && fields.deskripsi.required ? ew.Validators.required(fields.deskripsi.caption) : null], fields.deskripsi.isInvalid],
        ["no_gudang", [fields.no_gudang.visible && fields.no_gudang.required ? ew.Validators.required(fields.no_gudang.caption) : null], fields.no_gudang.isInvalid],
        ["no_rak", [fields.no_rak.visible && fields.no_rak.required ? ew.Validators.required(fields.no_rak.caption) : null], fields.no_rak.isInvalid],
        ["file", [fields.file.visible && fields.file.required ? ew.Validators.fileRequired(fields.file.caption) : null], fields.file.isInvalid],
        ["masa_berlaku", [fields.masa_berlaku.visible && fields.masa_berlaku.required ? ew.Validators.required(fields.masa_berlaku.caption) : null], fields.masa_berlaku.isInvalid]
    ]);

    // Form_CustomValidate
    ffiling_dokumen2edit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ffiling_dokumen2edit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    ffiling_dokumen2edit.lists.kode_pt = <?= $Page->kode_pt->toClientList($Page) ?>;
    ffiling_dokumen2edit.lists.kode_department = <?= $Page->kode_department->toClientList($Page) ?>;
    ffiling_dokumen2edit.lists.no_gudang = <?= $Page->no_gudang->toClientList($Page) ?>;
    ffiling_dokumen2edit.lists.masa_berlaku = <?= $Page->masa_berlaku->toClientList($Page) ?>;
    loadjs.done("ffiling_dokumen2edit");
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
<form name="ffiling_dokumen2edit" id="ffiling_dokumen2edit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="filing_dokumen2">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->no_box->Visible) { // no_box ?>
    <div id="r_no_box"<?= $Page->no_box->rowAttributes() ?>>
        <label id="elh_filing_dokumen2_no_box" for="x_no_box" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_box->caption() ?><?= $Page->no_box->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->no_box->cellAttributes() ?>>
<span id="el_filing_dokumen2_no_box">
<input type="<?= $Page->no_box->getInputTextType() ?>" name="x_no_box" id="x_no_box" data-table="filing_dokumen2" data-field="x_no_box" value="<?= $Page->no_box->EditValue ?>" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->no_box->getPlaceHolder()) ?>"<?= $Page->no_box->editAttributes() ?> aria-describedby="x_no_box_help">
<?= $Page->no_box->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_box->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode_pt->Visible) { // kode_pt ?>
    <div id="r_kode_pt"<?= $Page->kode_pt->rowAttributes() ?>>
        <label id="elh_filing_dokumen2_kode_pt" for="x_kode_pt" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_pt->caption() ?><?= $Page->kode_pt->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->kode_pt->cellAttributes() ?>>
<span id="el_filing_dokumen2_kode_pt">
    <select
        id="x_kode_pt"
        name="x_kode_pt"
        class="form-select ew-select<?= $Page->kode_pt->isInvalidClass() ?>"
        data-select2-id="ffiling_dokumen2edit_x_kode_pt"
        data-table="filing_dokumen2"
        data-field="x_kode_pt"
        data-value-separator="<?= $Page->kode_pt->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->kode_pt->getPlaceHolder()) ?>"
        <?= $Page->kode_pt->editAttributes() ?>>
        <?= $Page->kode_pt->selectOptionListHtml("x_kode_pt") ?>
    </select>
    <?= $Page->kode_pt->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->kode_pt->getErrorMessage() ?></div>
<?= $Page->kode_pt->Lookup->getParamTag($Page, "p_x_kode_pt") ?>
<script>
loadjs.ready("ffiling_dokumen2edit", function() {
    var options = { name: "x_kode_pt", selectId: "ffiling_dokumen2edit_x_kode_pt" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ffiling_dokumen2edit.lists.kode_pt.lookupOptions.length) {
        options.data = { id: "x_kode_pt", form: "ffiling_dokumen2edit" };
    } else {
        options.ajax = { id: "x_kode_pt", form: "ffiling_dokumen2edit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.filing_dokumen2.fields.kode_pt.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode_department->Visible) { // kode_department ?>
    <div id="r_kode_department"<?= $Page->kode_department->rowAttributes() ?>>
        <label id="elh_filing_dokumen2_kode_department" for="x_kode_department" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_department->caption() ?><?= $Page->kode_department->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->kode_department->cellAttributes() ?>>
<span id="el_filing_dokumen2_kode_department">
    <select
        id="x_kode_department"
        name="x_kode_department"
        class="form-select ew-select<?= $Page->kode_department->isInvalidClass() ?>"
        data-select2-id="ffiling_dokumen2edit_x_kode_department"
        data-table="filing_dokumen2"
        data-field="x_kode_department"
        data-value-separator="<?= $Page->kode_department->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->kode_department->getPlaceHolder()) ?>"
        <?= $Page->kode_department->editAttributes() ?>>
        <?= $Page->kode_department->selectOptionListHtml("x_kode_department") ?>
    </select>
    <?= $Page->kode_department->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->kode_department->getErrorMessage() ?></div>
<?= $Page->kode_department->Lookup->getParamTag($Page, "p_x_kode_department") ?>
<script>
loadjs.ready("ffiling_dokumen2edit", function() {
    var options = { name: "x_kode_department", selectId: "ffiling_dokumen2edit_x_kode_department" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ffiling_dokumen2edit.lists.kode_department.lookupOptions.length) {
        options.data = { id: "x_kode_department", form: "ffiling_dokumen2edit" };
    } else {
        options.ajax = { id: "x_kode_department", form: "ffiling_dokumen2edit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.filing_dokumen2.fields.kode_department.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lokasi->Visible) { // lokasi ?>
    <div id="r_lokasi"<?= $Page->lokasi->rowAttributes() ?>>
        <label id="elh_filing_dokumen2_lokasi" for="x_lokasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lokasi->caption() ?><?= $Page->lokasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->lokasi->cellAttributes() ?>>
<span id="el_filing_dokumen2_lokasi">
<input type="<?= $Page->lokasi->getInputTextType() ?>" name="x_lokasi" id="x_lokasi" data-table="filing_dokumen2" data-field="x_lokasi" value="<?= $Page->lokasi->EditValue ?>" size="30" maxlength="3" placeholder="<?= HtmlEncode($Page->lokasi->getPlaceHolder()) ?>"<?= $Page->lokasi->editAttributes() ?> aria-describedby="x_lokasi_help">
<?= $Page->lokasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lokasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_dokumen->Visible) { // nama_dokumen ?>
    <div id="r_nama_dokumen"<?= $Page->nama_dokumen->rowAttributes() ?>>
        <label id="elh_filing_dokumen2_nama_dokumen" for="x_nama_dokumen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_dokumen->caption() ?><?= $Page->nama_dokumen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nama_dokumen->cellAttributes() ?>>
<span id="el_filing_dokumen2_nama_dokumen">
<input type="<?= $Page->nama_dokumen->getInputTextType() ?>" name="x_nama_dokumen" id="x_nama_dokumen" data-table="filing_dokumen2" data-field="x_nama_dokumen" value="<?= $Page->nama_dokumen->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->nama_dokumen->getPlaceHolder()) ?>"<?= $Page->nama_dokumen->editAttributes() ?> aria-describedby="x_nama_dokumen_help">
<?= $Page->nama_dokumen->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_dokumen->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tahun_pembuatan_dokumen->Visible) { // tahun_pembuatan_dokumen ?>
    <div id="r_tahun_pembuatan_dokumen"<?= $Page->tahun_pembuatan_dokumen->rowAttributes() ?>>
        <label id="elh_filing_dokumen2_tahun_pembuatan_dokumen" for="x_tahun_pembuatan_dokumen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tahun_pembuatan_dokumen->caption() ?><?= $Page->tahun_pembuatan_dokumen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tahun_pembuatan_dokumen->cellAttributes() ?>>
<span id="el_filing_dokumen2_tahun_pembuatan_dokumen">
<input type="<?= $Page->tahun_pembuatan_dokumen->getInputTextType() ?>" name="x_tahun_pembuatan_dokumen" id="x_tahun_pembuatan_dokumen" data-table="filing_dokumen2" data-field="x_tahun_pembuatan_dokumen" value="<?= $Page->tahun_pembuatan_dokumen->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->tahun_pembuatan_dokumen->getPlaceHolder()) ?>"<?= $Page->tahun_pembuatan_dokumen->editAttributes() ?> aria-describedby="x_tahun_pembuatan_dokumen_help">
<?= $Page->tahun_pembuatan_dokumen->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tahun_pembuatan_dokumen->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->deskripsi->Visible) { // deskripsi ?>
    <div id="r_deskripsi"<?= $Page->deskripsi->rowAttributes() ?>>
        <label id="elh_filing_dokumen2_deskripsi" for="x_deskripsi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->deskripsi->caption() ?><?= $Page->deskripsi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->deskripsi->cellAttributes() ?>>
<span id="el_filing_dokumen2_deskripsi">
<textarea data-table="filing_dokumen2" data-field="x_deskripsi" name="x_deskripsi" id="x_deskripsi" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->deskripsi->getPlaceHolder()) ?>"<?= $Page->deskripsi->editAttributes() ?> aria-describedby="x_deskripsi_help"><?= $Page->deskripsi->EditValue ?></textarea>
<?= $Page->deskripsi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->deskripsi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->no_gudang->Visible) { // no_gudang ?>
    <div id="r_no_gudang"<?= $Page->no_gudang->rowAttributes() ?>>
        <label id="elh_filing_dokumen2_no_gudang" for="x_no_gudang" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_gudang->caption() ?><?= $Page->no_gudang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->no_gudang->cellAttributes() ?>>
<span id="el_filing_dokumen2_no_gudang">
    <select
        id="x_no_gudang"
        name="x_no_gudang"
        class="form-select ew-select<?= $Page->no_gudang->isInvalidClass() ?>"
        data-select2-id="ffiling_dokumen2edit_x_no_gudang"
        data-table="filing_dokumen2"
        data-field="x_no_gudang"
        data-value-separator="<?= $Page->no_gudang->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->no_gudang->getPlaceHolder()) ?>"
        <?= $Page->no_gudang->editAttributes() ?>>
        <?= $Page->no_gudang->selectOptionListHtml("x_no_gudang") ?>
    </select>
    <?= $Page->no_gudang->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->no_gudang->getErrorMessage() ?></div>
<?= $Page->no_gudang->Lookup->getParamTag($Page, "p_x_no_gudang") ?>
<script>
loadjs.ready("ffiling_dokumen2edit", function() {
    var options = { name: "x_no_gudang", selectId: "ffiling_dokumen2edit_x_no_gudang" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ffiling_dokumen2edit.lists.no_gudang.lookupOptions.length) {
        options.data = { id: "x_no_gudang", form: "ffiling_dokumen2edit" };
    } else {
        options.ajax = { id: "x_no_gudang", form: "ffiling_dokumen2edit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.filing_dokumen2.fields.no_gudang.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->no_rak->Visible) { // no_rak ?>
    <div id="r_no_rak"<?= $Page->no_rak->rowAttributes() ?>>
        <label id="elh_filing_dokumen2_no_rak" for="x_no_rak" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_rak->caption() ?><?= $Page->no_rak->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->no_rak->cellAttributes() ?>>
<span id="el_filing_dokumen2_no_rak">
<input type="<?= $Page->no_rak->getInputTextType() ?>" name="x_no_rak" id="x_no_rak" data-table="filing_dokumen2" data-field="x_no_rak" value="<?= $Page->no_rak->EditValue ?>" size="30" maxlength="4" placeholder="<?= HtmlEncode($Page->no_rak->getPlaceHolder()) ?>"<?= $Page->no_rak->editAttributes() ?> aria-describedby="x_no_rak_help">
<?= $Page->no_rak->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_rak->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->file->Visible) { // file ?>
    <div id="r_file"<?= $Page->file->rowAttributes() ?>>
        <label id="elh_filing_dokumen2_file" class="<?= $Page->LeftColumnClass ?>"><?= $Page->file->caption() ?><?= $Page->file->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->file->cellAttributes() ?>>
<span id="el_filing_dokumen2_file">
<div id="fd_x_file" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->file->title() ?>" data-table="filing_dokumen2" data-field="x_file" name="x_file" id="x_file" lang="<?= CurrentLanguageID() ?>"<?= $Page->file->editAttributes() ?> aria-describedby="x_file_help"<?= ($Page->file->ReadOnly || $Page->file->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->file->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->file->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_file" id= "fn_x_file" value="<?= $Page->file->Upload->FileName ?>">
<input type="hidden" name="fa_x_file" id= "fa_x_file" value="<?= (Post("fa_x_file") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_file" id= "fs_x_file" value="255">
<input type="hidden" name="fx_x_file" id= "fx_x_file" value="<?= $Page->file->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_file" id= "fm_x_file" value="<?= $Page->file->UploadMaxFileSize ?>">
<table id="ft_x_file" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->masa_berlaku->Visible) { // masa_berlaku ?>
    <div id="r_masa_berlaku"<?= $Page->masa_berlaku->rowAttributes() ?>>
        <label id="elh_filing_dokumen2_masa_berlaku" for="x_masa_berlaku" class="<?= $Page->LeftColumnClass ?>"><?= $Page->masa_berlaku->caption() ?><?= $Page->masa_berlaku->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->masa_berlaku->cellAttributes() ?>>
<span id="el_filing_dokumen2_masa_berlaku">
    <select
        id="x_masa_berlaku"
        name="x_masa_berlaku"
        class="form-select ew-select<?= $Page->masa_berlaku->isInvalidClass() ?>"
        data-select2-id="ffiling_dokumen2edit_x_masa_berlaku"
        data-table="filing_dokumen2"
        data-field="x_masa_berlaku"
        data-value-separator="<?= $Page->masa_berlaku->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->masa_berlaku->getPlaceHolder()) ?>"
        <?= $Page->masa_berlaku->editAttributes() ?>>
        <?= $Page->masa_berlaku->selectOptionListHtml("x_masa_berlaku") ?>
    </select>
    <?= $Page->masa_berlaku->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->masa_berlaku->getErrorMessage() ?></div>
<?= $Page->masa_berlaku->Lookup->getParamTag($Page, "p_x_masa_berlaku") ?>
<script>
loadjs.ready("ffiling_dokumen2edit", function() {
    var options = { name: "x_masa_berlaku", selectId: "ffiling_dokumen2edit_x_masa_berlaku" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (ffiling_dokumen2edit.lists.masa_berlaku.lookupOptions.length) {
        options.data = { id: "x_masa_berlaku", form: "ffiling_dokumen2edit" };
    } else {
        options.ajax = { id: "x_masa_berlaku", form: "ffiling_dokumen2edit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.filing_dokumen2.fields.masa_berlaku.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="filing_dokumen2" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .row -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("filing_dokumen2");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
