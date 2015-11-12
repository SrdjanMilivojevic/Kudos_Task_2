<?php

class Kalendar
{
    // Singleton patern
    private static $_instance = null;

    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new self; // No need to explicitly call Kalendar class
        }

        return self::$_instance;
    }

    public function __construct()
    {
        $date = time();
        // Start by defining day month and the year for our calaendar.
        // Since we need functionality of switching trouhg months, for month var we need to check first if
        // $_GET var is set. If not so, month will me current month.
        $day = date('d', $date);
        $month = isset($_GET['month']) && is_numeric($_GET['month']) ? $_GET['month'] : date('m', $date);
        $year = date('Y', $date);
        // Get a unix timestamp for a first day of afjusted month and yeear.
        $first_day = mktime(0, 0, 0, $month, 1, $year);
        // Get the string version of month for our title.
        $title_month = date('F', $first_day);
        // Get the string version of day.
        $day_of_week = date('D', $first_day);

        // Now we need to define from where will our first day of the month in a weeks day start.
        // Example : if Wednesday - it will start with 2 blank spaces.
        switch ($day_of_week) {
            case 'Mon':$blank = 0;
                break;
            case 'Tue':$blank = 1;
                break;
            case 'Wed':$blank = 2;
                break;
            case 'Thu':$blank = 3;
                break;
            case 'Fri':$blank = 4;
                break;
            case 'Sat':$blank = 5;
                break;
            case 'Sun':$blank = 6;
                break;
        }
        // Get the number of days in the month of the year.
        $days_in_month = cal_days_in_month(0, $month, $year);
        // Set the previousd and next month links.
        // If month is 12th next will be 1st. etc.
        $prev_month = $month == 1 ? 12 : $this->prevMonth($month);
        $next_month = $month == 12 ? 1 : $this->nextMonth($month);
        // Render links and table header.
        echo '<table>';
        echo '<tr><th colspan="2"><a href="?month=' . $prev_month . '"><b>< </b> previous</a> </th><th colspan="3">' . $title_month . ' ' . $year . '</th> <th colspan="2"><a href="?month=' . $next_month . '">next <b> ></b></a> </th></tr>';
        echo '<tr><td>Mon</td><td>Tue</td><td>Wed</td><td>Thu</td><td>Fri</td><td>Sat</td><td>Sun</td></tr>';
        // Set the day counter.
        $day_count = 1;

        echo '<tr>';
        // If blank is higher then zero, put empty cells for number of blank spaces.
        while ($blank > 0) {
            echo '<td></td>';
            --$blank;
            $day_count++;
        }

        $day_num = 1;
        // We start from day 1 and iterate integer untill it equals the number of days in the month.
        // We will check if the day eqals today & month equals this month so we can higlight it.
        // render the table cells containing the day. When day in the week reachs 7 we start rendering a new row.
        while ($day_num <= $days_in_month) {
            if ($day_num == $day && $month == date('m', $date)) {
                echo '<td style="background-color:#FFE0B2; color:green;"><b>' . $day_num . '</b></td>';
            } else {
                echo '<td>' . $day_num . '</td>';
            }
            $day_num++;
            $day_count++;
            if ($day_count > 7) {
                echo '</tr><tr>';
                $day_count = 1;
            }
        }
        // When last day in month is rendered we will proceed rendering empty cells for the rest days of
        // the week and close out table tag.
        while ($day_count < 1 && $day_count <= 7) {
            echo '<td></td>';
            $day_count++;
        }
        echo '</tr></table>';
    }

    /**
     * Encapsulated negative iteration
     * @param  int $month
     * @return int $month
     */
    private function prevMonth($month)
    {
        return --$month;
    }

    /**
     * Encapsulated positive iteration
     *
     * @param  int $month
     * @return int $month
     */
    private function nextMonth($month)
    {
        return ++$month;
    }
}
