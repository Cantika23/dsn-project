<?php

namespace Mitral2022\DSN2;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for filing_dokumen
 */
class FilingDokumen2 extends DbTable
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
    public $kode;
    public $kode_box;
    public $no_box;
    public $kode_pt;
    public $kode_department;
    public $lokasi;
    public $nama_dokumen;
    public $tahun_pembuatan_dokumen;
    public $deskripsi;
    public $id;
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
        $this->TableVar = 'filing_dokumen2';
        $this->TableName = 'filing_dokumen';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`filing_dokumen`";
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
        $this->DetailView = true; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UseColumnVisibility = true;
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // kode
        $this->kode = new DbField(
            'filing_dokumen2',
            'filing_dokumen',
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
                $this->kode->Lookup = new Lookup('kode', 'filing_dokumen2', true, 'kode', ["kode","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->kode->Lookup = new Lookup('kode', 'filing_dokumen2', true, 'kode', ["kode","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['kode'] = &$this->kode;

        // kode_box
        $this->kode_box = new DbField(
            'filing_dokumen2',
            'filing_dokumen',
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
                $this->kode_box->Lookup = new Lookup('kode_box', 'filing_dokumen2', true, 'kode_box', ["kode_box","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->kode_box->Lookup = new Lookup('kode_box', 'filing_dokumen2', true, 'kode_box', ["kode_box","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['kode_box'] = &$this->kode_box;

        // no_box
        $this->no_box = new DbField(
            'filing_dokumen2',
            'filing_dokumen',
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
                $this->no_box->Lookup = new Lookup('no_box', 'filing_dokumen2', true, 'no_box', ["no_box","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->no_box->Lookup = new Lookup('no_box', 'filing_dokumen2', true, 'no_box', ["no_box","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['no_box'] = &$this->no_box;

        // kode_pt
        $this->kode_pt = new DbField(
            'filing_dokumen2',
            'filing_dokumen',
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
        $this->Fields['kode_pt'] = &$this->kode_pt;

        // kode_department
        $this->kode_department = new DbField(
            'filing_dokumen2',
            'filing_dokumen',
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
        $this->Fields['kode_department'] = &$this->kode_department;

        // lokasi
        $this->lokasi = new DbField(
            'filing_dokumen2',
            'filing_dokumen',
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
                $this->lokasi->Lookup = new Lookup('lokasi', 'filing_dokumen2', true, 'lokasi', ["lokasi","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->lokasi->Lookup = new Lookup('lokasi', 'filing_dokumen2', true, 'lokasi', ["lokasi","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['lokasi'] = &$this->lokasi;

        // nama_dokumen
        $this->nama_dokumen = new DbField(
            'filing_dokumen2',
            'filing_dokumen',
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
                $this->nama_dokumen->Lookup = new Lookup('nama_dokumen', 'filing_dokumen2', true, 'nama_dokumen', ["nama_dokumen","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->nama_dokumen->Lookup = new Lookup('nama_dokumen', 'filing_dokumen2', true, 'nama_dokumen', ["nama_dokumen","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['nama_dokumen'] = &$this->nama_dokumen;

        // tahun_pembuatan_dokumen
        $this->tahun_pembuatan_dokumen = new DbField(
            'filing_dokumen2',
            'filing_dokumen',
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
                $this->tahun_pembuatan_dokumen->Lookup = new Lookup('tahun_pembuatan_dokumen', 'filing_dokumen2', true, 'tahun_pembuatan_dokumen', ["tahun_pembuatan_dokumen","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->tahun_pembuatan_dokumen->Lookup = new Lookup('tahun_pembuatan_dokumen', 'filing_dokumen2', true, 'tahun_pembuatan_dokumen', ["tahun_pembuatan_dokumen","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->tahun_pembuatan_dokumen->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['tahun_pembuatan_dokumen'] = &$this->tahun_pembuatan_dokumen;

        // deskripsi
        $this->deskripsi = new DbField(
            'filing_dokumen2',
            'filing_dokumen',
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
                $this->deskripsi->Lookup = new Lookup('deskripsi', 'filing_dokumen2', true, 'deskripsi', ["deskripsi","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->deskripsi->Lookup = new Lookup('deskripsi', 'filing_dokumen2', true, 'deskripsi', ["deskripsi","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['deskripsi'] = &$this->deskripsi;

        // id
        $this->id = new DbField(
            'filing_dokumen2',
            'filing_dokumen',
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
                $this->id->Lookup = new Lookup('id', 'filing_dokumen2', true, 'id', ["id","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->id->Lookup = new Lookup('id', 'filing_dokumen2', true, 'id', ["id","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['id'] = &$this->id;

        // no_gudang
        $this->no_gudang = new DbField(
            'filing_dokumen2',
            'filing_dokumen',
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
        $this->Fields['no_gudang'] = &$this->no_gudang;

        // no_rak
        $this->no_rak = new DbField(
            'filing_dokumen2',
            'filing_dokumen',
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
                $this->no_rak->Lookup = new Lookup('no_rak', 'filing_dokumen2', true, 'no_rak', ["no_rak","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->no_rak->Lookup = new Lookup('no_rak', 'filing_dokumen2', true, 'no_rak', ["no_rak","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['no_rak'] = &$this->no_rak;

        // file
        $this->file = new DbField(
            'filing_dokumen2',
            'filing_dokumen',
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
                $this->file->Lookup = new Lookup('file', 'filing_dokumen2', true, 'file', ["file","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->file->Lookup = new Lookup('file', 'filing_dokumen2', true, 'file', ["file","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['file'] = &$this->file;

        // masa_berlaku
        $this->masa_berlaku = new DbField(
            'filing_dokumen2',
            'filing_dokumen',
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
        $this->Fields['masa_berlaku'] = &$this->masa_berlaku;

        // created_date
        $this->created_date = new DbField(
            'filing_dokumen2',
            'filing_dokumen',
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
        $this->created_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['created_date'] = &$this->created_date;

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
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*");
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
            // Get insert id if necessary
            $this->id->setDbValue($conn->lastInsertId());
            $rs['id'] = $this->id->DbValue;
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
            if (array_key_exists('id', $rs)) {
                AddFilter($where, QuotedName('id', $this->Dbid) . '=' . QuotedValue($rs['id'], $this->id->DataType, $this->Dbid));
            }
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
        $this->kode->DbValue = $row['kode'];
        $this->kode_box->DbValue = $row['kode_box'];
        $this->no_box->DbValue = $row['no_box'];
        $this->kode_pt->DbValue = $row['kode_pt'];
        $this->kode_department->DbValue = $row['kode_department'];
        $this->lokasi->DbValue = $row['lokasi'];
        $this->nama_dokumen->DbValue = $row['nama_dokumen'];
        $this->tahun_pembuatan_dokumen->DbValue = $row['tahun_pembuatan_dokumen'];
        $this->deskripsi->DbValue = $row['deskripsi'];
        $this->id->DbValue = $row['id'];
        $this->no_gudang->DbValue = $row['no_gudang'];
        $this->no_rak->DbValue = $row['no_rak'];
        $this->file->Upload->DbValue = $row['file'];
        $this->masa_berlaku->DbValue = $row['masa_berlaku'];
        $this->created_date->DbValue = $row['created_date'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
        $oldFiles = EmptyValue($row['file']) ? [] : [$row['file']];
        foreach ($oldFiles as $oldFile) {
            if (file_exists($this->file->oldPhysicalUploadPath() . $oldFile)) {
                @unlink($this->file->oldPhysicalUploadPath() . $oldFile);
            }
        }
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
        return $_SESSION[$name] ?? GetUrl("filingdokumen2list");
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
        if ($pageName == "filingdokumen2view") {
            return $Language->phrase("View");
        } elseif ($pageName == "filingdokumen2edit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "filingdokumen2add") {
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
                return "FilingDokumen2View";
            case Config("API_ADD_ACTION"):
                return "FilingDokumen2Add";
            case Config("API_EDIT_ACTION"):
                return "FilingDokumen2Edit";
            case Config("API_DELETE_ACTION"):
                return "FilingDokumen2Delete";
            case Config("API_LIST_ACTION"):
                return "FilingDokumen2List";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "filingdokumen2list";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("filingdokumen2view", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("filingdokumen2view", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "filingdokumen2add?" . $this->getUrlParm($parm);
        } else {
            $url = "filingdokumen2add";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("filingdokumen2edit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("filingdokumen2add", $this->getUrlParm($parm));
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
        return $this->keyUrl("filingdokumen2delete", $this->getUrlParm());
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
        $this->kode->setDbValue($row['kode']);
        $this->kode_box->setDbValue($row['kode_box']);
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
        $this->masa_berlaku->setDbValue($row['masa_berlaku']);
        $this->created_date->setDbValue($row['created_date']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // kode

        // kode_box

        // no_box

        // kode_pt

        // kode_department

        // lokasi

        // nama_dokumen

        // tahun_pembuatan_dokumen

        // deskripsi

        // id

        // no_gudang

        // no_rak

        // file

        // masa_berlaku

        // created_date

        // kode
        $this->kode->ViewValue = $this->kode->CurrentValue;
        $this->kode->ViewCustomAttributes = "";

        // kode_box
        $this->kode_box->ViewValue = $this->kode_box->CurrentValue;
        $this->kode_box->ViewCustomAttributes = "";

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
        $this->tahun_pembuatan_dokumen->ViewCustomAttributes = "";

        // deskripsi
        $this->deskripsi->ViewValue = $this->deskripsi->CurrentValue;
        $this->deskripsi->ViewCustomAttributes = "";

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // no_gudang
        $curVal = strval($this->no_gudang->CurrentValue);
        if ($curVal != "") {
            $this->no_gudang->ViewValue = $this->no_gudang->lookupCacheOption($curVal);
            if ($this->no_gudang->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->no_gudang->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->no_gudang->Lookup->renderViewRow($rswrk[0]);
                    $this->no_gudang->ViewValue = $this->no_gudang->displayValue($arwrk);
                } else {
                    $this->no_gudang->ViewValue = FormatNumber($this->no_gudang->CurrentValue, $this->no_gudang->formatPattern());
                }
            }
        } else {
            $this->no_gudang->ViewValue = null;
        }
        $this->no_gudang->ViewCustomAttributes = "";

        // no_rak
        $this->no_rak->ViewValue = $this->no_rak->CurrentValue;
        $this->no_rak->ViewCustomAttributes = "";

        // file
        if (!EmptyValue($this->file->Upload->DbValue)) {
            $this->file->ImageWidth = 100;
            $this->file->ImageHeight = 50;
            $this->file->ImageAlt = $this->file->alt();
            $this->file->ImageCssClass = "ew-image";
            $this->file->ViewValue = $this->file->Upload->DbValue;
        } else {
            $this->file->ViewValue = "";
        }
        $this->file->ViewCustomAttributes = "";

        // masa_berlaku
        $curVal = strval($this->masa_berlaku->CurrentValue);
        if ($curVal != "") {
            $this->masa_berlaku->ViewValue = $this->masa_berlaku->lookupCacheOption($curVal);
            if ($this->masa_berlaku->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->masa_berlaku->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->masa_berlaku->Lookup->renderViewRow($rswrk[0]);
                    $this->masa_berlaku->ViewValue = $this->masa_berlaku->displayValue($arwrk);
                } else {
                    $this->masa_berlaku->ViewValue = FormatNumber($this->masa_berlaku->CurrentValue, $this->masa_berlaku->formatPattern());
                }
            }
        } else {
            $this->masa_berlaku->ViewValue = null;
        }
        $this->masa_berlaku->ViewCustomAttributes = "";

        // created_date
        $this->created_date->ViewValue = $this->created_date->CurrentValue;
        $this->created_date->ViewValue = FormatDateTime($this->created_date->ViewValue, $this->created_date->formatPattern());
        $this->created_date->ViewCustomAttributes = "";

        // kode
        $this->kode->LinkCustomAttributes = "";
        $this->kode->HrefValue = "";
        $this->kode->TooltipValue = "";

        // kode_box
        $this->kode_box->LinkCustomAttributes = "";
        $this->kode_box->HrefValue = "";
        $this->kode_box->TooltipValue = "";

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
            $this->file->LinkAttrs["data-rel"] = "filing_dokumen2_x_file";
            $this->file->LinkAttrs->appendClass("ew-lightbox");
        }

        // masa_berlaku
        $this->masa_berlaku->LinkCustomAttributes = "";
        $this->masa_berlaku->HrefValue = "";
        $this->masa_berlaku->TooltipValue = "";

        // created_date
        $this->created_date->LinkCustomAttributes = "";
        $this->created_date->HrefValue = "";
        $this->created_date->TooltipValue = "";

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

        // kode
        $this->kode->setupEditAttributes();
        $this->kode->EditCustomAttributes = "";
        if (!$this->kode->Raw) {
            $this->kode->CurrentValue = HtmlDecode($this->kode->CurrentValue);
        }
        $this->kode->EditValue = $this->kode->CurrentValue;
        $this->kode->PlaceHolder = RemoveHtml($this->kode->caption());

        // kode_box
        $this->kode_box->setupEditAttributes();
        $this->kode_box->EditCustomAttributes = "";
        if (!$this->kode_box->Raw) {
            $this->kode_box->CurrentValue = HtmlDecode($this->kode_box->CurrentValue);
        }
        $this->kode_box->EditValue = $this->kode_box->CurrentValue;
        $this->kode_box->PlaceHolder = RemoveHtml($this->kode_box->caption());

        // no_box
        $this->no_box->setupEditAttributes();
        $this->no_box->EditCustomAttributes = "";
        if (!$this->no_box->Raw) {
            $this->no_box->CurrentValue = HtmlDecode($this->no_box->CurrentValue);
        }
        $this->no_box->EditValue = $this->no_box->CurrentValue;
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
            $filterWrk = "";
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
            $filterWrk = "";
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
        $this->lokasi->EditValue = $this->lokasi->CurrentValue;
        $this->lokasi->PlaceHolder = RemoveHtml($this->lokasi->caption());

        // nama_dokumen
        $this->nama_dokumen->setupEditAttributes();
        $this->nama_dokumen->EditCustomAttributes = "";
        if (!$this->nama_dokumen->Raw) {
            $this->nama_dokumen->CurrentValue = HtmlDecode($this->nama_dokumen->CurrentValue);
        }
        $this->nama_dokumen->EditValue = $this->nama_dokumen->CurrentValue;
        $this->nama_dokumen->PlaceHolder = RemoveHtml($this->nama_dokumen->caption());

        // tahun_pembuatan_dokumen
        $this->tahun_pembuatan_dokumen->setupEditAttributes();
        $this->tahun_pembuatan_dokumen->EditCustomAttributes = "";
        $this->tahun_pembuatan_dokumen->EditValue = $this->tahun_pembuatan_dokumen->CurrentValue;
        $this->tahun_pembuatan_dokumen->PlaceHolder = RemoveHtml($this->tahun_pembuatan_dokumen->caption());
        if (strval($this->tahun_pembuatan_dokumen->EditValue) != "" && is_numeric($this->tahun_pembuatan_dokumen->EditValue)) {
            $this->tahun_pembuatan_dokumen->EditValue = $this->tahun_pembuatan_dokumen->EditValue;
        }

        // deskripsi
        $this->deskripsi->setupEditAttributes();
        $this->deskripsi->EditCustomAttributes = "";
        $this->deskripsi->EditValue = $this->deskripsi->CurrentValue;
        $this->deskripsi->PlaceHolder = RemoveHtml($this->deskripsi->caption());

        // id
        $this->id->setupEditAttributes();
        $this->id->EditCustomAttributes = "";
        $this->id->EditValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // no_gudang
        $this->no_gudang->setupEditAttributes();
        $this->no_gudang->EditCustomAttributes = "";
        $curVal = trim(strval($this->no_gudang->CurrentValue));
        if ($curVal != "") {
            $this->no_gudang->ViewValue = $this->no_gudang->lookupCacheOption($curVal);
        } else {
            $this->no_gudang->ViewValue = $this->no_gudang->Lookup !== null && is_array($this->no_gudang->lookupOptions()) ? $curVal : null;
        }
        if ($this->no_gudang->ViewValue !== null) { // Load from cache
            $this->no_gudang->EditValue = array_values($this->no_gudang->lookupOptions());
        } else { // Lookup from database
            $filterWrk = "";
            $sqlWrk = $this->no_gudang->Lookup->getSql(true, $filterWrk, '', $this, false, true);
            $conn = Conn();
            $config = $conn->getConfiguration();
            $config->setResultCacheImpl($this->Cache);
            $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
            $ari = count($rswrk);
            $arwrk = $rswrk;
            $this->no_gudang->EditValue = $arwrk;
        }
        $this->no_gudang->PlaceHolder = RemoveHtml($this->no_gudang->caption());

        // no_rak
        $this->no_rak->setupEditAttributes();
        $this->no_rak->EditCustomAttributes = "";
        if (!$this->no_rak->Raw) {
            $this->no_rak->CurrentValue = HtmlDecode($this->no_rak->CurrentValue);
        }
        $this->no_rak->EditValue = $this->no_rak->CurrentValue;
        $this->no_rak->PlaceHolder = RemoveHtml($this->no_rak->caption());

        // file
        $this->file->setupEditAttributes();
        $this->file->EditCustomAttributes = "";
        if (!EmptyValue($this->file->Upload->DbValue)) {
            $this->file->ImageWidth = 100;
            $this->file->ImageHeight = 50;
            $this->file->ImageAlt = $this->file->alt();
            $this->file->ImageCssClass = "ew-image";
            $this->file->EditValue = $this->file->Upload->DbValue;
        } else {
            $this->file->EditValue = "";
        }
        if (!EmptyValue($this->file->CurrentValue)) {
            $this->file->Upload->FileName = $this->file->CurrentValue;
        }

        // masa_berlaku
        $this->masa_berlaku->setupEditAttributes();
        $this->masa_berlaku->EditCustomAttributes = "";
        $curVal = trim(strval($this->masa_berlaku->CurrentValue));
        if ($curVal != "") {
            $this->masa_berlaku->ViewValue = $this->masa_berlaku->lookupCacheOption($curVal);
        } else {
            $this->masa_berlaku->ViewValue = $this->masa_berlaku->Lookup !== null && is_array($this->masa_berlaku->lookupOptions()) ? $curVal : null;
        }
        if ($this->masa_berlaku->ViewValue !== null) { // Load from cache
            $this->masa_berlaku->EditValue = array_values($this->masa_berlaku->lookupOptions());
        } else { // Lookup from database
            $filterWrk = "";
            $sqlWrk = $this->masa_berlaku->Lookup->getSql(true, $filterWrk, '', $this, false, true);
            $conn = Conn();
            $config = $conn->getConfiguration();
            $config->setResultCacheImpl($this->Cache);
            $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
            $ari = count($rswrk);
            $arwrk = $rswrk;
            $this->masa_berlaku->EditValue = $arwrk;
        }
        $this->masa_berlaku->PlaceHolder = RemoveHtml($this->masa_berlaku->caption());

        // created_date

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
                    $doc->exportCaption($this->no_box);
                    $doc->exportCaption($this->kode_pt);
                    $doc->exportCaption($this->kode_department);
                    $doc->exportCaption($this->lokasi);
                    $doc->exportCaption($this->nama_dokumen);
                    $doc->exportCaption($this->tahun_pembuatan_dokumen);
                    $doc->exportCaption($this->deskripsi);
                    $doc->exportCaption($this->no_rak);
                    $doc->exportCaption($this->file);
                    $doc->exportCaption($this->masa_berlaku);
                    $doc->exportCaption($this->created_date);
                } else {
                    $doc->exportCaption($this->kode);
                    $doc->exportCaption($this->kode_box);
                    $doc->exportCaption($this->no_box);
                    $doc->exportCaption($this->kode_pt);
                    $doc->exportCaption($this->kode_department);
                    $doc->exportCaption($this->lokasi);
                    $doc->exportCaption($this->nama_dokumen);
                    $doc->exportCaption($this->tahun_pembuatan_dokumen);
                    $doc->exportCaption($this->deskripsi);
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->no_gudang);
                    $doc->exportCaption($this->no_rak);
                    $doc->exportCaption($this->file);
                    $doc->exportCaption($this->masa_berlaku);
                    $doc->exportCaption($this->created_date);
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
                        $doc->exportField($this->no_box);
                        $doc->exportField($this->kode_pt);
                        $doc->exportField($this->kode_department);
                        $doc->exportField($this->lokasi);
                        $doc->exportField($this->nama_dokumen);
                        $doc->exportField($this->tahun_pembuatan_dokumen);
                        $doc->exportField($this->deskripsi);
                        $doc->exportField($this->no_rak);
                        $doc->exportField($this->file);
                        $doc->exportField($this->masa_berlaku);
                        $doc->exportField($this->created_date);
                    } else {
                        $doc->exportField($this->kode);
                        $doc->exportField($this->kode_box);
                        $doc->exportField($this->no_box);
                        $doc->exportField($this->kode_pt);
                        $doc->exportField($this->kode_department);
                        $doc->exportField($this->lokasi);
                        $doc->exportField($this->nama_dokumen);
                        $doc->exportField($this->tahun_pembuatan_dokumen);
                        $doc->exportField($this->deskripsi);
                        $doc->exportField($this->id);
                        $doc->exportField($this->no_gudang);
                        $doc->exportField($this->no_rak);
                        $doc->exportField($this->file);
                        $doc->exportField($this->masa_berlaku);
                        $doc->exportField($this->created_date);
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
        $rsnew["kode"] = GetNextKodeBox(); // mengantisipasi lebih satu user menginput data saat bersamaan
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
        //Log("Row Inserted");
        //$rsnew["kode"] = GetNextKodeBox();
        $sId = ExecuteScalar("SELECT LAST_INSERT_ID();");
        $sPTFiling = ExecuteScalar("SELECT kode_pt from filing_dokumen where id = '".$sId."'");
        $sDepartFiling = ExecuteScalar("SELECT kode_department from filing_dokumen where id = '".$sId."'");
        $sBox = ExecuteScalar("SELECT no_box from filing_dokumen where id = '".$sId."'");
        $sPT = ExecuteScalar("SELECT nama from m_kode_pt where id = '".$sPTFiling."'");
        $slok = ExecuteScalar("SELECT lokasi from filing_dokumen where id = '".$sId."'");
        $sDepart = ExecuteScalar("SELECT nama from m_kode_department where id = '".$sDepartFiling."'");
        $sTahun = ExecuteScalar("select SUBSTRING(tahun_pembuatan_dokumen, 3) from filing_dokumen where id = '".$sId."'");
       	$rowAffected = ExecuteUpdate("Update filing_dokumen Set kode_box = '".$sBox.'/'.$sPT.'/'.$sDepart.'/'.$slok.'/'.$sTahun."' where id='".$sId."'");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, &$rsnew)
    {
        //Log("Row Updated");
        $sId = $rsold['id'];
        $sPTFiling = ExecuteScalar("SELECT kode_pt from filing_dokumen where id = '".$sId."'");
        $sDepartFiling = ExecuteScalar("SELECT kode_department from filing_dokumen where id = '".$sId."'");
        $sBox = ExecuteScalar("SELECT no_box from filing_dokumen where id = '".$sId."'");
        $sPT = ExecuteScalar("SELECT nama from m_kode_pt where id = '".$sPTFiling."'");
        $slok = ExecuteScalar("SELECT lokasi from filing_dokumen where id = '".$sId."'");
        $sDepart = ExecuteScalar("SELECT nama from m_kode_department where id = '".$sDepartFiling."'");
        $sTahun = ExecuteScalar("SELECT SUBSTRING(tahun_pembuatan_dokumen,3) from filing_dokumen where id = '".$sId."'");
       	$rowAffected = ExecuteUpdate("Update filing_dokumen Set kode_box = '".$sBox.'/'.$sPT.'/'.$sDepart.'/'.$slok.'/'.$sTahun."' where id='".$sId."'");
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

        // Kondisi saat form Tambah sedang terbuka (tidak dalam mode konfirmasi)
        if (CurrentPageID() == "add" && $this->CurrentAction != "F") {
            $this->kode->CurrentValue = GetNextKodeBox(); // trik
            $this->kode->EditValue = $this->kode->CurrentValue; // tampilkan
            $this->kode->ReadOnly = TRUE; // supaya tidak bisa diubah
            $this->kode->Visible = FALSE;
            $this->kode_box->Visible = FALSE;
        }

        // Kondisi saat form Tambah sedang dalam mode konfirmasi
        if ($this->CurrentAction == "add" && $this->CurrentAction=="F") {
            $this->kode->ViewValue = $this->kode->CurrentValue; // ambil dari mode sebelumnya
        }
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
