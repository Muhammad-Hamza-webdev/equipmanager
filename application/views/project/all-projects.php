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
      rel="stylesheet"
    />
    <link
      href="<?= base_url() ?>assets/plugins/metismenu/css/metisMenu.min.css"
      rel="stylesheet"
    />
    <link
      href="<?= base_url() ?>assets/plugins/datatable/css/dataTables.bootstrap5.min.css"
      rel="stylesheet"
    />
    <!-- Bootstrap CSS -->
    <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/bootstrap-extended.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/icons.css" rel="stylesheet" />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
    />

    <!-- loader-->
    <link href="<?= base_url() ?>assets/css/pace.min.css" rel="stylesheet" />

    <!--Theme Styles-->
    <link href="<?= base_url() ?>assets/css/dark-theme.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/light-theme.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/semi-dark.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/header-colors.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/toastr/toastr.min.css" />

    <title>All Project Management</title>
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
            Project Management
          </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
          <div class="col-xl-12 mx-auto">
            <div class="card">
              <div class="card-body">
                <form  method="get" id="filterForm" name="filterForm">
                <div class="border p-4 rounded">
                  <div class="card-title d-flex align-items-center">
                    <h5 class="mb-0">Filter By</h5>
                  </div>
                  <hr />
                  <div class="row mb-3">
                 
                    <div class="col-sm-6">
                      <input
                        type="text"
                        class="form-control"
                        <?php 
                          if(!empty($_GET['projectName'])){
                            echo 'value="'.htmlspecialchars($_GET['projectName'], ENT_QUOTES, 'UTF-8').'"';
                          }
                        ?>
                        id="projectName"
                        name="projectName"
                        placeholder="Enter Project name"
                      />
                    </div>
                    <div class="col-sm-6">
                      <select name="projectCat" id="projectCat" class="form-select">
                        <option value="">Select Project Category</option>
                        <?php 
                        if($projectCats){
                          foreach($projectCats as $cat){
                        ?>
                        <option 
                        <?php 
                          if(!empty($_GET['projectCat']) && $_GET['projectCat'] == $cat['pCatID']){
                            echo 'selected';
                          }
                        ?>
                        
                        value="<?=$cat['pCatID']?>"><?=$cat['pCatName']?></option>
                        <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  
                  <div class="row mb-3">
                   
                    <div class="col-sm-6">
                      <input
                        type="text"
                        class="form-control"
                          name="location"
                          <?php 
                          if(!empty($_GET['location'])){
                            echo 'value="'.$_GET['location'].'"';
                          }
                        ?>
                        id="location"
                        placeholder="Add  Location"
                      />
                    </div>
                    <div class="col-sm-6">
                      <select name="pstatus" id="pstatus" class="form-select">
                        <option value="">Select Project Status</option>
                        <option 
                        <?php 
                          if(!empty($_GET['pstatus']) && $_GET['pstatus'] == '1'){
                            echo 'selected';
                          }
                        ?>
                        value="1">Draft</option>
                        <option 
                        <?php 
                          if(!empty($_GET['pstatus']) && $_GET['pstatus'] == '2'){
                            echo 'selected';
                          }
                        ?>
                        value="2">In Progress</option>
                        <option 
                        <?php 
                          if(!empty($_GET['pstatus']) && $_GET['pstatus'] == '3'){
                            echo 'selected';
                          }
                        ?>
                        value="3">Pending</option>
                        <option 
                        <?php 
                          if(!empty($_GET['pstatus']) && $_GET['pstatus'] == '4'){
                            echo 'selected';
                          }
                        ?>
                        value="4">Completed</option>
                      </select>
                    </div>
                  </div>
                  <div class="row mb-3">
                   
                    <div class="col-sm-6">
                      <span>Start Date</span>
                      <input
                        type="date"
                        class="form-control"
                        id="startDate"
                          <?php 
                            if(!empty($_GET['startDate'])){
                              echo 'value="'.$_GET['startDate'].'"';
                            }
                          ?>
                        name="startDate"
                        placeholder="Start Date"
                      />
                    </div>
                    <div class="col-sm-6">
                      <span>End Date</span>
                      <input
                        type="date"
                        class="form-control"
                        id="enddate"
                          <?php 
                            if(!empty($_GET['enddate'])){
                              echo 'value="'.$_GET['enddate'].'"';
                            }
                          ?>
                        name="enddate"
                        placeholder="End Date"
                      />
                    </div>
                  </div>

                  <div class="row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-12">
                      <button
                        type="submit"
                        class="btn btn-primary px-5 btn-clash"
                      >
                        Apply Filters
                      </button>
                      <?php 
                      if(isset($_GET['projectName'])){
                        ?>
                      <a href="<?= base_url('all-projects') ?>" style="color:#0f2f2c;margin-left:10px"><i class="bi bi-x-lg"></i> Clear Filter</a>
                        <?php 
                      }
                      ?>
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
            <h5 class="mb-0">Projects List</h5>
            <div class="table-responsive mt-3">
              <table class="table align-middle">
                <thead class="table-secondary bg-sky-blue font-clash-green">
                  <tr>
                    <th>Project Name</th>
                    <th>Category</th>
                    <th>Location</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  if($projects){
                    foreach($projects as $project){
                      
                  ?>
                  <tr>
                    <td><?=$project['pName']?></td>
                    <td><?php 
                    if($project['pCatName']==0){
                      echo "Website Listing";
                    }else{
                      echo $project['pCatName'];
                    }
                    ?></td>
                    <td><?=$project['pLocation']?></td>
                    <td><?= date('j M, Y', strtotime($project['pStartDate'])) ?></td>
                    <td><?= date('j M, Y', strtotime($project['pEndDate'])) ?></td>
                    <td><?=$project['pDesc']?></td>
                    <td>
                      <?php 
                      if($project['pStatus'] == 1){
                        echo '<span class="badge text-bg-secondary">Draft</span>';
                      }
                      else if($project['pStatus'] == 2){
                        echo '<span class="badge text-bg-primary">In Progress</span>';
                      }
                      else if($project['pStatus'] == 3){
                        echo '<span class="badge text-bg-warning">Pending</span>';
                      }
                      else if($project['pStatus'] == 4){
                        echo '<span class="badge text-bg-success">Completed</span>';
                      }
                      else{
                        echo '<span class="badge text-bg-danger">Unknown</span>';
                      } 
                      ?>
                    </td>
                    <td>
                      <div
                        class="table-actions d-flex align-items-center gap-3 fs-6"
                      >
                      <?php 
                    if($project['pCatName']==0){

                      ?>
 <a
                          href="<?=base_url('add-listing?itemID='.$project['itemID'])?>"
                          class="text-warning"
                          data-bs-toggle="tooltip"
                          data-bs-placement="bottom"
                          title="Edit"
                          ><i class="bi bi-pencil-fill"></i
                        ></a>
                      <?php 
                    }else{
                      ?>
                        <a
                          href="<?=base_url('add-project?id='.$project['ProjectID'].'&step=1')?>"
                          class="text-warning"
                          data-bs-toggle="tooltip"
                          data-bs-placement="bottom"
                          title="Edit"
                          ><i class="bi bi-pencil-fill"></i
                        ></a>
                        <?php 
                    }
                    ?>
                        <a
                          href="javascript:;"
                          onclick="return confirm('Are you sure you want to delete this project?') ? window.location.href='<?=base_url('delete-project/'.$project['ProjectID'])?>' : false;"
                          class="text-danger"
                          data-bs-toggle="tooltip"
                          data-bs-placement="bottom"
                          title="Delete"
                          ><i class="bi bi-trash-fill"></i
                        ></a>
                      </div>
                    </td>
                  </tr>
                  <?php 
                    }
                  }
                  else{
                  ?>
                  <tr>
                    <td colspan="8" class="text-center">No Projects Found</td>
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
      <a href="javaScript:;" class="back-to-top"
        ><i class="bx bxs-up-arrow-alt"></i
      ></a>
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
      <script src="<?= base_url() ?>assets/toastr/toastr.min.js"></script>
    <!--app-->
    <script src="<?= base_url() ?>assets/js/app.js"></script>
       <?php
  if ($this->session->flashdata('deletedproject') != '') {
  ?>
    <script type="text/javascript">
      toastr.options = {
        "closeButton": true,
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }
      toastr.success('Project Deleted!');
    </script>
  <?php
  }
  ?>
  </body>
</html>
