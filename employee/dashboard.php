<?php
$page = "dashboard";
$sub = "e_list";
include('header.php');

$resEmp = $db->selectQuery("SELECT * FROM `sm_employee` WHERE `employee_id`='$emp_id'");
if (count($resEmp)) {
    $employee_firstname = $resEmp[0]['employee_firstname'];
    $employee_middlename = $resEmp[0]['employee_middlename'];
    $employee_lastname = $resEmp[0]['employee_lastname'];
    $employee_employment_id = $resEmp[0]['employee_employment_id'];
    $employee_company = $resEmp[0]['employee_company'];
    $employee_designation = $resEmp[0]['employee_designation'];
    $employee_fee = $resEmp[0]['employee_fee'];
    $employee_salary = $resEmp[0]['employee_salary'];
    $employee_nationality = $resEmp[0]['employee_nationality'];
    $employee_visatype = $resEmp[0]['employee_visatype'];
    $employee_gender = $resEmp[0]['employee_gender'];
    $employee_dob = $resEmp[0]['employee_dob'];
    //$employee_dob=$expl_employee_dob1[0]."/".$expl_employee_dob1[1]."/".$expl_employee_dob1[0];
    $employee_doj1 = explode("-", $resEmp[0]['employee_joining_date']);
    $employee_doj = $employee_doj1[2] . "/" . $employee_doj1[1] . "/" . $employee_doj1[0];
    $employee_remarks = $resEmp[0]['employee_remarks'];
    $employee_peraddress1 = $resEmp[0]['employee_peraddress1'];
    $employee_peraddress2 = $resEmp[0]['employee_peraddress2'];
    $employee_perdoor = $resEmp[0]['employee_perdoor'];
    $employee_percity = $resEmp[0]['employee_percity'];
    $employee_perstate = $resEmp[0]['employee_perstate'];
    $employee_perzip = $resEmp[0]['employee_perzip'];
    $employee_resiaddress1 = $resEmp[0]['employee_resiaddress1'];
    $employee_resiaddress2 = $resEmp[0]['employee_resiaddress2'];
    $employee_residoor = $resEmp[0]['employee_residoor'];
    $employee_resicity = $resEmp[0]['employee_resicity'];
    $employee_resistate = $resEmp[0]['employee_resistate'];
    $employee_zip = $resEmp[0]['employee_zip'];
    $employee_email = $resEmp[0]['employee_email'];
    $employee_phone = $resEmp[0]['employee_phone'];
    $employee_emcontact = $resEmp[0]['employee_emcontact'];
    $sponsor_id = $resEmp[0]['sponsor_id'];
}
$dpImg = "";
$resLogo = $db->selectQuery("SELECT * FROM `sm_employee_files` WHERE `file_title`='Profile_Picture' AND `file_status`='1' AND `employee_id`='$emp_id'");
if (count($resLogo)) {
    $dpImg = "../" . $resLogo[0]['file_name'];
} else {
    $dpImg = "../assets/images/profile-default.png";
}
?>
<style>
    .form-control{
        background-color:#ffffff !important;
    }
</style>
<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<section id="content">

    <div class="page page-profile">

        <div class="pageheader">

            <h2>Employee Profile<span></span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="index.php"><i class="fa fa-home"></i> SME</a>
                    </li>

                    <li>
                        My Profile
                    </li>
                </ul>

            </div>

        </div>

        <!-- page content -->
        <div class="pagecontent">


            <!-- row -->
            <div class="row">
                <!-- col -->
                <div class="col-md-4">

                    <!-- tile -->
                    <section class="tile tile-simple">

                        <!-- tile widget -->
                        <div class="tile-widget p-30 text-center">

                            <div class="thumb thumb-xl">
                                <img class="img-circle" src="<?php echo $dpImg; ?>" alt="">
                            </div>
                            <h4 class="mb-0"><strong><?php echo $employee_firstname; ?></strong> <?php echo $employee_middlename . " " . $employee_lastname; ?></h4>
                            <span class="text-muted"><?php echo $employee_designation; ?></span>
                        </div>
                    </section>
                    <section class="tile tile-simple">
                        <div class="tile-header">
                            <h1 class="custom-font"><strong>About</strong> <?php echo $employee_firstname; ?> <span></span> <?php echo $employee_lastname; ?> </h1>
                        </div>
                        <div class="tile-body">
                            <p class="text-default lt"><?php echo $employee_remarks; ?></p>
                        </div>
                    </section>
                    <section class="tile tile-simple dvd dvd-btm">

                        <!-- tile header -->
                        <div class="tile-header">
                            <h1 class="custom-font"><strong>Write </strong>Report</h1>
                        </div>
                        <!-- /tile header -->

                        <!-- tile body -->
                        <div class="tile-body form-group">
                            <!--<label class="col-sm-2 control-label">Switch label</label> -->





                            <div class="row">
                                <div class="col-md-4">
                                    <button class="btn btn-success mb-10" id="write_report" data-toggle="modal" data-target="#splash12" data-options="splash-2 splash-primary splash-ef-2">Write Report</button>
                                </div>
                            </div>

                            <!-- Splash Modal -->



                        </div>
                        <!-- /tile body -->

                    </section>
                </div>

                <div class="col-md-8">

                    <!-- tile -->
                    <section class="tile tile-simple">
                        <!-- tile body -->
                        <div class="tile-body p-0">
                            <div role="tabpanel">
                                <ul class="nav nav-tabs tabs-dark" role="tablist">
                                    <li role="presentation"><a style="color:#16a085;" href="#">My Profile</a></li>
                                </ul>
                                <div style="padding: 12px">
                                    <form method="post" action="employee_edit.php">
                                        <div class="wrap-reset">

                                            <form class="profile-settings">

                                                <div class="row">
                                                    <div class="form-group col-md-6 legend">
                                                        <h4><strong>Personal</strong> Details </h4>
                                                    </div>
                                                    <div class="col-sm-5"> </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-sm-4">
                                                        <label for="first-name">First Name</label>
                                                        <input type="text" class="form-control" name="f_name" id="f_name" readonly value="<?php echo $employee_firstname; ?>">
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <label for="last-name">Middle Name</label>
                                                        <input type="text" class="form-control" name="m_name" id="m_name" readonly value="<?php echo $employee_middlename; ?>">
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <label for="last-name">Last Name</label>
                                                        <input type="text" class="form-control" name="l_name" id="l_name" readonly value="<?php echo $employee_lastname; ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-sm-6">
                                                        <label for="Nationality">Employee ID</label>
                                                        <input type="text" name="eid" readonly class="form-control" id="eid" value="<?php echo $employee_employment_id; ?>">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="Nationality">Joining Date</label>
                                                        <input type="text" name="doj" readonly class="form-control" id="Nationality" value="<?php echo $employee_doj; ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-sm-6">
                                                        <label for="address1">Permanant Address</label>

                                                        <input type="text" class="form-control" name="p_address" readonly id="p_address" value="<?php echo $employee_peraddress1; ?>">
                                                        <label for="address1"></label>
                                                        <input type="text" class="form-control" name="" readonly id="p_address" value="<?php echo $employee_peraddress2; ?>">
                                                        <label for="address1"></label>
                                                        <input type="text" class="form-control" name="" readonly id="p_address" value="<?php echo $employee_perdoor; ?>">
                                                        <label for="address1"></label>
                                                        <input type="text" class="form-control" name="" readonly id="p_address" value="<?php echo $employee_percity; ?>">
                                                        <label for="address1"></label>
                                                        <input type="text" class="form-control" name="" readonly id="p_address" value="<?php echo $employee_perstate; ?>">

                                                        <label for="address1"></label>
                                                        <input type="text" class="form-control" name="" readonly id="p_address" value="<?php echo $employee_perzip; ?>">

                                                    </div>

                                                    <div class="form-group col-sm-6">
                                                        <label for="address2">Temporary Address</label>
                                                        <input type="text" class="form-control" name="t_address" readonly id="t_address" value="<?php echo $employee_resiaddress1; ?>">
                                                        <label for="address1"></label>
                                                        <input type="text" class="form-control" name="" readonly id="p_address" value="<?php echo $employee_resiaddress2; ?>">
                                                        <label for="address1"></label>
                                                        <input type="text" class="form-control" name="" readonly id="p_address" value="<?php echo $employee_residoor; ?>">
                                                        <label for="address1"></label>
                                                        <input type="text" class="form-control" name="" readonly id="p_address" value="<?php echo $employee_resicity; ?>">
                                                        <label for="address1"></label>
                                                        <input type="text" class="form-control" name="" readonly id="p_address" value="<?php echo $employee_resistate; ?>">
                                                        <label for="address1"></label>
                                                        <input type="text" class="form-control" name="" readonly id="p_address" value="<?php echo $employee_zip; ?>">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-sm-6">
                                                        <label for="Nationality">Gender</label>

                                                        <input type="text" name="Nationality" readonly class="form-control" id="Nationality" value="<?php echo $employee_gender; ?>">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="zip">DOB</label>

                                                        <div class='input-group' data-format="L">
                                                            <input type="text" class="form-control" name="dob" readonly id="dob" value="<?php echo $employee_dob; ?>">
                                                            <span class="input-group-addon"> <span class="fa fa-calendar"></span> </span>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="form-group col-sm-6">
                                                        <label for="city">Company</label>
                                                        <?php
                                                        $cmpName = $db->selectQuery("SELECT `company_name` FROM `sm_company` WHERE `company_id`='$employee_company'");
                                                        ?>
                                                        <input type="text" class="form-control" readonly name="company" id="company" value="<?php echo $cmpName[0]['company_name']; ?>">
                                                    </div>

                                                    <div class="form-group col-sm-6">
                                                        <label for="city">Designation</label>
                                                        <input type="text" class="form-control"  name="desig" readonly value="<?php echo $employee_designation; ?>">
                                                    </div>

                                                </div>
                                                <div class="row">

                                                    <!--                                                        </div>-->

                                                    <div class="form-group col-sm-6">
                                                        <label for="email">Sponsorship Fee(QAR)</label>
                                                        <input type="email" name="email" readonly class="form-control" id="email" value="<?php echo $employee_fee; ?>">
                                                    </div>


                                                    <div class="form-group col-sm-6">
                                                        <label for="Nationality">Salary</label>

                                                        <input type="text" name="Nationality" readonly class="form-control" id="Nationality" value="<?php echo $employee_salary; ?>">
                                                    </div>


                                                </div>

                                                <div class="row">

                                                    <!--                                                        </div>-->

                                                    <div class="form-group col-sm-6">
                                                        <label for="email">E-mail</label>
                                                        <input type="email" name="email" readonly class="form-control" id="email" value="<?php echo $employee_email; ?>">
                                                    </div>


                                                    <div class="form-group col-sm-6">
                                                        <label for="Nationality">Nationality</label>

                                                        <input type="text" name="Nationality" readonly class="form-control" id="Nationality" value="<?php echo $employee_nationality; ?>">
                                                    </div>


                                                </div>
                                                <div class="row">

                                                    <!--                                                        </div>-->

                                                    <div class="form-group col-sm-6">
                                                        <label for="email">Phone</label>
                                                        <input type="email" name="email" readonly class="form-control" id="email" value="<?php echo $employee_phone; ?>">
                                                    </div>


                                                    <div class="form-group col-sm-6">
                                                        <label for="Nationality">Emergency Contact</label>

                                                        <input type="text" name="Nationality" readonly class="form-control" id="Nationality" value="<?php echo $employee_emcontact; ?>">
                                                    </div>


                                                </div>


                                                <?php
                                                $docc = $db->selectQuery("select * from sm_employee_documents where employee_id='$emp_id' and status=1");
                                                if (count($docc) > 0)
                                                    echo"<div class='form-group col-md-12 legend'>
                                                        <h4><strong>Document</strong> Details </h4>
                                                        </div>";
                                                if (count($docc)) {
                                                    for ($i = 0; $i < count($docc); $i++) {
                                                        $document_title = $docc[$i]['document_title'];
                                                        $doc_data = $docc[$i]['document_data'];
                                                        $document_start_date1 = explode("-", $docc[$i]['document_start_date']);
                                                        $document_start_date = $document_start_date1[2] . "/" . $document_start_date1[1] . "/" . $document_start_date1[0];
                                                        $document_end_date1 = explode("-", $docc[$i]['document_end_date']);
                                                        $document_end_date = $document_end_date1[2] . "/" . $document_end_date1[1] . "/" . $document_end_date1[0];
                                                        ?>
                                                        <div class="row">
                                                            <div class="form-group col-sm-4">
                                                                <label for="city"><?php echo $document_title; ?></label>
                                                                <input type="text" class="form-control" readonly name="company" id="company" value="<?php echo $doc_data; ?>">
                                                            </div>
                                                            <div class="form-group col-sm-4">
                                                                <label for="city">Commencing Date</label>
                                                                <input type="text" class="form-control"  name="desig" readonly value="<?php echo $document_start_date; ?>">
                                                            </div>

                                                            <div class="form-group col-sm-4">
                                                                <label for="city">End Date</label>
                                                                <input type="text" class="form-control"  name="desig" readonly value="<?php echo $document_end_date; ?>">
                                                            </div>

                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <input type="hidden" name="idd" value="<?php echo $id; ?>">


                                                <?php
                                                $doc = $db->selectQuery("select * from sm_dependant where employee_id='$emp_id' and status=1");
                                                if (count($doc) > 0) {
                                                    echo "<div class='form-group col-md-12 legend'>
                                                        <h4><strong>Dependent</strong> Details </h4>
                                                    </div>";
                                                } else {
                                                    echo"";
                                                }

                                                if (count($doc)) {
                                                    for ($j = 0; $j < count($doc); $j++) {
                                                        $dependant_name = $doc[$j]['dependant_name'];
                                                        $dependant_visa = $doc[$j]['dependant_visa'];
                                                        $dependant_visa_start = $doc[$j]['dependant_visa_start'];
                                                        $dependant_visa_end = $doc[$j]['dependant_visa_end'];
                                                        $dependant_pass = $doc[$j]['dependant_pass'];
                                                        $dependant_pass_start = $doc[$j]['dependant_pass_start'];
                                                        $dependant_pass_end = $doc[$j]['dependant_pass_end'];
                                                        $k = $j + 1;
                                                        ?>

                                                        <div class="row">
                                                            <div class="form-group col-sm-4">
                                                                <label for="city">Dependant <?php echo $k; ?> Name</label>
                                                                <input type="text" class="form-control" readonly name="company" id="company" value="<?php echo $dependant_name; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-4">
                                                                <label for="city">Visa ID</label>
                                                                <input type="text" class="form-control" readonly name="company" id="company" value="<?php echo $dependant_visa; ?>">
                                                            </div>
                                                            <div class="form-group col-sm-4">
                                                                <label for="city">Commencing Date</label>
                                                                <input type="text" class="form-control"  name="desig" readonly value="<?php echo $dependant_visa_start; ?>">
                                                            </div>

                                                            <div class="form-group col-sm-4">
                                                                <label for="city">End Date</label>
                                                                <input type="text" class="form-control"  name="desig" readonly value="<?php echo $dependant_visa_end; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-4">
                                                                <label for="city">Passport ID</label>
                                                                <input type="text" class="form-control" readonly name="company" id="company" value="<?php echo $dependant_pass; ?>">
                                                            </div>
                                                            <div class="form-group col-sm-4">
                                                                <label for="city">Commencing Date</label>
                                                                <input type="text" class="form-control"  name="desig" readonly value="<?php echo $dependant_pass_start; ?>">
                                                            </div>

                                                            <div class="form-group col-sm-4">
                                                                <label for="city">End Date</label>
                                                                <input type="text" class="form-control"  name="desig" readonly value="<?php echo $dependant_pass_end; ?>">
                                                            </div>

                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>



<!--                                                <input type="submit" class="btn btn-info" name="save" value="Save">-->

                                        </div>

                                    </form>
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

<!--/ Application Content -->
<!-- ============================================
============== Vendor JavaScripts ===============
============================================= -->
<?php include './footer.php'; ?>
<script>
    function close_modal() {
        $('#splash12').modal('hide');
    }
    $('#report_submit').click(function (e) {
        e.preventDefault();
        var report_text = $('#report_text').val();
        var emp_id = '<?php echo $emp_id; ?>';
        $.ajax({
            url: "employee_report_ajax.php",
            type: "POST",
            data: {report_text: report_text, emp_id: emp_id},
            success: function (data) {
                $('#report_msg').html(data);
                setTimeout('close_modal()', 2000);
            }
        });
    });
</script>
</body>

</html>
