<?php include_once 'page_top.php'; ?>
<?php
$page_title = 'Booking Details';
$table_name = 'Booking Details';
$action_page = 'PROCESS/cancel.php';
?>
<?php 
include 'header_user.php'; 
?>

<?php
if(!empty($_SESSION['privilage'])){
                                            $select =' BD.*,VT.vehicle_type,PA.location,PA.description,PS.slot_name, U.name,U.mobile,U.email ';
                                            $join =[
                                                'vehicle_type VT'=>'BD.vehicle_type = VT.id',
                                                'parking_slots PS'=>'BD.slot_id = PS.id',
                                                'user U'=>'BD.user_id = U.id',
                                                'parking_area PA'=>'PS.parking_area_id = PA.id',
                                                ];
                                            $result = $query->select(' booking_details BD ',$select,[],'',$join);
            
}else{

                                            $select =' BD.*,VT.vehicle_type,PA.location,PA.description,PS.slot_name, U.name,U.mobile,U.email ';
                                            $join =[
                                                'vehicle_type VT'=>'BD.vehicle_type = VT.id',
                                                'parking_slots PS'=>'BD.slot_id = PS.id',
                                                'user U'=>'BD.user_id = U.id',
                                                'parking_area PA'=>'PS.parking_area_id = PA.id',
                                                ];
                                            $result = $query->select(' booking_details BD ',$select,['U.id' => $_SESSION['USER']['id']],'',$join);
}
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
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    <h4 class="card-title"><?php echo $table_name;?></h4>
<!--                                    <p class="card-category">Manage users here</p>-->
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>Sl No.</th>
                                            <th>User Details</th>
                                            <th>Location Details</th>
                                            <th>Booking Details</th>
                                            <th>Booking Number</th>
                                            <th>Amount</th>
                                            <th>Cancel</th>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if(!empty($result)){
                                                $slno =1;
                                            while ($row=  mysqli_fetch_assoc($result)){ 
                                                ?>
                                            <tr>
                                                <td><?php echo $slno++; ?></td>
                                                <td><?php echo $row['name'].'<br>'.$row['mobile'].'<br>'.$row['email']; ?></td>
                                                <td><?php echo $row['location'].'-'.$row['description'].'<br>'.$row['slot_name']; ?></td>
                                                <td><?php echo $row['reservation_date'].'<br>['.$row['reservation_starttime'].'-'.$row['reservation_endtime'].']'; ?></td>
                                                <td><?php echo $row['booking_no']; ?></td>
                                                <td><?php echo $row['total_amount']; ?></td>
                                                <td>
                                                    <?php
                                                    $today =date("Y-m-d H:i:s");
                                                    $booked = $row['reservation_date'] .' '.$row['reservation_starttime'];
                                                    $date1=date_create($today);
                                                    $date2=date_create($booked);
                                                    $diff=date_diff($date1,$date2);
                                                    if($diff->format("%R") == '+'){
                                                    ?>
                                                    <form method="post" action="<?php echo $action_page; ?>">
                                                        <input type="hidden"  id="id" name="id"   value="<?php echo $row['id']; ?>"  >
                                                        <button type="submit" class="btn">Cancel</button>
                                                    </form>
                                                    <?php }else { ?>
                                                    <?php echo 'Cancellation Time over' ?>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php }}else{ ?>
                                             <tr>
                                                 <td colspan="6">No Records Found</td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                       
                    </div>
        </div>
    </div>
    </div>
    <?php include 'footer.php' ?>