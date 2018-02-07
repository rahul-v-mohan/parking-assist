<?php include_once 'page_top.php'; ?>
<?php
$page_title = 'Search Slot';
$table_name = 'Search Slot Details';
$action_page = 'PROCESS/search_process.php';
?>
<?php 
if(!empty($_SESSION['USER'])){
include 'header_user.php'; 
}else{
 include 'header_site.php';    
}
?>
<?php
$script_path =[
    'JS/search_slot.js',
    ];
?>
<?php
$location =(!empty($_GET['location']))?$_GET['location']:'';
$vehicle_type =(!empty($_GET['vehicle_type']))?$_GET['vehicle_type']:'';
$date =(!empty($_GET['date']))?$_GET['date']:'';
$start_time =(!empty($_GET['start_time']))?$_GET['start_time']:'';
$end_time =(!empty($_GET['end_time']))?$_GET['end_time']:'';

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

                        <form id="search_slot" method="post" action="<?php echo $action_page; ?>">
                             <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Locations <span class="mandatory">*</span></label>
                                        <?php $getlocation =$query->select('parking_area','*',['status' =>'1']); ?>
                                        <select class="form-control" id="parking_area_id" name="parking_area_id">
                                            <option value="" >Select</option>
                                           <?php while($value=  mysqli_fetch_assoc($getlocation)){ ?> 
                                           <?php $select =($value['id'] ==$parking_area_id)?'selected':''; ?> 
                                            <option value="<?php echo $value['id']; ?>" <?php echo $select; ?>><?php echo $value['location'].'-'.$value['description']; ?></option>
                                           <?php } ?> 
                                        </select>
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Vehicle Type <span class="mandatory">*</span></label>
                                        <?php $getvehicle_type =$query->select('vehicle_type','*',['status' =>'1']); ?>
                                        <select class="form-control" id="vehicle_type" name="vehicle_type">
                                            <option value="" >Select</option>
                                           <?php while($value=  mysqli_fetch_assoc($getvehicle_type)){  ?> 
                                           <?php $select =($value['id'] ==$vehicle_type)?'selected':''; ?> 
                                            <option value="<?php echo $value['id']; ?>" <?php echo $select; ?>><?php echo $value['vehicle_type']; ?></option>
                                           <?php } ?> 
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Date<span class="mandatory">*</span></label>
                                        <input type="text" class="form-control" id="date" name="date" placeholder="YYYY-MM-DD" value="<?php echo $date; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start Time<span class="mandatory">*</span></label>
                                        <input type="text" class="form-control" id="start_time" name="start_time" placeholder="HH:MM" value="<?php echo $start_time; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>End Time<span class="mandatory">*</span></label>
                                        <input type="text" class="form-control" id="end_time" name="end_time" placeholder="HH:MM" value="<?php echo $end_time; ?>">
                                    </div>
                                </div>
                            </div>
                            <button type="button" id="search-slot" class="btn btn-info btn-fill pull-right">Search</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
<div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    <h4 class="card-title"><?php echo $table_name;?></h4>
<!--                                    <p class="card-category">Manage users here</p>-->
                                </div>
                                <div class="card-body table-full-width table-responsive" id="slot-search-area">
                                    <!--ajax result here-->
                                </div>
                            </div>
                        </div>
                       
                    </div>
        </div>
        <!--Table-->
        
    </div>
    <?php include 'footer.php' ?>