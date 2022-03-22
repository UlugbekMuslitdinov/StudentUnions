<?php

namespace PHPMaker2022\project1;

/**
 * List option class
 */
class ListOption
{
    public $Name;
    public $OnLeft;
    public $CssStyle;
    public $CssClass;
    public $Visible = true;
    public $Header;
    public $Body;
    public $Footer;
    public $Parent;
    public $ShowInButtonGroup = true;
    public $ShowInDropDown = true;
    public $ButtonGroupName = "_default";

    // Constructor
    public function __construct($name, array $properties = [])
    {
        $this->Name = $name;
        foreach ($properties as $property => $value) {
            $this->$property = $value;
        }
    }

    // Add a link
    public function addLink($attrs, $phraseId)
    {
        $this->Body .= GetLinkHtml($attrs, $phraseId);
    }

    // Clear
    public function clear()
    {
        $this->Body = "";
    }

    // Move to
    public function moveTo($pos)
    {
        $this->Parent->moveItem($this->Name, $pos);
    }

    // Render
    public function render($part, $colspan, $pos)
    {
        $tagclass = $this->Parent->TagClassName;
        $td = SameText($this->Parent->Tag, "td");
        if ($part == "header") {
            $tagclass = $tagclass ?? "ew-list-option-header";
            $value = $this->Header;
        } elseif ($part == "body") {
            $tagclass = $tagclass ?? "ew-list-option-body";
            $value = $this->Body;
        } elseif ($part == "footer") {
            $tagclass = $tagclass ?? "ew-list-option-footer";
            $value = $this->Footer;
        } else {
            $value = $part;
        }
        if (strval($value) == "" && preg_match('/inline/', $this->Parent->TagClassName) && $this->Parent->TemplateId == "") { // Skip for multi-column inline tag
            return "";
        }
        $res = $value;
        $attrs = new Attributes(["class" => $tagclass, "style" => $this->CssStyle, "data-name" => $this->Name]);
        $attrs->appendClass($this->CssClass);
        if ($td && in_array($this->Name, [$this->Parent->GroupOptionName, "checkbox"])) { // "button" and "checkbox" columns
            $attrs->appendClass("w-1");
        }
        if ($td && $this->Parent->RowSpan > 1) {
            $attrs["rowspan"] = $this->Parent->RowSpan;
        }
        if ($td && $colspan > 1) {
            $attrs["colspan"] = $colspan;
        }
        $name = $this->Parent->TableVar . "_" . $this->Name;
        if ($this->Name != $this->Parent->GroupOptionName) {
            if (!in_array($this->Name, ["checkbox", "rowcnt"])) {
                if ($this->Parent->UseButtonGroup && $this->ShowInButtonGroup) {
                    $res = $this->Parent->renderButtonGroup($res, $pos);
                    if ($this->OnLeft && $td && $colspan > 1) {
                        $res = '<div class="text-end">' . $res . '</div>';
                    }
                }
            }
            if ($part == "header") {
                $res = '<span id="elh_' . $name . '" class="' . $name . '">' . $res . '</span>';
            } elseif ($part == "body") {
                $res = '<span id="el' . $this->Parent->RowCnt . '_' . $name . '" class="' . $name . '">' . $res . '</span>';
            } elseif ($part == "footer") {
                $res = '<span id="elf_' . $name . '" class="' . $name . '">' . $res . '</span>';
            }
        }
        $tag = ($td && $part == "header") ? "th" : $this->Parent->Tag;
        if ($this->Parent->UseButtonGroup && $this->ShowInButtonGroup) {
            $attrs->appendClass("text-nowrap");
        }
        $res = $tag ? HtmlElement($tag, $attrs, $res) : $res;
        if ($this->Parent->TemplateId != "" && $this->Parent->TemplateType == "single") {
            if ($part == "header") {
                $res = '<template id="tpoh_' . $this->Parent->TemplateId . '_' . $this->Name . '">' . $res . '</template>';
            } elseif ($part == 'body') {
                $res = '<template id="tpob' . $this->Parent->RowCnt . '_' . $this->Parent->TemplateId . '_' . $this->Name . '">' . $res . '</template>';
            } elseif ($part == 'footer') {
                $res = '<template id="tpof_' . $this->Parent->TemplateId . '_' . $this->Name . '">' . $res . '</template>';
            }
        }
        return $res;
    }
}
