<?php

namespace PHPMaker2022\project3;

/**
 * Export to Word
 */
class ExportReportWord
{
    // Export
    public function __invoke($page, $html)
    {
        global $ExportFileName;
        $charset = Config("PROJECT_CHARSET");
        header("Content-Type: application/msword" . ($charset ? "; charset=" . $charset : ""));
        header("Content-Disposition:"attachment; filename=" . $ExportFileName . ".doc");
        echo $html;
        exit();
    }
}
