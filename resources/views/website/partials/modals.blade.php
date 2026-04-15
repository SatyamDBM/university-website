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
            <form id="enquiryForm" onsubmit="handleEnquiry(event)">

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" id="enq_name" placeholder="Full Name">
                <small class="error" id="err_name"></small>
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" id="enq_email" placeholder="Email Address">
                <small class="error" id="err_email"></small>
            </div>

            <div class="form-group">
                <label>Mobile Number</label>
                <input type="text" id="enq_mobile" placeholder="Mobile Number">
                <small class="error" id="err_mobile"></small>
            </div>

            <div class="form-group">
                <label>Course Interested In</label>
                <input type="text" id="enq_course" placeholder="Course Interested In">
                <small class="error" id="err_course"></small>
            </div>

            <div class="form-group">
                <label>Message</label>
                <textarea id="enq_message" placeholder="Write your message"></textarea>
                <small class="error" id="err_message"></small>
            </div>

            <button type="submit" class="btn-submit">Enquire Now</button>
        </form>
    </div>
</div>
<div id="successPopup" class="popup">
    <div class="popup-box">
        <h3>🎉 Success</h3>
        <p id="successText"></p>
        <button onclick="closeSuccessPopup()">OK</button>
    </div>
</div>