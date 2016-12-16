<?php
$page = "work_report";
include('header.php');
// $attnd_id = $emp_id;
$rep_year = $_REQUEST["year"];
$rep_month = $_REQUEST["month"];
if (isset($_REQUEST['year'])) {
    $attndArray = array();
    $resFet = $db->selectQuery("SELECT "
            . "CONCAT( sm_employee.employee_firstname,  ' ', sm_employee.employee_middlename,  ' ', sm_employee.employee_lastname ) AS full_name, "
            . "sm_employee_work_report.report_id "
            . "FROM sm_employee "
            . "INNER JOIN sm_employee_work_report "
            . "ON sm_employee.employee_id=sm_employee_work_report.employee_id "
            . "WHERE MONTH(sm_employee_work_report.report_date)='$rep_month' "
            . "AND YEAR(sm_employee_work_report.report_date)='$rep_year' "
            . "AND sm_employee_work_report.employee_id='$emp_id'");

    if (count($resFet)) {

        for ($rC = 0; $rC < count($resFet); $rC++) {

            $values['employee_id'] = $resFet[$rC]['employee_id'];
            //$values['full_name'] = $resFet[$rC]['full_name'];

            $datee = new DateTime($resFet[$rC]['attendance_date']);
            $values['attendance_date'] = $datee->format("d/m/Y");
            $values['report_id'] = $resFet[$rC]['report_id'];
            $attndArray["data"][] = $values;
        }
    }
    $fp = fopen('../assets/extras/work_report_emp.json', 'w');
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



            <h2>Work Report <span></span></h2>



            <div class="page-bar">



                <ul class="page-breadcrumb">

                    <li>

                        <a><i class="fa fa-home"></i> SME</a>

                    </li>
                    <li>

                        <a href="#">Work Report</a>

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

                            <h1 class="custom-font"><strong>Work</strong> Report</h1>

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
                                    <div class="form-group col-md-4">
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
                                    <div class="form-group col-md-4">

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

                                    <div class="form-group col-md-4">
                                        <button id="attnd_button" name="submit" class="btn btn-success" type="button" style="margin-top:25px">Submit</button>
                                    </div>
                                </div>

                            </div>
                            <?php
                            if (isset($_REQUEST["year"])) {
                                ?>
                                <!--<label for="em_desig">Designation: </label>
                                       <input type="text" readonly value="<?php //echo @$values['employee_designation'];                                                       ?>"name="emp_desig">
                                        <label for="em_name">Employee: </label>
                                       <input type="text"  readonly value="<?php //echo @$values['full_name'];                                                        ?>"name="emp_name">
                                        <label for="em_id">Employee ID: </label>
                                       <input type="text"  readonly value="<?php //echo @$values['employee_id'];                                                        ?>"name="emp_id">
                                       <br><br>-->
                                <div class="table-responsive">


                                    <table class="table table-striped table-hover table-custom" id="products-list">

                                        <thead>

                                            <tr>

                                                <th>Sl.no</th>
                                                <th >Date</th>
                                                <th>Action</th>

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

<!--/ CONTENT -->

</div>

<?php include './footer.php'; ?>
<!--/ Page Specific Scripts -->
<script>
    $("#attnd_button").click(function () {
        var employee_name = '<?php echo $emp_id; ?>';
        var year = jQuery('#attnd_year').val();
        var month = jQuery('#attnd_month').val();
        location.href = 'work_report.php?year=' + year + '&month=' + month;
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
            "ajax": '../assets/extras/work_report_emp.json',
            "order": [[1, "desc"]],
            "columns": [
                {"data": null},
                {"data": "attendance_date"},
                {
                    "type": "html",
                    "data": "report_id",
                    "render": function (data, type, full, meta) {
                        return '<a href="work_report_view.php?rid=' + data + '" class=""><i class=""></i> View Report</a>';
                    }}
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
</body>
</html>


