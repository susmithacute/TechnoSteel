<?php
$page = "visa";

$tab = "process_visa";

$sub = "visa_nottr_list";

$head = $head1 = $sub1 = "";

include('file_parts/header.php');



$cmpArray = array();
$today = date('Ymd');
$nothing = "00000000";

$resFet = $db->selectQuery("SELECT  * FROM `sm_visa` WHERE `visa_status`='Issued' AND `visa_active`='1' AND visa_expiry_date < '$today' AND visa_entry_date='$nothing'");
if (count($resFet)) {

    for ($rC = 0; $rC < count($resFet); $rC++) {

        $values['visa_id'] = $resFet[$rC]['visa_id'];

        $values['visa_applicant_name'] = $resFet[$rC]['visa_applicant_name'];
        $values['visa_number'] = $resFet[$rC]['visa_number'];
        $values['visa_client_name'] = $resFet[$rC]['visa_client_name'];
        $values['visa_category'] = $resFet[$rC]['visa_category'];
        $values['visa_type'] = $resFet[$rC]['visa_type'];
        $exp_date = explode("-", $resFet[$rC]['visa_issued_date']);
        $disp_date = $exp_date[2] . "/" . $exp_date[1] . "/" . $exp_date[0];
        $values['visa_issued_date'] = $disp_date;

        $e_date = explode("-", $resFet[$rC]['visa_expiry_date']);
        $expiry_date = $e_date[2] . "/" . $e_date[1] . "/" . $e_date[0];
        $values['visa_expiry_date'] = $expiry_date;
        //$visa_type = $resFet[$rC]['visa_type'];
        $cmpArray["data"][] = $values;
    }
}

$fp = fopen('assets/extras/visa_nottravelled.json', 'w');

fwrite($fp, json_encode($cmpArray));

fclose($fp);
?>



<!-- ====================================================



================= CONTENT ===============================



===================================================== -->



<section id="content">







    <div class="page page-shop-products">







        <div class="pageheader">







            <h2>Not Entered List <span></span></h2>







            <div class="page-bar">







                <ul class="page-breadcrumb">



                    <li>



                        <a><i class="fa fa-home"></i> SME</a>



                    </li>



                    <li>



                        <a href="#">Visa</a>



                    </li>



                    <li>



                        <a href="#">Expired</a>



                    </li>

                    <li>



                        <a href="#">Not Entered List</a>



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

                    <section class="tile">

                        <!-- tile header -->



                        <div class="tile-header dvd dvd-btm">



                            <h1 class="custom-font"><strong>Not Entered</strong> List</h1>



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



                                            <th>Sl No.</th>




                                            <th style="width:120px;">Applicant Name</th>

                                            <th>Client Name</th>
                                            <th>Visa Number</th>
                                            <th>Visa Type</th>
                                            <th>Visa Category</th>
                                            <th>Issued Date</th>
                                            <th>Expiry Date</th>





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



            <input type="hidden" id="hid_del1" value=""/>







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

<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">



<!--/ custom javascripts -->



















<!-- ===============================================



============== Page Specific Scripts ===============



================================================ -->



<script>

    $('#dispatch_date').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true});

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
            "ajax": 'assets/extras/visa_nottravelled.json',
            "order": [[1, "desc"]],
            "columns": [
                {"data": "visa_id"},
                {"type": "html",
                    "data": "visa_applicant_name",
                    "render": function (data, type, full, meta) {



                        return '<a href="visa_process.php?visa_id=' + full.visa_id + '" class=""><i class=""></i> ' + data + '</a>';



                    }},
                {"data": "visa_client_name"},
                {"data": "visa_number"},
                {"data": "visa_type"},
                {"data": "visa_category"},
                {"data": "visa_issued_date"},
                {"data": "visa_expiry_date"},
                {
                    "type": "html",
                    "data": "visa_id",
                    "render": function (data, type, full, meta) {

                        return '<a onclick="delete_id(' + data + ')" class="btn btn-xs btn-lightred" data-toggle="modal" data-target="#splash" data-options="splash-ef-3"><i class="fa fa-times"></i> Delete</a>';


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

    function delete_id(id)
    {
        $('#hid_del1').val(id);
        //$('#emp_count').html(emp_count);
    }

    $('#sub_btn').click(function () {

        var pass_val = $('#hid_del1').val();

        $.ajax({
            url: "visa_permanant_delete.php",
            type: "POST",
            data: {pass_val: pass_val},
            success: function (data) {

                window.location = "visa_notravelled_list.php";

            }

        });

    });

</script>







</body>







</html>



