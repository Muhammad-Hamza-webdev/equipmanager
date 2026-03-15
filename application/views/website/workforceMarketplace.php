<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Equip Managemnt</title>
  <link rel="icon" type="image/x-icon" href="<?= base_url() ?>assets/website/img/favicon.svg" />
  <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/style.css" />
  <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/header.css" />
  <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/footer.css" />
  <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/market.css" />
  <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/resopnsive.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
  <!-- Link Swiper's CSS -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>

<body>
  <!-- header section-->
  <?php $this->load->view('components/websiteHeader'); ?>
  <!-- hero section start -->
  <section class="reg-page market-page">
    <div class="container">
      <div class="inner-login inner-login-2 market">
        <div class="market-line">
          <div class="main-box market-box-fix">
            <div class="img">
              <svg
                width="72"
                height="72"
                viewBox="0 0 72 72"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M72 36C72 55.8889 55.8889 72 36 72C27.9444 72 20.5 69.3611 14.4722 64.8611L19 60.3333C19.5833 59.75 20.5 59.6667 21.1944 60.1111C25.6111 62.9167 30.8611 64.5278 36.4722 64.5278C52.3333 64.5278 65.1667 51.6944 65.1667 35.8333C65.1667 35.25 65.1389 34.6389 65.1111 34.0556C65.0556 33.1389 64.2778 32.4167 63.3611 32.4167H58.3611C57.3611 32.4167 56.5278 33.2778 56.6111 34.3056C56.6667 34.8611 56.6667 35.4167 56.6667 36C56.6667 47.25 47.5556 56.3611 36.3056 56.3611C32.4722 56.3611 28.8889 55.3056 25.8333 53.4722C23.1389 51.8611 20.8333 49.6111 19.1667 46.9722C17.1389 43.8056 15.9722 40.0278 15.9722 36C15.9722 34.7778 16.0833 33.6111 16.2778 32.4444C17.9722 22.8889 26.3056 15.6389 36.3333 15.6389C39.4722 15.6389 42.4722 16.3611 45.1389 17.6389C46.2222 18.1667 46.4722 19.6111 45.6389 20.4444L40.6111 25.5L33.6944 32.4444L26.75 39.3889C26.1944 39.9444 26.0833 40.8056 26.4722 41.4722C27.6111 43.5 29.3333 45.1667 31.4444 46.1667C32.1111 46.5 32.9167 46.3611 33.4445 45.8333L46.8333 32.4167L47.0278 32.2222L53.7778 25.4444L58.8611 20.3611C59.4722 19.7222 59.5556 18.7222 59 18.0278C57.3889 16 55.5 14.1667 53.4167 12.6389C48.6667 9.16667 42.8333 7.11111 36.5 7.11111C21.8056 7.11111 9.69444 18.1667 8 32.3889C7.86111 33.5 7.80556 34.6389 7.80556 35.8056C7.80556 41.6667 9.55556 47.1111 12.5556 51.6389C13 52.3333 12.9167 53.25 12.3333 53.8333L7.94445 58.2222C7.88889 58.2778 7.86111 58.3333 7.80556 58.3889C2.91667 52.25 0 44.4722 0 36C0 16.1111 16.1111 0 36 0C55.8889 0 72 16.1111 72 36Z"
                  fill="#34FF67" />
              </svg>
            </div>
            <h1 class="text-h1-upp text-center">
              Find the Right Workforce for Your Next Project
            </h1>
            <!-- search -->
            <section class="search-2">
              <div class="inner-search-2">
                <span>Search Workforce</span>
                <form action="" method="post" class="search-main">
                  <!-- SECURITY FIX: Add CSRF token to form -->
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                  <!-- Custom Select Element -->
                  <div
                    class="custom-select-element custom-select-element-2"
                    data-custom-select-element
                    data-custom-select-value>
                    <div
                      class="custom-select-label-wrapper"
                      data-custom-select-triger>
                      <div class="custom-select-icon-txt">
                        <svg
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M8 10.75H4C3.27088 10.7493 2.57184 10.4593 2.05628 9.94372C1.54071 9.42816 1.25074 8.72912 1.25 8V4C1.25074 3.27088 1.54071 2.57184 2.05628 2.05628C2.57184 1.54071 3.27088 1.25074 4 1.25H8C8.72912 1.25074 9.42816 1.54071 9.94372 2.05628C10.4593 2.57184 10.7493 3.27088 10.75 4V8C10.7493 8.72912 10.4593 9.42816 9.94372 9.94372C9.42816 10.4593 8.72912 10.7493 8 10.75ZM4 2.75C3.66857 2.75031 3.35081 2.8821 3.11646 3.11646C2.8821 3.35081 2.75031 3.66857 2.75 4V8C2.75031 8.33143 2.8821 8.64919 3.11646 8.88354C3.35081 9.1179 3.66857 9.24969 4 9.25H8C8.33143 9.24969 8.64919 9.1179 8.88354 8.88354C9.1179 8.64919 9.24969 8.33143 9.25 8V4C9.24969 3.66857 9.1179 3.35081 8.88354 3.11646C8.64919 2.8821 8.33143 2.75031 8 2.75H4Z"
                            fill="#585B7C" />
                          <path
                            d="M20 10.75H16C15.2709 10.7493 14.5718 10.4593 14.0563 9.94372C13.5407 9.42816 13.2507 8.72912 13.25 8V4C13.2507 3.27088 13.5407 2.57184 14.0563 2.05628C14.5718 1.54071 15.2709 1.25074 16 1.25H20C20.7291 1.25074 21.4282 1.54071 21.9437 2.05628C22.4593 2.57184 22.7493 3.27088 22.75 4V8C22.7493 8.72912 22.4593 9.42816 21.9437 9.94372C21.4282 10.4593 20.7291 10.7493 20 10.75ZM16 2.75C15.6686 2.75031 15.3508 2.8821 15.1165 3.11646C14.8821 3.35081 14.7503 3.66857 14.75 4V8C14.7503 8.33143 14.8821 8.64919 15.1165 8.88354C15.3508 9.1179 15.6686 9.24969 16 9.25H20C20.3314 9.24969 20.6492 9.1179 20.8835 8.88354C21.1179 8.64919 21.2497 8.33143 21.25 8V4C21.2497 3.66857 21.1179 3.35081 20.8835 3.11646C20.6492 2.8821 20.3314 2.75031 20 2.75H16Z"
                            fill="#585B7C" />
                          <path
                            d="M8 22.75H4C3.27088 22.7493 2.57184 22.4593 2.05628 21.9437C1.54071 21.4282 1.25074 20.7291 1.25 20V16C1.25074 15.2709 1.54071 14.5718 2.05628 14.0563C2.57184 13.5407 3.27088 13.2507 4 13.25H8C8.72912 13.2507 9.42816 13.5407 9.94372 14.0563C10.4593 14.5718 10.7493 15.2709 10.75 16V20C10.7493 20.7291 10.4593 21.4282 9.94372 21.9437C9.42816 22.4593 8.72912 22.7493 8 22.75ZM4 14.75C3.66857 14.7503 3.35081 14.8821 3.11646 15.1165C2.8821 15.3508 2.75031 15.6686 2.75 16V20C2.75031 20.3314 2.8821 20.6492 3.11646 20.8835C3.35081 21.1179 3.66857 21.2497 4 21.25H8C8.33143 21.2497 8.64919 21.1179 8.88354 20.8835C9.1179 20.6492 9.24969 20.3314 9.25 20V16C9.24969 15.6686 9.1179 15.3508 8.88354 15.1165C8.64919 14.8821 8.33143 14.7503 8 14.75H4Z"
                            fill="#585B7C" />
                          <path
                            d="M18.0002 23.335C17.7705 23.3355 17.5428 23.2905 17.3305 23.2027C17.1181 23.1149 16.9253 22.9859 16.7629 22.8233L13.177 19.2373C12.8492 18.909 12.665 18.464 12.665 18C12.665 17.536 12.8492 17.091 13.177 16.7627L16.7629 13.1768C17.0913 12.8489 17.5363 12.6648 18.0002 12.6648C18.4642 12.6648 18.9092 12.8489 19.2375 13.1768L22.8235 16.7627C23.1513 17.091 23.3354 17.536 23.3354 18C23.3354 18.464 23.1513 18.909 22.8235 19.2373L19.2375 22.8232C19.0752 22.9859 18.8823 23.1149 18.67 23.2027C18.4577 23.2905 18.23 23.3355 18.0002 23.335ZM18.0002 14.1641C17.9674 14.164 17.9349 14.1704 17.9045 14.183C17.8742 14.1956 17.8466 14.2141 17.8235 14.2373L14.2375 17.8232C14.2143 17.8464 14.1959 17.874 14.1833 17.9043C14.1708 17.9347 14.1643 17.9672 14.1643 18C14.1643 18.0328 14.1708 18.0653 14.1833 18.0957C14.1959 18.126 14.2143 18.1535 14.2375 18.1768L17.8235 21.7627C17.8467 21.7859 17.8742 21.8043 17.9046 21.8169C17.9349 21.8295 17.9674 21.8359 18.0002 21.8359C18.0331 21.8359 18.0656 21.8295 18.0959 21.8169C18.1262 21.8043 18.1538 21.7859 18.177 21.7627L21.7629 18.1768C21.7862 18.1535 21.8046 18.126 21.8171 18.0957C21.8297 18.0653 21.8362 18.0328 21.8362 18C21.8362 17.9672 21.8297 17.9347 21.8171 17.9043C21.8046 17.874 21.7862 17.8464 21.7629 17.8232L18.177 14.2373C18.1538 14.214 18.1263 14.1955 18.096 14.183C18.0656 14.1704 18.0331 14.164 18.0002 14.1641Z"
                            fill="#585B7C" />
                        </svg>

                        <div class="custom-select-label-option-text">
                          <span class="cos-label">CATEGORY</span>
                          <span class="custom-select-label-txt"> </span>
                        </div>
                      </div>
                      <div class="custom-select-chevron">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          width="25"
                          height="24"
                          viewBox="0 0 25 24"
                          fill="none">
                          <path
                            d="M20.4201 8.95L13.9001 15.47C13.1301 16.24 11.8701 16.24 11.1001 15.47L4.58008 8.95"
                            stroke="none"
                            stroke-width="1.5"
                            stroke-miterlimit="10"
                            stroke-linecap="round"
                            stroke-linejoin="round" />
                        </svg>
                      </div>
                    </div>
                    <div
                      class="custom-select-options-dropdown-wrapper"
                      data-custom-select-dropdown>
                      <div class="custom-select-options-dropdown-container">
                        <div
                          class="custom-select-options-search"
                          data-custom-select-options-search>
                          <div class="label-input">
                            <!-- Placeholder Icon -->
                            <div class="input-placeholder-icon">
                              <svg
                                class="svg-icon"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none">
                                <path
                                  d="M20 11C20 15.97 15.97 20 11 20C6.03 20 2 15.97 2 11C2 6.03 6.03 2 11 2"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                                <path
                                  d="M18.9299 20.6898C19.4599 22.2898 20.6699 22.4498 21.5999 21.0498C22.4499 19.7698 21.8899 18.7198 20.3499 18.7198C19.2099 18.7098 18.5699 19.5998 18.9299 20.6898Z"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                                <path
                                  d="M14 5H20"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                                <path
                                  d="M14 8H17"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                            </div>
                            <input type="text" placeholder="Search here" />
                          </div>
                        </div>
                        <div class="custom-select-options-lists-container">
                          <ul
                            class="custom-select-options-list"
                            data-custom-select-options-list>
                            <?php
                            if ($workforceCat) {
                              foreach ($workforceCat as $row) {
                            ?>
                                <li class="custom-select-option">
                                  <span><?= $row['web_catName'] ?></span>
                                </li>
                            <?php
                              }
                            }
                            ?>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Custom Select Element -->
                  <!-- Custom Select Element -->
                  <div
                    class="custom-select-element custom-select-element-2"
                    data-custom-select-element
                    data-custom-select-value>
                    <div
                      class="custom-select-label-wrapper"
                      data-custom-select-triger>
                      <div class="custom-select-icon-txt">
                        <svg
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M19.1781 2.9731C17.2609 1.05586 14.7118 0 12.0004 0C9.28906 0 6.7399 1.05586 4.82271 2.9731C2.90547 4.89038 1.84961 7.43945 1.84961 10.1508C1.84961 15.6357 7.03578 20.1978 9.82198 22.6487C10.2092 22.9893 10.5435 23.2835 10.8099 23.5323C11.1437 23.844 11.5721 24 12.0004 24C12.4288 24 12.8571 23.844 13.1909 23.5323C13.4572 23.2834 13.7916 22.9893 14.1788 22.6487C16.965 20.1978 22.1512 15.6357 22.1512 10.1508C22.1511 7.43945 21.0953 4.89038 19.1781 2.9731ZM13.2502 21.5932C12.8545 21.9412 12.5128 22.2419 12.2311 22.505C12.1017 22.6258 11.899 22.6258 11.7696 22.505C11.4879 22.2418 11.1462 21.9412 10.7505 21.5932C8.13111 19.289 3.25539 15 3.25539 10.1508C3.25539 5.32885 7.17832 1.40592 12.0003 1.40592C16.8223 1.40592 20.7452 5.32885 20.7452 10.1508C20.7452 15 15.8696 19.289 13.2502 21.5932Z"
                            fill="#585B7C" />
                          <path
                            d="M11.9997 5.29401C9.53309 5.29401 7.52637 7.30068 7.52637 9.7673C7.52637 12.2339 9.53309 14.2406 11.9997 14.2406C14.4663 14.2406 16.473 12.2339 16.473 9.7673C16.473 7.30068 14.4663 5.29401 11.9997 5.29401ZM11.9997 12.8347C10.3083 12.8347 8.93224 11.4586 8.93224 9.76725C8.93224 8.0759 10.3083 6.69984 11.9997 6.69984C13.6911 6.69984 15.0671 8.0759 15.0671 9.76725C15.0671 11.4586 13.6911 12.8347 11.9997 12.8347Z"
                            fill="#585B7C" />
                        </svg>

                        <div class="custom-select-label-option-text">
                          <span class="cos-label">LOCATION</span>
                          <span class="custom-select-label-txt"> </span>
                        </div>
                      </div>
                      <div class="custom-select-chevron">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          width="25"
                          height="24"
                          viewBox="0 0 25 24"
                          fill="none">
                          <path
                            d="M20.4201 8.95L13.9001 15.47C13.1301 16.24 11.8701 16.24 11.1001 15.47L4.58008 8.95"
                            stroke="none"
                            stroke-width="1.5"
                            stroke-miterlimit="10"
                            stroke-linecap="round"
                            stroke-linejoin="round" />
                        </svg>
                      </div>
                    </div>
                    <div
                      class="custom-select-options-dropdown-wrapper"
                      data-custom-select-dropdown>
                      <div class="custom-select-options-dropdown-container">
                        <div
                          class="custom-select-options-search"
                          data-custom-select-options-search>
                          <div class="label-input">
                            <!-- Placeholder Icon -->
                            <div class="input-placeholder-icon">
                              <svg
                                class="svg-icon"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none">
                                <path
                                  d="M20 11C20 15.97 15.97 20 11 20C6.03 20 2 15.97 2 11C2 6.03 6.03 2 11 2"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                                <path
                                  d="M18.9299 20.6898C19.4599 22.2898 20.6699 22.4498 21.5999 21.0498C22.4499 19.7698 21.8899 18.7198 20.3499 18.7198C19.2099 18.7098 18.5699 19.5998 18.9299 20.6898Z"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                                <path
                                  d="M14 5H20"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                                <path
                                  d="M14 8H17"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                            </div>
                            <input type="text" placeholder="Search here" />
                          </div>
                        </div>
                        <div class="custom-select-options-lists-container">
                          <ul
                            class="custom-select-options-list"
                            data-custom-select-options-list>
                            <li class="custom-select-option">
                              <span>New York, USA</span>
                            </li>
                            <li class="custom-select-option">
                              <span>New York, USA 1</span>
                            </li>
                            <li class="custom-select-option">
                              <span>New York, USA 2</span>
                            </li>
                            <li class="custom-select-option">
                              <span>New York, USA 3</span>
                            </li>
                            <li class="custom-select-option">
                              <span>New York, USA 4</span>
                            </li>
                            <li class="custom-select-option">
                              <span>New York, USA 5</span>
                            </li>
                            <li class="custom-select-option">
                              <span>New York, USA 6</span>
                            </li>
                            <li class="custom-select-option">
                              <span>New York, USA 7</span>
                            </li>
                            <li class="custom-select-option">
                              <span>New York, USA 8</span>
                            </li>
                            <li class="custom-select-option">
                              <span>New York, USA 9</span>
                            </li>
                            <li class="custom-select-option">
                              <span>New York, USA 10</span>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Custom Select Element -->
                  <!-- Custom Select Element -->
                  <div
                    class="custom-select-element custom-select-element-2"
                    data-custom-select-element
                    data-custom-select-value>
                    <div
                      class="custom-select-label-wrapper"
                      data-custom-select-triger>
                      <div class="custom-select-icon-txt">
                        <svg
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M12 22.5C9.9233 22.5 7.89323 21.8842 6.16652 20.7304C4.4398 19.5767 3.09399 17.9368 2.29927 16.0182C1.50455 14.0996 1.29661 11.9884 1.70176 9.95156C2.1069 7.91476 3.10693 6.04383 4.57538 4.57538C6.04383 3.10693 7.91476 2.1069 9.95156 1.70176C11.9884 1.29661 14.0996 1.50455 16.0182 2.29927C17.9368 3.09399 19.5767 4.4398 20.7304 6.16652C21.8842 7.89323 22.5 9.9233 22.5 12C22.5 14.7848 21.3938 17.4555 19.4246 19.4246C17.4555 21.3938 14.7848 22.5 12 22.5ZM12 3C10.22 3 8.47992 3.52785 6.99987 4.51678C5.51983 5.50571 4.36628 6.91132 3.68509 8.55585C3.0039 10.2004 2.82567 12.01 3.17294 13.7558C3.5202 15.5016 4.37737 17.1053 5.63604 18.364C6.89472 19.6226 8.49836 20.4798 10.2442 20.8271C11.99 21.1743 13.7996 20.9961 15.4442 20.3149C17.0887 19.6337 18.4943 18.4802 19.4832 17.0001C20.4722 15.5201 21 13.78 21 12C21 9.61306 20.0518 7.32387 18.364 5.63604C16.6761 3.94822 14.387 3 12 3Z"
                            fill="#585B7C" />
                          <path
                            d="M15.75 15.75C15.5808 15.749 15.417 15.6909 15.285 15.585L11.535 12.585C11.4466 12.5152 11.3751 12.4263 11.3257 12.325C11.2764 12.2237 11.2505 12.1127 11.25 12V6C11.25 5.80109 11.329 5.61032 11.4697 5.46967C11.6103 5.32902 11.8011 5.25 12 5.25C12.1989 5.25 12.3897 5.32902 12.5303 5.46967C12.671 5.61032 12.75 5.80109 12.75 6V11.64L16.215 14.415C16.3695 14.5387 16.4689 14.7186 16.4914 14.9153C16.5138 15.112 16.4576 15.3096 16.335 15.465C16.2652 15.5534 16.1763 15.6249 16.075 15.6742C15.9737 15.7236 15.8627 15.7495 15.75 15.75Z"
                            fill="#585B7C" />
                        </svg>

                        <div class="custom-select-label-option-text">
                          <span class="cos-label">AVAILABILITY</span>
                          <span class="custom-select-label-txt"> </span>
                        </div>
                      </div>
                      <div class="custom-select-chevron">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          width="25"
                          height="24"
                          viewBox="0 0 25 24"
                          fill="none">
                          <path
                            d="M20.4201 8.95L13.9001 15.47C13.1301 16.24 11.8701 16.24 11.1001 15.47L4.58008 8.95"
                            stroke="none"
                            stroke-width="1.5"
                            stroke-miterlimit="10"
                            stroke-linecap="round"
                            stroke-linejoin="round" />
                        </svg>
                      </div>
                    </div>
                    <div
                      class="custom-select-options-dropdown-wrapper"
                      data-custom-select-dropdown>
                      <div class="custom-select-options-dropdown-container">
                        <div
                          class="custom-select-options-search"
                          data-custom-select-options-search>
                          <div class="label-input">
                            <!-- Placeholder Icon -->
                            <div class="input-placeholder-icon">
                              <svg
                                class="svg-icon"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none">
                                <path
                                  d="M20 11C20 15.97 15.97 20 11 20C6.03 20 2 15.97 2 11C2 6.03 6.03 2 11 2"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                                <path
                                  d="M18.9299 20.6898C19.4599 22.2898 20.6699 22.4498 21.5999 21.0498C22.4499 19.7698 21.8899 18.7198 20.3499 18.7198C19.2099 18.7098 18.5699 19.5998 18.9299 20.6898Z"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                                <path
                                  d="M14 5H20"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                                <path
                                  d="M14 8H17"
                                  stroke-width="1.5"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                              </svg>
                            </div>
                            <input type="text" placeholder="Search here" />
                          </div>
                        </div>
                        <div class="custom-select-options-lists-container">
                          <ul
                            class="custom-select-options-list"
                            data-custom-select-options-list>
                            <li class="custom-select-option">
                              <span>2 July - 10 July 2025</span>
                            </li>
                            <li class="custom-select-option">
                              <span>2 July - 10 July 2025 1</span>
                            </li>
                            <li class="custom-select-option">
                              <span>2 July - 10 July 2025 2</span>
                            </li>
                            <li class="custom-select-option">
                              <span>2 July - 10 July 2025 3</span>
                            </li>
                            <li class="custom-select-option">
                              <span>2 July - 10 July 2025 4</span>
                            </li>
                            <li class="custom-select-option">
                              <span>2 July - 10 July 2025 5</span>
                            </li>
                            <li class="custom-select-option">
                              <span>2 July - 10 July 2025 6</span>
                            </li>
                            <li class="custom-select-option">
                              <span>2 July - 10 July 2025 7</span>
                            </li>
                            <li class="custom-select-option">
                              <span>2 July - 10 July 2025 8</span>
                            </li>
                            <li class="custom-select-option">
                              <span>2 July - 10 July 2025 9</span>
                            </li>
                            <li class="custom-select-option">
                              <span>2 July - 10 July 2025 10</span>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Custom Select Element -->

                  <a href="#" class="btn-dark-green btn-responsive">SEARCH</a>
                </form>
              </div>
            </section>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- hero section end -->

  <!-- Workforce Grid -->
  <section class="equipment">
    <div class="container">
      <div class="inner-equipment">
        <div class="title">
          <h2 class="text-h2">Workforce</h2>

          <div class="hamburger hide-550px">
            <input class="checkbox" type="checkbox" />
            <svg fill="none" viewBox="0 0 50 50" height="50" width="50">
              <path
                class="lineTop line"
                stroke-linecap="round"
                stroke-width="4"
                stroke="black"
                d="M6 11L44 11"></path>
              <path
                stroke-linecap="round"
                stroke-width="4"
                stroke="black"
                d="M6 24H43"
                class="lineMid line"></path>
              <path
                stroke-linecap="round"
                stroke-width="4"
                stroke="black"
                d="M6 37H43"
                class="lineBottom line"></path>
            </svg>
            <!-- hamburger options -->
            <div class="hamburger-options">
              <ul>
                <li>Grid View</li>
                <li>List View</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- equipment grid main box -->
        <div class="equipment-grid">

          <?php
          if ($workforcelisting) {
            foreach ($workforcelisting as $row) {
          ?>
              <!-- single equipment grid -->
              <div class="single-equipment-grid">
                <div
                  class="bg-img"
                  style="
                  background-image: url('<?= base_url() ?>assets/website/img/b8db7165d2edea8a33ded6cae06c9adaa9b6b393.webp');
                ">
                  <div class="wish">
                    <span><?= $row['web_catName'] ?></span>
                    <label class="custom-heart-toggle">
                      <input type="checkbox" class="heart-input" />
                      <div class="heart-icon-wrapper">
                        <svg viewBox="0 0 256 256" class="heart-svg">
                          <rect fill="none" height="256" width="256"></rect>
                          <path
                            d="M224.6,51.9a59.5,59.5,0,0,0-43-19.9,60.5,60.5,0,0,0-44,17.6L128,59.1l-7.5-7.4C97.2,28.3,59.2,26.3,35.9,47.4a59.9,59.9,0,0,0-2.3,87l83.1,83.1a15.9,15.9,0,0,0,22.6,0l81-81C243.7,113.2,245.6,75.2,224.6,51.9Z"
                            stroke-width="20px"
                            stroke="#fff"
                            fill="none"></path>
                        </svg>
                      </div>
                    </label>
                  </div>
                </div>
                <div class="heading-price">
                  <div>
                    <span class="prod-name"><?= $row['personName'] ?></span>
                    <div class="prod-price">
                      <span>Price</span>
                      <span>$<?= $row['workforcePrice'] ?> /
                        <?php 
                          if($row['workforceRentalType']==1){
                            echo 'Per Day';
                          }else if($row['workforceRentalType']==2){
                            echo 'Per Week';
                          }else if($row['workforceRentalType']==3){
                            echo 'Per Month';
                          }else{
                            echo 'Per Year';
                          }
                        ?>
                      </span>
                    </div>
                  </div>
                  <svg
                    width="40"
                    height="40"
                    viewBox="0 0 40 40"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <foreignObject x="-22" y="-22" width="84" height="84">
                      <div
                        xmlns="http://www.w3.org/1999/xhtml"
                        style="
                        backdrop-filter: blur(11px);
                        clip-path: url(#bgblur_0_2718_1750_clip_path);
                        height: 100%;
                        width: 100%;
                      "></div>
                    </foreignObject>
                    <a href="<?= base_url('workforce-detail?item='.rtrim(strtr(base64_encode($row['itemID'] . '|mySecret'), '+/', '-_'), '=')) ?>">
                    <circle
                      data-figma-bg-blur-radius="22"
                      cx="20"
                      cy="20"
                      r="20"
                      fill="#34FF67" />
                    <path
                      d="M25.0361 16.1111C25.0354 15.8073 24.9144 15.5162 24.6997 15.3015C24.4849 15.0867 24.1938 14.9658 23.8901 14.9651L17.4083 14.9651C17.2578 14.9651 17.1088 14.9947 16.9697 15.0523C16.8307 15.1099 16.7044 15.1943 16.598 15.3007C16.383 15.5156 16.2623 15.8071 16.2623 16.1111C16.2623 16.415 16.383 16.7065 16.598 16.9214C16.8129 17.1363 17.1044 17.257 17.4083 17.257H21.1237L15.3017 23.079C15.0868 23.2939 14.9661 23.5853 14.9661 23.8892C14.9661 24.1931 15.0868 24.4846 15.3017 24.6995C15.5166 24.9143 15.808 25.0351 16.1119 25.0351C16.4158 25.0351 16.7073 24.9143 16.9222 24.6995L22.7441 18.8775L22.7441 22.5929C22.7441 22.7434 22.7738 22.8924 22.8314 23.0314C22.8889 23.1705 22.9734 23.2968 23.0798 23.4032C23.1862 23.5096 23.3125 23.594 23.4516 23.6516C23.5906 23.7092 23.7396 23.7389 23.8901 23.7389C24.0406 23.7389 24.1896 23.7092 24.3287 23.6516C24.4677 23.594 24.594 23.5096 24.7004 23.4032C24.8068 23.2968 24.8913 23.1705 24.9489 23.0314C25.0064 22.8924 25.0361 22.7434 25.0361 22.5929L25.0361 16.1111Z"
                      fill="#0F2F2C" />
                    <defs>
                      <clipPath
                        id="bgblur_0_2718_1750_clip_path"
                        transform="translate(22 22)">
                        <circle cx="20" cy="20" r="20" />
                      </clipPath>
                    </defs>
                    </a>
                  </svg>
                </div>
              </div>
          <?php
            }
          }
          ?>





        </div>
      </div>
    </div>
  </section>

  <!-- TESTIMONIALS -->
  <section class="testimoni">
    <div class="container overflow-hide">
      <div class="inner-testimoni">
        <div class="testimoni-title">
          <div>
            <span>TESTIMONIALS</span>
            <h2 class="text-h2 text-white">What Our Client Say!</h2>
          </div>
        </div>

        <!-- Swiper -->
        <div class="swiper mySwiper">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <!-- testimoni single start -->
              <div class="testimoni-single-card">
                <div class="rating">
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </div>
                <p class="text-para text-white fix-height">
                  Lorem Ipsum is simply dummy text of the printing and
                  typesetting industry. Lorem Ipsum has been the industry's
                  standard dummy text ever since the 1500s, when an unknown
                  printer took a galley of type and scrambled it to make a
                  type.
                </p>
                <div class="client-info">
                  <img
                    src="<?= base_url() ?>assets/website/img/67ffd9ab33f677397c671e58bef352ebc410bf03.png"
                    alt="client" />
                  <div>
                    <h4 class="text-h4">Alison Jordon</h4>
                    <span>Hook - USA</span>
                  </div>
                </div>
              </div>
              <!-- testimoni single end -->
            </div>
            <div class="swiper-slide">
              <!-- testimoni single start -->
              <div class="testimoni-single-card">
                <div class="rating">
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </div>
                <p class="text-para text-white fix-height">
                  Lorem Ipsum is simply dummy text of the printing and
                  typesetting industry. Lorem Ipsum has been the industry's
                  standard dummy text ever since the 1500s, when an unknown
                  printer took a galley of type and scrambled it to make a
                  type.
                </p>
                <div class="client-info">
                  <img
                    src="<?= base_url() ?>assets/website/img/67ffd9ab33f677397c671e58bef352ebc410bf03.png"
                    alt="client" />
                  <div>
                    <h4 class="text-h4">Alison Jordon</h4>
                    <span>Hook - USA</span>
                  </div>
                </div>
              </div>
              <!-- testimoni single end -->
            </div>
            <div class="swiper-slide">
              <!-- testimoni single start -->
              <div class="testimoni-single-card">
                <div class="rating">
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </div>
                <p class="text-para text-white fix-height">
                  Lorem Ipsum is simply dummy text of the printing and
                  typesetting industry. Lorem Ipsum has been the industry's
                  standard dummy text ever since the 1500s, when an unknown
                  printer took a galley of type and scrambled it to make a
                  type.
                </p>
                <div class="client-info">
                  <img
                    src="<?= base_url() ?>assets/website/img/67ffd9ab33f677397c671e58bef352ebc410bf03.png"
                    alt="client" />
                  <div>
                    <h4 class="text-h4">Alison Jordon</h4>
                    <span>Hook - USA</span>
                  </div>
                </div>
              </div>
              <!-- testimoni single end -->
            </div>
            <div class="swiper-slide">
              <!-- testimoni single start -->
              <div class="testimoni-single-card">
                <div class="rating">
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </div>
                <p class="text-para text-white fix-height">
                  Lorem Ipsum is simply dummy text of the printing and
                  typesetting industry. Lorem Ipsum has been the industry's
                  standard dummy text ever since the 1500s, when an unknown
                  printer took a galley of type and scrambled it to make a
                  type.
                </p>
                <div class="client-info">
                  <img
                    src="<?= base_url() ?>assets/website/img/67ffd9ab33f677397c671e58bef352ebc410bf03.png"
                    alt="client" />
                  <div>
                    <h4 class="text-h4">Alison Jordon</h4>
                    <span>Hook - USA</span>
                  </div>
                </div>
              </div>
              <!-- testimoni single end -->
            </div>
            <div class="swiper-slide">
              <!-- testimoni single start -->
              <div class="testimoni-single-card">
                <div class="rating">
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </div>
                <p class="text-para text-white fix-height">
                  Lorem Ipsum is simply dummy text of the printing and
                  typesetting industry. Lorem Ipsum has been the industry's
                  standard dummy text ever since the 1500s, when an unknown
                  printer took a galley of type and scrambled it to make a
                  type.
                </p>
                <div class="client-info">
                  <img
                    src="<?= base_url() ?>assets/website/img/67ffd9ab33f677397c671e58bef352ebc410bf03.png"
                    alt="client" />
                  <div>
                    <h4 class="text-h4">Alison Jordon</h4>
                    <span>Hook - USA</span>
                  </div>
                </div>
              </div>
              <!-- testimoni single end -->
            </div>
            <div class="swiper-slide">
              <!-- testimoni single start -->
              <div class="testimoni-single-card">
                <div class="rating">
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </div>
                <p class="text-para text-white fix-height">
                  Lorem Ipsum is simply dummy text of the printing and
                  typesetting industry. Lorem Ipsum has been the industry's
                  standard dummy text ever since the 1500s, when an unknown
                  printer took a galley of type and scrambled it to make a
                  type.
                </p>
                <div class="client-info">
                  <img
                    src="<?= base_url() ?>assets/website/img/67ffd9ab33f677397c671e58bef352ebc410bf03.png"
                    alt="client" />
                  <div>
                    <h4 class="text-h4">Alison Jordon</h4>
                    <span>Hook - USA</span>
                  </div>
                </div>
              </div>
              <!-- testimoni single end -->
            </div>
            <div class="swiper-slide">
              <!-- testimoni single start -->
              <div class="testimoni-single-card">
                <div class="rating">
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </div>
                <p class="text-para text-white fix-height">
                  Lorem Ipsum is simply dummy text of the printing and
                  typesetting industry. Lorem Ipsum has been the industry's
                  standard dummy text ever since the 1500s, when an unknown
                  printer took a galley of type and scrambled it to make a
                  type.
                </p>
                <div class="client-info">
                  <img
                    src="<?= base_url() ?>assets/website/img/67ffd9ab33f677397c671e58bef352ebc410bf03.png"
                    alt="client" />
                  <div>
                    <h4 class="text-h4">Alison Jordon</h4>
                    <span>Hook - USA</span>
                  </div>
                </div>
              </div>
              <!-- testimoni single end -->
            </div>
            <div class="swiper-slide">
              <!-- testimoni single start -->
              <div class="testimoni-single-card">
                <div class="rating">
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </div>
                <p class="text-para text-white fix-height">
                  Lorem Ipsum is simply dummy text of the printing and
                  typesetting industry. Lorem Ipsum has been the industry's
                  standard dummy text ever since the 1500s, when an unknown
                  printer took a galley of type and scrambled it to make a
                  type.
                </p>
                <div class="client-info">
                  <img
                    src="<?= base_url() ?>assets/website/img/67ffd9ab33f677397c671e58bef352ebc410bf03.png"
                    alt="client" />
                  <div>
                    <h4 class="text-h4">Alison Jordon</h4>
                    <span>Hook - USA</span>
                  </div>
                </div>
              </div>
              <!-- testimoni single end -->
            </div>
            <div class="swiper-slide">
              <!-- testimoni single start -->
              <div class="testimoni-single-card">
                <div class="rating">
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                      fill="#34FF67" />
                    <path
                      d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                      stroke="#34FF67"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </div>
                <p class="text-para text-white fix-height">
                  Lorem Ipsum is simply dummy text of the printing and
                  typesetting industry. Lorem Ipsum has been the industry's
                  standard dummy text ever since the 1500s, when an unknown
                  printer took a galley of type and scrambled it to make a
                  type.
                </p>
                <div class="client-info">
                  <img
                    src="<?= base_url() ?>assets/website/img/67ffd9ab33f677397c671e58bef352ebc410bf03.png"
                    alt="client" />
                  <div>
                    <h4 class="text-h4">Alison Jordon</h4>
                    <span>Hook - USA</span>
                  </div>
                </div>
              </div>
              <!-- testimoni single end -->
            </div>
          </div>

          <!-- Navigation buttons -->
          <div class="swiper-button-next mySwiper-next">
            <svg
              width="14"
              height="12"
              viewBox="0 0 14 12"
              fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M0.334579 6.53965C0.1203 6.3244 2.63713e-07 6.03304 2.50436e-07 5.72932C2.3716e-07 5.42559 0.1203 5.13423 0.334579 4.91898L4.91791 0.335651C5.02433 0.229237 5.15066 0.144824 5.2897 0.0872328C5.42873 0.0296417 5.57775 -2.43811e-07 5.72824 -2.5039e-07C6.03218 -2.63675e-07 6.32366 0.120737 6.53858 0.335651C6.75349 0.550565 6.87423 0.84205 6.87423 1.14598C6.87423 1.44992 6.75349 1.7414 6.53858 1.95632L3.91141 4.58348L12.1449 4.58348C12.4488 4.58348 12.7403 4.7042 12.9551 4.91909C13.17 5.13398 13.2907 5.42542 13.2907 5.72932C13.2907 6.03321 13.17 6.32466 12.9551 6.53954C12.7403 6.75443 12.4488 6.87515 12.1449 6.87515L3.91141 6.87515L6.53858 9.50232C6.64499 9.60873 6.72941 9.73507 6.787 9.8741C6.84459 10.0131 6.87423 10.1622 6.87423 10.3127C6.87423 10.4631 6.84459 10.6122 6.787 10.7512C6.72941 10.8902 6.64499 11.0166 6.53858 11.123C6.43216 11.2294 6.30583 11.3138 6.16679 11.3714C6.02776 11.429 5.87874 11.4586 5.72825 11.4586C5.57775 11.4586 5.42873 11.429 5.2897 11.3714C5.15066 11.3138 5.02433 11.2294 4.91791 11.123L0.334579 6.53965Z"
                fill="#34FF67"></path>
            </svg>
          </div>
          <div class="swiper-button-prev mySwiper-prev">
            <svg
              width="14"
              height="12"
              viewBox="0 0 14 12"
              fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M0.334579 6.53965C0.1203 6.3244 2.63713e-07 6.03304 2.50436e-07 5.72932C2.3716e-07 5.42559 0.1203 5.13423 0.334579 4.91898L4.91791 0.335651C5.02433 0.229237 5.15066 0.144824 5.2897 0.0872328C5.42873 0.0296417 5.57775 -2.43811e-07 5.72824 -2.5039e-07C6.03218 -2.63675e-07 6.32366 0.120737 6.53858 0.335651C6.75349 0.550565 6.87423 0.84205 6.87423 1.14598C6.87423 1.44992 6.75349 1.7414 6.53858 1.95632L3.91141 4.58348L12.1449 4.58348C12.4488 4.58348 12.7403 4.7042 12.9551 4.91909C13.17 5.13398 13.2907 5.42542 13.2907 5.72932C13.2907 6.03321 13.17 6.32466 12.9551 6.53954C12.7403 6.75443 12.4488 6.87515 12.1449 6.87515L3.91141 6.87515L6.53858 9.50232C6.64499 9.60873 6.72941 9.73507 6.787 9.8741C6.84459 10.0131 6.87423 10.1622 6.87423 10.3127C6.87423 10.4631 6.84459 10.6122 6.787 10.7512C6.72941 10.8902 6.64499 11.0166 6.53858 11.123C6.43216 11.2294 6.30583 11.3138 6.16679 11.3714C6.02776 11.429 5.87874 11.4586 5.72825 11.4586C5.57775 11.4586 5.42873 11.429 5.2897 11.3714C5.15066 11.3138 5.02433 11.2294 4.91791 11.123L0.334579 6.53965Z"
                fill="#34FF67"></path>
            </svg>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- call to action section -->
  <seation class="cta-section">
    <div class="container">
      <div class="inner-cta-section">
        <div class="cta-info">
          <span class="cta-heading">Got equipment to rent out?</span>
          <p class="text-para">Turn your idle assets into income.</p>
          <div class="cta-btn">
            <a href="#" class="btn-dark-green"> List Your Equipment Now</a>
          </div>
        </div>
        <img src="<?= base_url() ?>assets/website/img/stocks.png" alt="Grow" class="img-ctrl" />
      </div>
    </div>
  </seation>

  <!-- footer section -->
  <footer class="footer">
    <div class="container">
      <div class="inner-footer-main">
        <div class="footer-logo">
          <a href="/">
            <svg
              width="199"
              height="44"
              viewBox="0 0 199 44"
              fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M43.4637 21.7319C43.4637 33.7381 33.738 43.4637 21.7319 43.4637C16.869 43.4637 12.3751 41.8707 8.73635 39.1542L11.4696 36.421C11.8217 36.0689 12.3751 36.0186 12.7943 36.2869C15.4605 37.9805 18.6297 38.953 22.0169 38.953C31.5917 38.953 39.3387 31.206 39.3387 21.6313C39.3387 21.2791 39.3219 20.9102 39.3052 20.5581C39.2716 20.0047 38.8021 19.5687 38.2488 19.5687H35.2304C34.6268 19.5687 34.1237 20.0886 34.174 20.709C34.2076 21.0444 34.2076 21.3797 34.2076 21.7319C34.2076 28.5231 28.7075 34.0231 21.9163 34.0231C19.6023 34.0231 17.4392 33.3859 15.5946 32.2792C13.9681 31.3066 12.5763 29.9484 11.5702 28.3554C10.3461 26.4438 9.64184 24.1633 9.64184 21.7319C9.64184 20.9941 9.70891 20.2898 9.82629 19.5855C10.8492 13.8172 15.8797 9.44062 21.9331 9.44062C23.8279 9.44062 25.6389 9.8766 27.2487 10.6479C27.9026 10.9665 28.0536 11.8385 27.5505 12.3416L24.5154 15.3934L20.3401 19.5855L16.148 23.7776C15.8126 24.113 15.7455 24.6328 15.9803 25.0352C16.6678 26.2593 17.7074 27.2654 18.9818 27.8691C19.3843 28.0703 19.8706 27.9865 20.1892 27.6679L28.2715 19.5687L28.3889 19.4514L32.4636 15.3599L35.5323 12.2912C35.9012 11.9056 35.9515 11.3019 35.6161 10.8827C34.6436 9.65861 33.5033 8.55189 32.2457 7.62963C29.3783 5.53358 25.8569 4.29272 22.0337 4.29272C13.1632 4.29272 5.85217 10.9665 4.8293 19.552C4.74546 20.2227 4.71193 20.9102 4.71193 21.6145C4.71193 25.1526 5.76834 28.4392 7.57933 31.1725C7.84762 31.5917 7.79731 32.1451 7.44518 32.4972L4.79577 35.1466C4.76223 35.1801 4.74546 35.2137 4.71193 35.2472C1.76068 31.5414 0 26.8462 0 21.7319C0 9.72568 9.72568 0 21.7319 0C33.738 0 43.4637 9.72568 43.4637 21.7319Z"
                fill="#34FF67" />
              <path
                d="M57.1895 26.9928V12.6006H67.4881V14.6751H59.5233V18.6946H67.1547V20.8062H59.5233V24.8997H67.4881V26.9928H57.1895Z"
                fill="#34FF67" />
              <path
                d="M73.9158 25.2333C75.8051 25.2333 76.8424 24.3998 76.8424 22.6216V20.7137C76.8424 18.9356 75.8051 18.102 73.9158 18.102C71.8598 18.102 71.0077 19.0467 71.0077 21.6954C71.0077 24.3442 71.8598 25.2333 73.9158 25.2333ZM68.6924 21.6584C68.6924 18.2687 70.3224 16.1016 73.3231 16.1016C75.1754 16.1016 76.3979 16.824 76.9165 18.0835H77.0091V16.3238H79.1392V30.716H76.8424V25.3444H76.7683C76.3052 26.3076 75.1013 27.2152 73.249 27.2152C70.2483 27.1967 68.6924 25.0295 68.6924 21.6584Z"
                fill="#34FF67" />
              <path
                d="M81.3428 22.8988V16.3047H83.6581V22.4913C83.6581 24.3992 84.3805 25.1956 86.2328 25.1956C88.0851 25.1956 89.0297 24.4177 89.0297 22.3246V16.3047H91.3451V26.9738H89.1964V24.8437H89.1038C88.5852 26.0662 87.4553 27.1776 85.3622 27.1776C82.5838 27.1961 81.3428 25.3438 81.3428 22.8988Z"
                fill="#34FF67" />
              <path
                d="M93.4941 26.9928V16.2495H95.8095V26.9928H93.4941ZM93.4941 14.9529L93.4756 12.582H95.7909V14.9529H93.4941Z"
                fill="#34FF67" />
              <path
                d="M103.089 25.2333C105.126 25.2333 105.997 24.2886 105.997 21.6769C105.997 19.0652 105.163 18.0835 103.089 18.0835C101.199 18.0835 100.162 18.917 100.162 20.6952V22.603C100.162 24.3812 101.199 25.2333 103.089 25.2333ZM97.8652 30.6975V16.3053H99.9768V18.0649H100.088C100.588 16.8239 101.811 16.083 103.644 16.083C106.645 16.083 108.312 18.2502 108.312 21.6398C108.312 25.0295 106.701 27.1782 103.793 27.1782C101.885 27.1782 100.699 26.2891 100.236 25.3074H100.162V30.679H97.8652V30.6975Z"
                fill="#34FF67" />
              <path
                d="M114.333 26.9928V12.6006H117.63L120.909 20.4913L122.168 23.9365H122.353L123.594 20.4913L126.817 12.6006H130.096V26.9928H127.799V18.4723L127.892 16.0829H127.744L126.836 18.4723L123.613 26.1222H120.816L117.574 18.4723L116.722 16.0829H116.519L116.648 18.4723V26.9928H114.333Z"
                fill="#34FF67" />
              <path
                d="M136.116 25.363C137.616 25.363 139.265 24.7702 139.265 22.6216V22.4364L135.875 22.955C134.653 23.1217 134.227 23.3995 134.227 24.196C134.227 25.011 134.764 25.363 136.116 25.363ZM131.967 24.3442C131.967 22.5845 133.263 21.6584 135.523 21.3435L139.265 20.7878V20.2136C139.265 18.6207 138.542 18.1576 136.857 18.1576C135.171 18.1576 134.486 18.6948 134.486 20.121V20.4359H132.245V20.2136C132.245 17.8242 134.115 16.1016 136.968 16.1016C139.82 16.1016 141.45 17.8983 141.45 20.51V26.993H139.302V25.3259H139.191C138.561 26.3447 137.338 27.2152 135.319 27.2152C133.449 27.1967 131.967 26.215 131.967 24.3442Z"
                fill="#34FF67" />
              <path
                d="M143.691 26.993V16.3239H145.822V18.3243H145.914C146.414 17.1759 147.544 16.1201 149.637 16.1201C152.416 16.1201 153.657 17.8798 153.657 20.3063V27.0115H151.341V20.8249C151.341 18.9171 150.749 18.1206 148.785 18.1206C146.822 18.1206 146.044 18.843 146.044 20.8434V27.0115H143.691V26.993Z"
                fill="#34FF67" />
              <path
                d="M159.491 25.363C160.991 25.363 162.64 24.7702 162.64 22.6216V22.4364L159.25 22.955C158.028 23.1217 157.602 23.3995 157.602 24.196C157.602 25.011 158.139 25.363 159.491 25.363ZM155.342 24.3442C155.342 22.5845 156.638 21.6584 158.898 21.3435L162.64 20.7878V20.2136C162.64 18.6207 161.917 18.1576 160.232 18.1576C158.546 18.1576 157.861 18.6948 157.861 20.121V20.4359H155.62V20.2136C155.62 17.8242 157.49 16.1016 160.343 16.1016C163.195 16.1016 164.825 17.8983 164.825 20.51V26.993H162.677V25.3259H162.566C161.936 26.3447 160.713 27.2152 158.694 27.2152C156.824 27.1967 155.342 26.215 155.342 24.3442Z"
                fill="#34FF67" />
              <path
                d="M171.845 24.0108C173.587 24.0108 174.754 23.1773 174.754 21.362V20.6952C174.754 18.917 173.587 18.0835 171.808 18.0835C169.808 18.0835 168.937 18.8615 168.937 21.0472C168.937 23.2328 169.826 23.9923 171.845 24.0108ZM166.604 21.0472C166.604 18.0465 168.252 16.1016 171.271 16.1016C172.994 16.1016 174.328 16.824 174.828 18.0835H174.92V16.3238H177.05V26.2335C177.05 29.4009 175.198 30.8827 172.086 30.8827C168.974 30.8827 167.159 29.438 167.159 26.8633H169.456C169.456 28.3266 169.993 28.8267 172.142 28.8267C174.29 28.8267 174.735 28.234 174.735 26.2521V24.1219H174.642C174.142 25.1592 172.901 26.0113 171.16 26.0113C168.234 25.9742 166.604 24.0478 166.604 21.0472Z"
                fill="#34FF67" />
              <path
                d="M180.978 20.6582H186.627C186.72 18.8244 185.719 18.065 183.904 18.065C181.867 18.0465 181.089 18.9911 180.978 20.6582ZM178.773 21.6399C178.773 18.3243 180.755 16.1016 183.923 16.1016C186.794 16.1016 188.813 17.8242 188.813 20.7508C188.813 21.3065 188.739 21.8807 188.683 22.2141H180.922C181.015 24.159 181.719 25.1592 183.941 25.1592C185.719 25.1592 186.405 24.5665 186.405 23.5848V23.4181H188.702V23.6033C188.702 25.789 186.794 27.2152 183.904 27.2152C180.44 27.1967 178.773 24.974 178.773 21.6399Z"
                fill="#34FF67" />
              <path
                d="M190.684 26.993V16.2497H192.814V17.9538H192.925C193.351 16.9721 194.333 16.1016 195.907 16.1016C198.148 16.1016 199 17.7316 199 19.732V20.4359H196.685V20.0099C196.685 18.6021 196.277 18.0835 194.925 18.0835C193.573 18.0835 193.017 18.6207 193.017 20.0284V26.993H190.684Z"
                fill="#34FF67" />
            </svg>
          </a>
          <span>Subscribe Our Newsletter</span>
          <div class="sub_email">
            <form action="" method="post">
              <!-- SECURITY FIX: Add CSRF token to form -->
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
              <input
                type="email"
                name="email"
                id="email"
                placeholder="Enter Email Address" />
              <button type="submit" class="btn-submit">
                <svg
                  width="28"
                  height="28"
                  viewBox="0 0 28 28"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M17.2204 13.9998H7.97111C7.97111 13.6789 7.90461 13.3581 7.77278 13.0571L4.99961 6.78278C4.11294 4.77611 6.23394 2.76711 8.18928 3.75995L24.2671 11.9196C25.9704 12.7829 25.9704 15.2166 24.2671 16.0799L8.19044 24.2396C6.23394 25.2324 4.11294 23.2223 4.99961 21.2168L7.77044 14.9424C7.9014 14.6454 7.96895 14.3244 7.96878 13.9998"
                    stroke="#34FF67"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg>
              </button>
            </form>
          </div>
        </div>
        <div class="info custom-width">
          <span class="title">COMPANY INFO</span>
          <ul>
            <li><a href="/">HOME</a></li>
            <li><a href="">HOW IT WORK</a></li>
            <li><a href="">MARKETPLACE</a></li>
            <li><a href="">FEATURES</a></li>
            <li><a href="">TESTIMONIALS</a></li>
          </ul>
        </div>
        <div class="info custom-width">
          <span class="title">QUICK LINKS</span>
          <ul>
            <li><a href="">MARKETPLACE</a></li>
            <li><a href="">LOGIN</a></li>
            <li><a href="">REGISTER</a></li>
            <li><a href="">DASHBOARD</a></li>
          </ul>
        </div>
        <div class="info custom-width-2">
          <span class="title">CONTACT</span>
          <div class="icon-list">
            <svg
              width="20"
              height="20"
              viewBox="0 0 20 20"
              fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M17.5 3.75H2.5C2.16848 3.75 1.85054 3.8817 1.61612 4.11612C1.3817 4.35054 1.25 4.66848 1.25 5V15C1.25 15.3315 1.3817 15.6495 1.61612 15.8839C1.85054 16.1183 2.16848 16.25 2.5 16.25H17.5C17.8315 16.25 18.1495 16.1183 18.3839 15.8839C18.6183 15.6495 18.75 15.3315 18.75 15V5C18.75 4.66848 18.6183 4.35054 18.3839 4.11612C18.1495 3.8817 17.8315 3.75 17.5 3.75ZM16.125 5L10 9.2375L3.875 5H16.125ZM2.5 15V5.56875L9.64375 10.5125C9.74837 10.5851 9.87267 10.624 10 10.624C10.1273 10.624 10.2516 10.5851 10.3562 10.5125L17.5 5.56875V15H2.5Z"
                fill="#34FF67" />
            </svg>
            <a href="#">info@gmail.com</a>
          </div>
          <div class="icon-list">
            <svg
              width="20"
              height="20"
              viewBox="0 0 20 20"
              fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M4.64202 6.57296C4.40389 5.00171 5.51264 3.58796 7.20639 3.06921C7.50712 2.97717 7.83164 3.00332 8.11375 3.14234C8.39586 3.28137 8.6143 3.52278 8.72452 3.81734L9.26764 5.26734C9.35496 5.50058 9.37062 5.75459 9.3126 5.99679C9.25459 6.239 9.12554 6.45835 8.94202 6.62671L7.32639 8.10859C7.24656 8.18168 7.18708 8.27425 7.15377 8.37723C7.12047 8.48022 7.11448 8.59009 7.13639 8.69609L7.15077 8.76109L7.19077 8.92421C7.22639 9.06171 7.28014 9.25546 7.35577 9.48671C7.50577 9.94609 7.74514 10.5636 8.10139 11.1805C8.45764 11.7973 8.87264 12.3136 9.19514 12.673C9.36325 12.8599 9.5388 13.0401 9.72139 13.213L9.77139 13.2592C9.8522 13.3308 9.95017 13.3802 10.0558 13.4027C10.1613 13.4251 10.2709 13.4198 10.3739 13.3873L12.4651 12.7292C12.7027 12.6545 12.9572 12.6525 13.196 12.7235C13.4347 12.7944 13.6469 12.935 13.8051 13.1273L14.7945 14.3286C15.207 14.8286 15.1583 15.5636 14.6839 16.0055C13.3876 17.2136 11.6051 17.4617 10.3651 16.4642C8.84559 15.238 7.56432 13.7429 6.58514 12.0536C5.59878 10.3648 4.93956 8.50591 4.64202 6.57296ZM8.44577 8.77796L9.78702 7.54796C10.1541 7.21123 10.4122 6.77253 10.5282 6.28813C10.6442 5.80372 10.6129 5.2957 10.4383 4.82921L9.89452 3.37921C9.67269 2.78679 9.23327 2.30127 8.66585 2.02163C8.09843 1.74198 7.44571 1.68926 6.84077 1.87421C4.73764 2.51859 3.04889 4.40421 3.40639 6.75984C3.72731 8.84852 4.43911 10.858 5.50452 12.683C6.56064 14.5047 7.94255 16.1169 9.58139 17.4392C11.4408 18.933 13.9245 18.4236 15.5364 16.9205C15.9979 16.4907 16.2779 15.9011 16.3194 15.2719C16.3609 14.6427 16.1606 14.0214 15.7595 13.5348L14.7701 12.3336C14.4535 11.9488 14.0292 11.6675 13.5516 11.5256C13.0739 11.3837 12.5648 11.3878 12.0895 11.5373L10.3539 12.0836C10.2762 12.0037 10.2001 11.9222 10.1258 11.8392C9.76894 11.4447 9.45335 11.0147 9.18389 10.5561C8.92128 10.0933 8.70662 9.60497 8.54327 9.09859C8.50857 8.9926 8.47607 8.88591 8.44577 8.77859"
                fill="#34FF67" />
            </svg>
            <a href="#">+92 3046787889</a>
          </div>
          <div class="icon-list">
            <svg
              width="20"
              height="20"
              viewBox="0 0 20 20"
              fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M5.33325 3.96627C6.57518 2.74918 8.24725 2.07138 9.98611 2.08016C11.725 2.08894 13.3901 2.7836 14.6197 4.01317C15.8493 5.24275 16.5439 6.90789 16.5527 8.64674C16.5615 10.3856 15.8837 12.0577 14.6666 13.2996L11.1782 16.7879C10.8657 17.1004 10.4419 17.2759 9.99991 17.2759C9.55797 17.2759 9.13413 17.1004 8.82158 16.7879L5.33325 13.2996C4.09565 12.0619 3.40039 10.3832 3.40039 8.63294C3.40039 6.88263 4.09565 5.20399 5.33325 3.96627Z"
                stroke="#34FF67"
                stroke-width="1.5"
                stroke-linejoin="round" />
              <path
                d="M10 11.1328C11.3807 11.1328 12.5 10.0135 12.5 8.63281C12.5 7.2521 11.3807 6.13281 10 6.13281C8.61929 6.13281 7.5 7.2521 7.5 8.63281C7.5 10.0135 8.61929 11.1328 10 11.1328Z"
                stroke="#34FF67"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round" />
            </svg>
            <span>Bank sqaure market model town</span>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- bottom footer -->
  <section class="footer-bottom">
    <div class="container">
      <div class="terms-section">
        <!-- copyright -->
        <div>
          <span>COPYRIGHT ALL RIGHT RESERVED</span>
        </div>
        <!-- links -->
        <div>
          <ul>
            <li><a href="">TERMS OF USE</a></li>
            <li>-</li>
            <li><a href="">PRIVACY POLICY</a></li>
          </ul>
        </div>
        <!-- social links -->
        <div class="social-links">
          <a href="">
            <svg
              width="21"
              height="21"
              viewBox="0 0 21 21"
              fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M12.1711 2.46387C11.1198 2.46387 10.1114 2.88153 9.36798 3.62498C8.62453 4.36843 8.20686 5.37676 8.20686 6.42815V8.6353H6.08544C5.97915 8.6353 5.89258 8.72101 5.89258 8.82815V11.7424C5.89258 11.8487 5.97829 11.9353 6.08544 11.9353H8.20686V17.9139C8.20686 18.0202 8.29258 18.1067 8.39972 18.1067H11.314C11.4203 18.1067 11.5069 18.021 11.5069 17.9139V11.9353H13.6471C13.7354 11.9353 13.8126 11.8753 13.834 11.7896L14.5626 8.8753C14.5697 8.84686 14.5703 8.81716 14.5643 8.78846C14.5583 8.75976 14.5458 8.73282 14.5277 8.70967C14.5097 8.68653 14.4867 8.66781 14.4603 8.65492C14.434 8.64203 14.405 8.63532 14.3757 8.6353H11.5069V6.42815C11.5069 6.34092 11.524 6.25454 11.5574 6.17394C11.5908 6.09335 11.6397 6.02012 11.7014 5.95843C11.7631 5.89675 11.8363 5.84782 11.9169 5.81443C11.9975 5.78105 12.0839 5.76387 12.1711 5.76387H14.3997C14.506 5.76387 14.5926 5.67815 14.5926 5.57101V2.65672C14.5926 2.55044 14.5069 2.46387 14.3997 2.46387H12.1711Z"
                fill="#34FF67" />
            </svg>
          </a>
          <a href="">
            <svg
              width="21"
              height="21"
              viewBox="0 0 21 21"
              fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M12.986 7.20022C12.329 7.19797 11.6781 7.32528 11.0704 7.57486C10.4627 7.82445 9.91013 8.19141 9.4444 8.65475C8.97866 9.1181 8.60887 9.66873 8.35616 10.2751C8.10345 10.8816 7.9728 11.5318 7.97168 12.1888V17.2288C7.97168 17.4334 8.05296 17.6296 8.19763 17.7743C8.3423 17.919 8.53851 18.0002 8.74311 18.0002H10.5431C10.7477 18.0002 10.9439 17.919 11.0886 17.7743C11.2333 17.6296 11.3145 17.4334 11.3145 17.2288V12.1888C11.3144 11.9551 11.3634 11.7241 11.4586 11.5107C11.5537 11.2972 11.6927 11.1063 11.8666 10.9502C12.0405 10.7941 12.2453 10.6764 12.4677 10.6048C12.6901 10.5332 12.9251 10.5092 13.1574 10.5345C13.574 10.587 13.9568 10.7905 14.2333 11.1065C14.5098 11.4225 14.6607 11.8289 14.6574 12.2488V17.2288C14.6574 17.4334 14.7387 17.6296 14.8833 17.7743C15.028 17.919 15.2242 18.0002 15.4288 18.0002H17.2288C17.4334 18.0002 17.6296 17.919 17.7743 17.7743C17.919 17.6296 18.0003 17.4334 18.0003 17.2288V12.1888C17.9991 11.5318 17.8685 10.8816 17.6158 10.2751C17.3631 9.66873 16.9933 9.1181 16.5275 8.65475C16.0618 8.19141 15.5093 7.82445 14.9016 7.57486C14.2939 7.32528 13.6429 7.19797 12.986 7.20022Z"
                fill="#34FF67" />
              <path
                d="M5.657 7.97168H3.34272C2.91667 7.97168 2.57129 8.31706 2.57129 8.74311V17.2288C2.57129 17.6549 2.91667 18.0003 3.34272 18.0003H5.657C6.08305 18.0003 6.42843 17.6549 6.42843 17.2288V8.74311C6.42843 8.31706 6.08305 7.97168 5.657 7.97168Z"
                fill="#34FF67" />
              <path
                d="M4.49986 6.42843C5.56498 6.42843 6.42843 5.56498 6.42843 4.49986C6.42843 3.43474 5.56498 2.57129 4.49986 2.57129C3.43474 2.57129 2.57129 3.43474 2.57129 4.49986C2.57129 5.56498 3.43474 6.42843 4.49986 6.42843Z"
                fill="#34FF67" />
            </svg>
          </a>
          <a href="">
            <svg
              width="21"
              height="21"
              viewBox="0 0 21 21"
              fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M12.8571 3H7.71429C5.11066 3 3 5.11066 3 7.71429V12.8571C3 15.4608 5.11066 17.5714 7.71429 17.5714H12.8571C15.4608 17.5714 17.5714 15.4608 17.5714 12.8571V7.71429C17.5714 5.11066 15.4608 3 12.8571 3Z"
                stroke="#34FF67"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round" />
              <path
                d="M10.2862 13.377C11.9932 13.377 13.377 11.9932 13.377 10.2862C13.377 8.57914 11.9932 7.19531 10.2862 7.19531C8.57914 7.19531 7.19531 8.57914 7.19531 10.2862C7.19531 11.9932 8.57914 13.377 10.2862 13.377Z"
                stroke="#34FF67"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round" />
              <path
                d="M14.4805 6.97372C14.9681 6.97372 15.3634 6.57845 15.3634 6.09086C15.3634 5.60328 14.9681 5.20801 14.4805 5.20801C13.9929 5.20801 13.5977 5.60328 13.5977 6.09086C13.5977 6.57845 13.9929 6.97372 14.4805 6.97372Z"
                fill="#34FF67" />
            </svg>
          </a>
          <a href="">
            <svg
              width="21"
              height="21"
              viewBox="0 0 21 21"
              fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M18.6941 5.33725C18.7438 5.26868 18.6701 5.17868 18.5913 5.20953C18.0261 5.42863 17.4358 5.57634 16.8341 5.64925C17.5026 5.24995 18.0208 4.6414 18.3084 3.91782C18.3375 3.8441 18.257 3.7781 18.1884 3.81668C17.5653 4.16039 16.8941 4.4081 16.1955 4.55125C16.1812 4.55414 16.1663 4.55329 16.1523 4.54879C16.1384 4.54429 16.1258 4.53628 16.1158 4.52553C15.5901 3.97086 14.8979 3.60266 14.1442 3.47674C13.3904 3.35083 12.6161 3.47406 11.9387 3.82775C11.2612 4.18144 10.7175 4.74633 10.39 5.4368C10.0624 6.12727 9.96891 6.90569 10.1235 7.65411C10.1263 7.66714 10.126 7.68062 10.1228 7.69354C10.1195 7.70646 10.1134 7.71846 10.1048 7.72863C10.0962 7.7388 10.0854 7.74687 10.0732 7.75223C10.061 7.75758 10.0477 7.76008 10.0344 7.75953C8.67793 7.67529 7.35298 7.31479 6.14082 6.70016C4.92865 6.08553 3.85484 5.22973 2.98526 4.18525C2.97658 4.17438 2.96534 4.16584 2.95254 4.16039C2.93974 4.15495 2.92579 4.15276 2.91194 4.15404C2.89809 4.15531 2.88477 4.16001 2.87319 4.1677C2.8616 4.17539 2.8521 4.18584 2.84555 4.1981C2.57492 4.71149 2.43369 5.28318 2.43412 5.86353C2.43302 6.44158 2.57488 7.01092 2.84705 7.52087C3.11923 8.03083 3.51328 8.46557 3.99412 8.78639C3.4847 8.77254 2.98458 8.64671 2.52926 8.41782C2.47098 8.38782 2.40069 8.42982 2.40326 8.49496C2.43747 9.26733 2.71768 10.0085 3.20298 10.6104C3.7186 11.2349 4.43408 11.6621 5.2284 11.8198C4.92245 11.9121 4.60509 11.9611 4.28555 11.9655C4.11178 11.9632 3.93832 11.9503 3.76612 11.927C3.70183 11.9184 3.64955 11.9784 3.67183 12.0384C3.91734 12.703 4.35752 13.2781 4.93491 13.6886C5.5123 14.0992 6.20006 14.3261 6.90841 14.3398C5.54068 15.4156 3.82325 15.9471 2.08698 15.8321C1.99612 15.8261 1.95412 15.947 2.03212 15.9932C3.56745 16.9043 5.32025 17.3841 7.10555 17.3818C8.42521 17.3955 9.73438 17.1461 10.9566 16.6483C12.1788 16.1504 13.2896 15.4139 14.224 14.482C15.1584 13.55 15.8978 12.4412 16.3989 11.2203C16.9 9.99944 17.1529 8.69094 17.1427 7.37125V6.95982C17.1427 6.94651 17.1458 6.93339 17.1517 6.92149C17.1577 6.90958 17.1663 6.89923 17.177 6.89125C17.7584 6.45294 18.2699 5.92898 18.6941 5.33725Z"
                fill="#34FF67" />
            </svg>
          </a>
        </div>
      </div>
    </div>
  </section>
</body>
<script type="module" src="<?= base_url() ?>assets/website/js/main.js"></script>
<script src="<?= base_url() ?>assets/website/js/testimonial.js"></script>
<script src="<?= base_url() ?>assets/website/js/market-place.js"></script>

</html>