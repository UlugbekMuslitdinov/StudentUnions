<?php

namespace PHPMaker2022\project1;

/**
 * List action class
 */
class ListAction
{
    public $Action = "";
    public $Caption = "";
    public $Allow = true;
    public $Method = ACTION_POSTBACK; // Post back (p) / Ajax (a)
    public $Select = ACTION_MULTIPLE; // Multiple (m) / Single (s)
    public $Message = ""; // Message or Swal config
    public $Icon = "fas fa-star ew-icon"; // Icon
    public $Success = ""; // JavaScript callback function name

    // Constructor
    public function __construct($action, $caption, $allow = true, $method = ACTION_POSTBACK, $select = ACTION_MULTIPLE, $message = "", $icon = "fas fa-star ew-icon", $success = "", $input = false, $options = "")
    {
        $this->Action = $action;
        $this->Caption = $caption;
        $this->Allow = $allow;
        $this->Method = $method;
        $this->Select = $select;
        $this->Message = $message;
        $this->Icon = $icon;
        $this->Success = $success;
    }

    // To JSON
    public function toJson($htmlEncode = false)
    {
        $ar = [
            "msg" => $this->Message,
            "action" => $this->Action,
            "method" => $this->Method,
            "select" => $this->Select,
            "success" => $this->Success
        ];
        $json = JsonEncode($ar);
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // To data-* attributes
    public function toDataAttrs()
    {
        $attrs = new Attributes([
            "data-msg" => HtmlEncode($this->Message),
            "data-action" => HtmlEncode($this->Action),
            "data-method" => HtmlEncode($this->Method),
            "data-select" => HtmlEncode($this->Select),
            "data-success" => HtmlEncode($this->Success)
        ]);
        return $attrs->toString();
    }
}
