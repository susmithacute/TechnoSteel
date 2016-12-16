<?php

$cmpName = "";

$today = date('Y-m-d');

$yesterday = date('Y-m-d', strtotime("-1 days"));

$daylen = 60 * 60 * 24;

$cur_date = date("d-m-Y");
$notif_day_before = 15;
$select_day = $db->selectQuery("SELECT `notification_day` FROM `sm_notification_days` WHERE `notification_type`='Visa'");
if (count($select_day)) {
    $notif_day_before = $select_day[0]['notification_day'];
}
$cmpMail = "";
$empId = "";

$visaz = $db->selectQuery("SELECT * FROM `sm_visa` WHERE `visa_active`='1'");

if (count($visaz) > 0) {

    $values = array();

    for ($em = 0; $em < count($visaz); $em++) {
        $doc_end_date = "";
        $visaId = $visaz[$em]['visa_id'];
        $client_name = $visaz[$em]['visa_client_name'];
        $visa_email = $visaz[$em]['visa_email'];
        $applicant_name = $visaz[$em]['visa_applicant_name'];
        $visa_type = $visaz[$em]['visa_type'];
        $visa_renewal_date = $visaz[$em]['visa_renewal_date'];
        $visa_renewal_date1 = $visaz[$em]['visa_renewal_date1'];
        if ($visa_renewal_date != "0000-00-00") {
            $doc_end_date = $visaz[$em]['visa_renewal_date'];
        }if ($visa_renewal_date1 != "0000-00-00") {
            $doc_end_date = $visaz[$em]['visa_renewal_date1'];
        }
        // echo "check date not null";
        $values = array();
        if ($doc_end_date != "0000-00-00" && $doc_end_date != "") {
            $insert_doc_date = new DateTime($doc_end_date);
            $find_noti = (strtotime($doc_end_date) - strtotime($cur_date)) / $daylen;
            $num_days = round($find_noti);
            $explode_doc_end_date = explode("-", $doc_end_date);
            $ins_month_date = new DateTime($doc_end_date);
            $ins_month = $ins_month_date->format("M");
            $ins_date = $explode_doc_end_date[2] . "-" . $ins_month . "-" . $explode_doc_end_date[0];
            if ($num_days < $notif_day_before && $num_days >= 0) {
                $values['notification_start_date'] = date("Y-m-d");
                $values['visa_type'] = $visa_type;
                $values['visa_renewal_date'] = $visa_renewal_date;
                $values['visa_renewal_date1'] = $visa_renewal_date1;
                $values['visa_id'] = $visaId;
                $first_renew = $db->selectQuery("SELECT * FROM `sm_visa_notification` WHERE `visa_id` = '$visaId' AND `visa_renewal_date` = '$visa_renewal_date'");
                if (count($first_renew) > 0) {
                    for ($fc = 0; $fc < count($first_renew); $fc++) {
                        $check_date = $first_renew[$fc]['visa_renewal_date1'];
                        $check_visa_id = $first_renew[$fc]['visa_id'];
                        if ($check_date != "0000-00-00" && $check_date < $today) {
                            $values_up['notification_text'] = $visa_type . " " . "VISA for" . " " . $applicant_name . " " . " from " . " " . $client_name . ' ' . "expired " . " " . $ins_date;
                            $db->secure_update("sm_visa_notification", $values_up, "WHERE `visa_id`='$check_visa_id'");
                        }
                    }
                    $second_renew = $db->selectQuery("SELECT * FROM `sm_visa_notification` WHERE `visa_id` = '$visaId' AND `visa_renewal_date1` = '$visa_renewal_date1'");
                    if (count($second_renew) > 0) {
                        for ($sc = 0; $sc < count($second_renew); $sc++) {
                            $check_date1 = $second_renew[$sc]['visa_renewal_date1'];
                            $check_visa_id1 = $second_renew[$sc]['visa_id'];
                            if ($check_date1 != "0000-00-00" && $check_date1 < $today) {
                                $values_up['notification_text'] = $visa_type . " " . "VISA for" . " " . $applicant_name . " " . " from " . " " . $client_name . ' ' . "expired " . " " . $ins_date;
                                $db->secure_update("sm_visa_notification", $values_up, "WHERE `visa_id`='$check_visa_id1'");
                            }
                        }
                        continue;
                    } else {
                        // echo "second renew";
                        $values['notification_text'] = $visa_type . " " . "VISA for" . " " . $applicant_name . " " . " from " . " " . $client_name . ' ' . "expires on " . " " . $ins_date;

                        try {
                            $in = $db->secure_insert("sm_visa_notification", $values);
                            if (empty($in)) {
                                throw new Exception("error");
                            }
                        } catch (Exception $e) {
                            echo "#";
                        }
                        if (!empty($in)) {
                            $client_mail = 'althayeservices@gmail.com';
                            $headers = 'MIME-Version: 1.0' . "\r\n";
                            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                            $tmp = $headers;
                            $headers .= 'From:' . $client_mail . "\r\nReply-To:althayeservices@gmail.com";
                            $mail_content = "";
                            $subject1 = "Notification Alert!";
                            $mail_head = file_get_contents("mail/mail_head.php");
                            $mail_foot = file_get_contents("mail/mail_foot.php");
                            $mail_content = $mail_head . '
	  <td class="mcnTextContent" style="padding-top:0; padding-right:18px; padding-bottom:9px; padding-left:18px;" valign="top">
                        <h1>Notification Alert</h1>
                         <p>

' . $visa_type . ' ' . 'VISA for' . ' ' . $applicant_name . ' ' . ' from ' . ' ' . $client_name . ' ' . 'expires on' . ' ' . $ins_date
                                    . '
                                </p>
                        </td>
                    </tr>
	' . $mail_foot;

                            $mail_to_employee = mail($visa_email, $subject1, $mail_content, $headers);
                        }
                    }
                } else {
                    // echo "first renew";
                    $values['notification_text'] = $visa_type . " " . "VISA for" . " " . $applicant_name . " " . " from " . " " . $client_name . ' ' . "expires on " . " " . $ins_date;

                    try {
                        $in = $db->secure_insert("sm_visa_notification", $values);
                        if (empty($in)) {
                            throw new Exception("error");
                        }
                    } catch (Exception $e) {
                        echo "#";
                    }
                    if (!empty($in)) {
                        $client_mail = 'althayeservices@gmail.com';
                        $headers = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        $tmp = $headers;
                        $headers .= 'From:' . $client_mail . "\r\nReply-To:althayeservices@gmail.com";
                        $mail_content = "";
                        $subject1 = "Notification Alert!";
                        $mail_head = file_get_contents("mail/mail_head.php");
                        $mail_foot = file_get_contents("mail/mail_foot.php");
                        $mail_content = $mail_head . '
	  <td class="mcnTextContent" style="padding-top:0; padding-right:18px; padding-bottom:9px; padding-left:18px;" valign="top">
                        <h1>Notification Alert</h1>
                         <p>

' . $visa_type . ' ' . 'VISA for' . ' ' . $applicant_name . ' ' . ' from ' . ' ' . $client_name . ' ' . 'expires on' . ' ' . $ins_date
                                . '
                                </p>
                        </td>
                    </tr>
	' . $mail_foot;

                        $mail_to_employee = mail($visa_email, $subject1, $mail_content, $headers);
                    }
                }
            }
        }
    }
}
?>