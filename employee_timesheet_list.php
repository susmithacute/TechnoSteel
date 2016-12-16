<?php
$page = "";
$sub = "";
$sub1 = "";
$tab = "";

include('connection.php');
 if(isset($_POST['month']) && isset($_POST['year'])){ 
$month = $_POST['month'];
$year  = $_POST['year'];
$yearMonth = $_POST['year'].'-'.$_POST['month'];

$employee_id=$_POST['employee_id'];

$empArray = array();
// $resFet = $db->selectQuery("SELECT * FROM sm_time_sheet WHERE date LIKE '%$yearMonth%' AND employee_id ='$employee_id'");
// if (count($resFet)) {
	// //$ = array();
    // for ($rC = 0; $rC < count($resFet); $rC++) {
        // $values['employee_id'] = $resFet[$rC]['employee_id'];
        // $values['normal_work_hours'] = $resFet[$rC]['normal_work_hours'];
        // $values['normal_over_time'] = $resFet[$rC]['normal_over_time'];
        // $values['holiday_over_time'] = $resFet[$rC]['holiday_over_time'];
        // //$values['date'] = $resFet[$rC]['date'];
		// $ex_date1= explode("-",$resFet[$rC]['date']);
		// $Dates[]=$ex_date1[2];
		// //$Date=$ex_date1[2].'-'.$ex_date1[1].'-'.$ex_date1[0];
		// $values['date']=$Dates;
        // //$values['employee_email'] = $resFet[$rC]['employee_email'];
        // //$values['company_status'] = $resFet[$rC]['company_status'];
        // $empArray["data"][] = $values;
		// $s= $values['normal_work_hours'];
    // }
// }



//echo date("F");
function getMonth($year, $month) {

// this calculates the last day of the given month
$last=cal_days_in_month(CAL_GREGORIAN, $month, $year);

$date=new DateTime();
$res=Array();

// iterates through days
for ($day=01;$day<=$last;$day++) {
	
	
		$date->setDate($year, $month, $day);
       $date->format('Y-m-d');
	    //print_r($date);
		//$res[$day]=$date->format("l");
		$res[$day] = $day;
		
}
return $res;
}
$res=getMonth($year,$month);
//print_r($res); 
?>	
<style>
.input_box{
    width: 20%;
    margin: 0px 10px 0px 10px;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}	
</style>							
			<form name="form" id ="form" method="POST" >
				<input type="hidden" id="hid" value="<?php echo $employee_id;?>"/>
				<table class="table table-custom" id="timesheet_table">
                       <thead>
                         <tr>
                            <th>Day</th>
							<th>DayName</th>
							<th>Normal working hours</th>
                            <th>Normal Overtime<input type="text" name ="normal_overtime_addonce" id="normal_overtime_addonce" class="input_box"/><button type="button" class ="btn btn-round" style= "padding: 1px 12px;border-radius: -6px;" id="submit_normalOV" onClick="Normal()">Add</button></th>
                            <th>Holiday Overtime</th>
							<th>Total Working Hours</th>
                         </tr>
                       </thead>
                       <tbody>
											
					     <?php 
						 //Find Leave Date of Employee
						 $leaves = array();
							$selectleaves=$db->selectQuery("SELECT `leave_from`,`leave_to` FROM sm_employee_leave WHERE  employee_id ='$employee_id' AND status ='active'");
							for($Sl = 0; $Sl < count($selectleaves); $Sl++)
							{
								$date1 = $selectleaves[$Sl]['leave_to'];
								$end_date = date('Y-m-d',strtotime($date1 . "+1 days"));
								
								
								$begin = new DateTime($selectleaves[$Sl]['leave_from']);
								$end = new DateTime($end_date);
								

								$daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);

								foreach($daterange as $date){
									//echo "hai".$date->format("Y-m-d") . "<br>";
									$leaves[] = $date->format("Y-m-d");
								}
							}
							
							//echo "<pre>";print_r($leaves);
							
							
							
							$normal_total_work_hours = 0;
							foreach($res as $date){
							//if(strlen($date)==1)
								$s=strlen($date);
								if($s==1){
									$str = "0";
        						    $new_dates = $str.$date; }
								else{$new_dates = $date;}
								$new_date = $yearMonth.'-'.$new_dates;
								$weekday = date('l', strtotime($new_date));
								$resFets = $db->selectQuery("SELECT * FROM sm_time_sheet WHERE date = '$new_date' AND employee_id ='$employee_id'");
								$selectholiday=$db->selectQuery("SELECT `holiday` FROM holidays WHERE `holiday`='$new_date '");
								
								
								// if (count($selectleaves)) {
									// for ($rC = 0; $rC < count($selectleaves); $rC++) {
									// $leave_from = $selectleaves[$rC]['leave_from'];
									// $leave_to = $selectleaves[$rC]['leave_to'];
									// $aryRange=array();
									// if ($leave_to>=$leave_from)
										// {
											// array_push($aryRange,date('Y-m-d',$leave_from));
											// while ($leave_from<$leave_to)
											// {
												// $leave_from+=86400; // add 24 hours
												// array_push($aryRange,date('Y-m-d',$leave_from));
											// }
										// }
									// return $aryRange;
									// $selectleave=$db->selectQuery("SELECT `leave_from`,`leave_to` FROM sm_employee_leave WHERE 
									// '$new_date'<='$aryRange' AND '$leave_from'<='$new_date' AND employee_id ='$employee_id'");
									// }
								// }
								
													
						  ?>
						  
						  <?php 
							if(empty($selectholiday))
							{
								if(!in_array($new_date,$leaves))
								{
									$normal_values=array();
									$normal_values['date']=$new_date;
									$normal_values['normal_work_hours']=8;
									$normal_values['total_work_hours']=8;
									$normal_values['employee_id']=$employee_id;
									$check_normal=$db->selectQuery("SELECT * FROM `sm_time_sheet` WHERE `date`='$new_date' AND `employee_id`='$employee_id'");
									
									if(count($check_normal)>0){
										//$up_normal=$db->secure_update("sm_time_sheet",$normal_values," WHERE `employee_id`='$employee_id' AND `date`='$date_val'");
									}
									if(count($check_normal)<=0){
										$in_normal=$db->secure_insert("sm_time_sheet",$normal_values);
										$normal_total_work_hours+= 8;
									}
									
								}
							}
						  ?>


						  
                            <tr class="odd gradeX">
                            <!--td><?php //echo $new_date.':'.$resFets[0]['date']; ?></td-->
							<td><?php echo $date; ?></td>
							<td><?php echo $weekday;?></td>
                            <td>
								<input type="hidden" class="date"  name="val" value="<?php echo $new_date;?>"/>
								<input type="hidden" id="employee_id"value="<?php echo $employee_id;?>"/>
								<input type="text" name="normal_work_hours" id="normal_work_hours" class="normal_work_hours"<?php if(!empty($selectholiday)) {?> disabled style="color:blue;" value ="Holiday" <?php  }?> <?php if(in_array($new_date,$leaves)) {?> disabled style="color:red;" value="Leave" <?php  }?> <?php if(!empty($resFets[0]['normal_work_hours'])){ ?> value="<?php echo $resFets[0]['normal_work_hours']?>" <?php } else { ?> value="8"<?php } ?> <?php $s=@$resFets[0]['normal_work_hours'];?>  onblur="normal_function(this)" onkeyup="key_up_functionN(this)" />
							</td>
							
                            <td>
								<input type="hidden" class="date"  name="val" value="<?php echo $new_date;?>"/>
								<input type="hidden" id="employee_id"value="<?php echo $employee_id;?>"/>
								<input type="text" class="normal_over_time" id="normal_over_time" name="normal_over_time" <?php if(!empty($selectholiday)) {?> disabled style="color:blue;" value ="Holiday" <?php  }?> <?php if(in_array($new_date,$leaves)) {?> disabled style="color:red;" value="Leave" <?php  }?> <?php if(!empty($resFets[0]['normal_over_time'])){ ?> value="<?php echo $resFets[0]['normal_over_time']?>" <?php } else { ?> value="0"<?php } ?> <?php $t=@$resFets[0]['normal_over_time'];?>  onblur="normal_overtime_function(this)" onkeyup="key_up_functionO(this)"/>
							</td>
						
                            <td>
								<input type="hidden" class="date"  name="val" value="<?php echo $new_date;?>"/>
								<input type="hidden" id="employee_id"value="<?php echo $employee_id;?>"/>
								<input type="text" id="holiday_over_time" class="holiday_over_time" name="holiday_over_time" <?php if(empty($selectholiday)) { ?> disabled  <?php } else if(!empty($resFets[0]['holiday_over_time'])) { ?> value="<?php echo $resFets[0]['holiday_over_time']; ?>" <?php } else { ?> value="0" <?php } ?> <?php if(in_array($new_date,$leaves)){ ?> disabled style="color:red;" value="" <?php  } ?>  <?php $u=@$resFets[0]['holiday_over_time'];?> onblur="holiday_over_time_function(this)" onkeyup="key_up_functionH(this)" />
							</td>
							
							<?php /*<td> <?php echo $resFets[0]['holiday_over_time']; ?>
								<input type="hidden" class="date"  name="val" value="<?php echo $new_date;?>"/>
								<input type="hidden" id="employee_id"value="<?php echo $employee_id;?>"/>
								<input type="text" id="holiday_over_time" class="holiday_over_time" name="holiday_over_time" <?php if(empty($selectholiday)) {?> disabled style="color:blue;"  <?php } else { ?> value="000" <?php } ?>  <?php if(in_array($new_date,$leaves)) {?> disabled style="color:red;" value="" <?php  }?> <?php if(!empty($resFets[0]['holiday_over_time'])){ ?> value="<?php echo $resFets[0]['holiday_over_time']; ?>" <?php } else { ?> value=""<?php } ?> <?php $u=@$resFets[0]['holiday_over_time'];?> onblur="holiday_over_time_function(this)" onkeyup="key_up_functionH(this)" />
							</td> */ ?>
							
							<input type="hidden" class="slno"  name="slno" id="slno" value="<?php echo $new_date;?>"/>
							
							<td>
							<?php $sum = $s + $t + $u; ?>
								<input type="hidden" class="date"  name="val" value="<?php echo $new_date;?>"/>
								<input type="hidden" id="employee_id"value="<?php echo $employee_id;?>"/>
								
								<?php 
								$check_normal=$db->selectQuery("SELECT * FROM `sm_time_sheet` WHERE `date`='$new_date' AND `employee_id`='$employee_id'");
								//$ = $check_normal[0][''];
								//echo "hai";print_r($check_normal);
								//echo $check_normal[0]['total_work_hours'];
								?>
								
								<input type="text" id="totalwrkhour" name="totalwrkhour" class= "" <?php if(!empty($check_normal)){ ?> value="<?php echo @$check_normal[0]['total_work_hours'];  ?>" <?php  } else if(in_array($new_date,$leaves) && empty($selectholiday)){ ?> disabled <?php } else { ?> value="0" <?php } ?>  />
							</td>
                            </tr>
											
										<?php } ?>
										
										<?php //Total Working Hours
												if(!empty($in_normal)){
													$total_values['employee_id']=$employee_id;
													$total_values['month']=$month;
													$total_values['year']=$year;
													$total_values['normal_work_hours'] = $normal_total_work_hours;
													$total_values['grand_total'] = $normal_total_work_hours;
													$in_normal=$db->secure_insert("sm_employee_working_hours_total",$total_values);
												}
												?>
							
											
                            </tbody>
							<?php $resWtotal = $db->selectQuery("SELECT * FROM sm_employee_working_hours_total WHERE year = '$year' AND employee_id ='$employee_id' AND month = '$month'"); ?>
							<td></td><td><b>Total Hours</b></td>
							<td><b><input type="text" id="total_normal_work_hours" value="<?php echo @$resWtotal[0]['normal_work_hours']?>"/></b></td>
							<td><b><input type="text" id="total_normal_overtime_hours" value="<?php echo @$resWtotal[0]['normal_overtime']?>" /></b></td>
							<td><b><input type="text" id="total_holiday_overtime_hours" value="<?php echo @$resWtotal[0]['holiday_overtime']?>" /></b></td>
							<td><b><input type="text" id="total_monthly_work_hours" value="<?php echo @$resWtotal[0]['grand_total']?>" /></b></td>
                            </table>
							</form>
							</tr>
										
<?php } ?>