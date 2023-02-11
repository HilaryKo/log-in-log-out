<?php
session_start();
require 'config.php';


if (!empty($_POST)) {

  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE email = :email";
  $stmt = $pdo->prepare($sql);

  $stmt->bindValue(':email',$email);

  $stmt->execute();

  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if (empty($user)) {
    echo "<script>alert('Incorrect credentials, Try Again')</script>";
  }else{
    $validPassword = password_verify($password,$user['password']);
    if ($validPassword) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['logged_in'] = time();

      header('Location: index.php');
      exit();
    }else{
      echo "<script>alert('Incorrect credentials, Try Again')</script>";
    }
  }


}
?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Login Page</title>
   </head>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
   <link rel="stylesheet" href="style.css">
   <body>
     <div class="card">
       <div class="card-body">
         <h1>LogIn</h1>
         <form class="" action="login.php" method="post">
           <div class="form-group">
             <label for="username">Email</label>
             <input class="form-control" type="email" name="email" value="" required>
           </div>
           <div class="form-group">
             <label for="username">Password</label>
             <input class="form-control" type="password" name="password" value="" required>
           </div>
           <div class="form-group log">
             <input type="submit" class="btn btn-primary" name="" value="Login">
             <a href="register.php">Register</a>
           </div>
         </form>
       </div>
     </div>
   </body>
 </html>
