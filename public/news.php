<?php include ('header.php')?>

   <style>
        .container {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            padding: 20px;
        }
        .content-container {
            flex: 3;
        }
        .latest-updates {
            flex: 1;
        }
        .article {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .article-logo {
            flex: 0 0 100px;
            margin-right: 15px;
        }
        .article-logo img {
            max-width: 100px;
            height: auto;
        }
        .article-content {
            flex: 1;
        }
        .read-more {
            color: red;
            text-decoration: none;
            font-weight: bold;
        }
    </style>

   <div class="container" style="margin-top:120px">
        <div class="content-container">
            <article class="article">
                <div class="article-logo">
                    <img src="images/ssfi-logo-12.png" alt="SSFI Logo">
                </div>
                <div class="article-content">
                    <h2>Announcement of New Scholarships for Skating and International Medalists</h2>
                    <p>Published by <strong>admin</strong> on March 22, 2025</p>
                    <p>As you are aware, we are all committed to advancing our sport day by day. In line with this commitment, we are pleased to inform you...</p>
                    <a href="#" class="read-more">Read more</a>
                </div>
            </article>
            <article class="article">
                <div class="article-logo">
                    <img src="images/ssfi-logo-12.png" alt="SSFI Logo">
                </div>
                <div class="article-content">
                    <h2>Empowering Women in Roller Skating – A Step Toward Equality and Excellence</h2>
                    <p>Published by <strong>admin</strong> on March 20, 2025</p>
                    <p>Encouraging women in roller skating is a vital step towards inclusivity and sports excellence...</p>
                    <a href="#" class="read-more">Read more</a>
                </div>
            </article>
            <article class="article">
                <div class="article-logo">
                    <img src="images/ssfi-logo-12.png" alt="SSFI Logo">
                </div>
                <div class="article-content">
                    <h2>SKATES WHEEL SIZE INLINE SPEED SKATING 2025</h2>
                    <p>Published by <strong>admin</strong> on March 18, 2025</p>
                    <p>Find out the latest updates on inline speed skating wheel sizes for 2025...</p>
                    <a href="#" class="read-more">Read more</a>
                </div>
            </article>
            <article class="article">
                <div class="article-logo">
                    <img src="images/ssfi-logo-12.png" alt="SSFI Logo">
                </div>
                <div class="article-content">
                    <h2>Rescheduling of Roller and Inline Hockey Team Camps</h2>
                    <p>Published by <strong>admin</strong> on March 15, 2025</p>
                    <p>Due to unforeseen circumstances, the roller and inline hockey team camps have been rescheduled...</p>
                    <a href="#" class="read-more">Read more</a>
                </div>
            </article>
            <article class="article">
                <div class="article-logo">
                    <img src="images/ssfi-logo-12.png" alt="SSFI Logo">
                </div>
                <div class="article-content">
                    <h2>Opening Ceremony 2nd Inter District Open National Roller Skating Championship 2025</h2>
                    <p>Published by <strong>admin</strong> on March 10, 2025</p>
                    <p>The much-awaited championship is set to begin with a grand opening ceremony...</p>
                    <a href="#" class="read-more">Read more</a>
                </div>
            </article>
        </div>
        <aside class="latest-updates">
            <h3>Latest Updates</h3>
            <ul>
                <li><a href="#">Announcement of New Scholarships for Skating and International Medalists</a></li>
                <li><a href="#">Empowering Women in Roller Skating – A Step Toward Equality and Excellence</a></li>
                <li><a href="#">SKATES WHEEL SIZE INLINE SPEED SKATING 2025</a></li>
                <li><a href="#">Rescheduling of Roller and Inline Hockey Team camps</a></li>
                <li><a href="#">Opening Ceremony 2nd Inter District Open National Roller Skating Championship 2025</a></li>
            </ul>
        </aside>
    </div>



<?php include "footer.php"; ?>