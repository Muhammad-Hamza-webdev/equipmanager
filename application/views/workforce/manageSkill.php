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

  <title>Add Skill</title>
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
          Workforce Skill
        </div>
      </div>
      <!--end breadcrumb-->

      <div class="row">
        <div class="col-xl-12 mx-auto">
          <div class="card">
            <div class="card-body">
              <form action="<?= base_url('add-skill-data') ?>" method="post">
                <!-- SECURITY FIX: Add CSRF token to form -->
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                <div class="border p-4 rounded">
                  <div class="card-title d-flex align-items-center">
                    <h5 class="mb-0">Add New Skill</h5>
                  </div>
                  <hr />
                  <div class="row mb-3">
                    <label
                      for="skillName"
                      class="col-sm-3 col-form-label">New Skill Name</label>
                    <div class="col-sm-9">
                      <input
                        type="text"
                        class="form-control"
                        id="skillName"
                        name="skillName"
                        placeholder="Enter New Skill Name" />
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="skillDescription" class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-9">
                      <textarea
                        class="form-control"
                        id="skillDescription"
                        name="skillDescription"
                        rows="3"
                        placeholder="Description"></textarea>
                    </div>
                  </div>

                  <div class="row">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                      <button
                        type="submit"
                        class="btn btn-primary px-5 btn-clash">
                        Add  Skill
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <div class="table-responsive mt-3">
            <table class="table align-middle">
              <thead class="table-secondary bg-sky-blue font-clash-green">
                <tr>
                  <th>Skill Name</th>
                  <th>Description</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (!empty($skills) && is_array($skills)) {
                  foreach ($skills as $skill) {
                ?>
                    <tr>
                      <td><?= $skill['skillName'] ?></td>
                      <td><?= $skill['skillDesc'] ?></td>
                      <td>
                        <div
                          class="table-actions d-flex align-items-center gap-3 fs-6">
                          <a
                            href="javascript:;"
                            class="text-warning"
                            data-bs-toggle="modal"
                          data-bs-target="#exampleModal_<?=$skill['skillID']?>"
                            title="Edit"><i class="bi bi-pencil-fill"></i></a>
                          <!-- Modal -->
                          <div
                            class="modal fade"
                            id="exampleModal_<?=$skill['skillID']?>"
                            tabindex="-1"
                            aria-labelledby="exampleModalLabel"
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
                                            <h5 class="mb-0">Edit Skill</h5>
                                          </div>
                                          <hr />
                                          <form action="<?=base_url('update-skill-data/'.$skill['skillID'])?>" method="post">
                                            <!-- SECURITY FIX: Add CSRF token to form -->
                                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                          <div class="row mb-3">
                                            <label
                                              for="skillName"
                                              class="col-sm-3 col-form-label">Skill Name</label>
                                            <div class="col-sm-9">
                                              <input
                                                type="text"
                                                class="form-control"
                                                id="skillName"
                                                name="skillName"
                                                value="<?= $skill['skillName'] ?>"
                                                placeholder="Enter New Skill Name" />
                                            </div>
                                          </div>
                                          <div class="row mb-3">
                                            <label
                                              for="skillDescription"
                                              class="col-sm-3 col-form-label">Description</label>
                                            <div class="col-sm-9">
                                              <textarea
                                                class="form-control"
                                                id="skillDescription"
                                                name="skillDescription"
                                                rows="3"
                                                placeholder="Address"><?php echo $skill['skillDesc'] ?></textarea>
                                            </div>
                                          </div>

                                          <div class="row">
                                            <label class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-9">
                                              <button
                                                type="submit"
                                                class="btn btn-primary px-5 btn-clash">
                                                Update Skill
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
                              </div>
                            </div>
                          </div>




                          <a
                            href="<?= base_url('delet-skill/' . $skill['skillID']) ?>"
                            class="text-danger"
                            onclick="return confirm('Are you sure you want to delete this skill?');"
                            data-bs-toggle="tooltip"
                            data-bs-placement="bottom"
                            title="Delete"><i class="bi bi-trash-fill"></i></a>
                        </div>
                      </td>
                    </tr>
                  <?php
                  }
                } else {
                  ?>
                  <tr>
                    <td colspan="3" class="text-center">No Skills Added Yet!</td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
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
      toastr.success('Skill Added!');
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
      toastr.error('Please fill all fields!');
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
      toastr.success('Skill Deleted!');
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
      toastr.success('Skill Updated!');
    </script>
  <?php
  }
  ?>
</body>

</html>