<?php
// To connect with the database connection file
session_start();
include "db.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer autoload file
require 'PHPmailer/src/Exception.php';
require 'PHPmailer/src/PHPMailer.php';
require 'PHPmailer/src/SMTP.php';

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    // Check if email exists in the database
    $query = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        echo '
        <style>
            .container {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            .error-message {
                background-color: #f8d7da;
                border: 1px solid #f5c6cb;
                color: #721c24;
                padding: 15px;
                border-radius: 5px;
                width: 300px;
                text-align: center;
                box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            }

            .error-message p {
                margin: 0;
            }

            .back-button {
                background-color: #007bff;
                color: #fff;
                border: none;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
                margin-top: 15px;
            }

            .back-button:hover {
                background-color: #0056b3;
            }
        </style>
        <div class="container">
            <div class="error-message">
                <p>Email already exists</p>
                <button class="back-button" onclick="window.location.href=\'Registerform.php\'">Go Back</button>
            </div>
        </div>';
    } else {
        
    $username = $_POST['username'];
    $password = $_POST['password'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $email = $_POST['email'];
 
    // Generate verification code
    $verification_code = bin2hex(random_bytes(32));

    // Value for the field
  $sql = "INSERT INTO user (username, password, lastname, firstname, middlename, email, verification_code, active, status)
        VALUES ( '$username','$password','$lastname','$firstname','$middlename','$email','$verification_code', 'inactive', 'status')";
    if (mysqli_query($conn, $sql)) {
        // SMTP configuration
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // SMTP server address
        $mail->SMTPAuth = true;
        $mail->Username = 'punaycholo@gmail.com';  // SMTP username
        $mail->Password = 'qfipuquvkeelvfnn';  // SMTP password
        $mail->SMTPSecure = 'tls';          // Enable TLS encryption
        $mail->Port = 587;                  // TCP port to connect to

        // Email content
        $mail->setFrom('punaycholo@gmail.com');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Email Verification';
        $mail->Body = 'Please click the "verify" link to verify your email: <a href="http://localhost/userprofile/verified.php?email=' . $email . '&code=' . $verification_code . '">Verify</a>';

        // Send email
        try {
            $mail->send();

            header("Location: sent_notice.php?message=Verification email sent. Please check your email to verify your account.");
        } catch (Exception $e) {
            header("Location: Registerform.php?error=Failed to send verification email. Please try again later.");
        }
    } else {
        echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
    }
}
}
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page</title>

 <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <form action="registerform.php" method="post">
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="registerform.php" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="Username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <?php if (isset($username_err)): ?>
            <span class="text-danger"><?php echo $username_err; ?></span>
          <?php endif; ?>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="lastname" placeholder="Last Name" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <?php if (isset($lastname_err)): ?>
            <span class="text-danger"><?php echo $lastname_err; ?></span>
          <?php endif; ?>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="firstname" placeholder="First Name" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <?php if (isset($firstname_err)): ?>
            <span class="text-danger"><?php echo $firstname_err; ?></span>
          <?php endif; ?>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="middlename" placeholder="Middle Name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <?php if (isset($middlename_err)): ?>
            <span class="text-danger"><?php echo $middlename_err; ?></span>
          <?php endif; ?>
        </div>

        

        <div class="input-group mb-3">
    <input type="email" class="form-control" name="email" placeholder="Email" required>
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-envelope"></span>
        </div>
    </div>
</div>
<?php if (isset($email_err)): ?>
    <span class="text-danger" style="font-size: 12px;"><?php echo $email_err; ?></span>
<?php endif; ?>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <?php if (isset($password_err)): ?>
            <span class="text-danger"><?php echo $password_err; ?></span>
          <?php endif; ?>
        </div>
        
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree" required <?php echo isset($_POST['terms']) ? 'checked' : ''; ?>>
              <label for="agreeTerms">
               I agree to the <a href="registerform.php">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>

      <a href="login-v2.php" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>