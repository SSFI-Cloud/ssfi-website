<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Event Registrations with Category Filter (jQuery)</title>
<style>
  table { border-collapse: collapse; width: 100%; }
  th, td { border: 1px solid #ccc; padding: 6px; }
  th { background: #eee; }
  .group-header { font-weight: bold; color: blue; }
  #downloadBtn,#pdfDownloadBtn {
    margin: 10px 10px 10px 0;
    padding: 8px 15px;
    font-size: 16px;
  }
  #categorySelect { padding: 6px 10px; font-size: 16px; }
</style>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
</head>
<body>

<label for="categorySelect">Select Category:</label>
<select id="categorySelect">
  <option value="">-- Select Category --</option>
  <option value="Adjustable/Tenacity">Adjustable/Tenacity</option>
  <option value="Recreational Inline (Fancy)">Recreational Inline (Fancy)</option>
  <option value="Speed Inline">Speed Inline</option>
  <option value="Speed Quad">Speed Quad</option>
</select>

<button id="downloadBtn" disabled>Download Excel</button>
<button id="pdfDownloadBtn" disabled>Download PDF</button>

<table id="eventTable">
  <tbody>
    <tr><td colspan="18" style="text-align:center;">Please select a category</td></tr>
  </tbody>
</table>

<script>
const apiUrl = 'api/events-report/events-report-excel.php';

// --- Render table as before ---
function renderTable(data) {
  const $tbody = $('#eventTable tbody');
  $tbody.empty();

  if (!data || data.length === 0) {
    $tbody.html('<tr><td colspan="18" style="text-align:center;">No records found</td></tr>');
    return;
  }

  const grouped = {};
  $.each(data, function(_, row) {
    if (!row.membership_id) return;
    const cat = row.cat_name || 'Unknown';
    const gender = row.gender || 'Unknown';
    const age = row.age_category || 'Unknown';
    grouped[cat] = grouped[cat] || {};
    grouped[cat][gender] = grouped[cat][gender] || {};
    grouped[cat][gender][age] = grouped[cat][gender][age] || [];
    grouped[cat][gender][age].push(row);
  });

  $.each(Object.keys(grouped).sort(), function(_, cat) {
    $tbody.append(`<tr class="group-header"><td colspan="18">${cat}</td></tr>`);
    $tbody.append(`<tr>
    <th>S.No</th>
    <th>Id</th>
    <th>Full Name</th>
    <th>Club</th>
    <th>District</th>
    <th>Gender</th>
    <th>200M</th>
    <th>RES</th>
    <th>400M</th>
    <th>RES</th>
    <th>1000M</th>
    <th>RES</th>
    <th>R-R 100M</th>
    <th>RES</th>
    <th>P-P</th>
    <th>RES</th>
    <th>R-R 2K</th>
    <th>RES</th>
    </tr>`);

    let serial = 1;
    $.each(Object.keys(grouped[cat]).sort(), function(_, gender) {
      $tbody.append(`<tr style="font-weight:bold; background:#dfe6f0;"><td colspan="18">${gender}</td></tr>`);

      $.each(Object.keys(grouped[cat][gender]).sort(), function(_, ageCat) {
        $tbody.append(`<tr style="font-style:italic; background:#f0f4ff;"><td colspan="18">${ageCat}</td></tr>`);

        $.each(grouped[cat][gender][ageCat], function(_, row) {
          $tbody.append(`<tr>
            <td>${serial++}</td>
            <td>${row.membership_id.toString().slice(-5)}</td>
            <td>${row.full_name}</td>
            <td>${row.club_name}</td>
            <td>${row.district_name}</td>
            <td>${row.gender}</td>
            <td>${row['200 M']||''}</td>
            <td>${''}</td>
            <td>${row['400 M']||''}</td>
            <td>${''}</td>
            <td>${row['1000 M']||''}</td>
            <td>${''}</td>
            <td>${row['Road Race 100 M']||''}</td>
            <td>${''}</td>
            <td>${row['Point to Point']||''}</td>
            <td>${''}</td>
            <td>${row['Road Race 2000 M']||''}</td>
            <td>${''}</td>
          </tr>`);
        });
      });
    });
  });
}

// --- Fetch data ---
$('#categorySelect').on('change', function() {
  const selectedCat = $(this).val();
  const $tbody = $('#eventTable tbody');

  if (!selectedCat) {
    $tbody.html('<tr><td colspan="18" style="text-align:center;">Please select a category</td></tr>');
    $('#downloadBtn, #pdfDownloadBtn').prop('disabled', true);
    return;
  }

  $tbody.html('<tr><td colspan="18" style="text-align:center;">Loading...</td></tr>');

  $.ajax({
    url: `${apiUrl}?category=${encodeURIComponent(selectedCat)}`,
    method: 'GET',
    dataType: 'json',
    success: function(response) {
      const data = response.data || response;
      renderTable(data.filter(row => row.membership_id));
      $('#downloadBtn, #pdfDownloadBtn').prop('disabled', false);
    },
    error: function() {
      $tbody.html('<tr><td colspan="18" style="color:red;">Error fetching data</td></tr>');
    }
  });
});

$('#downloadBtn').on('click', function() {
  const selectedCategory = $('#categorySelect').val() || '';
  const wb = XLSX.utils.book_new();

  // Title row
  const titleRow = [`STATE MEET SPEED SKATING CHAMPIONSHIP 2025 - ${selectedCategory}`];
  while (titleRow.length < 18) titleRow.push('');
  const headers = ["S.No","Id","Full Name","Club","District","Gender",
                   "200 M","RES","400 M","RES","1000 M","RES",
                   "R-R 100M","RES","P-P","RES","R-R 2K","RES"];

  const wsData = [titleRow, headers];

  $('#eventTable tr').each(function() {
    const row = [];
    $(this).find('th, td').each(function() {
      row.push($(this).text().trim());
    });
    if (row.length > 0) wsData.push(row);
  });

  const ws = XLSX.utils.aoa_to_sheet(wsData);

  // Apply styles for group headers (bold, center, bigger font)
  wsData.forEach((r, rowIndex) => {
    if (r.length === 18 && r[0] && !r[1]) { // likely gender or age row
      for (let c = 0; c < 18; c++) {
        const cellRef = XLSX.utils.encode_cell({ r: rowIndex, c: c });
        ws[cellRef].s = {
          font: { bold: true, sz: 14 },
          alignment: { horizontal: "center", vertical: "center" }
        };
      }
    }
  });

  XLSX.utils.book_append_sheet(wb, ws, "Event Data");
  XLSX.writeFile(wb, "event-report.xlsx");
});

$('#pdfDownloadBtn').on('click', function() {
  const selectedCategory = $('#categorySelect').val() || '';
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF({ orientation: 'landscape', unit: 'pt', format: 'A4' });

  const title = `STATE MEET SPEED SKATING CHAMPIONSHIP 2025 - ${selectedCategory}`;
  doc.setFontSize(14);
  doc.setFont('helvetica', 'bold');
  doc.text(title, 40, 30);

  const rows = [];
  $('#eventTable tr').each(function() {
    const row = [];
    $(this).find('th,td').each(function() {
      row.push($(this).text().trim());
    });
    if (row.length > 0) rows.push(row);
  });

  const body = [];
  rows.forEach(r => {
    while (r.length < 18) r.push('');
    body.push(r);
  });

  doc.autoTable({
    startY: 50,
    head: [body[1] || []],
    body: body.slice(2),
    styles: { fontSize: 8, textColor: [0,0,0] },
    headStyles: { fillColor: [255,255,255], textColor: [0,0,0] },
    alternateRowStyles: { fillColor: [255,255,255] },
    tableLineWidth: 0.5,
    tableLineColor: [0,0,0],
    didParseCell: function(data) {
      data.cell.styles.lineWidth = 0.5;
      data.cell.styles.lineColor = [0,0,0];

      // Group headers (gender / age category)
      if (data.cell.raw && data.cell.raw.trim().length > 0 && data.cell.colSpan === 18) {
        data.cell.styles.fontStyle = 'bold';
        data.cell.styles.fontSize = 12;  // bigger font
        data.cell.styles.halign = 'center'; // center text
      }
    }
  });

  doc.save("event-report.pdf");
});



</script>

</body>
</html>
