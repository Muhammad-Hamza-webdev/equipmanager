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

    /* Custom styles for the dropdown */
    .cities-dropdown {
      position: absolute;
      top: 100%;
      left: 0;
      right: 0;
      z-index: 1000;
      max-height: 300px;
      overflow-y: auto;
      border: 1px solid #dee2e6;
      border-radius: 0.375rem;
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
      display: none;
      background-color: white;
    }

    .city-item {
      padding: 0.75rem 1rem;
      cursor: pointer;
      border-bottom: 1px solid #f8f9fa;
      transition: background-color 0.15s ease-in-out;
    }

    .city-item:hover,
    .city-item.active {
      background-color: #f8f9fa;
    }

    .city-item:last-child {
      border-bottom: none;
    }

    .city-name {
      font-weight: 500;
      color: #212529;
    }

    .city-details {
      font-size: 0.875rem;
      color: #6c757d;
    }

    .loading-spinner {
      padding: 1rem;
      text-align: center;
      color: #6c757d;
    }

    .no-results {
      padding: 1rem;
      text-align: center;
      color: #6c757d;
      font-style: italic;
    }

    .error-message {
      padding: 1rem;
      text-align: center;
      color: #dc3545;
      background-color: #f8d7da;
      border-radius: 0.375rem;
    }

    /* Ensure the dropdown container has relative positioning */
    .position-relative {
      position: relative !important;
    }

    /* Optional: Container styling */
    .container {
      max-width: 600px;
      margin-top: 50px;
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
  <style>
    .star-rating {
      display: flex;
    }

    .star-rating input {
      display: none;
    }

    .star-rating label {
      cursor: pointer;
      transition: color 0.2s;
    }

    .star-rating label .star-icon::before {
      content: "\f587";
      /* bi-star outline */
      color: grey;
    }

    .star-rating label.hovered .star-icon::before,
    .star-rating label.selected .star-icon::before {
      content: "\f586";
      /* bi-star-fill */
      color: #ffc107;
    }

    /* Tag input styles */
    .tag-input-container {
      border: 1px solid #dee2e6;
      border-radius: 0.375rem;
      padding: 0.5rem;
      min-height: 100px;
      display: flex;
      flex-wrap: wrap;
      align-items: flex-start;
      gap: 0.5rem;
      background-color: #fff;
    }

    .tag {
      background-color: #0f2f2c;
      color: white;
      padding: 0.5rem 0.75rem;
      border-radius: 20px;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.875rem;
    }

    .tag-remove {
      cursor: pointer;
      font-weight: bold;
      padding: 0;
      margin: 0;
      background: none;
      border: none;
      color: white;
      font-size: 1rem;
      line-height: 1;
    }

    .tag-remove:hover {
      opacity: 0.8;
    }

    .tag-input-field {
      flex: 1;
      min-width: 100px;
      border: none;
      outline: none;
      font-size: 0.875rem;
    }

    .tag-input-field:focus {
      outline: none;
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
                
                width-ctrl" data-bs-toggle="tooltip" data-bs-placement="top" title="Listing Type">
                <div class="tab-progress-bar"></div>
                <a href="
                <?php
                if (!isset($_GET['edit'])) {
                  echo base_url('add-listing');
                } else {
                  echo base_url('add-listing/?itemID=' . urlencode($_GET['itemID']) . '&edit=1');
                }
                ?>
                " class="tab-btn">
                  <span class="_circle">Step 1</span>
                </a>
              </div>
              <!-- Btn -->
              <div class="multi_tabs-btn 
                active_tab
                width-ctrl" data-bs-toggle="tooltip" data-bs-placement="top" title="Listing Details">
                <div class="tab-progress-bar"></div>
                <button class="tab-btn">
                  <span class="_circle">Step 2</span>
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
                    <a href="<?= base_url('add-listing?listingID='.urlencode($_GET['itemID']).'&edit=1') ?>">
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

          <?php
          if (isset($_GET['skill']) && $_GET['skill'] == 1) {
          ?>
            <!-- for equipment second step  -->
            <div class="card multi_tab_content" id="second-box">
              <div class="card-body">
                <!-- inner card 1rd start here-->
                <div class="row">
                  <div class="col-xl-12 mx-auto">
                    <div class="border p-3 rounded">
                      <h6 class="mb-0 text-uppercase">
                        Add details ( Equipment )
                      </h6>
                      <hr />
                      <form class="row g-3" method="post" enctype="multipart/form-data" action="<?= base_url('add-equipment-listing-data/?skill=' . urlencode($_GET['skill']) . '&rentalType=' . urlencode($_GET['rentalType'])) ?>">
                        <?= csrf_field() ?>
                        <?php
                        if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                        ?>
                          <input type="hidden" name="itemID" value="<?php echo htmlspecialchars($_GET['itemID'], ENT_QUOTES, 'UTF-8'); ?>">
                        <?php
                        } else {
                        ?> <input type="hidden" name="itemID" value="">

                        <?php
                        }
                        ?>
                        <div class="col-6">
                          <label class="form-label">Equipment <span data-bs-toggle="tooltip" title="Select the equipment you want to list on the marketplace.">ⓘ</span></label>
                          <select name="eqpID" id="eqpID"
                            <?php
                            if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                            ?>
                            disabled
                            <?php
                            }
                            ?>
                            onchange="return getavailabality()" required class="form-control">
                            <option value="">Select Equipment</option>
                            <?php
                            if ($eqp) {
                              foreach ($eqp as $row) {
                            ?>
                                <option
                                  <?php
                                  if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                                    if ($shopItem[0]['equipmentID'] == $row['equipmentID']) {
                                      echo 'selected';
                                    }
                                  }
                                  ?>
                                  value="<?= $row['equipmentID'] ?>"><?= $row['equipName'] ?></option>
                              <?php
                              }
                            } else {
                              ?>
                              <option value="">No Equipment Found</option>
                            <?php
                            }
                            ?>
                          </select>

                        </div>
                        <div class="col-6">
                          <label for="qty" class="form-label">Quantity <span data-bs-toggle="tooltip" title="Enter only the number of available units. Don't enter text. Examples: 1, 3, 10">ⓘ</span></label>
                          <input type="number"
                            <?php
                            if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                            ?>
                            disabled
                            <?php
                            }
                            ?>
                            name="eqpQty" required id="eqpQty"
                            <?php
                            if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                            ?>
                            value="<?= $shopItem[0]['equipQty'] ?>"
                            <?php
                            } else {
                              echo 'disabled';
                            }
                            ?>
                            class="form-control" placeholder="Select Equipment">
                        </div>
                        <?php
                        if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                        ?>
                          <input type="hidden" name="eqpID" value="<?= $shopItem[0]['equipmentID'] ?>">
                          <input type="hidden" name="eqpQty" value="<?= $shopItem[0]['equipQty'] ?>">
                        <?php
                        }
                        ?>
                        <div class="col-6">
                          <label class="form-label">Availability (Start - End) <span data-bs-toggle="tooltip" title="Select the date range when this equipment is available for rental or sale. You can update availability later if needed.">ⓘ</span></label>
                          <input
                            type="text"
                            class="form-control"
                            id="avlRange"
                            required
                            readonly
                            placeholder="Select equipment first"
                            disabled />
                          <input type="hidden"
                            <?php
                            if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                            ?>
                            value="<?= $shopItem[0]['eqpAvailableStart'] ?>"
                            <?php
                            }
                            ?>
                            name="avlStart" id="avlStart" />
                          <input type="hidden"
                            <?php
                            if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                            ?>
                            value="<?= $shopItem[0]['eqpAvailableEnd'] ?>"
                            <?php
                            }
                            ?>
                            name="avlEnd" id="avlEnd" />
                          <?php
                          if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                          ?>
                            <span><strong>Selected dates: </strong>
                              <?= date('j M, Y', strtotime($shopItem[0]['eqpAvailableStart'])) ?> - <?= date('j M, Y', strtotime($shopItem[0]['eqpAvailableEnd'])) ?>
                            </span>
                          <?php
                          }
                          ?>

                        </div>
                        <div class="col-6">
                          <label class="form-label">Marketplace Category <span data-bs-toggle="tooltip" title="Choose the category that best describes the equipment. This helps renters find your listing more easily.">ⓘ</span></label>
                          <select name="eqpCat" id="eqpCat" required class="form-control">
                            <option value="">Select Category</option>
                            <?php
                            if ($webcat) {
                              foreach ($webcat as $row) {
                            ?>
                                <option
                                  <?php
                                  if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                                    if ($shopItem[0]['web_catID'] == $row['web_catID']) {
                                      echo 'selected';
                                    }
                                  }
                                  ?>
                                  value="<?= $row['web_catID'] ?>"><?= $row['web_catName'] ?></option>
                              <?php
                              }
                            } else {

                              ?>
                              <option value="">No Category Found Please contact Admin</option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>

                        <div class="col-12">
                          <label class="form-label">Brand/Model <span data-bs-toggle="tooltip" title="Enter the brand or model name of the equipment. This helps renters understand exactly what is being offered. Examples: Milwaukee, Bosch, Makita">ⓘ</span></label>
                          <input
                            type="text"
                            class="form-control"
                            name="eqpBrand"
                            required
                            id="eqpBrand"
                            <?php
                            if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                            ?>
                            value="<?= $shopItem[0]['eqpBrandModel'] ?>"
                            <?php
                            }
                            ?>
                            placeholder="Add  brand/model" />
                        </div>

                        <div class="col-12">

                          <div class="star-rating">
                            <label class="form-label">Condition <span data-bs-toggle="tooltip" title="Rate the condition of the equipment based on its overall state and functionality. Be honest - accurate condition ratings build trust and reduce disputes.">ⓘ</span>&nbsp;&nbsp;</label>
                            <input type="radio" id="star1" name="eqpCond" value="1" required <?php if (isset($_GET['itemID']) && $_GET['itemID'] != '' && $shopItem[0]['eqpCondition'] == 1) echo 'checked'; ?>>
                            <label for="star1" data-bs-toggle="tooltip" title="Major defects affecting performance, nearing end-of-life, requires significant attention or
replacement."><i class="bi bi-star star-icon"></i></label>
                            <input type="radio" id="star2" name="eqpCond" value="2" <?php if (isset($_GET['itemID']) && $_GET['itemID'] != '' && $shopItem[0]['eqpCondition'] == 2) echo 'checked'; ?>>
                            <label for="star2" data-bs-toggle="tooltip" title="Noticeable wear, functional but approaching mid-lifecycle, maintenance recommended."><i class="bi bi-star star-icon"></i></label>
                            <input type="radio" id="star3" name="eqpCond" value="3" <?php if (isset($_GET['itemID']) && $_GET['itemID'] != '' && $shopItem[0]['eqpCondition'] == 3) echo 'checked'; ?>>
                            <label for="star3" data-bs-toggle="tooltip" title="Minor wear, fully functional, standard maintenance needed."><i class="bi bi-star star-icon"></i></label>
                            <input type="radio" id="star4" name="eqpCond" value="4" <?php if (isset($_GET['itemID']) && $_GET['itemID'] != '' && $shopItem[0]['eqpCondition'] == 4) echo 'checked'; ?>>
                            <label for="star4" data-bs-toggle="tooltip" title="Like new, no defects, optimal performance."><i class="bi bi-star star-icon"></i></label>
                          </div>
                          <label class="form-label">Specs <span data-bs-toggle="tooltip" title="Add technical specifications or key details. Each spec should describe one important feature. Press enter after typing each key detail. Examples: Voltage: 18V, Power: 2.5 kW, Weight: 4.2 kg">ⓘ</span></label>
                          <div class="tag-input-container" id="tagInputContainer">
                            <input
                              type="text"
                              class="tag-input-field"
                              id="tagInput"
                              placeholder="Type spec and press Enter..."
                              autocomplete="off">
                          </div>
                          <textarea
                            class="form-control"
                            style="display: none;"
                            rows="4"
                            name="eqpSpec"
                            required
                            id="eqpSpec"
                            cols="4"
                            placeholder="Write Here"><?php
                                                      if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                                                      ?><?= $shopItem[0]['eqpSpecs'] ?> <?php } ?></textarea>
                        </div>
                        <div class="col-6">
                          <label class="form-label">Location(City) <span data-bs-toggle="tooltip" title="Enter the city where the equipment is located. This helps renters understand logistics and distance.">ⓘ</span></label>
                          <div class="position-relative">
                            <input
                              type="text"
                              class="form-control"
                              id="cityInput"
                              name="cityInput"
                              placeholder="Type city name..."
                              <?php
                              if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                              ?>
                              value="<?= $shopItem[0]['eqpLocCity'] ?>"
                              <?php
                              }
                              ?>
                              autocomplete="off">
                            <div id="cityDropdown" class="cities-dropdown"></div>
                          </div>
                        </div>
                        <div class="col-6">
                          <label class="form-label">Complete Address <span data-bs-toggle="tooltip" title="Enter the full address where the equipment can be picked up or delivered from. This information is only shared after a contract has been fully created and accepted by both you and the renter. This helps protect your privacy and ensures a secure transaction.">ⓘ</span></label>
                          <div class="position-relative">
                            <input
                              type="text"
                              class="form-control"
                              id="eqpadd"
                              name="eqpadd"
                              <?php
                              if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                              ?>
                              value="<?= $shopItem[0]['eqpAdd'] ?>"
                              <?php
                              }
                              ?>
                              placeholder="Complete Address">
                          </div>
                        </div>
                        <?php
                        if ($_GET['rentalType'] == 0) {
                        ?>
                          <div class="col-6">
                            <label class="form-label">Rental Price Type <span data-bs-toggle="tooltip" title="Choose how the rental price is calculated. Options: Per day, Per week, Per month">ⓘ</span></label>
                            <select name="priceType" required id="priceType" class="form-control">
                              <option
                                value="">Select Options</option>
                              <option
                                <?php
                                if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                                  if ($shopItem[0]['eqpRentalType'] == 1) {
                                    echo 'selected';
                                  }
                                }
                                ?>
                                value="1">Per Day</option>
                              <option
                                <?php
                                if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                                  if ($shopItem[0]['eqpRentalType'] == 2) {
                                    echo 'selected';
                                  }
                                }
                                ?>
                                value="2">Per Week</option>
                              <option
                                <?php
                                if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                                  if ($shopItem[0]['eqpRentalType'] == 3) {
                                    echo 'selected';
                                  }
                                }
                                ?>
                                value="3">Per Month</option>
                              <option
                                <?php
                                if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                                  if ($shopItem[0]['eqpRentalType'] == 4) {
                                    echo 'selected';
                                  }
                                }
                                ?>
                                value="4">Per Year</option>
                            </select>
                          </div>
                        <?php
                        }
                        ?>
                        <div class="col-6">
                          <label class="form-label">Pricing <span data-bs-toggle="tooltip" title="Enter the price based on the selected rental price type.">ⓘ</span></label>
                          <input
                            type="number"
                            name="price"
                            id="price"
                            required
                            <?php
                            if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                            ?>
                            value="<?= $shopItem[0]['eqpPrice'] ?>"
                            <?php
                            }
                            ?>
                            class="form-control"
                            placeholder="Add Amount $10.00" />
                        </div>


                        <div class="col-12">
                          <label class="form-label">Upload Image (Max 10) <span data-bs-toggle="tooltip" title="Upload images or files related to the equipment. This can include photos, manuals, technical drawings, or documentation. Clear images increase trust and improve listing performance.">ⓘ</span></label>
                          <input type="file" multiple name="eqpImgs[]" id="eqpImgs" class="form-control" />
                          <!-- load images for equipments -->
                          <?php
                          if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                            echo '<div class="mt-3"><label class="form-label">Existing Images</label><div class="row">';
                            for ($i = 1; $i <= 10; $i++) {
                              $imgColumn = 'eqpimg' . $i;
                              if (isset($shopItem[0][$imgColumn]) && !empty($shopItem[0][$imgColumn])) {
                                echo '<div class="col-1 mb-2">
                                  <img src="' . base_url('assets/website/images/' . $shopItem[0][$imgColumn]) . '" alt="Equipment Image ' . $i . '" class="img-fluid img-thumbnail" style="max-height: 120px; object-fit: cover;">
                                </div>';
                              }
                            }
                            echo '</div></div>';
                          }
                          ?>
                        </div>
                        <div class="col-12">
                          <div class="d-grid">
                            <button
                              type="submit"
                              class="btn btn-primary btn-clash">
                              <?php
                              if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                              ?>
                                Update & Next
                              <?php
                              } else {
                              ?>
                                Next
                              <?php
                              }
                              ?>
                            </button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- inner card 1rd end here-->
              </div>
            </div>
          <?php
          } else {
          ?>
            <!-- for equipment ends second step -->
            <!-- for workforce step 2 -->
            <div class="card multi_tab_content" id="second-box">
              <div class="card-body">
                <!-- inner card 2nd start here-->
                <dWiv class="row">
                  <div class="col-xl-12 mx-auto">
                    <div class="border p-3 rounded">
                      <h6 class="mb-0 text-uppercase">
                        Add details ( Workforce )
                      </h6>
                      <hr />
                      <form class="row g-3" method="post" enctype="multipart/form-data" action="<?= base_url('add-workforce-listing-data/?skill=' . urlencode($_GET['skill']) . '&rentalType=' . urlencode($_GET['rentalType']))  ?>">
                        <?= csrf_field() ?>
                        <?php
                        if (isset($_GET['itemID'])) {
                        ?>
                          <input type="hidden" name="itemID" value="<?php echo htmlspecialchars($_GET['itemID'], ENT_QUOTES, 'UTF-8'); ?>">
                        <?php
                        }
                        ?>
                        <div class="col-6">
                          <label class="form-label">Select Workforce <span data-bs-toggle="tooltip" title="Select the workforce member you want to list on the marketplace.">ⓘ</span></label>
                          <select
                            <?php
                            if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                            ?>
                            disabled
                            <?php
                            }
                            ?>

                            name="workforce" id="workforce" required onchange="return getEmplAvailability()" class="form-control">
                            <option value="">Select Workforce</option>
                            <?php
                            if ($employe) {
                              foreach ($employe as $row) {
                            ?>
                                <option
                                  <?php
                                  if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                                    if ($shopItem[0]['workforceID'] == $row['workforceID']) {
                                      echo 'selected';
                                    }
                                  }

                                  ?>

                                  value="<?= $row['workforceID'] ?>"><?= $row['personName'] ?></option>
                              <?php
                              }
                            } else {
                              ?>
                              <option value="">No Workforce Found!</option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                        <?php
                        if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                        ?>
                          <input type="hidden" name="workforce" value="<?= $shopItem[0]['workforceID'] ?>">
                        <?php
                        }
                        ?>
                        <div class="col-6">
                          <label class="form-label">Availability (Start - End) <span data-bs-toggle="tooltip" title="Select the date range when this workforce member is available for rental or hire. You can update availability later if needed.">ⓘ</span></label>
                          <input
                            type="text"
                            class="form-control"
                            id="avlEmplRange"
                            required
                            readonly
                            placeholder="Select Workforce first"
                            disabled />
                          <input type="hidden" name="avlEmpStart" id="avlEmpStart" />
                          <input type="hidden" name="avlEmpEnd" id="avlEmpEnd" />
                          <?php
                          if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                          ?>
                            <span><strong>Selected dates: </strong>
                              <?= date('j M, Y', strtotime($shopItem[0]['workforceAvailableStart'])) ?> - <?= date('j M, Y', strtotime($shopItem[0]['workforceAvailableEnd'])) ?>
                            </span>
                          <?php
                          }
                          ?>
                        </div>
                        <div class="col-12">
                          <label class="form-label">Marketplace Category <span data-bs-toggle="tooltip" title="Choose the category that best describes the workforce skills. This helps clients find your listing more easily.">ⓘ</span></label>
                          <select name="eqpCat" id="eqpCat" required class="form-control">
                            <option value="">Select Category</option>
                            <?php
                            if ($webcat) {
                              foreach ($webcat as $row) {
                            ?>
                                <option
                                  <?php
                                  if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                                    if ($shopItem[0]['web_catID'] == $row['web_catID']) {
                                      echo 'selected';
                                    }
                                  }

                                  ?>
                                  value="<?= $row['web_catID'] ?>"><?= $row['web_catName'] ?></option>
                              <?php
                              }
                            } else {

                              ?>
                              <option value="">No Category Found Please contact Admin</option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>

                        <div class="col-12">
                          <label class="form-label">Upload CV <span data-bs-toggle="tooltip" title="Upload your CV or resume. This document helps clients understand your qualifications and experience.">ⓘ</span></label>
                          <input
                            type="file"
                            class="form-control"
                            name="cv"
                            id="cv"
                            <?php
                            if (isset($_GET['itemID']) && $_GET['itemID'] == '') {

                            ?>
                            required
                            <?php
                            }
                            ?>
                            placeholder="Upload CV Here" />
                        </div>
                        <?php
                        if (isset($_GET['itemID']) && $_GET['itemID'] != '') {

                        ?>
                          <div class="mt-3">
                            <label class="form-label">Existing Images</label>
                            <div class="row">
                              <div class="col-1 mb-2">
                                <img src="<?= base_url('assets/website/documents/' . $shopItem[0]['workforceCV'])  ?>" width="150px" alt="">
                              </div>
                            </div>
                          </div>
                        <?php

                        }
                        ?>
                        <div class="col-12">
                          <label class="form-label">Certificate <span data-bs-toggle="tooltip" title="Upload any relevant certificates or credentials. This helps establish credibility and expertise.">ⓘ</span></label>
                          <input
                            type="file"
                            id="certificate"
                            name="certificate"
                            class="form-control"
                            placeholder="Upload Certificates Here" />
                        </div>
                        <?php
                        if (isset($_GET['itemID']) && $_GET['itemID'] != '') {

                        ?>
                          <div class="mt-3">
                            <label class="form-label">Existing Images</label>
                            <div class="row">
                              <div class="col-1 mb-2">
                                <img src="<?= base_url('assets/website/documents/' . $shopItem[0]['workforceCertif'])  ?>" width="150px" alt="">
                              </div>
                            </div>
                          </div>
                        <?php

                        }
                        ?>
                        <div class="col-6">
                          <label class="form-label">Location(City)</label>
                          <div class="position-relative">
                            <input
                              type="text"
                              class="form-control"
                              id="cityInput"
                              name="cityInput"
                              <?php
                              if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                              ?>
                              value="<?= $shopItem[0]['workforceCity'] ?>"
                              <?php
                              }
                              ?>
                              placeholder="Type city name..."
                              autocomplete="off">
                            <div id="cityDropdown" class="cities-dropdown"></div>
                          </div>
                        </div>
                        <div class="col-6">
                          <label class="form-label">Complete Address</label>
                          <div class="position-relative">
                            <input
                              type="text"
                              class="form-control"
                              id="eqpadd"
                              <?php
                              if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                              ?>
                              value="<?= $shopItem[0]['WorkforceAdd'] ?>"
                              <?php
                              }
                              ?>
                              name="eqpadd"
                              placeholder="Complete Address">
                          </div>
                        </div>
                        <div class="col-6">
                          <label class="form-label">Rental Price Type <span data-bs-toggle="tooltip" title="Choose how the rental price is calculated. Options: Per day, Per week, Per month, Per year">ⓘ</span></label>
                          <select name="priceType" required id="priceType" class="form-control">
                            <option value="">Select Options</option>
                            <option
                              <?php
                              if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                                if ($shopItem[0]['workforceRentalType'] == 1) {
                                  echo 'selected';
                                }
                              }
                              ?>
                              value="1">Per Day</option>
                            <option
                              <?php
                              if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                                if ($shopItem[0]['workforceRentalType'] == 2) {
                                  echo 'selected';
                                }
                              }
                              ?>
                              value="2">Per Week</option>
                            <option
                              <?php
                              if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                                if ($shopItem[0]['workforceRentalType'] == 3) {
                                  echo 'selected';
                                }
                              }
                              ?>
                              value="3">Per Month</option>
                            <option
                              <?php
                              if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                                if ($shopItem[0]['workforceRentalType'] == 4) {
                                  echo 'selected';
                                }
                              }
                              ?>
                              value="4">Per Year</option>
                          </select>
                        </div>
                        <div class="col-6">
                          <label class="form-label">Pricing Amount <span data-bs-toggle="tooltip" title="Enter the price based on the selected rental price type.">ⓘ</span></label>
                          <input
                            type="number"
                            class="form-control"
                            id="workforcePrice"
                            required
                            <?php
                            if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                            ?>
                            value="<?= $shopItem[0]['workforcePrice'] ?>"
                            <?php
                            }
                            ?>
                            name="workforcePrice"
                            placeholder="Add Amount $10.00" />
                        </div>

                        <div class="col-12">
                          <div class="d-grid">
                            <button
                              type="submit"
                              class="btn btn-primary btn-clash">
                              <?php
                              if (isset($_GET['itemID']) && $_GET['itemID'] != '') {
                              ?>
                                Update & Next
                              <?php
                              } else {
                              ?>
                                Next
                              <?php
                              }
                              ?>
                            </button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </dWiv>
                <!-- inner card 2nd end here-->
              </div>
            </div>
          <?php
          }
          ?>

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
  <script src="<?= base_url() ?>assets/js/openstreet.js"></script>
  <!-- daterangepicker CSS/JS (CDN) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

  <script>
    (function() {
      var blockedRanges = [];
      var drInput = $('#avlEmplRange');
      var enabledPlaceholder = 'Select dates';
      drInput.prop('disabled', true);
      drInput.val('');
      var hiddenStart = $('#avlEmpStart');
      var hiddenEnd = $('#avlEmpEnd');

      function initPicker() {
        if (drInput.data('daterangepicker')) {
          drInput.data('daterangepicker').remove();
        }

        drInput.daterangepicker({
          opens: 'left',
          autoApply: true,
          autoUpdateInput: false,
          minDate: moment().startOf('day'),
          isInvalidDate: function(date) {
            for (var i = 0; i < blockedRanges.length; i++) {
              var r = blockedRanges[i];
              if (date.isBetween(r.start, r.end, null, '[]')) return true;
            }
            return false;
          }
        }, function(start, end, label) {
          hiddenStart.val(start.format('YYYY-MM-DD'));
          hiddenEnd.val(end.format('YYYY-MM-DD'));
          drInput.val(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
        });
      }

      initPicker();
      if (drInput.prop('disabled')) drInput.val('');

      window.getEmplAvailability = function() {
        var workforceID = $('#workforce').val();
        if (!workforceID) {
          drInput.prop('disabled', true).attr('placeholder', 'Select workforce first');
          drInput.val('');
          return;
        }
        $.ajax({
          url: '<?= base_url('listing/fetchWorkforceAvailablity') ?>',
          type: 'POST',
          data: {
            workforceID: workforceID,
            '<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>'
          },
          dataType: 'json',
          success: function(response) {
            blockedRanges = [];
            var ranges = Array.isArray(response) ? response : (response.ranges || []);

            ranges.forEach(function(r) {
              var s = moment(r.start, 'YYYY-MM-DD');
              var e = moment(r.end, 'YYYY-MM-DD');
              if (s.isValid() && e.isValid()) blockedRanges.push({
                start: s,
                end: e
              });
            });

            initPicker();
            drInput.prop('disabled', false).removeClass('disabled').attr('placeholder', enabledPlaceholder);
            hiddenStart.val('');
            hiddenEnd.val('');
            drInput.val('');
          },
          error: function() {
            blockedRanges = [];
            initPicker();
            drInput.prop('disabled', false).removeClass('disabled').attr('placeholder', enabledPlaceholder);
          }
        });
      };
      // Seed blocked ranges from server data if available, then initialize picker
      (function() {
        // indicate whether server-side availability variable exists
        var hasServerAvail = <?php echo isset($workforceAvailability) ? 'true' : 'false'; ?>;
        var serverRanges = <?php
                            $sr = array();
                            if (isset($workforceAvailability) && !empty($workforceAvailability)) {
                              foreach ($workforceAvailability as $p) {
                                $s = isset($p['pStartDate']) ? date('Y-m-d', strtotime($p['pStartDate'])) : null;
                                $e = isset($p['pEndDate']) ? date('Y-m-d', strtotime($p['pEndDate'])) : null;
                                $sr[] = array('start' => $s, 'end' => $e);
                              }
                            }
                            echo json_encode($sr);
                            ?>;

        if (Array.isArray(serverRanges) && serverRanges.length) {
          // there are blocked ranges from server; add them
          serverRanges.forEach(function(r) {
            if (r.start && r.end) blockedRanges.push({
              start: moment(r.start, 'YYYY-MM-DD'),
              end: moment(r.end, 'YYYY-MM-DD')
            });
          });
          drInput.prop('disabled', false).removeClass('disabled').attr('placeholder', enabledPlaceholder);
          <?php if (isset($shopItem[0]['workforceAvailableStart']) && isset($shopItem[0]['workforceAvailableEnd'])): ?>
            $('#avlEmpStart').val('<?= date('Y-m-d', strtotime($shopItem[0]['workforceAvailableStart'])) ?>');
            $('#avlEmpEnd').val('<?= date('Y-m-d', strtotime($shopItem[0]['workforceAvailableEnd'])) ?>');
          <?php endif; ?>
        } else if (hasServerAvail) {
          // variable is set but empty -> show full calendar (no blocked ranges)
          drInput.prop('disabled', false).removeClass('disabled').attr('placeholder', enabledPlaceholder);
          <?php if (isset($shopItem[0]['workforceAvailableStart']) && isset($shopItem[0]['workforceAvailableEnd'])): ?>
            $('#avlEmpStart').val('<?= date('Y-m-d', strtotime($shopItem[0]['workforceAvailableStart'])) ?>');
            $('#avlEmpEnd').val('<?= date('Y-m-d', strtotime($shopItem[0]['workforceAvailableEnd'])) ?>');
          <?php endif; ?>
        }

        // initialize picker after seeding ranges (always call)
        initPicker();
      })();
    })();
  </script>
  <script>
    (function() {
      var blockedRanges = [];
      var drInput = $('#avlRange');
      var enabledPlaceholder = 'Select dates';
      // keep picker disabled until equipment is selected (HTML provides initial placeholder)
      drInput.prop('disabled', true);
      drInput.val('');
      var hiddenStart = $('#avlStart');
      var hiddenEnd = $('#avlEnd');

      function initPicker() {
        // destroy existing if any
        if (drInput.data('daterangepicker')) {
          drInput.data('daterangepicker').remove();
        }

        drInput.daterangepicker({
          opens: 'left',
          autoApply: true,
          autoUpdateInput: false,
          minDate: moment().startOf('day'),
          isInvalidDate: function(date) {
            for (var i = 0; i < blockedRanges.length; i++) {
              var r = blockedRanges[i];
              if (date.isBetween(r.start, r.end, null, '[]')) return true;
            }
            return false;
          }
        }, function(start, end, label) {
          hiddenStart.val(start.format('YYYY-MM-DD'));
          hiddenEnd.val(end.format('YYYY-MM-DD'));
          drInput.val(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
        });
      }

      // Seed blocked ranges from server data if available, then initialize picker
      (function() {
        // indicate whether server-side availability variable exists
        var hasServerAvail = <?php echo isset($eqpAvailablity) ? 'true' : 'false'; ?>;
        var serverRanges = <?php
                            $sr = array();
                            if (isset($eqpAvailablity) && !empty($eqpAvailablity)) {
                              foreach ($eqpAvailablity as $p) {
                                $s = isset($p['pStartDate']) ? date('Y-m-d', strtotime($p['pStartDate'])) : null;
                                $e = isset($p['pEndDate']) ? date('Y-m-d', strtotime($p['pEndDate'])) : null;
                                $sr[] = array('start' => $s, 'end' => $e);
                              }
                            }
                            echo json_encode($sr);
                            ?>;

        if (Array.isArray(serverRanges) && serverRanges.length) {
          // there are blocked ranges from server; add them
          serverRanges.forEach(function(r) {
            if (r.start && r.end) blockedRanges.push({
              start: moment(r.start, 'YYYY-MM-DD'),
              end: moment(r.end, 'YYYY-MM-DD')
            });
          });
          drInput.prop('disabled', false).removeClass('disabled').attr('placeholder', enabledPlaceholder);
          <?php if (isset($shopItem[0]['eqpAvailableStart']) && isset($shopItem[0]['eqpAvailableEnd'])): ?>
            $('#avlStart').val('<?= date('Y-m-d', strtotime($shopItem[0]['eqpAvailableStart'])) ?>');
            $('#avlEnd').val('<?= date('Y-m-d', strtotime($shopItem[0]['eqpAvailableEnd'])) ?>');
          <?php endif; ?>
        } else if (hasServerAvail) {
          // variable is set but empty -> show full calendar (no blocked ranges)
          drInput.prop('disabled', false).removeClass('disabled').attr('placeholder', enabledPlaceholder);
          <?php if (isset($shopItem[0]['eqpAvailableStart']) && isset($shopItem[0]['eqpAvailableEnd'])): ?>
            $('#avlStart').val('<?= date('Y-m-d', strtotime($shopItem[0]['eqpAvailableStart'])) ?>');
            $('#avlEnd').val('<?= date('Y-m-d', strtotime($shopItem[0]['eqpAvailableEnd'])) ?>');
          <?php endif; ?>
        }

        // initialize picker after seeding ranges (always call)
        initPicker();
      })();
      // ensure the input stays empty on init (picker no longer auto-updates input)
      if (drInput.prop('disabled')) drInput.val('');

      window.getavailabality = function() {
        var eqpID = $('#eqpID').val();
        if (!eqpID) {
          drInput.prop('disabled', true).attr('placeholder', 'Select equipment first');
          drInput.val('');
          return;
        }
        $.ajax({
          url: '<?= base_url('listing/fetchEquipmentAvailablity') ?>',
          type: 'POST',
          data: {
            eqpID: eqpID,
            '<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>'
          },
          dataType: 'json',
          success: function(response) {
            blockedRanges = [];
            var ranges = Array.isArray(response) ? response : (response.ranges || []);
            var availableQty = response.availableQty !== undefined ? response.availableQty : 0;

            ranges.forEach(function(r) {
              // ensure valid moments
              var s = moment(r.start, 'YYYY-MM-DD');
              var e = moment(r.end, 'YYYY-MM-DD');
              if (s.isValid() && e.isValid()) blockedRanges.push({
                start: s,
                end: e
              });
            });

            initPicker();
            // enable input now and set enabled placeholder
            drInput.prop('disabled', false).removeClass('disabled').attr('placeholder', enabledPlaceholder);
            // clear previous selection
            hiddenStart.val('');
            hiddenEnd.val('');
            drInput.val('');

            // configure quantity input
            var eqpQtyInput = $('#eqpQty');
            if (eqpQtyInput.length) {
              eqpQtyInput.prop('disabled', false)
                .attr('max', availableQty)
                .attr('placeholder', 'Enter 0-' + availableQty);
            }
          },
          error: function() {
            blockedRanges = [];
            initPicker();
            drInput.prop('disabled', false).removeClass('disabled').attr('placeholder', enabledPlaceholder);
          }
        });
      };
    })();
  </script>
  <script>
    $(document).ready(function() {
      $('[data-bs-toggle="tooltip"]').tooltip({
        placement: 'top',
        fallbackPlacements: [],
        container: 'body',
        delay: { show: 100, hide: 50 }
      });
      $('.star-rating label').hover(function() {
        $(this).prevAll('label').addBack().addClass('hovered');
      }, function() {
        $(this).prevAll('label').addBack().removeClass('hovered');
      });
      $('.star-rating input').change(function() {
        var $starRating = $(this).closest('.star-rating');
        $starRating.find('label').removeClass('selected');
        $(this).next('label').prevAll('label').addBack().addClass('selected');
      });
      // Trigger change on load for pre-checked
      $('.star-rating input:checked').trigger('change');

      // Validate that condition is selected on form submission
      // $('form').on('submit', function(e) {
      //   var eqpCondChecked = $('input[name="eqpCond"]:checked').length > 0;
      //   if (!eqpCondChecked) {
      //     e.preventDefault();
      //     alert('Please select a condition rating');
      //     return false;
      //   }
      // });

      // Tag input functionality
      var tags = [];
      var tagInput = $('#tagInput');
      var tagContainer = $('#tagInputContainer');
      var eqpSpecField = $('#eqpSpec');

      // Load existing tags from textarea
      function loadExistingTags() {
        var existingSpecs = eqpSpecField.val().trim();
        if (existingSpecs) {
          tags = existingSpecs.split('|').map(function(tag) {
            return tag.trim();
          }).filter(function(tag) {
            return tag.length > 0;
          });
          renderTags();
        }
      }

      // Render tags
      function renderTags() {
        // Remove existing tag elements
        tagContainer.find('.tag').remove();

        // Add tag elements
        tags.forEach(function(tag, index) {
          var tagElement = $('<div class="tag">' +
            '<span>' + escapeHtml(tag) + '</span>' +
            '<button type="button" class="tag-remove" data-index="' + index + '">×</button>' +
            '</div>');
          tagContainer.append(tagElement);
        });

        // Update textarea
        updateTextarea();
      }

      // Update textarea with tags
      function updateTextarea() {
        eqpSpecField.val(tags.join(' | '));
      }

      // Escape HTML
      function escapeHtml(text) {
        var map = {
          '&': '&amp;',
          '<': '&lt;',
          '>': '&gt;',
          '"': '&quot;',
          "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, function(m) {
          return map[m];
        });
      }

      // Add tag on Enter
      tagInput.on('keypress', function(e) {
        if (e.which === 13) {
          e.preventDefault();
          var tagText = tagInput.val().trim();
          if (tagText.length > 0) {
            if (!tags.includes(tagText)) {
              tags.push(tagText);
              renderTags();
              tagInput.val('').focus();
            } else {
              alert('This tag already exists');
              tagInput.val('');
            }
          }
        }
      });

      // Remove tag
      $(document).on('click', '.tag-remove', function(e) {
        e.preventDefault();
        var index = $(this).data('index');
        tags.splice(index, 1);
        renderTags();
        tagInput.focus();
      });

      // Load existing tags on page load
      loadExistingTags();
    });
  </script>
</body>

</html>