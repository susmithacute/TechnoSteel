<?php

$page = "employee";
$tab = "employee_salary";
$sub = "advance_add_add";
$head = "";
$head1 = "";
$sub1 = "advance_approved";
$tab1 = "";

// $page = "Accounting";
// $tab = "salary";
// $sub = "advance";
// $sub1 = "advance_approved";
// $page = "Accounting";
// $tab = "salary";
// $sub = "advance";
// $sub1 = "advance_approved";
include("file_parts/header.php");
$advArray = array();
$resFet = $db->selectQuery("SELECT sm_employee.employee_firstname, sm_employee.employee_salary,sm_employee.employee_id,sm_salary_advance.advance_amount,sm_salary_advance.advance_id,sm_salary_advance.advance_payment_status FROM sm_employee INNER JOIN sm_salary_advance ON sm_employee.employee_id=sm_salary_advance.employee_id");

if (count($resFet)) {

    for ($rC = 0; $rC < count($resFet); $rC++) {
       //$prt_id=$resFet[$rC]['candidate_id'];
	   $values['advance_id'] =($resFet[$rC]['advance_id']);
        $values['employee_id'] =($resFet[$rC]['employee_id']);
        $values['employee_firstname'] =  htmlspecialchars_decode($resFet[$rC]['employee_firstname']);
		 $values['employee_salary'] =($resFet[$rC]['employee_salary']);
		 $values['advance_amount'] =($resFet[$rC]['advance_amount']);
		 $values['advance_payment_status'] =($resFet[$rC]['advance_payment_status']);
        $advArray["data"][] = $values;
		//print_r($values);
		//print_r($comArray["data"][0]);die;
		//echo($comArray["data"][0]);die;


    }

}
  
$fp = fopen('assets/extras/advapp.json', 'w');
fwrite($fp, json_encode($advArray));
fclose($fp);
?>
<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<section id="content">

    <div class="page page-shop-products">

        <div class="pageheader">

            <h2>Advance Approved<span></span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-home"></i> SME</a>
                    </li>
                    <li>
                        <a>Advance Approved</a>
                    </li>
                    <li>
                        <a>Advance Approved List</a>
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
                            <h1 class="custom-font"><strong>Advance Approved List</strong></h1>
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
                                <table class="table table-striped table-hover table-custom" id="products-list">
                                    <thead>
                                    <tr>
                                        <th>Sl.no</th>
                                        <th style="width:90px;">Employee Name</th>
                                        <th>Employee Salary</th>
                                        <th>Requested Amount</th>
                                        <th style="width:90px;">Status</th>
                                        <th style="width:150px;" class="no-sort">Actions</th>
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

<div class="modal splash fade" id="splash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title custom-font">Pay Advance?</h3>
            </div>
            <input type="hidden" id="hid_del" value=""/>
            <div class="modal-body">

                
            </div>
            <div class="modal-footer">
                <button class="btn btn-default btn-border" id="sub_btn">Yes</button>
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
            "ajax": 'assets/extras/advapp.json',
            "order": [[1, "asc"]],
            "columns": [
                {
                    "data": "null",
                    "defaultContent": ''
                },
               
                {"data": "employee_firstname"},
                {"data": "employee_salary"},
                {"data": "advance_amount"},
				{"data": "advance_payment_status"},
				//{"data": "employee_id"},
				//{"data": "advance_amount"},
                {
                    "type": "html",
                    "data": "advance_id",
                    "render": function (data) {
                        return '<a onclick="update_id(' + data + ')" class="btn btn-xs btn-green" data-toggle="modal" data-target="#splash" data-options="splash-ef-3"><i class="fa fa-check"></i>Pay</a>';
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
<!--/ Page Specific Scripts -->

<script type="text/javascript">
    function update_id(id)
    {
        $('#hid_del').val(id);
        // alert($.session.get('delete_seesion'));
    }
    $('#sub_btn').click(function () {
        var update_id= $('#hid_del').val();
        $.ajax({
            url: "advance_paid_status.php",
            type: "POST",
            data: {update_id: update_id},
            success: function (data) {
               window.location = "advance_approved.php";
            }
        });
    });
</script>
</body>

</html>
