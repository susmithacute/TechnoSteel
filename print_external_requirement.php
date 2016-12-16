<!Doctype html>
<head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <link rel="icon" type="image/ico" href="assets/images/favicon.ico" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">




        <!-- ============================================
        ================= Stylesheets ===================
        ============================================= -->
        <!-- vendor css files -->
        <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/vendor/animate.css">
        <link rel="stylesheet" href="assets/css/vendor/font-awesome.min.css">
        <link rel="stylesheet" href="assets/js/vendor/animsition/css/animsition.min.css">

        <!-- project main css files -->
        <link rel="stylesheet" href="assets/css/main.css">
        <!--/ stylesheets -->



        <!-- ==========================================
        ================= Modernizr ===================
        =========================================== -->
        <script src="assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <!--/ modernizr -->




    </head>
<style>
.d{
box-sizing:border-box;
width:100%;
height:100%;
margin:auto;
border:3 px solid #000000;
}
.dv{
text-align:right;
width:100%;
height:100%;
font-size:25px;
font-style:bold;

}
h1{
text-align:center;
color:red;}
h3{
text-align:center;
color:red;}
</style>

<body  onload="window.print()">

<?php 
include("connection.php");
$Rid = $_REQUEST['Rid'];

/*$requirement = $db->selectQuery("SELECT `sm_external_demands.client`,`sm_external_requirment.hiring_requirment_date_from`,`sm_external_requirment.hiring_requirment_date_to`,`sm_external_requirment.hiring_requirment_nof_person` FROM sm_external_demands LEFT JOIN sm_external_requirment ON `sm_external_demands.id` = `sm_external_requirment.id` WHERE sm_external_requirment.hiring_requirment_id='$Rid'");*/

$requirement = $db->selectQuery("SELECT * FROM `sm_external_requirment` WHERE `id`='$Rid'");

if (count($requirement)) {
	$hiring_req_id = $requirement[0]['id'];
	$requirementdemand = $db->selectQuery("SELECT * FROM `sm_external_demands` WHERE `id`='$hiring_req_id'");
	$client_name = $requirementdemand[0]['client'];
	$client_address = $requirementdemand[0]['client_address'];
	$client_phone = $requirementdemand[0]['client_phone'];
    $no_of_person = $requirement[0]['hiring_requirment_nof_person'];
	$requirements = $db->selectQuery("SELECT `hiring_requirment_date_from`,`hiring_requirment_date_to` FROM `sm_external_requirment` WHERE `id`='$Rid'");
	$las_row = count($requirements);
	for($reqs = 0; $reqs<count($requirements); $reqs++)
	{
		$hiring_requirment_date_from[] = $requirements[$reqs]['hiring_requirment_date_from'];
		$hiring_requirment_date_to[] = $requirements[$reqs]['hiring_requirment_date_to'];
	}
	

	$from_date_and_to_date = array_merge($hiring_requirment_date_from,$hiring_requirment_date_to);
	
	usort($from_date_and_to_date, function($a, $b) {
    $dateTimestamp1 = strtotime($a);
    $dateTimestamp2 = strtotime($b);

    return $dateTimestamp1 < $dateTimestamp2 ? -1: 1;
});
$from_date_and_to_date = array_merge($hiring_requirment_date_from,$hiring_requirment_date_to);
	
	usort($from_date_and_to_date, function($a, $b) {
    $dateTimestamp1 = strtotime($a);
    $dateTimestamp2 = strtotime($b);

    return $dateTimestamp1 < $dateTimestamp2 ? -1: 1;
});


$req_date_from = explode("-",$from_date_and_to_date[0]);
$req_date_to = explode("-",$from_date_and_to_date[count($from_date_and_to_date) - 1]);
$hiring_requirment_date_from = $req_date_from[2]."-".$req_date_from[1]."-".$req_date_from[0];

$hiring_requirment_date_to =  $req_date_to[2]."-".$req_date_to[1]."-".$req_date_to[0];
	if(!empty($requirements))
	 $date_from = $requirements[0]['hiring_requirment_date_from'];
	 $req_date_from1 = explode("-",$requirements[0]['hiring_requirment_date_from']);
	 //$req_date_from = $req_date_from1[2]."-".$req_date_from1[1]."-".$req_date_from1[0];
	 $req_date_to1 = explode("-",$requirements[0]['hiring_requirment_date_to']);
	 $date_to = $requirements[0]['hiring_requirment_date_to'];
	// $req_date_to = $req_date_to1[2]."-".$req_date_to1[1]."-".$req_date_to1[0];
	
	
	$datestart   = DateTime::createFromFormat('!m', $req_date_from[1]);
    $startmonth = $datestart->format('F');
	$datend  = DateTime::createFromFormat('!m', $req_date_to[1]);
	$endmonth = $datend->format('F');
	$designation = $requirement[0]['designation'];
	//$client_address1 = explode(" ",$client_address);
	//$client_add = $client_address1[0]."<br>".$client_address1[1]."<br>".$client_address1[2]."<br>".@$client_address1[3];
}
?>


<h1>INVOICE</h1>
<div class="row">
<div class="col-md-3">
<h4><?php echo $client_name;?></h4>
<h4><?php echo $client_address;?></h4>
<h4><?php echo $client_phone;?></h4>

</div>
<div class="col-md-6">
</div>

<div class="col-md-3">
<h2></h2>

<h4>Document Number :- <?php
						$leng = strlen($hiring_req_id);
						if($leng==1){ 
						$value= "0000".$hiring_req_id; 
						}
						else if($leng==2)
						{
							$value= "000".$hiring_req_id;
						}
						else if($leng==3)
						{
							$value= "00".$hiring_req_id;
						}
						else if($leng==4)
						{
							$value= "0".$hiring_req_id;
						}
						else{
							$value= $hiring_req_id;
						}
						echo "BEL".$value; ?></h4>
<h4>Document  Date: <?php echo date("d-m-Y");?></h4>
<h4>Job No :BEL :- <?php 
						$year=$req_date_from1[0];
						$endyear = substr("$year",-2);				
						echo $req_date_from1[2]."-".$endyear."-".$value; 
						?>	
</h4>
<?php /* <h4>Starting Date:- <?php echo $req_date_from;?></h4>
<h4>Completion Date:- <?php echo $req_date_to;?></h4> */ ?>
<h4>Starting Date:- <?php echo @$hiring_requirment_date_from;?></h4>
<h4>Completion Date:- <?php echo @$hiring_requirment_date_to;?></h4>

</div>
</div>
<div class="row">

<div class="col-md-4">
<h4>  Our Ref  No:- TSTC/2016/ETN/003/987</h4>					
<h4>  Our Ref  No:- TSTC/2016/ETN/002/981</h4>				
</div>
</div>
<div class="row">
<div class="col-md-4"></div>
<div class="col-md-6">
<h4>Invoice From <?php echo $req_date_from[2]." ".$startmonth." ".$req_date_from[0]; ?> To <?php echo $req_date_to[2]." ".$endmonth." ".$req_date_to[0]; ?> </h4>
</div>
</div>
 <table class="table table-striped">
     <thead>
  <tr>
    <th>Particulars</th>
    <th>Hours</th> 
	  <th></th>
    <th>Rate</th>
	  <th>Amount</th>
	
  </tr>
    </thead>
	 <tbody>
  
  <?php  
  $total_amount=0;
  $Particulars =$db->selectquery("SELECT sm_designation.designation_name,sm_designation.designation_id,sm_external_requirment.wage FROM sm_external_requirment LEFT JOIN sm_designation ON sm_external_requirment.designation = sm_designation.designation_id WHERE `id`='$hiring_req_id'");
  //$Particulars =$db->selectquery("SELECT `designation` FROM sm_external_requirment WHERE `hiring_requirment_id`='$Rid'");
  if(!empty($Particulars)){
  for($par=0; $par < count($Particulars); $par++){
	  $total = array();
	 $designation = $Particulars[$par]['designation_name'];
	 $selectwage =$db->selectquery("SELECT sm_designation.designation_name,sm_designation.designation_id,sm_external_requirment.wage FROM sm_external_requirment LEFT JOIN sm_designation ON sm_external_requirment.designation = sm_designation.designation_id WHERE `id`='$hiring_req_id'");
	 $Rate= $Particulars[$par]['wage'];
  $requirementdemand = $db->selectQuery("SELECT `id` FROM `sm_employee_work_assign` WHERE `requirement`='$hiring_req_id' AND `type` = 'External'");
  if(!empty($requirementdemand)){
	  $demand_id = $requirementdemand[0]['id'];
  }
 // $employee_ids = $db->selectQuery("SELECT `employee_id` FROM `sm_work_assign_employee_id` WHERE `employee_work_assign_id`='$demand_id'");  
  // if(!empty($employee_ids)){
	  // print_r($employee_ids);
  // for($emp_id=0; $emp_id < count($employee_ids); $emp_id++){
	  
	  
  // }	  
  // }
  // }
  $val="";
  $employee_work_hours = $db->selectquery("SELECT sm_work_assign_employee_id.employee_id,sm_time_sheet.employee_id,sm_time_sheet.normal_work_hours,sm_time_sheet.holiday_over_time,sm_time_sheet.normal_over_time,sm_time_sheet.date,sm_employee.employee_designation FROM sm_work_assign_employee_id LEFT JOIN sm_time_sheet ON sm_work_assign_employee_id.employee_id = sm_time_sheet.employee_id LEFT JOIN sm_employee ON sm_employee.employee_id = sm_time_sheet.employee_id  WHERE sm_work_assign_employee_id.employee_work_assign_id = '".$demand_id."' AND sm_time_sheet.date BETWEEN '".$date_from."' AND '".$date_to."' AND sm_employee.employee_designation = '".$designation."'");
 // echo "<pre>";print_r($employee_work_hours);
  if(!empty($employee_work_hours))
  {
  for ($emp_wrk_hr=0;$emp_wrk_hr<count($employee_work_hours);$emp_wrk_hr++)
  {
  $normal_work_hours = $employee_work_hours[$emp_wrk_hr]['normal_work_hours'];
  $normal_over_time = $employee_work_hours[$emp_wrk_hr]['normal_over_time'];
  $holiday_over_time = $employee_work_hours[$emp_wrk_hr]['holiday_over_time'];
  $total[]=$normal_work_hours + $normal_over_time + $holiday_over_time;
  $val = array_sum($total);
  }
  }
  //$selectwage = $db->selectquery("SELECT `designation`,`wage` FROM sm_external_requirment WHERE `designation`='$designation_id'  ");
 
  $Amount = $Rate*$val;
  
  $total_amount+=$Amount;
  
  ?>
	<tr>
    <td><?php echo $Particulars[$par]['designation_name']; ?></td>
    <td><?php echo @$val;?></td> 
    <td>Hrs @ QR</td>
	<td><?php echo $Rate; ?></td>
	<td><?php echo $Amount; ?></td>
  <?php  ?>
  </tr>
  <?php } ?>

  <tr>
 	 				 		  		
    <td>  </td>
    <td>   </td> 
    <td></td>
	<td> Total </td> 
    <td> <?php echo $s=number_format($total_amount, 2, '.', ','); ?></td>
  </tr>
  
  <?php } ?>
   </tbody>
</table>
<?php 

function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
	   return $string;
}
	?>
	
	

 
<h3>Amount in Words:-QR <?php 
$t1=explode(".",$s);
$v=$t1[1];
	echo ucfirst(convert_number_to_words($total_amount))." "."&"." "."$v"."/100 only.<br><br><br>";
	?></h3>
	<tr></tr>
	<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4"></div>
	<div class="col-md-4"><h4>K.R.Jayaraj</h4>
	<h4>Regional Manager</h4></div>
	
	</div>
	<div class="row">
	<div class=col-md-2></div>
	<div class="col-md-10"><h4>Cheque  to be drawn in favour of:<strong>TECHNO STEEL TRADING & CONTRACTING W.L.L , Ac No : 4610-727227-001</strong></h4></div>
	</div>
	<div class="row">
		
	<h4 style="text-align:center;">Bank Address:Commercial Bank, City Centre Branch, Doha. Qatar</h4>
	</div>
	
	 

<style type="text/css" media="print">
          @page 
    {
        size:  auto;  
        margin: 5mm; 
    }

    html
    {
        background-color: #FFFFFF; 
        margin: 0px;  
    }

    body
    {
       
        margin: 10mm 15mm 10mm 15mm; 
    }
</style>

</body>
