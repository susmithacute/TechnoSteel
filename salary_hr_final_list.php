<?php

$page = "employee";

$tab = "employee_salary";

$sub = "salary_final";

$sub1 = "";

include("file_parts/header.php");

$company_id = $company_account_no = $bank_code_com = $company_iban_no = "";

if (isset($_REQUEST["cid"])) {

    $company_id = $_REQUEST["cid"];

}

date_default_timezone_set('Asia/Qatar');

$advArray = array();

$resFet = $db->selectQuery("SELECT CONCAT(employee_firstname,' ',employee_middlename,' ',employee_lastname) as employee_name, employee_salary,employee_id FROM sm_employee "

        . " WHERE employee_status='1' AND employee_company='$company_id'");

$thisMonth = date("m");

$thisYear = date("Y");

$lastMonth1 = date('Y-m-d', strtotime('first day of last month'));

$lastMonth = date('m', strtotime(date($lastMonth) . " -1 month"));

$select_comp_bank_data = $db->selectQuery("SELECT sm_company_bank_details.company_account_no,sm_bank_details.bank_code,sm_company_bank_details.company_iban_no FROM sm_company_bank_details INNER JOIN sm_bank_details ON sm_company_bank_details.bank_id=sm_company_bank_details.bank_id LEFT JOIN sm_company ON sm_company.company_id=sm_company_bank_details.bank_id WHERE sm_company.company_id='$company_id'");

if (count($select_comp_bank_data)) {

    $company_account_no = $select_comp_bank_data[0]['company_account_no'];

    $bank_code_com = $select_comp_bank_data[0]['bank_code'];

    $company_iban_no = $select_comp_bank_data[0]['company_iban_no'];

}

$select_cr = $db->selectQuery("SELECT `doc_data` FROM `sm_company_docs` WHERE `doc_title`='Commercial Registration' AND `company_id`='$company_id' AND `doc_status`='1' ");

if (count($select_cr)) {

    $company_cr = $select_cr[0]['doc_data'];

    $payer_eid = str_pad($company_cr, 8, "0", STR_PAD_LEFT);

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

                            <h1 class="custom-font"><strong>Editable</strong> Usage</h1>

                            <ul class="controls">

                                <li>

                                    <a role="button" tabindex="0" id="add-entry"><i class="fa fa-plus mr-5"></i> Add Entry</a>

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

                                <table class="table table-custom" id="editable-usage">

                                    <thead>

                                        

                                        <tr>

                                            <th style="width:90px;">Employer ID</th>

                                            <th style="width:90px;">File Creation Date</th>

                                            <th style="width:90px;">File Creation Time</th>

                                            <th style="width:90px;">Payer EID</th>

                                            <th style="width:90px;">Payer QID</th>

                                            <th style="width:90px;">Payer Bank Short Name</th>

                                            <th style="width:10px;">Payer IBAN</th>

                                            <th style="width:10px;">Salary Year and Month</th>

                                            <th style="width:10px;">Total Salaries</th>

                                            <th style="width:10px;">Total Records</th>

                                            <th></th>

                                            <th></th>

                                            <th></th>

                                            <th></th>

                                            <th></th>

                                        </tr>

                                        <tr>

                                            <td id="employer_eid"><?php echo $payer_eid; ?></td>

                                            <td id="file_creation_date"><?php echo date("Ymd"); ?></td>

                                            <td id="file_creation_time"><?php echo date("hi"); ?></td>

                                            <td id="payer_eid"><?php echo $payer_eid; ?></td>

                                            <td></td>

                                            <td id="payer_bank"><?php $bank_code_com; ?></td>

                                            <td><?php echo $company_iban_no; ?></td>

                                            <td><?php echo date("Ym"); ?></td>

                                            <td id="total_salary"></td>

                                            <td id="total_records"><?php echo count($resFet); ?></td>

                                            <td></td>

                                            <td></td>

                                            <td></td>

                                            <td></td>

                                            <td></td>

                                        </tr>

                                        <tr>

                                            <th style="width:90px;">Record Sequence</th>

                                            <th style="width:90px;">Employee QID</th>

                                            <th style="width:90px;">Employee Visa ID</th>

                                            <th style="width:90px;">Employee Name</th>

                                            <th style="width:90px;">Employee Bank Short Name</th>

                                            <th style="width:90px;">Employee Account</th>

                                            <th style="width:90px;">Salary Frequency</th>

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

                                        if (count($resFet)) {

                                            $qatar_id = "";

                                            for ($rC = 0; $rC < count($resFet); $rC++) {

                                                $emp_id = $resFet[$rC]['employee_id'];

                                                $qatar = $db->selectQuery("SELECT `document_data` FROM `sm_employee_documents` WHERE `document_title`='Qatar ID' AND `status`='1' AND `employee_id`='$emp_id'");

                                                if (count($qatar)) {

                                                    $qatar_id = $qatar[0]['document_data'];

                                                }
                                                else{
                                                     $qatar_id ="";
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

                                                $select_basics = $db->selectQuery("SELECT * FROM `sm_sif_basic` WHERE `employee_id`='$emp_id' AND MONTH(sif_date)='$thisMonth'");

                                                if (count($select_basics)) {

                                                    $payment_type = $select_basics[0]['sif_payment_type'];

                                                    $notes_comments = $select_basics[0]['sif_notes_comments'];

                                                }

                                                $select_visa = $db->selectQuery("SELECT `document_data` FROM `sm_employee_documents` WHERE `employee_id`='$emp_id' AND `document_title`='Visa'");

                                                if (count($select_visa)) {

                                                    $visa_id = $select_visa[0]['document_data'];

                                                }
                                                else{
                                                     $visa_id ="";
                                                }

                                                $select_bank_data = $db->selectQuery("SELECT sm_employee_bank_details.employee_account_no,sm_bank_details.bank_code FROM sm_employee_bank_details INNER JOIN sm_bank_details ON sm_employee_bank_details.bank_id=sm_employee_bank_details.bank_id LEFT JOIN sm_employee ON sm_employee.employee_id=sm_employee_bank_details.bank_id WHERE sm_employee.employee_id='$emp_id'");

                                                if (count($select_bank_data)) {

                                                    $employee_account_no = $select_bank_data[0]['employee_account_no'];

                                                    $bank_code = $select_bank_data[0]['bank_code'];

                                                }

                                                ?>

                                                <tr class="odd gradeX">

                                                    <td><?php echo $fc = $rC + 1; ?></td>

                                                    <td><?php echo $qatar_id; ?></td>

                                                    <td><?php echo $visa_id; ?></td>

                                                    <td><?php echo htmlspecialchars_decode($resFet[$rC]['employee_name']); ?></td>

                                                    <td><?php echo $bank_code; ?></td>

                                                    <td><?php echo $employee_account_no; ?></td>

                                                    <td>M</td>

                                                    <td><?php echo $total_working_days; ?></td>

                                                    <td class="net_salary"><?php echo $net_salary; ?></td>

                                                    <td class="basic_salary"><?php echo $basic_salary; ?></td>

                                                    <td><?php echo $extra_hours; ?></td>

                                                    <td><?php echo round($total_extra_working_income); ?></td>

                                                    <td><?php echo $display_deduction; ?></td>

                                                    <td class="payment_type" ><?php echo $payment_type; ?></td>

                                                    <td class="notes_comments" ><?php echo $notes_comments; ?></td>

                                                </tr>

                                                <?php

                                            }

                                        }

                                        ?>

                                    </tbody>

                                    <tfoot>





                                    </tfoot>

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

        var name_title = "SIF_" + $('#employer_eid').html() + "_" + $('#payer_bank').html() + "_" + $('#file_creation_date').html() + "_" + $('#file_creation_time').html();

        var oTable = $('#editable-usage').DataTable({

            "dom": 'Bf t<"row"<"col-md-4 col-sm-12"<"inline-controls no-print"l>><"col-md-4 col-sm-12"<"inline-controls text-center no-print"i>><"col-md-4 col-sm-12 no-print"p>>',

            "buttons": [

            ],

            //"order": [[0, "desc"]],

            "aoColumnDefs": [

                {'bSortable': true, 'aTargets': ["no-sort"]}

            ],

            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

            "footerCallback": function (row, data, start, end, display) {

                var api = this.api(), data;

                var intVal = function (i) {

                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;

                };

                var total_salary = api.column(8, {page: 'current'}).data().reduce(function (a, b) {

                    return intVal(a) + intVal(b);

                }, 0);

                total_salary = parseFloat(total_salary);

                $('#total_salary').html(total_salary.toFixed());

            }

        });

    });</script>

<!--/ Page Specific Scripts -->



<script type="text/javascript">


</script>

</body>



</html>



