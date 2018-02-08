<?php

include 'process_common.php';
include '/../../HELPERS/GMAIL/mail_function.php';
$table_name = 'booking_details';
$field_values['vehicle_type'] = trim($_POST['vehicle_type']);
$field_values['booking_date'] = date('Y-m-d');
$field_values['reservation_date'] = trim($_POST['date']);
$field_values['reservation_starttime'] = trim($_POST['start_time']);
$field_values['reservation_endtime'] = trim($_POST['end_time']);
$field_values['total_amount'] = trim($_POST['total']);
$field_values['slot_id'] = trim($_POST['slot_id']);

$field_values['user_id'] = $_SESSION['USER']['id'];

//booking_no creation
    $field_values['booking_no'] = '';
    $alphabets = range('A', 'Z');
    for ($inc = 1; $inc <= 3; $inc++) {
        $temp = rand(0, 25);
        $field_values['booking_no'] .= $alphabets[$temp];
    }
    $field_values['booking_no'] .= $_SESSION['USER']['id'];
    $field_values['booking_no'] .= date('ymd');
///////////////////////////////


    $result = $query->insert($table_name, $field_values);
    if (!empty($result)) {
        //////////////////// Sending Mail/////////////////////////
        $subject = 'PARKING BOOKING DETAILS';
        $content = <<<rahul
            <h1>LOGIN DETAILS</h1>
            <p>Date: {$field_values['reservation_date']} </p>
            <p>Time: {$field_values['reservation_starttime']} - {$field_values['reservation_endtime']}</p>
            <p>Booking: {$field_values['booking_no']} </p>
rahul;
        $mail_result = mailsend($_SESSION['USER']['email'], $subject, $content);
        ////////////////////////////////////////////

        if ($mail_result == 1) {
            $_SESSION['MSG'] = 'Successfully inserted Details Send to Mail <br> <h2>Booking Number Is '.$field_values['booking_no'].'</h2>';
        } else {
            $_SESSION['MSG'] = 'Account has been created <br> <h2>Booking Number Is '.$field_values['booking_no'].'</h2>';
        }
        unset($_SESSION['BOOKINGDATA']);
    } else {
        $_SESSION['MSG'] = 'Not Inserted!!! Please try again';
    }
header("location:../search_slot.php");