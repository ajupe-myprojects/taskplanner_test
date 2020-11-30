<?php

namespace App\helpers;

use DateInterval;
use DateTime;

class Calendar
{
    public function get_seven_days()
    {
        $seven_days = [];
        for($i = 0; $i < 7; $i++)
        {
            $tmp_day = new DateTime();

            $tmp_day-add(new DateInterval('P'.$i.'D'));

            $seven_days[$tmp_day->format('D')] = $tmp_day->format('d-m-Y');

        }

        return $seven_days;
    }

} 