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
  <link rel="stylesheet" href="<?= base_url() ?>assets/toastr/toastr.min.css" />

  <title>Add Equiprnent</title>
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
          Add Equipment
        </div>
      </div>
      <!--end breadcrumb-->

      <div class="row">
        <div class="col-xl-6 mx-auto">
          <div class="card">
            <div class="card-body">
              <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Add Equipment</h6>
                <hr />
                <form class="row g-3" method="post" action="<?= base_url('add-equipment-data') ?>" enctype="multipart/form-data">
                  <!-- SECURITY FIX: Add CSRF token to form -->
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                  <div class="col-12">
                    <label class="form-label">Equipment Name <span data-bs-toggle="tooltip" title="Give the equipment a clear and recognizable name. This helps identify specific tools or assets across the system and improves searchability.">ⓘ</span></label>
                    <input
                      type="text"
                      id="equipName"
                      name="equipName"
                      required
                      class="form-control"
                      placeholder="Enter Equipment Name" />
                  </div>
                  <div class="col-12">
                    <div class="d-flex align-items-center gap-20 mb-3">
                      <label class="form-label mb-0">Equipment Category <span data-bs-toggle="tooltip" title="Select the category that best describes the equipment. This helps organize and improves filtering in the inventory system.">ⓘ</span></label>

                      <!-- Button trigger modal -->
                      <button
                        type="button"
                        class="btn btn-primary btn-clash-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        Add New Equipment Category
                      </button>
                    </div>
                    <select name="equipCat" required id="equipCat" class="form-control">
                      <option value="">Select  Equipment Category</option>
                      <?php
                      if (!empty($category)) {
                        foreach ($category as $cat) {
                      ?>
                          <option value="<?= $cat['equipCatID'] ?>"><?= $cat['catName'] ?></option>
                        <?php
                        }
                      } else {
                        ?>
                        <option value="">No Category Found</option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Upload Image <span data-bs-toggle="tooltip" title="Upload a clear image of the equipment. High-quality images help with identification and increase trust in the inventory.">ⓘ</span></label>
                    <input type="file" name="equipImg" id="equipImg" class="form-control" />
                  </div>
                  <div class="col-12">
                    <label class="form-label">Quantity <span data-bs-toggle="tooltip" title="Enter the total number of units available for this equipment. Only enter numbers (e.g., 1, 3, 10).">ⓘ</span></label>
                    <input
                      type="number"
                      class="form-control"
                      name="quantity"
                      id="quantity"
                      required
                      value="1"
                      placeholder="Enter Equipment Quantity" />
                  </div>
                  <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea
                      class="form-control"
                      placeholder="Write Here"
                      required
                      id="equipDesc"
                      name="equipDesc"
                      rows="4"
                      cols="4"></textarea>
                  </div>
                  <div class="col-12">
                    <div class="d-grid">
                      <button type="submit" class="btn btn-primary btn-clash">
                        Add Equipment
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
            <h5 class="modal-title" id="exampleModalLabel">
              Add New Equipment Category
            </h5>
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
                      <h5 class="mb-0"></h5>
                    </div>
                    <form class="row g-3" method="post" >
                      <div class="row mb-3">
                        <label
                          for="catName"
                          class="col-sm-3 col-form-label">Equipment Category</label>
                        <div class="col-sm-9">
                          <input
                            type="text"
                            class="form-control"
                            id="catName"
                            required
                            name="catName"
                            placeholder="Enter New Equipment Category" />
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label
                          for="catDesc"
                          class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                          <textarea
                            class="form-control"
                            id="catDesc"
                            name="catDesc"
                            required
                            rows="3"
                            placeholder="Write Description"></textarea>
                        </div>
                      </div>

                      <div class="row">
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                          <button
                            type="button"
                            onclick="return addCatData()"
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
  <!--app-->
  <script src="<?= base_url() ?>assets/js/app.js"></script>
  <script src="<?= base_url() ?>assets/toastr/toastr.min.js"></script>
   <script>
    function addCatData() {
      
      var catName = $('#catName').val();
      var catDesc = $('#catDesc').val();
      if (catName == '' || catDesc == '') {
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
          url: '<?= base_url('add-equipment-category-jax') ?>', // URL to the controller method
          type: 'POST', // HTTP method
          data: {
            catDesc: catDesc,
            catName: catName,
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
              $('#equipCat').html('<option value="">Select Category</option>' + response);

            

              // Hide modal and clear fields
              $('#exampleModal').modal('hide');
              $('#catName').val('');
              $('#catDesc').val('');

              toastr.options = {
                "closeButton": true,
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
              }
              toastr.success('Category Added!');
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
      toastr.success('Equipment Added!');
    </script>
  <?php
  }
  ?>
</body>

</html>