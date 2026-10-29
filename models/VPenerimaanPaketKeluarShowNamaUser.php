<?php

namespace Mitral2022\DSN2;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for v_penerimaan_paket_keluar_show_nama_user
 */
class VPenerimaanPaketKeluarShowNamaUser extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Export
    public $ExportDoc;

    // Fields
    public $no_dokumen_no_paket;
    public $no_dokumen;
    public $no_paket;
    public $jenis_dokumen;
    public $tujuan_penerima;
    public $no_hp_penerima;
    public $email_penerima;
    public $id;
    public $status;
    public $tanggal_terima;
    public $jenis_pengirim;
    public $nama_kurir;
    public $no_awb;
    public $employee_name;
    public $id_user;
    public $created_date;
    public $bukti_penerimaan;
    public $nama_penerima;
    public $status_sap;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'v_penerimaan_paket_keluar_show_nama_user';
        $this->TableName = 'v_penerimaan_paket_keluar_show_nama_user';
        $this->TableType = 'VIEW';

        // Update Table
        $this->UpdateTable = "`v_penerimaan_paket_keluar_show_nama_user`";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
        $this->ExportWordVersion = 12; // Word version (PHPWord only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordPageSize = "A4"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // no_dokumen_no_paket
        $this->no_dokumen_no_paket = new DbField(
            'v_penerimaan_paket_keluar_show_nama_user',
            'v_penerimaan_paket_keluar_show_nama_user',
            'x_no_dokumen_no_paket',
            'no_dokumen_no_paket',
            'CONCAT(no_dokumen, \', \',no_paket)',
            'CONCAT(no_dokumen, \', \',no_paket)',
            201,
            307,
            -1,
            false,
            'CONCAT(no_dokumen, \', \',no_paket)',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->no_dokumen_no_paket->InputTextType = "text";
        $this->no_dokumen_no_paket->IsCustom = true; // Custom field
        $this->no_dokumen_no_paket->Sortable = false; // Allow sort
        $this->no_dokumen_no_paket->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->no_dokumen_no_paket->Lookup = new Lookup('no_dokumen_no_paket', 'v_penerimaan_paket_keluar_show_nama_user', true, 'no_dokumen_no_paket', ["no_dokumen_no_paket", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->no_dokumen_no_paket->Lookup = new Lookup('no_dokumen_no_paket', 'v_penerimaan_paket_keluar_show_nama_user', true, 'no_dokumen_no_paket', ["no_dokumen_no_paket", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['no_dokumen_no_paket'] = &$this->no_dokumen_no_paket;

        // no_dokumen
        $this->no_dokumen = new DbField(
            'v_penerimaan_paket_keluar_show_nama_user',
            'v_penerimaan_paket_keluar_show_nama_user',
            'x_no_dokumen',
            'no_dokumen',
            '`no_dokumen`',
            '`no_dokumen`',
            200,
            255,
            -1,
            false,
            '`no_dokumen`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->no_dokumen->InputTextType = "text";
        $this->no_dokumen->Sortable = false; // Allow sort
        $this->Fields['no_dokumen'] = &$this->no_dokumen;

        // no_paket
        $this->no_paket = new DbField(
            'v_penerimaan_paket_keluar_show_nama_user',
            'v_penerimaan_paket_keluar_show_nama_user',
            'x_no_paket',
            'no_paket',
            '`no_paket`',
            '`no_paket`',
            200,
            50,
            -1,
            false,
            '`no_paket`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->no_paket->InputTextType = "text";
        $this->no_paket->Sortable = false; // Allow sort
        $this->Fields['no_paket'] = &$this->no_paket;

        // jenis_dokumen
        $this->jenis_dokumen = new DbField(
            'v_penerimaan_paket_keluar_show_nama_user',
            'v_penerimaan_paket_keluar_show_nama_user',
            'x_jenis_dokumen',
            'jenis_dokumen',
            '`jenis_dokumen`',
            '`jenis_dokumen`',
            3,
            11,
            -1,
            false,
            '`jenis_dokumen`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->jenis_dokumen->InputTextType = "text";
        $this->jenis_dokumen->Nullable = false; // NOT NULL field
        $this->jenis_dokumen->Required = true; // Required field
        $this->jenis_dokumen->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->jenis_dokumen->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->jenis_dokumen->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->jenis_dokumen->Lookup = new Lookup('jenis_dokumen', 'm_jenis_dokumen', true, 'id', ["jenis_dokumen", "", "", ""], [], [], [], [], [], [], '', '', "`jenis_dokumen`");
                break;
            default:
                $this->jenis_dokumen->Lookup = new Lookup('jenis_dokumen', 'm_jenis_dokumen', true, 'id', ["jenis_dokumen", "", "", ""], [], [], [], [], [], [], '', '', "`jenis_dokumen`");
                break;
        }
        $this->jenis_dokumen->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['jenis_dokumen'] = &$this->jenis_dokumen;

        // tujuan_penerima
        $this->tujuan_penerima = new DbField(
            'v_penerimaan_paket_keluar_show_nama_user',
            'v_penerimaan_paket_keluar_show_nama_user',
            'x_tujuan_penerima',
            'tujuan_penerima',
            '`tujuan_penerima`',
            '`tujuan_penerima`',
            200,
            255,
            -1,
            false,
            '`tujuan_penerima`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->tujuan_penerima->InputTextType = "text";
        $this->tujuan_penerima->Nullable = false; // NOT NULL field
        $this->tujuan_penerima->Required = true; // Required field
        $this->tujuan_penerima->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->tujuan_penerima->Lookup = new Lookup('tujuan_penerima', 'v_penerimaan_paket_keluar_show_nama_user', true, 'tujuan_penerima', ["tujuan_penerima", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->tujuan_penerima->Lookup = new Lookup('tujuan_penerima', 'v_penerimaan_paket_keluar_show_nama_user', true, 'tujuan_penerima', ["tujuan_penerima", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['tujuan_penerima'] = &$this->tujuan_penerima;

        // no_hp_penerima
        $this->no_hp_penerima = new DbField(
            'v_penerimaan_paket_keluar_show_nama_user',
            'v_penerimaan_paket_keluar_show_nama_user',
            'x_no_hp_penerima',
            'no_hp_penerima',
            '`no_hp_penerima`',
            '`no_hp_penerima`',
            200,
            20,
            -1,
            false,
            '`no_hp_penerima`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->no_hp_penerima->InputTextType = "text";
        $this->no_hp_penerima->Nullable = false; // NOT NULL field
        $this->no_hp_penerima->Required = true; // Required field
        $this->no_hp_penerima->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->no_hp_penerima->Lookup = new Lookup('no_hp_penerima', 'v_penerimaan_paket_keluar_show_nama_user', true, 'no_hp_penerima', ["no_hp_penerima", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->no_hp_penerima->Lookup = new Lookup('no_hp_penerima', 'v_penerimaan_paket_keluar_show_nama_user', true, 'no_hp_penerima', ["no_hp_penerima", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['no_hp_penerima'] = &$this->no_hp_penerima;

        // email_penerima
        $this->email_penerima = new DbField(
            'v_penerimaan_paket_keluar_show_nama_user',
            'v_penerimaan_paket_keluar_show_nama_user',
            'x_email_penerima',
            'email_penerima',
            '`email_penerima`',
            '`email_penerima`',
            200,
            50,
            -1,
            false,
            '`email_penerima`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->email_penerima->InputTextType = "text";
        $this->email_penerima->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->email_penerima->Lookup = new Lookup('email_penerima', 'v_penerimaan_paket_keluar_show_nama_user', true, 'email_penerima', ["email_penerima", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->email_penerima->Lookup = new Lookup('email_penerima', 'v_penerimaan_paket_keluar_show_nama_user', true, 'email_penerima', ["email_penerima", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['email_penerima'] = &$this->email_penerima;

        // id
        $this->id = new DbField(
            'v_penerimaan_paket_keluar_show_nama_user',
            'v_penerimaan_paket_keluar_show_nama_user',
            'x_id',
            'id',
            '`id`',
            '`id`',
            3,
            11,
            -1,
            false,
            '`id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->id->InputTextType = "text";
        $this->id->Nullable = false; // NOT NULL field
        $this->id->Sortable = false; // Allow sort
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['id'] = &$this->id;

        // status
        $this->status = new DbField(
            'v_penerimaan_paket_keluar_show_nama_user',
            'v_penerimaan_paket_keluar_show_nama_user',
            'x_status',
            'status',
            '`status`',
            '`status`',
            3,
            11,
            -1,
            false,
            '`status`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->status->InputTextType = "text";
        $this->status->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->status->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->status->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->status->Lookup = new Lookup('status', 'm_status_penerimaan_keluar', true, 'id', ["status", "", "", ""], [], [], [], [], [], [], '', '', "`status`");
                break;
            default:
                $this->status->Lookup = new Lookup('status', 'm_status_penerimaan_keluar', true, 'id', ["status", "", "", ""], [], [], [], [], [], [], '', '', "`status`");
                break;
        }
        $this->status->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['status'] = &$this->status;

        // tanggal_terima
        $this->tanggal_terima = new DbField(
            'v_penerimaan_paket_keluar_show_nama_user',
            'v_penerimaan_paket_keluar_show_nama_user',
            'x_tanggal_terima',
            'tanggal_terima',
            '`tanggal_terima`',
            CastDateFieldForLike("`tanggal_terima`", 0, "DB"),
            135,
            19,
            0,
            false,
            '`tanggal_terima`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->tanggal_terima->InputTextType = "text";
        $this->tanggal_terima->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->tanggal_terima->Lookup = new Lookup('tanggal_terima', 'v_penerimaan_paket_keluar_show_nama_user', true, 'tanggal_terima', ["tanggal_terima", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->tanggal_terima->Lookup = new Lookup('tanggal_terima', 'v_penerimaan_paket_keluar_show_nama_user', true, 'tanggal_terima', ["tanggal_terima", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->tanggal_terima->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['tanggal_terima'] = &$this->tanggal_terima;

        // jenis_pengirim
        $this->jenis_pengirim = new DbField(
            'v_penerimaan_paket_keluar_show_nama_user',
            'v_penerimaan_paket_keluar_show_nama_user',
            'x_jenis_pengirim',
            'jenis_pengirim',
            '`jenis_pengirim`',
            '`jenis_pengirim`',
            3,
            11,
            -1,
            false,
            '`jenis_pengirim`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->jenis_pengirim->InputTextType = "text";
        $this->jenis_pengirim->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->jenis_pengirim->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->jenis_pengirim->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->jenis_pengirim->Lookup = new Lookup('jenis_pengirim', 'm_jenis_pengirim', true, 'id', ["jenis_pengirim", "", "", ""], [], [], [], [], [], [], '', '', "`jenis_pengirim`");
                break;
            default:
                $this->jenis_pengirim->Lookup = new Lookup('jenis_pengirim', 'm_jenis_pengirim', true, 'id', ["jenis_pengirim", "", "", ""], [], [], [], [], [], [], '', '', "`jenis_pengirim`");
                break;
        }
        $this->jenis_pengirim->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['jenis_pengirim'] = &$this->jenis_pengirim;

        // nama_kurir
        $this->nama_kurir = new DbField(
            'v_penerimaan_paket_keluar_show_nama_user',
            'v_penerimaan_paket_keluar_show_nama_user',
            'x_nama_kurir',
            'nama_kurir',
            '`nama_kurir`',
            '`nama_kurir`',
            200,
            255,
            -1,
            false,
            '`nama_kurir`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->nama_kurir->InputTextType = "text";
        $this->nama_kurir->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->nama_kurir->Lookup = new Lookup('nama_kurir', 'v_penerimaan_paket_keluar_show_nama_user', true, 'nama_kurir', ["nama_kurir", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->nama_kurir->Lookup = new Lookup('nama_kurir', 'v_penerimaan_paket_keluar_show_nama_user', true, 'nama_kurir', ["nama_kurir", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['nama_kurir'] = &$this->nama_kurir;

        // no_awb
        $this->no_awb = new DbField(
            'v_penerimaan_paket_keluar_show_nama_user',
            'v_penerimaan_paket_keluar_show_nama_user',
            'x_no_awb',
            'no_awb',
            '`no_awb`',
            '`no_awb`',
            200,
            100,
            -1,
            false,
            '`no_awb`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->no_awb->InputTextType = "text";
        $this->no_awb->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->no_awb->Lookup = new Lookup('no_awb', 'v_penerimaan_paket_keluar_show_nama_user', true, 'no_awb', ["no_awb", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->no_awb->Lookup = new Lookup('no_awb', 'v_penerimaan_paket_keluar_show_nama_user', true, 'no_awb', ["no_awb", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['no_awb'] = &$this->no_awb;

        // employee_name
        $this->employee_name = new DbField(
            'v_penerimaan_paket_keluar_show_nama_user',
            'v_penerimaan_paket_keluar_show_nama_user',
            'x_employee_name',
            'employee_name',
            '`employee_name`',
            '`employee_name`',
            200,
            255,
            -1,
            false,
            '`employee_name`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->employee_name->InputTextType = "text";
        $this->employee_name->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->employee_name->Lookup = new Lookup('employee_name', 'v_penerimaan_paket_keluar_show_nama_user', true, 'employee_name', ["employee_name", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->employee_name->Lookup = new Lookup('employee_name', 'v_penerimaan_paket_keluar_show_nama_user', true, 'employee_name', ["employee_name", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['employee_name'] = &$this->employee_name;

        // id_user
        $this->id_user = new DbField(
            'v_penerimaan_paket_keluar_show_nama_user',
            'v_penerimaan_paket_keluar_show_nama_user',
            'x_id_user',
            'id_user',
            '`id_user`',
            '`id_user`',
            3,
            11,
            -1,
            false,
            '`id_user`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->id_user->InputTextType = "text";
        $this->id_user->Nullable = false; // NOT NULL field
        $this->id_user->Sortable = false; // Allow sort
        $this->id_user->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['id_user'] = &$this->id_user;

        // created_date
        $this->created_date = new DbField(
            'v_penerimaan_paket_keluar_show_nama_user',
            'v_penerimaan_paket_keluar_show_nama_user',
            'x_created_date',
            'created_date',
            '`created_date`',
            CastDateFieldForLike("`created_date`", 0, "DB"),
            133,
            10,
            0,
            false,
            '`created_date`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->created_date->InputTextType = "text";
        $this->created_date->Nullable = false; // NOT NULL field
        $this->created_date->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->created_date->Lookup = new Lookup('created_date', 'v_penerimaan_paket_keluar_show_nama_user', true, 'created_date', ["created_date", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->created_date->Lookup = new Lookup('created_date', 'v_penerimaan_paket_keluar_show_nama_user', true, 'created_date', ["created_date", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->created_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['created_date'] = &$this->created_date;

        // bukti_penerimaan
        $this->bukti_penerimaan = new DbField(
            'v_penerimaan_paket_keluar_show_nama_user',
            'v_penerimaan_paket_keluar_show_nama_user',
            'x_bukti_penerimaan',
            'bukti_penerimaan',
            '`bukti_penerimaan`',
            '`bukti_penerimaan`',
            200,
            255,
            -1,
            true,
            '`bukti_penerimaan`',
            false,
            false,
            false,
            'IMAGE',
            'FILE'
        );
        $this->bukti_penerimaan->InputTextType = "text";
        $this->bukti_penerimaan->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->bukti_penerimaan->Lookup = new Lookup('bukti_penerimaan', 'v_penerimaan_paket_keluar_show_nama_user', true, 'bukti_penerimaan', ["bukti_penerimaan", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->bukti_penerimaan->Lookup = new Lookup('bukti_penerimaan', 'v_penerimaan_paket_keluar_show_nama_user', true, 'bukti_penerimaan', ["bukti_penerimaan", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['bukti_penerimaan'] = &$this->bukti_penerimaan;

        // nama_penerima
        $this->nama_penerima = new DbField(
            'v_penerimaan_paket_keluar_show_nama_user',
            'v_penerimaan_paket_keluar_show_nama_user',
            'x_nama_penerima',
            'nama_penerima',
            '`nama_penerima`',
            '`nama_penerima`',
            200,
            255,
            -1,
            false,
            '`nama_penerima`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->nama_penerima->InputTextType = "text";
        $this->nama_penerima->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->nama_penerima->Lookup = new Lookup('nama_penerima', 'v_penerimaan_paket_keluar_show_nama_user', true, 'nama_penerima', ["nama_penerima", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->nama_penerima->Lookup = new Lookup('nama_penerima', 'v_penerimaan_paket_keluar_show_nama_user', true, 'nama_penerima', ["nama_penerima", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['nama_penerima'] = &$this->nama_penerima;

        // status_sap
        $this->status_sap = new DbField(
            'v_penerimaan_paket_keluar_show_nama_user',
            'v_penerimaan_paket_keluar_show_nama_user',
            'x_status_sap',
            'status_sap',
            '`status_sap`',
            '`status_sap`',
            3,
            11,
            -1,
            false,
            '`status_sap`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->status_sap->InputTextType = "text";
        $this->status_sap->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->status_sap->Lookup = new Lookup('status_sap', 'v_penerimaan_paket_keluar_show_nama_user', true, 'status_sap', ["status_sap", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->status_sap->Lookup = new Lookup('status_sap', 'v_penerimaan_paket_keluar_show_nama_user', true, 'status_sap', ["status_sap", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->status_sap->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['status_sap'] = &$this->status_sap;

        // Add Doctrine Cache
        $this->Cache = new ArrayCache();
        $this->CacheProfile = new \Doctrine\DBAL\Cache\QueryCacheProfile(0, $this->TableVar);
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Multiple column sort
    public function updateSort(&$fld, $ctrl)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $fld->setSort($curSort);
            $lastOrderBy = in_array($lastSort, ["ASC", "DESC"]) ? $sortField . " " . $lastSort : "";
            $curOrderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            if ($ctrl) {
                $orderBy = $this->getSessionOrderBy();
                $arOrderBy = !empty($orderBy) ? explode(", ", $orderBy) : [];
                if ($lastOrderBy != "" && in_array($lastOrderBy, $arOrderBy)) {
                    foreach ($arOrderBy as $key => $val) {
                        if ($val == $lastOrderBy) {
                            if ($curOrderBy == "") {
                                unset($arOrderBy[$key]);
                            } else {
                                $arOrderBy[$key] = $curOrderBy;
                            }
                        }
                    }
                } elseif ($curOrderBy != "") {
                    $arOrderBy[] = $curOrderBy;
                }
                $orderBy = implode(", ", $arOrderBy);
                $this->setSessionOrderBy($orderBy); // Save to Session
            } else {
                $this->setSessionOrderBy($curOrderBy); // Save to Session
            }
        } else {
            if (!$ctrl) {
                $fld->setSort("");
            }
        }
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`v_penerimaan_paket_keluar_show_nama_user`";
    }

    public function sqlFrom() // For backward compatibility
    {
        return $this->getSqlFrom();
    }

    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*, CONCAT(no_dokumen, ', ',no_paket) AS `no_dokumen_no_paket`");
    }

    public function sqlSelect() // For backward compatibility
    {
        return $this->getSqlSelect();
    }

    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    public function getSqlWhere() // Where
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    public function sqlWhere() // For backward compatibility
    {
        return $this->getSqlWhere();
    }

    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    public function getSqlGroupBy() // Group By
    {
        return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
    }

    public function sqlGroupBy() // For backward compatibility
    {
        return $this->getSqlGroupBy();
    }

    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    public function sqlHaving() // For backward compatibility
    {
        return $this->getSqlHaving();
    }

    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    public function getSqlOrderBy() // Order By
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : $this->DefaultSort;
    }

    public function sqlOrderBy() // For backward compatibility
    {
        return $this->getSqlOrderBy();
    }

    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter, $id = "")
    {
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return (($allow & 1) == 1);
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return (($allow & 4) == 4);
            case "delete":
                return (($allow & 2) == 2);
            case "view":
                return (($allow & 32) == 32);
            case "search":
                return (($allow & 64) == 64);
            case "lookup":
                return (($allow & 256) == 256);
            default:
                return (($allow & 8) == 8);
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $rs = null;
        if ($sql instanceof QueryBuilder) { // Query builder
            $sqlwrk = clone $sql;
            $sqlwrk = $sqlwrk->resetQueryPart("orderBy")->getSQL();
        } else {
            $sqlwrk = $sql;
        }
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            ($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
            preg_match($pattern, $sqlwrk) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*select\s+distinct\s+/i', $sqlwrk) && !preg_match('/\s+order\s+by\s+/i', $sqlwrk)
        ) {
            $sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlwrk = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $cnt = $conn->fetchOne($sqlwrk);
        if ($cnt !== false) {
            return (int)$cnt;
        }

        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        return ExecuteRecordCount($sql, $conn);
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        )->getSQL();
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    public function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->setValue($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        $success = $this->insertSql($rs)->execute();
        if ($success) {
        }
        return $success;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->set($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        $success = $this->updateSql($rs, $where, $curfilter)->execute();
        $success = ($success > 0) ? $success : true;
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            $success = $this->deleteSql($rs, $where, $curfilter)->execute();
        }
        return $success;
    }

    // Load DbValue from recordset or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->no_dokumen_no_paket->DbValue = $row['no_dokumen_no_paket'];
        $this->no_dokumen->DbValue = $row['no_dokumen'];
        $this->no_paket->DbValue = $row['no_paket'];
        $this->jenis_dokumen->DbValue = $row['jenis_dokumen'];
        $this->tujuan_penerima->DbValue = $row['tujuan_penerima'];
        $this->no_hp_penerima->DbValue = $row['no_hp_penerima'];
        $this->email_penerima->DbValue = $row['email_penerima'];
        $this->id->DbValue = $row['id'];
        $this->status->DbValue = $row['status'];
        $this->tanggal_terima->DbValue = $row['tanggal_terima'];
        $this->jenis_pengirim->DbValue = $row['jenis_pengirim'];
        $this->nama_kurir->DbValue = $row['nama_kurir'];
        $this->no_awb->DbValue = $row['no_awb'];
        $this->employee_name->DbValue = $row['employee_name'];
        $this->id_user->DbValue = $row['id_user'];
        $this->created_date->DbValue = $row['created_date'];
        $this->bukti_penerimaan->Upload->DbValue = $row['bukti_penerimaan'];
        $this->nama_penerima->DbValue = $row['nama_penerima'];
        $this->status_sap->DbValue = $row['status_sap'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
        $oldFiles = EmptyValue($row['bukti_penerimaan']) ? [] : [$row['bukti_penerimaan']];
        foreach ($oldFiles as $oldFile) {
            if (file_exists($this->bukti_penerimaan->oldPhysicalUploadPath() . $oldFile)) {
                @unlink($this->bukti_penerimaan->oldPhysicalUploadPath() . $oldFile);
            }
        }
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 0) {
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("vpenerimaanpaketkeluarshownamauserlist");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        if ($pageName == "vpenerimaanpaketkeluarshownamauserview") {
            return $Language->phrase("View");
        } elseif ($pageName == "vpenerimaanpaketkeluarshownamauseredit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "vpenerimaanpaketkeluarshownamauseradd") {
            return $Language->phrase("Add");
        } else {
            return "";
        }
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "VPenerimaanPaketKeluarShowNamaUserView";
            case Config("API_ADD_ACTION"):
                return "VPenerimaanPaketKeluarShowNamaUserAdd";
            case Config("API_EDIT_ACTION"):
                return "VPenerimaanPaketKeluarShowNamaUserEdit";
            case Config("API_DELETE_ACTION"):
                return "VPenerimaanPaketKeluarShowNamaUserDelete";
            case Config("API_LIST_ACTION"):
                return "VPenerimaanPaketKeluarShowNamaUserList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "vpenerimaanpaketkeluarshownamauserlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("vpenerimaanpaketkeluarshownamauserview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("vpenerimaanpaketkeluarshownamauserview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "vpenerimaanpaketkeluarshownamauseradd?" . $this->getUrlParm($parm);
        } else {
            $url = "vpenerimaanpaketkeluarshownamauseradd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("vpenerimaanpaketkeluarshownamauseredit", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("vpenerimaanpaketkeluarshownamauseradd", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        return $this->keyUrl("vpenerimaanpaketkeluarshownamauserdelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderFieldHeader($fld)
    {
        global $Security, $Language;
        $sortUrl = "";
        $attrs = "";
        if ($fld->Sortable) {
            $sortUrl = $this->sortUrl($fld);
            $attrs = ' role="button" data-sort-url="' . $sortUrl . '" data-sort-type="2"';
        }
        $html = '<div class="ew-table-header-caption"' . $attrs . '>' . $fld->caption() . '</div>';
        if ($sortUrl) {
            $html .= '<div class="ew-table-header-sort">' . $fld->getSortIcon() . '</div>';
        }
        if ($fld->UseFilter && $Security->canSearch()) {
            $html .= '<div class="ew-filter-dropdown-btn" data-ew-action="filter" data-table="' . $fld->TableVar . '" data-field="' . $fld->FieldVar .
                '"><div class="ew-table-header-filter" role="button" aria-haspopup="true">' . $Language->phrase("Filter") . '</div></div>';
        }
        $html = '<div class="ew-table-header-btn">' . $html . '</div>';
        if ($this->UseCustomTemplate) {
            $scriptId = str_replace("{id}", $fld->TableVar . "_" . $fld->Param, "tpc_{id}");
            $html = '<template id="' . $scriptId . '">' . $html . '</template>';
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
            return "";
        } elseif ($fld->Sortable) {
            $urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort());
            return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load recordset based on filter
    public function loadRs($filter)
    {
        $sql = $this->getSql($filter); // Set up filter (WHERE Clause)
        $conn = $this->getConnection();
        return $conn->executeQuery($sql);
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
        $this->no_dokumen_no_paket->setDbValue($row['no_dokumen_no_paket']);
        $this->no_dokumen->setDbValue($row['no_dokumen']);
        $this->no_paket->setDbValue($row['no_paket']);
        $this->jenis_dokumen->setDbValue($row['jenis_dokumen']);
        $this->tujuan_penerima->setDbValue($row['tujuan_penerima']);
        $this->no_hp_penerima->setDbValue($row['no_hp_penerima']);
        $this->email_penerima->setDbValue($row['email_penerima']);
        $this->id->setDbValue($row['id']);
        $this->status->setDbValue($row['status']);
        $this->tanggal_terima->setDbValue($row['tanggal_terima']);
        $this->jenis_pengirim->setDbValue($row['jenis_pengirim']);
        $this->nama_kurir->setDbValue($row['nama_kurir']);
        $this->no_awb->setDbValue($row['no_awb']);
        $this->employee_name->setDbValue($row['employee_name']);
        $this->id_user->setDbValue($row['id_user']);
        $this->created_date->setDbValue($row['created_date']);
        $this->bukti_penerimaan->Upload->DbValue = $row['bukti_penerimaan'];
        $this->nama_penerima->setDbValue($row['nama_penerima']);
        $this->status_sap->setDbValue($row['status_sap']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // no_dokumen_no_paket

        // no_dokumen
        $this->no_dokumen->CellCssStyle = "white-space: nowrap;";

        // no_paket
        $this->no_paket->CellCssStyle = "white-space: nowrap;";

        // jenis_dokumen

        // tujuan_penerima

        // no_hp_penerima

        // email_penerima

        // id
        $this->id->CellCssStyle = "white-space: nowrap;";

        // status

        // tanggal_terima

        // jenis_pengirim

        // nama_kurir

        // no_awb

        // employee_name

        // id_user
        $this->id_user->CellCssStyle = "white-space: nowrap;";

        // created_date

        // bukti_penerimaan

        // nama_penerima

        // status_sap

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

        // tujuan_penerima
        $this->tujuan_penerima->ViewValue = $this->tujuan_penerima->CurrentValue;
        $this->tujuan_penerima->ViewCustomAttributes = "";

        // no_hp_penerima
        $this->no_hp_penerima->ViewValue = $this->no_hp_penerima->CurrentValue;
        $this->no_hp_penerima->ViewCustomAttributes = "";

        // email_penerima
        $this->email_penerima->ViewValue = $this->email_penerima->CurrentValue;
        $this->email_penerima->ViewCustomAttributes = "";

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

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
        $this->nama_kurir->ViewValue = $this->nama_kurir->CurrentValue;
        $this->nama_kurir->ViewCustomAttributes = "";

        // no_awb
        $this->no_awb->ViewValue = $this->no_awb->CurrentValue;
        $this->no_awb->ViewCustomAttributes = "";

        // employee_name
        $this->employee_name->ViewValue = $this->employee_name->CurrentValue;
        $this->employee_name->ViewCustomAttributes = "";

        // id_user
        $this->id_user->ViewValue = $this->id_user->CurrentValue;
        $this->id_user->ViewValue = FormatNumber($this->id_user->ViewValue, $this->id_user->formatPattern());
        $this->id_user->ViewCustomAttributes = "";

        // created_date
        $this->created_date->ViewValue = $this->created_date->CurrentValue;
        $this->created_date->ViewValue = FormatDateTime($this->created_date->ViewValue, $this->created_date->formatPattern());
        $this->created_date->ViewCustomAttributes = "";

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

        // no_dokumen_no_paket
        $this->no_dokumen_no_paket->LinkCustomAttributes = "";
        $this->no_dokumen_no_paket->HrefValue = "";
        $this->no_dokumen_no_paket->TooltipValue = "";

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

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

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

        // employee_name
        $this->employee_name->LinkCustomAttributes = "";
        $this->employee_name->HrefValue = "";
        $this->employee_name->TooltipValue = "";

        // id_user
        $this->id_user->LinkCustomAttributes = "";
        $this->id_user->HrefValue = "";
        $this->id_user->TooltipValue = "";

        // created_date
        $this->created_date->LinkCustomAttributes = "";
        $this->created_date->HrefValue = "";
        $this->created_date->TooltipValue = "";

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
            $this->bukti_penerimaan->LinkAttrs["data-rel"] = "v_penerimaan_paket_keluar_show_nama_user_x_bukti_penerimaan";
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

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // no_dokumen_no_paket
        $this->no_dokumen_no_paket->setupEditAttributes();
        $this->no_dokumen_no_paket->EditCustomAttributes = "";
        $this->no_dokumen_no_paket->EditValue = $this->no_dokumen_no_paket->CurrentValue;
        $this->no_dokumen_no_paket->PlaceHolder = RemoveHtml($this->no_dokumen_no_paket->caption());

        // no_dokumen
        $this->no_dokumen->setupEditAttributes();
        $this->no_dokumen->EditCustomAttributes = "";
        if (!$this->no_dokumen->Raw) {
            $this->no_dokumen->CurrentValue = HtmlDecode($this->no_dokumen->CurrentValue);
        }
        $this->no_dokumen->EditValue = $this->no_dokumen->CurrentValue;
        $this->no_dokumen->PlaceHolder = RemoveHtml($this->no_dokumen->caption());

        // no_paket
        $this->no_paket->setupEditAttributes();
        $this->no_paket->EditCustomAttributes = "";
        if (!$this->no_paket->Raw) {
            $this->no_paket->CurrentValue = HtmlDecode($this->no_paket->CurrentValue);
        }
        $this->no_paket->EditValue = $this->no_paket->CurrentValue;
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
            $filterWrk = "";
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
        if (!$this->tujuan_penerima->Raw) {
            $this->tujuan_penerima->CurrentValue = HtmlDecode($this->tujuan_penerima->CurrentValue);
        }
        $this->tujuan_penerima->EditValue = $this->tujuan_penerima->CurrentValue;
        $this->tujuan_penerima->PlaceHolder = RemoveHtml($this->tujuan_penerima->caption());

        // no_hp_penerima
        $this->no_hp_penerima->setupEditAttributes();
        $this->no_hp_penerima->EditCustomAttributes = "";
        if (!$this->no_hp_penerima->Raw) {
            $this->no_hp_penerima->CurrentValue = HtmlDecode($this->no_hp_penerima->CurrentValue);
        }
        $this->no_hp_penerima->EditValue = $this->no_hp_penerima->CurrentValue;
        $this->no_hp_penerima->PlaceHolder = RemoveHtml($this->no_hp_penerima->caption());

        // email_penerima
        $this->email_penerima->setupEditAttributes();
        $this->email_penerima->EditCustomAttributes = "";
        if (!$this->email_penerima->Raw) {
            $this->email_penerima->CurrentValue = HtmlDecode($this->email_penerima->CurrentValue);
        }
        $this->email_penerima->EditValue = $this->email_penerima->CurrentValue;
        $this->email_penerima->PlaceHolder = RemoveHtml($this->email_penerima->caption());

        // id
        $this->id->setupEditAttributes();
        $this->id->EditCustomAttributes = "";
        $this->id->EditValue = $this->id->CurrentValue;
        $this->id->PlaceHolder = RemoveHtml($this->id->caption());
        if (strval($this->id->EditValue) != "" && is_numeric($this->id->EditValue)) {
            $this->id->EditValue = $this->id->EditValue;
        }

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
            $filterWrk = "";
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
        $this->tanggal_terima->EditValue = FormatDateTime($this->tanggal_terima->CurrentValue, $this->tanggal_terima->formatPattern());
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
            $filterWrk = "";
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
        if (!$this->nama_kurir->Raw) {
            $this->nama_kurir->CurrentValue = HtmlDecode($this->nama_kurir->CurrentValue);
        }
        $this->nama_kurir->EditValue = $this->nama_kurir->CurrentValue;
        $this->nama_kurir->PlaceHolder = RemoveHtml($this->nama_kurir->caption());

        // no_awb
        $this->no_awb->setupEditAttributes();
        $this->no_awb->EditCustomAttributes = "";
        if (!$this->no_awb->Raw) {
            $this->no_awb->CurrentValue = HtmlDecode($this->no_awb->CurrentValue);
        }
        $this->no_awb->EditValue = $this->no_awb->CurrentValue;
        $this->no_awb->PlaceHolder = RemoveHtml($this->no_awb->caption());

        // employee_name
        $this->employee_name->setupEditAttributes();
        $this->employee_name->EditCustomAttributes = "";
        if (!$this->employee_name->Raw) {
            $this->employee_name->CurrentValue = HtmlDecode($this->employee_name->CurrentValue);
        }
        $this->employee_name->EditValue = $this->employee_name->CurrentValue;
        $this->employee_name->PlaceHolder = RemoveHtml($this->employee_name->caption());

        // id_user

        // created_date

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

        // nama_penerima
        $this->nama_penerima->setupEditAttributes();
        $this->nama_penerima->EditCustomAttributes = "";
        if (!$this->nama_penerima->Raw) {
            $this->nama_penerima->CurrentValue = HtmlDecode($this->nama_penerima->CurrentValue);
        }
        $this->nama_penerima->EditValue = $this->nama_penerima->CurrentValue;
        $this->nama_penerima->PlaceHolder = RemoveHtml($this->nama_penerima->caption());

        // status_sap
        $this->status_sap->setupEditAttributes();
        $this->status_sap->EditCustomAttributes = "";
        $this->status_sap->EditValue = $this->status_sap->CurrentValue;
        $this->status_sap->PlaceHolder = RemoveHtml($this->status_sap->caption());
        if (strval($this->status_sap->EditValue) != "" && is_numeric($this->status_sap->EditValue)) {
            $this->status_sap->EditValue = FormatNumber($this->status_sap->EditValue, null);
        }

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$recordset || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->no_dokumen_no_paket);
                    $doc->exportCaption($this->no_dokumen);
                    $doc->exportCaption($this->no_paket);
                    $doc->exportCaption($this->jenis_dokumen);
                    $doc->exportCaption($this->tujuan_penerima);
                    $doc->exportCaption($this->no_hp_penerima);
                    $doc->exportCaption($this->email_penerima);
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->tanggal_terima);
                    $doc->exportCaption($this->jenis_pengirim);
                    $doc->exportCaption($this->nama_kurir);
                    $doc->exportCaption($this->no_awb);
                    $doc->exportCaption($this->employee_name);
                    $doc->exportCaption($this->id_user);
                    $doc->exportCaption($this->created_date);
                    $doc->exportCaption($this->bukti_penerimaan);
                    $doc->exportCaption($this->nama_penerima);
                    $doc->exportCaption($this->status_sap);
                } else {
                    $doc->exportCaption($this->jenis_dokumen);
                    $doc->exportCaption($this->tujuan_penerima);
                    $doc->exportCaption($this->no_hp_penerima);
                    $doc->exportCaption($this->email_penerima);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->tanggal_terima);
                    $doc->exportCaption($this->jenis_pengirim);
                    $doc->exportCaption($this->nama_kurir);
                    $doc->exportCaption($this->no_awb);
                    $doc->exportCaption($this->employee_name);
                    $doc->exportCaption($this->created_date);
                    $doc->exportCaption($this->bukti_penerimaan);
                    $doc->exportCaption($this->nama_penerima);
                    $doc->exportCaption($this->status_sap);
                }
                $doc->endExportRow();
            }
        }

        // Move to first record
        $recCnt = $startRec - 1;
        $stopRec = ($stopRec > 0) ? $stopRec : PHP_INT_MAX;
        while (!$recordset->EOF && $recCnt < $stopRec) {
            $row = $recordset->fields;
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = ROWTYPE_VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->no_dokumen_no_paket);
                        $doc->exportField($this->no_dokumen);
                        $doc->exportField($this->no_paket);
                        $doc->exportField($this->jenis_dokumen);
                        $doc->exportField($this->tujuan_penerima);
                        $doc->exportField($this->no_hp_penerima);
                        $doc->exportField($this->email_penerima);
                        $doc->exportField($this->id);
                        $doc->exportField($this->status);
                        $doc->exportField($this->tanggal_terima);
                        $doc->exportField($this->jenis_pengirim);
                        $doc->exportField($this->nama_kurir);
                        $doc->exportField($this->no_awb);
                        $doc->exportField($this->employee_name);
                        $doc->exportField($this->id_user);
                        $doc->exportField($this->created_date);
                        $doc->exportField($this->bukti_penerimaan);
                        $doc->exportField($this->nama_penerima);
                        $doc->exportField($this->status_sap);
                    } else {
                        $doc->exportField($this->jenis_dokumen);
                        $doc->exportField($this->tujuan_penerima);
                        $doc->exportField($this->no_hp_penerima);
                        $doc->exportField($this->email_penerima);
                        $doc->exportField($this->status);
                        $doc->exportField($this->tanggal_terima);
                        $doc->exportField($this->jenis_pengirim);
                        $doc->exportField($this->nama_kurir);
                        $doc->exportField($this->no_awb);
                        $doc->exportField($this->employee_name);
                        $doc->exportField($this->created_date);
                        $doc->exportField($this->bukti_penerimaan);
                        $doc->exportField($this->nama_penerima);
                        $doc->exportField($this->status_sap);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($row);
            }
            $recordset->moveNext();
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        $width = ($width > 0) ? $width : Config("THUMBNAIL_DEFAULT_WIDTH");
        $height = ($height > 0) ? $height : Config("THUMBNAIL_DEFAULT_HEIGHT");

        // Set up field name / file name field / file type field
        $fldName = "";
        $fileNameFld = "";
        $fileTypeFld = "";
        if ($fldparm == 'bukti_penerimaan') {
            $fldName = "bukti_penerimaan";
            $fileNameFld = "bukti_penerimaan";
        } else {
            return false; // Incorrect field
        }

        // Set up key values
        $ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
        if (count($ar) == 0) {
        } else {
            return false; // Incorrect key
        }

        // Set up filter (WHERE Clause)
        $filter = $this->getRecordFilter();
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $dbtype = GetConnectionType($this->Dbid);
        if ($row = $conn->fetchAssociative($sql)) {
            $val = $row[$fldName];
            if (!EmptyValue($val)) {
                $fld = $this->Fields[$fldName];

                // Binary data
                if ($fld->DataType == DATATYPE_BLOB) {
                    if ($dbtype != "MYSQL") {
                        if (is_resource($val) && get_resource_type($val) == "stream") { // Byte array
                            $val = stream_get_contents($val);
                        }
                    }
                    if ($resize) {
                        ResizeBinary($val, $width, $height, $plugins);
                    }

                    // Write file type
                    if ($fileTypeFld != "" && !EmptyValue($row[$fileTypeFld])) {
                        AddHeader("Content-type", $row[$fileTypeFld]);
                    } else {
                        AddHeader("Content-type", ContentType($val));
                    }

                    // Write file name
                    $downloadPdf = !Config("EMBED_PDF") && Config("DOWNLOAD_PDF_FILE");
                    if ($fileNameFld != "" && !EmptyValue($row[$fileNameFld])) {
                        $fileName = $row[$fileNameFld];
                        $pathinfo = pathinfo($fileName);
                        $ext = strtolower(@$pathinfo["extension"]);
                        $isPdf = SameText($ext, "pdf");
                        if ($downloadPdf || !$isPdf) { // Skip header if not download PDF
                            AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
                        }
                    } else {
                        $ext = ContentExtension($val);
                        $isPdf = SameText($ext, ".pdf");
                        if ($isPdf && $downloadPdf) { // Add header if download PDF
                            AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
                        }
                    }

                    // Write file data
                    if (
                        StartsString("PK", $val) &&
                        ContainsString($val, "[Content_Types].xml") &&
                        ContainsString($val, "_rels") &&
                        ContainsString($val, "docProps")
                    ) { // Fix Office 2007 documents
                        if (!EndsString("\0\0\0", $val)) { // Not ends with 3 or 4 \0
                            $val .= "\0\0\0\0";
                        }
                    }

                    // Clear any debug message
                    if (ob_get_length()) {
                        ob_end_clean();
                    }

                    // Write binary data
                    Write($val);

                    // Upload to folder
                } else {
                    if ($fld->UploadMultiple) {
                        $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                    } else {
                        $files = [$val];
                    }
                    $data = [];
                    $ar = [];
                    foreach ($files as $file) {
                        if (!EmptyValue($file)) {
                            if (Config("ENCRYPT_FILE_PATH")) {
                                $ar[$file] = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $this->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                            } else {
                                $ar[$file] = FullUrl($fld->hrefPath() . $file);
                            }
                        }
                    }
                    $data[$fld->Param] = $ar;
                    WriteJson($data);
                }
            }
            return true;
        }
        return false;
    }

    // Table level events

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected(&$rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        $rsnew["status_sap"] = 1;
        $rsnew["id_user"] = CurrentUserID();
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set the return value to false
        $rsnew["id_user"] = $rsold["id_user"];

        // Check if no_awb or nama_kurir is edited
        if ($rsold["status_sap"] != 2 && $rsold["status_sap"] != 3) {
            if (($rsnew["no_awb"] != $rsold["no_awb"]) || ($rsnew["nama_kurir"] != $rsold["nama_kurir"])) {
                //if($rsnew["jenis_pengirim"] == 2){
                //	$rsnew["status_sap"] = 2;
                //}else{
                $rsnew["status_sap"] = 1;
                //}
            }
        }

        // Check the status_sap for editing restrictions
        if ($rsold["status_sap"] == 2) {
            // When status_sap is 2, only jenis_pengirim, no_awb, and nama_kurir cannot be edited
            //$rsnew["tanggal_terima"] = $rsold["tanggal_terima"];
            $rsnew["no_awb"] = $rsold["no_awb"];
            $rsnew["nama_kurir"] = $rsold["nama_kurir"];
            $rsnew["jenis_pengirim"] = $rsold["jenis_pengirim"];
            $rsnew["status"] = $rsold["status"];
        }

        // Check the status_sap for editing restrictions
        if ($rsold["status_sap"] == 3) {
            //$rsnew["tanggal_terima"] = $rsold["tanggal_terima"];
            $rsnew["no_awb"] = $rsold["no_awb"];
            $rsnew["nama_kurir"] = $rsold["nama_kurir"];
            $rsnew["jenis_pengirim"] = $rsold["jenis_pengirim"];
            $rsnew["status"] = $rsold["status"];
            $rsnew["jenis_dokumen"] = $rsold["jenis_dokumen"];
            $rsnew["id_user"] = $rsold["id_user"];
        }
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, &$rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted(&$rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, &$args)
    {
        //var_dump($email, $args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
