<?php
$page = "visa";
$tab = "payment_data";
$sub = "visa_pay_list";
$head = $head1 = $sub1 = "";
include('file_parts/header.php');
$cmpArray = array();
$resFet = $db->selectQuery("SELECT sm_visa.visa_applicant_name,sm_visa_renew.renew_id,
sm_visa_renew.visa_id,sm_visa.visa_client_name,sm_visa.visa_sponsor,
sm_visa_renew.visa_renewal_type, sm_visa_renew.visa_renewal_amount,
sm_visa_renew.visa_renewal_type,sm_visa.visa_type, sm_visa_renew.visa_bank_fee,
 sm_visa_renew.visa_sponsor_fee, sm_visa_renew.visa_company_fee,
sm_visa_renew.visa_total_fee, sm_visa_renew.visa_balance_fee,
sm_visa_renew.visa_advance_fee,sm_visa_type.visa_type_name FROM sm_visa_renew
INNER JOIN sm_visa ON sm_visa_renew.visa_id=sm_visa.visa_id INNER JOIN sm_visa_type ON sm_visa_type.visa_type_id=sm_visa.visa_type WHERE sm_visa.visa_active=1");
if (count($resFet)) {
    for ($rC = 0; $rC < count($resFet); $rC++) {
        $values['visa_applicant_name'] = $resFet[$rC]['visa_applicant_name'];
        $values['visa_id'] = $resFet[$rC]['visa_id'];
        $values['visa_category'] = $resFet[$rC]['visa_renewal_type'];
        $values['visa_type'] = $resFet[$rC]['visa_type_name'];
        $values['visa_client_name'] = $resFet[$rC]['visa_client_name'];
        $values['visa_advance_amount'] = $resFet[$rC]['visa_advance_fee'];
        $values['visa_sponsor'] = $resFet[$rC]['visa_sponsor'];
        $values['visa_bank_fee'] = $resFet[$rC]['visa_bank_fee'];
        $values['visa_company_fee'] = $resFet[$rC]['visa_company_fee'];
        $values['visa_sponsor_fee'] = $resFet[$rC]['visa_sponsor_fee'];
        $values['visa_total_amount'] = $resFet[$rC]['visa_total_fee'];
        $values['visa_amount_balance'] = $resFet[$rC]['visa_balance_fee'];
        $cmpArray["data"][] = $values;
    }
}
$fp = fopen('assets/extras/visa_payment.json', 'w');
fwrite($fp, json_encode($cmpArray));
fclose($fp);
?>
<!-- ====================================================

================= CONTENT ===============================

===================================================== -->

<section id="content">

    <div class="page page-shop-products">
        <div class="pageheader">
            <h2>Visa Payment <span>List</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a><i class="fa fa-home"></i> SME</a>
                    </li>
                    <li>
                        <a href="#">Visa</a>
                    </li>
                    <li>
                        <a href="#">Payment Details</a>
                    </li>
                    <li>
                        <a href="#"></a>
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

                            <h1 class="custom-font"><strong>Visa Payment</strong> List</h1>

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

                                <table class="table table-striped table-hover table-custom" id="payment_list">

                                    <thead>
                                        <tr>
                                            <th style="width:80px;">Applicant</th>
                                            <th style="width:80px;">Type of Visa</th>
                                            <th style="width:80px;">Category</th>
                                            <th style="width:80px;">Client</th>
                                            <th style="width:80px;">Sponsor of visa</th>
                                            <th style="width:80px;">Total payment</th>
                                            <th style="width:80px;">Bank</th>
                                            <th style="width:80px;">Sponsor fee</th>
                                            <th style="width:80px;">Company</th>
                                            <th style="width:80px;">Advance</th>
                                            <th style="width:80px;">Balance</th>
                                        </tr>

                                    </thead>
                                    <tfoot>
                                        <tr>

                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th id="total_payment"></th>
                                            <th id="bank"></th>
                                            <th id="sponsor_fee">Sponsor fee</th>
                                            <th id="company">Company</th>
                                            <th id="advance">Advance</th>
                                            <th id="balance">Balance</th>
                                        </tr>
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

        var t = $('#payment_list').DataTable({
            "dom": 'Bf t<"row"<"col-md-4 col-sm-12"<"inline-controls no-print"l>><"col-md-4 col-sm-12"<"inline-controls text-center no-print"i>><"col-md-4 col-sm-12 no-print"p>>',
            "buttons": [
                {
                    extend: 'excelHtml5',
                    title: 'Payment List',
                    footer: true
                },
                {
                    extend: 'pdfHtml5',
                    title: 'Payment List',
                    footer: true
                }
                , {extend: 'print',
                    title: 'Payment List',
                    footer: true
                }
            ], "language": {
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
            "ajax": 'assets/extras/visa_payment.json',
            "order": [[1, "desc"]],
            "columns": [
                {"data": "visa_applicant_name"},
                {"data": "visa_type"},
                {"data": "visa_category"},
                {"data": "visa_client_name"},
                {"data": "visa_sponsor"},
                {"data": "visa_total_amount"},
                {"data": "visa_bank_fee"},
                {"data": "visa_sponsor_fee"},
                {"data": "visa_company_fee"},
                {"data": "visa_advance_amount"},
                {
                    "type": "html",
                    "data": "visa_total_amount",
                    "render": function (data, type, full, meta) {
                        var balance = full.visa_total_amount - full.visa_advance_amount;
                        return balance;

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

                $('#select-all').change(function () {

                    if ($(this).is(":checked")) {

                        $('#payment_list tbody .selectMe').prop('checked', true);

                    } else {

                        $('#payment_list tbody .selectMe').prop('checked', false);

                    }

                });

            },
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api(), data;
                var intVal = function (i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };

                // total_payment over all pages
//                total_payment = api.column(4).data().reduce(function (a, b) {
//                    return intVal(a) + intVal(b);
//                }, 0);


                total_payment = api.column(4, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                total_bank = api.column(5, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                total_sponsor_fee = api.column(6, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                total_company = api.column(7, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                total_advance = api.column(8, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                total_balance = api.column(9, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                total_payment = parseFloat(total_payment);
                total_bank = parseFloat(total_bank);
                total_sponsor_fee = parseFloat(total_sponsor_fee);
                total_company = parseFloat(total_company);
                total_advance = parseFloat(total_advance);
                total_balance = parseFloat(total_balance);

                $('#total_payment').html(total_payment.toFixed(2));
                $('#bank').html(total_bank.toFixed(2));
                $('#sponsor_fee').html(total_sponsor_fee.toFixed(2));
                $('#company').html(total_company.toFixed(2));
                $('#advance').html(total_advance.toFixed(2));
                $('#balance').html(total_balance.toFixed(2));
            }

        });
    });

</script>

<!--/ Page Specific Scripts -->

</body>



</html>

