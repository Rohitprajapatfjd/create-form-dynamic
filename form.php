<?php session_start();
include ("./config.php");

$id = $_GET['id'];
$id = base64_decode($id);
$sql = "SELECT * FROM formlist WHERE title like '%$id%'";
$run = mysqli_query($conn,$sql);
$fetch = mysqli_fetch_all($run,MYSQLI_ASSOC);

function get_client_ip_server()
{
    $ipaddress = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if ($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if ($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if ($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if ($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if ($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';

    return $ipaddress;
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./css/style2.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <?php foreach ($fetch as $row) { ?>
        <div class="form-top">
            <div class="img">
                <img src="./img/white-outline.png" alt="" class="image-forms">
                <img src="./img/cloud.png" alt="" class="image-form cloud">
                <img src="./img/rocket.png" alt="" class="image-form rocket">
                <img src="./img/dots.png" alt="" class="image-form dots">
                <img src="./img/coin.png" alt="" class="image-form coin">
                <img src="./img/spring.png" alt="" class="image-form spring">
                <img src="./img/stars.png" alt="" class="image-form stars">
            </div>
            <p class="subtitle"><?php echo $row['subtitle'];?></p>

            <div class="social-link">
                        <i class="bx bxl-facebook facebook"></i>
                        <i class="bx bxl-whatsapp whatsapp"></i>
                        <i class="bx bxl-twitter twitter"></i><i
                            class="bx bxl-instagram instagram"></i>
                    </div>

        </div>
        <div class="form-bottom">
            <form action="./submitform.php" method="post" id="submitform" enctype="multipart/form-data">
                             
                <div class="form_title">
                    <img src="./img/best.gif" width="330" alt="">
                    <h1 id="gets" data-ip="127.000544" data-title="<?php echo $row['title']; ?>"><?php echo $row['title']?></h1>
                     <input type="hidden" class="input-field" name="ip" value="<?php echo(get_client_ip_server()) ?>" id="ip">
                     <input type="hidden" class="input-field" name="id" value="<?php echo $id?>" id="id">

                      <input type="hidden" placeholder="Username" class="input-field" name="title" id="title" value="<?php echo $row['title']; ?>" required>
                </div>
                <div class="forminputs">
                    <?php if($row['name'] == 1){?>
                    <div class="input">
                        <input type="text" placeholder="Username" class="input-field"  name="name" id="name" required>
                       
                        <i class="bx bx-user icon"></i>
                    </div>
                    <?php  }  ?>
                     <?php if($row['phoneno'] == 1){?>
                    <div class="input">
                        <input type="text" placeholder="Phoneno" class="input-field" name="phoneno" id="phoneno"
                            required>
                        <i class="bx bx-mobile icon"></i>
                    </div>
                    <?php  }  ?>
                     <?php if($row['uid'] == 1){?>
                    <div class="input">
                        <input type="text" placeholder="UID" class="input-field" name="uid" id="uid" required>
                        <i class="bx bx-ghost icon"></i>
                    </div>
                    <?php  }  ?>
                     <?php if($row['email'] == 1){?>
                    <div class="input">
                        <input type="text" placeholder="Email" class="input-field" name="email" id="email" required>
                        <i class="bx bx-mail-send icon"></i>
                    </div>
                    <?php  }  ?>
                     <?php if($row['address'] == 1){?>
                    <div class="input">
                        <input type="text" placeholder="Address" class="input-field" name="address" id="address"
                            required>
                        <i class="bx bxs-city icon"></i>
                    </div>
                    <?php  }  ?>
                     <?php if($row['gender'] == 1){?>
                    <div class="input">
                        <select name="gender" id="gender" class="input-field select-field" required>
                            <option value="">select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        
                    </div>
                    <?php  }  ?>
                     <?php if($row['dob'] == 1){?>
                    <div class="input">
                        <input type="date" placeholder="DOB" class="input-field" name="dob" id="dob" required>
                       
                    </div>
                    <?php  }  ?>
                     <?php if($row['image'] == 1){?>
                    <div class="input">
                        <input type="file"  class="input-field customFileInput" id="img-photo" name="image" required>
                        <i class="bx bx-upload icon"></i>
                    </div>
                    <?php  }  ?>
                     <?php if($row['message'] == 1){?>
                    <div class="input">
                        <textarea name="texts" id="textarea" placeholder="Message....." id="text" cols="30" class="input-field textarea" rows="10">Message.....</textarea>

                    </div>
                    <?php } ?>
                    <div class="input">
                        <button type="submit" class="submit-form"> <span>Submit</span> <i class="bx bx-right-arrow-alt"></i></button>
                        
                    </div>
                    
                    
                </div>
                <?php }   ?>
            </form>
            <?php if ($_SESSION['status'] == 'true') { ?>
                <p class="message"><?php echo $_SESSION['message'] ?></p>
                <?php session_destroy();
            } ?>
        </div>
    </div>
 <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script>
            var text = document.getElementById("textarea");
            
            if(text == null){
             document.querySelector(".container").style.height = '630px';
            }

        </script>
</body>

</html>