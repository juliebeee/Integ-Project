<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Login</title>
  <style>
    body {
      background-image: url(../login/images/gasan.png);
      background-repeat: no-repeat;
      background-size: cover;
      background-position: fixed;
      font-family: Arial, sans-serif;
      background-color: #F4E1AB;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    h1 {
      color: #333;
      font-family: Broadway;
      font-weight: bold;
      font-size: 80px;
      text-align: center;
      position: fixed;
      top: 50px;
      left: 50%;
      transform: translateX(-50%);
    }

    form {
      margin-top: 100px;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 300px;
      margin: 0 auto;
    }

    label {
      display: block;
      margin-bottom: 10px;
      color: #555;
    }

    input[type="text"], input[type="password"] {
      width: calc(100% - 20px);
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-bottom: 15px;
    }

    button, input[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #D0A074;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button:hover, input[type="submit"]:hover {
      background-color: #3C2621;
    }

    .error-message {
      color: red;
      text-align: center;
      margin-bottom: 10px;
    }

    .forgot-password {
      text-align: center;
      margin-top: 10px;
    }

    .forgot-password a {
      color: #333;
      text-decoration: none;
    }

    .forgot-password a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <h1>Student Login</h1>

  <?php
  session_start();

  // Database configuration
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "student_system";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $error_message = "";
  $show_password_form = false;
  $show_create_password_form = false;

  // Check if the form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (isset($_POST['name']) && isset($_POST['student_id_no'])) {
          // Retrieve name and student ID from form
          $name = $_POST['name'];
          $student_id_no = $_POST['student_id_no'];

          $found = false;
          $tables = ['secondyear', 'thirdyear', 'fourthyear'];

          foreach ($tables as $table) {
              $sql = "SELECT * FROM $table WHERE student_id_no=? AND full_name=?";
              $stmt = $conn->prepare($sql);
              if ($stmt === false) {
                  die("MySQL Error: " . $conn->error);
              }
              $stmt->bind_param("ss", $student_id_no, $name);
              $stmt->execute();
              $result = $stmt->get_result();

              if ($result->num_rows > 0) {
                  $found = true;
                  $_SESSION['student_id_no'] = $student_id_no;
                  $_SESSION['table_name'] = $table; // Save the table name
                  break;
              }
          }

          if ($found) {
              // Check if the student already has a password
              $sql_password = "SELECT password FROM $table WHERE student_id_no=?";
              $stmt_password = $conn->prepare($sql_password);
              if ($stmt_password === false) {
                  die("MySQL Error: " . $conn->error);
              }
              $stmt_password->bind_param("s", $student_id_no);
              $stmt_password->execute();
              $result_password = $stmt_password->get_result();

              if ($result_password->num_rows > 0) {
                  $row = $result_password->fetch_assoc();
                  if (!empty($row['password'])) {
                      // Student has already created a password, proceed to login
                      $show_password_form = true;
                  } else {
                      // Student does not have a password, show form to create one
                      $show_create_password_form = true;
                  }
              }

              $stmt_password->close();
          } else {
              $error_message = "Invalid name or student ID!";
          }

          $stmt->close();
      } elseif (isset($_POST['password']) && isset($_SESSION['student_id_no']) && isset($_SESSION['table_name'])) {
          // Handle password verification
          $student_id_no = $_SESSION['student_id_no'];
          $password = $_POST['password'];
          $table_name = $_SESSION['table_name'];

          // Check if the provided password matches the one in the database
          $sql_verify_password = "SELECT password FROM $table_name WHERE student_id_no=?";
          $stmt_verify_password = $conn->prepare($sql_verify_password);
          if ($stmt_verify_password === false) {
              die("MySQL Error: " . $conn->error);
          }
          $stmt_verify_password->bind_param("s", $student_id_no);
          $stmt_verify_password->execute();
          $result_verify_password = $stmt_verify_password->get_result();

          if ($result_verify_password->num_rows > 0) {
              $row = $result_verify_password->fetch_assoc();
              $hashed_password = $row['password'];

              if (password_verify($password, $hashed_password)) {
                  // Password verified, redirect to dashboard
                  header("Location: ../student/student_dashboard.html");
                  exit();
              } else {
                  // Wrong password
                  $error_message = "Incorrect password.";
              }
          }

          $stmt_verify_password->close();
      } elseif (isset($_POST['new_password']) && isset($_SESSION['student_id_no']) && isset($_SESSION['table_name'])) {
          // Handle new password creation
          $student_id_no = $_SESSION['student_id_no'];
          $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
          $table_name = $_SESSION['table_name'];

          // Update the password in the database
          $sql_update_password = "UPDATE $table_name SET password=? WHERE student_id_no=?";
          $stmt_update_password = $conn->prepare($sql_update_password);
          if ($stmt_update_password === false) {
              die("MySQL Error: " . $conn->error);
          }
          $stmt_update_password->bind_param("ss", $new_password, $student_id_no);
          $stmt_update_password->execute();

          if ($stmt_update_password->affected_rows > 0) {
              // Password updated successfully, prompt user to login
              $show_password_form = true;
              $show_create_password_form = false;
          } else {
              $error_message = "Failed to create a new password.";
          }

          $stmt_update_password->close();
      }
  }

  $conn->close();
  ?>

  <?php if (!$show_password_form && !$show_create_password_form) { ?>
    <form id="loginForm" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="student_id_no">Student ID:</label>
        <input type="text" id="student_id_no" name="student_id_no" required><br>
        <?php if (!empty($error_message)) { ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php } ?>
        <button type="submit">Verify my Account</button>
    </form>
  <?php } ?>

  <?php if ($show_create_password_form) { ?>
    <form id="createPasswordForm" method="post">
        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required><br>
        <button type="submit">Create Password</button>
    </form>
  <?php } ?>

  <?php if ($show_password_form) { ?>
    <form id="passwordForm" method="post">
        <label for="password">Your Password:</label>
        <input type="password" id="password" name="password" required><br>
        <?php if (!empty($error_message)) { ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php } ?>
        <input type="submit" value="Login">
        <div class="forgot-password">
            <a href="#" id="forgotPasswordLink">Forgot Password?</a>
        </div>
    </form>
  <?php } ?>

  <script>
    document.getElementById("forgotPasswordLink").addEventListener("click", function(event) {
        event.preventDefault();
        document.getElementById("passwordForm").style.display = "none";
        var createPasswordForm = document.createElement("form");
        createPasswordForm.method = "post";
        createPasswordForm.innerHTML = `
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required><br>
            <button type="submit">Create Password</button>
        `;
        document.body.appendChild(createPasswordForm);
    });
  </script>

</body>
</html>
