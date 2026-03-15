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
    <link
        href="<?= base_url() ?>assets/plugins/datatable/css/dataTables.bootstrap5.min.css"
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
    <link rel="stylesheet" href="<?= base_url() ?>assets/toastr/toastr.min.css" />
    <title>Manage Testimonial</title>
    <style>
        .checkbox-apple {
            position: relative;
            width: 50px;
            height: 25px;
            margin: 20px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .checkbox-apple label {
            position: absolute;
            top: 0;
            left: 0;
            width: 50px;
            height: 25px;
            border-radius: 50px;
            background: linear-gradient(to bottom, #b3b3b3, #e6e6e6);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .checkbox-apple label:after {
            content: '';
            position: absolute;
            top: 1px;
            left: 1px;
            width: 23px;
            height: 23px;
            border-radius: 50%;
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .checkbox-apple input[type="checkbox"]:checked+label {
            background: linear-gradient(to bottom, #4cd964, #5de24e);
        }

        .checkbox-apple input[type="checkbox"]:checked+label:after {
            transform: translateX(25px);
        }

        .checkbox-apple label:hover {
            background: linear-gradient(to bottom, #b3b3b3, #e6e6e6);
        }

        .checkbox-apple label:hover:after {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        .yep {
            position: absolute;
            top: 0;
            left: 0;
            width: 50px;
            height: 25px;
        }
    </style>
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
                    Testimonial Management
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="row">
                <div class="col-xl-12 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex align-items-center">
                                    <h5 class="mb-0">Add Testimonial</h5>
                                </div>
                                <hr />
                                <form action="<?= base_url('add-testimoni') ?>" method="post" enctype="multipart/form-data">
                                    <!-- SECURITY FIX: Add CSRF token to form -->
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

                                    <div class="row mb-3">
                                        <label for="testiRating" class="col-sm-3 col-form-label">Rating</label>
                                        <div class="col-sm-9">
                                            <select name="testiRating" required id="testiRating" class="form-control">
                                                <option value="">Select Rating</option>
                                                <option value="1">1 Star</option>
                                                <option value="2">2 Star</option>
                                                <option value="3">3 Star</option>
                                                <option value="4">4 Star</option>
                                                <option value="5">5 Star</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="testiReview" class="col-sm-3 col-form-label">User Review</label>
                                        <div class="col-sm-9">
                                            <textarea
                                                class="form-control"
                                                id="testiReview"
                                                name="testiReview"
                                                rows="3"
                                                required
                                                placeholder="Write User Review"></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label
                                            for="testiImage"
                                            class="col-sm-3 col-form-label">Upload Image</label>
                                        <div class="col-sm-9">
                                            <input
                                                type="file"
                                                class="form-control"
                                                id="testiImage"
                                                name="testiImage" />
                                            <div class="mt-2 text-muted">
                                                <small>Acceptable image formats JPG, JPEG, PNG, SVG Max Size 500KB</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label
                                            for="testiName"
                                            class="col-sm-3 col-form-label">Client Name</label>
                                        <div class="col-sm-9">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="testiName"
                                                name="testiName"
                                                required
                                                placeholder="Enter Client Name" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label
                                            for="testiLocation"
                                            class="col-sm-3 col-form-label">Location</label>
                                        <div class="col-sm-9">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="testiLocation"
                                                name="testiLocation"
                                                required
                                                placeholder="Enter User Location" />
                                        </div>
                                    </div>


                                    <div class="row">
                                        <label class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">
                                            <button
                                                type="submit"
                                                class="btn btn-primary px-5 btn-clash">
                                                Add Testimonial
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->

            <!--end breadcrumb-->
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-0">Manage Testimonial</h5>
                    <div class="table-responsive mt-3">
                        <table class="table align-middle manage-testimonial">
                            <thead class="table-secondary bg-sky-blue font-clash-green">
                                <tr>
                                    <th style="width: 10%;">Testimonial Rating</th>
                                    <th style="width: 35%;">Testimonial Description</th>
                                    <th>Client Image</th>
                                    <th>Client Name</th>
                                    <th>Client Location</th>
                                    <th>Status</th>
                                    <th></th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($showtestimonialdata)) {
                                    foreach ($showtestimonialdata as $superTesti) { ?>
                                        <tr>
                                            <th style="width: 10%;"><?= !empty($superTesti['web_testimonialRating']) ? $superTesti['web_testimonialRating'] . ' Star' : '' ?></th>
                                            <td style="width: 35%;">
                                                <?php
                                                // Prepare short (10 words) and full descriptions safely
                                                $fullDesc = $superTesti['web_testimonialDesp'] ?? '';
                                                // split on whitespace, preserve words
                                                $words = preg_split('/\s+/', strip_tags($fullDesc));
                                                $shortDesc = implode(' ', array_slice($words, 0, 10));
                                                $needsToggle = count($words) > 10;
                                                ?>
                                                <div class="testi-desc">
                                                    <span class="text-short"><?= htmlspecialchars($shortDesc) ?><?= $needsToggle ? '...' : '' ?></span>
                                                    <span class="text-full" style="display:none"><?= nl2br(htmlspecialchars($fullDesc)) ?></span>
                                                    <?php if ($needsToggle) { ?>
                                                        &nbsp;<a href="#" class="toggle-desc" style="color:#34FF67;">Read more</a>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td>
                                                <img src="<?= base_url('assets/uploads/superadmin/testimonial/' . $superTesti['web_testimonialImg']) ?>" alt="Image" width="50" height="50" class="ms-2">
                                            </td>
                                            <td><?= $superTesti['web_testimonialName'] ?></td>
                                            <td><?= $superTesti['web_testimonialLocation'] ?></td>
                                            <td><?= ($superTesti['web_testimonialStatus'] == 1) ? 'Active' : 'Inactive' ?>
                                            </td>
                                            <td><a href="<?= base_url('change-testi-status/' . $superTesti['web_testimonialID']) ?>/<?= $superTesti['web_testimonialStatus'] ?>" data-bs-toggle="tooltip"
                                                    data-bs-placement="bottom"
                                                    title="Status">
                                                    <div class="checkbox-apple">
                                                        <input class="yep" id="check-apple" type="checkbox" <?= ($superTesti['web_testimonialStatus'] == 1) ? 'checked' : '' ?> />
                                                        <label for="check-apple"></label>
                                                    </div>
                                                </a></td>
                                            <td>
                                                <a href="<?= base_url('update-testmoni/' . $superTesti['web_testimonialID']) ?>" class="text-warning ms-2"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="bottom"
                                                    title="Edit">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <a href="<?= base_url('delet-testmoni/' . $superTesti['web_testimonialID']) ?>"
                                                    class="text-danger ms-2"
                                                    onclick="return confirm('Are you sure you want to delete this testimonial?');"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="bottom"
                                                    title="Delete">
                                                    <i class="bi bi-trash-fill"></i>
                                                </a>

                                            </td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No Testimonial Added Yet!</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
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
    <script src="<?= base_url() ?>assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script src="<?= base_url() ?>assets/js/table-datatable.js"></script>
    <!--app-->
    <script src="<?= base_url() ?>assets/js/app.js"></script>
    <script src="<?= base_url() ?>assets/toastr/toastr.min.js"></script>
    <style>
        /* Enforce column sizing and wrapping for the testimonial table */
        .manage-testimonial {
            width: 100%;
            table-layout: fixed; /* allow column widths to be respected */
        }

        .manage-testimonial td,
        .manage-testimonial th {
            white-space: normal; /* allow wrapping */
            word-wrap: break-word;
            overflow-wrap: anywhere;
        }

        /* first column (rating) and second (description) widths */
        .manage-testimonial th:nth-child(1),
        .manage-testimonial td:nth-child(1) { width: 10%; }

        .manage-testimonial th:nth-child(2),
        .manage-testimonial td:nth-child(2) { width: 35%; }
    </style>

    <script>
        // Plain JS: delegate clicks on the toggle area and redirect to the enclosing anchor's href.
        document.addEventListener('click', function(e) {
            var wrapper = e.target.closest('.checkbox-apple');
            if (!wrapper) return;
            var anchor = wrapper.closest('a');
            if (!anchor) return;
            e.preventDefault();
            // Use href (absolute or relative)
            var href = anchor.getAttribute('href');
            if (href) window.location.href = href;
        });
            // Read more / Read less toggle for testimonials
            document.addEventListener('click', function(e) {
                var toggle = e.target.closest('.toggle-desc');
                if (!toggle) return;
                e.preventDefault();
                var container = toggle.closest('.testi-desc');
                if (!container) return;
                var shortEl = container.querySelector('.text-short');
                var fullEl = container.querySelector('.text-full');
                if (!shortEl || !fullEl) return;
                var isShowingFull = shortEl.style.display === 'none';
                if (isShowingFull) {
                    // currently showing full -> collapse
                    shortEl.style.display = '';
                    fullEl.style.display = 'none';
                    toggle.textContent = 'Read more';
                } else {
                    // expand
                    shortEl.style.display = 'none';
                    fullEl.style.display = '';
                    toggle.textContent = 'Read less';
                }
            });
    </script>
    <?php
    if ($this->session->flashdata('statusDeactivated') != '') {
    ?>
        <script type="text/javascript">
            toastr.options = {
                "closeButton": true,
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr.success('Testimonial deactivated successfully!');
        </script>
    <?php
    }
    ?>
    <?php
    if ($this->session->flashdata('statusActivated') != '') {
    ?>
        <script type="text/javascript">
            toastr.options = {
                "closeButton": true,
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr.success('Testimonial activated successfully!');
        </script>
    <?php
    }
    ?>
    <?php
    if ($this->session->flashdata('success-edited') != '') {
    ?>
        <script type="text/javascript">
            toastr.options = {
                "closeButton": true,
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr.success('Testimonial Updated!');
        </script>
    <?php
    }
    ?>
    <?php
    if ($this->session->flashdata('success') != '') {
    ?>
        <script type="text/javascript">
            toastr.options = {
                "closeButton": true,
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr.success('Testimonial Added!');
        </script>
    <?php
    }
    ?>
    <?php
    if ($this->session->flashdata('successDeleted') != '') {
    ?>
        <script type="text/javascript">
            toastr.options = {
                "closeButton": true,
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr.success('Testimonial Deleted!');
        </script>
    <?php
    }
    ?>
    <?php
    if ($this->session->flashdata('error') != '') {
    ?>
        <script type="text/javascript">
            toastr.options = {
                "closeButton": true,
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr.error('Please fill out all fields!');
        </script>
    <?php
    }
    ?>
</body>

</html>