<?php
$success_msg="";
$page = "accounts";
$tab = "accounts_emp_settings";
$sub = "accounts_settings";
$sub1 = "holiday_settings";
include('file_parts/header.php');

$empArray = array();
$resFet = $db->selectquery("SELECT * FROM holidays order by id DESC");

if (count($resFet)) {
    for ($rC = 0; $rC < count($resFet); $rC++) {
        //$values['medical_status_id'] = $resFet[$rC]['medical_status_id'];
		//$date= array();
        $date = explode("-",$resFet[$rC]['holiday']);
		$values['holiday'] = $date[2].'-'.$date[1].'-'.$date[0];
		$values['id'] = $resFet[$rC]['id'];
      $empArray["data"][] = $values;
    }
}
$fp = fopen('assets/extras/employee.json', 'w');
fwrite($fp, json_encode($empArray));
fclose($fp);
?>

<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<style>
    .validate_span {
        color: #ff7b76 !important;
        font-size: 12px;
        line-height: 0.9em;
        list-style-type: none;
    }
</style>
<section id="content">

    <div class="page page-shop-products">

        <div class="pageheader">

            <h2>Holidays List<span></span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-home"></i> SME</a>
                    </li>
                    <li>
                        <a>Holidays</a>
                    </li>
                    <li>
                        <a>Holidays List</a>
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
                            <h1 class="custom-font"><strong>Holidays List</strong>-In a Company</h1> 
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
						<form name="step1" id="form1" role="form" method="post">
						            
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="username">Add Holiday: </label>
									
                                    <input type="text" name="add_holiday" id="add_holiday" class="form-control" required><br>
									
                                    <button class="btn btn-success" name="submit" id="submit_btn" type="button">Add</button>
									<span id ="succ" class="error" ></span>
									<span class="error" id="error"></span>
                                </div>
                          </div>
						   
						  
						   
					
                        

                            </form>
							

                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-custom" id="products-list">
                                    <thead>
                                        <tr>
                                            <th style="width:10px;" >
                                                Sl.no
                                            </th>
                                            <th style="width:90px;">Holiday</th>
											<th style="width:90px;">Actions</th>
                                            
                                        </tr>
                                    </thead>

                                </table>
									
                            </div>

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

<div class="modal splash fade" id="splash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title custom-font">Sure To Remove This Record ?</h3>
            </div>
            <input type="hidden" id="hid" value=""/>
            <div class="modal-body">

<!--                <p>This sure is a fine modal, isn't it?</p>

 <p>Modals are streamlined, but flexible, dialog prompts with the minimum required functionality and smart defaults.</p>-->
            </div>
            <div class="modal-footer">
                <button class="btn btn-default btn-border" id="sub_btn">Yes</button>
                <button class="btn btn-default btn-border" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!--/ CONTENT -->


<!--/ Application Content -->

<!-- ============================================
============== Vendor JavaScripts ===============
============================================= -->
<script>

</script>
<script src="assets/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>

<script src="assets/js/vendor/bootstrap/bootstrap.min.js"></script>

<script src="assets/js/vendor/jRespond/jRespond.min.js"></script>

<script src="assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>

<script src="assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>

<script src="assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>

<script src="assets/js/vendor/screenfull/screenfull.min.js"></script>

<script src="assets/js/vendor/parsley/parsley.min.js"></script>

<script src="assets/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="assets/js/vendor/daterangepicker/moment.min.js"></script>

<script src="assets/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/js/vendor/chosen/chosen.jquery.min.js"></script>
<script src="assets/js/vendor/datatables/js/jquery.dataTables.min.js"></script>

<script src="assets/js/vendor/datatables/extensions/dataTables.bootstrap.js"></script>

<script src="assets/js/vendor/datatables/extensions/Pagination/input.js"></script>
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

    
<script>
$('#add_holiday').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true});

</script>
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
            "ajax": 'assets/extras/employee.json',
            "order": [[1, "desc"]],
            "columns": [
                {
                    "data": null,
                    "defaultContent": ''
                },
                {
					"data":"holiday"},
				{
                    "type": "html",
                    "data": "id",
                    "render": function (data) {
						
                        return '<a onclick="delete_id(' + data + ')" class="btn btn-xs btn-lightred" data-toggle="modal" data-target="#splash" data-options="splash-ef-3"><i class="fa fa-times"></i> Delete</a>';
                 }}
                
                
            ],
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': ["no-sort"]}
            ],
            "drawCallback": function (settings, json) {
                $(".formatDate").each(function (idx, elem) {
                    $(elem).text($.format.date($(elem).text(), "MMM d, yyyy"));
                });
                $('#select-all').change(function () {
                    if ($(this).is(":checked")) {
                        $('#products-list tbody .selectMe').prop('checked', true);
                    } else {
                        $('#products-list tbody .selectMe').prop('checked', false);
                    }
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
	<script>
    function delete_id(id)
    {
		//alert(id);
        $.session.set('delete_seesion',id);
        $('#hid').val($.session.get('delete_seesion'));
        
    }
    $('#sub_btn').click(function () {
        var pass_val = $('#hid').val();
		//alert(pass_val);
        $.ajax({
            url: "delete_holiday.php",
            type: "POST",
            data: {pass_val: pass_val},
            success: function (data) {
				//alert(data);
                window.location = "accounts_manage_holiday.php";
            }
        });
    });
</script>
	
	<script>
$('#submit_btn').click(function(){
   $('#succ').html("");
    var add_holiday = $('#add_holiday').val();
	
    if(add_holiday==''){
       $('#error').html("Select Holiday").fadeOut(1000);
	   
    }
    else {
        $.ajax({
            url: 'manage_holiday_action.php',
            type: 'POST',
            
            data: {add_holiday: add_holiday},
            success: function (data) {
				
					$('#succ').html(data).hide('slow');
				
                   window.location="accounts_manage_holiday.php";
                

            }
        });
    }
});
	</script>
	


