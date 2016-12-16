<?php
$page = "recruitment";
$tab = "candidate";
$sub = "candidate_list";
$head = "";
$head1 = "";
$sub1 = "";
$tab1 = "";
include('header.php');
$can_id = $_GET['can_id'];
$display_name = "";
$select_name = $db->selectQuery("SELECT CONCAT(candidate_firstname,' ' ,candidate_middlename,' ', candidate_lastname) as fullname FROM `sm_candidate` WHERE `candidate_id`='$can_id'");
if (count($select_name)) {
    $display_name = $select_name[0]['fullname'];
}
?>
<style>
    .carousel-inner > .item > a > img, .carousel-inner > .item > img, .img-responsive, .thumbnail a > img, .thumbnail > img {
        height: 150px !important;
    }
</style>
<section id="content">
    <div class="page page-gallery">
        <div class="pageheader">
            <h2>Documents <span> : <?php echo @$display_name; ?></span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="javascript:void(0)"><i class="fa fa-home"></i> Sponsor Master</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">Recruitment</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">Candidates</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">Candidate Profile</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">Documents</a>
                    </li>
                </ul>
            </div>
        </div>
        <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs tabs-dark" role="tablist">
                <li role="presentation"><a href="candidate_profile.php?can_id=<?php echo $can_id; ?>" >Profile</a></li>
                <li role="presentation"><a href="candidate_edit.php?can_id=<?php echo $can_id; ?>">Edit Profile</a></li>
                <li role="presentation"><a href="candidate_gallery.php?can_id=<?php echo $can_id; ?>" style="color:#16a085;">Documents</a></li>
            </ul>
            <ul class="mix-filter pull-right">
                <li class="filter active all_select" data-filter="all">
                    All
                </li>
                <li class="filter individual_select" data-filter=".Candidate_Picture">
                    Picture
                </li>
                <li class="filter individual_select" data-filter=".Passport_Documents">
                    Passport
                </li>
                 <li class="filter individual_select" data-filter=".ID_Card">
                    ID Card
                </li> 
                <!--<li class="filter" data-filter=".Visa">
                    Visa
                </li>-->
                <li class="filter individual_select" data-filter=".Resume">
                    Resume
                </li>
                <li class="filter individual_select" data-filter=".Experience_Certificates">
                    Experience
                </li>
               <li class="filter individual_select" data-filter=".Driving_License">
                    License
                </li>

            </ul>
            <ul class="mix-controls">
                <li class="select-all">
                    <label class="checkbox checkbox-custom checkbox-custom inline-block m-0">
                        <input type="checkbox"><i></i> Select all
                    </label>
                </li>
                <li class="mix-control disabled">
                    <a class="email_btn" data-toggle="modal" data-target="#splash" data-options="splash-ef-3"><i class="fa fa-envelope-o"></i> Email</a>
                </li>
                <li class="mix-control disabled">
                    <a  class="download_btn" id="dwnbtn"><i class="fa fa-download"></i> Download</a>
                </li>
                <li class="mix-control disabled">
                                    <a class="edit_btn" href="candidate_gallery_edit.php?uid=<?php  echo $can_id;  ?>" id="edit_btn"><i class="fa fa-pencil"></i> Edit</a>
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
                        <div class="gallery" id="galDiv" data-lightbox="gallery">
                            <!-- col -->
                            <?php
                            $disp_image = "";
                            $file_type = "";
                            $empFiles = $db->selectQuery("SELECT * FROM `sm_candidate_files` WHERE `candidate_id`='$can_id' AND `file_status`='1'");
							//echo "<pre>"; print_r($empFiles);
						   if (!empty($empFiles)) {
                                // print_r($empFiles);
                                for ($ef = 0; $ef < count($empFiles); $ef++) {
                                    $images_with_path = $empFiles[$ef]['file_path'];
									if(!empty($images_with_path)){
                                    $explod_image = explode(",", $images_with_path); //
                                    $image_class = $empFiles[$ef]['file_name'];
                                    $count_image = count($explod_image);
                                    foreach ($explod_image as $imgs) {
										
										$img = str_replace("../","",$imgs);
                                        
										$fileExtension = explode(".", $img);
                                        if ($fileExtension[1] == 'pdf' || $fileExtension[1] == 'PDF') {
                                            $disp_image = "../assets/images/pdf_image.jpg";
                                            $file_type = "pdf";
                                        } if ($fileExtension[1] == 'docx' || $fileExtension[1] == 'doc' || $fileExtension[1] == 'DOCX' || $fileExtension[1] == 'DOC') {
                                            $disp_image = "../assets/images/docx_image.png";
                                            $file_type = "docx";
                                        } if ($fileExtension[1] == 'jpg' || $fileExtension[1] == 'png' || $fileExtension[1] == 'PNG' || $fileExtension[1] == 'JPG') {
                                            if(file_exists($imgs) && $imgs!=''){
											$disp_image = $imgs;
											} else { $disp_image = "../assets/images/Image-Not-Found.png"; }
                                            $file_type = "img";
                                        }
                                        ?>
                                        <div class="col-md-3 col-sm-4 mb-20 mix mix_all parentImg <?php echo $image_class; ?>">
                                            <div class="img-container">
                                                <input type="hidden" id="image_id" value="<?php echo $empFiles[$ef]['file_id']; ?>" />
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
                                                            <a class="img-preview" data-lightbox="gallery-item" href="<?php echo $imgs; ?>" title="<?php echo $image_class; ?>">
                                                                <i class="fa fa-search"></i>
                                                            </a>
                                                        <?php } else {
                                                            ?>
                                                            <a class="img-preview" data-lightbox="" target="_blank" href="<?php echo $imgs; ?>" title="<?php echo $image_class; ?>">
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
                            }
                            ?>
                        </div>

                    </div>
                    <!-- /row -->

                </div>

                <div role="tabpanel" class="tab-pane" id="col3">

                    <!-- row -->
                    <div class="row mix-grid">

                        <div class="gallery" data-lightbox="gallery">
                            <!-- col -->
                            <!-- /col -->
                        </div>
                    </div>
                    <!-- /row -->
                </div>

                <div role="tabpanel" class="tab-pane" id="col2">
                    <!-- row -->
                    <div class="row mix-grid">

                        <div class="gallery" data-lightbox="gallery">
                            <!-- col -->
                            <!-- /col -->
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
        </div>
</section>
<!--/ CONTENT -->

</div>
<!--/ Application Content -->
<div class="modal splash fade" id="splash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="email_modal">
            <div class="modal-header">
                <h3 class="modal-title custom-font">E-mail</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <label>Email</label>
                        <input type="email" name="gal_email" id="gal_email" class="form-control" placeholder="E-mail" />
						<div id="err_msg" style="color:#ff0000"></div>
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
                <button class="btn btn-default btn-border" data-dismiss="modal">Close</button>
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
<script src="../assets/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>

<script src="../assets/js/vendor/bootstrap/bootstrap.min.js"></script>

<script src="../assets/js/vendor/jRespond/jRespond.min.js"></script>

<script src="../assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>

<script src="../assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>

<script src="../assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>

<script src="../assets/js/vendor/screenfull/screenfull.min.js"></script>

<script src="../assets/js/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

<script src="../assets/js/vendor/mixitup/jquery.mixitup.min.js"></script>
<!--/ vendor javascripts -->
<!-- ============================================
============== Custom JavaScripts ===============
============================================= -->
<script src="../assets/js/main.js"></script>
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
<!--/ Page Specific Scripts -->
<script>
    function Redirect()
    {
        window.location = "candidate_gallery.php?can_id=" +<?php echo $can_id; ?>;
    }

    $('#email_btn').click(function () {
        var send_email = $('#gal_email').val();
        var gal_subject = $('#gal_subject').val();
        var gal_remarks = $('#gal_remarks').val();
        var imgVal = new Array();
        $('.selected').each(function () {
            imgVal.push($(this).find('.img-preview').attr('href'));
        });
		
		if(send_email == null || send_email == ''){
				$("#err_msg").html("Email is Required");
		} else {
			$.ajax({
				url: "employee_gallery_email.php",
				type: "POST",
				data: {imgVal: imgVal, send_email: send_email, gal_subject: gal_subject, employee_id: '<?php echo $can_id ?>', gal_remarks: gal_remarks},
				success: function (data) {
					$('#success_email').html(data);
					setTimeout('Redirect()', 2000);
				}
			});
		}
    });
    $('#edit_btn').click(function () {
        var imgVal = new Array();
        $('.selected').each(function () {
            imgVal.push($(this).find('img').attr('src'));
        });
        $.ajax({
            url: "candidate_gallery_edit.php",
            type: "POST",
            data: {imgVal: imgVal},
            success: function () {

            }
        });
    });
    $('#delete_btn').click(function () {
        var imgId = new Array();
        $('.selected').each(function () {
            imgId.push($(this).find('#image_id').val());
        });
        $.ajax({
            url: "candidate_gallery_delete.php",
            type: "POST",
            data: {imgId: imgId},
            success: function (data) {
                $("#del_message").html("Documents Deleted Successfully");
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
            url: "candidate_gallery_download.php",
            type: "POST",
            data: {picData: picData},
            success: function (data) {
                location.href = "download_zip.php?name=" + data;
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

<script type='text/javascript'>
$(document).ready(function () {
     $('#gal_email').keyup(function() {
              var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

              if (re.test($(this).val())) {

                   // $(this).css("background-color", "green");
				   

              } else {
				   $("#err_msg").html("Invalid Email Address").fadeOut(3000);
				   return false;
              }
        });
});
</script>

</body>

<!-- Mirrored from www.tattek.sk/minovate-noAngular/gallery.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Jun 2016 08:44:37 GMT -->
</html>
