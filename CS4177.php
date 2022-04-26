<?php
  require './config.php';
  session_start();

  if(isset($_POST['submit'])){
    $uName = $_POST['uname'];
    $pass = $_POST['psw'];

    $query = "SELECT userName, grade FROM students WHERE userName = '$uName' AND psw = '$pass' ";
    // inject with  username { admin'-- \ }
    // admin' AND 1=2 UNION SELECT table_schema, table_name FROM information.schema_table-- \
    // admin' AND 1=2 UNION SELECT table_schema, table_name FROM information_schema.tables WHERE table_name = 'students' -- \
    echo($query);
    $result = mysqli_query($conn,$query);
    
    if($result == false){
      echo(mysqli_error($conn));
    }else{
      if($result->num_rows == 0){
        echo 'Incorrect login.';
      }
      else{
        $user = $result->fetch_row();
        print_r($user);
        $_SESSION['grade'] = $user[1];
        $_SESSION['name'] = $user[0];

        if($user[0] == 'eggman'){
          header('location: adminLanding.php');
        }else if ($user[1] != null){
          header('location: landing.php');
        }
      }
    }
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel='stylesheet' href='login.css'> 
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'> 

</head>
<body>
  <div class='header'>
    <h2>CS4177 <br> Dr. Robotnik</h2>
    <hr>
  </div>
  <img src='egg.png' alt='Either Sonic stole my logo, or you are incapable of seeing how awesome it is!'>
  <div class="login">
    <form class="login-content" method="POST" id='login'>
      <h1> Log In </h1>
      <div class="container">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" id='uname'>
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" id='psw'>
        <button type="submit" name='submit'>Login</button>
      </div>
    </form>
  </div>
</body>
</html>
