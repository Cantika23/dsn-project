<?php

namespace Mitral2022\DSN2;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for Report1
 */
class Report1 extends ReportTable
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
    public $ShowGroupHeaderAsRow = false;
    public $ShowCompactSummaryFooter = true;

    // Export
    public $ExportDoc;
    public $JumlahPenerimaanPaketSuratKeluar;

    // Fields
    public $id;
    public $no_dokumen;
    public $tanggal_terima;
    public $nama_penerima;
    public $no_hp_penerima;
    public $email_penerima;
    public $tujuan_penerima;
    public $status;
    public $jenis_dokumen;
    public $bukti_penerimaan;
    public $jenis_pengirim;
    public $nama_kurir;
    public $no_awb;
    public $id_user;
    public $created_date;
    public $no_paket;
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
        $this->TableVar = 'Report1';
        $this->TableName = 'Report1';
        $this->TableType = 'REPORT';

        // Update Table
        $this->UpdateTable = "`penerimaan_paket_keluar`";
        $this->ReportSourceTable = 'penerimaan_paket_keluar'; // Report source table
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (report only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
        $this->ExportWordVersion = 12; // Word version (PHPWord only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordPageSize = "A4"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions

        // id
        $this->id = new ReportField(
            'Report1',
            'Report1',
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
            'NO'
        );
        $this->id->InputTextType = "text";
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->Sortable = false; // Allow sort
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id->SourceTableVar = 'penerimaan_paket_keluar';
        $this->Fields['id'] = &$this->id;

        // no_dokumen
        $this->no_dokumen = new ReportField(
            'Report1',
            'Report1',
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
        $this->no_dokumen->SourceTableVar = 'penerimaan_paket_keluar';
        $this->Fields['no_dokumen'] = &$this->no_dokumen;

        // tanggal_terima
        $this->tanggal_terima = new ReportField(
            'Report1',
            'Report1',
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
        $this->tanggal_terima->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tanggal_terima->SourceTableVar = 'penerimaan_paket_keluar';
        $this->Fields['tanggal_terima'] = &$this->tanggal_terima;

        // nama_penerima
        $this->nama_penerima = new ReportField(
            'Report1',
            'Report1',
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
        $this->nama_penerima->SourceTableVar = 'penerimaan_paket_keluar';
        $this->Fields['nama_penerima'] = &$this->nama_penerima;

        // no_hp_penerima
        $this->no_hp_penerima = new ReportField(
            'Report1',
            'Report1',
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
        $this->no_hp_penerima->SourceTableVar = 'penerimaan_paket_keluar';
        $this->Fields['no_hp_penerima'] = &$this->no_hp_penerima;

        // email_penerima
        $this->email_penerima = new ReportField(
            'Report1',
            'Report1',
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
        $this->email_penerima->SourceTableVar = 'penerimaan_paket_keluar';
        $this->Fields['email_penerima'] = &$this->email_penerima;

        // tujuan_penerima
        $this->tujuan_penerima = new ReportField(
            'Report1',
            'Report1',
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
        $this->tujuan_penerima->SourceTableVar = 'penerimaan_paket_keluar';
        $this->Fields['tujuan_penerima'] = &$this->tujuan_penerima;

        // status
        $this->status = new ReportField(
            'Report1',
            'Report1',
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
        switch ($CurrentLanguage) {
            case "en-US":
                $this->status->Lookup = new Lookup('status', 'm_status_penerimaan_keluar', false, 'id', ["status", "", "", ""], [], [], [], [], [], [], '', '', "`status`");
                break;
            default:
                $this->status->Lookup = new Lookup('status', 'm_status_penerimaan_keluar', false, 'id', ["status", "", "", ""], [], [], [], [], [], [], '', '', "`status`");
                break;
        }
        $this->status->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->status->SourceTableVar = 'penerimaan_paket_keluar';
        $this->Fields['status'] = &$this->status;

        // jenis_dokumen
        $this->jenis_dokumen = new ReportField(
            'Report1',
            'Report1',
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
        switch ($CurrentLanguage) {
            case "en-US":
                $this->jenis_dokumen->Lookup = new Lookup('jenis_dokumen', 'm_jenis_dokumen', false, 'id', ["jenis_dokumen", "", "", ""], [], [], [], [], [], [], '', '', "`jenis_dokumen`");
                break;
            default:
                $this->jenis_dokumen->Lookup = new Lookup('jenis_dokumen', 'm_jenis_dokumen', false, 'id', ["jenis_dokumen", "", "", ""], [], [], [], [], [], [], '', '', "`jenis_dokumen`");
                break;
        }
        $this->jenis_dokumen->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->jenis_dokumen->SourceTableVar = 'penerimaan_paket_keluar';
        $this->Fields['jenis_dokumen'] = &$this->jenis_dokumen;

        // bukti_penerimaan
        $this->bukti_penerimaan = new ReportField(
            'Report1',
            'Report1',
            'x_bukti_penerimaan',
            'bukti_penerimaan',
            '`bukti_penerimaan`',
            '`bukti_penerimaan`',
            200,
            255,
            -1,
            false,
            '`bukti_penerimaan`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->bukti_penerimaan->InputTextType = "text";
        $this->bukti_penerimaan->SourceTableVar = 'penerimaan_paket_keluar';
        $this->Fields['bukti_penerimaan'] = &$this->bukti_penerimaan;

        // jenis_pengirim
        $this->jenis_pengirim = new ReportField(
            'Report1',
            'Report1',
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
        switch ($CurrentLanguage) {
            case "en-US":
                $this->jenis_pengirim->Lookup = new Lookup('jenis_pengirim', 'Report1', false, '', ["", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->jenis_pengirim->Lookup = new Lookup('jenis_pengirim', 'Report1', false, '', ["", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->jenis_pengirim->OptionCount = 2;
        $this->jenis_pengirim->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->jenis_pengirim->SourceTableVar = 'penerimaan_paket_keluar';
        $this->Fields['jenis_pengirim'] = &$this->jenis_pengirim;

        // nama_kurir
        $this->nama_kurir = new ReportField(
            'Report1',
            'Report1',
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
            'SELECT'
        );
        $this->nama_kurir->InputTextType = "text";
        $this->nama_kurir->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->nama_kurir->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en-US":
                $this->nama_kurir->Lookup = new Lookup('nama_kurir', 'Report1', false, '', ["", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->nama_kurir->Lookup = new Lookup('nama_kurir', 'Report1', false, '', ["", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->nama_kurir->OptionCount = 2;
        $this->nama_kurir->SourceTableVar = 'penerimaan_paket_keluar';
        $this->Fields['nama_kurir'] = &$this->nama_kurir;

        // no_awb
        $this->no_awb = new ReportField(
            'Report1',
            'Report1',
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
        $this->no_awb->SourceTableVar = 'penerimaan_paket_keluar';
        $this->Fields['no_awb'] = &$this->no_awb;

        // id_user
        $this->id_user = new ReportField(
            'Report1',
            'Report1',
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
        $this->id_user->Required = true; // Required field
        $this->id_user->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->id_user->Lookup = new Lookup('id_user', 'user', true, 'id', ["nama_user", "", "", ""], [], [], [], [], [], [], '', '', "`nama_user`");
                break;
            default:
                $this->id_user->Lookup = new Lookup('id_user', 'user', true, 'id', ["nama_user", "", "", ""], [], [], [], [], [], [], '', '', "`nama_user`");
                break;
        }
        $this->id_user->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id_user->SourceTableVar = 'penerimaan_paket_keluar';
        $this->Fields['id_user'] = &$this->id_user;

        // created_date
        $this->created_date = new ReportField(
            'Report1',
            'Report1',
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
        $this->created_date->Required = true; // Required field
        $this->created_date->Sortable = false; // Allow sort
        $this->created_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->created_date->SourceTableVar = 'penerimaan_paket_keluar';
        $this->Fields['created_date'] = &$this->created_date;

        // no_paket
        $this->no_paket = new ReportField(
            'Report1',
            'Report1',
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
        $this->no_paket->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->no_paket->Lookup = new Lookup('no_paket', 'Report1', true, 'no_paket', ["no_paket", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->no_paket->Lookup = new Lookup('no_paket', 'Report1', true, 'no_paket', ["no_paket", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->no_paket->SourceTableVar = 'penerimaan_paket_keluar';
        $this->Fields['no_paket'] = &$this->no_paket;

        // status_sap
        $this->status_sap = new ReportField(
            'Report1',
            'Report1',
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
        $this->status_sap->Sortable = false; // Allow sort
        $this->status_sap->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->status_sap->SourceTableVar = 'penerimaan_paket_keluar';
        $this->Fields['status_sap'] = &$this->status_sap;

        // Jumlah Penerimaan Paket/Surat Keluar
        $this->JumlahPenerimaanPaketSuratKeluar = new DbChart($this, 'JumlahPenerimaanPaketSuratKeluar', 'Jumlah Penerimaan Paket/Surat Keluar', 'no_dokumen', 'tanggal_terima', 1005, '', 0, 'SUM', 600, 500);
        $this->JumlahPenerimaanPaketSuratKeluar->YAxisFormat = ["Date/Time"];
        $this->JumlahPenerimaanPaketSuratKeluar->YFieldFormat = ["Date/Time"];
        $this->JumlahPenerimaanPaketSuratKeluar->SortType = 0;
        $this->JumlahPenerimaanPaketSuratKeluar->SortSequence = "";
        $this->JumlahPenerimaanPaketSuratKeluar->SqlSelect = $this->getQueryBuilder()->select("`no_dokumen`", "''", "SUM(`tanggal_terima`)");
        $this->JumlahPenerimaanPaketSuratKeluar->SqlGroupBy = "`no_dokumen`";
        $this->JumlahPenerimaanPaketSuratKeluar->SqlOrderBy = "";
        $this->JumlahPenerimaanPaketSuratKeluar->SeriesDateType = "";
        $this->JumlahPenerimaanPaketSuratKeluar->ID = "Report1_JumlahPenerimaanPaketSuratKeluar"; // Chart ID
        $this->JumlahPenerimaanPaketSuratKeluar->setParameters([
            ["type", "1005"],
            ["seriestype", "0"]
        ]); // Chart type / Chart series type
        $this->JumlahPenerimaanPaketSuratKeluar->setParameters([
            ["caption", $this->JumlahPenerimaanPaketSuratKeluar->caption()],
            ["xaxisname", $this->JumlahPenerimaanPaketSuratKeluar->xAxisName()]
        ]); // Chart caption / X axis name
        $this->JumlahPenerimaanPaketSuratKeluar->setParameter("yaxisname", $this->JumlahPenerimaanPaketSuratKeluar->yAxisName()); // Y axis name
        $this->JumlahPenerimaanPaketSuratKeluar->setParameters([
            ["shownames", "1"],
            ["showvalues", "1"],
            ["showhovercap", "1"]
        ]); // Show names / Show values / Show hover
        $this->JumlahPenerimaanPaketSuratKeluar->setParameter("alpha", "50"); // Chart alpha
        $this->JumlahPenerimaanPaketSuratKeluar->setParameter("colorpalette", "#5899DA,#E8743B,#19A979,#ED4A7B,#945ECF,#13A4B4,#525DF4,#BF399E,#6C8893,#EE6868,#2F6497"); // Chart color palette

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

    // Multiple column sort
    protected function updateSort(&$fld, $ctrl)
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
            if ($fld->GroupingFieldId == 0) {
                if ($ctrl) {
                    $orderBy = $this->getDetailOrderBy();
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
                    $this->setDetailOrderBy($orderBy); // Save to Session
                } else {
                    $this->setDetailOrderBy($curOrderBy); // Save to Session
                }
            }
        } else {
            if ($fld->GroupingFieldId == 0 && !$ctrl) {
                $fld->setSort("");
            }
        }
    }

    // Get Sort SQL
    protected function sortSql()
    {
        $dtlSortSql = $this->getDetailOrderBy(); // Get ORDER BY for detail fields from session
        $argrps = [];
        foreach ($this->Fields as $fld) {
            if (in_array($fld->getSort(), ["ASC", "DESC"])) {
                $fldsql = $fld->Expression;
                if ($fld->GroupingFieldId > 0) {
                    if ($fld->GroupSql != "") {
                        $argrps[$fld->GroupingFieldId] = str_replace("%s", $fldsql, $fld->GroupSql) . " " . $fld->getSort();
                    } else {
                        $argrps[$fld->GroupingFieldId] = $fldsql . " " . $fld->getSort();
                    }
                }
            }
        }
        $sortSql = "";
        foreach ($argrps as $grp) {
            if ($sortSql != "") {
                $sortSql .= ", ";
            }
            $sortSql .= $grp;
        }
        if ($dtlSortSql != "") {
            if ($sortSql != "") {
                $sortSql .= ", ";
            }
            $sortSql .= $dtlSortSql;
        }
        return $sortSql;
    }

    // Summary properties
    private $sqlSelectAggregate = null;
    private $sqlAggregatePrefix = "";
    private $sqlAggregateSuffix = "";
    private $sqlSelectCount = null;

    // Select Aggregate
    public function getSqlSelectAggregate()
    {
        return $this->sqlSelectAggregate ?? $this->getQueryBuilder()->select("*");
    }

    public function setSqlSelectAggregate($v)
    {
        $this->sqlSelectAggregate = $v;
    }

    // Aggregate Prefix
    public function getSqlAggregatePrefix()
    {
        return ($this->sqlAggregatePrefix != "") ? $this->sqlAggregatePrefix : "";
    }

    public function setSqlAggregatePrefix($v)
    {
        $this->sqlAggregatePrefix = $v;
    }

    // Aggregate Suffix
    public function getSqlAggregateSuffix()
    {
        return ($this->sqlAggregateSuffix != "") ? $this->sqlAggregateSuffix : "";
    }

    public function setSqlAggregateSuffix($v)
    {
        $this->sqlAggregateSuffix = $v;
    }

    // Select Count
    public function getSqlSelectCount()
    {
        return $this->sqlSelectCount ?? $this->getQueryBuilder()->select("COUNT(*)");
    }

    public function setSqlSelectCount($v)
    {
        $this->sqlSelectCount = $v;
    }

    // Render for lookup
    public function renderLookup()
    {
    }

    // Render X Axis for chart
    public function renderChartXAxis($chartVar, $chartRow)
    {
        return $chartRow;
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`penerimaan_paket_keluar`";
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
        if ($this->SqlSelect) {
            return $this->SqlSelect;
        }
        $select = $this->getQueryBuilder()->select("*");
        return $select;
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

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`id` = @id@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->id->CurrentValue : $this->id->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->id->CurrentValue = $keys[0];
            } else {
                $this->id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('id', $row) ? $row['id'] : null;
        } else {
            $val = $this->id->OldValue !== null ? $this->id->OldValue : $this->id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
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
        return $_SESSION[$name] ?? GetUrl("");
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
        if ($pageName == "") {
            return $Language->phrase("View");
        } elseif ($pageName == "") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "") {
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
                return "";
            case Config("API_ADD_ACTION"):
                return "";
            case Config("API_EDIT_ACTION"):
                return "";
            case Config("API_DELETE_ACTION"):
                return "";
            case Config("API_LIST_ACTION"):
                return "";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "?" . $this->getUrlParm($parm);
        } else {
            $url = "";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("", $this->getUrlParm($parm));
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
        return $this->keyUrl("", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "\"id\":" . JsonEncode($this->id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->id->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->id->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
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
        global $DashboardReport;
        if (
            $this->CurrentAction || $this->isExport() ||
            $this->DrillDown || $DashboardReport ||
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
            if (($keyValue = Param("id") ?? Route("id")) !== null) {
                $arKeys[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }

            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_numeric($key)) {
                    continue;
                }
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
            if ($setCurrent) {
                $this->id->CurrentValue = $key;
            } else {
                $this->id->OldValue = $key;
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

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        // No binary fields
        return false;
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
