<?php 
   session_start();

   include("db.php");
   if(!isset($_SESSION['valid'])){
    header("Location: index.php");
   }
   $id = $_SESSION['id'];
   $result = mysqli_query($con,"SELECT * FROM users WHERE id='$id'") or die("Select Error");
   $row = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/stylehome.css">
    <link rel="stylesheet" href="style/stylenav.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <title>Details</title>
</head>

<style>
    body {
      font-family: Arial, sans-serif;
    }

    table {
      background-color: white;
      border-collapse: collapse;
      margin: 20px;
    }

    th, td {
      padding: 10px;
      border: 3px solid black;
    }

    th {
      background-color: #f2f2f2;
    }

    td {
      text-align: center;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    tr:hover {
      background-color: #ddd;
    }
  </style>

<style>
        .popup {
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            display: none;
        }
        .popup-content {
            background-color: white;
            margin: 10% auto;
            padding: 20px;
            font-size: 15px;
            border: 3px solid black;
            border-radius: 20px;
            width: 30%;
            font-weight: bolder;
        }
        .popup-content button {
            display: block;
            margin: 0 auto;
        }
        .show {
            display: block;
        }
        .btn{
            width: 160px;
            height: 40px;
            background: #4070f4;
            border-radius: 5px;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
            transition: all .3s;
            padding: 0px 10px;
        }
        .txt{
            height: 40px;
            border-radius: 5px;
            font-size: 20px;
            padding: 0px 10px;
        }
        .block-display button{
            margin-bottom:5px;
            display:block;
        }
        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 5px;
        }
        input[type=text], input[type=password], input[type=date], input[type=email] {
            width: 100%;
            padding: 5px;
            margin: 5px 0 22px 0;
            font-size: 13px;
            display: inline-block;
            border: none;
            background: #f1f1f1;
        }
        input[type=text]:focus, input[type=password]:focus, input[type=date]:focus, input[type=email]:focus {
            background-color: #ddd;
            outline: none;
        }
    </style>

<body>
    <nav class="navbar">
      <div class="logo_item">
        
        <img src="logo.png">
      <label style="color: var(--white-color);">Dashboard</label>
      </div>
      <a class="navbar_content">
        <i class="bi bi-grid"></i>
        <i class="bx bx-log-out-circle" onclick="window.location.href='logout.php'">Logout</i>
      </a>
    </nav>
    
    <?php
    if($row['privilege'] == 1){
      include 'nav.php';
    }else if($row['privilege'] == 2){
      include 'nav1.php';
    }else{
      include 'nav2.php';
    }
     ?>

<script>
        var currentURL = window.location.href;
        if (currentURL.indexOf("details.php") !== -1) {
            var myButton = document.getElementById("details");
            if (myButton) {
              //myButton.style.backgroundColor = "#4070f4";
              myButton.style.backgroundColor = "green";
              myButton.style.borderRadius = "6px";
            }
        }
</script>

    <nav class="body">
      <div class="container">
        <div class="box" style="height: 600px; width: 930px; padding: 10px 10px 10px 10px; align-items: right; overflow-x: auto; overflow-y: auto;">
        <pre>        </pre>
        <table style="width: 930px; overflow-x: auto; overflow-y: auto;" id="table">
        <tr>
          <th>Id</th>
          <th>Sub No</th>
          <th>Issued Date</th>
          <th>Exp Date</th>
          <th>Reg Date</th>
          <th>Vehicle No</th>
          <th>Certificate No</th>
          <th>Time</th>
          <th>Tel No</th>
          <th>ID No</th>
          <th>Company / Name</th>
          <th>Comment</th>
          <th>Images</th>
        </tr>
        <?php 
            if(isset($_POST['searchdetails'])){
              $search=trim($_POST['search']);
              $search1=trim($_POST['search1']);
              if($search =='' && $search1 == ''){
                $s="SELECT * FROM details";
              } else{
              $s="SELECT * FROM details WHERE id='$search' OR expdate='$search1'";
              }
              $result3 = $con->query($s);

              while ($row3 = $result3->fetch_assoc()) {
                $id = $row3['id'];
                $subno = $row3['subno'];
                $issueddate = $row3['issueddate'];
                $expdate = $row3['expdate'];
                $regdate = $row3['regdate'];
                $vehicleno = $row3['vehicleno'];
                $time = $row3['time'];
                $certificateno = $row3['certificateno'];
                $telno = $row3['telno'];
                $idd = $row3['idd'];
                $name = $row3['name'];
                $comment = $row3['comment'];
                $image = $row3['image'];
                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td>$subno</td>";
                echo "<td>$issueddate</td>";
                echo "<td>$expdate</td>";
                echo "<td>$regdate</td>";
                echo "<td>$vehicleno</td>";
                echo "<td>$certificateno</td>";
                echo "<td>$time</td>";
                echo "<td>$telno</td>";
                echo "<td>$idd</td>";
                echo "<td>$name</td>";
                echo "<td>$comment</td>";
                echo "<td style='white-space: nowrap;'>";
            $imageArray = explode(",", $image);
            foreach ($imageArray as $image) {
                echo '<img src="./images/' . htmlspecialchars($image, ENT_QUOTES, 'UTF-8') . '" style="max-width: 150px; max-height: 150px; margin-right: 10px;" />';
            }
            echo "</td>";
                echo "</tr>";
              }
            }
            
          ?>
      </table>
        </div>
      <pre>        </pre>
      <form method='post' action=''>
          <div class = "block-display">
            <button type="button" class = "btn" id ="add"><pre> Add Details </pre></button>
            <pre>        </pre>
            <pre>        </pre>
            <input type="text" class = "txt" style="width: 160px;" placeholder="Search by ID" id ="search" name ="search">
            <br>
            <input type="date" class = "txt" style="width: 160px;" placeholder="Search by Date" id ="search1" name ="search1">
            <button type="submit" class = "btn" id ="searchdetails" name ="searchdetails"><pre> Search </pre></button>
            <pre>        </pre>
            <pre>        </pre>
            <input type="text" class = "txt" style="width: 160px;" placeholder="Delete" id ="deldetails" name ="deldetails">
            <button type="submit" class = "btn" id ="del" name ="del"><pre> Delete </pre></button>
            <pre>        </pre>
            <pre>        </pre>
            <button type="button" class = "btn"  onclick="window.location.href='details.php'"><pre> Refresh </pre></button>
          </div>
      </div>
    </form>
      <form method='post'  enctype="multipart/form-data" action=''>
<div id="add1" class="popup">
            <div class="popup-content">
              <div style="padding: 0px 0px 0px 300px">
                  <button id="closePopupd" type="button" class="btn" style="width: 100px;">
                    <pre> Back </pre>
                  </button>
              </div>
              <h1 style="color:black;">
                  <center><b>Add Details</b></center>
              </h1>
              <hr>
                <label for="subno"><b>Sub No</b></label>
                <input type="text" placeholder="Sub No" name="subno" id="subno">
                <br>
                <label for="issueddaate"><b>Issued Date</b></label>
                <input type="date" placeholder="Issued Date" name="issueddate" id="issueddate">
                <br>
                <label for="expdate"><b>Exp Date</b></label>
                <input type="date" placeholder="Exp Date" name="expdate" id="expdate">
                <br>
                <label for="regdate"><b>Reg Date</b></label>
                <input type="date" placeholder="Reg Date" name="regdate" id="regdate">
                <br>
                <label for="vehicleno"><b>Vehicle No</b></label>
                <input type="text" placeholder="Vehicle No" name="vehicleno" id="vehicleno">
                <br>
                <label for="certificateno"><b>Certificate No</b></label>
                <input type="text" placeholder="Certificate No" name="certificateno" id="certificateno">
                <br>
                <label for="time"><b>Time</b></label>
                <br>
                <input type="time" placeholder="Time" name="time" id="time">
                <br>
                <br>
                <label for="telno"><b>Tel No</b></label>
                <input type="text" placeholder="Tel No" name="telno" id="telno">
                <br>
                <label for="idd"><b>ID Number</b></label>
                <input type="text" placeholder="Enter ID" name="idd" id="idd">
                <br>
                <label for="name"><b>Company / Name</b></label>
                <input type="text" placeholder="Company / Name" name="name" id="name">
                <br>
                <label for="comment"><b>Comment</b></label>
                <input type="text" placeholder="Comment" name="comment" id="comment">
                <br>
                <label for="img"><b>Images</b></label>
                <br>
                <input accept="image/*" type="file" name="img[]" id="img" multiple>
              <hr>
              <button type="submit" name="reg" class="btn">Add</button>
            </div>
          </div>
</form>

<?php 
            if(isset($_POST['reg'])){
              $subno = trim($_POST['subno']);
              $issueddaate = trim($_POST['issueddate']);
              $expdate = trim($_POST['expdate']);
              $regdate = trim($_POST['regdate']);
              $vehicleno = trim($_POST['vehicleno']);
              $certificateno = trim($_POST['certificateno']);
              $time = trim($_POST['time']);
              $telno = (trim($_POST['telno']));
              $idd = trim($_POST['idd']);
              $name = trim($_POST['name']);
              $comment = trim($_POST['comment']);
              $isValid = true;
              $uploaded_images = [];

    if(isset($_FILES['img'])){
        $total_files = count($_FILES['img']['name']);
        for($i = 0; $i < $total_files; $i++){
            $image = trim($_FILES['img']['name'][$i]);
            if($image != NULL){
                $tmpName1  = $_FILES['img']['tmp_name'][$i];
                $folder = "./images/" . $image;
                if(move_uploaded_file($tmpName1, $folder)){
                    $uploaded_images[] = $image;
                } else {
                    $isValid = false;
                    echo "Sorry, there was an error uploading your file: $image";
                    break;
                }
            }
        }
    }

              if($isValid){
                $images = implode(",", $uploaded_images);
                $insertSQL = "INSERT INTO `details`(`subno`, `issueddate`, `expdate`, `regdate` , `vehicleno`, `certificateno`, `time`, `telno`, `idd`, `name`, `comment`, `image`) values(?,?,?,?,?,?,?,?,?,?,?,?)";
                $stmt = $con->prepare($insertSQL);
                $stmt->bind_param("ssssssssssss",$subno,$issueddaate,$expdate,$regdate,$vehicleno,$certificateno,$time,$telno,$idd,$name,$comment,$images);
                $stmt->execute();
                $stmt->close();
                echo '<script>alert("Details Addedd successfully.")</script>';
              }
           }
          ?>

<?php 
            if(isset($_POST['del'])){
              $id = trim($_POST['deldetails']);
           
              $isValid = true;
           
              if($id == ''){
                $isValid = false;
                echo '<script>alert("Please fill ID.")</script>';
              }
           
              if($isValid){
                $insertSQL = "DELETE FROM `details` WHERE id = $id";
                $stmt = $con->prepare($insertSQL);
                $stmt->execute();
                $stmt->close();
                echo '<script>alert("User Deleted successfully.")</script>';
              }
           }
          ?>

    </nav>

    <!-- JavaScript -->
    <script src="javascript/script.js"></script>
    <script>
        add.addEventListener("click", function () {
            add1.classList.add("show");
        });
        closePopupd.addEventListener("click", function () {
            add1.classList.remove("show");
        });
      </script>
  </div>
</body>
</html>