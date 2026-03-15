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
    <title>Ticket Category</title>
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
                    Ticket Category Management
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="row">
                <div class="col-xl-12 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex align-items-center">
                                    <h5 class="mb-0">Ticket Category Metrics</h5>
                                </div>
                                <hr />
                                <form action="<?= base_url('add-ticket-cat-data') ?>" method="post" enctype="multipart/form-data">
                                    <!-- SECURITY FIX: Add CSRF token to form -->
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

                                    <div class="row mb-3">
                                        <label
                                            for="ticketCat"
                                            class="col-sm-3 col-form-label">Ticket Category</label>
                                        <div class="col-sm-9">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="ticketCat"
                                                name="ticketCat"
                                                required
                                                placeholder="Enter Ticket Category" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">
                                            <button
                                                type="submit"
                                                class="btn btn-primary px-5 btn-clash">
                                                Add Category
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
                    <h5 class="mb-0">Manage Success Metrics</h5>
                    <div class="table-responsive mt-3">
                        <table class="table align-middle">
                            <thead class="table-secondary bg-sky-blue font-clash-green">
                                <tr>
                                    <th>Ticket Category</th>
                                    <th>Status</th>
                                    <th></th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($ticketCat)) {
                                    foreach ($ticketCat as $cat) {
                                ?>
                                        <tr>
                                            <td><?= $cat['supportCat'] ?></td>
                                            <td><?= ($cat['supportCatStatus'] == 1) ? 'Active' : 'Inactive' ?></td>
                                            <td>
                                                <a href="<?= base_url('change-ticket-cat-status/' . $cat['supportTicketsCatID']) ?>/<?= $cat['supportCatStatus'] ?>" data-bs-toggle="tooltip"
                                                    data-bs-placement="bottom"
                                                    title="Status">
                                                    <div class="checkbox-apple">
                                                        <input class="yep" id="check-apple" type="checkbox" <?= ($cat['supportCatStatus'] == 1) ? 'checked' : '' ?> />
                                                        <label for="check-apple"></label>
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" class="text-warning ms-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal_<?= $cat['supportTicketsCatID']  ?>"
                                                    title="Edit">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <div
                                                    class="modal fade"
                                                    id="exampleModal_<?= $cat['supportTicketsCatID']  ?>"
                                                    tabindex="-1"
                                                    aria-labelledby="exampleModalLabel_<?= $cat['supportTicketsCatID']  ?>"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                                <button
                                                                    type="button"
                                                                    class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- body code -->

                                                                <div class="row">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <div class="border p-4 rounded">
                                                                                <div class="card-title d-flex align-items-center">
                                                                                    <h5 class="mb-0">Update Ticket Cateogry</h5>
                                                                                </div>
                                                                                <hr />
                                                                                <form method="post" action="<?= base_url('update-ticket-cat-data/'.$cat['supportTicketsCatID']) ?>">
                                                                                    <!-- SECURITY FIX: Add CSRF token to form -->
                                                                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                                                                    <div class="row mb-3">
                                                                                        <label
                                                                                            for="ticketCat"
                                                                                            class="col-sm-3 col-form-label">Ticket Category</label>
                                                                                        <div class="col-sm-9">
                                                                                            <input
                                                                                                type="text"
                                                                                                class="form-control"
                                                                                                id="ticketCat"
                                                                                                name="ticketCat"
                                                                                                value="<?= $cat['supportCat']  ?>"
                                                                                                placeholder="Enter Ticket Category" />
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row">
                                                                                        <label class="col-sm-3 col-form-label"></label>
                                                                                        <div class="col-sm-9">
                                                                                            <button
                                                                                                type="submit"
                                                                                                onclick="return addSkillData()"
                                                                                                class="btn btn-primary px-5 btn-clash">
                                                                                                Update Category
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- body code end here -->
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button
                                                                    type="button"
                                                                    class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    Close
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="<?= base_url('delet-ticket-cat/' . $cat['supportTicketsCatID']) ?>"
                                                    class="text-danger ms-2"
                                                    onclick="return confirm('Are you sure you want to delete this Ticket Category?');"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="bottom"
                                                    title="Delete">
                                                    <i class="bi bi-trash-fill"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No Metrics Added Yet!</td>
                                    </tr>
                                <?php
                                }
                                ?>
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
    </script>

    <?php
    if ($this->session->flashdata('newTicketCatOff') != '') {
    ?>
        <script type="text/javascript">
            toastr.options = {
                "closeButton": true,
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr.info('Ticket Category Deactivated!');
        </script>
    <?php
    }
    ?>
    <?php
    if ($this->session->flashdata('newTicketCatOnn') != '') {
    ?>
        <script type="text/javascript">
            toastr.options = {
                "closeButton": true,
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr.success('Ticket Category Activated!');
        </script>
    <?php
    }
    ?>
    <?php
    if ($this->session->flashdata('newTicketCatupdated') != '') {
    ?>
        <script type="text/javascript">
            toastr.options = {
                "closeButton": true,
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr.success('Ticket Category Updated!');
        </script>
    <?php
    }
    ?>

    <?php
    if ($this->session->flashdata('newTicketCatDlt') != '') {
    ?>
        <script type="text/javascript">
            toastr.options = {
                "closeButton": true,
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr.success('Ticket Category Deleted!');
        </script>
    <?php
    }
    ?>
    <?php
    if ($this->session->flashdata('newTicketCat') != '') {
    ?>
        <script type="text/javascript">
            toastr.options = {
                "closeButton": true,
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr.success('Ticket Category Added!');
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