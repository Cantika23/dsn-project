<?php

namespace Mitral2022\DSN2;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for log_courier
 */
class LogCourier extends DbTable
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
    public $id;
    public $awb;
    public $kurir;
    public $req_type;
    public $datetime;
    public $parameter;
    public $_response;
    public $_content;
    public $text_query;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'log_courier';
        $this->TableName = 'log_courier';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`log_courier`";
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

        // id
        $this->id = new DbField(
            'log_courier',
            'log_courier',
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
        $this->Fields['id'] = &$this->id;

        // awb
        $this->awb = new DbField(
            'log_courier',
            'log_courier',
            'x_awb',
            'awb',
            '`awb`',
            '`awb`',
            200,
            20,
            -1,
            false,
            '`awb`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->awb->InputTextType = "text";
        $this->awb->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->awb->Lookup = new Lookup('awb', 'log_courier', true, 'awb', ["awb", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->awb->Lookup = new Lookup('awb', 'log_courier', true, 'awb', ["awb", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['awb'] = &$this->awb;

        // kurir
        $this->kurir = new DbField(
            'log_courier',
            'log_courier',
            'x_kurir',
            'kurir',
            '`kurir`',
            '`kurir`',
            200,
            5,
            -1,
            false,
            '`kurir`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->kurir->InputTextType = "text";
        $this->kurir->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->kurir->Lookup = new Lookup('kurir', 'log_courier', true, 'kurir', ["kurir", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->kurir->Lookup = new Lookup('kurir', 'log_courier', true, 'kurir', ["kurir", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['kurir'] = &$this->kurir;

        // req_type
        $this->req_type = new DbField(
            'log_courier',
            'log_courier',
            'x_req_type',
            'req_type',
            '`req_type`',
            '`req_type`',
            200,
            20,
            -1,
            false,
            '`req_type`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->req_type->InputTextType = "text";
        $this->req_type->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->req_type->Lookup = new Lookup('req_type', 'log_courier', true, 'req_type', ["req_type", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->req_type->Lookup = new Lookup('req_type', 'log_courier', true, 'req_type', ["req_type", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['req_type'] = &$this->req_type;

        // datetime
        $this->datetime = new DbField(
            'log_courier',
            'log_courier',
            'x_datetime',
            'datetime',
            '`datetime`',
            CastDateFieldForLike("`datetime`", 0, "DB"),
            135,
            19,
            0,
            false,
            '`datetime`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->datetime->InputTextType = "text";
        $this->datetime->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->datetime->Lookup = new Lookup('datetime', 'log_courier', true, 'datetime', ["datetime", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->datetime->Lookup = new Lookup('datetime', 'log_courier', true, 'datetime', ["datetime", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->datetime->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['datetime'] = &$this->datetime;

        // parameter
        $this->parameter = new DbField(
            'log_courier',
            'log_courier',
            'x_parameter',
            'parameter',
            '`parameter`',
            '`parameter`',
            201,
            65535,
            -1,
            false,
            '`parameter`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->parameter->InputTextType = "text";
        $this->parameter->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->parameter->Lookup = new Lookup('parameter', 'log_courier', true, 'parameter', ["parameter", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->parameter->Lookup = new Lookup('parameter', 'log_courier', true, 'parameter', ["parameter", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['parameter'] = &$this->parameter;

        // response
        $this->_response = new DbField(
            'log_courier',
            'log_courier',
            'x__response',
            'response',
            '`response`',
            '`response`',
            200,
            10,
            -1,
            false,
            '`response`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->_response->InputTextType = "text";
        $this->_response->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->_response->Lookup = new Lookup('response', 'log_courier', true, 'response', ["response", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->_response->Lookup = new Lookup('response', 'log_courier', true, 'response', ["response", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['response'] = &$this->_response;

        // content
        $this->_content = new DbField(
            'log_courier',
            'log_courier',
            'x__content',
            'content',
            '`content`',
            '`content`',
            201,
            65535,
            -1,
            false,
            '`content`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->_content->InputTextType = "text";
        $this->_content->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->_content->Lookup = new Lookup('content', 'log_courier', true, 'content', ["content", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->_content->Lookup = new Lookup('content', 'log_courier', true, 'content', ["content", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['content'] = &$this->_content;

        // text_query
        $this->text_query = new DbField(
            'log_courier',
            'log_courier',
            'x_text_query',
            'text_query',
            '`text_query`',
            '`text_query`',
            201,
            65535,
            -1,
            false,
            '`text_query`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->text_query->InputTextType = "text";
        $this->text_query->UseFilter = true; // Table header filter
        switch ($CurrentLanguage) {
            case "en-US":
                $this->text_query->Lookup = new Lookup('text_query', 'log_courier', true, 'text_query', ["text_query", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->text_query->Lookup = new Lookup('text_query', 'log_courier', true, 'text_query', ["text_query", "", "", ""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->Fields['text_query'] = &$this->text_query;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`log_courier`";
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
        $this->id->DbValue = $row['id'];
        $this->awb->DbValue = $row['awb'];
        $this->kurir->DbValue = $row['kurir'];
        $this->req_type->DbValue = $row['req_type'];
        $this->datetime->DbValue = $row['datetime'];
        $this->parameter->DbValue = $row['parameter'];
        $this->_response->DbValue = $row['response'];
        $this->_content->DbValue = $row['content'];
        $this->text_query->DbValue = $row['text_query'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
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
        return $_SESSION[$name] ?? GetUrl("logcourierlist");
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
        if ($pageName == "logcourierview") {
            return $Language->phrase("View");
        } elseif ($pageName == "logcourieredit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "logcourieradd") {
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
                return "LogCourierView";
            case Config("API_ADD_ACTION"):
                return "LogCourierAdd";
            case Config("API_EDIT_ACTION"):
                return "LogCourierEdit";
            case Config("API_DELETE_ACTION"):
                return "LogCourierDelete";
            case Config("API_LIST_ACTION"):
                return "LogCourierList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "logcourierlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("logcourierview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("logcourierview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "logcourieradd?" . $this->getUrlParm($parm);
        } else {
            $url = "logcourieradd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("logcourieredit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("logcourieradd", $this->getUrlParm($parm));
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
        return $this->keyUrl("logcourierdelete", $this->getUrlParm());
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
        $this->id->setDbValue($row['id']);
        $this->awb->setDbValue($row['awb']);
        $this->kurir->setDbValue($row['kurir']);
        $this->req_type->setDbValue($row['req_type']);
        $this->datetime->setDbValue($row['datetime']);
        $this->parameter->setDbValue($row['parameter']);
        $this->_response->setDbValue($row['response']);
        $this->_content->setDbValue($row['content']);
        $this->text_query->setDbValue($row['text_query']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id
        $this->id->CellCssStyle = "white-space: nowrap;";

        // awb

        // kurir

        // req_type

        // datetime

        // parameter

        // response

        // content

        // text_query

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // awb
        $this->awb->ViewValue = $this->awb->CurrentValue;
        $this->awb->ViewCustomAttributes = "";

        // kurir
        $this->kurir->ViewValue = $this->kurir->CurrentValue;
        $this->kurir->ViewCustomAttributes = "";

        // req_type
        $this->req_type->ViewValue = $this->req_type->CurrentValue;
        $this->req_type->ViewCustomAttributes = "";

        // datetime
        $this->datetime->ViewValue = $this->datetime->CurrentValue;
        $this->datetime->ViewValue = FormatDateTime($this->datetime->ViewValue, $this->datetime->formatPattern());
        $this->datetime->ViewCustomAttributes = "";

        // parameter
        $this->parameter->ViewValue = $this->parameter->CurrentValue;
        $this->parameter->ViewCustomAttributes = "";

        // response
        $this->_response->ViewValue = $this->_response->CurrentValue;
        $this->_response->ViewCustomAttributes = "";

        // content
        $this->_content->ViewValue = $this->_content->CurrentValue;
        $this->_content->ViewCustomAttributes = "";

        // text_query
        $this->text_query->ViewValue = $this->text_query->CurrentValue;
        $this->text_query->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // awb
        $this->awb->LinkCustomAttributes = "";
        $this->awb->HrefValue = "";
        $this->awb->TooltipValue = "";

        // kurir
        $this->kurir->LinkCustomAttributes = "";
        $this->kurir->HrefValue = "";
        $this->kurir->TooltipValue = "";

        // req_type
        $this->req_type->LinkCustomAttributes = "";
        $this->req_type->HrefValue = "";
        $this->req_type->TooltipValue = "";

        // datetime
        $this->datetime->LinkCustomAttributes = "";
        $this->datetime->HrefValue = "";
        $this->datetime->TooltipValue = "";

        // parameter
        $this->parameter->LinkCustomAttributes = "";
        $this->parameter->HrefValue = "";
        $this->parameter->TooltipValue = "";

        // response
        $this->_response->LinkCustomAttributes = "";
        $this->_response->HrefValue = "";
        $this->_response->TooltipValue = "";

        // content
        $this->_content->LinkCustomAttributes = "";
        $this->_content->HrefValue = "";
        $this->_content->TooltipValue = "";

        // text_query
        $this->text_query->LinkCustomAttributes = "";
        $this->text_query->HrefValue = "";
        $this->text_query->TooltipValue = "";

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

        // id
        $this->id->setupEditAttributes();
        $this->id->EditCustomAttributes = "";
        $this->id->EditValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // awb
        $this->awb->setupEditAttributes();
        $this->awb->EditCustomAttributes = "";
        if (!$this->awb->Raw) {
            $this->awb->CurrentValue = HtmlDecode($this->awb->CurrentValue);
        }
        $this->awb->EditValue = $this->awb->CurrentValue;
        $this->awb->PlaceHolder = RemoveHtml($this->awb->caption());

        // kurir
        $this->kurir->setupEditAttributes();
        $this->kurir->EditCustomAttributes = "";
        if (!$this->kurir->Raw) {
            $this->kurir->CurrentValue = HtmlDecode($this->kurir->CurrentValue);
        }
        $this->kurir->EditValue = $this->kurir->CurrentValue;
        $this->kurir->PlaceHolder = RemoveHtml($this->kurir->caption());

        // req_type
        $this->req_type->setupEditAttributes();
        $this->req_type->EditCustomAttributes = "";
        if (!$this->req_type->Raw) {
            $this->req_type->CurrentValue = HtmlDecode($this->req_type->CurrentValue);
        }
        $this->req_type->EditValue = $this->req_type->CurrentValue;
        $this->req_type->PlaceHolder = RemoveHtml($this->req_type->caption());

        // datetime
        $this->datetime->setupEditAttributes();
        $this->datetime->EditCustomAttributes = "";
        $this->datetime->EditValue = FormatDateTime($this->datetime->CurrentValue, $this->datetime->formatPattern());
        $this->datetime->PlaceHolder = RemoveHtml($this->datetime->caption());

        // parameter
        $this->parameter->setupEditAttributes();
        $this->parameter->EditCustomAttributes = "";
        $this->parameter->EditValue = $this->parameter->CurrentValue;
        $this->parameter->PlaceHolder = RemoveHtml($this->parameter->caption());

        // response
        $this->_response->setupEditAttributes();
        $this->_response->EditCustomAttributes = "";
        if (!$this->_response->Raw) {
            $this->_response->CurrentValue = HtmlDecode($this->_response->CurrentValue);
        }
        $this->_response->EditValue = $this->_response->CurrentValue;
        $this->_response->PlaceHolder = RemoveHtml($this->_response->caption());

        // content
        $this->_content->setupEditAttributes();
        $this->_content->EditCustomAttributes = "";
        $this->_content->EditValue = $this->_content->CurrentValue;
        $this->_content->PlaceHolder = RemoveHtml($this->_content->caption());

        // text_query
        $this->text_query->setupEditAttributes();
        $this->text_query->EditCustomAttributes = "";
        $this->text_query->EditValue = $this->text_query->CurrentValue;
        $this->text_query->PlaceHolder = RemoveHtml($this->text_query->caption());

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
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->awb);
                    $doc->exportCaption($this->kurir);
                    $doc->exportCaption($this->req_type);
                    $doc->exportCaption($this->datetime);
                    $doc->exportCaption($this->parameter);
                    $doc->exportCaption($this->_response);
                    $doc->exportCaption($this->_content);
                    $doc->exportCaption($this->text_query);
                } else {
                    $doc->exportCaption($this->awb);
                    $doc->exportCaption($this->kurir);
                    $doc->exportCaption($this->req_type);
                    $doc->exportCaption($this->datetime);
                    $doc->exportCaption($this->parameter);
                    $doc->exportCaption($this->_response);
                    $doc->exportCaption($this->_content);
                    $doc->exportCaption($this->text_query);
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
                        $doc->exportField($this->id);
                        $doc->exportField($this->awb);
                        $doc->exportField($this->kurir);
                        $doc->exportField($this->req_type);
                        $doc->exportField($this->datetime);
                        $doc->exportField($this->parameter);
                        $doc->exportField($this->_response);
                        $doc->exportField($this->_content);
                        $doc->exportField($this->text_query);
                    } else {
                        $doc->exportField($this->awb);
                        $doc->exportField($this->kurir);
                        $doc->exportField($this->req_type);
                        $doc->exportField($this->datetime);
                        $doc->exportField($this->parameter);
                        $doc->exportField($this->_response);
                        $doc->exportField($this->_content);
                        $doc->exportField($this->text_query);
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
        // No binary fields
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
        // To cancel, set return value to false
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
