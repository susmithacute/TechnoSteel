<?php
// $page = "employee";
// $tab = "performance";
// $sub = "employee_appraisal";


$page = "employee";
$tab = "performance";
$sub = "employee_perform";
$head = "";
$head1 = "";
$sub1 = "";
$tab1 = "";
include('file_parts/header.php');
if(isset($_REQUEST['year'])){
	$perform = $_REQUEST['perform'];
$year  = $_REQUEST['year'];
//$employee_id = $REQUEST['employee_id'];
$empArray =$values= array();
$emp_name= $employee_code = $employee_id = $avg="";
$resFet = $db->selectQuery("SELECT DISTINCT employee_id FROM sm_employee_performance WHERE `status`='active' AND `date` LIKE '%$year%'");
if (count($resFet)) {
	
    for ($rC = 0; $rC < count($resFet); $rC++)
	{
		$sum_rating=$average=$avg =0;
     // echo "*****".$rC."<br>";
			$selected_emp_id=$resFet[$rC]['employee_id'];
			$select = $db->selectQuery("SELECT CONCAT(sm_employee.employee_firstname,  ' ', sm_employee.employee_middlename,  ' ', sm_employee.employee_lastname ) 
			AS employee_name,sm_employee.employee_employment_id,sm_company.company_name,sm_employee.employee_designation,sm_employee.employee_id,sm_employee_performance.rating1,sm_rating.value,sm_employee.employee_id,sm_employee_performance.date FROM sm_employee_performance INNER JOIN sm_employee ON sm_employee_performance.employee_id=sm_employee.employee_id INNER JOIN sm_rating ON sm_employee_performance.rating1=sm_rating.id LEFT JOIN sm_company ON sm_employee.employee_company=sm_company.company_id
			WHERE sm_employee_performance.status='active' AND sm_employee_performance.date LIKE '%$year%' AND sm_employee_performance.employee_id='$selected_emp_id'");
			
			for ($i = 0; $i < count($select); $i++){						    
			$employee_code =  $select[$i]['employee_employment_id'];
			$emp_name=$select[$i]['employee_name'];
			$employee_id=$select[$i]['employee_id'];
		    $rating_value  = $select[$i]['value'];	
       $employee_designation = $select[$i]['employee_designation'];	
	  $company_name =  $select[$i]['company_name'];	
			$sum_rating = $sum_rating+$rating_value;
			}
			if(count($select)>0){
			$average=($sum_rating/count($select));	
			}
	$avg = (round($average));
			
			if($avg == $perform){
				$values['average'] 	 =   $avg;
					$values['employee_id'] 	 = $selected_emp_id;
				$values['employee_name'] = $emp_name;
				$values['employee_code'] = $employee_code;
				$values['employee_designation'] = $employee_designation;
				$values['company_name'] = $company_name;
				
				
				$empArray["data"][] = $values;
			 }
			 
		}
		
		
	}


$fp = fopen('assets/extras/appraisal.json', 'w');
fwrite($fp, json_encode($empArray));
fclose($fp);
}
?>
<section id="content">

    <div class="page page-shop-products">

        <div class="pageheader">

            <h2>Employee Appraisal<span></span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-home"></i> HR</a>
                    </li>
                    <li>
                        <a>Employee</a>
                    </li>
                    <li>
                        <a>Employee Performance</a>
                    </li>
					<li>
                        <a>Employee Appraisal </a>
                    </li>
                </ul>

            </div>

        </div>


        <!-- page content -->
        <div class="pagecontent">


            <!-- row -->
            <div class="row">
                <!-- col -->
                <div class="col-md-12">


                    <!--                    <div class="alert alert-danger">
                                            <strong>Note!</strong> This table have only demo purpose. Data are not loaded from database but from dummy json.
                                        </div>-->


                    <!-- tile -->
                    <section class="tile">

                        <!-- tile header -->
                        <div class="tile-header dvd dvd-btm">
                            <h1 class="custom-font"><strong>Employee Appraisal </strong></h1>
                            <ul class="controls">
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
										
                                        <option <?php if(!empty($_REQUEST['year'])){ ?> value="<?php echo $i; ?>" <?php if($i==$_REQUEST['year']) 
										{ echo "selected"; } } else { ?> value="<?php echo $i; ?>" <?php if($i==date("Y")) 
										{ echo "selected"; } }?> >
									<?php echo $i; ?></option>
									<?php } ?>
                                    </select>
                                </div>
							<div class="form-group col-md-6">	  
                        <label for="selected_visa_type">Employee Performance: </label>
						

							<select class="form-control mb-10" name="type_name" id="perform" required="">
							<option>Select</option>
                                        <?php
                                        $select = $db->selectQuery("select * from sm_rating ");
                                        if (count($select)) {
                                            for ($rt = 0; $rt < count($select); $rt++) {
                                                ?>
												<option <?php if(!empty( $select[$rt]['value'])){ ?> value="<?php echo $select[$rt]['value']; ?>" <?php if($rt==$select[$rt]['value']) 
										{ echo $select[$rt]['rating'];} } else { ?> value="<?php echo $rt; ?>" <?php if($select[$rt]['value']== count($select)) 
											 {echo $select[$rt]['rating']; }}?> <?php if($select[$rt]['value'] == $perform){ echo "selected";}?>>
											<?php echo $select[$rt]['rating']; ?></option>
												
												 
												  
										<?php } ?>
										<?php } ?>
                                    </select>
									</div>
									
									<div id ="employee_list"></div>
									<?php 
									if(isset($_REQUEST['year'])){
										?>
										 <table class="table table-striped table-hover table-custom" id="products-list">
                                    <thead>
                                        <tr>
                                            <th style="width:10px;" >Sl.no</th>
                                           
                                             <th style="width:90px;">Employee ID</th>
											 <th style="width:90px;">Employee Name</th>
											 <th style="width:90px;"> Company</th>
											 <th style="width:90px;"> Designation</th>
											 <th style="width:90px;"> Action</th>
										 
											
                                          
                                        </tr>
                                    </thead>

                                </table>
										
										<?php
									}
									?>

                        </div>
                        <!-- /tile body -->

                    </section>
                    <!-- /tile -->

                </div>
                <!-- /col -->
            </div>
            <!-- /row -->




        </div>
        <!-- /page content -->

    </div>

</section>
<!--/ CONTENT -->





</div>
<!--/ Application Content -->














<!-- ============================================
============== Vendor JavaScripts ===============
============================================= -->

<script>window.jQuery || document.write('<script src="assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>

<script src="assets/js/vendor/bootstrap/bootstrap.min.js"></script>

<script src="assets/js/vendor/jRespond/jRespond.min.js"></script>

<script src="assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>

<script src="assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>

<script src="assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>

<script src="assets/js/vendor/screenfull/screenfull.min.js"></script>

<script src="assets/js/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="assets/js/vendor/datatables/extensions/dataTables.bootstrap.js"></script>
<script src="assets/js/vendor/datatables/extensions/Pagination/input.js"></script>

<script src="assets/js/vendor/date-format/jquery-dateFormat.min.js"></script>

<script src="assets/js/jquerysession.js"></script>
<!--/ vendor javascripts -->




<!-- ============================================
============== Custom JavaScripts ===============
============================================= -->
<script src="assets/js/main.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<!--/ custom javascripts -->




<!-- ===============================================
============== Page Specific Scripts ===============
================================================ -->



<!--/ Page Specific Scripts -->

<script>
    $(window).load(function () {

        //initialize datatable
      var t=  $('#products-list').DataTable({
            "dom": '<"row"<"col-md-8 col-sm-12"<"inline-controls"l>><"col-md-4 col-sm-12"<"pull-right"f>>>t<"row"<"col-md-4 col-sm-12"<"inline-controls"l>><"col-md-4 col-sm-12"<"inline-controls text-center"i>><"col-md-4 col-sm-12"p>>',
            "language": {
                "sLengthMenu": 'View _MENU_ records',
                "sInfo": 'Found _TOTAL_ records',
                "oPaginate": {
                    "sPage": "Page ",
                    "sPageOf": "of",
                    "sNext": '<i class="fa fa-angle-right"></i>',
                    "sPrevious": '<i class="fa fa-angle-left"></i>'
                }
            },
            "pagingType": "input",
            "ajax": 'assets/extras/appraisal.json',
            "order": [[1, "asc"]],
            "columns": [
                {"data": null},
				
				{"data": "employee_code"},
                {"data": "employee_name"},
                {"data": "company_name"},
                {"data": "employee_designation"},
				
				 {
					"data": "employee_id",
                    "type": "html",
                    
                   "render": function (data) {
                        return '<a href="employee_edit.php?uid=' + data + '&appraisal=1" class="btn btn-xs btn-blue" class="btn btn-xs btn-default mr-5"> Add Appraisal</a>';
                    }}
            ],
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': ["no-sort"]}
            ],
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "drawCallback": function (settings, json) {
                $(".formatDate").each(function (idx, elem) {
                    $(elem).text($.format.date($(elem).text(), "yyyy,mm,d"));
                });
               
            }
        });
        t.on( 'order.dt search.dt', function () {
            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );

        } ).draw();
        //*initialize datatable
    });</script>
<!--/ Page Specific Scripts -->

<script>
$('#perform').on('change', function (e) { 
 //alert("dgfdg");
		var perform = $(this).val();
		
		var year = jQuery('#year').val();
		
            location.href="employee_appraisal.php?year="+year+"&perform="+perform;
        //} 
    });
</script>





<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->

</body>

</html>
