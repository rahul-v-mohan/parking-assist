<?php

include 'process_common.php';
include '/../../HELPERS/GMAIL/mail_function.php';
$table_name = 'booking_details';
$where['id'] = trim($_POST['id']);


    $result = $query->delete($table_name,$where);
    if (!empty($result)) {
        $_SESSION['MSG'] = 'Successfully Record Deleted';
    } else {
        $_SESSION['MSG'] = 'Somethng went wrong!!! Please try again';
    }
header("location:../booking_details.php");