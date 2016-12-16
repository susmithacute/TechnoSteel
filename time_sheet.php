<?php
$page = "employee";
$tab = "employee_timesheet";
$sub = "employee_list_timesheet";

include('file_parts/header.php');
//$id = $_GET['uid'];
$employee_id=$_GET['uid'];
$empArray = array();
if(isset($_REQUEST['uid'])){
	//echo "################# in loop";
$resFet = $db->selectQuery("SELECT * FROM sm_time_sheet WHERE employee_id ='$employee_id'");
if (count($resFet)) {
	
    for ($rC = 0; $rC < count($resFet); $rC++) {
        $values['employee_id'] = $resFet[$rC]['employee_id'];
        $values['normal_work_hours'] = $resFet[$rC]['normal_work_hours'];
        $values['normal_over_time'] = $resFet[$rC]['normal_over_time'];
        $values['holiday_over_time'] = $resFet[$rC]['holiday_over_time'];
        //$values['date'] = $resFet[$rC]['date'];
		$ex_date1= explode("-",$resFet[$rC]['date']);
		$Date=$ex_date1[2];
		//$Date=$ex_date1[2].'-'.$ex_date1[1].'-'.$ex_date1[0];
		$values['date']=$Date;
        //$values['employee_email'] = $resFet[$rC]['employee_email'];
        //$values['company_status'] = $resFet[$rC]['company_status'];
        $empArray["data"][] = $values;
    }
}
}
?>
<style>
input {
    border: transparent;
}
input[type=text]:disabled  {
    background: none;
}
</style>


<?php
//include("connection.php");
/*$year = date("Y");
	//$selectemployee=$db->selectquery("SELECT `employee_id` FROM sm_employee WHERE `employee_status`='1'");
	    //if (count($selectemployee)) {
			//for ($emp = 0; $emp < count($selectemployee); $emp++)
			//{
				//$employee_id = $selectemployee[$emp]['employee_id'];
				$val = "";
				for($i=1; $i<=12; $i++){
				$str_len = strlen($i);
				if(($str_len)==1){ $is = '0'.$i; } else { $is = $i; }
				$selectemploye_id=$db->selectquery("SELECT `id` FROM sm_employee_working_hours_normal WHERE `employee_id`='$employee_id' AND `year` = '$year' AND `month` = '$is'");
				if(count($selectemploye_id)>0)
				{ $val = 0; }
				else{
					
				$month = $is;
				$valuess["normal_working_hours"] = 8; 
				$valuess["employee_id"] = $employee_id;
				$valuess["year"] = $year;
				$valuess["month"] = $is;
				
				$selectholiday=$db->selectQuery("SELECT `holiday` FROM holidays WHERE `holiday`='$new_date '");
				if(empty($selectholiday))
				{
					if(!in_array($new_date,$leaves))
					{
					$check_normal=$db->selectQuery("SELECT * FROM `sm_time_sheet` WHERE `date`='$new_date' AND `employee_id`='$emp_id'");
					if(count($check_normal)>0){		
						$up_normal=$db->secure_update("sm_time_sheet",$normal_values," WHERE `employee_id`='$emp_id' AND `date`='$new_date'");
					}
					if(count($check_normal)<=0){
						$in_normal=$db->secure_insert("sm_time_sheet",$normal_values);
					}
					$total+= $normal_over_time;
					}
				}
				
				$check_total=$db->selectQuery("SELECT * FROM `sm_employee_working_hours_total` WHERE `month`='$month' AND `employee_id`='$emp_id' AND `year`='$year'");
				$grand_total = $check_total[0]['normal_work_hours'] + $check_total[0]['holiday_overtime'] + $total;
				$normal_values1['grand_total'] = $grand_total;
				
				//$update = $db->secure_insert("sm_employee_working_hours_normal", $valuess);
				if($update){
							$val = 1;
						}
					}
				}
			//}
		//} */
		
		//echo $val;
?>


            <!-- ====================================================
            ================= CONTENT ===============================
            ===================================================== -->
            <section id="content">

                <div class="page page-tables-datatables">

                     <div class="pageheader">



            <h2>Time sheet<span>Employee Timesheet</span></h2>



            <div class="page-bar">



                <ul class="page-breadcrumb">

                    <li>

                        <a><i class="fa fa-home"></i> SME</a>

                    </li>

                    <li>

                        <a href="javascript:void(0)">Time Tracker</a>

                    </li>

                    <li>

                        <a href="javascript:void(0)">Time sheet</a>

                    </li>

                </ul>



            </div>



        </div>

                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-md-12">


                           
                            <!-- tile -->
                            <section class="tile">

                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font"><strong>Time </strong>sheet</h1>
                                    <ul class="controls">
                                      <!--  <li>
                                            <a role="button" tabindex="0" id="add-entry"><i class="fa fa-plus mr-5"></i> Add Entry</a>
                                        </li> -->
                                        <li class="dropdown">

                                            <a role="button" tabindex="0" class="dropdown-toggle settings" data-toggle="dropdown">
                                                <i class="fa fa-cog"></i>
                                                <i class="fa fa-spinner fa-spin"></i>
                                            </a>

                                            <ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">
                                                <li>
                                                    <a role="button" tabindex="0" class="tile-toggle">
                                                        <span class="minimize"><i class="fa fa-angle-down"></i>&nbsp;&nbsp;&nbsp;Minimize</span>
                                                        <span class="expand"><i class="fa fa-angle-up"></i>&nbsp;&nbsp;&nbsp;Expand</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a role="button" tabindex="0" class="tile-refresh">
                                                        <i class="fa fa-refresh"></i> Refresh
                                                    </a>
                                                </li>
                                                <li>
                                                    <a role="button" tabindex="0" class="tile-fullscreen">
                                                        <i class="fa fa-expand"></i> Fullscreen
                                                    </a>
                                                </li>
                                            </ul>

                                        </li>
                                        <li class="remove"><a role="button" tabindex="0" class="tile-close"><i class="fa fa-times"></i></a></li>
                                    </ul>
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="tile-body">
								
                                <div class="table-responsive">
								<div class="row">
								<div class="form-group col-md-6">
                                    <label for="phone">Year: </label>
                                    <select class="form-control mb-10" name="year" id="year">
                                        <?php for($i=2000; $i<=date("Y"); $i++){?>
                                        <option  value="<?php echo $i; ?>" <?php if($i==date("Y")) { echo "selected"; }?> ><?php echo $i; ?></option>
										<?php } ?>
                                    </select>
                                </div>
								<div class="form-group col-md-6">
                                    <label for="month">Month: </label>
                                    <?php
										$monthArray = range(1, 12);
									?>
                                    <select class="form-control mb-10" name="month" id="month">
									
									<?php //echo '<option value="'.date("m").'">'.date("F").'</option>';?>
										<?php
										foreach ($monthArray as $month) {
											// padding the month with extra zero
											$monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
											// you can use whatever year you want
											// you can use 'M' or 'F' as per your month formatting preference
											$fdate = date("F", strtotime("2015-$monthPadding-01"));
											//echo $fdate;
											//if("'.$monthPadding.'" == date("m")) { "selected"; }
											
											//echo '<option value="'.$monthPadding.'">'.$fdate.'</option>'; ?>
											<option value=<?php echo $monthPadding ?> <?php if($monthPadding == date("m")) { echo "selected";}?>><?php echo $fdate ?></option>
											
											<?php
										}
										?>
										
									</select>
                                </div>
								
								
								<?php
									//echo date("F");
									function getMonth($year, $month) {

										// this calculates the last day of the given month
										$last=cal_days_in_month(CAL_GREGORIAN, $month, $year);

										$date=new DateTime();
										$res=Array();

										// iterates through days
										for ($day=1;$day<=$last;$day++) {
												$date->setDate($year, $month, $day);

												$res[$day]=$date->format("l");
										}
										return $res;
									}
									$res=getMonth(date("Y"), date("m"));
									//print_r($res);

									?>


								 </div>
                                        <div id="timesheet"></div>
                                    </div>
                                </div>
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->

                            
                           
                            <!-- /tile -->

                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->

                </div>
                
            </section>
            <!--/ CONTENT -->






        </div>
        <!--/ Application Content -->














        <!-- ============================================
        ============== Vendor JavaScripts ===============
        ============================================= -->
        <script src="assets/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="assets/js/vendor/bootstrap/bootstrap.min.js"></script>

        <script src="assets/js/vendor/jRespond/jRespond.min.js"></script>

        <script src="assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>

        <script src="assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>

        <script src="assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>

        <script src="assets/js/vendor/screenfull/screenfull.min.js"></script>

        <script src="assets/js/vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/vendor/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
        <script src="assets/js/vendor/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/js/vendor/datatables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
        <script src="assets/js/vendor/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
        <script src="assets/js/vendor/datatables/extensions/dataTables.bootstrap.js"></script>

        <!--/ vendor javascripts -->




        <!-- ============================================
        ============== Custom JavaScripts ===============
        ============================================= -->
        <script src="assets/js/main.js"></script>
        <!--/ custom javascripts -->






        <!-- ===============================================
        ============== Page Specific Scripts ===============
        ================================================ -->
		<script>
		$(window).load(function (e) {
		var month = jQuery('#month').val();
		var year = jQuery('#year').val();
		//var employee_id = $employee_id;
		//var normalwrkhour = $resFet[$rC]['normal_work_hours'];
		//$('#year_value').val(year);
        //$('#qatar_status').html("");
       // if (qaid != "") {
            $('#qatar_status').html('');
            $.ajax({
                url: 'employee_timesheet_list.php',
                type: 'POST',
                //dataType: 'json',
                data: {month: month,year: year,employee_id:'<?php echo $employee_id ?>'},
                success: function (data) {
                    $('#timesheet').html(data);
                }
            });
        //} 
    });
		$('#month').on('change', function (e) {
		var month = $(this).val();
		var year = jQuery('#year').val();
		//var employee_id = $employee_id;
		//var normalwrkhour = $resFet[$rC]['normal_work_hours'];
		//$('#year_value').val(year);
        //$('#qatar_status').html("");
       // if (qaid != "") {
            $('#qatar_status').html('');
            $.ajax({
                url: 'employee_timesheet_list.php',
                type: 'POST',
                //dataType: 'json',
                data: {month: month,year: year,employee_id:'<?php echo $employee_id; ?>'},
                success: function (data) {
                    $('#timesheet').html(data);
                }
            });
        //} 
    });
	function normal_function(valuez){
			var nwh=$(valuez).val();
			var date_val=$(valuez).siblings('.date').val();
			var emp_id='<?php echo $employee_id; ?>';
			//alert(nwh);
			$.ajax({
            type: "POST",
			url: "employee_list_timesheet_action.php",
           data: {normal_work_hour:nwh,emp_id:emp_id,date_val:date_val},
            success: function (data) { 			
			                
            }
		});
	}
	function normal_overtime_function(valuez){
			var not=$(valuez).val();
			var date_val=$(valuez).siblings('.date').val();
			var emp_id='<?php echo $employee_id; ?>';
			$.ajax({
            type: "POST",
			url: "employee_list_timesheet_action.php",
           data: {normal_over_time:not,emp_id:emp_id,date_val:date_val},
            success: function (data) { 			
			                
            }
		});
	}
	function holiday_over_time_function(valuez){
			var hot=$(valuez).val();
			var date_val=$(valuez).siblings('.date').val();
			var emp_id='<?php echo $employee_id; ?>';
			//alert(hot);
			//alert(date_val);
			//alert(emp_id);
			$.ajax({
            type: "POST",
			url: "employee_list_timesheet_action.php",
           data: {holiday_over_time:hot,emp_id:emp_id,date_val:date_val},
            success: function (data) { 			
			                
            }
		});
	}
	
	//$('#normal_work_hours').keyup(function () {
	function key_up_functionN(valuez){
		var nwh1 = $(valuez).val();
        var ot = $(valuez).parent('td').siblings('td').find('.normal_over_time').val();
		
		if(nwh1 === ""){
			nwh1s = 0;
		} else {  nwh1s = nwh1; }
		
		if(ot === ""){
			ots = 0;
		} else {  ots = ot; }
		
		
        nwh = parseInt(ots) + parseInt(nwh1s);
        calculate_hours(nwh, valuez);
		
		//Normal WH Total
		 var arr = document.getElementsByName('normal_work_hours');
		 var tot=0;
		for(var i=0;i<arr.length;i++){
			if(parseInt(arr[i].value))
            tot += parseInt(arr[i].value);
			}
		$("#total_normal_work_hours").val(tot);
		
		//grand Total insert db
		var month = jQuery('#month').val();
		var year = jQuery('#year').val();
		var emp_id='<?php echo $employee_id; ?>';
		
		
		//Grand Total
		 var arrG = document.getElementsByName('totalwrkhour');
		 var totG=0;
		for(var i=0;i<arrG.length;i++){
			if(parseInt(arrG[i].value))
            totG += parseInt(arrG[i].value);
			}
		$("#total_monthly_work_hours").val(totG);
		
		$.ajax({
            type: "POST",
			url: "employee_list_timesheet_action.php",
           data: {month:month,year:year,emp_id:emp_id,normal_wh:tot,grand_total:totG},
            success: function (data) { 			
			                
            }
		});
		
		
	}
	function key_up_functionO(valuez){
		 var over1 = $(valuez).val();
        var normal = $(valuez).parent('td').siblings('td').find('.normal_work_hours').val();
//var ht=0;
		if(over1 === ""){
			overs = 0;
		} else {  overs = over1; }
		
		if(normal === ""){
			normals = 0;
		} else {  normals = normal; }
		
        var over = parseInt(overs) + parseInt(normals);
        calculate_hours(over, valuez);
	   
	   //normal_over_time Total
		 var arr = document.getElementsByName('normal_over_time');
		 var tot=0;
		for(var i=0;i<arr.length;i++){
			if(parseInt(arr[i].value))
            tot += parseInt(arr[i].value);
			}
		$("#total_normal_overtime_hours").val(tot);
		
		//normal_over_time Total insert db
		var month = jQuery('#month').val();
		var year = jQuery('#year').val();
		var emp_id='<?php echo $employee_id; ?>';
		
		//Grand Total
		 var arrG = document.getElementsByName('totalwrkhour');
		 var totG=0;
		for(var i=0;i<arrG.length;i++){
			if(parseInt(arrG[i].value))
            totG += parseInt(arrG[i].value);
			}
		$("#total_monthly_work_hours").val(totG);
		
		$.ajax({
            type: "POST",
			url: "employee_list_timesheet_action.php",
           data: {month:month,year:year,emp_id:emp_id,normal_ot:tot,grand_total:totG},
            success: function (data) { 			
			                
            }
		});
		
	}
	function key_up_functionH(valuez){
		var holiday = $(valuez).val();
		
		if(holiday === ""){
			holidays = 0;
		} else {  holidays = holiday; }
		
		
        calculate_hours(holidays, valuez);
		
		//holiday_over_time Total
		 var arr = document.getElementsByName('holiday_over_time');
		 var tot=0;
		for(var i=0;i<arr.length;i++){
			if(parseInt(arr[i].value))
            tot += parseInt(arr[i].value);
			}
		$("#total_holiday_overtime_hours").val(tot);
		
		//holiday_over_time Total insert db
		var month = jQuery('#month').val();
		var year = jQuery('#year').val();
		var emp_id='<?php echo $employee_id; ?>';
		
		//Grand Total
		 var arrG = document.getElementsByName('totalwrkhour');
		 var totG=0;
		for(var i=0;i<arrG.length;i++){
			if(parseInt(arrG[i].value))
            totG += parseInt(arrG[i].value);
			}
		$("#total_monthly_work_hours").val(totG);
		
		$.ajax({
            type: "POST",
			url: "employee_list_timesheet_action.php",
           data: {month:month,year:year,emp_id:emp_id,holiday_ot:tot,grand_total:totG},
            success: function (data) { 			
			                
            }
		});
	}
   	function calculate_hours(nwh,vv) {
		var value = $(vv).parent('td').siblings('td').find("#totalwrkhour").val();
		var normal_work_hours = $('#normal_work_hours').val();
        if (normal_work_hours === "") {
            normal_work_hours = 0;
        }
        var normal_over_time = $('#normal_over_time').val();
        if (normal_over_time === "") {
            normal_over_time = 0;
        }
        var holiday_over_time = $('#holiday_over_time').val();
		
        if (holiday_over_time === "") {
            holiday_over_time = 0;
        }
        var total_fee = 0;
	  var total_fee = nwh;
	   $(vv).parent('td').siblings('td').find("#totalwrkhour").val(total_fee);
    }
	

	</script>

<script type="text/javascript">
/*function findTotalO(){
    var arr = document.getElementsByName('normal_over_time');
    var tot=0;
    for(var i=0;i<arr.length;i++){
        if(parseInt(arr[i].value))
            tot += parseInt(arr[i].value);
    }
	$("#total_normal_over_time").val(tot);
    //document.getElementById('total').value = tot;
} */
</script>
	
	<script>
	<!--script>
	function key_up_function(valuez){
	
	 var vlaues =$(valuez).val();
	 //alert(vlaues);
	
	 var tot=$(valuez).val()
	$.ajax({
            type: "POST",
			url: "employee_list_timesheet_action.php",
            data: {total_work_hours:tot,emp_id:emp_id,date_val:date_val},
            success: function (data) { 			
			             //alert(data);   
            }
		});
	
	
	}
	
	function total_work_hours_function(valuez){
			var twh=$(valuez).val();
			var date_val=$(valuez).siblings('.date').val();
			var emp_id='<?php echo $employee_id; ?>';
			
	}
	
	function Normal() {
	//$('#submit_normalOV').click(function () {
		//alert("dgfdg");
        var normal_overtimeMul = $('#normal_overtime_addonce').val();
		var year = $('#year').val();
		var month = $('#month').val();
        $.ajax({
            url: "employee_list_timesheet_action.php",
            type: "POST",
            data: {normal_overtimeMul: normal_overtimeMul,emp_idMul:<?php echo $employee_id; ?>,year:year,month:month},
            success: function (data) {
            window.location = "time_sheet.php?uid=<?php echo $employee_id ?>";
            }
        });
    };
	//);
	
		</script>
