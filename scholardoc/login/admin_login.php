<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administrator Login</title>
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
      font-size: 70px;
      text-align: center;
      position: fixed; /* Set heading position to fixed */
      top: 50px; /* Adjust top position */
      left: 50%; /* Center horizontally */
      transform: translateX(-50%); /* Center horizontally */
    }
    
    form {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 300px;
      margin-top: 100px; /* Add space below the heading */
      
    }
    
    label {
      display: block;
      margin-bottom: 10px;
      color: #555;
    }
    
    input[type="text"],
    input[type="password"] {
      width: calc(100% - 20px);
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-bottom: 5px;
    }
    
    button {
      width: 100%;
      padding: 10px;
      background-color: #D0A074;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    
    button:hover {
      background-color: #3C2621;
    }
    
    .error-message {
      color: red;
      text-align: center;
      margin-bottom: 15px;
      margin-top: -15px;
    }

  </style>
</head>
<body>
  <h1>Administrator Login</h1>
  
  

  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> " method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <?php
  // Check if the form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Hardcoded username and password
      $username = "admin";
      $password = "admin";

      // Get the submitted username and password
      $submitted_username = $_POST['username'];
      $submitted_password = $_POST['password'];

      // Check if the submitted username and password match the hardcoded values
      if ($submitted_username === $username && $submitted_password === $password) {
          // Authentication successful, redirect to the admin dashboard
          header("Location: ../admin/admin_dashboard.html");
          exit();
      } else {
          // Authentication failed, display an error message
          echo "<p class='error-message'>Invalid username or password.</p>";
      }
    }
    ?>

    <button type="submit">Login</button>
  </form>
</body>
</html>
