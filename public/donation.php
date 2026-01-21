<?php include('header.php')?>
<div style="margin-top:20%">
    
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sports Club Donation Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f0f8ff;
    }
    .donation-form {
      max-width: 600px;
      margin: 50px auto;
      padding: 30px;
      background: #fff;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border-radius: 12px;
    }
    .form-title {
      text-align: center;
      margin-bottom: 25px;
      font-weight: bold;
      color: #0066cc;
    }
    .btn-donate {
      background-color: #0066cc;
      color: #fff;
    }
    .btn-donate:hover {
      background-color: #004c99;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="donation-form">
      <h2 class="form-title">Support Our Sports Club</h2>
      <form>
        <div class="mb-3">
          <label for="donorName" class="form-label">Full Name</label>
          <input type="text" class="form-control" id="donorName" placeholder="Enter your name" required>
        </div>

        <div class="mb-3">
          <label for="donorEmail" class="form-label">Email address</label>
          <input type="email" class="form-control" id="donorEmail" placeholder="name@example.com" required>
        </div>

        <div class="mb-3">
          <label for="donationAmount" class="form-label">Donation Amount (₹)</label>
          <input type="number" class="form-control" id="donationAmount" placeholder="Enter amount" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Payment Method</label>
          <select class="form-select" required>
            <option value="" selected disabled>Choose a method</option>
            <option value="upi">UPI</option>
            <option value="card">Credit/Debit Card</option>
            <option value="netbanking">Net Banking</option>
          </select>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-donate">Donate Now</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

    
</div>


<?php include('footer.php')?>