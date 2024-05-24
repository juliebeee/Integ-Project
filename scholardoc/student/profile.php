<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Dashboard - Students</title>
  <style>
    body {
      font-family: 'Courier New', Courier, monospace;
      background-color: #F6EAC6;
      margin: 0;
      padding: 0;
    }

    h1 {
      color: #333;
      font-family: Broadway;
      font-weight: bold;
      font-size: 50px;
      text-align: center;
      margin: auto;
      width: 100%;
      background-color: #F4E1AB;
      padding: 40px 0;
      z-index: 1;
      transition: transform 0.3s ease;
    }

    header {
      padding-top: 0px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      color: #3C2621;
      text-align: center;
      margin-top: 30px;
      font-family: 'Courier New', Courier, monospace;
      font-size: 20px;
    }

    .section-title {
      color: #3C2621;
      text-align: center;
      margin-top: 50px;
      font-family: Lucida calligraphy;
    }

    .content-container {
      display: flex;
      align-items: flex-start;
      margin: 60px;
      padding: 50px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .image-container {
      text-align: center;
      margin-right: 30px;
      margin-left: 60px;
    }

    .image-container img {
      width: 230px;
      height: 230px;
      border-radius: 8px;
    }

    .image-container p {
      margin-top: 10px;
      font-family: 'Courier New', Courier, monospace;
      font-size: 18px;
      color: #3C2621;
    }

    .table-container {
      flex-grow: 1;
    }

    .content-table {
      width: 95%;
      border-collapse: collapse;
    }

    .content-table th,
    .content-table td {
      padding: 10px;
      text-align: left;
      font-family: 'Courier New', Courier, monospace;
      font-size: 16px;
      color: #3C2621;
      border-bottom: 1px solid #ccc;
      border-right: 1px solid #ccc;
      border-top: 1px solid #ccc;
    }

    .content-table th {
      background-color: #776867;
      color: #fff;
      width: 30px;
      text-align: center;
    }

    .content-table td {
      background-color: #fff;
      width: 170px;
    }

    .back-button {
      background-color: #D0A074;
      border: none;
      border-radius: 8px;
      padding: 10px 20px;
      font-size: 18px;
      cursor: pointer;
      transition: background-color 0.3s;
      font-family: 'Courier New', Courier, monospace;

    }

    .back-button-container {
    text-align: center;
    margin-top: -30px;
  }

    .back-button:hover {
      background-color: #A52A2A;
      cursor: pointer;
      transform: scale(1.1);
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header>
    <h1>Student Dashboard</h1>
  </header>

  <?php
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

// Fetch student information from the database based on session
session_start();
if (isset($_SESSION['student_id_no'])) {
    $student_id_no = $_SESSION['student_id_no'];

    $table_name = "";
$first_char = substr($student_id_no, 0, 1);

switch ($first_char) {
    case '2':
        $table_name = "secondyear";
        break;
    case '3':
        $table_name = "thirdyear";
        break;
    case '4':
        $table_name = "fourthyear";
        break;
    default:
        echo "Invalid student ID format: $student_id_no";
}

    // Fetch student information from the appropriate table
    $sql = "SELECT * FROM $table_name WHERE student_id_no=?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("MySQL Error: " . $conn->error);
    }
    $stmt->bind_param("s", $student_id_no);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $student_info = $result->fetch_assoc();
    } else {
        echo "No rows found in table $table_name for student ID: $student_id_no";
    }
    $stmt->close();
}

$conn->close();
?>

  <!-- Main Content -->
  <main>
    <h2>Welcome to Your Dashboard, <?php echo isset($student_info['full_name']) ? $student_info['full_name'] : ""; ?> </h2>
    <section class="content-container">
      <div class="image-container">
        <img src="../images/prof.png" alt="Student Profile">
        <p>Profile</p>
      </div>
      <div class="table-container">
        <table class="content-table">
          <tbody>
            <tr>
              <th>Name</th>
              <td id="student-name"><?php echo isset($student_info['full_name']) ? $student_info['full_name'] : ""; ?></td>
            </tr>
            <tr>
              <th>Student ID Number</th>
              <td id="student-id"><?php echo isset($student_info['student_id_no']) ? $student_info['student_id_no'] : ""; ?></td>
            </tr>
            <tr>
              <th>Year/Course</th>
              <td id="student-year-course"><?php echo isset($student_info['year_course']) ? $student_info['year_course'] : ""; ?></td>
            </tr>
            <tr>
              <th>School</th>
              <td id="student-school"><?php echo isset($student_info['school']) ? $student_info['school'] : ""; ?></td>
            </tr>
            <tr>
              <th>Address</th>
              <td id="student-address"><?php echo isset($student_info['address']) ? $student_info['address'] : ""; ?></td>
            </tr>
            <tr>
              <th>Contact Number</th>
              <td id="student-contact"><?php echo isset($student_info['contact_number']) ? $student_info['contact_number'] : ""; ?></td>
            </tr>
            <tr>
              <th>Email Address</th>
              <td id="student-email"><?php echo isset($student_info['email_address']) ? $student_info['email_address'] : ""; ?></td>
            </tr>
          </tbody>
        </table>
      </div>

    </section>
    <!-- Back Button Container -->
  <div class="back-button-container">
    <button class="back-button" onclick="goBack()">Back</button>
  </div>
  
  </main>

  <script>
    // Function to navigate back to the student_dashboard.html page
    function goBack() {
      window.location.href = '../student/student_dashboard.html';
    }
  </script>

</body>
</html>
