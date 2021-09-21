<!DOCTYPE html >
  
<head>
    <title>Sign up</title>
    <link href="css/style.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <!-- start header div --> 
    <div id="header">
        <h3>Sign up</h3>
    </div>
    <!-- end header div -->   
      
    <!-- start wrap div -->   
    <div id="wrap">
        <!-- start PHP code -->
        <?php
          
          $con = mysqli_connect("localhost","root", "","registrations");
        
          if (mysqli_connect_errno()) {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
              exit();
            }
            if(isset($_POST['name']) && !empty($_POST['name']) AND isset($_POST['password']) && !empty($_POST['password'])) {
                $username = mysqli_real_escape_string($con, $_POST['name']); // Set variable for the username
             
                $result = mysqli_fetch_assoc(mysql_query("SELECT password FROM users WHERE active = '1' AND username = '" . $username . "'"));
                $password_hash = (isset($result['password']) ? $result['password'] : '');
                $result = password_verify($_POST['password'], $password_hash);

                if($result){
                    $msg = 'Login Complete! Thanks';
                    // Set cookie / Start Session / Start Download etc...
                }else{
                    $msg = 'Login Failed! Please make sure that you enter the correct details and that you have activated your account.';
                }
            }    
        ?>
        <!-- stop PHP Code -->
      
        <!-- title and description -->    
        <h3>Login Form</h3>
        <p>Please enter your name and password to login</p>
          
        <?php 
            if(isset($msg)){ // Check if $msg is not empty
                echo '<div class="statusmsg">'.$msg.'</div>'; // Display our message and add a div around it with the class statusmsg
            } ?>
          
        <!-- start sign up form -->   
        <form action="" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" value="" />
            <label for="password">Password:</label>
            <input type="password" name="password" value="" />
              
            <input type="submit" class="submit_button" value="Sign up" />
        </form>
        <!-- end sign up form --> 
          
    </div>
    <!-- end wrap div --> 
</body>
</html>