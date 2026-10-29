<?php

namespace Mitral2022\DSN2;

// Page object
$KodepenyimpananboxSummary = &$Page;
?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { kodepenyimpananbox: currentTable } });
var currentForm, currentPageID;
var fkodepenyimpananboxsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fkodepenyimpananboxsrch = new ew.Form("fkodepenyimpananboxsrch", "summary");
    currentSearchForm = fkodepenyimpananboxsrch;
    currentPageID = ew.PAGE_ID = "summary";

    // Add fields
    var fields = currentTable.fields;
    fkodepenyimpananboxsrch.addFields([
        ["kode", [], fields.kode.isInvalid],
        ["kode_box", [], fields.kode_box.isInvalid]
    ]);

    // Validate form
    fkodepenyimpananboxsrch.validate = function () {
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
    fkodepenyimpananboxsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fkodepenyimpananboxsrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fkodepenyimpananboxsrch.lists.kode = <?= $Page->kode->toClientList($Page) ?>;

    // Filters
    fkodepenyimpananboxsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fkodepenyimpananboxsrch");
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
<form name="fkodepenyimpananboxsrch" id="fkodepenyimpananboxsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fkodepenyimpananboxsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="kodepenyimpananbox">
<div class="ew-extended-search container-fluid">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->kode->Visible) { // kode ?>
<?php
if (!$Page->kode->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_kode" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->kode->UseFilter ? " ew-filter-field" : "" ?>">
        <div class="d-flex my-1 my-sm-0">
            <label for="x_kode" class="ew-search-caption ew-label"><?= $Page->kode->caption() ?></label>
        </div>
        <div id="el_kodepenyimpananbox_kode" class="ew-search-field">
    <select
        id="x_kode"
        name="x_kode"
        class="form-select ew-select<?= $Page->kode->isInvalidClass() ?>"
        data-select2-id="fkodepenyimpananboxsrch_x_kode"
        data-table="kodepenyimpananbox"
        data-field="x_kode"
        data-value-separator="<?= $Page->kode->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->kode->getPlaceHolder()) ?>"
        <?= $Page->kode->editAttributes() ?>>
        <?= $Page->kode->selectOptionListHtml("x_kode") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->kode->getErrorMessage() ?></div>
<?= $Page->kode->Lookup->getParamTag($Page, "p_x_kode") ?>
<script>
loadjs.ready("fkodepenyimpananboxsrch", function() {
    var options = { name: "x_kode", selectId: "fkodepenyimpananboxsrch_x_kode" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fkodepenyimpananboxsrch.lists.kode.lookupOptions.length) {
        options.data = { id: "x_kode", form: "fkodepenyimpananboxsrch" };
    } else {
        options.ajax = { id: "x_kode", form: "fkodepenyimpananboxsrch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.kodepenyimpananbox.fields.kode.selectOptions);
    ew.createSelect(options);
});
</script>
</div>
        <div class="d-flex my-1 my-sm-0">
        </div><!-- /.ew-search-field -->
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
while ($Page->GroupCount <= count($Page->GroupRecords) && $Page->GroupCount <= $Page->DisplayGroups) {
?>
<?php
    // Show header
    if ($Page->ShowHeader) {
?>
<?php if ($Page->GroupCount > 1) { ?>
</tbody>
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
<?= $Page->PageBreakContent ?>
<?php } ?>
<div class="<?php if (!$Page->isExport("word") && !$Page->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?= $Page->ReportTableStyle ?>>
<!-- Report grid (begin) -->
<div id="gmp_kodepenyimpananbox" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="<?= $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
    <tr class="ew-table-header">
<?php if ($Page->kode->Visible) { ?>
    <?php if ($Page->kode->ShowGroupHeaderAsRow) { ?>
    <th data-name="kode">&nbsp;</th>
    <?php } else { ?>
    <th data-name="kode" class="<?= $Page->kode->headerCellClass() ?>"><div class="kodepenyimpananbox_kode"><?= $Page->renderFieldHeader($Page->kode) ?></div></th>
    <?php } ?>
<?php } ?>
<?php if ($Page->kode_box->Visible) { ?>
    <?php if ($Page->kode_box->ShowGroupHeaderAsRow) { ?>
    <th data-name="kode_box">&nbsp;</th>
    <?php } else { ?>
    <th data-name="kode_box" class="<?= $Page->kode_box->headerCellClass() ?>"><div class="kodepenyimpananbox_kode_box"><?= $Page->renderFieldHeader($Page->kode_box) ?></div></th>
    <?php } ?>
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

    // Build detail SQL
    $where = DetailFilterSql($Page->kode, $Page->getSqlFirstGroupField(), $Page->kode->groupValue(), $Page->Dbid);
    if ($Page->PageFirstGroupFilter != "") {
        $Page->PageFirstGroupFilter .= " OR ";
    }
    $Page->PageFirstGroupFilter .= $where;
    if ($Page->Filter != "") {
        $where = "($Page->Filter) AND ($where)";
    }
    $sql = $Page->buildReportSql($Page->getSqlSelect(), $Page->getSqlFrom(), $Page->getSqlWhere(), $Page->getSqlGroupBy(), $Page->getSqlHaving(), $Page->getSqlOrderBy(), $where, $Page->Sort);
    $rs = $sql->execute();
    $Page->DetailRecords = $rs ? $rs->fetchAll() : [];
    $Page->DetailRecordCount = count($Page->DetailRecords);

    // Load detail records
    $Page->kode->Records = &$Page->DetailRecords;
    $Page->kode->LevelBreak = true; // Set field level break
        $Page->GroupCounter[1] = $Page->GroupCount;
        $Page->kode->getCnt($Page->kode->Records); // Get record count
?>
<?php if ($Page->kode->Visible && $Page->kode->ShowGroupHeaderAsRow) { ?>
<?php
        // Render header row
        $Page->resetAttributes();
        $Page->RowType = ROWTYPE_TOTAL;
        $Page->RowTotalType = ROWTOTAL_GROUP;
        $Page->RowTotalSubType = ROWTOTAL_HEADER;
        $Page->RowGroupLevel = 1;
        $Page->renderRow();
?>
    <tr<?= $Page->rowAttributes(); ?>>
<?php if ($Page->kode->Visible) { ?>
        <?php $Page->kode->CellAttrs->appendClass("ew-rpt-grp-caret"); ?>
        <td data-field="kode"<?= $Page->kode->cellAttributes(); ?>><i class="ew-group-toggle fas fa-caret-down"></i></td>
        <?php $Page->kode->CellAttrs->removeClass("ew-rpt-grp-caret"); ?>
<?php } ?>
        <td data-field="kode" colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>"<?= $Page->kode->cellAttributes() ?>>
            <span class="ew-summary-caption kodepenyimpananbox_kode"><?= $Page->renderFieldHeader($Page->kode) ?></span><?= $Language->phrase("SummaryColon") ?><span<?= $Page->kode->viewAttributes() ?>><?= $Page->kode->GroupViewValue ?></span>
            <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?= $Language->phrase("RptCnt") ?></span><?= $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?= FormatNumber($Page->kode->Count, Config("DEFAULT_NUMBER_FORMAT")) ?></span>)</span>
        </td>
    </tr>
<?php } ?>
<?php
    $Page->kode_box->getDistinctValues($Page->kode->Records);
    $Page->setGroupCount(count($Page->kode_box->DistinctValues), $Page->GroupCounter[1]);
    $Page->GroupCounter[2] = 0; // Init group count index
    foreach ($Page->kode_box->DistinctValues as $kode_box) { // Load records for this distinct value
        $Page->kode_box->setGroupValue($kode_box); // Set group value
        $Page->kode_box->getDistinctRecords($Page->kode->Records, $Page->kode_box->groupValue());
        $Page->kode_box->LevelBreak = true; // Set field level break
        $Page->GroupCounter[2]++;
        $Page->kode_box->getCnt($Page->kode_box->Records); // Get record count
        $Page->setGroupCount($Page->kode_box->Count, $Page->GroupCounter[1], $Page->GroupCounter[2]);
?>
<?php if ($Page->kode_box->Visible && $Page->kode_box->ShowGroupHeaderAsRow) { ?>
<?php
        // Render header row
        $Page->kode_box->setDbValue($kode_box); // Set current value for kode_box
        $Page->resetAttributes();
        $Page->RowType = ROWTYPE_TOTAL;
        $Page->RowTotalType = ROWTOTAL_GROUP;
        $Page->RowTotalSubType = ROWTOTAL_HEADER;
        $Page->RowGroupLevel = 2;
        $Page->renderRow();
?>
    <tr<?= $Page->rowAttributes(); ?>>
<?php if ($Page->kode->Visible) { ?>
        <td data-field="kode"<?= $Page->kode->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Page->kode_box->Visible) { ?>
        <?php $Page->kode_box->CellAttrs->appendClass("ew-rpt-grp-caret"); ?>
        <td data-field="kode_box"<?= $Page->kode_box->cellAttributes(); ?>><i class="ew-group-toggle fas fa-caret-down"></i></td>
        <?php $Page->kode_box->CellAttrs->removeClass("ew-rpt-grp-caret"); ?>
<?php } ?>
        <td data-field="kode_box" colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount - 2) ?>"<?= $Page->kode_box->cellAttributes() ?>>
            <span class="ew-summary-caption kodepenyimpananbox_kode_box"><?= $Page->renderFieldHeader($Page->kode_box) ?></span><?= $Language->phrase("SummaryColon") ?><span<?= $Page->kode_box->viewAttributes() ?>><?= $Page->kode_box->GroupViewValue ?></span>
            <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?= $Language->phrase("RptCnt") ?></span><?= $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?= FormatNumber($Page->kode_box->Count, Config("DEFAULT_NUMBER_FORMAT")) ?></span>)</span>
        </td>
    </tr>
<?php } ?>
<?php
        $Page->RecordCount = 0; // Reset record count
        foreach ($Page->kode_box->Records as $record) {
            $Page->RecordCount++;
            $Page->RecordIndex++;
            $Page->loadRowValues($record);
?>
<?php
    }
    } // End group level 1
?>
<?php if ($Page->TotalGroups > 0) { ?>
<?php
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_TOTAL;
    $Page->RowTotalType = ROWTOTAL_GROUP;
    $Page->RowTotalSubType = ROWTOTAL_FOOTER;
    $Page->RowGroupLevel = 1;
    $Page->renderRow();
?>
<?php if ($Page->kode->ShowCompactSummaryFooter) { ?>
    <?php if (!$Page->kode->ShowGroupHeaderAsRow) { ?>
    <tr<?= $Page->rowAttributes(); ?>>
<?php if ($Page->kode->Visible) { ?>
    <?php if ($Page->kode->ShowGroupHeaderAsRow) { ?>
        <td data-field="kode"<?= $Page->kode->cellAttributes() ?>></td>
    <?php } elseif ($Page->RowGroupLevel != 1) { ?>
        <td data-field="kode"<?= $Page->kode->cellAttributes() ?>>
            <span<?= $Page->kode->viewAttributes() ?>><?= $Page->kode->GroupViewValue ?></span>
        </td>
    <?php } else { ?>
        <td data-field="kode"<?= $Page->kode->cellAttributes() ?>>
            <span class="ew-summary-count"><span class="ew-aggregate-caption"><?= $Language->phrase("RptCnt") ?></span><?= $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?= FormatNumber($Page->kode->Count, Config("DEFAULT_NUMBER_FORMAT")) ?></span></span>
        </td>
    <?php } ?>
<?php } ?>
<?php if ($Page->kode_box->Visible) { ?>
    <?php if ($Page->kode_box->ShowGroupHeaderAsRow) { ?>
        <td data-field="kode_box"<?= $Page->kode->cellAttributes() ?>></td>
    <?php } elseif ($Page->RowGroupLevel != 2) { ?>
        <td data-field="kode_box"<?= $Page->kode->cellAttributes() ?>>
            <span<?= $Page->kode_box->viewAttributes() ?>><?= $Page->kode_box->GroupViewValue ?></span>
        </td>
    <?php } else { ?>
        <td data-field="kode_box"<?= $Page->kode->cellAttributes() ?>>
            <span class="ew-summary-count"><span<?= $Page->kode_box->viewAttributes() ?>><?= $Page->kode_box->GroupViewValue ?></span>&nbsp;(<span class="ew-aggregate-caption"><?= $Language->phrase("RptCnt") ?></span><?= $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?= FormatNumber($Page->kode_box->Count, Config("DEFAULT_NUMBER_FORMAT")) ?></span>)</span>
        </td>
    <?php } ?>
<?php } ?>
    </tr>
    <?php } ?>
<?php } else { ?>
    <tr<?= $Page->rowAttributes(); ?>>
<?php if ($Page->GroupColumnCount + $Page->DetailColumnCount > 0) { ?>
        <td colspan="<?= ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"<?= $Page->kode->cellAttributes() ?>><?= str_replace(["%v", "%c"], [$Page->kode->GroupViewValue, $Page->kode->caption()], $Language->phrase("RptSumHead")) ?> <span class="ew-dir-ltr">(<?= FormatNumber($Page->kode->Count, Config("DEFAULT_NUMBER_FORMAT")) ?><?= $Language->phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
    </tr>
<?php } ?>
<?php } ?>
<?php
?>
<?php

    // Next group
    $Page->loadGroupRowValues();

    // Show header if page break
    if ($Page->isExport()) {
        $Page->ShowHeader = ($Page->ExportPageBreakCount == 0) ? false : ($Page->GroupCount % $Page->ExportPageBreakCount == 0);
    }

    // Page_Breaking server event
    if ($Page->ShowHeader) {
        $Page->pageBreaking($Page->ShowHeader, $Page->PageBreakContent);
    }
    $Page->GroupCount++;
} // End while
?>
<?php if ($Page->TotalGroups > 0) { ?>
</tbody>
<tfoot>
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
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("fixedheadertable", function () {
    ew.fixedHeaderTable({
        delay: 0,
        container: "gmp_kodepenyimpananbox",
        width: "",
        height: "500px"
    });
});
</script>
<?php } ?>
<?php if (!$Page->isExport() && !$Page->DrillDown && !$DashboardReport) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
