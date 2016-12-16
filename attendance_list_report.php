<?php
$page = "management";
$tab = "emp1_report";

$sub = "attendance_list_report";

//$sub1 = "attendance_list_report";
include('file_parts/header.php');

$attndArray = array();

$resFet = $db->selectQuery("SELECT
CONCAT( sm_employee.employee_firstname,  ' ', sm_employee.employee_middlename,  ' ', sm_employee.employee_lastname ) AS full_name,
sm_employee.employee_id,sm_employee.employee_employment_id,sm_employee.employee_designation,
sm_employee_attendance.attendance_date,
CAST(sm_employee_attendance.attendance_punch_in_time AS time) time_in,
CAST(sm_employee_attendance.attendance_punch_out_time AS time) time_out,
sm_employee_attendance.attendance_punch_in_format,
sm_employee_attendance.attendance_punch_out_format,
sm_employee_attendance.attendance_punch_in_location,
sm_employee_attendance.attendance_punch_out_location,
sm_employee_attendance.attendance_punch_in_ip,sm_employee_attendance.attendance_punch_out_ip FROM sm_employee INNER JOIN sm_employee_attendance ON sm_employee.employee_id=sm_employee_attendance.employee_id");

if (count($resFet)) {
    $number = 1;
    for ($rC = 0; $rC < count($resFet); $rC++) {
        $emp_id_wrk = $resFet[$rC]['employee_id'];
        $wrk_date = $resFet[$rC]['attendance_date'];

        $resFet_report = $db->selectQuery("SELECT report_id FROM sm_employee_work_report WHERE employee_id='$emp_id_wrk' AND report_date='$wrk_date'");

        if (count($resFet_report)) {
            $values['report_id'] = $resFet_report[0]['report_id'];
        }
        $values['s_number'] = $number + $rC;
        $values['employee_id'] = $resFet[$rC]['employee_id'];
        $values['employee_employment_id'] = $resFet[$rC]['employee_employment_id'];
        $values['full_name'] = $resFet[$rC]['full_name'];
        $values['employee_designation'] = $resFet[$rC]['employee_designation'];
        $datee = new DateTime($resFet[$rC]['attendance_date']);
        $time_in_a = new DateTime($resFet[$rC]['time_in']);
        $time_out_a = new DateTime($resFet[$rC]['time_out']);
        $values['attendance_date'] = $datee->format("d/m/Y");
        $values['attendance_punch_in_time'] = $time_in_a->format('h:i:s') . " " . $resFet[$rC]['attendance_punch_in_format'];
        $values['attendance_punch_in_location'] = $resFet[$rC]['attendance_punch_in_location'];
        $values['attendance_punch_out_time'] = $time_out_a->format('h:i:s') . " " . $resFet[$rC]['attendance_punch_out_format'];
        $values['attendance_punch_out_location'] = $resFet[$rC]['attendance_punch_out_location'];
        $values['attendance_punch_in_ip'] = $resFet[$rC]['attendance_punch_in_ip'];
        $values['attendance_punch_out_ip'] = $resFet[$rC]['attendance_punch_out_ip'];

        $attndArray["data"][] = $values;
    }
}
$fp = fopen('assets/extras/attendance.json', 'w');
fwrite($fp, json_encode($attndArray));
fclose($fp);
?>

<!-- ====================================================

================= CONTENT ===============================

===================================================== -->

<section id="content">



    <div class="page page-shop-products">



        <div class="pageheader">



            <h2>Attendence List <span></span></h2>



            <div class="page-bar">



                <ul class="page-breadcrumb">

                    <li>

                        <a><i class="fa fa-home"></i> SME</a>

                    </li>

                    <li>

                        <a href="#">Attendence</a>

                    </li>

                    <li>

                        <a href="companylist.php">Attendence List</a>

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

                            <h1 class="custom-font"><strong>Attendence</strong> List</h1>

                            <ul class="controls">

                                <!--<li><a href="javascipt:;"><i class="fa fa-plus mr-5"></i> New Company</a></li>-->





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
                                            <th >Employee ID</th>
                                            <th>Employee Name</th>
                                            <th>Designation</th>
                                            <th >Date</th>
                                            <th>Punch in time</th>
                                            <th>Punch in Location</th>
                                            <th>Punch in IP</th>
                                            <th>Punch out time</th>
                                            <th>Punch out Location</th>
                                            <th>Punch out IP</th>


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

            <input type="hidden" id="hid_del" value=""/>

            <div class="modal-body">



                <p><span id="emp_count"></span> employees will be deleted.</p>

            </div>

            <div class="modal-footer">

                <button class="btn btn-default btn-border" id="sub_btn">Yes</button>

                <button class="btn btn-default btn-border" data-dismiss="modal">Cancel</button>

            </div>

        </div>

    </div>

</div>

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

<script src="assets/js/vendor/datatables/extensions/dataTables.bootstrap.js"></script>

<script src="assets/js/vendor/datatables/extensions/Pagination/input.js"></script>

<script src="assets/js/vendor/date-format/jquery-dateFormat.min.js"></script>

<!--/ vendor javascripts -->









<!-- ============================================

============== Custom JavaScripts ===============

============================================= -->

<script src="assets/js/main.js"></script>

<!--/ custom javascripts -->









<!-- ===============================================

============== Page Specific Scripts ===============

================================================ -->

<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">

<script>

    $(window).load(function () {



        //initialize datatable

        var t = $('#products-list').DataTable({
            "dom": 'Bf t<"row"<"col-md-4 col-sm-12"<"inline-controls no-print"l>><"col-md-4 col-sm-12"<"inline-controls text-center no-print"i>><"col-md-4 col-sm-12 no-print"p>>',
            "buttons": [
                {
                    extend: 'excelHtml5',
                    title: 'Attendance List'
                },
                {
                    extend: 'pdfHtml5',
                    title: 'Attendance List'
                }
                , "print"
            ],
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
            "ajax": 'assets/extras/attendance.json',
            "order": [[1, "asc"]],
            "columns": [
                {"data": "s_number"},
                {"data": "employee_employment_id"},
                {
                    "type": "html",
                    "data": "full_name",
                    "render": function (data, type, full, meta) {
                        return '<a href="employee_read.php?uid=' + full.employee_id + '" class=""><i class=""></i> ' + data + '</a>';
                    }},
                {"data": "employee_designation"},
                {"data": "attendance_date"},
                {"data": "attendance_punch_in_time"},
                {"data": "attendance_punch_in_location"},
                {"data": "attendance_punch_in_ip"},
                {"data": "attendance_punch_out_time"},
                {"data": "attendance_punch_out_location"},
                {"data": "attendance_punch_out_ip"}

            ],
            "aoColumnDefs": [
                {'bSortable': true, 'aTargets': 0}
            ],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
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
        t.on('order.dt search.dt', function () {
            t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();        //*initialize datatable
    });
</script>
<!--/ Page Specific Scripts -->

</body>
</html>

