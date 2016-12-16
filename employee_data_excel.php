<?php
$success_msg = "";
$page = "report";
$sub = "r_em";
$head = $head1 = $tab = $tab1 = "";
include('file_parts/header.php');
?>
<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<style>
    .validate_span {
        color: #ff7b76 !important;
        font-size: 12px;
        line-height: 0.9em;
        list-style-type: none;
    }
</style>
<section id="content">

    <div class="page page-forms-wizard">

        <div class="pageheader">

            <h2>Generate Report<span></span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-home"></i> SME</a>
                    </li>
                    <li>
                        <a href="#">Report </a>
                    </li>
                    <li>
                        <a href="#">Employee List</a>
                    </li>

                </ul>

            </div>

        </div>

        <!-- page content -->
        <div class="pagecontent">

            <div id="rootwizard" class="tab-container tab-wizard">
                <ul class="nav nav-tabs nav-justified">
                    <li><a href="#tab1" data-toggle="tab">Generate Excel </a></li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="tab1">

                        <form name="step1" id="form1" role="form" method="post">
                            <div class="form-group col-md-2">
                                <input type="checkbox" name="emp[employee_id]" value="employee_employment_id" checked>employee_id<br>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="checkbox" name="emp[name]" value="Name"checked>name<br></div>
                            <div class="form-group col-md-2">
                                <input type="checkbox" name="emp[employee_joining_date]" value="employee_joining_date" checked>joining_date<br>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="checkbox" name="emp[employee_visatype]" value="employee_visatype" checked>visa_type<br>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="checkbox" name="emp[employee_peraddress1]" value="employee_peraddress1" checked>address<br>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="checkbox" name="emp[employee_gender]" value="employee_gender" checked>gender<br>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="checkbox" name="emp[employee_dob]" value="employee_dob" checked>dob<br>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="checkbox" name="emp[employee_company]" value="employee_company" checked>company<br>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="checkbox" name="emp[employee_designation]" value="employee_designation" checked>designation<br>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="checkbox" name="emp[employee_fee]" value="employee_fee" checked>sponsorship_fee<br>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="checkbox" name="emp[employee_salary]" value="employee_salary" checked>salary<br>
                            </div>

                            <div class="form-group col-md-2">
                                <input type="checkbox" name="emp[employee_email]" value="employee_email" checked>e-mail<br>
                            </div>

                            <div class="form-group col-md-2">
                                <input type="checkbox" name="emp[employee_nationality]" value="employee_nationality" checked>nationality<br>
                            </div>

                            <div class="form-group col-md-2">
                                <input type="checkbox" name="emp[employee_phone]" value="employee_phone" checked>phone<br>
                            </div>


                            <div class="form-group col-md-2">
                                <input type="checkbox" name="doc[qatar]" value="Qatar ID" checked>Qatar ID<br>
                            </div>

                            <div class="form-group col-md-2">
                                <input type="checkbox" name="doc[visa]" value="Visa" checked>Visa<br>
                            </div>

                            <div class="form-group col-md-2">
                                <input type="checkbox" name="doc[passport]" value="Passport" checked>Passport<br>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="checkbox" name="doc[health]" value="Health" checked>Health<br>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="checkbox" name="doc[license]" value="License" checked>License<br>
                            </div>
                            <div class="col-md-6">
                                <p style="color:red;" id = ""></p>
                            </div>

                            <ul class="pager wizard" style="margin-right:650px;">

                                <li class="next finish" style="display:none;">
                                    <button class="btn btn-success" name="submit" id="submit_btn" type="button">Generate excel</button>
                                </li>
                            </ul>

                        </form>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-2">
                            <h4 style="margin-left:30px;" class="text-success mt-0 mb-20" id="succes"><?php echo $success_msg; ?></h4>
                        </div>
                    </div>

                </div>

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

<script src="assets/js/vendor/parsley/parsley.min.js"></script>

<script src="assets/js/vendor/form-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="assets/js/vendor/daterangepicker/moment.min.js"></script>

<script src="assets/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/js/vendor/chosen/chosen.jquery.min.js"></script>



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

        $('#rootwizard').bootstrapWizard({
            onTabShow: function (tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index + 1;

                // If it's the last tab then hide the last button and show the finish instead
                if ($current >= $total) {
                    $('#rootwizard').find('.pager .next').hide();
                    $('#rootwizard').find('.pager .finish').show();
                    $('#rootwizard').find('.pager .finish').removeClass('disabled');
                } else {
                    $('#rootwizard').find('.pager .next').show();
                    $('#rootwizard').find('.pager .finish').hide();
                }

            },
            onNext: function (tab, navigation, index) {

                var form = $('form[name="step' + index + '"]');

                form.parsley().validate();

                if (!form.parsley().isValid()) {
                    return false;
                }

            },
            onTabClick: function (tab, navigation, index) {

                var form = $('form[name="step' + (index + 1) + '"]');
                form.parsley().validate();

                if (!form.parsley().isValid()) {
                    return false;
                }

            }

        });

    });
</script>
<!--
<script>
$("#submit_btn").click(function(){
    $('#com_status').html('');
    var des = jQuery('#cr').val();
    if(des==""){
      //  $('#com_status').html('This value is required.');
    }
    else{
        $.ajax({
            url: 'designation_check.php',
            type: 'POST',
            dataType: 'json',
            data: {des: des},
            success: function (data) {
                $('#com_status').html(data.Status);
                var ch2 = data.data_val;
                if (ch2 == 0) {
                    $('#cr').val('');
                }
                if (ch2 == 1) {
                    location.href='employee_list.php';
                }

            }
        });
    }
});

        </script>-->
<!--/ Page Specific Scripts -->

<script>
    $(document).ready(function () {
        var fdata = "";
        $('#submit_btn').click(function () {
            $("#succes").html('<img src="assets/images/buffering.gif" width="30" height="30" />');
            fdata = $('#form1').serialize();
            $.ajax({
                url: "employee_data_excel_ajax.php",
                type: "POST",
                data: fdata,
                success: function (data) {
                    $("#succes").html(data);
                    location.href = "excel_download.php?excel_name=" + data;
                }
            });
        });
    });
    /**/
</script>

</body>
</html>
