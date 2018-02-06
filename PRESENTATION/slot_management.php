<?php include_once 'page_top.php'; ?>
<?php
$page_title = 'Location Slots';
$table_name = 'Location Slot Details';
$action_page = 'PROCESS/slot_process.php';
?>
<?php 
include 'header_user.php'; 
?>

<?php
$slot_name ='';
$vehicle_type ='';
$status_check ='';
$parking_area_id ='';
$id = '0';
$method ='insert';
if(!empty($_GET['action']) && !empty($_GET['id']) ){
    if($_GET['action'] == 'edit'){
        
        $method ='update';
        $page_title = $page_title.' - Update';
        
       $result =$query->select('parking_slots','*',['id'=>$_GET['id']]) ;
       $row=  mysqli_fetch_array($result);
        $id =$row['id'];
        $slot_name =$row['slot_name'];
        $vehicle_type =$row['vehicle_type'];
        $parking_area_id =$row['parking_area_id'];
        $status_check = ($row['status'] == '1')?'checked':'';
       
    }
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
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><?= $page_title ?></h4>
                    </div>
                    <div class="card-body">

                        <form id="location_management" method="post" action="<?php echo $action_page; ?>">
                            <input type="hidden" class="form-control"  name="id" value="<?php echo $id; ?>">
                            <input type="hidden" class="form-control"  name="method" value="<?php echo $method; ?>">
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
                                        <label>Slot Name <span class="mandatory">*</span></label>
                                        <input type="text" class="form-control" id="slot_name" name="slot_name" placeholder="Enter Slot name" value="<?php echo $slot_name; ?>">
                                    </div>
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <div class="options">
                                            <label>Set To Active</label><input type="checkbox"  id="status" name="status"   value="1" <?php echo $status_check; ?> >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill pull-right">Submit</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Table-->
        <?php if(!empty($_SESSION['privilage'])){  ?>
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
                                            <th>Location Description</th>
                                            <th>Vehicle Type</th>
                                            <th>Slot Name</th>
                                            <th>Status</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            //get user details
                                            $slno = 1;
                                            $select ='PS.*,PA.location,PA.description,VT.vehicle_type ';
                                            $join =[
                                                'parking_slots PS'=>'PA.id = PS.parking_area_id',
                                                'vehicle_type VT'=>'VT.id = PS.vehicle_type',
                                                ];
                                            $result = $query->select('parking_area PA',$select,[],'',$join);
                                            if(!empty($result)){
                                            while ($row=  mysqli_fetch_assoc($result)){ 
                                                ?>
                                            <tr>
                                                <td><?php echo $slno++; ?></td>
                                                <td><?php echo $row['location'].'-'.$row['description']; ?></td>
                                                <td><?php echo $row['vehicle_type']; ?></td>
                                                <td><?php echo $row['slot_name']; ?></td>
                                                <td><?php echo $row['status']; ?></td>
                                                <td><a href="?action=edit&id=<?php echo $row['id'];?>"><button type="button" class="btn">Edit</button></a></td>
                                                <td>
                                                    <form method="post" action="<?php echo $action_page; ?>">
                                                        <input type="hidden"  id="id" name="id"   value="<?php echo $row['id']; ?>"  >
                                                        <input type="hidden"  id="method" name="method"   value="delete"  >
                                                        <button type="submit" class="btn">Delete</button>
                                                    </form>
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
                <?php } ?>
    </div>
    <?php include 'footer.php' ?>