<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Disbursement - Students</title>
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
      border-left: 1px solid #ccc;
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
      text-align: center;
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
    <h1>Disbursement</h1>
  </header>

  <!-- Main Content -->
  <main>
    <section class="content-container">
      <div class="table-container">
        <table class="content-table">
          <thead>
            <tr>
              <th>Semester</th>
              <th>Term</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody id="table-body">
              <!-- Data will be inserted here dynamically -->
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

    // Function to load data for the logged-in student
    function loadData() {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById('table-body').innerHTML = this.responseText;
        }
      };
      xhttp.open("GET", "../student/fetch_student_data.php", true);
      xhttp.send();
    }

    // Load data when the page loads
    window.onload = function() {
      loadData();
    };
  </script>



</body>
</html>
