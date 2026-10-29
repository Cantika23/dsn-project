<?php

namespace Mitral2022\DSN2;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class VPenerimaanPaketKeluarShowNamaUserEdit extends VPenerimaanPaketKeluarShowNamaUser
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'v_penerimaan_paket_keluar_show_nama_user';

    // Page object name
    public $PageObjName = "VPenerimaanPaketKeluarShowNamaUserEdit";

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

        // Table object (v_penerimaan_paket_keluar_show_nama_user)
        if (!isset($GLOBALS["v_penerimaan_paket_keluar_show_nama_user"]) || get_class($GLOBALS["v_penerimaan_paket_keluar_show_nama_user"]) == PROJECT_NAMESPACE . "v_penerimaan_paket_keluar_show_nama_user") {
            $GLOBALS["v_penerimaan_paket_keluar_show_nama_user"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'v_penerimaan_paket_keluar_show_nama_user');
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
                $tbl = Container("v_penerimaan_paket_keluar_show_nama_user");
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
                    if ($pageName == "vpenerimaanpaketkeluarshownamauserview") {
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
            $key .= @$ar['ID'];
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
            $this->ID->Visible = false;
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

    // Properties
    public $FormClassName = "ew-form ew-edit-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter;
    public $DbDetailFilter;
    public $HashValue; // Hash Value
    public $DisplayRecords = 1;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $RecordCount;

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
        $this->no_dokumen_no_paket->Visible = false;
        $this->NoDokumen->setVisibility();
        $this->NoPaket->setVisibility();
        $this->JenisDokumen->setVisibility();
        $this->Penerima->setVisibility();
        $this->NoHPPenerima->setVisibility();
        $this->EmailPenerima->setVisibility();
        $this->ID->Visible = false;
        $this->Status->setVisibility();
        $this->TanggalTerima->setVisibility();
        $this->MetodePengiriman->setVisibility();
        $this->NamaEkspedisiMessenger->setVisibility();
        $this->NoAWB->setVisibility();
        $this->PIC->setVisibility();
        $this->IDUser->Visible = false;
        $this->CreatedDate->Visible = false;
        $this->BuktiPenerimaan->setVisibility();
        $this->NamaPenerima->setVisibility();
        $this->StatusSAP->setVisibility();
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

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-edit-form";
        $loaded = false;
        $postBack = false;

        // Set up current action and primary key
        if (IsApi()) {
            // Load key values
            $loaded = true;
            if (($keyValue = Get("ID") ?? Key(0) ?? Route(2)) !== null) {
                $this->ID->setQueryStringValue($keyValue);
                $this->ID->setOldValue($this->ID->QueryStringValue);
            } elseif (Post("ID") !== null) {
                $this->ID->setFormValue(Post("ID"));
                $this->ID->setOldValue($this->ID->FormValue);
            } else {
                $loaded = false; // Unable to load key
            }

            // Load record
            if ($loaded) {
                $loaded = $this->loadRow();
            }
            if (!$loaded) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                $this->terminate();
                return;
            }
            $this->CurrentAction = "update"; // Update record directly
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $postBack = true;
        } else {
            if (Post("action") !== null) {
                $this->CurrentAction = Post("action"); // Get action code
                if (!$this->isShow()) { // Not reload record, handle as postback
                    $postBack = true;
                }

                // Get key from Form
                $this->setKey(Post($this->OldKeyName), $this->isShow());
            } else {
                $this->CurrentAction = "show"; // Default action is display

                // Load key from QueryString
                $loadByQuery = false;
                if (($keyValue = Get("ID") ?? Route("ID")) !== null) {
                    $this->ID->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->ID->CurrentValue = null;
                }
            }

            // Load recordset
            if ($this->isShow()) {
                // Load current record
                $loaded = $this->loadRow();
                $this->OldKey = $loaded ? $this->getKey(true) : ""; // Get from CurrentValue
            }
        }

        // Process form if post back
        if ($postBack) {
            $this->loadFormValues(); // Get form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues();
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = ""; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "show": // Get a record to display
                if (!$loaded) { // Load record based on key
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("vpenerimaanpaketkeluarshownamauserlist"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "vpenerimaanpaketkeluarshownamauserlist") {
                    $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                }
                $this->SendEmail = true; // Send email on update success
                if ($this->editRow()) { // Update record based on key
                    if ($this->getSuccessMessage() == "") {
                        $this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
                    }
                    if (IsApi()) {
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl); // Return to caller
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
                    $this->terminate($returnUrl); // Return to caller
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Restore form values if update failed
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render the record
        $this->RowType = ROWTYPE_EDIT; // Render as Edit
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
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'No Dokumen' first before field var 'x_NoDokumen'
        $val = $CurrentForm->hasValue("No Dokumen") ? $CurrentForm->getValue("No Dokumen") : $CurrentForm->getValue("x_NoDokumen");
        if (!$this->NoDokumen->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NoDokumen->Visible = false; // Disable update for API request
            } else {
                $this->NoDokumen->setFormValue($val);
            }
        }

        // Check field name 'No Paket' first before field var 'x_NoPaket'
        $val = $CurrentForm->hasValue("No Paket") ? $CurrentForm->getValue("No Paket") : $CurrentForm->getValue("x_NoPaket");
        if (!$this->NoPaket->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NoPaket->Visible = false; // Disable update for API request
            } else {
                $this->NoPaket->setFormValue($val);
            }
        }

        // Check field name 'Jenis Dokumen' first before field var 'x_JenisDokumen'
        $val = $CurrentForm->hasValue("Jenis Dokumen") ? $CurrentForm->getValue("Jenis Dokumen") : $CurrentForm->getValue("x_JenisDokumen");
        if (!$this->JenisDokumen->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->JenisDokumen->Visible = false; // Disable update for API request
            } else {
                $this->JenisDokumen->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'Penerima' first before field var 'x_Penerima'
        $val = $CurrentForm->hasValue("Penerima") ? $CurrentForm->getValue("Penerima") : $CurrentForm->getValue("x_Penerima");
        if (!$this->Penerima->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Penerima->Visible = false; // Disable update for API request
            } else {
                $this->Penerima->setFormValue($val);
            }
        }

        // Check field name 'No HP Penerima' first before field var 'x_NoHPPenerima'
        $val = $CurrentForm->hasValue("No HP Penerima") ? $CurrentForm->getValue("No HP Penerima") : $CurrentForm->getValue("x_NoHPPenerima");
        if (!$this->NoHPPenerima->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NoHPPenerima->Visible = false; // Disable update for API request
            } else {
                $this->NoHPPenerima->setFormValue($val);
            }
        }

        // Check field name 'Email Penerima' first before field var 'x_EmailPenerima'
        $val = $CurrentForm->hasValue("Email Penerima") ? $CurrentForm->getValue("Email Penerima") : $CurrentForm->getValue("x_EmailPenerima");
        if (!$this->EmailPenerima->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->EmailPenerima->Visible = false; // Disable update for API request
            } else {
                $this->EmailPenerima->setFormValue($val);
            }
        }

        // Check field name 'Status' first before field var 'x_Status'
        $val = $CurrentForm->hasValue("Status") ? $CurrentForm->getValue("Status") : $CurrentForm->getValue("x_Status");
        if (!$this->Status->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Status->Visible = false; // Disable update for API request
            } else {
                $this->Status->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'Tanggal Terima' first before field var 'x_TanggalTerima'
        $val = $CurrentForm->hasValue("Tanggal Terima") ? $CurrentForm->getValue("Tanggal Terima") : $CurrentForm->getValue("x_TanggalTerima");
        if (!$this->TanggalTerima->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->TanggalTerima->Visible = false; // Disable update for API request
            } else {
                $this->TanggalTerima->setFormValue($val, true, $validate);
            }
            $this->TanggalTerima->CurrentValue = UnFormatDateTime($this->TanggalTerima->CurrentValue, $this->TanggalTerima->formatPattern());
        }

        // Check field name 'Metode Pengiriman' first before field var 'x_MetodePengiriman'
        $val = $CurrentForm->hasValue("Metode Pengiriman") ? $CurrentForm->getValue("Metode Pengiriman") : $CurrentForm->getValue("x_MetodePengiriman");
        if (!$this->MetodePengiriman->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->MetodePengiriman->Visible = false; // Disable update for API request
            } else {
                $this->MetodePengiriman->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'Nama Ekspedisi/Messenger' first before field var 'x_NamaEkspedisiMessenger'
        $val = $CurrentForm->hasValue("Nama Ekspedisi/Messenger") ? $CurrentForm->getValue("Nama Ekspedisi/Messenger") : $CurrentForm->getValue("x_NamaEkspedisiMessenger");
        if (!$this->NamaEkspedisiMessenger->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NamaEkspedisiMessenger->Visible = false; // Disable update for API request
            } else {
                $this->NamaEkspedisiMessenger->setFormValue($val);
            }
        }

        // Check field name 'No AWB' first before field var 'x_NoAWB'
        $val = $CurrentForm->hasValue("No AWB") ? $CurrentForm->getValue("No AWB") : $CurrentForm->getValue("x_NoAWB");
        if (!$this->NoAWB->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NoAWB->Visible = false; // Disable update for API request
            } else {
                $this->NoAWB->setFormValue($val);
            }
        }

        // Check field name 'PIC' first before field var 'x_PIC'
        $val = $CurrentForm->hasValue("PIC") ? $CurrentForm->getValue("PIC") : $CurrentForm->getValue("x_PIC");
        if (!$this->PIC->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PIC->Visible = false; // Disable update for API request
            } else {
                $this->PIC->setFormValue($val);
            }
        }

        // Check field name 'Bukti Penerimaan' first before field var 'x_BuktiPenerimaan'
        $val = $CurrentForm->hasValue("Bukti Penerimaan") ? $CurrentForm->getValue("Bukti Penerimaan") : $CurrentForm->getValue("x_BuktiPenerimaan");
        if (!$this->BuktiPenerimaan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->BuktiPenerimaan->Visible = false; // Disable update for API request
            } else {
                $this->BuktiPenerimaan->setFormValue($val);
            }
        }

        // Check field name 'Nama Penerima' first before field var 'x_NamaPenerima'
        $val = $CurrentForm->hasValue("Nama Penerima") ? $CurrentForm->getValue("Nama Penerima") : $CurrentForm->getValue("x_NamaPenerima");
        if (!$this->NamaPenerima->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NamaPenerima->Visible = false; // Disable update for API request
            } else {
                $this->NamaPenerima->setFormValue($val);
            }
        }

        // Check field name 'Status SAP' first before field var 'x_StatusSAP'
        $val = $CurrentForm->hasValue("Status SAP") ? $CurrentForm->getValue("Status SAP") : $CurrentForm->getValue("x_StatusSAP");
        if (!$this->StatusSAP->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->StatusSAP->Visible = false; // Disable update for API request
            } else {
                $this->StatusSAP->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'ID' first before field var 'x_ID'
        $val = $CurrentForm->hasValue("ID") ? $CurrentForm->getValue("ID") : $CurrentForm->getValue("x_ID");
        if (!$this->ID->IsDetailKey) {
            $this->ID->setFormValue($val);
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->ID->CurrentValue = $this->ID->FormValue;
        $this->NoDokumen->CurrentValue = $this->NoDokumen->FormValue;
        $this->NoPaket->CurrentValue = $this->NoPaket->FormValue;
        $this->JenisDokumen->CurrentValue = $this->JenisDokumen->FormValue;
        $this->Penerima->CurrentValue = $this->Penerima->FormValue;
        $this->NoHPPenerima->CurrentValue = $this->NoHPPenerima->FormValue;
        $this->EmailPenerima->CurrentValue = $this->EmailPenerima->FormValue;
        $this->Status->CurrentValue = $this->Status->FormValue;
        $this->TanggalTerima->CurrentValue = $this->TanggalTerima->FormValue;
        $this->TanggalTerima->CurrentValue = UnFormatDateTime($this->TanggalTerima->CurrentValue, $this->TanggalTerima->formatPattern());
        $this->MetodePengiriman->CurrentValue = $this->MetodePengiriman->FormValue;
        $this->NamaEkspedisiMessenger->CurrentValue = $this->NamaEkspedisiMessenger->FormValue;
        $this->NoAWB->CurrentValue = $this->NoAWB->FormValue;
        $this->PIC->CurrentValue = $this->PIC->FormValue;
        $this->BuktiPenerimaan->CurrentValue = $this->BuktiPenerimaan->FormValue;
        $this->NamaPenerima->CurrentValue = $this->NamaPenerima->FormValue;
        $this->StatusSAP->CurrentValue = $this->StatusSAP->FormValue;
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
        $this->no_dokumen_no_paket->setDbValue($row['no_dokumen_no_paket']);
        $this->NoDokumen->setDbValue($row['No Dokumen']);
        $this->NoPaket->setDbValue($row['No Paket']);
        $this->JenisDokumen->setDbValue($row['Jenis Dokumen']);
        $this->Penerima->setDbValue($row['Penerima']);
        $this->NoHPPenerima->setDbValue($row['No HP Penerima']);
        $this->EmailPenerima->setDbValue($row['Email Penerima']);
        $this->ID->setDbValue($row['ID']);
        $this->Status->setDbValue($row['Status']);
        $this->TanggalTerima->setDbValue($row['Tanggal Terima']);
        $this->MetodePengiriman->setDbValue($row['Metode Pengiriman']);
        $this->NamaEkspedisiMessenger->setDbValue($row['Nama Ekspedisi/Messenger']);
        $this->NoAWB->setDbValue($row['No AWB']);
        $this->PIC->setDbValue($row['PIC']);
        $this->IDUser->setDbValue($row['ID User']);
        $this->CreatedDate->setDbValue($row['Created Date']);
        $this->BuktiPenerimaan->setDbValue($row['Bukti Penerimaan']);
        $this->NamaPenerima->setDbValue($row['Nama Penerima']);
        $this->StatusSAP->setDbValue($row['Status SAP']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['no_dokumen_no_paket'] = null;
        $row['No Dokumen'] = null;
        $row['No Paket'] = null;
        $row['Jenis Dokumen'] = null;
        $row['Penerima'] = null;
        $row['No HP Penerima'] = null;
        $row['Email Penerima'] = null;
        $row['ID'] = null;
        $row['Status'] = null;
        $row['Tanggal Terima'] = null;
        $row['Metode Pengiriman'] = null;
        $row['Nama Ekspedisi/Messenger'] = null;
        $row['No AWB'] = null;
        $row['PIC'] = null;
        $row['ID User'] = null;
        $row['Created Date'] = null;
        $row['Bukti Penerimaan'] = null;
        $row['Nama Penerima'] = null;
        $row['Status SAP'] = null;
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

        // no_dokumen_no_paket
        $this->no_dokumen_no_paket->RowCssClass = "row";

        // No Dokumen
        $this->NoDokumen->RowCssClass = "row";

        // No Paket
        $this->NoPaket->RowCssClass = "row";

        // Jenis Dokumen
        $this->JenisDokumen->RowCssClass = "row";

        // Penerima
        $this->Penerima->RowCssClass = "row";

        // No HP Penerima
        $this->NoHPPenerima->RowCssClass = "row";

        // Email Penerima
        $this->EmailPenerima->RowCssClass = "row";

        // ID
        $this->ID->RowCssClass = "row";

        // Status
        $this->Status->RowCssClass = "row";

        // Tanggal Terima
        $this->TanggalTerima->RowCssClass = "row";

        // Metode Pengiriman
        $this->MetodePengiriman->RowCssClass = "row";

        // Nama Ekspedisi/Messenger
        $this->NamaEkspedisiMessenger->RowCssClass = "row";

        // No AWB
        $this->NoAWB->RowCssClass = "row";

        // PIC
        $this->PIC->RowCssClass = "row";

        // ID User
        $this->IDUser->RowCssClass = "row";

        // Created Date
        $this->CreatedDate->RowCssClass = "row";

        // Bukti Penerimaan
        $this->BuktiPenerimaan->RowCssClass = "row";

        // Nama Penerima
        $this->NamaPenerima->RowCssClass = "row";

        // Status SAP
        $this->StatusSAP->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // no_dokumen_no_paket
            $this->no_dokumen_no_paket->ViewValue = $this->no_dokumen_no_paket->CurrentValue;
            $this->no_dokumen_no_paket->ViewCustomAttributes = "";

            // No Dokumen
            $this->NoDokumen->ViewValue = $this->NoDokumen->CurrentValue;
            $this->NoDokumen->ViewCustomAttributes = "";

            // No Paket
            $this->NoPaket->ViewValue = $this->NoPaket->CurrentValue;
            $this->NoPaket->ViewCustomAttributes = "";

            // Jenis Dokumen
            $this->JenisDokumen->ViewValue = $this->JenisDokumen->CurrentValue;
            $this->JenisDokumen->ViewValue = FormatNumber($this->JenisDokumen->ViewValue, $this->JenisDokumen->formatPattern());
            $this->JenisDokumen->ViewCustomAttributes = "";

            // Penerima
            $this->Penerima->ViewValue = $this->Penerima->CurrentValue;
            $this->Penerima->ViewCustomAttributes = "";

            // No HP Penerima
            $this->NoHPPenerima->ViewValue = $this->NoHPPenerima->CurrentValue;
            $this->NoHPPenerima->ViewCustomAttributes = "";

            // Email Penerima
            $this->EmailPenerima->ViewValue = $this->EmailPenerima->CurrentValue;
            $this->EmailPenerima->ViewCustomAttributes = "";

            // Status
            $this->Status->ViewValue = $this->Status->CurrentValue;
            $this->Status->ViewValue = FormatNumber($this->Status->ViewValue, $this->Status->formatPattern());
            $this->Status->ViewCustomAttributes = "";

            // Tanggal Terima
            $this->TanggalTerima->ViewValue = $this->TanggalTerima->CurrentValue;
            $this->TanggalTerima->ViewValue = FormatDateTime($this->TanggalTerima->ViewValue, $this->TanggalTerima->formatPattern());
            $this->TanggalTerima->ViewCustomAttributes = "";

            // Metode Pengiriman
            $this->MetodePengiriman->ViewValue = $this->MetodePengiriman->CurrentValue;
            $this->MetodePengiriman->ViewValue = FormatNumber($this->MetodePengiriman->ViewValue, $this->MetodePengiriman->formatPattern());
            $this->MetodePengiriman->ViewCustomAttributes = "";

            // Nama Ekspedisi/Messenger
            $this->NamaEkspedisiMessenger->ViewValue = $this->NamaEkspedisiMessenger->CurrentValue;
            $this->NamaEkspedisiMessenger->ViewCustomAttributes = "";

            // No AWB
            $this->NoAWB->ViewValue = $this->NoAWB->CurrentValue;
            $this->NoAWB->ViewCustomAttributes = "";

            // PIC
            $this->PIC->ViewValue = $this->PIC->CurrentValue;
            $this->PIC->ViewCustomAttributes = "";

            // Created Date
            $this->CreatedDate->ViewValue = $this->CreatedDate->CurrentValue;
            $this->CreatedDate->ViewValue = FormatDateTime($this->CreatedDate->ViewValue, $this->CreatedDate->formatPattern());
            $this->CreatedDate->ViewCustomAttributes = "";

            // Bukti Penerimaan
            $this->BuktiPenerimaan->ViewValue = $this->BuktiPenerimaan->CurrentValue;
            $this->BuktiPenerimaan->ViewCustomAttributes = "";

            // Nama Penerima
            $this->NamaPenerima->ViewValue = $this->NamaPenerima->CurrentValue;
            $this->NamaPenerima->ViewCustomAttributes = "";

            // Status SAP
            $this->StatusSAP->ViewValue = $this->StatusSAP->CurrentValue;
            $this->StatusSAP->ViewValue = FormatNumber($this->StatusSAP->ViewValue, $this->StatusSAP->formatPattern());
            $this->StatusSAP->ViewCustomAttributes = "";

            // No Dokumen
            $this->NoDokumen->LinkCustomAttributes = "";
            $this->NoDokumen->HrefValue = "";

            // No Paket
            $this->NoPaket->LinkCustomAttributes = "";
            $this->NoPaket->HrefValue = "";

            // Jenis Dokumen
            $this->JenisDokumen->LinkCustomAttributes = "";
            $this->JenisDokumen->HrefValue = "";

            // Penerima
            $this->Penerima->LinkCustomAttributes = "";
            $this->Penerima->HrefValue = "";

            // No HP Penerima
            $this->NoHPPenerima->LinkCustomAttributes = "";
            $this->NoHPPenerima->HrefValue = "";

            // Email Penerima
            $this->EmailPenerima->LinkCustomAttributes = "";
            $this->EmailPenerima->HrefValue = "";

            // Status
            $this->Status->LinkCustomAttributes = "";
            $this->Status->HrefValue = "";

            // Tanggal Terima
            $this->TanggalTerima->LinkCustomAttributes = "";
            $this->TanggalTerima->HrefValue = "";

            // Metode Pengiriman
            $this->MetodePengiriman->LinkCustomAttributes = "";
            $this->MetodePengiriman->HrefValue = "";

            // Nama Ekspedisi/Messenger
            $this->NamaEkspedisiMessenger->LinkCustomAttributes = "";
            $this->NamaEkspedisiMessenger->HrefValue = "";

            // No AWB
            $this->NoAWB->LinkCustomAttributes = "";
            $this->NoAWB->HrefValue = "";

            // PIC
            $this->PIC->LinkCustomAttributes = "";
            $this->PIC->HrefValue = "";

            // Bukti Penerimaan
            $this->BuktiPenerimaan->LinkCustomAttributes = "";
            $this->BuktiPenerimaan->HrefValue = "";

            // Nama Penerima
            $this->NamaPenerima->LinkCustomAttributes = "";
            $this->NamaPenerima->HrefValue = "";

            // Status SAP
            $this->StatusSAP->LinkCustomAttributes = "";
            $this->StatusSAP->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // No Dokumen
            $this->NoDokumen->setupEditAttributes();
            $this->NoDokumen->EditCustomAttributes = "";
            if (!$this->NoDokumen->Raw) {
                $this->NoDokumen->CurrentValue = HtmlDecode($this->NoDokumen->CurrentValue);
            }
            $this->NoDokumen->EditValue = HtmlEncode($this->NoDokumen->CurrentValue);
            $this->NoDokumen->PlaceHolder = RemoveHtml($this->NoDokumen->caption());

            // No Paket
            $this->NoPaket->setupEditAttributes();
            $this->NoPaket->EditCustomAttributes = "";
            if (!$this->NoPaket->Raw) {
                $this->NoPaket->CurrentValue = HtmlDecode($this->NoPaket->CurrentValue);
            }
            $this->NoPaket->EditValue = HtmlEncode($this->NoPaket->CurrentValue);
            $this->NoPaket->PlaceHolder = RemoveHtml($this->NoPaket->caption());

            // Jenis Dokumen
            $this->JenisDokumen->setupEditAttributes();
            $this->JenisDokumen->EditCustomAttributes = "";
            $this->JenisDokumen->EditValue = HtmlEncode($this->JenisDokumen->CurrentValue);
            $this->JenisDokumen->PlaceHolder = RemoveHtml($this->JenisDokumen->caption());
            if (strval($this->JenisDokumen->EditValue) != "" && is_numeric($this->JenisDokumen->EditValue)) {
                $this->JenisDokumen->EditValue = FormatNumber($this->JenisDokumen->EditValue, null);
            }

            // Penerima
            $this->Penerima->setupEditAttributes();
            $this->Penerima->EditCustomAttributes = "";
            if (!$this->Penerima->Raw) {
                $this->Penerima->CurrentValue = HtmlDecode($this->Penerima->CurrentValue);
            }
            $this->Penerima->EditValue = HtmlEncode($this->Penerima->CurrentValue);
            $this->Penerima->PlaceHolder = RemoveHtml($this->Penerima->caption());

            // No HP Penerima
            $this->NoHPPenerima->setupEditAttributes();
            $this->NoHPPenerima->EditCustomAttributes = "";
            if (!$this->NoHPPenerima->Raw) {
                $this->NoHPPenerima->CurrentValue = HtmlDecode($this->NoHPPenerima->CurrentValue);
            }
            $this->NoHPPenerima->EditValue = HtmlEncode($this->NoHPPenerima->CurrentValue);
            $this->NoHPPenerima->PlaceHolder = RemoveHtml($this->NoHPPenerima->caption());

            // Email Penerima
            $this->EmailPenerima->setupEditAttributes();
            $this->EmailPenerima->EditCustomAttributes = "";
            if (!$this->EmailPenerima->Raw) {
                $this->EmailPenerima->CurrentValue = HtmlDecode($this->EmailPenerima->CurrentValue);
            }
            $this->EmailPenerima->EditValue = HtmlEncode($this->EmailPenerima->CurrentValue);
            $this->EmailPenerima->PlaceHolder = RemoveHtml($this->EmailPenerima->caption());

            // Status
            $this->Status->setupEditAttributes();
            $this->Status->EditCustomAttributes = "";
            $this->Status->EditValue = HtmlEncode($this->Status->CurrentValue);
            $this->Status->PlaceHolder = RemoveHtml($this->Status->caption());
            if (strval($this->Status->EditValue) != "" && is_numeric($this->Status->EditValue)) {
                $this->Status->EditValue = FormatNumber($this->Status->EditValue, null);
            }

            // Tanggal Terima
            $this->TanggalTerima->setupEditAttributes();
            $this->TanggalTerima->EditCustomAttributes = "";
            $this->TanggalTerima->EditValue = HtmlEncode(FormatDateTime($this->TanggalTerima->CurrentValue, $this->TanggalTerima->formatPattern()));
            $this->TanggalTerima->PlaceHolder = RemoveHtml($this->TanggalTerima->caption());

            // Metode Pengiriman
            $this->MetodePengiriman->setupEditAttributes();
            $this->MetodePengiriman->EditCustomAttributes = "";
            $this->MetodePengiriman->EditValue = HtmlEncode($this->MetodePengiriman->CurrentValue);
            $this->MetodePengiriman->PlaceHolder = RemoveHtml($this->MetodePengiriman->caption());
            if (strval($this->MetodePengiriman->EditValue) != "" && is_numeric($this->MetodePengiriman->EditValue)) {
                $this->MetodePengiriman->EditValue = FormatNumber($this->MetodePengiriman->EditValue, null);
            }

            // Nama Ekspedisi/Messenger
            $this->NamaEkspedisiMessenger->setupEditAttributes();
            $this->NamaEkspedisiMessenger->EditCustomAttributes = "";
            if (!$this->NamaEkspedisiMessenger->Raw) {
                $this->NamaEkspedisiMessenger->CurrentValue = HtmlDecode($this->NamaEkspedisiMessenger->CurrentValue);
            }
            $this->NamaEkspedisiMessenger->EditValue = HtmlEncode($this->NamaEkspedisiMessenger->CurrentValue);
            $this->NamaEkspedisiMessenger->PlaceHolder = RemoveHtml($this->NamaEkspedisiMessenger->caption());

            // No AWB
            $this->NoAWB->setupEditAttributes();
            $this->NoAWB->EditCustomAttributes = "";
            if (!$this->NoAWB->Raw) {
                $this->NoAWB->CurrentValue = HtmlDecode($this->NoAWB->CurrentValue);
            }
            $this->NoAWB->EditValue = HtmlEncode($this->NoAWB->CurrentValue);
            $this->NoAWB->PlaceHolder = RemoveHtml($this->NoAWB->caption());

            // PIC
            $this->PIC->setupEditAttributes();
            $this->PIC->EditCustomAttributes = "";
            if (!$this->PIC->Raw) {
                $this->PIC->CurrentValue = HtmlDecode($this->PIC->CurrentValue);
            }
            $this->PIC->EditValue = HtmlEncode($this->PIC->CurrentValue);
            $this->PIC->PlaceHolder = RemoveHtml($this->PIC->caption());

            // Bukti Penerimaan
            $this->BuktiPenerimaan->setupEditAttributes();
            $this->BuktiPenerimaan->EditCustomAttributes = "";
            if (!$this->BuktiPenerimaan->Raw) {
                $this->BuktiPenerimaan->CurrentValue = HtmlDecode($this->BuktiPenerimaan->CurrentValue);
            }
            $this->BuktiPenerimaan->EditValue = HtmlEncode($this->BuktiPenerimaan->CurrentValue);
            $this->BuktiPenerimaan->PlaceHolder = RemoveHtml($this->BuktiPenerimaan->caption());

            // Nama Penerima
            $this->NamaPenerima->setupEditAttributes();
            $this->NamaPenerima->EditCustomAttributes = "";
            if (!$this->NamaPenerima->Raw) {
                $this->NamaPenerima->CurrentValue = HtmlDecode($this->NamaPenerima->CurrentValue);
            }
            $this->NamaPenerima->EditValue = HtmlEncode($this->NamaPenerima->CurrentValue);
            $this->NamaPenerima->PlaceHolder = RemoveHtml($this->NamaPenerima->caption());

            // Status SAP
            $this->StatusSAP->setupEditAttributes();
            $this->StatusSAP->EditCustomAttributes = "";
            $this->StatusSAP->EditValue = HtmlEncode($this->StatusSAP->CurrentValue);
            $this->StatusSAP->PlaceHolder = RemoveHtml($this->StatusSAP->caption());
            if (strval($this->StatusSAP->EditValue) != "" && is_numeric($this->StatusSAP->EditValue)) {
                $this->StatusSAP->EditValue = FormatNumber($this->StatusSAP->EditValue, null);
            }

            // Edit refer script

            // No Dokumen
            $this->NoDokumen->LinkCustomAttributes = "";
            $this->NoDokumen->HrefValue = "";

            // No Paket
            $this->NoPaket->LinkCustomAttributes = "";
            $this->NoPaket->HrefValue = "";

            // Jenis Dokumen
            $this->JenisDokumen->LinkCustomAttributes = "";
            $this->JenisDokumen->HrefValue = "";

            // Penerima
            $this->Penerima->LinkCustomAttributes = "";
            $this->Penerima->HrefValue = "";

            // No HP Penerima
            $this->NoHPPenerima->LinkCustomAttributes = "";
            $this->NoHPPenerima->HrefValue = "";

            // Email Penerima
            $this->EmailPenerima->LinkCustomAttributes = "";
            $this->EmailPenerima->HrefValue = "";

            // Status
            $this->Status->LinkCustomAttributes = "";
            $this->Status->HrefValue = "";

            // Tanggal Terima
            $this->TanggalTerima->LinkCustomAttributes = "";
            $this->TanggalTerima->HrefValue = "";

            // Metode Pengiriman
            $this->MetodePengiriman->LinkCustomAttributes = "";
            $this->MetodePengiriman->HrefValue = "";

            // Nama Ekspedisi/Messenger
            $this->NamaEkspedisiMessenger->LinkCustomAttributes = "";
            $this->NamaEkspedisiMessenger->HrefValue = "";

            // No AWB
            $this->NoAWB->LinkCustomAttributes = "";
            $this->NoAWB->HrefValue = "";

            // PIC
            $this->PIC->LinkCustomAttributes = "";
            $this->PIC->HrefValue = "";

            // Bukti Penerimaan
            $this->BuktiPenerimaan->LinkCustomAttributes = "";
            $this->BuktiPenerimaan->HrefValue = "";

            // Nama Penerima
            $this->NamaPenerima->LinkCustomAttributes = "";
            $this->NamaPenerima->HrefValue = "";

            // Status SAP
            $this->StatusSAP->LinkCustomAttributes = "";
            $this->StatusSAP->HrefValue = "";
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
        if ($this->NoDokumen->Required) {
            if (!$this->NoDokumen->IsDetailKey && EmptyValue($this->NoDokumen->FormValue)) {
                $this->NoDokumen->addErrorMessage(str_replace("%s", $this->NoDokumen->caption(), $this->NoDokumen->RequiredErrorMessage));
            }
        }
        if ($this->NoPaket->Required) {
            if (!$this->NoPaket->IsDetailKey && EmptyValue($this->NoPaket->FormValue)) {
                $this->NoPaket->addErrorMessage(str_replace("%s", $this->NoPaket->caption(), $this->NoPaket->RequiredErrorMessage));
            }
        }
        if ($this->JenisDokumen->Required) {
            if (!$this->JenisDokumen->IsDetailKey && EmptyValue($this->JenisDokumen->FormValue)) {
                $this->JenisDokumen->addErrorMessage(str_replace("%s", $this->JenisDokumen->caption(), $this->JenisDokumen->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->JenisDokumen->FormValue)) {
            $this->JenisDokumen->addErrorMessage($this->JenisDokumen->getErrorMessage(false));
        }
        if ($this->Penerima->Required) {
            if (!$this->Penerima->IsDetailKey && EmptyValue($this->Penerima->FormValue)) {
                $this->Penerima->addErrorMessage(str_replace("%s", $this->Penerima->caption(), $this->Penerima->RequiredErrorMessage));
            }
        }
        if ($this->NoHPPenerima->Required) {
            if (!$this->NoHPPenerima->IsDetailKey && EmptyValue($this->NoHPPenerima->FormValue)) {
                $this->NoHPPenerima->addErrorMessage(str_replace("%s", $this->NoHPPenerima->caption(), $this->NoHPPenerima->RequiredErrorMessage));
            }
        }
        if ($this->EmailPenerima->Required) {
            if (!$this->EmailPenerima->IsDetailKey && EmptyValue($this->EmailPenerima->FormValue)) {
                $this->EmailPenerima->addErrorMessage(str_replace("%s", $this->EmailPenerima->caption(), $this->EmailPenerima->RequiredErrorMessage));
            }
        }
        if ($this->Status->Required) {
            if (!$this->Status->IsDetailKey && EmptyValue($this->Status->FormValue)) {
                $this->Status->addErrorMessage(str_replace("%s", $this->Status->caption(), $this->Status->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->Status->FormValue)) {
            $this->Status->addErrorMessage($this->Status->getErrorMessage(false));
        }
        if ($this->TanggalTerima->Required) {
            if (!$this->TanggalTerima->IsDetailKey && EmptyValue($this->TanggalTerima->FormValue)) {
                $this->TanggalTerima->addErrorMessage(str_replace("%s", $this->TanggalTerima->caption(), $this->TanggalTerima->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->TanggalTerima->FormValue, $this->TanggalTerima->formatPattern())) {
            $this->TanggalTerima->addErrorMessage($this->TanggalTerima->getErrorMessage(false));
        }
        if ($this->MetodePengiriman->Required) {
            if (!$this->MetodePengiriman->IsDetailKey && EmptyValue($this->MetodePengiriman->FormValue)) {
                $this->MetodePengiriman->addErrorMessage(str_replace("%s", $this->MetodePengiriman->caption(), $this->MetodePengiriman->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->MetodePengiriman->FormValue)) {
            $this->MetodePengiriman->addErrorMessage($this->MetodePengiriman->getErrorMessage(false));
        }
        if ($this->NamaEkspedisiMessenger->Required) {
            if (!$this->NamaEkspedisiMessenger->IsDetailKey && EmptyValue($this->NamaEkspedisiMessenger->FormValue)) {
                $this->NamaEkspedisiMessenger->addErrorMessage(str_replace("%s", $this->NamaEkspedisiMessenger->caption(), $this->NamaEkspedisiMessenger->RequiredErrorMessage));
            }
        }
        if ($this->NoAWB->Required) {
            if (!$this->NoAWB->IsDetailKey && EmptyValue($this->NoAWB->FormValue)) {
                $this->NoAWB->addErrorMessage(str_replace("%s", $this->NoAWB->caption(), $this->NoAWB->RequiredErrorMessage));
            }
        }
        if ($this->PIC->Required) {
            if (!$this->PIC->IsDetailKey && EmptyValue($this->PIC->FormValue)) {
                $this->PIC->addErrorMessage(str_replace("%s", $this->PIC->caption(), $this->PIC->RequiredErrorMessage));
            }
        }
        if ($this->BuktiPenerimaan->Required) {
            if (!$this->BuktiPenerimaan->IsDetailKey && EmptyValue($this->BuktiPenerimaan->FormValue)) {
                $this->BuktiPenerimaan->addErrorMessage(str_replace("%s", $this->BuktiPenerimaan->caption(), $this->BuktiPenerimaan->RequiredErrorMessage));
            }
        }
        if ($this->NamaPenerima->Required) {
            if (!$this->NamaPenerima->IsDetailKey && EmptyValue($this->NamaPenerima->FormValue)) {
                $this->NamaPenerima->addErrorMessage(str_replace("%s", $this->NamaPenerima->caption(), $this->NamaPenerima->RequiredErrorMessage));
            }
        }
        if ($this->StatusSAP->Required) {
            if (!$this->StatusSAP->IsDetailKey && EmptyValue($this->StatusSAP->FormValue)) {
                $this->StatusSAP->addErrorMessage(str_replace("%s", $this->StatusSAP->caption(), $this->StatusSAP->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->StatusSAP->FormValue)) {
            $this->StatusSAP->addErrorMessage($this->StatusSAP->getErrorMessage(false));
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

            // No Dokumen
            $this->NoDokumen->setDbValueDef($rsnew, $this->NoDokumen->CurrentValue, null, $this->NoDokumen->ReadOnly);

            // No Paket
            $this->NoPaket->setDbValueDef($rsnew, $this->NoPaket->CurrentValue, null, $this->NoPaket->ReadOnly);

            // Jenis Dokumen
            $this->JenisDokumen->setDbValueDef($rsnew, $this->JenisDokumen->CurrentValue, 0, $this->JenisDokumen->ReadOnly);

            // Penerima
            $this->Penerima->setDbValueDef($rsnew, $this->Penerima->CurrentValue, "", $this->Penerima->ReadOnly);

            // No HP Penerima
            $this->NoHPPenerima->setDbValueDef($rsnew, $this->NoHPPenerima->CurrentValue, "", $this->NoHPPenerima->ReadOnly);

            // Email Penerima
            $this->EmailPenerima->setDbValueDef($rsnew, $this->EmailPenerima->CurrentValue, null, $this->EmailPenerima->ReadOnly);

            // Status
            $this->Status->setDbValueDef($rsnew, $this->Status->CurrentValue, null, $this->Status->ReadOnly);

            // Tanggal Terima
            $this->TanggalTerima->setDbValueDef($rsnew, UnFormatDateTime($this->TanggalTerima->CurrentValue, $this->TanggalTerima->formatPattern()), null, $this->TanggalTerima->ReadOnly);

            // Metode Pengiriman
            $this->MetodePengiriman->setDbValueDef($rsnew, $this->MetodePengiriman->CurrentValue, null, $this->MetodePengiriman->ReadOnly);

            // Nama Ekspedisi/Messenger
            $this->NamaEkspedisiMessenger->setDbValueDef($rsnew, $this->NamaEkspedisiMessenger->CurrentValue, null, $this->NamaEkspedisiMessenger->ReadOnly);

            // No AWB
            $this->NoAWB->setDbValueDef($rsnew, $this->NoAWB->CurrentValue, null, $this->NoAWB->ReadOnly);

            // PIC
            $this->PIC->setDbValueDef($rsnew, $this->PIC->CurrentValue, "", $this->PIC->ReadOnly);

            // Bukti Penerimaan
            $this->BuktiPenerimaan->setDbValueDef($rsnew, $this->BuktiPenerimaan->CurrentValue, null, $this->BuktiPenerimaan->ReadOnly);

            // Nama Penerima
            $this->NamaPenerima->setDbValueDef($rsnew, $this->NamaPenerima->CurrentValue, null, $this->NamaPenerima->ReadOnly);

            // Status SAP
            $this->StatusSAP->setDbValueDef($rsnew, $this->StatusSAP->CurrentValue, null, $this->StatusSAP->ReadOnly);

            // Call Row Updating event
            $updateRow = $this->rowUpdating($rsold, $rsnew);
            if ($updateRow) {
                if (count($rsnew) > 0) {
                    $editRow = $this->update($rsnew, "", $rsold);
                } else {
                    $editRow = true; // No field to update
                }
                if ($editRow) {
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
        }

        // Write JSON for API request
        if (IsApi() && $editRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $editRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("vpenerimaanpaketkeluarshownamauserlist"), "", $this->TableVar, true);
        $pageId = "edit";
        $Breadcrumb->add("edit", $pageId, $url);
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
            if ($startRec !== null && is_numeric($startRec)) { // Check for "start" parameter
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
}
