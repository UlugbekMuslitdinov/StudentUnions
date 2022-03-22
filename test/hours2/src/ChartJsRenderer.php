<?php

namespace PHPMaker2022\project1;

/**
 * Chart.js renderer
 */
class ChartJsRenderer implements ChartRendererInterface
{
    public $Chart;
    public $Data;
    public $Options;
    static $DefaultWidth = 600;
    static $DefaultHeight = 500;

    // Constructor
    public function __construct($chart)
    {
        $this->Chart = $chart;
        $this->Options = new \Dflydev\DotAccessData\Data();
    }

    // Get chart Canvas
    public function getContainer($width, $height)
    {
        $id = $this->Chart->ID; // Chart ID
        return '<div id="div_' . $id . '" class="ew-chart-container"><canvas id="chart_' . $id . '" width="' . $width . '" height="' . $height . '" class="ew-chart-canvas"></canvas></div>';
    }

    // Get chart JavaScript
    public function getScript($width, $height)
    {
        $drilldown = $this->Chart->DrillDownInPanel;
        $typ = $this->Chart->Type ?: ChartTypes::$DefaultType; // Chart type (nnnn)
        $id = $this->Chart->ID; // Chart ID
        $tblVar = $this->Chart->TableVar; // Table variable name
        $chartVar = $this->Chart->ChartVar; // Chart variable name
        // $scroll = $this->Chart->ScrollChart; // Not supported
        // $trends = $this->Chart->Trends;
        // $series = $this->Chart->Series;
        // $align = $this->Chart->Align;
        $chartType = ChartTypes::getName($typ); // Chart type name
        $canvasId = "chart_" . $id;
        $this->loadChart();
        $chartData = ["type" => $chartType, "data" => $this->Data, "options" => $this->Options->export()];

        // Output JavaScript for Chart.js
        $dataformat = $this->Chart->DataFormat;
        $chartid = "chart_$id" . ($drilldown ? "_" . Random() : "");
        $yFieldFormat = $this->Chart->YFieldFormat;
        $yAxisFormat = $this->Chart->YAxisFormat;
        $args = [
            "id" => $id,
            "canvasId" => $canvasId,
            "chartJson" => $chartData,
            "yFieldFormat" => $yFieldFormat,
            "yAxisFormat" => $yAxisFormat,
            "useDrilldownPanel" => null
        ];
        if ($this->Chart->DrillDownUrl != "") {
            $args["useDrilldownPanel"] = $this->Chart->UseDrillDownPanel;
        }
        if ($this->Chart->isPieChart() || $this->Chart->isDoughnutChart()) {
            $args["showPercentage"] = $this->Chart->ShowPercentage;
        }
        $wrk = "<script>ew.createChart(" . JsonEncode($args) . ");</script>";

        // Show data for debug
        if (Config("DEBUG")) {
            $chartJson = JsonEncode($chartData);
            $chartJson = json_encode(json_decode(ConvertToUtf8($chartJson)), JSON_PRETTY_PRINT); // Pretty print
            SetDebugMessage("(Chart JSON):<pre>" . HtmlEncode(ConvertFromUtf8($chartJson)) . "</pre>");
        }
        return $wrk;
    }

    // Load chart
    protected function loadChart()
    {
        $chtType = $this->Chart->loadParameter("type");
        $chartSeries = $this->Chart->Series;
        $chartData = $this->Chart->ViewData;
        $multiSeries = $this->Chart->isSingleSeries() ? 0 : 1; // $multiSeries = 1 (Multi series charts)
        $seriesType = $this->Chart->loadParameter("seriestype");

        // Load default options
        $this->Options->import($this->Chart->getParameters("options"));

        // chartjs-plugin-datalabels options
        // https://chartjs-plugin-datalabels.netlify.app/guide/options.html
        $this->Options["plugins.datalabels.clamp"] = true;
        $title = $this->Chart->loadParameter("caption");

        // Initialise X / Y Axes
        $yAxes = [];
        $x = [];
        $y = [];
        $scale = $this->Chart->getParameters("scale"); // Default bar chart scale

        // Set up beginAtZero / min / max // chartjs 3
        $vscale = [];
        if ($this->Chart->ScaleBeginWithZero) {
            $vscale["beginAtZero"] = true;
        }
        if ($this->Chart->MinValue !== null) {
            $vscale["min"] = $this->Chart->MinValue;
        }
        if ($this->Chart->MaxValue !== null) {
            $vscale["max"] = $this->Chart->MaxValue;
        }
        if (is_array($chartData)) {
            // Multi series
            if ($multiSeries == 1) {
                $labels = [];
                $datasets = [];

                // Multi-Y values
                if ($seriesType == "1") {
                    // Set up labels
                    $cntCat = count($chartData);
                    for ($i = 0; $i < $cntCat; $i++) {
                        $name = $this->Chart->formatName($chartData[$i][0]);
                        $labels[] = $name;
                    }

                    // Set up datasets
                    $cntData = count($chartData);
                    $cntSeries = count($chartSeries);
                    if ($cntData > 0 && is_array($chartData[0]) && $cntSeries > count($chartData[0]) - 2) {
                        $cntSeries = count($chartData[0]) - 2;
                    }
                    for ($i = 0; $i < $cntSeries; $i++) {
                        $seriesName = (is_array($chartSeries[$i])) ? $chartSeries[$i][0] : $chartSeries[$i];
                        $yAxisId = (is_array($chartSeries[$i])) ? $chartSeries[$i][1] : "";
                        if (!EmptyString($yAxisId) && !in_array($yAxisId, array_column($yAxes, "id"))) { // Dual axis
                            $yAxes[$yAxisId] = ["type" => "linear", "display" => true, "position" => $yAxisId == "P" ? "left" : "right"];
                            if ($yAxisId != "P") {
                                $yAxes[$yAxisId]["grid"] = ["drawOnChartArea" => false];
                            }
                        }
                        $color = $this->Chart->getPaletteRgbaColor($i);
                        $renderAs = $this->Chart->getRenderAs($i);
                        $showSeries = Config("CHART_SHOW_BLANK_SERIES");
                        $data = [];
                        $links = [];
                        for ($j = 0; $j < $cntData; $j++) {
                            $val = $chartData[$j][$i + 2];
                            $val = ($val === null) ? 0 : (float)$val;
                            if ($val != 0) {
                                $showSeries = true;
                            }
                            $lnk = $this->getChartLink($this->Chart->DrillDownUrl, $this->Chart->Data[$j]);
                            $links[] = $lnk;
                            $data[] = $val;
                        }
                        if ($showSeries) {
                            $dataset = $this->getDataset($data, $color, $links, $seriesName, $renderAs, $yAxisId);
                            $datasets[] = $dataset;
                        }
                    }

                // Series field
                } else {
                    // Get series names
                    if (is_array($chartSeries)) {
                        $cntSeries = count($chartSeries);
                    } else {
                        $cntSeries = 0;
                    }

                    // Set up labels
                    $cntData = count($chartData);
                    for ($i = 0; $i < $cntData; $i++) {
                        $name = $chartData[$i][0];
                        if (!in_array($name, $labels)) {
                            $labels[] = $name;
                        }
                    }

                    // Set up dataset
                    $cntLabels = count($labels);
                    $cntData = count($chartData);
                    for ($i = 0; $i < $cntSeries; $i++) {
                        $seriesName = (is_array($chartSeries[$i])) ? $chartSeries[$i][0] : $chartSeries[$i];
                        $yAxisId = (is_array($chartSeries[$i])) ? $chartSeries[$i][1] : "";
                        if (!EmptyString($yAxisId) && !in_array($yAxisId, array_column($yAxes, "id"))) { // Dual axis
                            $yAxes[$yAxisId] = ["type" => "linear", "display" => true, "position" => $yAxisId == "P" ? "left" : "right"];
                            if ($yAxisId != "P") {
                                $yAxes[$yAxisId]["grid"] = ["drawOnChartArea" => false];
                            }
                        }
                        $color = $this->Chart->getPaletteRgbaColor($i);
                        $renderAs = $this->Chart->getRenderAs($i);
                        $showSeries = Config("CHART_SHOW_BLANK_SERIES");
                        $data = [];
                        $links = [];
                        for ($j = 0; $j < $cntLabels; $j++) {
                            $val = 0;
                            $lnk = "";
                            for ($k = 0; $k < $cntData; $k++) {
                                if ($chartData[$k][0] == $labels[$j] && $chartData[$k][1] == $seriesName) {
                                    $val = $chartData[$k][2];
                                    $val = ($val === null) ? 0 : (float)$val;
                                    if ($val != 0) {
                                        $showSeries = true;
                                    }
                                    $lnk = $this->getChartLink($this->Chart->DrillDownUrl, $this->Chart->Data[$k]);
                                    $links[] = $lnk;
                                    break;
                                }
                            }
                            $data[] = $val;
                        }
                        if ($showSeries) {
                            $dataset = $this->getDataset($data, $color, $links, $seriesName, $renderAs, $yAxisId);
                            $datasets[] = $dataset;
                        }
                    }
                }

                // Set up Data/Options
                $this->Data = ["labels" => $labels, "datasets" => $datasets];
                $this->Options->import(["responsive" => false, "plugins" => ["legend" => ["display" => true], "title" => ["display" => true, "text" => $title]]]);
                // Set up tooltips for stacked charts
                if ($this->Chart->isStackedChart()) {
                    $this->Options["tooltips"] = ["mode" => "index"];
                }

                // Set up X/Y Axes
                if ($this->Chart->isCombinationChart()) {
                    if (count($scale) > 0) {
                        $x = $scale;
                    }
                    if (count($vscale) > 0) {
                        $y = $vscale;
                    }
                } else {
                    $stack = $this->Chart->isStackedChart() ? ["stacked" => true] : [];
                    $arx = $stack;
                    $ary = $stack;
                    if ($this->Chart->isColumnChart()) {
                        $arx = array_replace_recursive($scale, $arx);
                        $ary = array_replace_recursive($vscale, $ary);
                    } elseif ($this->Chart->isBarChart()) {
                        $arx = array_replace_recursive($vscale, $arx);
                        $ary = array_replace_recursive($scale, $ary);
                    }
                    if (count($arx) > 0) {
                        $x = $arx;
                    }
                    if (count($ary) > 0) {
                        $y = $ary;
                    }
                }

            // Single series
            } else {
                $cntData = count($chartData);
                $labels = [];
                $backgroundColor = [];
                $data = [];
                $links = [];
                for ($i = 0; $i < $cntData; $i++) {
                    $name = $this->Chart->formatName($chartData[$i][0]);
                    $color = $this->Chart->getPaletteRgbaColor($i);
                    if ($chartData[$i][1] != "") {
                        $name .= ", " . $chartData[$i][1];
                    }
                    $val = $chartData[$i][2];
                    $val = ($val === null) ? 0 : (float)$val;
                    $lnk = $this->getChartLink($this->Chart->DrillDownUrl, $this->Chart->Data[$i]);
                    $links[] = $lnk;
                    $labels[] = $name;
                    $backgroundColor[] = $color;
                    $data[] = $val;
                }

                // Set bar defaults
                if ($this->Chart->isColumnChart()) {
                    if (count($scale) > 0) {
                        $x = $scale;
                    }
                    if (count($vscale) > 0) {
                        $y = $vscale;
                    }
                } elseif ($this->Chart->isBarChart()) {
                    if (count($scale) > 0) {
                        $y = $scale;
                    }
                    if (count($vscale) > 0) {
                        $x = $vscale;
                    }
                }

                // Line/Area chart, use first color
                if ($this->Chart->isLineChart() || $this->Chart->isAreaChart()) {
                    $backgroundColor = $this->Chart->getPaletteRgbaColor(0); // Use first color
                }

                // Get dataset
                $datasets = $cntData > 0 ? [$this->getDataset($data, $backgroundColor, $links)] : [];

                // Set up Data/Options
                $this->Data = ["labels" => $labels, "datasets" => $datasets];
                $showLegend = $this->Chart->isPieChart() || $this->Chart->isDoughnutChart() ? true : false;
                $this->Options->import(["responsive" => false, "plugins" => ["legend" => ["display" => $showLegend], "title" => ["display" => true, "text" => $title]]]);
            }

            // Set up indexAxis = y for horizontal bar charts
            if ($this->Chart->isBarChart()) {
                $this->Options["indexAxis"] = "y";
            }

            // Set X / Y Axes
            $scales = [];
            if (count($x) > 0) {
                $scales = ["x" => $x];
            }
            if (count($y) > 0) {
                $scales = ["y" => $y];
            }
            if (count($yAxes) > 0) {
                $scales = array_merge_recursive($scales, $yAxes);
            }
            $this->Options["scales"] = $scales;

            // Set up trend lines
            $annotations = $this->getAnnotations();
            if (is_array($annotations)) {
                $plugins = @$this->Options["plugins"];
                $this->Options["plugins"] = array_merge_recursive(is_array($plugins) ? $plugins : [], [ "annotation" => $annotations ]);
            }
        }

        // Chart_Rendered event
        if (method_exists($this->Chart, "chartRendered")) {
            $this->Chart->chartRendered($this);
        }
    }

    // Get annotations
    protected function getAnnotations()
    {
        if (is_array($this->Chart->Trends)) {
            $ar = [];
            $i = 0;
            foreach ($this->Chart->Trends as $trend) {
                $i++;
                $ar["line" . $i] = $this->getAnnotation($trend);
            }
            return ["annotations" => $ar];
        }
        return null;
    }

    // Get annotation
    protected function getAnnotation($trend)
    {
        $ar = [];
        if (is_array($trend)) {
            $ar["type"] = "line"; // Line annotation
            $startValue = @$trend[0]; // Start value
            $ar["value"] = $startValue;
            $endValue = @$trend[1]; // End value
            if ($endValue) {
                $ar["endValue"] = $endValue;
            }
            $color = @$trend[2]; // Color
            $alpha = @$trend[5]; // Alpha
            $opacity = GetOpacity($alpha);
            $color = GetRgbaColor($color, $opacity);
            $ar["borderColor"] = $color; // Color
            $label = @$trend[3] ? $trend[3] : $startValue; // Display value (label)
            if ($label) {
                $ar["label"] = ["enabled" => true, "backgroundColor" => $color, "position" => "right", "content" => $label];
            }
            $ar["borderWidth"] = @$trend[4]; // Thickness
            $axis = $this->Chart->isBarChart() ? "x" : "y"; // Axis type
            $id = @$trend[6] == "S" ? "1" : ""; // Secondary / Primary axis id
            $ar["scaleID"] = $axis . $id;
            $ar["mode"] = $axis == "x" ? "vertical" : "horizontal";
        }
        return $ar;
    }

    // Get chart link
    protected function getChartLink($src, $row)
    {
        if ($src != "" && is_array($row)) {
            global $Language;
            $cntrow = count($row);
            $lnk = $src;
            $sdt = $this->Chart->SeriesDateType;
            $xdt = $this->Chart->XAxisDateFormat;
            if ($sdt != "") {
                $xdt = $sdt;
            }
            if (preg_match("/&t=([^&]+)&/", $lnk, $m)) {
                $tblCaption = $Language->tablePhrase($m[1], "TblCaption");
            } else {
                $tblCaption = "";
            }
            for ($i = 0; $i < $cntrow; $i++) { // Link format: %i:Parameter:FieldType%
                if (preg_match("/%" . $i . ":([^%:]*):([\d]+)%/", $lnk, $m)) {
                    $fldtype = FieldDataType($m[2]);
                    if ($i == 0) { // Format X SQL
                        $lnk = str_replace($m[0], Encrypt($this->Chart->getXSql("@" . $m[1], $fldtype, $row[$i], $xdt)), $lnk);
                    } elseif ($i == 1) { // Format Series SQL
                        $lnk = str_replace($m[0], Encrypt($this->Chart->getSeriesSql("@" . $m[1], $fldtype, $row[$i], $sdt)), $lnk);
                    } else {
                        $lnk = str_replace($m[0], Encrypt("@" . $m[1] . " = " . QuotedValue($row[$i], $fldtype, $this->Chart->Table->Dbid)), $lnk);
                    }
                }
            }
            return ["url" => $lnk, "id" => $this->Chart->ID, "hdr" => $tblCaption];
        }
        return null;
    }

    protected function getDataset($data, $color, $links, $seriesName = null, $renderAs = "", $yAxisId = "")
    {
        $dataset = $this->Chart->getParameters("dataset"); // Load default dataset options
        $dataset["data"] = $data; // Load data
        $dataset["backgroundColor"] = $color; // Background color
        $changeAlpha = function ($c) {
            return preg_replace('/[\d\.]+(?=\))/', "1.0", $c); // Change alpha to 1.0
        };
        if (is_array($color)) {
            $borderColor = array_map($changeAlpha, $color);
            $dataset["borderColor"] = $borderColor;
            $dataset["borderWidth"] = 1;
        } elseif (is_string($color)) {
            $dataset["borderColor"] = $changeAlpha($color);
            $dataset["borderWidth"] = 1;
        }
        $hasLink = count(array_filter($links)) > 0;
        $dataset["links"] = $hasLink ? $links : null; // Drill down link
        if ($seriesName !== null) { // Multi series
            $dataset["label"] = $seriesName;
            if ($this->Chart->isCombinationChart()) { // Combination chart, set render type / stack id / axis id
                $renderType = $this->getRenderType($renderAs);
                $dataset["type"] = $renderType;
                if ($renderType == "bar" && $this->Chart->isStackedChart()) { // Set up stack id
                    $dataset["stack"] = $this->Chart->ID;
                }
                if ($this->Chart->isDualAxisChart()) { // Set up axis id
                    $dataset["yAxisID"] = $yAxisId;
                }
            } elseif ($this->Chart->isStackedChart()) { // Stacked chart, set up stack id
                $dataset["stack"] = $this->Chart->ID;
            }
        }
        if ($this->Chart->isAreaChart() || $this->Chart->isCombinationChart() && SameText($renderAs, "area")) { // Area chart, set fill
            $dataset["fill"] = true;
        }
        return $dataset;
    }

    // Get render type for combination chart
    protected function getRenderType($renderAs)
    {
        if (SameText($renderAs, "column")) {
            return "bar";
        } elseif (SameText($renderAs, "line") || SameText($renderAs, "area") && !$this->Chart->isStackedChart()) {
            return "line";
        } else { // Default
            return "bar";
        }
    }
}
