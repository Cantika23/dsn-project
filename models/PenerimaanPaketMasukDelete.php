<?php

namespace Mitral2022\DSN2;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class PenerimaanPaketMasukDelete extends PenerimaanPaketMasuk
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'penerimaan_paket_masuk';

    // Page object name
    public $PageObjName = "PenerimaanPaketMasukDelete";

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
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $TotalRecords = 0;
    public $RecordCount;
    public $RecKeys = [];
    public $StartRowCount = 1;
    public $RowCount = 0;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param("layout", true));
        $this->CurrentAction = Param("action"); // Set up current action
        $this->id->Visible = false;
        $this->no_dokumen_no_paket->setVisibility();
        $this->no_dokumen->Visible = false;
        $this->no_paket->Visible = false;
        $this->jenis_dokumen->setVisibility();
        $this->nama_pengirim->setVisibility();
        $this->keterangan->Visible = false;
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

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Load key parameters
        $this->RecKeys = $this->getRecordKeys(); // Load record keys
        $filter = $this->getFilterFromRecordKeys();
        if ($filter == "") {
            $this->terminate("penerimaanpaketmasuklist"); // Prevent SQL injection, return to list
            return;
        }

        // Set up filter (WHERE Clause)
        $this->CurrentFilter = $filter;

        // Check if valid User ID
        $conn = $this->getConnection();
        $sql = $this->getSql($this->CurrentFilter);
        $rows = $conn->fetchAllAssociative($sql);
        $res = true;
        foreach ($rows as $row) {
            $this->loadRowValues($row);
            if (!$this->showOptionLink("delete")) {
                $userIdMsg = $Language->phrase("NoDeletePermission");
                $this->setFailureMessage($userIdMsg);
                $res = false;
                break;
            }
        }
        if (!$res) {
            $this->terminate("penerimaanpaketmasuklist"); // Return to list
            return;
        }

        // Get action
        if (IsApi()) {
            $this->CurrentAction = "delete"; // Delete record directly
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action");
        } elseif (Get("action") == "1") {
            $this->CurrentAction = "delete"; // Delete record directly
        } else {
            $this->CurrentAction = "show"; // Display record
        }
        if ($this->isDelete()) {
            $this->SendEmail = true; // Send email on delete success
            if ($this->deleteRows()) { // Delete rows
                if ($this->getSuccessMessage() == "") {
                    $this->setSuccessMessage($Language->phrase("DeleteSuccess")); // Set up success message
                }
                if (IsApi()) {
                    $this->terminate(true);
                    return;
                } else {
                    $this->terminate($this->getReturnUrl()); // Return to caller
                    return;
                }
            } else { // Delete failed
                if (IsApi()) {
                    $this->terminate();
                    return;
                }
                $this->CurrentAction = "show"; // Display record
            }
        }
        if ($this->isShow()) { // Load records for display
            if ($this->Recordset = $this->loadRecordset()) {
                $this->TotalRecords = $this->Recordset->recordCount(); // Get record count
            }
            if ($this->TotalRecords <= 0) { // No record found, exit
                if ($this->Recordset) {
                    $this->Recordset->close();
                }
                $this->terminate("penerimaanpaketmasuklist"); // Return to list
                return;
            }
        }

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
        $row = [];
        $row['id'] = null;
        $row['no_dokumen_no_paket'] = null;
        $row['no_dokumen'] = null;
        $row['no_paket'] = null;
        $row['jenis_dokumen'] = null;
        $row['nama_pengirim'] = null;
        $row['keterangan'] = null;
        $row['nama_penerima'] = null;
        $row['email_penerima'] = null;
        $row['no_hp_penerima'] = null;
        $row['status'] = null;
        $row['tanggal_terima'] = null;
        $row['bukti_penerimaan'] = null;
        $row['diterima_oleh'] = null;
        $row['id_user'] = null;
        $row['created_date'] = null;
        $row['update_by'] = null;
        return $row;
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
        $this->id->CellCssStyle = "white-space: nowrap;";

        // no_dokumen_no_paket

        // no_dokumen
        $this->no_dokumen->CellCssStyle = "white-space: nowrap;";

        // no_paket
        $this->no_paket->CellCssStyle = "white-space: nowrap;";

        // jenis_dokumen

        // nama_pengirim

        // keterangan
        $this->keterangan->CellCssStyle = "white-space: nowrap;";

        // nama_penerima

        // email_penerima

        // no_hp_penerima

        // status

        // tanggal_terima

        // bukti_penerimaan

        // diterima_oleh

        // id_user
        $this->id_user->CellCssStyle = "white-space: nowrap;";

        // created_date

        // update_by

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // no_dokumen_no_paket
            $this->no_dokumen_no_paket->ViewValue = $this->no_dokumen_no_paket->CurrentValue;
            $this->no_dokumen_no_paket->ViewCustomAttributes = "";

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

            // no_dokumen_no_paket
            $this->no_dokumen_no_paket->LinkCustomAttributes = "";
            $this->no_dokumen_no_paket->HrefValue = "";
            $this->no_dokumen_no_paket->TooltipValue = "";

            // jenis_dokumen
            $this->jenis_dokumen->LinkCustomAttributes = "";
            $this->jenis_dokumen->HrefValue = "";
            $this->jenis_dokumen->TooltipValue = "";

            // nama_pengirim
            $this->nama_pengirim->LinkCustomAttributes = "";
            $this->nama_pengirim->HrefValue = "";
            $this->nama_pengirim->TooltipValue = "";

            // nama_penerima
            $this->nama_penerima->LinkCustomAttributes = "";
            $this->nama_penerima->HrefValue = "";
            $this->nama_penerima->TooltipValue = "";

            // email_penerima
            $this->email_penerima->LinkCustomAttributes = "";
            $this->email_penerima->HrefValue = "";
            $this->email_penerima->TooltipValue = "";

            // no_hp_penerima
            $this->no_hp_penerima->LinkCustomAttributes = "";
            $this->no_hp_penerima->HrefValue = "";
            $this->no_hp_penerima->TooltipValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";
            $this->status->TooltipValue = "";

            // tanggal_terima
            $this->tanggal_terima->LinkCustomAttributes = "";
            $this->tanggal_terima->HrefValue = "";
            $this->tanggal_terima->TooltipValue = "";

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
                $this->bukti_penerimaan->LinkAttrs["data-rel"] = "penerimaan_paket_masuk_x_bukti_penerimaan";
                $this->bukti_penerimaan->LinkAttrs->appendClass("ew-lightbox");
            }

            // diterima_oleh
            $this->diterima_oleh->LinkCustomAttributes = "";
            $this->diterima_oleh->HrefValue = "";
            $this->diterima_oleh->TooltipValue = "";

            // id_user
            $this->id_user->LinkCustomAttributes = "";
            $this->id_user->HrefValue = "";
            $this->id_user->TooltipValue = "";

            // created_date
            $this->created_date->LinkCustomAttributes = "";
            $this->created_date->HrefValue = "";
            $this->created_date->TooltipValue = "";

            // update_by
            $this->update_by->LinkCustomAttributes = "";
            $this->update_by->HrefValue = "";
            $this->update_by->TooltipValue = "";
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Delete records based on current filter
    protected function deleteRows()
    {
        global $Language, $Security;
        if (!$Security->canDelete()) {
            $this->setFailureMessage($Language->phrase("NoDeletePermission")); // No delete permission
            return false;
        }
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $rows = $conn->fetchAllAssociative($sql);
        if (count($rows) == 0) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
            return false;
        }
        if ($this->UseTransaction) {
            $conn->beginTransaction();
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
        if ($deleteRows) {
            if ($this->UseTransaction) { // Commit transaction
                $conn->commit();
            }

            // Set warning message if delete some records failed
            if (count($failKeys) > 0) {
                $this->setWarningMessage(str_replace("%k", explode(", ", $failKeys), $Language->phrase("DeleteSomeRecordsFailed")));
            }
        } else {
            if ($this->UseTransaction) { // Rollback transaction
                $conn->rollback();
            }
        }

        // Write JSON for API request
        if (IsApi() && $deleteRows) {
            $row = $this->getRecordsFromRecordset($rsold);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $deleteRows;
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
        $pageId = "delete";
        $Breadcrumb->add("delete", $pageId, $url);
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
}
