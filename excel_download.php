<?php

$zipname = $_REQUEST['excel_name'];
header('Content-Type: application/zip');
header('Content-disposition: attachment; filename=' . $zipname);
header('Content-Length: ' . filesize($zipname));
readfile($zipname);
unlink($zipname);
