<?php include "header.php"; ?>
<link href="css/modern_home.css" rel="stylesheet" type="text/css">

<!-- Hero Section -->
<section class="hero-slider" id="home">
    <div class="swiper">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide">
                <div class="hero-bg" style="background-image: url('images/slider-1.jpg');"></div>
                <div class="hero-overlay"></div>
                <div class="hero-content">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                <h1 class="hero-title">Empowering India Through <span style="color:var(--accent-gold);">Speed & Skill</span></h1>
                                <p class="hero-subtitle">The National Governing Body for Roller Sports in India. Recognized by Government of India & IOA.</p>
                                <div class="d-flex gap-3 justify-content-center">
                                    <a href="registers/skater-2526.php" class="btn-premium">Register Now</a>
                                    <a href="about.php" class="btn-premium-outline">Discover SSFI</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slide 2 -->
             <div class="swiper-slide">
                <div class="hero-bg" style="background-image: url('images/slider2.jpg');"></div>
                <div class="hero-overlay"></div>
                <div class="hero-content">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                <h1 class="hero-title">Join the <span style="color:var(--accent-gold);">Champions</span> League</h1>
                                <p class="hero-subtitle">Participate in National, State, and District Championships to showcase your talent.</p>
                                <div class="d-flex gap-3 justify-content-center">
                                    <a href="events/event-registration.php" class="btn-premium">View Events</a>
                                    <a href="contact.php" class="btn-premium-outline">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pagination/Navigation if needed (Optional, usually handled by JS) -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</section>

<!-- Event Selection Section (New) -->
<section class="section-premium" id="registrations">
    <div class="container">
        <div class="section-title">
            <h2>Select Your <span style="color:var(--accent-gold);">Registration</span> Type</h2>
            <p>Choose the appropriate category to proceed</p>
        </div>
        
        <!-- Registration Cards -->
        <div class="row g-4 justify-content-center mb-5">
             <!-- Skater Registration -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card text-center p-4">
                    <div class="mb-3">
                        <img src="images/skater-1.png" alt="Skater" style="height: 100px;">
                    </div>
                    <h3>Skater Registration</h3>
                    <p class="text-muted">Annual registration for athletes.</p>
                    <a href="registers/skater-2526.php" class="btn-premium" style="width: 100%;">Register Now</a>
                </div>
            </div>
            
             <!-- Club Registration -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card text-center p-4">
                    <div class="mb-3">
                        <img src="images/coach.png" alt="Club" style="height: 100px;">
                    </div>
                    <h3>Club Registration</h3>
                    <p class="text-muted">Affiliate your club with SSFI.</p>
                    <a href="registers/club-2526.php" class="btn-premium" style="width: 100%;">Affiliate Club</a>
                </div>
            </div>
            
             <!-- State Association -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card text-center p-4">
                    <div class="mb-3">
                        <img src="images/team/1.webp" alt="State" style="height: 100px; border-radius: 50%;">
                    </div>
                    <h3>State / District Unit</h3>
                    <p class="text-muted">Login for State/UT/District units.</p>
                    <a href="registers/s-secretary.php" class="btn-premium" style="width: 100%;">Login / Join</a>
                </div>
            </div>
        </div>

        <!-- Event Types Selection (District/State/National) -->
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-4">
                <h3 style="color:var(--primary-navy); font-weight:700;">Event Registration</h3>
                <p>Select the level of championship you wish to enter</p>
            </div>
            
            <div class="col-lg-4 mb-3">
                <a href="events/district_event.php" class="d-block text-decoration-none">
                    <div class="card p-4 text-center text-white h-100" style="background: linear-gradient(135deg, #28a745, #218838); border-radius: 20px; transition: transform 0.3s;">
                        <h4 class="m-0">District Event Registration</h4>
                    </div>
                </a>
            </div>
            
            <div class="col-lg-4 mb-3">
                <a href="events/state_event_type.php" class="d-block text-decoration-none">
                    <div class="card p-4 text-center text-white h-100" style="background: linear-gradient(135deg, #28a745, #218838); border-radius: 20px; transition: transform 0.3s;">
                        <h4 class="m-0">State Event Registration</h4>
                    </div>
                </a>
            </div>
            
            <div class="col-lg-4 mb-3">
                <a href="events/national_event_type.php" class="d-block text-decoration-none">
                    <div class="card p-4 text-center text-white h-100" style="background: linear-gradient(135deg, #28a745, #218838); border-radius: 20px; transition: transform 0.3s;">
                        <h4 class="m-0">National Event Registration</h4>
                    </div>
                </a>
            </div>
        </div>
        
    </div>
</section>

<!-- Latest Updates Section -->
<section style="padding: 60px 0; background: white;">
    <div class="container">
         <div class="row align-items-center">
             <div class="col-md-6">
                 <h2>Latest <span style="color:var(--primary-navy);">Updates</span></h2>
                 <p class="lead">Stay informed about the latest announcements, results, and schedules.</p>
                 <a href="#" class="btn-premium-outline" style="color:var(--primary-navy); border-color:var(--primary-navy);">View All News</a>
             </div>
             <div class="col-md-6">
                 <!-- Simple News Card -->
                 <div class="card p-3 shadow-sm border-0 mb-3" style="border-left: 4px solid var(--accent-gold) !important;">
                     <h5>SSFI All India Skatathon 2025</h5>
                     <p class="mb-0 text-muted">Coming Soon! Get ready for the ultimate endurance challenge.</p>
                 </div>
                 <div class="card p-3 shadow-sm border-0 mb-3" style="border-left: 4px solid var(--primary-navy) !important;">
                     <h5>New Scholarship Programs</h5>
                     <p class="mb-0 text-muted">Announcing scholarships for international medalists.</p>
                 </div>
                 <div class="card p-3 shadow-sm border-0" style="border-left: 4px solid var(--primary-navy) !important;">
                     <h5>Wheel Size Regulation Update</h5>
                     <p class="mb-0 text-muted">Clarification regarding skate wheel sizes for 2025 events.</p>
                 </div>
             </div>
         </div>
    </div>
</section>

<?php include "footer.php"; ?>