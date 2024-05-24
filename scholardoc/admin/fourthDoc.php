<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Grades Table</title>
  <style>
    body {
      font-family: 'Courier New', Courier, monospace;
      background-color: #F6EAC6;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
      position: relative;
      overflow-y: auto; /* Make the body scrollable */
    }

    .admin-dashboard {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      font-size: 24px;
      color: #3C2621;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      color: #333;
      font-family: Broadway;
      font-weight: bold;
      font-size: 50px;
      text-align: center;
      margin: 0;
      width: 100%;
      background-color: #F4E1AB;
      padding: 40px 0;
      z-index: 1;
      transition: transform 0.3s ease;
    }

    h2 {
      color: #3C2621;
      text-align: center;
      margin-top: 160px;
      font-family: 'Courier New', Courier, monospace;
      font-size: 20px;
    }

    table {
      border-collapse: collapse;
      width: 95%;
      background-color: #F4E1AB;
      border-radius: 8px;
      overflow: hidden;
      margin-bottom: 20px; /* Add some bottom margin to separate from the back button */
    }

    th, td {
      border: 1px solid #3C2621;
      text-align: center;
      padding: 10px;
      color: #333;
    }

    th {
      background-color: #D0A074;
    }

    tr:nth-child(even) {
      background-color:  #fff;
    }

    tr:nth-child(odd) {
      background-color: #f2f2f2;
    }

    .year-buttons {
      margin-bottom: 20px;
      margin-top: -10px;
    }

    .year-button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #D0A074;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s;
      margin-right: 10px;
      font-family: 'Courier New', Courier, monospace;
    }

    .year-button:hover {
      background-color: #A52A2A;
      cursor: pointer;
      transform: scale(1.1);
    }

    /* Style for active button */
    .active {
      background-color: #A52A2A !important;
      color: #fff !important;
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

    .back-button:hover {
      background-color: #A52A2A;
      cursor: pointer;
      transform: scale(1.1);
    }

    /* Style for file input label */
    .file-label {
      position: relative;
      display: inline-block;
      text-align: right;
    }

    .file-label img {
      width: 20px;
      height: 20px;
      cursor: pointer;
      margin-left: 80px
    }

    .file-label input[type="file"] {
      position: absolute;
      top: 0;
      left: 0;
      opacity: 0;
      cursor: pointer;
    }

    /* Style for file input label when hovered */
    .file-label:hover img {
      filter: brightness(0.8);
      transform: scale(1.1);
    }

    /* Style for file input label when focused */
    .file-label input[type="file"]:focus + img {
      filter: brightness(0.8);
    }

    .file-button {
      display: inline-block;
      cursor: pointer;
      font-size: 10px;
      color: #333;
      text-align: left;
      font-family: 'Courier New', Courier, monospace;
      max-width: 80px;
      overflow: hidden;
      text-overflow: ellipsis; /* Add ellipsis for overflow */
      white-space: nowrap; /* Prevent line breaks */
}

.file-button:hover {
    background-color: #A52A2A;
    color: #fff;
}




  </style>
</head>
<body>

  <!-- Admin Dashboard -->
  <header class="admin-dashboard">
    <h1>Admin Dashboard</h1>
  </header>

  <!-- Header -->
  <h2>Student Documents</h2>

  <!-- Year Selection Buttons -->
  <div class="year-buttons">
    <!-- Your year selection buttons -->
  </div>

  <!-- Year Selection Buttons -->
<div class="year-buttons">
  <button class="year-button" onclick="loadData('2nd')">2nd Year</button>
  <button class="year-button" onclick="loadData('3rd')">3rd Year</button>
  <button class="year-button active" onclick="loadData('4th')">4th Year</button>
</div>

  <!-- Scrollable container for the table -->
  
    <table id="grades-table">
      <thead>
        <tr>
          <th rowspan="3">Name</th>
          <th colspan="2">FRG</th>
          <th colspan="6">COR</th>
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
        <!-- Your PHP code to fetch and display data -->
        <?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_system";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT * FROM fourthyear";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   // Output data of each row
   while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row["full_name"] . "</td>";

      // Display file attachments for each row
      for ($i = 0; $i < 6; $i++) {
         echo '<td>';
         $file_path = $row["file_" . $i];
         if (!empty($file_path)) {
            echo '<a href="' . $file_path . '" target="_blank">' . basename($file_path) . '</a>';
         } else {
            echo 'No file uploaded';
         }
         echo '</td>';
      }

      echo "</tr>";
   }
} else {
   echo "<tr><td colspan='7'>0 results</td></tr>";
}

// Close connection
$conn->close();
?>



      </tbody>
    </table>

  <!-- Back Button -->
  <button class="back-button" onclick="goBack()">Back</button>

  <script>
  // JavaScript function to handle file change
  function handleFileChange(input, rowId) {
    var fileId = input.id.split('_')[2]; // Extract the file ID from the input ID
    var displayDiv = document.getElementById('file_display_' + rowId + '_' + fileId);

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

</script>
 <script>
    // Load the saved file attachments when the page is loaded
    window.addEventListener('load', function() {
      loadSavedFileAttachments();
    });

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

    // Function to navigate back to the admin_dashboard.html page
    function goBack() {
      window.location.href = 'admin_dashboard.html';
    }

    // Function to load data for a specific year
    function loadData(year) {
    if (year === '2nd') {
      window.location.href = 'doc.php';
    } else if (year === '3rd') {
      window.location.href = 'thirdDoc.php'; // Redirect to third.php for 3rd year
    } else if (year === '4th') {
      window.location.href = 'fourthDoc.php'; // Redirect to fourth.php for 4th year
    }
  }
  </script>



</body>
</html> 