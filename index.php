<?php

  session_start();
  require 'config.php';



  if (empty($_SESSION['user_id']) || empty($_SESSION['logged_in'])) {
    echo "
    <script>
    alert('Please login to continue');
    window.location.href='login.php';
    </script>
    ";
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home Page</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php
      $pdo_statement = $pdo->prepare("SELECT * FROM post ORDER BY id DESC");
      $pdo_statement->execute();
      $result = $pdo_statement->fetchAll();

    ?>
    <div class="card">
      <div class="card-body">
        <table class="table table-striped">
          <h1>Post Management</h1>
          <div>
            <a class="btn btn-primary" href="add.php">Creat New</a>
            <a style="float:right" class="btn btn-warning" href="logout.php">Logout</a>
          </div><br>
          <thead>
            <tr>
              <th width="20%">Title</th>
              <th width="40%">Description</th>
              <th width="20%">Created At</th>
              <th width="10%">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($result) {
              foreach ($result as $value) {
            ?>
            <tr>
              <td><?php echo $value['title'] ?></td>
              <td><?php echo $value['description'] ?></td>
              <td><?php echo date('d-m-Y',strtotime($value['created_at']))?></td>
              <td>
                <a href="edit.php?id=<?php echo $value['id']?>">Edit</a>
                <a href="delete.php?id=<?php echo $value['id']?>">Delete</a>
              </td>
            </tr>
            <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>
