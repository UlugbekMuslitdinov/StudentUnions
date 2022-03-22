<?php

namespace PHPMaker2022\project1;

// Debug timer
class Timer
{
    public $StartTime;
    public static $Template = '<p class="text-info">Page processing time: {time} seconds</p>';

    // Constructor
    public function __construct($start = true)
    {
        if ($start) {
            $this->start();
        }
    }

    // Get time
    protected function getTime()
    {
        return microtime(true);
    }

    // Get elapsed time
    public function getElapsedTime()
    {
        $curtime = $this->getTime();
        if (isset($curtime) && isset($this->StartTime) && $curtime > $this->StartTime) {
            return $curtime - $this->StartTime;
        } else {
            return 0;
        }
    }

    // Get formatted elapsed time
    public function getFormattedElapsedTime()
    {
        $time = $this->getElapsedTime();
        return number_format($time, 6);
    }

    // Get script start time
    public function start()
    {
        if (Config("DEBUG")) {
            $this->StartTime = $this->getTime();
        }
    }

    // Display elapsed time (in seconds)
    public function stop()
    {
        if (Config("DEBUG")) {
            $time = $this->getFormattedElapsedTime();
            echo str_replace("{time}", $time, self::$Template);
        }
    }
}
