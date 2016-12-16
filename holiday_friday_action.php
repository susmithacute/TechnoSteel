
<?php
//include("connection.php");
$year = date("Y");
function getFridays($year, $format, $timezone='UTC')
{
    $fridays = array();
    $startDate = new DateTime("{$year}-01-01 Friday", new DateTimezone($timezone));
    $year++;
    $endDate = new DateTime("{$year}-01-01", new DateTimezone($timezone));
    $int = new DateInterval('P7D');
    foreach(new DatePeriod($startDate, $int, $endDate) as $d) {
        $fridays[] = $d->format($format);
    }

    return $fridays;
}

//$fridays = getFridays('2016', 'F j, Y, g:i a T', 'America/New_York');
$fridays = getFridays($year, 'Y-m-d', 'America/New_York');
//echo "<pre>";print_r($fridays);

	    foreach($fridays as $frid)
		{
			 $val = "";
			$selectholiday=$db->selectquery("SELECT `holiday` FROM holidays WHERE `holiday`='$frid'");
			if($selectholiday)
			{ $val = 0; }
			else{
			$values["holiday"] = $frid;
			
			$update = $db->secure_insert("holidays", $values);
			if($update){
						$val = 1;
					}
				}
		}
		//echo $val;
?>