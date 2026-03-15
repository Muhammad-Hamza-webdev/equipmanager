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

  <title>Add New Project </title>
  <style>
    .img-fix-cover {
      object-fit: cover !important;
    }

    .width-ctrl {
      --width: 25%;
    }

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

    /* Overlay */
    .loader-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: #8080802b;
      /* grey dim */
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 999;
      border-radius: 15px;
      display: none;
    }

    /* Logo Spin Animation */
    .loader-logo {
      width: 45px;
      animation: spinCycle 4s infinite;
    }

    @keyframes spinCycle {
      0% {
        transform: rotate(0deg);
      }

      60% {
        transform: rotate(1080deg);
      }

      /* 3 fast spins */
      80% {
        transform: rotate(1440deg);
      }

      /* slowing down */
      100% {
        transform: rotate(1440deg);
      }

      /* pause before repeat */
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
          Project Management
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
              <div class="multi_tabs-btn active_tab width-ctrl" id="step1div" data-bs-toggle="tooltip" data-bs-placement="top" title="Project Overview">
                <div class="tab-progress-bar"></div>
                <button class="tab-btn" id="step-1">
                  <span class="_circle">Step 1</span>
                </button>
              </div>
              <!-- Btn -->
              <div class="multi_tabs-btn   width-ctrl" id="step2div" data-bs-toggle="tooltip" data-bs-placement="top" title="Resources">
                <div class="tab-progress-bar"></div>
                <button class="tab-btn " id="step-2">
                  <span class="_circle">Step 2</span>
                </button>
              </div>
              <!-- Btn -->
              <div class="multi_tabs-btn" style="--width: 50%" id="step3div" data-bs-toggle="tooltip" data-bs-placement="top" title="Responsibility">
                <div class="tab-progress-bar"></div>
                <button class="tab-btn" id="step-3">
                  <span class="_circle">Step 3</span>
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
                  <!-- <div class="card">
                    <div class="card-body"> -->
                  <div class="border p-3 rounded">
                    <h6 class="mb-0 text">Add General Information</h6>
                    <hr />
                    <form class="row g-3" method="post" id="firstForm" enctype="multipart/form-data">
                      <!-- SECURITY FIX: Add CSRF token to form -->
                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                      <div class="col-12">
                        <label class="form-label">Project name <span data-bs-toggle="tooltip" title="Give the project a clear and recognizable name. This helps your team and partners quickly identify the project across equipment, workforce, and tracking. Examples: 'Office renovation – electrical installation' or 'Warehouse expansion – phase 1'">ⓘ</span></label>
                        <input
                          type="text"
                          required
                          id="pName"
                          name="pName"
                          <?php
                          if (isset($_GET['id'])) {
                            echo 'value="' . htmlspecialchars($projectData[0]['pName']) . '"';
                          }
                          ?>
                          class="form-control"
                          placeholder="Enter Project name" />
                      </div>
                      <div class="col-12">
                        <label class="form-label">Project category <span data-bs-toggle="tooltip" title="Select the category that best describes the type of work. This helps organize projects and improves filtering and reporting later. Categories: Electrical, Construction, Plumbing, Renovation, Infrastructure">ⓘ</span></label>
                        <select name="pCatID" id="pCatID" required class="form-control">
                          <option value="">select Category</option>
                          <?php
                          if (!empty($Pcategory)) {
                            foreach ($Pcategory as $cat) {
                          ?>
                              <option
                                <?php
                                if (isset($_GET['id']) && $projectData[0]['pCatID'] == $cat['pCatID']) {
                                  echo 'selected';
                                }
                                ?>
                                value="<?= $cat['pCatID'] ?>"><?= $cat['pCatName'] ?></option>
                          <?php
                            }
                          } else {
                            echo '<option value="">No Category Found</option>';
                          }
                          ?>
                        </select>
                      </div>
                      <div class="col-12">
                        <label class="form-label">Location <span data-bs-toggle="tooltip" title="Enter the primary location of the project. This is used to link equipment, workforce, and logistics to the correct site. You can use a city name, site name, or address.">ⓘ</span></label>
                        <input
                          type="text"
                          required
                          id="pLocation"
                          name="pLocation"
                          <?php
                          if (isset($_GET['id'])) {
                            echo 'value="' . htmlspecialchars($projectData[0]['pLocation']) . '"';
                          }
                          ?>
                          class="form-control"
                          placeholder="Add  Location" />
                      </div>
                      <div class="col-12">
                        <label class="form-label">Upload Image (Max 10, Optional) <span data-bs-toggle="tooltip" title="Upload relevant files for the project. This can include photos, technical drawings, plans, documents, or other project-related files (Site photos, Technical drawings PDF/DWG, Electrical diagrams, Safety documents, Specifications). These files help create a shared understanding of the project for everyone involved.">ⓘ</span></label>
                        <input type="file" multiple id="pImg" name="pImg[]" class="form-control" />
                        <div id="previewContainer" class="mt-3 d-flex flex-wrap gap-2">
                          <?php
                          if (isset($projectData) && !empty($projectData[0]['pImg1'])) {
                            for ($i = 1; $i <= 10; $i++) {
                              $imgField = 'pImg' . $i;
                              if (!empty($projectData[0][$imgField])) {
                                echo '<img src="' . base_url('assets/uploads/projectImgs/' . $projectData[0][$imgField]) . '" alt="Project Image" style="width:100px; height:100px; object-fit:cover; border-radius:8px; border:1px solid #ddd;"/>';
                              }
                            }
                          }
                          ?>
                        </div>
                      </div>
                      <script>
                        document.getElementById("pImg").addEventListener("change", function(event) {
                          const previewContainer = document.getElementById("previewContainer");
                          previewContainer.innerHTML = ""; // Clear previous previews

                          const files = event.target.files;

                          if (files.length > 10) {
                            alert("You can only upload a maximum of 10 files.");
                            event.target.value = ""; // Clear the input
                            return;
                          }

                          Array.from(files).forEach((file) => {
                            if (file.type.startsWith("image/")) {
                              const reader = new FileReader();

                              reader.onload = function(e) {
                                const img = document.createElement("img");
                                img.src = e.target.result;
                                img.alt = file.name;
                                img.style.width = "100px";
                                img.style.height = "100px";
                                img.style.objectFit = "cover";
                                img.style.borderRadius = "8px";
                                img.style.border = "1px solid #ddd";
                                previewContainer.appendChild(img);
                              };

                              reader.readAsDataURL(file);
                            } else {
                              const fileName = document.createElement("p");
                              fileName.textContent = file.name;
                              fileName.style.color = "red";
                              previewContainer.appendChild(fileName);
                            }
                          });
                        });
                      </script>
                      <div class="col-12 mb-3">
                        <label class="form-label">Timeline</label><br>

                        <div class="row">

                          <div class="col-md-6 mb-2 mb-md-0">
                            <span class="text-muted mt-2">Start Date <span data-bs-toggle="tooltip" title="Select the expected start date of the project. This is used for planning availability of equipment and workforce.">ⓘ</span></span>
                            <input
                              type="date"
                              id="pStartDate"
                              name="pStartDate"
                              <?php
                              if (isset($_GET['id'])) {
                                echo 'value="' . htmlspecialchars($projectData[0]['pStartDate']) . '"';
                              }
                              ?>
                              required
                              class="form-control"
                              placeholder="Start Date" />

                          </div>

                          <div class="col-md-6">
                            <span class="text-muted mt-2">End Date <span data-bs-toggle="tooltip" title="Select the expected end date of the project. The timeline can be updated later if the project changes.">ⓘ</span></span>
                            <input
                              type="date"
                              id="pEndDate"
                              required
                              name="pEndDate"
                              <?php
                              if (isset($_GET['id'])) {
                                echo 'value="' . $projectData[0]['pEndDate'] . '"';
                              }
                              ?>
                              class="form-control"
                              placeholder="End Date" />
                          </div>
                        </div>
                      </div>
                      <div class="col-12">
                        <label class="form-label">Description <span data-bs-toggle="tooltip" title="Add a description of the project scope, goals, and any important details. The more detailed the description, the better the shared understanding for everyone connected to the project.">ⓘ</span></label>
                        <textarea
                          class="form-control"
                          rows="4"
                          cols="4"
                          required
                          id="pDesc"
                          name="pDesc"
                          placeholder="Write Here"><?php
                                                    if (isset($_GET['id'])) {
                                                      echo  htmlspecialchars($projectData[0]['pDesc']);
                                                    }
                                                    ?></textarea>
                      </div>
                      <div class="row justify-content-center mt-3">
                        <div class="col-sm-1">
                          <div class="d-flex">
                            <button
                              type="submit"
                              class="btn btn-primary btn-clash">
                              Next
                            </button>
                          </div>
                        </div>
                      </div>
                    </form>
                    <!-- </div>
                    </div> -->
                  </div>
                </div>
                <div class="loader-overlay" id="loader">
                  <img src="<?= base_url() ?>assets/images/logo-icon.png" alt="Loading..." class="loader-logo">
                </div>
              </div>
              <!-- inner card end here-->
            </div>
          </div>
          <div class="card multi_tab_content" id="second-box">
            <div class="card-body">
              <!-- inner card 2nd start here-->
              <div class="row">
                <div class="col-xl-12 mx-auto">
                  <!-- <div class="card">
                    <div class="card-body"> -->
                  <div class="border p-3 rounded">
                    <h6 class="mb-0 text">Workforce and Equipment</h6>
                    <hr />
                    <form class="row g-3">
                      <div class="col-12">
                        <div class="d-flex align-items-center gap-20 mb-3">
                          <label class="form-label mb-0">Select Workforce <span data-bs-toggle="tooltip" title="Select the employees or workforce members who will be assigned to this project. This helps with planning, coordination, and responsibility tracking. You can add or remove workforce members later if the project changes.">ⓘ</span></label>
                        </div>
                        <select name="workforce" id="workforce" onchange="return step2ajax()" class="form-control">
                          <option value="">Select Workforce</option>
                          <?php
                          if (!empty($workforce) && isset($workforce)) {
                            foreach ($workforce as $emp) {
                          ?>
                              <option value="<?= $emp['workforceID'] ?>"><?= $emp['personName'] ?></option>
                          <?php
                            }
                          } else {
                            echo '<option value="">No Workforce Found</option>';
                          }
                          ?>
                        </select>
                      </div>

                      <!-- start -->
                      <div class="card-body card-body-p-0">
                        <div class="product-grid">
                          <div
                            class="row row-cols-1 row-cols-sm-1 row-cols-md-3 row-cols-lg-6 g-3" id="workcardsContainer">
                            <?php
                            if (isset($selectedworkforce) && !empty($selectedworkforce)) {
                              foreach ($selectedworkforce as $sel) {
                                $getskill = $this->generic->GetWorkforcewithSkill(array(), array('w.workforceID' => $sel['workforceID']));
                                $skills = '';
                                if ($getskill) {

                                  foreach ($getskill as $sk) {
                                    $skills .= $sk['skillNames'];
                                  }
                                }
                            ?>
                                <!-- Card start -->
                                <div class="col close" style="position: relative">
                                  <div class="card border shadow-none h-100">
                                    <div class="text-start">
                                      <img
                                        src="<?= base_url('assets/uploads/workforce/' . $sel['personImg']) ?>"
                                        class="card-img-top-main rounded-top"
                                        alt="Helen Heidenreich" />
                                      <a href="javascript:removeworkforce(<?= $sel['workforceID'] ?>)" onclick="return confirm('Are you sure you want to remove person from project?')">
                                        <svg
                                          width="29"
                                          height="29"
                                          viewBox="0 0 29 29"
                                          fill="none"
                                          xmlns="http://www.w3.org/2000/svg">
                                          <path
                                            d="M19.323 18.1157L15.6999 14.4925L19.323 10.8694C19.4832 10.7092 19.5732 10.492 19.5732 10.2655C19.5732 10.039 19.4832 9.82181 19.323 9.66166C19.1629 9.50151 18.9457 9.41154 18.7192 9.41154C18.4927 9.41154 18.2755 9.50151 18.1153 9.66166L14.4922 13.2848L10.869 9.66166C10.7089 9.50151 10.4917 9.41154 10.2652 9.41154C10.0387 9.41154 9.82149 9.50151 9.66134 9.66166C9.50118 9.82181 9.41121 10.039 9.41121 10.2655C9.41121 10.492 9.50118 10.7092 9.66134 10.8694L13.2845 14.4925L9.66134 18.1157C9.50118 18.2758 9.41121 18.493 9.41121 18.7195C9.41121 18.946 9.50118 19.1632 9.66134 19.3234C9.82149 19.4835 10.0387 19.5735 10.2652 19.5735C10.4917 19.5735 10.7089 19.4835 10.869 19.3234L14.4922 15.7002L18.1153 19.3234C18.2755 19.4835 18.4927 19.5735 18.7192 19.5735C18.9457 19.5735 19.1629 19.4835 19.323 19.3234C19.4832 19.1632 19.5732 18.946 19.5732 18.7195C19.5732 18.493 19.4832 18.2758 19.323 18.1157Z"
                                            fill="grey" />
                                        </svg>
                                      </a>
                                      <div class="card-body p-3">
                                        <h5 class="card-title mb-1">
                                          <?= $sel['personName'] ?>
                                        </h5>
                                        <span class="text-muted"><?= $skills ?></span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            <?php
                              }
                            } else {
                              echo '<p class="text-muted">No Workforce Selected Yet</p>';
                            }
                            ?>
                          </div>
                        </div>
                      </div>
                      <!-- end -->




                      <!-- second section start  -->

                      <div class="col-5">
                        <div class="d-flex align-items-center gap-20 mb-3">
                          <label class="form-label mb-0">Select Equipment <span data-bs-toggle="tooltip" title="Select the equipment that will be used for this project. Assigned equipment can be tracked, planned, and linked to availability and usage. You can add or remove equipment later if the project changes.">ⓘ</span></label>
                        </div>
                        <select name="equipment" id="equipment" class="form-control">
                          <option value="">Select Equipment</option>
                          <?php
                          if (isset($_GET['id'])) {
                            $allEquipments = $this->generic->GetData('equipment');

                            foreach ($allEquipments as $allequips) {
                              // Initialize available quantity with the total quantity
                              $availableQty = $allequips['equipTotalQuantity'];

                              // Get all assigned equipment for the current equipment
                              $curentEquipAssignList = $this->generic->GetAllAssignedEquipment(array('pel.equipmentID' => $allequips['equipmentID']));
                              if( $curentEquipAssignList){
                              // Loop through assigned equipment and calculate overlapping quantities
                              foreach ($curentEquipAssignList as $projectEQList) {
                                // Check if the project dates overlap
                                if (
                                  $projectData[0]['pStartDate'] <= $projectEQList['pEndDate'] &&
                                  $projectData[0]['pEndDate'] >= $projectEQList['pStartDate']
                                ) {
                                  
                                  // Subtract the assigned quantity from the available quantity
                                  $availableQty -= $projectEQList['equipmentQTY'];
                                  echo 'aaaa'.$availableQty;
                                }
                              }
                            }
                              
                              // Ensure the available quantity is not negative
                              $availableQty = max($availableQty, 0);

                              // Display the equipment in the dropdown with the available quantity
                              if ($availableQty > 0) {
                                echo '<option value="' . $allequips['equipmentID'] . '" data-available-qty="' . $availableQty . '">' . $allequips['equipName'] . ' (QTY: ' . $availableQty . ')</option>';
                              }
                            }
                          ?>
                          <?php

                          } else {
                            echo '<option value="">No Equipment Selected Yet</option>';
                          }
                          ?>
                        </select>
                      </div>
                      <div class="col-5">
                        <div class="d-flex align-items-center gap-20 mb-3">
                          <label class="form-label mb-0">Quantity <span data-bs-toggle="tooltip" title="Enter only the number of units you want to assign to this project. Only enter numbers (e.g., 1, 3, 10).">ⓘ</span></label>
                        </div>
                        <input type="number" name="qty" id="qty" class="form-control" placeholder="Select equipment first" />
                      </div>
                      <div class="col-2 d-flex justify-content-start align-items-end">
                        <!-- <div class="d-flex align-items-center gap-20 mb-3">
                          <label class="form-label mb-0">Select Equipment</label>
                        </div> -->
                        <input type="button" onclick="return addequipmentAjax()" class="btn btn-primary btn-clash d-flex align-items-center" value="Add Equipment" />
                      </div>


                      <!-- start -->
                      <div class="card-body card-body-p-0">
                        <div class="product-grid">
                          <div
                            class="row row-cols-1 row-cols-sm-1 row-cols-md-3 row-cols-lg-6 g-3" id="equipcardsContainer">

                            <?php
                            if (isset($selectedEquipment) && !empty($selectedEquipment)) {
                              foreach ($selectedEquipment as $selEquip) {
                                $equipDetails = $this->generic->GetData('equipment', array('equipmentID' => $selEquip['equipmentID']));
                                //get category name
                                $equipmentCat = $this->generic->GetData('equipcat', array('equipCatID' => $equipDetails[0]['equipCatID']));
                                if ($equipDetails) {
                                  $equip = $equipDetails[0];
                                  $catName = $equipmentCat ? $equipmentCat[0]['catName'] : 'Uncategorized';
                            ?>
                                  <!-- Card start -->
                                  <div class="col close" style="position: relative">
                                    <div class="card border shadow-none h-100">
                                      <div class="text-start">
                                        <img
                                          src="<?= base_url() ?>assets/uploads/equipment/<?= $equip['equipImg'] ?>"
                                          class="card-img-top-main rounded-top img-fix-cover"
                                          alt="Helen Heidenreich" />
                                        <a href="javascript:removeequipment(<?= $equip['equipmentID'] ?>)" onclick="return confirm('Are you sure you want to remove Equipment from project?')">
                                          <svg
                                            width="29"
                                            height="29"
                                            viewBox="0 0 29 29"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                              d="M19.323 18.1157L15.6999 14.4925L19.323 10.8694C19.4832 10.7092 19.5732 10.492 19.5732 10.2655C19.5732 10.039 19.4832 9.82181 19.323 9.66166C19.1629 9.50151 18.9457 9.41154 18.7192 9.41154C18.4927 9.41154 18.2755 9.50151 18.1153 9.66166L14.4922 13.2848L10.869 9.66166C10.7089 9.50151 10.4917 9.41154 10.2652 9.41154C10.0387 9.41154 9.82149 9.50151 9.66134 9.66166C9.50118 9.82181 9.41121 10.039 9.41121 10.2655C9.41121 10.492 9.50118 10.7092 9.66134 10.8694L13.2845 14.4925L9.66134 18.1157C9.50118 18.2758 9.41121 18.493 9.41121 18.7195C9.41121 18.946 9.50118 19.1632 9.66134 19.3234C9.82149 19.4835 10.0387 19.5735 10.2652 19.5735C10.4917 19.5735 10.7089 19.4835 10.869 19.3234L14.4922 15.7002L18.1153 19.3234C18.2755 19.4835 18.4927 19.5735 18.7192 19.5735C18.9457 19.5735 19.1629 19.4835 19.323 19.3234C19.4832 19.1632 19.5732 18.946 19.5732 18.7195C19.5732 18.493 19.4832 18.2758 19.323 18.1157Z"
                                              fill="grey" />
                                          </svg>
                                        </a>

                                        <div class="card-body p-3">
                                          <h5 class="card-title mb-1">
                                            <?= $equip['equipName'] ?> (Qty: <?= $selEquip['equipmentQTY'] ?>)
                                          </h5>
                                          <span class="text-muted"><?= $catName ?></span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- Card end -->
                            <?php
                                }
                              }
                            } else {
                              echo '<p class="text-muted">No Equipment Selected Yet</p>';
                            }
                            ?>

                          </div>
                        </div>
                      </div>
                      <!-- end -->

                      <!-- second section end  -->

                      <div class="row justify-content-center mt-3">
                        <div class="col-sm-1">
                          <div class="d-flex">
                            <button
                              type="button"
                              onclick="return gotostep3()"
                              class="btn btn-primary btn-clash">
                              Next
                            </button>
                          </div>
                        </div>
                      </div>
                    </form>
                    <!-- </div>
                    </div> -->
                  </div>
                </div>
              </div>
              <!-- inner card 2nd end here-->
            </div>
          </div>
          <div class="multi_tab_content" id="third-box">
            <div class="card">
              <div class="card-body">
                <!-- inner card 3nd start here-->
                <div class="row">
                  <div class="col-xl-12 mx-auto">
                    <!-- <div class="card">
                    <div class="card-body"> -->
                    <div class="border p-3 rounded">
                      <h6 class="mb-0 text">Assign Equipment (Optional)</h6>
                      <hr />
                      <form class="row g-3">
                        <div class="col-12">
                          <div class="d-flex align-items-center gap-20 mb-3">
                            <label class="form-label mb-0">Select Employee <span data-bs-toggle="tooltip" title="Select the employee who will be responsible for the assigned equipment.">ⓘ</span></label>
                          </div>
                          <select
                            name="AssignWorkforce"
                            id="AssignWorkforce"
                            class="form-control">
                            <option value="">Select Employee</option>
                            <?php
                            if (isset($selectedworkforce) && !empty($selectedworkforce)) {
                              foreach ($selectedworkforce as $sel) {
                                $getskill = $this->generic->GetWorkforcewithSkill(array(), array('w.workforceID' => $sel['workforceID']));
                                $skills = '';
                                if ($getskill) {

                                  foreach ($getskill as $sk) {
                                    $skills .= $sk['skillNames'];
                                  }
                                }
                            ?>
                                <option value="<?= $sel['workforceID'] ?>"><?= $sel['personName'] ?> (Skills: <?= $skills ?>)</option>
                            <?php
                              }
                            } else {
                              echo '<option value="">No Employee Added Yet</option>';
                            }
                            ?>
                          </select>
                        </div>
                        <div class="col-6">
                          <div class="d-flex align-items-center gap-20 mb-3">
                            <label class="form-label mb-0">Select Equipment <span data-bs-toggle="tooltip" title="Select the equipment you want to assign to the selected employee.">ⓘ</span></label>
                          </div>
                          <select
                            name="AssignEquipment"
                            id="AssignEquipment"
                            class="form-control">
                            <option value="">Select Equipment</option>
                            <?php
                            if (isset($selectedEquipment) && !empty($selectedEquipment)) {
                              foreach ($selectedEquipment as $selEquip) {
                                $equipDetails = $this->generic->GetData('equipment', array('equipmentID' => $selEquip['equipmentID']));
                                $equip = $equipDetails[0];
                                if ($selEquip['equipmentQTY'] - $selEquip['TotalAssignQTY'] > 0) {
                            ?>
                                  <option value="<?= $equip['equipmentID'] ?>" data-available-assign-qty="<?= $selEquip['equipmentQTY'] - $selEquip['TotalAssignQTY'] ?>"><?= $equip['equipName'] ?> (QTY for Project: <?= $selEquip['equipmentQTY'] - $selEquip['TotalAssignQTY'] ?>)</option>
                            <?php
                                }
                              }
                            } else {
                              echo '<option value="">No Equipment Added Yet</option>';
                            }
                            ?>
                          </select>

                        </div>

                        <div class="col-6">
                          <div class="d-flex align-items-center gap-20 mb-3">
                            <label class="form-label mb-0">Assigning Quantity <span data-bs-toggle="tooltip" title="Enter only the number of units to assign. Don't enter text. Examples: 1, 2, 5">ⓘ</span></label>
                          </div>
                          <input type="number" name="assqty" id="assqty" class="form-control" placeholder="Enter Quantity to assign" />
                        </div>
                        <div class="col-12 text-center mt-3">
                          <div
                            class="d-flex flex-column flex-md-row justify-content-center gap-2">
                            <button
                              type="button"
                              onclick="return assignEquipmentAjax()"
                              class="btn btn-primary btn-clash">
                              Assign
                            </button>
                            <?php
                            if (isset($_GET['id'])) {
                            ?>
                              <a
                                href="<?= base_url('mark-project-as-inprogress?id=' . $_GET['id']) ?>"
                                class="btn btn-primary btn-clash-outline">
                                Submit Project
                              </a>
                            <?php
                            }
                            ?>
                          </div>
                        </div>
                      </form>
                      <!-- </div>
                    </div> -->
                    </div>
                  </div>
                </div>
                <!-- inner card 3nd end here-->
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <h5 class="mb-0">Equipment and Employees</h5>
                <div class="table-responsive mt-3">
                  <table class="table align-middle">
                    <thead
                      class="table-secondary bg-sky-blue font-clash-green">
                      <tr>
                        <th>Sr.</th>
                        <th>Equipment</th>
                        <th>Assigned Quantity</th>
                        <th>Employee</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody id="assignEquipTbody">
                      <?php
                      if (isset($assignedEquipments) && !empty($assignedEquipments)) {
                        $sr = 0;
                        foreach ($assignedEquipments as $assign) {
                          $sr++;
                      ?>
                          <tr>
                            <td><?= $sr . '.' ?></td>
                            <td>
                              <div class="employee">
                                <img
                                  src="<?= base_url() ?>assets/uploads/equipment/<?= $assign['equipImg'] ?>"
                                  alt="client" />
                                <span><?= $assign['equipName'] ?></span>
                              </div>

                            </td>
                            <td><?= $assign['assignedQty'] ?></td>
                            <td>
                              <div class="employee">
                                <img
                                  src="<?= base_url() ?>assets/uploads/workforce/<?= $assign['personImg'] ?>"
                                  alt="client" />
                                <span><?= $assign['personName'] ?></span>
                              </div>
                            </td>
                            <td>
                              <div
                                class="table-actions d-flex align-items-center gap-3 fs-6">

                                <a
                                  href="javascript:;"
                                  onclick="confirm('Are you sure you want to delete this assignment?') ? deleteAssignedEquipment(<?= $assign['assignID'] ?>) : false"
                                  class="text-danger"
                                  data-bs-toggle="tooltip"
                                  data-bs-placement="bottom"
                                  title="Delete"><i class="bi bi-trash-fill"></i></a>
                              </div>
                            </td>
                          </tr>
                      <?php
                        }
                      } else {
                        echo '<tr><td colspan="5" class="text-center text-muted">No Equipment Assigned Yet</td></tr>';
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
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

    <!-- popup end -->

    <!--start overlay-->
    <div class="overlay nav-toggle-icon"></div>
    <!--end overlay-->

    <!--Start Back To Top Button-->
    <a href="javaScript:;" class="back-to-top"><i class="bx bxs-up-arrow-alt"></i></a>
    <!--End Back To Top Button-->
  </div>
  <!--end wrapper-->

  <!--plugins-->
  <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
  <!-- Bootstrap bundle JS (Popper included) -->
  <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
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
    (function() {
      function initTooltips() {
        if (typeof bootstrap === 'undefined' || !bootstrap.Tooltip) {
          console.warn('Bootstrap Tooltip not available');
          return;
        }

        var triggers = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));

        // Dispose any existing instances
        triggers.forEach(function(el) {
          var existing = bootstrap.Tooltip.getInstance(el);
          if (existing) existing.dispose();
        });

        // Create fresh tooltips
        triggers.forEach(function(el) {
          new bootstrap.Tooltip(el, {
            trigger: 'hover focus',
            placement: 'top',
            fallbackPlacements: [],
            container: 'body',
            delay: { show: 100, hide: 50 }
          });
        });
      }

      // On full page load to ensure all elements exist
      window.addEventListener('load', function() {
        setTimeout(initTooltips, 150);
      });

      // Re-run after tab/step interactions
      document.addEventListener('click', function(e) {
        if (e.target.closest('[id^="step-"]') || e.target.closest('.tab-btn')) {
          setTimeout(initTooltips, 100);
        }
      });

      // Observe DOM changes inside the tabs container (for dynamic content)
      var tabsContainer = document.getElementById('multiTabsBtnsContentSection');
      if (tabsContainer && 'MutationObserver' in window) {
        var observer = new MutationObserver(function() {
          setTimeout(initTooltips, 50);
        });
        observer.observe(tabsContainer, { childList: true, subtree: true, attributes: true });
      }
    })();
  </script>
  <!-- date selection  -->
  <script>
    $(document).ready(function() {
      // Disable the end date input by default
      

      // Listen for changes in the start date input
      $('#pStartDate').on('change', function() {
        const startDate = $(this).val(); // Get the selected start date

        if (startDate) {
          // Enable the end date input
          $('#pEndDate').prop('disabled', false);

          // Set the min attribute of the end date to the selected start date
          $('#pEndDate').attr('min', startDate);
        } else {
          // If no start date is selected, disable the end date input
          $('#pEndDate').prop('disabled', true);
          $('#pEndDate').removeAttr('min'); // Remove the min attribute
        }
      });
    });
  </script>
  <?php
  if ($this->session->flashdata('successaddedd') != '') {
  ?>
    <script type="text/javascript">
      toastr.options = {
        "closeButton": true,
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }
      toastr.success('Project In Progress!');
    </script>
  <?php
  }
  ?>
  <!-- setup qty field based on equipment selection -->
  <script>
    $(document).ready(function() {

      // Handle the onchange event for the equipment dropdown
      $('#equipment').on('change', function() {
        // Get the selected option
        const selectedOption = $(this).find(':selected');
        const availableQty = selectedOption.data('available-qty'); // Get the available quantity from the data attribute

        if (availableQty !== undefined) {
          // Set the placeholder for the qty input field
          $('#qty').attr('placeholder', `Enter quantity (0 - ${availableQty})`);

          // Set the min and max attributes for the qty input field
          $('#qty').attr('min', 0);
          $('#qty').attr('max', availableQty);
        } else {
          // Reset the qty input field if no valid option is selected
          $('#qty').attr('placeholder', 'Select equipment first');
          $('#qty').removeAttr('min');
          $('#qty').removeAttr('max');
        }
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      // Handle the onchange event for the AssignEquipment dropdown
      $('#AssignEquipment').on('change', function() {
        // Get the selected option
        const selectedOption = $(this).find(':selected');
        const availableQty = selectedOption.data('available-assign-qty'); // Get the available quantity from the data attribute

        if (availableQty !== undefined) {
          // Set the placeholder for the assqty input field
          $('#assqty').attr('placeholder', `Enter quantity (0 - ${availableQty})`);

          // Set the min and max attributes for the assqty input field
          $('#assqty').attr('min', 0);
          $('#assqty').attr('max', availableQty);
        } else {
          // Reset the assqty input field if no valid option is selected
          $('#assqty').attr('placeholder', 'Select equipment first');
          $('#assqty').removeAttr('min');
          $('#assqty').removeAttr('max');
        }
      });
    });
  </script>
  <?php
  if (!isset($_GET['step'])) {
    if (isset($_GET['id'])) {
      if ($projectData[0]['pDraftStatus'] == 2) {
  ?>
        <script>
          $(document).ready(function() {
            $("#step-3").prop("disabled", true);
            $("#first-box").removeClass("active");
            $("#second-box").addClass("active");
            $("#step2div").addClass("active_tab");
            $("#step1div").removeClass("active_tab");
          });
        </script>

      <?php
      } else if ($projectData[0]['pDraftStatus'] == 3) {
      ?>
        <script>
          $(document).ready(function() {
            $("#first-box").removeClass("active");
            $("#second-box").removeClass("active");
            $("#third-box").addClass("active");
            $("#step-3").prop("disabled", false);
            $("#step3div").addClass("active_tab");
          });
        </script>
      <?php
      }
    } else {
      ?>
      <script>
        $(document).ready(function() {
          $("#step-2").prop("disabled", true);
          $("#step-3").prop("disabled", true);
        });
      </script>
  <?php
    }
  }
  ?>


  <!-- first step ajax call  -->
  <script>
    $(document).ready(function() {
      $("#firstForm").on("submit", function(e) {
        e.preventDefault();
        // alert('ok');
        document.getElementById("loader").style.display = "flex";
        var form = this;
        // Get the current URL and check for the `id` parameter
        let currentUrl = new URL(window.location.href);
        let id = currentUrl.searchParams.get("id"); // Get the `id` parameter if it exists

        // Build the AJAX URL
        let ajaxUrl = "<?= base_url('add-project-general-data') ?>";
        if (id) {
          ajaxUrl += "?id=" + id; // Append `id` if it exists
        }
        $.ajax({
          url: ajaxUrl,
          type: "POST",
          data: new FormData(form),
          processData: false,
          contentType: false,
          cache: false,
          success: function(response) {
            // alert(response);
            if (response) {
              if (response == "data missing") {
                toastr.options = {
                  "closeButton": true,
                  "showMethod": "fadeIn",
                  "hideMethod": "fadeOut"
                }
                toastr.error('Please fill all Required Fields!');

              }
              // explode by array //
              response = response.split("//");

              if (response[0] == "Projectadded") {

                toastr.options = {
                  "closeButton": true,
                  "showMethod": "fadeIn",
                  "hideMethod": "fadeOut"
                }
                toastr.success('Project Added Successfully!');
              } else if (response[0] == "Projectupdated") {
                toastr.options = {
                  "closeButton": true,
                  "showMethod": "fadeIn",
                  "hideMethod": "fadeOut"
                }
                toastr.success('Project Updated!');
              }
              document.getElementById("loader").style.display = "none";
              //remove disable attribute from second tab
              $("#step-2").prop("disabled", false);
              //remove active_tab from first tab
              $("#step1div").removeClass("active_tab");
              //add active_tab to second tab
              $("#step2div").addClass("active_tab");
              //remove show active from first box
              $("#first-box").removeClass("active");
              //add active class to second box
              $("#second-box").addClass("active");
              //update workforce
              $('#workforce').html(response[2]);
              $('#equipment').html(response[3]);
              //add parementer to url
              var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?id=' + response[1];
              window.history.pushState({
                path: newurl
              }, '', newurl);
            } else {
              toastr.error("Something Went Wrong");
            }

          },
        });
      });
    });
  </script>

  <!-- second step ajax call -->
  <script>
    function step2ajax() {
      // alert('ok');
      var workforceID = $('#workforce').val();
      if (workforceID == '') {
        toastr.error('Please select workforce!');
        return false;
      }
      // document.getElementById("loader").style.display = "flex";
      // Get the current URL and check for the `id` parameter
      let currentUrl = new URL(window.location.href);
      let id = currentUrl.searchParams.get("id"); // Get the `id` parameter if it exists

      // Build the AJAX URL
      let ajaxUrl = "<?= base_url('add-project-workforce') ?>";
      if (id) {
        ajaxUrl += "?id=" + id; // Append `id` if it exists
      }
      $.ajax({
        url: ajaxUrl,
        type: "POST",
        data: {
          workforceID: workforceID,
          '<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>'
        },
        success: function(response) {
          // alert(response);
          if (response) {

            toastr.options = {
              "closeButton": true,
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }
            toastr.success('Workforce Added Successfully!');
            response = response.split("///");
            $('#workforce').html(response[1]);
            $('#workcardsContainer').html('');
            console.log(response[2]);
            $('#workcardsContainer').html(response[2]);

          } else {
            toastr.error("Something Went Wrong, Try Again!");
          }



        },
      });
    }
  </script>
  <!-- remove workforce ajax -->
  <script>
    function removeworkforce(workforceID) {
      // alert(workforceID);
      if (workforceID == '') {
        toastr.error('Invalid Workforce!');
        return false;
      }
      // document.getElementById("loader").style.display = "flex";
      // Get the current URL and check for the `id` parameter
      let currentUrl = new URL(window.location.href);
      let id = currentUrl.searchParams.get("id"); // Get the `id` parameter if it exists

      // Build the AJAX URL
      let ajaxUrl = "<?= base_url('remove-project-workforce') ?>";
      if (id) {
        ajaxUrl += "?id=" + id; // Append `id` if it exists
      }
      $.ajax({
        url: ajaxUrl,
        type: "POST",
        data: {
          workforceID: workforceID,
          '<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>'
        },
        success: function(response) {
          // alert(response);
          if (response) {
            if (response == 'Invalid Request!') {
              toastr.error("Something Went Wrong, Try Again!");
              return false;
            }

            toastr.options = {
              "closeButton": true,
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }
            toastr.success('Workforce Removed Successfully!');
            response = response.split("///");
            $('#workforce').html(response[1]);
            $('#workcardsContainer').html('');
            $('#workcardsContainer').html(response[2]);

          } else {
            toastr.error("Something Went Wrong, Try Again!");
          }
        },
      });
    }
  </script>
  <!-- add eqipment ajax -->
  <script>
    function addequipmentAjax() {
      // alert('ok');
      var equipmentID = $('#equipment').val();
      var qty = $('#qty').val();
      if (equipmentID == '') {
        toastr.error('Please select equipment!');
        return false;
      }
      //validate qty on max min
      var min = parseInt($('#qty').attr('min'));
      var max = parseInt($('#qty').attr('max'));
      if (qty == '') {
        toastr.error('Please enter quantity!');
        return false;
      } else if (isNaN(qty) || qty < min || qty > max) {
        toastr.error('Please enter a valid quantity between ' + min + ' and ' + max + '!');
        return false;
      }
      // document.getElementById("loader").style.display = "flex";
      // Get the current URL and check for the `id` parameter
      let currentUrl = new URL(window.location.href);
      let id = currentUrl.searchParams.get("id"); // Get the `id` parameter if it exists

      // Build the AJAX URL
      let ajaxUrl = "<?= base_url('add-project-equipment') ?>";
      if (id) {
        ajaxUrl += "?id=" + id; // Append `id` if it exists
      }
      $.ajax({
        url: ajaxUrl,
        type: "POST",
        data: {
          equipmentID: equipmentID,
          qty: qty,
          '<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>'
        },
        success: function(response) {
          console.log(response);
          if (response == 'Invalid Request!') {
            toastr.error("Something Went Wrong, Try Again!");
            return false;
          } else {

            response = response.split("///");
            if (response[0] == 'EquipmentUpdated') {
              toastr.success("Equipment Already Added, Quantity Updated!");
            } else {
              toastr.success('Equipment Added Successfully!');
            }
            $('#equipment').html(response[1]);
            $('#qty').val('');
            $('#qty').attr('placeholder', 'Select equipment first');
            $('#equipcardsContainer').html('');
            $('#equipcardsContainer').html(response[2]);
          }


        },
      });
    }
    //remove equipment ajax
    function removeequipment(equipmentID) {
      // alert(equipCatID);
      if (equipmentID == '') {
        toastr.error('Invalid Equipment!');
        return false;
      }
      // document.getElementById("loader").style.display = "flex";
      // Get the current URL and check for the `id` parameter
      let currentUrl = new URL(window.location.href);
      let id = currentUrl.searchParams.get("id"); // Get the `id` parameter if it exists

      // Build the AJAX URL
      let ajaxUrl = "<?= base_url('remove-project-equipment') ?>";
      if (id) {
        ajaxUrl += "?id=" + id; // Append `id` if it exists
      }
      $.ajax({
        url: ajaxUrl,
        type: "POST",
        data: {
          equipmentID: equipmentID,
          '<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>'
        },
        success: function(response) {
          if (response) {
            if (response == 'Invalid Request!') {
              toastr.error("Something Went Wrong, Try Again!");
              return false;
            }

            toastr.options = {
              "closeButton": true,
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }
            toastr.success('Equipment Removed Successfully!');
            response = response.split("///");
            $('#equipment').html(response[1]);
            $('#equipcardsContainer').html('');
            $('#equipcardsContainer').html(response[2]);

          } else {
            toastr.error("Something Went Wrong, Try Again!");
          }
        },
      });
    }
  </script>
  <!-- move to step 3 ajax  -->
  <script>
    function gotostep3() {
      // document.getElementById("loader").style.display = "flex";
      // Get the current URL and check for the `id` parameter
      let currentUrl = new URL(window.location.href);
      let id = currentUrl.searchParams.get("id"); // Get the `id` parameter if it exists

      // Build the AJAX URL
      let ajaxUrl = "<?= base_url('move-to-step3') ?>";
      if (id) {
        ajaxUrl += "?id=" + id; // Append `id` if it exists
      }
      $.ajax({
        url: ajaxUrl,
        type: "POST",
        data: {
          '<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>'
        },
        success: function(response) {
          if (response) {
            if (response == 'Invalid Request!') {
              toastr.error("Something Went Wrong, Try Again!");
              return false;
            }
            response = response.split("///");
            $('#AssignEquipment').html(response[2]);
            $('#AssignWorkforce').html(response[1]);
            toastr.options = {
              "closeButton": true,
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }
            toastr.success('Moved to Step 3 Successfully!');

            //remove disable attribute from second tab
            $("#step-3").prop("disabled", false);
            //remove active_tab from first tab
            $("#step2div").removeClass("active_tab");
            //add active_tab to second tab
            $("#step3div").addClass("active_tab");
            //remove show active from first box
            $("#second-box").removeClass("active");
            //add active class to second box
            $("#third-box").addClass("active");

          } else {
            toastr.error("Something Went Wrong, Try Again!");
          }
        },
      });
    }
  </script>
  <!-- step 3 assign equipment ajax  -->
  <script>
    function assignEquipmentAjax() {
      // alert('ok');
      var workforceID = $('#AssignWorkforce').val();
      var equipmentID = $('#AssignEquipment').val();
      var assqty = $('#assqty').val();
      if (workforceID == '') {
        toastr.error('Please select employee!');
        return false;
      }
      if (equipmentID == '') {
        toastr.error('Please select equipment!');
        return false;
      }
      if (assqty == '') {
        toastr.error('Please enter assigning quantity!');
        return false;
      }
      //validate qty on max min
      var min = parseInt($('#assqty').attr('min'));
      var max = parseInt($('#assqty').attr('max'));
      if (isNaN(assqty) || assqty < min || assqty > max) {
        toastr.error('Please enter a valid quantity between ' + min + ' and ' + max + '!');
        return false;
      }
      // document.getElementById("loader").style.display = "flex";
      // Get the current URL and check for the `id` parameter
      let currentUrl = new URL(window.location.href);
      let id = currentUrl.searchParams.get("id"); // Get the `id` parameter if it exists
      // Build the AJAX URL
      let ajaxUrl = "<?= base_url('assign-equipment-employee') ?>";
      if (id) {
        ajaxUrl += "?id=" + id; // Append `id` if it exists
      }
      $.ajax({
        url: ajaxUrl,
        type: "POST",
        data: {
          workforceID: workforceID,
          equipmentID: equipmentID,
          assqty: assqty,
          '<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>'
        },
        success: function(response) {
          if (response) {
            if (response == 'Invalid Request!') {
              toastr.error("Something Went Wrong, Try Again!");
              return false;
            } else if (response == 'Quantity Exceeded!') {
              toastr.error("Assigning Quantity Exceeded, Try Again!");
              return false;
            }
            response = response.split("///");
            if (response[0] == 'EquipmentAssignmentUpdated') {
              toastr.success("Equipment Already Assigned to Employee, Quantity Updated!");
            } else {
              toastr.success('Equipment Assigned to Employee Successfully!');
            }


            $('#assignEquipTbody').html('');
            $('#assignEquipTbody').html(response[1]);
            $('#AssignEquipment').html(response[2]);
            $('#assqty').val('');
            $('#assqty').attr('placeholder', 'Select equipment first');
            //set select employee to default
            $('#AssignWorkforce').val('');

          } else {
            toastr.error("Something Went Wrong, Try Again!");
          }
        },
      });
    }
  </script>
  <!-- remove assigned equipment ajax -->
  <script>
    function deleteAssignedEquipment(assignID) {
      // alert(assignID);
      if (assignID == '') {
        toastr.error('Invalid Assignment!');
        return false;
      }
      // document.getElementById("loader").style.display = "flex";
      // Get the current URL and check for the `id` parameter
      let currentUrl = new URL(window.location.href);
      let id = currentUrl.searchParams.get("id"); // Get the `id` parameter if it exists
      // Build the AJAX URL
      let ajaxUrl = "<?= base_url('remove-assigned-equipment') ?>";
      if (id) {
        ajaxUrl += "?id=" + id; // Append `id` if it exists
      }
      $.ajax({
        url: ajaxUrl,
        type: "POST",
        data: {
          assignID: assignID,
          '<?= $this->security->get_csrf_token_name() ?>': '<?= $this->security->get_csrf_hash() ?>'
        },
        success: function(response) {
          if (response) {
            if (response == 'Invalid Request!') {
              toastr.error("Something Went Wrong, Try Again!");
              return false;
            }
            toastr.options = {
              "closeButton": true,
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }
            toastr.success('Assignment Removed Successfully!');
            response = response.split("///");
            $('#assignEquipTbody').html('');
            $('#assignEquipTbody').html(response[1]);
            $('#AssignEquipment').html(response[2]);
            //set select employee to default
            $('#AssignWorkforce').val('');
            $('#assqty').val('');
            $('#assqty').attr('placeholder', 'Select equipment first');
          } else {
            toastr.error("Something Went Wrong, Try Again!");
          }
        },
      });
    }
  </script>
</body>

</html>