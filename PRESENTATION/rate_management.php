<?php include_once 'page_top.php'; ?>
<?php
$page_title = 'Rate Management';
$table_name = 'Rate Details';
$action_page = 'PROCESS/rate_process.php';
?>
<?php 
include 'header_user.php'; 
?>

<?php
$rate_perhour ='';
$vehicle_type ='';
$parking_area_id ='';
$id = '0';
$method ='insert';
if(!empty($_GET['action']) && !empty($_GET['id']) ){
    if($_GET['action'] == 'edit'){
        
        $method ='update';
        $page_title = $page_title.' - Update';
        
       $result =$query->select('slot_rate','*',['id'=>$_GET['id']]) ;
       $row=  mysqli_fetch_array($result);
        $id =$row['id'];
        $rate_perhour =$row['rate_perhour'];
        $vehicle_type =$row['vehicle_type'];
        $parking_area_id =$row['parking_area_id'];
       
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
                                        <label>Rate Per Hour <span class="mandatory">*</span></label>
                                        <input type="text" class="form-control" id="rate_perhour" name="rate_perhour" placeholder="Enter Rate" value="<?php echo $rate_perhour; ?>">
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
                                            <th>Rate Per Hour</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            //get user details
                                            $slno = 1;
                                            $select ='SR.*,PA.location,PA.description,VT.vehicle_type ';
                                            $join =[
                                                'parking_area PA'=>'PA.id = SR.parking_area_id',
                                                'vehicle_type VT'=>'VT.id = SR.vehicle_type',
                                                ];
                                            $result = $query->select('slot_rate SR',$select,[],'',$join);
                                            if(!empty($result)){
                                            while ($row=  mysqli_fetch_assoc($result)){ 
                                                ?>
                                            <tr>
                                                <td><?php echo $slno++; ?></td>
                                                <td><?php echo $row['location'].'-'.$row['description']; ?></td>
                                                <td><?php echo $row['vehicle_type']; ?></td>
                                                <td><?php echo $row['rate_perhour']; ?></td>
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