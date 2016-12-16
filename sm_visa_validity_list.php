<?php
$page = "recruitment";
$tab = "recruit_settings";
$sub = "notification_settings";
$sub1 = "visa_validity_list";
//$sub = "visa_validity_list";

//$sub1 = "advance_request";
include("file_parts/header.php");
$validityArray = array();
$resFet = $db->selectQuery("SELECT sm_visa_validity.notification_name,sm_visa_validity.id, sm_visa_validity.validity_period,sm_visa_validity.notify_period from sm_visa_validity Where status='active'");

if (count($resFet)) {

    for ($rC = 0; $rC < count($resFet); $rC++) {
       //$prt_id=$resFet[$rC]['candidate_id'];
	   $values['id'] =($resFet[$rC]['id']);
	   $values['notify_period'] =($resFet[$rC]['notify_period']);
	   $values['notification_name'] =($resFet[$rC]['notification_name']);
        $values['validity_period'] =($resFet[$rC]['validity_period']);
        
        $validityArray["data"][] = $values;
		//print_r($values);no need
		//print_r($comArray["data"][0]);die;
		//echo($comArray["data"][0]);die;

	}
}
    


  
$fp = fopen('assets/extras/validity.json', 'w');
fwrite($fp, json_encode($validityArray));
fclose($fp);
?>
<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<section id="content">

    <div class="page page-shop-products">

        <div class="pageheader">

            <h2>Notification List<span></span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-home"></i> SME</a>
                    </li>
					 <li>
                        <a>HR</a>
                    </li>
                    <li>
                        <a>Recruitment</a>
                    </li>
                    <li>
                        <a>Settings</a>
                    </li>
					<li>
                        <a>Notification</a>
                    </li>
					 <li>
                        <a>Notification List</a>
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
                            <h1 class="custom-font"><strong>Notification List</strong></h1>
                            <ul class="controls">
							
							<li>
 <a href="sm_visa_validity_add.php" role="button" tabindex="0" class="tile-add" title="Add Notify Period">
 <i class="fa fa-plus"></i>
 </a>
</li>
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
                                <table class="table table-striped table-hover table-custom" id="products-list">
                                    <thead>
                                    <tr>
                                        <th style="width:90px;">Sl.no</th>
                                        <th style="width:90px;">Name Of Notification</th>
                                        <!--<th>Validity Period</th>-->
                                        <th style="width:90px;">Notify Period</th>
										
                                        <th style="width:90px;" class="no-sort">Actions</th>
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
<!--/ CONTENT -->



<div class="modal splash fade" id="splashdel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title custom-font">Are You Sure To Delete?</h3>
            </div>
            <input type="hidden" id="hid_del1" value=""/>
            <div class="modal-body">

                
            </div>
            <div class="modal-footer">
                <button class="btn btn-default btn-border" id="sub_btn">Yes</button>
				<!--<button class="btn btn-default btn-border" id="nosub_btn">Rejected</button>-->
                <button class="btn btn-default btn-border" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>




</div>

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
<script src="assets/js/vendor/datatables/extensions/dataTables.bootstrap.js"></script>
<script src="assets/js/vendor/datatables/extensions/Pagination/input.js"></script>

<script src="assets/js/vendor/date-format/jquery-dateFormat.min.js"></script>

<script src="assets/js/jquerysession.js"></script>
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
    $(window).load(function () {

        //initialize datatable
        var t =$('#products-list').DataTable({
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
            "ajax": 'assets/extras/validity.json',
            "order": [[1, "asc"]],
            "columns": [
                {
                    "data": "null",
                    "defaultContent": ''
                },
               
               
                {"data": "notification_name"},
                //{"data": "validity_period"},
				{"data": "notify_period"},
                
				{
					"type": "html",
					"data": "id",
					//"data": "validity_period",
					"render": function (data) {
                        return '<a onclick="delete_id(' + data + ')" class="btn btn-xs btn-red" data-toggle="modal" data-target="#splashdel" data-options="splash-ef-3">Delete</a><a href="sm_visa_validity_edit.php?edit_id=' + data + '" class="btn btn-xs btn-default mr-5"><i class="fa fa-pencil"></i> Edit</a>';
                }},
				
					
            ],
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
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
<!--/ Page Specific Scripts -->


<script type="text/javascript">
function update_id(id)
    {
		$.session.set('update_session',id);
        $('#hid_del').val($.session.get('update_session'));
        // alert($.session.get('delete_seesion'));
    }
    function delete_id(id)
    {
		$.session.set('delete_session',id);
        $('#hid_del1').val($.session.get('delete_session'));
        // alert($.session.get('delete_seesion'));
    }
    $('#sub_btn').click(function () {
        var pass_val= $('#hid_del1').val();
		
        $.ajax({
            url: "sm_visa_validity_delete.php",
            type: "POST",
            data: {pass_val: pass_val},
            success: function (data) {
				
                window.location = "sm_visa_validity_list.php";
            }
        });
    });
</script>

</body>

</html>
