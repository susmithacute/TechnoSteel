<?php
$page = "employee";

$sub = "attnd_rpt";

include('header.php');

if (isset($_REQUEST["year"])) {
    // $attnd_id = $emp_id;
    $attnd_year = $_REQUEST["year"];
    $attnd_month = $_REQUEST["month"];
    $attndArray = array();

    $resFet = $db->selectQuery("SELECT "
            . "CONCAT(sm_employee.employee_firstname,  ' ', sm_employee.employee_middlename,  ' ', sm_employee.employee_lastname ) AS full_name, "
            . "sm_employee.employee_id,sm_employee.employee_designation,sm_employee_attendance.attendance_date, "
            . "CAST(sm_employee_attendance.attendance_punch_in_time AS time) time_in,"
            . "CAST(sm_employee_attendance.attendance_punch_out_time AS time) time_out,"
            . "sm_employee_attendance.attendance_punch_in_format,"
            . "sm_employee_attendance.attendance_punch_out_format,"
            . "sm_employee_attendance.attendance_punch_in_location,"
            . "sm_employee_attendance.attendance_punch_out_location, "
            . "sm_employee_attendance.attendance_punch_in_ip, "
            . "sm_employee_attendance.attendance_punch_out_ip "
            . "FROM sm_employee "
            . "INNER JOIN sm_employee_attendance ON sm_employee.employee_id=sm_employee_attendance.employee_id "
            . "WHERE sm_employee.employee_id='$emp_id' "
            . "AND year(sm_employee_attendance.attendance_date)='$attnd_year' "
            . "AND month(sm_employee_attendance.attendance_date)='$attnd_month'");

    if (count($resFet) > 0) {
        for ($rC = 0; $rC < count($resFet); $rC++) {
            $time_out1 = new DateTime($resFet[$rC]['time_out']);
            $time_out = $time_out1->format("h:i:s");
            $time_in1 = new DateTime($resFet[$rC]['time_in']);
            $time_in = $time_in1->format("h:i:s");
            $values['employee_id'] = $resFet[$rC]['employee_id'];
            $values['full_name'] = $resFet[$rC]['full_name'];
            $values['employee_designation'] = $resFet[$rC]['employee_designation'];
            $datee = new DateTime($resFet[$rC]['attendance_date']);
            $values['attendance_date'] = $datee->format("d/m/Y");
            $values['attendance_punch_in_time'] = $time_in . " " . $resFet[$rC]['attendance_punch_in_format'];
            $values['attendance_punch_in_location'] = $resFet[$rC]['attendance_punch_in_location'];
            $values['attendance_punch_out_time'] = $time_out . " " . $resFet[$rC]['attendance_punch_out_format'];
            $values['attendance_punch_out_location'] = $resFet[$rC]['attendance_punch_out_location'];
            $values['attendance_punch_in_ip'] = $resFet[$rC]['attendance_punch_in_ip'];
            $values['attendance_punch_out_ip'] = $resFet[$rC]['attendance_punch_out_ip'];
            $attndArray["data"][] = $values;
        }
    }
    $fp = fopen('../assets/extras/attendancez.json', 'w');
    fwrite($fp, json_encode($attndArray));
    fclose($fp);
}
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

                        <a href="#">Attendence Report</a>

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
                            <div class="table-responsive">
                                <div class="row">

                                    <!--    <div class="form-group col-md-2">
                                                <label for="last-name">Designation</label>
                                                <select class="form-control" name="designation" id="designation" required="">
                                                                                                                    <option selected="" value=""> Select</option>
                                    <?php
                                    $select = $db->selectQuery("SELECT `designation_name`,`designation_id` FROM `sm_designation` WHERE designation_status='1'");
                                    if (count($select) > 0) {
                                        for ($ei = 0; $ei < count($select); $ei++) {
                                            ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <option value="<?php echo $select[$ei]['designation_id']; ?>"<?php
                                            if ($select[$ei]['designation_name'] == @$values['employee_designation']) {
                                                echo "selected";
                                            }
                                            ?>><?php echo $select[$ei]['designation_name']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                                                                                            </select>
                                            </div>-->
                                    <!--
                              <div  name="emp_id_name" id="emp_id_name">
    <div class="form-group col-md-2">
        <label for="phone">Employee: </label>
        <select class="form-control mb-10" name="employee_name" id="attnd_employee_name"  >
            <option  value="">Select</option>
                                    <?php
                                    $select = $db->selectQuery("select CONCAT( sm_employee.employee_firstname,  ' ', sm_employee.employee_middlename,  ' ', sm_employee.employee_lastname ) AS full_name,employee_id  FROM sm_employee");
                                    if (count($select)) {
                                        for ($rt = 0; $rt < count($select); $rt++) {
                                            ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <option value="<?php echo $select[$rt]['employee_id']; ?>"<?php
                                            if ($select[$rt]['employee_id'] == @$values['employee_id']) {
                                                echo "selected";
                                            }
                                            ?>> <?php echo $select[$rt]['full_name']; ?> </option>
                                            <?php
                                        }
                                    }
                                    ?>
        </select>
    </div>
                                    <div class="form-group col-sm-2">

             <label for="emp_id">Employee Id</label>
                                                     <select class="form-control mb-10" name="emp_id" id="emp_id">
            <option  value="">Select</option>
                                    <?php
                                    $select_id = $db->selectQuery("select employee_id  FROM sm_employee");
                                    if (count($select_id)) {
                                        for ($rt = 0; $rt < count($select_id); $rt++) {
                                            ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <option value="<?php echo $select_id[$rt]['employee_id']; ?>"> <?php echo $select_id[$rt]['employee_id']; ?> </option>
                                            <?php
                                        }
                                    }
                                    ?>
        </select>

                                    </div>
                            </div>
                                    -->
                                    <div class="form-group col-md-5">
                                        <label for="year">year: </label>
                                        <select class="form-control mb-10" id="attnd_year" name="year">
                                            <option  value="<?php echo date("Y"); ?>"><?php echo date("Y"); ?></option>
                                            <?php
                                            for ($i = 1990; $i < date("Y") + 1; $i++) {
                                                echo '<option value="' . $i . '">' . $i . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-5">

                                        <label for="month">month: </label>

                                        <select id='attnd_month' class="form-control mb-10">
                                            <option value=''>--Select Month--</option>
                                            <option selected value='1'>Janaury</option>
                                            <option value='2'>February</option>
                                            <option value='3'>March</option>
                                            <option value='4'>April</option>
                                            <option value='5'>May</option>
                                            <option value='6'>June</option>
                                            <option value='7'>July</option>
                                            <option value='8'>August</option>
                                            <option value='9'>September</option>
                                            <option value='10'>October</option>
                                            <option value='11'>November</option>
                                            <option value='12'>December</option>
                                        </select>


                                    </div>

                                    <div class="form-group col-md-3">
                                        <button id="attnd_button" name="submit" class="btn btn-success" type="button">submit</button>
                                    </div>
                                </div>

                            </div>
                            <?php
                            if (isset($_REQUEST["year"])) {
                                ?>
                                <!--<label for="em_desig">Designation: </label>
                                       <input type="text" readonly value="<?php //echo @$values['employee_designation'];                                        ?>"name="emp_desig">
                                        <label for="em_name">Employee: </label>
                                       <input type="text"  readonly value="<?php //echo @$values['full_name'];                                        ?>"name="emp_name">
                                        <label for="em_id">Employee ID: </label>
                                       <input type="text"  readonly value="<?php //echo @$values['employee_id'];                                        ?>"name="emp_id">
                                       <br><br>-->
                                <div class="table-responsive">


                                    <table class="table table-striped table-hover table-custom" id="products-list">

                                        <thead>

                                            <tr>

                                                <th>Sl.no</th>
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

                            <?php } ?>



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


<!--/ vendor javascripts -->



<?php include './footer.php'; ?>




<!-- ============================================

============== Custom JavaScripts ===============

============================================= -->



<!--/ custom javascripts -->









<!-- ===============================================

============== Page Specific Scripts ===============

================================================ -->


<!--/ Page Specific Scripts -->
<script>
    $("#attnd_button").click(function () {
        var employee_name = '<?php echo $emp_id; ?>';
        var year = jQuery('#attnd_year').val();
        var month = jQuery('#attnd_month').val();
        location.href = 'attendance_report.php?year=' + year + '&month=' + month;
    });

</script>

<script>

    $(window).load(function () {



        //initialize datatable

        var t = $('#products-list').DataTable({
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
            "ajax": '../assets/extras/attendancez.json',
            "order": [[1, "desc"]],
            "columns": [
                {"data": null},
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

            }
        });
        t.on('order.dt search.dt', function () {
            t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();        //*initialize datatable
    });
</script>
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
    });
</script>
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
    });
</script>
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

