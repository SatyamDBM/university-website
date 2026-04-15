    {{-- ========== NEWSLETTER ========== --}}
   <section class="newsletter">
    <div class="container">

        <div class="newsletter-form">
            <h2>Join Our Newsletter</h2>
            <p>Subscribe to get updates on your inbox. Latest updates & news</p>
        </div>

        <div class="newsletter-form">
           <input type="email" id="newsletterEmail" placeholder="Enter your email">
            <button onclick="subscribeNewsletter()">Subscribe Now</button>

            <small id="newsletterMsg"></small>
        </div>

    </div>
</section>
    {{-- ========== END NEWSLETTER ========== --}}
 <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col first">
                    <div class="footer-logo">
                       
                   <a href="{{route('home')}}"><img src="{{ asset($brandingSettings['website_logo'] ?? 'images/logo.png') }}" alt="{{ $brandingSettings['brand_name'] ?? 'Logo' }}"></a>
               
                    </div>
                    <p>Begonia & Clover, Embassy Tech Village, Outer Ring Road, Devarabeesanahalli Village, Bengaluru – 560103, Karnataka, India.</p>
                  
                </div>
                
                <div class="footer-col">
                    <h3>Top Universities</h3>
                    <ul>
                        <li><i class="fa-solid fa-angle-right"></i><a href="course-detail.html">Engineering</a></li>
                        <li><i class="fa-solid fa-angle-right"></i><a href="course-detail.html">Management</a></li>
                        <li><i class="fa-solid fa-angle-right"></i><a href="course-detail.html">Medical</a></li>
                        <li><i class="fa-solid fa-angle-right"></i><a href="course-detail.html">Law</a></li>
                        <li><i class="fa-solid fa-angle-right"></i><a href="course-detail.html">Science</a></li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h3>Quick links</h3>
                    <ul>
                        <li><i class="fa-solid fa-angle-right"></i><a href="{{route('about')}}">About</a></li>
                        <li><i class="fa-solid fa-angle-right"></i><a href="{{route('blog')}}">Blog and article</a></li>
                        <li><i class="fa-solid fa-angle-right"></i><a href="{{route('web-faq')}}">Faq</a></li>
                        <li><i class="fa-solid fa-angle-right"></i><a href="{{route('contact')}}">Contact us</a></li>
                        <li><i class="fa-solid fa-angle-right"></i><a href="{{route('terms')}}">Terms & conditions</a></li>
                        <li><i class="fa-solid fa-angle-right"></i><a href="{{route('privacy')}}">Privacy & policy</a></li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="footer-bottom">
            <p>
                {!! $brandingSettings['footer_text'] ?? 'Copyright © 2026 <a href="index.html" target="_blank">topuniversitiesindia.com</a> | All Rights Reserved' !!}
            </p>
        </div>
    </footer>
