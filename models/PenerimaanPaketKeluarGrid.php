<?php

namespace Mitral2022\DSN2;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class PenerimaanPaketKeluarGrid extends PenerimaanPaketKeluar
{
    use MessagesTrait;

    // Page ID
    public $PageID = "grid";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'penerimaan_paket_keluar';

    // Page object name
    public $PageObjName = "PenerimaanPaketKeluarGrid";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fpenerimaan_paket_keluargrid";
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

        // Initialize
        $this->FormActionName .= "_" . $this->FormName;
        $this->OldKeyName .= "_" . $this->FormName;
        $this->FormBlankRowName .= "_" . $this->FormName;
        $this->FormKeyCountName .= "_" . $this->FormName;
        $GLOBALS["Grid"] = &$this;

        // Language object
        $Language = Container("language");

        // Parent constuctor
        parent::__construct();

        // Table object (penerimaan_paket_keluar)
        if (!isset($GLOBALS["penerimaan_paket_keluar"]) || get_class($GLOBALS["penerimaan_paket_keluar"]) == PROJECT_NAMESPACE . "penerimaan_paket_keluar") {
            $GLOBALS["penerimaan_paket_keluar"] = &$this;
        }
        $this->AddUrl = "penerimaanpaketkeluaradd";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'penerimaan_paket_keluar');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // List options
        $this->ListOptions = new ListOptions(["Tag" => "td", "TableVar" => $this->TableVar]);

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

        // Export
        if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
            $content = $this->getContents();
            if ($ExportFileName == "") {
                $ExportFileName = $this->TableVar;
            }
            $class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
            if (class_exists($class)) {
                $tbl = Container("penerimaan_paket_keluar");
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
        unset($GLOBALS["Grid"]);
        if ($url === "") {
            return;
        }
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

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
    public $ShowOtherOptions = false;
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

        // Get grid add count
        $gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
        if (is_numeric($gridaddcnt) && $gridaddcnt > 0) {
            $this->GridAddRowCount = $gridaddcnt;
        }

        // Set up list options
        $this->setupListOptions();
        $this->id->setVisibility();
        $this->no_dokumen->setVisibility();
        $this->no_paket->setVisibility();
        $this->jenis_dokumen->setVisibility();
        $this->tujuan_penerima->setVisibility();
        $this->no_hp_penerima->setVisibility();
        $this->email_penerima->setVisibility();
        $this->status->setVisibility();
        $this->tanggal_terima->setVisibility();
        $this->jenis_pengirim->setVisibility();
        $this->nama_kurir->setVisibility();
        $this->no_awb->setVisibility();
        $this->id_user->setVisibility();
        $this->created_date->Visible = false;
        $this->bukti_penerimaan->setVisibility();
        $this->nama_penerima->setVisibility();
        $this->status_sap->setVisibility();
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

        // Set up master detail parameters
        $this->setupMasterParms();

        // Setup other options
        $this->setupOtherOptions();

        // Set up lookup cache
        $this->setupLookupOptions($this->jenis_dokumen);
        $this->setupLookupOptions($this->status);
        $this->setupLookupOptions($this->jenis_pengirim);
        $this->setupLookupOptions($this->nama_kurir);

        // Search filters
        $srchAdvanced = ""; // Advanced search filter
        $srchBasic = ""; // Basic search filter
        $filter = "";

        // Get command
        $this->Command = strtolower(Get("cmd"));
        if ($this->isPageRequest()) {
            // Set up records per page
            $this->setupDisplayRecords();

            // Handle reset command
            $this->resetCmd();

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

            // Show grid delete link for grid add / grid edit
            if ($this->AllowAddDeleteRow) {
                if ($this->isGridAdd() || $this->isGridEdit()) {
                    $item = $this->ListOptions["griddelete"];
                    if ($item) {
                        $item->Visible = true;
                    }
                }
            }

            // Set up sorting order
            $this->setupSortOrder();
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

        // Build filter
        $filter = "";

        // Restore master/detail filter from session
        $this->DbMasterFilter = $this->getMasterFilterFromSession(); // Restore master filter from session
        $this->DbDetailFilter = $this->getDetailFilterFromSession(); // Restore detail filter from session
        AddFilter($filter, $this->DbDetailFilter);
        AddFilter($filter, $this->SearchWhere);

        // Load master record
        if ($this->CurrentMode != "add" && $this->DbMasterFilter != "" && $this->getCurrentMasterTable() == "user") {
            $masterTbl = Container("user");
            $rsmaster = $masterTbl->loadRs($this->DbMasterFilter)->fetchAssociative();
            $this->MasterRecordExists = $rsmaster !== false;
            if (!$this->MasterRecordExists) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
                $this->terminate("userlist"); // Return to master page
                return;
            } else {
                $masterTbl->loadListRowValues($rsmaster);
                $masterTbl->RowType = ROWTYPE_MASTER; // Master row
                $masterTbl->renderListRow();
            }
        }

        // Set up filter
        if ($this->Command == "json") {
            $this->UseSessionForListSql = false; // Do not use session for ListSQL
            $this->CurrentFilter = $filter;
        } else {
            $this->setSessionWhere($filter);
            $this->CurrentFilter = "";
        }
        if ($this->isGridAdd()) {
            if ($this->CurrentMode == "copy") {
                $this->TotalRecords = $this->listRecordCount();
                $this->StartRecord = 1;
                $this->DisplayRecords = $this->TotalRecords;
                $this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);
            } else {
                $this->CurrentFilter = "0=1";
                $this->StartRecord = 1;
                $this->DisplayRecords = $this->GridAddRowCount;
            }
            $this->TotalRecords = $this->DisplayRecords;
            $this->StopRecord = $this->DisplayRecords;
        } else {
            $this->TotalRecords = $this->listRecordCount();
            $this->StartRecord = 1;
            $this->DisplayRecords = $this->TotalRecords; // Display all records
            $this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);
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

    // Exit inline mode
    protected function clearInlineMode()
    {
        $this->LastAction = $this->CurrentAction; // Save last action
        $this->CurrentAction = ""; // Clear action
        $_SESSION[SESSION_INLINE_MODE] = ""; // Clear inline mode
    }

    // Switch to Grid Add mode
    protected function gridAddMode()
    {
        $this->CurrentAction = "gridadd";
        $_SESSION[SESSION_INLINE_MODE] = "gridadd";
        $this->hideFieldsForAddEdit();
    }

    // Switch to Grid Edit mode
    protected function gridEditMode()
    {
        $this->CurrentAction = "gridedit";
        $_SESSION[SESSION_INLINE_MODE] = "gridedit";
        $this->hideFieldsForAddEdit();
    }

    // Perform update to grid
    public function gridUpdate()
    {
        global $Language, $CurrentForm;
        $gridUpdate = true;

        // Get old recordset
        $this->CurrentFilter = $this->buildKeyFilter();
        if ($this->CurrentFilter == "") {
            $this->CurrentFilter = "0=1";
        }
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        if ($rs = $conn->executeQuery($sql)) {
            $rsold = $rs->fetchAllAssociative();
        }

        // Call Grid Updating event
        if (!$this->gridUpdating($rsold)) {
            if ($this->getFailureMessage() == "") {
                $this->setFailureMessage($Language->phrase("GridEditCancelled")); // Set grid edit cancelled message
            }
            return false;
        }
        $key = "";

        // Update row index and get row key
        $CurrentForm->Index = -1;
        $rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
        if ($rowcnt == "" || !is_numeric($rowcnt)) {
            $rowcnt = 0;
        }

        // Update all rows based on key
        for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
            $CurrentForm->Index = $rowindex;
            $this->setKey($CurrentForm->getValue($this->OldKeyName));
            $rowaction = strval($CurrentForm->getValue($this->FormActionName));

            // Load all values and keys
            if ($rowaction != "insertdelete") { // Skip insert then deleted rows
                $this->loadFormValues(); // Get form values
                if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
                    $gridUpdate = $this->OldKey != ""; // Key must not be empty
                } else {
                    $gridUpdate = true;
                }

                // Skip empty row
                if ($rowaction == "insert" && $this->emptyRow()) {
                    // Validate form and insert/update/delete record
                } elseif ($gridUpdate) {
                    if ($rowaction == "delete") {
                        $this->CurrentFilter = $this->getRecordFilter();
                        $gridUpdate = $this->deleteRows(); // Delete this row
                        //} elseif (!$this->validateForm()) { // Already done in validateGridForm
                        //    $gridUpdate = false; // Form error, reset action
                    } else {
                        if ($rowaction == "insert") {
                            $gridUpdate = $this->addRow(); // Insert this row
                        } else {
                            if ($this->OldKey != "") {
                                $this->SendEmail = false; // Do not send email on update success
                                $gridUpdate = $this->editRow(); // Update this row
                            }
                        } // End update
                    }
                }
                if ($gridUpdate) {
                    if ($key != "") {
                        $key .= ", ";
                    }
                    $key .= $this->OldKey;
                } else {
                    break;
                }
            }
        }
        if ($gridUpdate) {
            // Get new records
            $rsnew = $conn->fetchAllAssociative($sql);

            // Call Grid_Updated event
            $this->gridUpdated($rsold, $rsnew);
            $this->clearInlineMode(); // Clear inline edit mode
        } else {
            if ($this->getFailureMessage() == "") {
                $this->setFailureMessage($Language->phrase("UpdateFailed")); // Set update failed message
            }
        }
        return $gridUpdate;
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

    // Perform Grid Add
    public function gridInsert()
    {
        global $Language, $CurrentForm;
        $rowindex = 1;
        $gridInsert = false;
        $conn = $this->getConnection();

        // Call Grid Inserting event
        if (!$this->gridInserting()) {
            if ($this->getFailureMessage() == "") {
                $this->setFailureMessage($Language->phrase("GridAddCancelled")); // Set grid add cancelled message
            }
            return false;
        }

        // Init key filter
        $wrkfilter = "";
        $addcnt = 0;
        $key = "";

        // Get row count
        $CurrentForm->Index = -1;
        $rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
        if ($rowcnt == "" || !is_numeric($rowcnt)) {
            $rowcnt = 0;
        }

        // Insert all rows
        for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
            // Load current row values
            $CurrentForm->Index = $rowindex;
            $rowaction = strval($CurrentForm->getValue($this->FormActionName));
            if ($rowaction != "" && $rowaction != "insert") {
                continue; // Skip
            }
            if ($rowaction == "insert") {
                $this->OldKey = strval($CurrentForm->getValue($this->OldKeyName));
                $this->loadOldRecord(); // Load old record
            }
            $this->loadFormValues(); // Get form values
            if (!$this->emptyRow()) {
                $addcnt++;
                $this->SendEmail = false; // Do not send email on insert success

                // Validate form // Already done in validateGridForm
                //if (!$this->validateForm()) {
                //    $gridInsert = false; // Form error, reset action
                //} else {
                $gridInsert = $this->addRow($this->OldRecordset); // Insert this row
                //}
                if ($gridInsert) {
                    if ($key != "") {
                        $key .= Config("COMPOSITE_KEY_SEPARATOR");
                    }
                    $key .= $this->id->CurrentValue;

                    // Add filter for this record
                    $filter = $this->getRecordFilter();
                    if ($wrkfilter != "") {
                        $wrkfilter .= " OR ";
                    }
                    $wrkfilter .= $filter;
                } else {
                    break;
                }
            }
        }
        if ($addcnt == 0) { // No record inserted
            $this->clearInlineMode(); // Clear grid add mode and return
            return true;
        }
        if ($gridInsert) {
            // Get new records
            $this->CurrentFilter = $wrkfilter;
            $sql = $this->getCurrentSql();
            $rsnew = $conn->fetchAllAssociative($sql);

            // Call Grid_Inserted event
            $this->gridInserted($rsnew);
            $this->clearInlineMode(); // Clear grid add mode
        } else {
            if ($this->getFailureMessage() == "") {
                $this->setFailureMessage($Language->phrase("InsertFailed")); // Set insert failed message
            }
        }
        return $gridInsert;
    }

    // Check if empty row
    public function emptyRow()
    {
        global $CurrentForm;
        if ($CurrentForm->hasValue("x_no_dokumen") && $CurrentForm->hasValue("o_no_dokumen") && $this->no_dokumen->CurrentValue != $this->no_dokumen->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_no_paket") && $CurrentForm->hasValue("o_no_paket") && $this->no_paket->CurrentValue != $this->no_paket->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_jenis_dokumen") && $CurrentForm->hasValue("o_jenis_dokumen") && $this->jenis_dokumen->CurrentValue != $this->jenis_dokumen->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_tujuan_penerima") && $CurrentForm->hasValue("o_tujuan_penerima") && $this->tujuan_penerima->CurrentValue != $this->tujuan_penerima->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_no_hp_penerima") && $CurrentForm->hasValue("o_no_hp_penerima") && $this->no_hp_penerima->CurrentValue != $this->no_hp_penerima->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_email_penerima") && $CurrentForm->hasValue("o_email_penerima") && $this->email_penerima->CurrentValue != $this->email_penerima->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_status") && $CurrentForm->hasValue("o_status") && $this->status->CurrentValue != $this->status->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_tanggal_terima") && $CurrentForm->hasValue("o_tanggal_terima") && $this->tanggal_terima->CurrentValue != $this->tanggal_terima->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_jenis_pengirim") && $CurrentForm->hasValue("o_jenis_pengirim") && $this->jenis_pengirim->CurrentValue != $this->jenis_pengirim->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_nama_kurir") && $CurrentForm->hasValue("o_nama_kurir") && $this->nama_kurir->CurrentValue != $this->nama_kurir->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_no_awb") && $CurrentForm->hasValue("o_no_awb") && $this->no_awb->CurrentValue != $this->no_awb->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_id_user") && $CurrentForm->hasValue("o_id_user") && $this->id_user->CurrentValue != $this->id_user->OldValue) {
            return false;
        }
        if (!EmptyValue($this->bukti_penerimaan->Upload->Value)) {
            return false;
        }
        if ($CurrentForm->hasValue("x_nama_penerima") && $CurrentForm->hasValue("o_nama_penerima") && $this->nama_penerima->CurrentValue != $this->nama_penerima->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_status_sap") && $CurrentForm->hasValue("o_status_sap") && $this->status_sap->CurrentValue != $this->status_sap->OldValue) {
            return false;
        }
        return true;
    }

    // Validate grid form
    public function validateGridForm()
    {
        global $CurrentForm;
        // Get row count
        $CurrentForm->Index = -1;
        $rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
        if ($rowcnt == "" || !is_numeric($rowcnt)) {
            $rowcnt = 0;
        }

        // Validate all records
        for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
            // Load current row values
            $CurrentForm->Index = $rowindex;
            $rowaction = strval($CurrentForm->getValue($this->FormActionName));
            if ($rowaction != "delete" && $rowaction != "insertdelete") {
                $this->loadFormValues(); // Get form values
                if ($rowaction == "insert" && $this->emptyRow()) {
                    // Ignore
                } elseif (!$this->validateForm()) {
                    $this->EventCancelled = true;
                    return false;
                }
            }
        }
        return true;
    }

    // Get all form values of the grid
    public function getGridFormValues()
    {
        global $CurrentForm;
        // Get row count
        $CurrentForm->Index = -1;
        $rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
        if ($rowcnt == "" || !is_numeric($rowcnt)) {
            $rowcnt = 0;
        }
        $rows = [];

        // Loop through all records
        for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
            // Load current row values
            $CurrentForm->Index = $rowindex;
            $rowaction = strval($CurrentForm->getValue($this->FormActionName));
            if ($rowaction != "delete" && $rowaction != "insertdelete") {
                $this->loadFormValues(); // Get form values
                if ($rowaction == "insert" && $this->emptyRow()) {
                    // Ignore
                } else {
                    $rows[] = $this->getFieldValues("FormValue"); // Return row as array
                }
            }
        }
        return $rows; // Return as array of array
    }

    // Restore form values for current row
    public function restoreCurrentRowFormValues($idx)
    {
        global $CurrentForm;

        // Get row based on current index
        $CurrentForm->Index = $idx;
        $rowaction = strval($CurrentForm->getValue($this->FormActionName));
        $this->loadFormValues(); // Load form values
        // Set up invalid status correctly
        $this->resetFormError();
        if ($rowaction == "insert" && $this->emptyRow()) {
            // Ignore
        } else {
            $this->validateForm();
        }
    }

    // Reset form status
    public function resetFormError()
    {
        $this->id->clearErrorMessage();
        $this->no_dokumen->clearErrorMessage();
        $this->no_paket->clearErrorMessage();
        $this->jenis_dokumen->clearErrorMessage();
        $this->tujuan_penerima->clearErrorMessage();
        $this->no_hp_penerima->clearErrorMessage();
        $this->email_penerima->clearErrorMessage();
        $this->status->clearErrorMessage();
        $this->tanggal_terima->clearErrorMessage();
        $this->jenis_pengirim->clearErrorMessage();
        $this->nama_kurir->clearErrorMessage();
        $this->no_awb->clearErrorMessage();
        $this->id_user->clearErrorMessage();
        $this->bukti_penerimaan->clearErrorMessage();
        $this->nama_penerima->clearErrorMessage();
        $this->status_sap->clearErrorMessage();
    }

    // Set up sort parameters
    protected function setupSortOrder()
    {
        // Check for "order" parameter
        if (Get("order") !== null) {
            $this->CurrentOrder = Get("order");
            $this->CurrentOrderType = Get("ordertype", "");
            $this->setStartRecordNumber(1); // Reset start position
        }
    }

    // Load sort order parameters
    protected function loadSortOrder()
    {
        $orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
        if ($orderBy == "") {
            $this->DefaultSort = "";
            if ($this->getSqlOrderBy() != "") {
                $useDefaultSort = true;
                if ($useDefaultSort) {
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
            // Reset master/detail keys
            if ($this->Command == "resetall") {
                $this->setCurrentMasterTable(""); // Clear master table
                $this->DbMasterFilter = "";
                $this->DbDetailFilter = "";
                $this->id_user->setSessionValue("");
            }

            // Reset (clear) sorting order
            if ($this->Command == "resetsort") {
                $orderBy = "";
                $this->setSessionOrderBy($orderBy);
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

        // "griddelete"
        if ($this->AllowAddDeleteRow) {
            $item = &$this->ListOptions->add("griddelete");
            $item->CssClass = "text-nowrap";
            $item->OnLeft = true;
            $item->Visible = false; // Default hidden
        }

        // Add group option item ("button")
        $item = &$this->ListOptions->addGroupOption();
        $item->Body = "";
        $item->OnLeft = true;
        $item->Visible = false;

        // "view"
        $item = &$this->ListOptions->add("view");
        $item->CssClass = "text-nowrap";
        $item->Visible = true;
        $item->OnLeft = true;

        // "edit"
        $item = &$this->ListOptions->add("edit");
        $item->CssClass = "text-nowrap";
        $item->Visible = true;
        $item->OnLeft = true;

        // "copy"
        $item = &$this->ListOptions->add("copy");
        $item->CssClass = "text-nowrap";
        $item->Visible = true;
        $item->OnLeft = true;

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

        // Set up row action and key
        if ($CurrentForm && is_numeric($this->RowIndex) && $this->RowType != "view") {
            $CurrentForm->Index = $this->RowIndex;
            $actionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
            $oldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->OldKeyName);
            $blankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
            if ($this->RowAction != "") {
                $this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $actionName . "\" id=\"" . $actionName . "\" value=\"" . $this->RowAction . "\">";
            }
            $oldKey = $this->getKey(false); // Get from OldValue
            if ($oldKeyName != "" && $oldKey != "") {
                $this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $oldKeyName . "\" id=\"" . $oldKeyName . "\" value=\"" . HtmlEncode($oldKey) . "\">";
            }
            if ($this->RowAction == "insert" && $this->isConfirm() && $this->emptyRow()) {
                $this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $blankRowName . "\" id=\"" . $blankRowName . "\" value=\"1\">";
            }
        }

        // "delete"
        if ($this->AllowAddDeleteRow) {
            if ($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") {
                $options = &$this->ListOptions;
                $options->UseButtonGroup = true; // Use button group for grid delete button
                $opt = $options["griddelete"];
                $opt->Body = "<a class=\"ew-grid-link ew-grid-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-ew-action=\"delete-grid-row\" data-rowindex=\"" . $this->RowIndex . "\">" . $Language->phrase("DeleteLink") . "</a>";
            }
        }

        // "sequence"
        $opt = $this->ListOptions["sequence"];
        $opt->Body = FormatSequenceNumber($this->RecordCount);
        if ($this->CurrentMode == "view") {
            // "view"
            $opt = $this->ListOptions["view"];
            $viewcaption = HtmlTitle($Language->phrase("ViewLink"));
            if (true) {
                $opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode(GetUrl($this->ViewUrl)) . "\">" . $Language->phrase("ViewLink") . "</a>";
            } else {
                $opt->Body = "";
            }

            // "edit"
            $opt = $this->ListOptions["edit"];
            $editcaption = HtmlTitle($Language->phrase("EditLink"));
            if (true) {
                $opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" href=\"" . HtmlEncode(GetUrl($this->EditUrl)) . "\">" . $Language->phrase("EditLink") . "</a>";
            } else {
                $opt->Body = "";
            }

            // "copy"
            $opt = $this->ListOptions["copy"];
            $copycaption = HtmlTitle($Language->phrase("CopyLink"));
            if (true) {
                $opt->Body = "<a class=\"ew-row-link ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode(GetUrl($this->CopyUrl)) . "\">" . $Language->phrase("CopyLink") . "</a>";
            } else {
                $opt->Body = "";
            }
        } // End View mode
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
        $option = $this->OtherOptions["addedit"];
        $item = &$option->addGroupOption();
        $item->Body = "";
        $item->Visible = false;

        // Add
        if ($this->CurrentMode == "view") { // Check view mode
            $item = &$option->add("add");
            $addcaption = HtmlTitle($Language->phrase("AddLink"));
            $this->AddUrl = $this->getAddUrl();
            $item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode(GetUrl($this->AddUrl)) . "\">" . $Language->phrase("AddLink") . "</a>";
            $item->Visible = $this->AddUrl != "";
        }
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
        if (in_array($this->CurrentMode, ["add", "copy", "edit"]) && !$this->isConfirm()) { // Check add/copy/edit mode
            if ($this->AllowAddDeleteRow) {
                $option = $options["addedit"];
                $option->UseDropDownButton = false;
                $item = &$option->add("addblankrow");
                $item->Body = "<a class=\"ew-add-edit ew-add-blank-row\" title=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" data-ew-action=\"add-grid-row\">" . $Language->phrase("AddBlankRow") . "</a>";
                $item->Visible = true;
                $this->ShowOtherOptions = $item->Visible;
            }
        }
        if ($this->CurrentMode == "view") { // Check view mode
            $option = $options["addedit"];
            $item = $option["add"];
            $this->ShowOtherOptions = $item && $item->Visible;
        }
    }

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
        $this->bukti_penerimaan->Upload->Index = $CurrentForm->Index;
        $this->bukti_penerimaan->Upload->uploadFile();
        $this->bukti_penerimaan->CurrentValue = $this->bukti_penerimaan->Upload->FileName;
    }

    // Load default values
    protected function loadDefaultValues()
    {
        $this->id->CurrentValue = null;
        $this->id->OldValue = $this->id->CurrentValue;
        $this->no_dokumen->CurrentValue = null;
        $this->no_dokumen->OldValue = $this->no_dokumen->CurrentValue;
        $this->no_paket->CurrentValue = null;
        $this->no_paket->OldValue = $this->no_paket->CurrentValue;
        $this->jenis_dokumen->CurrentValue = null;
        $this->jenis_dokumen->OldValue = $this->jenis_dokumen->CurrentValue;
        $this->tujuan_penerima->CurrentValue = null;
        $this->tujuan_penerima->OldValue = $this->tujuan_penerima->CurrentValue;
        $this->no_hp_penerima->CurrentValue = null;
        $this->no_hp_penerima->OldValue = $this->no_hp_penerima->CurrentValue;
        $this->email_penerima->CurrentValue = null;
        $this->email_penerima->OldValue = $this->email_penerima->CurrentValue;
        $this->status->CurrentValue = null;
        $this->status->OldValue = $this->status->CurrentValue;
        $this->tanggal_terima->CurrentValue = null;
        $this->tanggal_terima->OldValue = $this->tanggal_terima->CurrentValue;
        $this->jenis_pengirim->CurrentValue = null;
        $this->jenis_pengirim->OldValue = $this->jenis_pengirim->CurrentValue;
        $this->nama_kurir->CurrentValue = null;
        $this->nama_kurir->OldValue = $this->nama_kurir->CurrentValue;
        $this->no_awb->CurrentValue = null;
        $this->no_awb->OldValue = $this->no_awb->CurrentValue;
        $this->id_user->CurrentValue = null;
        $this->id_user->OldValue = $this->id_user->CurrentValue;
        $this->created_date->CurrentValue = null;
        $this->created_date->OldValue = $this->created_date->CurrentValue;
        $this->bukti_penerimaan->Upload->DbValue = null;
        $this->bukti_penerimaan->OldValue = $this->bukti_penerimaan->Upload->DbValue;
        $this->bukti_penerimaan->Upload->Index = $this->RowIndex;
        $this->nama_penerima->CurrentValue = null;
        $this->nama_penerima->OldValue = $this->nama_penerima->CurrentValue;
        $this->status_sap->CurrentValue = null;
        $this->status_sap->OldValue = $this->status_sap->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $CurrentForm->FormName = $this->FormName;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
        if (!$this->id->IsDetailKey && !$this->isGridAdd() && !$this->isAdd()) {
            $this->id->setFormValue($val);
        }

        // Check field name 'no_dokumen' first before field var 'x_no_dokumen'
        $val = $CurrentForm->hasValue("no_dokumen") ? $CurrentForm->getValue("no_dokumen") : $CurrentForm->getValue("x_no_dokumen");
        if (!$this->no_dokumen->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no_dokumen->Visible = false; // Disable update for API request
            } else {
                $this->no_dokumen->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_no_dokumen")) {
            $this->no_dokumen->setOldValue($CurrentForm->getValue("o_no_dokumen"));
        }

        // Check field name 'no_paket' first before field var 'x_no_paket'
        $val = $CurrentForm->hasValue("no_paket") ? $CurrentForm->getValue("no_paket") : $CurrentForm->getValue("x_no_paket");
        if (!$this->no_paket->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no_paket->Visible = false; // Disable update for API request
            } else {
                $this->no_paket->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_no_paket")) {
            $this->no_paket->setOldValue($CurrentForm->getValue("o_no_paket"));
        }

        // Check field name 'jenis_dokumen' first before field var 'x_jenis_dokumen'
        $val = $CurrentForm->hasValue("jenis_dokumen") ? $CurrentForm->getValue("jenis_dokumen") : $CurrentForm->getValue("x_jenis_dokumen");
        if (!$this->jenis_dokumen->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jenis_dokumen->Visible = false; // Disable update for API request
            } else {
                $this->jenis_dokumen->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_jenis_dokumen")) {
            $this->jenis_dokumen->setOldValue($CurrentForm->getValue("o_jenis_dokumen"));
        }

        // Check field name 'tujuan_penerima' first before field var 'x_tujuan_penerima'
        $val = $CurrentForm->hasValue("tujuan_penerima") ? $CurrentForm->getValue("tujuan_penerima") : $CurrentForm->getValue("x_tujuan_penerima");
        if (!$this->tujuan_penerima->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tujuan_penerima->Visible = false; // Disable update for API request
            } else {
                $this->tujuan_penerima->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_tujuan_penerima")) {
            $this->tujuan_penerima->setOldValue($CurrentForm->getValue("o_tujuan_penerima"));
        }

        // Check field name 'no_hp_penerima' first before field var 'x_no_hp_penerima'
        $val = $CurrentForm->hasValue("no_hp_penerima") ? $CurrentForm->getValue("no_hp_penerima") : $CurrentForm->getValue("x_no_hp_penerima");
        if (!$this->no_hp_penerima->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no_hp_penerima->Visible = false; // Disable update for API request
            } else {
                $this->no_hp_penerima->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_no_hp_penerima")) {
            $this->no_hp_penerima->setOldValue($CurrentForm->getValue("o_no_hp_penerima"));
        }

        // Check field name 'email_penerima' first before field var 'x_email_penerima'
        $val = $CurrentForm->hasValue("email_penerima") ? $CurrentForm->getValue("email_penerima") : $CurrentForm->getValue("x_email_penerima");
        if (!$this->email_penerima->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->email_penerima->Visible = false; // Disable update for API request
            } else {
                $this->email_penerima->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_email_penerima")) {
            $this->email_penerima->setOldValue($CurrentForm->getValue("o_email_penerima"));
        }

        // Check field name 'status' first before field var 'x_status'
        $val = $CurrentForm->hasValue("status") ? $CurrentForm->getValue("status") : $CurrentForm->getValue("x_status");
        if (!$this->status->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->status->Visible = false; // Disable update for API request
            } else {
                $this->status->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_status")) {
            $this->status->setOldValue($CurrentForm->getValue("o_status"));
        }

        // Check field name 'tanggal_terima' first before field var 'x_tanggal_terima'
        $val = $CurrentForm->hasValue("tanggal_terima") ? $CurrentForm->getValue("tanggal_terima") : $CurrentForm->getValue("x_tanggal_terima");
        if (!$this->tanggal_terima->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tanggal_terima->Visible = false; // Disable update for API request
            } else {
                $this->tanggal_terima->setFormValue($val, true, $validate);
            }
            $this->tanggal_terima->CurrentValue = UnFormatDateTime($this->tanggal_terima->CurrentValue, $this->tanggal_terima->formatPattern());
        }
        if ($CurrentForm->hasValue("o_tanggal_terima")) {
            $this->tanggal_terima->setOldValue($CurrentForm->getValue("o_tanggal_terima"));
        }

        // Check field name 'jenis_pengirim' first before field var 'x_jenis_pengirim'
        $val = $CurrentForm->hasValue("jenis_pengirim") ? $CurrentForm->getValue("jenis_pengirim") : $CurrentForm->getValue("x_jenis_pengirim");
        if (!$this->jenis_pengirim->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jenis_pengirim->Visible = false; // Disable update for API request
            } else {
                $this->jenis_pengirim->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_jenis_pengirim")) {
            $this->jenis_pengirim->setOldValue($CurrentForm->getValue("o_jenis_pengirim"));
        }

        // Check field name 'nama_kurir' first before field var 'x_nama_kurir'
        $val = $CurrentForm->hasValue("nama_kurir") ? $CurrentForm->getValue("nama_kurir") : $CurrentForm->getValue("x_nama_kurir");
        if (!$this->nama_kurir->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nama_kurir->Visible = false; // Disable update for API request
            } else {
                $this->nama_kurir->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_nama_kurir")) {
            $this->nama_kurir->setOldValue($CurrentForm->getValue("o_nama_kurir"));
        }

        // Check field name 'no_awb' first before field var 'x_no_awb'
        $val = $CurrentForm->hasValue("no_awb") ? $CurrentForm->getValue("no_awb") : $CurrentForm->getValue("x_no_awb");
        if (!$this->no_awb->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no_awb->Visible = false; // Disable update for API request
            } else {
                $this->no_awb->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_no_awb")) {
            $this->no_awb->setOldValue($CurrentForm->getValue("o_no_awb"));
        }

        // Check field name 'id_user' first before field var 'x_id_user'
        $val = $CurrentForm->hasValue("id_user") ? $CurrentForm->getValue("id_user") : $CurrentForm->getValue("x_id_user");
        if (!$this->id_user->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->id_user->Visible = false; // Disable update for API request
            } else {
                $this->id_user->setFormValue($val, true, $validate);
            }
        }
        if ($CurrentForm->hasValue("o_id_user")) {
            $this->id_user->setOldValue($CurrentForm->getValue("o_id_user"));
        }

        // Check field name 'nama_penerima' first before field var 'x_nama_penerima'
        $val = $CurrentForm->hasValue("nama_penerima") ? $CurrentForm->getValue("nama_penerima") : $CurrentForm->getValue("x_nama_penerima");
        if (!$this->nama_penerima->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nama_penerima->Visible = false; // Disable update for API request
            } else {
                $this->nama_penerima->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_nama_penerima")) {
            $this->nama_penerima->setOldValue($CurrentForm->getValue("o_nama_penerima"));
        }

        // Check field name 'status_sap' first before field var 'x_status_sap'
        $val = $CurrentForm->hasValue("status_sap") ? $CurrentForm->getValue("status_sap") : $CurrentForm->getValue("x_status_sap");
        if (!$this->status_sap->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->status_sap->Visible = false; // Disable update for API request
            } else {
                $this->status_sap->setFormValue($val, true, $validate);
            }
        }
        if ($CurrentForm->hasValue("o_status_sap")) {
            $this->status_sap->setOldValue($CurrentForm->getValue("o_status_sap"));
        }
        $this->getUploadFiles(); // Get upload files
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        if (!$this->isGridAdd() && !$this->isAdd()) {
            $this->id->CurrentValue = $this->id->FormValue;
        }
        $this->no_dokumen->CurrentValue = $this->no_dokumen->FormValue;
        $this->no_paket->CurrentValue = $this->no_paket->FormValue;
        $this->jenis_dokumen->CurrentValue = $this->jenis_dokumen->FormValue;
        $this->tujuan_penerima->CurrentValue = $this->tujuan_penerima->FormValue;
        $this->no_hp_penerima->CurrentValue = $this->no_hp_penerima->FormValue;
        $this->email_penerima->CurrentValue = $this->email_penerima->FormValue;
        $this->status->CurrentValue = $this->status->FormValue;
        $this->tanggal_terima->CurrentValue = $this->tanggal_terima->FormValue;
        $this->tanggal_terima->CurrentValue = UnFormatDateTime($this->tanggal_terima->CurrentValue, $this->tanggal_terima->formatPattern());
        $this->jenis_pengirim->CurrentValue = $this->jenis_pengirim->FormValue;
        $this->nama_kurir->CurrentValue = $this->nama_kurir->FormValue;
        $this->no_awb->CurrentValue = $this->no_awb->FormValue;
        $this->id_user->CurrentValue = $this->id_user->FormValue;
        $this->nama_penerima->CurrentValue = $this->nama_penerima->FormValue;
        $this->status_sap->CurrentValue = $this->status_sap->FormValue;
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
        $this->id->setDbValue($row['id']);
        $this->no_dokumen->setDbValue($row['no_dokumen']);
        $this->no_paket->setDbValue($row['no_paket']);
        $this->jenis_dokumen->setDbValue($row['jenis_dokumen']);
        $this->tujuan_penerima->setDbValue($row['tujuan_penerima']);
        $this->no_hp_penerima->setDbValue($row['no_hp_penerima']);
        $this->email_penerima->setDbValue($row['email_penerima']);
        $this->status->setDbValue($row['status']);
        $this->tanggal_terima->setDbValue($row['tanggal_terima']);
        $this->jenis_pengirim->setDbValue($row['jenis_pengirim']);
        $this->nama_kurir->setDbValue($row['nama_kurir']);
        $this->no_awb->setDbValue($row['no_awb']);
        $this->id_user->setDbValue($row['id_user']);
        $this->created_date->setDbValue($row['created_date']);
        $this->bukti_penerimaan->Upload->DbValue = $row['bukti_penerimaan'];
        $this->bukti_penerimaan->setDbValue($this->bukti_penerimaan->Upload->DbValue);
        $this->bukti_penerimaan->Upload->Index = $this->RowIndex;
        $this->nama_penerima->setDbValue($row['nama_penerima']);
        $this->status_sap->setDbValue($row['status_sap']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['id'] = $this->id->CurrentValue;
        $row['no_dokumen'] = $this->no_dokumen->CurrentValue;
        $row['no_paket'] = $this->no_paket->CurrentValue;
        $row['jenis_dokumen'] = $this->jenis_dokumen->CurrentValue;
        $row['tujuan_penerima'] = $this->tujuan_penerima->CurrentValue;
        $row['no_hp_penerima'] = $this->no_hp_penerima->CurrentValue;
        $row['email_penerima'] = $this->email_penerima->CurrentValue;
        $row['status'] = $this->status->CurrentValue;
        $row['tanggal_terima'] = $this->tanggal_terima->CurrentValue;
        $row['jenis_pengirim'] = $this->jenis_pengirim->CurrentValue;
        $row['nama_kurir'] = $this->nama_kurir->CurrentValue;
        $row['no_awb'] = $this->no_awb->CurrentValue;
        $row['id_user'] = $this->id_user->CurrentValue;
        $row['created_date'] = $this->created_date->CurrentValue;
        $row['bukti_penerimaan'] = $this->bukti_penerimaan->Upload->DbValue;
        $row['nama_penerima'] = $this->nama_penerima->CurrentValue;
        $row['status_sap'] = $this->status_sap->CurrentValue;
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
        $this->CopyUrl = $this->getCopyUrl();
        $this->DeleteUrl = $this->getDeleteUrl();

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id
        $this->id->CellCssStyle = "white-space: nowrap;";

        // no_dokumen

        // no_paket

        // jenis_dokumen

        // tujuan_penerima

        // no_hp_penerima

        // email_penerima

        // status

        // tanggal_terima

        // jenis_pengirim

        // nama_kurir

        // no_awb

        // id_user

        // created_date
        $this->created_date->CellCssStyle = "white-space: nowrap;";

        // bukti_penerimaan

        // nama_penerima

        // status_sap
        $this->status_sap->CellCssStyle = "white-space: nowrap;";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // no_dokumen
            $this->no_dokumen->ViewValue = $this->no_dokumen->CurrentValue;
            $this->no_dokumen->ViewCustomAttributes = "";

            // no_paket
            $this->no_paket->ViewValue = $this->no_paket->CurrentValue;
            $this->no_paket->ViewCustomAttributes = "";

            // jenis_dokumen
            $curVal = strval($this->jenis_dokumen->CurrentValue);
            if ($curVal != "") {
                $this->jenis_dokumen->ViewValue = $this->jenis_dokumen->lookupCacheOption($curVal);
                if ($this->jenis_dokumen->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->jenis_dokumen->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->jenis_dokumen->Lookup->renderViewRow($rswrk[0]);
                        $this->jenis_dokumen->ViewValue = $this->jenis_dokumen->displayValue($arwrk);
                    } else {
                        $this->jenis_dokumen->ViewValue = FormatNumber($this->jenis_dokumen->CurrentValue, $this->jenis_dokumen->formatPattern());
                    }
                }
            } else {
                $this->jenis_dokumen->ViewValue = null;
            }
            $this->jenis_dokumen->ViewCustomAttributes = "";

            // tujuan_penerima
            $this->tujuan_penerima->ViewValue = $this->tujuan_penerima->CurrentValue;
            $this->tujuan_penerima->ViewCustomAttributes = "";

            // no_hp_penerima
            $this->no_hp_penerima->ViewValue = $this->no_hp_penerima->CurrentValue;
            $this->no_hp_penerima->ViewCustomAttributes = "";

            // email_penerima
            $this->email_penerima->ViewValue = $this->email_penerima->CurrentValue;
            $this->email_penerima->ViewCustomAttributes = "";

            // status
            $curVal = strval($this->status->CurrentValue);
            if ($curVal != "") {
                $this->status->ViewValue = $this->status->lookupCacheOption($curVal);
                if ($this->status->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->status->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->status->Lookup->renderViewRow($rswrk[0]);
                        $this->status->ViewValue = $this->status->displayValue($arwrk);
                    } else {
                        $this->status->ViewValue = FormatNumber($this->status->CurrentValue, $this->status->formatPattern());
                    }
                }
            } else {
                $this->status->ViewValue = null;
            }
            $this->status->ViewCustomAttributes = "";

            // tanggal_terima
            $this->tanggal_terima->ViewValue = $this->tanggal_terima->CurrentValue;
            $this->tanggal_terima->ViewValue = FormatDateTime($this->tanggal_terima->ViewValue, $this->tanggal_terima->formatPattern());
            $this->tanggal_terima->ViewCustomAttributes = "";

            // jenis_pengirim
            $curVal = strval($this->jenis_pengirim->CurrentValue);
            if ($curVal != "") {
                $this->jenis_pengirim->ViewValue = $this->jenis_pengirim->lookupCacheOption($curVal);
                if ($this->jenis_pengirim->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->jenis_pengirim->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->jenis_pengirim->Lookup->renderViewRow($rswrk[0]);
                        $this->jenis_pengirim->ViewValue = $this->jenis_pengirim->displayValue($arwrk);
                    } else {
                        $this->jenis_pengirim->ViewValue = FormatNumber($this->jenis_pengirim->CurrentValue, $this->jenis_pengirim->formatPattern());
                    }
                }
            } else {
                $this->jenis_pengirim->ViewValue = null;
            }
            $this->jenis_pengirim->ViewCustomAttributes = "";

            // nama_kurir
            if (strval($this->nama_kurir->CurrentValue) != "") {
                $this->nama_kurir->ViewValue = $this->nama_kurir->optionCaption($this->nama_kurir->CurrentValue);
            } else {
                $this->nama_kurir->ViewValue = null;
            }
            $this->nama_kurir->ViewCustomAttributes = "";

            // no_awb
            $this->no_awb->ViewValue = $this->no_awb->CurrentValue;
            $this->no_awb->ViewCustomAttributes = "";

            // id_user
            $this->id_user->ViewValue = $this->id_user->CurrentValue;
            $this->id_user->ViewValue = FormatNumber($this->id_user->ViewValue, $this->id_user->formatPattern());
            $this->id_user->ViewCustomAttributes = "";

            // bukti_penerimaan
            if (!EmptyValue($this->bukti_penerimaan->Upload->DbValue)) {
                $this->bukti_penerimaan->ImageWidth = 100;
                $this->bukti_penerimaan->ImageHeight = 0;
                $this->bukti_penerimaan->ImageAlt = $this->bukti_penerimaan->alt();
                $this->bukti_penerimaan->ImageCssClass = "ew-image";
                $this->bukti_penerimaan->ViewValue = $this->bukti_penerimaan->Upload->DbValue;
            } else {
                $this->bukti_penerimaan->ViewValue = "";
            }
            $this->bukti_penerimaan->ViewCustomAttributes = "";

            // nama_penerima
            $this->nama_penerima->ViewValue = $this->nama_penerima->CurrentValue;
            $this->nama_penerima->ViewCustomAttributes = "";

            // status_sap
            $this->status_sap->ViewValue = $this->status_sap->CurrentValue;
            $this->status_sap->ViewValue = FormatNumber($this->status_sap->ViewValue, $this->status_sap->formatPattern());
            $this->status_sap->ViewCustomAttributes = "";

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";
            $this->id->TooltipValue = "";

            // no_dokumen
            $this->no_dokumen->LinkCustomAttributes = "";
            $this->no_dokumen->HrefValue = "";
            $this->no_dokumen->TooltipValue = "";

            // no_paket
            $this->no_paket->LinkCustomAttributes = "";
            $this->no_paket->HrefValue = "";
            $this->no_paket->TooltipValue = "";

            // jenis_dokumen
            $this->jenis_dokumen->LinkCustomAttributes = "";
            $this->jenis_dokumen->HrefValue = "";
            $this->jenis_dokumen->TooltipValue = "";

            // tujuan_penerima
            $this->tujuan_penerima->LinkCustomAttributes = "";
            $this->tujuan_penerima->HrefValue = "";
            $this->tujuan_penerima->TooltipValue = "";

            // no_hp_penerima
            $this->no_hp_penerima->LinkCustomAttributes = "";
            $this->no_hp_penerima->HrefValue = "";
            $this->no_hp_penerima->TooltipValue = "";

            // email_penerima
            $this->email_penerima->LinkCustomAttributes = "";
            $this->email_penerima->HrefValue = "";
            $this->email_penerima->TooltipValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";
            $this->status->TooltipValue = "";

            // tanggal_terima
            $this->tanggal_terima->LinkCustomAttributes = "";
            $this->tanggal_terima->HrefValue = "";
            $this->tanggal_terima->TooltipValue = "";

            // jenis_pengirim
            $this->jenis_pengirim->LinkCustomAttributes = "";
            $this->jenis_pengirim->HrefValue = "";
            $this->jenis_pengirim->TooltipValue = "";

            // nama_kurir
            $this->nama_kurir->LinkCustomAttributes = "";
            $this->nama_kurir->HrefValue = "";
            $this->nama_kurir->TooltipValue = "";

            // no_awb
            $this->no_awb->LinkCustomAttributes = "";
            $this->no_awb->HrefValue = "";
            $this->no_awb->TooltipValue = "";

            // id_user
            $this->id_user->LinkCustomAttributes = "";
            $this->id_user->HrefValue = "";
            $this->id_user->TooltipValue = "";

            // bukti_penerimaan
            $this->bukti_penerimaan->LinkCustomAttributes = "";
            if (!EmptyValue($this->bukti_penerimaan->Upload->DbValue)) {
                $this->bukti_penerimaan->HrefValue = GetFileUploadUrl($this->bukti_penerimaan, $this->bukti_penerimaan->htmlDecode($this->bukti_penerimaan->Upload->DbValue)); // Add prefix/suffix
                $this->bukti_penerimaan->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->bukti_penerimaan->HrefValue = FullUrl($this->bukti_penerimaan->HrefValue, "href");
                }
            } else {
                $this->bukti_penerimaan->HrefValue = "";
            }
            $this->bukti_penerimaan->ExportHrefValue = $this->bukti_penerimaan->UploadPath . $this->bukti_penerimaan->Upload->DbValue;
            $this->bukti_penerimaan->TooltipValue = "";
            if ($this->bukti_penerimaan->UseColorbox) {
                if (EmptyValue($this->bukti_penerimaan->TooltipValue)) {
                    $this->bukti_penerimaan->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
                }
                $this->bukti_penerimaan->LinkAttrs["data-rel"] = "penerimaan_paket_keluar_x" . $this->RowCount . "_bukti_penerimaan";
                $this->bukti_penerimaan->LinkAttrs->appendClass("ew-lightbox");
            }

            // nama_penerima
            $this->nama_penerima->LinkCustomAttributes = "";
            $this->nama_penerima->HrefValue = "";
            $this->nama_penerima->TooltipValue = "";

            // status_sap
            $this->status_sap->LinkCustomAttributes = "";
            $this->status_sap->HrefValue = "";
            $this->status_sap->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // id

            // no_dokumen
            $this->no_dokumen->setupEditAttributes();
            $this->no_dokumen->EditCustomAttributes = "";
            if (!$this->no_dokumen->Raw) {
                $this->no_dokumen->CurrentValue = HtmlDecode($this->no_dokumen->CurrentValue);
            }
            $this->no_dokumen->EditValue = HtmlEncode($this->no_dokumen->CurrentValue);
            $this->no_dokumen->PlaceHolder = RemoveHtml($this->no_dokumen->caption());

            // no_paket
            $this->no_paket->setupEditAttributes();
            $this->no_paket->EditCustomAttributes = "";
            if (!$this->no_paket->Raw) {
                $this->no_paket->CurrentValue = HtmlDecode($this->no_paket->CurrentValue);
            }
            $this->no_paket->EditValue = HtmlEncode($this->no_paket->CurrentValue);
            $this->no_paket->PlaceHolder = RemoveHtml($this->no_paket->caption());

            // jenis_dokumen
            $this->jenis_dokumen->setupEditAttributes();
            $this->jenis_dokumen->EditCustomAttributes = "";
            $curVal = trim(strval($this->jenis_dokumen->CurrentValue));
            if ($curVal != "") {
                $this->jenis_dokumen->ViewValue = $this->jenis_dokumen->lookupCacheOption($curVal);
            } else {
                $this->jenis_dokumen->ViewValue = $this->jenis_dokumen->Lookup !== null && is_array($this->jenis_dokumen->lookupOptions()) ? $curVal : null;
            }
            if ($this->jenis_dokumen->ViewValue !== null) { // Load from cache
                $this->jenis_dokumen->EditValue = array_values($this->jenis_dokumen->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->jenis_dokumen->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->jenis_dokumen->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->jenis_dokumen->EditValue = $arwrk;
            }
            $this->jenis_dokumen->PlaceHolder = RemoveHtml($this->jenis_dokumen->caption());

            // tujuan_penerima
            $this->tujuan_penerima->setupEditAttributes();
            $this->tujuan_penerima->EditCustomAttributes = "";
            $this->tujuan_penerima->EditValue = HtmlEncode($this->tujuan_penerima->CurrentValue);
            $this->tujuan_penerima->PlaceHolder = RemoveHtml($this->tujuan_penerima->caption());

            // no_hp_penerima
            $this->no_hp_penerima->setupEditAttributes();
            $this->no_hp_penerima->EditCustomAttributes = "";
            if (!$this->no_hp_penerima->Raw) {
                $this->no_hp_penerima->CurrentValue = HtmlDecode($this->no_hp_penerima->CurrentValue);
            }
            $this->no_hp_penerima->EditValue = HtmlEncode($this->no_hp_penerima->CurrentValue);
            $this->no_hp_penerima->PlaceHolder = RemoveHtml($this->no_hp_penerima->caption());

            // email_penerima
            $this->email_penerima->setupEditAttributes();
            $this->email_penerima->EditCustomAttributes = "";
            if (!$this->email_penerima->Raw) {
                $this->email_penerima->CurrentValue = HtmlDecode($this->email_penerima->CurrentValue);
            }
            $this->email_penerima->EditValue = HtmlEncode($this->email_penerima->CurrentValue);
            $this->email_penerima->PlaceHolder = RemoveHtml($this->email_penerima->caption());

            // status
            $this->status->setupEditAttributes();
            $this->status->EditCustomAttributes = "";
            $curVal = trim(strval($this->status->CurrentValue));
            if ($curVal != "") {
                $this->status->ViewValue = $this->status->lookupCacheOption($curVal);
            } else {
                $this->status->ViewValue = $this->status->Lookup !== null && is_array($this->status->lookupOptions()) ? $curVal : null;
            }
            if ($this->status->ViewValue !== null) { // Load from cache
                $this->status->EditValue = array_values($this->status->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->status->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->status->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->status->EditValue = $arwrk;
            }
            $this->status->PlaceHolder = RemoveHtml($this->status->caption());

            // tanggal_terima
            $this->tanggal_terima->setupEditAttributes();
            $this->tanggal_terima->EditCustomAttributes = "";
            $this->tanggal_terima->EditValue = HtmlEncode(FormatDateTime($this->tanggal_terima->CurrentValue, $this->tanggal_terima->formatPattern()));
            $this->tanggal_terima->PlaceHolder = RemoveHtml($this->tanggal_terima->caption());

            // jenis_pengirim
            $this->jenis_pengirim->setupEditAttributes();
            $this->jenis_pengirim->EditCustomAttributes = "";
            $curVal = trim(strval($this->jenis_pengirim->CurrentValue));
            if ($curVal != "") {
                $this->jenis_pengirim->ViewValue = $this->jenis_pengirim->lookupCacheOption($curVal);
            } else {
                $this->jenis_pengirim->ViewValue = $this->jenis_pengirim->Lookup !== null && is_array($this->jenis_pengirim->lookupOptions()) ? $curVal : null;
            }
            if ($this->jenis_pengirim->ViewValue !== null) { // Load from cache
                $this->jenis_pengirim->EditValue = array_values($this->jenis_pengirim->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->jenis_pengirim->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->jenis_pengirim->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->jenis_pengirim->EditValue = $arwrk;
            }
            $this->jenis_pengirim->PlaceHolder = RemoveHtml($this->jenis_pengirim->caption());

            // nama_kurir
            $this->nama_kurir->setupEditAttributes();
            $this->nama_kurir->EditCustomAttributes = "";
            $this->nama_kurir->EditValue = $this->nama_kurir->options(true);
            $this->nama_kurir->PlaceHolder = RemoveHtml($this->nama_kurir->caption());

            // no_awb
            $this->no_awb->setupEditAttributes();
            $this->no_awb->EditCustomAttributes = "";
            if (!$this->no_awb->Raw) {
                $this->no_awb->CurrentValue = HtmlDecode($this->no_awb->CurrentValue);
            }
            $this->no_awb->EditValue = HtmlEncode($this->no_awb->CurrentValue);
            $this->no_awb->PlaceHolder = RemoveHtml($this->no_awb->caption());

            // id_user
            $this->id_user->setupEditAttributes();
            $this->id_user->EditCustomAttributes = "";
            if ($this->id_user->getSessionValue() != "") {
                $this->id_user->CurrentValue = GetForeignKeyValue($this->id_user->getSessionValue());
                $this->id_user->OldValue = $this->id_user->CurrentValue;
                $this->id_user->ViewValue = $this->id_user->CurrentValue;
                $this->id_user->ViewValue = FormatNumber($this->id_user->ViewValue, $this->id_user->formatPattern());
                $this->id_user->ViewCustomAttributes = "";
            } else {
                $this->id_user->EditValue = HtmlEncode($this->id_user->CurrentValue);
                $this->id_user->PlaceHolder = RemoveHtml($this->id_user->caption());
                if (strval($this->id_user->EditValue) != "" && is_numeric($this->id_user->EditValue)) {
                    $this->id_user->EditValue = FormatNumber($this->id_user->EditValue, null);
                    $this->id_user->OldValue = $this->id_user->EditValue;
                }
            }

            // bukti_penerimaan
            $this->bukti_penerimaan->setupEditAttributes();
            $this->bukti_penerimaan->EditCustomAttributes = "";
            if (!EmptyValue($this->bukti_penerimaan->Upload->DbValue)) {
                $this->bukti_penerimaan->ImageWidth = 100;
                $this->bukti_penerimaan->ImageHeight = 0;
                $this->bukti_penerimaan->ImageAlt = $this->bukti_penerimaan->alt();
                $this->bukti_penerimaan->ImageCssClass = "ew-image";
                $this->bukti_penerimaan->EditValue = $this->bukti_penerimaan->Upload->DbValue;
            } else {
                $this->bukti_penerimaan->EditValue = "";
            }
            if (!EmptyValue($this->bukti_penerimaan->CurrentValue)) {
                if ($this->RowIndex == '$rowindex$') {
                    $this->bukti_penerimaan->Upload->FileName = "";
                } else {
                    $this->bukti_penerimaan->Upload->FileName = $this->bukti_penerimaan->CurrentValue;
                }
            }
            if (is_numeric($this->RowIndex)) {
                RenderUploadField($this->bukti_penerimaan, $this->RowIndex);
            }

            // nama_penerima
            $this->nama_penerima->setupEditAttributes();
            $this->nama_penerima->EditCustomAttributes = "";
            if (!$this->nama_penerima->Raw) {
                $this->nama_penerima->CurrentValue = HtmlDecode($this->nama_penerima->CurrentValue);
            }
            $this->nama_penerima->EditValue = HtmlEncode($this->nama_penerima->CurrentValue);
            $this->nama_penerima->PlaceHolder = RemoveHtml($this->nama_penerima->caption());

            // status_sap
            $this->status_sap->setupEditAttributes();
            $this->status_sap->EditCustomAttributes = "";
            $this->status_sap->EditValue = HtmlEncode($this->status_sap->CurrentValue);
            $this->status_sap->PlaceHolder = RemoveHtml($this->status_sap->caption());
            if (strval($this->status_sap->EditValue) != "" && is_numeric($this->status_sap->EditValue)) {
                $this->status_sap->EditValue = FormatNumber($this->status_sap->EditValue, null);
                $this->status_sap->OldValue = $this->status_sap->EditValue;
            }

            // Add refer script

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // no_dokumen
            $this->no_dokumen->LinkCustomAttributes = "";
            $this->no_dokumen->HrefValue = "";

            // no_paket
            $this->no_paket->LinkCustomAttributes = "";
            $this->no_paket->HrefValue = "";

            // jenis_dokumen
            $this->jenis_dokumen->LinkCustomAttributes = "";
            $this->jenis_dokumen->HrefValue = "";

            // tujuan_penerima
            $this->tujuan_penerima->LinkCustomAttributes = "";
            $this->tujuan_penerima->HrefValue = "";

            // no_hp_penerima
            $this->no_hp_penerima->LinkCustomAttributes = "";
            $this->no_hp_penerima->HrefValue = "";

            // email_penerima
            $this->email_penerima->LinkCustomAttributes = "";
            $this->email_penerima->HrefValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";

            // tanggal_terima
            $this->tanggal_terima->LinkCustomAttributes = "";
            $this->tanggal_terima->HrefValue = "";

            // jenis_pengirim
            $this->jenis_pengirim->LinkCustomAttributes = "";
            $this->jenis_pengirim->HrefValue = "";

            // nama_kurir
            $this->nama_kurir->LinkCustomAttributes = "";
            $this->nama_kurir->HrefValue = "";

            // no_awb
            $this->no_awb->LinkCustomAttributes = "";
            $this->no_awb->HrefValue = "";

            // id_user
            $this->id_user->LinkCustomAttributes = "";
            $this->id_user->HrefValue = "";

            // bukti_penerimaan
            $this->bukti_penerimaan->LinkCustomAttributes = "";
            if (!EmptyValue($this->bukti_penerimaan->Upload->DbValue)) {
                $this->bukti_penerimaan->HrefValue = GetFileUploadUrl($this->bukti_penerimaan, $this->bukti_penerimaan->htmlDecode($this->bukti_penerimaan->Upload->DbValue)); // Add prefix/suffix
                $this->bukti_penerimaan->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->bukti_penerimaan->HrefValue = FullUrl($this->bukti_penerimaan->HrefValue, "href");
                }
            } else {
                $this->bukti_penerimaan->HrefValue = "";
            }
            $this->bukti_penerimaan->ExportHrefValue = $this->bukti_penerimaan->UploadPath . $this->bukti_penerimaan->Upload->DbValue;

            // nama_penerima
            $this->nama_penerima->LinkCustomAttributes = "";
            $this->nama_penerima->HrefValue = "";

            // status_sap
            $this->status_sap->LinkCustomAttributes = "";
            $this->status_sap->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // id
            $this->id->setupEditAttributes();
            $this->id->EditCustomAttributes = "";
            $this->id->EditValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // no_dokumen
            $this->no_dokumen->setupEditAttributes();
            $this->no_dokumen->EditCustomAttributes = "";
            if (!$this->no_dokumen->Raw) {
                $this->no_dokumen->CurrentValue = HtmlDecode($this->no_dokumen->CurrentValue);
            }
            $this->no_dokumen->EditValue = HtmlEncode($this->no_dokumen->CurrentValue);
            $this->no_dokumen->PlaceHolder = RemoveHtml($this->no_dokumen->caption());

            // no_paket
            $this->no_paket->setupEditAttributes();
            $this->no_paket->EditCustomAttributes = "";
            if (!$this->no_paket->Raw) {
                $this->no_paket->CurrentValue = HtmlDecode($this->no_paket->CurrentValue);
            }
            $this->no_paket->EditValue = HtmlEncode($this->no_paket->CurrentValue);
            $this->no_paket->PlaceHolder = RemoveHtml($this->no_paket->caption());

            // jenis_dokumen
            $this->jenis_dokumen->setupEditAttributes();
            $this->jenis_dokumen->EditCustomAttributes = "";
            $curVal = trim(strval($this->jenis_dokumen->CurrentValue));
            if ($curVal != "") {
                $this->jenis_dokumen->ViewValue = $this->jenis_dokumen->lookupCacheOption($curVal);
            } else {
                $this->jenis_dokumen->ViewValue = $this->jenis_dokumen->Lookup !== null && is_array($this->jenis_dokumen->lookupOptions()) ? $curVal : null;
            }
            if ($this->jenis_dokumen->ViewValue !== null) { // Load from cache
                $this->jenis_dokumen->EditValue = array_values($this->jenis_dokumen->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->jenis_dokumen->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->jenis_dokumen->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->jenis_dokumen->EditValue = $arwrk;
            }
            $this->jenis_dokumen->PlaceHolder = RemoveHtml($this->jenis_dokumen->caption());

            // tujuan_penerima
            $this->tujuan_penerima->setupEditAttributes();
            $this->tujuan_penerima->EditCustomAttributes = "";
            $this->tujuan_penerima->EditValue = HtmlEncode($this->tujuan_penerima->CurrentValue);
            $this->tujuan_penerima->PlaceHolder = RemoveHtml($this->tujuan_penerima->caption());

            // no_hp_penerima
            $this->no_hp_penerima->setupEditAttributes();
            $this->no_hp_penerima->EditCustomAttributes = "";
            if (!$this->no_hp_penerima->Raw) {
                $this->no_hp_penerima->CurrentValue = HtmlDecode($this->no_hp_penerima->CurrentValue);
            }
            $this->no_hp_penerima->EditValue = HtmlEncode($this->no_hp_penerima->CurrentValue);
            $this->no_hp_penerima->PlaceHolder = RemoveHtml($this->no_hp_penerima->caption());

            // email_penerima
            $this->email_penerima->setupEditAttributes();
            $this->email_penerima->EditCustomAttributes = "";
            if (!$this->email_penerima->Raw) {
                $this->email_penerima->CurrentValue = HtmlDecode($this->email_penerima->CurrentValue);
            }
            $this->email_penerima->EditValue = HtmlEncode($this->email_penerima->CurrentValue);
            $this->email_penerima->PlaceHolder = RemoveHtml($this->email_penerima->caption());

            // status
            $this->status->setupEditAttributes();
            $this->status->EditCustomAttributes = "";
            $curVal = trim(strval($this->status->CurrentValue));
            if ($curVal != "") {
                $this->status->ViewValue = $this->status->lookupCacheOption($curVal);
            } else {
                $this->status->ViewValue = $this->status->Lookup !== null && is_array($this->status->lookupOptions()) ? $curVal : null;
            }
            if ($this->status->ViewValue !== null) { // Load from cache
                $this->status->EditValue = array_values($this->status->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->status->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->status->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->status->EditValue = $arwrk;
            }
            $this->status->PlaceHolder = RemoveHtml($this->status->caption());

            // tanggal_terima
            $this->tanggal_terima->setupEditAttributes();
            $this->tanggal_terima->EditCustomAttributes = "";
            $this->tanggal_terima->EditValue = HtmlEncode(FormatDateTime($this->tanggal_terima->CurrentValue, $this->tanggal_terima->formatPattern()));
            $this->tanggal_terima->PlaceHolder = RemoveHtml($this->tanggal_terima->caption());

            // jenis_pengirim
            $this->jenis_pengirim->setupEditAttributes();
            $this->jenis_pengirim->EditCustomAttributes = "";
            $curVal = trim(strval($this->jenis_pengirim->CurrentValue));
            if ($curVal != "") {
                $this->jenis_pengirim->ViewValue = $this->jenis_pengirim->lookupCacheOption($curVal);
            } else {
                $this->jenis_pengirim->ViewValue = $this->jenis_pengirim->Lookup !== null && is_array($this->jenis_pengirim->lookupOptions()) ? $curVal : null;
            }
            if ($this->jenis_pengirim->ViewValue !== null) { // Load from cache
                $this->jenis_pengirim->EditValue = array_values($this->jenis_pengirim->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->jenis_pengirim->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->jenis_pengirim->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->jenis_pengirim->EditValue = $arwrk;
            }
            $this->jenis_pengirim->PlaceHolder = RemoveHtml($this->jenis_pengirim->caption());

            // nama_kurir
            $this->nama_kurir->setupEditAttributes();
            $this->nama_kurir->EditCustomAttributes = "";
            $this->nama_kurir->EditValue = $this->nama_kurir->options(true);
            $this->nama_kurir->PlaceHolder = RemoveHtml($this->nama_kurir->caption());

            // no_awb
            $this->no_awb->setupEditAttributes();
            $this->no_awb->EditCustomAttributes = "";
            if (!$this->no_awb->Raw) {
                $this->no_awb->CurrentValue = HtmlDecode($this->no_awb->CurrentValue);
            }
            $this->no_awb->EditValue = HtmlEncode($this->no_awb->CurrentValue);
            $this->no_awb->PlaceHolder = RemoveHtml($this->no_awb->caption());

            // id_user
            $this->id_user->setupEditAttributes();
            $this->id_user->EditCustomAttributes = "";
            if ($this->id_user->getSessionValue() != "") {
                $this->id_user->CurrentValue = GetForeignKeyValue($this->id_user->getSessionValue());
                $this->id_user->OldValue = $this->id_user->CurrentValue;
                $this->id_user->ViewValue = $this->id_user->CurrentValue;
                $this->id_user->ViewValue = FormatNumber($this->id_user->ViewValue, $this->id_user->formatPattern());
                $this->id_user->ViewCustomAttributes = "";
            } else {
                $this->id_user->EditValue = HtmlEncode($this->id_user->CurrentValue);
                $this->id_user->PlaceHolder = RemoveHtml($this->id_user->caption());
                if (strval($this->id_user->EditValue) != "" && is_numeric($this->id_user->EditValue)) {
                    $this->id_user->EditValue = FormatNumber($this->id_user->EditValue, null);
                    $this->id_user->OldValue = $this->id_user->EditValue;
                }
            }

            // bukti_penerimaan
            $this->bukti_penerimaan->setupEditAttributes();
            $this->bukti_penerimaan->EditCustomAttributes = "";
            if (!EmptyValue($this->bukti_penerimaan->Upload->DbValue)) {
                $this->bukti_penerimaan->ImageWidth = 100;
                $this->bukti_penerimaan->ImageHeight = 0;
                $this->bukti_penerimaan->ImageAlt = $this->bukti_penerimaan->alt();
                $this->bukti_penerimaan->ImageCssClass = "ew-image";
                $this->bukti_penerimaan->EditValue = $this->bukti_penerimaan->Upload->DbValue;
            } else {
                $this->bukti_penerimaan->EditValue = "";
            }
            if (!EmptyValue($this->bukti_penerimaan->CurrentValue)) {
                if ($this->RowIndex == '$rowindex$') {
                    $this->bukti_penerimaan->Upload->FileName = "";
                } else {
                    $this->bukti_penerimaan->Upload->FileName = $this->bukti_penerimaan->CurrentValue;
                }
            }
            if (is_numeric($this->RowIndex)) {
                RenderUploadField($this->bukti_penerimaan, $this->RowIndex);
            }

            // nama_penerima
            $this->nama_penerima->setupEditAttributes();
            $this->nama_penerima->EditCustomAttributes = "";
            if (!$this->nama_penerima->Raw) {
                $this->nama_penerima->CurrentValue = HtmlDecode($this->nama_penerima->CurrentValue);
            }
            $this->nama_penerima->EditValue = HtmlEncode($this->nama_penerima->CurrentValue);
            $this->nama_penerima->PlaceHolder = RemoveHtml($this->nama_penerima->caption());

            // status_sap
            $this->status_sap->setupEditAttributes();
            $this->status_sap->EditCustomAttributes = "";
            $this->status_sap->EditValue = HtmlEncode($this->status_sap->CurrentValue);
            $this->status_sap->PlaceHolder = RemoveHtml($this->status_sap->caption());
            if (strval($this->status_sap->EditValue) != "" && is_numeric($this->status_sap->EditValue)) {
                $this->status_sap->EditValue = FormatNumber($this->status_sap->EditValue, null);
                $this->status_sap->OldValue = $this->status_sap->EditValue;
            }

            // Edit refer script

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // no_dokumen
            $this->no_dokumen->LinkCustomAttributes = "";
            $this->no_dokumen->HrefValue = "";

            // no_paket
            $this->no_paket->LinkCustomAttributes = "";
            $this->no_paket->HrefValue = "";

            // jenis_dokumen
            $this->jenis_dokumen->LinkCustomAttributes = "";
            $this->jenis_dokumen->HrefValue = "";

            // tujuan_penerima
            $this->tujuan_penerima->LinkCustomAttributes = "";
            $this->tujuan_penerima->HrefValue = "";

            // no_hp_penerima
            $this->no_hp_penerima->LinkCustomAttributes = "";
            $this->no_hp_penerima->HrefValue = "";

            // email_penerima
            $this->email_penerima->LinkCustomAttributes = "";
            $this->email_penerima->HrefValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";

            // tanggal_terima
            $this->tanggal_terima->LinkCustomAttributes = "";
            $this->tanggal_terima->HrefValue = "";

            // jenis_pengirim
            $this->jenis_pengirim->LinkCustomAttributes = "";
            $this->jenis_pengirim->HrefValue = "";

            // nama_kurir
            $this->nama_kurir->LinkCustomAttributes = "";
            $this->nama_kurir->HrefValue = "";

            // no_awb
            $this->no_awb->LinkCustomAttributes = "";
            $this->no_awb->HrefValue = "";

            // id_user
            $this->id_user->LinkCustomAttributes = "";
            $this->id_user->HrefValue = "";

            // bukti_penerimaan
            $this->bukti_penerimaan->LinkCustomAttributes = "";
            if (!EmptyValue($this->bukti_penerimaan->Upload->DbValue)) {
                $this->bukti_penerimaan->HrefValue = GetFileUploadUrl($this->bukti_penerimaan, $this->bukti_penerimaan->htmlDecode($this->bukti_penerimaan->Upload->DbValue)); // Add prefix/suffix
                $this->bukti_penerimaan->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->bukti_penerimaan->HrefValue = FullUrl($this->bukti_penerimaan->HrefValue, "href");
                }
            } else {
                $this->bukti_penerimaan->HrefValue = "";
            }
            $this->bukti_penerimaan->ExportHrefValue = $this->bukti_penerimaan->UploadPath . $this->bukti_penerimaan->Upload->DbValue;

            // nama_penerima
            $this->nama_penerima->LinkCustomAttributes = "";
            $this->nama_penerima->HrefValue = "";

            // status_sap
            $this->status_sap->LinkCustomAttributes = "";
            $this->status_sap->HrefValue = "";
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        $validateForm = true;
        if ($this->id->Required) {
            if (!$this->id->IsDetailKey && EmptyValue($this->id->FormValue)) {
                $this->id->addErrorMessage(str_replace("%s", $this->id->caption(), $this->id->RequiredErrorMessage));
            }
        }
        if ($this->no_dokumen->Required) {
            if (!$this->no_dokumen->IsDetailKey && EmptyValue($this->no_dokumen->FormValue)) {
                $this->no_dokumen->addErrorMessage(str_replace("%s", $this->no_dokumen->caption(), $this->no_dokumen->RequiredErrorMessage));
            }
        }
        if ($this->no_paket->Required) {
            if (!$this->no_paket->IsDetailKey && EmptyValue($this->no_paket->FormValue)) {
                $this->no_paket->addErrorMessage(str_replace("%s", $this->no_paket->caption(), $this->no_paket->RequiredErrorMessage));
            }
        }
        if ($this->jenis_dokumen->Required) {
            if (!$this->jenis_dokumen->IsDetailKey && EmptyValue($this->jenis_dokumen->FormValue)) {
                $this->jenis_dokumen->addErrorMessage(str_replace("%s", $this->jenis_dokumen->caption(), $this->jenis_dokumen->RequiredErrorMessage));
            }
        }
        if ($this->tujuan_penerima->Required) {
            if (!$this->tujuan_penerima->IsDetailKey && EmptyValue($this->tujuan_penerima->FormValue)) {
                $this->tujuan_penerima->addErrorMessage(str_replace("%s", $this->tujuan_penerima->caption(), $this->tujuan_penerima->RequiredErrorMessage));
            }
        }
        if ($this->no_hp_penerima->Required) {
            if (!$this->no_hp_penerima->IsDetailKey && EmptyValue($this->no_hp_penerima->FormValue)) {
                $this->no_hp_penerima->addErrorMessage(str_replace("%s", $this->no_hp_penerima->caption(), $this->no_hp_penerima->RequiredErrorMessage));
            }
        }
        if ($this->email_penerima->Required) {
            if (!$this->email_penerima->IsDetailKey && EmptyValue($this->email_penerima->FormValue)) {
                $this->email_penerima->addErrorMessage(str_replace("%s", $this->email_penerima->caption(), $this->email_penerima->RequiredErrorMessage));
            }
        }
        if ($this->status->Required) {
            if (!$this->status->IsDetailKey && EmptyValue($this->status->FormValue)) {
                $this->status->addErrorMessage(str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
            }
        }
        if ($this->tanggal_terima->Required) {
            if (!$this->tanggal_terima->IsDetailKey && EmptyValue($this->tanggal_terima->FormValue)) {
                $this->tanggal_terima->addErrorMessage(str_replace("%s", $this->tanggal_terima->caption(), $this->tanggal_terima->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->tanggal_terima->FormValue, $this->tanggal_terima->formatPattern())) {
            $this->tanggal_terima->addErrorMessage($this->tanggal_terima->getErrorMessage(false));
        }
        if ($this->jenis_pengirim->Required) {
            if (!$this->jenis_pengirim->IsDetailKey && EmptyValue($this->jenis_pengirim->FormValue)) {
                $this->jenis_pengirim->addErrorMessage(str_replace("%s", $this->jenis_pengirim->caption(), $this->jenis_pengirim->RequiredErrorMessage));
            }
        }
        if ($this->nama_kurir->Required) {
            if (!$this->nama_kurir->IsDetailKey && EmptyValue($this->nama_kurir->FormValue)) {
                $this->nama_kurir->addErrorMessage(str_replace("%s", $this->nama_kurir->caption(), $this->nama_kurir->RequiredErrorMessage));
            }
        }
        if ($this->no_awb->Required) {
            if (!$this->no_awb->IsDetailKey && EmptyValue($this->no_awb->FormValue)) {
                $this->no_awb->addErrorMessage(str_replace("%s", $this->no_awb->caption(), $this->no_awb->RequiredErrorMessage));
            }
        }
        if ($this->id_user->Required) {
            if (!$this->id_user->IsDetailKey && EmptyValue($this->id_user->FormValue)) {
                $this->id_user->addErrorMessage(str_replace("%s", $this->id_user->caption(), $this->id_user->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->id_user->FormValue)) {
            $this->id_user->addErrorMessage($this->id_user->getErrorMessage(false));
        }
        if ($this->bukti_penerimaan->Required) {
            if ($this->bukti_penerimaan->Upload->FileName == "" && !$this->bukti_penerimaan->Upload->KeepFile) {
                $this->bukti_penerimaan->addErrorMessage(str_replace("%s", $this->bukti_penerimaan->caption(), $this->bukti_penerimaan->RequiredErrorMessage));
            }
        }
        if ($this->nama_penerima->Required) {
            if (!$this->nama_penerima->IsDetailKey && EmptyValue($this->nama_penerima->FormValue)) {
                $this->nama_penerima->addErrorMessage(str_replace("%s", $this->nama_penerima->caption(), $this->nama_penerima->RequiredErrorMessage));
            }
        }
        if ($this->status_sap->Required) {
            if (!$this->status_sap->IsDetailKey && EmptyValue($this->status_sap->FormValue)) {
                $this->status_sap->addErrorMessage(str_replace("%s", $this->status_sap->caption(), $this->status_sap->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->status_sap->FormValue)) {
            $this->status_sap->addErrorMessage($this->status_sap->getErrorMessage(false));
        }

        // Return validate result
        $validateForm = $validateForm && !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Delete records based on current filter
    protected function deleteRows()
    {
        global $Language, $Security;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $rows = $conn->fetchAllAssociative($sql);
        if (count($rows) == 0) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
            return false;
        }

        // Clone old rows
        $rsold = $rows;
        $successKeys = [];
        $failKeys = [];
        foreach ($rsold as $row) {
            $thisKey = "";
            if ($thisKey != "") {
                $thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
            }
            $thisKey .= $row['id'];

            // Call row deleting event
            $deleteRow = $this->rowDeleting($row);
            if ($deleteRow) { // Delete
                $deleteRow = $this->delete($row);
            }
            if ($deleteRow === false) {
                if ($this->UseTransaction) {
                    $successKeys = []; // Reset success keys
                    break;
                }
                $failKeys[] = $thisKey;
            } else {
                if (Config("DELETE_UPLOADED_FILES")) { // Delete old files
                    $this->deleteUploadedFiles($row);
                }

                // Call Row Deleted event
                $this->rowDeleted($row);
                $successKeys[] = $thisKey;
            }
        }

        // Any records deleted
        $deleteRows = count($successKeys) > 0;
        if (!$deleteRows) {
            // Set up error message
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("DeleteCancelled"));
            }
        }

        // Write JSON for API request
        if (IsApi() && $deleteRows) {
            $row = $this->getRecordsFromRecordset($rsold);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $deleteRows;
    }

    // Update record based on key values
    protected function editRow()
    {
        global $Security, $Language;
        $oldKeyFilter = $this->getRecordFilter();
        $filter = $this->applyUserIDFilters($oldKeyFilter);
        $conn = $this->getConnection();
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $rsold = $conn->fetchAssociative($sql);
        if (!$rsold) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
            $editRow = false; // Update Failed
        } else {
            // Save old values
            $this->loadDbValues($rsold);
            $rsnew = [];

            // no_dokumen
            $this->no_dokumen->setDbValueDef($rsnew, $this->no_dokumen->CurrentValue, null, $this->no_dokumen->ReadOnly);

            // no_paket
            $this->no_paket->setDbValueDef($rsnew, $this->no_paket->CurrentValue, null, $this->no_paket->ReadOnly);

            // jenis_dokumen
            $this->jenis_dokumen->setDbValueDef($rsnew, $this->jenis_dokumen->CurrentValue, 0, $this->jenis_dokumen->ReadOnly);

            // tujuan_penerima
            $this->tujuan_penerima->setDbValueDef($rsnew, $this->tujuan_penerima->CurrentValue, "", $this->tujuan_penerima->ReadOnly);

            // no_hp_penerima
            $this->no_hp_penerima->setDbValueDef($rsnew, $this->no_hp_penerima->CurrentValue, "", $this->no_hp_penerima->ReadOnly);

            // email_penerima
            $this->email_penerima->setDbValueDef($rsnew, $this->email_penerima->CurrentValue, null, $this->email_penerima->ReadOnly);

            // status
            $this->status->setDbValueDef($rsnew, $this->status->CurrentValue, null, $this->status->ReadOnly);

            // tanggal_terima
            $this->tanggal_terima->setDbValueDef($rsnew, UnFormatDateTime($this->tanggal_terima->CurrentValue, $this->tanggal_terima->formatPattern()), null, $this->tanggal_terima->ReadOnly);

            // jenis_pengirim
            $this->jenis_pengirim->setDbValueDef($rsnew, $this->jenis_pengirim->CurrentValue, null, $this->jenis_pengirim->ReadOnly);

            // nama_kurir
            $this->nama_kurir->setDbValueDef($rsnew, $this->nama_kurir->CurrentValue, null, $this->nama_kurir->ReadOnly);

            // no_awb
            $this->no_awb->setDbValueDef($rsnew, $this->no_awb->CurrentValue, null, $this->no_awb->ReadOnly);

            // id_user
            if ($this->id_user->getSessionValue() != "") {
                $this->id_user->ReadOnly = true;
            }
            $this->id_user->setDbValueDef($rsnew, $this->id_user->CurrentValue, 0, $this->id_user->ReadOnly);

            // bukti_penerimaan
            if ($this->bukti_penerimaan->Visible && !$this->bukti_penerimaan->ReadOnly && !$this->bukti_penerimaan->Upload->KeepFile) {
                $this->bukti_penerimaan->Upload->DbValue = $rsold['bukti_penerimaan']; // Get original value
                if ($this->bukti_penerimaan->Upload->FileName == "") {
                    $rsnew['bukti_penerimaan'] = null;
                } else {
                    $rsnew['bukti_penerimaan'] = $this->bukti_penerimaan->Upload->FileName;
                }
            }

            // nama_penerima
            $this->nama_penerima->setDbValueDef($rsnew, $this->nama_penerima->CurrentValue, null, $this->nama_penerima->ReadOnly);

            // status_sap
            $this->status_sap->setDbValueDef($rsnew, $this->status_sap->CurrentValue, null, $this->status_sap->ReadOnly);
            if ($this->bukti_penerimaan->Visible && !$this->bukti_penerimaan->Upload->KeepFile) {
                $oldFiles = EmptyValue($this->bukti_penerimaan->Upload->DbValue) ? [] : [$this->bukti_penerimaan->htmlDecode($this->bukti_penerimaan->Upload->DbValue)];
                if (!EmptyValue($this->bukti_penerimaan->Upload->FileName)) {
                    $newFiles = [$this->bukti_penerimaan->Upload->FileName];
                    $NewFileCount = count($newFiles);
                    for ($i = 0; $i < $NewFileCount; $i++) {
                        if ($newFiles[$i] != "") {
                            $file = $newFiles[$i];
                            $tempPath = UploadTempPath($this->bukti_penerimaan, $this->bukti_penerimaan->Upload->Index);
                            if (file_exists($tempPath . $file)) {
                                if (Config("DELETE_UPLOADED_FILES")) {
                                    $oldFileFound = false;
                                    $oldFileCount = count($oldFiles);
                                    for ($j = 0; $j < $oldFileCount; $j++) {
                                        $oldFile = $oldFiles[$j];
                                        if ($oldFile == $file) { // Old file found, no need to delete anymore
                                            array_splice($oldFiles, $j, 1);
                                            $oldFileFound = true;
                                            break;
                                        }
                                    }
                                    if ($oldFileFound) { // No need to check if file exists further
                                        continue;
                                    }
                                }
                                $file1 = UniqueFilename($this->bukti_penerimaan->physicalUploadPath(), $file); // Get new file name
                                if ($file1 != $file) { // Rename temp file
                                    while (file_exists($tempPath . $file1) || file_exists($this->bukti_penerimaan->physicalUploadPath() . $file1)) { // Make sure no file name clash
                                        $file1 = UniqueFilename([$this->bukti_penerimaan->physicalUploadPath(), $tempPath], $file1, true); // Use indexed name
                                    }
                                    rename($tempPath . $file, $tempPath . $file1);
                                    $newFiles[$i] = $file1;
                                }
                            }
                        }
                    }
                    $this->bukti_penerimaan->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
                    $this->bukti_penerimaan->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
                    $this->bukti_penerimaan->setDbValueDef($rsnew, $this->bukti_penerimaan->Upload->FileName, null, $this->bukti_penerimaan->ReadOnly);
                }
            }

            // Call Row Updating event
            $updateRow = $this->rowUpdating($rsold, $rsnew);
            if ($updateRow) {
                if (count($rsnew) > 0) {
                    $editRow = $this->update($rsnew, "", $rsold);
                } else {
                    $editRow = true; // No field to update
                }
                if ($editRow) {
                    if ($this->bukti_penerimaan->Visible && !$this->bukti_penerimaan->Upload->KeepFile) {
                        $oldFiles = EmptyValue($this->bukti_penerimaan->Upload->DbValue) ? [] : [$this->bukti_penerimaan->htmlDecode($this->bukti_penerimaan->Upload->DbValue)];
                        if (!EmptyValue($this->bukti_penerimaan->Upload->FileName)) {
                            $newFiles = [$this->bukti_penerimaan->Upload->FileName];
                            $newFiles2 = [$this->bukti_penerimaan->htmlDecode($rsnew['bukti_penerimaan'])];
                            $newFileCount = count($newFiles);
                            for ($i = 0; $i < $newFileCount; $i++) {
                                if ($newFiles[$i] != "") {
                                    $file = UploadTempPath($this->bukti_penerimaan, $this->bukti_penerimaan->Upload->Index) . $newFiles[$i];
                                    if (file_exists($file)) {
                                        if (@$newFiles2[$i] != "") { // Use correct file name
                                            $newFiles[$i] = $newFiles2[$i];
                                        }
                                        if (!$this->bukti_penerimaan->Upload->SaveToFile($newFiles[$i], true, $i)) { // Just replace
                                            $this->setFailureMessage($Language->phrase("UploadErrMsg7"));
                                            return false;
                                        }
                                    }
                                }
                            }
                        } else {
                            $newFiles = [];
                        }
                        if (Config("DELETE_UPLOADED_FILES")) {
                            foreach ($oldFiles as $oldFile) {
                                if ($oldFile != "" && !in_array($oldFile, $newFiles)) {
                                    @unlink($this->bukti_penerimaan->oldPhysicalUploadPath() . $oldFile);
                                }
                            }
                        }
                    }
                }
            } else {
                if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                    // Use the message, do nothing
                } elseif ($this->CancelMessage != "") {
                    $this->setFailureMessage($this->CancelMessage);
                    $this->CancelMessage = "";
                } else {
                    $this->setFailureMessage($Language->phrase("UpdateCancelled"));
                }
                $editRow = false;
            }
        }

        // Call Row_Updated event
        if ($editRow) {
            $this->rowUpdated($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($editRow) {
            // bukti_penerimaan
            CleanUploadTempPath($this->bukti_penerimaan, $this->bukti_penerimaan->Upload->Index);
        }

        // Write JSON for API request
        if (IsApi() && $editRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $editRow;
    }

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;

        // Set up foreign key field value from Session
        if ($this->getCurrentMasterTable() == "user") {
            $this->id_user->CurrentValue = $this->id_user->getSessionValue();
        }
        $conn = $this->getConnection();

        // Load db values from rsold
        $this->loadDbValues($rsold);
        if ($rsold) {
        }
        $rsnew = [];

        // no_dokumen
        $this->no_dokumen->setDbValueDef($rsnew, $this->no_dokumen->CurrentValue, null, false);

        // no_paket
        $this->no_paket->setDbValueDef($rsnew, $this->no_paket->CurrentValue, null, false);

        // jenis_dokumen
        $this->jenis_dokumen->setDbValueDef($rsnew, $this->jenis_dokumen->CurrentValue, 0, false);

        // tujuan_penerima
        $this->tujuan_penerima->setDbValueDef($rsnew, $this->tujuan_penerima->CurrentValue, "", false);

        // no_hp_penerima
        $this->no_hp_penerima->setDbValueDef($rsnew, $this->no_hp_penerima->CurrentValue, "", false);

        // email_penerima
        $this->email_penerima->setDbValueDef($rsnew, $this->email_penerima->CurrentValue, null, false);

        // status
        $this->status->setDbValueDef($rsnew, $this->status->CurrentValue, null, false);

        // tanggal_terima
        $this->tanggal_terima->setDbValueDef($rsnew, UnFormatDateTime($this->tanggal_terima->CurrentValue, $this->tanggal_terima->formatPattern()), null, false);

        // jenis_pengirim
        $this->jenis_pengirim->setDbValueDef($rsnew, $this->jenis_pengirim->CurrentValue, null, false);

        // nama_kurir
        $this->nama_kurir->setDbValueDef($rsnew, $this->nama_kurir->CurrentValue, null, false);

        // no_awb
        $this->no_awb->setDbValueDef($rsnew, $this->no_awb->CurrentValue, null, false);

        // id_user
        $this->id_user->setDbValueDef($rsnew, $this->id_user->CurrentValue, 0, false);

        // bukti_penerimaan
        if ($this->bukti_penerimaan->Visible && !$this->bukti_penerimaan->Upload->KeepFile) {
            $this->bukti_penerimaan->Upload->DbValue = ""; // No need to delete old file
            if ($this->bukti_penerimaan->Upload->FileName == "") {
                $rsnew['bukti_penerimaan'] = null;
            } else {
                $rsnew['bukti_penerimaan'] = $this->bukti_penerimaan->Upload->FileName;
            }
        }

        // nama_penerima
        $this->nama_penerima->setDbValueDef($rsnew, $this->nama_penerima->CurrentValue, null, false);

        // status_sap
        $this->status_sap->setDbValueDef($rsnew, $this->status_sap->CurrentValue, null, false);
        if ($this->bukti_penerimaan->Visible && !$this->bukti_penerimaan->Upload->KeepFile) {
            $oldFiles = EmptyValue($this->bukti_penerimaan->Upload->DbValue) ? [] : [$this->bukti_penerimaan->htmlDecode($this->bukti_penerimaan->Upload->DbValue)];
            if (!EmptyValue($this->bukti_penerimaan->Upload->FileName)) {
                $newFiles = [$this->bukti_penerimaan->Upload->FileName];
                $NewFileCount = count($newFiles);
                for ($i = 0; $i < $NewFileCount; $i++) {
                    if ($newFiles[$i] != "") {
                        $file = $newFiles[$i];
                        $tempPath = UploadTempPath($this->bukti_penerimaan, $this->bukti_penerimaan->Upload->Index);
                        if (file_exists($tempPath . $file)) {
                            if (Config("DELETE_UPLOADED_FILES")) {
                                $oldFileFound = false;
                                $oldFileCount = count($oldFiles);
                                for ($j = 0; $j < $oldFileCount; $j++) {
                                    $oldFile = $oldFiles[$j];
                                    if ($oldFile == $file) { // Old file found, no need to delete anymore
                                        array_splice($oldFiles, $j, 1);
                                        $oldFileFound = true;
                                        break;
                                    }
                                }
                                if ($oldFileFound) { // No need to check if file exists further
                                    continue;
                                }
                            }
                            $file1 = UniqueFilename($this->bukti_penerimaan->physicalUploadPath(), $file); // Get new file name
                            if ($file1 != $file) { // Rename temp file
                                while (file_exists($tempPath . $file1) || file_exists($this->bukti_penerimaan->physicalUploadPath() . $file1)) { // Make sure no file name clash
                                    $file1 = UniqueFilename([$this->bukti_penerimaan->physicalUploadPath(), $tempPath], $file1, true); // Use indexed name
                                }
                                rename($tempPath . $file, $tempPath . $file1);
                                $newFiles[$i] = $file1;
                            }
                        }
                    }
                }
                $this->bukti_penerimaan->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
                $this->bukti_penerimaan->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
                $this->bukti_penerimaan->setDbValueDef($rsnew, $this->bukti_penerimaan->Upload->FileName, null, false);
            }
        }

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
        if ($insertRow) {
            $addRow = $this->insert($rsnew);
            if ($addRow) {
                if ($this->bukti_penerimaan->Visible && !$this->bukti_penerimaan->Upload->KeepFile) {
                    $oldFiles = EmptyValue($this->bukti_penerimaan->Upload->DbValue) ? [] : [$this->bukti_penerimaan->htmlDecode($this->bukti_penerimaan->Upload->DbValue)];
                    if (!EmptyValue($this->bukti_penerimaan->Upload->FileName)) {
                        $newFiles = [$this->bukti_penerimaan->Upload->FileName];
                        $newFiles2 = [$this->bukti_penerimaan->htmlDecode($rsnew['bukti_penerimaan'])];
                        $newFileCount = count($newFiles);
                        for ($i = 0; $i < $newFileCount; $i++) {
                            if ($newFiles[$i] != "") {
                                $file = UploadTempPath($this->bukti_penerimaan, $this->bukti_penerimaan->Upload->Index) . $newFiles[$i];
                                if (file_exists($file)) {
                                    if (@$newFiles2[$i] != "") { // Use correct file name
                                        $newFiles[$i] = $newFiles2[$i];
                                    }
                                    if (!$this->bukti_penerimaan->Upload->SaveToFile($newFiles[$i], true, $i)) { // Just replace
                                        $this->setFailureMessage($Language->phrase("UploadErrMsg7"));
                                        return false;
                                    }
                                }
                            }
                        }
                    } else {
                        $newFiles = [];
                    }
                    if (Config("DELETE_UPLOADED_FILES")) {
                        foreach ($oldFiles as $oldFile) {
                            if ($oldFile != "" && !in_array($oldFile, $newFiles)) {
                                @unlink($this->bukti_penerimaan->oldPhysicalUploadPath() . $oldFile);
                            }
                        }
                    }
                }
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("InsertCancelled"));
            }
            $addRow = false;
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($addRow) {
            // bukti_penerimaan
            CleanUploadTempPath($this->bukti_penerimaan, $this->bukti_penerimaan->Upload->Index);
        }

        // Write JSON for API request
        if (IsApi() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $addRow;
    }

    // Set up master/detail based on QueryString
    protected function setupMasterParms()
    {
        // Hide foreign keys
        $masterTblVar = $this->getCurrentMasterTable();
        if ($masterTblVar == "user") {
            $masterTbl = Container("user");
            $this->id_user->Visible = false;
            if ($masterTbl->EventCancelled) {
                $this->EventCancelled = true;
            }
        }
        $this->DbMasterFilter = $this->getMasterFilterFromSession(); // Get master filter from session
        $this->DbDetailFilter = $this->getDetailFilterFromSession(); // Get detail filter from session
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
                case "x_jenis_dokumen":
                    break;
                case "x_status":
                    break;
                case "x_jenis_pengirim":
                    break;
                case "x_nama_kurir":
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
}
