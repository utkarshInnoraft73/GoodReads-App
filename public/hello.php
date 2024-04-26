<?php

/**
 * Start session.
 */
session_start();
$userName = $_SESSION['user_name'];
$userEmail = $_SESSION['user_email'];
$userBook = $_SESSION['book_read'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Linked font awesome. -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- Custom script file for form validation. -->
  <script src="../../JS/script.js"></script>
  <!-- <script src="script.js"></script> -->
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./Home.php">Home</a>
          </li>
        </ul>
        <a class="roboto-medium me-5 btn btn-danger" href="./logout.php">Log out</a>
      </div>
    </div>
  </nav>
  <section class="wrapper">
    <div class="container mt-5">
      <div class="card text-center">
        <div class="card-header">
          <h5 class="card-title">Welcome <?php echo "$userName"; ?></h5>
        </div>
        <div class="card-body">
          <p>Your Email : <?php echo "$userEmail"; ?></p>
          <p class="card-text">Continue reading Your books <a href="./continueReading.php">Here</a></p>
          <p class="card-text">Books that you should read <a href="./AllBooks.php">Here</a></p>
          <a href="./Home.php" class="btn btn-primary">Go Home</a>
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
