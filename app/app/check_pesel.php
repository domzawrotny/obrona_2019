<?php
class CheckPesel {

    public function checkLength($pesel) {
        if (strlen($pesel)==11) {

            if(is_numeric($pesel)) {
                return true;
            }
            else {
                return false;
            }

        }
        else {
            return false;
        }

    }

    function getDateFromPesel($pesel){

        $pesel = $pesel + 0;
        // Wyciągamy dzień i miesiąc
        $month=substr($pesel,2,2);
        $day = substr($pesel,4,2);




        // Budujemy tablicę miesięcy dozwolonych
        $arrAdditionalMonths = Array(80,0,20,40,60);

        $arrBaseMonths = range(1,12);
        foreach ($arrAdditionalMonths as $additionalMonth){
            foreach ($arrBaseMonths as $baseMonth){
                $arrMonths[]=$additionalMonth+$baseMonth;
            }
        }

        // Odrzucamy nieprawidłowo podane miesiące
        if (!in_array($month,$arrMonths)) {
            return false;
            exit();
        }

        // Ustalamy stulecie
        if (substr($month,0,1)=='0' || substr($month,0,1)=='1') $century = 1900;
        if (substr($month,0,1)=='8' || substr($month,0,1)=='9') $century = 1800;
        if (substr($month,0,1)=='2' || substr($month,0,1)=='3') $century = 2000;
        if (substr($month,0,1)=='5' || substr($month,0,1)=='4') $century = 2100;
        if (substr($month,0,1)=='6' || substr($month,0,1)=='7') $century = 2200;
        if ($century=='2000') $month =- 20;
        if ($century=='1800') $month =- 80;
        if ($century=='2100') $month =- 40;
        if ($century=='2200') $month =- 60;

        // Ustalamy ostatecznie rok
        $year=$century+substr($pesel,0,2);

        $maxDays = cal_days_in_month(CAL_GREGORIAN,$month,$year);

        if ($maxDays < $day) {
            return false;
            exit();
        }

        $fullDate = $year . "-" . $month . "-" . "$day";

        $currentDate = new DateTime();

        $interval = date_diff($currentDate,new DateTime($fullDate))->format('%R%a');

        if ($interval >= 0 ) {
            return false;
            exit();
        }


        return $fullDate;
    }

}