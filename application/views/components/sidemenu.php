  <?php
    if ($this->session->userdata('loginData')['userType'] == 1) {
    ?>

      <!--start sidebar -->
      <aside class="sidebar-wrapper" data-simplebar="true">
          <div class="sidebar-header">
              <div>
                  <img
                      src="<?= base_url() ?>assets/images/logo-icon.png"
                      class="logo-icon"
                      alt="logo icon" />
              </div>
              <div>
                  <h4 class="logo-text" style="color: black">Equip Manager</h4>
              </div>
              <div class="toggle-icon ms-auto">
                  <i class="bi bi-chevron-double-left" style="color: black"></i>
              </div>
          </div>
          <!--navigation-->
          <ul class="metismenu" id="menu">
              <li>
                  <a href="<?= base_url('admin-dashboard') ?>">
                      <div class="parent-icon"><i class="bi bi-house-door"></i></div>
                      <div class="menu-title font-clash">Dashboard</div>
                  </a>
              </li>
              <!-- manage Blog -->
              <li>
                  <a class="has-arrow" href="javascript:;">
                      <div class="parent-icon">
                          <i class="bi bi-card-heading"></i>
                      </div>
                      <div class="menu-title font-clash">Manage Blog</div>
                  </a>
                  <ul>

                      <li>
                          <a href="<?= base_url('manage-super-blog') ?>"><i class="bi bi-arrow-right-short"></i>Add Blog</a>
                      </li>
                      <li>
                          <a href="<?= base_url('manage-blog-category') ?>"><i class="bi bi-arrow-right-short"></i>Manage Blog Category</a>
                      </li>
                      <li>
                          <a href="<?= base_url('show-super-blog') ?>"><i class="bi bi-arrow-right-short"></i>Manage Blog</a>
                      </li>
                  </ul>
              </li>
              <!-- mannage  Blog end here-->
              <li>
                  <a href="javascript:;" class="has-arrow">
                      <div class="parent-icon"><i class="bi bi-bookmark"></i></div>
                      <div class="menu-title font-clash">Marketplace Categories</div>
                  </a>
                  <ul>
                      <li>
                          <a href="<?= base_url('manage-super-category') ?>"><i class="bi bi-arrow-right-short"></i>Add Category</a>
                      </li>
                      <li>
                          <a href="<?= base_url('show-super-category') ?>"><i class="bi bi-arrow-right-short"></i>Manage Category</a>
                      </li>
                  </ul>
              </li>
              <li>
                  <a href="<?= base_url('admin-marketplace-listing') ?>">
                      <div class="parent-icon">
                          <i class="bi bi-cart2"></i>
                      </div>
                      <div class="menu-title font-clash">Marketplace Listing</div>
                  </a>
                  <!-- <ul>

                      <li>
                          <a href="<?= base_url('add-listing') ?>"><i class="bi bi-arrow-right-short"></i>Add Listing</a>
                      </li>
                      <li>
                          <a href="<?= base_url('all-listing') ?>"><i class="bi bi-arrow-right-short"></i>All Listing </a>
                      </li>
                  </ul> -->
              </li>

              <!-- All Orders -->
              <li>
                  <a href="<?= base_url('super-admin-orders') ?>">
                      <div class="parent-icon">
                          <i class="bi bi-receipt"></i>
                      </div>
                      <div class="menu-title font-clash">All Orders</div>
                  </a>
              </li>

              <li>
                  <a class="has-arrow" href="javascript:;">
                      <div class="parent-icon">
                          <i class="bi bi-globe2"></i>
                      </div>
                      <div class="menu-title font-clash">Manage Website</div>
                  </a>
                  <ul>

                      <li>
                          <a href="<?= base_url('manage-super-testimonial') ?>"><i class="bi bi-arrow-right-short"></i>Manage Testimonial</a>
                      </li>
                      <li>
                          <a href="<?= base_url('manage-success') ?>"><i class="bi bi-arrow-right-short"></i>Manage Metrics </a>
                      </li>
                      <li>
                          <a href="<?= base_url('manage-company') ?>"><i class="bi bi-arrow-right-short"></i>Manage Company Partners </a>
                      </li>
                  </ul>
              </li>
              <li>
                  <a class="has-arrow" href="javascript:;">
                      <div class="parent-icon">
                          <i class="bi bi-headset"></i>
                      </div>
                      <div class="menu-title font-clash">Support</div>
                  </a>
                  <ul>

                      <li>
                          <a href="<?= base_url('ticket-category') ?>"><i class="bi bi-arrow-right-short"></i>Manage Ticket Categories</a>
                      </li>
                      <li>
                          <a href="<?= base_url('all-tickets') ?>"><i class="bi bi-arrow-right-short"></i>All Tickets </a>
                      </li>
                      <li>
                          <a href="<?= base_url('contact-form') ?>"><i class="bi bi-arrow-right-short"></i>Contact Form </a>
                      </li>
                  </ul>
              </li>
              <!-- System Settings -->
              <li>
                  <a href="<?= base_url('manage-system-settings') ?>">
                      <div class="parent-icon"><i class="bi bi-sliders"></i></div>
                      <div class="menu-title font-clash">System Settings</div>
                  </a>
              </li>
              <!-- mannage  Company Partners end here-->
          </ul>
          <!--end navigation-->
      </aside>
      <!--end sidebar -->
  <?php
    } else {
    ?>
      <!--start sidebar -->
      <aside class="sidebar-wrapper" data-simplebar="true">
          <div class="sidebar-header">
              <div>
                  <img
                      src="<?= base_url() ?>assets/images/logo-icon.png"
                      class="logo-icon"
                      alt="logo icon" />
              </div>
              <div>
                  <h4 class="logo-text" style="color: black">Equip Manager</h4>
              </div>
              <div class="toggle-icon ms-auto">
                  <i class="bi bi-chevron-double-left" style="color: black"></i>
              </div>
          </div>
          <!--navigation-->
          <ul class="metismenu" id="menu">
              <li>
                  <?php
                    //   dashboard for company vendor 
                    if ($this->session->userdata('loginData')['userType'] == 2) {
                    ?>
                      <a href="<?= base_url('company-dashboard') ?>">
                          <div class="parent-icon"><i class="bi bi-house-door"></i></div>
                          <div class="menu-title font-clash">Dashboard</div>
                      </a>
                  <?php
                    } else if ($this->session->userdata('loginData')['userType'] == 3) {
                    ?>
                      <a href="<?= base_url('manager-dashboard') ?>">
                          <div class="parent-icon"><i class="bi bi-house-door"></i></div>
                          <div class="menu-title font-clash">Dashboard</div>
                      </a>
                  <?php
                    }
                    ?>
              </li>
              <?php
                // Only show company/manager management menus for userType 2 and 3, not for regular users (type 4)
                if ($this->session->userdata('loginData')['userType'] != 4) {
                ?>
                  <li>
                      <a href="javascript:;" class="has-arrow">
                          <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
                          <div class="menu-title font-clash">Manage Workforce</div>
                      </a>
                      <ul>
                          <li>
                              <a href="<?= base_url('add-workforce') ?>"><i class="bi bi-arrow-right-short"></i>Add workforce</a>
                          </li>
                          <li>
                              <a href="<?= base_url('all-workforce') ?>"><i class="bi bi-arrow-right-short"></i>All Workforce</a>
                          </li>
                          <li>
                              <a href="<?= base_url('manage-workforce-skill') ?>"><i class="bi bi-arrow-right-short"></i>Manage Skills</a>
                          </li>
                      </ul>
                  </li>

                  <!-- manage Equipment -->
                  <li>
                      <a class="has-arrow" href="javascript:;">
                          <div class="parent-icon">
                              <i class="bi bi-tools"></i>
                          </div>
                          <div class="menu-title font-clash">Manage Equipment</div>
                      </a>
                      <ul>

                          <li>
                              <a href="<?= base_url('add-equipment') ?>"><i class="bi bi-arrow-right-short"></i>Add Equipment</a>
                          </li>
                          <li>
                              <a href="<?= base_url('all-equipment') ?>"><i class="bi bi-arrow-right-short"></i>All Equipment </a>
                          </li>
                          <li>
                              <a href="<?= base_url('manage-category') ?>"><i class="bi bi-arrow-right-short"></i>Manage Category</a>
                          </li>
                      </ul>
                  </li>
                  <!-- mannage  Equipment end here-->
                  <!-- manage Project -->
                  <li>
                      <a class="has-arrow" href="javascript:;">
                          <div class="parent-icon">
                              <i class="bx bx-window-alt"></i>
                          </div>
                          <div class="menu-title font-clash">Manage Projects</div>
                      </a>
                      <ul>

                          <li>
                              <a href="<?= base_url('add-project') ?>"><i class="bi bi-arrow-right-short"></i>Add Project</a>
                          </li>
                          <li>
                              <a href="<?= base_url('all-projects') ?>"><i class="bi bi-arrow-right-short"></i>All Projects </a>
                          </li>
                          <li>
                              <a href="<?= base_url('project-category') ?>"><i class="bi bi-arrow-right-short"></i>Project Category</a>
                          </li>
                      </ul>
                  </li>
                  <li>
                      <a class="has-arrow" href="javascript:;">
                          <div class="parent-icon">
                              <i class="bi bi-cart2"></i>
                          </div>
                          <div class="menu-title font-clash">Marketplace</div>
                      </a>
                      <ul>

                          <li>
                              <a href="<?= base_url('add-listing') ?>"><i class="bi bi-arrow-right-short"></i>Add Listing</a>
                          </li>
                          <li>
                              <a href="<?= base_url('all-listing') ?>"><i class="bi bi-arrow-right-short"></i>All Listing </a>
                          </li>
                          <?php if ($this->session->userdata('loginData')['userType'] == 2) { ?>
                          <li>
                              <a href="<?= base_url('company-orders') ?>"><i class="bi bi-arrow-right-short"></i>Orders</a>
                          </li>
                          <?php } ?>
                      </ul>
                  </li>
                  <!-- mannage  Equipment end here-->
              <?php
                }
                ?>
              <!-- My Chats menu -->
              <li>
                  <a href="<?= base_url('chats') ?>">
                      <div class="parent-icon"><i class="bi bi-chat-dots"></i></div>
                      <div class="menu-title font-clash">My Chats</div>
                  </a>
              </li>
              <!-- support menu  -->
              <li>
                  <a class="has-arrow" href="javascript:;">
                      <div class="parent-icon">
                          <i class="bi bi-headset"></i>
                      </div>
                      <div class="menu-title font-clash">Support</div>
                  </a>
                  <ul>

                      <li>
                          <a href="<?= base_url('add-new-ticket') ?>"><i class="bi bi-arrow-right-short"></i>Add New Ticket</a>
                      </li>
                      <li>
                          <a href="<?= base_url('all-tickets') ?>"><i class="bi bi-arrow-right-short"></i>All Tickets </a>
                      </li>
                  </ul>
              </li>
          </ul>
          <!--end navigation-->
      </aside>
      <!--end sidebar -->
  <?php
    }
    ?>