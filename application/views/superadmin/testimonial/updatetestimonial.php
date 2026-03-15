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
    <title>Update Testimonial</title>
    <style>
        .bg-dark-green img {
            background-color: #0b2523 !important;
            border-radius: 10px;
        }

        .red {
            color: red;
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
                    Update Testimonial
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="row">
                <div class="col-xl-12 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex align-items-center">
                                    <h5 class="mb-0">Update Testimonial</h5>
                                </div>
                                <hr />
                                <?php foreach ($testimonialData as $testiData) { ?>
                                    <form action="<?= base_url('process-update-testi/' . $testiData['web_testimonialID']) ?>" method="post" enctype="multipart/form-data">
                                        <!-- SECURITY FIX: Add CSRF token to form -->
                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

                                        <div class="row mb-3">
                                            <label for="testiRating" class="col-sm-3 col-form-label">Rating</label>
                                            <div class="col-sm-9">
                                                <select name="testiRating" id="testiRating" class="form-control">
                                                    <option value="">Select Rating</option>
                                                    <option value="1" <?= isset($testiData['web_testimonialRating']) && $testiData['web_testimonialRating'] == '1' ? 'selected' : '' ?>>1 Star</option>
                                                    <option value="2" <?= isset($testiData['web_testimonialRating']) && $testiData['web_testimonialRating'] == '2' ? 'selected' : '' ?>>2 Star</option>
                                                    <option value="3" <?= isset($testiData['web_testimonialRating']) && $testiData['web_testimonialRating'] == '3' ? 'selected' : '' ?>>3 Star</option>
                                                    <option value="4" <?= isset($testiData['web_testimonialRating']) && $testiData['web_testimonialRating'] == '4' ? 'selected' : '' ?>>4 Star</option>
                                                    <option value="5" <?= isset($testiData['web_testimonialRating']) && $testiData['web_testimonialRating'] == '5' ? 'selected' : '' ?>>5 Star</option>
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
                                                    placeholder="Write User Review"><?= $testiData['web_testimonialDesp'] ?></textarea>
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
                                                    name="testiImage"
                                                    placeholder="Enter Category Name" />
                                                <div class="mt-2 text-muted">
                                                    <small>Acceptable image formats JPG, JPEG, PNG, SVG Max Size 500KB</small><br>
                                                    <small class="red">Select the current image again if you don't want to change new image.</small>
                                                </div>
                                                <!-- Show current icon -->
                                                <?php if (!empty($testiData['web_testimonialImg'])) { ?>
                                                    <div class="mt-2 bg-dark-green">
                                                        <small>Current Icon:</small>
                                                        <img src="<?= base_url('assets/uploads/superadmin/testimonial/' . $testiData['web_testimonialImg']) ?>" alt="icon" width="50" height="50" class="ms-2">
                                                    </div>
                                                <?php } ?>
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
                                                    value="<?= $testiData['web_testimonialName'] ?>"
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
                                                    value="<?= $testiData['web_testimonialLocation'] ?>"
                                                    placeholder="Enter User Location" />
                                            </div>
                                        </div>


                                        <div class="row">
                                            <label class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-9">
                                                <button
                                                    type="submit"
                                                    class="btn btn-primary px-5 btn-clash">
                                                    Update Testimonial
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->


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