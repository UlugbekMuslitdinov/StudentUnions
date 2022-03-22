<?php

namespace PHPMaker2022\project2;

/**
 * Sub pages class
 */
class SubPages implements \ArrayAccess
{
    public $Justified = false;
    public $Fill = false;
    public $Vertical = false;
    public $Align = ""; // "start" or "center" or "end"
    public $Style = "tabs"; // "tabs" (nav nav-tabs) or "pills" (nav nav-pills) or "" (nav) or "accordion"
    public $Classes = ""; // Other CSS classes
    public $Parent = "false"; // For the data-bs-parent attribute on each .accordion-collapse
    public $Items = [];
    public $ValidKeys = null;
    public $ActiveIndex = null;

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

    // Get .nav classes
    public function navClasses()
    {
        $style = "nav";
        if (!$this->Vertical) {
            $style .= " nav-" . $this->Style;
            if ($this->Justified) {
                $style .= " nav-justified";
            }
            if ($this->Fill) {
                $style .= " nav-fill";
            }
            if (in_array($this->Align, ["start", "center", "end"])) {
                $style .= " justify-content-" . $this->Align;
            }
        } else {
            if ($this->isPills()) { // Vertical does not support tabs
                $style .= " nav-" . $this->Style;
            }
            $style .= " flex-column me-3";
        }
        if ($this->Classes) {
            $style .= " " . $this->Classes;
        }
        return $style;
    }

    // Get .nav-link classes
    public function navLinkClasses($k)
    {
        $classes = "nav-link";
        if ($this->isActive($k)) { // Active page
            $classes .= " active";
        } else {
            $item = &$this->getItem($k);
            if ($item) {
                if (!$item->Visible) {
                    $classes .= "d-none ew-hidden";
                } elseif ($item->Disabled) {
                    $classes .= "disabled ew-disabled";
                }
            }
        }
        return $classes;
    }

    // Check if a page is active
    public function isActive($k)
    {
        return $this->activePageIndex() == $k;
    }

    // Check if accordion
    public function isAccordion()
    {
        return $this->Style == "accordion";
    }

    // Check if tabsn
    public function isTabs()
    {
        return $this->Style == "tabs";
    }

    // Check if accordion
    public function isPills()
    {
        return $this->Style == "pills";
    }

    // Check if tabs or pills
    public function isTabsOrPills()
    {
        return $this->isTabs() || $this->isPills();
    }

    // Get container classes (for .nav.lex-column)
    public function containerClasses()
    {
        return $this->Vertical ? " d-flex align-items-start" : "";
    }

    // Get tab content classes (for .tab-content)
    public function tabContentClasses()
    {
        $classes = "tab-content";
        if ($this->Vertical) {
            $classes .= " flex-grow-1";
        }
        return $classes;
    }

    // Get active classes (for .nav-link if tabs/pills or .accordion-collapse if accordion)
    public function activeClasses($k)
    {
        if ($this->isActive($k)) { // Active page
            if ($this->isTabsOrPills()) { // "tabs" or "pills"
                return " active";
            } elseif ($this->isAccordion()) { // accordion
                return " show";
            }
        }
        return "";
    }

    // Get .tab-pane classes (for .tab-pane if tabs/pills)
    public function tabPaneClasses($k)
    {
        $classes = "tab-pane fade";
        if ($this->isActive($k)) { // Active page
            $classes .= " active show";
        }
        return $classes;
    }

    // Get count
    public function count()
    {
        return count($this->Items);
    }

    // Add item by name
    public function &add($name = "")
    {
        $item = new SubPage();
        if (strval($name) != "") {
            $this->Items[$name] = $item;
        }
        if (!is_int($name)) {
            $this->Items[] = $item;
        }
        return $item;
    }

    // Get item by key
    public function &getItem($k)
    {
        $item = $this->Items[$k] ?? null;
        return $item;
    }

    // Active page index
    public function activePageIndex()
    {
        if ($this->ActiveIndex !== null) {
            return $this->ActiveIndex;
        }

        // Return first active page
        foreach ($this->Items as $key => $item) {
            if ((!is_array($this->ValidKeys) || in_array($key, $this->ValidKeys)) && $item->Visible && !$item->Disabled && $item->Active && $key !== 0) { // Not common page
                $this->ActiveIndex = $key;
                return $this->ActiveIndex;
            }
        }

        // If not found, return first visible page
        foreach ($this->Items as $key => $item) {
            if ((!is_array($this->ValidKeys) || in_array($key, $this->ValidKeys)) && $item->Visible && !$item->Disabled && $key !== 0) { // Not common page
                $this->ActiveIndex = $key;
                return $this->ActiveIndex;
            }
        }

        // Not found
        return null;
    }
}
