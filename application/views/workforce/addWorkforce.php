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

  <title>Add Workforce</title>
</head>
<style>
  .select2-container {
    width: 100% !important;
  }
</style>

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
          Add Workforce
        </div>
      </div>
      <!--end breadcrumb-->

      <div class="row">
        <div class="col-xl-6 mx-auto">
          <div class="card">
            <div class="card-body">
              <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Add workforce</h6>
                <hr />
                <form class="row g-3" method="post" action="<?= base_url('add-work-force-data') ?>" enctype="multipart/form-data">
                  <!-- SECURITY FIX: Add CSRF token to form -->
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                  <div class="col-12">
                    <label class="form-label">Person Name</label>
                    <input
                      type="text"
                      class="form-control"
                      name="personName"
                      id="personName"
                      required
                      placeholder="Enter Person Name" />
                  </div>
                  <div class="col-12">
                    <div class="d-flex align-items-center gap-20 mb-3">
                      <label class="form-label mb-0">Skill</label>

                      <!-- Button trigger modal -->
                      <button
                        type="button"
                        class="btn btn-primary btn-clash-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        Add Skills
                      </button>
                    </div>
                    <!-- <select name="personSkill" id="personSkill" required class="form-control" multiple> -->
                    <select class="multiple-select" id="personSkill" name="personSkill[]" data-placeholder="Choose anything" multiple="multiple">
                      <option value="">Select Skill</option>
                      <?php
                      if (!empty($skills) && is_array($skills)) {
                        foreach ($skills as $skill) {
                      ?>
                          <option value="<?= $skill['skillID'] ?>"><?= $skill['skillName'] ?></option>
                      <?php
                        }
                      }
                      ?>
                    </select>
                    <div id="selectedSkillsTags"></div>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Upload Image</label>
                    <input type="file" name="personImage" id="personImage" class="form-control" />
                  </div>
                  <div class="col-6">
                    <label class="form-label">Phone Number</label>
                    <input
                      type="number"
                      name="personPhone"
                      id="personPhone"
                      required
                      class="form-control"
                      placeholder="Enter Phone Number" />
                  </div>
                  <div class="col-6">
                    <label class="form-label">Email</label>
                    <input
                      type="email"
                      class="form-control"
                      name="personEmail"
                      required
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
                      rows="4"
                      name="personAddress"
                      required
                      id="personAddress"
                      cols="4"></textarea>
                  </div>
                  <div class="col-12">
                    <div class="d-grid">
                      <button type="submit" class="btn btn-primary btn-clash">
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
      <!--end row-->

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
            <!-- body code -->

            <div class="row">
              <div class="card">
                <div class="card-body">
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
                      <label
                        for="skillDesc"
                        class="col-sm-3 col-form-label">Description</label>
                      <div class="col-sm-9">
                        <textarea
                          class="form-control"
                          id="skillDesc"
                          name="skillDesc"
                          rows="3"
                          placeholder="Description"></textarea>
                      </div>
                    </div>

                    <div class="row">
                      <label class="col-sm-3 col-form-label"></label>
                      <div class="col-sm-9">
                        <button
                          type="button"
                          onclick="return addSkillData()"
                          class="btn btn-primary px-5 btn-clash">
                          Add Skill
                        </button>
                      </div>
                    </div>
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

    <!-- popup end -->

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
  <script src="<?= base_url() ?>assets/plugins/select2/js/select2.min.js"></script>
  <script src="<?= base_url() ?>assets/js/form-select2.js"></script>
  <!--app-->
  <script src="<?= base_url() ?>assets/js/app.js"></script>
  <script src="<?= base_url() ?>assets/toastr/toastr.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.multiple-select').select2({
        placeholder: "Select Skills"
      });
    });
  </script>
  <script>
    function addSkillData() {
      var skillName = $('#skillName').val();
      var skillDescription = $('#skillDesc').val();
      if (skillName == '' || skillDescription == '') {
        toastr.options = {
          "closeButton": true,
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }
        toastr.error('Please fill all fields!');
        return false
      } else {
        //  Make an AJAX POST request
        $.ajax({
          url: '<?= base_url('add-skill-data-ajax') ?>', // URL to the controller method
          type: 'POST', // HTTP method
          data: {
            skillName: skillName,
            skillDescription: skillDescription,
            '<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>'
          }, // Data to send

          success: function(response) {
            if (response == "error") {
              toastr.options = {
                "closeButton": true,
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
              }
              toastr.error('Please fill all fields!');
              return false
            } else {
              // Update the select options
              $('#personSkill').html('<option value="">Select Skill</option>' + response);

              // Refresh Select2 dropdown
              $('#personSkill').select2({
                placeholder: "Select Skills"
              });

              // Hide modal and clear fields
              $('#exampleModal').modal('hide');
              $('#skillName').val('');
              $('#skillDesc').val('');

              toastr.options = {
                "closeButton": true,
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
              }
              toastr.success('Skill added successfully!');
            }

          },
        });
      }


    }
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
</body>

</html>