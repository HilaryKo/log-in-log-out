<?php
require 'config.php';

if (!empty($_POST)) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  if ($username == '' || $email == '' || $password == '') {
    echo "<script>alert('Fill the form data')</script>";
  }else{
    // query prepare
    $sql = "SELECT COUNT(email) AS num FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    // bind statement
    $stmt->bindValue(':email',$email);
    // execute statement
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row['num'] > 0) {
      echo "<script>alert('This user email already exists')</script>";
    }else{
      $passwordHash = password_hash($password,PASSWORD_BCRYPT);

      $sql = "INSERT INTO users(name,email,password) VALUES (:username,:email,:password)";
      $stmt = $pdo->prepare($sql);

      $stmt->bindValue(':username',$username);
      $stmt->bindValue(':email',$email);
      $stmt->bindValue(':password',$passwordHash);

      $result = $stmt->execute();

      if ($result) {
        echo "Thanks for your registration!".'<a href="login.php">login</a>';
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Registration Form</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="card">
      <div class="card-body">
        <h1>Register</h1>
        <form class="" action="register.php" method="post">
          <div class="form-group">
            <label for="username">Name</label>
            <input class="form-control" type="text" name="username" value="" required>
          </div>
          <div class="form-group">
            <label for="username">Email</label>
            <input class="form-control" type="email" name="email" value="" required>
          </div>
          <div class="form-group">
            <label for="username">Password</label>
            <input class="form-control" type="password" name="password" value="" required>
          </div>
          <div class="form-group log">
            <input type="submit" class="btn btn-primary" name="" value="Register">
            <a href="login.php">Login</a>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
