<?php

namespace PHPMaker2022\project1;

/**
 * Export to Word
 */
class ExportWord extends ExportBase
{
    // Export
    public function export()
    {
        global $ExportFileName;
        if (!Config("DEBUG") && ob_get_length()) {
            ob_end_clean();
        }
        AddHeader('Content-Type', 'application/msword' . ((Config("PROJECT_CHARSET") != '') ? '; charset=' . Config("PROJECT_CHARSET") : ''));
        AddHeader('Content-Disposition', 'attachment; filename=' . $ExportFileName . '.doc');
        if (SameText(Config("PROJECT_CHARSET"), "utf-8")) {
            Write("\xEF\xBB\xBF");
        }
        Write($this->Text);
    }
}
