<?php
$page = "employee";
$sub = "employee_docs";
$sub1 = "employee_expiry";
$tab1 = $head = $head1 ="";
include('file_parts/header.php');
$qatar_ID = "";
?>
<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<section id="content">

    <div class="page page-shop-products">

        <div class="pageheader">

            <h2>Employee Document Expiry List<span></span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="index.html"><i class="fa fa-home"></i> SME</a>
                    </li>
                    <li>
                        <a>Employee</a>
                    </li>
                    <li>
                        <a>Employee Document Expiry List</a>
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
                            <h1 class="custom-font"><strong>Employee</strong> Document Expiry List</h1>
                            <ul class="controls">
                                <li class="dropdown">

                                    <a role="button" tabindex="0" class="dropdown-toggle settings" data-toggle="dropdown">
                                        <i class="glyphicon glyphicon-th-list"></i>
                                        <i class="fa fa-spinner fa-spin"></i>
                                    </a>



                                </li>
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
                                    <div class="divHeader"><strong style="font-size: 30px">Employee List</strong></div>
                                    <table class="table table-striped table-hover table-custom" id="products-list">
                                        <thead>
                                            <tr>
                                                <th style="width:90px;">Name</th>
                                                <th style="width:90px;">Employee ID</th>
                                                <th style="width:90px;">Visa Type</th>
                                                <th style="width:90px;">Passport Number</th>
                                                <th style="width:90px;">ID</th>
                                                <?php
                                                $select_docs = $db->selectQuery("SELECT DISTINCT `document_title` FROM `sm_employee_documents` WHERE `status`='1'");
                                                if (count($select_docs) > 0) {
                                                    for ($sd = 0; $sd < count($select_docs); $sd++) {
                                                        $docum_title = $select_docs[$sd]['document_title'];
                                                        if ($docum_title == 'Qatar ID') {
                                                            $docum_title = "ID Expiry";
                                                        }
                                                        if ($docum_title == 'Passport') {
                                                            $docum_title = "Passport Number";
                                                        }
                                                        ?>
                                                        <th style="width:70px;"><?php echo $docum_title; ?></th>
                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $resFet = $db->selectQuery("SELECT CONCAT(employee_firstname,' ', employee_middlename,' ', employee_lastname) AS full_name,employee_id,employee_visatype,employee_employment_id
FROM sm_employee
WHERE `employee_status` ='1'");
                                            if (count($resFet)) {
                                                for ($rC = 0; $rC < count($resFet); $rC++) {
                                                    $full_name = $resFet[$rC]['full_name'];
                                                    $employee_id = $resFet[$rC]['employee_id'];
                                                    $employee_visatype = $resFet[$rC]['employee_visatype'];
                                                    $employee_employment_id = $resFet[$rC]['employee_employment_id'];
                                                    ?>
                                                    <tr>
                                                        <td><a href="employee_read.php?uid=<?php echo $employee_id; ?>"><?php echo $full_name; ?></a></td>
                                                        <?php
                                                        $select_qatar = $db->selectQuery("SELECT `document_data` FROM `sm_employee_documents` WHERE `employee_id`='$employee_id' AND `status`='1' AND `document_title`='Qatar ID'");
                                                        if (count($select_qatar) > 0) {
                                                            $qatar_ID = $select_qatar[0]['document_data'];
                                                        }
                                                        $select_pass = $db->selectQuery("SELECT `document_data` FROM `sm_employee_documents` WHERE `employee_id`='$employee_id' AND `status`='1' AND `document_title`='Passport'");
                                                        if (count($select_pass) > 0) {
                                                            $pass_ID = $select_pass[0]['document_data'];
                                                        }
                                                        ?>
                                                        <td><?php echo $employee_employment_id; ?></td>
                                                        <td><?php echo $employee_visatype; ?></td>
                                                        <td><?php echo $pass_ID; ?></td>
                                                        <td><?php echo $qatar_ID; ?></td>
                                                        <?php
                                                        $select_docs1 = $db->selectQuery("SELECT DISTINCT `document_title` FROM `sm_employee_documents` WHERE `status`='1'");
                                                        if (count($select_docs1) > 0) {
                                                            for ($sd = 0; $sd < count($select_docs1); $sd++) {
																$insert_date="";
                                                                $d_title = $select_docs1[$sd]['document_title'];
                                                                $select_exp_date = $db->selectQuery("SELECT `document_end_date` FROM `sm_employee_documents` WHERE `document_title`='$d_title' AND `employee_id`='$employee_id' AND `status`='1'");
                                                                if (count($select_exp_date)) {
                                                                    $exp_date = $select_exp_date[0]['document_end_date'];
                                                                    if ($exp_date == "" || $exp_date == "0000-00-00") {
                                                                        $insert_date = "Not Available";
                                                                    } else {
                                                                        $myDateTime = DateTime::createFromFormat('Y-m-d', $select_exp_date[0]['document_end_date']);
                                                                        $insert_date = $myDateTime->format('d-M-Y');
                                                                    }
                                                                }
																else{
																$insert_date="Not Available";	
																}
                                                                ?>
                                                                <td><?php echo $insert_date; ?></td>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </tr> <?php
                                                }
                                            }
                                            ?>


                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th style="width:90px;">Name</th>
                                                <th style="width:90px;">Employee ID</th>
                                                <th style="width:90px;">Visa Type</th>
                                                <th style="width:90px;">Passport Number</th>
                                                <th style="width:90px;">ID</th>
                                                <?php
                                                $select_docs = $db->selectQuery("SELECT DISTINCT `document_title` FROM `sm_employee_documents` WHERE `status`='1'");
                                                if (count($select_docs) > 0) {
                                                    for ($sd = 0; $sd < count($select_docs); $sd++) {
                                                        $docum_title = $select_docs[$sd]['document_title'];
                                                        if ($docum_title == 'Qatar ID') {
                                                            $docum_title = "ID Expiry";
                                                        }
                                                        if ($docum_title == 'Passport') {
                                                            $docum_title = "Passport Number";
                                                        }
                                                        ?>
                                                        <th style="width:70px;"><?php echo $docum_title; ?></th>
                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </tr>
                                        </tfoot>
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
    tfoot input,thead input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
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

        $('#products-list tfoot th').each(function () {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="' + title + '" />');
        });


        //initialize datatable
        var table = $('#products-list').DataTable({
            "dom": 'Bf t<"row"<"col-md-4 col-sm-12"<"inline-controls no-print"l>><"col-md-4 col-sm-12"<"inline-controls text-center no-print"i>><"col-md-4 col-sm-12 no-print"p>>',
            "buttons": [
                {
                    extend: 'excelHtml5',
                    title: 'Employee Document Expiry List'
                },
                {
                    extend: 'pdfHtml5',
                    title: 'Employee Document Expiry List'
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
            //  "ajax": 'assets/extras/employee_doc_exp.json',
            "order": [[0, "asc"]],
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': ["no-sort"]}
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
                $('.inline-controls').has("#products-list_length").children('label').addClass("no-print");
            }
        });
        table.columns().every(function () {
            var that = this;

            $('input', this.footer()).on('keyup change', function () {
                if (that.search() !== this.value) {
                    that
                            .search(this.value)
                            .draw();
                }
            });
        });
        //*initialize datatable
    });
</script>
<!--/ Page Specific Scripts -->

<script>

</script>
<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->

</body>

</html>
