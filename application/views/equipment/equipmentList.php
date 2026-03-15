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
  <link rel="stylesheet" href="<?= base_url() ?>assets/toastr/toastr.min.css" />
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

  <title>Equipment List</title>
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
          Equipment Management
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
                <form class="row g-3" method="get">
                  <div class="col-12">
                    <label class="form-label"> Keyword</label>
                    <input
                      type="text"
                      id="equipName"
                      name="equipName"
                      <?php if (isset($_GET['equipName']) && $_GET['equipName'] != '') { ?>
                      value="<?= h($this->input->get('equipName', TRUE)) ?>"
                      <?php } ?>
                      class="form-control"
                      placeholder="Enter Keyword" />
                  </div>
                  <div class="col-12">
                    <label class="form-label">Category</label>
                    <select
                      name="equipCatID"
                      id="equipCatID"
                      class="form-control">
                      <option value="">Select Category</option>
                      <?php
                      if (!empty($equipCat)) {
                        foreach ($equipCat as $cat) { ?>
                          <option
                            <?php if ($this->input->get('equipCatID') !== NULL && $this->input->get('equipCatID') == $cat['equipCatID']) {
                              echo 'selected';
                            } ?>
                            value="<?= (int)$cat['equipCatID'] ?>"><?= h($cat['catName']) ?></option>
                        <?php  }
                      } else { ?>
                        <option value="">No Category Found</option>
                      <?php }
                      ?>
                    </select>
                  </div>
                  <!-- <div class="col-12">
                      <label class="form-label">Status</label>
                      <select name="status" id="status" class="form-control">
                        <option value="">Select Status</option>
                        <option value="">Status 1</option>
                        <option value="">Status 3</option>
                        <option value="">Status 4</option>
                      </select>
                    </div> -->
                  <div class="col-12">
                    <div class="d-grid">
                      <?php
                      if (isset($_GET['equipName'])) {
                      ?>
                        <a href="<?= base_url('all-equipment') ?>" style="color:#0f2f2c;margin-bottom:10px"><i class="bi bi-x-lg"></i> Clear Filter</a>
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
                <h5 class="mb-0">Equipment List</h5>
                <div class="d-flex gap-20 justify-spc-btw-md flex-col-sm">
                  <div class="d-grid">
                    <!-- This is your button, now wrapped in a label -->
                    <!-- Button trigger modal -->
                    <button
                      type="button"
                      class="btn btn-primary btn-clash-sm"
                      data-bs-toggle="modal"
                      data-bs-target="#exampleModal">
                      Add New Equipment
                    </button>
                  </div>
                  <div class="d-grid">
                    <!-- Manage Skills Button -->
                    <button
                      type="button"
                      class="btn btn-primary btn-clash-sm"
                      data-bs-toggle="modal"
                      data-bs-target="#manageskills">
                      Add New Category
                    </button>
                  </div>
                </div>
              </div>
              <div class="table-responsive mt-3">
                <table class="table align-middle">
                  <thead class="table-secondary bg-sky-blue font-clash-green">
                    <tr>
                      <th>Name</th>
                      <th>Category</th>
                      <th class="text-center">Quantity(Inuse/Total)</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if (!empty($equipment)) {
                      foreach ($equipment as $equip) { ?>


                        <tr>
                          <td>
                            <div
                              class="d-flex align-items-center gap-3 cursor-pointer">
                              <img
                                src="<?= base_url() ?>assets/uploads/equipment/<?= $equip['equipImg'] ?>"
                                class="rounded-circle"
                                width="44"
                                height="44"
                                alt="" />
                              <div class="">
                                <p class="mb-0"><?= $equip['equipName'] ?></p>
                              </div>
                            </div>
                          </td>
                          <td><?= $equip['catName'] ?></td>
                          <td class="text-center">
                            <?= $equip['equipInUseQuantity'] ?>/<?= $equip['equipTotalQuantity'] ?>
                          </td>
                          <td>
                            <div
                              class="table-actions d-flex align-items-center gap-3 fs-6">
                              <!-- <a
                              href="javascript:;"
                              class="text-primary"
                              data-bs-toggle="tooltip"
                              data-bs-placement="bottom"
                              title="Views"
                              ><i class="bi bi-eye-fill"></i
                            ></a> -->
                              <a
                                href="#"
                                class="text-warning"
                                data-bs-toggle="modal"
                                data-bs-target="#exampleModal_<?= $equip['equipmentID'] ?>"

                                title="Edit"><i class="bi bi-pencil-fill"></i></a>
                              <!-- Modal -->
                              <div
                                class="modal fade"
                                id="exampleModal_<?= $equip['equipmentID'] ?>"
                                tabindex="-1"
                                aria-labelledby="exampleModalLabel_<?= $equip['equipmentID'] ?>"
                                aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel_<?= $equip['equipmentID'] ?>"></h5>
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
                                            <div class="border p-3 rounded">
                                              <h6 class="mb-0 text-uppercase">Edit Equipment</h6>
                                              <hr />
                                              <form class="row g-3" method="post" action="<?= base_url('edit-equipment-data/'.$equip['equipmentID'].'?equipmentList=1') ?>" enctype="multipart/form-data">
                                                <?= csrf_field() ?>
                                                <div class="col-12">
                                                  <label class="form-label">Equipment Name</label>
                                                  <input
                                                    type="text"
                                                    id="equipName"
                                                    name="equipName"
                                                    <?php
                                                    if (isset($equip['equipName']) && $equip['equipName'] != '') { ?>
                                                    value="<?= $equip['equipName'] ?>"
                                                    <?php } ?>
                                                    class="form-control"
                                                    placeholder="Enter Equipment Name" />
                                                </div>
                                                <div class="col-12">
                                                  <div class="d-flex align-items-center gap-20 mb-3">
                                                    <label class="form-label mb-0"> Equipment Category</label>
                                                  </div>
                                                  <select name="equipCat" id="equipCat" class="form-control">
                                                    <option value="">Select  Equipment Category</option>
                                                    <?php
                                                    if (!empty($equipCat)) {
                                                      foreach ($equipCat as $cat) { ?>
                                                        <option
                                                          <?php
                                                          if (isset($equip['equipCatID']) && $equip['equipCatID'] == $cat['equipCatID']) {
                                                            echo 'selected';
                                                          }
                                                          ?>
                                                          value="<?= $cat['equipCatID'] ?>"><?= $cat['catName'] ?></option>
                                                      <?php  }
                                                    } else { ?>
                                                      <option
                                                        value="">No Category Found</option>
                                                    <?php }
                                                    ?>

                                                  </select>
                                                </div>
                                                <div class="col-12">
                                                  <label class="form-label">Upload Image</label>
                                                  <input type="file" id="equipImg" name="equipImg" class="form-control" />
                                                  <img src="<?= base_url() ?>assets/uploads/equipment/<?= $equip['equipImg'] ?>" width="100" height="100" alt="No Image">
                                                </div>
                                                <div class="col-12">
                                                  <label class="form-label">Quantity</label>
                                                  <input
                                                    type="number"
                                                    id="quantity"
                                                    name="quantity"
                                                    <?php
                                                    if (isset($equip['equipTotalQuantity']) && $equip['equipTotalQuantity'] != '') { ?>
                                                    value="<?= $equip['equipTotalQuantity'] ?>"
                                                    <?php } ?>
                                                    class="form-control"
                                                    placeholder="Enter Password" />
                                                </div>
                                                <div class="col-12">
                                                  <label class="form-label">Description</label>
                                                  <textarea
                                                    class="form-control"
                                                    placeholder="Write Here"
                                                    id="equipDesc"
                                                    name="equipDesc"
                                                    rows="4"
                                                    cols="4"><?= $equip['equipDesc'] ?></textarea>
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

                              <a
                                href="<?= base_url('delet-equipment/') . $equip['equipmentID'] ?>"
                                class="text-danger"
                                onclick="return confirm('Are you sure you want to delete this equipment?');"
                                data-bs-toggle="tooltip"
                                data-bs-placement="bottom"
                                title="Delete"><i class="bi bi-trash-fill"></i></a>
                            </div>
                          </td>
                        </tr>
                      <?php }
                    } else { ?>
                      <tr>
                        <td colspan="4" class="text-center">No Equipment Found</td>
                      </tr>
                    <?php } ?>
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
            <h5 class="modal-title" id="exampleModalLabel">Add Equipment</h5>
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
                  <div class="border p-3 rounded">
                    <h6 class="mb-0 text-uppercase">Add Equipment</h6>
                    <hr />
                    <form class="row g-3" method="post" action="<?= base_url('add-equipment-data?equipmentList=1') ?>" enctype="multipart/form-data">
                      <?= csrf_field() ?>
                      <div class="col-12">
                        <label class="form-label">Equipment Name</label>
                        <input
                          type="text"
                          id="equipName"
                          name="equipName"
                          class="form-control"
                          placeholder="Enter Equipment Name" />
                      </div>
                      <div class="col-12">
                        <div class="d-flex align-items-center gap-20 mb-3">
                          <label class="form-label mb-0"> Equipment Category</label>
                        </div>
                        <select name="equipCat" id="equipCat" class="form-control">
                          <option value="">Select  Equipment Category</option>
                          <?php
                          if (!empty($equipCat)) {
                            foreach ($equipCat as $cat) { ?>
                              <option value="<?= $cat['equipCatID'] ?>"><?= $cat['catName'] ?></option>
                            <?php  }
                          } else { ?>
                            <option value="">No Category Found</option>
                          <?php }
                          ?>

                        </select>
                      </div>
                      <div class="col-12">
                        <label class="form-label">Upload Image</label>
                        <input type="file" id="equipImg" name="equipImg" class="form-control" />
                      </div>
                      <div class="col-12">
                        <label class="form-label">Quantity</label>
                        <input
                          type="number"
                          id="quantity"
                          name="quantity"
                          value="1"
                          class="form-control"
                          placeholder="Enter Quantity" />
                      </div>
                      <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea
                          class="form-control"
                          placeholder="Write Here"
                          id="equipDesc"
                          name="equipDesc"
                          rows="4"
                          cols="4"></textarea>
                      </div>
                      <div class="col-12">
                        <div class="d-grid">
                          <button
                            type="submit"
                            class="btn btn-primary btn-clash">
                            Add Equipment
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
            <h5 class="modal-title" id="manageskillsLabel">

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
                      <h5 class="mb-0">Add Equipment Category</h5>
                    </div>
                    <hr />
                    <form action="<?= base_url('equipment-category-data?equipmnetlist=1') ?>" method="post">
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
                            placeholder="Enter New Category Name" />
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
  if ($this->session->flashdata('successDeleted') != '') {
  ?>
    <script type="text/javascript">
      toastr.options = {
        "closeButton": true,
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }
      toastr.success('Equipment Deleted!');
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
      toastr.success('Equipment Updated!');
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
      toastr.error('Something went wrong, Please try again!');
    </script>
  <?php
  }
  ?>
</body>

</html>
