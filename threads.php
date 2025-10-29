<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <title>Coding Forum</title>
</head>

<body>
  <?php include 'partials/_header.php'; ?>
  <?php include 'partials/_dbconnect.php'; ?>
  <?php
  $id = $_GET['catid'];
  $sql = "SELECT * FROM `categories` WHERE category_id=$id";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
  $catname = $row['category_name'];          
  $catdesc = $row['category_description'];   
}



  ?>
  <div class="container my-4">
    <div class="jumbotron">
      <h1 class="display-4">Welcome to <?php echo $catname; ?> Python Forums</h1>
      <p class="lead"> <?php echo $catdesc; ?> </p>
      <hr class="my-4">
      <p>Be respectful.Stay on-topic.Use descriptive titles.Be constructive.
        Use appropriate language: Refrain from using obscene, offensive, or demeaning language.Give credit. </p>
      <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
    </div>
  </div>

  <div class="container">
    <h1 class="py-3">Browe Questions</h1>
    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
  $thread_id = $row['thread_id'];            
  $title = $row['thread_title'];            
  $desc = $row['thread_desc'];



      echo '<div class="media my-3">
  <img class="mr-3" src="Photos/user.png" width="45px" alt="Generic placeholder image">
  <div class="media-body">
    <h5 class="mt-0"><a class="text-dark" href="thread.php">'. $title .' </a></h5>
    '. $desc .'
  </div>
</div>';
}

    ?>
    

  </div>


  <?php include 'partials/_footer.php'; ?>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</body>

</html>