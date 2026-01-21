<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Event Registrations with Category Filter</title>
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
  #categorySelect {
    padding: 6px 10px;
    font-size: 16px;
  }
</style>
</head>
<body>

<label for="categorySelect">Select Category:</label>
<select id="categorySelect">
  <option value="all">All Categories</option>
</select>
<button id="downloadBtn">Download Excel</button>
<button id="pdfDownloadBtn">Download PDF</button>


<table id="eventTable">
  <tbody>
    <!-- Rows will be inserted here by JS -->
  </tbody>
</table>

<script>
const apiUrl = 'api/events-report/events-report-excel.php'; // Replace with your PHP endpoint URL


let allData = []; // store all data globally

function escapeCsvValue(val) {
  if (val == null) return '';
  val = val.toString();
  if (val.search(/("|,|\n)/g) >= 0) {
    val = '"' + val.replace(/"/g, '""') + '"';
  }
  return val;
}

function tableToCsv(table, filteredRows) {
  const rows = [];
  for (const tr of filteredRows) {
    const row = [];
    for (const cell of tr.children) {
      row.push(escapeCsvValue(cell.textContent.trim()));
    }
    rows.push(row.join(','));
  }
  return rows.join('\n');
}

function downloadCsv(filename, csvContent) {
  const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
  const link = document.createElement('a');
  if (navigator.msSaveBlob) {
    navigator.msSaveBlob(blob, filename);
  } else {
    const url = URL.createObjectURL(blob);
    link.setAttribute('href', url);
    link.setAttribute('download', filename);
    link.style.visibility = 'hidden';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  }
}

// Render rows grouped by category -> gender -> age category
function renderTable(category) {
  const tbody = document.querySelector('#eventTable tbody');
  tbody.innerHTML = '';

  // Build structure: category -> gender -> age category -> rows
  const grouped = {};

  allData.forEach(row => {
    if (!row.membership_id) return;

    if (category === 'all' || row.cat_name === category) {
      const cat = row.cat_name || 'Unknown';
      const gender = row.gender || 'Unknown';
      const age = row.age_category || 'Unknown';

      if (!grouped[cat]) grouped[cat] = {};
      if (!grouped[cat][gender]) grouped[cat][gender] = {};
      if (!grouped[cat][gender][age]) grouped[cat][gender][age] = [];
      grouped[cat][gender][age].push(row);
    }
  });

  Object.keys(grouped).sort().forEach(cat => {
    // Category header (big blue)
    tbody.insertAdjacentHTML('beforeend', `<tr class="group-header"><td colspan="18">${cat}</td></tr>`);
    
    // Table headers after category header
    tbody.insertAdjacentHTML('beforeend', `
      <tr>
        <th>S.No</th>
        <th>Id</th>
        <th>Full Name</th>

        <th>Club</th>
        <th>District Name</th>
        <th>Gender</th>
        <th>200M</th>
        <th>Res</th>
        <th>400</th>
        <th>Res</th>
        <th>1000</th>
        <th>Res</th>
        <th>R-R 100M</th>
        <th>Res</th>
        <th>P-P</th>
        <th>Res</th>
        <th>R-R 2K</th>
        <th>Res</th>
      </tr>
    `);

    let serial = 1;

    Object.keys(grouped[cat]).sort().forEach(gender => {
      // Gender sub-header (bold with background)
      tbody.insertAdjacentHTML('beforeend', `<tr style="font-weight:bold; background:#dfe6f0;"><td colspan="18">${gender}</td></tr>`);

      Object.keys(grouped[cat][gender]).sort().forEach(ageCat => {
        // Age category sub-sub-header (italic and lighter background)
        tbody.insertAdjacentHTML('beforeend', `<tr style="font-style:italic; background:#f0f4ff;"><td colspan="18">${ageCat}</td></tr>`);

        grouped[cat][gender][ageCat].forEach(row => {
          tbody.insertAdjacentHTML('beforeend', `
            <tr>
              <td>${serial++}</td>
              <td>${row.membership_id.toString().slice(-5)}</td>
              <td>${row.full_name}</td>
          
              <td>${row.club_name}</td>
              <td>${row.district_name}</td>
              <td>${row.gender}</td>
              <td>${row['200 M']}</td>
              <td></td>
              <td>${row['400 M']}</td>
              <td></td>
              <td>${row['1000 M']}</td>
              <td></td>
              <td>${row['Road Race 100 M']}</td>
              <td></td>
              <td>${row['Point to Point']}</td>
              <td></td>
              <td>${row['Road Race 2000 M']}</td>
              <td></td>
            </tr>
          `);
        });
      });
    });
  });
}

// Populate category dropdown
function populateCategoryDropdown(categories) {
  const select = document.getElementById('categorySelect');
  categories.forEach(cat => {
    const option = document.createElement('option');
    option.value = cat;
    option.textContent = cat;
    select.appendChild(option);
  });
}

// Fetch data and initialize
fetch(apiUrl)
  .then(res => res.json())
  .then(response => {
    if(response.status !== 'success') {
      alert('Error loading data');
      return;
    }

    // Filter only skater rows (membership_id present)
    allData = response.data.filter(row => row.membership_id);

    // Get unique categories sorted
    const categories = [...new Set(allData.map(row => row.cat_name))].sort();

    populateCategoryDropdown(categories);

    renderTable('all'); // initial render with all categories
  });

// Event listener for category change
document.getElementById('categorySelect').addEventListener('change', e => {
  renderTable(e.target.value);
});

// CSV download button event - export only visible rows
document.getElementById('downloadBtn').addEventListener('click', () => {
  const table = document.getElementById('eventTable');
  const filteredRows = table.querySelectorAll('tbody tr');
  if (filteredRows.length === 0) {
    alert('No data to export for selected category');
    return;
  }
  const csvContent = tableToCsv(table, filteredRows);
  const selectedCat = document.getElementById('categorySelect').value;
  const filename = selectedCat === 'all' ? 'event_registrations_all.csv' : `event_registrations_${selectedCat.replace(/\s+/g, '_')}.csv`;
  downloadCsv(filename, csvContent);
});




document.getElementById('pdfDownloadBtn').addEventListener('click', () => {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF({ orientation: 'landscape' });

  const table = document.querySelector("#eventTable");
  const filteredRows = Array.from(table.querySelectorAll("tbody tr")).filter(row =>
    row.children.length > 1 && !row.classList.contains('group-header')
  );

  if (filteredRows.length === 0) {
    alert('No data to export for selected category');
    return;
  }

  const headers = [
  "S.No", "Member Id", "Full Name", "Age Category", "Club",
  "District Name", "Gender",
  "200 M", "Result",
  "400 M", "Result",
  "1000 M", "Result",
  "Road Race 100 M", "Result",
  "Point to Point", "Result",
  "Road Race 2000 M", "Result"
];


  const data = [];

  filteredRows.forEach(row => {
  const cells = row.querySelectorAll("td, th");
  if (cells.length >= 18) {
    data.push([
      cells[0].innerText,  // S.No
      cells[1].innerText,  // Member Id
      cells[2].innerText,  // Full Name
      cells[3].innerText,  // Age Category
      cells[4].innerText,  // Club
      cells[5].innerText,  // District Name
      cells[6].innerText,  // Gender
      cells[7].innerText,  // 200 M
      cells[8].innerText,  // Result (empty or filled)
      cells[9].innerText,  // 400 M
      cells[10].innerText, // Result
      cells[11].innerText, // 1000 M
      cells[12].innerText, // Result
      cells[13].innerText, // Road Race 100 M
      cells[14].innerText, // Result
      cells[15].innerText, // Point to Point
      cells[16].innerText, // Result
      cells[17].innerText, // Road Race 2000 M
      cells[18].innerText  // Result
    ]);
  }
});


  const selectedCat = document.getElementById('categorySelect').value;
  const title = selectedCat === 'all' ? 'Event Registrations - All Categories' : `Event Registrations - ${selectedCat}`;

  doc.setFontSize(14);
  doc.text(title, 14, 15);

  doc.autoTable({
  head: [headers],
  body: data,
  startY: 20,
  styles: { fontSize: 7 }, // 👈 reduced font size here
  headStyles: { fillColor: [22, 160, 133], fontSize: 7 }, // match header size
});


  const filename = selectedCat === 'all' ? 'event_registrations_all.pdf' : `event_registrations_${selectedCat.replace(/\s+/g, '_')}.pdf`;
  doc.save(filename);
});


</script>

<!-- jsPDF & autoTable (PDF export) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>


</body>
</html>
