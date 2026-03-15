<!DOCTYPE html>
<html lang="en" class="minimal-theme">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="<?= base_url() ?>assets/images/logo-icon.png" type="image/png" />
    <!--plugins-->
    <link href="<?= base_url() ?>assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link
        href="<?= base_url() ?>assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css"
        rel="stylesheet" />
    <link
        href="<?= base_url() ?>assets/plugins/metismenu/css/metisMenu.min.css"
        rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/bootstrap-extended.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/icons.css" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap"
        rel="stylesheet" />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />

    <!-- loader-->
    <link href="<?= base_url() ?>assets/css/pace.min.css" rel="stylesheet" />

    <!--Theme Styles-->
    <link href="<?= base_url() ?>assets/css/dark-theme.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/light-theme.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/semi-dark.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/header-colors.css" rel="stylesheet" />

    <title>System Settings - Equip Manager</title>
</head>

<body>
    <!--start wrapper-->
    <div class="wrapper">

        <?php $this->load->view('components/header'); ?>
        <?php $this->load->view('components/sidemenu'); ?>

        <!--start content-->
        <main class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3" style="border: none">
                    System Settings
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="row">
                <div class="col-xxl-6 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">Global Commission Rate</h6>
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('successUpdated')): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success!</strong> <?= $this->session->flashdata('successUpdated') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->session->flashdata('successAdded')): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success!</strong> <?= $this->session->flashdata('successAdded') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <form method="POST" action="<?= base_url('update-system-settings') ?>">
                                <!-- SECURITY FIX: Add CSRF token to form -->
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                <?php
                                // Get the marketplace commission setting
                                $commission = 5.00;
                                $description = 'Global commission percentage for all marketplace transactions';
                                
                                if ($settings && count($settings) > 0) {
                                    foreach ($settings as $setting) {
                                        if ($setting['settingKey'] == 'marketplace_commission_percent') {
                                            $commission = $setting['settingValue'];
                                            $description = $setting['description'];
                                            break;
                                        }
                                    }
                                }
                                ?>

                                <div class="mb-3">
                                    <label for="commissionRate" class="form-label">Commission Rate (%)</label>
                                    <input 
                                        type="number" 
                                        class="form-control" 
                                        id="commissionRate" 
                                        name="settingValue" 
                                        value="<?= htmlspecialchars($commission) ?>" 
                                        step="0.01"
                                        min="0"
                                        max="100"
                                        required
                                        placeholder="Enter commission percentage" />
                                    <small class="form-text text-muted">Set the global commission percentage for all marketplace transactions (equipment rentals/purchases and workforce services).</small>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea 
                                        class="form-control" 
                                        id="description" 
                                        name="description" 
                                        rows="3"
                                        placeholder="Enter description"><?= htmlspecialchars($description) ?></textarea>
                                </div>

                                <input type="hidden" name="settingKey" value="marketplace_commission_percent" />

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-circle"></i> Update Commission Rate
                                    </button>
                                    <a href="<?= base_url('admin-dashboard') ?>" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left"></i> Back to Dashboard
                                    </a>
                                </div>
                            </form>

                            <div class="alert alert-info mt-4">
                                <h6>Commission Information:</h6>
                                <ul class="mb-0">
                                    <li>This commission percentage applies to <strong>all marketplace transactions</strong></li>
                                    <li>It applies to both <strong>equipment rentals/purchases</strong> and <strong>workforce services</strong></li>
                                    <li>The commission is deducted from the seller's earnings</li>
                                    <li>Changes take effect immediately on new transactions</li>
                                    <li>Last updated: <?php 
                                        if ($settings && count($settings) > 0) {
                                            foreach ($settings as $setting) {
                                                if ($setting['settingKey'] == 'marketplace_commission_percent') {
                                                    echo date('M d, Y H:i A', strtotime($setting['updatedAt']));
                                                    break;
                                                }
                                            }
                                        }
                                    ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!--end page main-->

        <!--start overlay-->
        <div class="overlay nav-toggle-icon"></div>
        <!--end overlay-->

        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class="bx bxs-up-arrow-alt"></i></a>
        <!--End Back To Top Button-->
    </div>
    <!--end wrapper-->

    <!-- Bootstrap bundle JS -->
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="<?= base_url() ?>assets/js/pace.min.js"></script>
    <!--app-->
    <script src="<?= base_url() ?>assets/js/app.js"></script>
</body>

</html>
