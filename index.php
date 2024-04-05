<?php session_start();
include("./config.php");

if(id == ""){
header("location:./login.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="This is a Page For Create a custom">
    <meta name="keywords" content="Create Form,Form">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Create Form</title>
</head>

<body>
    <div class="container">
        <form action="./saveform.php" method="post" id="formsubmit">
            <div class="top">
                <h1 class="heading">Create Form</h1>
                <a class="logout" href="./logout.php">Log-out</a>
                <div class="titleItem">
                    <div class="item"><label for="title">Title:</label>
                        <input type="text" name="title" id="title" placeholder="Enter The Form title" class="inputform"
                            required>
                    </div>
                    <div class="item"><label for="title">Subtitle:</label>
                        <input type="text" name="subtitle" id="subtitle" placeholder="Enter The Form subtitle"
                            class="inputform" required>
                    </div>
                </div>

            </div>
            <div class="bottom">
                <h1 class="heading1">Check the box which you Want</h1>
                <div class="bottomitem">
                    <div class="items">
                        <div>
                            <input type="text" placeholder="Enter Your Name" class="inputcheck">
                            <input type="checkbox" name="names" id="names" value="1" class="inputchecks">
                        </div>
                        <div><input type="text" placeholder="Phone Number" class="inputcheck">
                            <input type="checkbox" name="phoneno" id="phoneno" value="1" class="inputchecks" required>
                        </div>


                        <div><input type="text" placeholder="Enter Address" class="inputcheck">
                            <input type="checkbox" name="address" id="address" value="1" class="inputchecks">
                        </div>

                    </div>
                    <div class="items">
                        <div><input type="text" placeholder="Enter The UID" class="inputcheck">
                            <input type="checkbox" name="uid" id="uid" value="1" class="inputchecks">
                        </div>

                        <div><input type="text" placeholder="Email" class="inputcheck">
                            <input type="checkbox" name="email" id="email" value="1" class="inputchecks">
                        </div>

                        <div><input type="file" class="inputcheck customFileInput" placeholder="hgdgkgdk">
                            <input type="checkbox" name="file" id="file" value="1" class="inputchecks">
                        </div>
                    </div>
                    <div class="items">
                        <div><input type="text" placeholder="Gender" class="inputcheck">
                            <input type="checkbox" name="gender" id="gender" value="1" class="inputchecks">
                            <input type="hidden" name="url" id="url"
                                value="http://localhost/project/client-pg-and-csv-code/newone/form.php?id=<?php base64_encode(rand(0, 10)) ?>"
                                class="inputchecks">
                        </div>

                        <div><input type="date" placeholder="DOB" class="inputcheck">
                            <input type="checkbox" name="dob" id="dob" value="1" class="inputchecks">
                        </div>

                        <div><input type="text" class="inputcheck " placeholder="message">
                            <input type="checkbox" name="message" id="message" value="1" class="inputchecks">
                        </div>
                    </div>
                    <button id="save" class="btn">Create Form</button>
                </div>
                <div class="message"></div>
            </div>
        </form>
    </div>
    <section>
        <div class="container2">
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>Sno</th>
                            <th>Title</th>
                            <th>Urls</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("./config.php");
                        $sql2 = "SELECT * FROM formlist WHERE url != ''";
                        $run2 = mysqli_query($conn, $sql2);
                        $row = mysqli_num_rows($run2);
                        $sno = 1;
                        if ($row > 0) {
                           $fetch = mysqli_fetch_all($run2,MYSQLI_ASSOC);
                          
                           foreach($fetch as $rows){     ?>
                        <tr>
                            <td><?php echo $sno ?></td>
                            <td><?php echo $rows['title']?></td>
                            <td><a href="<?php echo $rows['url'] ?>"><?php echo $rows['url'] ?></a></td>
                        </tr>
                        <?php  $sno = $sno + 1;  }   }   ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="container3">
            <h1>Select Form to Check User Data</h1>
            <form action="userdata.php" method="post" id="user">
            <select name="titles" id="titles">
                
                <?php $title_get = "SELECT title FROM formlist";
                    $query = mysqli_query($conn,$title_get);
                    while($fetch = mysqli_fetch_assoc($query)){                     

                  ?>
               <option value="<?php echo $fetch['title']?>"><?php echo $fetch['title'] ?></option>
              
                    <?php }   ?>
            </select>
            <button class="userbtn" type="submit">Submit</button>
            </form>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $("#formsubmit").on("submit", function (e) {
                e.preventDefault();

                var urls = $(this).attr('action');
                var formdata = new FormData(this);
                console.log(formdata);
                $.ajax({
                    dataType: 'json',
                    type: 'POST',
                    url: urls,
                    data: formdata,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (resp) {
                        if (resp.status) {
                            $(".message").append("Create Sucessfully")
                            setInterval(function () {
                                $(".message").addClass("hidden");
                                location.reload();
                            }, 3000)
                        }
                    }
                })
            })
        })
    </script>
</body>

</html>