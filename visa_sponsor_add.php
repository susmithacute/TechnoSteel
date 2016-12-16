<?php
$success_msg = "";
$page = "visa";
$tab = "visa_settings";
$sub = "visa_sponsor_settings";
$sub1 = "visa_sponsor_add";
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
            <h2>Add Visa Sponsor<span></span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="dashboard.php"><i class="fa fa-home"></i> SME</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">Visa </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">Visa Sponsor</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">Add Visa Sponsor</a>
                    </li>

                </ul>

            </div>

        </div>
        <!-- page content -->
        <div class="pagecontent">

            <div id="rootwizard" class="tab-container tab-wizard">
                <ul class="nav nav-tabs nav-justified">
                    <li><a href="#tab1" data-toggle="tab">Add Visa Sponsor </a></li>


                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="tab1">

                        <form name="step1" id="form1" role="form" method="post">

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="username">Sponsor Name: </label>
                                    <input type="text" name="sponsor_name" id="sponsor_name" class="form-control" required>
                                    <span id="exist_status" class="validate_span"></span>

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="sponsor_email">Sponsor E-mail: </label>
                                    <input type="text" name="sponsor_email" id="sponsor_email" class="form-control" required>
                                    <span id="" class="validate_email validate_span"></span>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <p style="color:red;" id =""></p>
                            </div>

                            <ul class="pager wizard" style="margin-right:650px;">
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
<script>
    $(document).ready(function () {
        $("#form1").submit(function () {
            $(".btn .btn-success").attr("disabled", true);
            return true;
        });
    });
</script>
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
    function validate_email(email)
    {
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        return reg.test(email);
    }
    $('#submit_btn').click(function () {
        $('#exist_status').html('');
        var sponsor_name = jQuery('#sponsor_name').val();
        var sponsor_email = jQuery('#sponsor_email').val();
        if (validate_email(sponsor_email)) {
            $.ajax({
                url: 'sponsor_check.php',
                type: 'POST',
                dataType: 'json',
                data: {sponsor_name: sponsor_name, sponsor_email: sponsor_email},
                success: function (data) {
                    $('#exist_status').html(data.Status);
                    var ch2 = data.data_val;
                    if (ch2 == 0) {
                        $('#sponsor_name').val('');
                    }
                    if (ch2 == 1) {
                        location.href = 'visa_sponsor_list.php';
                    }

                }
            });
        } else {
            $('.validate_email').html("Not a valid E-mail");
        }
    });
</script>
<!--/ Page Specific Scripts -->

</body>
</html>
