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

  <title>Marketplace Listing</title>
  <style>
    /* Force tooltips to stay centered on top */
    .tooltip-inner {
      transform: translateX(-50%) !important;
      left: 50% !important;
    }

    /* Hide all tooltip arrows */
    .tooltip-arrow {
      display: none !important;
    }

    .bs-tooltip-top .tooltip-arrow,
    .bs-tooltip-auto[data-popper-placement^="top"] .tooltip-arrow {
      display: none !important;
    }

    .width-ctrl {
      --width: 25%;
    }

    .white {
      color: #ffffff;
    }

    .form-check-input:checked {
      background-color: #0f2f2c;
      border-color: #0f2f2c;
    }

    @media (max-width: 550px) {
      .width-ctrl {
        --width: 37%;
      }

      .multi_tabs-container {
        & .multi_tabs-btn {
          & .tab-btn {
            & ._circle {
              width: 70px;
              font-size: 14px;
            }
          }
        }
      }
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
          Equipment Listings
        </div>
      </div>
      <!--end breadcrumb-->

      <div class="col-xl-12 mx-auto">
        <!--  STEPS -->
        <div
          class="multi_tabs-container col-12"
          id="multiTabsBtnsContentSection">
          <!-- Btns -->
          <div class="multi_tabs_btns-container">
            <div class="multi_tabs_btns-wrapper">
              <!-- Btn -->
              <div class="multi_tabs-btn 
                active_tab
                width-ctrl" data-bs-toggle="tooltip" data-bs-placement="top" title="Listing Type">
                <div class="tab-progress-bar"></div>
                <button class="tab-btn">
                  <span class="_circle">Step 1</span>
                </button>
              </div>
              <!-- Btn -->
              <div class="multi_tabs-btn 
                width-ctrl " data-bs-toggle="tooltip" data-bs-placement="top" title="Listing Details">
                <div class="tab-progress-bar "></div>
                <button class="tab-btn" <?php if (!isset($_GET['edit'])) {
                                          echo 'disabled';
                                        } ?>>
                  <?php
                  if (isset($_GET['edit'])) {
                  ?>
                    <a href="<?= base_url('add-listing/?itemID='.$_GET['itemID'].'&skill='.$itemData[0]['itemType'].'&rentalType='.$itemData[0]['saleType'].'&edit=1') ?>">
                    <?php
                  }
                    ?>

                    <span class="_circle">Step 2</span>
                    <?php
                    if (isset($_GET['edit'])) {
                    ?>
                    </a>
                  <?php
                    }
                  ?>
                </button>
              </div>
              <!-- Btn -->
              <div class="multi_tabs-btn" style="--width: 50%" data-bs-toggle="tooltip" data-bs-placement="top" title="Terms & Conditions">
                <div class="tab-progress-bar"></div>
                <button class="tab-btn" <?php if (!isset($_GET['edit'])) {
                                          echo 'disabled';
                                        } ?>>
                                         <?php
                  if (isset($_GET['edit'])) {
                  ?>
                    <a href="<?= base_url('add-listing?listingID='.$_GET['itemID'].'&edit=1') ?>">
                    <?php
                  }
                    ?>
                  <span class="_circle">Step 3</span>
                  <?php
                    if (isset($_GET['edit'])) {
                    ?>
                    </a>
                  <?php
                    }
                  ?>
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- HAMZA STEPS -->

        <div class="multi_tabs_content-container">
          <div class="card multi_tab_content" id="first-box">
            <div class="card-body">
              <!-- inner card start here-->
              <div class="row">
                <div class="col-xl-12 mx-auto">
                  <div class="border p-3 rounded">
                    <h6 class="mb-0 text-uppercase">Choose listing</h6>
                    <hr />
                    <form class="row g-3" method="get">
                      <input type="hidden" name="itemID" value="<?php echo isset($_GET['itemID']) ? $_GET['itemID'] : ''; ?>">
                      <div class="col-12">
                        <div class="d-flex align-items-center gap-20 mb-3">
                          <label class="form-label mb-0" for="skill">Choose listing type <span data-bs-toggle="tooltip" title="Select 'Equipment' if you want to list tools, machines, or physical assets (Drills, generators, lifts, vehicles). Select 'Workforce' if you want to list employees or labor services (Electricians, operators, technicians).">ⓘ</span></label>
                        </div>
                        <select name="skill" required id="skill" onchange="return skillSelected()" class="form-control">
                          <option value="">Select Listing Type</option>
                          <option
                            <?php
                            if (isset($itemData)) {

                              if ($itemData[0]['itemType'] == 1) {
                                echo 'selected';
                              }
                            }
                            ?>
                            value="1">Equipment</option>
                          <option value="2"
                            <?php
                            if (isset($itemData)) {
                              if ($itemData[0]['itemType'] == 2) {
                                echo 'selected';
                              }
                            }
                            ?>>Workforce</option>
                        </select>
                      </div>
                      <div class="col-12" id="rentalTypeMain"
                        <?php
                        if (!isset($itemData)) {
                          echo 'style="display: none;"';
                        }
                        ?>>
                        <label class="form-label">Choose rental type</label>
                        <div class="d-flex">
                          <div class="form-check me-3"
                            <?php
                            if (isset($itemData)) {
                              if ($itemData[0]['itemType'] != 1) {
                                echo 'style="display: none;"';
                              }
                            }
                            ?>
                            id="saleDiv">
                            <input
                              type="radio"
                              class="form-check-input"
                              id="radioBtnBuy"
                              name="rentalType"
                              <?php
                              if (isset($itemData)) {
                                if ($itemData[0]['saleType'] == 1) {
                                  echo 'checked';
                                }
                              }
                              ?>
                              value="1"
                              required />
                            <label class="form-check-label" for="radioBtnBuy">Sale</label>
                          </div>
                          <div class="form-check">
                            <input
                              type="radio"
                              class="form-check-input"
                              id="radioBtnRental"
                              name="rentalType"
                              <?php
                              if (isset($itemData)) {
                                if ($itemData[0]['saleType'] == 0) {
                                  echo 'checked';
                                }
                              }
                              ?>
                              value="0"
                              required />
                            <label
                              class="form-check-label"
                              for="radioBtnRental">Rental</label>
                            <?php
                            if (isset($_GET['edit'])) {
                            ?>
                      <input type="hidden" name="edit" id="edit" value="1">
                            <?php
                            }
                            ?>
                          </div>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="d-grid">
                          <button
                            type="submit"
                            class="btn btn-primary btn-clash">
                            Next
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- inner card end here-->
            </div>
          </div>


        </div>
      </div>
      <!--end row-->
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
  <!--app-->
  <script src="<?= base_url() ?>assets/js/app.js"></script>
  <script src="<?= base_url() ?>assets/js/step.js"></script>
  <script src="<?= base_url() ?>assets/toastr/toastr.min.js"></script>
  <!-- Initialize Bootstrap Tooltips -->
  <script>
    $(document).ready(function() {
      $('[data-bs-toggle="tooltip"]').tooltip({
        placement: 'top',
        fallbackPlacements: [],
        container: 'body',
        delay: { show: 100, hide: 50 }
      });
      
      function skillSelected() {
        var skill = $('#skill').val();
        if (skill == 1) {
          $('#saleDiv').css('display', 'block');
          $('#rentalTypeMain').fadeIn();
        } else {
          $('#saleDiv').css('display', 'none');
          $('#rentalTypeMain').fadeIn();
        }
      }
      window.skillSelected = skillSelected;
    });
  </script>
  <?php
  if ($this->session->flashdata('listingAddedForApproval') != '') {
  ?>
    <script type="text/javascript">
      toastr.options = {
        "closeButton": true,
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }
      toastr.success('Listing Submitted for Approval!');
    </script>
  <?php
  }
  ?>
</body>

</html>