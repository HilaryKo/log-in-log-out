<?php
require 'config.php';

if (!empty($_POST)) {
    $targetFile = 'images/'.($_FILES['image']['name']);
    $imageType = pathinfo($targetFile,PATHINFO_EXTENSION);

    if ($imageType != 'jpeg' && $imageType != 'png' && $imageType != 'jpg') {
      echo "<script> alert('Image must be jpeg or png,jpg')</script>";
    }else {
      move_uploaded_file($_FILES['image']['name'],$targetFile);
    }

    $sql = "INSERT INTO post(title,description,image,created_at) VALUES (:title,:description,:image,:created_at)";

    $pdo_statement = $pdo->prepare($sql);

    $result = $pdo_statement->execute(
      array(':title'=>$_POST['title'],'description'=>$_POST['description'],
      ':image'=>$_FILES['image']['name'],'created_at'=>$_POST['created_at'])
    );
  

    if ($result) {
      echo "<script>alert('Record is added.');window.location.href='index.php';</script>";
    }



}
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
         <h1>Add New Record</h1>
         <form class="" action="add.php" method="post" enctype="multipart/form-data">
           <div class="form-group">
             <label for="username">Title</label>
             <input class="form-control" type="text" name="title" value="" required>
           </div>
           <div class="form-group">
             <label for="username">Description</label>
             <textarea class="form-control" name="description" rows="8" cols="80"></textarea>
           </div><br>
           <div class="form-group">
             <label for="">Image</label>
             <input type="file" name="image" value="" accept=".jpeg, .png, .jpg" required>
           </div>
           <div class="form-group">
             <label for="username">Date</label>
             <input class="form-control" type="date" name="created_at" value="" required>
           </div>
           <div class="form-group log">
             <input type="submit" class="btn btn-primary" name="" value="Add">
             <a class="btn btn-success" href="index.php">Back</a>
           </div>
         </form>
       </div>
     </div>

   </body>
 </html>
