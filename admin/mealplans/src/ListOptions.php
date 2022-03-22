<?php

namespace PHPMaker2022\mealplans;

use DiDom\Document;
use DiDom\Query;

/**
 * List option collection class
 */
class ListOptions implements \ArrayAccess
{
    public $Items = [];
    public $CustomItem = "";
    public $Tag = "div";
    public $TagClassName = null;
    public $TableVar = "";
    public $RowCnt = "";
    public $TemplateType = "block";
    public $TemplateId = "";
    public $TemplateClassName = "";
    public $RowSpan = 1;
    public $UseDropDownButton = false;
    public $UseButtonGroup = false;
    public $ButtonClass = "";
    public $ButtonGroupClass = "";
    public $GroupOptionName = "button";
    public $DropDownButtonPhrase = "";
    public $DropDownAutoClose = "true"; // true/inside/outside/false (see https://getbootstrap.com/docs/5.0/components/dropdowns/#auto-close-behavior)

    // Constructor
    public function __construct($args = null)
    {
        if (is_string($args)) { // Tag
            $this->Tag = $args;
        } elseif (is_array($args)) { // Properties
            foreach ($args as $property => $arg) {
                $this->$property = $arg;
            }
        }
    }

    // Implements offsetSet
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->Items[] = &$value;
        } else {
            $this->Items[$offset] = &$value;
        }
    }

    // Implements offsetExists
    public function offsetExists($offset)
    {
        return isset($this->Items[$offset]);
    }

    // Implements offsetUnset
    public function offsetUnset($offset)
    {
        unset($this->Items[$offset]);
    }

    // Implements offsetGet
    public function &offsetGet($offset)
    {
        $item = $this->Items[$offset] ?? null;
        return $item;
    }

    // Check visible
    public function visible()
    {
        foreach ($this->Items as $item) {
            if ($item->Visible) {
                return true;
            }
        }
        return false;
    }

    // Check group option visible
    public function groupOptionVisible()
    {
        $cnt = 0;
        foreach ($this->Items as $item) {
            if (
                $item->Name != $this->GroupOptionName &&
                ($item->Visible && $item->ShowInDropDown && $this->UseDropDownButton ||
                $item->Visible && $item->ShowInButtonGroup && $this->UseButtonGroup)
            ) {
                $cnt += 1;
                if ($this->UseDropDownButton && $cnt > 1 || $this->UseButtonGroup) {
                    return true;
                }
            }
        }
        return false;
    }

    // Add and return the new option
    public function &add($name, $option = null)
    {
        $numargs = func_num_args();
        $item = null;
        if ($numargs == 1) {
            if (is_string($name)) {
                $item = new ListOption($name);
            }
        } elseif ($numargs == 2) {
            if ($option instanceof ListOption) {
                $item = $option;
            } elseif (is_array($option)) {
                $item = new ListOption($name, $option);
            }
        }
        if ($item != null) {
            $item->Parent = &$this;
            $this->Items[$name] = $item;
        }
        return $item;
    }

    // Add group option and return the new option
    public function &addGroupOption()
    {
        $item = &$this->add($this->GroupOptionName);
        return $item;
    }

    // Load default settings
    public function loadDefault()
    {
        $this->CustomItem = "";
        foreach ($this->Items as $key => $item) {
            $this->Items[$key]->Body = "";
        }
    }

    // Hide all options
    public function hideAllOptions($lists = [])
    {
        foreach ($this->Items as $key => $item) {
            if (!in_array($key, $lists)) {
                $this->Items[$key]->Visible = false;
            }
        }
    }

    // Show all options
    public function showAllOptions()
    {
        foreach ($this->Items as $key => $item) {
            $this->Items[$key]->Visible = true;
        }
    }

    /**
     * Get item by name (same as offsetGet)
     *
     * @param string $name Predefined names: view/edit/copy/delete/detail_<DetailTable>/userpermission/checkbox
     * @return void
     */
    public function &getItem($name)
    {
        $item = $this->Items[$name] ?? null;
        return $item;
    }

    // Get item position
    public function itemPos($name)
    {
        $pos = 0;
        foreach ($this->Items as $item) {
            if ($item->Name == $name) {
                return $pos;
            }
            $pos++;
        }
        return false;
    }

    // Get count
    public function count()
    {
        return count($this->Items);
    }

    // Get visible item count
    public function visibleCount()
    {
        return array_reduce($this->Items, function ($cnt, $item) {
            return $cnt + ($item->Visible ? 1 : 0);
        }, 0);
    }

    // Move item to position
    public function moveItem($name, $pos)
    {
        $cnt = $this->count();
        if ($pos < 0) { // If negative, count from the end
            $pos = $cnt + $pos;
        }
        if ($pos < 0) {
            $pos = 0;
        }
        if ($pos >= $cnt) {
            $pos = $cnt - 1;
        }
        $item = &$this->getItem($name);
        if ($item) {
            unset($this->Items[$name]);
            $this->Items = array_merge(
                array_slice($this->Items, 0, $pos),
                [$name => $item],
                array_slice($this->Items, $pos)
            );
        }
    }

    // Render list options
    public function render($part, $pos = "", $rowCnt = "", $templateType = "block", $templateId = "", $templateClassName = "", $output = true)
    {
        if ($this->CustomItem == "" && $groupitem = &$this->getItem($this->GroupOptionName) && $this->showPos($groupitem->OnLeft, $pos)) {
            if ($this->UseDropDownButton) { // Render dropdown
                $buttonValue = "";
                $cnt = 0;
                foreach ($this->Items as $item) {
                    if ($item->Name != $this->GroupOptionName && $item->Visible) {
                        if ($item->ShowInDropDown) {
                            $buttonValue .= $item->Body;
                            $cnt += 1;
                        } elseif ($item->Name == "listactions") { // Show listactions as button group
                            $item->Body = $this->renderButtonGroup($item->Body, $pos);
                        }
                    }
                }
                if ($cnt < 1 || $cnt == 1 && !ContainsString($buttonValue, "dropdown-menu")) { // No item to show in dropdown or only one item without dropdown menu
                    $this->UseDropDownButton = false; // No need to use drop down button
                } else {
                    $dropdownButtonClass = !ContainsString($this->TagClassName, "ew-multi-column-list-option-card") ? "btn-default" : "";
                    AppendClass($dropdownButtonClass, "btn dropdown-toggle");
                    $groupitem->Body = $this->renderDropDownButton($buttonValue, $pos, $dropdownButtonClass);
                    $groupitem->Visible = true;
                }
            }
            if (!$this->UseDropDownButton && $this->UseButtonGroup) { // Render button group
                $visible = false;
                $buttongroups = [];
                foreach ($this->Items as $item) {
                    if ($item->Name != $this->GroupOptionName && $item->Visible && $item->Body != "") {
                        if ($item->ShowInButtonGroup) {
                            $visible = true;
                            $buttonValue = $item->Body;
                            if (!array_key_exists($item->ButtonGroupName, $buttongroups)) {
                                $buttongroups[$item->ButtonGroupName] = "";
                            }
                            $buttongroups[$item->ButtonGroupName] .= $buttonValue;
                        } elseif ($item->Name == "listactions") { // Show listactions as button group
                            $item->Body = $this->renderButtonGroup($item->Body, $pos);
                        }
                    }
                }
                $groupitem->Body = "";
                foreach ($buttongroups as $buttongroup => $buttonValue) {
                    $groupitem->Body .= $this->renderButtonGroup($buttonValue, $pos);
                }
                if ($visible) {
                    $groupitem->Visible = true;
                }
            }
        }
        if ($templateId != "") {
            $html = "";
            if ($pos == "right" || StartsText("bottom", $pos)) { // Show all options script tags on the right/bottom (ignore left to avoid duplicate)
                $html = $this->write($part, "", $rowCnt, "block", $templateId, $templateClassName) .
                    $this->write($part, "", $rowCnt, "inline", $templateId) .
                    $this->write($part, "", $rowCnt, "single", $templateId);
            }
        } else {
            $html = $this->write($part, $pos, $rowCnt, $templateType, $templateId, $templateClassName);
        }
        if ($output) {
            echo $html;
        } else {
            return $html;
        }
    }

    // Get custom template tag
    protected function customTemplateTag($templateId, $templateType, $templateClass, $rowCnt = "")
    {
        $id = "_" . $templateId;
        if (!EmptyString($rowCnt)) {
            $id = $rowCnt . $id;
        }
        $id = "tp" . $templateType . $id;
        return "<template id=\"" . $id . "\"" . (!EmptyString($templateClass) ? " class=\"" . $templateClass . "\"" : "") . ">";
    }

    // Write list options
    protected function write($part, $pos = "", $rowCnt = "", $templateType = "block", $templateId = "", $templateClass = "")
    {
        $this->RowCnt = $rowCnt;
        $this->TemplateType = $templateType;
        $this->TemplateId = $templateId;
        $this->TemplateClassName = $templateClass;
        $res = "";
        if ($templateId != "") {
            if ($templateType != "block") {
                AppendClass($this->TagClassName, "d-inline-block");
            } else {
                RemoveClass($this->TagClassName, "d-inline-block");
            }
            if ($templateType == "block") {
                if ($part == "header") {
                    $res .= $this->customTemplateTag($templateId, "oh", $templateClass);
                } elseif ($part == "body") {
                    $res .= $this->customTemplateTag($templateId, "ob", $templateClass, $rowCnt);
                } elseif ($part == "footer") {
                    $res .= $this->customTemplateTag($templateId, "of", $templateClass);
                }
            } elseif ($templateType == "inline") {
                if ($part == "header") {
                    $res .= $this->customTemplateTag($templateId, "o2h", $templateClass);
                } elseif ($part == "body") {
                    $res .= $this->customTemplateTag($templateId, "o2b", $templateClass, $rowCnt);
                } elseif ($part == "footer") {
                    $res .= $this->customTemplateTag($templateId, "o2f", $templateClass);
                }
            }
        } else {
            if (!$pos || StartsText("top", $pos) || StartsText("bottom", $pos) || $templateType != "block") { // Use inline tag for multi-column
                AppendClass($this->TagClassName, "d-inline-block");
            }
        }
        if ($this->CustomItem != "") {
            $cnt = 0;
            $opt = null;
            foreach ($this->Items as $item) {
                if ($this->showItem($item, $templateId, $pos)) {
                    $cnt++;
                }
                if ($item->Name == $this->CustomItem) {
                    $opt = $item;
                }
            }
            $useButtonGroup = $this->UseButtonGroup; // Backup options
            $this->UseButtonGroup = true; // Show button group for custom item
            if (is_object($opt) && $cnt > 0) {
                if ($templateId != "" || $this->showPos($opt->OnLeft, $pos)) {
                    $res .= $opt->render($part, $cnt, $pos);
                } else {
                    $res .= $opt->render("", $cnt, $pos);
                }
            }
            $this->UseButtonGroup = $useButtonGroup; // Restore options
        } else {
            foreach ($this->Items as $item) {
                if ($this->showItem($item, $templateId, $pos)) {
                    $res .= $item->render($part, 1, $pos);
                }
            }
        }
        if (in_array($templateType, ["block", "inline"]) && $templateId != "") {
            $res .= "</template>"; // End <template id="...">
        }
        return $res;
    }

    // Show item
    protected function showItem($item, $templateId, $pos)
    {
        $show = $item->Visible && $this->showPos($item->OnLeft, $pos);
        if ($show) {
            if ($this->UseDropDownButton) {
                $show = ($item->Name == $this->GroupOptionName || !$item->ShowInDropDown);
            } elseif ($this->UseButtonGroup) {
                $show = ($item->Name == $this->GroupOptionName || !$item->ShowInButtonGroup);
            }
        }
        return $show;
    }

    // Show position
    protected function showPos($onLeft, $pos)
    {
        return $onLeft && $pos == "left" || !$onLeft && $pos == "right" || $pos == "" || StartsText("top", $pos) || StartsText("bottom", $pos);
    }

    /**
     * Concat options and return concatenated HTML
     *
     * @param string $pattern Regular expression pattern for matching the option names, e.g. '/^detail_/'
     * @param string $separator optional Separator
     * @return string
     */
    public function concat($pattern, $separator = "")
    {
        $ar = [];
        $keys = array_keys($this->Items);
        foreach ($keys as $key) {
            if (preg_match($pattern, $key) && trim($this->Items[$key]->Body) != "") {
                $ar[] = $this->Items[$key]->Body;
            }
        }
        return implode($separator, $ar);
    }

    /**
     * Merge options to the first option and return it
     *
     * @param string $pattern Regular expression pattern for matching the option names, e.g. '/^detail_/'
     * @param string $separator optional Separator
     * @return string
     */
    public function merge($pattern, $separator = "")
    {
        $keys = array_keys($this->Items);
        $first = null;
        foreach ($keys as $key) {
            if (preg_match($pattern, $key)) {
                if (!$first) {
                    $first = $this->Items[$key];
                    $first->Body = $this->concat($pattern, $separator);
                } else {
                    $this->Items[$key]->Visible = false;
                }
            }
        }
        return $first;
    }

    // Get button group link
    public function renderButtonGroup($body, $pos)
    {
        if (EmptyValue($body)) {
            return $body;
        }

        //$dom = new Document($body, false, strtoupper(Config('PROJECT_CHARSET')));
        $doc = new Document(null, false, strtoupper(Config('PROJECT_CHARSET')));
        $dom = @$doc->load($body); // Suppress htmlParseEntityRef warning if any

        // Get and remove <input type="hidden"> and <div class="btn-group">
        $html = array_reduce($dom->find('div.btn-group, input[type=hidden]'), function ($res, $el) {
            $res .= $el->toDocument()->format()->html();
            $el->remove();
            return $res;
        }, '');

        // Get <a> and <button>
        $btnClass = $this->ButtonClass;
        $links = array_reduce($dom->find('a, button'), function ($res, $button) use ($btnClass) {
            $class = $button->getAttribute('class');
            PrependClass($class, 'btn btn-default');
            $button->setAttribute('class', AppendClass($class, $btnClass)); // Add button classes
            return $res . $button->toDocument()->format()->html();
        }, '');
        $btngroupClass = 'btn-group btn-group-sm ew-btn-group' . (StartsText('bottom', $pos) ? ' dropup' : '');
        $btngroup = $links ? '<div class="' . $btngroupClass . '">' . $links . '</div>' : '';
        return $btngroup . $html;
    }

    // Render drop down button
    public function renderDropDownButton($body, $pos, $dropdownButtonClass)
    {
        if (EmptyValue($body)) {
            return $body;
        }

        //$dom = new Document($body, false, strtoupper(Config('PROJECT_CHARSET')));
        $doc = new Document(null, false, strtoupper(Config('PROJECT_CHARSET')));
        $dom = @$doc->load($body); // Suppress htmlParseEntityRef warning if any

        // Get and remove <div class="d-none"> and <input type="hidden">
        $html = array_reduce($dom->find('div.d-none, input[type=hidden]'), function ($res, $el) {
            $res .= $el->toDocument()->format()->html();
            $el->remove();
            return $res;
        }, '');

        // Get <a> and <button> without data-bs-toggle attribute
        $buttons = $dom->find('a:not([data-bs-toggle]), button:not([data-bs-toggle])');
        $links = '';
        $submenu = false;
        $submenulink = '';
        $submenulinks = '';
        foreach ($buttons as $button) {
            $action = $button->getAttribute('data-action');
            $classes = $button->getAttribute('class');
            if (!preg_match('/\bdropdown-item\b/', $classes)) { // Skip if already dropdown-item
                $classes = preg_replace('/btn[\S]*\s+/i', '', $classes); // Remove btn classes
                $button->removeAttribute('title'); // Remove title
                $caption = $button->text();
                $htmlTitle = HtmlTitle($caption); // Match data-caption='caption' or span.visually-hidden
                $caption = ($htmlTitle != $caption) ? $htmlTitle : $caption;
                $button->setAttribute('class', AppendClass($classes, 'dropdown-item'));
                if (SameText($button->tag, 'a') && !$button->getAttribute('href')) { // Add href for <a>
                    $button->setAttribute('href', '#');
                }
                $icon = $button->find('i.ew-icon')[0] ?? null; // Icon classes contains 'ew-icon'
                $badge = $button->find('span.badge');
                if (!$badge) { // Skip span.badge
                    if ($caption !== "" && $icon) { // Has both caption and icon
                        $classes = $icon->getAttribute('class');
                        $icon->setAttribute('class', AppendClass($classes, 'me-2')); // Add margin-right to icon
                    }
                    $children = $button->children();
                    foreach ($children as $child) {
                        $child->remove();
                    }
                    if ($icon) {
                        $button->appendChild($icon);
                    }
                    if ($caption !== "") { // Has caption
                        $button->appendChild($dom->createTextNode($caption));
                    }
                }
            }
            $link = $button->toDocument()->format()->html();
            if ($action == 'list') { // Start new submenu
                if ($submenu) { // End previous submenu
                    if ($submenulinks != '') { // Set up submenu
                        $links .= '<li class="dropdown-submenu dropdown-hover">' . str_replace('dropdown-item', 'dropdown-item dropdown-toggle', $submenulink) . '<ul class="dropdown-menu">' . $submenulinks . '</ul></li>';
                    } else {
                        $links .= '<li>' . $submenulink . '</li>';
                    }
                }
                $submenu = true;
                $submenulink = $link;
                $submenulinks = '';
            } else {
                if ($action == '' && $submenu) { // End previous submenu
                    if ($submenulinks != '') { // Set up submenu
                        $links .= '<li class="dropdown-submenu dropdown-hover">' . $submenulink . '<ul class="dropdown-menu">' . $submenulinks . '</ul></li>';
                    } else {
                        $links .= '<li>' . $submenulink . '</li>';
                    }
                    $submenu = false;
                }
                if ($submenu) {
                    $submenulinks .= '<li>' . $link . '</li>';
                } else {
                    $links .= '<li>' . $link . '</li>';
                }
            }
        }
        $btndropdown = '';
        if ($links != '') {
            if ($submenu) { // End previous submenu
                if ($submenulinks != '') { // Set up submenu
                    $links .= '<li class="dropdown-submenu dropdown-hover">' . $submenulink . '<ul class="dropdown-menu">' . $submenulinks . '</ul></li>';
                } else {
                    $links .= '<li>' . $submenulink . '</li>';
                }
            }
            $btnclass = $dropdownButtonClass;
            AppendClass($btnclass, $this->ButtonClass);
            $btngrpclass = 'btn-group btn-group-sm ew-btn-dropdown' . (StartsText('bottom', $pos) ? ' dropup' : '');
            AppendClass($btngrpclass, $this->ButtonGroupClass);
            $buttontitle = HtmlTitle($this->DropDownButtonPhrase);
            $buttontitle = ($this->DropDownButtonPhrase != $buttontitle) ? $buttontitle : "";
            $button = '<button class="' . $btnclass . '" title="' . $buttontitle . '" data-bs-toggle="dropdown" data-bs-auto-close="' . $this->DropDownAutoClose . '">' . $this->DropDownButtonPhrase . '</button>' .
                '<ul class="dropdown-menu ' . ($pos == 'right' || EndsText('end', $pos) ? 'dropdown-menu-end ' : '') . 'ew-menu">' . $links . '</ul>';
            $btndropdown = '<div class="' . $btngrpclass . '" data-table="' . $this->TableVar . '">' . $button . '</div>'; // Use dropup for bottom
        }
        return $btndropdown . $html;
    }

    // Hide detail items for dropdown
    public function hideDetailItemsForDropDown()
    {
        $showdtl = false;
        if ($this->UseDropDownButton) {
            foreach ($this->Items as $item) {
                if ($item->Name != $this->GroupOptionName && $item->Visible && $item->ShowInDropDown && !StartsString("detail_", $item->Name)) {
                    $showdtl = true;
                    break;
                }
            }
        }
        if (!$showdtl) {
            $this->hideDetailItems();
        }
    }

    // Hide detail items
    public function hideDetailItems()
    {
        foreach ($this->Items as $item) {
            if (StartsString("detail_", $item->Name)) {
                $item->Visible = false;
            }
        }
    }

    // Detail items is visible
    public function detailVisible()
    {
        foreach ($this->Items as $item) {
            if (StartsString("detail_", $item->Name) && $item->Visible) {
                return true;
            }
        }
        return false;
    }    
}
