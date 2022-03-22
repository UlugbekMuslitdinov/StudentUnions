<?php

namespace PHPMaker2022\project1;

/**
 * Class for export to PDF
 */
class ExportReportPdf
{
    public static $StreamOptions = ["Attachment" => 1]; // 0 to open in browser, 1 to download
    public static $Options = [];

    // Get style tag
    public static function styleTag()
    {
        $pdfcss = Config("PDF_STYLESHEET_FILENAME");
        if ($pdfcss != "") {
            $path = __DIR__ . "/../" . $pdfcss;
            $content = file_get_contents($path);
            if ($content) {
                return "<style>" . $content . "</style>\r\n";
            }
        }
        return "";
    }

    // Export
    public function __invoke($page, $html)
    {
        global $ExportFileName;
        @ini_set("memory_limit", Config("PDF_MEMORY_LIMIT"));
        @set_time_limit(Config("PDF_TIME_LIMIT"));
        $html = CheckHtml($html);
        $html = str_replace("</head>", self::styleTag() . "</head>", $html);
        if (Config("DEBUG")) {
            $html = str_replace("</body>", GetDebugMessage() . "</body>", $html);
        }
        $options = new \Dompdf\Options(self::$Options);
        $options->set("pdfBackend", "CPDF");
        $options->set('isRemoteEnabled', true); // Support remote images such as s3
        $chroot = $options->getChroot();
        $chroot[] = UploadTempPath();
        $options->setChroot($chroot);
        $dompdf = new \Dompdf\Dompdf($options);
        $doc = new \DOMDocument("1.0", "utf-8");
        @$doc->loadHTML('<?xml encoding="utf-8">' . ConvertToUtf8($html)); // Convert to utf-8
        $spans = $doc->getElementsByTagName("span");
        foreach ($spans as $span) {
            $classNames = $span->getAttribute("class");
            if ($classNames == "ew-filter-caption") { // Insert colon
                $span->parentNode->insertBefore($doc->createElement("span", ":&nbsp;"), $span->nextSibling);
            } elseif (preg_match('/\bicon\-\w+\b/', $classNames)) { // Remove icons
                $span->parentNode->removeChild($span);
            }
        }
        $images = $doc->getElementsByTagName("img");
        $pageSize = $page->ExportPageSize;
        $pageOrientation = $page->ExportPageOrientation;
        $portrait = SameText($pageOrientation, "portrait");
        foreach ($images as $image) {
            $imagefn = $image->getAttribute("src");
            if (file_exists($imagefn)) {
                $imagefn = realpath($imagefn);
                $size = getimagesize($imagefn); // Get image size
                if ($size[0] != 0) {
                    if (SameText($pageSize, "letter")) { // Letter paper (8.5 in. by 11 in.)
                        $w = $portrait ? 216 : 279;
                    } elseif (SameText($pageSize, "legal")) { // Legal paper (8.5 in. by 14 in.)
                        $w = $portrait ? 216 : 356;
                    } else {
                        $w = $portrait ? 210 : 297; // A4 paper (210 mm by 297 mm)
                    }
                    $w = min($size[0], ($w - 20 * 2) / 25.4 * 72 * Config("PDF_IMAGE_SCALE_FACTOR")); // Resize image, adjust the scale factor if necessary
                    $h = $w / $size[0] * $size[1];
                    $image->setAttribute("width", $w);
                    $image->setAttribute("height", $h);
                }
            }
        }
        $html = $doc->saveHTML();
        $html = ConvertFromUtf8($html);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($pageSize, $pageOrientation);
        $dompdf->render();
        $exportFile = EndsText(".pdf", $ExportFileName) ? $ExportFileName : $ExportFileName . ".pdf";
        $dompdf->stream($exportFile, self::$StreamOptions); // 0 to open in browser, 1 to download
        DeleteTempImages();
    }

    // Destructor
    public function __destruct()
    {
        DeleteTempImages();
    }
}
