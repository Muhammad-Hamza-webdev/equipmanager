<!DOCTYPE html>
<html lang="en" class="minimal-theme">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" href="<?= base_url() ?>assets/images/logo-icon.png" type="image/png" />
  <!--plugins-->
  <link href="<?= base_url() ?>assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
  <link href="<?= base_url() ?>assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
  <link href="<?= base_url() ?>assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
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


  <title>All Workforce</title>
</head>

<body>
  <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/select2/js/select2.min.js"></script>
  <script src="<?= base_url() ?>assets/js/form-select2.js"></script>
  <!--start wrapper-->
  <div class="wrapper">
    <?php $this->load->view('components/header'); ?>
    <?php $this->load->view('components/sidemenu'); ?>

    <!--start content-->
    <main class="page-content">
      <!--breadcrumb-->
      <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3" style="border: none">
          Workforce Management
        </div>
      </div>
      <!--end breadcrumb-->

      <div class="row">
        <div class="col-xl-3 mx-auto">
          <div class="card">
            <div class="card-body">
              <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Filter By</h6>
                <hr />
                <form class="row g-3" method="get" id="workforceFilter" name="workforceFilter">
                  <div class="col-12">
                    <label class="form-label">Skill</label>
                    <select name="personSkill" id="personSkill" class="form-control">
                      <option value="">Select Skill</option>
                      <?php
                      if ($skills && is_array($skills)) {
                        foreach ($skills as $skill) {
                      ?>
                          <option
                            <?php
                            if (isset($_GET['personSkill']) && $_GET['personSkill'] == $skill['skillID']) {
                              echo "selected";
                            }
                            ?>

                            value="<?= $skill['skillID'] ?>"><?= $skill['skillName'] ?></option>
                      <?php
                        }
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-12">
                    <label class="form-label"> Name</label>
                    <input
                      type="text"
                      name="personName"
                      id="personName"
                      value="<?php if (isset($_GET['personName'])) {
                                echo htmlspecialchars($_GET['personName'], ENT_QUOTES, 'UTF-8');
                              } ?>"
                      class="form-control"
                      placeholder="Enter Person Name" />
                  </div>

                  <div class="col-12">
                    <label class="form-label">Phone Number</label>
                    <input
                      type="number"
                      name="personPhone"
                      value="<?php if (isset($_GET['personPhone'])) {
                                echo $_GET['personPhone'];
                              } ?>"
                      id="personPhone"
                      class="form-control"
                      placeholder="Enter Phone Number" />
                  </div>
                  <div class="col-12">
                    <label class="form-label">Email</label>
                    <input
                      type="email"
                      class="form-control"
                      value="<?php if (isset($_GET['personEmail'])) {
                                echo $_GET['personEmail'];
                              } ?>"
                      name="personEmail"
                      id="personEmail"
                      placeholder="Enter Email Address" />
                  </div>
                  <div class="col-12">
                    <label class="form-label">Status</label>
                    <select name="status" id="status" class="form-control">
                      <option value="">Select Status</option>
                      <option
                        <?php

                        if (isset($_GET['status']) && $_GET['status'] == 1) {
                          echo "selected";
                        }
                        ?>
                        value="1">Available</option>
                      <option
                        <?php

                        if (isset($_GET['status']) && $_GET['status'] == 2) {
                          echo "selected";
                        }
                        ?>
                        value="2">Allocated</option>
                    </select>
                  </div>
                  <div class="col-12">
                    <div class="d-grid">
                      <?php
                      if (isset($_GET['personSkill'])) {
                      ?>
                        <a href="<?= base_url('all-workforce') ?>" style="color:#0f2f2c;margin-bottom:10px"><i class="bi bi-x-lg"></i> Clear Filter</a>
                      <?php
                      }
                      ?>
                      <button type="submit" class="btn btn-primary btn-clash">
                        Apply Filters
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-9 mx-auto">
          <div class="card">
            <div class="card-body">
              <div
                class="d-flex align-items-center justify-spc-btw flex-col-md">
                <h5 class="mb-0">Workforce List</h5>
                <div class="d-flex gap-20 justify-spc-btw-md flex-col-sm">
                  <div class="d-grid">
                    <!-- This is your button, now wrapped in a label -->
                    <!-- Button trigger modal -->
                    <button
                      type="button"
                      class="btn btn-primary btn-clash-sm"
                      data-bs-toggle="modal"
                      data-bs-target="#exampleModal">
                      Add Person
                    </button>
                  </div>
                  <div class="d-grid">
                    <!-- Manage Skills Button -->
                    <button
                      type="button"
                      class="btn btn-primary btn-clash-sm"
                      data-bs-toggle="modal"
                      data-bs-target="#manageskills">
                      Add Skills
                    </button>
                  </div>

                </div>
              </div>
              <div class="table-responsive mt-3">
                <table class="table align-middle">
                  <thead class="table-secondary bg-sky-blue font-clash-green">
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Skill</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if (!empty($workforces)) {

                      foreach ($workforces as $workforce) {
                    ?>

                        <tr>
                          <td>
                            <div
                              class="d-flex align-items-center gap-3 cursor-pointer">
                              <img
                                src="<?= base_url() ?>assets/uploads/workforce/<?= $workforce['personImg'] ?>"
                                class="rounded-circle"
                                width="44"
                                height="44"
                                alt="" />
                              <div class="">
                                <p class="mb-0"><?= h($workforce['personName']) ?></p>
                              </div>
                            </div>
                          </td>
                          <td><?= h($workforce['personEmail']) ?></td>
                          <td><?= h($workforce['personPhone']) ?></td>
                          <?php
                          $skillsArr = array_map('trim', explode(',', $workforce['skillNames']));
                          $maxToShow = 2;
                          ?>
                          <td>
                            <?php
                            // Show first two skills
                            for ($i = 0; $i < min($maxToShow, count($skillsArr)); $i++) {
                              echo '<span class="badge bg-secondary me-1">' . htmlspecialchars($skillsArr[$i]) . '</span>';
                            }

                            // If more than two, show "View More" link
                            if (count($skillsArr) > $maxToShow) {
                              $hiddenSkills = array_slice($skillsArr, $maxToShow);
                              $hiddenHtml = '';
                              foreach ($hiddenSkills as $skill) {
                                $hiddenHtml .= '<span class="badge bg-secondary me-1">' . htmlspecialchars($skill) . '</span>';
                              }
                              $uniqueId = 'skills_' . $workforce['workforceID'];
                              $viewMoreId = 'viewMore_' . $workforce['workforceID'];
                              $viewLessId = 'viewLess_' . $workforce['workforceID'];

                              // View More link
                              echo '<a id="' . $viewMoreId . '" href="javascript:void(0);" style="color:#0b2523;" 
            onclick="document.getElementById(\'' . $uniqueId . '\').style.display = \'inline\'; 
                     this.style.display = \'none\'; 
                     document.getElementById(\'' . $viewLessId . '\').style.display = \'inline\';">
            View More
          </a>';
                              echo '<br>';
                              // Hidden skills with "View Less"
                              echo '<span id="' . $uniqueId . '" style="display:none;">' . $hiddenHtml . '</span>';

                              // View Less link
                              echo '<a id="' . $viewLessId . '" href="javascript:void(0);" style="color:#0b2523; display:none;" 
            onclick="document.getElementById(\'' . $uniqueId . '\').style.display = \'none\'; 
                     this.style.display = \'none\'; 
                     document.getElementById(\'' . $viewMoreId . '\').style.display = \'inline\';">
            View Less
          </a>';
                            }
                            ?>
                          </td>
                          <td>
                            <?php
                            if ($workforce['personStatus'] == 1) {
                            ?>
                              <span class="badge text-success">Available</span>
                            <?php
                            } else {
                            ?>
                              <span class="badge text-danger">Allocated</span>
                            <?php
                            }
                            ?>
                          </td>
                          <td>
                            <div
                              class="table-actions d-flex align-items-center gap-3 fs-6">
                              <!-- <a
                                href="javascript:;"
                                class="text-primary"
                                data-bs-toggle="tooltip"
                                data-bs-placement="bottom"
                                title="Views"><i class="bi bi-eye-fill"></i></a> -->
                              <a
                                href="#"
                                class="text-warning"
                                data-bs-toggle="modal"
                                data-bs-target="#exampleModal_<?= $workforce['workforceID'] ?>"
                                title="Edit"><i class="bi bi-pencil-fill"></i></a>
                              <!-- Modal -->
                              <div
                                class="modal fade"
                                id="exampleModal_<?= $workforce['workforceID'] ?>"
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
                                      <div class="row">
                                        <div class="card">
                                          <div class="card-body">
                                            <div class="border p-3 rounded">
                                              <h6 class="mb-0 text-uppercase">Edit workforce</h6>
                                              <hr />
                                              <form class="row g-3" method="post" action="<?= base_url('edit-work-force/' . $workforce['workforceID']) ?>" enctype="multipart/form-data">
                                                <?= csrf_field() ?>
                                                <div class="col-12">
                                                  <label class="form-label">Person Name</label>
                                                  <input
                                                    type="text"
                                                    class="form-control"
                                                    name="personName"
                                                    value="<?= h($workforce['personName']) ?>"
                                                    id="personName"
                                                    placeholder="Enter Person Name" />
                                                </div>
                                                <div class="col-12">
                                                  <label class="form-label">Skill</label>
                                                  <!-- <select name="personSkill" id="personSkill" class="form-control"> -->
                                                  <select class="multiple-select" id="personSkill" name="personSkill[]" data-placeholder="Choose anything" multiple="multiple">
                                                    <option value="">Select Skill</option>
                                                    <?php
                                                    if ($skills && is_array($skills)) {
                                                      $selectedSkills = array_map('trim', explode(',', $workforce['skillNames']));

                                                      foreach ($skills as $skill) {
                                                    ?>
                                                        <option
                                                          <?php if (in_array($skill['skillName'], $selectedSkills)) echo 'selected'; ?>

                                                          value="<?= $skill['skillID'] ?>"><?= $skill['skillName'] ?></option>
                                                    <?php
                                                      }
                                                    }
                                                    ?>
                                                  </select>
                                                </div>
                                                <div class="col-12">
                                                  <label class="form-label">Upload Image</label>
                                                  <input type="file" name="personImage" id="personImage" class="form-control" />
                                                  <img src="<?= base_url() ?>assets/uploads/workforce/<?= $workforce['personImg'] ?>" width="80" height="80" alt="">
                                                </div>
                                                <div class="col-6">
                                                  <label class="form-label">Phone Number</label>
                                                  <input
                                                    type="number"
                                                    class="form-control"
                                                    name="personPhone"
                                                    value="<?= h($workforce['personPhone']) ?>"
                                                    id="personPhone"
                                                    placeholder="Enter Phone Number" />
                                                </div>
                                                <div class="col-6">
                                                  <label class="form-label">Email</label>
                                                  <input
                                                    type="email"
                                                    class="form-control"
                                                    value="<?= h($workforce['personEmail']) ?>"
                                                    name="personEmail"
                                                    id="personEmail"
                                                    placeholder="Enter Email Address" />
                                                </div>
                                                <div class="col-12">
                                                  <label class="form-label">Additional Note</label>
                                                  <textarea
                                                    class="form-control"
                                                    id="personAddress"

                                                    name="personAddress"
                                                    rows="4"
                                                    cols="4"><?= h($workforce['personAddInfo']) ?></textarea>
                                                </div>
                                                <div class="col-12">
                                                  <div class="d-grid">
                                                    <button
                                                      type="submit"
                                                      class="btn btn-primary btn-clash">
                                                      Update
                                                    </button>
                                                  </div>
                                                </div>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
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

                              <script>
                                $('#exampleModal_<?= $workforce['workforceID'] ?>').on('shown.bs.modal', function() {
                                  $(this).find('.multiple-select').select2({
                                    dropdownParent: $('#exampleModal_<?= $workforce['workforceID'] ?>'),
                                    theme: 'bootstrap4', // Use the Select2 Bootstrap 4 theme
                                    width: '100%',
                                    placeholder: "Select Skills"
                                  });
                                });
                              </script>

                              <a
                                href="<?= base_url('delete-person/' . $workforce['workforceID']) ?>"
                                class="text-danger"
                                onclick="return confirm('Are you sure you want to delete this person?');"
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
                        <td colspan="6" class="text-center">No workforce found.</td>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--end row-->
    </main>
    <!--end page main-->

    <!-- popup start -->

    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
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
            <div class="row">
              <div class="card">
                <div class="card-body">
                  <div class="border p-3 rounded">
                    <h6 class="mb-0 text-uppercase">Add workforce</h6>
                    <hr />
                    <form class="row g-3" method="post" action="<?= base_url('add-work-force-data?worforcelist=1') ?>" enctype="multipart/form-data">
                      <?= csrf_field() ?>
                      <div class="col-12">
                        <label class="form-label">Person Name</label>
                        <input
                          type="text"
                          class="form-control"
                          name="personName"
                          id="personName"
                          placeholder="Enter Person Name" />
                      </div>
                      <div class="col-12">
                        <label class="form-label">Skill</label>
                        <!-- <select name="personSkill" id="personSkill" class="form-control"> -->
                        <select class="multiple-select" id="personSkill" name="personSkill[]" data-placeholder="Choose anything" multiple="multiple">
                          <option value="">Select Skill</option>
                          <?php
                          if ($skills && is_array($skills)) {
                            foreach ($skills as $skill) {
                          ?>
                              <option value="<?= $skill['skillID'] ?>"><?= $skill['skillName'] ?></option>
                          <?php
                            }
                          }
                          ?>
                        </select>
                      </div>
                      <div class="col-12">
                        <label class="form-label">Upload Image</label>
                        <input type="file" name="personImage" id="personImage" class="form-control" />
                      </div>
                      <div class="col-6">
                        <label class="form-label">Phone Number</label>
                        <input
                          type="number"
                          class="form-control"
                          name="personPhone"
                          id="personPhone"
                          placeholder="Enter Phone Number" />
                      </div>
                      <div class="col-6">
                        <label class="form-label">Email</label>
                        <input
                          type="email"
                          class="form-control"
                          name="personEmail"
                          id="personEmail"
                          placeholder="Enter Email Address" />
                      </div>
                      <!-- <div class="col-12">
                      <label class="form-label">Password</label>
                      <input
                        type="password"
                        class="form-control"
                        placeholder="Enter Password"
                      />
                    </div> -->
                      <div class="col-12">
                        <label class="form-label">Additional Note</label>
                        <textarea
                          class="form-control"
                          id="personAddress"
                          name="personAddress"
                          rows="4"
                          cols="4"></textarea>
                      </div>
                      <div class="col-12">
                        <div class="d-grid">
                          <button
                            type="submit"
                            class="btn btn-primary btn-clash">
                            Add Workforce
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
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

    <!-- popup end -->

    <!-- second popup here -->

    <div
      class="modal fade"
      id="manageskills"
      tabindex="-1"
      aria-labelledby="manageskillsLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="manageskillsLabel"></h5>
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
                      <h5 class="mb-0">Add New Skill</h5>
                    </div>
                    <hr />
                    <form method="post" action="<?= base_url('add-skill-data/?allWorkforce=1') ?>">
                      <?= csrf_field() ?>
                      <div class="row mb-3">
                        <label
                          for="skillName"
                          class="col-sm-3 col-form-label">New Skill </label>
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
                        <label
                          for="skillDesc"
                          class="col-sm-3 col-form-label">Description</label>
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
                            Add Skill
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

    <!-- second popup end -->

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
    $('#exampleModal').on('shown.bs.modal', function() {
      $(this).find('.multiple-select').select2({
        dropdownParent: $('#exampleModal'),
        theme: 'bootstrap4', // Use the Select2 Bootstrap 4 theme
        width: '100%',
        placeholder: "Select Skills"
      });
    });
  </script>
  <?php
  if ($this->session->flashdata('success-added') != '') {
  ?>
    <script type="text/javascript">
      toastr.options = {
        "closeButton": true,
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }
      toastr.success('Person Added!');
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
      toastr.success('Skill Added!');
    </script>
  <?php
  }
  ?>
  <?php
  if ($this->session->flashdata('emailExist') != '') {
  ?>
    <script type="text/javascript">
      toastr.options = {
        "closeButton": true,
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }
      toastr.error('Email Already Registered!');
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
      toastr.error('Person Deleted!');
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
      toastr.success('Person Data Updated!');
    </script>
  <?php
  }
  ?>
</body>

</html>