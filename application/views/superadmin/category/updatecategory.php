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
    <title>Update Category</title>
    <style>
        .bg-dark-green img {
            background-color: #0b2523 !important;
            border-radius: 10px;
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
                    Super Category Update
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="row">
                <div class="col-xl-12 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex align-items-center">
                                    <h5 class="mb-0">Update Super Category</h5>
                                </div>
                                <hr />
                                <?php foreach ($updateCategory as $catdata) { ?>
                                    <form action="<?= base_url('process-update-cat') ?>" method="post" enctype="multipart/form-data">
                                        <!-- SECURITY FIX: Add CSRF token to form -->
                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" name="catID" value="<?= $catdata['web_catID'] ?>">

                                        <div class="row mb-3">
                                            <label for="catIcon" class="col-sm-3 col-form-label">Upload Icon</label>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control" id="catIcon" name="catIcon" />
                                                <!-- Show current icon -->
                                                <?php if (!empty($catdata['web_catIcon'])) { ?>
                                                    <div class="mt-2 bg-dark-green">
                                                        <small>Current Icon:</small>
                                                        <img src="<?= base_url('assets/uploads/superadmin/category/' . $catdata['web_catIcon']) ?>" alt="icon" width="30" height="30" class="ms-2">
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="catName" class="col-sm-3 col-form-label">Category Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="catName" name="catName" required value="<?= $catdata['web_catName'] ?>" placeholder="Enter Category Name" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="catDesc" class="col-sm-3 col-form-label">Description</label>
                                            <div class="col-sm-9">
                                                <textarea
                                                    class="form-control"
                                                    id="catDesc"
                                                    name="catDesc"
                                                    rows="3"
                                                    required placeholder="Write Description"><?= $catdata['web_catDesp'] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="card-title d-flex align-items-center">
                                            <h5 class="mb-0">Category page SEO (Optional)</h5>
                                        </div>
                                        <hr />
                                        <div class="row mb-3">
                                            <label
                                                for="metaTittle"
                                                class="col-sm-3 col-form-label">Page Tittle<br><span>(Don't fill if you want auto generate)</span></label>
                                            <div class="col-sm-9">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    value="<?=$catdata['metaTittle'] ?> "
                                                    id="metaTittle"
                                                    name="metaTittle"
                                                    placeholder="Page Title" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label
                                                for="metaDesc"
                                                class="col-sm-3 col-form-label">Meta Description</label>
                                            <div class="col-sm-9">
                                                <textarea
                                                    class="form-control"
                                                    id="metaDesc"

                                                    name="metaDesc"
                                                    rows="3"
                                                    placeholder="Meta Description"><?=$catdata['metaDesc'] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label
                                                for="metaKeyword"
                                                class="col-sm-3 col-form-label">Meta Keyword<br><span>(Seperate each keywork by coma , )</span></label>
                                            <div class="col-sm-9">
                                                <textarea
                                                    class="form-control"
                                                    id="metaKeyword"
                                                    name="metaKeyword"
                                                    rows="3"
                                                    placeholder="Meta Keywords"><?=$catdata['metaKeywords'] ?></textarea>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row mb-3">

                                            <div class="col-sm-6">
                                                <label for="heading1">heading 1</label>
                                                <input
                                                    class="form-control"
                                                    type="text"
                                                    id="heading1"
                                                    value="<?=$catdata['h1'] ?> "
                                                    name="heading1"
                                                    placeholder="Heading 1" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="heading2">heading 2</label>
                                                <input
                                                    class="form-control"
                                                    type="text"
                                                    id="heading2"
                                                    value="<?=$catdata['h2'] ?> "

                                                    name="heading2"
                                                    placeholder="Heading 2" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">

                                            <div class="col-sm-6">
                                                <label for="headingDesc1">Heading description 1</label>
                                                <input
                                                    class="form-control"
                                                    type="text"
                                                    value="<?=$catdata['p1'] ?> "
                                                    id="headingDesc1"
                                                    name="headingDesc1"
                                                    placeholder="Heading Description 1" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="headingDesc2">Heading description 2</label>
                                                <input
                                                    class="form-control"
                                                    type="text"
                                                    id="headingDesc2"
                                                    value="<?=$catdata['p2'] ?> "
                                                    name="headingDesc2"
                                                    placeholder="Heading Description 2" />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-9">
                                                <button type="submit" class="btn btn-primary px-5 btn-clash">
                                                    Update Category
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                <?php } ?>
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