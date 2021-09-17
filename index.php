<!DOCTYPE html >
  
<head>
    <title> Sign up</title>
    <link href="css/style.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <!-- start header div -->
    <div id="header">
        <h3> Sign up</h3>
    </div>
    <!-- end header div -->  
      
    <!-- start wrap div -->  
    <div id="wrap">
          
        <!-- start php code -->
        <?php
        $con = mysqli_connect("localhost","root", "","registrations");
        //mysql_connect("localhost", "username", "password") or die(mysql_error()); // Connect to database server(localhost) with username and password.
        //mysql_select_db("registrations") or die(mysql_error()); // Select registrations database.
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
          }

          if(isset($_POST['name']) && !empty($_POST['name']) AND isset($_POST['email']) && !empty($_POST['email'])){
            // Escape special characters, if any
            $name = mysqli_real_escape_string($con, $_POST['name']); // Turn our post into a local variable
            $email = mysqli_real_escape_string($con, $_POST['email']); // Turn our post into a local variable
            if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
                // Return Error - Invalid Email
                $msg = 'The email you have entered is invalid, please try again.';
            }else{
                // Return Success - Valid Email
                $msg = 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';
                $hash = md5( rand(0,1000) ); // Generate random 32 character hash and assign it to a local variable.
                // Example output: f4552671f8909587cf485ea990207f3b
                $password = rand(1000,5000); // Generate random number between 1000 and 5000 and assign it to a local variable.
                // Example output: 4568
                $passwordhash = password_hash($password);
                $sql="INSERT INTO users (username, password, email, hash) VALUES ('$name', '$passwordhash', '$email','$hash' )";
                if (!mysqli_query($con, $sql)) {
                    printf("%d Row inserted.\n", mysqli_affected_rows($con));
                  }
                  
                  mysqli_close($con);
            }
        }
        /*---------------------------------------------------------

      
          if(isset($_POST['name']) && !empty($_POST['name']) AND isset($_POST['email']) && !empty($_POST['email'])){
            // Escape special characters, if any
            $name = mysql_escape_string($_POST['name']); // Turn our post into a local variable
            $email = mysql_escape_string($_POST['email']); // Turn our post into a local variable
            if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
                // Return Error - Invalid Email
                $msg = 'The email you have entered is invalid, please try again.';
            }else{
                // Return Success - Valid Email
                $msg = 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';
                $hash = md5( rand(0,1000) ); // Generate random 32 character hash and assign it to a local variable.
                // Example output: f4552671f8909587cf485ea990207f3b
                $password = rand(1000,5000); // Generate random number between 1000 and 5000 and assign it to a local variable.
                // Example output: 4568
                mysql_query("INSERT INTO users (username, password, email, hash) VALUES(
                    '". mysql_escape_string($name) ."', 
                    '". mysql_escape_string(password_hash($password)) ."', 
                    '". mysql_escape_string($email) ."', 
                    '". mysql_escape_string($hash) ."') ") or die(mysql_error());
            }
        }
        /*---------------------------------------------------------*/    
        ?> 
        <!-- stop php code -->
      
        <!-- title and description -->   
        <h3>Signup Form</h3>
        <p>Please enter your name and email addres to create your account</p>
        <?php 
            if(isset($msg)){  // Check if $msg is not empty
            echo '<div class="statusmsg">'.$msg.'</div>'; // Display our message and wrap it with a div with the class "statusmsg".
            } 
        ?>  
        <!-- start sign up form -->  
        <form action="" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" value="" />
            <label for="email">Email:</label>
            <input type="text" name="email" value="" />
              
            <input type="submit" class="submit_button" value="Sign up" />
        </form>
        <!-- end sign up form -->
          
    </div>
    <!-- end wrap div -->
</body>
</html>