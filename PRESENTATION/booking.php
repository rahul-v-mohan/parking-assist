<?php include_once 'page_top.php'; ?>
<?php
$page_title = 'Booking';
$table_name = 'Booked details';
$action_page = 'PROCESS/booking_process.php';
?>
<?php
if(empty($_SESSION['BOOKINGDATA'])){
    header("location:search_slot.php");
}
$location = $_SESSION['BOOKINGDATA']['location'];
$vehicle_type = $_SESSION['BOOKINGDATA']['vehicle_type'];
$date = $_SESSION['BOOKINGDATA']['date'];
$start_time = $_SESSION['BOOKINGDATA']['start_time'];
$end_time = $_SESSION['BOOKINGDATA']['end_time'];
$slot_id = $_SESSION['BOOKINGDATA']['slot_id'];
$method ='booking';
$hours ='1';
$rate='0';
if(!empty($date) && !empty($start_time)&& !empty($end_time)&& !empty($vehicle_type)&& !empty($slot_id)&& !empty($location) ){
$to_time = strtotime("$date $start_time:00");
$from_time = strtotime("$date $end_time:00");

$hours  = ceil(abs($to_time - $from_time) / 3600);

$where = ['parking_area_id'=>$location,'vehicle_type'=>$vehicle_type];
$rate_perhour = $query->select('slot_rate','rate_perhour',$where);
if(!empty($rate_perhour)){
    $rate_perhour = mysqli_fetch_assoc($rate_perhour);
    $rate = $rate_perhour['rate_perhour']*$hours;
}

$where = ['S.id'=>$slot_id];
$join = ['parking_area PA'=>'PA.id = S.parking_area_id'];
$area_details = $query->select('parking_slots S','*',$where,'',$join);
$area_details = mysqli_fetch_assoc($area_details);
}

?>
<?php
  include 'header_user.php';  
?>


<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
                    <?php if (!empty($_SESSION['MSG'])) { ?>
                <div class="container">

                    <div class="alert alert-warning   alert-dismissable">
                        <strong>INFO</strong> 
                        <?php
                        echo $_SESSION['MSG'] . '.';
                        unset($_SESSION['MSG']);
                        ?> 
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    </div>
                </div>
            <?php } ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><?= $page_title ?></h4>
                    </div>
                    <div class="card-body">

                        <form id="booking" method="post" action="<?php echo $action_page; ?>">
                            <input type="hidden" class="form-control"  name="vehicle_type" value="<?php echo $vehicle_type; ?>">
                            <input type="hidden" class="form-control"  name="date" value="<?php echo $date; ?>">
                            <input type="hidden" class="form-control"  name="start_time" value="<?php echo $start_time; ?>">
                            <input type="hidden" class="form-control"  name="end_time" value="<?php echo $end_time; ?>">
                            <input type="hidden" class="form-control"  name="slot_id" value="<?php echo $slot_id; ?>">
                            <input type="hidden" class="form-control"  name="total" value="<?php echo $rate; ?>">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-4">
                                <div class="author">
                                    <p class="description "> <h5>Customer Details:</h5> </p>
                                <p class="description text-info ">Name  : <label><?php echo $_SESSION['USER']['name']; ?> </label></p>
                                <p class="description text-info">Mobile  : <label> <?php echo $_SESSION['USER']['mobile']; ?> </label> </p>
                                <p class="description text-info">Email  : <label> <?php echo $_SESSION['USER']['email']; ?> </label> </p>
                                </div>
                                </div>
                                <div class="col-md-4">
                                <div class="author">
                                    <p class="description "> <h5>Booking Deatail</h5> </p>
                                <p class="description text-info">Location  :<label> <?php echo $area_details['location'].'-'.$area_details['description']; ?></label> </p>
                                <p class="description text-info">Slot  :<label> <?php echo $area_details['slot_name']; ?> </label></p>
                                <p class="description text-info">Booking Date|Time:<label> <?php echo $date.'  |  '.$start_time.'-'.$end_time; ?></label> </p>
                                </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                <div class="author">
                                    <h4 class="description text-center text-danger">Total Fare :<label class="card-title"><?php echo $rate;?></label></h4>
                                </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill ">Book Now</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Table-->
    </div>
    <?php include 'footer.php' ?>