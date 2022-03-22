<?php

namespace PHPMaker2021\project1;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for room_reservation
 */
class RoomReservation extends DbTable
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
    public $contact_org;
    public $contact_name;
    public $contact_email;
    public $contact_phone;
    public $contact_fax;
    public $contact_address;
    public $contact_city;
    public $contact_state;
    public $contact_zip;
    public $contact_advisor;
    public $contact_advisor_phone;
    public $contact_advisor_email;
    public $billing_org;
    public $billing_name;
    public $billing_email;
    public $billing_phone;
    public $billing_fax;
    public $billing_address;
    public $billing_city;
    public $billing_state;
    public $billing_zip;
    public $billing_method;
    public $billing_frs;
    public $event_title;
    public $event_type;
    public $event_date;
    public $event_time_start;
    public $event_time_end;
    public $event_num_people;
    public $event_room_preference;
    public $recurring_jan;
    public $recurring_feb;
    public $recurring_mar;
    public $recurring_apr;
    public $recurring_may;
    public $recurring_jun;
    public $recurring_jul;
    public $recurring_aug;
    public $recurring_sep;
    public $recurring_oct;
    public $recurring_nov;
    public $recurring_dec;
    public $setup_shape;
    public $certification_name;
    public $certification_date;
    public $timestamp;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'room_reservation';
        $this->TableName = 'room_reservation';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`room_reservation`";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
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
        $this->id = new DbField('room_reservation', 'room_reservation', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, false, '`id`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->Sortable = true; // Allow sort
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['id'] = &$this->id;

        // contact_org
        $this->contact_org = new DbField('room_reservation', 'room_reservation', 'x_contact_org', 'contact_org', '`contact_org`', '`contact_org`', 200, 45, -1, false, '`contact_org`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->contact_org->Sortable = true; // Allow sort
        $this->Fields['contact_org'] = &$this->contact_org;

        // contact_name
        $this->contact_name = new DbField('room_reservation', 'room_reservation', 'x_contact_name', 'contact_name', '`contact_name`', '`contact_name`', 200, 45, -1, false, '`contact_name`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->contact_name->Nullable = false; // NOT NULL field
        $this->contact_name->Required = true; // Required field
        $this->contact_name->Sortable = true; // Allow sort
        $this->Fields['contact_name'] = &$this->contact_name;

        // contact_email
        $this->contact_email = new DbField('room_reservation', 'room_reservation', 'x_contact_email', 'contact_email', '`contact_email`', '`contact_email`', 200, 45, -1, false, '`contact_email`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->contact_email->Nullable = false; // NOT NULL field
        $this->contact_email->Required = true; // Required field
        $this->contact_email->Sortable = true; // Allow sort
        $this->Fields['contact_email'] = &$this->contact_email;

        // contact_phone
        $this->contact_phone = new DbField('room_reservation', 'room_reservation', 'x_contact_phone', 'contact_phone', '`contact_phone`', '`contact_phone`', 200, 45, -1, false, '`contact_phone`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->contact_phone->Nullable = false; // NOT NULL field
        $this->contact_phone->Required = true; // Required field
        $this->contact_phone->Sortable = true; // Allow sort
        $this->Fields['contact_phone'] = &$this->contact_phone;

        // contact_fax
        $this->contact_fax = new DbField('room_reservation', 'room_reservation', 'x_contact_fax', 'contact_fax', '`contact_fax`', '`contact_fax`', 200, 45, -1, false, '`contact_fax`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->contact_fax->Sortable = true; // Allow sort
        $this->Fields['contact_fax'] = &$this->contact_fax;

        // contact_address
        $this->contact_address = new DbField('room_reservation', 'room_reservation', 'x_contact_address', 'contact_address', '`contact_address`', '`contact_address`', 200, 200, -1, false, '`contact_address`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->contact_address->Sortable = true; // Allow sort
        $this->Fields['contact_address'] = &$this->contact_address;

        // contact_city
        $this->contact_city = new DbField('room_reservation', 'room_reservation', 'x_contact_city', 'contact_city', '`contact_city`', '`contact_city`', 200, 45, -1, false, '`contact_city`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->contact_city->Sortable = true; // Allow sort
        $this->Fields['contact_city'] = &$this->contact_city;

        // contact_state
        $this->contact_state = new DbField('room_reservation', 'room_reservation', 'x_contact_state', 'contact_state', '`contact_state`', '`contact_state`', 200, 45, -1, false, '`contact_state`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->contact_state->Sortable = true; // Allow sort
        $this->Fields['contact_state'] = &$this->contact_state;

        // contact_zip
        $this->contact_zip = new DbField('room_reservation', 'room_reservation', 'x_contact_zip', 'contact_zip', '`contact_zip`', '`contact_zip`', 200, 45, -1, false, '`contact_zip`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->contact_zip->Sortable = true; // Allow sort
        $this->Fields['contact_zip'] = &$this->contact_zip;

        // contact_advisor
        $this->contact_advisor = new DbField('room_reservation', 'room_reservation', 'x_contact_advisor', 'contact_advisor', '`contact_advisor`', '`contact_advisor`', 200, 45, -1, false, '`contact_advisor`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->contact_advisor->Sortable = true; // Allow sort
        $this->Fields['contact_advisor'] = &$this->contact_advisor;

        // contact_advisor_phone
        $this->contact_advisor_phone = new DbField('room_reservation', 'room_reservation', 'x_contact_advisor_phone', 'contact_advisor_phone', '`contact_advisor_phone`', '`contact_advisor_phone`', 200, 45, -1, false, '`contact_advisor_phone`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->contact_advisor_phone->Sortable = true; // Allow sort
        $this->Fields['contact_advisor_phone'] = &$this->contact_advisor_phone;

        // contact_advisor_email
        $this->contact_advisor_email = new DbField('room_reservation', 'room_reservation', 'x_contact_advisor_email', 'contact_advisor_email', '`contact_advisor_email`', '`contact_advisor_email`', 200, 45, -1, false, '`contact_advisor_email`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->contact_advisor_email->Sortable = true; // Allow sort
        $this->Fields['contact_advisor_email'] = &$this->contact_advisor_email;

        // billing_org
        $this->billing_org = new DbField('room_reservation', 'room_reservation', 'x_billing_org', 'billing_org', '`billing_org`', '`billing_org`', 200, 45, -1, false, '`billing_org`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->billing_org->Sortable = true; // Allow sort
        $this->Fields['billing_org'] = &$this->billing_org;

        // billing_name
        $this->billing_name = new DbField('room_reservation', 'room_reservation', 'x_billing_name', 'billing_name', '`billing_name`', '`billing_name`', 200, 45, -1, false, '`billing_name`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->billing_name->Nullable = false; // NOT NULL field
        $this->billing_name->Required = true; // Required field
        $this->billing_name->Sortable = true; // Allow sort
        $this->Fields['billing_name'] = &$this->billing_name;

        // billing_email
        $this->billing_email = new DbField('room_reservation', 'room_reservation', 'x_billing_email', 'billing_email', '`billing_email`', '`billing_email`', 200, 45, -1, false, '`billing_email`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->billing_email->Nullable = false; // NOT NULL field
        $this->billing_email->Required = true; // Required field
        $this->billing_email->Sortable = true; // Allow sort
        $this->Fields['billing_email'] = &$this->billing_email;

        // billing_phone
        $this->billing_phone = new DbField('room_reservation', 'room_reservation', 'x_billing_phone', 'billing_phone', '`billing_phone`', '`billing_phone`', 200, 45, -1, false, '`billing_phone`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->billing_phone->Nullable = false; // NOT NULL field
        $this->billing_phone->Required = true; // Required field
        $this->billing_phone->Sortable = true; // Allow sort
        $this->Fields['billing_phone'] = &$this->billing_phone;

        // billing_fax
        $this->billing_fax = new DbField('room_reservation', 'room_reservation', 'x_billing_fax', 'billing_fax', '`billing_fax`', '`billing_fax`', 200, 45, -1, false, '`billing_fax`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->billing_fax->Sortable = true; // Allow sort
        $this->Fields['billing_fax'] = &$this->billing_fax;

        // billing_address
        $this->billing_address = new DbField('room_reservation', 'room_reservation', 'x_billing_address', 'billing_address', '`billing_address`', '`billing_address`', 200, 200, -1, false, '`billing_address`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->billing_address->Sortable = true; // Allow sort
        $this->Fields['billing_address'] = &$this->billing_address;

        // billing_city
        $this->billing_city = new DbField('room_reservation', 'room_reservation', 'x_billing_city', 'billing_city', '`billing_city`', '`billing_city`', 200, 45, -1, false, '`billing_city`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->billing_city->Sortable = true; // Allow sort
        $this->Fields['billing_city'] = &$this->billing_city;

        // billing_state
        $this->billing_state = new DbField('room_reservation', 'room_reservation', 'x_billing_state', 'billing_state', '`billing_state`', '`billing_state`', 200, 45, -1, false, '`billing_state`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->billing_state->Sortable = true; // Allow sort
        $this->Fields['billing_state'] = &$this->billing_state;

        // billing_zip
        $this->billing_zip = new DbField('room_reservation', 'room_reservation', 'x_billing_zip', 'billing_zip', '`billing_zip`', '`billing_zip`', 200, 45, -1, false, '`billing_zip`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->billing_zip->Sortable = true; // Allow sort
        $this->Fields['billing_zip'] = &$this->billing_zip;

        // billing_method
        $this->billing_method = new DbField('room_reservation', 'room_reservation', 'x_billing_method', 'billing_method', '`billing_method`', '`billing_method`', 200, 45, -1, false, '`billing_method`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->billing_method->Nullable = false; // NOT NULL field
        $this->billing_method->Required = true; // Required field
        $this->billing_method->Sortable = true; // Allow sort
        $this->Fields['billing_method'] = &$this->billing_method;

        // billing_frs
        $this->billing_frs = new DbField('room_reservation', 'room_reservation', 'x_billing_frs', 'billing_frs', '`billing_frs`', '`billing_frs`', 200, 45, -1, false, '`billing_frs`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->billing_frs->Sortable = true; // Allow sort
        $this->Fields['billing_frs'] = &$this->billing_frs;

        // event_title
        $this->event_title = new DbField('room_reservation', 'room_reservation', 'x_event_title', 'event_title', '`event_title`', '`event_title`', 200, 200, -1, false, '`event_title`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->event_title->Sortable = true; // Allow sort
        $this->Fields['event_title'] = &$this->event_title;

        // event_type
        $this->event_type = new DbField('room_reservation', 'room_reservation', 'x_event_type', 'event_type', '`event_type`', '`event_type`', 200, 200, -1, false, '`event_type`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->event_type->Sortable = true; // Allow sort
        $this->Fields['event_type'] = &$this->event_type;

        // event_date
        $this->event_date = new DbField('room_reservation', 'room_reservation', 'x_event_date', 'event_date', '`event_date`', CastDateFieldForLike("`event_date`", 0, "DB"), 133, 10, 0, false, '`event_date`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->event_date->Nullable = false; // NOT NULL field
        $this->event_date->Required = true; // Required field
        $this->event_date->Sortable = true; // Allow sort
        $this->event_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['event_date'] = &$this->event_date;

        // event_time_start
        $this->event_time_start = new DbField('room_reservation', 'room_reservation', 'x_event_time_start', 'event_time_start', '`event_time_start`', '`event_time_start`', 200, 45, -1, false, '`event_time_start`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->event_time_start->Nullable = false; // NOT NULL field
        $this->event_time_start->Required = true; // Required field
        $this->event_time_start->Sortable = true; // Allow sort
        $this->Fields['event_time_start'] = &$this->event_time_start;

        // event_time_end
        $this->event_time_end = new DbField('room_reservation', 'room_reservation', 'x_event_time_end', 'event_time_end', '`event_time_end`', '`event_time_end`', 200, 45, -1, false, '`event_time_end`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->event_time_end->Nullable = false; // NOT NULL field
        $this->event_time_end->Required = true; // Required field
        $this->event_time_end->Sortable = true; // Allow sort
        $this->Fields['event_time_end'] = &$this->event_time_end;

        // event_num_people
        $this->event_num_people = new DbField('room_reservation', 'room_reservation', 'x_event_num_people', 'event_num_people', '`event_num_people`', '`event_num_people`', 3, 11, -1, false, '`event_num_people`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->event_num_people->Nullable = false; // NOT NULL field
        $this->event_num_people->Required = true; // Required field
        $this->event_num_people->Sortable = true; // Allow sort
        $this->event_num_people->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['event_num_people'] = &$this->event_num_people;

        // event_room_preference
        $this->event_room_preference = new DbField('room_reservation', 'room_reservation', 'x_event_room_preference', 'event_room_preference', '`event_room_preference`', '`event_room_preference`', 200, 45, -1, false, '`event_room_preference`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->event_room_preference->Sortable = true; // Allow sort
        $this->Fields['event_room_preference'] = &$this->event_room_preference;

        // recurring_jan
        $this->recurring_jan = new DbField('room_reservation', 'room_reservation', 'x_recurring_jan', 'recurring_jan', '`recurring_jan`', '`recurring_jan`', 200, 45, -1, false, '`recurring_jan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->recurring_jan->Sortable = true; // Allow sort
        $this->Fields['recurring_jan'] = &$this->recurring_jan;

        // recurring_feb
        $this->recurring_feb = new DbField('room_reservation', 'room_reservation', 'x_recurring_feb', 'recurring_feb', '`recurring_feb`', '`recurring_feb`', 200, 45, -1, false, '`recurring_feb`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->recurring_feb->Sortable = true; // Allow sort
        $this->Fields['recurring_feb'] = &$this->recurring_feb;

        // recurring_mar
        $this->recurring_mar = new DbField('room_reservation', 'room_reservation', 'x_recurring_mar', 'recurring_mar', '`recurring_mar`', '`recurring_mar`', 200, 45, -1, false, '`recurring_mar`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->recurring_mar->Sortable = true; // Allow sort
        $this->Fields['recurring_mar'] = &$this->recurring_mar;

        // recurring_apr
        $this->recurring_apr = new DbField('room_reservation', 'room_reservation', 'x_recurring_apr', 'recurring_apr', '`recurring_apr`', '`recurring_apr`', 200, 45, -1, false, '`recurring_apr`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->recurring_apr->Sortable = true; // Allow sort
        $this->Fields['recurring_apr'] = &$this->recurring_apr;

        // recurring_may
        $this->recurring_may = new DbField('room_reservation', 'room_reservation', 'x_recurring_may', 'recurring_may', '`recurring_may`', '`recurring_may`', 200, 45, -1, false, '`recurring_may`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->recurring_may->Sortable = true; // Allow sort
        $this->Fields['recurring_may'] = &$this->recurring_may;

        // recurring_jun
        $this->recurring_jun = new DbField('room_reservation', 'room_reservation', 'x_recurring_jun', 'recurring_jun', '`recurring_jun`', '`recurring_jun`', 200, 45, -1, false, '`recurring_jun`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->recurring_jun->Sortable = true; // Allow sort
        $this->Fields['recurring_jun'] = &$this->recurring_jun;

        // recurring_jul
        $this->recurring_jul = new DbField('room_reservation', 'room_reservation', 'x_recurring_jul', 'recurring_jul', '`recurring_jul`', '`recurring_jul`', 200, 45, -1, false, '`recurring_jul`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->recurring_jul->Sortable = true; // Allow sort
        $this->Fields['recurring_jul'] = &$this->recurring_jul;

        // recurring_aug
        $this->recurring_aug = new DbField('room_reservation', 'room_reservation', 'x_recurring_aug', 'recurring_aug', '`recurring_aug`', '`recurring_aug`', 200, 45, -1, false, '`recurring_aug`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->recurring_aug->Sortable = true; // Allow sort
        $this->Fields['recurring_aug'] = &$this->recurring_aug;

        // recurring_sep
        $this->recurring_sep = new DbField('room_reservation', 'room_reservation', 'x_recurring_sep', 'recurring_sep', '`recurring_sep`', '`recurring_sep`', 200, 45, -1, false, '`recurring_sep`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->recurring_sep->Sortable = true; // Allow sort
        $this->Fields['recurring_sep'] = &$this->recurring_sep;

        // recurring_oct
        $this->recurring_oct = new DbField('room_reservation', 'room_reservation', 'x_recurring_oct', 'recurring_oct', '`recurring_oct`', '`recurring_oct`', 200, 45, -1, false, '`recurring_oct`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->recurring_oct->Sortable = true; // Allow sort
        $this->Fields['recurring_oct'] = &$this->recurring_oct;

        // recurring_nov
        $this->recurring_nov = new DbField('room_reservation', 'room_reservation', 'x_recurring_nov', 'recurring_nov', '`recurring_nov`', '`recurring_nov`', 200, 45, -1, false, '`recurring_nov`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->recurring_nov->Sortable = true; // Allow sort
        $this->Fields['recurring_nov'] = &$this->recurring_nov;

        // recurring_dec
        $this->recurring_dec = new DbField('room_reservation', 'room_reservation', 'x_recurring_dec', 'recurring_dec', '`recurring_dec`', '`recurring_dec`', 200, 45, -1, false, '`recurring_dec`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->recurring_dec->Sortable = true; // Allow sort
        $this->Fields['recurring_dec'] = &$this->recurring_dec;

        // setup_shape
        $this->setup_shape = new DbField('room_reservation', 'room_reservation', 'x_setup_shape', 'setup_shape', '`setup_shape`', '`setup_shape`', 200, 45, -1, false, '`setup_shape`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->setup_shape->Sortable = true; // Allow sort
        $this->Fields['setup_shape'] = &$this->setup_shape;

        // certification_name
        $this->certification_name = new DbField('room_reservation', 'room_reservation', 'x_certification_name', 'certification_name', '`certification_name`', '`certification_name`', 200, 45, -1, false, '`certification_name`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->certification_name->Nullable = false; // NOT NULL field
        $this->certification_name->Required = true; // Required field
        $this->certification_name->Sortable = true; // Allow sort
        $this->Fields['certification_name'] = &$this->certification_name;

        // certification_date
        $this->certification_date = new DbField('room_reservation', 'room_reservation', 'x_certification_date', 'certification_date', '`certification_date`', CastDateFieldForLike("`certification_date`", 0, "DB"), 133, 10, 0, false, '`certification_date`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->certification_date->Nullable = false; // NOT NULL field
        $this->certification_date->Required = true; // Required field
        $this->certification_date->Sortable = true; // Allow sort
        $this->certification_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['certification_date'] = &$this->certification_date;

        // timestamp
        $this->timestamp = new DbField('room_reservation', 'room_reservation', 'x_timestamp', 'timestamp', '`timestamp`', CastDateFieldForLike("`timestamp`", 0, "DB"), 135, 19, 0, false, '`timestamp`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->timestamp->Sortable = true; // Allow sort
        $this->timestamp->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['timestamp'] = &$this->timestamp;
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

    // Single column sort
    public function updateSort(&$fld)
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
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        } else {
            $fld->setSort("");
        }
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`room_reservation`";
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
    public function applyUserIDFilters($filter)
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
        if ($sql instanceof \Doctrine\DBAL\Query\QueryBuilder) { // Query builder
            $sql = $sql->resetQueryPart("orderBy")->getSQL();
        }
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            ($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
            preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) &&
            !preg_match('/^\s*select\s+distinct\s+/i', $sql) && !preg_match('/\s+order\s+by\s+/i', $sql)
        ) {
            $sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
        } else {
            $sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $rs = $conn->executeQuery($sqlwrk);
        $cnt = $rs->fetchColumn();
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
    protected function insertSql(&$rs)
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
    protected function updateSql(&$rs, $where = "", $curfilter = true)
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
    protected function deleteSql(&$rs, $where = "", $curfilter = true)
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
        $this->contact_org->DbValue = $row['contact_org'];
        $this->contact_name->DbValue = $row['contact_name'];
        $this->contact_email->DbValue = $row['contact_email'];
        $this->contact_phone->DbValue = $row['contact_phone'];
        $this->contact_fax->DbValue = $row['contact_fax'];
        $this->contact_address->DbValue = $row['contact_address'];
        $this->contact_city->DbValue = $row['contact_city'];
        $this->contact_state->DbValue = $row['contact_state'];
        $this->contact_zip->DbValue = $row['contact_zip'];
        $this->contact_advisor->DbValue = $row['contact_advisor'];
        $this->contact_advisor_phone->DbValue = $row['contact_advisor_phone'];
        $this->contact_advisor_email->DbValue = $row['contact_advisor_email'];
        $this->billing_org->DbValue = $row['billing_org'];
        $this->billing_name->DbValue = $row['billing_name'];
        $this->billing_email->DbValue = $row['billing_email'];
        $this->billing_phone->DbValue = $row['billing_phone'];
        $this->billing_fax->DbValue = $row['billing_fax'];
        $this->billing_address->DbValue = $row['billing_address'];
        $this->billing_city->DbValue = $row['billing_city'];
        $this->billing_state->DbValue = $row['billing_state'];
        $this->billing_zip->DbValue = $row['billing_zip'];
        $this->billing_method->DbValue = $row['billing_method'];
        $this->billing_frs->DbValue = $row['billing_frs'];
        $this->event_title->DbValue = $row['event_title'];
        $this->event_type->DbValue = $row['event_type'];
        $this->event_date->DbValue = $row['event_date'];
        $this->event_time_start->DbValue = $row['event_time_start'];
        $this->event_time_end->DbValue = $row['event_time_end'];
        $this->event_num_people->DbValue = $row['event_num_people'];
        $this->event_room_preference->DbValue = $row['event_room_preference'];
        $this->recurring_jan->DbValue = $row['recurring_jan'];
        $this->recurring_feb->DbValue = $row['recurring_feb'];
        $this->recurring_mar->DbValue = $row['recurring_mar'];
        $this->recurring_apr->DbValue = $row['recurring_apr'];
        $this->recurring_may->DbValue = $row['recurring_may'];
        $this->recurring_jun->DbValue = $row['recurring_jun'];
        $this->recurring_jul->DbValue = $row['recurring_jul'];
        $this->recurring_aug->DbValue = $row['recurring_aug'];
        $this->recurring_sep->DbValue = $row['recurring_sep'];
        $this->recurring_oct->DbValue = $row['recurring_oct'];
        $this->recurring_nov->DbValue = $row['recurring_nov'];
        $this->recurring_dec->DbValue = $row['recurring_dec'];
        $this->setup_shape->DbValue = $row['setup_shape'];
        $this->certification_name->DbValue = $row['certification_name'];
        $this->certification_date->DbValue = $row['certification_date'];
        $this->timestamp->DbValue = $row['timestamp'];
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
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if (ReferUrl() != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login") { // Referer not same page or login page
            $_SESSION[$name] = ReferUrl(); // Save to Session
        }
        if (@$_SESSION[$name] != "") {
            return $_SESSION[$name];
        } else {
            return GetUrl("RoomReservationList");
        }
    }

    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        if ($pageName == "RoomReservationView") {
            return $Language->phrase("View");
        } elseif ($pageName == "RoomReservationEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "RoomReservationAdd") {
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
                return "RoomReservationView";
            case Config("API_ADD_ACTION"):
                return "RoomReservationAdd";
            case Config("API_EDIT_ACTION"):
                return "RoomReservationEdit";
            case Config("API_DELETE_ACTION"):
                return "RoomReservationDelete";
            case Config("API_LIST_ACTION"):
                return "RoomReservationList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "RoomReservationList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("RoomReservationView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("RoomReservationView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "RoomReservationAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "RoomReservationAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("RoomReservationEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("RoomReservationAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("RoomReservationDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "id:" . JsonEncode($this->id->CurrentValue, "number");
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
            $url .= "/" . rawurlencode($this->id->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderSort($fld)
    {
        $classId = $fld->TableVar . "_" . $fld->Param;
        $scriptId = str_replace("%id%", $classId, "tpc_%id%");
        $scriptStart = $this->UseCustomTemplate ? "<template id=\"" . $scriptId . "\">" : "";
        $scriptEnd = $this->UseCustomTemplate ? "</template>" : "";
        $jsSort = " class=\"ew-pointer\" onclick=\"ew.sort(event, '" . $this->sortUrl($fld) . "', 1);\"";
        if ($this->sortUrl($fld) == "") {
            $html = <<<NOSORTHTML
{$scriptStart}<div class="ew-table-header-caption">{$fld->caption()}</div>{$scriptEnd}
NOSORTHTML;
        } else {
            if ($fld->getSort() == "ASC") {
                $sortIcon = '<i class="fas fa-sort-up"></i>';
            } elseif ($fld->getSort() == "DESC") {
                $sortIcon = '<i class="fas fa-sort-down"></i>';
            } else {
                $sortIcon = '';
            }
            $html = <<<SORTHTML
{$scriptStart}<div{$jsSort}><div class="ew-table-header-btn"><span class="ew-table-header-caption">{$fld->caption()}</span><span class="ew-table-header-sort">{$sortIcon}</span></div></div>{$scriptEnd}
SORTHTML;
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
    public function &loadRs($filter)
    {
        $sql = $this->getSql($filter); // Set up filter (WHERE Clause)
        $conn = $this->getConnection();
        $stmt = $conn->executeQuery($sql);
        return $stmt;
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
        $this->contact_org->setDbValue($row['contact_org']);
        $this->contact_name->setDbValue($row['contact_name']);
        $this->contact_email->setDbValue($row['contact_email']);
        $this->contact_phone->setDbValue($row['contact_phone']);
        $this->contact_fax->setDbValue($row['contact_fax']);
        $this->contact_address->setDbValue($row['contact_address']);
        $this->contact_city->setDbValue($row['contact_city']);
        $this->contact_state->setDbValue($row['contact_state']);
        $this->contact_zip->setDbValue($row['contact_zip']);
        $this->contact_advisor->setDbValue($row['contact_advisor']);
        $this->contact_advisor_phone->setDbValue($row['contact_advisor_phone']);
        $this->contact_advisor_email->setDbValue($row['contact_advisor_email']);
        $this->billing_org->setDbValue($row['billing_org']);
        $this->billing_name->setDbValue($row['billing_name']);
        $this->billing_email->setDbValue($row['billing_email']);
        $this->billing_phone->setDbValue($row['billing_phone']);
        $this->billing_fax->setDbValue($row['billing_fax']);
        $this->billing_address->setDbValue($row['billing_address']);
        $this->billing_city->setDbValue($row['billing_city']);
        $this->billing_state->setDbValue($row['billing_state']);
        $this->billing_zip->setDbValue($row['billing_zip']);
        $this->billing_method->setDbValue($row['billing_method']);
        $this->billing_frs->setDbValue($row['billing_frs']);
        $this->event_title->setDbValue($row['event_title']);
        $this->event_type->setDbValue($row['event_type']);
        $this->event_date->setDbValue($row['event_date']);
        $this->event_time_start->setDbValue($row['event_time_start']);
        $this->event_time_end->setDbValue($row['event_time_end']);
        $this->event_num_people->setDbValue($row['event_num_people']);
        $this->event_room_preference->setDbValue($row['event_room_preference']);
        $this->recurring_jan->setDbValue($row['recurring_jan']);
        $this->recurring_feb->setDbValue($row['recurring_feb']);
        $this->recurring_mar->setDbValue($row['recurring_mar']);
        $this->recurring_apr->setDbValue($row['recurring_apr']);
        $this->recurring_may->setDbValue($row['recurring_may']);
        $this->recurring_jun->setDbValue($row['recurring_jun']);
        $this->recurring_jul->setDbValue($row['recurring_jul']);
        $this->recurring_aug->setDbValue($row['recurring_aug']);
        $this->recurring_sep->setDbValue($row['recurring_sep']);
        $this->recurring_oct->setDbValue($row['recurring_oct']);
        $this->recurring_nov->setDbValue($row['recurring_nov']);
        $this->recurring_dec->setDbValue($row['recurring_dec']);
        $this->setup_shape->setDbValue($row['setup_shape']);
        $this->certification_name->setDbValue($row['certification_name']);
        $this->certification_date->setDbValue($row['certification_date']);
        $this->timestamp->setDbValue($row['timestamp']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id

        // contact_org

        // contact_name

        // contact_email

        // contact_phone

        // contact_fax

        // contact_address

        // contact_city

        // contact_state

        // contact_zip

        // contact_advisor

        // contact_advisor_phone

        // contact_advisor_email

        // billing_org

        // billing_name

        // billing_email

        // billing_phone

        // billing_fax

        // billing_address

        // billing_city

        // billing_state

        // billing_zip

        // billing_method

        // billing_frs

        // event_title

        // event_type

        // event_date

        // event_time_start

        // event_time_end

        // event_num_people

        // event_room_preference

        // recurring_jan

        // recurring_feb

        // recurring_mar

        // recurring_apr

        // recurring_may

        // recurring_jun

        // recurring_jul

        // recurring_aug

        // recurring_sep

        // recurring_oct

        // recurring_nov

        // recurring_dec

        // setup_shape

        // certification_name

        // certification_date

        // timestamp

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // contact_org
        $this->contact_org->ViewValue = $this->contact_org->CurrentValue;
        $this->contact_org->ViewCustomAttributes = "";

        // contact_name
        $this->contact_name->ViewValue = $this->contact_name->CurrentValue;
        $this->contact_name->ViewCustomAttributes = "";

        // contact_email
        $this->contact_email->ViewValue = $this->contact_email->CurrentValue;
        $this->contact_email->ViewCustomAttributes = "";

        // contact_phone
        $this->contact_phone->ViewValue = $this->contact_phone->CurrentValue;
        $this->contact_phone->ViewCustomAttributes = "";

        // contact_fax
        $this->contact_fax->ViewValue = $this->contact_fax->CurrentValue;
        $this->contact_fax->ViewCustomAttributes = "";

        // contact_address
        $this->contact_address->ViewValue = $this->contact_address->CurrentValue;
        $this->contact_address->ViewCustomAttributes = "";

        // contact_city
        $this->contact_city->ViewValue = $this->contact_city->CurrentValue;
        $this->contact_city->ViewCustomAttributes = "";

        // contact_state
        $this->contact_state->ViewValue = $this->contact_state->CurrentValue;
        $this->contact_state->ViewCustomAttributes = "";

        // contact_zip
        $this->contact_zip->ViewValue = $this->contact_zip->CurrentValue;
        $this->contact_zip->ViewCustomAttributes = "";

        // contact_advisor
        $this->contact_advisor->ViewValue = $this->contact_advisor->CurrentValue;
        $this->contact_advisor->ViewCustomAttributes = "";

        // contact_advisor_phone
        $this->contact_advisor_phone->ViewValue = $this->contact_advisor_phone->CurrentValue;
        $this->contact_advisor_phone->ViewCustomAttributes = "";

        // contact_advisor_email
        $this->contact_advisor_email->ViewValue = $this->contact_advisor_email->CurrentValue;
        $this->contact_advisor_email->ViewCustomAttributes = "";

        // billing_org
        $this->billing_org->ViewValue = $this->billing_org->CurrentValue;
        $this->billing_org->ViewCustomAttributes = "";

        // billing_name
        $this->billing_name->ViewValue = $this->billing_name->CurrentValue;
        $this->billing_name->ViewCustomAttributes = "";

        // billing_email
        $this->billing_email->ViewValue = $this->billing_email->CurrentValue;
        $this->billing_email->ViewCustomAttributes = "";

        // billing_phone
        $this->billing_phone->ViewValue = $this->billing_phone->CurrentValue;
        $this->billing_phone->ViewCustomAttributes = "";

        // billing_fax
        $this->billing_fax->ViewValue = $this->billing_fax->CurrentValue;
        $this->billing_fax->ViewCustomAttributes = "";

        // billing_address
        $this->billing_address->ViewValue = $this->billing_address->CurrentValue;
        $this->billing_address->ViewCustomAttributes = "";

        // billing_city
        $this->billing_city->ViewValue = $this->billing_city->CurrentValue;
        $this->billing_city->ViewCustomAttributes = "";

        // billing_state
        $this->billing_state->ViewValue = $this->billing_state->CurrentValue;
        $this->billing_state->ViewCustomAttributes = "";

        // billing_zip
        $this->billing_zip->ViewValue = $this->billing_zip->CurrentValue;
        $this->billing_zip->ViewCustomAttributes = "";

        // billing_method
        $this->billing_method->ViewValue = $this->billing_method->CurrentValue;
        $this->billing_method->ViewCustomAttributes = "";

        // billing_frs
        $this->billing_frs->ViewValue = $this->billing_frs->CurrentValue;
        $this->billing_frs->ViewCustomAttributes = "";

        // event_title
        $this->event_title->ViewValue = $this->event_title->CurrentValue;
        $this->event_title->ViewCustomAttributes = "";

        // event_type
        $this->event_type->ViewValue = $this->event_type->CurrentValue;
        $this->event_type->ViewCustomAttributes = "";

        // event_date
        $this->event_date->ViewValue = $this->event_date->CurrentValue;
        $this->event_date->ViewValue = FormatDateTime($this->event_date->ViewValue, 0);
        $this->event_date->ViewCustomAttributes = "";

        // event_time_start
        $this->event_time_start->ViewValue = $this->event_time_start->CurrentValue;
        $this->event_time_start->ViewCustomAttributes = "";

        // event_time_end
        $this->event_time_end->ViewValue = $this->event_time_end->CurrentValue;
        $this->event_time_end->ViewCustomAttributes = "";

        // event_num_people
        $this->event_num_people->ViewValue = $this->event_num_people->CurrentValue;
        $this->event_num_people->ViewValue = FormatNumber($this->event_num_people->ViewValue, 0, -2, -2, -2);
        $this->event_num_people->ViewCustomAttributes = "";

        // event_room_preference
        $this->event_room_preference->ViewValue = $this->event_room_preference->CurrentValue;
        $this->event_room_preference->ViewCustomAttributes = "";

        // recurring_jan
        $this->recurring_jan->ViewValue = $this->recurring_jan->CurrentValue;
        $this->recurring_jan->ViewCustomAttributes = "";

        // recurring_feb
        $this->recurring_feb->ViewValue = $this->recurring_feb->CurrentValue;
        $this->recurring_feb->ViewCustomAttributes = "";

        // recurring_mar
        $this->recurring_mar->ViewValue = $this->recurring_mar->CurrentValue;
        $this->recurring_mar->ViewCustomAttributes = "";

        // recurring_apr
        $this->recurring_apr->ViewValue = $this->recurring_apr->CurrentValue;
        $this->recurring_apr->ViewCustomAttributes = "";

        // recurring_may
        $this->recurring_may->ViewValue = $this->recurring_may->CurrentValue;
        $this->recurring_may->ViewCustomAttributes = "";

        // recurring_jun
        $this->recurring_jun->ViewValue = $this->recurring_jun->CurrentValue;
        $this->recurring_jun->ViewCustomAttributes = "";

        // recurring_jul
        $this->recurring_jul->ViewValue = $this->recurring_jul->CurrentValue;
        $this->recurring_jul->ViewCustomAttributes = "";

        // recurring_aug
        $this->recurring_aug->ViewValue = $this->recurring_aug->CurrentValue;
        $this->recurring_aug->ViewCustomAttributes = "";

        // recurring_sep
        $this->recurring_sep->ViewValue = $this->recurring_sep->CurrentValue;
        $this->recurring_sep->ViewCustomAttributes = "";

        // recurring_oct
        $this->recurring_oct->ViewValue = $this->recurring_oct->CurrentValue;
        $this->recurring_oct->ViewCustomAttributes = "";

        // recurring_nov
        $this->recurring_nov->ViewValue = $this->recurring_nov->CurrentValue;
        $this->recurring_nov->ViewCustomAttributes = "";

        // recurring_dec
        $this->recurring_dec->ViewValue = $this->recurring_dec->CurrentValue;
        $this->recurring_dec->ViewCustomAttributes = "";

        // setup_shape
        $this->setup_shape->ViewValue = $this->setup_shape->CurrentValue;
        $this->setup_shape->ViewCustomAttributes = "";

        // certification_name
        $this->certification_name->ViewValue = $this->certification_name->CurrentValue;
        $this->certification_name->ViewCustomAttributes = "";

        // certification_date
        $this->certification_date->ViewValue = $this->certification_date->CurrentValue;
        $this->certification_date->ViewValue = FormatDateTime($this->certification_date->ViewValue, 0);
        $this->certification_date->ViewCustomAttributes = "";

        // timestamp
        $this->timestamp->ViewValue = $this->timestamp->CurrentValue;
        $this->timestamp->ViewValue = FormatDateTime($this->timestamp->ViewValue, 0);
        $this->timestamp->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // contact_org
        $this->contact_org->LinkCustomAttributes = "";
        $this->contact_org->HrefValue = "";
        $this->contact_org->TooltipValue = "";

        // contact_name
        $this->contact_name->LinkCustomAttributes = "";
        $this->contact_name->HrefValue = "";
        $this->contact_name->TooltipValue = "";

        // contact_email
        $this->contact_email->LinkCustomAttributes = "";
        $this->contact_email->HrefValue = "";
        $this->contact_email->TooltipValue = "";

        // contact_phone
        $this->contact_phone->LinkCustomAttributes = "";
        $this->contact_phone->HrefValue = "";
        $this->contact_phone->TooltipValue = "";

        // contact_fax
        $this->contact_fax->LinkCustomAttributes = "";
        $this->contact_fax->HrefValue = "";
        $this->contact_fax->TooltipValue = "";

        // contact_address
        $this->contact_address->LinkCustomAttributes = "";
        $this->contact_address->HrefValue = "";
        $this->contact_address->TooltipValue = "";

        // contact_city
        $this->contact_city->LinkCustomAttributes = "";
        $this->contact_city->HrefValue = "";
        $this->contact_city->TooltipValue = "";

        // contact_state
        $this->contact_state->LinkCustomAttributes = "";
        $this->contact_state->HrefValue = "";
        $this->contact_state->TooltipValue = "";

        // contact_zip
        $this->contact_zip->LinkCustomAttributes = "";
        $this->contact_zip->HrefValue = "";
        $this->contact_zip->TooltipValue = "";

        // contact_advisor
        $this->contact_advisor->LinkCustomAttributes = "";
        $this->contact_advisor->HrefValue = "";
        $this->contact_advisor->TooltipValue = "";

        // contact_advisor_phone
        $this->contact_advisor_phone->LinkCustomAttributes = "";
        $this->contact_advisor_phone->HrefValue = "";
        $this->contact_advisor_phone->TooltipValue = "";

        // contact_advisor_email
        $this->contact_advisor_email->LinkCustomAttributes = "";
        $this->contact_advisor_email->HrefValue = "";
        $this->contact_advisor_email->TooltipValue = "";

        // billing_org
        $this->billing_org->LinkCustomAttributes = "";
        $this->billing_org->HrefValue = "";
        $this->billing_org->TooltipValue = "";

        // billing_name
        $this->billing_name->LinkCustomAttributes = "";
        $this->billing_name->HrefValue = "";
        $this->billing_name->TooltipValue = "";

        // billing_email
        $this->billing_email->LinkCustomAttributes = "";
        $this->billing_email->HrefValue = "";
        $this->billing_email->TooltipValue = "";

        // billing_phone
        $this->billing_phone->LinkCustomAttributes = "";
        $this->billing_phone->HrefValue = "";
        $this->billing_phone->TooltipValue = "";

        // billing_fax
        $this->billing_fax->LinkCustomAttributes = "";
        $this->billing_fax->HrefValue = "";
        $this->billing_fax->TooltipValue = "";

        // billing_address
        $this->billing_address->LinkCustomAttributes = "";
        $this->billing_address->HrefValue = "";
        $this->billing_address->TooltipValue = "";

        // billing_city
        $this->billing_city->LinkCustomAttributes = "";
        $this->billing_city->HrefValue = "";
        $this->billing_city->TooltipValue = "";

        // billing_state
        $this->billing_state->LinkCustomAttributes = "";
        $this->billing_state->HrefValue = "";
        $this->billing_state->TooltipValue = "";

        // billing_zip
        $this->billing_zip->LinkCustomAttributes = "";
        $this->billing_zip->HrefValue = "";
        $this->billing_zip->TooltipValue = "";

        // billing_method
        $this->billing_method->LinkCustomAttributes = "";
        $this->billing_method->HrefValue = "";
        $this->billing_method->TooltipValue = "";

        // billing_frs
        $this->billing_frs->LinkCustomAttributes = "";
        $this->billing_frs->HrefValue = "";
        $this->billing_frs->TooltipValue = "";

        // event_title
        $this->event_title->LinkCustomAttributes = "";
        $this->event_title->HrefValue = "";
        $this->event_title->TooltipValue = "";

        // event_type
        $this->event_type->LinkCustomAttributes = "";
        $this->event_type->HrefValue = "";
        $this->event_type->TooltipValue = "";

        // event_date
        $this->event_date->LinkCustomAttributes = "";
        $this->event_date->HrefValue = "";
        $this->event_date->TooltipValue = "";

        // event_time_start
        $this->event_time_start->LinkCustomAttributes = "";
        $this->event_time_start->HrefValue = "";
        $this->event_time_start->TooltipValue = "";

        // event_time_end
        $this->event_time_end->LinkCustomAttributes = "";
        $this->event_time_end->HrefValue = "";
        $this->event_time_end->TooltipValue = "";

        // event_num_people
        $this->event_num_people->LinkCustomAttributes = "";
        $this->event_num_people->HrefValue = "";
        $this->event_num_people->TooltipValue = "";

        // event_room_preference
        $this->event_room_preference->LinkCustomAttributes = "";
        $this->event_room_preference->HrefValue = "";
        $this->event_room_preference->TooltipValue = "";

        // recurring_jan
        $this->recurring_jan->LinkCustomAttributes = "";
        $this->recurring_jan->HrefValue = "";
        $this->recurring_jan->TooltipValue = "";

        // recurring_feb
        $this->recurring_feb->LinkCustomAttributes = "";
        $this->recurring_feb->HrefValue = "";
        $this->recurring_feb->TooltipValue = "";

        // recurring_mar
        $this->recurring_mar->LinkCustomAttributes = "";
        $this->recurring_mar->HrefValue = "";
        $this->recurring_mar->TooltipValue = "";

        // recurring_apr
        $this->recurring_apr->LinkCustomAttributes = "";
        $this->recurring_apr->HrefValue = "";
        $this->recurring_apr->TooltipValue = "";

        // recurring_may
        $this->recurring_may->LinkCustomAttributes = "";
        $this->recurring_may->HrefValue = "";
        $this->recurring_may->TooltipValue = "";

        // recurring_jun
        $this->recurring_jun->LinkCustomAttributes = "";
        $this->recurring_jun->HrefValue = "";
        $this->recurring_jun->TooltipValue = "";

        // recurring_jul
        $this->recurring_jul->LinkCustomAttributes = "";
        $this->recurring_jul->HrefValue = "";
        $this->recurring_jul->TooltipValue = "";

        // recurring_aug
        $this->recurring_aug->LinkCustomAttributes = "";
        $this->recurring_aug->HrefValue = "";
        $this->recurring_aug->TooltipValue = "";

        // recurring_sep
        $this->recurring_sep->LinkCustomAttributes = "";
        $this->recurring_sep->HrefValue = "";
        $this->recurring_sep->TooltipValue = "";

        // recurring_oct
        $this->recurring_oct->LinkCustomAttributes = "";
        $this->recurring_oct->HrefValue = "";
        $this->recurring_oct->TooltipValue = "";

        // recurring_nov
        $this->recurring_nov->LinkCustomAttributes = "";
        $this->recurring_nov->HrefValue = "";
        $this->recurring_nov->TooltipValue = "";

        // recurring_dec
        $this->recurring_dec->LinkCustomAttributes = "";
        $this->recurring_dec->HrefValue = "";
        $this->recurring_dec->TooltipValue = "";

        // setup_shape
        $this->setup_shape->LinkCustomAttributes = "";
        $this->setup_shape->HrefValue = "";
        $this->setup_shape->TooltipValue = "";

        // certification_name
        $this->certification_name->LinkCustomAttributes = "";
        $this->certification_name->HrefValue = "";
        $this->certification_name->TooltipValue = "";

        // certification_date
        $this->certification_date->LinkCustomAttributes = "";
        $this->certification_date->HrefValue = "";
        $this->certification_date->TooltipValue = "";

        // timestamp
        $this->timestamp->LinkCustomAttributes = "";
        $this->timestamp->HrefValue = "";
        $this->timestamp->TooltipValue = "";

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
        $this->id->EditAttrs["class"] = "form-control";
        $this->id->EditCustomAttributes = "";
        $this->id->EditValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // contact_org
        $this->contact_org->EditAttrs["class"] = "form-control";
        $this->contact_org->EditCustomAttributes = "";
        if (!$this->contact_org->Raw) {
            $this->contact_org->CurrentValue = HtmlDecode($this->contact_org->CurrentValue);
        }
        $this->contact_org->EditValue = $this->contact_org->CurrentValue;
        $this->contact_org->PlaceHolder = RemoveHtml($this->contact_org->caption());

        // contact_name
        $this->contact_name->EditAttrs["class"] = "form-control";
        $this->contact_name->EditCustomAttributes = "";
        if (!$this->contact_name->Raw) {
            $this->contact_name->CurrentValue = HtmlDecode($this->contact_name->CurrentValue);
        }
        $this->contact_name->EditValue = $this->contact_name->CurrentValue;
        $this->contact_name->PlaceHolder = RemoveHtml($this->contact_name->caption());

        // contact_email
        $this->contact_email->EditAttrs["class"] = "form-control";
        $this->contact_email->EditCustomAttributes = "";
        if (!$this->contact_email->Raw) {
            $this->contact_email->CurrentValue = HtmlDecode($this->contact_email->CurrentValue);
        }
        $this->contact_email->EditValue = $this->contact_email->CurrentValue;
        $this->contact_email->PlaceHolder = RemoveHtml($this->contact_email->caption());

        // contact_phone
        $this->contact_phone->EditAttrs["class"] = "form-control";
        $this->contact_phone->EditCustomAttributes = "";
        if (!$this->contact_phone->Raw) {
            $this->contact_phone->CurrentValue = HtmlDecode($this->contact_phone->CurrentValue);
        }
        $this->contact_phone->EditValue = $this->contact_phone->CurrentValue;
        $this->contact_phone->PlaceHolder = RemoveHtml($this->contact_phone->caption());

        // contact_fax
        $this->contact_fax->EditAttrs["class"] = "form-control";
        $this->contact_fax->EditCustomAttributes = "";
        if (!$this->contact_fax->Raw) {
            $this->contact_fax->CurrentValue = HtmlDecode($this->contact_fax->CurrentValue);
        }
        $this->contact_fax->EditValue = $this->contact_fax->CurrentValue;
        $this->contact_fax->PlaceHolder = RemoveHtml($this->contact_fax->caption());

        // contact_address
        $this->contact_address->EditAttrs["class"] = "form-control";
        $this->contact_address->EditCustomAttributes = "";
        if (!$this->contact_address->Raw) {
            $this->contact_address->CurrentValue = HtmlDecode($this->contact_address->CurrentValue);
        }
        $this->contact_address->EditValue = $this->contact_address->CurrentValue;
        $this->contact_address->PlaceHolder = RemoveHtml($this->contact_address->caption());

        // contact_city
        $this->contact_city->EditAttrs["class"] = "form-control";
        $this->contact_city->EditCustomAttributes = "";
        if (!$this->contact_city->Raw) {
            $this->contact_city->CurrentValue = HtmlDecode($this->contact_city->CurrentValue);
        }
        $this->contact_city->EditValue = $this->contact_city->CurrentValue;
        $this->contact_city->PlaceHolder = RemoveHtml($this->contact_city->caption());

        // contact_state
        $this->contact_state->EditAttrs["class"] = "form-control";
        $this->contact_state->EditCustomAttributes = "";
        if (!$this->contact_state->Raw) {
            $this->contact_state->CurrentValue = HtmlDecode($this->contact_state->CurrentValue);
        }
        $this->contact_state->EditValue = $this->contact_state->CurrentValue;
        $this->contact_state->PlaceHolder = RemoveHtml($this->contact_state->caption());

        // contact_zip
        $this->contact_zip->EditAttrs["class"] = "form-control";
        $this->contact_zip->EditCustomAttributes = "";
        if (!$this->contact_zip->Raw) {
            $this->contact_zip->CurrentValue = HtmlDecode($this->contact_zip->CurrentValue);
        }
        $this->contact_zip->EditValue = $this->contact_zip->CurrentValue;
        $this->contact_zip->PlaceHolder = RemoveHtml($this->contact_zip->caption());

        // contact_advisor
        $this->contact_advisor->EditAttrs["class"] = "form-control";
        $this->contact_advisor->EditCustomAttributes = "";
        if (!$this->contact_advisor->Raw) {
            $this->contact_advisor->CurrentValue = HtmlDecode($this->contact_advisor->CurrentValue);
        }
        $this->contact_advisor->EditValue = $this->contact_advisor->CurrentValue;
        $this->contact_advisor->PlaceHolder = RemoveHtml($this->contact_advisor->caption());

        // contact_advisor_phone
        $this->contact_advisor_phone->EditAttrs["class"] = "form-control";
        $this->contact_advisor_phone->EditCustomAttributes = "";
        if (!$this->contact_advisor_phone->Raw) {
            $this->contact_advisor_phone->CurrentValue = HtmlDecode($this->contact_advisor_phone->CurrentValue);
        }
        $this->contact_advisor_phone->EditValue = $this->contact_advisor_phone->CurrentValue;
        $this->contact_advisor_phone->PlaceHolder = RemoveHtml($this->contact_advisor_phone->caption());

        // contact_advisor_email
        $this->contact_advisor_email->EditAttrs["class"] = "form-control";
        $this->contact_advisor_email->EditCustomAttributes = "";
        if (!$this->contact_advisor_email->Raw) {
            $this->contact_advisor_email->CurrentValue = HtmlDecode($this->contact_advisor_email->CurrentValue);
        }
        $this->contact_advisor_email->EditValue = $this->contact_advisor_email->CurrentValue;
        $this->contact_advisor_email->PlaceHolder = RemoveHtml($this->contact_advisor_email->caption());

        // billing_org
        $this->billing_org->EditAttrs["class"] = "form-control";
        $this->billing_org->EditCustomAttributes = "";
        if (!$this->billing_org->Raw) {
            $this->billing_org->CurrentValue = HtmlDecode($this->billing_org->CurrentValue);
        }
        $this->billing_org->EditValue = $this->billing_org->CurrentValue;
        $this->billing_org->PlaceHolder = RemoveHtml($this->billing_org->caption());

        // billing_name
        $this->billing_name->EditAttrs["class"] = "form-control";
        $this->billing_name->EditCustomAttributes = "";
        if (!$this->billing_name->Raw) {
            $this->billing_name->CurrentValue = HtmlDecode($this->billing_name->CurrentValue);
        }
        $this->billing_name->EditValue = $this->billing_name->CurrentValue;
        $this->billing_name->PlaceHolder = RemoveHtml($this->billing_name->caption());

        // billing_email
        $this->billing_email->EditAttrs["class"] = "form-control";
        $this->billing_email->EditCustomAttributes = "";
        if (!$this->billing_email->Raw) {
            $this->billing_email->CurrentValue = HtmlDecode($this->billing_email->CurrentValue);
        }
        $this->billing_email->EditValue = $this->billing_email->CurrentValue;
        $this->billing_email->PlaceHolder = RemoveHtml($this->billing_email->caption());

        // billing_phone
        $this->billing_phone->EditAttrs["class"] = "form-control";
        $this->billing_phone->EditCustomAttributes = "";
        if (!$this->billing_phone->Raw) {
            $this->billing_phone->CurrentValue = HtmlDecode($this->billing_phone->CurrentValue);
        }
        $this->billing_phone->EditValue = $this->billing_phone->CurrentValue;
        $this->billing_phone->PlaceHolder = RemoveHtml($this->billing_phone->caption());

        // billing_fax
        $this->billing_fax->EditAttrs["class"] = "form-control";
        $this->billing_fax->EditCustomAttributes = "";
        if (!$this->billing_fax->Raw) {
            $this->billing_fax->CurrentValue = HtmlDecode($this->billing_fax->CurrentValue);
        }
        $this->billing_fax->EditValue = $this->billing_fax->CurrentValue;
        $this->billing_fax->PlaceHolder = RemoveHtml($this->billing_fax->caption());

        // billing_address
        $this->billing_address->EditAttrs["class"] = "form-control";
        $this->billing_address->EditCustomAttributes = "";
        if (!$this->billing_address->Raw) {
            $this->billing_address->CurrentValue = HtmlDecode($this->billing_address->CurrentValue);
        }
        $this->billing_address->EditValue = $this->billing_address->CurrentValue;
        $this->billing_address->PlaceHolder = RemoveHtml($this->billing_address->caption());

        // billing_city
        $this->billing_city->EditAttrs["class"] = "form-control";
        $this->billing_city->EditCustomAttributes = "";
        if (!$this->billing_city->Raw) {
            $this->billing_city->CurrentValue = HtmlDecode($this->billing_city->CurrentValue);
        }
        $this->billing_city->EditValue = $this->billing_city->CurrentValue;
        $this->billing_city->PlaceHolder = RemoveHtml($this->billing_city->caption());

        // billing_state
        $this->billing_state->EditAttrs["class"] = "form-control";
        $this->billing_state->EditCustomAttributes = "";
        if (!$this->billing_state->Raw) {
            $this->billing_state->CurrentValue = HtmlDecode($this->billing_state->CurrentValue);
        }
        $this->billing_state->EditValue = $this->billing_state->CurrentValue;
        $this->billing_state->PlaceHolder = RemoveHtml($this->billing_state->caption());

        // billing_zip
        $this->billing_zip->EditAttrs["class"] = "form-control";
        $this->billing_zip->EditCustomAttributes = "";
        if (!$this->billing_zip->Raw) {
            $this->billing_zip->CurrentValue = HtmlDecode($this->billing_zip->CurrentValue);
        }
        $this->billing_zip->EditValue = $this->billing_zip->CurrentValue;
        $this->billing_zip->PlaceHolder = RemoveHtml($this->billing_zip->caption());

        // billing_method
        $this->billing_method->EditAttrs["class"] = "form-control";
        $this->billing_method->EditCustomAttributes = "";
        if (!$this->billing_method->Raw) {
            $this->billing_method->CurrentValue = HtmlDecode($this->billing_method->CurrentValue);
        }
        $this->billing_method->EditValue = $this->billing_method->CurrentValue;
        $this->billing_method->PlaceHolder = RemoveHtml($this->billing_method->caption());

        // billing_frs
        $this->billing_frs->EditAttrs["class"] = "form-control";
        $this->billing_frs->EditCustomAttributes = "";
        if (!$this->billing_frs->Raw) {
            $this->billing_frs->CurrentValue = HtmlDecode($this->billing_frs->CurrentValue);
        }
        $this->billing_frs->EditValue = $this->billing_frs->CurrentValue;
        $this->billing_frs->PlaceHolder = RemoveHtml($this->billing_frs->caption());

        // event_title
        $this->event_title->EditAttrs["class"] = "form-control";
        $this->event_title->EditCustomAttributes = "";
        if (!$this->event_title->Raw) {
            $this->event_title->CurrentValue = HtmlDecode($this->event_title->CurrentValue);
        }
        $this->event_title->EditValue = $this->event_title->CurrentValue;
        $this->event_title->PlaceHolder = RemoveHtml($this->event_title->caption());

        // event_type
        $this->event_type->EditAttrs["class"] = "form-control";
        $this->event_type->EditCustomAttributes = "";
        if (!$this->event_type->Raw) {
            $this->event_type->CurrentValue = HtmlDecode($this->event_type->CurrentValue);
        }
        $this->event_type->EditValue = $this->event_type->CurrentValue;
        $this->event_type->PlaceHolder = RemoveHtml($this->event_type->caption());

        // event_date
        $this->event_date->EditAttrs["class"] = "form-control";
        $this->event_date->EditCustomAttributes = "";
        $this->event_date->EditValue = FormatDateTime($this->event_date->CurrentValue, 8);
        $this->event_date->PlaceHolder = RemoveHtml($this->event_date->caption());

        // event_time_start
        $this->event_time_start->EditAttrs["class"] = "form-control";
        $this->event_time_start->EditCustomAttributes = "";
        if (!$this->event_time_start->Raw) {
            $this->event_time_start->CurrentValue = HtmlDecode($this->event_time_start->CurrentValue);
        }
        $this->event_time_start->EditValue = $this->event_time_start->CurrentValue;
        $this->event_time_start->PlaceHolder = RemoveHtml($this->event_time_start->caption());

        // event_time_end
        $this->event_time_end->EditAttrs["class"] = "form-control";
        $this->event_time_end->EditCustomAttributes = "";
        if (!$this->event_time_end->Raw) {
            $this->event_time_end->CurrentValue = HtmlDecode($this->event_time_end->CurrentValue);
        }
        $this->event_time_end->EditValue = $this->event_time_end->CurrentValue;
        $this->event_time_end->PlaceHolder = RemoveHtml($this->event_time_end->caption());

        // event_num_people
        $this->event_num_people->EditAttrs["class"] = "form-control";
        $this->event_num_people->EditCustomAttributes = "";
        $this->event_num_people->EditValue = $this->event_num_people->CurrentValue;
        $this->event_num_people->PlaceHolder = RemoveHtml($this->event_num_people->caption());

        // event_room_preference
        $this->event_room_preference->EditAttrs["class"] = "form-control";
        $this->event_room_preference->EditCustomAttributes = "";
        if (!$this->event_room_preference->Raw) {
            $this->event_room_preference->CurrentValue = HtmlDecode($this->event_room_preference->CurrentValue);
        }
        $this->event_room_preference->EditValue = $this->event_room_preference->CurrentValue;
        $this->event_room_preference->PlaceHolder = RemoveHtml($this->event_room_preference->caption());

        // recurring_jan
        $this->recurring_jan->EditAttrs["class"] = "form-control";
        $this->recurring_jan->EditCustomAttributes = "";
        if (!$this->recurring_jan->Raw) {
            $this->recurring_jan->CurrentValue = HtmlDecode($this->recurring_jan->CurrentValue);
        }
        $this->recurring_jan->EditValue = $this->recurring_jan->CurrentValue;
        $this->recurring_jan->PlaceHolder = RemoveHtml($this->recurring_jan->caption());

        // recurring_feb
        $this->recurring_feb->EditAttrs["class"] = "form-control";
        $this->recurring_feb->EditCustomAttributes = "";
        if (!$this->recurring_feb->Raw) {
            $this->recurring_feb->CurrentValue = HtmlDecode($this->recurring_feb->CurrentValue);
        }
        $this->recurring_feb->EditValue = $this->recurring_feb->CurrentValue;
        $this->recurring_feb->PlaceHolder = RemoveHtml($this->recurring_feb->caption());

        // recurring_mar
        $this->recurring_mar->EditAttrs["class"] = "form-control";
        $this->recurring_mar->EditCustomAttributes = "";
        if (!$this->recurring_mar->Raw) {
            $this->recurring_mar->CurrentValue = HtmlDecode($this->recurring_mar->CurrentValue);
        }
        $this->recurring_mar->EditValue = $this->recurring_mar->CurrentValue;
        $this->recurring_mar->PlaceHolder = RemoveHtml($this->recurring_mar->caption());

        // recurring_apr
        $this->recurring_apr->EditAttrs["class"] = "form-control";
        $this->recurring_apr->EditCustomAttributes = "";
        if (!$this->recurring_apr->Raw) {
            $this->recurring_apr->CurrentValue = HtmlDecode($this->recurring_apr->CurrentValue);
        }
        $this->recurring_apr->EditValue = $this->recurring_apr->CurrentValue;
        $this->recurring_apr->PlaceHolder = RemoveHtml($this->recurring_apr->caption());

        // recurring_may
        $this->recurring_may->EditAttrs["class"] = "form-control";
        $this->recurring_may->EditCustomAttributes = "";
        if (!$this->recurring_may->Raw) {
            $this->recurring_may->CurrentValue = HtmlDecode($this->recurring_may->CurrentValue);
        }
        $this->recurring_may->EditValue = $this->recurring_may->CurrentValue;
        $this->recurring_may->PlaceHolder = RemoveHtml($this->recurring_may->caption());

        // recurring_jun
        $this->recurring_jun->EditAttrs["class"] = "form-control";
        $this->recurring_jun->EditCustomAttributes = "";
        if (!$this->recurring_jun->Raw) {
            $this->recurring_jun->CurrentValue = HtmlDecode($this->recurring_jun->CurrentValue);
        }
        $this->recurring_jun->EditValue = $this->recurring_jun->CurrentValue;
        $this->recurring_jun->PlaceHolder = RemoveHtml($this->recurring_jun->caption());

        // recurring_jul
        $this->recurring_jul->EditAttrs["class"] = "form-control";
        $this->recurring_jul->EditCustomAttributes = "";
        if (!$this->recurring_jul->Raw) {
            $this->recurring_jul->CurrentValue = HtmlDecode($this->recurring_jul->CurrentValue);
        }
        $this->recurring_jul->EditValue = $this->recurring_jul->CurrentValue;
        $this->recurring_jul->PlaceHolder = RemoveHtml($this->recurring_jul->caption());

        // recurring_aug
        $this->recurring_aug->EditAttrs["class"] = "form-control";
        $this->recurring_aug->EditCustomAttributes = "";
        if (!$this->recurring_aug->Raw) {
            $this->recurring_aug->CurrentValue = HtmlDecode($this->recurring_aug->CurrentValue);
        }
        $this->recurring_aug->EditValue = $this->recurring_aug->CurrentValue;
        $this->recurring_aug->PlaceHolder = RemoveHtml($this->recurring_aug->caption());

        // recurring_sep
        $this->recurring_sep->EditAttrs["class"] = "form-control";
        $this->recurring_sep->EditCustomAttributes = "";
        if (!$this->recurring_sep->Raw) {
            $this->recurring_sep->CurrentValue = HtmlDecode($this->recurring_sep->CurrentValue);
        }
        $this->recurring_sep->EditValue = $this->recurring_sep->CurrentValue;
        $this->recurring_sep->PlaceHolder = RemoveHtml($this->recurring_sep->caption());

        // recurring_oct
        $this->recurring_oct->EditAttrs["class"] = "form-control";
        $this->recurring_oct->EditCustomAttributes = "";
        if (!$this->recurring_oct->Raw) {
            $this->recurring_oct->CurrentValue = HtmlDecode($this->recurring_oct->CurrentValue);
        }
        $this->recurring_oct->EditValue = $this->recurring_oct->CurrentValue;
        $this->recurring_oct->PlaceHolder = RemoveHtml($this->recurring_oct->caption());

        // recurring_nov
        $this->recurring_nov->EditAttrs["class"] = "form-control";
        $this->recurring_nov->EditCustomAttributes = "";
        if (!$this->recurring_nov->Raw) {
            $this->recurring_nov->CurrentValue = HtmlDecode($this->recurring_nov->CurrentValue);
        }
        $this->recurring_nov->EditValue = $this->recurring_nov->CurrentValue;
        $this->recurring_nov->PlaceHolder = RemoveHtml($this->recurring_nov->caption());

        // recurring_dec
        $this->recurring_dec->EditAttrs["class"] = "form-control";
        $this->recurring_dec->EditCustomAttributes = "";
        if (!$this->recurring_dec->Raw) {
            $this->recurring_dec->CurrentValue = HtmlDecode($this->recurring_dec->CurrentValue);
        }
        $this->recurring_dec->EditValue = $this->recurring_dec->CurrentValue;
        $this->recurring_dec->PlaceHolder = RemoveHtml($this->recurring_dec->caption());

        // setup_shape
        $this->setup_shape->EditAttrs["class"] = "form-control";
        $this->setup_shape->EditCustomAttributes = "";
        if (!$this->setup_shape->Raw) {
            $this->setup_shape->CurrentValue = HtmlDecode($this->setup_shape->CurrentValue);
        }
        $this->setup_shape->EditValue = $this->setup_shape->CurrentValue;
        $this->setup_shape->PlaceHolder = RemoveHtml($this->setup_shape->caption());

        // certification_name
        $this->certification_name->EditAttrs["class"] = "form-control";
        $this->certification_name->EditCustomAttributes = "";
        if (!$this->certification_name->Raw) {
            $this->certification_name->CurrentValue = HtmlDecode($this->certification_name->CurrentValue);
        }
        $this->certification_name->EditValue = $this->certification_name->CurrentValue;
        $this->certification_name->PlaceHolder = RemoveHtml($this->certification_name->caption());

        // certification_date
        $this->certification_date->EditAttrs["class"] = "form-control";
        $this->certification_date->EditCustomAttributes = "";
        $this->certification_date->EditValue = FormatDateTime($this->certification_date->CurrentValue, 8);
        $this->certification_date->PlaceHolder = RemoveHtml($this->certification_date->caption());

        // timestamp
        $this->timestamp->EditAttrs["class"] = "form-control";
        $this->timestamp->EditCustomAttributes = "";
        $this->timestamp->EditValue = FormatDateTime($this->timestamp->CurrentValue, 8);
        $this->timestamp->PlaceHolder = RemoveHtml($this->timestamp->caption());

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
                    $doc->exportCaption($this->contact_org);
                    $doc->exportCaption($this->contact_name);
                    $doc->exportCaption($this->contact_email);
                    $doc->exportCaption($this->contact_phone);
                    $doc->exportCaption($this->contact_fax);
                    $doc->exportCaption($this->contact_address);
                    $doc->exportCaption($this->contact_city);
                    $doc->exportCaption($this->contact_state);
                    $doc->exportCaption($this->contact_zip);
                    $doc->exportCaption($this->contact_advisor);
                    $doc->exportCaption($this->contact_advisor_phone);
                    $doc->exportCaption($this->contact_advisor_email);
                    $doc->exportCaption($this->billing_org);
                    $doc->exportCaption($this->billing_name);
                    $doc->exportCaption($this->billing_email);
                    $doc->exportCaption($this->billing_phone);
                    $doc->exportCaption($this->billing_fax);
                    $doc->exportCaption($this->billing_address);
                    $doc->exportCaption($this->billing_city);
                    $doc->exportCaption($this->billing_state);
                    $doc->exportCaption($this->billing_zip);
                    $doc->exportCaption($this->billing_method);
                    $doc->exportCaption($this->billing_frs);
                    $doc->exportCaption($this->event_title);
                    $doc->exportCaption($this->event_type);
                    $doc->exportCaption($this->event_date);
                    $doc->exportCaption($this->event_time_start);
                    $doc->exportCaption($this->event_time_end);
                    $doc->exportCaption($this->event_num_people);
                    $doc->exportCaption($this->event_room_preference);
                    $doc->exportCaption($this->recurring_jan);
                    $doc->exportCaption($this->recurring_feb);
                    $doc->exportCaption($this->recurring_mar);
                    $doc->exportCaption($this->recurring_apr);
                    $doc->exportCaption($this->recurring_may);
                    $doc->exportCaption($this->recurring_jun);
                    $doc->exportCaption($this->recurring_jul);
                    $doc->exportCaption($this->recurring_aug);
                    $doc->exportCaption($this->recurring_sep);
                    $doc->exportCaption($this->recurring_oct);
                    $doc->exportCaption($this->recurring_nov);
                    $doc->exportCaption($this->recurring_dec);
                    $doc->exportCaption($this->setup_shape);
                    $doc->exportCaption($this->certification_name);
                    $doc->exportCaption($this->certification_date);
                    $doc->exportCaption($this->timestamp);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->contact_org);
                    $doc->exportCaption($this->contact_name);
                    $doc->exportCaption($this->contact_email);
                    $doc->exportCaption($this->contact_phone);
                    $doc->exportCaption($this->contact_fax);
                    $doc->exportCaption($this->contact_address);
                    $doc->exportCaption($this->contact_city);
                    $doc->exportCaption($this->contact_state);
                    $doc->exportCaption($this->contact_zip);
                    $doc->exportCaption($this->contact_advisor);
                    $doc->exportCaption($this->contact_advisor_phone);
                    $doc->exportCaption($this->contact_advisor_email);
                    $doc->exportCaption($this->billing_org);
                    $doc->exportCaption($this->billing_name);
                    $doc->exportCaption($this->billing_email);
                    $doc->exportCaption($this->billing_phone);
                    $doc->exportCaption($this->billing_fax);
                    $doc->exportCaption($this->billing_address);
                    $doc->exportCaption($this->billing_city);
                    $doc->exportCaption($this->billing_state);
                    $doc->exportCaption($this->billing_zip);
                    $doc->exportCaption($this->billing_method);
                    $doc->exportCaption($this->billing_frs);
                    $doc->exportCaption($this->event_title);
                    $doc->exportCaption($this->event_type);
                    $doc->exportCaption($this->event_date);
                    $doc->exportCaption($this->event_time_start);
                    $doc->exportCaption($this->event_time_end);
                    $doc->exportCaption($this->event_num_people);
                    $doc->exportCaption($this->event_room_preference);
                    $doc->exportCaption($this->recurring_jan);
                    $doc->exportCaption($this->recurring_feb);
                    $doc->exportCaption($this->recurring_mar);
                    $doc->exportCaption($this->recurring_apr);
                    $doc->exportCaption($this->recurring_may);
                    $doc->exportCaption($this->recurring_jun);
                    $doc->exportCaption($this->recurring_jul);
                    $doc->exportCaption($this->recurring_aug);
                    $doc->exportCaption($this->recurring_sep);
                    $doc->exportCaption($this->recurring_oct);
                    $doc->exportCaption($this->recurring_nov);
                    $doc->exportCaption($this->recurring_dec);
                    $doc->exportCaption($this->setup_shape);
                    $doc->exportCaption($this->certification_name);
                    $doc->exportCaption($this->certification_date);
                    $doc->exportCaption($this->timestamp);
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
                        $doc->exportField($this->contact_org);
                        $doc->exportField($this->contact_name);
                        $doc->exportField($this->contact_email);
                        $doc->exportField($this->contact_phone);
                        $doc->exportField($this->contact_fax);
                        $doc->exportField($this->contact_address);
                        $doc->exportField($this->contact_city);
                        $doc->exportField($this->contact_state);
                        $doc->exportField($this->contact_zip);
                        $doc->exportField($this->contact_advisor);
                        $doc->exportField($this->contact_advisor_phone);
                        $doc->exportField($this->contact_advisor_email);
                        $doc->exportField($this->billing_org);
                        $doc->exportField($this->billing_name);
                        $doc->exportField($this->billing_email);
                        $doc->exportField($this->billing_phone);
                        $doc->exportField($this->billing_fax);
                        $doc->exportField($this->billing_address);
                        $doc->exportField($this->billing_city);
                        $doc->exportField($this->billing_state);
                        $doc->exportField($this->billing_zip);
                        $doc->exportField($this->billing_method);
                        $doc->exportField($this->billing_frs);
                        $doc->exportField($this->event_title);
                        $doc->exportField($this->event_type);
                        $doc->exportField($this->event_date);
                        $doc->exportField($this->event_time_start);
                        $doc->exportField($this->event_time_end);
                        $doc->exportField($this->event_num_people);
                        $doc->exportField($this->event_room_preference);
                        $doc->exportField($this->recurring_jan);
                        $doc->exportField($this->recurring_feb);
                        $doc->exportField($this->recurring_mar);
                        $doc->exportField($this->recurring_apr);
                        $doc->exportField($this->recurring_may);
                        $doc->exportField($this->recurring_jun);
                        $doc->exportField($this->recurring_jul);
                        $doc->exportField($this->recurring_aug);
                        $doc->exportField($this->recurring_sep);
                        $doc->exportField($this->recurring_oct);
                        $doc->exportField($this->recurring_nov);
                        $doc->exportField($this->recurring_dec);
                        $doc->exportField($this->setup_shape);
                        $doc->exportField($this->certification_name);
                        $doc->exportField($this->certification_date);
                        $doc->exportField($this->timestamp);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->contact_org);
                        $doc->exportField($this->contact_name);
                        $doc->exportField($this->contact_email);
                        $doc->exportField($this->contact_phone);
                        $doc->exportField($this->contact_fax);
                        $doc->exportField($this->contact_address);
                        $doc->exportField($this->contact_city);
                        $doc->exportField($this->contact_state);
                        $doc->exportField($this->contact_zip);
                        $doc->exportField($this->contact_advisor);
                        $doc->exportField($this->contact_advisor_phone);
                        $doc->exportField($this->contact_advisor_email);
                        $doc->exportField($this->billing_org);
                        $doc->exportField($this->billing_name);
                        $doc->exportField($this->billing_email);
                        $doc->exportField($this->billing_phone);
                        $doc->exportField($this->billing_fax);
                        $doc->exportField($this->billing_address);
                        $doc->exportField($this->billing_city);
                        $doc->exportField($this->billing_state);
                        $doc->exportField($this->billing_zip);
                        $doc->exportField($this->billing_method);
                        $doc->exportField($this->billing_frs);
                        $doc->exportField($this->event_title);
                        $doc->exportField($this->event_type);
                        $doc->exportField($this->event_date);
                        $doc->exportField($this->event_time_start);
                        $doc->exportField($this->event_time_end);
                        $doc->exportField($this->event_num_people);
                        $doc->exportField($this->event_room_preference);
                        $doc->exportField($this->recurring_jan);
                        $doc->exportField($this->recurring_feb);
                        $doc->exportField($this->recurring_mar);
                        $doc->exportField($this->recurring_apr);
                        $doc->exportField($this->recurring_may);
                        $doc->exportField($this->recurring_jun);
                        $doc->exportField($this->recurring_jul);
                        $doc->exportField($this->recurring_aug);
                        $doc->exportField($this->recurring_sep);
                        $doc->exportField($this->recurring_oct);
                        $doc->exportField($this->recurring_nov);
                        $doc->exportField($this->recurring_dec);
                        $doc->exportField($this->setup_shape);
                        $doc->exportField($this->certification_name);
                        $doc->exportField($this->certification_date);
                        $doc->exportField($this->timestamp);
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
        //var_dump($email); var_dump($args); exit();
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
