{{-- ========== LOGIN MODAL ========== --}}
<div id="loginModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeLoginModal()">&times;</span>
        <h2>Login to get started</h2>
        <form onsubmit="handleLogin(event)">
            <div class="form-group">
                <label>Email</label>
                <input type="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn-submit">Login</button>
            <p class="form-footer">
                Don't have an account?
                <a href="#" onclick="openSignupModal()">Sign up</a>
            </p>
        </form>
    </div>
</div>

{{-- ========== SIGNUP MODAL ========== --}}
<div id="signupModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeSignupModal()">&times;</span>
        <h2>Institute Sign Up</h2>
        <form onsubmit="handleSignup(event)">
            <div class="form-group">
                <label>Institute Name</label>
                <input type="text" placeholder="Enter institute name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn-submit">Sign Up</button>
            <p class="form-footer">
                Already have an account?
                <a href="#" onclick="openLoginModal()">Login</a>
            </p>
        </form>
    </div>
</div>

{{-- ========== ENQUIRY MODAL ========== --}}
<div id="enquiryModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEnquiryModal()">&times;</span>
        <h2>Enquire Now</h2>
        <form onsubmit="handleEnquiry(event)">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" placeholder="Full Name" required>
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" placeholder="Email Address" required>
            </div>
            <div class="form-group">
                <label>Mobile Number</label>
                <input type="tel" placeholder="Mobile Number" required>
            </div>
            <div class="form-group">
                <label>Course Interested In</label>
                <input type="text" placeholder="Course Interested In" required>
            </div>
            <div class="form-group">
                <label>Write message here...</label>
                <textarea placeholder="Write your message here..." required></textarea>
            </div>
            <button type="submit" class="btn-submit">Enquire Now</button>
        </form>
    </div>
</div>