<?php
$page = "company";
$sub = "company_list";
$head = "";
include('file_parts/header.php');
if (isset($_REQUEST['company_id'])) {
    $company_id = $_REQUEST['company_id'];
}
$company_name = "";
$select_company_name = $db->selectQuery("SELECT `company_name` FROM `sm_company` WHERE `company_id`='$company_id'");
if (count($select_company_name)) {
    $company_name = $select_company_name[0]['company_name'];
}
?>
<style>
    .carousel-inner > .item > a > img, .carousel-inner > .item > img, .img-responsive, .thumbnail a > img, .thumbnail > img {
        height: 150px !important;
    }
</style>
<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<section id="content">

    <div class="page page-gallery">

        <div class="pageheader">

            <h2>Company Documents <span>: <?php echo $company_name; ?></span></h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-home"></i> Sponsor Master</a>
                    </li>
                    <li>
                        <a href="#">Company</a>
                    </li>
                    <li>
                        <a href="#">Company List</a>
                    </li>
                    <li>
                        <a href="#">Company Profile</a>
                    </li>
                    <li>
                        <a href="#">Documents</a>
                    </li>
                </ul>

            </div>

        </div>
        <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs tabs-dark" role="tablist">
                <li role="presentation"><a href="company_read.php?company_id=<?php echo $_GET['company_id'] ?>">Profile</a></li>
                <li role="presentation"><a href="company_edit.php?company_id=<?php echo $_GET['company_id'] ?>">Profile Edit</a></li>
                <li role="presentation" class="active"><a href="company_gallery.php?company_id=<?php echo $company_id ?>" aria-controls="messages" role="col2" data-toggle="tab">Documents</a></li>
            </ul>
            <ul class="mix-filter pull-right">
                <li class="filter active all_select" data-filter="all">
                    All
                </li>
                <?php
                $select_file_class = $db->selectQuery("SELECT `file_class` FROM `sm_company_files` WHERE `company_id`='$company_id' AND `file_status`='1'");
                if (count($select_file_class)) {
                    for ($fc = 0; $fc < count($select_file_class); $fc++) {
                        if ($select_file_class[$fc]['file_class'] != "") {
                            if( $select_file_class[$fc]['file_class']!=""){
                            ?>
                            <li class="filter individual_select" data-filter=".<?php echo $select_file_class[$fc]['file_class']; ?>">
                                <?php echo $select_file_class[$fc]['file_class']; ?>
                            </li>
                            <?php
                        }
                        }
                    }
                }
                ?>
            </ul>
            <ul class="mix-controls">
                <li class="select-all">
                    <label class="checkbox checkbox-custom checkbox-custom inline-block m-0">
                        <input type="checkbox"><i></i> Select all
                    </label>
                </li>
                <li class="mix-control disabled">
                    <a class="email_btn" id="" data-toggle="modal" data-target="#splash" data-options="splash-ef-3"><i class="fa fa-envelope-o"></i> Email</a>
                </li>
                <li class="mix-control disabled">
                    <a  class="download_btn" id="dwnbtn"><i class="fa fa-download"></i> Download</a>
                </li>
                <li class="mix-control disabled">
                    <a class="edit_btn" id="edit_btn" href="company_doc_edit.php?company_id=<?php echo $company_id; ?>"><i class="fa fa-pencil"></i> Edit</a>
                </li>
                <li class="mix-control disabled">
                    <a class="delete_btn" data-toggle="modal" data-target="#splash1" data-options="splash-ef-3"><i class="fa fa-trash-o"></i> Delete</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="col4">
                    <!-- row -->
                    <div class="row mix-grid">
                        <div class="gallery" data-lightbox="gallery">
                            <?php
                            $disp_image = "";
                            $file_type = "";
                            $cmpFiles = $db->selectQuery("SELECT * FROM `sm_company_files` WHERE `company_id`='$company_id' AND `file_status`='1'");
                            if (count($cmpFiles)) {
                                for ($ef = 0; $ef < count($cmpFiles); $ef++) {
                                    $images_with_path = $cmpFiles[$ef]['file_name'];
                                    $explod_image = explode(",", $images_with_path);
                                    $image_class = $cmpFiles[$ef]['file_class'];
                                    foreach ($explod_image as $img) {
                                        $disp_image = "";
                                        $file_type = "";
                                        $fileExtension = explode(".", $img);
                                        if ($fileExtension[1] == 'pdf' || $fileExtension[1] == 'PDF') {
                                            $disp_image = "assets/images/pdf_image.jpg";
                                            $file_type = "pdf";
                                        } if ($fileExtension[1] == 'docx' || $fileExtension[1] == 'doc' || $fileExtension[1] == 'DOCX' || $fileExtension[1] == 'DOC') {
                                            $disp_image = "assets/images/docx_image.png";
                                            $file_type = "docx";
                                        } if ($fileExtension[1] == 'jpg' || $fileExtension[1] == 'png' || $fileExtension[1] == 'PNG' || $fileExtension[1] == 'JPG') {
                                            $disp_image = $img;
                                            $file_type = "img";
                                        }
                                        ?>
                                        <div class="col-md-3 col-sm-4 mb-20 mix mix_all parentImg <?php echo $image_class; ?>">
                                            <div class="img-container">
                                                <input type="hidden" id="image_id" value="<?php echo $cmpFiles[$ef]['file_id']; ?>" />
                                                <input type="hidden" id="filename" value="<?php echo $image_class; ?>"/>
                                                <img class="img-responsive" alt="" src="<?php echo $disp_image; ?>" width="500" height="auto">
                                                <div class="img-details">
                                                    <h4 class="custom-font ng-binding"><?php echo $image_class; ?></h4>
                                                    <div class="img-controls">
                                                        <a href="javascript:;" class="img-select">
                                                            <i class="fa fa-circle-o"></i>
                                                            <i class="fa fa-circle"></i>
                                                        </a>
                                                        <a href="javascript:;" class="img-link">
                                                            <i class="fa fa-link"></i>
                                                        </a>
                                                        <?php
                                                        if ($file_type == "img") {
                                                            ?>
                                                            <a class="img-preview" data-lightbox="gallery-item" href="<?php echo $img; ?>" title="<?php echo $image_class; ?>">
                                                                <i class="fa fa-search"></i>
                                                            </a>
                                                        <?php } else {
                                                            ?>
                                                            <a class="img-preview" data-lightbox="" target="_blank" href="<?php echo $img; ?>" title="<?php echo $image_class; ?>">
                                                                <i class="fa fa-search"></i>
                                                            </a>
                                                        <?php }
                                                        ?>
                                                        <a href="javascript:;" class="img-more">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            ?>
                            <!-- /col -->
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
</div>
</div>
</div>
</section>
<!--/ CONTENT -->
</div>
<!--/ Application Content -->
<div class="modal splash fade" id="splash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="email_modals">
            <div class="modal-header">
                <h3 class="modal-title custom-font">E-mail</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <label>Email</label>
                        <input type="text" name="gal_email" id="gal_email" class="form-control" placeholder="E-mail"/>
                        <span id="gal_span"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label>Subject</label>
                        <input type="text" name="gal_subject" id="gal_subject" class="form-control" placeholder="Subject"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label>Remarks</label>
                        <textarea name="gal_remarks" id="gal_remarks" class="form-control" placeholder="Remarks(if any)"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <span id="success_email" style="color:green"></span>
                <button class="btn btn-default btn-border" id="email_btn">Send</button>
                <button class="btn btn-default btn-border" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="modal splash fade" id="splash1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="email_modal">
            <div class="modal-header">
                <h3 class="modal-title custom-font">Sure to delete this?</h3>
            </div>
            <div class="modal-body">
                <p style="color:green" id="del_message"></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default btn-border" id="delete_btn">Yes</button>
                <button class="btn btn-default btn-border" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
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

<script src="assets/js/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

<script src="assets/js/vendor/mixitup/jquery.mixitup.min.js"></script>
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
        $('.mix-grid').mixItUp();
        $('.mix-controls .select-all input').change(function () {
            if ($(this).is(":checked")) {
                $('.gallery').find('.mix').addClass('selected');
                enableGalleryTools(true);
            } else {
                $('.gallery').find('.mix').removeClass('selected');
                enableGalleryTools(false);
            }
        });
        $('.mix .img-select').click(function () {
            var mix = $(this).parents('.mix');
            if (mix.hasClass('selected')) {
                mix.removeClass('selected');
                enableGalleryTools(false);
            } else {
                mix.addClass('selected');
                enableGalleryTools(true);
            }
        });
        var enableGalleryTools = function (enable) {

            if (enable) {

                $('.mix-controls li.mix-control').removeClass('disabled');

            } else {

                var selected = false;

                $('.gallery .mix').each(function () {
                    if ($(this).hasClass('selected')) {
                        selected = true;
                    }
                });

                if (!selected) {
                    $('.mix-controls li.mix-control').addClass('disabled');
                }
            }
        }

    });
</script>
<script>
    function Redirect()
    {
        window.location = "company_gallery.php?company_id=" +<?php echo $company_id; ?>;
    }

    $('#email_btn').click(function () {
        var send_email = $('#gal_email').val();
        var gal_subject = $('#gal_subject').val();
        var gal_remarks = $('#gal_remarks').val();
        var imgVal = new Array();
        $('.selected').each(function () {
            imgVal.push($(this).find('.img-preview').attr('href'));
        });
        if (send_email == "") {
            $('#gal_span').css("color", "red");
            $('#gal_span').html('This field is required');
        } else {
            $.ajax({
                url: "company_gallery_email.php",
                type: "POST",
                data: {imgVal: imgVal, send_email: send_email, gal_subject: gal_subject, company_id: '<?php echo $company_id ?>', gal_remarks: gal_remarks},
                success: function (data) {
                    $('#success_email').html(data);
                    setTimeout('Redirect()', 2000);
                }
            });
        }
    });
    $('#delete_btn').click(function () {
        var imgId = new Array();
        $('.selected').each(function () {
            imgId.push($(this).find('#image_id').val());
        });
        $.ajax({
            url: "company_gallery_delete.php",
            type: "POST",
            data: {imgId: imgId},
            success: function (data) {
                $("#del_message").text(data);
                setTimeout('Redirect()', 1000);
            }
        });
    });
    $('#dwnbtn').click(function () {
        var picData = new Array();
        $('.selected').each(function () {
            picData.push($(this).find('.img-preview').attr('href'));
        });
        $.ajax({
            url: "company_gallery_download.php",
            type: "POST",
            data: {picData: picData},
            success: function (data) {
                location.href = "company_download.php?name=" + data;
            }
        });
    });
    $(".all_select").click(function () {
        $('.select-all').show();
    });
    $(".individual_select").click(function () {
        $('.select-all').hide();
    });
</script>

<!--/ Page Specific Scripts -->
<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->

</body>
<!-- Mirrored from www.tattek.sk/minovate-noAngular/gallery.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Jun 2016 08:44:37 GMT -->
</html>
