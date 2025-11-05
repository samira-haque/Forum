<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <style>
    #ques {
      min-height: 433px;
    }
  </style>
  <title>Coding Forum</title>
</head>

<body>
  <?php
  include 'partials/_header.php';
  include 'partials/_dbconnect.php';

  // ✅ Get thread details
  if (isset($_GET['threadid'])) {
    $id = intval($_GET['threadid']);
    $sql = "SELECT * FROM `threads` WHERE thread_id = $id";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
      $title = $row['thread_title'];
      $desc = $row['thread_desc'];
      $thread_user_id = $row['thread_user_id'];

      // Fetch user email of thread creator
      $sql2 = "SELECT user_email FROM `users` WHERE sno = '$thread_user_id'";
      $result2 = mysqli_query($conn, $sql2);
      $row2 = mysqli_fetch_assoc($result2);
      $posted_by = $row2 ? $row2['user_email'] : "Unknown User";
    } else {
      echo "No thread found.";
      exit;
    }
  } else {
    echo "Thread ID missing in URL.";
    exit;
  }
  ?>

  <div class="container my-4">
    <div class="jumbotron">
      <h1 class="display-4"><?php echo $title; ?></h1>
      <p class="lead"><?php echo $desc; ?></p>
      <hr class="my-4">
      <p>
        Be respectful. Stay on-topic. Use descriptive titles. Be constructive.
        Use appropriate language. Give credit.
      </p>
      <p><b>Posted by: <?php echo $posted_by; ?></b></p>
    </div>
  </div>

  <?php
  $showAlert = false;
  $method = $_SERVER['REQUEST_METHOD'];
  if ($method == 'POST') {
    // ✅ Insert comment into database
    $comment = $_POST['comment'];
    $sno = $_POST['sno'];

    $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`)
            VALUES ('$comment', '$id', '$sno', current_timestamp())";
    $result = mysqli_query($conn, $sql);
    $showAlert = true;

    if ($showAlert) {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> Your comment has been added.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
    }
  }
  ?>

  <div class="container">
    <h1 class="py-2">Post a Comment</h1>
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
      echo '<form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Type your comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                <input type="hidden" name="sno" value="' . $_SESSION["sno"] . '">
              </div>
              <button type="submit" class="btn btn-success">Post Comment</button>
            </form>';
    } else {
      echo '<p class="lead">You are not logged in. Please login to be able to post a comment.</p>';
    }
    ?>
  </div>

  <div class="container mb-5" id="ques">
    <h1 class="py-2">Discussions</h1>
    <?php
    $sql = "SELECT * FROM `comments` WHERE thread_id = $id";
    $result = mysqli_query($conn, $sql);
    $noResult = true;

    while ($row = mysqli_fetch_assoc($result)) {
      $noResult = false;
      $content = $row['comment_content'];
      $comment_time = $row['comment_time'];
      $comment_by = $row['comment_by'];

      $sql2 = "SELECT user_email FROM `users` WHERE sno = '$comment_by'";
      $result2 = mysqli_query($conn, $sql2);
      $row2 = mysqli_fetch_assoc($result2);
      $user_email = $row2 ? $row2['user_email'] : "Anonymous";

      echo '<div class="media my-3">
              <img class="mr-3" src="img/userdefault.png" width="45px" alt="User">
              <div class="media-body">
                <p class="font-weight-bold my-0">' . $user_email . ' at ' . $comment_time . '</p>
                ' . $content . '
              </div>
            </div>';
    }

    if ($noResult) {
      echo '<div class="jumbotron jumbotron-fluid">
              <div class="container">
                <p class="display-4">No Comments Found</p>
                <p class="lead">Be the first person to comment.</p>
              </div>
            </div>';
    }
    ?>
  </div>

  <?php include 'partials/_footer.php'; ?>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
</body>
</html>
