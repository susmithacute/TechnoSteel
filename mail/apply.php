<?php
/*
Template Name: Apply Job
*/
?>
<?php get_header(); ?><?php $title=''; if(isset($_REQUEST['id'])){$title=$_REQUEST['id']; }?>
<section class="section-block project-wrap">

            <div class="container">

                <div class="title-blk cf">

                    <h3><?php the_title(); ?>&nbsp;<?php echo $title   ?></h3>

                    

                </div>

                

                <div class="contnt01 about cf">
<!--*********************************************************************************************-->
<?php
require_once('class.phpmailer.php');
if(isset($_POST['submit']))
{
$fname = $_REQUEST['fname'];
$lname = $_REQUEST['lname'];
$dob = $_REQUEST['dob'];
$address = $_REQUEST['address'];
$phone = $_REQUEST['phone'];
$mail = $_REQUEST['mail'];
$title=$_REQUEST['title'];


  
  
  $body = '<table style="border:solid 1px #0684F5; width:500px" cellpadding="8px" cellspacing="0">';
  
  $body .='<tr>';
  $body .='<td colspan="3" style="background-color:#0684F5; text-align:center; color:#FFFFFF; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">Apply</td>';
  $body .='</tr>';
  
  $body .='<tr>';
  $body .='<td style="color:#000000; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; font-weight:normal;">Name</td>';
  $body .='<td style="width:3px;">:</td><td>';
  $body .=$fname .'&nbsp;'. $lname;
  $body .='</td></tr>';
  
 

  $body .='<tr>';
  $body .='<td style="color:#000000; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; font-weight:normal;">Date of Birth</td>';
  $body .='<td style="width:3px;">:</td><td>';
  $body .=$dob;
  $body .='</td></tr>';

  /*$body .='<tr>';
  $body .='<td style="color:#000000; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; font-weight:normal;">Address</td>';
  $body .='<td style="width:3px;">:</td><td>';
  $body .=$address;
  $body .='</td></tr>';
*/
  

  /*$body .='<tr>';
  $body .='<td style="color:#000000; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; font-weight:normal;">Designation</td>';
  $body .='<td style="width:3px;">:</td><td>';
  $body .=$designation;
  $body .='</td></tr>';
  */
  $body .='<tr>';
  $body .='<td style="color:#000000; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; font-weight:normal;">Address</td>';
  $body .='<td style="width:3px;">:</td><td>';
  $body .=$address;
  $body .='</td></tr>';
  
  $body .='<tr>';
  $body .='<td style="color:#000000; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; font-weight:normal;">Phone</td>';
  $body .='<td style="width:3px;">:</td><td>';
  $body .=$phone;
  $body .='</td></tr>';
  
  
  $body .='<tr>';
  $body .='<td style="color:#000000; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; font-weight:normal;">Mail</td>';
  $body .='<td style="width:3px;">:</td><td>';
  $body .=$mail;
  $body .='</td></tr>';
  
  $body .='</table>';


$uploads = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads/cv/';
$target = $uploads;  
$target = $target . basename( $_FILES['cv']['name']) ;  
$ok=1;  

if(move_uploaded_file($_FILES['cv']['tmp_name'], $target))  
{
	$email = new PHPMailer();
	$email->From      = 'no-reply@bct.qa';
	$email->FromName  = $fname;
	$email->Subject   = 'CV-'.$title;
	$email->Body      = $body;
	$email->AddAddress('career@batec-qa.com');
	$email->IsHTML(true);

if (file_exists($target)) 
{
	$email->AddAttachment($target);    
}
$email->Send();

echo('<div class="alert alert-success" role="alert" style="color:red;">Your message has been successfully sent. We will reply soon. Thank You!</div>');

}  
else 
{ 

}
	
} 
?>
				
				<?php if(have_posts()) : while(have_posts()) : the_post(); the_content(); endwhile; endif; ?>

                <form action="<?php the_permalink(); ?>"  method="POST" enctype="multipart/form-data">
						<div class="contact-form">

                                <div class="row">
								
                                    <div class="col-sm-12">

                                        <label>First Name</label>

                                        <input type="text" class="form-control" placeholder="Your First Name Here" name="fname" required>

                                    </div>
									
									<div class="col-sm-12">

                                        <label>Last Name</label>

                                        <input type="text" class="form-control" placeholder="Your Last Name Here" name="lname" required>

                                    </div>
									
									<div class="col-sm-12">

                                        <label>Date of Birth</label>

                                        <input type="text" class="form-control" placeholder="Your Date of Birth Here" name="dob" required>

                                    </div>
									
									<div class="col-sm-12">

                                        <label>Address</label>

                                        <input type="text" class="form-control" placeholder="Your Address Here " name="address" required />

                                    </div>
									
									<div class="col-sm-12">

                                        <label>Phone</label>

                                        <input type="text" class="form-control" placeholder="Your Phone Here " name="phone" required />

                                    </div>
									
                                    <div class="col-sm-12">

                                        <label>E-mail</label>
										<input type="hidden" name="title" value="<?php  echo $title;  ?>" />	
                                        <input type="email" class="form-control" placeholder="Your Mail Here " name="mail" required />

                                    </div>
									
									
									
									
									
									
									

                                </div>

                                <div class="row">

                                    <div class="col-sm-12">

                                        <label>Attach you CV</label>

                                        <input type="file" placeholder="attach cv here" name="cv" required />

                                    </div>

                                </div>

                                
                                <div class="cf">

                                    <input type="submit" class="btn pull-left" value="SUBMIT" name="submit">

                                </div>

                            </div>
						

                             </form>    

                  </div> 

                

                

                

                

            </div>

        </section>
<?php get_footer(); ?>