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
    <title>Home</title>
</head>
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
        if (currentURL.indexOf("home.php") !== -1) {
            var myButton = document.getElementById("home");
            if (myButton) {
              //myButton.style.backgroundColor = "#4070f4";
              myButton.style.backgroundColor = "green";
              myButton.style.borderRadius = "6px";
            }
        }
</script>

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

    <nav class="body">
      <div class="container">
      <div class="box" style="height: 600px; width: 1730px; padding: 10px 10px 10px 10px; align-items: right; overflow-x: auto; overflow-y: auto;">
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
              $s = "SELECT * FROM details WHERE expdate BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 10 DAY)";
              
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
            
          ?>
      </table>

      <?php 
      
      ?>
        </div>
      <pre>        </pre>
    </nav>
      </div>

    <!-- JavaScript -->
    <script src="javascript/script.js"></script>
  </div>
</body>
</html>