<?php
$success_msg = "";
$page = "accounts";
$tab = "accounts_emp_settings";
$sub = "accounts_deduction";
$sub1 = "accounts_deduction_category_add";


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

            <h2>Add Deduction Category<span></span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-home"></i> SME</a>
                    </li>
                    <li>
                        <a href="#">HR </a>
                    </li>
                    <li>
                        <a href="#">Employee</a>
                    </li>
                    <li>
                        <a href="#">Salary</a>
                    </li>
					<li>
                        <a href="#">Add Deduction Category</a>
                    </li>
                </ul>

            </div>

        </div>

        <!-- page content -->
        <div class="pagecontent">

            <div id="rootwizard" class="tab-container tab-wizard">
                <ul class="nav nav-tabs nav-justified">
                    <li><a href="#tab1" data-toggle="tab">Add Deduction Category </a></li>


                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="tab1">

                        <form name="step1" id="step1" role="form" method="post">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="username">&nbsp; </label>
                                    <input type="text" name="ded_category[0]" placeholder="Deduction Category 1" class=" ded_category form-control" required="">
                                    <span id="com_status" class="validate_span"></span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="username">&nbsp; </label>
                                    <input type="text" name="ded_category[1]" placeholder="Deduction Category 2" class=" ded_category form-control" >
                                    <span id="com_status" class="validate_span"></span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="username">&nbsp;</label>
                                    <input type="text" name="ded_category[2]" placeholder="Deduction Category 3" class=" ded_category form-control" >
                                    <span id="com_status" class="validate_span"></span>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="username">&nbsp; </label>
                                    <input type="text" name="ded_category[3]" placeholder="Deduction Category 4" class=" ded_category form-control" >
                                    <span id="com_status" class="validate_span"></span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="username">&nbsp; </label>
                                    <input type="text" name="ded_category[4]" placeholder="Deduction Category 5" class=" ded_category form-control" >
                                    <span id="com_status" class="validate_span"></span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="username">&nbsp;</label>
                                    <input type="text" name="ded_category[5]" placeholder="Deduction Category 6" class=" ded_category form-control" >
                                    <span id="com_status" class="validate_span"></span>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="username">&nbsp; </label>
                                    <input type="text" name="ded_category[6]" placeholder="Deduction Category 7" class=" ded_category form-control" >
                                    <span id="com_status" class="validate_span"></span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="username">&nbsp; </label>
                                    <input type="text" name="ded_category[7]" placeholder="Deduction Category 8" class=" ded_category form-control" >
                                    <span id="com_status" class="validate_span"></span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="username">&nbsp;</label>
                                    <input type="text" name="ded_category[8]" placeholder="Deduction Category 9" class=" ded_category form-control" >
                                    <span id="com_status" class="validate_span"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="username">&nbsp; </label>
                                    <input type="text" name="ded_category[9]" placeholder="Deduction Category 10" class=" ded_category form-control" >
                                    <span id="com_status" class="validate_span"></span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="username">&nbsp; </label>
                                    <input type="text" name="ded_category[10]" placeholder="Deduction Category 11" class=" ded_category form-control" >
                                    <span id="com_status" class="validate_span"></span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="username">&nbsp;</label>
                                    <input type="text" name="ded_category[11]" placeholder="Deduction Category 12" class=" ded_category form-control" >
                                    <span id="com_status" class="validate_span"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p style="color:red;" id = ""></p>
                            </div>

                            <ul class="pager wizard" style="margin-right:650px;">
                                <!--<li class="previous"><button class="btn btn-default">Previous</button></li>
                                <li class="next"><button class="btn btn-default" id="next_btn">Next</button></li>-->
                                <li class="next finish" style="display:none;">
                                    <button class="btn btn-success" name="submit" id="submit_btn" type="button">Add</button>
                                </li>
                            </ul>

                        </form>
                    </div>


                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-2">
                            <h4 style="margin-left:30px;" class="text-success mt-0 mb-20" id="partner_succes"><?php echo $success_msg; ?></h4>
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
<script>
    $('.ded_category').blur(function () {
        var ded_category = $(this).val();
        var this_span = $(this).siblings('span');
        var this_textbox = $(this);
        $.ajax({
            url: 'deduction_category_ajax.php',
            type: 'POST',
            data: {ded: ded_category},
            success: function (data) {
                if (data == 0) {
                    $(this_span).html("Category Already Exist");
                    $(this_textbox).val("");
                } else {
                    $(this_span).html("");
                }
            }
        });
    });
    $("#submit_btn").click(function () {
        $('#com_status').html('');
        var fdata = $('#step1').serialize();
        $.ajax({
            url: 'deduction_category_ajax.php',
            type: 'POST',
            data: fdata,
            success: function () {
                location.href = 'accounts_deduction_category_list.php';
            }
        });
    });
</script>
<script>

</script>
<!--/ Page Specific Scripts -->

<script>

</script>
</body>
</html>
