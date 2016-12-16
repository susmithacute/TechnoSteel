<?php
$page = "payroll";
$sub = "salary_final";
$sub1 = "";
include("file_parts/header.php");
$advArray = array();

if (isset($_REQUEST["company"])) {
    $company_id = $_REQUEST["company"];

    $resFet = $db->selectQuery("SELECT CONCAT(sm_employee.employee_firstname,sm_employee.employee_middlename,sm_employee.employee_lastname) as employee_name, sm_employee.employee_salary,sm_employee.employee_id FROM sm_employee WHERE sm_employee.employee_status='1' AND sm_employee.employee_company='$company_id'");
} else {
    $resFet = $db->selectQuery("SELECT CONCAT(sm_employee.employee_firstname,' ',sm_employee.employee_middlename,' ',sm_employee.employee_lastname) as employee_name, sm_employee.employee_salary,sm_employee.employee_id FROM sm_employee "
            . " WHERE sm_employee.employee_status='1'");
}
$thisMonth = date("m");
$thisYear = date("Y");
$lastMonth1 = date('Y-m-d', strtotime('first day of last month'));
$lastMonth = date('m', strtotime(date($lastMonth) . " -1 month"));
if (count($resFet)) {

    for ($rC = 0; $rC < count($resFet); $rC++) {

    }
}
?>
<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<section id="content">

    <div class="page page-shop-products">

        <div class="pageheader">

            <h2>Employee Salary List<span></span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-home"></i> SME</a>
                    </li>
                    <li>
                        <a>Payroll</a>
                    </li>
                    <li>
                        <a>Salary List</a>
                    </li>
                </ul>

            </div>

        </div>

        <!-- page content -->
        <div class="pagecontent">
            <div class="row">
                <!-- col -->
                <div class="col-md-12">
                    <section class="tile">

                        <!-- tile header -->
                        <div class="tile-header dvd dvd-btm">
                            <h1 class="custom-font"><strong>Salary</strong> Update</h1>
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
                            <form method="POST">
                                <div class="form-group col-md-4">
                                    <label for="last-name">Company</label>
                                    <select class="form-control" name="company" id="company" required="">
                                        <option selected="" value=""> Select</option>
                                        <?php
                                        $select = $db->selectQuery("SELECT * FROM `sm_company` WHERE company_status='1'");
                                        if (count($select) > 0) {
                                            for ($ei = 0; $ei < count($select); $ei++) {
                                                ?>
                                                <option value="<?php echo $select[$ei]['company_id']; ?>"><?php echo $select[$ei]['company_name']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <?php if (isset($_REQUEST["company"])) { ?>
                                    <div class="form-group col-md-4">
                                        <button id="salary_list" name="button" class="btn btn-success" type="button" style="margin-top:23px;margin-left: 5px;margin-right: 35px;">Generate SIF</button>
                                    </div>
                                <?php }
                                ?>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-custom" id="editable-usage">
                                    <thead>
                                        <tr>
                                            <th style="width:90px;">Employee QID</th>
                                            <th style="width:90px;">Employee Name</th>
                                            <th style="width:10px;">Working Days</th>
                                            <th style="width:10px;">Net Salary</th>
                                            <th style="width:10px;">Basic Salary</th>
                                            <th style="width:10px;">Extra Hours</th>
                                            <th style="width:10px;">Extra Income</th>
                                            <th style="width:20px;">Deductions</th>
                                            <th style="width:90px;">Payment Type</th>
                                            <th style="width:90px;">Notes/Comments</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $cl = "";
                                        $deduct_amount = 0;
                                        if (count($resFet)) {
                                            $qatar_id = "";
                                            for ($rC = 0; $rC < count($resFet); $rC++) {
                                                $emp_id = $resFet[$rC]['employee_id'];
                                                $qatar = $db->selectQuery("SELECT `document_data` FROM `sm_employee_documents` WHERE `document_title`='Qatar ID' AND `status`='1' AND `employee_id`='$emp_id'");
                                                if (count($qatar)) {
                                                    $qatar_id = $qatar[0]['document_data'];
                                                }
                                                $emp_salary = $resFet[$rC]['employee_salary'];
                                                $basic_salary = preg_replace("/[^0-9]/", "", $emp_salary);
                                                if ($basic_salary == "") {
                                                    $basic_salary = 0;
                                                }
                                                $total_extra_working_income = $net_salary = $extra_hours = $extra_income = $normal_over_time = $holiday_over_time = $total_holiday_over_time = $total_normal_over_time = $total_normal_income = $holiday_extra = $total_holiday_income = 0;
                                                $times = $db->selectQuery("SELECT * FROM `sm_time_sheet` WHERE `employee_id`='$emp_id' AND MONTH(date)='$lastMonth'");
                                                if (count($times) > 0) {
                                                    for ($t = 0; $t < count($times); $t++) {
                                                        $normal_over_time = $times[$t]['normal_over_time'];
                                                        $holiday_over_time = $times[$t]['holiday_over_time'];
                                                        $total_normal_over_time = $total_normal_over_time + $normal_over_time;
                                                        $total_holiday_over_time = $total_holiday_over_time + $holiday_over_time;
                                                        $extra_hours = $extra_hours + $normal_over_time + $holiday_over_time;
                                                        if ($extra_hours > 85) {
                                                            $extra_hours = 85;
                                                        }
                                                    }
                                                }
                                                if ($basic_salary != 0) {
                                                    $per_day = $basic_salary / 30;
                                                    $per_hour = $per_day / 8;
                                                    $normal_extra = $per_hour * (1.25 / 100);
                                                    $total_normal_income = ($per_hour + $normal_extra) * $total_normal_over_time;
                                                    $holiday_extra = $per_hour * (1.5 / 100);
                                                    $total_holiday_income = ($per_hour + $holiday_extra) * $total_holiday_over_time;
                                                    $total_extra_working_income = $total_normal_income + $total_holiday_income;
                                                }
                                                $deduction_amount = $display_deduction = $deduct_this_month_amount = 0;
                                                $deductions = $db->selectQuery("SELECT `deduction_amount` FROM `sm_salary_deduction` WHERE `employee_id`='$emp_id' AND MONTH(deduction_date)='$thisMonth'");
                                                if (count($deductions)) {
                                                    for ($dct = 0; $dct < count($deductions); $dct++) {
                                                        $deduct_amount = $deductions[$dct]['deduction_amount'];
                                                        $deduction_amount = $deduction_amount + $deduct_amount;
                                                    }
                                                }
                                                if ($deduct_amount == 0) {
                                                    $display_deduction = "0";
                                                } else {

                                                    $this_month_deduct_percntage = $basic_salary / 4;
                                                    if ($deduction_amount >= $this_month_deduct_percntage) {
                                                        $deduct_this_month_amount = $this_month_deduct_percntage;
                                                    } else {
                                                        $deduct_this_month_amount = $deduction_amount;
                                                    }
                                                    $display_deduction = round($deduct_this_month_amount);
                                                } $this_month_deduct_percntage = $basic_salary / 4;
                                                if ($deduction_amount >= $this_month_deduct_percntage) {
                                                    $net_salary = round(($basic_salary + round($total_extra_working_income)) - $this_month_deduct_percntage);
                                                } else {
                                                    $net_salary = round(($basic_salary + round($total_extra_working_income)) - $deduct_this_month_amount);
                                                }

                                                //$holidays = $db->selectQuery("SELECT * FROM `holiday` WHERE MONTH(holiday)='$thisMonth'");
                                                $month_start_date = $thisYear . "-" . $thisMonth . "-01";
                                                $month_end_date1 = strtotime('last day of this month', time());
                                                $month_end_date = date("Y-m-d", $month_end_date1);
                                                $total_working_days = 0;
                                                $working_days = 0;
                                                $leave_days = 0;
                                                for ($dt = $month_start_date; $dt <= $month_end_date; $dt++) {
                                                    $check_date = strtotime($dt);
                                                    $emp_leave = $db->selectQuery("SELECT * FROM `sm_employee_leave` WHERE `employee_id`='$emp_id'");
                                                    if (count($emp_leave)) {
                                                        for ($lv = 0; $lv < count($emp_leave); $lv++) {
                                                            $leave_from = strtotime($emp_leave[$lv]['leave_from']);
                                                            $leave_to = strtotime($emp_leave[$lv]['leave_to']);
                                                            if (($check_date >= $leave_from) && ($check_date <= $leave_to)) {
                                                                $leave_days = $leave_days + 1;
                                                            } else {
                                                                $leave_days = $leave_days + 0;
                                                            }
                                                        }
                                                    } else {
                                                        $leave_days = $leave_days + 0;
                                                    }
                                                    $working_days = $working_days + 1;
                                                }
                                                if ($leave_days >= $working_days) {
                                                    $total_working_days = 0;
                                                } else {
                                                    $total_working_days = $working_days - $leave_days;
                                                }
                                                $deduction_list_leave = $db->selectQuery("SELECT * FROM `sm_salary_deduction` WHERE employee_id='$emp_id'");
                                                $per_day = $basic_salary / 30;
                                                $leave_deduction = round($leave_days * $per_day);
                                                $valuesdeduction = array();

                                                $valuesdeduction['employee_id'] = $emp_id;
                                                $valuesdeduction['deduction_date'] = date("Y/m/d");
                                                $valuesdeduction['deduction_amount'] = $leave_deduction;
                                                $valuesdeduction['deduction_category_id'] = '2';
                                                if (empty($deduction_list_leave)) {
                                                    $leave_deduction_update = $db->secure_insert("sm_salary_deduction", $valuesdeduction);
                                                } else {
                                                    $leave_deduction_update = $db->secure_update("sm_salary_deduction", $valuesdeduction, "WHERE employee_id='$emp_id' AND deduction_category_id='2'");
                                                }


                                                $check_exist = $db->selectQuery("SELECT * FROM `sm_sif_basic` WHERE `employee_id`='$emp_id' AND MONTH(sif_date)='$thisMonth'");
                                                if (count($check_exist)) {
                                                    $values = array();
                                                    //$values['sif_payment_type'] = $payment_type;
                                                    //$values['sif_notes_comments'] = $notes_comments;
                                                    if ($total_working_days == 0) {
                                                        $notes_comments = "Vacation";
                                                        $values['sif_notes_comments'] = $notes_comments;
                                                        $net_salary = 0;
                                                    }
                                                    $values['sif_date'] = date("Y-m-d");
                                                    $update = $db->secure_update("sm_sif_basic", $values, "WHERE `employee_id`='$emp_id'");
                                                } else {
                                                    $values = array();
                                                    //$values['sif_payment_type'] = $payment_type;
                                                    if ($total_working_days == 0) {
                                                        $notes_comments = "Vacation";
                                                        $values['sif_notes_comments'] = $notes_comments;
                                                        $net_salary = 0;
                                                    }
                                                    $values['sif_date'] = date("Y-m-d");
                                                    $values['employee_id'] = $emp_id;
                                                    $insert = $db->secure_insert("sm_sif_basic", $values);
                                                }
                                                $select_basics = $db->selectQuery("SELECT * FROM `sm_sif_basic` WHERE `employee_id`='$emp_id' AND MONTH(sif_date)='$thisMonth'");
                                                if (count($select_basics)) {
                                                    $payment_type = $select_basics[0]['sif_payment_type'];
                                                    $notes_comments = $select_basics[0]['sif_notes_comments'];
                                                }
                                                ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $qatar_id; ?></td>
                                                    <td><?php echo htmlspecialchars_decode($resFet[$rC]['employee_name']); ?></td>
                                                    <td><?php echo $total_working_days; ?></td>
                                                    <td class="net_salary"><?php echo $net_salary; ?></td>
                                                    <td class="basic_salary"><?php echo $basic_salary; ?></td>
                                                    <td><?php echo $extra_hours; ?></td>
                                                    <td><?php echo round($total_extra_working_income); ?></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-success" onclick="function_emp(this)" data-toggle="modal" data-target="#approved_splash" data-options="splash-ef-3"><?php echo $display_deduction; ?></button>
                                                        <input type="hidden" class="employee_id" value="<?php echo $emp_id; ?>" />
                                                    </td>
                                                    <td contenteditable="true" class="payment_type" onblur="payment_type(this)" ><?php echo $payment_type; ?></td>
                                                    <td contenteditable="true" class="notes_comments" onblur="notes_comments(this)" ><?php echo $notes_comments; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
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
</div>
<div class="modal splash fade" id="approved_splash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" id="step1">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title custom-font">Add Deduction Fee</h3>
                </div>
                <input type="hidden" id="hid_del" value=""/>



                <input type="hidden" value="" id="employ_id" name="employ_id">


                <div class="modal-body">


                </div>
                <div class="modal-footer">
                    <button class="btn btn-default btn-border" type="button" id="sub_btn">Add</button>

                    <button class="btn btn-default btn-border" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>

    </form>
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

<script src="assets/js/jquerysession.js"></script>
<script src="assets/js/main.js"></script>
<script>
                                                $(window).load(function () {
                                                    var oTable = $('#editable-usage').DataTable({
                                                        "aoColumnDefs": [
                                                            {'bSortable': false, 'aTargets': ["no-sort"]}
                                                        ]
                                                    });
                                                });
</script>
<!--/ Page Specific Scripts -->

<script type="text/javascript">
    function delete_id(id)
    {
        $.session.set('delete_seesion', id);
        $('#hid_del').val($.session.get('delete_seesion'));
        // alert($.session.get('delete_seesion'));
    }
    function payment_type(ele) {
        var pt = $(ele).html();
        var emp_id = $(ele).siblings('td').find('.employee_id').val();
        $.ajax({
            url: "salary_update_ajax.php",
            type: "POST",
            data: {payment_type: pt, emp_id: emp_id},
            success: function () {}
        });
    }
    function notes_comments(ele) {
        var nc = $(ele).html();
        var emp_id = $(ele).siblings('td').find('.employee_id').val();
        $.ajax({
            url: "salary_update_ajax.php",
            type: "POST",
            data: {notes_comments: nc, emp_id: emp_id},
            success: function () {}
        });
    }

    function function_emp(elem) {
        var emp_id = $(elem).siblings("input").val();
        $("#employ_id").val(emp_id);
        $.ajax({
            url: "salary_update_ajax.php",
            type: "POST",
            data: {emp_id: emp_id, popup: "popup"},
            success: function (data) {
                $('.modal-body').html(data);
            }
        });
    }

    $('#sub_btn').click(function () {
        var fdata = $('#step1').serialize();
        $.ajax({
            url: "salary_update_add_ajax.php",
            type: "POST",
            data: fdata,
            success: function (data) {
                window.location = "salary_update.php";
            }

        });

    });

</script>
<script>
    $('#company').change(function () {
        var company = $(this).val();
        location.href = 'salary_hr_update.php?company=' + company;

    });
</script>
<script>
    $('#salary_list').click(function () {
        var cid = '<?php echo $company_id; ?>';
        location.href = 'salary_hr_final_list.php?cid=' + cid;
    });
</script>


</body>

</html>

