<?php 
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <title>How To Drive</title>
</head>

<body>
      <div class="container" style="background: #333; height: 100vh;">
        <img src="logo1.png" width="820" height="550" style="border-radius: 20px;">

        <div style="color: #333 white-space:pre;"><pre>                 </pre></div>

        <div class="box form-box" style="background: #fff;">
            <?php 
             
              include("db.php");
              if(isset($_POST['submit'])){
                $username = mysqli_real_escape_string($con,$_POST['username']);
                $password = mysqli_real_escape_string($con,$_POST['password']);
                $pass = sha1($password);
                $result = mysqli_query($con,"SELECT * FROM users WHERE username='$username' AND Password='$pass' ") or die("Select Error");
                $row = mysqli_fetch_assoc($result);
                $id = $row['id'];

                if(is_array($row) && !empty($row)){
                    $_SESSION['valid'] = $row['username'];
                    $_SESSION['id'] = $id;
                    if(isset($_SESSION['valid'])){
                        header("Location: home.php");
                    }
                }else{
                    echo "<div class='message'>
                      <p><b>Wrong Username or Password</b></p>
                       </div> ";
                   echo "<a href='index.php'><center><button class='btn'>Go Back</button></center>";
                }
                
              }else{

            ?>
            <header style="background: #fff;"><center style="background: #fff;">Login</center></header>
            <form action="" method="post" style="background: #fff;">
                <div class="field input" style="background: #fff;">
                    <label for="username" style="background: #fff;"><b style="background: #fff;"><pre>Username                           </pre></b></label>
                    <input type="text" name="username" id="username" autocomplete="off" required style="background: #fff;">
                </div>

                <div class="field input" style="background: #fff;">
                    <label for="password" style="background: #fff;"><b style="background: #fff;"><pre>Password                                  </pre></b></label>
                    <input type="password" name="password" id="password" autocomplete="off" required style="background: #fff;">
                </div>

                <div class="field" style="background: #fff;">
                    
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>