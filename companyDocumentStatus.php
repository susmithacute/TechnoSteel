<?php
$page = "company";
$sub = "company_docs";
$sub1= "company_status";
include('./file_parts/header.php');

$empArray = array();
$resFet = $db->selectQuery("SELECT company_id,company_pid,company_name FROM sm_company WHERE company_status =1");
if (count($resFet)) {
	$number=1;
    for ($rC = 0; $rC < count($resFet); $rC++) {
		$values['s_number']=$number+$rC;
		$cmp_id=$resFet[$rC]['company_id'];
		$values['company_id'] = $resFet[$rC]['company_id'];
		$values['company_pid'] = $resFet[$rC]['company_pid'];
        $values['company_name'] = $resFet[$rC]['company_name'];
		$select_file_data=$db->selectQuery("SELECT * FROM `sm_company_files` WHERE `company_id`='$cmp_id' AND `file_status`='1'");
		$values['document_staus_cr'] = $values['document_staus_cc'] = $values['document_staus_tc'] = $values['document_staus_mun'] = "Not Uploaded";
		
		if(count($select_file_data))
		{
			for($i=0; $i < count($select_file_data); $i++){
				$file_class = $select_file_data[$i]['file_class'];
				$file_title = $select_file_data[$i]['file_title'];
				if($file_class == 'CR'){
					if(!empty($select_file_data[$i]['file_name'])){
						$values['document_staus_cr'] = "Uploaded";
					} else { 
						$values['document_staus_cr'] = "Not Uploaded";}
				} else if($file_class == 'CC'){
					if(!empty($select_file_data[$i]['file_name'])){
						$values['document_staus_cc'] = "Uploaded";
					} else { 
						$values['document_staus_cc'] = "Not Uploaded";}
				}else if($file_class == 'TC'){
					if(!empty($select_file_data[$i]['file_name'])){
						$values['document_staus_tc'] = "Uploaded";
					} else { 
						$values['document_staus_tc'] = "Not Uploaded";}
				}else if($file_class == 'ML'){
					if(!empty($select_file_data[$i]['file_name'])){
						$values['document_staus_mun'] = "Uploaded";
					} else { 
						$values['document_staus_mun'] = "Not Uploaded";}
						
				
				}
			}
		} else {
			$values['document_staus_cr'] ="Not Uploaded";
			$values['document_staus_cc'] ="Not Uploaded";
			$values['document_staus_tc'] ="Not Uploaded";
			$values['document_staus_mun'] ="Not Uploaded";
			
		}
        $empArray["data"][] = $values;
    }
}
/* while ($row = mysql_fetch_assoc($resEmp)) {
  $empArray["data"][] = $row;
  } */
$fp = fopen('assets/extras/company.json', 'w');
fwrite($fp, json_encode($empArray));
fclose($fp);
?>
<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<section id="content">

    <div class="page page-shop-products">

        <div class="pageheader">

            <h2>Company List<span></span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-home"></i> SME</a>
                    </li>
                    <li>
                        <a>Company</a>
                    </li>
                    <li>
                        <a>Company List-All Companies</a>
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
                            <h1 class="custom-font"><strong>Company List</strong>-All Companies</h1>
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

                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-custom" id="products-list">
                                    <thead>
                                        <tr>
                                            <th style="width:10px;" >
                                                Sl.no
                                            </th>
                                            <th style="width:90px;">Company ID</th>
                                            <th style="width:90px;">Company Name</th>
                                            <th>Commercial Registration</th>
                                            <th>Computer Card</th>
											<th>Tax Card Documents</th>
											<th>Municipal Documents</th>
											
                                        
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
<!--/ CONTENT -->

<div class="modal splash fade" id="splash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title custom-font">Sure To Remove This Record ?</h3>
            </div>
            <input type="hidden" id="hid_del" value=""/>
            <div class="modal-body">

<!--                <p>This sure is a fine modal, isn't it?</p>

 <p>Modals are streamlined, but flexible, dialog prompts with the minimum required functionality and smart defaults.</p>-->
            </div>
            <div class="modal-footer">
                <button class="btn btn-default btn-border" id="sub_btn">Yes</button>
                <button class="btn btn-default btn-border" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>




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
      var t=  $('#products-list').DataTable({
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
            "ajax": 'assets/extras/company.json',
            "order": [[0, "asc"]],
            "columns": [
                {
                    "data": "s_number"
                },
                {
                    "data": "company_pid",
                },
                {
                    "type": "html",
                    "data": "company_name",
                    "render": function (data, type, full, meta) {
                        return '<a href="company_read.php?company_id=' + full.company_id + '" class=""><i class=""></i> ' + data + '</a>';
                    }},
                {"data": "document_staus_cr"},
                {"data": "document_staus_cc"},
                {"data": "document_staus_tc"},
				{"data": "document_staus_mun"}
				
                /*{
                    "type": "html",
                    "data": "employee_id",
                    "render": function (data) {
                        return '<a href="employee_edit.php?uid=' + data + '" class="btn btn-xs btn-default mr-5"><i class="fa fa-pencil"></i> Edit</a><a onclick="delete_id(' + data + ')" class="btn btn-xs btn-lightred" data-toggle="modal" data-target="#splash" data-options="splash-ef-3"><i class="fa fa-times"></i> Delete</a>';
                    }} */ 
            ],
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
            }
        });
        // t.on( 'order.dt search.dt', function () {
            // t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                // cell.innerHTML = i+1;
            // } );

        // } ).draw();
        //*initialize datatable
    });</script>

<!--/ Page Specific Scripts -->
	
<script type="text/javascript" src="assets/js/jquery.techbytarun.excelexportjs.js"></script>
<script type="text/javascript" src="assets/js/jquery.techbytarun.excelexportjs.min.js"></script>


<script>
    function printDiv(divName) {
        var headstr = "<html><head><title>Company List</title></head><body>";
        var footstr = "</body></html>";
        var printContents = document.getElementById(divName).innerHTML;
        //var originalContents = document.body.innerHTML;
        document.body.innerHTML = headstr + printContents + footstr;
        window.print();
        //document.body.innerHTML = originalContents;
        location.href = "employeeDocumentStatus.php";
    }
    $("#btnExport").click(function () {
        $("#products-list").excelexportjs({
            containerid: "products-list"
            , datatype: 'table'
        });
    });

</script>


<script type="text/javascript">
    function delete_id(id)
    {
        $.session.set('delete_seesion', id);
        $('#hid_del').val($.session.get('delete_seesion'));
        // alert($.session.get('delete_seesion'));
    }
    $('#sub_btn').click(function () {
        var pass_val = $('#hid_del').val();
        $.ajax({
            url: "delete_emp.php",
            type: "POST",
            data: {pass_val: pass_val},
            success: function (data) {
                window.location = "employee_list.php";
            }
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






<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->

</body>

</html>
