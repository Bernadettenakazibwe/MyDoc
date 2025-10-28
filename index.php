<?php
session_start();
require_once __DIR__ . '/php/config.php';

// Handle login first, before any HTML output:
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Read inputs (no output yet!)
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Safer query (prepared statement). For now we compare plain text
    // because your DB stores plain passwords; later switch to password_hash/verify.
    $stmt = mysqli_prepare($con, "SELECT Id, Username, Age, Email, Password FROM users WHERE Email = ?");
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row && $password === $row['Password']) {
        $_SESSION['valid']    = $row['Email'];
        $_SESSION['username'] = $row['Username'];
        $_SESSION['age']      = $row['Age'];
        $_SESSION['id']       = $row['Id'];

        // Redirect BEFORE any HTML is sent
        header('Location: welcome1.php');
        exit;
    } else {
        $error = 'Wrong Username or Password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/style.css" />
  <title>Login</title>
  <link rel="icon" type="image/x-icon" href="assets/img" />
</head>
<body style="background-color: #f4623a;">
  <div class="container" style="background-image: url('assets/img/bg-masthead.jpg'); background-size: cover;">
    <div class="box form-box">
      <header>Login</header>

      <?php if (!empty($error)): ?>
        <div class="message"><p><?= htmlspecialchars($error) ?></p></div>
        <br />
      <?php endif; ?>

      <form action="" method="post">
        <div class="field input">
          <label for="email">Email</label>
          <input type="text" name="email" id="email" autocomplete="off" required />
        </div>

        <div class="field input">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" autocomplete="off" required />
        </div>

        <div class="field">
          <input type="submit" class="btn" name="submit" value="Login" />
        </div>

        <div class="links">
          Don't have account? <a href="register.php">Sign Up Now</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
