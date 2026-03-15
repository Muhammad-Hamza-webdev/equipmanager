<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="<?= base_url() ?>assets/images/logo-icon.png" type="image/png" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/toastr/toastr.min.css" />
    <title>Sign Up</title>
    <style>
    .reg-page {
        padding: 100px 0 !important;
    }

    .inner-login {
        height: 100vh !important;
    }

    .btn-login {
        right: 30.6%;
    }

    .form {
        width: unset !important;
    }

    @media (max-width: 550px) {
        .main-box {
            padding: 60px 10px 50px 10px;
            gap: 10px;
        }

        .btn-login {
            right: 20%;
        }

        .fot-pass {
            align-items: start;
        }

        .fot-pass input[type="checkbox"] {
            margin-top: 2px;
            width: 23px;
            height: 19px;
        }
    }
    </style>
</head>

<body>
    <section class="reg-page">
        <div class="containers">
            <div class="inner-login">
                <!-- form is removed from her  -->
                <div class="main-box form">
                    <div class="img">
                        <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M72 36C72 55.8889 55.8889 72 36 72C27.9444 72 20.5 69.3611 14.4722 64.8611L19 60.3333C19.5833 59.75 20.5 59.6667 21.1944 60.1111C25.6111 62.9167 30.8611 64.5278 36.4722 64.5278C52.3333 64.5278 65.1667 51.6944 65.1667 35.8333C65.1667 35.25 65.1389 34.6389 65.1111 34.0556C65.0556 33.1389 64.2778 32.4167 63.3611 32.4167H58.3611C57.3611 32.4167 56.5278 33.2778 56.6111 34.3056C56.6667 34.8611 56.6667 35.4167 56.6667 36C56.6667 47.25 47.5556 56.3611 36.3056 56.3611C32.4722 56.3611 28.8889 55.3056 25.8333 53.4722C23.1389 51.8611 20.8333 49.6111 19.1667 46.9722C17.1389 43.8056 15.9722 40.0278 15.9722 36C15.9722 34.7778 16.0833 33.6111 16.2778 32.4444C17.9722 22.8889 26.3056 15.6389 36.3333 15.6389C39.4722 15.6389 42.4722 16.3611 45.1389 17.6389C46.2222 18.1667 46.4722 19.6111 45.6389 20.4444L40.6111 25.5L33.6944 32.4444L26.75 39.3889C26.1944 39.9444 26.0833 40.8056 26.4722 41.4722C27.6111 43.5 29.3333 45.1667 31.4444 46.1667C32.1111 46.5 32.9167 46.3611 33.4445 45.8333L46.8333 32.4167L47.0278 32.2222L53.7778 25.4444L58.8611 20.3611C59.4722 19.7222 59.5556 18.7222 59 18.0278C57.3889 16 55.5 14.1667 53.4167 12.6389C48.6667 9.16667 42.8333 7.11111 36.5 7.11111C21.8056 7.11111 9.69444 18.1667 8 32.3889C7.86111 33.5 7.80556 34.6389 7.80556 35.8056C7.80556 41.6667 9.55556 47.1111 12.5556 51.6389C13 52.3333 12.9167 53.25 12.3333 53.8333L7.94445 58.2222C7.88889 58.2778 7.86111 58.3333 7.80556 58.3889C2.91667 52.25 0 44.4722 0 36C0 16.1111 16.1111 0 36 0C55.8889 0 72 16.1111 72 36Z"
                                fill="#34FF67" />
                        </svg>
                    </div>
                    <h5 class="heading">Create Your Account</h5>
                    <span class="sub-heading">Join us to get started. It only takes a minute.</span>
                    <div style="z-index: 2" class="toggle-btn">
                        <input type="button" value="Register Company" class="btn-green" id="companyBtn"
                            onclick="showCompanyForm()" />
                        <input type="button" value="Register User" class="btn-green-inv" id="userBtn"
                            onclick="showUserForm()" />
                    </div>
                    <!-- company Form start here -->
                    <form action="<?= base_url('company-registeration-data') ?>" name="companyForm" id="companyForm"
                        method="post">
                        <!-- SECURITY FIX: Add CSRF token to form -->
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                        <div class="inputs mt-10">
                            <label for="comName">Company Name</label>
                            <input type="text" name="comName" id="comName" placeholder="Enter Company Name" />
                        </div>
                        <div class="inputs mt-10">
                            <label for="comName">User Name</label>
                            <input type="text" name="userName" id="userName" placeholder="Enter Company Name" />
                        </div>
                        <div class="inputs mt-10">
                            <label for="cPhone">Phone</label>
                            <input type="tel" name="cPhone" id="cPhone" placeholder="Enter Phone number" />
                        </div>
                        <div class="inputs mt-10">
                            <label for="Cemail">Email</label>
                            <input type="email" name="Cemail" id="Cemail" placeholder="Enter Your Email" />
                        </div>
                        <div class="inputs mt-10">
                            <label for="Cpassword">Password</label>
                            <input type="password" name="Cpassword" id="Cpassword" placeholder="Enter Your Password" />
                        </div>
                        <div class="fot-pass mt-10">
                            <input type="checkbox" name="cCbox" id="cCbox" />
                            <span>
                                I agree to the
                                <a href="#">Terms & Conditions and Privacy Policy.</a>
                            </span>
                        </div>
                        <div class="fot-pass mt-10">
                            <span> Already have account? <a href="<?=base_url()?>">Login Here</a></span>
                        </div>
                        <div>
                            <input type="submit" value="Sign Up" class="btn-login" />
                        </div>
                    </form>

                    <!-- company Form End here -->
                    <!-- user Form start here -->
                    <form action="<?=base_url('user-registeration-data')?>" name="userForm" id="userForm" method="post"
                        style="display: none">
                        <!-- SECURITY FIX: Add CSRF token to form -->
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                        <div class="inputs mt-10">
                            <label for="usrName">User Name</label>
                            <input type="text" name="usrName" id="usrName" placeholder="Enter User Name" />
                        </div>
                        <div class="inputs mt-10">
                            <label for="UPhone">Phone</label>
                            <input type="tel" name="UPhone" id="UPhone" placeholder="Enter Phone number" />
                        </div>
                        <div class="inputs mt-10">
                            <label for="uemail">Email</label>
                            <input type="email" name="uemail" id="uemail" placeholder="Enter Your Email" />
                        </div>
                        <div class="inputs mt-10">
                            <label for="password">Password</label>
                            <input type="password" name="upassword" id="upassword" placeholder="Enter Your Password" />
                        </div>

                        <div class="fot-pass mt-10">
                            <input type="checkbox" name="uCbox" id="uCbox" />
                            <span>
                                I agree to the
                                <a href="#">Terms & Conditions and Privacy Policy.</a><br>
                            </span><br>
                        </div>
                        <div class="fot-pass mt-10">
                            <span> Already have account? <a href="<?=base_url()?>">Login Here</a></span>
                        </div>
                        <div>
                            <input type="submit" value="Sign Up" class="btn-login" />
                        </div>
                    </form>
                    <!-- user Form End here -->
                </div>
            </div>
        </div>
    </section>

    <script>
    function showCompanyForm() {
        document.getElementById("companyForm").style.display = "block";
        document.getElementById("userForm").style.display = "none";
        document.getElementById("companyBtn").className = "btn-green";
        document.getElementById("userBtn").className = "btn-green-inv";
    }

    function showUserForm() {
        document.getElementById("companyForm").style.display = "none";
        document.getElementById("userForm").style.display = "block";
        document.getElementById("companyBtn").className = "btn-green-inv";
        document.getElementById("userBtn").className = "btn-green";
    }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/toastr/toastr.min.js"></script>
    <?php
if ($this->session->flashdata('alreadyRegistered') != '') {
?>
    <script type="text/javascript">
    toastr.options = {
        "closeButton": true,
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    toastr.error('Email already registered. Please try another email.');
    </script>
    <?php
}
?>
    <?php
if ($this->session->flashdata('ageeremntError') != '') {
?>
    <script type="text/javascript">
    toastr.options = {
        "closeButton": true,
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    toastr.error('Please agree to the terms and conditions.');
    </script>
    <?php
}
?>
</body>


</html>