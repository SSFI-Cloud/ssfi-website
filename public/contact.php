<?php include('header.php')?>
<style>
        .contact-container {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }
        .contact-box {
            background-color: #030492;
            color: white;
            padding: 30px;
            border-radius: 5px;
            width: 40%;
        }
        .contact-box i {
            margin-right: 10px;
        }
        .form-container {
            width: 50%;
            padding-left: 30px;
        }
        .form-container input,
        .form-container textarea {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn-submit {
            background-color: #fe6917;
            color: white;
            border: none;
            padding: 10px 20px; 
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container-fluid" id="top_section" style="margin-top:330px">
         <div class="row">
            <div class="col-lg-12">
                <h3 style="background-color:#030492;color:white;padding-left: 20px;">
                    Contact-Us
                </h3>
            </div>
            
        </div>
    </div>
   
    
    <div class="container-fluid contact-container">
        <div class="contact-box">
            <h4>Office Address :</h4>
            <p><i class="fa-solid fa-map"></i> P-12 Porkudil Nagar, Podumbhu - 625018, Madurai, Tamilnadu.</p>
            <p><i class="fa-solid fa-phone"></i>+91 9600635806/+91 9894487268</p>
            <p><i class="fa fa-envelope" aria-hidden="true"></i>info@ssfibharatskate.com</p>
            <p><i class="fa fa-link" aria-hidden="true"></i> ssfibharatskate.com</p>
        </div>
        <div class="form-container">
            <label>Name:</label>
            <input type="text" placeholder="Enter your name">
            <label>E-mail address:</label>
            <input type="email" placeholder="Enter your email">
            <label>Subject:</label>
            <input type="text" placeholder="Enter subject">
            <label>Message:</label>
            <textarea rows="5" placeholder="Enter your message"></textarea>
            <button class="btn-submit">Send message</button>
        </div>
    </div>
    
    
    
    <div class="container text-center">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3929.45601360809!2d78.0920094737642!3d9.979138473395926!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b00c9006b3100fb%3A0x666270a37fa4854e!2sPorkudil%20nagar!5e0!3m2!1sen!2sin!4v1743328908682!5m2!1sen!2sin"
                    width="750" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
    </div>
    
    
    <?php include('footer.php')?>
    
<script>
   // Ensure the script is executed after the DOM is fully loaded
document.addEventListener('DOMContentLoaded', function() {
  const rowElement = document.querySelector('#top_section');
  // Ensure rowElement exists before adding the scroll listener
  if (rowElement) {
    // Function to apply margin-top when scrolling
    window.addEventListener('scroll', function() {
      if (window.scrollY > 25) {  // When scroll position is more than 25px
        rowElement.style.marginTop = '70px';
      } else {
        rowElement.style.marginTop = '330px';  // Reset to 280px when scrolled back to top
      }
    });
  } else {
    console.warn('Element #top_section not found!');
  }
});
</script>