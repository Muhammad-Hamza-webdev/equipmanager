<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="<?=base_url()?>assets/images/logo-icon.png" type="image/png" />
    <!-- Website CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/style.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/header.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/footer.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/resopnsive.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <!-- Website Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..28,100..900;1,14..28,100..900&display=swap" rel="stylesheet">
    <title>Settings - EquipManager</title>
    <style>
        :root {
            --primary-brand: #13372E;
            --accent-green: #2A7A66;
            --text-primary: #1A1A1A;
            --text-secondary: #6B7280;
            --text-light: #FFFFFF;
            --body-bg: #F5F6F8;
            --card-bg: #FFFFFF;
            --border-color: #E5E7EB;
            --border-dark: #D1D5DB;
            --shadow: 0px 4px 12px rgba(0, 0, 0, 0.05);
        }

        body {
            background-color: var(--body-bg);
            font-family: "Manrope", "Inter", sans-serif;
        }

        .dashboard-container {
            display: flex;
            gap: 0;
            min-height: calc(100vh - 200px);
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .dashboard-content {
            flex: 1;
            background-color: var(--body-bg);
            padding: 0 32px 32px 32px;
            overflow-y: auto;
        }

        .settings-card-container {
            background-color: var(--card-bg);
            border-radius: 12px;
            box-shadow: var(--shadow);
            padding: 40px;
            max-width: 900px;
            width: 100%;
            margin: 0 auto;
        }

        /* Section 1 — Profile Image */
        .profile-image-section {
            display: flex;
            align-items: flex-start;
            gap: 24px;
            padding-bottom: 32px;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 32px;
        }

        .profile-avatar-large {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            background-color: var(--primary-brand);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
            font-size: 32px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .profile-image-actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
            flex-grow: 1;
        }

        .button-row {
            display: flex;
            gap: 16px;
        }

        .btn-change-image {
            background-color: var(--primary-brand);
            color: var(--text-light);
            padding: 10px 24px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: opacity 0.2s ease;
        }

        .btn-change-image:hover {
            opacity: 0.9;
        }

        .btn-remove-image {
            background-color: transparent;
            color: var(--text-primary);
            border: 1px solid var(--border-dark);
            padding: 10px 24px;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-remove-image:hover {
            background-color: #f9f9f9;
            border-color: var(--text-primary);
        }

        .helper-text {
            font-size: 13px;
            color: var(--text-secondary);
            margin-top: 4px;
        }

        /* Section 2 — Personal Information */
        .personal-info-section {
            margin-bottom: 32px;
        }

        .section-heading {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 24px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .input-label {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .form-input {
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 14px;
            width: 100%;
            font-family: inherit;
            transition: border-color 0.2s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--accent-green);
        }

        /* Section 3 — Account Security */
        .account-security-section {
            margin-bottom: 48px;
        }

        .security-rows-container {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .security-row {
            display: flex;
            align-items: flex-end;
            gap: 24px;
        }

        .security-input-group {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .security-input-wrapper {
            position: relative;
        }

        .security-input {
            width: 100%;
            height: 46px;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.2s ease;
        }

        .security-input:focus {
            outline: none;
            border-color: var(--accent-green);
        }

        .password-toggle-icon {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            cursor: pointer;
            font-size: 18px;
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--text-primary);
            color: var(--text-primary);
            font-weight: 500;
            font-size: 14px;
            padding: 12px 24px;
            border-radius: 6px;
            height: 46px;
            white-space: nowrap;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-outline:hover {
            background-color: #f9f9f9;
            border-color: var(--accent-green);
            color: var(--accent-green);
        }

        /* Footer Action — Save Changes */
        .settings-footer {
            margin-top: 48px;
            display: flex;
            justify-content: center;
        }

        .btn-save {
            background-color: var(--primary-brand);
            color: var(--text-light);
            padding: 12px 32px;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            transition: opacity 0.2s ease;
        }

        .btn-save:hover {
            opacity: 0.9;
        }

        .main-wrapper {
            padding: 0 40px;
            max-width: 1600px;
            margin: 0 auto;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .dashboard-content {
                padding: 24px;
            }

            .settings-card-container {
                padding: 32px;
            }
        }

        @media (max-width: 768px) {
            .dashboard-container {
                flex-direction: column;
            }

            .security-row {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-outline {
                width: 100%;
            }

            .profile-image-section {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .button-row {
                justify-content: center;
            }

            .settings-card-container {
                padding: 24px;
            }

            .main-wrapper {
                padding: 0 20px;
            }
        }

        @media (max-width: 480px) {
            .button-row {
                flex-direction: column;
            }

            .btn-change-image,
            .btn-remove-image {
                width: 100%;
                justify-content: center;
            }

            .settings-card-container {
                padding: 20px;
            }

            .main-wrapper {
                padding: 0 16px;
            }
        }
    </style>
</head>
<body>
    <!-- Website Header -->
    <?php $this->load->view('components/websiteHeader'); ?>

    <div class="main-wrapper">
        <!-- Main Dashboard Container -->
        <div class="dashboard-container">
            <!-- Dashboard Sidebar Component -->
            <?php $this->load->view('components/dashboardSidebar', ['active_page' => 'settings']); ?>

            <!-- Main Content -->
            <main class="dashboard-content">
                <div class="settings-card-container">
                    <!-- Section 1: Profile Image -->
                    <div class="profile-image-section">
                        <div class="profile-avatar-large">
                            <?php 
                                $login_data = $this->session->userdata('loginData');
                                $user_name = isset($login_data['userName']) ? $login_data['userName'] : 'User';
                                echo strtoupper(substr($user_name, 0, 2));
                            ?>
                        </div>
                        <div class="profile-image-actions">
                            <div class="button-row">
                                <button class="btn-change-image">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 1V15M1 8H15" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                    Change Image
                                </button>
                                <button class="btn-remove-image">Remove</button>
                            </div>
                            <div class="helper-text">We support PNG's, JPGs, and GIFs under 2MB</div>
                        </div>
                    </div>

                    <!-- Section 2: Personal Information -->
                    <div class="personal-info-section">
                        <h2 class="section-heading">Personal Information</h2>
                        
                        <form id="settingsForm" class="form-grid">
                            <div class="input-group">
                                <label class="input-label">First Name</label>
                                <input type="text" class="form-input" placeholder="John" value="<?= htmlspecialchars($login_data['userName'] ?? '') ?>" />
                            </div>

                            <div class="input-group">
                                <label class="input-label">Last Name</label>
                                <input type="text" class="form-input" placeholder="Doe" />
                            </div>

                            <div class="input-group">
                                <label class="input-label">Email Address</label>
                                <input type="email" class="form-input" placeholder="john@example.com" value="<?= htmlspecialchars($login_data['userEmail'] ?? '') ?>" />
                            </div>

                            <div class="input-group">
                                <label class="input-label">Phone Number</label>
                                <input type="tel" class="form-input" placeholder="+1 (555) 123-4567" />
                            </div>

                            <div class="input-group">
                                <label class="input-label">Company Name</label>
                                <input type="text" class="form-input" placeholder="Your Company" />
                            </div>

                            <div class="input-group">
                                <label class="input-label">Location</label>
                                <input type="text" class="form-input" placeholder="City, Country" />
                            </div>
                        </form>
                    </div>

                    <!-- Section 3: Account Security -->
                    <div class="account-security-section">
                        <h2 class="section-heading">Account Security</h2>
                        
                        <div class="security-rows-container">
                            <!-- Phone Number Row -->
                            <div class="security-row">
                                <div class="security-input-group">
                                    <label class="input-label">Phone Number</label>
                                    <div class="security-input-wrapper">
                                        <input type="tel" class="security-input" placeholder="+1 (555) 123-4567" readonly />
                                    </div>
                                </div>
                                <button type="button" class="btn-outline">Change Phone No.</button>
                            </div>

                            <!-- Email Row -->
                            <div class="security-row">
                                <div class="security-input-group">
                                    <label class="input-label">Email Address</label>
                                    <div class="security-input-wrapper">
                                        <input type="email" class="security-input" placeholder="your@email.com" readonly />
                                    </div>
                                </div>
                                <button type="button" class="btn-outline">Change Email</button>
                            </div>

                            <!-- Password Row -->
                            <div class="security-row">
                                <div class="security-input-group">
                                    <label class="input-label">Password</label>
                                    <div class="security-input-wrapper">
                                        <input type="password" class="security-input" placeholder="••••••••" readonly />
                                        <i class="bi bi-eye-off password-toggle-icon" id="passwordToggle"></i>
                                    </div>
                                </div>
                                <button type="button" class="btn-outline">Change Password</button>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Action: Save Changes -->
                    <div class="settings-footer">
                        <button type="submit" class="btn-save">Save Changes</button>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Website Footer -->
    <?php $this->load->view('components/websiteFooter'); ?>

    <!-- Scripts -->
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script>
        // Password visibility toggle
        const passwordToggle = document.getElementById('passwordToggle');
        const passwordInput = document.querySelector('input[type="password"]');

        if (passwordToggle) {
            passwordToggle.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    passwordToggle.classList.remove('bi-eye-off');
                    passwordToggle.classList.add('bi-eye');
                } else {
                    passwordInput.type = 'password';
                    passwordToggle.classList.remove('bi-eye');
                    passwordToggle.classList.add('bi-eye-off');
                }
            });
        }

        function logoutUser() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = '<?= base_url('logout') ?>';
            }
        }

        function navigateTo(page) {
            window.location.href = '<?= base_url() ?>' + page;
        }
    </script>
</body>
</html>
