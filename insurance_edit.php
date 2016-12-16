<?php
$success_msg="";
$page = "vehicle";
$tab = "accounts_emp_settings";
$sub = "accounts_insurance_type";
$sub1 = "accounts_insurance_type_list";
include('file_parts/header.php');
$insurance_id = $_GET['insurance_id'];
?>

<?php



$res = $db->selectQuery("select * from sm_insurance where insurance_id='$insurance_id' ");


if (count($res)) {

    $insu_id = $res[0]['insurance_id'];

    $insu_type = $res[0]['insurance_type'];

}

?>



<?php

if (isset($_POST['submit'])) {

    $insurance_type= $_POST['insurance_type'];

    $values1['insurance_type'] = $insurance_type;
    $query1 = $db->secure_update('sm_insurance', $values1, "  WHERE insurance_id = '$insurance_id'");
    if (count($query1)) {

        $success_msg = "Values Updated!";

        echo "<script>location.href='insurance_list.php'</script>";

    }

    else

    {

        $success_msg = "Error in updation";

    }


}?>
<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<section id="content">

    <div class="page page-forms-wizard">

        <div class="pageheader">

            <h2>Edit Insurance Type<span></span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="dashboard.php"><i class="fa fa-home"></i> SME</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">Settings </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">Insurance List</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">Edit Insurance</a>
                    </li>
                </ul>

            </div>

        </div>

        <!-- page content -->
        <div class="pagecontent">

            <div id="rootwizard" class="tab-container tab-wizard">
                <ul class="nav nav-tabs nav-justified">
                    <li><a href="#tab1" data-toggle="tab">Edit Insurance </a></li>


                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="tab1">

                        <form name="step1" id="form1" role="form" method="post">

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="username">Insurance Type: </label>
                                    <input type="text" name="insurance_type" id="insurance_type" value="<?php echo $insu_type;?> "class="form-control" required>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <p style="color:red;" id = "com_status"></p>
                            </div>

                            <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $insu_id; ?>" />

                            <ul class="pager wizard" style="margin-right:650px;">
                                <!--<li class="previous"><button class="btn btn-default">Previous</button></li>
                                <li class="next"><button class="btn btn-default" id="next_btn">Next</button></li>-->
                                <li class="next finish" style="display:none;">
                                    <button class="btn btn-success" name="submit" id="submit_btn" type="submit">Add</button>
                                </li>
                            </ul>
                        </form>
                    </div>


                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-2">
                            <h4  class="text-success mt-0 mb-20" id="partner_succes"><?php echo $success_msg; ?></h4>
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

    $('#insurance_type').on('keyup', function (e) {
        var insurance_type = jQuery('#insurance_type').val();
        var edit_id = jQuery('#edit_id').val();
        $('#com_status').html('Please wait...');
        $.ajax({
            url: 'insurance_type_check_edit.php',
            type: 'POST',
            dataType: 'json',
            data: {insurance_type: insurance_type,edit_id:edit_id},
            success: function (data) {
                $('#com_status').html(data.Status);
                var ch2 = data.data_val;
                if (ch2 == 0) {
                    $('#insurance_type').val('');
                    $('#com_status').html(data.Status);
                }
                if (ch2 == 1) {

                }

            }
        });
    });
</script>
<!--/ Page Specific Scripts -->


</body>
</html>
