<?php
$page = "visa";

$tab = "process_visa";

$sub = "visa_tr_list";

$head = $head1 = $sub1 = "";

include('file_parts/header.php');

$cmpArray = array();
$today = date('Y-m-d');
$nothing = "";
$resFet = $db->selectQuery("SELECT sm_visa.visa_applicant_name,sm_visa.visa_type,sm_visa.visa_expiry_date,sm_visa.visa_entry_date,sm_visa_renew.renew_id,sm_visa_renew.visa_id,sm_visa.visa_renewal_date1,sm_visa.visa_number,sm_visa.visa_entry_date, sm_visa.visa_client_name, sm_visa_renew.visa_renewal_type FROM sm_visa INNER JOIN sm_visa_renew ON sm_visa.visa_id=sm_visa_renew.visa_id WHERE sm_visa_renew.renew_id IN ( SELECT MAX(sm_visa_renew.renew_id) FROM sm_visa_renew GROUP BY sm_visa_renew.visa_id)");
if (count($resFet)) {
    $fees = "";
    for ($rC = 0; $rC < count($resFet); $rC++) {
        $type = $resFet[$rC]['visa_type'];
        $values['visa_applicant_name'] = $resFet[$rC]['visa_applicant_name'];
        $values['visa_client_name'] = $resFet[$rC]['visa_client_name'];
        $values['visa_number'] = $resFet[$rC]['visa_number'];
        $values['visa_type'] = $resFet[$rC]['visa_renewal_type'];
        $values['visa_category'] = $resFet[$rC]['visa_client_name'];
        $values['visa_entry_date'] = $resFet[$rC]['visa_entry_date'];
        $expiry_date = explode("-", $resFet[$rC]['visa_expiry_date']);
        $exp = $expiry_date[2] . "" . $expiry_date[1] . "" . $expiry_date[0];
        $values['visa_exp'] = $exp;

        $cmpArray["data"][] = $values;
    }
}

$fp = fopen('assets/extras/visa_travelled.json', 'w');

fwrite($fp, json_encode($cmpArray));

fclose($fp);
?>

<!-- ====================================================

================= CONTENT ===============================

===================================================== -->

<section id="content">



    <div class="page page-shop-products">



        <div class="pageheader">



            <h2>Company List <span>Your Companies</span></h2>



            <div class="page-bar">



                <ul class="page-breadcrumb">

                    <li>

                        <a><i class="fa fa-home"></i> SME</a>

                    </li>

                    <li>

                        <a href="#">Company</a>

                    </li>

                    <li>

                        <a href="companylist.php">Company List</a>

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

                            <h1 class="custom-font"><strong>Company</strong> List</h1>

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

                                            <th style="width:90px;">Company ID</th>

                                            <th>Company Name</th>

                                            <th>Address</th>

                                            <th style="width:80px;">E-Mail</th>

                                            <!--<th style="width:160px;">CR Expiry</th>-->

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
            "ajax": 'assets/extras/company.json',
            "order": [[1, "desc"]],
            "columns": [
                {"data": null},
                {"data": "company_pid"},
                {
                    "type": "html",
                    "data": "company_name",
                    "render": function (data, type, full, meta) {

                        return '<a href="company_read.php?company_id=' + full.company_id + '" class=""><i class=""></i> ' + data + '</a>';

                    }},
                {"data": "company_address1"},
                {"data": "company_email"},
                {
                    "type": "html",
                    "data": "company_id",
                    "render": function (data, type, full, meta) {

                        // return '<a href="company_profile.php?id=' + data + '" class="btn btn-xs btn-default mr-5"><i class="fa fa-pencil"></i> Edit</a><a href="del_company.php?id=' + data + '" class="btn btn-xs btn-lightred"><i class="fa fa-times"></i> Delete</a>';

                        return '<a href="company_edit.php?company_id=' + data + '" class="btn btn-xs btn-default mr-5"><i class="fa fa-pencil"></i> Edit</a><a onclick="delete_id(' + data + ',' + full.emp_count + ')" class="btn btn-xs btn-lightred" data-toggle="modal" data-target="#splash" data-options="splash-ef-3"><i class="fa fa-times"></i> Delete</a>';



                    }}

            ],
            "aoColumnDefs": [
                {'bSortable': true, 'aTargets': 0}

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

        t.on('order.dt search.dt', function () {

            t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {

                cell.innerHTML = i + 1;

            });

        }).draw();        //*initialize datatable

    });

</script>

<!--/ Page Specific Scripts -->



<script type="text/javascript">

    function delete_id(id, emp_count)
    {
        $('#hid_del').val(id);
        $('#emp_count').html(emp_count);
    }

    $('#sub_btn').click(function () {

        var pass_val = $('#hid_del').val();

        $.ajax({
            url: "delete_com.php",
            type: "POST",
            data: {pass_val: pass_val},
            success: function (data) {

                window.location = "companylist.php";

            }

        });

    });</script>



</body>



</html>

