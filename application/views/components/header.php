   <style>
     .bg-dark-green img {
       background-color: #0b2523 !important;
       border-radius: 10px;
     }

     .maintinance-toggle {
       position: relative;
       width: 50px;
       height: 25px;
       margin: 20px;
       -webkit-user-select: none;
       -moz-user-select: none;
       -ms-user-select: none;
       user-select: none;
     }

     .maintinance-toggle label {
       position: absolute;
       top: 0;
       left: 0;
       width: 50px;
       height: 25px;
       border-radius: 50px;
       background: linear-gradient(to bottom, #b3b3b3, #e6e6e6);
       cursor: pointer;
       transition: all 0.3s ease;
     }

     .maintinance-toggle label:after {
       content: '';
       position: absolute;
       top: 1px;
       left: 1px;
       width: 23px;
       height: 23px;
       border-radius: 50%;
       background-color: #fff;
       box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
       transition: all 0.3s ease;
     }

     .maintinance-toggle input[type="checkbox"]:checked+label {
       background: linear-gradient(to bottom, #4cd964, #5de24e);
     }

     .maintinance-toggle input[type="checkbox"]:checked+label:after {
       transform: translateX(25px);
     }

     .maintinance-toggle label:hover {
       background: linear-gradient(to bottom, #b3b3b3, #e6e6e6);
     }

     .maintinance-toggle label:hover:after {
       box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
     }

     .yep {
       position: absolute;
       top: 0;
       left: 0;
       width: 50px;
       height: 25px;
     }
   </style>

   <!--start top header-->
   <header class="top-header">
     <nav class="navbar navbar-expand">
       <div class="mobile-toggle-icon d-xl-none">
         <i class="bi bi-list"></i>
       </div>
      
       <?php
        if ($this->session->userdata('loginData')['userType'] == 1) {
          $CI = &get_instance();
          $CI->load->model('Generic_model', 'generic'); // avoid repeated loads in many views
          $setting = $CI->generic->GetData('web_setting');
        ?>
         <strong>Website Mode</strong>
         <div>
           <a href="<?= base_url('change-website-mode') ?>?curentUrl=<?= uri_string()?>" >
             <div class="maintinance-toggle">
               <input class="yep" id="maintinance-toggle" type="checkbox" <?= ($setting[0]['websiteStatus'] == 1) ? 'checked' : '' ?> />
               <label for="maintinance-toggle"></label>
             </div>
           </a>
         </div>
         <?php 
          if($setting[0]['websiteStatus'] == 1){
         ?>
         <span style="color: green;">Website is Live</span>
         <?php 
          }else{
          ?>
         <span style="color: red;">Website is Offline</span>
         <?php 
          }
          ?>
       <?php
        }
        ?>
       <script>
         // Plain JS: delegate clicks on the toggle area and redirect to the enclosing anchor's href.
         document.addEventListener('click', function(e) {
           var wrapper = e.target.closest('.maintinance-toggle');
           if (!wrapper) return;
           var anchor = wrapper.closest('a');
           if (!anchor) return;
           e.preventDefault();
           // Use href (absolute or relative)
           var href = anchor.getAttribute('href');
           if (href) window.location.href = href;
         });
       </script>
       <div class="search-toggle-icon d-xl-none ms-auto">
         <i class="bi bi-search"></i>
       </div>
       <form class="searchbar d-none d-xl-flex ms-auto">
         <div
           class="position-absolute top-50 translate-middle-y search-icon ms-3">
           <i class="bi bi-search"></i>
         </div>
         <input
           class="form-control"
           type="text"
           placeholder="Type here to search" />
         <div
           class="position-absolute top-50 translate-middle-y d-block d-xl-none search-close-icon">
           <i class="bi bi-x-lg"></i>
         </div>
       </form>
       <div class="top-navbar-right ms-3">
         <ul class="navbar-nav align-items-center">
           <li class="nav-item dropdown dropdown-large">
             <a
               class="nav-link dropdown-toggle dropdown-toggle-nocaret"
               href="#"
               data-bs-toggle="dropdown">
               <div class="user-setting d-flex align-items-center gap-1">
                 <img
                   src="<?= base_url() ?>assets/images/avatars/avatar-1.png"
                   class="user-img"
                   alt="" />
                 <div class="user-name d-none d-sm-block"><?= $this->session->userdata('loginData')['userName'] ?></div>
               </div>
             </a>
             <ul class="dropdown-menu dropdown-menu-end">
               <li>
                 <a class="dropdown-item" href="#">
                   <div class="d-flex align-items-center">
                     <img
                       src="<?= base_url() ?>assets/images/avatars/avatar-1.png"
                       alt=""
                       class="rounded-circle"
                       width="60"
                       height="60" />
                     <div class="ms-3">
                       <h6 class="mb-0 dropdown-user-name"><?= $this->session->userdata('loginData')['userName'] ?></h6>
                       <small
                         class="mb-0 dropdown-user-designation text-secondary">
                         <?php
                          if ($this->session->userdata('loginData')['userType'] == 2) {
                            echo "Company Owner";
                          } else if ($this->session->userdata('loginData')['userType'] == 3) {
                            echo "Manager";
                          } else if ($this->session->userdata('loginData')['userType'] == 4) {
                            echo "User";
                          } else {
                            echo "Admin";
                          }
                          ?>
                       </small>
                     </div>
                   </div>
                 </a>
               </li>
               <li>
                 <hr class="dropdown-divider" />
               </li>
               <li>
                 <a class="dropdown-item" href="pages-user-profile.html">
                   <div class="d-flex align-items-center">
                     <div class="setting-icon">
                       <i class="bi bi-person-fill"></i>
                     </div>
                     <div class="setting-text ms-3">
                       <span>Profile</span>
                     </div>
                   </div>
                 </a>
               </li>
               <li>
                 <a class="dropdown-item" href="#">
                   <div class="d-flex align-items-center">
                     <div class="setting-icon">
                       <i class="bi bi-gear-fill"></i>
                     </div>
                     <div class="setting-text ms-3">
                       <span>Setting</span>
                     </div>
                   </div>
                 </a>
               </li>
               <li>
                 <a class="dropdown-item" href="index2.html">
                   <div class="d-flex align-items-center">
                     <div class="setting-icon">
                       <i class="bi bi-speedometer"></i>
                     </div>
                     <div class="setting-text ms-3">
                       <span>Dashboard</span>
                     </div>
                   </div>
                 </a>
               </li>
               <li>
                 <a class="dropdown-item" href="#">
                   <div class="d-flex align-items-center">
                     <div class="setting-icon">
                       <i class="bi bi-piggy-bank-fill"></i>
                     </div>
                     <div class="setting-text ms-3">
                       <span>Earnings</span>
                     </div>
                   </div>
                 </a>
               </li>
               <li>
                 <a class="dropdown-item" href="#">
                   <div class="d-flex align-items-center">
                     <div class="setting-icon">
                       <i class="bi bi-cloud-arrow-down-fill"></i>
                     </div>
                     <div class="setting-text ms-3">
                       <span>Downloads</span>
                     </div>
                   </div>
                 </a>
               </li>
               <li>
                 <hr class="dropdown-divider" />
               </li>
               <li>
                 <a
                   class="dropdown-item"
                   href="<?= base_url('login-data') ?>">
                   <div class="d-flex align-items-center">
                     <div class="setting-icon">
                       <i class="bi bi-lock-fill"></i>
                     </div>
                     <div class="setting-text ms-3"><span>Logout</span></div>
                   </div>
                 </a>
               </li>
             </ul>
           </li>

           <!-- <li class="nav-item dropdown dropdown-large d-none d-sm-block">
              <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                <div class="notifications">
                  <span class="notify-badge">8</span>
                  <i class="bi bi-bell-fill"></i>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end p-0">
                <div class="p-2 border-bottom m-2">
                    <h5 class="h5 mb-0">Notifications</h5>
                </div>
                <div class="header-notifications-list p-2">
                   <div class="dropdown-item bg-light radius-10 mb-1">
                    <form class="dropdown-searchbar position-relative">
                      <div class="position-absolute top-50 start-0 translate-middle-y px-3 search-icon"><i class="bi bi-search"></i></div>
                      <input class="form-control" type="search" placeholder="Search Messages">
                    </form>
                    </div>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex align-items-center">
                         <div class="notification-box"><i class="bi bi-basket2-fill"></i></div>
                         <div class="ms-3 flex-grow-1">
                           <h6 class="mb-0 dropdown-msg-user">New Orders <span class="msg-time float-end text-secondary">1 m</span></h6>
                           <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">You have recived new orders</small>
                         </div>
                      </div>
                    </a>
                   <a class="dropdown-item" href="#">
                     <div class="d-flex align-items-center">
                      <div class="notification-box"><i class="bi bi-people-fill"></i></div>
                        <div class="ms-3 flex-grow-1">
                          <h6 class="mb-0 dropdown-msg-user">New Customers <span class="msg-time float-end text-secondary">7 m</span></h6>
                          <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">5 new user registered</small>
                        </div>
                     </div>
                   </a>
                   <a class="dropdown-item" href="#">
                     <div class="d-flex align-items-center">
                      <div class="notification-box"><i class="bi bi-file-earmark-bar-graph-fill"></i></div>
                        <div class="ms-3 flex-grow-1">
                          <h6 class="mb-0 dropdown-msg-user">24 PDF File <span class="msg-time float-end text-secondary">2 h</span></h6>
                          <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">The pdf files generated</small>
                        </div>
                     </div>
                   </a>
                   <a class="dropdown-item" href="#">
                     <div class="d-flex align-items-center">
                      <div class="notification-box"><i class="bi bi-collection-play-fill"></i></div>
                        <div class="ms-3 flex-grow-1">
                          <h6 class="mb-0 dropdown-msg-user">Time Response  <span class="msg-time float-end text-secondary">3 h</span></h6>
                          <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">5.1 min avarage time response</small>
                        </div>
                     </div>
                   </a>
                   <a class="dropdown-item" href="#">
                     <div class="d-flex align-items-center">
                      <div class="notification-box"><i class="bi bi-cursor-fill"></i></div>
                        <div class="ms-3 flex-grow-1">
                          <h6 class="mb-0 dropdown-msg-user">New Product Approved  <span class="msg-time float-end text-secondary">1 d</span></h6>
                          <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">Your new product has approved</small>
                        </div>
                     </div>
                   </a>
                   <a class="dropdown-item" href="#">
                     <div class="d-flex align-items-center">
                      <div class="notification-box"><i class="bi bi-gift-fill"></i></div>
                        <div class="ms-3 flex-grow-1">
                          <h6 class="mb-0 dropdown-msg-user">New Comments <span class="msg-time float-end text-secondary">2 w</span></h6>
                          <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">New customer comments recived</small>
                        </div>
                     </div>
                   </a>
                   <a class="dropdown-item" href="#">
                     <div class="d-flex align-items-center">
                      <div class="notification-box"><i class="bi bi-droplet-fill"></i></div>
                        <div class="ms-3 flex-grow-1">
                          <h6 class="mb-0 dropdown-msg-user">New 24 authors<span class="msg-time float-end text-secondary">1 m</span></h6>
                          <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">24 new authors joined last week</small>
                        </div>
                     </div>
                   </a>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex align-items-center">
                      <div class="notification-box"><i class="bi bi-mic-fill"></i></div>
                       <div class="ms-3 flex-grow-1">
                         <h6 class="mb-0 dropdown-msg-user">Your item is shipped <span class="msg-time float-end text-secondary">7 m</span></h6>
                         <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">Successfully shipped your item</small>
                       </div>
                    </div>
                  </a>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex align-items-center">
                      <div class="notification-box"><i class="bi bi-lightbulb-fill"></i></div>
                       <div class="ms-3 flex-grow-1">
                         <h6 class="mb-0 dropdown-msg-user">Defense Alerts <span class="msg-time float-end text-secondary">2 h</span></h6>
                         <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">45% less alerts last 4 weeks</small>
                       </div>
                    </div>
                  </a>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex align-items-center">
                      <div class="notification-box"><i class="bi bi-bookmark-heart-fill"></i></div>
                       <div class="ms-3 flex-grow-1">
                         <h6 class="mb-0 dropdown-msg-user">4 New Sign Up <span class="msg-time float-end text-secondary">2 w</span></h6>
                         <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">New 4 user registartions</small>
                       </div>
                    </div>
                  </a>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex align-items-center">
                      <div class="notification-box"><i class="bi bi-briefcase-fill"></i></div>
                       <div class="ms-3 flex-grow-1">
                         <h6 class="mb-0 dropdown-msg-user">All Documents Uploaded <span class="msg-time float-end text-secondary">1 mo</span></h6>
                         <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">Sussessfully uploaded all files</small>
                       </div>
                    </div>
                  </a>
               </div>
               <div class="p-2">
                 <div><hr class="dropdown-divider"></div>
                   <a class="dropdown-item" href="#">
                     <div class="text-center">View All Notifications</div>
                   </a>
               </div>
              </div>
            </li> -->
         </ul>
       </div>
     </nav>
   </header>
   <!--end top header-->