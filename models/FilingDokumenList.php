<?php

namespace Mitral2022\DSN2;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class FilingDokumenList extends FilingDokumen
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'filing_dokumen';

    // Page object name
    public $PageObjName = "FilingDokumenList";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "ffiling_dokumenlist";
    public $FormActionName = "k_action";
    public $FormBlankRowName = "k_blankrow";
    public $FormKeyCountName = "key_count";

    // Page URLs
    public $AddUrl;
    public $EditUrl;
    public $CopyUrl;
    public $DeleteUrl;
    public $ViewUrl;
    public $ListUrl;

    // Update URLs
    public $InlineAddUrl;
    public $InlineCopyUrl;
    public $InlineEditUrl;
    public $GridAddUrl;
    public $GridEditUrl;
    public $MultiDeleteUrl;
    public $MultiUpdateUrl;

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page layout
    public $UseLayout = true;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl($withArgs = true)
    {
        $route = GetRoute();
        $args = $route->getArguments();
        if (!$withArgs) {
            foreach ($args as $key => &$val) {
                $val = "";
            }
            unset($val);
        }
        $url = rtrim(UrlFor($route->getName(), $args), "/") . "?";
        if ($this->UseTokenInUrl) {
            $url .= "t=" . $this->TableVar . "&"; // Add page token
        }
        return $url;
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<p id="ew-page-header">' . $header . '</p>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<p id="ew-page-footer">' . $footer . '</p>';
        }
    }

    // Validate page request
    protected function isPageRequest()
    {
        global $CurrentForm;
        if ($this->UseTokenInUrl) {
            if ($CurrentForm) {
                return $this->TableVar == $CurrentForm->getValue("t");
            }
            if (Get("t") !== null) {
                return $this->TableVar == Get("t");
            }
        }
        return true;
    }

    // Constructor
    public function __construct()
    {
        global $Language, $DashboardReport, $DebugTimer;
        global $UserTable;

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Parent constuctor
        parent::__construct();

        // Table object (filing_dokumen)
        if (!isset($GLOBALS["filing_dokumen"]) || get_class($GLOBALS["filing_dokumen"]) == PROJECT_NAMESPACE . "filing_dokumen") {
            $GLOBALS["filing_dokumen"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl(false);

        // Initialize URLs
        $this->AddUrl = "filingdokumenadd";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiDeleteUrl = "filingdokumendelete";
        $this->MultiUpdateUrl = "filingdokumenupdate";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'filing_dokumen');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // User table object
        $UserTable = Container("usertable");

        // List options
        $this->ListOptions = new ListOptions(["Tag" => "td", "TableVar" => $this->TableVar]);

        // Export options
        $this->ExportOptions = new ListOptions(["TagClassName" => "ew-export-option"]);

        // Import options
        $this->ImportOptions = new ListOptions(["TagClassName" => "ew-import-option"]);

        // Other options
        if (!$this->OtherOptions) {
            $this->OtherOptions = new ListOptionsArray();
        }

        // Grid-Add/Edit
        $this->OtherOptions["addedit"] = new ListOptions([
            "TagClassName" => "ew-add-edit-option",
            "UseDropDownButton" => false,
            "DropDownButtonPhrase" => $Language->phrase("ButtonAddEdit"),
            "UseButtonGroup" => true
        ]);

        // Detail tables
        $this->OtherOptions["detail"] = new ListOptions(["TagClassName" => "ew-detail-option"]);
        // Actions
        $this->OtherOptions["action"] = new ListOptions(["TagClassName" => "ew-action-option"]);

        // Column visibility
        $this->OtherOptions["column"] = new ListOptions([
            "TableVar" => $this->TableVar,
            "TagClassName" => "ew-column-option",
            "ButtonGroupClass" => "ew-column-dropdown",
            "UseDropDownButton" => true,
            "DropDownButtonPhrase" => $Language->phrase("Columns"),
            "DropDownAutoClose" => "outside",
            "UseButtonGroup" => false
        ]);

        // Filter options
        $this->FilterOptions = new ListOptions(["TagClassName" => "ew-filter-option"]);

        // List actions
        $this->ListActions = new ListActions();
    }

    // Get content from stream
    public function getContents($stream = null): string
    {
        global $Response;
        return is_object($Response) ? $Response->getBody() : ob_get_clean();
    }

    // Is lookup
    public function isLookup()
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup()
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $ExportFileName, $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

        // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }

        // Global Page Unloaded event (in userfn*.php)
        Page_Unloaded();

        // Export
        if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
            $content = $this->getContents();
            if ($ExportFileName == "") {
                $ExportFileName = $this->TableVar;
            }
            $class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
            if (class_exists($class)) {
                $tbl = Container("filing_dokumen");
                $doc = new $class($tbl);
                $doc->Text = @$content;
                if ($this->isExport("email")) {
                    echo $this->exportEmail($doc->Text);
                } else {
                    $doc->export();
                }
                DeleteTempImages(); // Delete temp images
                return;
            }
        }
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show error
                WriteJson(array_merge(["success" => false], $this->getMessages()));
            }
            return;
        } else { // Check if response is JSON
            if (StartsString("application/json", $Response->getHeaderLine("Content-type")) && $Response->getBody()->getSize()) { // With JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }
            SaveDebugMessage();
            Redirect(GetUrl($url));
        }
        return; // Return to controller
    }

    // Get records from recordset
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Recordset
            while ($rs && !$rs->EOF) {
                $this->loadRowValues($rs); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($rs->fields);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
                $rs->moveNext();
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray($ar)
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DATATYPE_BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        if ($fld->DataType == DATATYPE_MEMO && $fld->MemoMaxLength > 0) {
                            $val = TruncateMemo($val, $fld->MemoMaxLength, $fld->TruncateMemoRemoveHtml);
                        }
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue($ar)
    {
        $key = "";
        if (is_array($ar)) {
            $key .= @$ar['id'];
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit()
    {
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->id->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->created_date->Visible = false;
        }
    }

    // Lookup data
    public function lookup($ar = null)
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = $ar["field"] ?? Post("field");
        $lookup = $this->Fields[$fieldName]->Lookup;

        // Get lookup parameters
        $lookupType = $ar["ajax"] ?? Post("ajax", "unknown");
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal") || SameText($lookupType, "filter")) {
            $searchValue = $ar["q"] ?? Param("q") ?? $ar["sv"] ?? Post("sv", "");
            $pageSize = $ar["n"] ?? Param("n") ?? $ar["recperpage"] ?? Post("recperpage", 10);
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = $ar["q"] ?? Param("q", "");
            $pageSize = $ar["n"] ?? Param("n", -1);
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
        }
        $start = $ar["start"] ?? Param("start", -1);
        $start = is_numeric($start) ? (int)$start : -1;
        $page = $ar["page"] ?? Param("page", -1);
        $page = is_numeric($page) ? (int)$page : -1;
        $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        $userSelect = Decrypt($ar["s"] ?? Post("s", ""));
        $userFilter = Decrypt($ar["f"] ?? Post("f", ""));
        $userOrderBy = Decrypt($ar["o"] ?? Post("o", ""));
        $keys = $ar["keys"] ?? Post("keys");
        $lookup->LookupType = $lookupType; // Lookup type
        $lookup->FilterValues = []; // Clear filter values first
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = $ar["v0"] ?? $ar["lookupValue"] ?? Post("v0", Post("lookupValue", ""));
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = $ar["v" . $i] ?? Post("v" . $i, "");
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        return $lookup->toJson($this, !is_array($ar)); // Use settings from current page
    }

    // Class variables
    public $ListOptions; // List options
    public $ExportOptions; // Export options
    public $SearchOptions; // Search options
    public $OtherOptions; // Other options
    public $FilterOptions; // Filter options
    public $ImportOptions; // Import options
    public $ListActions; // List actions
    public $SelectedCount = 0;
    public $SelectedIndex = 0;
    public $DisplayRecords = 20;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $PageSizes = "10,20,50,-1"; // Page sizes (comma separated)
    public $DefaultSearchWhere = ""; // Default search WHERE clause
    public $SearchWhere = ""; // Search WHERE clause
    public $SearchPanelClass = "ew-search-panel collapse show"; // Search Panel class
    public $SearchColumnCount = 0; // For extended search
    public $SearchFieldsPerRow = 1; // For extended search
    public $RecordCount = 0; // Record count
    public $EditRowCount;
    public $StartRowCount = 1;
    public $RowCount = 0;
    public $Attrs = []; // Row attributes and cell attributes
    public $RowIndex = 0; // Row index
    public $KeyCount = 0; // Key count
    public $MultiColumnGridClass = "row-cols-md";
    public $MultiColumnEditClass = "col-12 w-100";
    public $MultiColumnCardClass = "card h-100 ew-card";
    public $MultiColumnListOptionsPosition = "bottom-start";
    public $DbMasterFilter = ""; // Master filter
    public $DbDetailFilter = ""; // Detail filter
    public $MasterRecordExists;
    public $MultiSelectKey;
    public $Command;
    public $UserAction; // User action
    public $RestoreSearch = false;
    public $HashValue; // Hash value
    public $DetailPages;
    public $OldRecordset;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm;

        // Multi column button position
        $this->MultiColumnListOptionsPosition = Config("MULTI_COLUMN_LIST_OPTIONS_POSITION");

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param("layout", true));

        // Get export parameters
        $custom = "";
        if (Param("export") !== null) {
            $this->Export = Param("export");
            $custom = Param("custom", "");
        } elseif (IsPost()) {
            if (Post("exporttype") !== null) {
                $this->Export = Post("exporttype");
            }
            $custom = Post("custom", "");
        } elseif (Get("cmd") == "json") {
            $this->Export = Get("cmd");
        } else {
            $this->setExportReturnUrl(CurrentUrl());
        }
        $ExportFileName = $this->TableVar; // Get export file, used in header

        // Get custom export parameters
        if ($this->isExport() && $custom != "") {
            $this->CustomExport = $this->Export;
            $this->Export = "print";
        }
        $CustomExportType = $this->CustomExport;
        $ExportType = $this->Export; // Get export parameter, used in header
        $this->CurrentAction = Param("action"); // Set up current action

        // Get grid add count
        $gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
        if (is_numeric($gridaddcnt) && $gridaddcnt > 0) {
            $this->GridAddRowCount = $gridaddcnt;
        }

        // Set up list options
        $this->setupListOptions();

        // Setup export options
        $this->setupExportOptions();
        $this->no_box->setVisibility();
        $this->kode_pt->setVisibility();
        $this->kode_department->setVisibility();
        $this->lokasi->setVisibility();
        $this->nama_dokumen->setVisibility();
        $this->tahun_pembuatan_dokumen->setVisibility();
        $this->deskripsi->setVisibility();
        $this->id->setVisibility();
        $this->no_gudang->setVisibility();
        $this->no_rak->setVisibility();
        $this->file->setVisibility();
        $this->masa_berlaku->setVisibility();
        $this->kode->Visible = false;
        $this->kode_box->Visible = false;
        $this->created_date->Visible = false;
        $this->hideFieldsForAddEdit();

        // Set lookup cache
        if (!in_array($this->PageID, Config("LOOKUP_CACHE_PAGE_IDS"))) {
            $this->setUseLookupCache(false);
        }

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Setup other options
        $this->setupOtherOptions();

        // Set up custom action (compatible with old version)
        foreach ($this->CustomActions as $name => $action) {
            $this->ListActions->add($name, $action);
        }

        // Set up lookup cache
        $this->setupLookupOptions($this->kode_pt);
        $this->setupLookupOptions($this->kode_department);

        // Search filters
        $srchAdvanced = ""; // Advanced search filter
        $srchBasic = ""; // Basic search filter
        $filter = "";

        // Get command
        $this->Command = strtolower(Get("cmd"));
        if ($this->isPageRequest()) {
            // Process list action first
            if ($this->processListAction()) { // Ajax request
                $this->terminate();
                return;
            }

            // Set up records per page
            $this->setupDisplayRecords();

            // Handle reset command
            $this->resetCmd();

            // Set up Breadcrumb
            if (!$this->isExport()) {
                $this->setupBreadcrumb();
            }

            // Hide list options
            if ($this->isExport()) {
                $this->ListOptions->hideAllOptions(["sequence"]);
                $this->ListOptions->UseDropDownButton = false; // Disable drop down button
                $this->ListOptions->UseButtonGroup = false; // Disable button group
            } elseif ($this->isGridAdd() || $this->isGridEdit()) {
                $this->ListOptions->hideAllOptions();
                $this->ListOptions->UseDropDownButton = false; // Disable drop down button
                $this->ListOptions->UseButtonGroup = false; // Disable button group
            }

            // Hide options
            if ($this->isExport() || $this->CurrentAction) {
                $this->ExportOptions->hideAllOptions();
                $this->FilterOptions->hideAllOptions();
                $this->ImportOptions->hideAllOptions();
            }

            // Hide other options
            if ($this->isExport()) {
                $this->OtherOptions->hideAllOptions();
            }

            // Get default search criteria
            AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(true));
            AddFilter($this->DefaultSearchWhere, $this->advancedSearchWhere(true));

            // Get basic search values
            $this->loadBasicSearchValues();

            // Get and validate search values for advanced search
            if (EmptyValue($this->UserAction)) { // Skip if user action
                $this->loadSearchValues();
            }

            // Process filter list
            if ($this->processFilterList()) {
                $this->terminate();
                return;
            }
            if (!$this->validateSearch()) {
                // Nothing to do
            }

            // Restore search parms from Session if not searching / reset / export
            if (($this->isExport() || $this->Command != "search" && $this->Command != "reset" && $this->Command != "resetall") && $this->Command != "json" && $this->checkSearchParms()) {
                $this->restoreSearchParms();
            }

            // Call Recordset SearchValidated event
            $this->recordsetSearchValidated();

            // Set up sorting order
            $this->setupSortOrder();

            // Get basic search criteria
            if (!$this->hasInvalidFields()) {
                $srchBasic = $this->basicSearchWhere();
            }

            // Get search criteria for advanced search
            if (!$this->hasInvalidFields()) {
                $srchAdvanced = $this->advancedSearchWhere();
            }
        }

        // Restore display records
        if ($this->Command != "json" && $this->getRecordsPerPage() != "") {
            $this->DisplayRecords = $this->getRecordsPerPage(); // Restore from Session
        } else {
            $this->DisplayRecords = 20; // Load default
            $this->setRecordsPerPage($this->DisplayRecords); // Save default to Session
        }

        // Load Sorting Order
        if ($this->Command != "json") {
            $this->loadSortOrder();
        }

        // Load search default if no existing search criteria
        if (!$this->checkSearchParms()) {
            // Load basic search from default
            $this->BasicSearch->loadDefault();
            if ($this->BasicSearch->Keyword != "") {
                $srchBasic = $this->basicSearchWhere();
            }

            // Load advanced search from default
            if ($this->loadAdvancedSearchDefault()) {
                $srchAdvanced = $this->advancedSearchWhere();
            }
        }

        // Restore search settings from Session
        if (!$this->hasInvalidFields()) {
            $this->loadAdvancedSearch();
        }

        // Build search criteria
        AddFilter($this->SearchWhere, $srchAdvanced);
        AddFilter($this->SearchWhere, $srchBasic);

        // Call Recordset_Searching event
        $this->recordsetSearching($this->SearchWhere);

        // Save search criteria
        if ($this->Command == "search" && !$this->RestoreSearch) {
            $this->setSearchWhere($this->SearchWhere); // Save to Session
            $this->StartRecord = 1; // Reset start record counter
            $this->setStartRecordNumber($this->StartRecord);
        } elseif ($this->Command != "json") {
            $this->SearchWhere = $this->getSearchWhere();
        }

        // Build filter
        $filter = "";
        if (!$Security->canList()) {
            $filter = "(0=1)"; // Filter all records
        }
        AddFilter($filter, $this->DbDetailFilter);
        AddFilter($filter, $this->SearchWhere);

        // Set up filter
        if ($this->Command == "json") {
            $this->UseSessionForListSql = false; // Do not use session for ListSQL
            $this->CurrentFilter = $filter;
        } else {
            $this->setSessionWhere($filter);
            $this->CurrentFilter = "";
        }

        // Export data only
        if (!$this->CustomExport && in_array($this->Export, array_keys(Config("EXPORT_CLASSES")))) {
            $this->exportData();
            $this->terminate();
            return;
        }
        if ($this->isGridAdd()) {
            $this->CurrentFilter = "0=1";
            $this->StartRecord = 1;
            $this->DisplayRecords = $this->GridAddRowCount;
            $this->TotalRecords = $this->DisplayRecords;
            $this->StopRecord = $this->DisplayRecords;
        } else {
            $this->TotalRecords = $this->listRecordCount();
            $this->StartRecord = 1;
            if ($this->DisplayRecords <= 0 || ($this->isExport() && $this->ExportAll)) { // Display all records
                $this->DisplayRecords = $this->TotalRecords;
            }
            if (!($this->isExport() && $this->ExportAll)) { // Set up start record position
                $this->setupStartRecord();
            }
            $this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);

            // Set no record found message
            if (!$this->CurrentAction && $this->TotalRecords == 0) {
                if (!$Security->canList()) {
                    $this->setWarningMessage(DeniedMessage());
                }
                if ($this->SearchWhere == "0=101") {
                    $this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
                } else {
                    $this->setWarningMessage($Language->phrase("NoRecord"));
                }
            }
        }

        // Set up list action columns
        foreach ($this->ListActions->Items as $listaction) {
            if ($listaction->Allow) {
                if ($listaction->Select == ACTION_MULTIPLE) { // Show checkbox column if multiple action
                    $this->ListOptions["checkbox"]->Visible = true;
                } elseif ($listaction->Select == ACTION_SINGLE) { // Show list action column
                    $this->ListOptions["listactions"]->Visible = true; // Set visible if any list action is allowed
                }
            }
        }

        // Search options
        $this->setupSearchOptions();

        // Set up search panel class
        if ($this->SearchWhere != "") {
            AppendClass($this->SearchPanelClass, "show");
        }

        // Normal return
        if (IsApi()) {
            $rows = $this->getRecordsFromRecordset($this->Recordset);
            $this->Recordset->close();
            WriteJson(["success" => true, $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecords]);
            $this->terminate(true);
            return;
        }

        // Set up pager
        $this->Pager = new PrevNextPager($this->TableVar, $this->StartRecord, $this->getRecordsPerPage(), $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Setup login status
            SetupLoginStatus();

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            Page_Rendering();

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }

            // Render search option
            if (method_exists($this, "renderSearchOptions")) {
                $this->renderSearchOptions();
            }
        }
    }

    // Set up number of records displayed per page
    protected function setupDisplayRecords()
    {
        $wrk = Get(Config("TABLE_REC_PER_PAGE"), "");
        if ($wrk != "") {
            if (is_numeric($wrk)) {
                $this->DisplayRecords = (int)$wrk;
            } else {
                if (SameText($wrk, "all")) { // Display all records
                    $this->DisplayRecords = -1;
                } else {
                    $this->DisplayRecords = 20; // Non-numeric, load default
                }
            }
            $this->setRecordsPerPage($this->DisplayRecords); // Save to Session
            // Reset start position
            $this->StartRecord = 1;
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Build filter for all keys
    protected function buildKeyFilter()
    {
        global $CurrentForm;
        $wrkFilter = "";

        // Update row index and get row key
        $rowindex = 1;
        $CurrentForm->Index = $rowindex;
        $thisKey = strval($CurrentForm->getValue($this->OldKeyName));
        while ($thisKey != "") {
            $this->setKey($thisKey);
            if ($this->OldKey != "") {
                $filter = $this->getRecordFilter();
                if ($wrkFilter != "") {
                    $wrkFilter .= " OR ";
                }
                $wrkFilter .= $filter;
            } else {
                $wrkFilter = "0=1";
                break;
            }

            // Update row index and get row key
            $rowindex++; // Next row
            $CurrentForm->Index = $rowindex;
            $thisKey = strval($CurrentForm->getValue($this->OldKeyName));
        }
        return $wrkFilter;
    }

    // Get list of filters
    public function getFilterList()
    {
        global $UserProfile;

        // Initialize
        $filterList = "";
        $savedFilterList = "";
        $filterList = Concat($filterList, $this->no_box->AdvancedSearch->toJson(), ","); // Field no_box
        $filterList = Concat($filterList, $this->kode_pt->AdvancedSearch->toJson(), ","); // Field kode_pt
        $filterList = Concat($filterList, $this->kode_department->AdvancedSearch->toJson(), ","); // Field kode_department
        $filterList = Concat($filterList, $this->lokasi->AdvancedSearch->toJson(), ","); // Field lokasi
        $filterList = Concat($filterList, $this->nama_dokumen->AdvancedSearch->toJson(), ","); // Field nama_dokumen
        $filterList = Concat($filterList, $this->tahun_pembuatan_dokumen->AdvancedSearch->toJson(), ","); // Field tahun_pembuatan_dokumen
        $filterList = Concat($filterList, $this->deskripsi->AdvancedSearch->toJson(), ","); // Field deskripsi
        $filterList = Concat($filterList, $this->id->AdvancedSearch->toJson(), ","); // Field id
        $filterList = Concat($filterList, $this->no_gudang->AdvancedSearch->toJson(), ","); // Field no_gudang
        $filterList = Concat($filterList, $this->no_rak->AdvancedSearch->toJson(), ","); // Field no_rak
        $filterList = Concat($filterList, $this->file->AdvancedSearch->toJson(), ","); // Field file
        $filterList = Concat($filterList, $this->masa_berlaku->AdvancedSearch->toJson(), ","); // Field masa_berlaku
        $filterList = Concat($filterList, $this->kode->AdvancedSearch->toJson(), ","); // Field kode
        $filterList = Concat($filterList, $this->kode_box->AdvancedSearch->toJson(), ","); // Field kode_box
        $filterList = Concat($filterList, $this->created_date->AdvancedSearch->toJson(), ","); // Field created_date
        if ($this->BasicSearch->Keyword != "") {
            $wrk = "\"" . Config("TABLE_BASIC_SEARCH") . "\":\"" . JsEncode($this->BasicSearch->Keyword) . "\",\"" . Config("TABLE_BASIC_SEARCH_TYPE") . "\":\"" . JsEncode($this->BasicSearch->Type) . "\"";
            $filterList = Concat($filterList, $wrk, ",");
        }

        // Return filter list in JSON
        if ($filterList != "") {
            $filterList = "\"data\":{" . $filterList . "}";
        }
        if ($savedFilterList != "") {
            $filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
        }
        return ($filterList != "") ? "{" . $filterList . "}" : "null";
    }

    // Process filter list
    protected function processFilterList()
    {
        global $UserProfile;
        if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
            $filters = Post("filters");
            $UserProfile->setSearchFilters(CurrentUserName(), "ffiling_dokumensrch", $filters);
            WriteJson([["success" => true]]); // Success
            return true;
        } elseif (Post("cmd") == "resetfilter") {
            $this->restoreFilterList();
        }
        return false;
    }

    // Restore list of filters
    protected function restoreFilterList()
    {
        // Return if not reset filter
        if (Post("cmd") !== "resetfilter") {
            return false;
        }
        $filter = json_decode(Post("filter"), true);
        $this->Command = "search";

        // Field no_box
        $this->no_box->AdvancedSearch->SearchValue = @$filter["x_no_box"];
        $this->no_box->AdvancedSearch->SearchOperator = @$filter["z_no_box"];
        $this->no_box->AdvancedSearch->SearchCondition = @$filter["v_no_box"];
        $this->no_box->AdvancedSearch->SearchValue2 = @$filter["y_no_box"];
        $this->no_box->AdvancedSearch->SearchOperator2 = @$filter["w_no_box"];
        $this->no_box->AdvancedSearch->save();

        // Field kode_pt
        $this->kode_pt->AdvancedSearch->SearchValue = @$filter["x_kode_pt"];
        $this->kode_pt->AdvancedSearch->SearchOperator = @$filter["z_kode_pt"];
        $this->kode_pt->AdvancedSearch->SearchCondition = @$filter["v_kode_pt"];
        $this->kode_pt->AdvancedSearch->SearchValue2 = @$filter["y_kode_pt"];
        $this->kode_pt->AdvancedSearch->SearchOperator2 = @$filter["w_kode_pt"];
        $this->kode_pt->AdvancedSearch->save();

        // Field kode_department
        $this->kode_department->AdvancedSearch->SearchValue = @$filter["x_kode_department"];
        $this->kode_department->AdvancedSearch->SearchOperator = @$filter["z_kode_department"];
        $this->kode_department->AdvancedSearch->SearchCondition = @$filter["v_kode_department"];
        $this->kode_department->AdvancedSearch->SearchValue2 = @$filter["y_kode_department"];
        $this->kode_department->AdvancedSearch->SearchOperator2 = @$filter["w_kode_department"];
        $this->kode_department->AdvancedSearch->save();

        // Field lokasi
        $this->lokasi->AdvancedSearch->SearchValue = @$filter["x_lokasi"];
        $this->lokasi->AdvancedSearch->SearchOperator = @$filter["z_lokasi"];
        $this->lokasi->AdvancedSearch->SearchCondition = @$filter["v_lokasi"];
        $this->lokasi->AdvancedSearch->SearchValue2 = @$filter["y_lokasi"];
        $this->lokasi->AdvancedSearch->SearchOperator2 = @$filter["w_lokasi"];
        $this->lokasi->AdvancedSearch->save();

        // Field nama_dokumen
        $this->nama_dokumen->AdvancedSearch->SearchValue = @$filter["x_nama_dokumen"];
        $this->nama_dokumen->AdvancedSearch->SearchOperator = @$filter["z_nama_dokumen"];
        $this->nama_dokumen->AdvancedSearch->SearchCondition = @$filter["v_nama_dokumen"];
        $this->nama_dokumen->AdvancedSearch->SearchValue2 = @$filter["y_nama_dokumen"];
        $this->nama_dokumen->AdvancedSearch->SearchOperator2 = @$filter["w_nama_dokumen"];
        $this->nama_dokumen->AdvancedSearch->save();

        // Field tahun_pembuatan_dokumen
        $this->tahun_pembuatan_dokumen->AdvancedSearch->SearchValue = @$filter["x_tahun_pembuatan_dokumen"];
        $this->tahun_pembuatan_dokumen->AdvancedSearch->SearchOperator = @$filter["z_tahun_pembuatan_dokumen"];
        $this->tahun_pembuatan_dokumen->AdvancedSearch->SearchCondition = @$filter["v_tahun_pembuatan_dokumen"];
        $this->tahun_pembuatan_dokumen->AdvancedSearch->SearchValue2 = @$filter["y_tahun_pembuatan_dokumen"];
        $this->tahun_pembuatan_dokumen->AdvancedSearch->SearchOperator2 = @$filter["w_tahun_pembuatan_dokumen"];
        $this->tahun_pembuatan_dokumen->AdvancedSearch->save();

        // Field deskripsi
        $this->deskripsi->AdvancedSearch->SearchValue = @$filter["x_deskripsi"];
        $this->deskripsi->AdvancedSearch->SearchOperator = @$filter["z_deskripsi"];
        $this->deskripsi->AdvancedSearch->SearchCondition = @$filter["v_deskripsi"];
        $this->deskripsi->AdvancedSearch->SearchValue2 = @$filter["y_deskripsi"];
        $this->deskripsi->AdvancedSearch->SearchOperator2 = @$filter["w_deskripsi"];
        $this->deskripsi->AdvancedSearch->save();

        // Field id
        $this->id->AdvancedSearch->SearchValue = @$filter["x_id"];
        $this->id->AdvancedSearch->SearchOperator = @$filter["z_id"];
        $this->id->AdvancedSearch->SearchCondition = @$filter["v_id"];
        $this->id->AdvancedSearch->SearchValue2 = @$filter["y_id"];
        $this->id->AdvancedSearch->SearchOperator2 = @$filter["w_id"];
        $this->id->AdvancedSearch->save();

        // Field no_gudang
        $this->no_gudang->AdvancedSearch->SearchValue = @$filter["x_no_gudang"];
        $this->no_gudang->AdvancedSearch->SearchOperator = @$filter["z_no_gudang"];
        $this->no_gudang->AdvancedSearch->SearchCondition = @$filter["v_no_gudang"];
        $this->no_gudang->AdvancedSearch->SearchValue2 = @$filter["y_no_gudang"];
        $this->no_gudang->AdvancedSearch->SearchOperator2 = @$filter["w_no_gudang"];
        $this->no_gudang->AdvancedSearch->save();

        // Field no_rak
        $this->no_rak->AdvancedSearch->SearchValue = @$filter["x_no_rak"];
        $this->no_rak->AdvancedSearch->SearchOperator = @$filter["z_no_rak"];
        $this->no_rak->AdvancedSearch->SearchCondition = @$filter["v_no_rak"];
        $this->no_rak->AdvancedSearch->SearchValue2 = @$filter["y_no_rak"];
        $this->no_rak->AdvancedSearch->SearchOperator2 = @$filter["w_no_rak"];
        $this->no_rak->AdvancedSearch->save();

        // Field file
        $this->file->AdvancedSearch->SearchValue = @$filter["x_file"];
        $this->file->AdvancedSearch->SearchOperator = @$filter["z_file"];
        $this->file->AdvancedSearch->SearchCondition = @$filter["v_file"];
        $this->file->AdvancedSearch->SearchValue2 = @$filter["y_file"];
        $this->file->AdvancedSearch->SearchOperator2 = @$filter["w_file"];
        $this->file->AdvancedSearch->save();

        // Field masa_berlaku
        $this->masa_berlaku->AdvancedSearch->SearchValue = @$filter["x_masa_berlaku"];
        $this->masa_berlaku->AdvancedSearch->SearchOperator = @$filter["z_masa_berlaku"];
        $this->masa_berlaku->AdvancedSearch->SearchCondition = @$filter["v_masa_berlaku"];
        $this->masa_berlaku->AdvancedSearch->SearchValue2 = @$filter["y_masa_berlaku"];
        $this->masa_berlaku->AdvancedSearch->SearchOperator2 = @$filter["w_masa_berlaku"];
        $this->masa_berlaku->AdvancedSearch->save();

        // Field kode
        $this->kode->AdvancedSearch->SearchValue = @$filter["x_kode"];
        $this->kode->AdvancedSearch->SearchOperator = @$filter["z_kode"];
        $this->kode->AdvancedSearch->SearchCondition = @$filter["v_kode"];
        $this->kode->AdvancedSearch->SearchValue2 = @$filter["y_kode"];
        $this->kode->AdvancedSearch->SearchOperator2 = @$filter["w_kode"];
        $this->kode->AdvancedSearch->save();

        // Field kode_box
        $this->kode_box->AdvancedSearch->SearchValue = @$filter["x_kode_box"];
        $this->kode_box->AdvancedSearch->SearchOperator = @$filter["z_kode_box"];
        $this->kode_box->AdvancedSearch->SearchCondition = @$filter["v_kode_box"];
        $this->kode_box->AdvancedSearch->SearchValue2 = @$filter["y_kode_box"];
        $this->kode_box->AdvancedSearch->SearchOperator2 = @$filter["w_kode_box"];
        $this->kode_box->AdvancedSearch->save();

        // Field created_date
        $this->created_date->AdvancedSearch->SearchValue = @$filter["x_created_date"];
        $this->created_date->AdvancedSearch->SearchOperator = @$filter["z_created_date"];
        $this->created_date->AdvancedSearch->SearchCondition = @$filter["v_created_date"];
        $this->created_date->AdvancedSearch->SearchValue2 = @$filter["y_created_date"];
        $this->created_date->AdvancedSearch->SearchOperator2 = @$filter["w_created_date"];
        $this->created_date->AdvancedSearch->save();
        $this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
        $this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
    }

    // Advanced search WHERE clause based on QueryString
    protected function advancedSearchWhere($default = false)
    {
        global $Security;
        $where = "";
        if (!$Security->canSearch()) {
            return "";
        }
        $this->buildSearchSql($where, $this->no_box, $default, true); // no_box
        $this->buildSearchSql($where, $this->kode_pt, $default, true); // kode_pt
        $this->buildSearchSql($where, $this->kode_department, $default, true); // kode_department
        $this->buildSearchSql($where, $this->lokasi, $default, true); // lokasi
        $this->buildSearchSql($where, $this->nama_dokumen, $default, true); // nama_dokumen
        $this->buildSearchSql($where, $this->tahun_pembuatan_dokumen, $default, true); // tahun_pembuatan_dokumen
        $this->buildSearchSql($where, $this->deskripsi, $default, true); // deskripsi
        $this->buildSearchSql($where, $this->id, $default, false); // id
        $this->buildSearchSql($where, $this->no_gudang, $default, true); // no_gudang
        $this->buildSearchSql($where, $this->no_rak, $default, true); // no_rak
        $this->buildSearchSql($where, $this->file, $default, true); // file
        $this->buildSearchSql($where, $this->masa_berlaku, $default, true); // masa_berlaku
        $this->buildSearchSql($where, $this->kode, $default, false); // kode
        $this->buildSearchSql($where, $this->kode_box, $default, false); // kode_box
        $this->buildSearchSql($where, $this->created_date, $default, false); // created_date

        // Set up search parm
        if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
            $this->Command = "search";
        }
        if (!$default && $this->Command == "search") {
            $this->no_box->AdvancedSearch->save(); // no_box
            $this->kode_pt->AdvancedSearch->save(); // kode_pt
            $this->kode_department->AdvancedSearch->save(); // kode_department
            $this->lokasi->AdvancedSearch->save(); // lokasi
            $this->nama_dokumen->AdvancedSearch->save(); // nama_dokumen
            $this->tahun_pembuatan_dokumen->AdvancedSearch->save(); // tahun_pembuatan_dokumen
            $this->deskripsi->AdvancedSearch->save(); // deskripsi
            $this->id->AdvancedSearch->save(); // id
            $this->no_gudang->AdvancedSearch->save(); // no_gudang
            $this->no_rak->AdvancedSearch->save(); // no_rak
            $this->file->AdvancedSearch->save(); // file
            $this->masa_berlaku->AdvancedSearch->save(); // masa_berlaku
            $this->kode->AdvancedSearch->save(); // kode
            $this->kode_box->AdvancedSearch->save(); // kode_box
            $this->created_date->AdvancedSearch->save(); // created_date
        }
        return $where;
    }

    // Build search SQL
    protected function buildSearchSql(&$where, &$fld, $default, $multiValue)
    {
        $fldParm = $fld->Param;
        $fldVal = $default ? $fld->AdvancedSearch->SearchValueDefault : $fld->AdvancedSearch->SearchValue;
        $fldOpr = $default ? $fld->AdvancedSearch->SearchOperatorDefault : $fld->AdvancedSearch->SearchOperator;
        $fldCond = $default ? $fld->AdvancedSearch->SearchConditionDefault : $fld->AdvancedSearch->SearchCondition;
        $fldVal2 = $default ? $fld->AdvancedSearch->SearchValue2Default : $fld->AdvancedSearch->SearchValue2;
        $fldOpr2 = $default ? $fld->AdvancedSearch->SearchOperator2Default : $fld->AdvancedSearch->SearchOperator2;
        $wrk = "";
        if (is_array($fldVal)) {
            $fldVal = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal);
        }
        if (is_array($fldVal2)) {
            $fldVal2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal2);
        }
        $fldOpr = strtoupper(trim($fldOpr));
        if ($fldOpr == "") {
            $fldOpr = "=";
        }
        $fldOpr2 = strtoupper(trim($fldOpr2));
        if ($fldOpr2 == "") {
            $fldOpr2 = "=";
        }
        if (Config("SEARCH_MULTI_VALUE_OPTION") == 1 && !$fld->UseFilter || !IsMultiSearchOperator($fldOpr)) {
            $multiValue = false;
        }
        if ($multiValue) {
            $wrk = $fldVal != "" ? GetMultiSearchSql($fld, $fldOpr, $fldVal, $this->Dbid) : ""; // Field value 1
            $wrk2 = $fldVal2 != "" ? GetMultiSearchSql($fld, $fldOpr2, $fldVal2, $this->Dbid) : ""; // Field value 2
            AddFilter($wrk, $wrk2, $fldCond);
        } else {
            $fldVal = $this->convertSearchValue($fld, $fldVal);
            $fldVal2 = $this->convertSearchValue($fld, $fldVal2);
            $wrk = GetSearchSql($fld, $fldVal, $fldOpr, $fldCond, $fldVal2, $fldOpr2, $this->Dbid);
        }
        if ($this->SearchOption == "AUTO" && in_array($this->BasicSearch->getType(), ["AND", "OR"])) {
            $cond = $this->BasicSearch->getType();
        } else {
            $cond = SameText($this->SearchOption, "OR") ? "OR" : "AND";
        }
        AddFilter($where, $wrk, $cond);
    }

    // Convert search value
    protected function convertSearchValue(&$fld, $fldVal)
    {
        if ($fldVal == Config("NULL_VALUE") || $fldVal == Config("NOT_NULL_VALUE")) {
            return $fldVal;
        }
        $value = $fldVal;
        if ($fld->isBoolean()) {
            if ($fldVal != "") {
                $value = (SameText($fldVal, "1") || SameText($fldVal, "y") || SameText($fldVal, "t")) ? $fld->TrueValue : $fld->FalseValue;
            }
        } elseif ($fld->DataType == DATATYPE_DATE || $fld->DataType == DATATYPE_TIME) {
            if ($fldVal != "") {
                $value = UnFormatDateTime($fldVal, $fld->formatPattern());
            }
        }
        return $value;
    }

    // Return basic search WHERE clause based on search keyword and type
    protected function basicSearchWhere($default = false)
    {
        global $Security;
        $searchStr = "";
        if (!$Security->canSearch()) {
            return "";
        }

        // Fields to search
        $searchFlds = [];
        $searchFlds[] = &$this->no_box;
        $searchFlds[] = &$this->kode_pt;
        $searchFlds[] = &$this->kode_department;
        $searchFlds[] = &$this->lokasi;
        $searchFlds[] = &$this->nama_dokumen;
        $searchFlds[] = &$this->tahun_pembuatan_dokumen;
        $searchFlds[] = &$this->deskripsi;
        $searchFlds[] = &$this->no_gudang;
        $searchFlds[] = &$this->no_rak;
        $searchFlds[] = &$this->file;
        $searchFlds[] = &$this->masa_berlaku;
        $searchKeyword = $default ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
        $searchType = $default ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

        // Get search SQL
        if ($searchKeyword != "") {
            $ar = $this->BasicSearch->keywordList($default);
            $searchStr = GetQuickSearchFilter($searchFlds, $ar, $searchType, Config("BASIC_SEARCH_ANY_FIELDS"), $this->Dbid);
            if (!$default && in_array($this->Command, ["", "reset", "resetall"])) {
                $this->Command = "search";
            }
        }
        if (!$default && $this->Command == "search") {
            $this->BasicSearch->setKeyword($searchKeyword);
            $this->BasicSearch->setType($searchType);
        }
        return $searchStr;
    }

    // Check if search parm exists
    protected function checkSearchParms()
    {
        // Check basic search
        if ($this->BasicSearch->issetSession()) {
            return true;
        }
        if ($this->no_box->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->kode_pt->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->kode_department->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->lokasi->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->nama_dokumen->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->tahun_pembuatan_dokumen->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->deskripsi->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->id->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->no_gudang->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->no_rak->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->file->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->masa_berlaku->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->kode->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->kode_box->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->created_date->AdvancedSearch->issetSession()) {
            return true;
        }
        return false;
    }

    // Clear all search parameters
    protected function resetSearchParms()
    {
        // Clear search WHERE clause
        $this->SearchWhere = "";
        $this->setSearchWhere($this->SearchWhere);

        // Clear basic search parameters
        $this->resetBasicSearchParms();

        // Clear advanced search parameters
        $this->resetAdvancedSearchParms();
    }

    // Load advanced search default values
    protected function loadAdvancedSearchDefault()
    {
        return false;
    }

    // Clear all basic search parameters
    protected function resetBasicSearchParms()
    {
        $this->BasicSearch->unsetSession();
    }

    // Clear all advanced search parameters
    protected function resetAdvancedSearchParms()
    {
        $this->no_box->AdvancedSearch->unsetSession();
        $this->kode_pt->AdvancedSearch->unsetSession();
        $this->kode_department->AdvancedSearch->unsetSession();
        $this->lokasi->AdvancedSearch->unsetSession();
        $this->nama_dokumen->AdvancedSearch->unsetSession();
        $this->tahun_pembuatan_dokumen->AdvancedSearch->unsetSession();
        $this->deskripsi->AdvancedSearch->unsetSession();
        $this->id->AdvancedSearch->unsetSession();
        $this->no_gudang->AdvancedSearch->unsetSession();
        $this->no_rak->AdvancedSearch->unsetSession();
        $this->file->AdvancedSearch->unsetSession();
        $this->masa_berlaku->AdvancedSearch->unsetSession();
        $this->kode->AdvancedSearch->unsetSession();
        $this->kode_box->AdvancedSearch->unsetSession();
        $this->created_date->AdvancedSearch->unsetSession();
    }

    // Restore all search parameters
    protected function restoreSearchParms()
    {
        $this->RestoreSearch = true;

        // Restore basic search values
        $this->BasicSearch->load();

        // Restore advanced search values
        $this->no_box->AdvancedSearch->load();
        $this->kode_pt->AdvancedSearch->load();
        $this->kode_department->AdvancedSearch->load();
        $this->lokasi->AdvancedSearch->load();
        $this->nama_dokumen->AdvancedSearch->load();
        $this->tahun_pembuatan_dokumen->AdvancedSearch->load();
        $this->deskripsi->AdvancedSearch->load();
        $this->id->AdvancedSearch->load();
        $this->no_gudang->AdvancedSearch->load();
        $this->no_rak->AdvancedSearch->load();
        $this->file->AdvancedSearch->load();
        $this->masa_berlaku->AdvancedSearch->load();
        $this->kode->AdvancedSearch->load();
        $this->kode_box->AdvancedSearch->load();
        $this->created_date->AdvancedSearch->load();
    }

    // Set up sort parameters
    protected function setupSortOrder()
    {
        // Check for Ctrl pressed
        $ctrl = Get("ctrl") !== null;

        // Check for "order" parameter
        if (Get("order") !== null) {
            $this->CurrentOrder = Get("order");
            $this->CurrentOrderType = Get("ordertype", "");
            $this->updateSort($this->no_box, $ctrl); // no_box
            $this->updateSort($this->kode_pt, $ctrl); // kode_pt
            $this->updateSort($this->kode_department, $ctrl); // kode_department
            $this->updateSort($this->lokasi, $ctrl); // lokasi
            $this->updateSort($this->nama_dokumen, $ctrl); // nama_dokumen
            $this->updateSort($this->tahun_pembuatan_dokumen, $ctrl); // tahun_pembuatan_dokumen
            $this->updateSort($this->deskripsi, $ctrl); // deskripsi
            $this->updateSort($this->id, $ctrl); // id
            $this->updateSort($this->no_gudang, $ctrl); // no_gudang
            $this->updateSort($this->no_rak, $ctrl); // no_rak
            $this->updateSort($this->file, $ctrl); // file
            $this->updateSort($this->masa_berlaku, $ctrl); // masa_berlaku
            $this->setStartRecordNumber(1); // Reset start position
        }
    }

    // Load sort order parameters
    protected function loadSortOrder()
    {
        $orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
        if ($orderBy == "") {
            $this->DefaultSort = "`id` DESC";
            if ($this->getSqlOrderBy() != "") {
                $useDefaultSort = true;
                if ($this->id->getSort() != "") {
                    $useDefaultSort = false;
                }
                if ($useDefaultSort) {
                    $this->id->setSort("DESC");
                    $orderBy = $this->getSqlOrderBy();
                    $this->setSessionOrderBy($orderBy);
                } else {
                    $this->setSessionOrderBy("");
                }
            }
        }
    }

    // Reset command
    // - cmd=reset (Reset search parameters)
    // - cmd=resetall (Reset search and master/detail parameters)
    // - cmd=resetsort (Reset sort parameters)
    protected function resetCmd()
    {
        // Check if reset command
        if (StartsString("reset", $this->Command)) {
            // Reset search criteria
            if ($this->Command == "reset" || $this->Command == "resetall") {
                $this->resetSearchParms();
            }

            // Reset (clear) sorting order
            if ($this->Command == "resetsort") {
                $orderBy = "";
                $this->setSessionOrderBy($orderBy);
                $this->no_box->setSort("");
                $this->kode_pt->setSort("");
                $this->kode_department->setSort("");
                $this->lokasi->setSort("");
                $this->nama_dokumen->setSort("");
                $this->tahun_pembuatan_dokumen->setSort("");
                $this->deskripsi->setSort("");
                $this->id->setSort("");
                $this->no_gudang->setSort("");
                $this->no_rak->setSort("");
                $this->file->setSort("");
                $this->masa_berlaku->setSort("");
                $this->kode->setSort("");
                $this->kode_box->setSort("");
                $this->created_date->setSort("");
            }

            // Reset start position
            $this->StartRecord = 1;
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Set up list options
    protected function setupListOptions()
    {
        global $Security, $Language;

        // Add group option item ("button")
        $item = &$this->ListOptions->addGroupOption();
        $item->Body = "";
        $item->OnLeft = true;
        $item->Visible = false;

        // "view"
        $item = &$this->ListOptions->add("view");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->canView();
        $item->OnLeft = true;

        // "edit"
        $item = &$this->ListOptions->add("edit");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->canEdit();
        $item->OnLeft = true;

        // "copy"
        $item = &$this->ListOptions->add("copy");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->canAdd();
        $item->OnLeft = true;

        // List actions
        $item = &$this->ListOptions->add("listactions");
        $item->CssClass = "text-nowrap";
        $item->OnLeft = true;
        $item->Visible = false;
        $item->ShowInButtonGroup = false;
        $item->ShowInDropDown = false;

        // "checkbox"
        $item = &$this->ListOptions->add("checkbox");
        $item->Visible = $Security->canDelete();
        $item->OnLeft = true;
        $item->Header = "<div class=\"form-check\"><input type=\"checkbox\" name=\"key\" id=\"key\" class=\"form-check-input\" data-ew-action=\"select-all-keys\"></div>";
        if ($item->OnLeft) {
            $item->moveTo(0);
        }
        $item->ShowInDropDown = false;
        $item->ShowInButtonGroup = false;

        // "sequence"
        $item = &$this->ListOptions->add("sequence");
        $item->CssClass = "text-nowrap";
        $item->Visible = true;
        $item->OnLeft = true; // Always on left
        $item->ShowInDropDown = false;
        $item->ShowInButtonGroup = false;

        // Drop down button for ListOptions
        $this->ListOptions->UseDropDownButton = true;
        $this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
        $this->ListOptions->UseButtonGroup = false;
        if ($this->ListOptions->UseButtonGroup && IsMobile()) {
            $this->ListOptions->UseDropDownButton = true;
        }

        //$this->ListOptions->ButtonClass = ""; // Class for button group

        // Call ListOptions_Load event
        $this->listOptionsLoad();
        $this->setupListOptionsExt();
        $item = $this->ListOptions[$this->ListOptions->GroupOptionName];
        $item->Visible = $this->ListOptions->groupOptionVisible();
    }

    // Set up list options (extensions)
    protected function setupListOptionsExt()
    {
        // Set up list options (to be implemented by extensions)
    }

    // Render list options
    public function renderListOptions()
    {
        global $Security, $Language, $CurrentForm, $UserProfile;
        $this->ListOptions->loadDefault();

        // Call ListOptions_Rendering event
        $this->listOptionsRendering();

        // "sequence"
        $opt = $this->ListOptions["sequence"];
        $opt->Body = FormatSequenceNumber($this->RecordCount);
        $pageUrl = $this->pageUrl(false);
        if ($this->CurrentMode == "view") {
            // "view"
            $opt = $this->ListOptions["view"];
            $viewcaption = HtmlTitle($Language->phrase("ViewLink"));
            if ($Security->canView()) {
                $opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode(GetUrl($this->ViewUrl)) . "\">" . $Language->phrase("ViewLink") . "</a>";
            } else {
                $opt->Body = "";
            }

            // "edit"
            $opt = $this->ListOptions["edit"];
            $editcaption = HtmlTitle($Language->phrase("EditLink"));
            if ($Security->canEdit()) {
                $opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" href=\"" . HtmlEncode(GetUrl($this->EditUrl)) . "\">" . $Language->phrase("EditLink") . "</a>";
            } else {
                $opt->Body = "";
            }

            // "copy"
            $opt = $this->ListOptions["copy"];
            $copycaption = HtmlTitle($Language->phrase("CopyLink"));
            if ($Security->canAdd()) {
                $opt->Body = "<a class=\"ew-row-link ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode(GetUrl($this->CopyUrl)) . "\">" . $Language->phrase("CopyLink") . "</a>";
            } else {
                $opt->Body = "";
            }
        } // End View mode

        // Set up list action buttons
        $opt = $this->ListOptions["listactions"];
        if ($opt && !$this->isExport() && !$this->CurrentAction) {
            $body = "";
            $links = [];
            foreach ($this->ListActions->Items as $listaction) {
                $action = $listaction->Action;
                $allowed = $listaction->Allow;
                if ($listaction->Select == ACTION_SINGLE && $allowed) {
                    $caption = $listaction->Caption;
                    $icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listaction->Icon)) . "\" data-caption=\"" . HtmlTitle($caption) . "\"></i> " : "";
                    $link = "<li><button type=\"button\" class=\"dropdown-item ew-action ew-list-action\" data-caption=\"" . HtmlTitle($caption) . "\" data-ew-action=\"submit\" form=\"ffiling_dokumenlist\" data-key=\"" . $this->keyToJson(true) . "\"" . $listaction->toDataAttrs() . ">" . $icon . $listaction->Caption . "</button></li>";
                    if ($link != "") {
                        $links[] = $link;
                        if ($body == "") { // Setup first button
                            $body = "<button type=\"button\" class=\"btn btn-default ew-action ew-list-action\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" data-ew-action=\"submit\" form=\"ffiling_dokumenlist\" data-key=\"" . $this->keyToJson(true) . "\"" . $listaction->toDataAttrs() . ">" . $icon . $listaction->Caption . "</button>";
                        }
                    }
                }
            }
            if (count($links) > 1) { // More than one buttons, use dropdown
                $body = "<button class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->phrase("ListActionButton")) . "\" data-bs-toggle=\"dropdown\">" . $Language->phrase("ListActionButton") . "</button>";
                $content = "";
                foreach ($links as $link) {
                    $content .= "<li>" . $link . "</li>";
                }
                $body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">" . $content . "</ul>";
                $body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
            }
            if (count($links) > 0) {
                $opt->Body = $body;
            }
        }

        // "checkbox"
        $opt = $this->ListOptions["checkbox"];
        $opt->Body = "<div class=\"form-check\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"form-check-input ew-multi-select\" value=\"" . HtmlEncode($this->id->CurrentValue) . "\" data-ew-action=\"select-key\"></div>";
        $this->renderListOptionsExt();

        // Call ListOptions_Rendered event
        $this->listOptionsRendered();
    }

    // Render list options (extensions)
    protected function renderListOptionsExt()
    {
        // Render list options (to be implemented by extensions)
        global $Security, $Language;
    }

    // Set up other options
    protected function setupOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["addedit"];

        // Add
        $item = &$option->add("add");
        $addcaption = HtmlTitle($Language->phrase("AddLink"));
        $item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode(GetUrl($this->AddUrl)) . "\">" . $Language->phrase("AddLink") . "</a>";
        $item->Visible = $this->AddUrl != "" && $Security->canAdd();
        $option = $options["action"];

        // Add multi delete
        $item = &$option->add("multidelete");
        $item->Body = "<button type=\"button\" class=\"ew-action ew-multi-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteSelectedLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteSelectedLink")) . "\" form=\"ffiling_dokumenlist\" data-ew-action=\"submit\" data-url=\"" . GetUrl($this->MultiDeleteUrl) . "\"data-data='{\"action\":\"show\"}'>" . $Language->phrase("DeleteSelectedLink") . "</button>";
        $item->Visible = $Security->canDelete();

        // Show column list for column visibility
        if ($this->UseColumnVisibility) {
            $option = $this->OtherOptions["column"];
            $item = &$option->addGroupOption();
            $item->Body = "";
            $item->Visible = $this->UseColumnVisibility;
            $option->add("no_box", $this->createColumnOption("no_box"));
            $option->add("kode_pt", $this->createColumnOption("kode_pt"));
            $option->add("kode_department", $this->createColumnOption("kode_department"));
            $option->add("lokasi", $this->createColumnOption("lokasi"));
            $option->add("nama_dokumen", $this->createColumnOption("nama_dokumen"));
            $option->add("tahun_pembuatan_dokumen", $this->createColumnOption("tahun_pembuatan_dokumen"));
            $option->add("deskripsi", $this->createColumnOption("deskripsi"));
            $option->add("id", $this->createColumnOption("id"));
            $option->add("no_gudang", $this->createColumnOption("no_gudang"));
            $option->add("no_rak", $this->createColumnOption("no_rak"));
            $option->add("file", $this->createColumnOption("file"));
            $option->add("masa_berlaku", $this->createColumnOption("masa_berlaku"));
        }

        // Set up options default
        foreach ($options as $name => $option) {
            if ($name != "column") { // Always use dropdown for column
                $option->UseDropDownButton = true;
                $option->UseButtonGroup = true;
            }
            //$option->ButtonClass = ""; // Class for button group
            $item = &$option->addGroupOption();
            $item->Body = "";
            $item->Visible = false;
        }
        $options["addedit"]->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
        $options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
        $options["action"]->DropDownButtonPhrase = $Language->phrase("ButtonActions");

        // Filter button
        $item = &$this->FilterOptions->add("savecurrentfilter");
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"ffiling_dokumensrch\" data-ew-action=\"none\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"ffiling_dokumensrch\" data-ew-action=\"none\">" . $Language->phrase("DeleteFilter") . "</a>";
        $item->Visible = true;
        $this->FilterOptions->UseDropDownButton = true;
        $this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
        $this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

        // Add group option item
        $item = &$this->FilterOptions->addGroupOption();
        $item->Body = "";
        $item->Visible = false;
    }

    // Create new column option
    public function createColumnOption($name)
    {
        $field = $this->Fields[$name] ?? false;
        if ($field && $field->Visible) {
            $item = new ListOption($field->Name);
            $item->Body = '<button class="dropdown-item">' .
                '<div class="form-check ew-dropdown-checkbox">' .
                '<div class="form-check-input ew-dropdown-check-input" data-field="' . $field->Param . '"></div>' .
                '<label class="form-check-label ew-dropdown-check-label">' . $field->caption() . '</label></div></button>';
            return $item;
        }
        return null;
    }

    // Render other options
    public function renderOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["action"];
        // Set up list action buttons
        foreach ($this->ListActions->Items as $listaction) {
            if ($listaction->Select == ACTION_MULTIPLE) {
                $item = &$option->add("custom_" . $listaction->Action);
                $caption = $listaction->Caption;
                $icon = ($listaction->Icon != "") ? '<i class="' . HtmlEncode($listaction->Icon) . '" data-caption="' . HtmlEncode($caption) . '"></i>' . $caption : $caption;
                $item->Body = '<button type="button" class="btn btn-default ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" data-ew-action="submit" form="ffiling_dokumenlist"' . $listaction->toDataAttrs() . '>' . $icon . '</button>';
                $item->Visible = $listaction->Allow;
            }
        }

        // Hide grid edit and other options
        if ($this->TotalRecords <= 0) {
            $option = $options["addedit"];
            $item = $option["gridedit"];
            if ($item) {
                $item->Visible = false;
            }
            $option = $options["action"];
            $option->hideAllOptions();
        }
    }

    // Process list action
    protected function processListAction()
    {
        global $Language, $Security, $Response;
        $userlist = "";
        $user = "";
        $filter = $this->getFilterFromRecordKeys();
        $userAction = Post("useraction", "");
        if ($filter != "" && $userAction != "") {
            // Check permission first
            $actionCaption = $userAction;
            if (array_key_exists($userAction, $this->ListActions->Items)) {
                $actionCaption = $this->ListActions[$userAction]->Caption;
                if (!$this->ListActions[$userAction]->Allow) {
                    $errmsg = str_replace('%s', $actionCaption, $Language->phrase("CustomActionNotAllowed"));
                    if (Post("ajax") == $userAction) { // Ajax
                        echo "<p class=\"text-danger\">" . $errmsg . "</p>";
                        return true;
                    } else {
                        $this->setFailureMessage($errmsg);
                        return false;
                    }
                }
            }
            $this->CurrentFilter = $filter;
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $rs = LoadRecordset($sql, $conn);
            $this->UserAction = $userAction;
            $this->ActionValue = Post("actionvalue");

            // Call row action event
            if ($rs) {
                if ($this->UseTransaction) {
                    $conn->beginTransaction();
                }
                $this->SelectedCount = $rs->recordCount();
                $this->SelectedIndex = 0;
                while (!$rs->EOF) {
                    $this->SelectedIndex++;
                    $row = $rs->fields;
                    $processed = $this->rowCustomAction($userAction, $row);
                    if (!$processed) {
                        break;
                    }
                    $rs->moveNext();
                }
                if ($processed) {
                    if ($this->UseTransaction) { // Commit transaction
                        $conn->commit();
                    }
                    if ($this->getSuccessMessage() == "" && !ob_get_length() && !$Response->getBody()->getSize()) { // No output
                        $this->setSuccessMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionCompleted"))); // Set up success message
                    }
                } else {
                    if ($this->UseTransaction) { // Rollback transaction
                        $conn->rollback();
                    }

                    // Set up error message
                    if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                        // Use the message, do nothing
                    } elseif ($this->CancelMessage != "") {
                        $this->setFailureMessage($this->CancelMessage);
                        $this->CancelMessage = "";
                    } else {
                        $this->setFailureMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionFailed")));
                    }
                }
            }
            if ($rs) {
                $rs->close();
            }
            if (Post("ajax") == $userAction) { // Ajax
                if ($this->getSuccessMessage() != "") {
                    echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
                    $this->clearSuccessMessage(); // Clear message
                }
                if ($this->getFailureMessage() != "") {
                    echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
                    $this->clearFailureMessage(); // Clear message
                }
                return true;
            }
        }
        return false; // Not ajax request
    }

    // Load basic search values
    protected function loadBasicSearchValues()
    {
        $this->BasicSearch->setKeyword(Get(Config("TABLE_BASIC_SEARCH"), ""), false);
        if ($this->BasicSearch->Keyword != "" && $this->Command == "") {
            $this->Command = "search";
        }
        $this->BasicSearch->setType(Get(Config("TABLE_BASIC_SEARCH_TYPE"), ""), false);
    }

    // Load search values for validation
    protected function loadSearchValues()
    {
        // Load search values
        $hasValue = false;

        // no_box
        if ($this->no_box->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->no_box->AdvancedSearch->SearchValue != "" || $this->no_box->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // kode_pt
        if ($this->kode_pt->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->kode_pt->AdvancedSearch->SearchValue != "" || $this->kode_pt->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // kode_department
        if ($this->kode_department->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->kode_department->AdvancedSearch->SearchValue != "" || $this->kode_department->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // lokasi
        if ($this->lokasi->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->lokasi->AdvancedSearch->SearchValue != "" || $this->lokasi->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // nama_dokumen
        if ($this->nama_dokumen->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->nama_dokumen->AdvancedSearch->SearchValue != "" || $this->nama_dokumen->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // tahun_pembuatan_dokumen
        if ($this->tahun_pembuatan_dokumen->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->tahun_pembuatan_dokumen->AdvancedSearch->SearchValue != "" || $this->tahun_pembuatan_dokumen->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // deskripsi
        if ($this->deskripsi->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->deskripsi->AdvancedSearch->SearchValue != "" || $this->deskripsi->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // id
        if ($this->id->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->id->AdvancedSearch->SearchValue != "" || $this->id->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // no_gudang
        if ($this->no_gudang->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->no_gudang->AdvancedSearch->SearchValue != "" || $this->no_gudang->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // no_rak
        if ($this->no_rak->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->no_rak->AdvancedSearch->SearchValue != "" || $this->no_rak->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // file
        if ($this->file->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->file->AdvancedSearch->SearchValue != "" || $this->file->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // masa_berlaku
        if ($this->masa_berlaku->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->masa_berlaku->AdvancedSearch->SearchValue != "" || $this->masa_berlaku->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // kode
        if ($this->kode->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->kode->AdvancedSearch->SearchValue != "" || $this->kode->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // kode_box
        if ($this->kode_box->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->kode_box->AdvancedSearch->SearchValue != "" || $this->kode_box->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // created_date
        if ($this->created_date->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->created_date->AdvancedSearch->SearchValue != "" || $this->created_date->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }
        return $hasValue;
    }

    // Load recordset
    public function loadRecordset($offset = -1, $rowcnt = -1)
    {
        // Load List page SQL (QueryBuilder)
        $sql = $this->getListSql();

        // Load recordset
        if ($offset > -1) {
            $sql->setFirstResult($offset);
        }
        if ($rowcnt > 0) {
            $sql->setMaxResults($rowcnt);
        }
        $result = $sql->execute();
        $rs = new Recordset($result, $sql);

        // Call Recordset Selected event
        $this->recordsetSelected($rs);
        return $rs;
    }

    // Load records as associative array
    public function loadRows($offset = -1, $rowcnt = -1)
    {
        // Load List page SQL (QueryBuilder)
        $sql = $this->getListSql();

        // Load recordset
        if ($offset > -1) {
            $sql->setFirstResult($offset);
        }
        if ($rowcnt > 0) {
            $sql->setMaxResults($rowcnt);
        }
        $result = $sql->execute();
        return $result->fetchAll(FetchMode::ASSOCIATIVE);
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssociative($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from recordset or record
     *
     * @param Recordset|array $rs Record
     * @return void
     */
    public function loadRowValues($rs = null)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            $row = $this->newRow();
        }
        if (!$row) {
            return;
        }

        // Call Row Selected event
        $this->rowSelected($row);
        $this->no_box->setDbValue($row['no_box']);
        $this->kode_pt->setDbValue($row['kode_pt']);
        $this->kode_department->setDbValue($row['kode_department']);
        $this->lokasi->setDbValue($row['lokasi']);
        $this->nama_dokumen->setDbValue($row['nama_dokumen']);
        $this->tahun_pembuatan_dokumen->setDbValue($row['tahun_pembuatan_dokumen']);
        $this->deskripsi->setDbValue($row['deskripsi']);
        $this->id->setDbValue($row['id']);
        $this->no_gudang->setDbValue($row['no_gudang']);
        $this->no_rak->setDbValue($row['no_rak']);
        $this->file->Upload->DbValue = $row['file'];
        $this->file->setDbValue($this->file->Upload->DbValue);
        $this->masa_berlaku->setDbValue($row['masa_berlaku']);
        $this->kode->setDbValue($row['kode']);
        $this->kode_box->setDbValue($row['kode_box']);
        $this->created_date->setDbValue($row['created_date']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['no_box'] = null;
        $row['kode_pt'] = null;
        $row['kode_department'] = null;
        $row['lokasi'] = null;
        $row['nama_dokumen'] = null;
        $row['tahun_pembuatan_dokumen'] = null;
        $row['deskripsi'] = null;
        $row['id'] = null;
        $row['no_gudang'] = null;
        $row['no_rak'] = null;
        $row['file'] = null;
        $row['masa_berlaku'] = null;
        $row['kode'] = null;
        $row['kode_box'] = null;
        $row['created_date'] = null;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        // Load old record
        $this->OldRecordset = null;
        $validKey = $this->OldKey != "";
        if ($validKey) {
            $this->CurrentFilter = $this->getRecordFilter();
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $this->OldRecordset = LoadRecordset($sql, $conn);
        }
        $this->loadRowValues($this->OldRecordset); // Load row values
        return $validKey;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs
        $this->ViewUrl = $this->getViewUrl();
        $this->EditUrl = $this->getEditUrl();
        $this->InlineEditUrl = $this->getInlineEditUrl();
        $this->CopyUrl = $this->getCopyUrl();
        $this->InlineCopyUrl = $this->getInlineCopyUrl();
        $this->DeleteUrl = $this->getDeleteUrl();

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // no_box

        // kode_pt

        // kode_department

        // lokasi

        // nama_dokumen

        // tahun_pembuatan_dokumen

        // deskripsi

        // id
        $this->id->CellCssStyle = "white-space: nowrap;";

        // no_gudang

        // no_rak

        // file

        // masa_berlaku

        // kode
        $this->kode->CellCssStyle = "white-space: nowrap;";

        // kode_box
        $this->kode_box->CellCssStyle = "white-space: nowrap;";

        // created_date
        $this->created_date->CellCssStyle = "white-space: nowrap;";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // no_box
            $this->no_box->ViewValue = $this->no_box->CurrentValue;
            $this->no_box->ViewCustomAttributes = "";

            // kode_pt
            $curVal = strval($this->kode_pt->CurrentValue);
            if ($curVal != "") {
                $this->kode_pt->ViewValue = $this->kode_pt->lookupCacheOption($curVal);
                if ($this->kode_pt->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->kode_pt->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->kode_pt->Lookup->renderViewRow($rswrk[0]);
                        $this->kode_pt->ViewValue = $this->kode_pt->displayValue($arwrk);
                    } else {
                        $this->kode_pt->ViewValue = FormatNumber($this->kode_pt->CurrentValue, $this->kode_pt->formatPattern());
                    }
                }
            } else {
                $this->kode_pt->ViewValue = null;
            }
            $this->kode_pt->ViewCustomAttributes = "";

            // kode_department
            $curVal = strval($this->kode_department->CurrentValue);
            if ($curVal != "") {
                $this->kode_department->ViewValue = $this->kode_department->lookupCacheOption($curVal);
                if ($this->kode_department->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->kode_department->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->kode_department->Lookup->renderViewRow($rswrk[0]);
                        $this->kode_department->ViewValue = $this->kode_department->displayValue($arwrk);
                    } else {
                        $this->kode_department->ViewValue = FormatNumber($this->kode_department->CurrentValue, $this->kode_department->formatPattern());
                    }
                }
            } else {
                $this->kode_department->ViewValue = null;
            }
            $this->kode_department->ViewCustomAttributes = "";

            // lokasi
            $this->lokasi->ViewValue = $this->lokasi->CurrentValue;
            $this->lokasi->ViewCustomAttributes = "";

            // nama_dokumen
            $this->nama_dokumen->ViewValue = $this->nama_dokumen->CurrentValue;
            $this->nama_dokumen->ViewCustomAttributes = "";

            // tahun_pembuatan_dokumen
            $this->tahun_pembuatan_dokumen->ViewValue = $this->tahun_pembuatan_dokumen->CurrentValue;
            $this->tahun_pembuatan_dokumen->ViewValue = FormatNumber($this->tahun_pembuatan_dokumen->ViewValue, $this->tahun_pembuatan_dokumen->formatPattern());
            $this->tahun_pembuatan_dokumen->ViewCustomAttributes = "";

            // deskripsi
            $this->deskripsi->ViewValue = $this->deskripsi->CurrentValue;
            $this->deskripsi->ViewCustomAttributes = "";

            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // no_gudang
            $this->no_gudang->ViewValue = $this->no_gudang->CurrentValue;
            $this->no_gudang->ViewValue = FormatNumber($this->no_gudang->ViewValue, $this->no_gudang->formatPattern());
            $this->no_gudang->ViewCustomAttributes = "";

            // no_rak
            $this->no_rak->ViewValue = $this->no_rak->CurrentValue;
            $this->no_rak->ViewCustomAttributes = "";

            // file
            if (!EmptyValue($this->file->Upload->DbValue)) {
                $this->file->ImageWidth = 100;
                $this->file->ImageHeight = 0;
                $this->file->ImageAlt = $this->file->alt();
                $this->file->ImageCssClass = "ew-image";
                $this->file->ViewValue = $this->file->Upload->DbValue;
            } else {
                $this->file->ViewValue = "";
            }
            $this->file->ViewCustomAttributes = "";

            // masa_berlaku
            $this->masa_berlaku->ViewValue = $this->masa_berlaku->CurrentValue;
            $this->masa_berlaku->ViewValue = FormatNumber($this->masa_berlaku->ViewValue, $this->masa_berlaku->formatPattern());
            $this->masa_berlaku->ViewCustomAttributes = "";

            // no_box
            $this->no_box->LinkCustomAttributes = "";
            $this->no_box->HrefValue = "";
            $this->no_box->TooltipValue = "";

            // kode_pt
            $this->kode_pt->LinkCustomAttributes = "";
            $this->kode_pt->HrefValue = "";
            $this->kode_pt->TooltipValue = "";

            // kode_department
            $this->kode_department->LinkCustomAttributes = "";
            $this->kode_department->HrefValue = "";
            $this->kode_department->TooltipValue = "";

            // lokasi
            $this->lokasi->LinkCustomAttributes = "";
            $this->lokasi->HrefValue = "";
            $this->lokasi->TooltipValue = "";

            // nama_dokumen
            $this->nama_dokumen->LinkCustomAttributes = "";
            $this->nama_dokumen->HrefValue = "";
            $this->nama_dokumen->TooltipValue = "";

            // tahun_pembuatan_dokumen
            $this->tahun_pembuatan_dokumen->LinkCustomAttributes = "";
            $this->tahun_pembuatan_dokumen->HrefValue = "";
            $this->tahun_pembuatan_dokumen->TooltipValue = "";

            // deskripsi
            $this->deskripsi->LinkCustomAttributes = "";
            $this->deskripsi->HrefValue = "";
            $this->deskripsi->TooltipValue = "";

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";
            $this->id->TooltipValue = "";

            // no_gudang
            $this->no_gudang->LinkCustomAttributes = "";
            $this->no_gudang->HrefValue = "";
            $this->no_gudang->TooltipValue = "";

            // no_rak
            $this->no_rak->LinkCustomAttributes = "";
            $this->no_rak->HrefValue = "";
            $this->no_rak->TooltipValue = "";

            // file
            $this->file->LinkCustomAttributes = "";
            if (!EmptyValue($this->file->Upload->DbValue)) {
                $this->file->HrefValue = GetFileUploadUrl($this->file, $this->file->htmlDecode($this->file->Upload->DbValue)); // Add prefix/suffix
                $this->file->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->file->HrefValue = FullUrl($this->file->HrefValue, "href");
                }
            } else {
                $this->file->HrefValue = "";
            }
            $this->file->ExportHrefValue = $this->file->UploadPath . $this->file->Upload->DbValue;
            $this->file->TooltipValue = "";
            if ($this->file->UseColorbox) {
                if (EmptyValue($this->file->TooltipValue)) {
                    $this->file->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
                }
                $this->file->LinkAttrs["data-rel"] = "filing_dokumen_x" . $this->RowCount . "_file";
                $this->file->LinkAttrs->appendClass("ew-lightbox");
            }

            // masa_berlaku
            $this->masa_berlaku->LinkCustomAttributes = "";
            $this->masa_berlaku->HrefValue = "";
            $this->masa_berlaku->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_SEARCH) {
            // no_box
            if ($this->no_box->UseFilter && !EmptyValue($this->no_box->AdvancedSearch->SearchValue)) {
                if (is_array($this->no_box->AdvancedSearch->SearchValue)) {
                    $this->no_box->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->no_box->AdvancedSearch->SearchValue);
                }
                $this->no_box->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->no_box->AdvancedSearch->SearchValue);
            }

            // kode_pt
            if ($this->kode_pt->UseFilter && !EmptyValue($this->kode_pt->AdvancedSearch->SearchValue)) {
                if (is_array($this->kode_pt->AdvancedSearch->SearchValue)) {
                    $this->kode_pt->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->kode_pt->AdvancedSearch->SearchValue);
                }
                $this->kode_pt->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->kode_pt->AdvancedSearch->SearchValue);
            }

            // kode_department
            if ($this->kode_department->UseFilter && !EmptyValue($this->kode_department->AdvancedSearch->SearchValue)) {
                if (is_array($this->kode_department->AdvancedSearch->SearchValue)) {
                    $this->kode_department->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->kode_department->AdvancedSearch->SearchValue);
                }
                $this->kode_department->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->kode_department->AdvancedSearch->SearchValue);
            }

            // lokasi
            if ($this->lokasi->UseFilter && !EmptyValue($this->lokasi->AdvancedSearch->SearchValue)) {
                if (is_array($this->lokasi->AdvancedSearch->SearchValue)) {
                    $this->lokasi->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->lokasi->AdvancedSearch->SearchValue);
                }
                $this->lokasi->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->lokasi->AdvancedSearch->SearchValue);
            }

            // nama_dokumen
            if ($this->nama_dokumen->UseFilter && !EmptyValue($this->nama_dokumen->AdvancedSearch->SearchValue)) {
                if (is_array($this->nama_dokumen->AdvancedSearch->SearchValue)) {
                    $this->nama_dokumen->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->nama_dokumen->AdvancedSearch->SearchValue);
                }
                $this->nama_dokumen->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->nama_dokumen->AdvancedSearch->SearchValue);
            }

            // tahun_pembuatan_dokumen
            if ($this->tahun_pembuatan_dokumen->UseFilter && !EmptyValue($this->tahun_pembuatan_dokumen->AdvancedSearch->SearchValue)) {
                if (is_array($this->tahun_pembuatan_dokumen->AdvancedSearch->SearchValue)) {
                    $this->tahun_pembuatan_dokumen->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->tahun_pembuatan_dokumen->AdvancedSearch->SearchValue);
                }
                $this->tahun_pembuatan_dokumen->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->tahun_pembuatan_dokumen->AdvancedSearch->SearchValue);
            }

            // deskripsi
            if ($this->deskripsi->UseFilter && !EmptyValue($this->deskripsi->AdvancedSearch->SearchValue)) {
                if (is_array($this->deskripsi->AdvancedSearch->SearchValue)) {
                    $this->deskripsi->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->deskripsi->AdvancedSearch->SearchValue);
                }
                $this->deskripsi->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->deskripsi->AdvancedSearch->SearchValue);
            }

            // id
            $this->id->setupEditAttributes();
            $this->id->EditCustomAttributes = "";
            $this->id->EditValue = HtmlEncode($this->id->AdvancedSearch->SearchValue);
            $this->id->PlaceHolder = RemoveHtml($this->id->caption());

            // no_gudang
            if ($this->no_gudang->UseFilter && !EmptyValue($this->no_gudang->AdvancedSearch->SearchValue)) {
                if (is_array($this->no_gudang->AdvancedSearch->SearchValue)) {
                    $this->no_gudang->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->no_gudang->AdvancedSearch->SearchValue);
                }
                $this->no_gudang->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->no_gudang->AdvancedSearch->SearchValue);
            }

            // no_rak
            if ($this->no_rak->UseFilter && !EmptyValue($this->no_rak->AdvancedSearch->SearchValue)) {
                if (is_array($this->no_rak->AdvancedSearch->SearchValue)) {
                    $this->no_rak->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->no_rak->AdvancedSearch->SearchValue);
                }
                $this->no_rak->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->no_rak->AdvancedSearch->SearchValue);
            }

            // file
            if ($this->file->UseFilter && !EmptyValue($this->file->AdvancedSearch->SearchValue)) {
                if (is_array($this->file->AdvancedSearch->SearchValue)) {
                    $this->file->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->file->AdvancedSearch->SearchValue);
                }
                $this->file->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->file->AdvancedSearch->SearchValue);
            }

            // masa_berlaku
            if ($this->masa_berlaku->UseFilter && !EmptyValue($this->masa_berlaku->AdvancedSearch->SearchValue)) {
                if (is_array($this->masa_berlaku->AdvancedSearch->SearchValue)) {
                    $this->masa_berlaku->AdvancedSearch->SearchValue = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->masa_berlaku->AdvancedSearch->SearchValue);
                }
                $this->masa_berlaku->EditValue = explode(Config("MULTIPLE_OPTION_SEPARATOR"), $this->masa_berlaku->AdvancedSearch->SearchValue);
            }
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate search
    protected function validateSearch()
    {
        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }

        // Return validate result
        $validateSearch = !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateSearch = $validateSearch && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateSearch;
    }

    // Load advanced search
    public function loadAdvancedSearch()
    {
        $this->no_box->AdvancedSearch->load();
        $this->kode_pt->AdvancedSearch->load();
        $this->kode_department->AdvancedSearch->load();
        $this->lokasi->AdvancedSearch->load();
        $this->nama_dokumen->AdvancedSearch->load();
        $this->tahun_pembuatan_dokumen->AdvancedSearch->load();
        $this->deskripsi->AdvancedSearch->load();
        $this->id->AdvancedSearch->load();
        $this->no_gudang->AdvancedSearch->load();
        $this->no_rak->AdvancedSearch->load();
        $this->file->AdvancedSearch->load();
        $this->masa_berlaku->AdvancedSearch->load();
        $this->kode->AdvancedSearch->load();
        $this->kode_box->AdvancedSearch->load();
        $this->created_date->AdvancedSearch->load();
    }

    // Get export HTML tag
    protected function getExportTag($type, $custom = false)
    {
        global $Language;
        $pageUrl = $this->pageUrl();
        $exportUrl = GetUrl($pageUrl . "export=" . $type . ($custom ? "&amp;custom=1" : ""));
        if (SameText($type, "excel")) {
            if ($custom) {
                return "<button type=\"button\" class=\"btn btn-default ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" form=\"ffiling_dokumenlist\" data-url=\"$exportUrl\" data-ew-action=\"export\" data-export=\"excel\" data-custom=\"true\" data-export-selected=\"false\">" . $Language->phrase("ExportToExcel") . "</button>";
            } else {
                return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
            }
        } elseif (SameText($type, "word")) {
            if ($custom) {
                return "<button type=\"button\" class=\"btn btn-default ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" form=\"ffiling_dokumenlist\" data-url=\"$exportUrl\" data-ew-action=\"export\" data-export=\"word\" data-custom=\"true\" data-export-selected=\"false\">" . $Language->phrase("ExportToWord") . "</button>";
            } else {
                return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
            }
        } elseif (SameText($type, "pdf")) {
            if ($custom) {
                return "<button type=\"button\" class=\"btn btn-default ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPdfText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPdfText")) . "\" form=\"ffiling_dokumenlist\" data-url=\"$exportUrl\" data-ew-action=\"export\" data-export=\"pdf\" data-custom=\"true\" data-export-selected=\"false\">" . $Language->phrase("ExportToPdf") . "</button>";
            } else {
                return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPdfText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPdfText")) . "\">" . $Language->phrase("ExportToPdf") . "</a>";
            }
        } elseif (SameText($type, "html")) {
            return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-html\" title=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\">" . $Language->phrase("ExportToHtml") . "</a>";
        } elseif (SameText($type, "xml")) {
            return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-xml\" title=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\">" . $Language->phrase("ExportToXml") . "</a>";
        } elseif (SameText($type, "csv")) {
            return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-csv\" title=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\">" . $Language->phrase("ExportToCsv") . "</a>";
        } elseif (SameText($type, "email")) {
            $url = $custom ? ' data-url="' . $exportUrl . '"' : '';
            return '<button type="button" class="btn btn-default ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" form="ffiling_dokumenlist" data-ew-action="email" data-hdr="' . $Language->phrase("ExportToEmailText") . '" data-sel="false"' . $url . '>' . $Language->phrase("ExportToEmail") . '</button>';
        } elseif (SameText($type, "print")) {
            return "<a href=\"$exportUrl\" class=\"btn btn-default ew-export-link ew-print\" title=\"" . HtmlEncode($Language->phrase("ExportToPrintText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPrintText")) . "\">" . $Language->phrase("PrinterFriendly") . "</a>";
        }
    }

    // Set up export options
    protected function setupExportOptions()
    {
        global $Language;

        // Printer friendly
        $item = &$this->ExportOptions->add("print");
        $item->Body = $this->getExportTag("print");
        $item->Visible = false;

        // Export to Excel
        $item = &$this->ExportOptions->add("excel");
        $item->Body = $this->getExportTag("excel");
        $item->Visible = true;

        // Export to Word
        $item = &$this->ExportOptions->add("word");
        $item->Body = $this->getExportTag("word");
        $item->Visible = false;

        // Export to HTML
        $item = &$this->ExportOptions->add("html");
        $item->Body = $this->getExportTag("html");
        $item->Visible = false;

        // Export to XML
        $item = &$this->ExportOptions->add("xml");
        $item->Body = $this->getExportTag("xml");
        $item->Visible = false;

        // Export to CSV
        $item = &$this->ExportOptions->add("csv");
        $item->Body = $this->getExportTag("csv");
        $item->Visible = false;

        // Export to PDF
        $item = &$this->ExportOptions->add("pdf");
        $item->Body = $this->getExportTag("pdf");
        $item->Visible = false;

        // Export to Email
        $item = &$this->ExportOptions->add("email");
        $item->Body = $this->getExportTag("email");
        $item->Visible = false;

        // Drop down button for export
        $this->ExportOptions->UseButtonGroup = true;
        $this->ExportOptions->UseDropDownButton = true;
        if ($this->ExportOptions->UseButtonGroup && IsMobile()) {
            $this->ExportOptions->UseDropDownButton = true;
        }
        $this->ExportOptions->DropDownButtonPhrase = $Language->phrase("ButtonExport");

        // Add group option item
        $item = &$this->ExportOptions->addGroupOption();
        $item->Body = "";
        $item->Visible = false;
    }

    // Set up search options
    protected function setupSearchOptions()
    {
        global $Language, $Security;
        $pageUrl = $this->pageUrl();
        $this->SearchOptions = new ListOptions(["TagClassName" => "ew-search-option"]);

        // Search button
        $item = &$this->SearchOptions->add("searchtoggle");
        $searchToggleClass = ($this->SearchWhere != "") ? " active" : " active";
        $item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-ew-action=\"search-toggle\" data-form=\"ffiling_dokumensrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
        $item->Visible = true;

        // Show all button
        $item = &$this->SearchOptions->add("showall");
        $item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $pageUrl . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
        $item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

        // Button group for search
        $this->SearchOptions->UseDropDownButton = false;
        $this->SearchOptions->UseButtonGroup = true;
        $this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

        // Add group option item
        $item = &$this->SearchOptions->addGroupOption();
        $item->Body = "";
        $item->Visible = false;

        // Hide search options
        if ($this->isExport() || $this->CurrentAction) {
            $this->SearchOptions->hideAllOptions();
        }
        if (!$Security->canSearch()) {
            $this->SearchOptions->hideAllOptions();
            $this->FilterOptions->hideAllOptions();
        }
    }

    // Check if any search fields
    public function hasSearchFields()
    {
        return true;
    }

    // Render search options
    protected function renderSearchOptions()
    {
        if (!$this->hasSearchFields() && $this->SearchOptions["searchtoggle"]) {
            $this->SearchOptions["searchtoggle"]->Visible = false;
        }
    }

    /**
     * Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
     *
     * @param bool $return Return the data rather than output it
     * @return mixed
     */
    public function exportData($return = false)
    {
        global $Language;
        $utf8 = SameText(Config("PROJECT_CHARSET"), "utf-8");

        // Load recordset
        $this->TotalRecords = $this->listRecordCount();
        $this->StartRecord = 1;

        // Export all
        if ($this->ExportAll) {
            if (Config("EXPORT_ALL_TIME_LIMIT") >= 0) {
                @set_time_limit(Config("EXPORT_ALL_TIME_LIMIT"));
            }
            $this->DisplayRecords = $this->TotalRecords;
            $this->StopRecord = $this->TotalRecords;
        } else { // Export one page only
            $this->setupStartRecord(); // Set up start record position
            // Set the last record to display
            if ($this->DisplayRecords <= 0) {
                $this->StopRecord = $this->TotalRecords;
            } else {
                $this->StopRecord = $this->StartRecord + $this->DisplayRecords - 1;
            }
        }
        $rs = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords <= 0 ? $this->TotalRecords : $this->DisplayRecords);
        $this->ExportDoc = GetExportDocument($this, "h");
        $doc = &$this->ExportDoc;
        if (!$doc) {
            $this->setFailureMessage($Language->phrase("ExportClassNotFound")); // Export class not found
        }
        if (!$rs || !$doc) {
            RemoveHeader("Content-Type"); // Remove header
            RemoveHeader("Content-Disposition");
            $this->showMessage();
            return;
        }
        $this->StartRecord = 1;
        $this->StopRecord = $this->DisplayRecords <= 0 ? $this->TotalRecords : $this->DisplayRecords;

        // Call Page Exporting server event
        $this->ExportDoc->ExportCustom = !$this->pageExporting();
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        $doc->Text .= $header;
        $this->exportDocument($doc, $rs, $this->StartRecord, $this->StopRecord, "");
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        $doc->Text .= $footer;

        // Close recordset
        $rs->close();

        // Call Page Exported server event
        $this->pageExported();

        // Export header and footer
        $doc->exportHeaderAndFooter();

        // Clean output buffer (without destroying output buffer)
        $buffer = ob_get_contents(); // Save the output buffer
        if (!Config("DEBUG") && $buffer) {
            ob_clean();
        }

        // Write debug message if enabled
        if (Config("DEBUG") && !$this->isExport("pdf")) {
            echo GetDebugMessage();
        }

        // Output data
        if ($this->isExport("email")) {
            // Export-to-email disabled
        } else {
            $doc->export();
            if ($return) {
                RemoveHeader("Content-Type"); // Remove header
                RemoveHeader("Content-Disposition");
                $content = ob_get_contents();
                if ($content) {
                    ob_clean();
                }
                if ($buffer) {
                    echo $buffer; // Resume the output buffer
                }
                return $content;
            }
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
        $Breadcrumb->add("list", $this->TableVar, $url, "", $this->TableVar, true);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup !== null && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                case "x_kode_pt":
                    break;
                case "x_kode_department":
                    break;
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if (!$fld->hasLookupOptions() && $fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll();
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row, Container($fld->Lookup->LinkTable));
                    $ar[strval($row["lf"])] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Set up starting record parameters
    public function setupStartRecord()
    {
        if ($this->DisplayRecords == 0) {
            return;
        }
        if ($this->isPageRequest()) { // Validate request
            $startRec = Get(Config("TABLE_START_REC"));
            $pageNo = Get(Config("TABLE_PAGE_NO"));
            if ($pageNo !== null) { // Check for "pageno" parameter first
                $pageNo = ParseInteger($pageNo);
                if (is_numeric($pageNo)) {
                    $this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
                    if ($this->StartRecord <= 0) {
                        $this->StartRecord = 1;
                    } elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1) {
                        $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1;
                    }
                    $this->setStartRecordNumber($this->StartRecord);
                }
            } elseif ($startRec !== null && is_numeric($startRec)) { // Check for "start" parameter
                $this->StartRecord = $startRec;
                $this->setStartRecordNumber($this->StartRecord);
            }
        }
        $this->StartRecord = $this->getStartRecordNumber();

        // Check if correct start record counter
        if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
            $this->StartRecord = 1; // Reset start record counter
            $this->setStartRecordNumber($this->StartRecord);
        } elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
            $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
            $this->setStartRecordNumber($this->StartRecord);
        } elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
            $this->StartRecord = (int)(($this->StartRecord - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
        if ($type == 'success') {
            //$msg = "your success message";
        } elseif ($type == 'failure') {
            //$msg = "your failure message";
        } elseif ($type == 'warning') {
            //$msg = "your warning message";
        } else {
            //$msg = "your message";
        }
    }

    // Page Render event
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in $customError
        return true;
    }

    // ListOptions Load event
    public function listOptionsLoad()
    {
        // Example:
        //$opt = &$this->ListOptions->Add("new");
        //$opt->Header = "xxx";
        //$opt->OnLeft = true; // Link on left
        //$opt->MoveTo(0); // Move to first column
    }

    // ListOptions Rendering event
    public function listOptionsRendering()
    {
        //Container("DetailTableGrid")->DetailAdd = (...condition...); // Set to true or false conditionally
        //Container("DetailTableGrid")->DetailEdit = (...condition...); // Set to true or false conditionally
        //Container("DetailTableGrid")->DetailView = (...condition...); // Set to true or false conditionally
    }

    // ListOptions Rendered event
    public function listOptionsRendered()
    {
        // Example:
        //$this->ListOptions["new"]->Body = "xxx";
    }

    // Row Custom Action event
    public function rowCustomAction($action, $row)
    {
        // Return false to abort
        return true;
    }

    // Page Exporting event
    // $this->ExportDoc = export document object
    public function pageExporting()
    {
        //$this->ExportDoc->Text = "my header"; // Export header
        //return false; // Return false to skip default export and use Row_Export event
        return true; // Return true to use default export and skip Row_Export event
    }

    // Row Export event
    // $this->ExportDoc = export document object
    public function rowExport($rs)
    {
        //$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
    }

    // Page Exported event
    // $this->ExportDoc = export document object
    public function pageExported()
    {
        //$this->ExportDoc->Text .= "my footer"; // Export footer
        //Log($this->ExportDoc->Text);
    }

    // Page Importing event
    public function pageImporting($reader, &$options)
    {
        //var_dump($reader); // Import data reader
        //var_dump($options); // Show all options for importing
        //return false; // Return false to skip import
        return true;
    }

    // Row Import event
    public function rowImport(&$row, $cnt)
    {
        //Log($cnt); // Import record count
        //var_dump($row); // Import row
        //return false; // Return false to skip import
        return true;
    }

    // Page Imported event
    public function pageImported($reader, $results)
    {
        //var_dump($reader); // Import data reader
        //var_dump($results); // Import results
    }
}
