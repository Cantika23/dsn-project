<?php

namespace Mitral2022\DSN2;

// Page object
$PaketKeluar2Summary = &$Page;
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { PaketKeluar2: currentTable } });
var currentForm, currentPageID;
var fPaketKeluar2srch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fPaketKeluar2srch = new ew.Form("fPaketKeluar2srch", "summary");
    currentSearchForm = fPaketKeluar2srch;
    currentPageID = ew.PAGE_ID = "summary";

    // Add fields
    var fields = currentTable.fields;
    fPaketKeluar2srch.addFields([
        ["nopaketnodkumen", [], fields.nopaketnodkumen.isInvalid],
        ["jenis_dokumen", [], fields.jenis_dokumen.isInvalid],
        ["created_date", [], fields.created_date.isInvalid]
    ]);

    // Validate form
    fPaketKeluar2srch.validate = function () {
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
    fPaketKeluar2srch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fPaketKeluar2srch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fPaketKeluar2srch.lists.id = <?= $Page->id->toClientList($Page) ?>;
    fPaketKeluar2srch.lists.nopaketnodkumen = <?= $Page->nopaketnodkumen->toClientList($Page) ?>;
    fPaketKeluar2srch.lists.no_dokumen = <?= $Page->no_dokumen->toClientList($Page) ?>;
    fPaketKeluar2srch.lists.no_paket = <?= $Page->no_paket->toClientList($Page) ?>;
    fPaketKeluar2srch.lists.jenis_dokumen = <?= $Page->jenis_dokumen->toClientList($Page) ?>;
    fPaketKeluar2srch.lists.tujuan_penerima = <?= $Page->tujuan_penerima->toClientList($Page) ?>;
    fPaketKeluar2srch.lists.no_hp_penerima = <?= $Page->no_hp_penerima->toClientList($Page) ?>;
    fPaketKeluar2srch.lists.email_penerima = <?= $Page->email_penerima->toClientList($Page) ?>;
    fPaketKeluar2srch.lists.status = <?= $Page->status->toClientList($Page) ?>;
    fPaketKeluar2srch.lists.tanggal_terima = <?= $Page->tanggal_terima->toClientList($Page) ?>;
    fPaketKeluar2srch.lists.jenis_pengirim = <?= $Page->jenis_pengirim->toClientList($Page) ?>;
    fPaketKeluar2srch.lists.nama_kurir = <?= $Page->nama_kurir->toClientList($Page) ?>;
    fPaketKeluar2srch.lists.no_awb = <?= $Page->no_awb->toClientList($Page) ?>;
    fPaketKeluar2srch.lists.bukti_penerimaan = <?= $Page->bukti_penerimaan->toClientList($Page) ?>;
    fPaketKeluar2srch.lists.nama_penerima = <?= $Page->nama_penerima->toClientList($Page) ?>;
    fPaketKeluar2srch.lists.id_user = <?= $Page->id_user->toClientList($Page) ?>;
    fPaketKeluar2srch.lists.created_date = <?= $Page->created_date->toClientList($Page) ?>;

    // Filters
    fPaketKeluar2srch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fPaketKeluar2srch");
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
<form name="fPaketKeluar2srch" id="fPaketKeluar2srch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fPaketKeluar2srch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="PaketKeluar2">
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
            data-select2-id="fPaketKeluar2srch_x_id"
            data-table="PaketKeluar2"
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
        loadjs.ready("fPaketKeluar2srch", function() {
            var options = {
                name: "x_id",
                selectId: "fPaketKeluar2srch_x_id",
                ajax: { id: "x_id", form: "fPaketKeluar2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.PaketKeluar2.fields.id.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->nopaketnodkumen->Visible) { // nopaketnodkumen ?>
<?php
if (!$Page->nopaketnodkumen->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_nopaketnodkumen" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->nopaketnodkumen->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_nopaketnodkumen"
            name="x_nopaketnodkumen[]"
            class="form-control ew-select<?= $Page->nopaketnodkumen->isInvalidClass() ?>"
            data-select2-id="fPaketKeluar2srch_x_nopaketnodkumen"
            data-table="PaketKeluar2"
            data-field="x_nopaketnodkumen"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->nopaketnodkumen->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->nopaketnodkumen->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->nopaketnodkumen->getPlaceHolder()) ?>"
            <?= $Page->nopaketnodkumen->editAttributes() ?>>
            <?= $Page->nopaketnodkumen->selectOptionListHtml("x_nopaketnodkumen", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->nopaketnodkumen->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fPaketKeluar2srch", function() {
            var options = {
                name: "x_nopaketnodkumen",
                selectId: "fPaketKeluar2srch_x_nopaketnodkumen",
                ajax: { id: "x_nopaketnodkumen", form: "fPaketKeluar2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.PaketKeluar2.fields.nopaketnodkumen.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->no_dokumen->Visible) { // no_dokumen ?>
<?php
if (!$Page->no_dokumen->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_no_dokumen" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->no_dokumen->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_no_dokumen"
            name="x_no_dokumen[]"
            class="form-control ew-select<?= $Page->no_dokumen->isInvalidClass() ?>"
            data-select2-id="fPaketKeluar2srch_x_no_dokumen"
            data-table="PaketKeluar2"
            data-field="x_no_dokumen"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->no_dokumen->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->no_dokumen->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->no_dokumen->getPlaceHolder()) ?>"
            <?= $Page->no_dokumen->editAttributes() ?>>
            <?= $Page->no_dokumen->selectOptionListHtml("x_no_dokumen", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->no_dokumen->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fPaketKeluar2srch", function() {
            var options = {
                name: "x_no_dokumen",
                selectId: "fPaketKeluar2srch_x_no_dokumen",
                ajax: { id: "x_no_dokumen", form: "fPaketKeluar2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.PaketKeluar2.fields.no_dokumen.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->no_paket->Visible) { // no_paket ?>
<?php
if (!$Page->no_paket->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_no_paket" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->no_paket->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_no_paket"
            name="x_no_paket[]"
            class="form-control ew-select<?= $Page->no_paket->isInvalidClass() ?>"
            data-select2-id="fPaketKeluar2srch_x_no_paket"
            data-table="PaketKeluar2"
            data-field="x_no_paket"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->no_paket->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->no_paket->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->no_paket->getPlaceHolder()) ?>"
            <?= $Page->no_paket->editAttributes() ?>>
            <?= $Page->no_paket->selectOptionListHtml("x_no_paket", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->no_paket->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fPaketKeluar2srch", function() {
            var options = {
                name: "x_no_paket",
                selectId: "fPaketKeluar2srch_x_no_paket",
                ajax: { id: "x_no_paket", form: "fPaketKeluar2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.PaketKeluar2.fields.no_paket.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->jenis_dokumen->Visible) { // jenis_dokumen ?>
<?php
if (!$Page->jenis_dokumen->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_jenis_dokumen" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->jenis_dokumen->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_jenis_dokumen"
            name="x_jenis_dokumen[]"
            class="form-control ew-select<?= $Page->jenis_dokumen->isInvalidClass() ?>"
            data-select2-id="fPaketKeluar2srch_x_jenis_dokumen"
            data-table="PaketKeluar2"
            data-field="x_jenis_dokumen"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->jenis_dokumen->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->jenis_dokumen->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->jenis_dokumen->getPlaceHolder()) ?>"
            <?= $Page->jenis_dokumen->editAttributes() ?>>
            <?= $Page->jenis_dokumen->selectOptionListHtml("x_jenis_dokumen", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->jenis_dokumen->getErrorMessage() ?></div>
        <?= $Page->jenis_dokumen->Lookup->getParamTag($Page, "p_x_jenis_dokumen") ?>
        <script>
        loadjs.ready("fPaketKeluar2srch", function() {
            var options = {
                name: "x_jenis_dokumen",
                selectId: "fPaketKeluar2srch_x_jenis_dokumen",
                ajax: { id: "x_jenis_dokumen", form: "fPaketKeluar2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.PaketKeluar2.fields.jenis_dokumen.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->tujuan_penerima->Visible) { // tujuan_penerima ?>
<?php
if (!$Page->tujuan_penerima->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_tujuan_penerima" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->tujuan_penerima->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_tujuan_penerima"
            name="x_tujuan_penerima[]"
            class="form-control ew-select<?= $Page->tujuan_penerima->isInvalidClass() ?>"
            data-select2-id="fPaketKeluar2srch_x_tujuan_penerima"
            data-table="PaketKeluar2"
            data-field="x_tujuan_penerima"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->tujuan_penerima->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->tujuan_penerima->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->tujuan_penerima->getPlaceHolder()) ?>"
            <?= $Page->tujuan_penerima->editAttributes() ?>>
            <?= $Page->tujuan_penerima->selectOptionListHtml("x_tujuan_penerima", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->tujuan_penerima->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fPaketKeluar2srch", function() {
            var options = {
                name: "x_tujuan_penerima",
                selectId: "fPaketKeluar2srch_x_tujuan_penerima",
                ajax: { id: "x_tujuan_penerima", form: "fPaketKeluar2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.PaketKeluar2.fields.tujuan_penerima.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->no_hp_penerima->Visible) { // no_hp_penerima ?>
<?php
if (!$Page->no_hp_penerima->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_no_hp_penerima" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->no_hp_penerima->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_no_hp_penerima"
            name="x_no_hp_penerima[]"
            class="form-control ew-select<?= $Page->no_hp_penerima->isInvalidClass() ?>"
            data-select2-id="fPaketKeluar2srch_x_no_hp_penerima"
            data-table="PaketKeluar2"
            data-field="x_no_hp_penerima"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->no_hp_penerima->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->no_hp_penerima->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->no_hp_penerima->getPlaceHolder()) ?>"
            <?= $Page->no_hp_penerima->editAttributes() ?>>
            <?= $Page->no_hp_penerima->selectOptionListHtml("x_no_hp_penerima", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->no_hp_penerima->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fPaketKeluar2srch", function() {
            var options = {
                name: "x_no_hp_penerima",
                selectId: "fPaketKeluar2srch_x_no_hp_penerima",
                ajax: { id: "x_no_hp_penerima", form: "fPaketKeluar2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.PaketKeluar2.fields.no_hp_penerima.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->email_penerima->Visible) { // email_penerima ?>
<?php
if (!$Page->email_penerima->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_email_penerima" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->email_penerima->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_email_penerima"
            name="x_email_penerima[]"
            class="form-control ew-select<?= $Page->email_penerima->isInvalidClass() ?>"
            data-select2-id="fPaketKeluar2srch_x_email_penerima"
            data-table="PaketKeluar2"
            data-field="x_email_penerima"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->email_penerima->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->email_penerima->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->email_penerima->getPlaceHolder()) ?>"
            <?= $Page->email_penerima->editAttributes() ?>>
            <?= $Page->email_penerima->selectOptionListHtml("x_email_penerima", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->email_penerima->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fPaketKeluar2srch", function() {
            var options = {
                name: "x_email_penerima",
                selectId: "fPaketKeluar2srch_x_email_penerima",
                ajax: { id: "x_email_penerima", form: "fPaketKeluar2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.PaketKeluar2.fields.email_penerima.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
<?php
if (!$Page->status->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_status" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->status->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_status"
            name="x_status[]"
            class="form-control ew-select<?= $Page->status->isInvalidClass() ?>"
            data-select2-id="fPaketKeluar2srch_x_status"
            data-table="PaketKeluar2"
            data-field="x_status"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->status->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->status->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>"
            <?= $Page->status->editAttributes() ?>>
            <?= $Page->status->selectOptionListHtml("x_status", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fPaketKeluar2srch", function() {
            var options = {
                name: "x_status",
                selectId: "fPaketKeluar2srch_x_status",
                ajax: { id: "x_status", form: "fPaketKeluar2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.PaketKeluar2.fields.status.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->tanggal_terima->Visible) { // tanggal_terima ?>
<?php
if (!$Page->tanggal_terima->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_tanggal_terima" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->tanggal_terima->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_tanggal_terima"
            name="x_tanggal_terima[]"
            class="form-control ew-select<?= $Page->tanggal_terima->isInvalidClass() ?>"
            data-select2-id="fPaketKeluar2srch_x_tanggal_terima"
            data-table="PaketKeluar2"
            data-field="x_tanggal_terima"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->tanggal_terima->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->tanggal_terima->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->tanggal_terima->getPlaceHolder()) ?>"
            <?= $Page->tanggal_terima->editAttributes() ?>>
            <?= $Page->tanggal_terima->selectOptionListHtml("x_tanggal_terima", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->tanggal_terima->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fPaketKeluar2srch", function() {
            var options = {
                name: "x_tanggal_terima",
                selectId: "fPaketKeluar2srch_x_tanggal_terima",
                ajax: { id: "x_tanggal_terima", form: "fPaketKeluar2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.PaketKeluar2.fields.tanggal_terima.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->jenis_pengirim->Visible) { // jenis_pengirim ?>
<?php
if (!$Page->jenis_pengirim->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_jenis_pengirim" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->jenis_pengirim->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_jenis_pengirim"
            name="x_jenis_pengirim[]"
            class="form-control ew-select<?= $Page->jenis_pengirim->isInvalidClass() ?>"
            data-select2-id="fPaketKeluar2srch_x_jenis_pengirim"
            data-table="PaketKeluar2"
            data-field="x_jenis_pengirim"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->jenis_pengirim->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->jenis_pengirim->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->jenis_pengirim->getPlaceHolder()) ?>"
            <?= $Page->jenis_pengirim->editAttributes() ?>>
            <?= $Page->jenis_pengirim->selectOptionListHtml("x_jenis_pengirim", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->jenis_pengirim->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fPaketKeluar2srch", function() {
            var options = {
                name: "x_jenis_pengirim",
                selectId: "fPaketKeluar2srch_x_jenis_pengirim",
                ajax: { id: "x_jenis_pengirim", form: "fPaketKeluar2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.PaketKeluar2.fields.jenis_pengirim.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->nama_kurir->Visible) { // nama_kurir ?>
<?php
if (!$Page->nama_kurir->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_nama_kurir" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->nama_kurir->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_nama_kurir"
            name="x_nama_kurir[]"
            class="form-control ew-select<?= $Page->nama_kurir->isInvalidClass() ?>"
            data-select2-id="fPaketKeluar2srch_x_nama_kurir"
            data-table="PaketKeluar2"
            data-field="x_nama_kurir"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->nama_kurir->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->nama_kurir->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->nama_kurir->getPlaceHolder()) ?>"
            <?= $Page->nama_kurir->editAttributes() ?>>
            <?= $Page->nama_kurir->selectOptionListHtml("x_nama_kurir", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->nama_kurir->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fPaketKeluar2srch", function() {
            var options = {
                name: "x_nama_kurir",
                selectId: "fPaketKeluar2srch_x_nama_kurir",
                ajax: { id: "x_nama_kurir", form: "fPaketKeluar2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.PaketKeluar2.fields.nama_kurir.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->no_awb->Visible) { // no_awb ?>
<?php
if (!$Page->no_awb->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_no_awb" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->no_awb->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_no_awb"
            name="x_no_awb[]"
            class="form-control ew-select<?= $Page->no_awb->isInvalidClass() ?>"
            data-select2-id="fPaketKeluar2srch_x_no_awb"
            data-table="PaketKeluar2"
            data-field="x_no_awb"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->no_awb->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->no_awb->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->no_awb->getPlaceHolder()) ?>"
            <?= $Page->no_awb->editAttributes() ?>>
            <?= $Page->no_awb->selectOptionListHtml("x_no_awb", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->no_awb->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fPaketKeluar2srch", function() {
            var options = {
                name: "x_no_awb",
                selectId: "fPaketKeluar2srch_x_no_awb",
                ajax: { id: "x_no_awb", form: "fPaketKeluar2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.PaketKeluar2.fields.no_awb.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->bukti_penerimaan->Visible) { // bukti_penerimaan ?>
<?php
if (!$Page->bukti_penerimaan->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_bukti_penerimaan" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->bukti_penerimaan->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_bukti_penerimaan"
            name="x_bukti_penerimaan[]"
            class="form-control ew-select<?= $Page->bukti_penerimaan->isInvalidClass() ?>"
            data-select2-id="fPaketKeluar2srch_x_bukti_penerimaan"
            data-table="PaketKeluar2"
            data-field="x_bukti_penerimaan"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->bukti_penerimaan->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->bukti_penerimaan->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->bukti_penerimaan->getPlaceHolder()) ?>"
            <?= $Page->bukti_penerimaan->editAttributes() ?>>
            <?= $Page->bukti_penerimaan->selectOptionListHtml("x_bukti_penerimaan", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->bukti_penerimaan->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fPaketKeluar2srch", function() {
            var options = {
                name: "x_bukti_penerimaan",
                selectId: "fPaketKeluar2srch_x_bukti_penerimaan",
                ajax: { id: "x_bukti_penerimaan", form: "fPaketKeluar2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.PaketKeluar2.fields.bukti_penerimaan.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->nama_penerima->Visible) { // nama_penerima ?>
<?php
if (!$Page->nama_penerima->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_nama_penerima" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->nama_penerima->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_nama_penerima"
            name="x_nama_penerima[]"
            class="form-control ew-select<?= $Page->nama_penerima->isInvalidClass() ?>"
            data-select2-id="fPaketKeluar2srch_x_nama_penerima"
            data-table="PaketKeluar2"
            data-field="x_nama_penerima"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->nama_penerima->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->nama_penerima->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->nama_penerima->getPlaceHolder()) ?>"
            <?= $Page->nama_penerima->editAttributes() ?>>
            <?= $Page->nama_penerima->selectOptionListHtml("x_nama_penerima", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->nama_penerima->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fPaketKeluar2srch", function() {
            var options = {
                name: "x_nama_penerima",
                selectId: "fPaketKeluar2srch_x_nama_penerima",
                ajax: { id: "x_nama_penerima", form: "fPaketKeluar2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.PaketKeluar2.fields.nama_penerima.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->id_user->Visible) { // id_user ?>
<?php
if (!$Page->id_user->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_id_user" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->id_user->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_id_user"
            name="x_id_user[]"
            class="form-control ew-select<?= $Page->id_user->isInvalidClass() ?>"
            data-select2-id="fPaketKeluar2srch_x_id_user"
            data-table="PaketKeluar2"
            data-field="x_id_user"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->id_user->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->id_user->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->id_user->getPlaceHolder()) ?>"
            <?= $Page->id_user->editAttributes() ?>>
            <?= $Page->id_user->selectOptionListHtml("x_id_user", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->id_user->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fPaketKeluar2srch", function() {
            var options = {
                name: "x_id_user",
                selectId: "fPaketKeluar2srch_x_id_user",
                ajax: { id: "x_id_user", form: "fPaketKeluar2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.PaketKeluar2.fields.id_user.filterOptions);
            ew.createFilter(options);
        });
        </script>
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->created_date->Visible) { // created_date ?>
<?php
if (!$Page->created_date->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_created_date" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->created_date->UseFilter ? " ew-filter-field" : "" ?>">
        <select
            id="x_created_date"
            name="x_created_date[]"
            class="form-control ew-select<?= $Page->created_date->isInvalidClass() ?>"
            data-select2-id="fPaketKeluar2srch_x_created_date"
            data-table="PaketKeluar2"
            data-field="x_created_date"
            data-caption="<?= HtmlEncode(RemoveHtml($Page->created_date->caption())) ?>"
            data-filter="true"
            multiple
            size="1"
            data-value-separator="<?= $Page->created_date->displayValueSeparatorAttribute() ?>"
            data-placeholder="<?= HtmlEncode($Page->created_date->getPlaceHolder()) ?>"
            <?= $Page->created_date->editAttributes() ?>>
            <?= $Page->created_date->selectOptionListHtml("x_created_date", true) ?>
        </select>
        <div class="invalid-feedback"><?= $Page->created_date->getErrorMessage() ?></div>
        <script>
        loadjs.ready("fPaketKeluar2srch", function() {
            var options = {
                name: "x_created_date",
                selectId: "fPaketKeluar2srch_x_created_date",
                ajax: { id: "x_created_date", form: "fPaketKeluar2srch", limit: ew.FILTER_PAGE_SIZE, data: { ajax: "filter" } }
            };
            options = Object.assign({}, ew.filterOptions, options, ew.vars.tables.PaketKeluar2.fields.created_date.filterOptions);
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
<div id="gmp_PaketKeluar2" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="<?= $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
    <tr class="ew-table-header">
<?php if ($Page->nopaketnodkumen->Visible) { ?>
    <th data-name="nopaketnodkumen" class="<?= $Page->nopaketnodkumen->headerCellClass() ?>"><div class="PaketKeluar2_nopaketnodkumen"><?= $Page->renderFieldHeader($Page->nopaketnodkumen) ?></div></th>
<?php } ?>
<?php if ($Page->jenis_dokumen->Visible) { ?>
    <th data-name="jenis_dokumen" class="<?= $Page->jenis_dokumen->headerCellClass() ?>"><div class="PaketKeluar2_jenis_dokumen"><?= $Page->renderFieldHeader($Page->jenis_dokumen) ?></div></th>
<?php } ?>
<?php if ($Page->created_date->Visible) { ?>
    <th data-name="created_date" class="<?= $Page->created_date->headerCellClass() ?>"><div class="PaketKeluar2_created_date"><?= $Page->renderFieldHeader($Page->created_date) ?></div></th>
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
<?php if ($Page->nopaketnodkumen->Visible) { ?>
        <td data-field="nopaketnodkumen"<?= $Page->nopaketnodkumen->cellAttributes() ?>>
<span<?= $Page->nopaketnodkumen->viewAttributes() ?>>
<?= $Page->nopaketnodkumen->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->jenis_dokumen->Visible) { ?>
        <td data-field="jenis_dokumen"<?= $Page->jenis_dokumen->cellAttributes() ?>>
<span<?= $Page->jenis_dokumen->viewAttributes() ?>>
<?= $Page->jenis_dokumen->getViewValue() ?></span>
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
        $Page->PaketKeluar->PageBreakType = "before"; // Page break type
        $Page->PaketKeluar->PageBreak = $Page->ExportChartPageBreak;
        $Page->PaketKeluar->PageBreakContent = $Page->PageBreakContent;
    }

    // Set up chart drilldown
    $Page->PaketKeluar->DrillDownInPanel = $Page->DrillDownInPanel;
    $Page->PaketKeluar->render("ew-chart-bottom");
}
?>
<?php if (!$DashboardReport && !$Page->isExport("email") && !$Page->DrillDown && $Page->PaketKeluar->hasData()) { ?>
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
