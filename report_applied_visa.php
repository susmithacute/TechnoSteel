<?php
$page = "visa";
$tab = "visa_report";
$sub = "visa_apply_list";

include('file_parts/header.php');

$visaArray = array();

$resFet = $db->selectQuery("SELECT sm_visa.visa_id,sm_visa.visa_ref_no,sm_visa.visa_applicant_name,sm_visa_client.visa_client_name,
sm_visa_renew.visa_renewal_type	,sm_visa_category.visa_category,sm_visa_type.visa_type_name,sm_visa.visa_status,sm_visa.visa_sponsor,sm_visa.visa_entry_date,sm_visa.visa_expiry_date
FROM sm_visa
INNER JOIN sm_visa_renew ON sm_visa.visa_id=sm_visa_renew.visa_id
INNER JOIN sm_visa_type ON
sm_visa_type.visa_type_id=sm_visa.visa_type
INNER JOIN sm_visa_category ON sm_visa_renew.visa_renewal_type=sm_visa_category.visa_category_id
INNER JOIN sm_visa_client ON sm_visa_client.visa_client_name=sm_visa_client.visa_client_name
WHERE sm_visa.visa_active='1'
AND sm_visa_renew.renew_id
 IN ( SELECT MAX(sm_visa_renew.renew_id)
FROM sm_visa_renew GROUP BY sm_visa_renew.visa_id )");

if (count($resFet)) {
    $entry_date = "";
    for ($rC = 0; $rC < count($resFet); $rC++) {
        if (!empty($resFet[$rC]['visa_entry_date'])) {
            $entry_date1 = explode('-', $resFet[$rC]['visa_entry_date']);
            $entry_date = $entry_date1[2] . "/" . $entry_date1[1] . "/" . $entry_date1[0];
        }
        if (!empty($resFet[$rC]['visa_expiry_date'])) {
            $expry_date1 = explode("-", $resFet[$rC]['visa_expiry_date']);
            $expry_date = $expry_date1[2] . "/" . $expry_date1[1] . "/" . $expry_date1[0];
        }
        $values['visa_id'] = $resFet[$rC]['visa_id'];
        $values['visa_ref_no'] = $resFet[$rC]['visa_ref_no'];
        $values['visa_applicant_name'] = $resFet[$rC]['visa_applicant_name'];
        $values['visa_client_name'] = $resFet[$rC]['visa_client_name'];
        $values['visa_category'] = $resFet[$rC]['visa_category'];
        $values['visa_sponsor'] = $resFet[$rC]['visa_sponsor'];
        $values['visa_entry_date'] = $entry_date;
        $values['visa_expiry_date'] = $expry_date;
        $values['visa_type'] = $resFet[$rC]['visa_type_name'];
        $values['visa_status'] = $resFet[$rC]['visa_status'];

        $visaArray["data"][] = $values;
    }
}

/* while ($row = mysql_fetch_assoc($resCom)) {

  $cmpArray["data"][] = $row;

  } */

$fp = fopen('assets/extras/visa.json', 'w');

fwrite($fp, json_encode($visaArray));

fclose($fp);
?>
<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<section id="content">

    <div class="page page-shop-products">

        <div class="pageheader">

            <h2>Visa -Applied List<span></span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-home"></i> SME</a>
                    </li>
                    <li>
                        <a>Reports</a>
                    </li>
                    <li>
                        <a>Visa -Applied List</a>
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
                            <h1 class="custom-font"><strong>Visa </strong>- Applied List</h1>
                            <ul class="controls">

                                <li class="dropdown">

                                    <a role="button" tabindex="0" class="dropdown-toggle settings" data-toggle="dropdown">
                                        <i class="fa fa-cog"></i>
                                        <i class="fa fa-spinner fa-spin"></i>
                                    </a>


                                </li>
                                <li class="remove"><a role="button" tabindex="0" class="tile-close"><i class="fa fa-times"></i></a></li>
                            </ul>
                        </div>
                        <!-- /tile header -->

                        <!-- tile body -->
                        <div class="tile-body">

                            <div class="table-responsive">
                                <div id="printableArea">
                                    <div class="divHeader"><strong style="font-size: 30px">Visa -Applied List</strong></div>
                                    <table class="table table-striped table-hover table-custom" id="products-list">
                                        <thead>
                                            <tr>




                                                <th>Applicant Name</th>
                                                <th>Client Name</th>
                                                <th>Reference No.</th>
                                                <th>Sponsor</th>
                                                <th>Type Of Visa</th>
                                                <th>Category</th>
                                                <th>Entry Date</th>
                                                <th>Expiry Date</th>
                                                <th>Status</th>

<!--<th style="width:150px;" class="no-sort">Actions</th>-->
                                            </tr>
                                        </thead>

                                    </table>

                                </div>
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





<style type="text/css">
    @media screen {
        div.divHeader {
            display: none;
        }
    }
    @media print {
        div.divHeader {
            position: fixed;
            bottom: 0;
        }
    }
</style>








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
        $('#products-list').DataTable({
            "dom": 'Bf t<"row"<"col-md-4 col-sm-12"<"inline-controls no-print"l>><"col-md-4 col-sm-12"<"inline-controls text-center no-print"i>><"col-md-4 col-sm-12 no-print"p>>',
            "buttons": [
                {
                    extend: 'excelHtml5',
                    title: 'Visa Applied '
                },
                {
                    extend: 'pdfHtml5',
                    title: 'Visa Applied '
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
            "ajax": 'assets/extras/visa.json',
            "order": [[0, "asc"]],
            "columns": [
                {"data": "visa_applicant_name"},
                {"data": "visa_client_name"},
                {"data": "visa_ref_no"},
                {"data": "visa_sponsor"},
                {"data": "visa_type"},
                {"data": "visa_category"},
                {"data": "visa_entry_date"},
                {"data": "visa_expiry_date"},
                {
                    "type": "html",
                    "data": "visa_status",
                    "render": function (data) {

                        return '<span class="label bg-success">' + data + '</span>';

                    }
                }

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
                $('.inline-controls').has("#products-list_length").children('label').addClass("no-print");
            }
        });

        //*initialize datatable
    });
</script>
<!--/ Page Specific Scripts -->

<script>

</script>

<script type="text/javascript" src="assets/js/jquery.techbytarun.excelexportjs.js"></script>
<script type="text/javascript" src="assets/js/jquery.techbytarun.excelexportjs.min.js"></script>

<script>
    function printDiv(divName) {
        var headstr = "<!doctype html><head><title>Visa List</title></head><body>";
        var footstr = "</body></html>";
        var printContents = document.getElementById(divName).innerHTML;
        //ar originalContents = document.body.innerHTML;
        document.body.innerHTML = headstr + printContents + footstr;
        window.print();
        location.href = "report_applied_visa.php";
        //document.body.innerHTML = originalContents;
    }
    $("#btnExport").click(function () {
        $("#products-list").excelexportjs({
            containerid: "products-list"
            , datatype: 'table'
        });
    });

</script>



<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    (function (b, o, i, l, e, r) {
        b.GoogleAnalyticsObject = l;
        b[l] || (b[l] =
                function () {
                    (b[l].q = b[l].q || []).push(arguments)
                });
        b[l].l = +new Date;
        e = o.createElement(i);
        r = o.getElementsByTagName(i)[0];
        e.src = '../../www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e, r)
    }(window, document, 'script', 'ga'));
    ga('create', 'UA-XXXXX-X', 'auto');
    ga('send', 'pageview');
</script>

</body>

</html>
