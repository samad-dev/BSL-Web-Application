<!DOCTYPE html>
<html>
<head>
  <title>Custom Excel Exporter</title>
  <style>
    /* Style for the custom Excel export */
    .export-container {
      max-width: 800px;
      margin: 0 auto;
    }

    .export-header {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;
    }

    .logo {
      width: 80px;
      height: 80px;
      margin-right: 10px;
    }

    .company-name {
      font-size: 24px;
      font-weight: bold;
    }

    .export-caption {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .date-range {
      font-size: 16px;
    }

    .export-table {
      border-collapse: collapse;
      width: 100%;
    }

    .export-table th,
    .export-table td {
      border: 1px solid black;
      padding: 5px;
    }

    .export-table th {
      background-color: #f2f2f2;
    }
  </style>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>
<body>
  <div class="export-container">
    <div class="export-header">
      <img class="logo" src="https://www.pkbsl.com/wp-content/uploads/2018/01/logo.png" alt="Logo">
      <div class="company-name">Company Name</div>
    </div>
    <div class="export-caption">Exported Data</div>
    <div class="date-range">From: 01/04/2023 To: 18/04/2023</div>
    <table class="export-table" id="dataTable">
      <thead>
        <tr>
          <th>Column 1</th>
          <th>Column 2</th>
          <th>Column 3</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Row 1, Column 1</td>
          <td>Row 1, Column 2</td>
          <td>Row 1, Column 3</td>
        </tr>
        <tr>
          <td>Row 2, Column 1</td>
          <td>Row 2, Column 2</td>
          <td>Row 2, Column 3</td>
        </tr>
        <tr>
          <td>Row 2, Column 1</td>
          <td>Row 2, Column 2</td>
          <td>Row 2, Column 3</td>
        </tr>
        <tr>
          <td>Row 2, Column 1</td>
          <td>Row 2, Column 2</td>
          <td>Row 2, Column 3</td>
        </tr>
        <tr>
          <td>Row 2, Column 1</td>
          <td>Row 2, Column 2</td>
          <td>Row 2, Column 3</td>
        </tr>
        <tr>
          <td>Row 2, Column 1</td>
          <td>Row 2, Column 2</td>
          <td>Row 2, Column 3</td>
        </tr>
        <tr>
          <td>Row 2, Column 1</td>
          <td>Row 2, Column 2</td>
          <td>Row 2, Column 3</td>
        </tr>
        <tr>
          <td>Row 2, Column 1</td>
          <td>Row 2, Column 2</td>
          <td>Row 2, Column 3</td>
        </tr>
        <tr>
          <td>Row 2, Column 1</td>
          <td>Row 2, Column 2</td>
          <td>Row 2, Column 3</td>
        </tr>
        <tr>
          <td>Row 2, Column 1</td>
          <td>Row 2, Column 2</td>
          <td>Row 2, Column 3</td>
        </tr>
        <tr>
          <td>Row 2, Column 1</td>
          <td>Row 2, Column 2</td>
          <td>Row 2, Column 3</td>
        </tr>
        <tr>
          <td>Row 2, Column 1</td>
          <td>Row 2, Column 2</td>
          <td>Row 2, Column 3</td>
        </tr>
        <tr>
          <td>Row 2, Column 1</td>
          <td>Row 2, Column 2</td>
          <td>Row 2, Column 3</td>
        </tr>
        <tr>
          <td>Row 2, Column 1</td>
          <td>Row 2, Column 2</td>
          <td>Row 2, Column 3</td>
        </tr>
        <tr>
          <td>Row 2, Column 1</td>
          <td>Row 2, Column 2</td>
          <td>Row 2, Column 3</td>
        </tr>
        <tr>
          <td>Row 2, Column 1</td>
          <td>Row 2, Column 2</td>
          <td>Row 5, Column 5</td>
        </tr>
        <!-- Add more rows dynamically if needed -->
      </tbody>
    </table>
    <button id="exportBtn">Export to Excel</button>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
  <script>
    $(document).ready(function() {
      // Initialize DataTable
      $('#dataTable').DataTable();

      // Export to Excel function
      function exportToExcel() {
        let caption = "Data Export"; // Custom caption
        let dateRange = $(".date-range").text(); // Get the date range text
        let table = $("#dataTable").clone(); // Clone the DataTable

        // Encode the logo image as base64
        let logoBase64 = "data:image/png;base64,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";
 // Replace with your logo's base64 string

        // Create a new HTML document for the export
        let exportDoc = "<html><head><title>Exported Data</title></head><body>";
        exportDoc += "<div class='export-container'>";
        exportDoc += "<div class='export-header'>";
        exportDoc += "<img class='logo' src='" + logoBase64 + "' width='35' height='35' alt='Logo'>"; // Include the logo image
        exportDoc += "<div class='company-name'>Company Name</div>";
        exportDoc += "</div>";
        exportDoc += "<div class='export-caption'>" + caption + "</div>";
        exportDoc += "<div class='date-range'>" + dateRange + "</div>";
        exportDoc += "<table class='export-table'>" + table.html() + "</table>";
        exportDoc += "</div>";
        exportDoc += "</body></html>";

        // Create a Blob with the export document data
        let blob = new Blob([exportDoc], { type: "application/vnd.ms-excel" });

        // Create a download link and trigger the download
        let link = document.createElement("a");
        link.href = URL.createObjectURL(blob);
        link.download = "exported_data.xlsx";
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
      }

      // Call the exportToExcel function when the "Export" button is clicked
      $("#exportBtn").on("click", function() {
        exportToExcel();
      });
    });
  </script>
</body>
</html>

