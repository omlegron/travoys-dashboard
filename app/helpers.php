<?php
if(!function_exists('sizing')) {
    function sizing($size) {
        $selectedSize   = 0;
        $selectedUnit   = "b";
        $sizeBase       = 1000;

        if ($size > 0) {
            $units = ['tb', 'gb', 'mb', 'kb', 'b'];

            for ($i = 0; $i < count($units); $i++) {
              $unit = $units[$i];
              $cutoff = pow($sizeBase, 4 - $i) / 10;

              if ($size >= $cutoff) {
                    $selectedSize = $size / pow($sizeBase, 4 - $i);
                    $selectedUnit = $unit;
                    break;
                }
            }

            $selectedSize = round(10 * $selectedSize) / 10; // Cutting of digits
        }

        return $selectedSize." ".strtoupper($selectedUnit);
    }
}

if(!function_exists('moonToInt')) {
    function moonToInt($val, $number = true) {
        if($number !== true){
            $string = "";
            switch ($val) {
                case 1:
                    $string = "January";
                break;
                case 2:
                    $string = "February";
                break;
                case 3:
                    $string = "March";
                break;
                case 4:
                    $string = "April";
                break;
                case 5:
                    $string = "May";
                break;
                case 6:
                    $string = "June";
                break;
                case 7:
                    $string = "July";
                break;
                case 8:
                    $string = "August";
                break;
                case 9:
                    $string = "September";
                break;
                case 10:
                    $string ="October" ;
                break;
                case 11:
                    $string ="November" ;
                break;
                case 12:
                    $string ="December" ;
                break;
            }
            return $string;
        }else{
            $int = 0;
            switch ($val) {
                case 'January':
                    $int = 1;
                break;
                case 'February':
                    $int = 2;
                break;
                case 'March':
                    $int = 3;
                break;
                case 'April':
                    $int = 4;
                break;
                case 'May':
                    $int = 5;
                break;
                case 'June':
                    $int = 6;
                break;
                case 'July':
                    $int = 7;
                break;
                case 'August':
                    $int = 8;
                break;
                case 'September':
                    $int = 9;
                break;
                case 'October':
                    $int = 10;
                break;
                case 'November':
                    $int = 11;
                break;
                case 'December':
                    $int = 12;
                break;
            }
            return $int;
        }
    }
}


if(!function_exists('moonNumber')) {
    function moonNumber() {
        $int = [1,2,3,4,5,6,7,8,9,10,11,12];

        return $int;
    }
}

if(!function_exists('getpecahan')) {
    function getpecahan() {
        $int = [
            [
                'pecahan' => '100.000',
                'type'    => 'k'
            ],
            [
                'pecahan' => '50.000',
                'type'    => 'k'
            ],
            [
                'pecahan' => '20.000',
                'type' => 'k'
            ],
            [
                'pecahan' => '10.000',
                'type'    => 'k'
            ],
            [
                'pecahan' => '5.000',
                'type'    => 'k'
            ],
            [
                'pecahan' => '2.000',
                'type'    => 'k'
            ],
            [
                'pecahan' => '1.000',
                'type'    => 'k'
            ],
            [
                'pecahan' => '1.000',
                'type'    => 'l'
            ],
            [
                'pecahan' => '500',
                'type'    => 'l'
            ],
            [
                'pecahan' => '200',
                'type'    => 'l'
            ],
            [
                'pecahan' => '100',
                'type'    => 'l'
            ],
            [
                'pecahan' => '50',
                'type'    => 'l'
            ]
        ];

        return $int;
    }
}

if (!function_exists('last_day')) {
    function last_day($year, $month)
    {
        return cal_days_in_month(CAL_GREGORIAN, $month, $year);
    }
}
