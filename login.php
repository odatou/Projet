<?php
session_start();
$host="localhost";
$dbname="bonbagay";
$dbusername="root";
$dbpassword="";
$db=new PDO("mysql:host=".$host.";dbname=".$dbname,$dbusername,$dbpassword);$db->exec('SET NAMES utf8');

if(isset($_POST['signin']))
{
  if(!empty($_POST['username'])AND! empty($_POST['password']))
  {
    $query=$db->prepare("select id_user FROM user WHERE username=:username AND password=:password");
    $query->execute(array('username'=>$_POST['username'],'password'=>$_POST['password']));
    
    if($query->rowCount() > 0)
    {
      $row=$query->fetch();
      $_SESSION['user']=$row['id_user'];
      header("Location:admin.php");
        }
        else{
          $error="Nom d'utilisateur ou mot de passe incorrect";    
        }
  }
  else
  {
    $error="veuillez remplir tous les champs!";
  }
}
?>

<html>
  <head>
    <link rel="stylesheet" href="login.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <title>Login</title>
  </head>

<body>
  <div class="main">
    <div class="main">
      <p class="sign" align="center">Login</p>
      <form class="form1" method="POST">
        <input class="form-container " type="text" align="center" placeholder="username" name="username">
        <input class="form-container" type="password" align="center" placeholder="password" name="password">
        <button class="submit" align="center" name="signin"> Login </button>  <br>    
        <?php if(isset($error)){echo $error;}?>
    </div>
    <div class="form2">
      <div class="paragraph">
        <p class="title"><span class="welcome">Welcome</span><br> to Enterprise Trucmuch</p>
      </div>
    </div>
  </div>
</body>
</html>
