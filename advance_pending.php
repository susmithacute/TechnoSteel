<?php
$page = "employee";
$tab = "employee_salary";
$sub = "advance_add_add";
$head = "";
$head1 = "";
$sub1 = "advance_pending";
$tab1 = "";
// $page="Accounting";

// $tab="salary";

// $sub="advance";

// $sub1="advance_pending";



include("file_parts/header.php");

$advArray = array();

$resFet = $db->selectQuery("SELECT CONCAT(sm_employee.employee_firstname,' ',sm_employee.employee_middlename,' ',sm_employee.employee_lastname)as fullname, sm_employee.employee_salary,sm_employee.employee_id,sm_salary_advance.advance_amount,sm_salary_advance.advance_requested_date,sm_salary_advance.advance_status FROM sm_employee INNER JOIN sm_salary_advance ON sm_employee.employee_id=sm_salary_advance.employee_id WHERE`advance_status`='Not Paid'");



if (count($resFet)) {



    for ($rC = 0; $rC < count($resFet); $rC++) {

       //$prt_id=$resFet[$rC]['candidate_id'];

        $values['employee_id'] =($resFet[$rC]['employee_id']);
		$var = $resFet[$rC]['advance_requested_date'];
         $advance_requested_date = date('d-M-Y', strtotime(str_replace('-', '/', $var)));
        $values['advance_requested_date'] = $advance_requested_date;

        $values['fullname'] =  htmlspecialchars_decode($resFet[$rC]['fullname']);

		 $values['employee_salary'] =($resFet[$rC]['employee_salary']);

		 $values['advance_amount'] =($resFet[$rC]['advance_amount']);

		 $values['advance_status'] =($resFet[$rC]['advance_status']);

        $advArray["data"][] = $values;

		//print_r($values);

		//print_r($comArray["data"][0]);die;

		//echo($comArray["data"][0]);die;





    }



}

  

$fp = fopen('assets/extras/pending.json', 'w');

fwrite($fp, json_encode($advArray));

fclose($fp);

?>

<!-- ====================================================

================= CONTENT ===============================

===================================================== -->

<section id="content">



    <div class="page page-shop-products">



        <div class="pageheader">



            <h2>Advance Pending<span></span></h2>



            <div class="page-bar">



                <ul class="page-breadcrumb">

                    <li>

                        <a href="#"><i class="fa fa-home"></i> SME</a>

                    </li>

                    <li>

                        <a>Advance Pending</a>

                    </li>

                    <li>

                        <a>Advance Pending List</a>

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

                            <h1 class="custom-font"><strong>Advance pending List</strong></h1>

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

                                        <th>Employee Name</th>

                                        <th>Employee Salary</th>

                                        <th>Requested Amount</th>
										
										<th>Requested Date</th>
										

                                        <th style="width:90px;">Status</th>

                                        

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

            "ajax": 'assets/extras/pending.json',

            "order": [[1, "asc"]],

            "columns": [

                {

                    "data": "null",

                    "defaultContent": ''

                },

               

                {"data": "fullname"},

                {"data": "employee_salary"},

                {"data": "advance_amount"},
				
				{"data": "advance_requested_date"},

				{"data": "advance_status"},

				

				//{"data": "advance_amount"},

               

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





</body>



</html>

