<?php  
include("./config.php");
extract($_POST);

$sql ="SELECT * FROM userdata WHERE title like '%$titles%'";
$run = mysqli_query($conn,$sql);
$fetch = mysqli_fetch_all($run,MYSQLI_ASSOC);

$sql2 = "SELECT * FROM formlist WHERE title like '%$titles%'";
$run2 = mysqli_query($conn, $sql2);
$fetch2 = mysqli_fetch_all($run2, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style3.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>User Data</h1>
        <h3><?php echo $titles; ?></h3>
        <div class="table">
            <table>
                <thead>
                    <th>Sno</th>
                    <?php foreach($fetch2 as $row)  {?>
                        <?php if($row['name']=='1') { ?>
                    <th>Name</th>
                    <?php }  ?>
                     <?php if($row['phoneno']=='1') { ?>
                    <th>Phone no</th>
                    <?php }  ?>
                     <?php if($row['uid']=='1') { ?>
                    <th>UId</th>
                    <?php }  ?>
                     <?php if($row['email']=='1') { ?>
                    <th>Email</th>
                    <?php }  ?>
                     <?php if($row['address']=='1') { ?>
                    <th>Address</th>
                    <?php }  ?>
                     <?php if($row['dob']=='1') { ?>
                    <th>DOB</th>
                    <?php }  ?>                    
                     <?php if($row['image']=='1') { ?>
                    <th>Image</th>
                    <?php }  ?>
                     <?php if($row['message']=='1')  {?>
                    <th>Message</th>
                    <?php }  ?>
                     
                </thead>
                <tbody>
                    <?php  $sno = 1;
                    foreach($fetch as $row1)  {
                    ?>
                  <tr>   
                    <td><?php echo $sno ?></td>                 
                     <?php if($row['name']=='1') { ?>
                    <td><?php  echo $row1['name']?></td>
                    <?php }  ?>
                     <?php if($row['phoneno']=='1') { ?>
                    <td><?php echo $row1['phoneno'] ?>
                    </td>
                    <?php }  ?>
                     <?php if($row['uid']=='1') { ?>
                   <td><?php echo $row1['uid'] ?>
                </td>
                    <?php }  ?>
                     <?php if($row['email']=='1') { ?>
                   <td><?php echo $row1['email'] ?>
                </td>
                    <?php }  ?>
                     <?php if($row['address']=='1') { ?>
                   <td><?php echo $row1['address'] ?>
                </td>
                    <?php }  ?>
                     <?php if($row['dob']=='1') { ?>
                   <td><?php echo $row1['dob'] ?>
                </td>
                    <?php }  ?>                    
                     <?php if($row['image']=='1') { ?>
                    <td><img src="<?php echo $row1['paths']  ?>" width="200px" alt="">
                    </td>
                    <?php }  ?>
                     <?php if($row['message']=='1')  {?>
                    <td><?php echo $row1['message'] ?>
                    </td>
                    <?php }  ?>
                  </tr>
                   <?php  $sno = $sno+1;  }   ?>
                </tbody>
                <?php   }  ?>
            </table>
        </div>
    </div>
</body>
</html>