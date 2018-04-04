<?php

class DateHelper{

    public $weekDays =  ['Thu', "Fri", "Sat", 'Sun', 'Mon', 'Tue', 'Wed'];
    public $weekStartDay = 'Mon';

    function weekStartAndEndDates(){


        $weekEndDay = $this->getWeekLastDay($this->weekStartDay);
        $weekStartDate = '';
        $weekEndDate = '';
        $date = date('Y-m-d');

        if(date('D')==$weekEndDay){

            $weekEndDate = $date;
            $weekStartDate = $this->getDateOfDay($weekEndDay, $date, '-');


        }
        else if(date('D')==$this->weekStartDay){

            $weekStartDate = $date;
            $weekEndDate = $this->getDateOfDay($this->weekStartDay, $date, '+');

        }else{

            $weekStartDate = $this->getDateOfDay($this->weekStartDay, $date, '-');
            $weekEndDate = $this->getDateOfDay($weekEndDay, $date, '+');
        }

        return [$weekStartDate, $weekEndDate];
    }

    function getDateOfDay($dayName, $fromDate, $iterationDirection){


        if(!$dayName || !$iterationDirection){
            return false;
        }


        $loopDayName = '';

        while($loopDayName!=$dayName){

            $iteratedDate = strtotime($fromDate.' '.$iterationDirection.'1 day');
            $loopDayName = date('D', $iteratedDate);
            $fromDate = date('Y-m-d', $iteratedDate);

        }

        return $fromDate;
    }

    function getWeekLastDay($weekStartDay=''){

        if(!$weekStartDay){
            $weekStartDay = $this->weekStartDay;
        }


        $dayNames = $this->weekDays;

        if(!in_array($weekStartDay, $dayNames)){
            return false;
        }

        $i = 0;
        $dayNum = 0;

        while($dayNum!=7){

            $day = $dayNames[$i];
            // start considering if pointer reaches to desired weekstartday
            if($day==$weekStartDay){
                $dayNum = 1;
            }
            if($dayNum >0 ){
                $dayNum++;
            }

            if($i==count($dayNames) -1 ){$i=0;}else{$i++;}

            if($dayNum==7){
                $weekLastDay = $dayNames[$i];
            }

        }

        return $weekLastDay;

    }
}

$obj = new DateHelper();
print_r($obj->weekStartAndEndDates('Tue'));
