<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Documents - Students</title>
  <style>
    /* CSS styles */
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

    .content-container {
      display: flex;
      align-items: flex-start;
      margin: 60px;
      padding: 50px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .table-container {
      flex-grow: 1;
    }

    .content-table {
       border-collapse: collapse;
        table-layout: fixed; /* Fixed layout to prevent overflowing */
        width: 100%; /* Take full width of container */
    }

    .content-table th,
    .content-table td {
      padding: 10px;
      text-align: left;
      font-family: 'Courier New', Courier, monospace;
      font-size: 16px;
      color: #3C2621;
      border-bottom: 1px solid #ccc;
      border-right: 1px solid #ccc; /* Add border right */
      border-left: 1px solid #ccc;
       white-space: nowrap; /* Prevent text wrapping */
        overflow: hidden; /* Hide overflow */
        text-overflow: ellipsis; /* Show ellipsis for overflow text */
        width: 150px; /* Fixed width for cells */
    }

    .content-table th {
      background-color: #776867;
      color: #fff;
      width: 30px;
      text-align: center;
    }

    .content-table td {
      background-color: #fff;
       max-width: 200px;
    }

    .content-table input[type="submit"] {
        background-color: #D0A074;
        border: none;
        border-radius: 8px;
        padding: 5px 10px; /* Adjusted padding for smaller buttons */
        font-size: 14px; /* Adjusted font size for smaller buttons */
        cursor: pointer;
        transition: background-color 0.3s;
        font-family: 'Courier New', Courier, monospace;
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

     .back-button:hover, .content-table input[type="submit"]:hover {
        background-color: #A52A2A;
        cursor: pointer;
        transform: scale(1.1);
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header>
    <h1>Documents</h1>
  </header>

  <!-- Main Content -->
  <main>
    <section class="content-container">
      <div class="table-container">
        <table class="content-table">
          <thead>
            <tr>
              <th colspan="2">FRG</th>
              <th colspan="4">COR</th>
            </tr>
            <tr>
              <th rowspan="2">1st Semester</th>
              <th rowspan="2">2nd Semester</th>
              <th colspan="2">1st Semester</th>
              <th colspan="2">2nd Semester</th>
            </tr>
            <tr>
              <th>Midterm</th>
              <th>Final Term</th>
              <th>Midterm</th>
              <th>Final Term</th>
            </tr>
          </thead>
          <tbody>
            <?php
            session_start();

            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "student_system";

            // Connect to your database
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve student_id_no from session
            $student_id_no = $_SESSION['student_id_no'];

            // Function to determine the table name based on the student_id_no
            function getStudentYearTable($conn, $student_id_no) {
                $tables = ['secondyear', 'thirdyear', 'fourthyear'];
                foreach ($tables as $table) {
                    $sql = "SELECT student_id_no FROM $table WHERE student_id_no = '$student_id_no'";
                    $result = $conn->query($sql);
                    if ($result && $result->num_rows > 0) {
                        return $table;
                    }
                }
                return null;
            }

            $tableName = getStudentYearTable($conn, $student_id_no);
            if (!$tableName) {
                die("Student not found in any year table.");
            }

            // Fetch existing file data
            $sql = "SELECT file_0, file_1, file_2, file_3, file_4, file_5 FROM $tableName WHERE student_id_no = '$student_id_no'";
            $result = $conn->query($sql);
            $files = [];
            if ($result->num_rows > 0) {
                $files = $result->fetch_assoc();
            }

            // Start a form for file upload
            echo '<form action="fileupload.php" method="post" enctype="multipart/form-data">';
            for ($i = 0; $i < 6; $i++) {
                $fileInputName = "file_" . $i; // Generate unique name for each file input
                // Create a table cell with file input and submit button
                echo '<td>';
                if (isset($files[$fileInputName]) && !empty($files[$fileInputName])) {
                    echo '<a href="' . $files[$fileInputName] . '" target="_blank">View File</a><br>';
                }
                echo '<input type="file" name="' . $fileInputName . '">';
                echo '<br><br>';
                echo '<input type="submit" value="Upload File" name="submit">';
                echo '</td>';
            }
            // End the form
            echo '</form>';

            // Close connection
            $conn->close();
            ?>

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

    window.onload = function() {
        loadSavedFileAttachments();
    };

    // Function to navigate back to the student_dashboard.html page
    function goBack() {
      window.location.href = '../student/student_dashboard.html';
    }
  
    // JavaScript function to handle file change
function handleFileChange(input, rowId) {
    var fileId = input.id.split('_')[2]; // Extract the file ID from the input ID
    var displayDiv = document.getElementById('file_display_' + rowId + '_' + fileId);

    // Remove any previously attached file in this cell
    displayDiv.innerHTML = '';

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            var fileName = input.files[0].name;
            var fileButton = document.createElement('button');
            fileButton.innerText = fileName;
            fileButton.classList.add('file-button');
            fileButton.onclick = function() {
                window.open(e.target.result, '_blank');
            };
            displayDiv.appendChild(fileButton);

            // Save file data to localStorage
            saveFileToLocalStorage('file_' + rowId + '_' + fileId, {
                name: fileName,
                data: e.target.result
            });
        };

        reader.readAsDataURL(input.files[0]);
    } else {
        displayDiv.innerHTML = '';
    }
}

// Function to save file data to local storage
function saveFileToLocalStorage(key, value) {
    localStorage.setItem(key, JSON.stringify(value));
}

// Function to retrieve file data from local storage
function getFileFromLocalStorage(key) {
    return JSON.parse(localStorage.getItem(key));
}

// Display the saved file attachments when the page is loaded
function loadSavedFileAttachments() {
    for (var i = 0; i < 10; i++) {
        for (var j = 0; j < 10; j++) {
            var fileId = i + '_' + j;
            var fileData = getFileFromLocalStorage('file_' + fileId);
            if (fileData) {
                displayFileName(fileId, fileData.name);
            }
        }
    }
}

// Display the file name in the corresponding cell
function displayFileName(fileId, fileName) {
    var displayDiv = document.getElementById('file_display_' + fileId);
    var fileButton = document.createElement('button');
    fileButton.innerText = fileName;
    fileButton.classList.add('file-button');
    fileButton.onclick = function() {
        var fileData = getFileFromLocalStorage('file_' + fileId);
        window.open(fileData.data, '_blank');
    };
    displayDiv.appendChild(fileButton);
}



  </script>

</body>
</html>
