<?php
  require './config.php';

  if(isset($_POST['submit'])){
    $uName = $_POST['uname'];
    $pass = $_POST['psw'];

    $query = "SELECT * FROM students WHERE userName = '$uName' AND psw = '$pass';";
    $result = mysqli_query($conn,$query);
    
    if($result == false){
      echo(mysqli_error($conn));
    }else{
      $user = $result->fetch_assoc();
      header('location: landing.php');
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
    <div class ='ribbon'>
      <ul class='horizontal'>
          <li><a href='adminLanding.php'>Grades</a></li>
          <li><a class='active' href='adminIntel.php'>Intel</a></li>
        </ul>
    </div>
    <hr>
  </div>
  <img src='egg.png' alt='Either Sonic stole my logo, or you are incapable of seeing how awesome it is!'>
  <p>Agent Stone, here is all of the intel we have been able to acquire through the recon team. 
    My years of research into that dreadful "Team Zeros" will soon bear fruit. If I were to ever lose this
    research, I would simply have to retire and live the rest of my years as an ACTUAL professor. Needless to say,
    DON'T lose this data!
  </p>
  <table id='bois'>
        <thead>
            <tr>
                <th>Agent</th>
                <th>Intel</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $results = mysqli_query($conn,"SELECT * FROM students LIMIT 10");
            while($row = mysqli_fetch_array($results)) {
            ?>
                <tr>
                    <td><?php echo $row['userName']?></td>
                    <td><?php echo $row['grade']?></td>
                </tr>

            <?php
            }
            ?>
            </tbody>
    </table>
</body>
</html>
