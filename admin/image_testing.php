<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image'])) {
        $fileSize = $_FILES['image']['size'];

        if ($fileSize > 2 * 1024 * 1024) { // Check size again on server (2MB)
            echo "File too large.";
            exit;
        }

        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $fileName = basename($_FILES['image']['name']);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            echo "Image uploaded to: " . $targetPath;
        } else {
            echo "Failed to move uploaded file.";
        }
    } else {
        echo "No file received.";
    }
} else {
    echo "Invalid request.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Image Upload with Size Check</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

  <h2>Select an Image (Max 2MB)</h2>
  <input type="file" id="imageUpload" name="image" accept="image/*">

  <script>
    $(document).ready(function () {
      $('#imageUpload').on('change', function () {
        var file = this.files[0];

        if (file) {
          var maxSize = 2 * 1024 * 1024; // 2MB

          if (file.size > maxSize) {
            alert('Image size exceeds 2MB. Please upload a smaller image.');
            $(this).val(''); // Clear the file input
            return;
          }

          var formData = new FormData();
          formData.append('image', file);

          $.ajax({
            url: 'upload.php', // Your PHP file path
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
              alert('Image uploaded successfully!');
              console.log('Server response:', response);
            },
            error: function () {
              alert('Error uploading the image.');
            }
          });
        }
      });
    });
  </script>

</body>
</html>
