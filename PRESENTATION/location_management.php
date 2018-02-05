<?php include_once 'page_top.php'; ?>
<?php
$page_title = 'Parking Location';
$table_name = 'Location Details';
$action_page = 'PROCESS/location_process.php';
?>
<?php 
include 'header_user.php'; 
?>

<?php
$location ='';
$description ='';
$status_check ='';
$id = '0';
$method ='insert';
if(!empty($_GET['action']) && !empty($_GET['id']) ){
    if($_GET['action'] == 'edit'){
        
        $method ='update';
        $page_title = $page_title.' - Update';
        
       $result =$query->select('parking_area','*',['id'=>$_GET['id']]) ;
       $row=  mysqli_fetch_array($result);
        $id =$row['id'];
        $location =$row['location'];
        $description =$row['description'];
        $status_check = ($row['status'] == '1')?'checked':'';
       
    }else if($_GET['action'] == 'delete'){
       $response =$query->delete('user','id',$_GET['id']);
       if(!empty($response)){
            $_SESSION['MSG'] = 'Deleted Successfully';
       }else{
           $_SESSION['MSG'] = 'Not able to delete';
       }
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
                                        <label>Location <span class="mandatory">*</span></label>
                                        <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location name" value="<?php echo $location; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description <span class="mandatory">*</span></label>
                                        <textarea rows="6" class="form-control" id="description" name="description" placeholder="Enter Location Description" ><?php echo $description; ?></textarea>
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
                                            <th>Location</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            //get user details
                                            $slno = 1;
                                            $result = $query->select('parking_area','*');
                                            if(!empty($result)){
                                            while ($row=  mysqli_fetch_assoc($result)){ 
                                                ?>
                                            <tr>
                                                <td><?php echo $slno++; ?></td>
                                                <td><?php echo $row['location']; ?></td>
                                                <td><?php echo $row['description']; ?></td>
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