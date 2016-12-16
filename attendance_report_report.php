<?php
//$page = "employee";
$page = "management";
$tab = "emp1_report";
$sub = "attendance_report_report";
include('file_parts/header.php');
if (isset($_REQUEST["id"])) {
    $attnd_id = $_REQUEST["id"];
    $emp_resFet = $db->selectQuery("SELECT CONCAT( sm_employee.employee_firstname,  ' ', sm_employee.employee_middlename,  ' ', sm_employee.employee_lastname ) AS full_name,employee_designation FROM sm_employee WHERE employee_id='$attnd_id'");
    if (count($emp_resFet)) {
        $attnd_name = $emp_resFet[0]['full_name'];
        $attnd_designation = $emp_resFet[0]['employee_designation'];
    }
}
if (isset($_REQUEST["year"])) {
    $attnd_year = $_REQUEST["year"];
}
if (isset($_REQUEST["month"])) {
    $attnd_month = $_REQUEST["month"];
}

$where = "";
date_default_timezone_set('Asia/Qatar');
$date_today = date('Y-m-d');

if (!empty($_REQUEST['id']) && !empty($_REQUEST['year']) && !empty($_REQUEST['month']) && !empty($_REQUEST['day'])) {
    $iddd = $_REQUEST['id'];
    $date_c = $_REQUEST['year'] . "-" . $_REQUEST['month'] . "-" . $_REQUEST['day'];
    $where.= ($where == '') ? ' WHERE ' : ' AND ';
    $where.=" sm_employee_attendance.attendance_date='$date_c' AND sm_employee_attendance.employee_id='$iddd'";
}
if (!empty($_REQUEST['id']) && !empty($_REQUEST['year']) && !empty($_REQUEST['month']) && empty($_REQUEST['day'])) {
    $iddd = $_REQUEST['id'];
    $date_c = $_REQUEST['year'] . "-" . $_REQUEST['month'] . "-" . $_REQUEST['day'];
    $where.= ($where == '') ? ' WHERE ' : ' AND ';
    $where.=" year(sm_employee_attendance.attendance_date)='$attnd_year' AND  month(sm_employee_attendance.attendance_date)='$attnd_month' AND sm_employee_attendance.employee_id='$iddd'";
}
if (!empty($_REQUEST['id']) && !empty($_REQUEST['year']) && empty($_REQUEST['month']) && empty($_REQUEST['day'])) {
    $iddd = $_REQUEST['id'];
    $date_c = $_REQUEST['year'] . "-" . $_REQUEST['month'] . "-" . $_REQUEST['day'];
    $where.= ($where == '') ? ' WHERE ' : ' AND ';
    $where.=" year(sm_employee_attendance.attendance_date)='$attnd_year' AND sm_employee_attendance.employee_id='$iddd'";
}
if (empty($_REQUEST['id']) && !empty($_REQUEST['year']) && !empty($_REQUEST['month']) && !empty($_REQUEST['day'])) {
    $date_c = $_REQUEST['year'] . "-" . $_REQUEST['month'] . "-" . $_REQUEST['day'];
    $where.= ($where == '') ? ' WHERE ' : ' AND ';
    $where.=" sm_employee_attendance.attendance_date='$date_c'";
} if (empty($_REQUEST['id']) && !empty($_REQUEST['year']) && !empty($_REQUEST['month']) && empty($_REQUEST['day'])) {
    //$date_c = $_REQUEST['year'] . "-" . $_REQUEST['month'] . "-" . $_REQUEST['day'];
    $where.= ($where == '') ? ' WHERE ' : ' AND ';
    $where.=" year(sm_employee_attendance.attendance_date)='$attnd_year' AND  month(sm_employee_attendance.attendance_date)='$attnd_month'";
}
if (!isset($_REQUEST['id']) && !isset($_REQUEST['year']) && !isset($_REQUEST['month']) && !isset($_REQUEST['day'])) {
    $date_c = $_REQUEST['year'] . "-" . $_REQUEST['month'] . "-" . $_REQUEST['day'];
    $where.= ($where == '') ? ' WHERE ' : ' AND ';
    $where.=" sm_employee_attendance.attendance_date='$date_today'";
}
$attndArray = array();
echo "*****************************<br>";
echo $where;
echo "*****************************";
$resFet = $db->selectQuery("SELECT "
        . "CONCAT( sm_employee.employee_firstname,  ' ', sm_employee.employee_middlename,  ' ', sm_employee.employee_lastname ) AS full_name, "
        . "sm_employee.employee_id,sm_employee.employee_designation,sm_employee_attendance.attendance_date, "
        . "CAST(sm_employee_attendance.attendance_punch_in_time AS time) time_in,"
        . "CAST(sm_employee_attendance.attendance_punch_out_time AS time) time_out,"
        . "sm_employee_attendance.attendance_punch_in_format,"
        . "sm_employee_attendance.attendance_punch_out_format,"
        . "sm_employee_attendance.attendance_punch_out_time,"
        . "sm_employee_attendance.attendance_punch_in_location,"
        . "sm_employee_attendance.attendance_punch_in_ip,"
        . "sm_employee_attendance.attendance_punch_out_ip,"
        . "sm_employee_attendance.attendance_punch_out_location,sm_employee_work_report.report_id "
        . "FROM sm_employee "
        . "INNER JOIN sm_employee_attendance "
        . "ON sm_employee.employee_id=sm_employee_attendance.employee_id "
        . "INNER JOIN sm_employee_work_report "
        . "ON sm_employee.employee_id=sm_employee_work_report.employee_id " . $where);

if (count($resFet)) {
    $insert_punch_in = "";
    $number = 1;
    for ($rC = 0; $rC < count($resFet); $rC++) {
        $pun_out = new DateTime($resFet[$rC]['time_out']);
        if ($pun_out == "") {
            $pun_out_insert = "";
        } else {
            $pun_out_insert = $pun_out->format("h:i:s") . " " . $resFet[$rC]['attendance_punch_out_format'];
        }
        $values['s_number'] = $number + $rC;
        $values['employee_id'] = $resFet[$rC]['employee_id'];
        $values['full_name'] = $resFet[$rC]['full_name'];
        $values['employee_designation'] = $resFet[$rC]['employee_designation'];
        $datee = new DateTime($resFet[$rC]['attendance_date']);
        $values['attendance_date'] = $datee->format("d/m/Y");
        $punch_in = new DateTime($resFet[$rC]['time_in']);
        if (!empty($punch_in)) {
            $insert_punch_in = $punch_in->format("h:i:s") . " " . $resFet[$rC]['attendance_punch_in_format'];
        } else {
            $insert_punch_in = "";
        }
        $values['attendance_punch_in_time'] = $insert_punch_in;
        $values['attendance_punch_in_location'] = $resFet[$rC]['attendance_punch_in_location'];
        $values['attendance_punch_in_ip'] = $resFet[$rC]['attendance_punch_in_ip'];
        $values['attendance_punch_out_ip'] = $resFet[$rC]['attendance_punch_out_ip'];
        $values['attendance_punch_out_time'] = $pun_out_insert;
        $values['attendance_punch_out_location'] = $resFet[$rC]['attendance_punch_out_location'];
        $values['report_id'] = $resFet[$rC]['report_id'];
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



            <h2>Attendence Report <span></span></h2>



            <div class="page-bar">



                <ul class="page-breadcrumb">

                    <li>

                        <a><i class="fa fa-home"></i> SME</a>

                    </li>

                    <li>

                        <a href="#">Attendence</a>

                    </li>

                    <li>

                        <a href="companylist.php">Attendence Report</a>

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

                            <h1 class="custom-font"><strong>Attendence</strong> Report</h1>

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
                            <form method="POST">
                                <div class="table-responsive">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <label for="last-name">Designation</label>
                                            <select class="form-control" name="designation" id="designation" required="">
                                                <option selected="" value=""> Select</option>
                                                <?php
                                                $select = $db->selectQuery("SELECT `designation_name`,`designation_id` FROM `sm_designation` WHERE designation_status='1'");
                                                if (count($select) > 0) {
                                                    for ($ei = 0; $ei < count($select); $ei++) {
                                                        ?>
                                                        <option value="<?php echo $select[$ei]['designation_id']; ?>"><?php echo $select[$ei]['designation_name']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div  name="emp_id_name" id="emp_id_name">
                                            <div class="form-group col-md-2">
                                                <label for="phone">Employee Name: </label>
                                                <select class="form-control mb-10" name="employee_name" id="attnd_employee_name"  >
                                                    <option  value="">Select</option>
                                                    <?php
                                                    $select = $db->selectQuery("select CONCAT( sm_employee.employee_firstname,  ' ', sm_employee.employee_middlename,  ' ', sm_employee.employee_lastname ) AS full_name,employee_id  FROM sm_employee");
                                                    if (count($select)) {
                                                        for ($rt = 0; $rt < count($select); $rt++) {
                                                            ?>
                                                            <option value="<?php echo $select[$rt]['employee_id']; ?>" <?php echo $select[$rt]['full_name']; ?> </option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-2">

                                                <label for="emp_id">Employee ID</label>
                                                <select class="form-control mb-10" name="emp_id" id="emp_id">
                                                    <option  value="">Select</option>
                                                    <?php
                                                    $select_id = $db->selectQuery("select employee_id,employee_employment_id  FROM sm_employee");
                                                    if (count($select_id)) {
                                                        for ($rt = 0; $rt < count($select_id); $rt++) {
                                                            ?>
                                                            <option value="<?php echo $select_id[$rt]['employee_id']; ?>"> <?php echo $select_id[$rt]['employee_employment_id']; ?> </option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="year">Year: </label>
                                            <select class="form-control mb-10" id="attnd_year" name="year">
                                                <?php
                                                for ($i = date("Y"); $i >= 1990; $i--) {
                                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">

                                            <label for="month">Month: </label>

                                            <select id='attnd_month' class="form-control mb-10">
                                                <option value='' selected>--Select Month--</option>
                                                <option  value='01'>January</option>
                                                <option value='02'>February</option>
                                                <option value='03'>March</option>
                                                <option value='04'>April</option>
                                                <option value='05'>May</option>
                                                <option value='06'>June</option>
                                                <option value='07'>July</option>
                                                <option value='08'>August</option>
                                                <option value='09'>September</option>
                                                <option value='10'>October</option>
                                                <option value='11'>November</option>
                                                <option value='12'>December</option>
                                            </select>


                                        </div>
                                        <div class="form-group col-md-2">

                                            <label for="month">Day: </label>

                                            <select id='attnd_day' class="form-control mb-10">
                                                <option value='' selected="">--Select Day--</option>
                                                <?php
                                                for ($d = 1; $d <= 31; $d++) {
                                                    if (strlen($d) == 1) {
                                                        $d = "0" . $d;
                                                    }
                                                    ?>
                                                    <option value="<?php echo $d; ?>"><?php echo $d; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>


                                        </div>

                                        <div class="form-group col-md-3">
                                            <button id="attnd_button" name="submit" class="btn btn-success" type="button" >submit</button>
                                        </div>

                                        </form>
                                    </div>


                                    <?php if (!empty($_REQUEST['id']) && isset($_REQUEST['year']) != "" && isset($_REQUEST['month']) != "" && isset($_REQUEST['day']) != "") { ?>
                                        <div class="form-group col-md-4" style="margin-left:-16px;margin-bottom:15px">

                                            <label for="Employee_Name">Employee Name: </label>
                                            <input type="text" readonly value="<?php echo @$attnd_name; ?>" name="" class="form-control"  style="margin-right:10px;" >
                                        </div>
                                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp

                                        <div class="form-group col-md-4">
                                            <label for="designation">Designation: </label>
                                            <input type="text" readonly value="<?php echo @$attnd_designation; ?> " name="" class="form-control">
                                        </div>

                                    <?php } ?>


                                </div>
                                <?php
                                // if (isset($_REQUEST["id"])) {
                                ?>
                                <!--<label for="em_desig">Designation: </label>
                                       <input type="text" readonly value="<?php echo @$values['employee_designation']; ?>"name="emp_desig">
                                        <label for="em_name">Employee: </label>
                                       <input type="text"  readonly value="<?php echo @$values['full_name']; ?>"name="emp_name">
                                        <label for="em_id">Employee ID: </label>
                                       <input type="text"  readonly value="<?php echo @$values['employee_id']; ?>"name="emp_id">
                                       <br><br>-->
                                <div class="table-responsive">


                                    <table class="table table-striped table-hover table-custom" id="products-list">

                                        <thead>

                                            <tr>

                                                <th>Sl.no</th>
                                                <?php if (empty($_REQUEST['id']) && isset($_REQUEST['year']) != "" && isset($_REQUEST['month']) != "" && isset($_REQUEST['day']) != "") { ?>
                                                    <th >Name</th>
                                                    <th >Designation</th>
                                                    <?php
                                                }
                                                if (!isset($_REQUEST['id'])) {
                                                    ?>
                                                    <th >Name</th>
                                                    <th >Designation</th>
                                                    <?php
                                                }
                                                ?>

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
                                <br><br>

                                <?php // }      ?>



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
                                                title: 'Attendance List  <?php
                                if (!empty($_REQUEST['id']) && isset($_REQUEST['year']) != "" && isset($_REQUEST['month']) != "" && isset($_REQUEST['day']) != "") {
                                    echo @$attnd_name;
                                }
                                ?>'
                                        },
                                        {
                                        extend: 'pdfHtml5',
                                                title: 'Attendance List  <?php
                                if (!empty($_REQUEST['id']) && isset($_REQUEST['year']) != "" && isset($_REQUEST['month']) != "" && isset($_REQUEST['day']) != "") {
                                    echo @$attnd_name;
                                }
                                ?>'
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
                                        "order": [[1, "dsc"]],
                                        "columns": [
                                        {"data": "s_number"},
<?php
if (!isset($_REQUEST['id'])) {
    ?>{"data":"full_name"},
                                            {"data":"employee_designation"},<?php
}
if (empty($_REQUEST['id']) && isset($_REQUEST['year']) != "" && isset($_REQUEST['month']) != "" && isset($_REQUEST['day']) != "") {
    ?>{"data":"full_name"},
                                            {"data":"employee_designation"},<?php
}
?>
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
                                        "aLengthMenu"
                                        : [[10, 25, 50, - 1], [10, 25, 50, "All"]],
                                        "drawCallback"
                                        : function (settings, json) {
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
                            }).draw(); //*initialize datatable
                            });</script>
                        <!--/ Page Specific Scripts -->
                        <script>
                                    $("#attnd_button").click(function () {
                                var employee_name = jQuery('#attnd_employee_name').val();
                                var year = jQuery('#attnd_year').val();
                                var month = jQuery('#attnd_month').val();
                                var day = jQuery('#attnd_day').val();
                                location.href = 'attendance_report_report.php?year=' + year + '&month=' + month + '&day=' + day + '&id=' + employee_name;
                            });</script>

                        <script>
                            $('body').on('change', '#designation', function () {
                                var designation = $(this).val();
                                $.ajax({
                                    url: "attendance_report_desig_ajax.php",
                                    type: "POST",
                                    data: {designation: designation},
                                    success: function (data) {
                                        //alert(data);
                                        $('#emp_id_name').html(data);
                                    }
                                });
                            });</script>
                        <script>
                            $('body').on('change', '#attnd_employee_name', function () {
                                var emp_name = $(this).val();
                                $.ajax({
                                    url: "attendance_report_empid_ajax.php",
                                    type: "POST",
                                    data: {emp_name: emp_name},
                                    success: function (data) {
                                        //alert(data);
                                        $('#emp_id').html(data);
                                    }
                                });
                            });</script>
                        <script>
                            $('body').on('change', '#emp_id', function () {
                                var emp_id = $(this).val();
                                $.ajax({
                                    url: "attendance_report_empname_ajax.php",
                                    type: "POST",
                                    data: {emp_id: emp_id},
                                    success: function (data) {
                                        //alert(data);
                                        $('#attnd_employee_name').html(data);
                                    }
                                });
                            });
                        </script>


                        </body>
                        </html>

