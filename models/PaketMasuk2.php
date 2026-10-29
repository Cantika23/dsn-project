<?php

namespace Mitral2022\DSN2;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for Paket Masuk
 */
class PaketMasuk2 extends ReportTable
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
    public $PaketMasuk;

    // Fields
    public $id;
    public $nopaketdokumen;
    public $no_dokumen;
    public $no_paket;
    public $jenis_dokumen;
    public $nama_pengirim;
    public $keterangan;
    public $nama_penerima;
    public $email_penerima;
    public $no_hp_penerima;
    public $status;
    public $hari;
    public $tanggal_terima;
    public $bukti_penerimaan;
    public $diterima_oleh;
    public $created_date;
    public $update_by;
    public $id_user;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'PaketMasuk2';
        $this->TableName = 'Paket Masuk';
        $this->TableType = 'REPORT';

        // Update Table
        $this->UpdateTable = "`penerimaan_paket_masuk`";
        $this->ReportSourceTable = 'penerimaan_paket_masuk'; // Report source table
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

        // id
        $this->id = new ReportField(
            'PaketMasuk2',
            'Paket Masuk',
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
                $this->id->Lookup = new Lookup('id', 'PaketMasuk2', true, 'id', ["id","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->id->Lookup = new Lookup('id', 'PaketMasuk2', true, 'id', ["id","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id->SourceTableVar = 'penerimaan_paket_masuk';
        $this->Fields['id'] = &$this->id;

        // nopaketdokumen
        $this->nopaketdokumen = new ReportField(
            'PaketMasuk2',
            'Paket Masuk',
            'x_nopaketdokumen',
            'nopaketdokumen',
            'concat(no_dokumen,\',\',no_paket)',
            'concat(no_dokumen,\',\',no_paket)',
            201,
            306,
            -1,
            false,
            'concat(no_dokumen,\',\',no_paket)',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->nopaketdokumen->InputTextType = "text";
        $this->nopaketdokumen->IsCustom = true; // Custom field
        $this->nopaketdokumen->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->nopaketdokumen->Lookup = new Lookup('nopaketdokumen', 'PaketMasuk2', true, 'nopaketdokumen', ["nopaketdokumen","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->nopaketdokumen->Lookup = new Lookup('nopaketdokumen', 'PaketMasuk2', true, 'nopaketdokumen', ["nopaketdokumen","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->nopaketdokumen->SourceTableVar = 'penerimaan_paket_masuk';
        $this->Fields['nopaketdokumen'] = &$this->nopaketdokumen;

        // no_dokumen
        $this->no_dokumen = new ReportField(
            'PaketMasuk2',
            'Paket Masuk',
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
        $this->no_dokumen->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->no_dokumen->Lookup = new Lookup('no_dokumen', 'PaketMasuk2', true, 'no_dokumen', ["no_dokumen","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->no_dokumen->Lookup = new Lookup('no_dokumen', 'PaketMasuk2', true, 'no_dokumen', ["no_dokumen","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->no_dokumen->SourceTableVar = 'penerimaan_paket_masuk';
        $this->Fields['no_dokumen'] = &$this->no_dokumen;

        // no_paket
        $this->no_paket = new ReportField(
            'PaketMasuk2',
            'Paket Masuk',
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
                $this->no_paket->Lookup = new Lookup('no_paket', 'PaketMasuk2', true, 'no_paket', ["no_paket","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->no_paket->Lookup = new Lookup('no_paket', 'PaketMasuk2', true, 'no_paket', ["no_paket","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->no_paket->SourceTableVar = 'penerimaan_paket_masuk';
        $this->Fields['no_paket'] = &$this->no_paket;

        // jenis_dokumen
        $this->jenis_dokumen = new ReportField(
            'PaketMasuk2',
            'Paket Masuk',
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
                $this->jenis_dokumen->Lookup = new Lookup('jenis_dokumen', 'm_jenis_dokumen', true, 'id', ["jenis_dokumen","","",""], [], [], [], [], [], [], '', '', "`jenis_dokumen`");
                break;
            default:
                $this->jenis_dokumen->Lookup = new Lookup('jenis_dokumen', 'm_jenis_dokumen', true, 'id', ["jenis_dokumen","","",""], [], [], [], [], [], [], '', '', "`jenis_dokumen`");
                break;
        }
        $this->jenis_dokumen->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->jenis_dokumen->SourceTableVar = 'penerimaan_paket_masuk';
        $this->Fields['jenis_dokumen'] = &$this->jenis_dokumen;

        // nama_pengirim
        $this->nama_pengirim = new ReportField(
            'PaketMasuk2',
            'Paket Masuk',
            'x_nama_pengirim',
            'nama_pengirim',
            '`nama_pengirim`',
            '`nama_pengirim`',
            200,
            200,
            -1,
            false,
            '`nama_pengirim`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->nama_pengirim->InputTextType = "text";
        $this->nama_pengirim->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->nama_pengirim->Lookup = new Lookup('nama_pengirim', 'PaketMasuk2', true, 'nama_pengirim', ["nama_pengirim","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->nama_pengirim->Lookup = new Lookup('nama_pengirim', 'PaketMasuk2', true, 'nama_pengirim', ["nama_pengirim","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->nama_pengirim->SourceTableVar = 'penerimaan_paket_masuk';
        $this->Fields['nama_pengirim'] = &$this->nama_pengirim;

        // keterangan
        $this->keterangan = new ReportField(
            'PaketMasuk2',
            'Paket Masuk',
            'x_keterangan',
            'keterangan',
            '`keterangan`',
            '`keterangan`',
            201,
            300,
            -1,
            false,
            '`keterangan`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->keterangan->InputTextType = "text";
        $this->keterangan->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->keterangan->Lookup = new Lookup('keterangan', 'PaketMasuk2', true, 'keterangan', ["keterangan","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->keterangan->Lookup = new Lookup('keterangan', 'PaketMasuk2', true, 'keterangan', ["keterangan","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->keterangan->SourceTableVar = 'penerimaan_paket_masuk';
        $this->Fields['keterangan'] = &$this->keterangan;

        // nama_penerima
        $this->nama_penerima = new ReportField(
            'PaketMasuk2',
            'Paket Masuk',
            'x_nama_penerima',
            'nama_penerima',
            '`nama_penerima`',
            '`nama_penerima`',
            3,
            11,
            -1,
            false,
            '`nama_penerima`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->nama_penerima->InputTextType = "text";
        $this->nama_penerima->Nullable = false; // NOT NULL field
        $this->nama_penerima->Required = true; // Required field
        $this->nama_penerima->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->nama_penerima->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->nama_penerima->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->nama_penerima->Lookup = new Lookup('nama_penerima', 'user', true, 'id', ["nama_user","","",""], [], [], [], [], [], [], '', '', "`nama_user`");
                break;
            default:
                $this->nama_penerima->Lookup = new Lookup('nama_penerima', 'user', true, 'id', ["nama_user","","",""], [], [], [], [], [], [], '', '', "`nama_user`");
                break;
        }
        $this->nama_penerima->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->nama_penerima->SourceTableVar = 'penerimaan_paket_masuk';
        $this->Fields['nama_penerima'] = &$this->nama_penerima;

        // email_penerima
        $this->email_penerima = new ReportField(
            'PaketMasuk2',
            'Paket Masuk',
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
        $this->email_penerima->Nullable = false; // NOT NULL field
        $this->email_penerima->Required = true; // Required field
        $this->email_penerima->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->email_penerima->Lookup = new Lookup('email_penerima', 'PaketMasuk2', true, 'email_penerima', ["email_penerima","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->email_penerima->Lookup = new Lookup('email_penerima', 'PaketMasuk2', true, 'email_penerima', ["email_penerima","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->email_penerima->SourceTableVar = 'penerimaan_paket_masuk';
        $this->Fields['email_penerima'] = &$this->email_penerima;

        // no_hp_penerima
        $this->no_hp_penerima = new ReportField(
            'PaketMasuk2',
            'Paket Masuk',
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
                $this->no_hp_penerima->Lookup = new Lookup('no_hp_penerima', 'PaketMasuk2', true, 'no_hp_penerima', ["no_hp_penerima","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->no_hp_penerima->Lookup = new Lookup('no_hp_penerima', 'PaketMasuk2', true, 'no_hp_penerima', ["no_hp_penerima","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->no_hp_penerima->SourceTableVar = 'penerimaan_paket_masuk';
        $this->Fields['no_hp_penerima'] = &$this->no_hp_penerima;

        // status
        $this->status = new ReportField(
            'PaketMasuk2',
            'Paket Masuk',
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
                $this->status->Lookup = new Lookup('status', 'm_status_penerimaan', true, 'id', ["status","","",""], [], [], [], [], [], [], '', '', "`status`");
                break;
            default:
                $this->status->Lookup = new Lookup('status', 'm_status_penerimaan', true, 'id', ["status","","",""], [], [], [], [], [], [], '', '', "`status`");
                break;
        }
        $this->status->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->status->SourceTableVar = 'penerimaan_paket_masuk';
        $this->Fields['status'] = &$this->status;

        // hari
        $this->hari = new ReportField(
            'PaketMasuk2',
            'Paket Masuk',
            'x_hari',
            'hari',
            'concat(DAYNAME(tanggal_terima),\',\',tanggal_terima)',
            'concat(DAYNAME(tanggal_terima),\',\',tanggal_terima)',
            200,
            29,
            -1,
            false,
            'concat(DAYNAME(tanggal_terima),\',\',tanggal_terima)',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->hari->InputTextType = "text";
        $this->hari->IsCustom = true; // Custom field
        $this->hari->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->hari->Lookup = new Lookup('hari', 'PaketMasuk2', true, 'hari', ["hari","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->hari->Lookup = new Lookup('hari', 'PaketMasuk2', true, 'hari', ["hari","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->hari->SourceTableVar = 'penerimaan_paket_masuk';
        $this->Fields['hari'] = &$this->hari;

        // tanggal_terima
        $this->tanggal_terima = new ReportField(
            'PaketMasuk2',
            'Paket Masuk',
            'x_tanggal_terima',
            'tanggal_terima',
            '`tanggal_terima`',
            CastDateFieldForLike("`tanggal_terima`", 1, "DB"),
            135,
            19,
            1,
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
                $this->tanggal_terima->Lookup = new Lookup('tanggal_terima', 'PaketMasuk2', true, 'tanggal_terima', ["tanggal_terima","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->tanggal_terima->Lookup = new Lookup('tanggal_terima', 'PaketMasuk2', true, 'tanggal_terima', ["tanggal_terima","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->tanggal_terima->DefaultErrorMessage = str_replace("%s", DateFormat(1), $Language->phrase("IncorrectDate"));
        $this->tanggal_terima->SourceTableVar = 'penerimaan_paket_masuk';
        $this->Fields['tanggal_terima'] = &$this->tanggal_terima;

        // bukti_penerimaan
        $this->bukti_penerimaan = new ReportField(
            'PaketMasuk2',
            'Paket Masuk',
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
                $this->bukti_penerimaan->Lookup = new Lookup('bukti_penerimaan', 'PaketMasuk2', true, 'bukti_penerimaan', ["bukti_penerimaan","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->bukti_penerimaan->Lookup = new Lookup('bukti_penerimaan', 'PaketMasuk2', true, 'bukti_penerimaan', ["bukti_penerimaan","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->bukti_penerimaan->SourceTableVar = 'penerimaan_paket_masuk';
        $this->Fields['bukti_penerimaan'] = &$this->bukti_penerimaan;

        // diterima_oleh
        $this->diterima_oleh = new ReportField(
            'PaketMasuk2',
            'Paket Masuk',
            'x_diterima_oleh',
            'diterima_oleh',
            '`diterima_oleh`',
            '`diterima_oleh`',
            200,
            50,
            -1,
            false,
            '`diterima_oleh`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->diterima_oleh->InputTextType = "text";
        $this->diterima_oleh->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->diterima_oleh->Lookup = new Lookup('diterima_oleh', 'user', true, 'id', ["nama_user","","",""], [], [], [], [], [], [], '', '', "`nama_user`");
                break;
            default:
                $this->diterima_oleh->Lookup = new Lookup('diterima_oleh', 'user', true, 'id', ["nama_user","","",""], [], [], [], [], [], [], '', '', "`nama_user`");
                break;
        }
        $this->diterima_oleh->SourceTableVar = 'penerimaan_paket_masuk';
        $this->Fields['diterima_oleh'] = &$this->diterima_oleh;

        // created_date
        $this->created_date = new ReportField(
            'PaketMasuk2',
            'Paket Masuk',
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
            'HIDDEN'
        );
        $this->created_date->InputTextType = "text";
        $this->created_date->Nullable = false; // NOT NULL field
        $this->created_date->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->created_date->Lookup = new Lookup('created_date', 'PaketMasuk2', true, 'created_date', ["created_date","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->created_date->Lookup = new Lookup('created_date', 'PaketMasuk2', true, 'created_date', ["created_date","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->created_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->created_date->SourceTableVar = 'penerimaan_paket_masuk';
        $this->Fields['created_date'] = &$this->created_date;

        // update_by
        $this->update_by = new ReportField(
            'PaketMasuk2',
            'Paket Masuk',
            'x_update_by',
            'update_by',
            '`update_by`',
            '`update_by`',
            200,
            255,
            -1,
            false,
            '`update_by`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->update_by->InputTextType = "text";
        $this->update_by->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->update_by->Lookup = new Lookup('update_by', 'PaketMasuk2', true, 'update_by', ["update_by","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->update_by->Lookup = new Lookup('update_by', 'PaketMasuk2', true, 'update_by', ["update_by","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->update_by->SourceTableVar = 'penerimaan_paket_masuk';
        $this->Fields['update_by'] = &$this->update_by;

        // id_user
        $this->id_user = new ReportField(
            'PaketMasuk2',
            'Paket Masuk',
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
        $this->id_user->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->id_user->Lookup = new Lookup('id_user', 'PaketMasuk2', true, 'id_user', ["id_user","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->id_user->Lookup = new Lookup('id_user', 'PaketMasuk2', true, 'id_user', ["id_user","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->id_user->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id_user->SourceTableVar = 'penerimaan_paket_masuk';
        $this->Fields['id_user'] = &$this->id_user;

        // PaketMasuk
        $this->PaketMasuk = new DbChart($this, 'PaketMasuk', 'PaketMasuk', 'jenis_dokumen', 'jenis_dokumen', 1005, '', 0, 'COUNT', 600, 250);
        $this->PaketMasuk->YAxisFormat = ["Number"];
        $this->PaketMasuk->YFieldFormat = ["Number"];
        $this->PaketMasuk->SortType = 0;
        $this->PaketMasuk->SortSequence = "";
        $this->PaketMasuk->SqlSelect = $this->getQueryBuilder()->select("`jenis_dokumen`", "''", "COUNT(`jenis_dokumen`)");
        $this->PaketMasuk->SqlGroupBy = "`jenis_dokumen`";
        $this->PaketMasuk->SqlOrderBy = "";
        $this->PaketMasuk->SeriesDateType = "";
        $this->PaketMasuk->ID = "PaketMasuk2_PaketMasuk"; // Chart ID
        $this->PaketMasuk->setParameters([
            ["type", "1005"],
            ["seriestype", "0"]
        ]); // Chart type / Chart series type
        $this->PaketMasuk->setParameters([
            ["caption", $this->PaketMasuk->caption()],
            ["xaxisname", $this->PaketMasuk->xAxisName()]
        ]); // Chart caption / X axis name
        $this->PaketMasuk->setParameter("yaxisname", $this->PaketMasuk->yAxisName()); // Y axis name
        $this->PaketMasuk->setParameters([
            ["shownames", "1"],
            ["showvalues", "1"],
            ["showhovercap", "1"]
        ]); // Show names / Show values / Show hover
        $this->PaketMasuk->setParameter("alpha", "50"); // Chart alpha
        $this->PaketMasuk->setParameter("colorpalette", "#5899DA,#E8743B,#19A979,#ED4A7B,#945ECF,#13A4B4,#525DF4,#BF399E,#6C8893,#EE6868,#2F6497"); // Chart color palette

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
        if ($chartVar == "PaketMasuk") {
            $this->jenis_dokumen->CurrentValue = $chartRow[0];
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
            $chartRow[0] = is_object($this->jenis_dokumen->ViewValue) ? $this->jenis_dokumen->ViewValue->__toString() : $this->jenis_dokumen->ViewValue;
        }
        return $chartRow;
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`penerimaan_paket_masuk`";
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
        $select = $this->getQueryBuilder()->select("*, concat(no_dokumen,',',no_paket) AS `nopaketdokumen`, concat(DAYNAME(tanggal_terima),',',tanggal_terima) AS `hari`, concat(no_dokumen,',',no_paket) AS `nopaketdokumen`, concat(DAYNAME(tanggal_terima),',',tanggal_terima) AS `hari`");
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
        global $Security;
        // Add User ID filter
        if ($Security->currentUserID() != "" && !$Security->isAdmin()) { // Non system admin
            $filter = $this->addUserIDFilter($filter, $id);
        }
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

    // Add User ID filter
    public function addUserIDFilter($filter = "", $id = "")
    {
        global $Security;
        $filterWrk = "";
        if ($id == "")
            $id = (CurrentPageID() == "list") ? $this->CurrentAction : CurrentPageID();
        if (!$this->userIDAllow($id) && !$Security->isAdmin()) {
            $filterWrk = $Security->userIdList();
            if ($filterWrk != "") {
                $filterWrk = '`id_user` IN (' . $filterWrk . ')';
            }
        }

        // Call User ID Filtering event
        $this->userIdFiltering($filterWrk);
        AddFilter($filter, $filterWrk);
        return $filter;
    }

    // User ID subquery
    public function getUserIDSubquery(&$fld, &$masterfld)
    {
        global $UserTable;
        $wrk = "";
        $sql = "SELECT " . $masterfld->Expression . " FROM `penerimaan_paket_masuk`";
        $filter = $this->addUserIDFilter("");
        if ($filter != "") {
            $sql .= " WHERE " . $filter;
        }

        // List all values
        $conn = Conn($UserTable->Dbid);
        $config = $conn->getConfiguration();
        $config->setResultCacheImpl($this->Cache);
        if ($rs = $conn->executeCacheQuery($sql, [], [], $this->CacheProfile)->fetchAllNumeric()) {
            foreach ($rs as $row) {
                if ($wrk != "") {
                    $wrk .= ",";
                }
                $wrk .= QuotedValue($row[0], $masterfld->DataType, Config("USER_TABLE_DBID"));
            }
        }
        if ($wrk != "") {
            $wrk = $fld->Expression . " IN (" . $wrk . ")";
        } else { // No User ID value found
            $wrk = "0=1";
        }
        return $wrk;
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
