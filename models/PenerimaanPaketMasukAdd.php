<?php

namespace Mitral2022\DSN2;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class PenerimaanPaketMasukAdd extends PenerimaanPaketMasuk
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'penerimaan_paket_masuk';

    // Page object name
    public $PageObjName = "PenerimaanPaketMasukAdd";

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

        // Table object (penerimaan_paket_masuk)
        if (!isset($GLOBALS["penerimaan_paket_masuk"]) || get_class($GLOBALS["penerimaan_paket_masuk"]) == PROJECT_NAMESPACE . "penerimaan_paket_masuk") {
            $GLOBALS["penerimaan_paket_masuk"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'penerimaan_paket_masuk');
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
                $tbl = Container("penerimaan_paket_masuk");
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
                    if ($pageName == "penerimaanpaketmasukview") {
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
        $this->id->Visible = false;
        $this->no_dokumen_no_paket->Visible = false;
        $this->no_dokumen->setVisibility();
        $this->no_paket->setVisibility();
        $this->jenis_dokumen->setVisibility();
        $this->nama_pengirim->setVisibility();
        $this->keterangan->setVisibility();
        $this->nama_penerima->setVisibility();
        $this->email_penerima->setVisibility();
        $this->no_hp_penerima->setVisibility();
        $this->status->setVisibility();
        $this->tanggal_terima->setVisibility();
        $this->bukti_penerimaan->setVisibility();
        $this->diterima_oleh->setVisibility();
        $this->id_user->setVisibility();
        $this->created_date->setVisibility();
        $this->update_by->setVisibility();
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
        $this->setupLookupOptions($this->jenis_dokumen);
        $this->setupLookupOptions($this->nama_penerima);
        $this->setupLookupOptions($this->status);
        $this->setupLookupOptions($this->id_user);

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
                    $this->terminate("penerimaanpaketmasuklist"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "penerimaanpaketmasuklist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "penerimaanpaketmasukview") {
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
        $this->bukti_penerimaan->Upload->Index = $CurrentForm->Index;
        $this->bukti_penerimaan->Upload->uploadFile();
        $this->bukti_penerimaan->CurrentValue = $this->bukti_penerimaan->Upload->FileName;
    }

    // Load default values
    protected function loadDefaultValues()
    {
        $this->id->CurrentValue = null;
        $this->id->OldValue = $this->id->CurrentValue;
        $this->no_dokumen_no_paket->CurrentValue = null;
        $this->no_dokumen_no_paket->OldValue = $this->no_dokumen_no_paket->CurrentValue;
        $this->no_dokumen->CurrentValue = null;
        $this->no_dokumen->OldValue = $this->no_dokumen->CurrentValue;
        $this->no_paket->CurrentValue = null;
        $this->no_paket->OldValue = $this->no_paket->CurrentValue;
        $this->jenis_dokumen->CurrentValue = null;
        $this->jenis_dokumen->OldValue = $this->jenis_dokumen->CurrentValue;
        $this->nama_pengirim->CurrentValue = null;
        $this->nama_pengirim->OldValue = $this->nama_pengirim->CurrentValue;
        $this->keterangan->CurrentValue = null;
        $this->keterangan->OldValue = $this->keterangan->CurrentValue;
        $this->nama_penerima->CurrentValue = null;
        $this->nama_penerima->OldValue = $this->nama_penerima->CurrentValue;
        $this->email_penerima->CurrentValue = null;
        $this->email_penerima->OldValue = $this->email_penerima->CurrentValue;
        $this->no_hp_penerima->CurrentValue = null;
        $this->no_hp_penerima->OldValue = $this->no_hp_penerima->CurrentValue;
        $this->status->CurrentValue = null;
        $this->status->OldValue = $this->status->CurrentValue;
        $this->tanggal_terima->CurrentValue = null;
        $this->tanggal_terima->OldValue = $this->tanggal_terima->CurrentValue;
        $this->bukti_penerimaan->Upload->DbValue = null;
        $this->bukti_penerimaan->OldValue = $this->bukti_penerimaan->Upload->DbValue;
        $this->bukti_penerimaan->CurrentValue = null; // Clear file related field
        $this->diterima_oleh->CurrentValue = null;
        $this->diterima_oleh->OldValue = $this->diterima_oleh->CurrentValue;
        $this->id_user->CurrentValue = CurrentUserID();
        $this->created_date->CurrentValue = CurrentDate();
        $this->update_by->CurrentValue = CurrentUserName();
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'no_dokumen' first before field var 'x_no_dokumen'
        $val = $CurrentForm->hasValue("no_dokumen") ? $CurrentForm->getValue("no_dokumen") : $CurrentForm->getValue("x_no_dokumen");
        if (!$this->no_dokumen->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no_dokumen->Visible = false; // Disable update for API request
            } else {
                $this->no_dokumen->setFormValue($val);
            }
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

        // Check field name 'jenis_dokumen' first before field var 'x_jenis_dokumen'
        $val = $CurrentForm->hasValue("jenis_dokumen") ? $CurrentForm->getValue("jenis_dokumen") : $CurrentForm->getValue("x_jenis_dokumen");
        if (!$this->jenis_dokumen->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jenis_dokumen->Visible = false; // Disable update for API request
            } else {
                $this->jenis_dokumen->setFormValue($val);
            }
        }

        // Check field name 'nama_pengirim' first before field var 'x_nama_pengirim'
        $val = $CurrentForm->hasValue("nama_pengirim") ? $CurrentForm->getValue("nama_pengirim") : $CurrentForm->getValue("x_nama_pengirim");
        if (!$this->nama_pengirim->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nama_pengirim->Visible = false; // Disable update for API request
            } else {
                $this->nama_pengirim->setFormValue($val);
            }
        }

        // Check field name 'keterangan' first before field var 'x_keterangan'
        $val = $CurrentForm->hasValue("keterangan") ? $CurrentForm->getValue("keterangan") : $CurrentForm->getValue("x_keterangan");
        if (!$this->keterangan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->keterangan->Visible = false; // Disable update for API request
            } else {
                $this->keterangan->setFormValue($val);
            }
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

        // Check field name 'email_penerima' first before field var 'x_email_penerima'
        $val = $CurrentForm->hasValue("email_penerima") ? $CurrentForm->getValue("email_penerima") : $CurrentForm->getValue("x_email_penerima");
        if (!$this->email_penerima->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->email_penerima->Visible = false; // Disable update for API request
            } else {
                $this->email_penerima->setFormValue($val);
            }
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

        // Check field name 'status' first before field var 'x_status'
        $val = $CurrentForm->hasValue("status") ? $CurrentForm->getValue("status") : $CurrentForm->getValue("x_status");
        if (!$this->status->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->status->Visible = false; // Disable update for API request
            } else {
                $this->status->setFormValue($val);
            }
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

        // Check field name 'diterima_oleh' first before field var 'x_diterima_oleh'
        $val = $CurrentForm->hasValue("diterima_oleh") ? $CurrentForm->getValue("diterima_oleh") : $CurrentForm->getValue("x_diterima_oleh");
        if (!$this->diterima_oleh->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->diterima_oleh->Visible = false; // Disable update for API request
            } else {
                $this->diterima_oleh->setFormValue($val);
            }
        }

        // Check field name 'id_user' first before field var 'x_id_user'
        $val = $CurrentForm->hasValue("id_user") ? $CurrentForm->getValue("id_user") : $CurrentForm->getValue("x_id_user");
        if (!$this->id_user->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->id_user->Visible = false; // Disable update for API request
            } else {
                $this->id_user->setFormValue($val);
            }
        }

        // Check field name 'created_date' first before field var 'x_created_date'
        $val = $CurrentForm->hasValue("created_date") ? $CurrentForm->getValue("created_date") : $CurrentForm->getValue("x_created_date");
        if (!$this->created_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->created_date->Visible = false; // Disable update for API request
            } else {
                $this->created_date->setFormValue($val, true, $validate);
            }
            $this->created_date->CurrentValue = UnFormatDateTime($this->created_date->CurrentValue, $this->created_date->formatPattern());
        }

        // Check field name 'update_by' first before field var 'x_update_by'
        $val = $CurrentForm->hasValue("update_by") ? $CurrentForm->getValue("update_by") : $CurrentForm->getValue("x_update_by");
        if (!$this->update_by->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->update_by->Visible = false; // Disable update for API request
            } else {
                $this->update_by->setFormValue($val);
            }
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
        $this->getUploadFiles(); // Get upload files
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->no_dokumen->CurrentValue = $this->no_dokumen->FormValue;
        $this->no_paket->CurrentValue = $this->no_paket->FormValue;
        $this->jenis_dokumen->CurrentValue = $this->jenis_dokumen->FormValue;
        $this->nama_pengirim->CurrentValue = $this->nama_pengirim->FormValue;
        $this->keterangan->CurrentValue = $this->keterangan->FormValue;
        $this->nama_penerima->CurrentValue = $this->nama_penerima->FormValue;
        $this->email_penerima->CurrentValue = $this->email_penerima->FormValue;
        $this->no_hp_penerima->CurrentValue = $this->no_hp_penerima->FormValue;
        $this->status->CurrentValue = $this->status->FormValue;
        $this->tanggal_terima->CurrentValue = $this->tanggal_terima->FormValue;
        $this->tanggal_terima->CurrentValue = UnFormatDateTime($this->tanggal_terima->CurrentValue, $this->tanggal_terima->formatPattern());
        $this->diterima_oleh->CurrentValue = $this->diterima_oleh->FormValue;
        $this->id_user->CurrentValue = $this->id_user->FormValue;
        $this->created_date->CurrentValue = $this->created_date->FormValue;
        $this->created_date->CurrentValue = UnFormatDateTime($this->created_date->CurrentValue, $this->created_date->formatPattern());
        $this->update_by->CurrentValue = $this->update_by->FormValue;
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

        // Check if valid User ID
        if ($res) {
            $res = $this->showOptionLink("add");
            if (!$res) {
                $userIdMsg = DeniedMessage();
                $this->setFailureMessage($userIdMsg);
            }
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
        $this->no_dokumen_no_paket->setDbValue($row['no_dokumen_no_paket']);
        $this->no_dokumen->setDbValue($row['no_dokumen']);
        $this->no_paket->setDbValue($row['no_paket']);
        $this->jenis_dokumen->setDbValue($row['jenis_dokumen']);
        $this->nama_pengirim->setDbValue($row['nama_pengirim']);
        $this->keterangan->setDbValue($row['keterangan']);
        $this->nama_penerima->setDbValue($row['nama_penerima']);
        $this->email_penerima->setDbValue($row['email_penerima']);
        $this->no_hp_penerima->setDbValue($row['no_hp_penerima']);
        $this->status->setDbValue($row['status']);
        $this->tanggal_terima->setDbValue($row['tanggal_terima']);
        $this->bukti_penerimaan->Upload->DbValue = $row['bukti_penerimaan'];
        $this->bukti_penerimaan->setDbValue($this->bukti_penerimaan->Upload->DbValue);
        $this->diterima_oleh->setDbValue($row['diterima_oleh']);
        $this->id_user->setDbValue($row['id_user']);
        $this->created_date->setDbValue($row['created_date']);
        $this->update_by->setDbValue($row['update_by']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['id'] = $this->id->CurrentValue;
        $row['no_dokumen_no_paket'] = $this->no_dokumen_no_paket->CurrentValue;
        $row['no_dokumen'] = $this->no_dokumen->CurrentValue;
        $row['no_paket'] = $this->no_paket->CurrentValue;
        $row['jenis_dokumen'] = $this->jenis_dokumen->CurrentValue;
        $row['nama_pengirim'] = $this->nama_pengirim->CurrentValue;
        $row['keterangan'] = $this->keterangan->CurrentValue;
        $row['nama_penerima'] = $this->nama_penerima->CurrentValue;
        $row['email_penerima'] = $this->email_penerima->CurrentValue;
        $row['no_hp_penerima'] = $this->no_hp_penerima->CurrentValue;
        $row['status'] = $this->status->CurrentValue;
        $row['tanggal_terima'] = $this->tanggal_terima->CurrentValue;
        $row['bukti_penerimaan'] = $this->bukti_penerimaan->Upload->DbValue;
        $row['diterima_oleh'] = $this->diterima_oleh->CurrentValue;
        $row['id_user'] = $this->id_user->CurrentValue;
        $row['created_date'] = $this->created_date->CurrentValue;
        $row['update_by'] = $this->update_by->CurrentValue;
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

        // id
        $this->id->RowCssClass = "row";

        // no_dokumen_no_paket
        $this->no_dokumen_no_paket->RowCssClass = "row";

        // no_dokumen
        $this->no_dokumen->RowCssClass = "row";

        // no_paket
        $this->no_paket->RowCssClass = "row";

        // jenis_dokumen
        $this->jenis_dokumen->RowCssClass = "row";

        // nama_pengirim
        $this->nama_pengirim->RowCssClass = "row";

        // keterangan
        $this->keterangan->RowCssClass = "row";

        // nama_penerima
        $this->nama_penerima->RowCssClass = "row";

        // email_penerima
        $this->email_penerima->RowCssClass = "row";

        // no_hp_penerima
        $this->no_hp_penerima->RowCssClass = "row";

        // status
        $this->status->RowCssClass = "row";

        // tanggal_terima
        $this->tanggal_terima->RowCssClass = "row";

        // bukti_penerimaan
        $this->bukti_penerimaan->RowCssClass = "row";

        // diterima_oleh
        $this->diterima_oleh->RowCssClass = "row";

        // id_user
        $this->id_user->RowCssClass = "row";

        // created_date
        $this->created_date->RowCssClass = "row";

        // update_by
        $this->update_by->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // no_dokumen_no_paket
            $this->no_dokumen_no_paket->ViewValue = $this->no_dokumen_no_paket->CurrentValue;
            $this->no_dokumen_no_paket->ViewCustomAttributes = "";

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

            // nama_pengirim
            $this->nama_pengirim->ViewValue = $this->nama_pengirim->CurrentValue;
            $this->nama_pengirim->ViewCustomAttributes = "";

            // keterangan
            $this->keterangan->ViewValue = $this->keterangan->CurrentValue;
            $this->keterangan->ViewCustomAttributes = "";

            // nama_penerima
            $curVal = strval($this->nama_penerima->CurrentValue);
            if ($curVal != "") {
                $this->nama_penerima->ViewValue = $this->nama_penerima->lookupCacheOption($curVal);
                if ($this->nama_penerima->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->nama_penerima->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->nama_penerima->Lookup->renderViewRow($rswrk[0]);
                        $this->nama_penerima->ViewValue = $this->nama_penerima->displayValue($arwrk);
                    } else {
                        $this->nama_penerima->ViewValue = FormatNumber($this->nama_penerima->CurrentValue, $this->nama_penerima->formatPattern());
                    }
                }
            } else {
                $this->nama_penerima->ViewValue = null;
            }
            $this->nama_penerima->ViewCustomAttributes = "";

            // email_penerima
            $this->email_penerima->ViewValue = $this->email_penerima->CurrentValue;
            $this->email_penerima->ViewCustomAttributes = "";

            // no_hp_penerima
            $this->no_hp_penerima->ViewValue = $this->no_hp_penerima->CurrentValue;
            $this->no_hp_penerima->ViewCustomAttributes = "";

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

            // diterima_oleh
            $this->diterima_oleh->ViewValue = $this->diterima_oleh->CurrentValue;
            $this->diterima_oleh->ViewCustomAttributes = "";

            // id_user
            $curVal = strval($this->id_user->CurrentValue);
            if ($curVal != "") {
                $this->id_user->ViewValue = $this->id_user->lookupCacheOption($curVal);
                if ($this->id_user->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->id_user->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->id_user->Lookup->renderViewRow($rswrk[0]);
                        $this->id_user->ViewValue = $this->id_user->displayValue($arwrk);
                    } else {
                        $this->id_user->ViewValue = FormatNumber($this->id_user->CurrentValue, $this->id_user->formatPattern());
                    }
                }
            } else {
                $this->id_user->ViewValue = null;
            }
            $this->id_user->ViewCustomAttributes = "";

            // created_date
            $this->created_date->ViewValue = $this->created_date->CurrentValue;
            $this->created_date->ViewValue = FormatDateTime($this->created_date->ViewValue, $this->created_date->formatPattern());
            $this->created_date->ViewCustomAttributes = "";

            // update_by
            $this->update_by->ViewValue = $this->update_by->CurrentValue;
            $this->update_by->ViewCustomAttributes = "";

            // no_dokumen
            $this->no_dokumen->LinkCustomAttributes = "";
            $this->no_dokumen->HrefValue = "";

            // no_paket
            $this->no_paket->LinkCustomAttributes = "";
            $this->no_paket->HrefValue = "";

            // jenis_dokumen
            $this->jenis_dokumen->LinkCustomAttributes = "";
            $this->jenis_dokumen->HrefValue = "";

            // nama_pengirim
            $this->nama_pengirim->LinkCustomAttributes = "";
            $this->nama_pengirim->HrefValue = "";

            // keterangan
            $this->keterangan->LinkCustomAttributes = "";
            $this->keterangan->HrefValue = "";

            // nama_penerima
            $this->nama_penerima->LinkCustomAttributes = "";
            $this->nama_penerima->HrefValue = "";

            // email_penerima
            $this->email_penerima->LinkCustomAttributes = "";
            $this->email_penerima->HrefValue = "";

            // no_hp_penerima
            $this->no_hp_penerima->LinkCustomAttributes = "";
            $this->no_hp_penerima->HrefValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";

            // tanggal_terima
            $this->tanggal_terima->LinkCustomAttributes = "";
            $this->tanggal_terima->HrefValue = "";

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

            // diterima_oleh
            $this->diterima_oleh->LinkCustomAttributes = "";
            $this->diterima_oleh->HrefValue = "";

            // id_user
            $this->id_user->LinkCustomAttributes = "";
            $this->id_user->HrefValue = "";

            // created_date
            $this->created_date->LinkCustomAttributes = "";
            $this->created_date->HrefValue = "";

            // update_by
            $this->update_by->LinkCustomAttributes = "";
            $this->update_by->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
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

            // nama_pengirim
            $this->nama_pengirim->setupEditAttributes();
            $this->nama_pengirim->EditCustomAttributes = "";
            if (!$this->nama_pengirim->Raw) {
                $this->nama_pengirim->CurrentValue = HtmlDecode($this->nama_pengirim->CurrentValue);
            }
            $this->nama_pengirim->EditValue = HtmlEncode($this->nama_pengirim->CurrentValue);
            $this->nama_pengirim->PlaceHolder = RemoveHtml($this->nama_pengirim->caption());

            // keterangan
            $this->keterangan->setupEditAttributes();
            $this->keterangan->EditCustomAttributes = "";
            $this->keterangan->EditValue = HtmlEncode($this->keterangan->CurrentValue);
            $this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());

            // nama_penerima
            $this->nama_penerima->setupEditAttributes();
            $this->nama_penerima->EditCustomAttributes = "";
            $curVal = trim(strval($this->nama_penerima->CurrentValue));
            if ($curVal != "") {
                $this->nama_penerima->ViewValue = $this->nama_penerima->lookupCacheOption($curVal);
            } else {
                $this->nama_penerima->ViewValue = $this->nama_penerima->Lookup !== null && is_array($this->nama_penerima->lookupOptions()) ? $curVal : null;
            }
            if ($this->nama_penerima->ViewValue !== null) { // Load from cache
                $this->nama_penerima->EditValue = array_values($this->nama_penerima->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->nama_penerima->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->nama_penerima->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->nama_penerima->EditValue = $arwrk;
            }
            $this->nama_penerima->PlaceHolder = RemoveHtml($this->nama_penerima->caption());

            // email_penerima
            $this->email_penerima->setupEditAttributes();
            $this->email_penerima->EditCustomAttributes = "";
            if (!$this->email_penerima->Raw) {
                $this->email_penerima->CurrentValue = HtmlDecode($this->email_penerima->CurrentValue);
            }
            $this->email_penerima->EditValue = HtmlEncode($this->email_penerima->CurrentValue);
            $this->email_penerima->PlaceHolder = RemoveHtml($this->email_penerima->caption());

            // no_hp_penerima
            $this->no_hp_penerima->setupEditAttributes();
            $this->no_hp_penerima->EditCustomAttributes = "";
            if (!$this->no_hp_penerima->Raw) {
                $this->no_hp_penerima->CurrentValue = HtmlDecode($this->no_hp_penerima->CurrentValue);
            }
            $this->no_hp_penerima->EditValue = HtmlEncode($this->no_hp_penerima->CurrentValue);
            $this->no_hp_penerima->PlaceHolder = RemoveHtml($this->no_hp_penerima->caption());

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
                $this->bukti_penerimaan->Upload->FileName = $this->bukti_penerimaan->CurrentValue;
            }
            if ($this->isShow() || $this->isCopy()) {
                RenderUploadField($this->bukti_penerimaan);
            }

            // diterima_oleh
            $this->diterima_oleh->setupEditAttributes();
            $this->diterima_oleh->EditCustomAttributes = "";
            if (!$this->diterima_oleh->Raw) {
                $this->diterima_oleh->CurrentValue = HtmlDecode($this->diterima_oleh->CurrentValue);
            }
            $this->diterima_oleh->EditValue = HtmlEncode($this->diterima_oleh->CurrentValue);
            $this->diterima_oleh->PlaceHolder = RemoveHtml($this->diterima_oleh->caption());

            // id_user

            // created_date
            $this->created_date->setupEditAttributes();
            $this->created_date->EditCustomAttributes = "";
            $this->created_date->EditValue = HtmlEncode(FormatDateTime($this->created_date->CurrentValue, $this->created_date->formatPattern()));
            $this->created_date->PlaceHolder = RemoveHtml($this->created_date->caption());

            // update_by

            // Add refer script

            // no_dokumen
            $this->no_dokumen->LinkCustomAttributes = "";
            $this->no_dokumen->HrefValue = "";

            // no_paket
            $this->no_paket->LinkCustomAttributes = "";
            $this->no_paket->HrefValue = "";

            // jenis_dokumen
            $this->jenis_dokumen->LinkCustomAttributes = "";
            $this->jenis_dokumen->HrefValue = "";

            // nama_pengirim
            $this->nama_pengirim->LinkCustomAttributes = "";
            $this->nama_pengirim->HrefValue = "";

            // keterangan
            $this->keterangan->LinkCustomAttributes = "";
            $this->keterangan->HrefValue = "";

            // nama_penerima
            $this->nama_penerima->LinkCustomAttributes = "";
            $this->nama_penerima->HrefValue = "";

            // email_penerima
            $this->email_penerima->LinkCustomAttributes = "";
            $this->email_penerima->HrefValue = "";

            // no_hp_penerima
            $this->no_hp_penerima->LinkCustomAttributes = "";
            $this->no_hp_penerima->HrefValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";

            // tanggal_terima
            $this->tanggal_terima->LinkCustomAttributes = "";
            $this->tanggal_terima->HrefValue = "";

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

            // diterima_oleh
            $this->diterima_oleh->LinkCustomAttributes = "";
            $this->diterima_oleh->HrefValue = "";

            // id_user
            $this->id_user->LinkCustomAttributes = "";
            $this->id_user->HrefValue = "";

            // created_date
            $this->created_date->LinkCustomAttributes = "";
            $this->created_date->HrefValue = "";

            // update_by
            $this->update_by->LinkCustomAttributes = "";
            $this->update_by->HrefValue = "";
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
        if ($this->nama_pengirim->Required) {
            if (!$this->nama_pengirim->IsDetailKey && EmptyValue($this->nama_pengirim->FormValue)) {
                $this->nama_pengirim->addErrorMessage(str_replace("%s", $this->nama_pengirim->caption(), $this->nama_pengirim->RequiredErrorMessage));
            }
        }
        if ($this->keterangan->Required) {
            if (!$this->keterangan->IsDetailKey && EmptyValue($this->keterangan->FormValue)) {
                $this->keterangan->addErrorMessage(str_replace("%s", $this->keterangan->caption(), $this->keterangan->RequiredErrorMessage));
            }
        }
        if ($this->nama_penerima->Required) {
            if (!$this->nama_penerima->IsDetailKey && EmptyValue($this->nama_penerima->FormValue)) {
                $this->nama_penerima->addErrorMessage(str_replace("%s", $this->nama_penerima->caption(), $this->nama_penerima->RequiredErrorMessage));
            }
        }
        if ($this->email_penerima->Required) {
            if (!$this->email_penerima->IsDetailKey && EmptyValue($this->email_penerima->FormValue)) {
                $this->email_penerima->addErrorMessage(str_replace("%s", $this->email_penerima->caption(), $this->email_penerima->RequiredErrorMessage));
            }
        }
        if ($this->no_hp_penerima->Required) {
            if (!$this->no_hp_penerima->IsDetailKey && EmptyValue($this->no_hp_penerima->FormValue)) {
                $this->no_hp_penerima->addErrorMessage(str_replace("%s", $this->no_hp_penerima->caption(), $this->no_hp_penerima->RequiredErrorMessage));
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
        if ($this->bukti_penerimaan->Required) {
            if ($this->bukti_penerimaan->Upload->FileName == "" && !$this->bukti_penerimaan->Upload->KeepFile) {
                $this->bukti_penerimaan->addErrorMessage(str_replace("%s", $this->bukti_penerimaan->caption(), $this->bukti_penerimaan->RequiredErrorMessage));
            }
        }
        if ($this->diterima_oleh->Required) {
            if (!$this->diterima_oleh->IsDetailKey && EmptyValue($this->diterima_oleh->FormValue)) {
                $this->diterima_oleh->addErrorMessage(str_replace("%s", $this->diterima_oleh->caption(), $this->diterima_oleh->RequiredErrorMessage));
            }
        }
        if ($this->id_user->Required) {
            if (!$this->id_user->IsDetailKey && EmptyValue($this->id_user->FormValue)) {
                $this->id_user->addErrorMessage(str_replace("%s", $this->id_user->caption(), $this->id_user->RequiredErrorMessage));
            }
        }
        if ($this->created_date->Required) {
            if (!$this->created_date->IsDetailKey && EmptyValue($this->created_date->FormValue)) {
                $this->created_date->addErrorMessage(str_replace("%s", $this->created_date->caption(), $this->created_date->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->created_date->FormValue, $this->created_date->formatPattern())) {
            $this->created_date->addErrorMessage($this->created_date->getErrorMessage(false));
        }
        if ($this->update_by->Required) {
            if (!$this->update_by->IsDetailKey && EmptyValue($this->update_by->FormValue)) {
                $this->update_by->addErrorMessage(str_replace("%s", $this->update_by->caption(), $this->update_by->RequiredErrorMessage));
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

        // no_dokumen
        $this->no_dokumen->setDbValueDef($rsnew, $this->no_dokumen->CurrentValue, null, false);

        // no_paket
        $this->no_paket->setDbValueDef($rsnew, $this->no_paket->CurrentValue, null, false);

        // jenis_dokumen
        $this->jenis_dokumen->setDbValueDef($rsnew, $this->jenis_dokumen->CurrentValue, 0, false);

        // nama_pengirim
        $this->nama_pengirim->setDbValueDef($rsnew, $this->nama_pengirim->CurrentValue, null, false);

        // keterangan
        $this->keterangan->setDbValueDef($rsnew, $this->keterangan->CurrentValue, null, false);

        // nama_penerima
        $this->nama_penerima->setDbValueDef($rsnew, $this->nama_penerima->CurrentValue, 0, false);

        // email_penerima
        $this->email_penerima->setDbValueDef($rsnew, $this->email_penerima->CurrentValue, "", false);

        // no_hp_penerima
        $this->no_hp_penerima->setDbValueDef($rsnew, $this->no_hp_penerima->CurrentValue, "", false);

        // status
        $this->status->setDbValueDef($rsnew, $this->status->CurrentValue, null, false);

        // tanggal_terima
        $this->tanggal_terima->setDbValueDef($rsnew, UnFormatDateTime($this->tanggal_terima->CurrentValue, $this->tanggal_terima->formatPattern()), null, false);

        // bukti_penerimaan
        if ($this->bukti_penerimaan->Visible && !$this->bukti_penerimaan->Upload->KeepFile) {
            $this->bukti_penerimaan->Upload->DbValue = ""; // No need to delete old file
            if ($this->bukti_penerimaan->Upload->FileName == "") {
                $rsnew['bukti_penerimaan'] = null;
            } else {
                $rsnew['bukti_penerimaan'] = $this->bukti_penerimaan->Upload->FileName;
            }
        }

        // diterima_oleh
        $this->diterima_oleh->setDbValueDef($rsnew, $this->diterima_oleh->CurrentValue, null, false);

        // id_user
        $this->id_user->CurrentValue = CurrentUserID();
        $this->id_user->setDbValueDef($rsnew, $this->id_user->CurrentValue, 0);

        // created_date
        $this->created_date->setDbValueDef($rsnew, UnFormatDateTime($this->created_date->CurrentValue, $this->created_date->formatPattern()), CurrentDate(), false);

        // update_by
        $this->update_by->CurrentValue = CurrentUserName();
        $this->update_by->setDbValueDef($rsnew, $this->update_by->CurrentValue, null);
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

    // Show link optionally based on User ID
    protected function showOptionLink($id = "")
    {
        global $Security;
        if ($Security->isLoggedIn() && !$Security->isAdmin() && !$this->userIDAllow($id)) {
            return $Security->isValidUserID($this->id_user->CurrentValue);
        }
        return true;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("penerimaanpaketmasuklist"), "", $this->TableVar, true);
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
                case "x_jenis_dokumen":
                    break;
                case "x_nama_penerima":
                    break;
                case "x_status":
                    break;
                case "x_id_user":
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
