<?php include('header.php')?>

<!-- Contact Hero -->
<section class="hero-slider" style="height: 40vh;">
    <div class="hero-bg" style="background-image: url('images/slider-1.jpg'); background-position: center;"></div>
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 class="hero-title" style="font-size: 2.5rem;">Contact <span style="color:var(--accent-gold);">Us</span></h1>
        <p class="hero-subtitle">We'd love to hear from you</p>
    </div>
</section>

<!-- Contact Section -->
<div class="contact-container">
    <div class="contact-box">
        <h4><i class="fa fa-building"></i> Office Address</h4>
        <p><i class="fa fa-map-marker"></i> P-12 Porkudil Nagar, Podumbhu - 625018, Madurai, Tamilnadu, India</p>
        <p><i class="fa fa-phone"></i> +91 9600635806 / +91 9894487268</p>
        <p><i class="fa fa-envelope"></i> info@ssfibharatskate.com</p>
        <p><i class="fa fa-globe"></i> www.ssfibharatskate.com</p>
        
        <div style="margin-top: 25px; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.2);">
            <h5 style="color: var(--accent-gold); margin-bottom: 15px;">Follow Us</h5>
            <div style="display: flex; gap: 15px;">
                <a href="https://www.youtube.com/@SSFIXBharatSkate" target="_blank" style="color: white; font-size: 1.5rem;"><i class="fa fa-youtube-play"></i></a>
                <a href="https://www.instagram.com/ssfi_official" target="_blank" style="color: white; font-size: 1.5rem;"><i class="fa fa-instagram"></i></a>
                <a href="#" style="color: white; font-size: 1.5rem;"><i class="fa fa-facebook"></i></a>
            </div>
        </div>
    </div>
    
    <div class="form-container">
        <h4 style="color: var(--primary-navy); margin-bottom: 25px; font-weight: 700;">Send us a Message</h4>
        <form>
            <label>Your Name</label>
            <input type="text" placeholder="Enter your full name" required>
            
            <label>Email Address</label>
            <input type="email" placeholder="Enter your email" required>
            
            <label>Subject</label>
            <input type="text" placeholder="What is this regarding?">
            
            <label>Message</label>
            <textarea rows="5" placeholder="Write your message here..." required></textarea>
            
            <button type="submit" class="btn-submit">Send Message</button>
        </form>
    </div>
</div>

<!-- Map Section -->
<div class="container text-center" style="padding: 40px 0;">
    <h4 style="color: var(--primary-navy); margin-bottom: 25px;">Find Us Here</h4>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3929.45601360809!2d78.0920094737642!3d9.979138473395926!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b00c9006b3100fb%3A0x666270a37fa4854e!2sPorkudil%20nagar!5e0!3m2!1sen!2sin!4v1743328908682!5m2!1sen!2sin"
    width="100%" height="400" style="border:0; border-radius: 15px; max-width: 1000px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

<?php include('footer.php')?>