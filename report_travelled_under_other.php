<?php
$page = "recruitment";
$tab = "CandidateTravel";
$tab1= "CandidateTravelled";
$sub="reports";
$sub1="Travelled_Candidate_Under_otherVisa";
include('file_parts/header.php');

$empArray = array();
//$resFet = $db->selectQuery("SELECT CONCAT( sm_employee.employee_firstname,  ' ', sm_employee.employee_middlename,  ' ', sm_employee.employee_lastname ) AS full_name, sm_employee.employee_designation, sm_employee.employee_employment_id, sm_employee.employee_company, sm_employee.employee_id, sm_employee.employee_email, sm_company.company_name
//FROM sm_employee
//INNER JOIN sm_company ON sm_employee.employee_company = sm_company.company_id
//WHERE sm_employee.sponsor_id ='" . $_SESSION['id'] . "'
//AND sm_employee.employee_status =1");


//select * from dbo.Students S INNER JOIN dbo.Advisors A ON S.Advisor_ID=A.Advisor_ID
$resFet=$db->selectQuery("SELECT DISTINCT CONCAT( sm_candidate.candidate_firstname,  ' ', sm_candidate.candidate_middlename,  ' ', sm_candidate.candidate_lastname ) AS full_name, sm_candidate.candidate_code,  sm_candidate.candidate_id,sm_candidate_visa_process. visa_type
FROM sm_candidate
LEFT JOIN sm_candidate_visa_process ON sm_candidate.candidate_id = sm_candidate_visa_process.candidate_id
WHERE   sm_candidate_visa_process.visa_type!='4' ");

//$resFet=$db->selectQuery("SELECT CONCAT( employee_firstname,  ' ', employee_middlename,  ' ', employee_lastname ) AS full_name,employee_designation, employee_id,employee_employment_id,employee_email FROM `sm_employee` WHERE `employee_visatype`!='Residential Visa'AND employee_status =1");
if (count($resFet)) {
    for ($rC = 0; $rC < count($resFet); $rC++) {
		$values['no']=$rC+1;
        $values['candidate_id'] = $resFet[$rC]['candidate_id'];
        $values['full_name'] = $resFet[$rC]['full_name'];
        //$values['employee_designation'] = $resFet[$rC]['employee_designation'];
        
        $values['candidate_code'] = $resFet[$rC]['candidate_code'];
		$visa_type_id= $resFet[$rC]['visa_type'];
		$visa_type_select = $db->selectQuery("SELECT `visa_type_name` FROM sm_visa_type WHERE `visa_type_id`='$visa_type_id'");
		$values['visa_type'] = $visa_type_select[0]['visa_type_name'];
        //$values['visa_type'] = $resFet[$rC]['visa_type'];
        //$values['company_status'] = $resFet[$rC]['company_status'];
        $empArray["data"][] = $values;
    }
}
/* while ($row = mysql_fetch_assoc($resEmp)) {
  $empArray["data"][] = $row;
  } */
$fp = fopen('assets/extras/travelled_other.json', 'w');
fwrite($fp, json_encode($empArray));
fclose($fp);
?>



<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<section id="content">

    <div class="page page-shop-products">

         <div class="pageheader">

            <h2>Candidates Travelled <span></span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-home"></i> SME</a>
                    </li>
                    <li>
                        <a>Candidate</a>
                    </li>
                    <li>
                        <a>Travelled Candidate List-Under other Visa</a>
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
                            <h1 class="custom-font"><strong>Travelled Candidate List</strong>-Under Other Visa </h1>
                            <ul class="controls">
                                <!--<li><a href="addcomp.php"><i class="fa fa-plus mr-5"></i> New Company</a></li>-->

                                
                                <li class="dropdown">

                                    <a role="button" tabindex="0" class="dropdown-toggle settings"
                                       data-toggle="dropdown">
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
                                <li class="remove"><a role="button" tabindex="0" class="tile-close"><i
                                            class="fa fa-times"></i></a></li>
                            </ul>
                        </div>
                        <!-- /tile header -->

                        <!-- tile body -->
                        <div class="tile-body">

                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-custom" id="products-list">
                                    <thead>
                                        <tr>
                                            <th style="width:10px;" >
                                                Sl.no
                                            </th>
                                            <th style="width:90px;">Candidate ID</th>
                                            <th style="width:90px;">Candidate Name</th>
                                            
                                            <th style="width:150px;" class="no-sort">Candidate Code</th>
											<th style="width:150px;" class="no-sort">Visa Type</th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>                   </div>
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
                                                                title: 'Employee List'
                                                            },
                                                            {
                                                                extend: 'pdfHtml5',
                                                                title: 'Employee List'
                                                            }
                                                            ,"print"
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
                                                        "ajax": 'assets/extras/travelled_other.json',
                                                        "order": [[0, "asc"]],
                                                        "columns": [
															
                                                            {"data": "no"},
                                                            {"data": "candidate_id"},
															{"data": "full_name"},
															{"data": "candidate_code"},
															{"data": "visa_type"}
															//,
//                {
//                    "type": "html",
//                    "data": "employee_id",
//                    "render": function (data) {
//                        return '<a href="employee_single.php?uid=' + data + '" class="btn btn-xs btn-default mr-5"><i class="fa fa-pencil"></i> Edit</a><a href="del_employ.php?uid=' + data + '" class="btn btn-xs btn-lightred"><i class="fa fa-times"></i> Delete</a>';
//                    }}
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
        var headstr = "<!doctype html><head><title>Employee List</title></head><body>";
        var footstr = "</body></html>";
        var printContents = document.getElementById(divName).innerHTML;
        //ar originalContents = document.body.innerHTML;
        document.body.innerHTML = headstr + printContents + footstr;
        window.print();
        location.href = "report_employee.php";
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
