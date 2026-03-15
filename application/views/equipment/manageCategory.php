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

  <title>Manage Category</title>
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
          Category Management
        </div>
      </div>
      <!--end breadcrumb-->

      <div class="row">
        <div class="col-xl-12 mx-auto">
          <div class="card">
            <div class="card-body">
              <div class="border p-4 rounded">
                <div class="card-title d-flex align-items-center">
                  <h5 class="mb-0">Add Equipment Category</h5>
                </div>
                <hr />
                <form action="<?=base_url('equipment-category-data')?>" method="post">
                  <?= csrf_field() ?>
                  <div class="row mb-3">
                    <label
                      for="catName"
                      class="col-sm-3 col-form-label">Category Name</label>
                    <div class="col-sm-9">
                      <input
                        type="text"
                        class="form-control"
                        id="catName"
                        name="catName"
                        required
                        placeholder="Enter Category Name" />
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
                        required
                        placeholder="Write Description"></textarea>
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

      <div class="card">
        <div class="card-body">
          <h5 class="mb-0">Manage Category</h5>
          <div class="table-responsive mt-3">
            <table class="table align-middle">
              <thead class="table-secondary bg-sky-blue font-clash-green">
                <tr>
                  <th>Category Name</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                if($categories){
                    foreach($categories as $cat){
                ?>
                <tr>
                  <td><?= h($cat['catName']) ?></td>
                  <td><?= h($cat['catDesc']) ?></td>
                  <td>
                    <?php 
                    //count number of equipment in this category
                    $equipmentCount = $this->generic->GetCount('equipment','equipmentID', array('equipCatID' => $cat['equipCatID']));
                    if($equipmentCount){
                        echo $equipmentCount[0]['result'];
                    }else{
                        echo '-';
                    }
                    ?>
                  </td>
                  <td>
                    <div
                      class="table-actions d-flex align-items-center gap-3 fs-6">
                      <a
                            href="javascript:;"
                            class="text-warning"
                            data-bs-toggle="modal"
                          data-bs-target="#exampleModal_<?=$cat['equipCatID']?>"
                            title="Edit"><i class="bi bi-pencil-fill"></i></a>
                       
                      <a
                        href="<?=base_url().'delete-category/'.$cat['equipCatID']?>"
                        class="text-danger"
                        onclick="return confirm('Are you sure you want to delete this category?');"
                        data-bs-toggle="tooltip"
                        data-bs-placement="bottom"
                        title="Delete"><i class="bi bi-trash-fill"></i></a>
                           <!-- Modal -->
                          <div
                            class="modal fade"
                            id="exampleModal_<?=$cat['equipCatID']?>"
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
                                            <h5 class="mb-0">Edit Category</h5>
                                          </div>
                                          <hr />
                                          <form action="<?=base_url('update-category-data/'.$cat['equipCatID'])?>" method="post">
                                          <?= csrf_field() ?>
                                          <div class="row mb-3">
                                            <label
                                              for="catName"
                                              class="col-sm-3 col-form-label">Category Name</label>
                                            <div class="col-sm-9">
                                              <input
                                                type="text"
                                                class="form-control"
                                                id="catName"
                                                name="catName"
                                                required
                                                value="<?= h($cat['catName']) ?>"
                                                placeholder="Enter New Skill Name" />
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
                                                rows="3"
                                                required
                                                placeholder="Address"><?= h($cat['catDesc']) ?></textarea>
                                            </div>
                                          </div>

                                          <div class="row">
                                            <label class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-9">
                                              <button
                                                type="submit"
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
                              </div>
                            </div>
                          </div>
                    </div>
                  </td>
                </tr>
               <?php 
                    }
                  }else{
               ?>
               <tr>
                  <td colspan="4" class="text-center">No categories found.</td>
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
  if ($this->session->flashdata('success-edited') != '') {
  ?>
    <script type="text/javascript">
      toastr.options = {
        "closeButton": true,
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }
      toastr.success('Category Updated!');
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
      toastr.success('Category Deleted!');
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
      toastr.success('Category Added!');
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