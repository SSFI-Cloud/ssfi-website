<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="theme-color" content="#33b5e5">
    <title>SKATER REGISTRATION-TNSSA</title>
    <link rel="icon" type="image/x-icon" href="logo.png">
    
    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<link href='https://code.jquery.com/ui/1.12.1/themes/cupertino/jquery-ui.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.0.1/jquery.rateyo.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<!-- MDB -->
<link  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" rel="stylesheet"/>
<!-- MDB -->
<scripttype="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"></script>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>



    <style>
       /* Fix body to prevent scrolling */
            html, body {
                height: 100%;
                margin: 0;
                overflow: hidden; /* Prevent body scrolling */
                background-image: url("https://png.pngtree.com/thumb_back/fh260/background/20231011/pngtree-vibrant-yellow-skateboard-or-skating-surf-board-soaring-against-a-scenic-image_13595541.png");
                background-size: cover;
                background-attachment: fixed;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            
            /* Scrollable Box */
            .scroll-box {
                width: min(95vw, 2480px); /* Adjusts width dynamically */
                height: 90vh; /* Limits height to viewport */
                background: rgba(255, 255, 255, 0.9);
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                overflow-y: auto; /* Enables scrolling inside */
                overflow-x: hidden;
                box-sizing: border-box; /* Prevents overflow due to padding */
            }
            /* Responsive adjustments */
            @media (max-width: 768px) {
                .scroll-box {
                    max-width: 100vw; /* Ensures it fits smaller screens */
                    width: min(100vw, 2480px);
                    height: 100vh;
                }
            }

    </style>
    <style type="text/css">
  .required::after {
   content: " * ";
   color: red;
   width: 1.5em;
   margin-right: 1.5em;
}
.optional::after {
   content: " (Optional) ";
   color: green;
   width: 1.5em;
   margin-right: 1.5em;
}
</style>
<style>
    @media only screen and (max-width: 900px) {
        .tnssa-logo{
            width:100%;
        }
    /*    .load{
            
             width: 90%;
    text-align: center;
        }
        .venkat{
            width: 158%;
        }*/
    }
    @media only screen and (min-width: 1200px) {
        .tnssa-logo{
            width:675px;
        }
    }
</style>
</head>
<body>
    <div class="scroll-box">
        
        
     <div class="row">  
     <center style="padding: 10px;"><b style="font-size: 16px;color: #afa300;">SKATER REGISTRATION 2024 - 2025</b></center>
        <div class="col-md-4">
            <div class="form-outline">
              <input type="text" class="form-control" name="name" id="name" required />
              <label for="validationCustom01" class="form-label required">Full Name (As Per Aadhar)</label>
              <div class="invalid-feedback">Please Provide valid name.<br></div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-outline">
              <input type="text" class="form-control" name="fathername" id="fathername"  required />
              <label for="validationCustom02" class="form-label required">Father Name</label>
              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Please provide a father name.<br></div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-outline">
              <input type="number" class="form-control active" id="mobile" name="mobile" required onkeypress="if(this.value.length==10) return false;"/>
              <label for="validationCustom06" class="form-label required">Mobile Number (Please Provide a Valid Number)</label>
              <div class="invalid-feedback">Please provide a mobile number.</div>
            </div>
          </div>
     </div>  
        
        
        
        
    </div>
</body>
