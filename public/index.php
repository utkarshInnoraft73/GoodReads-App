<?php

require('./../vendor/autoload.php');
require('./../ConnectDb/ConnectDb.php');
require('./../User.php');

/**
 * @var array $errors;
 *   To check the any error related to user crediential.
 */
$errors['userNotFound'] = $errors['invalidPassword'] = $errors['nullCred'] = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

  // Create the instanse of class User.
  $user = new User();

  // Call the validation method from user class.
  $user->validations($_POST['email'], 'email', $_POST['password'], 'password');

  // Get he email;
  $email = $user->getEmail();

  // Get Password.
  $password = $_POST['password'];

  if ($email != NULL && $password != NULL) {
    try {

      // Connect the db.
      $db = new ConnectDB();
      $conn = $db->connectDB();
      $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");

      if (!$stmt) {
        throw new Exception("Failed to prepare statement.");
      }
      $stmt->bindParam(1, $email, PDO::PARAM_STR);
      $stmt->execute();

      // Fetch the result.
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($result) {

        // Verify the entered password against the hashed password from the database.
        if ($password  == $result['password']) {
          if ($result['user_type'] == 'reader') {
            session_start();
            $_SESSION['user_id'] = $result['id'];
            $_SESSION['user_name'] = $result['name'];
            $_SESSION['user_email'] = $result['email'];
            header('Location: ./hello.php');
          }
          else {
            session_start();
            $_SESSION['user_id'] = $result['id'];
            $_SESSION['user_name'] = $result['name'];
            header('Location: ./Admin.php');
          }
        } else {
          $errors['invalidPassword'] = "Password is invalid.";
        }
      }
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  } else {
    $errors["nullCred"] = "Please enter correct credential.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- Linked custom CSS. -->
  <link rel="stylesheet" href="./Style.css">
  <!-- Linked font awesome. -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="./../../JS/script.js"></script>
</head>

<body>
  <section class="wrapper">
    <div class="container">
      <div class="registerContent d-flex justify-center item.center flex-col">
        <div class="innerContent ">
          <h3 class="roboto-bold">Login here</h3>
          <em style="color:red;">
            <?php
            echo $errors['userNotFound'];
            echo $errors['invalidPassword'];
            echo $errors['nullCred'];
            ?>
          </em>
          <hr>
          <form action="" method="post" id="form">
            <div class="formDiv">
              <input class="roboto-light" type="email" id="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($_POST['email'] ?? '') ?>">
              <i class="fa-solid fa-check"></i>
              <i class="fa-solid fa-circle-exclamation"></i>
              <small class="roboto-light">Error msg</small>
            </div>
            <div class="formDiv">
              <input class="roboto-light" type="password" id="password" name="password" placeholder="Password">
              <i class="fa-solid fa-check"></i>
              <i class="fa-solid fa-circle-exclamation"></i>
              <small class="roboto-light">Error msg</small>
            </div>
            <input type="submit" value="Submit" class="submitBtn roboto-medium">
          </form>
        </div>
      </div>
    </div>
  </section>
</body>

</html>
