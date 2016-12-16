<?php

include("connection.php");
$num_files=0;
if (isset($_POST['imgId'])) {    
    $images_array = $_POST['imgId'];
    foreach ($images_array as $image) {
        $file_id = $db->executeQuery("UPDATE `sm_company_files` SET `file_status`='0' WHERE `file_id`='$image'");
        if (!empty($file_id)) {
            $num_files= $num_files+1;
        }
    }
     echo  $num_files." File Deleted";
}