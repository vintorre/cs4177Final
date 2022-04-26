<?php
  require './config.php';
  session_start();

  if(isset($_POST['submit'])){
    $pdf = $_FILES['file']['name'];
    $pdf_type = $_FILES['file']['type'];
    $pdf_size = $_FILES['file']['size'];
    $pdf_tem_loc = $_FILES['file']['tmp_name'];
    $pdf_store ="pdf/".$pdf;

    move_uploaded_file($pdf_tem_loc,$pdf_store);

    $sql="INSERT INTO pdf_file(pdf) values('$pdf')";
    $query=mysqli_query($conn,$sql);
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
  <h2> Student: <?php echo($_SESSION['grade']); ?>  </h2>
  <h2> Your grade: <?php echo($_SESSION['grade']); ?> <p style="color: #C2C2C2;"> MAKE SURE TO CHANGE YOUR PASSWORD FROM MMDD TO SOMETHING MORE COMPLEX</p></h2>
  <form class="login-content" method="POST" id='login' ecntype='multipart/form-data'>
    <div class="container">
      <a href='encrypt.exe' download '>
        <button type='button'>Download Encryption.exe</button>
      </a>
        <h1> Submit your "Hedgehog Intel Assignment", due 4/28 6:00PM </h1>
        <h3> Your submission MUST be a .txt and MUST be encrypted.
         Non-encrypted and non-txt files will receive NO CREDIT.</h3>
        <input type='file' name='file'>
        <button type='submit' name='submit'>Submit</button>
    </div>
  </form>
</body>
</html>
