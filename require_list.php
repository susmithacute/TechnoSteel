<?php
$page = "employee";
$sub = "work_assign_list";
$tab="salary_list";
include('file_parts/header.php'); 

$empArray = array();
$resFet = $db->selectQuery("SELECT sm_work_site.work_site,sm_work_site.site_location,sm_inhouse_requirement.project_manager,sm_inhouse_requirement.title,sm_inhouse_requirement.contact,sm_inhouse_requirement.id  FROM sm_work_site INNER JOIN  sm_inhouse_requirement ON sm_work_site.id=sm_inhouse_requirement.work_site_id WHERE sm_inhouse_requirement.status='active'");

if (count($resFet)) {
    for ($rC = 0; $rC < count($resFet); $rC++) {
		
		$values['title']=$resFet[$rC]['title'];
		$values['project_manager']=$resFet[$rC]['project_manager'];
		$values['id'] = $resFet[$rC]['id'];
		$values['work_site_id'] = $resFet[$rC]['work_site'];
		$values['site_location'] = $resFet[$rC]['site_location'];
		$values['contact'] = $resFet[$rC]['contact'];
		
        $empArray['data'][] = $values;
    }
}


$fp = fopen('assets/extras/require_list.json', 'w');
fwrite($fp, json_encode($empArray));
fclose($fp);
?> 
<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<section id="content">

    <div class="page page-shop-products">

        <div class="pageheader">

            <h2>Inhouse Requirement List<span></span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-home"></i> SME</a>
                    </li>
                    <li>
                        <a>Inhouse Requirement</a>
                    </li>
                    <li>
                        <a>Inhouse Requirement List</a>
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
                            <h1 class="custom-font"><strong>Requirement  List  <?php //echo $resFet[$rC]['id']; ?></strong></h1>
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
                                             <th>sl.no</th>
											 <th>Title</th>
											 <th>Worksite</th>
											<th>site location</th>
											 <th>Project Manager</th>
											 <th>contact</th>
											<th>Action</th>
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
<div class="modal splash fade" id="splash2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title custom-font">No Of Employees?</h3>
            </div>
            <input type="hidden" id="hid_del" value=""/>
            <div class="modal-body">

                
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>


<div class="modal splash fade" id="splash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title custom-font">Sure To Remove This Record ?</h3>
            </div>
            <input type="hidden" id="hid_delete" value=""/>
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
<script>
    $(window).load(function () {

        //initialize datatable
      var t=  $('#products-list').DataTable({
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
            "ajax": 'assets/extras/require_list.json',
            "order": [[1, "asc"]],
            "columns": [
                {
                    "data": null,
                    "defaultContent": ''
                },
                
                {
                    "type": "html",
                    "data": "title",
                    "render": function (data, type, full, meta) {
                    return '<a href="require_view.php?uid=' + full.id + '" class=""><i class=""></i> ' + data + '</a>';
                    }},
                
				{"data": "work_site_id"},
				{"data": "site_location"},
				
				{"data": "project_manager"},
				{"data": "contact"},
				
				
				//{
                    //"type": "html",
                   // "data": "id",
                   // "render": function (data) {
                     //   return '<a onclick="update_id(' + data + ')" class="btn btn-xs btn-green" data-toggle="modal" //data-target="#splash2" data-options="splash-ef-3"><i class="fa fa-check"></i>Process</a>';
                //}},
                
                {
                    "type": "html",
                    "data": "id",
                    "render": function (data) {
                        return '<a href="require_edit.php?uid=' + data + '" class="btn btn-xs btn-default mr-5"><i class="fa fa-pencil"></i> Edit</a><a onclick="delete_id(' + data + ')" class="btn btn-xs btn-lightred" data-toggle="modal" data-target="#splash" data-options="splash-ef-3"><i class="fa fa-times"></i> Delete</a>';
                    }},
					
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
            }
        });
        t.on( 'order.dt search.dt', function () {
            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );

        } ).draw();
        //*initialize datatable
    });</script>
<!--/ Page Specific Scripts -->

<script type="text/javascript">
	
	function delete_id(id)
    {
        $.session.set('delete_seesion', id);
        $('#hid_delete').val($.session.get('delete_seesion'));
        // alert($.session.get('delete_seesion'));
    }
    $('#sub_btn').click(function () {
        var pass_val = $('#hid_delete').val();
		
        $.ajax({
            url: "require_delete.php",
            type: "POST",
            data: {pass_val: pass_val},
            success: function (data) {
                window.location = "require_list.php";
            }
        });
    });
</script>






<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->

</body>

</html>
