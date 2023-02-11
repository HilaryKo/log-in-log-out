<?php
require 'config.php';

if (!empty($_POST)) {
  $title = $_POST['title'];
  $desc = $_POST['description'];
  $created_at = $_POST['created_at'];
  $id = $_GET['id'];  //$_POST['id'];
  $pdo_statement = $pdo->prepare("UPDATE post SET title='$title', description='$desc', created_at='$created_at' WHERE id=$id");

  $result = $pdo_statement->execute();

  if ($result) {
    echo "<script>alert('Record is updated.');window.location.href='index.php';</script>";
  }

}

$pdo_statement = $pdo->prepare("SELECT * FROM post WHERE id=".$_GET['id']);

$pdo_statement->execute();

$result= $pdo_statement->fetchAll();

 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Add New Record</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
     <link rel="stylesheet" href="style.css">
   </head>
   <body>
     <div class="card">
       <div class="card-body">
         <h1>Edit Record</h1>
         <form class="" action="" method="post"> <!-- action="edit.php?id="$result[0]['id'] -->
           <!-- <input type="hidden" name="id" value="php echo $result[0]['id']"> -->
           <div class="form-group">
             <label for="username">Title</label>
             <input class="form-control" type="text" name="title" value="<?php echo $result[0]['title'] ?>" required>
           </div>
           <div class="form-group">
             <label for="username">Description</label>
             <textarea class="form-control" name="description" rows="8" cols="80"><?php echo $result[0]['description'] ?></textarea>
           </div>
           <div class="form-group">
             <label for="username">Date</label>
             <input class="form-control" type="date" name="created_at" value="<?php echo date('Y-m-d',strtotime($result[0]['created_at'])); ?>" required>
           </div>
           <div class="form-group log">
             <input type="submit" class="btn btn-primary" name="" value="Update">
             <a class="btn btn-success" href="index.php">Back</a>
           </div>
         </form>
       </div>
     </div>

   </body>
 </html>
