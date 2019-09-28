<?php

function mustRun(){
    date_default_timezone_set("Asia/Kolkata");
}

function GetIndianDateNTime() {
    return date('d-m-Y H:i:s');
}

function GetIndianDate() {
    return date('d-m-Y');
}

function GetIndianTime() {
    return date('H:i:s');
}

function GetDateNTime($date) {
    return date_format(date_create($date), 'd-m-Y H:i:s');
}

function GetCurrentDbDateNTime() {
    return date('Y-m-d H:i:s');
}

function formatDbDate($date) {
    return date_format(date_create($date), 'Y-m-d');
}


/*--
| This Function is to remove date from timestamp if it's today's
| if not then it vl remove time stamp without year and second
| ex :
| param : 10-12-2017 12:30:12
| return1 : 12:30  10-12 [if not today]
| return2 :  12:30 [if today date]
--*/
function RemoveTodayDateNYear($in_date) {
    if($in_date == "00:00" || $in_date == "") // undefined in_date
        return $in_date;
    $date = date_create($in_date);
    $temp_date =  date_format($date, 'Y-m-d');
    $today_date = date('Y-m-d');
    if ($temp_date == $today_date)
        return $this->ConvertTimeAMnPMtoAnP(date_format($date, 'H:i'));
    else
        return date_format($date,'H:i d-m');
}

/*--
| This Function is to convert 24 hour format to AM / PM with one word
| ex :
| param : 23:30:12
| return1 : 11:30 P
| return2 :  10:10 A
--*/
function ConvertTimeAMnPMtoAnP($time) {
    $arr = explode(" ",date("g:i A", strtotime($time)));
    if($arr[1] == "AM")
        $AnP = "A";
    else
        $AnP = "P";
    return $arr[0]." <sup>$AnP</sup>";
}

/*--
 | To arrange input date in indian format
 | it will return date and time without second
 --*/
function ArrangeDateAndTime($in_date) {
    return date_format(date_create($in_date), 'd-m-Y H:i');
}

function getHrMinFromTimeStamp($in_date) {
//        return date_format(date_create($in_date), 'H:iA'); // with AM / PM
    return date_format(date_create($in_date), 'H:i');
}

function AddMinToTimeStamp($in_time, $min) {
    $endTime = strtotime("+$min minutes", strtotime($in_time));
    return date('Y-m-d H:i:s', $endTime);
}

function ConvertInTimeToTimeStamp($in_time) {
    return date_format(date_create($in_time), 'Y-m-d H:i:s');
}

function getHrMinFromDate($in_time){
    return date_format(date_create($in_time), 'H:i');
}


/*--DAY TATS--*/
//$Tat = round(abs(strtotime($row->OutDate)-strtotime($row->InDate)) /(60*60*24),0);

/*--DAY HOUR TATS--*/
//$Tat = round(abs(strtotime($row->OutDate)-strtotime($row->InDate)) /(60*60),0);
function getTat($in_time, $out_time) {
    if($in_time != "" && $out_time != "")
        return round((strtotime($out_time)-strtotime($in_time)) /(60*60),2);
    else
        return 0;
}

function convertDecimalHrIntoHrMin($tat) {
    $hr = floor($tat);
    $dec = $tat-$hr;
    $min = round($dec * 60, 0);
    return $hr."h ".$min."m";
}

function convertMinIntoHrMin($total_min) {
    $total_hr = round($total_min/60, 2);
    $hr = floor($total_hr);
    $dec = $total_hr-$hr;
    $min = floor($dec*60);
    return $hr."h ".$min."m";
}

function getAge($in_time) {
    if($in_time=="")
        return 0;
    $diff = strtotime(date('Y-m-d H:i:s')) - strtotime($in_time);
    return abs(round($diff / 86400));
}