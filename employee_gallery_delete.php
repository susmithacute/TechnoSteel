<?php

include("connection.php");
if (isset($_POST['imgId'])) {
     $num_files=0;
    $images_array = $_POST['imgId'];
    foreach ($images_array as $image) {
        $file_id = $db->executeQuery("UPDATE `sm_employee_files` SET `file_status`='0' WHERE `file_id`='$image'");
        if (!empty($file_id)) {
             $num_files= $num_files+1;
           
        }
    }
     echo  $num_files." File Deleted";
}