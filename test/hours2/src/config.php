<?php

/**
 * PHPMaker 2022 configuration file
 */

namespace PHPMaker2022\project1;

/**
 * Locale settings
 * Note: If you want to use custom settings, customize the locale files.
*/
$DECIMAL_SEPARATOR = ".";
$GROUPING_SEPARATOR = ",";
$CURRENCY_CODE = "USD"; // => $
$CURRENCY_SYMBOL = "$";
$CURRENCY_FORMAT = "¤#,##0.00";
$NUMBER_FORMAT = "#,##0.###";
$PERCENT_SYMBOL = "%";
$PERCENT_FORMAT = "#,##0%";
$DATE_SEPARATOR = "/";
$TIME_SEPARATOR = ":";
$DATE_FORMAT = "y/MM/dd";
$TIME_FORMAT = "HH:mm";
$TIME_ZONE = "UTC";

/**
 * Global variables
 */
$CONNECTIONS = []; // Connections
$LANGUAGES = [["en-us","","english.xml"]];
$Conn = null; // Primary connection
$Page = null; // Page
$UserTable = null; // User table
$Table = null; // Main table
$Grid = null; // Grid page object
$Language = null; // Language
$Security = null; // Security
$UserProfile = null; // User profile
$CurrentForm = null; // Form
$Session = null; // Session
$Title = null; // Title

// Current language
$CurrentLanguage = "";
$CurrentLocale = ""; // Alias of $CurrentLanguage

// Used by header.php, export checking
$ExportType = "";
$ExportFileName = "";
$ReportExportType = "";
$CustomExportType = "";

// Used by header.php/footer.php, skip header/footer checking
$SkipHeaderFooter = false;
$OldSkipHeaderFooter = $SkipHeaderFooter;

// Debug message
$DebugMessage = "";

// Debug timer
$DebugTimer = null;

// Keep temp image names for delete
$TempImages = [];

// Mobile detect
$MobileDetect = null;
$IsMobile = null;

// Breadcrumb
$Breadcrumb = null;

// Login status
$LoginStatus = [];

// LDAP
$Ldap = null;

// API
$IsApi = false;
$Request = null;
$Response = null;

// CSRF
$TokenName = null;
$TokenNameKey = null;
$TokenValue = null;
$TokenValueKey = null;

// Route values
$RouteValues = [];

// HTML Purifier
$PurifierConfig = \HTMLPurifier_Config::createDefault();
$Purifier = null;

// Captcha
$Captcha = null;
$CaptchaClass = "CaptchaBase";

// Dashboard report checking
$DashboardReport = false;

// Drilldown panel
$DrillDownInPanel = false;

// Chart
$Chart = null;

// Client variables
$ClientVariables = [];

// Error
$Error = null;

// Custom API actions
$API_ACTIONS = [];

// User level
require_once __DIR__ . "/userlevelsettings.php";

/**
 * Config
 */
$CONFIG = [

    // Debug
    "DEBUG" => false, // Enabled
    "REPORT_ALL_ERRORS" => false, // Treat PHP warnings and notices as errors
    "LOG_ERROR_TO_FILE" => false, // Log error to file
    "DEBUG_MESSAGE_TEMPLATE" => '<div class="card card-danger ew-debug"><div class="card-header">' .
        '<h3 class="card-title">%t</h3>' .
        '<div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>' .
        '</div><div class="card-body">%s</div></div>', // Debug message template

    // Environment
    "ENVIRONMENT" => "development",

    // Container
    "COMPILE_CONTAINER" => false,

    // Use route cache
    "USE_ROUTE_CACHE" => false,

    // General
    "UNFORMAT_YEAR" => 50, // Unformat year
    "RANDOM_KEY" => 'TztAkROVNsdiwP8Q', // Random key for encryption
    "ENCRYPTION_KEY" => '', // Encryption key for data protection
    "PROJECT_STYLESHEET_FILENAME" => "css/project1.css", // Project stylesheet file name
    "USE_COMPRESSED_STYLESHEET" => true, // Compressed stylesheet
    "PROJECT_CHARSET" => "utf-8", // Project charset
    "IS_UTF8" => true, // Project charset
    "EMAIL_CHARSET" => "utf-8", // Email charset
    "HIGHLIGHT_COMPARE" => true, // Highlight compare mode, true(case-insensitive)|false(case-sensitive)
    "RELATED_PROJECT_ID" => "", // Related Project ID (GUID)
    "COMPOSITE_KEY_SEPARATOR" => ",", // Composite key separator
    "CACHE" => false, // Cache
    "LAZY_LOAD" => true, // Lazy loading of images
    "BODY_CLASS" => "hold-transition layout-fixed",
    "SIDEBAR_CLASS" => "main-sidebar sidebar-dark-red",
    "NAVBAR_CLASS" => "main-header navbar navbar-expand navbar-red navbar-dark border-bottom-0",

    // Check Token
    "CHECK_TOKEN" => true,

    // Remove XSS
    "REMOVE_XSS" => true,

    // Model path
    "MODEL_PATH" => "models/", // With trailing delimiter

    // View path
    "VIEW_PATH" => "views/", // With trailing delimiter

    // Controller path
    "CONTROLLER_PATH" => "controllers/", // With trailing delimiter

    // Font path
    "FONT_PATH" => __DIR__ . "/../font", // No trailing delimiter

    // External JavaScripts
    "JAVASCRIPT_FILES" => [],

    // External StyleSheets
    "STYLESHEET_FILES" => [],

    // Authentication configuration for Google/Facebook
    "AUTH_CONFIG" => [
        "providers" => [
            "Google" => [
                "enabled" => false,
                "keys" => ["id" => "", "secret" => ""],
                "color" => "danger"
            ],
            "Facebook" => [
                "enabled" => false,
                "keys" => ["id" => "", "secret" => ""],
                "color" => "primary"
            ]
        ],
        "debug_mode" => false,
        "debug_file" => "",
        "curl_options" => null
    ],

    // ADODB (Access)
    "PROJECT_CODEPAGE" => 65001, // Code page

    /**
     * Database time zone
     * Difference to Greenwich time (GMT) with colon between hours and minutes, e.g. +02:00
     */
    "DB_TIME_ZONE" => "",

    /**
     * MySQL charset (for SET NAMES statement, not used by default)
     * Note: Read https://dev.mysql.com/doc/refman/8.0/en/charset-connection.html
     * before using this setting.
     */
    "MYSQL_CHARSET" => "utf8",

    /**
     * PostgreSQL charset (for SET NAMES statement, not used by default)
     * Note: Read https://www.postgresql.org/docs/current/static/multibyte.html
     * before using this setting.
     */
    "POSTGRESQL_CHARSET" => "UTF8",

    /**
     * Password (hashed and case-sensitivity)
     * Note: If you enable hashed password, make sure that the passwords in your
     * user table are stored as hash of the clear text password. If you also use
     * case-insensitive password, convert the clear text passwords to lower case
     * first before calculating hash. Otherwise, existing users will not be able
     * to login. Hashed password is irreversible, it will be reset during password recovery.
     */
    "ENCRYPTED_PASSWORD" => false, // Use encrypted password
    "CASE_SENSITIVE_PASSWORD" => false, // Case-sensitive password

    // Session timeout time
    "SESSION_TIMEOUT" => 0, // Session timeout time (minutes)

    // Session keep alive interval
    "SESSION_KEEP_ALIVE_INTERVAL" => 0, // Session keep alive interval (seconds)
    "SESSION_TIMEOUT_COUNTDOWN" => 60, // Session timeout count down interval (seconds)

    // Language settings
    "LANGUAGE_FOLDER" => __DIR__ . "/../lang/",
    "LANGUAGE_DEFAULT_ID" => "en-us",
    "LOCALE_FOLDER" => __DIR__ . "/../locale/",
    "USE_TRANSACTION" => true,
    "CUSTOM_TEMPLATE_DATATYPES" => [DATATYPE_NUMBER, DATATYPE_DATE, DATATYPE_STRING, DATATYPE_BOOLEAN, DATATYPE_TIME], // Data to be passed to Custom Template
    "DATA_STRING_MAX_LENGTH" => 512,

    // Table parameters
    "TABLE_PREFIX" => "||PHPReportMaker||", // For backward compatibility only
    "TABLE_REC_PER_PAGE" => "recperpage", // Records per page
    "TABLE_START_REC" => "start", // Start record
    "TABLE_PAGE_NO" => "pageno", // Page number
    "TABLE_BASIC_SEARCH" => "psearch", // Basic search keyword
    "TABLE_BASIC_SEARCH_TYPE" => "psearchtype", // Basic search type
    "TABLE_ADVANCED_SEARCH" => "advsrch", // Advanced search
    "TABLE_SEARCH_WHERE" => "searchwhere", // Search where clause
    "TABLE_WHERE" => "where", // Table where
    "TABLE_WHERE_LIST" => "where_list", // Table where (list page)
    "TABLE_ORDER_BY" => "orderby", // Table order by
    "TABLE_ORDER_BY_LIST" => "orderby_list", // Table order by (list page)
    "TABLE_SORT" => "sort", // Table sort
    "TABLE_KEY" => "key", // Table key
    "TABLE_SHOW_MASTER" => "showmaster", // Table show master
    "TABLE_MASTER" => "master", // Table show master (alternate key)
    "TABLE_SHOW_DETAIL" => "showdetail", // Table show detail
    "TABLE_MASTER_TABLE" => "mastertable", // Master table
    "TABLE_DETAIL_TABLE" => "detailtable", // Detail table
    "TABLE_RETURN_URL" => "return", // Return URL
    "TABLE_EXPORT_RETURN_URL" => "exportreturn", // Export return URL
    "TABLE_GRID_ADD_ROW_COUNT" => "gridaddcnt", // Grid add row count

    // Page layout
    "PAGE_LAYOUT" => "layout", // Page layout (string|false)
    "PAGE_LAYOUTS" => ["table", "cards"], // Supported page layouts

    // Audit Trail
    "AUDIT_TRAIL_TO_DATABASE" => false, // Write audit trail to DB
    "AUDIT_TRAIL_DBID" => "DB", // Audit trail DBID
    "AUDIT_TRAIL_TABLE_NAME" => "", // Audit trail table name
    "AUDIT_TRAIL_TABLE_VAR" => "", // Audit trail table var
    "AUDIT_TRAIL_FIELD_NAME_DATETIME" => "", // Audit trail DateTime field name
    "AUDIT_TRAIL_FIELD_NAME_SCRIPT" => "", // Audit trail Script field name
    "AUDIT_TRAIL_FIELD_NAME_USER" => "", // Audit trail User field name
    "AUDIT_TRAIL_FIELD_NAME_ACTION" => "", // Audit trail Action field name
    "AUDIT_TRAIL_FIELD_NAME_TABLE" => "", // Audit trail Table field name
    "AUDIT_TRAIL_FIELD_NAME_FIELD" => "", // Audit trail Field field name
    "AUDIT_TRAIL_FIELD_NAME_KEYVALUE" => "", // Audit trail Key Value field name
    "AUDIT_TRAIL_FIELD_NAME_OLDVALUE" => "", // Audit trail Old Value field name
    "AUDIT_TRAIL_FIELD_NAME_NEWVALUE" => "", // Audit trail New Value field name

    // Security
    "CSRF_PREFIX" => "csrf",
    "ENCRYPTION_ENABLED" => false, // Encryption enabled
    "ADMIN_USER_NAME" => "", // Administrator user name
    "ADMIN_PASSWORD" => "", // Administrator password
    "USE_CUSTOM_LOGIN" => true, // Use custom login
    "ALLOW_LOGIN_BY_URL" => false, // Allow login by URL
    "ALLOW_LOGIN_BY_SESSION" => false, // Allow login by session variables
    "PHPASS_ITERATION_COUNT_LOG2" => [10, 8], // For PasswordHash
    "PASSWORD_HASH" => false, // Use PHP password hashing functions
    "USE_MODAL_LOGIN" => false, // Use modal login
    "USE_MODAL_REGISTER" => false, // Use modal register
    "USE_MODAL_CHANGE_PASSWORD" => false, // Use modal change password
    "USE_MODAL_RESET_PASSWORD" => false, // Use modal reset password

    // Default User ID allowed permissions
    "DEFAULT_USER_ID_ALLOW_SECURITY" => 360,

    // User table/field names
    "USER_TABLE_NAME" => "",
    "LOGIN_USERNAME_FIELD_NAME" => "",
    "LOGIN_PASSWORD_FIELD_NAME" => "",
    "USER_ID_FIELD_NAME" => "",
    "PARENT_USER_ID_FIELD_NAME" => "",
    "USER_LEVEL_FIELD_NAME" => "",
    "USER_PROFILE_FIELD_NAME" => "",
    "REGISTER_ACTIVATE_FIELD_NAME" => "",
    "USER_EMAIL_FIELD_NAME" => "",
    "USER_IMAGE_FIELD_NAME" => "",
    "USER_IMAGE_SIZE" => 40,
    "USER_IMAGE_CROP" => true,

    // User table filters
    "USER_TABLE_DBID" => "",
    "USER_TABLE" => "",
    "USER_NAME_FILTER" => "",
    "USER_ID_FILTER" => "",
    "USER_EMAIL_FILTER" => "",
    "USER_ACTIVATE_FILTER" => "",

    // User profile constants
    "USER_PROFILE_SESSION_ID" => "SessionID",
    "USER_PROFILE_LAST_ACCESSED_DATE_TIME" => "LastAccessedDateTime",
    "USER_PROFILE_CONCURRENT_SESSION_COUNT" => 1, // Maximum sessions allowed
    "USER_PROFILE_SESSION_TIMEOUT" => 20,
    "USER_PROFILE_LOGIN_RETRY_COUNT" => "LoginRetryCount",
    "USER_PROFILE_LAST_BAD_LOGIN_DATE_TIME" => "LastBadLoginDateTime",
    "USER_PROFILE_MAX_RETRY" => 3,
    "USER_PROFILE_RETRY_LOCKOUT" => 20,
    "USER_PROFILE_LAST_PASSWORD_CHANGED_DATE" => "LastPasswordChangedDate",
    "USER_PROFILE_PASSWORD_EXPIRE" => 90,
    "USER_PROFILE_LANGUAGE_ID" => "LanguageId",
    "USER_PROFILE_SEARCH_FILTERS" => "SearchFilters",
    "SEARCH_FILTER_OPTION" => "Client",
    "USER_PROFILE_SECRET" => "Secret",
    "USER_PROFILE_SECRET_CREATE_DATE_TIME" => "SecretCreateDateTime",
    "USER_PROFILE_SECRET_VERIFY_DATE_TIME" => "SecretVerifyDateTime",
    "USER_PROFILE_SECRET_LAST_VERIFY_CODE" => "SecretLastVerifyCode",
    "USER_PROFILE_BACKUP_CODES" => "BackupCodes",
    "USER_PROFILE_IMAGE" => "UserImage",

    // Email
    "SENDER_EMAIL" => "", // Sender email address
    "RECIPIENT_EMAIL" => "", // Recipient email address
    "MAX_EMAIL_RECIPIENT" => 3,
    "MAX_EMAIL_SENT_COUNT" => 3,
    "EXPORT_EMAIL_COUNTER" => SESSION_STATUS . "_EmailCounter",
    "EMAIL_CHANGE_PASSWORD_TEMPLATE" => "changepassword.html",
    "EMAIL_NOTIFY_TEMPLATE" => "notify.html",
    "EMAIL_REGISTER_TEMPLATE" => "register.html",
    "EMAIL_RESET_PASSWORD_TEMPLATE" => "resetpassword.html",
    "EMAIL_TEMPLATE_PATH" => "html", // Template path

    // Remote file
    "REMOTE_FILE_PATTERN" => '/^((https?\:)?|s3:)\/\//i',

    // File upload
    "UPLOAD_TEMP_PATH" => "", // Upload temp path (absolute local physical path)
    "UPLOAD_TEMP_HREF_PATH" => "", // Upload temp href path (absolute URL path for download)
    "UPLOAD_DEST_PATH" => "files/", // Upload destination path (relative to app root)
    "UPLOAD_HREF_PATH" => "", // Upload file href path (URL for download)
    "UPLOAD_TEMP_FOLDER_PREFIX" => "temp__", // Upload temp folders prefix
    "UPLOAD_TEMP_FOLDER_TIME_LIMIT" => 1440, // Upload temp folder time limit (minutes)
    "UPLOAD_THUMBNAIL_FOLDER" => "thumbnail", // Temporary thumbnail folder
    "UPLOAD_THUMBNAIL_WIDTH" => 200, // Temporary thumbnail max width
    "UPLOAD_THUMBNAIL_HEIGHT" => 0, // Temporary thumbnail max height
    "UPLOAD_ALLOWED_FILE_EXT" => "gif,jpg,jpeg,bmp,png,doc,docx,xls,xlsx,pdf,zip", // Allowed file extensions
    "IMAGE_ALLOWED_FILE_EXT" => "gif,jpe,jpeg,jpg,png,bmp", // Allowed file extensions for images
    "DOWNLOAD_ALLOWED_FILE_EXT" => "csv,pdf,xls,doc,xlsx,docx", // Allowed file extensions for download (non-image)
    "ENCRYPT_FILE_PATH" => true, // Encrypt file path
    "MAX_FILE_SIZE" => 2000000, // Max file size
    "MAX_FILE_COUNT" => 0, // Max file count
    "THUMBNAIL_DEFAULT_WIDTH" => 100, // Thumbnail default width
    "THUMBNAIL_DEFAULT_HEIGHT" => 0, // Thumbnail default height
    "UPLOADED_FILE_MODE" => 0666, // Uploaded file mode
    "USER_UPLOAD_TEMP_PATH" => "", // User upload temp path (relative to app root) e.g. "tmp/"
    "UPLOAD_CONVERT_ACCENTED_CHARS" => false, // Convert accented chars in upload file name
    "USE_COLORBOX" => true, // Use Colorbox
    "MULTIPLE_UPLOAD_SEPARATOR" => ",", // Multiple upload separator
    "DELETE_UPLOADED_FILES" => false, // Delete uploaded file on deleting record
    "FILE_NOT_FOUND" => "/9j/4AAQSkZJRgABAQAAAQABAAD/7QAuUGhvdG9zaG9wIDMuMAA4QklNBAQAAAAAABIcAigADEZpbGVOb3RGb3VuZAD/2wBDAAgGBgcGBQgHBwcJCQgKDBQNDAsLDBkSEw8UHRofHh0aHBwgJC4nICIsIxwcKDcpLDAxNDQ0Hyc5PTgyPC4zNDL/2wBDAQkJCQwLDBgNDRgyIRwhMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjL/wgARCAABAAEDAREAAhEBAxEB/8QAFAABAAAAAAAAAAAAAAAAAAAACP/EABQBAQAAAAAAAAAAAAAAAAAAAAD/2gAMAwEAAhADEAAAAD+f/8QAFBABAAAAAAAAAAAAAAAAAAAAAP/aAAgBAQABPwB//8QAFBEBAAAAAAAAAAAAAAAAAAAAAP/aAAgBAgEBPwB//8QAFBEBAAAAAAAAAAAAAAAAAAAAAP/aAAgBAwEBPwB//9k=", // 1x1 jpeg with IPTC data "2#040"="FileNotFound"

    // Save file options
    "SAVE_FILE_OPTIONS" => LOCK_EX,

    // Table actions
    "LIST_ACTION" => "list", // Table list action
    "VIEW_ACTION" => "view", // Table view action
    "ADD_ACTION" => "add", // Table add action
    "ADDOPT_ACTION" => "addopt", // Table addopt action
    "EDIT_ACTION" => "edit", // Table edit action
    "UPDATE_ACTION" => "update", // Table update action
    "DELETE_ACTION" => "delete", // Table delete action
    "SEARCH_ACTION" => "search", // Table search action
    "PREVIEW_ACTION" => "preview", // Table preview action
    "CUSTOM_REPORT_ACTION" => "custom", // Custom report action
    "SUMMARY_REPORT_ACTION" => "summary", // Summary report action
    "CROSSTAB_REPORT_ACTION" => "crosstab", // Crosstab report action
    "DASHBOARD_REPORT_ACTION" => "dashboard", // Dashboard report action

    // Swagger
    "SWAGGER_ACTION" => "swagger/swagger", // API swagger action
    "API_VERSION" => "v1", // API version for swagger

    // API
    "API_URL" => "api/", // API accessor URL
    "API_ACTION_NAME" => "action", // API action name
    "API_OBJECT_NAME" => "table", // API object name
    "API_FIELD_NAME" => "field", // API field name
    "API_KEY_NAME" => "key", // API key name
    "API_FILE_TOKEN_NAME" => "filetoken", // API upload file token name
    "API_LOGIN_USERNAME" => "username", // API login user name
    "API_LOGIN_PASSWORD" => "password", // API login password
    "API_LOGIN_SECURITY_CODE" => "securitycode", // API login security code
    "API_LOOKUP_PAGE" => "page", // API lookup page name
    "API_USERLEVEL_NAME" => "userlevel", // API userlevel name
    "API_PUSH_NOTIFICATION_SUBSCRIBE" => "subscribe", // API push notification subscribe
    "API_PUSH_NOTIFICATION_SEND" => "send", // API push notification send
    "API_PUSH_NOTIFICATION_DELETE" => "delete", // API push notification delete
    "API_2FA_SHOW" => "show", // API two factor authentication show
    "API_2FA_VERIFY" => "verify", // API two factor authentication verify
    "API_2FA_RESET" => "reset", // API two factor authentication reset
    "API_2FA_BACKUP_CODES" => "codes", // API two factor authentication backup codes
    "API_2FA_NEW_BACKUP_CODES" => "newcodes", // API two factor authentication new backup codes

    // API actions
    "API_LIST_ACTION" => "list", // API list action
    "API_VIEW_ACTION" => "view", // API view action
    "API_ADD_ACTION" => "add", // API add action
    "API_REGISTER_ACTION" => "register", // API register action
    "API_EDIT_ACTION" => "edit", // API edit action
    "API_DELETE_ACTION" => "delete", // API delete action
    "API_LOGIN_ACTION" => "login", // API login action
    "API_FILE_ACTION" => "file", // API file action
    "API_UPLOAD_ACTION" => "upload", // API upload action
    "API_JQUERY_UPLOAD_ACTION" => "jupload", // API jQuery upload action
    "API_SESSION_ACTION" => "session", // API get session action
    "API_LOOKUP_ACTION" => "lookup", // API lookup action
    "API_PROGRESS_ACTION" => "progress", // API progress action
    "API_EXPORT_CHART_ACTION" => "chart", // API export chart action
    "API_PERMISSIONS_ACTION" => "permissions", // API permissions action
    "API_PUSH_NOTIFICATION_ACTION" => "push", // API push notification action
    "API_2FA_ACTION" => "2fa", // API two factor authentication action

    // Session-less API actions
    "SESSIONLESS_API_ACTIONS" => ["file"],

    // Send push notification time limit
    "SEND_PUSH_NOTIFICATION_TIME_LIMIT" => 300,
    "PUSH_ANONYMOUS" => false,

    // Use 2FA Authentication
    "USE_TWO_FACTOR_AUTHENTICATION" => false,
    "FORCE_TWO_FACTOR_AUTHENTICATION" => false,
    "TWO_FACTOR_AUTHENTICATION_ISSUER" => PROJECT_NAME,
    "TWO_FACTOR_AUTHENTICATION_DISCREPANCY" => 1,
    "TWO_FACTOR_AUTHENTICATION_QRCODE_SIZE" => 200,
    "TWO_FACTOR_AUTHENTICATION_PASS_CODE_LENGTH" => 6,
    "TWO_FACTOR_AUTHENTICATION_BACKUP_CODE_LENGTH" => 8,
    "TWO_FACTOR_AUTHENTICATION_BACKUP_CODE_COUNT" => 10,

    // Image resize
    "THUMBNAIL_CLASS" => "\PHPThumb\GD",
    "RESIZE_OPTIONS" => ["keepAspectRatio" => false, "resizeUp" => !true, "jpegQuality" => 100],

    // Audit trail
    "AUDIT_TRAIL_PATH" => "", // Audit trail path (relative to app root)

    // Import records
    "IMPORT_CSV_DELIMITER" => ",", // Import to CSV delimiter
    "IMPORT_CSV_QUOTE_CHARACTER" => "\"", // Import to CSV quote character
    "IMPORT_MAX_EXECUTION_TIME" => 300, // Import max execution time
    "IMPORT_FILE_ALLOWED_EXT" => "csv,xls,xlsx", // Import file allowed extensions
    "IMPORT_INSERT_ONLY" => true, // Import by insert only
    "IMPORT_USE_TRANSACTION" => false, // Import use transaction

    // Export records
    "EXPORT_ALL" => true, // Export all records
    "EXPORT_ALL_TIME_LIMIT" => 120, // Export all records time limit
    "XML_ENCODING" => "utf-8", // Encoding for Export to XML
    "EXPORT_ORIGINAL_VALUE" => false,
    "EXPORT_FIELD_CAPTION" => false, // true to export field caption
    "EXPORT_FIELD_IMAGE" => true, // true to export field image
    "EXPORT_CSS_STYLES" => true, // true to export CSS styles
    "EXPORT_MASTER_RECORD" => true, // true to export master record
    "EXPORT_MASTER_RECORD_FOR_CSV" => false, // true to export master record for CSV
    "EXPORT_DETAIL_RECORDS" => true, // true to export detail records
    "EXPORT_DETAIL_RECORDS_FOR_CSV" => false, // true to export detail records for CSV
    "EXPORT_CLASSES" => [
        "email" => "ExportEmail",
        "html" => "ExportHtml",
        "word" => "ExportWord",
        "excel" => "ExportExcel",
        "pdf" => "ExportPdf",
        "csv" => "ExportCsv",
        "xml" => "ExportXml",
        "json" => "ExportJson"
    ],

    // Full URL protocols ("http" or "https")
    "FULL_URL_PROTOCOLS" => [
        "href" => "", // Field hyperlink
        "upload" => "", // Upload page
        "resetpwd" => "", // Reset password
        "activate" => "", // Register page activate link
        "tmpfile" => "", // Upload temp file
        "auth" => "", // OAuth base URL
        "export" => "", // export (for reports)
        "genurl" => "" // generate URL (for reports)
    ],

    // MIME types
    "MIME_TYPES" => [
        "323" => "text/h323",
        "3g2" => "video/3gpp2",
        "3gp2" => "video/3gpp2",
        "3gp" => "video/3gpp",
        "3gpp" => "video/3gpp",
        "aac" => "audio/aac",
        "aaf" => "application/octet-stream",
        "aca" => "application/octet-stream",
        "accdb" => "application/msaccess",
        "accde" => "application/msaccess",
        "accdt" => "application/msaccess",
        "acx" => "application/internet-property-stream",
        "adt" => "audio/vnd.dlna.adts",
        "adts" => "audio/vnd.dlna.adts",
        "afm" => "application/octet-stream",
        "ai" => "application/postscript",
        "aif" => "audio/x-aiff",
        "aifc" => "audio/aiff",
        "aiff" => "audio/aiff",
        "appcache" => "text/cache-manifest",
        "application" => "application/x-ms-application",
        "art" => "image/x-jg",
        "asd" => "application/octet-stream",
        "asf" => "video/x-ms-asf",
        "asi" => "application/octet-stream",
        "asm" => "text/plain",
        "asr" => "video/x-ms-asf",
        "asx" => "video/x-ms-asf",
        "atom" => "application/atom+xml",
        "au" => "audio/basic",
        "avi" => "video/x-msvideo",
        "axs" => "application/olescript",
        "bas" => "text/plain",
        "bcpio" => "application/x-bcpio",
        "bin" => "application/octet-stream",
        "bmp" => "image/bmp",
        "c" => "text/plain",
        "cab" => "application/vnd.ms-cab-compressed",
        "calx" => "application/vnd.ms-office.calx",
        "cat" => "application/vnd.ms-pki.seccat",
        "cdf" => "application/x-cdf",
        "chm" => "application/octet-stream",
        "class" => "application/x-java-applet",
        "clp" => "application/x-msclip",
        "cmx" => "image/x-cmx",
        "cnf" => "text/plain",
        "cod" => "image/cis-cod",
        "cpio" => "application/x-cpio",
        "cpp" => "text/plain",
        "crd" => "application/x-mscardfile",
        "crl" => "application/pkix-crl",
        "crt" => "application/x-x509-ca-cert",
        "csh" => "application/x-csh",
        "css" => "text/css",
        "csv" => "application/octet-stream",
        "cur" => "application/octet-stream",
        "dcr" => "application/x-director",
        "deploy" => "application/octet-stream",
        "der" => "application/x-x509-ca-cert",
        "dib" => "image/bmp",
        "dir" => "application/x-director",
        "disco" => "text/xml",
        "dlm" => "text/dlm",
        "doc" => "application/msword",
        "docm" => "application/vnd.ms-word.document.macroEnabled.12",
        "docx" => "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
        "dot" => "application/msword",
        "dotm" => "application/vnd.ms-word.template.macroEnabled.12",
        "dotx" => "application/vnd.openxmlformats-officedocument.wordprocessingml.template",
        "dsp" => "application/octet-stream",
        "dtd" => "text/xml",
        "dvi" => "application/x-dvi",
        "dvr-ms" => "video/x-ms-dvr",
        "dwf" => "drawing/x-dwf",
        "dwp" => "application/octet-stream",
        "dxr" => "application/x-director",
        "eml" => "message/rfc822",
        "emz" => "application/octet-stream",
        "eot" => "application/vnd.ms-fontobject",
        "eps" => "application/postscript",
        "etx" => "text/x-setext",
        "evy" => "application/envoy",
        "fdf" => "application/vnd.fdf",
        "fif" => "application/fractals",
        "fla" => "application/octet-stream",
        "flac" => "audio/flac",
        "flr" => "x-world/x-vrml",
        "flv" => "video/x-flv",
        "gif" => "image/gif",
        "gtar" => "application/x-gtar",
        "gz" => "application/x-gzip",
        "h" => "text/plain",
        "hdf" => "application/x-hdf",
        "hdml" => "text/x-hdml",
        "hhc" => "application/x-oleobject",
        "hhk" => "application/octet-stream",
        "hhp" => "application/octet-stream",
        "hlp" => "application/winhlp",
        "hqx" => "application/mac-binhex40",
        "hta" => "application/hta",
        "htc" => "text/x-component",
        "htm" => "text/html",
        "html" => "text/html",
        "htt" => "text/webviewhtml",
        "hxt" => "text/html",
        "ical" => "text/calendar",
        "icalendar" => "text/calendar",
        "ico" => "image/x-icon",
        "ics" => "text/calendar",
        "ief" => "image/ief",
        "ifb" => "text/calendar",
        "iii" => "application/x-iphone",
        "inf" => "application/octet-stream",
        "ins" => "application/x-internet-signup",
        "isp" => "application/x-internet-signup",
        "IVF" => "video/x-ivf",
        "jar" => "application/java-archive",
        "java" => "application/octet-stream",
        "jck" => "application/liquidmotion",
        "jcz" => "application/liquidmotion",
        "jfif" => "image/pjpeg",
        "jpb" => "application/octet-stream",
        "jpg" => "image/jpeg", // Note: Use "jpg" first
        "jpeg" => "image/jpeg",
        "jpe" => "image/jpeg",
        "js" => "application/javascript",
        "json" => "application/json",
        "jsx" => "text/jscript",
        "latex" => "application/x-latex",
        "lit" => "application/x-ms-reader",
        "lpk" => "application/octet-stream",
        "lsf" => "video/x-la-asf",
        "lsx" => "video/x-la-asf",
        "lzh" => "application/octet-stream",
        "m13" => "application/x-msmediaview",
        "m14" => "application/x-msmediaview",
        "m1v" => "video/mpeg",
        "m2ts" => "video/vnd.dlna.mpeg-tts",
        "m3u" => "audio/x-mpegurl",
        "m4a" => "audio/mp4",
        "m4v" => "video/mp4",
        "man" => "application/x-troff-man",
        "manifest" => "application/x-ms-manifest",
        "map" => "text/plain",
        "mdb" => "application/x-msaccess",
        "mdp" => "application/octet-stream",
        "me" => "application/x-troff-me",
        "mht" => "message/rfc822",
        "mhtml" => "message/rfc822",
        "mid" => "audio/mid",
        "midi" => "audio/mid",
        "mix" => "application/octet-stream",
        "mmf" => "application/x-smaf",
        "mno" => "text/xml",
        "mny" => "application/x-msmoney",
        "mov" => "video/quicktime",
        "movie" => "video/x-sgi-movie",
        "mp2" => "video/mpeg",
        "mp3" => "audio/mpeg",
        "mp4" => "video/mp4",
        "mp4v" => "video/mp4",
        "mpa" => "video/mpeg",
        "mpe" => "video/mpeg",
        "mpeg" => "video/mpeg",
        "mpg" => "video/mpeg",
        "mpp" => "application/vnd.ms-project",
        "mpv2" => "video/mpeg",
        "ms" => "application/x-troff-ms",
        "msi" => "application/octet-stream",
        "mso" => "application/octet-stream",
        "mvb" => "application/x-msmediaview",
        "mvc" => "application/x-miva-compiled",
        "nc" => "application/x-netcdf",
        "nsc" => "video/x-ms-asf",
        "nws" => "message/rfc822",
        "ocx" => "application/octet-stream",
        "oda" => "application/oda",
        "odc" => "text/x-ms-odc",
        "ods" => "application/oleobject",
        "oga" => "audio/ogg",
        "ogg" => "video/ogg",
        "ogv" => "video/ogg",
        "ogx" => "application/ogg",
        "one" => "application/onenote",
        "onea" => "application/onenote",
        "onetoc" => "application/onenote",
        "onetoc2" => "application/onenote",
        "onetmp" => "application/onenote",
        "onepkg" => "application/onenote",
        "osdx" => "application/opensearchdescription+xml",
        "otf" => "font/otf",
        "p10" => "application/pkcs10",
        "p12" => "application/x-pkcs12",
        "p7b" => "application/x-pkcs7-certificates",
        "p7c" => "application/pkcs7-mime",
        "p7m" => "application/pkcs7-mime",
        "p7r" => "application/x-pkcs7-certreqresp",
        "p7s" => "application/pkcs7-signature",
        "pbm" => "image/x-portable-bitmap",
        "pcx" => "application/octet-stream",
        "pcz" => "application/octet-stream",
        "pdf" => "application/pdf",
        "pfb" => "application/octet-stream",
        "pfm" => "application/octet-stream",
        "pfx" => "application/x-pkcs12",
        "pgm" => "image/x-portable-graymap",
        "pko" => "application/vnd.ms-pki.pko",
        "pma" => "application/x-perfmon",
        "pmc" => "application/x-perfmon",
        "pml" => "application/x-perfmon",
        "pmr" => "application/x-perfmon",
        "pmw" => "application/x-perfmon",
        "png" => "image/png",
        "pnm" => "image/x-portable-anymap",
        "pnz" => "image/png",
        "pot" => "application/vnd.ms-powerpoint",
        "potm" => "application/vnd.ms-powerpoint.template.macroEnabled.12",
        "potx" => "application/vnd.openxmlformats-officedocument.presentationml.template",
        "ppam" => "application/vnd.ms-powerpoint.addin.macroEnabled.12",
        "ppm" => "image/x-portable-pixmap",
        "pps" => "application/vnd.ms-powerpoint",
        "ppsm" => "application/vnd.ms-powerpoint.slideshow.macroEnabled.12",
        "ppsx" => "application/vnd.openxmlformats-officedocument.presentationml.slideshow",
        "ppt" => "application/vnd.ms-powerpoint",
        "pptm" => "application/vnd.ms-powerpoint.presentation.macroEnabled.12",
        "pptx" => "application/vnd.openxmlformats-officedocument.presentationml.presentation",
        "prf" => "application/pics-rules",
        "prm" => "application/octet-stream",
        "prx" => "application/octet-stream",
        "ps" => "application/postscript",
        "psd" => "application/octet-stream",
        "psm" => "application/octet-stream",
        "psp" => "application/octet-stream",
        "pub" => "application/x-mspublisher",
        "qt" => "video/quicktime",
        "qtl" => "application/x-quicktimeplayer",
        "qxd" => "application/octet-stream",
        "ra" => "audio/x-pn-realaudio",
        "ram" => "audio/x-pn-realaudio",
        "rar" => "application/octet-stream",
        "ras" => "image/x-cmu-raster",
        "rf" => "image/vnd.rn-realflash",
        "rgb" => "image/x-rgb",
        "rm" => "application/vnd.rn-realmedia",
        "rmi" => "audio/mid",
        "roff" => "application/x-troff",
        "rpm" => "audio/x-pn-realaudio-plugin",
        "rtf" => "application/rtf",
        "rtx" => "text/richtext",
        "scd" => "application/x-msschedule",
        "sct" => "text/scriptlet",
        "sea" => "application/octet-stream",
        "setpay" => "application/set-payment-initiation",
        "setreg" => "application/set-registration-initiation",
        "sgml" => "text/sgml",
        "sh" => "application/x-sh",
        "shar" => "application/x-shar",
        "sit" => "application/x-stuffit",
        "sldm" => "application/vnd.ms-powerpoint.slide.macroEnabled.12",
        "sldx" => "application/vnd.openxmlformats-officedocument.presentationml.slide",
        "smd" => "audio/x-smd",
        "smi" => "application/octet-stream",
        "smx" => "audio/x-smd",
        "smz" => "audio/x-smd",
        "snd" => "audio/basic",
        "snp" => "application/octet-stream",
        "spc" => "application/x-pkcs7-certificates",
        "spl" => "application/futuresplash",
        "spx" => "audio/ogg",
        "src" => "application/x-wais-source",
        "ssm" => "application/streamingmedia",
        "sst" => "application/vnd.ms-pki.certstore",
        "stl" => "application/vnd.ms-pki.stl",
        "sv4cpio" => "application/x-sv4cpio",
        "sv4crc" => "application/x-sv4crc",
        "svg" => "image/svg+xml",
        "svgz" => "image/svg+xml",
        "swf" => "application/x-shockwave-flash",
        "t" => "application/x-troff",
        "tar" => "application/x-tar",
        "tcl" => "application/x-tcl",
        "tex" => "application/x-tex",
        "texi" => "application/x-texinfo",
        "texinfo" => "application/x-texinfo",
        "tgz" => "application/x-compressed",
        "thmx" => "application/vnd.ms-officetheme",
        "thn" => "application/octet-stream",
        "tif" => "image/tiff",
        "tiff" => "image/tiff",
        "toc" => "application/octet-stream",
        "tr" => "application/x-troff",
        "trm" => "application/x-msterminal",
        "ts" => "video/vnd.dlna.mpeg-tts",
        "tsv" => "text/tab-separated-values",
        "ttc" => "application/x-font-ttf",
        "ttf" => "application/x-font-ttf",
        "tts" => "video/vnd.dlna.mpeg-tts",
        "txt" => "text/plain",
        "u32" => "application/octet-stream",
        "uls" => "text/iuls",
        "ustar" => "application/x-ustar",
        "vbs" => "text/vbscript",
        "vcf" => "text/x-vcard",
        "vcs" => "text/plain",
        "vdx" => "application/vnd.ms-visio.viewer",
        "vml" => "text/xml",
        "vsd" => "application/vnd.visio",
        "vss" => "application/vnd.visio",
        "vst" => "application/vnd.visio",
        "vsto" => "application/x-ms-vsto",
        "vsw" => "application/vnd.visio",
        "vsx" => "application/vnd.visio",
        "vtx" => "application/vnd.visio",
        "wav" => "audio/wav",
        "wax" => "audio/x-ms-wax",
        "wbmp" => "image/vnd.wap.wbmp",
        "wcm" => "application/vnd.ms-works",
        "wdb" => "application/vnd.ms-works",
        "webm" => "video/webm",
        "webp" => "image/webp",
        "wks" => "application/vnd.ms-works",
        "wm" => "video/x-ms-wm",
        "wma" => "audio/x-ms-wma",
        "wmd" => "application/x-ms-wmd",
        "wmf" => "application/x-msmetafile",
        "wml" => "text/vnd.wap.wml",
        "wmlc" => "application/vnd.wap.wmlc",
        "wmls" => "text/vnd.wap.wmlscript",
        "wmlsc" => "application/vnd.wap.wmlscriptc",
        "wmp" => "video/x-ms-wmp",
        "wmv" => "video/x-ms-wmv",
        "wmx" => "video/x-ms-wmx",
        "wmz" => "application/x-ms-wmz",
        "woff" => "application/font-woff",
        "woff2" => "application/font-woff2",
        "wps" => "application/vnd.ms-works",
        "wri" => "application/x-mswrite",
        "wrl" => "x-world/x-vrml",
        "wrz" => "x-world/x-vrml",
        "wsdl" => "text/xml",
        "wtv" => "video/x-ms-wtv",
        "wvx" => "video/x-ms-wvx",
        "x" => "application/directx",
        "xaf" => "x-world/x-vrml",
        "xaml" => "application/xaml+xml",
        "xap" => "application/x-silverlight-app",
        "xbap" => "application/x-ms-xbap",
        "xbm" => "image/x-xbitmap",
        "xdr" => "text/plain",
        "xht" => "application/xhtml+xml",
        "xhtml" => "application/xhtml+xml",
        "xla" => "application/vnd.ms-excel",
        "xlam" => "application/vnd.ms-excel.addin.macroEnabled.12",
        "xlc" => "application/vnd.ms-excel",
        "xlm" => "application/vnd.ms-excel",
        "xls" => "application/vnd.ms-excel",
        "xlsb" => "application/vnd.ms-excel.sheet.binary.macroEnabled.12",
        "xlsm" => "application/vnd.ms-excel.sheet.macroEnabled.12",
        "xlsx" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
        "xlt" => "application/vnd.ms-excel",
        "xltm" => "application/vnd.ms-excel.template.macroEnabled.12",
        "xltx" => "application/vnd.openxmlformats-officedocument.spreadsheetml.template",
        "xlw" => "application/vnd.ms-excel",
        "xml" => "text/xml",
        "xof" => "x-world/x-vrml",
        "xpm" => "image/x-xpixmap",
        "xps" => "application/vnd.ms-xpsdocument",
        "xsd" => "text/xml",
        "xsf" => "text/xml",
        "xsl" => "text/xml",
        "xslt" => "text/xml",
        "xsn" => "application/octet-stream",
        "xtp" => "application/octet-stream",
        "xwd" => "image/x-xwindowdump",
        "z" => "application/x-compress",
        "zip" => "application/x-zip-compressed"
    ],

    // Boolean HTML attributes
    "BOOLEAN_HTML_ATTRIBUTES" => [
        "allowfullscreen",
        "allowpaymentrequest",
        "async",
        "autofocus",
        "autoplay",
        "checked",
        "controls",
        "default",
        "defer",
        "disabled",
        "formnovalidate",
        "hidden",
        "ismap",
        "itemscope",
        "loop",
        "multiple",
        "muted",
        "nomodule",
        "novalidate",
        "open",
        "readonly",
        "required",
        "reversed",
        "selected",
        "typemustmatch"
    ],

    // HTML singleton tags
    "HTML_SINGLETON_TAGS" => [
        "area",
        "base",
        "br",
        "col",
        "command",
        "embed",
        "hr",
        "img",
        "input",
        "keygen",
        "link",
        "meta",
        "param",
        "source",
        "track",
        "wbr"
    ],

    // Use token in URL (reserved, not used, do NOT change!)
    "USE_TOKEN_IN_URL" => false,

    // Use ILIKE for PostgreSQL
    "USE_ILIKE_FOR_POSTGRESQL" => true,

    // Use collation for MySQL
    "LIKE_COLLATION_FOR_MYSQL" => "",

    // Use collation for MsSQL
    "LIKE_COLLATION_FOR_MSSQL" => "",

    // Null / Not Null / Init / Empty / all values
    "NULL_VALUE" => "##null##",
    "NOT_NULL_VALUE" => "##notnull##",
    "INIT_VALUE" => "##init##",
    "EMPTY_VALUE" => "##empty##",
    "ALL_VALUE" => "##all##",

    /**
     * Search multi value option
     * 1 - no multi value
     * 2 - AND all multi values
     * 3 - OR all multi values
    */
    "SEARCH_MULTI_VALUE_OPTION" => 3,

    // Advanced search
    "SEARCH_OPTION" => "AUTO",

    // Quick search
    "BASIC_SEARCH_IGNORE_PATTERN" => "/[\?,\.\^\*\(\)\[\]\\\"]/", // Ignore special characters
    "BASIC_SEARCH_ANY_FIELDS" => false, // Search "All keywords" in any selected fields

    // Sort options
    "SORT_OPTION" => "Tristate", // Sort option (toggle/tristate)

    // Validate options
    "CLIENT_VALIDATE" => true,
    "SERVER_VALIDATE" => false,
    "INVALID_USERNAME_CHARACTERS" => "<>\"'&",
    "INVALID_PASSWORD_CHARACTERS" => "<>\"'&",
    "URL_PATTERN" => '~^
            (https?)://                                 # protocol
            (((?:[\_\.\pL\pN-]|%%[0-9A-Fa-f]{2})+:)?((?:[\_\.\pL\pN-]|%%[0-9A-Fa-f]{2})+)@)?  # basic auth
            (
                ([\pL\pN\pS\-\_\.])+(\.?([\pL\pN]|xn\-\-[\pL\pN-]+)+\.?) # a domain name
                    |                                                 # or
                \d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}                    # an IP address
                    |                                                 # or
                \[
                    (?:(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){6})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:::(?:(?:(?:[0-9a-f]{1,4})):){5})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:[0-9a-f]{1,4})))?::(?:(?:(?:[0-9a-f]{1,4})):){4})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,1}(?:(?:[0-9a-f]{1,4})))?::(?:(?:(?:[0-9a-f]{1,4})):){3})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,2}(?:(?:[0-9a-f]{1,4})))?::(?:(?:(?:[0-9a-f]{1,4})):){2})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,3}(?:(?:[0-9a-f]{1,4})))?::(?:(?:[0-9a-f]{1,4})):)(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,4}(?:(?:[0-9a-f]{1,4})))?::)(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,5}(?:(?:[0-9a-f]{1,4})))?::)(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,6}(?:(?:[0-9a-f]{1,4})))?::))))
                \]  # an IPv6 address
            )
            (:[0-9]+)?                              # a port (optional)
            (?:/ (?:[\pL\pN\-._\~!$&\'()*+,;=:@]|%%[0-9A-Fa-f]{2})* )*          # a path
            (?:\? (?:[\pL\pN\-._\~!$&\'\[\]()*+,;=:@/?]|%%[0-9A-Fa-f]{2})* )?   # a query (optional)
            (?:\# (?:[\pL\pN\-._\~!$&\'()*+,;=:@/?]|%%[0-9A-Fa-f]{2})* )?       # a fragment (optional)
        $~ixu', // Based on https://github.com/symfony/validator/blob/5.4/Constraints/UrlValidator.php

    // Blob field byte count for hash value calculation
    "BLOB_FIELD_BYTE_COUNT" => 200,

    // Auto suggest max entries
    "AUTO_SUGGEST_MAX_ENTRIES" => 10,

    // Lookup all display fields
    "LOOKUP_ALL_DISPLAY_FIELDS" => false,

    // Lookup page size
    "LOOKUP_PAGE_SIZE" => 100,

    // Filter page size
    "FILTER_PAGE_SIZE" => 100,

    // Auto fill original value
    "AUTO_FILL_ORIGINAL_VALUE" => false,

    // Lookup
    "MULTIPLE_OPTION_SEPARATOR" => ",",
    "USE_LOOKUP_CACHE" => true,
    "LOOKUP_CACHE_COUNT" => 100,

    // Page Title Style
    "PAGE_TITLE_STYLE" => "Breadcrumbs",

    // Responsive tables
    "USE_RESPONSIVE_TABLE" => true,
    "RESPONSIVE_TABLE_CLASS" => "table-responsive",

    // Multi column list options position
    "MULTI_COLUMN_LIST_OPTIONS_POSITION" => "bottom-start",

    // RTL
    "RTL_LANGUAGES" => ["ar", "fa", "he", "iw", "ug", "ur"],

    // Multiple selection
    "OPTION_HTML_TEMPLATE" => '<span class="ew-option">{value}</span>', // Note: class="ew-option" must match CSS style in project stylesheet
    "OPTION_SEPARATOR" => ", ",

    // Cookie consent
    "COOKIE_CONSENT_NAME" => "ConsentCookie", // Cookie consent name
    "COOKIE_CONSENT_CLASS" => "bg-secondary", // CSS class name for cookie consent
    "COOKIE_CONSENT_BUTTON_CLASS" => "btn btn-dark btn-sm", // CSS class name for cookie consent buttons

    // Cookies
    "COOKIE_EXPIRY_TIME" => time() + 365 * 24 * 60 * 60,
    "COOKIE_HTTP_ONLY" => true,
    "COOKIE_SECURE" => false,
    "COOKIE_SAMESITE" => "Lax",

    // Mime type
    "DEFAULT_MIME_TYPE" => "application/octet-stream",

    // Auto hide pager
    "AUTO_HIDE_PAGER" => false,
    "AUTO_HIDE_PAGE_SIZE_SELECTOR" => false,

    // Extensions
    "USE_PHPEXCEL" => false,
    "USE_PHPWORD" => false,
    "PDF_STYLESHEET_FILENAME" => "",

    /**
     * Reports
     */

    // Chart
    "CHART_SHOW_BLANK_SERIES" => false, // Show blank series
    "CHART_SHOW_ZERO_IN_STACK_CHART" => false, // Show zero in stack chart
    "CHART_SCALE_BEGIN_WITH_ZERO" => false, // Chart scale begin with zero
    "CHART_SCALE_MINIMUM_VALUE" => 0, // Chart scale minimum value
    "CHART_SCALE_MAXIMUM_VALUE" => 0, // Chart scale maximum value
    "CHART_SHOW_PERCENTAGE" => false, // Show percentage in Pie/Doughnut charts

    // Drill down setting
    "USE_DRILLDOWN_PANEL" => true, // Use popover for drill down

    // Filter
    "SHOW_CURRENT_FILTER" => false, // True to show current filter
    "SHOW_DRILLDOWN_FILTER" => true, // True to show drill down filter

    // Table level constants
    "TABLE_GROUP_PER_PAGE" => "recperpage",
    "TABLE_START_GROUP" => "start",
    "TABLE_SORTCHART" => "sortc", // Table sort chart

    // Page break
    "PAGE_BREAK_HTML" => '<div style="page-break-after:always;"></div>',

    // Export reports
    "REPORT_EXPORT_CLASSES" => [
        "email" => "ExportReportEmail",
        "word" => "ExportReportWord",
        "excel" => "ExportReportExcel",
        "pdf" => "ExportReportPdf"
    ],

    // Download PDF file (instead of shown in browser)
    "DOWNLOAD_PDF_FILE" => false,

    // Embed PDF documents
    "EMBED_PDF" => true,

    // Advanced Filters
    "REPORT_ADVANCED_FILTERS" => [
        "PastFuture" => ["Past" => "IsPast", "Future" => "IsFuture"],
        "RelativeDayPeriods" => ["Last30Days" => "IsLast30Days", "Last14Days" => "IsLast14Days", "Last7Days" => "IsLast7Days", "Next7Days" => "IsNext7Days", "Next14Days" => "IsNext14Days", "Next30Days" => "IsNext30Days"],
        "RelativeDays" => ["Yesterday" => "IsYesterday", "Today" => "IsToday", "Tomorrow" => "IsTomorrow"],
        "RelativeWeeks" => ["LastTwoWeeks" => "IsLast2Weeks", "LastWeek" => "IsLastWeek", "ThisWeek" => "IsThisWeek", "NextWeek" => "IsNextWeek", "NextTwoWeeks" => "IsNext2Weeks"],
        "RelativeMonths" => ["LastMonth" => "IsLastMonth", "ThisMonth" => "IsThisMonth", "NextMonth" => "IsNextMonth"],
        "RelativeYears" => ["LastYear" => "IsLastYear", "ThisYear" => "IsThisYear", "NextYear" => "IsNextYear"]
    ],

    // Chart
    "DEFAULT_CHART_RENDERER" => "",

    // Float fields default number format
    "DEFAULT_NUMBER_FORMAT" => "#,##0.##",

    // Pace options
    "PACE_OPTIONS" => [
        "ajax" => [
            "trackMethods" => ["GET", "POST"],
            "ignoreURLs" => ["/session?"]
        ]
    ],

    // Date time formats
    "DATE_FORMATS" => [
        4 => "HH:mm",
        5 => "y/MM/dd",
        6 => "MM/dd/y",
        7 => "dd/MM/y",
        9 => "y/MM/dd HH:mm:ss",
        10 => "MM/dd/y HH:mm:ss",
        11 => "dd/MM/y HH:mm:ss",
        109 => "y/MM/dd HH:mm",
        110 => "MM/dd/y HH:mm",
        111 => "dd/MM/y HH:mm",
        12 => "yy/MM/dd",
        13 => "MM/dd/yy",
        14 => "dd/MM/yy",
        15 => "yy/MM/dd HH:mm:ss",
        16 => "MM/dd/yy HH:mm:ss",
        17 => "dd/MM/yy HH:mm:ss",
        115 => "yy/MM/dd HH:mm",
        116 => "MM/dd/yy HH:mm",
        117 => "dd/MM/yy HH:mm",
    ],

    // Database date time formats
    "DB_DATE_FORMATS" => [
        "MYSQL" => [
            "dd" => "%d",
            "d" => "%e",
            "HH" => "%H",
            "H" => "%k",
            "hh" => "%h",
            "h" => "%l",
            "MM" => "%m",
            "M" => "%c",
            "mm" => "%i",
            "m" => "%i",
            "ss" => "%S",
            "s" => "%S",
            "yy" => "%y",
            "y" => "%Y",
            "a" => "%p"
        ],
        "POSTGRESQL" => [
            "dd" => "DD",
            "d" => "FMDD",
            "HH" => "HH24",
            "H" => "FMHH24",
            "hh" => "HH12",
            "h" => "FMHH12",
            "MM" => "MM",
            "M" => "FMMM",
            "mm" => "MI",
            "m" => "FMMI",
            "ss" => "SS",
            "s" => "FMSS",
            "yy" => "YY",
            "y" => "YYYY",
            "a" => "AM"
        ],
        "MSSQL" => [
            "dd" => "dd",
            "d" => "d",
            "HH" => "HH",
            "H" => "H",
            "hh" => "hh",
            "h" => "h",
            "MM" => "MM",
            "M" => "M",
            "mm" => "mm",
            "m" => "m",
            "ss" => "ss",
            "s" => "s",
            "yy" => "yy",
            "y" => "yyyy",
            "a" => "tt"
        ],
        "ORACLE" => [
            "dd" => "DD",
            "d" => "FMDD",
            "HH" => "HH24",
            "H" => "FMHH24",
            "hh" => "HH12",
            "h" => "FMHH12",
            "MM" => "MM",
            "M" => "FMMM",
            "mm" => "MI",
            "m" => "FMMI",
            "ss" => "SS",
            "s" => "FMSS",
            "yy" => "YY",
            "y" => "YYYY",
            "a" => "AM"
        ],
        "SQLITE" => [
            "dd" => "%d",
            "d" => "%d",
            "HH" => "%H",
            "H" => "%H",
            "hh" => "%I",
            "h" => "%I",
            "MM" => "%m",
            "M" => "%m",
            "mm" => "%M",
            "m" => "%M",
            "ss" => "%S",
            "s" => "%S",
            "yy" => "%y",
            "y" => "%Y",
            "a" => "%P"
        ]
    ],

    // Quarter name
    "QUARTER_PATTERN" => "QQQQ",

    // Month name
    "MONTH_PATTERN" => "MMM",

    // Table client side variables
    "TABLE_CLIENT_VARS" => [
        "tableCaption"
    ],

    // Field client side variables
    "FIELD_CLIENT_VARS" => [
        "caption",
        "Visible",
        "Required",
        "IsInvalid",
        "Raw",
        "clientFormatPattern"
    ],

    // Config client side variables
    "CONFIG_CLIENT_VARS" => [
        "DEBUG",
        "SESSION_TIMEOUT_COUNTDOWN", // Count down time to session timeout (seconds)
        "SESSION_KEEP_ALIVE_INTERVAL", // Keep alive interval (seconds)
        "API_FILE_TOKEN_NAME", // API file token name
        "API_URL", // API file name // PHP
        "API_ACTION_NAME", // API action name
        "API_OBJECT_NAME", // API object name
        "API_LIST_ACTION", // API list action
        "API_VIEW_ACTION", // API view action
        "API_ADD_ACTION", // API add action
        "API_EDIT_ACTION", // API edit action
        "API_DELETE_ACTION", // API delete action
        "API_LOGIN_ACTION", // API login action
        "API_FILE_ACTION", // API file action
        "API_UPLOAD_ACTION", // API upload action
        "API_JQUERY_UPLOAD_ACTION", // API jQuery upload action
        "API_SESSION_ACTION", // API get session action
        "API_LOOKUP_ACTION", // API lookup action
        "API_LOOKUP_PAGE", // API lookup page name
        "API_PROGRESS_ACTION", // API progress action
        "API_EXPORT_CHART_ACTION", // API export chart action
        "PUSH_SERVER_PUBLIC_KEY", // Push Server Public Key
        "API_PUSH_NOTIFICATION_ACTION", // API push notification action
        "API_PUSH_NOTIFICATION_SUBSCRIBE", // API push notification subscribe
        "API_PUSH_NOTIFICATION_DELETE", // API push notification delete
        "API_2FA_ACTION", // API two factor authentication action
        "API_2FA_SHOW", // API two factor authentication show
        "API_2FA_VERIFY", // API two factor authentication verify
        "API_2FA_RESET", // API two factor authentication reset
        "API_2FA_BACKUP_CODES", // API two factor authentication backup codes
        "API_2FA_NEW_BACKUP_CODES", // API two factor authentication new backup codes
        "MULTIPLE_OPTION_SEPARATOR", // Multiple option separator
        "AUTO_SUGGEST_MAX_ENTRIES", // Auto-Suggest max entries
        "LOOKUP_ALL_DISPLAY_FIELDS", // Auto-Suggest for all display fields
        "LOOKUP_PAGE_SIZE", // Lookup page size
        "FILTER_PAGE_SIZE", // Filter page size
        "MAX_EMAIL_RECIPIENT",
        "UPLOAD_THUMBNAIL_WIDTH", // Upload thumbnail width
        "UPLOAD_THUMBNAIL_HEIGHT", // Upload thumbnail height
        "MULTIPLE_UPLOAD_SEPARATOR", // Upload multiple separator
        "IMPORT_FILE_ALLOWED_EXT", // Import file allowed extensions
        "USE_COLORBOX",
        "PROJECT_STYLESHEET_FILENAME", // Project style sheet
        "PDF_STYLESHEET_FILENAME", // PDF style sheet // PHP
        "EMBED_PDF",
        "LAZY_LOAD",
        "REMOVE_XSS",
        "ENCRYPTED_PASSWORD",
        "INVALID_USERNAME_CHARACTERS",
        "INVALID_PASSWORD_CHARACTERS",
        "USE_RESPONSIVE_TABLE",
        "RESPONSIVE_TABLE_CLASS",
        "SEARCH_FILTER_OPTION",
        "OPTION_HTML_TEMPLATE",
        "PAGE_LAYOUT",
        "CLIENT_VALIDATE"
    ],

    // Global client side variables
    "GLOBAL_CLIENT_VARS" => [
        "DATE_FORMAT", // Date format
        "TIME_FORMAT", // Time format
        "DATE_SEPARATOR", // Date separator
        "TIME_SEPARATOR", // Time separator
        "DECIMAL_SEPARATOR", // Decimal separator
        "GROUPING_SEPARATOR", // Grouping separator
        "NUMBER_FORMAT", // Number format
        "PERCENT_FORMAT", // Percent format
        "CURRENCY_CODE", // Currency code
        "CURRENCY_SYMBOL", // Currency code
        "TokenNameKey", // Token name key
        "TokenName" // Token name
    ]
];

// Config data
$CONFIG = array_merge(
    $CONFIG,
    require("config." . $CONFIG["ENVIRONMENT"] . ".php")
);
$CONFIG_DATA = null;

// Dompdf
$CONFIG["PDF_STYLESHEET_FILENAME"] = "css/ewpdf.css"; // Export PDF CSS styles
$CONFIG["PDF_MEMORY_LIMIT"] = "512M"; // Memory limit
$CONFIG["PDF_TIME_LIMIT"] = 120; // Time limit
$CONFIG["PDF_MAX_IMAGE_WIDTH"] = 650; // Make sure image width not larger than page width or "infinite table loop" error
$CONFIG["PDF_MAX_IMAGE_HEIGHT"] = 900; // Make sure image height not larger than page height or "infinite table loop" error
$CONFIG["PDF_IMAGE_SCALE_FACTOR"] = 1.53; // Scale factor
