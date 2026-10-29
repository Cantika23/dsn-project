<?php

namespace Mitral2022\DSN2;

// Page object
$FillingDokumenSummary = &$Page;
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { FillingDokumen: currentTable } });
var currentForm, currentPageID;
var fFillingDokumensrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fFillingDokumensrch = new ew.Form("fFillingDokumensrch", "summary");
    currentSearchForm = fFillingDokumensrch;
    currentPageID = ew.PAGE_ID = "summary";

    // Add fields
    var fields = currentTable.fields;
    fFillingDokumensrch.addFields([
        ["nama_dokumen", [], fields.nama_dokumen.isInvalid],
        ["tahun_pembuatan_dokumen", [], fields.tahun_pembuatan_dokumen.isInvalid],
        ["created_date", [], fields.created_date.isInvalid]
    ]);

    // Validate form
    fFillingDokumensrch.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm();

        // Validate fields
        if (!this.validateFields())
            return false;

        // Call Form_CustomValidate event
        if (!this.customValidate(fobj)) {
            this.focus();
            return false;
        }
        return true;
    }

    // Form_CustomValidate
    fFillingDokumensrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fFillingDokumensrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fFillingDokumensrch.lists.id = <?= $Page->id->toClientList($Page) ?>;
    fFillingDokumensrch.lists.kode = <?= $Page->kode->toClientList($Page) ?>;
    fFillingDokumensrch.lists.kode_box = <?= $Page->kode_box->toClientList($Page) ?>;
    fFillingDokumensrch.lists.no_box = <?= $Page->no_box->toClientList($Page) ?>;
    fFillingDokumensrch.lists.kode_pt = <?= $Page->kode_pt->toClientList($Page) ?>;
    fFillingDokumensrch.lists.kode_department = <?= $Page->kode_department->toClientList($Page) ?>;
    fFillingDokumensrch.lists.lokasi = <?= $Page->lokasi->toClientList($Page) ?>;
    fFillingDokumensrch.lists.nama_dokumen = <?= $Page->nama_dokumen->toClientList($Page) ?>;
    fFillingDokumensrch.lists.tahun_pembuatan_dokumen = <?= $Page->tahun_pembuatan_dokumen->toClientList($Page) ?>;
    fFillingDokumensrch.lists.deskripsi = <?= $Page->deskripsi->toClientList($Page) ?>;
    fFillingDokumensrch.lists.no_gudang = <?= $Page->no_gudang->toClientList($Page) ?>;
    fFillingDokumensrch.lists.no_rak = <?= $Page->no_rak->toClientList($Page) ?>;
    fFillingDokumensrch.lists.file = <?= $Page->file->toClientList($Page) ?>;
    fFillingDokumensrch.lists.masa_berlaku = <?= $Page->masa_berlaku->toClientList($Page) ?>;

    // Filters
    fFillingDokumensrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fFillingDokumensrch");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<a id="top"></a>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<?php if ($Page->ShowCurrentFilter) { ?>
<?php $Page->showFilterList() ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Page->DrillDownInPanel) {
    $Page->ExportOptions->render("body");
    $Page->SearchOptions->render("body");
    $Page->FilterOptions->render("body");
}
?>
</div>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?= $Page->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<div id="report_summary">
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction && $Page->hasSearchFields()) { ?>
<form name="fFillingDokumensrch" id="fFillingDokumensrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fFillingDokumensrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="FillingDokumen">
<div class="ew-extended-search container-fluid">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->id->Visible) { // id ?>
<?php
if (!$Page->id->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_id" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->id->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_id"
            name="x_id[]"
            class="form-control ew-select<?= $Page->id->isInvalidClass() ?>"
            data-select2-id="fFillingDokumensrch_x_id"
            data-table="FillingDokumen"
            data-field="x_id"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->id->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->id->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>"
            <?= $Page->id->editAttributes() ?>>
            <?= $Page->id->selectOptionListHtml("x_id", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->id->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fFillingDokumensrch", function() {
            var options = {
                name: "x_id",
                selectId: "fFillingDokumensrch_x_id",
                ajax: { id: "x_id", form: "fFillingDokumensrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.FillingDokumen.fields.id.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->kode->Visible) { // kode ?>
<?php
if (!$Page->kode->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_kode" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->kode->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_kode"
            name="x_kode[]"
            class="form-control ew-select<?= $Page->kode->isInvalidClass() ?>"
            data-select2-id="fFillingDokumensrch_x_kode"
            data-table="FillingDokumen"
            data-field="x_kode"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->kode->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->kode->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->kode->getPlaceHolder()) ?>"
            <?= $Page->kode->editAttributes() ?>>
            <?= $Page->kode->selectOptionListHtml("x_kode", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->kode->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fFillingDokumensrch", function() {
            var options = {
                name: "x_kode",
                selectId: "fFillingDokumensrch_x_kode",
                ajax: { id: "x_kode", form: "fFillingDokumensrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.FillingDokumen.fields.kode.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->kode_box->Visible) { // kode_box ?>
<?php
if (!$Page->kode_box->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_kode_box" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->kode_box->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_kode_box"
            name="x_kode_box[]"
            class="form-control ew-select<?= $Page->kode_box->isInvalidClass() ?>"
            data-select2-id="fFillingDokumensrch_x_kode_box"
            data-table="FillingDokumen"
            data-field="x_kode_box"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->kode_box->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->kode_box->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->kode_box->getPlaceHolder()) ?>"
            <?= $Page->kode_box->editAttributes() ?>>
            <?= $Page->kode_box->selectOptionListHtml("x_kode_box", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->kode_box->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fFillingDokumensrch", function() {
            var options = {
                name: "x_kode_box",
                selectId: "fFillingDokumensrch_x_kode_box",
                ajax: { id: "x_kode_box", form: "fFillingDokumensrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.FillingDokumen.fields.kode_box.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->no_box->Visible) { // no_box ?>
<?php
if (!$Page->no_box->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_no_box" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->no_box->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_no_box"
            name="x_no_box[]"
            class="form-control ew-select<?= $Page->no_box->isInvalidClass() ?>"
            data-select2-id="fFillingDokumensrch_x_no_box"
            data-table="FillingDokumen"
            data-field="x_no_box"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->no_box->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->no_box->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->no_box->getPlaceHolder()) ?>"
            <?= $Page->no_box->editAttributes() ?>>
            <?= $Page->no_box->selectOptionListHtml("x_no_box", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->no_box->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fFillingDokumensrch", function() {
            var options = {
                name: "x_no_box",
                selectId: "fFillingDokumensrch_x_no_box",
                ajax: { id: "x_no_box", form: "fFillingDokumensrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.FillingDokumen.fields.no_box.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->kode_pt->Visible) { // kode_pt ?>
<?php
if (!$Page->kode_pt->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_kode_pt" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->kode_pt->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_kode_pt"
            name="x_kode_pt[]"
            class="form-control ew-select<?= $Page->kode_pt->isInvalidClass() ?>"
            data-select2-id="fFillingDokumensrch_x_kode_pt"
            data-table="FillingDokumen"
            data-field="x_kode_pt"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->kode_pt->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->kode_pt->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->kode_pt->getPlaceHolder()) ?>"
            <?= $Page->kode_pt->editAttributes() ?>>
            <?= $Page->kode_pt->selectOptionListHtml("x_kode_pt", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->kode_pt->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fFillingDokumensrch", function() {
            var options = {
                name: "x_kode_pt",
                selectId: "fFillingDokumensrch_x_kode_pt",
                ajax: { id: "x_kode_pt", form: "fFillingDokumensrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.FillingDokumen.fields.kode_pt.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->kode_department->Visible) { // kode_department ?>
<?php
if (!$Page->kode_department->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_kode_department" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->kode_department->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_kode_department"
            name="x_kode_department[]"
            class="form-control ew-select<?= $Page->kode_department->isInvalidClass() ?>"
            data-select2-id="fFillingDokumensrch_x_kode_department"
            data-table="FillingDokumen"
            data-field="x_kode_department"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->kode_department->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->kode_department->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->kode_department->getPlaceHolder()) ?>"
            <?= $Page->kode_department->editAttributes() ?>>
            <?= $Page->kode_department->selectOptionListHtml("x_kode_department", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->kode_department->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fFillingDokumensrch", function() {
            var options = {
                name: "x_kode_department",
                selectId: "fFillingDokumensrch_x_kode_department",
                ajax: { id: "x_kode_department", form: "fFillingDokumensrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.FillingDokumen.fields.kode_department.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->lokasi->Visible) { // lokasi ?>
<?php
if (!$Page->lokasi->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_lokasi" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->lokasi->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_lokasi"
            name="x_lokasi[]"
            class="form-control ew-select<?= $Page->lokasi->isInvalidClass() ?>"
            data-select2-id="fFillingDokumensrch_x_lokasi"
            data-table="FillingDokumen"
            data-field="x_lokasi"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->lokasi->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->lokasi->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->lokasi->getPlaceHolder()) ?>"
            <?= $Page->lokasi->editAttributes() ?>>
            <?= $Page->lokasi->selectOptionListHtml("x_lokasi", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->lokasi->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fFillingDokumensrch", function() {
            var options = {
                name: "x_lokasi",
                selectId: "fFillingDokumensrch_x_lokasi",
                ajax: { id: "x_lokasi", form: "fFillingDokumensrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.FillingDokumen.fields.lokasi.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->nama_dokumen->Visible) { // nama_dokumen ?>
<?php
if (!$Page->nama_dokumen->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_nama_dokumen" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->nama_dokumen->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_nama_dokumen"
            name="x_nama_dokumen[]"
            class="form-control ew-select<?= $Page->nama_dokumen->isInvalidClass() ?>"
            data-select2-id="fFillingDokumensrch_x_nama_dokumen"
            data-table="FillingDokumen"
            data-field="x_nama_dokumen"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->nama_dokumen->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->nama_dokumen->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->nama_dokumen->getPlaceHolder()) ?>"
            <?= $Page->nama_dokumen->editAttributes() ?>>
            <?= $Page->nama_dokumen->selectOptionListHtml("x_nama_dokumen", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->nama_dokumen->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fFillingDokumensrch", function() {
            var options = {
                name: "x_nama_dokumen",
                selectId: "fFillingDokumensrch_x_nama_dokumen",
                ajax: { id: "x_nama_dokumen", form: "fFillingDokumensrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.FillingDokumen.fields.nama_dokumen.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->tahun_pembuatan_dokumen->Visible) { // tahun_pembuatan_dokumen ?>
<?php
if (!$Page->tahun_pembuatan_dokumen->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_tahun_pembuatan_dokumen" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->tahun_pembuatan_dokumen->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_tahun_pembuatan_dokumen"
            name="x_tahun_pembuatan_dokumen[]"
            class="form-control ew-select<?= $Page->tahun_pembuatan_dokumen->isInvalidClass() ?>"
            data-select2-id="fFillingDokumensrch_x_tahun_pembuatan_dokumen"
            data-table="FillingDokumen"
            data-field="x_tahun_pembuatan_dokumen"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->tahun_pembuatan_dokumen->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->tahun_pembuatan_dokumen->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->tahun_pembuatan_dokumen->getPlaceHolder()) ?>"
            <?= $Page->tahun_pembuatan_dokumen->editAttributes() ?>>
            <?= $Page->tahun_pembuatan_dokumen->selectOptionListHtml("x_tahun_pembuatan_dokumen", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->tahun_pembuatan_dokumen->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fFillingDokumensrch", function() {
            var options = {
                name: "x_tahun_pembuatan_dokumen",
                selectId: "fFillingDokumensrch_x_tahun_pembuatan_dokumen",
                ajax: { id: "x_tahun_pembuatan_dokumen", form: "fFillingDokumensrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.FillingDokumen.fields.tahun_pembuatan_dokumen.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->deskripsi->Visible) { // deskripsi ?>
<?php
if (!$Page->deskripsi->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_deskripsi" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->deskripsi->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_deskripsi"
            name="x_deskripsi[]"
            class="form-control ew-select<?= $Page->deskripsi->isInvalidClass() ?>"
            data-select2-id="fFillingDokumensrch_x_deskripsi"
            data-table="FillingDokumen"
            data-field="x_deskripsi"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->deskripsi->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->deskripsi->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->deskripsi->getPlaceHolder()) ?>"
            <?= $Page->deskripsi->editAttributes() ?>>
            <?= $Page->deskripsi->selectOptionListHtml("x_deskripsi", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->deskripsi->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fFillingDokumensrch", function() {
            var options = {
                name: "x_deskripsi",
                selectId: "fFillingDokumensrch_x_deskripsi",
                ajax: { id: "x_deskripsi", form: "fFillingDokumensrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.FillingDokumen.fields.deskripsi.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->no_gudang->Visible) { // no_gudang ?>
<?php
if (!$Page->no_gudang->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_no_gudang" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->no_gudang->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_no_gudang"
            name="x_no_gudang[]"
            class="form-control ew-select<?= $Page->no_gudang->isInvalidClass() ?>"
            data-select2-id="fFillingDokumensrch_x_no_gudang"
            data-table="FillingDokumen"
            data-field="x_no_gudang"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->no_gudang->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->no_gudang->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->no_gudang->getPlaceHolder()) ?>"
            <?= $Page->no_gudang->editAttributes() ?>>
            <?= $Page->no_gudang->selectOptionListHtml("x_no_gudang", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->no_gudang->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fFillingDokumensrch", function() {
            var options = {
                name: "x_no_gudang",
                selectId: "fFillingDokumensrch_x_no_gudang",
                ajax: { id: "x_no_gudang", form: "fFillingDokumensrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.FillingDokumen.fields.no_gudang.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->no_rak->Visible) { // no_rak ?>
<?php
if (!$Page->no_rak->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_no_rak" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->no_rak->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_no_rak"
            name="x_no_rak[]"
            class="form-control ew-select<?= $Page->no_rak->isInvalidClass() ?>"
            data-select2-id="fFillingDokumensrch_x_no_rak"
            data-table="FillingDokumen"
            data-field="x_no_rak"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->no_rak->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->no_rak->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->no_rak->getPlaceHolder()) ?>"
            <?= $Page->no_rak->editAttributes() ?>>
            <?= $Page->no_rak->selectOptionListHtml("x_no_rak", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->no_rak->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fFillingDokumensrch", function() {
            var options = {
                name: "x_no_rak",
                selectId: "fFillingDokumensrch_x_no_rak",
                ajax: { id: "x_no_rak", form: "fFillingDokumensrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.FillingDokumen.fields.no_rak.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->file->Visible) { // file ?>
<?php
if (!$Page->file->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_file" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->file->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_file"
            name="x_file[]"
            class="form-control ew-select<?= $Page->file->isInvalidClass() ?>"
            data-select2-id="fFillingDokumensrch_x_file"
            data-table="FillingDokumen"
            data-field="x_file"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->file->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->file->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->file->getPlaceHolder()) ?>"
            <?= $Page->file->editAttributes() ?>>
            <?= $Page->file->selectOptionListHtml("x_file", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->file->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fFillingDokumensrch", function() {
            var options = {
                name: "x_file",
                selectId: "fFillingDokumensrch_x_file",
                ajax: { id: "x_file", form: "fFillingDokumensrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.FillingDokumen.fields.file.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->masa_berlaku->Visible) { // masa_berlaku ?>
<?php
if (!$Page->masa_berlaku->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_masa_berlaku" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->masa_berlaku->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_masa_berlaku"
            name="x_masa_berlaku[]"
            class="form-control ew-select<?= $Page->masa_berlaku->isInvalidClass() ?>"
            data-select2-id="fFillingDokumensrch_x_masa_berlaku"
            data-table="FillingDokumen"
            data-field="x_masa_berlaku"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->masa_berlaku->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->masa_berlaku->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->masa_berlaku->getPlaceHolder()) ?>"
            <?= $Page->masa_berlaku->editAttributes() ?>>
            <?= $Page->masa_berlaku->selectOptionListHtml("x_masa_berlaku", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->masa_berlaku->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fFillingDokumensrch", function() {
            var options = {
                name: "x_masa_berlaku",
                selectId: "fFillingDokumensrch_x_masa_berlaku",
                ajax: { id: "x_masa_berlaku", form: "fFillingDokumensrch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.FillingDokumen.fields.masa_berlaku.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->SearchColumnCount > 0) { ?>
   <div class="col-sm-auto mb-3">
       <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
   </div>
<?php } ?>
</div><!-- /.row -->
</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php } ?>
<?php
while ($Page->RecordCount < count($Page->DetailRecords) && $Page->RecordCount < $Page->DisplayGroups) {
?>
<?php
    // Show header
    if ($Page->ShowHeader) {
?>
<div class="<?php if (!$Page->isExport("word") && !$Page->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?= $Page->ReportTableStyle ?>>
<!-- Report grid (begin) -->
<div id="gmp_FillingDokumen" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="<?= $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
    <tr class="ew-table-header">
<?php if ($Page->nama_dokumen->Visible) { ?>
    <th data-name="nama_dokumen" class="<?= $Page->nama_dokumen->headerCellClass() ?>"><div class="FillingDokumen_nama_dokumen"><?= $Page->renderFieldHeader($Page->nama_dokumen) ?></div></th>
<?php } ?>
<?php if ($Page->tahun_pembuatan_dokumen->Visible) { ?>
    <th data-name="tahun_pembuatan_dokumen" class="<?= $Page->tahun_pembuatan_dokumen->headerCellClass() ?>"><div class="FillingDokumen_tahun_pembuatan_dokumen"><?= $Page->renderFieldHeader($Page->tahun_pembuatan_dokumen) ?></div></th>
<?php } ?>
<?php if ($Page->created_date->Visible) { ?>
    <th data-name="created_date" class="<?= $Page->created_date->headerCellClass() ?>"><div class="FillingDokumen_created_date"><?= $Page->renderFieldHeader($Page->created_date) ?></div></th>
<?php } ?>
    </tr>
</thead>
<tbody>
<?php
        if ($Page->TotalGroups == 0) {
            break; // Show header only
        }
        $Page->ShowHeader = false;
    } // End show header
?>
<?php
    $Page->loadRowValues($Page->DetailRecords[$Page->RecordCount]);
    $Page->RecordCount++;
    $Page->RecordIndex++;
?>
<?php
        // Render detail row
        $Page->resetAttributes();
        $Page->RowType = ROWTYPE_DETAIL;
        $Page->renderRow();
?>
    <tr<?= $Page->rowAttributes(); ?>>
<?php if ($Page->nama_dokumen->Visible) { ?>
        <td data-field="nama_dokumen"<?= $Page->nama_dokumen->cellAttributes() ?>>
<span<?= $Page->nama_dokumen->viewAttributes() ?>>
<?= $Page->nama_dokumen->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->tahun_pembuatan_dokumen->Visible) { ?>
        <td data-field="tahun_pembuatan_dokumen"<?= $Page->tahun_pembuatan_dokumen->cellAttributes() ?>>
<span<?= $Page->tahun_pembuatan_dokumen->viewAttributes() ?>>
<?= $Page->tahun_pembuatan_dokumen->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->created_date->Visible) { ?>
        <td data-field="created_date"<?= $Page->created_date->cellAttributes() ?>>
<span<?= $Page->created_date->viewAttributes() ?>>
<?= $Page->created_date->getViewValue() ?></span>
</td>
<?php } ?>
    </tr>
<?php
} // End while
?>
<?php if ($Page->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_TOTAL;
    $Page->RowTotalType = ROWTOTAL_GRAND;
    $Page->RowTotalSubType = ROWTOTAL_FOOTER;
    $Page->RowAttrs["class"] = "ew-rpt-grand-summary";
    $Page->renderRow();
?>
<?php if ($Page->ShowCompactSummaryFooter) { ?>
    <tr<?= $Page->rowAttributes() ?>><td colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?= $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?= $Language->phrase("RptCnt") ?></span><?= $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?= FormatNumber($Page->TotalCount, Config("DEFAULT_NUMBER_FORMAT")) ?></span>)</span></td></tr>
<?php } else { ?>
    <tr<?= $Page->rowAttributes() ?>><td colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?= $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?= FormatNumber($Page->TotalCount, Config("DEFAULT_NUMBER_FORMAT")) ?><?= $Language->phrase("RptDtlRec") ?>)</span></td></tr>
<?php } ?>
</tfoot>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if (!$Page->isExport() && !($Page->DrillDown && $Page->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
</div>
<?php } ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
</div>
<!-- /#report-summary -->
<!-- Summary report (end) -->
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
<!-- Bottom Container -->
<div class="row">
    <div id="ew-bottom" class="<?= $Page->BottomContentClass ?>">
<?php } ?>
<?php
if (!$DashboardReport) {
    // Set up page break
    if (($Page->isExport("print") || $Page->isExport("pdf") || $Page->isExport("email") || $Page->isExport("excel") && Config("USE_PHPEXCEL") || $Page->isExport("word") && Config("USE_PHPWORD")) && $Page->ExportChartPageBreak) {
        // Page_Breaking server event
        $Page->pageBreaking($Page->ExportChartPageBreak, $Page->PageBreakContent);

        // Set up chart page break
        $Page->FillingDokumen->PageBreakType = "before"; // Page break type
        $Page->FillingDokumen->PageBreak = $Page->ExportChartPageBreak;
        $Page->FillingDokumen->PageBreakContent = $Page->PageBreakContent;
    }

    // Set up chart drilldown
    $Page->FillingDokumen->DrillDownInPanel = $Page->DrillDownInPanel;
    $Page->FillingDokumen->render("ew-chart-bottom");
}
?>
<?php if (!$DashboardReport && !$Page->isExport("email") && !$Page->DrillDown && $Page->FillingDokumen->hasData()) { ?>
<?php if (!$Page->isExport()) { ?>
<div class="mb-3"><a class="ew-top-link" data-ew-action="scroll-top"><?= $Language->phrase("Top") ?></a></div>
<?php } ?>
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
    </div>
</div>
<!-- /#ew-bottom -->
<?php } ?>
<?php if ((!$Page->isExport() || $Page->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
