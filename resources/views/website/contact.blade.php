
    @extends('layouts.website')

    @section('title', 'Contact-Us - Top Universities in India')

    @section('body-class', 'Contact-Us')

    @section('content')

         <!-- Banner section -->
    <section class="hero common-hero">

        <div class="hero-banner">
        <img src="images/banner.png" alt="Background Image" class="bg-image">
        </div>

        <div class="middleware">
            <div class="hero-content">
                <div class="left portion">
                <p class="hero-subtitle"><img src="images/unversity.png" alt="unversity"> india’s #1 University Discovery Platform</p>
                <h2 class="hero-title">Contact Us</h2>
                <p class="hero-description">Welcome to your trusted platform for discovering the best educational opportunities across India.</p>
                </div>
            </div>
        </div>
    </section>
    <!--End of Banner section -->


    <section class="popular-streams">
        <div class="container">
                <p class="section-btn">Contact Us</p>
                <h2 class="section-title">Head Office</h2>

            <div class="tu-contact-container">
                <div class="tu-card-box new">
                    <div class="offic">
                        <img src="images/contact.svg" alt="Contact Icon">
                    </div>
                    <div class="office">
                    <p>
                        TopUniversities Pvt. Ltd.<br>
                        5th & 6th Floor, Knowledge Tower,<br>
                        Sector 62, Noida, Uttar Pradesh 201309
                    </p>
                    <p><strong>Phone:</strong> +91 9876543210</p>
                    <p><strong>Email:</strong> support@topuniversities.com</p>
                    </div></div>

                <p class="common-p">Have an opinion or an experience to share with students? - Get published on Shiksha and join a vibrant community of
                    thought ‘provokers’!Visit this page for details on how to submit your article: Write for ShikshaGet your College
                    / Institute / Business listed on ShikshaSend email to us: sales@shiksha.comAlternatively, contact a sales
                    branch near you | Timing: Mon-Fri, 9:30 AM - 6:30 PM (IST)</p>


                   <!-- Map -->
        <div class="cm-map">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3559.2764846397263!2d80.99640997609308!3d26.862955462225926!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399957d579200cf9%3A0xff057efaaaae1e44!2sDigital%20Brain%20Media!5e0!3m2!1sen!2sin!4v1775731991140!5m2!1sen!2sin" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>

        <div class="destination-add">
            <img src="images/addon.png" alt="View All Universities">
            </div>

                <h2 class="tu-section-heading">Regional Offices</h2>

                <div class="tu-grid-layout">

                    <div class="tu-card-box">
                        <h3>Delhi</h3>
                        <p>Connaught Place Business Hub,<br>New Delhi - 110001</p>
                        <div class="alignment-pp">
                        <i class="fa-solid fa-phone"></i>
                        <div class="phn-div">
                            <a href="tel:+91-78xxxxxxxxxx" class="link-gray-medium">+91-78xxxxxxxxxx</a>
                            </div>
                        </div>
                    </div>

                    <div class="tu-card-box">
                        <h3>Mumbai</h3>
                        <p>Andheri Tech Park,<br>Mumbai, Maharashtra - 400069</p>
                        <div class="alignment-pp">
                        <i class="fa-solid fa-phone"></i>
                        <div class="phn-div">
                            <a href="tel:+91-78xxxxxxxxxx" class="link-gray-medium">+91-78xxxxxxxxxx</a>
                            </div>
                        </div>
                    </div>

                    <div class="tu-card-box">
                        <h3>Bengaluru</h3>
                        <p>Electronic City Phase 1,<br>Bengaluru, Karnataka - 560100</p>
                        <div class="alignment-pp">
                        <i class="fa-solid fa-phone"></i>
                        <div class="phn-div">
                            <a href="tel:+91-78xxxxxxxxxx" class="link-gray-medium">+91-78xxxxxxxxxx</a>
                            </div>
                        </div>
                    </div>

                    <div class="tu-card-box">
                        <h3>Hyderabad</h3>
                        <p>HITEC City, Madhapur,<br>Hyderabad - 500081</p>
                       <div class="alignment-pp">
                        <i class="fa-solid fa-phone"></i>
                        <div class="phn-div">
                            <a href="tel:+91-78xxxxxxxxxx" class="link-gray-medium">+91-78xxxxxxxxxx</a>
                            </div>
                        </div>            
                    </div>

                    <div class="tu-card-box">
                        <h3>Chennai</h3>
                        <p>OMR IT Corridor,<br>Chennai - 600096</p>
                                                <div class="alignment-pp">
                        <i class="fa-solid fa-phone"></i>
                        <div class="phn-div">
                            <a href="tel:+91-78xxxxxxxxxx" class="link-gray-medium">+91-78xxxxxxxxxx</a>
                            </div>
                        </div>
                    </div>

                    <div class="tu-card-box">
                        <h3>Jaipur</h3>
                        <p>Malviya Nagar Business Center,<br>Jaipur - 302017</p>
                                                <div class="alignment-pp">
                        <i class="fa-solid fa-phone"></i>
                        <div class="phn-div">
                            <a href="tel:+91-78xxxxxxxxxx" class="link-gray-medium">+91-78xxxxxxxxxx</a>
                            </div>
                        </div>
                    </div>

                </div>
                <br>
                <!-- Student Support -->
                <div class="tu-card-box">
                    <h2>Student Support</h2>
                    <p>
                        Need help with university selection, applications, or guidance? Our support team is here to help
                        you.
                    </p>
                    <p><strong>Email:</strong> help@topuniversities.com</p>
                </div>

            </div>


    </section>
@endsection