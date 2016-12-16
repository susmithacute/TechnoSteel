<?php
$page = "recruitment";
$tab = "recruitment_report";
$sub = "req_visa_report";
include('file_parts/header.php');

$empArray = array();
$resFet = $db->selectQuery("SELECT CONCAT( sm_candidate.candidate_firstname,  ' ', sm_candidate.candidate_middlename,  ' ', sm_candidate.candidate_lastname ) AS candidate_name, sm_candidate_medical_status.medical_status_id,sm_candidate.candidate_id,sm_candidate.candidate_code,sm_candidate_application.application_job_position,sm_candidate.candidate_nationality FROM sm_candidate LEFT JOIN sm_candidate_medical_status ON  sm_candidate.candidate_id=sm_candidate_medical_status.candidate_id LEFT JOIN sm_candidate_application ON  sm_candidate.candidate_id=sm_candidate_application.candidate_id  WHERE  `medical_status`='fit' AND `candidate_interview_status` ='Selected'");
$status ="";
if (count($resFet)) {
    for ($rC = 0; $rC < count($resFet); $rC++) {
		
		$vals= $rC+1;
		   $values['s_number']=$vals;
		
        //$values['medical_status_id'] = $resFet[$rC]['medical_status_id'];
        $values['candidate_code'] = $resFet[$rC]['candidate_code'];
		$values['candidate_name'] = $resFet[$rC]['candidate_name'];
		$values['application_job_position'] = $resFet[$rC]['application_job_position'];
     $yoyo = $resFet[$rC]['candidate_id'];
	 $values['candidate_id'] = $resFet[$rC]['candidate_id'];
		  $values['candidate_nationality'] = $resFet[$rC]['candidate_nationality'];
		   
	  $select = $db->selectQuery("SELECT visa_status FROM sm_candidate_visa_process WHERE `candidate_id` = '$yoyo' ");
		    // for ($i = 0; $i < count($select); $i++){
    
	if(count($select)>0){
	
		
		
		$visa_stat = $select[0]['visa_status'];
		if($visa_stat == 'Approved'){
		$values['visa_status'] = "Issued";
		} else {
			$values['visa_status'] = $visa_stat;
		}
		
	$status=$select[0]['visa_status'];
	
	}else{
		$values['visa_status']='Pending';
	}
	$cau_type = $db->selectQuery("SELECT * FROM sm_candidate_visa_process WHERE `visa_status` != 'Pending'  AND`candidate_id` = '$yoyo'");
		
		if(count($cau_type)>0){
			$values['casual']="1";
		}
		else{
			$values['casual']="0";
		}
		
	$empArray["data"][] = $values;
	 
		
    }
	

	
}

		
/* while ($row = mysql_fetch_assoc($resEmp)) {
  $empArray["data"][] = $row;
  } */
$fp = fopen('assets/extras/processvisa.json', 'w');
fwrite($fp, json_encode($empArray));
fclose($fp);
?>
<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<section id="content">

    <div class="page page-shop-products">

     
        <div class="pageheader">

            <h2>Selected Candidate List<span></span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-home"></i> SME</a>
                    </li>
					<li>
                        <a>Recruitment</a>
                    </li>
					
                    <li>
                        <a>Process Visa</a>
                    </li>
					
                    <li>
                        <a>Selected Candidate List</a>
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
                  <h1 class="custom-font"><strong>Candidate List For Visa</strong></h1>
                            <ul class="controls">
                                <!--<li><a href="addcomp.php"><i class="fa fa-plus mr-5"></i> New Company</a></li>-->

                                <li class="dropdown">

                                    <a role="button" tabindex="0" class="dropdown-toggle settings"
                                       data-toggle="dropdown">
                                        <i class="glyphicon glyphicon-th-list"></i>
                                        <i class="fa fa-spinner fa-spin"></i>
                                    </a>
									

                                </li>
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
                                            <th style="width:10px;" >Sl.no</th>
                                            <th style="width:90px;">Candidate ID</th>
											 <th style="width:90px;">Candidate Name</th>
											 		 <th style="width:90px;">Nationality</th>
										 <th style="width:90px;">Designation</th>
                                            <th style="width:150px;" class="no-sort">Status</th>
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
</div>
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
     $('#products-list').DataTable({
            "dom": 'Bf t<"row"<"col-md-4 col-sm-12"<"inline-controls no-print"l>><"col-md-4 col-sm-12"<"inline-controls text-center no-print"i>><"col-md-4 col-sm-12 no-print"p>>',
            "buttons": [
                {
                    extend: 'excelHtml5',
                    title: 'Process Candidate List'
                },
                {
                    extend: 'pdfHtml5',
                    title: 'Process Candidate List'
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
            "ajax": 'assets/extras/processvisa.json',
            "order": [[0, "asc"]],
            "columns": [
                {"data": "s_number"},
              
				{"data": "candidate_code"},
                 {
                     "type": "html",
                     "data": "candidate_name",
                    // "render": function (data, type, full, meta) {
                        // return '<a href="employee_read.php?uid=' + full.candidate_id + '" class=""><i class=""></i> ' + data + '</a>';
                    // }
					 },
                
               	{"data": "candidate_nationality"},
				{"data": "application_job_position"},
			
            {
					"type": "html",
					"data": "candidate_id",
                    
                    
                    "render": function (data, type, full, meta) {
						 var c="";
						if(full.casual==="0"){
							c=full.visa_status;
							
						}
                        else {
							c=full.visa_status; 
							//{"data": "visa_status"};
							}	
						
						
						
						return c;

						
						}
                              	
									  
            }],
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
            }
        });
//        t.on( 'order.dt search.dt', function () {
//            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
//                cell.innerHTML = i+1;
//            } );
//        } ).draw();
        //*initialize datatable
    });
</script>
<!--/ Page Specific Scripts -->


<script type="text/javascript" src="assets/js/jquery.techbytarun.excelexportjs.js"></script>
<script type="text/javascript" src="assets/js/jquery.techbytarun.excelexportjs.min.js"></script>

<script>
    function printDiv(divName) {
        var headstr = "<html><head><title>Employee Performance List</title></head><body>";
        var footstr = "</body></html>";
        var printContents = document.getElementById(divName).innerHTML;
        //var originalContents = document.body.innerHTML;
        document.body.innerHTML = headstr + printContents + footstr;
        window.print();
        //document.body.innerHTML = originalContents;
        location.href = "report_appraisal.php";
    }
    $("#btnExport").click(function () {
        $("#products-list").excelexportjs({
            containerid: "products-list"
            , datatype: 'table'
        });
    });

</script>
<script>
$('#year').on('change', function (e) { 
 //alert("dgfdg");
		var perform = $(this).val();
		
		var year = jQuery('#year').val();
		
            location.href="report_appraisal.php?year="+year+"&perform="+perform;
        //} 
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
