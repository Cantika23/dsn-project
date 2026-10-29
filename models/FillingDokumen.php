<?php

namespace Mitral2022\DSN2;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for Filling Dokumen
 */
class FillingDokumen extends ReportTable
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
    public $FillingDokumen;

    // Fields
    public $id;
    public $kode;
    public $kode_box;
    public $no_box;
    public $kode_pt;
    public $kode_department;
    public $lokasi;
    public $nama_dokumen;
    public $tahun_pembuatan_dokumen;
    public $deskripsi;
    public $no_gudang;
    public $no_rak;
    public $file;
    public $masa_berlaku;
    public $created_date;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'FillingDokumen';
        $this->TableName = 'Filling Dokumen';
        $this->TableType = 'REPORT';

        // Update Table
        $this->UpdateTable = "`filing_dokumen`";
        $this->ReportSourceTable = 'filing_dokumen'; // Report source table
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
            'FillingDokumen',
            'Filling Dokumen',
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
        $this->id->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->id->Lookup = new Lookup('id', 'FillingDokumen', true, 'id', ["id","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->id->Lookup = new Lookup('id', 'FillingDokumen', true, 'id', ["id","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id->SourceTableVar = 'filing_dokumen';
        $this->Fields['id'] = &$this->id;

        // kode
        $this->kode = new ReportField(
            'FillingDokumen',
            'Filling Dokumen',
            'x_kode',
            'kode',
            '`kode`',
            '`kode`',
            200,
            200,
            -1,
            false,
            '`kode`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->kode->InputTextType = "text";
        $this->kode->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->kode->Lookup = new Lookup('kode', 'FillingDokumen', true, 'kode', ["kode","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->kode->Lookup = new Lookup('kode', 'FillingDokumen', true, 'kode', ["kode","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->kode->SourceTableVar = 'filing_dokumen';
        $this->Fields['kode'] = &$this->kode;

        // kode_box
        $this->kode_box = new ReportField(
            'FillingDokumen',
            'Filling Dokumen',
            'x_kode_box',
            'kode_box',
            '`kode_box`',
            '`kode_box`',
            200,
            50,
            -1,
            false,
            '`kode_box`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->kode_box->InputTextType = "text";
        $this->kode_box->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->kode_box->Lookup = new Lookup('kode_box', 'FillingDokumen', true, 'kode_box', ["kode_box","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->kode_box->Lookup = new Lookup('kode_box', 'FillingDokumen', true, 'kode_box', ["kode_box","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->kode_box->SourceTableVar = 'filing_dokumen';
        $this->Fields['kode_box'] = &$this->kode_box;

        // no_box
        $this->no_box = new ReportField(
            'FillingDokumen',
            'Filling Dokumen',
            'x_no_box',
            'no_box',
            '`no_box`',
            '`no_box`',
            200,
            25,
            -1,
            false,
            '`no_box`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->no_box->InputTextType = "text";
        $this->no_box->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->no_box->Lookup = new Lookup('no_box', 'FillingDokumen', true, 'no_box', ["no_box","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->no_box->Lookup = new Lookup('no_box', 'FillingDokumen', true, 'no_box', ["no_box","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->no_box->SourceTableVar = 'filing_dokumen';
        $this->Fields['no_box'] = &$this->no_box;

        // kode_pt
        $this->kode_pt = new ReportField(
            'FillingDokumen',
            'Filling Dokumen',
            'x_kode_pt',
            'kode_pt',
            '`kode_pt`',
            '`kode_pt`',
            3,
            11,
            -1,
            false,
            '`kode_pt`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->kode_pt->InputTextType = "text";
        $this->kode_pt->Nullable = false; // NOT NULL field
        $this->kode_pt->Required = true; // Required field
        $this->kode_pt->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kode_pt->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->kode_pt->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->kode_pt->Lookup = new Lookup('kode_pt', 'm_kode_pt', true, 'id', ["nama","nama_lengkap","",""], [], [], [], [], [], [], '', '', "CONCAT(COALESCE(`nama`, ''),'" . ValueSeparator(1, $this->kode_pt) . "',COALESCE(`nama_lengkap`,''))");
                break;
            default:
                $this->kode_pt->Lookup = new Lookup('kode_pt', 'm_kode_pt', true, 'id', ["nama","nama_lengkap","",""], [], [], [], [], [], [], '', '', "CONCAT(COALESCE(`nama`, ''),'" . ValueSeparator(1, $this->kode_pt) . "',COALESCE(`nama_lengkap`,''))");
                break;
        }
        $this->kode_pt->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kode_pt->SourceTableVar = 'filing_dokumen';
        $this->Fields['kode_pt'] = &$this->kode_pt;

        // kode_department
        $this->kode_department = new ReportField(
            'FillingDokumen',
            'Filling Dokumen',
            'x_kode_department',
            'kode_department',
            '`kode_department`',
            '`kode_department`',
            3,
            11,
            -1,
            false,
            '`kode_department`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->kode_department->InputTextType = "text";
        $this->kode_department->Nullable = false; // NOT NULL field
        $this->kode_department->Required = true; // Required field
        $this->kode_department->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->kode_department->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->kode_department->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->kode_department->Lookup = new Lookup('kode_department', 'm_kode_department', true, 'id', ["nama","nama_lengkap","",""], [], [], [], [], [], [], '', '', "CONCAT(COALESCE(`nama`, ''),'" . ValueSeparator(1, $this->kode_department) . "',COALESCE(`nama_lengkap`,''))");
                break;
            default:
                $this->kode_department->Lookup = new Lookup('kode_department', 'm_kode_department', true, 'id', ["nama","nama_lengkap","",""], [], [], [], [], [], [], '', '', "CONCAT(COALESCE(`nama`, ''),'" . ValueSeparator(1, $this->kode_department) . "',COALESCE(`nama_lengkap`,''))");
                break;
        }
        $this->kode_department->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kode_department->SourceTableVar = 'filing_dokumen';
        $this->Fields['kode_department'] = &$this->kode_department;

        // lokasi
        $this->lokasi = new ReportField(
            'FillingDokumen',
            'Filling Dokumen',
            'x_lokasi',
            'lokasi',
            '`lokasi`',
            '`lokasi`',
            200,
            3,
            -1,
            false,
            '`lokasi`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->lokasi->InputTextType = "text";
        $this->lokasi->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->lokasi->Lookup = new Lookup('lokasi', 'FillingDokumen', true, 'lokasi', ["lokasi","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->lokasi->Lookup = new Lookup('lokasi', 'FillingDokumen', true, 'lokasi', ["lokasi","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->lokasi->SourceTableVar = 'filing_dokumen';
        $this->Fields['lokasi'] = &$this->lokasi;

        // nama_dokumen
        $this->nama_dokumen = new ReportField(
            'FillingDokumen',
            'Filling Dokumen',
            'x_nama_dokumen',
            'nama_dokumen',
            '`nama_dokumen`',
            '`nama_dokumen`',
            200,
            100,
            -1,
            false,
            '`nama_dokumen`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->nama_dokumen->InputTextType = "text";
        $this->nama_dokumen->Nullable = false; // NOT NULL field
        $this->nama_dokumen->Required = true; // Required field
        $this->nama_dokumen->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->nama_dokumen->Lookup = new Lookup('nama_dokumen', 'FillingDokumen', true, 'nama_dokumen', ["nama_dokumen","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->nama_dokumen->Lookup = new Lookup('nama_dokumen', 'FillingDokumen', true, 'nama_dokumen', ["nama_dokumen","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->nama_dokumen->SourceTableVar = 'filing_dokumen';
        $this->Fields['nama_dokumen'] = &$this->nama_dokumen;

        // tahun_pembuatan_dokumen
        $this->tahun_pembuatan_dokumen = new ReportField(
            'FillingDokumen',
            'Filling Dokumen',
            'x_tahun_pembuatan_dokumen',
            'tahun_pembuatan_dokumen',
            '`tahun_pembuatan_dokumen`',
            '`tahun_pembuatan_dokumen`',
            3,
            5,
            -1,
            false,
            '`tahun_pembuatan_dokumen`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->tahun_pembuatan_dokumen->InputTextType = "text";
        $this->tahun_pembuatan_dokumen->Nullable = false; // NOT NULL field
        $this->tahun_pembuatan_dokumen->Required = true; // Required field
        $this->tahun_pembuatan_dokumen->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->tahun_pembuatan_dokumen->Lookup = new Lookup('tahun_pembuatan_dokumen', 'FillingDokumen', true, 'tahun_pembuatan_dokumen', ["tahun_pembuatan_dokumen","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->tahun_pembuatan_dokumen->Lookup = new Lookup('tahun_pembuatan_dokumen', 'FillingDokumen', true, 'tahun_pembuatan_dokumen', ["tahun_pembuatan_dokumen","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->tahun_pembuatan_dokumen->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->tahun_pembuatan_dokumen->SourceTableVar = 'filing_dokumen';
        $this->Fields['tahun_pembuatan_dokumen'] = &$this->tahun_pembuatan_dokumen;

        // deskripsi
        $this->deskripsi = new ReportField(
            'FillingDokumen',
            'Filling Dokumen',
            'x_deskripsi',
            'deskripsi',
            '`deskripsi`',
            '`deskripsi`',
            200,
            255,
            -1,
            false,
            '`deskripsi`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->deskripsi->InputTextType = "text";
        $this->deskripsi->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->deskripsi->Lookup = new Lookup('deskripsi', 'FillingDokumen', true, 'deskripsi', ["deskripsi","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->deskripsi->Lookup = new Lookup('deskripsi', 'FillingDokumen', true, 'deskripsi', ["deskripsi","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->deskripsi->SourceTableVar = 'filing_dokumen';
        $this->Fields['deskripsi'] = &$this->deskripsi;

        // no_gudang
        $this->no_gudang = new ReportField(
            'FillingDokumen',
            'Filling Dokumen',
            'x_no_gudang',
            'no_gudang',
            '`no_gudang`',
            '`no_gudang`',
            3,
            11,
            -1,
            false,
            '`no_gudang`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->no_gudang->InputTextType = "text";
        $this->no_gudang->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->no_gudang->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->no_gudang->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->no_gudang->Lookup = new Lookup('no_gudang', 'm_gudang', true, 'id', ["nama","","",""], [], [], [], [], [], [], '', '', "`nama`");
                break;
            default:
                $this->no_gudang->Lookup = new Lookup('no_gudang', 'm_gudang', true, 'id', ["nama","","",""], [], [], [], [], [], [], '', '', "`nama`");
                break;
        }
        $this->no_gudang->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->no_gudang->SourceTableVar = 'filing_dokumen';
        $this->Fields['no_gudang'] = &$this->no_gudang;

        // no_rak
        $this->no_rak = new ReportField(
            'FillingDokumen',
            'Filling Dokumen',
            'x_no_rak',
            'no_rak',
            '`no_rak`',
            '`no_rak`',
            200,
            4,
            -1,
            false,
            '`no_rak`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->no_rak->InputTextType = "text";
        $this->no_rak->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->no_rak->Lookup = new Lookup('no_rak', 'FillingDokumen', true, 'no_rak', ["no_rak","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->no_rak->Lookup = new Lookup('no_rak', 'FillingDokumen', true, 'no_rak', ["no_rak","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->no_rak->SourceTableVar = 'filing_dokumen';
        $this->Fields['no_rak'] = &$this->no_rak;

        // file
        $this->file = new ReportField(
            'FillingDokumen',
            'Filling Dokumen',
            'x_file',
            'file',
            '`file`',
            '`file`',
            200,
            255,
            -1,
            true,
            '`file`',
            false,
            false,
            false,
            'IMAGE',
            'FILE'
        );
        $this->file->InputTextType = "text";
        $this->file->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->file->Lookup = new Lookup('file', 'FillingDokumen', true, 'file', ["file","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->file->Lookup = new Lookup('file', 'FillingDokumen', true, 'file', ["file","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->file->SourceTableVar = 'filing_dokumen';
        $this->Fields['file'] = &$this->file;

        // masa_berlaku
        $this->masa_berlaku = new ReportField(
            'FillingDokumen',
            'Filling Dokumen',
            'x_masa_berlaku',
            'masa_berlaku',
            '`masa_berlaku`',
            '`masa_berlaku`',
            3,
            11,
            -1,
            false,
            '`masa_berlaku`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->masa_berlaku->InputTextType = "text";
        $this->masa_berlaku->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->masa_berlaku->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->masa_berlaku->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->masa_berlaku->Lookup = new Lookup('masa_berlaku', 'm_notifikasi_expired', true, 'id', ["interval","","",""], [], [], [], [], [], [], '', '', "`interval`");
                break;
            default:
                $this->masa_berlaku->Lookup = new Lookup('masa_berlaku', 'm_notifikasi_expired', true, 'id', ["interval","","",""], [], [], [], [], [], [], '', '', "`interval`");
                break;
        }
        $this->masa_berlaku->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->masa_berlaku->SourceTableVar = 'filing_dokumen';
        $this->Fields['masa_berlaku'] = &$this->masa_berlaku;

        // created_date
        $this->created_date = new ReportField(
            'FillingDokumen',
            'Filling Dokumen',
            'x_created_date',
            'created_date',
            '`created_date`',
            CastDateFieldForLike("`created_date`", 0, "DB"),
            135,
            19,
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
        $this->created_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->created_date->SourceTableVar = 'filing_dokumen';
        $this->Fields['created_date'] = &$this->created_date;

        // FillingDokumen
        $this->FillingDokumen = new DbChart($this, 'FillingDokumen', 'FillingDokumen', 'tahun_pembuatan_dokumen', 'nama_dokumen', 1001, '', 0, 'COUNT', 600, 250);
        $this->FillingDokumen->YAxisFormat = [""];
        $this->FillingDokumen->YFieldFormat = [""];
        $this->FillingDokumen->SortType = 0;
        $this->FillingDokumen->SortSequence = "";
        $this->FillingDokumen->SqlSelect = $this->getQueryBuilder()->select("`tahun_pembuatan_dokumen`", "''", "COUNT(`nama_dokumen`)");
        $this->FillingDokumen->SqlGroupBy = "`tahun_pembuatan_dokumen`";
        $this->FillingDokumen->SqlOrderBy = "";
        $this->FillingDokumen->SeriesDateType = "";
        $this->FillingDokumen->ID = "FillingDokumen_FillingDokumen"; // Chart ID
        $this->FillingDokumen->setParameters([
            ["type", "1001"],
            ["seriestype", "0"]
        ]); // Chart type / Chart series type
        $this->FillingDokumen->setParameters([
            ["caption", $this->FillingDokumen->caption()],
            ["xaxisname", $this->FillingDokumen->xAxisName()]
        ]); // Chart caption / X axis name
        $this->FillingDokumen->setParameter("yaxisname", $this->FillingDokumen->yAxisName()); // Y axis name
        $this->FillingDokumen->setParameters([
            ["shownames", "1"],
            ["showvalues", "1"],
            ["showhovercap", "1"]
        ]); // Show names / Show values / Show hover
        $this->FillingDokumen->setParameter("alpha", "50"); // Chart alpha
        $this->FillingDokumen->setParameter("colorpalette", "#5899DA,#E8743B,#19A979,#ED4A7B,#945ECF,#13A4B4,#525DF4,#BF399E,#6C8893,#EE6868,#2F6497"); // Chart color palette

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`filing_dokumen`";
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
        $width = ($width > 0) ? $width : Config("THUMBNAIL_DEFAULT_WIDTH");
        $height = ($height > 0) ? $height : Config("THUMBNAIL_DEFAULT_HEIGHT");

        // Set up field name / file name field / file type field
        $fldName = "";
        $fileNameFld = "";
        $fileTypeFld = "";
        if ($fldparm == 'file') {
            $fldName = "file";
            $fileNameFld = "file";
        } else {
            return false; // Incorrect field
        }

        // Set up key values
        $ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
        if (count($ar) == 1) {
            $this->id->CurrentValue = $ar[0];
        } else {
            return false; // Incorrect key
        }

        // Set up filter (WHERE Clause)
        $filter = $this->getRecordFilter();
        $sql = $this->buildReportSql($this->getSqlSelect(), $this->getSqlFrom(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $filter, "");
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
