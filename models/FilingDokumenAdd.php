<?php

namespace Mitral2022\DSN2;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class FilingDokumenAdd extends FilingDokumen
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'filing_dokumen';

    // Page object name
    public $PageObjName = "FilingDokumenAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

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

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $row = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page
                    $row["caption"] = $this->getModalCaption($pageName);
                    if ($pageName == "filingdokumenview") {
                        $row["view"] = "1";
                    }
                } else { // List page should not be shown as modal => error
                    $row["error"] = $this->getFailureMessage();
                    $this->clearFailureMessage();
                }
                WriteJson($row);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
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
    public $FormClassName = "ew-form ew-add-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $Priv = 0;
    public $OldRecordset;
    public $CopyRecord;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
            $SkipHeaderFooter;

        // Is modal
        $this->IsModal = Param("modal") == "1";
        $this->UseLayout = $this->UseLayout && !$this->IsModal;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param("layout", true));

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->no_box->setVisibility();
        $this->kode_pt->setVisibility();
        $this->kode_department->setVisibility();
        $this->lokasi->setVisibility();
        $this->nama_dokumen->setVisibility();
        $this->tahun_pembuatan_dokumen->setVisibility();
        $this->deskripsi->setVisibility();
        $this->id->Visible = false;
        $this->no_gudang->setVisibility();
        $this->no_rak->setVisibility();
        $this->file->setVisibility();
        $this->masa_berlaku->setVisibility();
        $this->kode->setVisibility();
        $this->kode_box->setVisibility();
        $this->created_date->setVisibility();
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

        // Set up lookup cache
        $this->setupLookupOptions($this->kode_pt);
        $this->setupLookupOptions($this->kode_department);

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-add-form";
        $postBack = false;

        // Set up current action
        if (IsApi()) {
            $this->CurrentAction = "insert"; // Add record directly
            $postBack = true;
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("id") ?? Route("id")) !== null) {
                $this->id->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !EmptyValue($this->OldKey);
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
            } else {
                $this->CurrentAction = "show"; // Display blank record
            }
        }

        // Load old record / default values
        $loaded = $this->loadOldRecord();

        // Load form values
        if ($postBack) {
            $this->loadFormValues(); // Load form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues(); // Restore form values
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "copy": // Copy an existing record
                if (!$loaded) { // Record not loaded
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("filingdokumenlist"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($this->OldRecordset)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->getReturnUrl();
                    if (GetPageName($returnUrl) == "filingdokumenlist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "filingdokumenview") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }
                    if (IsApi()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl);
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Add failed, restore form values
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render row based on row type
        $this->RowType = ROWTYPE_ADD; // Render add type

        // Render row
        $this->resetAttributes();
        $this->renderRow();

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

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
        $this->file->Upload->Index = $CurrentForm->Index;
        $this->file->Upload->uploadFile();
        $this->file->CurrentValue = $this->file->Upload->FileName;
    }

    // Load default values
    protected function loadDefaultValues()
    {
        $this->no_box->CurrentValue = null;
        $this->no_box->OldValue = $this->no_box->CurrentValue;
        $this->kode_pt->CurrentValue = null;
        $this->kode_pt->OldValue = $this->kode_pt->CurrentValue;
        $this->kode_department->CurrentValue = null;
        $this->kode_department->OldValue = $this->kode_department->CurrentValue;
        $this->lokasi->CurrentValue = null;
        $this->lokasi->OldValue = $this->lokasi->CurrentValue;
        $this->nama_dokumen->CurrentValue = null;
        $this->nama_dokumen->OldValue = $this->nama_dokumen->CurrentValue;
        $this->tahun_pembuatan_dokumen->CurrentValue = null;
        $this->tahun_pembuatan_dokumen->OldValue = $this->tahun_pembuatan_dokumen->CurrentValue;
        $this->deskripsi->CurrentValue = null;
        $this->deskripsi->OldValue = $this->deskripsi->CurrentValue;
        $this->id->CurrentValue = null;
        $this->id->OldValue = $this->id->CurrentValue;
        $this->no_gudang->CurrentValue = null;
        $this->no_gudang->OldValue = $this->no_gudang->CurrentValue;
        $this->no_rak->CurrentValue = null;
        $this->no_rak->OldValue = $this->no_rak->CurrentValue;
        $this->file->Upload->DbValue = null;
        $this->file->OldValue = $this->file->Upload->DbValue;
        $this->file->CurrentValue = null; // Clear file related field
        $this->masa_berlaku->CurrentValue = null;
        $this->masa_berlaku->OldValue = $this->masa_berlaku->CurrentValue;
        $this->kode->CurrentValue = null;
        $this->kode->OldValue = $this->kode->CurrentValue;
        $this->kode_box->CurrentValue = null;
        $this->kode_box->OldValue = $this->kode_box->CurrentValue;
        $this->created_date->CurrentValue = CurrentDate();
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'no_box' first before field var 'x_no_box'
        $val = $CurrentForm->hasValue("no_box") ? $CurrentForm->getValue("no_box") : $CurrentForm->getValue("x_no_box");
        if (!$this->no_box->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no_box->Visible = false; // Disable update for API request
            } else {
                $this->no_box->setFormValue($val);
            }
        }

        // Check field name 'kode_pt' first before field var 'x_kode_pt'
        $val = $CurrentForm->hasValue("kode_pt") ? $CurrentForm->getValue("kode_pt") : $CurrentForm->getValue("x_kode_pt");
        if (!$this->kode_pt->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kode_pt->Visible = false; // Disable update for API request
            } else {
                $this->kode_pt->setFormValue($val);
            }
        }

        // Check field name 'kode_department' first before field var 'x_kode_department'
        $val = $CurrentForm->hasValue("kode_department") ? $CurrentForm->getValue("kode_department") : $CurrentForm->getValue("x_kode_department");
        if (!$this->kode_department->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kode_department->Visible = false; // Disable update for API request
            } else {
                $this->kode_department->setFormValue($val);
            }
        }

        // Check field name 'lokasi' first before field var 'x_lokasi'
        $val = $CurrentForm->hasValue("lokasi") ? $CurrentForm->getValue("lokasi") : $CurrentForm->getValue("x_lokasi");
        if (!$this->lokasi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->lokasi->Visible = false; // Disable update for API request
            } else {
                $this->lokasi->setFormValue($val);
            }
        }

        // Check field name 'nama_dokumen' first before field var 'x_nama_dokumen'
        $val = $CurrentForm->hasValue("nama_dokumen") ? $CurrentForm->getValue("nama_dokumen") : $CurrentForm->getValue("x_nama_dokumen");
        if (!$this->nama_dokumen->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nama_dokumen->Visible = false; // Disable update for API request
            } else {
                $this->nama_dokumen->setFormValue($val);
            }
        }

        // Check field name 'tahun_pembuatan_dokumen' first before field var 'x_tahun_pembuatan_dokumen'
        $val = $CurrentForm->hasValue("tahun_pembuatan_dokumen") ? $CurrentForm->getValue("tahun_pembuatan_dokumen") : $CurrentForm->getValue("x_tahun_pembuatan_dokumen");
        if (!$this->tahun_pembuatan_dokumen->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tahun_pembuatan_dokumen->Visible = false; // Disable update for API request
            } else {
                $this->tahun_pembuatan_dokumen->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'deskripsi' first before field var 'x_deskripsi'
        $val = $CurrentForm->hasValue("deskripsi") ? $CurrentForm->getValue("deskripsi") : $CurrentForm->getValue("x_deskripsi");
        if (!$this->deskripsi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->deskripsi->Visible = false; // Disable update for API request
            } else {
                $this->deskripsi->setFormValue($val);
            }
        }

        // Check field name 'no_gudang' first before field var 'x_no_gudang'
        $val = $CurrentForm->hasValue("no_gudang") ? $CurrentForm->getValue("no_gudang") : $CurrentForm->getValue("x_no_gudang");
        if (!$this->no_gudang->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no_gudang->Visible = false; // Disable update for API request
            } else {
                $this->no_gudang->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'no_rak' first before field var 'x_no_rak'
        $val = $CurrentForm->hasValue("no_rak") ? $CurrentForm->getValue("no_rak") : $CurrentForm->getValue("x_no_rak");
        if (!$this->no_rak->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no_rak->Visible = false; // Disable update for API request
            } else {
                $this->no_rak->setFormValue($val);
            }
        }

        // Check field name 'masa_berlaku' first before field var 'x_masa_berlaku'
        $val = $CurrentForm->hasValue("masa_berlaku") ? $CurrentForm->getValue("masa_berlaku") : $CurrentForm->getValue("x_masa_berlaku");
        if (!$this->masa_berlaku->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->masa_berlaku->Visible = false; // Disable update for API request
            } else {
                $this->masa_berlaku->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'kode' first before field var 'x_kode'
        $val = $CurrentForm->hasValue("kode") ? $CurrentForm->getValue("kode") : $CurrentForm->getValue("x_kode");
        if (!$this->kode->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kode->Visible = false; // Disable update for API request
            } else {
                $this->kode->setFormValue($val);
            }
        }

        // Check field name 'kode_box' first before field var 'x_kode_box'
        $val = $CurrentForm->hasValue("kode_box") ? $CurrentForm->getValue("kode_box") : $CurrentForm->getValue("x_kode_box");
        if (!$this->kode_box->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kode_box->Visible = false; // Disable update for API request
            } else {
                $this->kode_box->setFormValue($val);
            }
        }

        // Check field name 'created_date' first before field var 'x_created_date'
        $val = $CurrentForm->hasValue("created_date") ? $CurrentForm->getValue("created_date") : $CurrentForm->getValue("x_created_date");
        if (!$this->created_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->created_date->Visible = false; // Disable update for API request
            } else {
                $this->created_date->setFormValue($val);
            }
            $this->created_date->CurrentValue = UnFormatDateTime($this->created_date->CurrentValue, $this->created_date->formatPattern());
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
        $this->getUploadFiles(); // Get upload files
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->no_box->CurrentValue = $this->no_box->FormValue;
        $this->kode_pt->CurrentValue = $this->kode_pt->FormValue;
        $this->kode_department->CurrentValue = $this->kode_department->FormValue;
        $this->lokasi->CurrentValue = $this->lokasi->FormValue;
        $this->nama_dokumen->CurrentValue = $this->nama_dokumen->FormValue;
        $this->tahun_pembuatan_dokumen->CurrentValue = $this->tahun_pembuatan_dokumen->FormValue;
        $this->deskripsi->CurrentValue = $this->deskripsi->FormValue;
        $this->no_gudang->CurrentValue = $this->no_gudang->FormValue;
        $this->no_rak->CurrentValue = $this->no_rak->FormValue;
        $this->masa_berlaku->CurrentValue = $this->masa_berlaku->FormValue;
        $this->kode->CurrentValue = $this->kode->FormValue;
        $this->kode_box->CurrentValue = $this->kode_box->FormValue;
        $this->created_date->CurrentValue = $this->created_date->FormValue;
        $this->created_date->CurrentValue = UnFormatDateTime($this->created_date->CurrentValue, $this->created_date->formatPattern());
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
        $this->loadDefaultValues();
        $row = [];
        $row['no_box'] = $this->no_box->CurrentValue;
        $row['kode_pt'] = $this->kode_pt->CurrentValue;
        $row['kode_department'] = $this->kode_department->CurrentValue;
        $row['lokasi'] = $this->lokasi->CurrentValue;
        $row['nama_dokumen'] = $this->nama_dokumen->CurrentValue;
        $row['tahun_pembuatan_dokumen'] = $this->tahun_pembuatan_dokumen->CurrentValue;
        $row['deskripsi'] = $this->deskripsi->CurrentValue;
        $row['id'] = $this->id->CurrentValue;
        $row['no_gudang'] = $this->no_gudang->CurrentValue;
        $row['no_rak'] = $this->no_rak->CurrentValue;
        $row['file'] = $this->file->Upload->DbValue;
        $row['masa_berlaku'] = $this->masa_berlaku->CurrentValue;
        $row['kode'] = $this->kode->CurrentValue;
        $row['kode_box'] = $this->kode_box->CurrentValue;
        $row['created_date'] = $this->created_date->CurrentValue;
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

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // no_box
        $this->no_box->RowCssClass = "row";

        // kode_pt
        $this->kode_pt->RowCssClass = "row";

        // kode_department
        $this->kode_department->RowCssClass = "row";

        // lokasi
        $this->lokasi->RowCssClass = "row";

        // nama_dokumen
        $this->nama_dokumen->RowCssClass = "row";

        // tahun_pembuatan_dokumen
        $this->tahun_pembuatan_dokumen->RowCssClass = "row";

        // deskripsi
        $this->deskripsi->RowCssClass = "row";

        // id
        $this->id->RowCssClass = "row";

        // no_gudang
        $this->no_gudang->RowCssClass = "row";

        // no_rak
        $this->no_rak->RowCssClass = "row";

        // file
        $this->file->RowCssClass = "row";

        // masa_berlaku
        $this->masa_berlaku->RowCssClass = "row";

        // kode
        $this->kode->RowCssClass = "row";

        // kode_box
        $this->kode_box->RowCssClass = "row";

        // created_date
        $this->created_date->RowCssClass = "row";

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

            // kode
            $this->kode->ViewValue = $this->kode->CurrentValue;
            $this->kode->ViewCustomAttributes = "";

            // kode_box
            $this->kode_box->ViewValue = $this->kode_box->CurrentValue;
            $this->kode_box->ViewCustomAttributes = "";

            // created_date
            $this->created_date->ViewValue = $this->created_date->CurrentValue;
            $this->created_date->ViewValue = FormatDateTime($this->created_date->ViewValue, $this->created_date->formatPattern());
            $this->created_date->ViewCustomAttributes = "";

            // no_box
            $this->no_box->LinkCustomAttributes = "";
            $this->no_box->HrefValue = "";

            // kode_pt
            $this->kode_pt->LinkCustomAttributes = "";
            $this->kode_pt->HrefValue = "";

            // kode_department
            $this->kode_department->LinkCustomAttributes = "";
            $this->kode_department->HrefValue = "";

            // lokasi
            $this->lokasi->LinkCustomAttributes = "";
            $this->lokasi->HrefValue = "";

            // nama_dokumen
            $this->nama_dokumen->LinkCustomAttributes = "";
            $this->nama_dokumen->HrefValue = "";

            // tahun_pembuatan_dokumen
            $this->tahun_pembuatan_dokumen->LinkCustomAttributes = "";
            $this->tahun_pembuatan_dokumen->HrefValue = "";

            // deskripsi
            $this->deskripsi->LinkCustomAttributes = "";
            $this->deskripsi->HrefValue = "";

            // no_gudang
            $this->no_gudang->LinkCustomAttributes = "";
            $this->no_gudang->HrefValue = "";

            // no_rak
            $this->no_rak->LinkCustomAttributes = "";
            $this->no_rak->HrefValue = "";

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

            // masa_berlaku
            $this->masa_berlaku->LinkCustomAttributes = "";
            $this->masa_berlaku->HrefValue = "";

            // kode
            $this->kode->LinkCustomAttributes = "";
            $this->kode->HrefValue = "";

            // kode_box
            $this->kode_box->LinkCustomAttributes = "";
            $this->kode_box->HrefValue = "";

            // created_date
            $this->created_date->LinkCustomAttributes = "";
            $this->created_date->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // no_box
            $this->no_box->setupEditAttributes();
            $this->no_box->EditCustomAttributes = "";
            if (!$this->no_box->Raw) {
                $this->no_box->CurrentValue = HtmlDecode($this->no_box->CurrentValue);
            }
            $this->no_box->EditValue = HtmlEncode($this->no_box->CurrentValue);
            $this->no_box->PlaceHolder = RemoveHtml($this->no_box->caption());

            // kode_pt
            $this->kode_pt->setupEditAttributes();
            $this->kode_pt->EditCustomAttributes = "";
            $curVal = trim(strval($this->kode_pt->CurrentValue));
            if ($curVal != "") {
                $this->kode_pt->ViewValue = $this->kode_pt->lookupCacheOption($curVal);
            } else {
                $this->kode_pt->ViewValue = $this->kode_pt->Lookup !== null && is_array($this->kode_pt->lookupOptions()) ? $curVal : null;
            }
            if ($this->kode_pt->ViewValue !== null) { // Load from cache
                $this->kode_pt->EditValue = array_values($this->kode_pt->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->kode_pt->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->kode_pt->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->kode_pt->EditValue = $arwrk;
            }
            $this->kode_pt->PlaceHolder = RemoveHtml($this->kode_pt->caption());

            // kode_department
            $this->kode_department->setupEditAttributes();
            $this->kode_department->EditCustomAttributes = "";
            $curVal = trim(strval($this->kode_department->CurrentValue));
            if ($curVal != "") {
                $this->kode_department->ViewValue = $this->kode_department->lookupCacheOption($curVal);
            } else {
                $this->kode_department->ViewValue = $this->kode_department->Lookup !== null && is_array($this->kode_department->lookupOptions()) ? $curVal : null;
            }
            if ($this->kode_department->ViewValue !== null) { // Load from cache
                $this->kode_department->EditValue = array_values($this->kode_department->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->kode_department->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->kode_department->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->kode_department->EditValue = $arwrk;
            }
            $this->kode_department->PlaceHolder = RemoveHtml($this->kode_department->caption());

            // lokasi
            $this->lokasi->setupEditAttributes();
            $this->lokasi->EditCustomAttributes = "";
            if (!$this->lokasi->Raw) {
                $this->lokasi->CurrentValue = HtmlDecode($this->lokasi->CurrentValue);
            }
            $this->lokasi->EditValue = HtmlEncode($this->lokasi->CurrentValue);
            $this->lokasi->PlaceHolder = RemoveHtml($this->lokasi->caption());

            // nama_dokumen
            $this->nama_dokumen->setupEditAttributes();
            $this->nama_dokumen->EditCustomAttributes = "";
            if (!$this->nama_dokumen->Raw) {
                $this->nama_dokumen->CurrentValue = HtmlDecode($this->nama_dokumen->CurrentValue);
            }
            $this->nama_dokumen->EditValue = HtmlEncode($this->nama_dokumen->CurrentValue);
            $this->nama_dokumen->PlaceHolder = RemoveHtml($this->nama_dokumen->caption());

            // tahun_pembuatan_dokumen
            $this->tahun_pembuatan_dokumen->setupEditAttributes();
            $this->tahun_pembuatan_dokumen->EditCustomAttributes = "";
            $this->tahun_pembuatan_dokumen->EditValue = HtmlEncode($this->tahun_pembuatan_dokumen->CurrentValue);
            $this->tahun_pembuatan_dokumen->PlaceHolder = RemoveHtml($this->tahun_pembuatan_dokumen->caption());
            if (strval($this->tahun_pembuatan_dokumen->EditValue) != "" && is_numeric($this->tahun_pembuatan_dokumen->EditValue)) {
                $this->tahun_pembuatan_dokumen->EditValue = FormatNumber($this->tahun_pembuatan_dokumen->EditValue, null);
            }

            // deskripsi
            $this->deskripsi->setupEditAttributes();
            $this->deskripsi->EditCustomAttributes = "";
            if (!$this->deskripsi->Raw) {
                $this->deskripsi->CurrentValue = HtmlDecode($this->deskripsi->CurrentValue);
            }
            $this->deskripsi->EditValue = HtmlEncode($this->deskripsi->CurrentValue);
            $this->deskripsi->PlaceHolder = RemoveHtml($this->deskripsi->caption());

            // no_gudang
            $this->no_gudang->setupEditAttributes();
            $this->no_gudang->EditCustomAttributes = "";
            $this->no_gudang->EditValue = HtmlEncode($this->no_gudang->CurrentValue);
            $this->no_gudang->PlaceHolder = RemoveHtml($this->no_gudang->caption());
            if (strval($this->no_gudang->EditValue) != "" && is_numeric($this->no_gudang->EditValue)) {
                $this->no_gudang->EditValue = FormatNumber($this->no_gudang->EditValue, null);
            }

            // no_rak
            $this->no_rak->setupEditAttributes();
            $this->no_rak->EditCustomAttributes = "";
            if (!$this->no_rak->Raw) {
                $this->no_rak->CurrentValue = HtmlDecode($this->no_rak->CurrentValue);
            }
            $this->no_rak->EditValue = HtmlEncode($this->no_rak->CurrentValue);
            $this->no_rak->PlaceHolder = RemoveHtml($this->no_rak->caption());

            // file
            $this->file->setupEditAttributes();
            $this->file->EditCustomAttributes = "";
            if (!EmptyValue($this->file->Upload->DbValue)) {
                $this->file->ImageWidth = 100;
                $this->file->ImageHeight = 0;
                $this->file->ImageAlt = $this->file->alt();
                $this->file->ImageCssClass = "ew-image";
                $this->file->EditValue = $this->file->Upload->DbValue;
            } else {
                $this->file->EditValue = "";
            }
            if (!EmptyValue($this->file->CurrentValue)) {
                $this->file->Upload->FileName = $this->file->CurrentValue;
            }
            if ($this->isShow() || $this->isCopy()) {
                RenderUploadField($this->file);
            }

            // masa_berlaku
            $this->masa_berlaku->setupEditAttributes();
            $this->masa_berlaku->EditCustomAttributes = "";
            $this->masa_berlaku->EditValue = HtmlEncode($this->masa_berlaku->CurrentValue);
            $this->masa_berlaku->PlaceHolder = RemoveHtml($this->masa_berlaku->caption());
            if (strval($this->masa_berlaku->EditValue) != "" && is_numeric($this->masa_berlaku->EditValue)) {
                $this->masa_berlaku->EditValue = FormatNumber($this->masa_berlaku->EditValue, null);
            }

            // kode
            $this->kode->setupEditAttributes();
            $this->kode->EditCustomAttributes = "";
            if (!$this->kode->Raw) {
                $this->kode->CurrentValue = HtmlDecode($this->kode->CurrentValue);
            }
            $this->kode->EditValue = HtmlEncode($this->kode->CurrentValue);
            $this->kode->PlaceHolder = RemoveHtml($this->kode->caption());

            // kode_box
            $this->kode_box->setupEditAttributes();
            $this->kode_box->EditCustomAttributes = "";
            if (!$this->kode_box->Raw) {
                $this->kode_box->CurrentValue = HtmlDecode($this->kode_box->CurrentValue);
            }
            $this->kode_box->EditValue = HtmlEncode($this->kode_box->CurrentValue);
            $this->kode_box->PlaceHolder = RemoveHtml($this->kode_box->caption());

            // created_date

            // Add refer script

            // no_box
            $this->no_box->LinkCustomAttributes = "";
            $this->no_box->HrefValue = "";

            // kode_pt
            $this->kode_pt->LinkCustomAttributes = "";
            $this->kode_pt->HrefValue = "";

            // kode_department
            $this->kode_department->LinkCustomAttributes = "";
            $this->kode_department->HrefValue = "";

            // lokasi
            $this->lokasi->LinkCustomAttributes = "";
            $this->lokasi->HrefValue = "";

            // nama_dokumen
            $this->nama_dokumen->LinkCustomAttributes = "";
            $this->nama_dokumen->HrefValue = "";

            // tahun_pembuatan_dokumen
            $this->tahun_pembuatan_dokumen->LinkCustomAttributes = "";
            $this->tahun_pembuatan_dokumen->HrefValue = "";

            // deskripsi
            $this->deskripsi->LinkCustomAttributes = "";
            $this->deskripsi->HrefValue = "";

            // no_gudang
            $this->no_gudang->LinkCustomAttributes = "";
            $this->no_gudang->HrefValue = "";

            // no_rak
            $this->no_rak->LinkCustomAttributes = "";
            $this->no_rak->HrefValue = "";

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

            // masa_berlaku
            $this->masa_berlaku->LinkCustomAttributes = "";
            $this->masa_berlaku->HrefValue = "";

            // kode
            $this->kode->LinkCustomAttributes = "";
            $this->kode->HrefValue = "";

            // kode_box
            $this->kode_box->LinkCustomAttributes = "";
            $this->kode_box->HrefValue = "";

            // created_date
            $this->created_date->LinkCustomAttributes = "";
            $this->created_date->HrefValue = "";
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
        if ($this->no_box->Required) {
            if (!$this->no_box->IsDetailKey && EmptyValue($this->no_box->FormValue)) {
                $this->no_box->addErrorMessage(str_replace("%s", $this->no_box->caption(), $this->no_box->RequiredErrorMessage));
            }
        }
        if ($this->kode_pt->Required) {
            if (!$this->kode_pt->IsDetailKey && EmptyValue($this->kode_pt->FormValue)) {
                $this->kode_pt->addErrorMessage(str_replace("%s", $this->kode_pt->caption(), $this->kode_pt->RequiredErrorMessage));
            }
        }
        if ($this->kode_department->Required) {
            if (!$this->kode_department->IsDetailKey && EmptyValue($this->kode_department->FormValue)) {
                $this->kode_department->addErrorMessage(str_replace("%s", $this->kode_department->caption(), $this->kode_department->RequiredErrorMessage));
            }
        }
        if ($this->lokasi->Required) {
            if (!$this->lokasi->IsDetailKey && EmptyValue($this->lokasi->FormValue)) {
                $this->lokasi->addErrorMessage(str_replace("%s", $this->lokasi->caption(), $this->lokasi->RequiredErrorMessage));
            }
        }
        if ($this->nama_dokumen->Required) {
            if (!$this->nama_dokumen->IsDetailKey && EmptyValue($this->nama_dokumen->FormValue)) {
                $this->nama_dokumen->addErrorMessage(str_replace("%s", $this->nama_dokumen->caption(), $this->nama_dokumen->RequiredErrorMessage));
            }
        }
        if ($this->tahun_pembuatan_dokumen->Required) {
            if (!$this->tahun_pembuatan_dokumen->IsDetailKey && EmptyValue($this->tahun_pembuatan_dokumen->FormValue)) {
                $this->tahun_pembuatan_dokumen->addErrorMessage(str_replace("%s", $this->tahun_pembuatan_dokumen->caption(), $this->tahun_pembuatan_dokumen->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->tahun_pembuatan_dokumen->FormValue)) {
            $this->tahun_pembuatan_dokumen->addErrorMessage($this->tahun_pembuatan_dokumen->getErrorMessage(false));
        }
        if ($this->deskripsi->Required) {
            if (!$this->deskripsi->IsDetailKey && EmptyValue($this->deskripsi->FormValue)) {
                $this->deskripsi->addErrorMessage(str_replace("%s", $this->deskripsi->caption(), $this->deskripsi->RequiredErrorMessage));
            }
        }
        if ($this->no_gudang->Required) {
            if (!$this->no_gudang->IsDetailKey && EmptyValue($this->no_gudang->FormValue)) {
                $this->no_gudang->addErrorMessage(str_replace("%s", $this->no_gudang->caption(), $this->no_gudang->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->no_gudang->FormValue)) {
            $this->no_gudang->addErrorMessage($this->no_gudang->getErrorMessage(false));
        }
        if ($this->no_rak->Required) {
            if (!$this->no_rak->IsDetailKey && EmptyValue($this->no_rak->FormValue)) {
                $this->no_rak->addErrorMessage(str_replace("%s", $this->no_rak->caption(), $this->no_rak->RequiredErrorMessage));
            }
        }
        if ($this->file->Required) {
            if ($this->file->Upload->FileName == "" && !$this->file->Upload->KeepFile) {
                $this->file->addErrorMessage(str_replace("%s", $this->file->caption(), $this->file->RequiredErrorMessage));
            }
        }
        if ($this->masa_berlaku->Required) {
            if (!$this->masa_berlaku->IsDetailKey && EmptyValue($this->masa_berlaku->FormValue)) {
                $this->masa_berlaku->addErrorMessage(str_replace("%s", $this->masa_berlaku->caption(), $this->masa_berlaku->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->masa_berlaku->FormValue)) {
            $this->masa_berlaku->addErrorMessage($this->masa_berlaku->getErrorMessage(false));
        }
        if ($this->kode->Required) {
            if (!$this->kode->IsDetailKey && EmptyValue($this->kode->FormValue)) {
                $this->kode->addErrorMessage(str_replace("%s", $this->kode->caption(), $this->kode->RequiredErrorMessage));
            }
        }
        if ($this->kode_box->Required) {
            if (!$this->kode_box->IsDetailKey && EmptyValue($this->kode_box->FormValue)) {
                $this->kode_box->addErrorMessage(str_replace("%s", $this->kode_box->caption(), $this->kode_box->RequiredErrorMessage));
            }
        }
        if ($this->created_date->Required) {
            if (!$this->created_date->IsDetailKey && EmptyValue($this->created_date->FormValue)) {
                $this->created_date->addErrorMessage(str_replace("%s", $this->created_date->caption(), $this->created_date->RequiredErrorMessage));
            }
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

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;
        $conn = $this->getConnection();

        // Load db values from rsold
        $this->loadDbValues($rsold);
        if ($rsold) {
        }
        $rsnew = [];

        // no_box
        $this->no_box->setDbValueDef($rsnew, $this->no_box->CurrentValue, null, false);

        // kode_pt
        $this->kode_pt->setDbValueDef($rsnew, $this->kode_pt->CurrentValue, 0, false);

        // kode_department
        $this->kode_department->setDbValueDef($rsnew, $this->kode_department->CurrentValue, 0, false);

        // lokasi
        $this->lokasi->setDbValueDef($rsnew, $this->lokasi->CurrentValue, null, false);

        // nama_dokumen
        $this->nama_dokumen->setDbValueDef($rsnew, $this->nama_dokumen->CurrentValue, "", false);

        // tahun_pembuatan_dokumen
        $this->tahun_pembuatan_dokumen->setDbValueDef($rsnew, $this->tahun_pembuatan_dokumen->CurrentValue, 0, false);

        // deskripsi
        $this->deskripsi->setDbValueDef($rsnew, $this->deskripsi->CurrentValue, null, false);

        // no_gudang
        $this->no_gudang->setDbValueDef($rsnew, $this->no_gudang->CurrentValue, null, false);

        // no_rak
        $this->no_rak->setDbValueDef($rsnew, $this->no_rak->CurrentValue, null, false);

        // file
        if ($this->file->Visible && !$this->file->Upload->KeepFile) {
            $this->file->Upload->DbValue = ""; // No need to delete old file
            if ($this->file->Upload->FileName == "") {
                $rsnew['file'] = null;
            } else {
                $rsnew['file'] = $this->file->Upload->FileName;
            }
        }

        // masa_berlaku
        $this->masa_berlaku->setDbValueDef($rsnew, $this->masa_berlaku->CurrentValue, null, false);

        // kode
        $this->kode->setDbValueDef($rsnew, $this->kode->CurrentValue, null, false);

        // kode_box
        $this->kode_box->setDbValueDef($rsnew, $this->kode_box->CurrentValue, null, false);

        // created_date
        $this->created_date->CurrentValue = CurrentDate();
        $this->created_date->setDbValueDef($rsnew, $this->created_date->CurrentValue, CurrentDate());
        if ($this->file->Visible && !$this->file->Upload->KeepFile) {
            $oldFiles = EmptyValue($this->file->Upload->DbValue) ? [] : [$this->file->htmlDecode($this->file->Upload->DbValue)];
            if (!EmptyValue($this->file->Upload->FileName)) {
                $newFiles = [$this->file->Upload->FileName];
                $NewFileCount = count($newFiles);
                for ($i = 0; $i < $NewFileCount; $i++) {
                    if ($newFiles[$i] != "") {
                        $file = $newFiles[$i];
                        $tempPath = UploadTempPath($this->file, $this->file->Upload->Index);
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
                            $file1 = UniqueFilename($this->file->physicalUploadPath(), $file); // Get new file name
                            if ($file1 != $file) { // Rename temp file
                                while (file_exists($tempPath . $file1) || file_exists($this->file->physicalUploadPath() . $file1)) { // Make sure no file name clash
                                    $file1 = UniqueFilename([$this->file->physicalUploadPath(), $tempPath], $file1, true); // Use indexed name
                                }
                                rename($tempPath . $file, $tempPath . $file1);
                                $newFiles[$i] = $file1;
                            }
                        }
                    }
                }
                $this->file->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
                $this->file->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
                $this->file->setDbValueDef($rsnew, $this->file->Upload->FileName, null, false);
            }
        }

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
        if ($insertRow) {
            $addRow = $this->insert($rsnew);
            if ($addRow) {
                if ($this->file->Visible && !$this->file->Upload->KeepFile) {
                    $oldFiles = EmptyValue($this->file->Upload->DbValue) ? [] : [$this->file->htmlDecode($this->file->Upload->DbValue)];
                    if (!EmptyValue($this->file->Upload->FileName)) {
                        $newFiles = [$this->file->Upload->FileName];
                        $newFiles2 = [$this->file->htmlDecode($rsnew['file'])];
                        $newFileCount = count($newFiles);
                        for ($i = 0; $i < $newFileCount; $i++) {
                            if ($newFiles[$i] != "") {
                                $file = UploadTempPath($this->file, $this->file->Upload->Index) . $newFiles[$i];
                                if (file_exists($file)) {
                                    if (@$newFiles2[$i] != "") { // Use correct file name
                                        $newFiles[$i] = $newFiles2[$i];
                                    }
                                    if (!$this->file->Upload->SaveToFile($newFiles[$i], true, $i)) { // Just replace
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
                                @unlink($this->file->oldPhysicalUploadPath() . $oldFile);
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
            // file
            CleanUploadTempPath($this->file, $this->file->Upload->Index);
        }

        // Write JSON for API request
        if (IsApi() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $addRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("filingdokumenlist"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
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
}
