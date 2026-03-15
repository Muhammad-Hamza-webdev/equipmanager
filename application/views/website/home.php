<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?=$pageData[0]['metaTittle'] ?></title>
  <link rel="icon" type="image/x-icon" href="<?= base_url() ?>assets/website/img/favicon.svg" />
  <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/style.css" />
  <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/header.css" />
  <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/footer.css" />
  <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/home.css" />
  <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/resopnsive.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
  <meta name="description" content="<?=$pageData[0]['metaDesc'] ?> ">
  <meta name="keywords" content="<?=$pageData[0]['metaKeywords'] ?>">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Link Swiper's CSS -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>

<body>
  <?php $this->load->view('components/websiteHeader'); ?>
  <!-- body section -->
  <section class="hero-section">
    <div class="container">
      <div class="inner-hero-section">
        <span class="slide">EQUIP MANAGER</span>
        <h1>
          Rent, Hire, or List Your Workforce And Equipment with Confidence
        </h1>
        <p>
          Lorem Ipsum is simply dummy text of the printing and typesetting
          industry. Lorem Ipsum has been the industry's standard
        </p>
        <div class="hero-btn">
          <div class="btns">
            <a href="#" class="btn-parrot-green">Browse Marketplace</a>
            <a href="#" class="btn-white-transparent">REGISTER YOUR COMPANY</a>
          </div>
          <div class="client">
            <img src="<?= base_url() ?>assets/website/img/clients.webp" alt="image" />
            <span>50K+ HAPPY CLIENTS</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- search -->
  <section class="search">
    <div class="container">
      <div class="inner-search">
        <span>Search Equipment</span>
        <form action="" method="post" class="search-main">
          <!-- SECURITY FIX: Add CSRF token to form -->
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
          <!-- Custom Select Element -->
          <div
            class="custom-select-element"
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
                    <li class="custom-select-option">
                      <span>Heavy Machinery</span>
                    </li>
                    <li class="custom-select-option">
                      <span>Heavy Machinery 1</span>
                    </li>
                    <li class="custom-select-option">
                      <span>Heavy Machinery 2</span>
                    </li>
                    <li class="custom-select-option">
                      <span>Heavy Machinery 3</span>
                    </li>
                    <li class="custom-select-option">
                      <span>Heavy Machinery 4</span>
                    </li>
                    <li class="custom-select-option">
                      <span>Heavy Machinery 5</span>
                    </li>
                    <li class="custom-select-option">
                      <span>Heavy Machinery 6</span>
                    </li>
                    <li class="custom-select-option">
                      <span>Heavy Machinery 7</span>
                    </li>
                    <li class="custom-select-option">
                      <span>Heavy Machinery 8</span>
                    </li>
                    <li class="custom-select-option">
                      <span>Heavy Machinery 9</span>
                    </li>
                    <li class="custom-select-option">
                      <span>Heavy Machinery 10</span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- Custom Select Element -->
          <!-- Custom Select Element -->
          <div
            class="custom-select-element"
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
            class="custom-select-element"
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
    </div>
  </section>

  <!-- how it works -->
  <section class="how-it-work">
    <div class="container">
      <div class="inner-how-it-works">
        <div class="how-img">
          <img
            src="<?= base_url() ?>assets/website/img/16fb6ac02ec32d408b1e2a37b4a78c241610b23b.webp"
            alt="image" />
        </div>
        <div class="how-works">
          <span class="sub-heading">HOW IT WORKS</span>
          <h2 class="text-h2">We Provide Cost Effective Solution For You</h2>
          <p class="text-para">
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ip sum has been the industry's standard Lorem
            Ipsum is simply dummy text of the printing and typesetting
            industry.
          </p>
          <!-- timeline -->
          <div class="timeline">
            <!-- timeline card start-->
            <div class="timeline-card">
              <img src="<?= base_url() ?>assets/website/img/register.svg" alt="Register" />
              <span>Register your company</span>
            </div>
            <!-- line -->
            <div class="timeline-line">
              <img src="<?= base_url() ?>assets/website/img/circle-line.svg" alt="line" />
            </div>
            <!-- timeline card end-->

            <!-- timeline card start-->
            <div class="timeline-card">
              <img src="<?= base_url() ?>assets/website/img/list.svg" alt="Register" />
              <span>List your tools, equipment, or skilled staff</span>
            </div>
            <!-- line -->
            <div class="timeline-line">
              <img src="<?= base_url() ?>assets/website/img/circle-line.svg" alt="line" />
            </div>
            <!-- timeline card end-->

            <!-- timeline card start-->
            <div class="timeline-card">
              <img src="<?= base_url() ?>assets/website/img/rent.svg" alt="Register" />
              <span>Rent or get hired through our secure platform</span>
            </div>
            <!-- line -->
            <div class="timeline-line">
              <img src="<?= base_url() ?>assets/website/img/circle-line.svg" alt="line" />
            </div>
            <!-- timeline card end-->

            <!-- timeline card start-->
            <div class="timeline-card">
              <img src="<?= base_url() ?>assets/website/img/track.svg" alt="Register" />
              <span>Track everything from your company dashboard</span>
            </div>
            <!-- timeline card end-->
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--  what's available -->
  <section class="available">
    <div class="container">
      <div class="inner-available">
        <h2 class="text-h2"> what's available</h2>
        <!-- tabs -->
        <div class="tabs">
          <button class="tab-btn active" data-tab="workforce">
            Workforce
          </button>
          <button class="tab-btn" data-tab="equipment">Equipment</button>
          <button class="tab-btn" data-tab="services">Services</button>
        </div>

        <!-- cards start-->
        <div class="tab-content active-tab" id="workforce">
          <div class="cards">
            <!-- single card -->
            <div class="single-card one-card">
              <svg
                width="40"
                height="40"
                viewBox="0 0 40 40"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <circle
                  data-figma-bg-blur-radius="22"
                  cx="20"
                  cy="20"
                  r="20"
                  fill="#34FF67" />
                <path
                  d="M25.0351 16.1111C25.0344 15.8073 24.9135 15.5162 24.6987 15.3015C24.4839 15.0867 24.1928 14.9658 23.8891 14.9651L17.4073 14.9651C17.2568 14.9651 17.1078 14.9947 16.9688 15.0523C16.8297 15.1099 16.7034 15.1943 16.597 15.3007C16.3821 15.5156 16.2613 15.8071 16.2613 16.1111C16.2613 16.415 16.3821 16.7065 16.597 16.9214C16.8119 17.1363 17.1034 17.257 17.4073 17.257H21.1227L15.3007 23.079C15.0858 23.2939 14.9651 23.5853 14.9651 23.8892C14.9651 24.1931 15.0858 24.4846 15.3007 24.6995C15.5156 24.9143 15.8071 25.0351 16.111 25.0351C16.4148 25.0351 16.7063 24.9143 16.9212 24.6995L22.7431 18.8775L22.7431 22.5929C22.7431 22.7434 22.7728 22.8924 22.8304 23.0314C22.888 23.1705 22.9724 23.2968 23.0788 23.4032C23.1852 23.5096 23.3115 23.594 23.4506 23.6516C23.5896 23.7092 23.7386 23.7389 23.8891 23.7389C24.0396 23.7389 24.1886 23.7092 24.3277 23.6516C24.4667 23.594 24.593 23.5096 24.6995 23.4032C24.8059 23.2968 24.8903 23.1705 24.9479 23.0314C25.0055 22.8924 25.0351 22.7434 25.0351 22.5929L25.0351 16.1111Z"
                  fill="#0F2F2C" />
                <defs>
                  <clipPath
                    id="bgblur_0_2218_3538_clip_path"
                    transform="translate(22 22)">
                    <circle cx="20" cy="20" r="20" />
                  </clipPath>
                </defs>
              </svg>
              <div class="card-info">
                <div>
                  <svg
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_2218_3549)">
                      <path
                        d="M11.6719 9.03516H13.0781C13.0781 11.2838 11.2488 13.1133 9 13.1133C6.75124 13.1133 4.92188 11.2838 4.92188 9.03516H6.32812C6.32812 10.5084 7.52673 11.707 9 11.707C10.4733 11.707 11.6719 10.5084 11.6719 9.03516ZM17.1028 8.92186L16.708 9.03516H16.5938V9.06798L14.4152 9.69324L14.3291 10.1093C14.1915 10.774 13.9296 11.4037 13.5507 11.9807L13.3132 12.3425L14.4256 14.2747L14.2747 14.4256L12.3425 13.3131L11.9807 13.5505C11.4037 13.9294 10.774 14.1913 10.1093 14.3289L9.68404 14.4171L9.10506 16.5938H8.89494L8.31596 14.4171L7.89066 14.3291C7.22585 14.1915 6.59633 13.9296 6.01913 13.5507L5.65741 13.3132L3.72519 14.4256L3.57426 14.2747L4.68677 12.3426L4.44933 11.9809C4.07043 11.4037 3.80855 10.7742 3.67094 10.1093L3.58484 9.69337L1.40625 9.06798V9.03516H1.29199L0.897171 8.92186L0.864624 9.03516H0V10.1273L2.39502 10.8148C2.54457 11.3593 2.76183 11.8824 3.04404 12.3775L1.81796 14.507L3.49297 16.182L5.62253 14.956C6.11485 15.2367 6.63478 15.453 7.17613 15.6025L7.81389 18H10.1861L10.8239 15.6025C11.3652 15.453 11.8851 15.2367 12.3775 14.956L14.507 16.182L16.182 14.507L14.956 12.3775C15.2382 11.8824 15.4554 11.3593 15.605 10.8148L18 10.1273V9.03516H17.1354L17.1028 8.92186ZM1.40625 7.62891H0C0 6.33746 0.709579 5.20876 1.75919 4.61165C1.53644 4.27725 1.40625 3.87625 1.40625 3.44531C1.40625 2.28214 2.35245 1.33594 3.51562 1.33594C4.6788 1.33594 5.625 2.28214 5.625 3.44531C5.625 3.89191 5.48506 4.30637 5.24734 4.64777C5.45265 4.77013 5.64505 4.91391 5.82152 5.07706C6.16965 4.6442 6.60429 4.28371 7.09895 4.02196C6.74931 3.59692 6.53906 3.05296 6.53906 2.46094C6.53906 1.10399 7.64305 0 9 0C10.3569 0 11.4609 1.10399 11.4609 2.46094C11.4609 3.05296 11.2507 3.59692 10.901 4.02196C11.3957 4.28371 11.8304 4.6442 12.1786 5.07706C12.3551 4.91391 12.5475 4.77013 12.7528 4.64777C12.5149 4.30637 12.375 3.89191 12.375 3.44531C12.375 2.28214 13.3212 1.33594 14.4844 1.33594C15.6476 1.33594 16.5938 2.28214 16.5938 3.44531C16.5938 3.87625 16.4636 4.27725 16.2408 4.61165C17.2904 5.20876 18 6.33746 18 7.62891H16.5938C16.5938 6.49168 15.6686 5.56636 14.5312 5.56636C13.873 5.56636 13.2698 5.87315 12.8842 6.38622C13.01 6.77815 13.0781 7.19577 13.0781 7.62891H11.6719C11.6719 6.15564 10.4733 4.95703 9 4.95703C7.52673 4.95703 6.32812 6.15564 6.32812 7.62891H4.92188C4.92188 7.19577 4.98999 6.77815 5.11578 6.38622C4.73016 5.87315 4.12701 5.5665 3.4688 5.5665C2.33144 5.56636 1.40625 6.49168 1.40625 7.62891ZM13.7812 3.44531C13.7812 3.83299 14.0967 4.14844 14.4844 4.14844C14.8721 4.14844 15.1875 3.83299 15.1875 3.44531C15.1875 3.05763 14.8721 2.74219 14.4844 2.74219C14.0967 2.74219 13.7812 3.05763 13.7812 3.44531ZM7.94531 2.46094C7.94531 3.04253 8.41841 3.51562 9 3.51562C9.58159 3.51562 10.0547 3.04253 10.0547 2.46094C10.0547 1.87935 9.58159 1.40625 9 1.40625C8.41841 1.40625 7.94531 1.87935 7.94531 2.46094ZM2.8125 3.44531C2.8125 3.83299 3.12794 4.14844 3.51562 4.14844C3.90331 4.14844 4.21875 3.83299 4.21875 3.44531C4.21875 3.05763 3.90331 2.74219 3.51562 2.74219C3.12794 2.74219 2.8125 3.05763 2.8125 3.44531Z"
                        fill="white" />
                    </g>
                    <defs>
                      <clipPath id="clip0_2218_3549">
                        <rect width="18" height="18" fill="white" />
                      </clipPath>
                    </defs>
                  </svg>
                </div>
                <h3 class="text-h3">Available Workforce</h3>
                <span>Electrician in Karachi</span>
                <div class="price-location">
                  <!-- price -->
                  <div>
                    <div>
                      <svg
                        width="17"
                        height="17"
                        viewBox="0 0 17 17"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M7.23342 16.875C7.233 16.875 7.23249 16.875 7.23197 16.875C6.70391 16.8746 6.20736 16.6686 5.8341 16.2947L0.576731 11.0298C-0.192244 10.2594 -0.192244 9.00584 0.576731 8.23552L7.66374 1.13492C8.39409 0.40313 9.36586 0 10.4 0H14.8963C15.9866 0 16.8738 0.887009 16.8738 1.97754V6.46006C16.8738 7.49343 16.4711 8.46479 15.74 9.19504L8.63098 16.2967C8.25751 16.6696 7.76117 16.875 7.23342 16.875ZM10.4 1.31836C9.71852 1.31836 9.07819 1.58399 8.59689 2.06622L1.50978 9.16682C1.25342 9.42369 1.25342 9.84145 1.50978 10.0983L6.76715 15.3632C6.89147 15.4877 7.05688 15.5565 7.233 15.5566H7.23352C7.40944 15.5566 7.57485 15.4881 7.69927 15.3639L14.8083 8.26241C15.2901 7.7812 15.5555 7.14098 15.5555 6.46006V1.97754C15.5555 1.61406 15.2598 1.31836 14.8963 1.31836H10.4ZM12.0947 6.69067C11.0042 6.69067 10.1171 5.80367 10.1171 4.71313C10.1171 3.6226 11.0042 2.7356 12.0947 2.7356C13.1851 2.7356 14.0722 3.6226 14.0722 4.71313C14.0722 5.80367 13.1851 6.69067 12.0947 6.69067ZM12.0947 4.05396C11.7312 4.05396 11.4355 4.34966 11.4355 4.71313C11.4355 5.07661 11.7312 5.37231 12.0947 5.37231C12.4582 5.37231 12.7538 5.07661 12.7538 4.71313C12.7538 4.34966 12.4582 4.05396 12.0947 4.05396Z"
                          fill="#34FF67" />
                      </svg>
                      <span>Price</span>
                    </div>
                    <span>$200.00</span>
                  </div>
                  <div class="line"></div>
                  <!-- location -->
                  <div>
                    <div>
                      <svg
                        width="17"
                        height="17"
                        viewBox="0 0 17 17"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M7.23342 16.875C7.233 16.875 7.23249 16.875 7.23197 16.875C6.70391 16.8746 6.20736 16.6686 5.8341 16.2947L0.576731 11.0298C-0.192244 10.2594 -0.192244 9.00584 0.576731 8.23552L7.66374 1.13492C8.39409 0.40313 9.36586 0 10.4 0H14.8963C15.9866 0 16.8738 0.887009 16.8738 1.97754V6.46006C16.8738 7.49343 16.4711 8.46479 15.74 9.19504L8.63098 16.2967C8.25751 16.6696 7.76117 16.875 7.23342 16.875ZM10.4 1.31836C9.71852 1.31836 9.07819 1.58399 8.59689 2.06622L1.50978 9.16682C1.25342 9.42369 1.25342 9.84145 1.50978 10.0983L6.76715 15.3632C6.89147 15.4877 7.05688 15.5565 7.233 15.5566H7.23352C7.40944 15.5566 7.57485 15.4881 7.69927 15.3639L14.8083 8.26241C15.2901 7.7812 15.5555 7.14098 15.5555 6.46006V1.97754C15.5555 1.61406 15.2598 1.31836 14.8963 1.31836H10.4ZM12.0947 6.69067C11.0042 6.69067 10.1171 5.80367 10.1171 4.71313C10.1171 3.6226 11.0042 2.7356 12.0947 2.7356C13.1851 2.7356 14.0722 3.6226 14.0722 4.71313C14.0722 5.80367 13.1851 6.69067 12.0947 6.69067ZM12.0947 4.05396C11.7312 4.05396 11.4355 4.34966 11.4355 4.71313C11.4355 5.07661 11.7312 5.37231 12.0947 5.37231C12.4582 5.37231 12.7538 5.07661 12.7538 4.71313C12.7538 4.34966 12.4582 4.05396 12.0947 4.05396Z"
                          fill="#34FF67" />
                      </svg>
                      <span>Location</span>
                    </div>
                    <span>New York, USA</span>
                  </div>
                </div>
              </div>
            </div>
            <!-- single card -->
            <div class="single-card two-card">
              <svg
                width="40"
                height="40"
                viewBox="0 0 40 40"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <circle
                  data-figma-bg-blur-radius="22"
                  cx="20"
                  cy="20"
                  r="20"
                  fill="#34FF67" />
                <path
                  d="M25.0351 16.1111C25.0344 15.8073 24.9135 15.5162 24.6987 15.3015C24.4839 15.0867 24.1928 14.9658 23.8891 14.9651L17.4073 14.9651C17.2568 14.9651 17.1078 14.9947 16.9688 15.0523C16.8297 15.1099 16.7034 15.1943 16.597 15.3007C16.3821 15.5156 16.2613 15.8071 16.2613 16.1111C16.2613 16.415 16.3821 16.7065 16.597 16.9214C16.8119 17.1363 17.1034 17.257 17.4073 17.257H21.1227L15.3007 23.079C15.0858 23.2939 14.9651 23.5853 14.9651 23.8892C14.9651 24.1931 15.0858 24.4846 15.3007 24.6995C15.5156 24.9143 15.8071 25.0351 16.111 25.0351C16.4148 25.0351 16.7063 24.9143 16.9212 24.6995L22.7431 18.8775L22.7431 22.5929C22.7431 22.7434 22.7728 22.8924 22.8304 23.0314C22.888 23.1705 22.9724 23.2968 23.0788 23.4032C23.1852 23.5096 23.3115 23.594 23.4506 23.6516C23.5896 23.7092 23.7386 23.7389 23.8891 23.7389C24.0396 23.7389 24.1886 23.7092 24.3277 23.6516C24.4667 23.594 24.593 23.5096 24.6995 23.4032C24.8059 23.2968 24.8903 23.1705 24.9479 23.0314C25.0055 22.8924 25.0351 22.7434 25.0351 22.5929L25.0351 16.1111Z"
                  fill="#0F2F2C" />
                <defs>
                  <clipPath
                    id="bgblur_0_2218_3538_clip_path"
                    transform="translate(22 22)">
                    <circle cx="20" cy="20" r="20" />
                  </clipPath>
                </defs>
              </svg>
              <div class="card-info">
                <div>
                  <svg
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M17.4375 13.6406H15.6094V3.9375C15.6094 3.70459 15.4204 3.51562 15.1875 3.51562H12.9375C12.7046 3.51562 12.5156 3.70459 12.5156 3.9375V10.5991C12.1371 10.3933 11.7103 10.2656 11.25 10.2656H11.1094V8.4375C11.1094 5.50635 10.1733 2.39062 8.4375 2.39062H3.9375C3.73645 2.39062 3.56287 2.53235 3.52332 2.72955L2.46609 8.01562H1.6875C0.834961 8.01562 0.140625 8.70941 0.140625 9.5625V12.375C0.140625 13.0945 0.636658 13.6953 1.30277 13.8676C1.4778 14.8552 2.33748 15.6094 3.375 15.6094C4.18092 15.6094 4.87422 15.1501 5.22922 14.4844H9.07972C9.56477 15.1627 10.3543 15.6094 11.25 15.6094C12.1457 15.6094 12.9352 15.1627 13.4203 14.4844H17.4375C17.6704 14.4844 17.8594 14.2954 17.8594 14.0625C17.8594 13.8296 17.6704 13.6406 17.4375 13.6406ZM10.2656 8.4375V10.2656H6.60938V3.23438H8.4375C9.29993 3.23438 10.2656 5.45966 10.2656 8.4375ZM4.28357 3.23438H5.76562V9.66893L4.23633 8.13922C4.15723 8.06012 4.04956 8.01562 3.9375 8.01562H3.32762L4.28357 3.23438ZM3.375 14.7656C2.67737 14.7656 2.10938 14.1976 2.10938 13.5C2.10938 12.8024 2.67737 12.2344 3.375 12.2344C4.07263 12.2344 4.64062 12.8024 4.64062 13.5C4.64062 14.1976 4.07263 14.7656 3.375 14.7656ZM5.47016 13.6406C5.47332 13.5932 5.48438 13.5481 5.48438 13.5C5.48438 12.3371 4.53845 11.3906 3.375 11.3906C2.39461 11.3906 1.57606 12.0658 1.3404 12.9731C1.13152 12.8511 0.984375 12.6339 0.984375 12.375V9.5625C0.984375 9.17468 1.29968 8.85938 1.6875 8.85938H3.76282L5.88867 10.9858C5.96777 11.0649 6.07544 11.1094 6.1875 11.1094H9.31181C8.86013 11.5881 8.57812 12.229 8.57812 12.9375C8.57812 13.1824 8.62193 13.4151 8.68394 13.6406H5.47016ZM11.25 14.7656C10.2415 14.7656 9.42188 13.9455 9.42188 12.9375C9.42188 11.9295 10.2415 11.1094 11.25 11.1094C12.2585 11.1094 13.0781 11.9295 13.0781 12.9375C13.0781 13.9455 12.2585 14.7656 11.25 14.7656ZM13.3594 11.3168V4.35938H14.7656V13.6406H13.8161C13.8781 13.4151 13.9219 13.1824 13.9219 12.9375C13.9219 12.3255 13.7068 11.7678 13.3594 11.3168Z"
                      fill="white" />
                    <path
                      d="M11.25 13.3594C11.483 13.3594 11.6719 13.1705 11.6719 12.9375C11.6719 12.7045 11.483 12.5156 11.25 12.5156C11.017 12.5156 10.8281 12.7045 10.8281 12.9375C10.8281 13.1705 11.017 13.3594 11.25 13.3594Z"
                      fill="white" />
                  </svg>
                </div>
                <h3 class="text-h3">Available Equipment</h3>
                <span>Concrete Mixer in Lahore </span>
                <div class="price-location">
                  <!-- price -->
                  <div>
                    <div>
                      <svg
                        width="17"
                        height="17"
                        viewBox="0 0 17 17"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M7.23342 16.875C7.233 16.875 7.23249 16.875 7.23197 16.875C6.70391 16.8746 6.20736 16.6686 5.8341 16.2947L0.576731 11.0298C-0.192244 10.2594 -0.192244 9.00584 0.576731 8.23552L7.66374 1.13492C8.39409 0.40313 9.36586 0 10.4 0H14.8963C15.9866 0 16.8738 0.887009 16.8738 1.97754V6.46006C16.8738 7.49343 16.4711 8.46479 15.74 9.19504L8.63098 16.2967C8.25751 16.6696 7.76117 16.875 7.23342 16.875ZM10.4 1.31836C9.71852 1.31836 9.07819 1.58399 8.59689 2.06622L1.50978 9.16682C1.25342 9.42369 1.25342 9.84145 1.50978 10.0983L6.76715 15.3632C6.89147 15.4877 7.05688 15.5565 7.233 15.5566H7.23352C7.40944 15.5566 7.57485 15.4881 7.69927 15.3639L14.8083 8.26241C15.2901 7.7812 15.5555 7.14098 15.5555 6.46006V1.97754C15.5555 1.61406 15.2598 1.31836 14.8963 1.31836H10.4ZM12.0947 6.69067C11.0042 6.69067 10.1171 5.80367 10.1171 4.71313C10.1171 3.6226 11.0042 2.7356 12.0947 2.7356C13.1851 2.7356 14.0722 3.6226 14.0722 4.71313C14.0722 5.80367 13.1851 6.69067 12.0947 6.69067ZM12.0947 4.05396C11.7312 4.05396 11.4355 4.34966 11.4355 4.71313C11.4355 5.07661 11.7312 5.37231 12.0947 5.37231C12.4582 5.37231 12.7538 5.07661 12.7538 4.71313C12.7538 4.34966 12.4582 4.05396 12.0947 4.05396Z"
                          fill="#34FF67" />
                      </svg>
                      <span>Price</span>
                    </div>
                    <span>$200.00</span>
                  </div>
                  <div class="line"></div>
                  <!-- location -->
                  <div>
                    <div>
                      <svg
                        width="17"
                        height="17"
                        viewBox="0 0 17 17"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M7.23342 16.875C7.233 16.875 7.23249 16.875 7.23197 16.875C6.70391 16.8746 6.20736 16.6686 5.8341 16.2947L0.576731 11.0298C-0.192244 10.2594 -0.192244 9.00584 0.576731 8.23552L7.66374 1.13492C8.39409 0.40313 9.36586 0 10.4 0H14.8963C15.9866 0 16.8738 0.887009 16.8738 1.97754V6.46006C16.8738 7.49343 16.4711 8.46479 15.74 9.19504L8.63098 16.2967C8.25751 16.6696 7.76117 16.875 7.23342 16.875ZM10.4 1.31836C9.71852 1.31836 9.07819 1.58399 8.59689 2.06622L1.50978 9.16682C1.25342 9.42369 1.25342 9.84145 1.50978 10.0983L6.76715 15.3632C6.89147 15.4877 7.05688 15.5565 7.233 15.5566H7.23352C7.40944 15.5566 7.57485 15.4881 7.69927 15.3639L14.8083 8.26241C15.2901 7.7812 15.5555 7.14098 15.5555 6.46006V1.97754C15.5555 1.61406 15.2598 1.31836 14.8963 1.31836H10.4ZM12.0947 6.69067C11.0042 6.69067 10.1171 5.80367 10.1171 4.71313C10.1171 3.6226 11.0042 2.7356 12.0947 2.7356C13.1851 2.7356 14.0722 3.6226 14.0722 4.71313C14.0722 5.80367 13.1851 6.69067 12.0947 6.69067ZM12.0947 4.05396C11.7312 4.05396 11.4355 4.34966 11.4355 4.71313C11.4355 5.07661 11.7312 5.37231 12.0947 5.37231C12.4582 5.37231 12.7538 5.07661 12.7538 4.71313C12.7538 4.34966 12.4582 4.05396 12.0947 4.05396Z"
                          fill="#34FF67" />
                      </svg>
                      <span>Location</span>
                    </div>
                    <span>New York, USA</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- cards end -->

        <!-- cards start-->
        <div class="tab-content" id="equipment">
          <div class="cards">
            <!-- single card -->
            <div class="single-card one-card">
              <svg
                width="40"
                height="40"
                viewBox="0 0 40 40"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <circle
                  data-figma-bg-blur-radius="22"
                  cx="20"
                  cy="20"
                  r="20"
                  fill="#34FF67" />
                <path
                  d="M25.0351 16.1111C25.0344 15.8073 24.9135 15.5162 24.6987 15.3015C24.4839 15.0867 24.1928 14.9658 23.8891 14.9651L17.4073 14.9651C17.2568 14.9651 17.1078 14.9947 16.9688 15.0523C16.8297 15.1099 16.7034 15.1943 16.597 15.3007C16.3821 15.5156 16.2613 15.8071 16.2613 16.1111C16.2613 16.415 16.3821 16.7065 16.597 16.9214C16.8119 17.1363 17.1034 17.257 17.4073 17.257H21.1227L15.3007 23.079C15.0858 23.2939 14.9651 23.5853 14.9651 23.8892C14.9651 24.1931 15.0858 24.4846 15.3007 24.6995C15.5156 24.9143 15.8071 25.0351 16.111 25.0351C16.4148 25.0351 16.7063 24.9143 16.9212 24.6995L22.7431 18.8775L22.7431 22.5929C22.7431 22.7434 22.7728 22.8924 22.8304 23.0314C22.888 23.1705 22.9724 23.2968 23.0788 23.4032C23.1852 23.5096 23.3115 23.594 23.4506 23.6516C23.5896 23.7092 23.7386 23.7389 23.8891 23.7389C24.0396 23.7389 24.1886 23.7092 24.3277 23.6516C24.4667 23.594 24.593 23.5096 24.6995 23.4032C24.8059 23.2968 24.8903 23.1705 24.9479 23.0314C25.0055 22.8924 25.0351 22.7434 25.0351 22.5929L25.0351 16.1111Z"
                  fill="#0F2F2C" />
                <defs>
                  <clipPath
                    id="bgblur_0_2218_3538_clip_path"
                    transform="translate(22 22)">
                    <circle cx="20" cy="20" r="20" />
                  </clipPath>
                </defs>
              </svg>
              <div class="card-info">
                <div>
                  <svg
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_2218_3549)">
                      <path
                        d="M11.6719 9.03516H13.0781C13.0781 11.2838 11.2488 13.1133 9 13.1133C6.75124 13.1133 4.92188 11.2838 4.92188 9.03516H6.32812C6.32812 10.5084 7.52673 11.707 9 11.707C10.4733 11.707 11.6719 10.5084 11.6719 9.03516ZM17.1028 8.92186L16.708 9.03516H16.5938V9.06798L14.4152 9.69324L14.3291 10.1093C14.1915 10.774 13.9296 11.4037 13.5507 11.9807L13.3132 12.3425L14.4256 14.2747L14.2747 14.4256L12.3425 13.3131L11.9807 13.5505C11.4037 13.9294 10.774 14.1913 10.1093 14.3289L9.68404 14.4171L9.10506 16.5938H8.89494L8.31596 14.4171L7.89066 14.3291C7.22585 14.1915 6.59633 13.9296 6.01913 13.5507L5.65741 13.3132L3.72519 14.4256L3.57426 14.2747L4.68677 12.3426L4.44933 11.9809C4.07043 11.4037 3.80855 10.7742 3.67094 10.1093L3.58484 9.69337L1.40625 9.06798V9.03516H1.29199L0.897171 8.92186L0.864624 9.03516H0V10.1273L2.39502 10.8148C2.54457 11.3593 2.76183 11.8824 3.04404 12.3775L1.81796 14.507L3.49297 16.182L5.62253 14.956C6.11485 15.2367 6.63478 15.453 7.17613 15.6025L7.81389 18H10.1861L10.8239 15.6025C11.3652 15.453 11.8851 15.2367 12.3775 14.956L14.507 16.182L16.182 14.507L14.956 12.3775C15.2382 11.8824 15.4554 11.3593 15.605 10.8148L18 10.1273V9.03516H17.1354L17.1028 8.92186ZM1.40625 7.62891H0C0 6.33746 0.709579 5.20876 1.75919 4.61165C1.53644 4.27725 1.40625 3.87625 1.40625 3.44531C1.40625 2.28214 2.35245 1.33594 3.51562 1.33594C4.6788 1.33594 5.625 2.28214 5.625 3.44531C5.625 3.89191 5.48506 4.30637 5.24734 4.64777C5.45265 4.77013 5.64505 4.91391 5.82152 5.07706C6.16965 4.6442 6.60429 4.28371 7.09895 4.02196C6.74931 3.59692 6.53906 3.05296 6.53906 2.46094C6.53906 1.10399 7.64305 0 9 0C10.3569 0 11.4609 1.10399 11.4609 2.46094C11.4609 3.05296 11.2507 3.59692 10.901 4.02196C11.3957 4.28371 11.8304 4.6442 12.1786 5.07706C12.3551 4.91391 12.5475 4.77013 12.7528 4.64777C12.5149 4.30637 12.375 3.89191 12.375 3.44531C12.375 2.28214 13.3212 1.33594 14.4844 1.33594C15.6476 1.33594 16.5938 2.28214 16.5938 3.44531C16.5938 3.87625 16.4636 4.27725 16.2408 4.61165C17.2904 5.20876 18 6.33746 18 7.62891H16.5938C16.5938 6.49168 15.6686 5.56636 14.5312 5.56636C13.873 5.56636 13.2698 5.87315 12.8842 6.38622C13.01 6.77815 13.0781 7.19577 13.0781 7.62891H11.6719C11.6719 6.15564 10.4733 4.95703 9 4.95703C7.52673 4.95703 6.32812 6.15564 6.32812 7.62891H4.92188C4.92188 7.19577 4.98999 6.77815 5.11578 6.38622C4.73016 5.87315 4.12701 5.5665 3.4688 5.5665C2.33144 5.56636 1.40625 6.49168 1.40625 7.62891ZM13.7812 3.44531C13.7812 3.83299 14.0967 4.14844 14.4844 4.14844C14.8721 4.14844 15.1875 3.83299 15.1875 3.44531C15.1875 3.05763 14.8721 2.74219 14.4844 2.74219C14.0967 2.74219 13.7812 3.05763 13.7812 3.44531ZM7.94531 2.46094C7.94531 3.04253 8.41841 3.51562 9 3.51562C9.58159 3.51562 10.0547 3.04253 10.0547 2.46094C10.0547 1.87935 9.58159 1.40625 9 1.40625C8.41841 1.40625 7.94531 1.87935 7.94531 2.46094ZM2.8125 3.44531C2.8125 3.83299 3.12794 4.14844 3.51562 4.14844C3.90331 4.14844 4.21875 3.83299 4.21875 3.44531C4.21875 3.05763 3.90331 2.74219 3.51562 2.74219C3.12794 2.74219 2.8125 3.05763 2.8125 3.44531Z"
                        fill="white" />
                    </g>
                    <defs>
                      <clipPath id="clip0_2218_3549">
                        <rect width="18" height="18" fill="white" />
                      </clipPath>
                    </defs>
                  </svg>
                </div>
                <h3 class="text-h3">Available Equipment</h3>
                <span>Electrician in Karachi</span>
                <div class="price-location">
                  <!-- price -->
                  <div>
                    <div>
                      <svg
                        width="17"
                        height="17"
                        viewBox="0 0 17 17"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M7.23342 16.875C7.233 16.875 7.23249 16.875 7.23197 16.875C6.70391 16.8746 6.20736 16.6686 5.8341 16.2947L0.576731 11.0298C-0.192244 10.2594 -0.192244 9.00584 0.576731 8.23552L7.66374 1.13492C8.39409 0.40313 9.36586 0 10.4 0H14.8963C15.9866 0 16.8738 0.887009 16.8738 1.97754V6.46006C16.8738 7.49343 16.4711 8.46479 15.74 9.19504L8.63098 16.2967C8.25751 16.6696 7.76117 16.875 7.23342 16.875ZM10.4 1.31836C9.71852 1.31836 9.07819 1.58399 8.59689 2.06622L1.50978 9.16682C1.25342 9.42369 1.25342 9.84145 1.50978 10.0983L6.76715 15.3632C6.89147 15.4877 7.05688 15.5565 7.233 15.5566H7.23352C7.40944 15.5566 7.57485 15.4881 7.69927 15.3639L14.8083 8.26241C15.2901 7.7812 15.5555 7.14098 15.5555 6.46006V1.97754C15.5555 1.61406 15.2598 1.31836 14.8963 1.31836H10.4ZM12.0947 6.69067C11.0042 6.69067 10.1171 5.80367 10.1171 4.71313C10.1171 3.6226 11.0042 2.7356 12.0947 2.7356C13.1851 2.7356 14.0722 3.6226 14.0722 4.71313C14.0722 5.80367 13.1851 6.69067 12.0947 6.69067ZM12.0947 4.05396C11.7312 4.05396 11.4355 4.34966 11.4355 4.71313C11.4355 5.07661 11.7312 5.37231 12.0947 5.37231C12.4582 5.37231 12.7538 5.07661 12.7538 4.71313C12.7538 4.34966 12.4582 4.05396 12.0947 4.05396Z"
                          fill="#34FF67" />
                      </svg>
                      <span>Price</span>
                    </div>
                    <span>$200.00</span>
                  </div>
                  <div class="line"></div>
                  <!-- location -->
                  <div>
                    <div>
                      <svg
                        width="17"
                        height="17"
                        viewBox="0 0 17 17"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M7.23342 16.875C7.233 16.875 7.23249 16.875 7.23197 16.875C6.70391 16.8746 6.20736 16.6686 5.8341 16.2947L0.576731 11.0298C-0.192244 10.2594 -0.192244 9.00584 0.576731 8.23552L7.66374 1.13492C8.39409 0.40313 9.36586 0 10.4 0H14.8963C15.9866 0 16.8738 0.887009 16.8738 1.97754V6.46006C16.8738 7.49343 16.4711 8.46479 15.74 9.19504L8.63098 16.2967C8.25751 16.6696 7.76117 16.875 7.23342 16.875ZM10.4 1.31836C9.71852 1.31836 9.07819 1.58399 8.59689 2.06622L1.50978 9.16682C1.25342 9.42369 1.25342 9.84145 1.50978 10.0983L6.76715 15.3632C6.89147 15.4877 7.05688 15.5565 7.233 15.5566H7.23352C7.40944 15.5566 7.57485 15.4881 7.69927 15.3639L14.8083 8.26241C15.2901 7.7812 15.5555 7.14098 15.5555 6.46006V1.97754C15.5555 1.61406 15.2598 1.31836 14.8963 1.31836H10.4ZM12.0947 6.69067C11.0042 6.69067 10.1171 5.80367 10.1171 4.71313C10.1171 3.6226 11.0042 2.7356 12.0947 2.7356C13.1851 2.7356 14.0722 3.6226 14.0722 4.71313C14.0722 5.80367 13.1851 6.69067 12.0947 6.69067ZM12.0947 4.05396C11.7312 4.05396 11.4355 4.34966 11.4355 4.71313C11.4355 5.07661 11.7312 5.37231 12.0947 5.37231C12.4582 5.37231 12.7538 5.07661 12.7538 4.71313C12.7538 4.34966 12.4582 4.05396 12.0947 4.05396Z"
                          fill="#34FF67" />
                      </svg>
                      <span>Location</span>
                    </div>
                    <span>New York, USA</span>
                  </div>
                </div>
              </div>
            </div>
            <!-- single card -->
            <div class="single-card two-card">
              <svg
                width="40"
                height="40"
                viewBox="0 0 40 40"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <circle
                  data-figma-bg-blur-radius="22"
                  cx="20"
                  cy="20"
                  r="20"
                  fill="#34FF67" />
                <path
                  d="M25.0351 16.1111C25.0344 15.8073 24.9135 15.5162 24.6987 15.3015C24.4839 15.0867 24.1928 14.9658 23.8891 14.9651L17.4073 14.9651C17.2568 14.9651 17.1078 14.9947 16.9688 15.0523C16.8297 15.1099 16.7034 15.1943 16.597 15.3007C16.3821 15.5156 16.2613 15.8071 16.2613 16.1111C16.2613 16.415 16.3821 16.7065 16.597 16.9214C16.8119 17.1363 17.1034 17.257 17.4073 17.257H21.1227L15.3007 23.079C15.0858 23.2939 14.9651 23.5853 14.9651 23.8892C14.9651 24.1931 15.0858 24.4846 15.3007 24.6995C15.5156 24.9143 15.8071 25.0351 16.111 25.0351C16.4148 25.0351 16.7063 24.9143 16.9212 24.6995L22.7431 18.8775L22.7431 22.5929C22.7431 22.7434 22.7728 22.8924 22.8304 23.0314C22.888 23.1705 22.9724 23.2968 23.0788 23.4032C23.1852 23.5096 23.3115 23.594 23.4506 23.6516C23.5896 23.7092 23.7386 23.7389 23.8891 23.7389C24.0396 23.7389 24.1886 23.7092 24.3277 23.6516C24.4667 23.594 24.593 23.5096 24.6995 23.4032C24.8059 23.2968 24.8903 23.1705 24.9479 23.0314C25.0055 22.8924 25.0351 22.7434 25.0351 22.5929L25.0351 16.1111Z"
                  fill="#0F2F2C" />
                <defs>
                  <clipPath
                    id="bgblur_0_2218_3538_clip_path"
                    transform="translate(22 22)">
                    <circle cx="20" cy="20" r="20" />
                  </clipPath>
                </defs>
              </svg>
              <div class="card-info">
                <div>
                  <svg
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M17.4375 13.6406H15.6094V3.9375C15.6094 3.70459 15.4204 3.51562 15.1875 3.51562H12.9375C12.7046 3.51562 12.5156 3.70459 12.5156 3.9375V10.5991C12.1371 10.3933 11.7103 10.2656 11.25 10.2656H11.1094V8.4375C11.1094 5.50635 10.1733 2.39062 8.4375 2.39062H3.9375C3.73645 2.39062 3.56287 2.53235 3.52332 2.72955L2.46609 8.01562H1.6875C0.834961 8.01562 0.140625 8.70941 0.140625 9.5625V12.375C0.140625 13.0945 0.636658 13.6953 1.30277 13.8676C1.4778 14.8552 2.33748 15.6094 3.375 15.6094C4.18092 15.6094 4.87422 15.1501 5.22922 14.4844H9.07972C9.56477 15.1627 10.3543 15.6094 11.25 15.6094C12.1457 15.6094 12.9352 15.1627 13.4203 14.4844H17.4375C17.6704 14.4844 17.8594 14.2954 17.8594 14.0625C17.8594 13.8296 17.6704 13.6406 17.4375 13.6406ZM10.2656 8.4375V10.2656H6.60938V3.23438H8.4375C9.29993 3.23438 10.2656 5.45966 10.2656 8.4375ZM4.28357 3.23438H5.76562V9.66893L4.23633 8.13922C4.15723 8.06012 4.04956 8.01562 3.9375 8.01562H3.32762L4.28357 3.23438ZM3.375 14.7656C2.67737 14.7656 2.10938 14.1976 2.10938 13.5C2.10938 12.8024 2.67737 12.2344 3.375 12.2344C4.07263 12.2344 4.64062 12.8024 4.64062 13.5C4.64062 14.1976 4.07263 14.7656 3.375 14.7656ZM5.47016 13.6406C5.47332 13.5932 5.48438 13.5481 5.48438 13.5C5.48438 12.3371 4.53845 11.3906 3.375 11.3906C2.39461 11.3906 1.57606 12.0658 1.3404 12.9731C1.13152 12.8511 0.984375 12.6339 0.984375 12.375V9.5625C0.984375 9.17468 1.29968 8.85938 1.6875 8.85938H3.76282L5.88867 10.9858C5.96777 11.0649 6.07544 11.1094 6.1875 11.1094H9.31181C8.86013 11.5881 8.57812 12.229 8.57812 12.9375C8.57812 13.1824 8.62193 13.4151 8.68394 13.6406H5.47016ZM11.25 14.7656C10.2415 14.7656 9.42188 13.9455 9.42188 12.9375C9.42188 11.9295 10.2415 11.1094 11.25 11.1094C12.2585 11.1094 13.0781 11.9295 13.0781 12.9375C13.0781 13.9455 12.2585 14.7656 11.25 14.7656ZM13.3594 11.3168V4.35938H14.7656V13.6406H13.8161C13.8781 13.4151 13.9219 13.1824 13.9219 12.9375C13.9219 12.3255 13.7068 11.7678 13.3594 11.3168Z"
                      fill="white" />
                    <path
                      d="M11.25 13.3594C11.483 13.3594 11.6719 13.1705 11.6719 12.9375C11.6719 12.7045 11.483 12.5156 11.25 12.5156C11.017 12.5156 10.8281 12.7045 10.8281 12.9375C10.8281 13.1705 11.017 13.3594 11.25 13.3594Z"
                      fill="white" />
                  </svg>
                </div>
                <h3 class="text-h3">Available Services</h3>
                <span>Concrete Mixer in Lahore </span>
                <div class="price-location">
                  <!-- price -->
                  <div>
                    <div>
                      <svg
                        width="17"
                        height="17"
                        viewBox="0 0 17 17"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M7.23342 16.875C7.233 16.875 7.23249 16.875 7.23197 16.875C6.70391 16.8746 6.20736 16.6686 5.8341 16.2947L0.576731 11.0298C-0.192244 10.2594 -0.192244 9.00584 0.576731 8.23552L7.66374 1.13492C8.39409 0.40313 9.36586 0 10.4 0H14.8963C15.9866 0 16.8738 0.887009 16.8738 1.97754V6.46006C16.8738 7.49343 16.4711 8.46479 15.74 9.19504L8.63098 16.2967C8.25751 16.6696 7.76117 16.875 7.23342 16.875ZM10.4 1.31836C9.71852 1.31836 9.07819 1.58399 8.59689 2.06622L1.50978 9.16682C1.25342 9.42369 1.25342 9.84145 1.50978 10.0983L6.76715 15.3632C6.89147 15.4877 7.05688 15.5565 7.233 15.5566H7.23352C7.40944 15.5566 7.57485 15.4881 7.69927 15.3639L14.8083 8.26241C15.2901 7.7812 15.5555 7.14098 15.5555 6.46006V1.97754C15.5555 1.61406 15.2598 1.31836 14.8963 1.31836H10.4ZM12.0947 6.69067C11.0042 6.69067 10.1171 5.80367 10.1171 4.71313C10.1171 3.6226 11.0042 2.7356 12.0947 2.7356C13.1851 2.7356 14.0722 3.6226 14.0722 4.71313C14.0722 5.80367 13.1851 6.69067 12.0947 6.69067ZM12.0947 4.05396C11.7312 4.05396 11.4355 4.34966 11.4355 4.71313C11.4355 5.07661 11.7312 5.37231 12.0947 5.37231C12.4582 5.37231 12.7538 5.07661 12.7538 4.71313C12.7538 4.34966 12.4582 4.05396 12.0947 4.05396Z"
                          fill="#34FF67" />
                      </svg>
                      <span>Price</span>
                    </div>
                    <span>$200.00</span>
                  </div>
                  <div class="line"></div>
                  <!-- location -->
                  <div>
                    <div>
                      <svg
                        width="17"
                        height="17"
                        viewBox="0 0 17 17"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M7.23342 16.875C7.233 16.875 7.23249 16.875 7.23197 16.875C6.70391 16.8746 6.20736 16.6686 5.8341 16.2947L0.576731 11.0298C-0.192244 10.2594 -0.192244 9.00584 0.576731 8.23552L7.66374 1.13492C8.39409 0.40313 9.36586 0 10.4 0H14.8963C15.9866 0 16.8738 0.887009 16.8738 1.97754V6.46006C16.8738 7.49343 16.4711 8.46479 15.74 9.19504L8.63098 16.2967C8.25751 16.6696 7.76117 16.875 7.23342 16.875ZM10.4 1.31836C9.71852 1.31836 9.07819 1.58399 8.59689 2.06622L1.50978 9.16682C1.25342 9.42369 1.25342 9.84145 1.50978 10.0983L6.76715 15.3632C6.89147 15.4877 7.05688 15.5565 7.233 15.5566H7.23352C7.40944 15.5566 7.57485 15.4881 7.69927 15.3639L14.8083 8.26241C15.2901 7.7812 15.5555 7.14098 15.5555 6.46006V1.97754C15.5555 1.61406 15.2598 1.31836 14.8963 1.31836H10.4ZM12.0947 6.69067C11.0042 6.69067 10.1171 5.80367 10.1171 4.71313C10.1171 3.6226 11.0042 2.7356 12.0947 2.7356C13.1851 2.7356 14.0722 3.6226 14.0722 4.71313C14.0722 5.80367 13.1851 6.69067 12.0947 6.69067ZM12.0947 4.05396C11.7312 4.05396 11.4355 4.34966 11.4355 4.71313C11.4355 5.07661 11.7312 5.37231 12.0947 5.37231C12.4582 5.37231 12.7538 5.07661 12.7538 4.71313C12.7538 4.34966 12.4582 4.05396 12.0947 4.05396Z"
                          fill="#34FF67" />
                      </svg>
                      <span>Location</span>
                    </div>
                    <span>New York, USA</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- cards end -->

        <!-- cards start-->
        <div class="tab-content" id="services">
          <div class="cards">
            <!-- single card -->
            <div class="single-card one-card">
              <svg
                width="40"
                height="40"
                viewBox="0 0 40 40"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <circle
                  data-figma-bg-blur-radius="22"
                  cx="20"
                  cy="20"
                  r="20"
                  fill="#34FF67" />
                <path
                  d="M25.0351 16.1111C25.0344 15.8073 24.9135 15.5162 24.6987 15.3015C24.4839 15.0867 24.1928 14.9658 23.8891 14.9651L17.4073 14.9651C17.2568 14.9651 17.1078 14.9947 16.9688 15.0523C16.8297 15.1099 16.7034 15.1943 16.597 15.3007C16.3821 15.5156 16.2613 15.8071 16.2613 16.1111C16.2613 16.415 16.3821 16.7065 16.597 16.9214C16.8119 17.1363 17.1034 17.257 17.4073 17.257H21.1227L15.3007 23.079C15.0858 23.2939 14.9651 23.5853 14.9651 23.8892C14.9651 24.1931 15.0858 24.4846 15.3007 24.6995C15.5156 24.9143 15.8071 25.0351 16.111 25.0351C16.4148 25.0351 16.7063 24.9143 16.9212 24.6995L22.7431 18.8775L22.7431 22.5929C22.7431 22.7434 22.7728 22.8924 22.8304 23.0314C22.888 23.1705 22.9724 23.2968 23.0788 23.4032C23.1852 23.5096 23.3115 23.594 23.4506 23.6516C23.5896 23.7092 23.7386 23.7389 23.8891 23.7389C24.0396 23.7389 24.1886 23.7092 24.3277 23.6516C24.4667 23.594 24.593 23.5096 24.6995 23.4032C24.8059 23.2968 24.8903 23.1705 24.9479 23.0314C25.0055 22.8924 25.0351 22.7434 25.0351 22.5929L25.0351 16.1111Z"
                  fill="#0F2F2C" />
                <defs>
                  <clipPath
                    id="bgblur_0_2218_3538_clip_path"
                    transform="translate(22 22)">
                    <circle cx="20" cy="20" r="20" />
                  </clipPath>
                </defs>
              </svg>
              <div class="card-info">
                <div>
                  <svg
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_2218_3549)">
                      <path
                        d="M11.6719 9.03516H13.0781C13.0781 11.2838 11.2488 13.1133 9 13.1133C6.75124 13.1133 4.92188 11.2838 4.92188 9.03516H6.32812C6.32812 10.5084 7.52673 11.707 9 11.707C10.4733 11.707 11.6719 10.5084 11.6719 9.03516ZM17.1028 8.92186L16.708 9.03516H16.5938V9.06798L14.4152 9.69324L14.3291 10.1093C14.1915 10.774 13.9296 11.4037 13.5507 11.9807L13.3132 12.3425L14.4256 14.2747L14.2747 14.4256L12.3425 13.3131L11.9807 13.5505C11.4037 13.9294 10.774 14.1913 10.1093 14.3289L9.68404 14.4171L9.10506 16.5938H8.89494L8.31596 14.4171L7.89066 14.3291C7.22585 14.1915 6.59633 13.9296 6.01913 13.5507L5.65741 13.3132L3.72519 14.4256L3.57426 14.2747L4.68677 12.3426L4.44933 11.9809C4.07043 11.4037 3.80855 10.7742 3.67094 10.1093L3.58484 9.69337L1.40625 9.06798V9.03516H1.29199L0.897171 8.92186L0.864624 9.03516H0V10.1273L2.39502 10.8148C2.54457 11.3593 2.76183 11.8824 3.04404 12.3775L1.81796 14.507L3.49297 16.182L5.62253 14.956C6.11485 15.2367 6.63478 15.453 7.17613 15.6025L7.81389 18H10.1861L10.8239 15.6025C11.3652 15.453 11.8851 15.2367 12.3775 14.956L14.507 16.182L16.182 14.507L14.956 12.3775C15.2382 11.8824 15.4554 11.3593 15.605 10.8148L18 10.1273V9.03516H17.1354L17.1028 8.92186ZM1.40625 7.62891H0C0 6.33746 0.709579 5.20876 1.75919 4.61165C1.53644 4.27725 1.40625 3.87625 1.40625 3.44531C1.40625 2.28214 2.35245 1.33594 3.51562 1.33594C4.6788 1.33594 5.625 2.28214 5.625 3.44531C5.625 3.89191 5.48506 4.30637 5.24734 4.64777C5.45265 4.77013 5.64505 4.91391 5.82152 5.07706C6.16965 4.6442 6.60429 4.28371 7.09895 4.02196C6.74931 3.59692 6.53906 3.05296 6.53906 2.46094C6.53906 1.10399 7.64305 0 9 0C10.3569 0 11.4609 1.10399 11.4609 2.46094C11.4609 3.05296 11.2507 3.59692 10.901 4.02196C11.3957 4.28371 11.8304 4.6442 12.1786 5.07706C12.3551 4.91391 12.5475 4.77013 12.7528 4.64777C12.5149 4.30637 12.375 3.89191 12.375 3.44531C12.375 2.28214 13.3212 1.33594 14.4844 1.33594C15.6476 1.33594 16.5938 2.28214 16.5938 3.44531C16.5938 3.87625 16.4636 4.27725 16.2408 4.61165C17.2904 5.20876 18 6.33746 18 7.62891H16.5938C16.5938 6.49168 15.6686 5.56636 14.5312 5.56636C13.873 5.56636 13.2698 5.87315 12.8842 6.38622C13.01 6.77815 13.0781 7.19577 13.0781 7.62891H11.6719C11.6719 6.15564 10.4733 4.95703 9 4.95703C7.52673 4.95703 6.32812 6.15564 6.32812 7.62891H4.92188C4.92188 7.19577 4.98999 6.77815 5.11578 6.38622C4.73016 5.87315 4.12701 5.5665 3.4688 5.5665C2.33144 5.56636 1.40625 6.49168 1.40625 7.62891ZM13.7812 3.44531C13.7812 3.83299 14.0967 4.14844 14.4844 4.14844C14.8721 4.14844 15.1875 3.83299 15.1875 3.44531C15.1875 3.05763 14.8721 2.74219 14.4844 2.74219C14.0967 2.74219 13.7812 3.05763 13.7812 3.44531ZM7.94531 2.46094C7.94531 3.04253 8.41841 3.51562 9 3.51562C9.58159 3.51562 10.0547 3.04253 10.0547 2.46094C10.0547 1.87935 9.58159 1.40625 9 1.40625C8.41841 1.40625 7.94531 1.87935 7.94531 2.46094ZM2.8125 3.44531C2.8125 3.83299 3.12794 4.14844 3.51562 4.14844C3.90331 4.14844 4.21875 3.83299 4.21875 3.44531C4.21875 3.05763 3.90331 2.74219 3.51562 2.74219C3.12794 2.74219 2.8125 3.05763 2.8125 3.44531Z"
                        fill="white" />
                    </g>
                    <defs>
                      <clipPath id="clip0_2218_3549">
                        <rect width="18" height="18" fill="white" />
                      </clipPath>
                    </defs>
                  </svg>
                </div>
                <h3 class="text-h3">Available Services</h3>
                <span>Electrician in Karachi</span>
                <div class="price-location">
                  <!-- price -->
                  <div>
                    <div>
                      <svg
                        width="17"
                        height="17"
                        viewBox="0 0 17 17"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M7.23342 16.875C7.233 16.875 7.23249 16.875 7.23197 16.875C6.70391 16.8746 6.20736 16.6686 5.8341 16.2947L0.576731 11.0298C-0.192244 10.2594 -0.192244 9.00584 0.576731 8.23552L7.66374 1.13492C8.39409 0.40313 9.36586 0 10.4 0H14.8963C15.9866 0 16.8738 0.887009 16.8738 1.97754V6.46006C16.8738 7.49343 16.4711 8.46479 15.74 9.19504L8.63098 16.2967C8.25751 16.6696 7.76117 16.875 7.23342 16.875ZM10.4 1.31836C9.71852 1.31836 9.07819 1.58399 8.59689 2.06622L1.50978 9.16682C1.25342 9.42369 1.25342 9.84145 1.50978 10.0983L6.76715 15.3632C6.89147 15.4877 7.05688 15.5565 7.233 15.5566H7.23352C7.40944 15.5566 7.57485 15.4881 7.69927 15.3639L14.8083 8.26241C15.2901 7.7812 15.5555 7.14098 15.5555 6.46006V1.97754C15.5555 1.61406 15.2598 1.31836 14.8963 1.31836H10.4ZM12.0947 6.69067C11.0042 6.69067 10.1171 5.80367 10.1171 4.71313C10.1171 3.6226 11.0042 2.7356 12.0947 2.7356C13.1851 2.7356 14.0722 3.6226 14.0722 4.71313C14.0722 5.80367 13.1851 6.69067 12.0947 6.69067ZM12.0947 4.05396C11.7312 4.05396 11.4355 4.34966 11.4355 4.71313C11.4355 5.07661 11.7312 5.37231 12.0947 5.37231C12.4582 5.37231 12.7538 5.07661 12.7538 4.71313C12.7538 4.34966 12.4582 4.05396 12.0947 4.05396Z"
                          fill="#34FF67" />
                      </svg>
                      <span>Price</span>
                    </div>
                    <span>$200.00</span>
                  </div>
                  <div class="line"></div>
                  <!-- location -->
                  <div>
                    <div>
                      <svg
                        width="17"
                        height="17"
                        viewBox="0 0 17 17"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M7.23342 16.875C7.233 16.875 7.23249 16.875 7.23197 16.875C6.70391 16.8746 6.20736 16.6686 5.8341 16.2947L0.576731 11.0298C-0.192244 10.2594 -0.192244 9.00584 0.576731 8.23552L7.66374 1.13492C8.39409 0.40313 9.36586 0 10.4 0H14.8963C15.9866 0 16.8738 0.887009 16.8738 1.97754V6.46006C16.8738 7.49343 16.4711 8.46479 15.74 9.19504L8.63098 16.2967C8.25751 16.6696 7.76117 16.875 7.23342 16.875ZM10.4 1.31836C9.71852 1.31836 9.07819 1.58399 8.59689 2.06622L1.50978 9.16682C1.25342 9.42369 1.25342 9.84145 1.50978 10.0983L6.76715 15.3632C6.89147 15.4877 7.05688 15.5565 7.233 15.5566H7.23352C7.40944 15.5566 7.57485 15.4881 7.69927 15.3639L14.8083 8.26241C15.2901 7.7812 15.5555 7.14098 15.5555 6.46006V1.97754C15.5555 1.61406 15.2598 1.31836 14.8963 1.31836H10.4ZM12.0947 6.69067C11.0042 6.69067 10.1171 5.80367 10.1171 4.71313C10.1171 3.6226 11.0042 2.7356 12.0947 2.7356C13.1851 2.7356 14.0722 3.6226 14.0722 4.71313C14.0722 5.80367 13.1851 6.69067 12.0947 6.69067ZM12.0947 4.05396C11.7312 4.05396 11.4355 4.34966 11.4355 4.71313C11.4355 5.07661 11.7312 5.37231 12.0947 5.37231C12.4582 5.37231 12.7538 5.07661 12.7538 4.71313C12.7538 4.34966 12.4582 4.05396 12.0947 4.05396Z"
                          fill="#34FF67" />
                      </svg>
                      <span>Location</span>
                    </div>
                    <span>New York, USA</span>
                  </div>
                </div>
              </div>
            </div>
            <!-- single card -->
            <div class="single-card two-card">
              <svg
                width="40"
                height="40"
                viewBox="0 0 40 40"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <circle
                  data-figma-bg-blur-radius="22"
                  cx="20"
                  cy="20"
                  r="20"
                  fill="#34FF67" />
                <path
                  d="M25.0351 16.1111C25.0344 15.8073 24.9135 15.5162 24.6987 15.3015C24.4839 15.0867 24.1928 14.9658 23.8891 14.9651L17.4073 14.9651C17.2568 14.9651 17.1078 14.9947 16.9688 15.0523C16.8297 15.1099 16.7034 15.1943 16.597 15.3007C16.3821 15.5156 16.2613 15.8071 16.2613 16.1111C16.2613 16.415 16.3821 16.7065 16.597 16.9214C16.8119 17.1363 17.1034 17.257 17.4073 17.257H21.1227L15.3007 23.079C15.0858 23.2939 14.9651 23.5853 14.9651 23.8892C14.9651 24.1931 15.0858 24.4846 15.3007 24.6995C15.5156 24.9143 15.8071 25.0351 16.111 25.0351C16.4148 25.0351 16.7063 24.9143 16.9212 24.6995L22.7431 18.8775L22.7431 22.5929C22.7431 22.7434 22.7728 22.8924 22.8304 23.0314C22.888 23.1705 22.9724 23.2968 23.0788 23.4032C23.1852 23.5096 23.3115 23.594 23.4506 23.6516C23.5896 23.7092 23.7386 23.7389 23.8891 23.7389C24.0396 23.7389 24.1886 23.7092 24.3277 23.6516C24.4667 23.594 24.593 23.5096 24.6995 23.4032C24.8059 23.2968 24.8903 23.1705 24.9479 23.0314C25.0055 22.8924 25.0351 22.7434 25.0351 22.5929L25.0351 16.1111Z"
                  fill="#0F2F2C" />
                <defs>
                  <clipPath
                    id="bgblur_0_2218_3538_clip_path"
                    transform="translate(22 22)">
                    <circle cx="20" cy="20" r="20" />
                  </clipPath>
                </defs>
              </svg>
              <div class="card-info">
                <div>
                  <svg
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M17.4375 13.6406H15.6094V3.9375C15.6094 3.70459 15.4204 3.51562 15.1875 3.51562H12.9375C12.7046 3.51562 12.5156 3.70459 12.5156 3.9375V10.5991C12.1371 10.3933 11.7103 10.2656 11.25 10.2656H11.1094V8.4375C11.1094 5.50635 10.1733 2.39062 8.4375 2.39062H3.9375C3.73645 2.39062 3.56287 2.53235 3.52332 2.72955L2.46609 8.01562H1.6875C0.834961 8.01562 0.140625 8.70941 0.140625 9.5625V12.375C0.140625 13.0945 0.636658 13.6953 1.30277 13.8676C1.4778 14.8552 2.33748 15.6094 3.375 15.6094C4.18092 15.6094 4.87422 15.1501 5.22922 14.4844H9.07972C9.56477 15.1627 10.3543 15.6094 11.25 15.6094C12.1457 15.6094 12.9352 15.1627 13.4203 14.4844H17.4375C17.6704 14.4844 17.8594 14.2954 17.8594 14.0625C17.8594 13.8296 17.6704 13.6406 17.4375 13.6406ZM10.2656 8.4375V10.2656H6.60938V3.23438H8.4375C9.29993 3.23438 10.2656 5.45966 10.2656 8.4375ZM4.28357 3.23438H5.76562V9.66893L4.23633 8.13922C4.15723 8.06012 4.04956 8.01562 3.9375 8.01562H3.32762L4.28357 3.23438ZM3.375 14.7656C2.67737 14.7656 2.10938 14.1976 2.10938 13.5C2.10938 12.8024 2.67737 12.2344 3.375 12.2344C4.07263 12.2344 4.64062 12.8024 4.64062 13.5C4.64062 14.1976 4.07263 14.7656 3.375 14.7656ZM5.47016 13.6406C5.47332 13.5932 5.48438 13.5481 5.48438 13.5C5.48438 12.3371 4.53845 11.3906 3.375 11.3906C2.39461 11.3906 1.57606 12.0658 1.3404 12.9731C1.13152 12.8511 0.984375 12.6339 0.984375 12.375V9.5625C0.984375 9.17468 1.29968 8.85938 1.6875 8.85938H3.76282L5.88867 10.9858C5.96777 11.0649 6.07544 11.1094 6.1875 11.1094H9.31181C8.86013 11.5881 8.57812 12.229 8.57812 12.9375C8.57812 13.1824 8.62193 13.4151 8.68394 13.6406H5.47016ZM11.25 14.7656C10.2415 14.7656 9.42188 13.9455 9.42188 12.9375C9.42188 11.9295 10.2415 11.1094 11.25 11.1094C12.2585 11.1094 13.0781 11.9295 13.0781 12.9375C13.0781 13.9455 12.2585 14.7656 11.25 14.7656ZM13.3594 11.3168V4.35938H14.7656V13.6406H13.8161C13.8781 13.4151 13.9219 13.1824 13.9219 12.9375C13.9219 12.3255 13.7068 11.7678 13.3594 11.3168Z"
                      fill="white" />
                    <path
                      d="M11.25 13.3594C11.483 13.3594 11.6719 13.1705 11.6719 12.9375C11.6719 12.7045 11.483 12.5156 11.25 12.5156C11.017 12.5156 10.8281 12.7045 10.8281 12.9375C10.8281 13.1705 11.017 13.3594 11.25 13.3594Z"
                      fill="white" />
                  </svg>
                </div>
                <h3 class="text-h3">Available Workforce</h3>
                <span>Concrete Mixer in Lahore </span>
                <div class="price-location">
                  <!-- price -->
                  <div>
                    <div>
                      <svg
                        width="17"
                        height="17"
                        viewBox="0 0 17 17"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M7.23342 16.875C7.233 16.875 7.23249 16.875 7.23197 16.875C6.70391 16.8746 6.20736 16.6686 5.8341 16.2947L0.576731 11.0298C-0.192244 10.2594 -0.192244 9.00584 0.576731 8.23552L7.66374 1.13492C8.39409 0.40313 9.36586 0 10.4 0H14.8963C15.9866 0 16.8738 0.887009 16.8738 1.97754V6.46006C16.8738 7.49343 16.4711 8.46479 15.74 9.19504L8.63098 16.2967C8.25751 16.6696 7.76117 16.875 7.23342 16.875ZM10.4 1.31836C9.71852 1.31836 9.07819 1.58399 8.59689 2.06622L1.50978 9.16682C1.25342 9.42369 1.25342 9.84145 1.50978 10.0983L6.76715 15.3632C6.89147 15.4877 7.05688 15.5565 7.233 15.5566H7.23352C7.40944 15.5566 7.57485 15.4881 7.69927 15.3639L14.8083 8.26241C15.2901 7.7812 15.5555 7.14098 15.5555 6.46006V1.97754C15.5555 1.61406 15.2598 1.31836 14.8963 1.31836H10.4ZM12.0947 6.69067C11.0042 6.69067 10.1171 5.80367 10.1171 4.71313C10.1171 3.6226 11.0042 2.7356 12.0947 2.7356C13.1851 2.7356 14.0722 3.6226 14.0722 4.71313C14.0722 5.80367 13.1851 6.69067 12.0947 6.69067ZM12.0947 4.05396C11.7312 4.05396 11.4355 4.34966 11.4355 4.71313C11.4355 5.07661 11.7312 5.37231 12.0947 5.37231C12.4582 5.37231 12.7538 5.07661 12.7538 4.71313C12.7538 4.34966 12.4582 4.05396 12.0947 4.05396Z"
                          fill="#34FF67" />
                      </svg>
                      <span>Price</span>
                    </div>
                    <span>$200.00</span>
                  </div>
                  <div class="line"></div>
                  <!-- location -->
                  <div>
                    <div>
                      <svg
                        width="17"
                        height="17"
                        viewBox="0 0 17 17"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M7.23342 16.875C7.233 16.875 7.23249 16.875 7.23197 16.875C6.70391 16.8746 6.20736 16.6686 5.8341 16.2947L0.576731 11.0298C-0.192244 10.2594 -0.192244 9.00584 0.576731 8.23552L7.66374 1.13492C8.39409 0.40313 9.36586 0 10.4 0H14.8963C15.9866 0 16.8738 0.887009 16.8738 1.97754V6.46006C16.8738 7.49343 16.4711 8.46479 15.74 9.19504L8.63098 16.2967C8.25751 16.6696 7.76117 16.875 7.23342 16.875ZM10.4 1.31836C9.71852 1.31836 9.07819 1.58399 8.59689 2.06622L1.50978 9.16682C1.25342 9.42369 1.25342 9.84145 1.50978 10.0983L6.76715 15.3632C6.89147 15.4877 7.05688 15.5565 7.233 15.5566H7.23352C7.40944 15.5566 7.57485 15.4881 7.69927 15.3639L14.8083 8.26241C15.2901 7.7812 15.5555 7.14098 15.5555 6.46006V1.97754C15.5555 1.61406 15.2598 1.31836 14.8963 1.31836H10.4ZM12.0947 6.69067C11.0042 6.69067 10.1171 5.80367 10.1171 4.71313C10.1171 3.6226 11.0042 2.7356 12.0947 2.7356C13.1851 2.7356 14.0722 3.6226 14.0722 4.71313C14.0722 5.80367 13.1851 6.69067 12.0947 6.69067ZM12.0947 4.05396C11.7312 4.05396 11.4355 4.34966 11.4355 4.71313C11.4355 5.07661 11.7312 5.37231 12.0947 5.37231C12.4582 5.37231 12.7538 5.07661 12.7538 4.71313C12.7538 4.34966 12.4582 4.05396 12.0947 4.05396Z"
                          fill="#34FF67" />
                      </svg>
                      <span>Location</span>
                    </div>
                    <span>New York, USA</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- cards end -->

        <a href="#" class="btn-dark-green">VIEW ALL</a>
      </div>
    </div>
  </section>

  <!-- Key Features & Benefits -->
  <section class="features">
    <div class="container">
      <div class="inner-features">
        <span class="sub-heading">FEATURES AND BENEFITS</span>
        <h2 class="text-h2">Key Features & Benefits</h2>
        <div class="key-feature">
          <div class="box-area">
            <!-- single box start -->
            <div class="single-icon-box">
              <svg
                width="48"
                height="48"
                viewBox="0 0 48 48"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M16 29C17.1046 29 18 28.1046 18 27C18 25.8954 17.1046 25 16 25C14.8954 25 14 25.8954 14 27C14 28.1046 14.8954 29 16 29Z"
                  fill="#0F2F2C" />
                <path
                  d="M16 37C17.1046 37 18 36.1046 18 35C18 33.8954 17.1046 33 16 33C14.8954 33 14 33.8954 14 35C14 36.1046 14.8954 37 16 37Z"
                  fill="#0F2F2C" />
                <path
                  d="M24 29C25.1046 29 26 28.1046 26 27C26 25.8954 25.1046 25 24 25C22.8954 25 22 25.8954 22 27C22 28.1046 22.8954 29 24 29Z"
                  fill="#0F2F2C" />
                <path
                  d="M24 37C25.1046 37 26 36.1046 26 35C26 33.8954 25.1046 33 24 33C22.8954 33 22 33.8954 22 35C22 36.1046 22.8954 37 24 37Z"
                  fill="#0F2F2C" />
                <path
                  d="M32 29C33.1046 29 34 28.1046 34 27C34 25.8954 33.1046 25 32 25C30.8954 25 30 25.8954 30 27C30 28.1046 30.8954 29 32 29Z"
                  fill="#0F2F2C" />
                <path
                  d="M32 37C33.1046 37 34 36.1046 34 35C34 33.8954 33.1046 33 32 33C30.8954 33 30 33.8954 30 35C30 36.1046 30.8954 37 32 37Z"
                  fill="#0F2F2C" />
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M45.5 13V39C45.5 40.99 44.71 42.896 43.304 44.304C41.896 45.71 39.99 46.5 38 46.5H10C8.01 46.5 6.104 45.71 4.696 44.304C3.29 42.896 2.5 40.99 2.5 39V13C2.5 11.01 3.29 9.104 4.696 7.696C6.104 6.29 8.01 5.5 10 5.5H38C39.99 5.5 41.896 6.29 43.304 7.696C44.71 9.104 45.5 11.01 45.5 13ZM42.5 13C42.5 11.806 42.026 10.662 41.182 9.818C40.338 8.974 39.194 8.5 38 8.5H10C8.806 8.5 7.662 8.974 6.818 9.818C5.974 10.662 5.5 11.806 5.5 13V39C5.5 40.194 5.974 41.338 6.818 42.182C7.662 43.026 8.806 43.5 10 43.5H38C39.194 43.5 40.338 43.026 41.182 42.182C42.026 41.338 42.5 40.194 42.5 39V13Z"
                  fill="#0F2F2C" />
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M44 16.5C44.828 16.5 45.5 17.172 45.5 18C45.5 18.828 44.828 19.5 44 19.5H4C3.172 19.5 2.5 18.828 2.5 18C2.5 17.172 3.172 16.5 4 16.5H44Z"
                  fill="#0F2F2C" />
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M30.5 3C30.5 2.172 31.172 1.5 32 1.5C32.828 1.5 33.5 2.172 33.5 3V11C33.5 11.828 32.828 12.5 32 12.5C31.172 12.5 30.5 11.828 30.5 11V3Z"
                  fill="#0F2F2C" />
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M14.5 3C14.5 2.172 15.172 1.5 16 1.5C16.828 1.5 17.5 2.172 17.5 3V11C17.5 11.828 16.828 12.5 16 12.5C15.172 12.5 14.5 11.828 14.5 11V3Z"
                  fill="#0F2F2C" />
              </svg>
              <h3 class="text-h3 text-gray-black">
                Real-time availability & scheduling
              </h3>
              <p class="text-para">
                Lorem Ipsum is simply dummy text of the printing and
                typesetting industry. Lorem Ip sum has been the industry's
                standard Lorem Ipsum is simply dummy text of the printing and
                typesetting industry.
              </p>
            </div>
            <!-- single box end -->
            <!-- single box start -->
            <div class="single-icon-box">
              <svg
                width="48"
                height="48"
                viewBox="0 0 48 48"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_2869_75)">
                  <path
                    d="M32.6661 7.98046H27.9526C28.1194 5.90849 27.4137 3.77886 25.8323 2.1973C22.9708 -0.663949 18.3151 -0.663949 15.4537 2.1973L13.9909 3.66008L12.5281 2.1973C9.66666 -0.664137 5.01084 -0.664043 2.1495 2.19739C0.763406 3.58339 0 5.42643 0 7.38664C0 9.34686 0.763312 11.1898 2.1495 12.5759L5.69616 16.1226C4.52306 18.3287 3.90666 20.7919 3.90666 23.3144C3.90666 31.7696 10.7855 38.6483 19.2407 38.6483H21.5323L31.5255 47.9488V38.6483H32.6661C41.1213 38.6483 48 31.7695 48 23.3144C48 14.8593 41.1212 7.98046 32.6661 7.98046ZM4.13991 4.18771C5.02191 3.30571 6.18019 2.8648 7.33875 2.8648C8.49703 2.8648 9.65578 3.30589 10.5376 4.18771L13.9908 7.64089L17.444 4.18771C19.2079 2.42399 22.0777 2.42389 23.8417 4.1878C24.6962 5.04224 25.1667 6.17821 25.1667 7.38664C25.1667 8.59499 24.6962 9.73105 23.8417 10.5855L13.9909 20.4365L4.13991 10.5855C2.37609 8.82158 2.37609 5.95161 4.13991 4.18771ZM32.6661 35.8335H28.7106V41.4838L22.6396 35.8335H19.2407C12.3376 35.8335 6.72159 30.2175 6.72159 23.3144C6.72159 21.5482 7.09144 19.8184 7.79991 18.2262L13.991 24.4173L25.8323 12.5759C26.3704 12.0379 26.8071 11.4364 27.1428 10.7953H32.6662C39.5692 10.7953 45.1852 16.4113 45.1852 23.3144C45.1852 30.2175 39.5691 35.8335 32.6661 35.8335Z"
                    fill="#0F2F2C" />
                  <path
                    d="M18.2764 22.5139H21.2513V25.3289H18.2764V22.5139Z"
                    fill="#0F2F2C" />
                  <path
                    d="M24.8447 22.5139H27.8197V25.3289H24.8447V22.5139Z"
                    fill="#0F2F2C" />
                  <path
                    d="M31.4131 22.5139H34.3881V25.3289H31.4131V22.5139Z"
                    fill="#0F2F2C" />
                </g>
                <defs>
                  <clipPath id="clip0_2869_75">
                    <rect width="48" height="48" fill="white" />
                  </clipPath>
                </defs>
              </svg>
              <h3 class="text-h3 text-gray-black">
                Verified companies and reviews
              </h3>
              <p class="text-para">
                Lorem Ipsum is simply dummy text of the printing and
                typesetting industry. Lorem Ip sum has been the industry's
                standard Lorem Ipsum is simply dummy text of the printing and
                typesetting industry.
              </p>
            </div>
            <!-- single box end -->
            <!-- single box start -->
            <div class="single-icon-box">
              <svg
                width="48"
                height="48"
                viewBox="0 0 48 48"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M2.5 12C2.5 8.96244 4.96244 6.5 8 6.5H40C43.0376 6.5 45.5 8.96244 45.5 12V32C45.5 35.0376 43.0376 37.5 40 37.5H28.427L29.927 40.5H34C34.8284 40.5 35.5 41.1716 35.5 42C35.5 42.8284 34.8284 43.5 34 43.5H14C13.1716 43.5 12.5 42.8284 12.5 42C12.5 41.1716 13.1716 40.5 14 40.5H18.0729L19.5729 37.5H8C4.96244 37.5 2.5 35.0376 2.5 32V12ZM40 34.5H8C6.61928 34.5 5.5 33.3808 5.5 32V12C5.5 10.6193 6.61928 9.5 8 9.5H40C41.3808 9.5 42.5 10.6193 42.5 12V32C42.5 33.3808 41.3808 34.5 40 34.5Z"
                  fill="#0F2F2C" />
              </svg>
              <h3 class="text-h3 text-gray-black">
                Centralized dashboard for tracking
              </h3>
              <p class="text-para">
                Lorem Ipsum is simply dummy text of the printing and
                typesetting industry. Lorem Ip sum has been the industry's
                standard Lorem Ipsum is simply dummy text of the printing and
                typesetting industry.
              </p>
            </div>
            <!-- single box end -->
            <!-- single box start -->
            <div class="single-icon-box">
              <svg
                width="48"
                height="48"
                viewBox="0 0 48 48"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M47.9999 16.2711C47.9999 12.7358 46.6232 9.41209 44.1233 6.91225C41.6235 4.41241 38.2998 3.03564 34.7645 3.03564C31.2292 3.03564 27.9055 4.41241 25.4057 6.91225L23.9982 8.31967L22.588 6.90953C17.4275 1.74897 9.03081 1.74907 3.87035 6.90953C-1.29012 12.07 -1.29012 20.4667 3.87035 25.6272L5.28049 27.0373L5.2353 27.0825C4.41121 27.9065 3.95744 29.0021 3.95744 30.1674C3.95744 31.3326 4.41121 32.4282 5.23652 33.2535C6.06052 34.0775 7.15612 34.5313 8.32138 34.5313C8.52604 34.5313 8.72855 34.5172 8.92787 34.4897C9.08875 35.3111 9.48664 36.0947 10.1216 36.7298L10.1333 36.7414C10.956 37.5589 12.0474 38.009 13.2078 38.009C13.4125 38.009 13.615 37.9949 13.8143 37.9674C13.9752 38.7887 14.3731 39.5724 15.008 40.2075L15.0185 40.2178C15.8414 41.0361 16.9332 41.4866 18.0942 41.4866C18.298 41.4866 18.4996 41.4726 18.6981 41.4453C18.8628 42.2886 19.2737 43.0643 19.8958 43.6863C20.7198 44.5104 21.8154 44.9642 22.9806 44.9642C24.1459 44.9642 25.2415 44.5104 26.0655 43.6864L27.0836 42.6684C27.5466 42.2053 27.8835 41.6632 28.0944 41.0851C28.6684 41.3467 29.2879 41.4775 29.9075 41.4775C31.0249 41.4774 32.1428 41.0519 32.9938 40.2009C33.629 39.5657 34.027 38.7818 34.1878 37.9602C34.387 37.9877 34.5896 38.0017 34.7942 38.0017H34.7944C35.9599 38.0017 37.0557 37.5478 37.8802 36.7234C38.5154 36.0881 38.9135 35.3042 39.0742 34.4827C39.2735 34.5101 39.476 34.5242 39.6806 34.5242H39.6807C40.8462 34.5242 41.9421 34.0703 42.7662 33.2462L42.8025 33.2094C43.6037 32.3896 44.0444 31.309 44.0445 30.1607C44.0445 28.9953 43.5906 27.8996 42.7665 27.0756L42.7221 27.0311L44.1232 25.6301C46.6232 23.1301 47.9999 19.8064 47.9999 16.2711ZM27.3945 8.90104C29.3631 6.93241 31.9805 5.84824 34.7645 5.84824C37.5485 5.84824 40.166 6.93241 42.1346 8.90104C44.1033 10.8697 45.1874 13.4871 45.1874 16.2711C45.1874 19.0551 44.1033 21.6725 42.1346 23.641L40.7271 25.0485L28.6391 12.9606L23.8917 17.7081C23.5375 18.0623 23.0666 18.2573 22.5656 18.2573C22.0647 18.2573 21.5938 18.0622 21.2396 17.7081C20.8854 17.3539 20.6903 16.883 20.6903 16.3821C20.6903 15.8812 20.8854 15.4102 21.2396 15.0559L27.3945 8.90104ZM9.41754 31.2648C9.12475 31.5576 8.73549 31.7188 8.32147 31.7188C7.90746 31.7188 7.51819 31.5576 7.22409 31.2635C6.9313 30.9708 6.77004 30.5815 6.77004 30.1675C6.77004 29.7535 6.9313 29.3642 7.22409 29.0714L10.3554 25.9401C10.6481 25.6473 11.0374 25.4861 11.4514 25.4861C11.8654 25.4861 12.2547 25.6473 12.5488 25.9414C13.1474 26.54 13.1531 27.5106 12.5658 28.1162C12.5601 28.1219 12.5543 28.1275 12.5486 28.1332L9.41754 31.2648ZM14.3039 34.7424C14.0111 35.0351 13.6219 35.1964 13.2079 35.1964C12.7938 35.1964 12.4046 35.0351 12.1118 34.7424L12.1059 34.7364C11.5134 34.1389 11.5078 33.1753 12.089 32.5708L14.5377 30.1222C14.5431 30.1168 14.5484 30.1113 14.5537 30.1059C14.8445 29.8232 15.2271 29.6679 15.6335 29.6679C16.0475 29.6679 16.4368 29.8291 16.7309 30.1231C17.3298 30.722 17.3351 31.6933 16.747 32.299C16.7415 32.3043 16.7361 32.3096 16.7307 32.3151L14.3039 34.7424ZM19.1903 38.2199C18.8975 38.5127 18.5083 38.674 18.0942 38.674C17.6802 38.674 17.2909 38.5127 16.9982 38.2199L16.9926 38.2144C16.3994 37.6166 16.3941 36.6521 16.9762 36.0476L18.7197 34.3042C18.7251 34.2988 18.7304 34.2934 18.7358 34.2879C19.0266 34.0054 19.4091 33.85 19.8155 33.85C20.2295 33.85 20.6188 34.0113 20.9115 34.3041L20.9177 34.3102C21.5121 34.9098 21.5156 35.8781 20.928 36.482C20.9229 36.4871 20.9177 36.4922 20.9126 36.4972L19.1903 38.2199ZM25.0949 40.6795L24.0768 41.6975C23.784 41.9903 23.3948 42.1516 22.9807 42.1516C22.5667 42.1516 22.1775 41.9903 21.8834 41.6963C21.5906 41.4035 21.4293 41.0143 21.4293 40.6002C21.4293 40.1966 21.5825 39.8167 21.8614 39.5266L22.9016 38.4864C22.907 38.4809 22.9123 38.4755 22.9176 38.4701C23.2085 38.1874 23.591 38.0321 23.9974 38.0321C24.4114 38.0321 24.8007 38.1933 25.0934 38.4861L25.0993 38.492C25.6992 39.0967 25.6976 40.0766 25.0949 40.6795ZM35.4531 28.1258L33.4642 30.1146L35.9058 32.5563C36.4959 33.162 36.4911 34.1347 35.8911 34.7348C35.5981 35.0277 35.2087 35.189 34.7944 35.189C34.3801 35.189 33.9907 35.0276 33.6977 34.7346L31.2716 32.3084L29.2828 34.2972L31.0154 36.0299C31.6094 36.6352 31.6059 37.611 31.0042 38.2127C30.3996 38.8173 29.4161 38.8172 28.8115 38.2127L27.089 36.4902L27.0822 36.497L27.072 36.487C26.291 35.7108 25.2679 35.266 24.1735 35.2228C24.1306 34.1659 23.7067 33.1216 22.9014 32.3164L22.89 32.305C22.1088 31.5289 21.0858 31.084 19.9912 31.0409C19.9482 29.9837 19.524 28.939 18.7182 28.1332C17.9358 27.3508 16.9085 26.9022 15.8093 26.8589C15.7662 25.8018 15.342 24.7571 14.5361 23.9513C13.7121 23.1273 12.6165 22.6735 11.4512 22.6735C10.2859 22.6735 9.19038 23.1273 8.36638 23.9513L7.269 25.0486L5.85885 23.6385C1.79502 19.5747 1.79502 12.9622 5.85885 8.89832C9.92268 4.83449 16.535 4.8344 20.5989 8.89832L22.0091 10.3086L19.2505 13.0672C17.4227 14.895 17.4227 17.869 19.2505 19.6968C20.1359 20.5822 21.3131 21.0699 22.5653 21.0699C23.8175 21.0699 24.9947 20.5823 25.8801 19.6968L28.6387 16.9382L40.7267 29.0261L40.7331 29.0197L40.7776 29.0643C41.0705 29.3571 41.2318 29.7464 41.2318 30.1605C41.2318 30.5746 41.0705 30.964 40.7776 31.2569L40.7707 31.2638C40.4785 31.5527 40.0917 31.7115 39.6806 31.7115C39.2663 31.7115 38.8769 31.5501 38.5839 31.2572L35.4531 28.1258Z"
                  fill="#0F2F2C" />
              </svg>
              <h3 class="text-h3 text-gray-black">
                Secure contracts and bookings
              </h3>
              <p class="text-para">
                Lorem Ipsum is simply dummy text of the printing and
                typesetting industry. Lorem Ip sum has been the industry's
                standard Lorem Ipsum is simply dummy text of the printing and
                typesetting industry.
              </p>
            </div>
            <!-- single box end -->
          </div>
          <div class="img-area">
            <img
              src="<?= base_url() ?>assets/website/img/441a5e4f71245e172857574814944e65401bdec4.webp"
              alt="img" />
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- POPULAR CATEGORIES -->
  <section class="popular">
    <div class="container overflow-hide">
      <div class="inner-popular">
        <span class="sub-heading">POPULAR CATEGORIES</span>
        <h2 class="text-h2">Explore Popular Categories</h2>
        <div class="para-btn">
          <p class="text-para">
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ip sum has been the industry's standard Lorem
            Ipsum.
          </p>
          <a href="#" class="btn-dark-green">GET A QUOTE</a>
        </div>
        <!-- slider section -->
        <div class="bg-slider">
          <div class="swiper categorySwiper">
            <div class="swiper-wrapper">
              <?php
              if ($categories) {
                foreach ($categories as $cat) {
              ?>
                  <div class="swiper-slide">
                    <!-- single slide  start-->
                    <div class="single-slide-box">
                      <div>
                        <svg width="64" height="64" xmlns="http://www.w3.org/2000/svg">
                          <image href="<?= base_url('assets/uploads/superadmin/category/' . $cat['web_catIcon']) ?>" width="64" height="64" />
                        </svg>
                        <h3 class="text-h3"><?= $cat['web_catName'] ?></h3>
                        <p style="color: white;">
                          <?= $cat['web_catDesp'] ?>
                        </p>
                      </div>
                      <!-- btn -->
                      <a href="<?= $cat['slug'] ?>" class="single-box-btn">VIEW LISTINGS
                        <svg
                          width="22"
                          height="22"
                          viewBox="0 0 22 22"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M16.0351 7.1113C16.0344 6.80758 15.9135 6.51649 15.6987 6.30173C15.4839 6.08696 15.1928 5.966 14.8891 5.96532L8.40731 5.96532C8.25682 5.96532 8.1078 5.99496 7.96876 6.05255C7.82973 6.11014 7.70339 6.19455 7.59698 6.30097C7.38207 6.51588 7.26133 6.80737 7.26133 7.1113C7.26133 7.41524 7.38207 7.70672 7.59698 7.92164C7.81189 8.13655 8.10338 8.25729 8.40731 8.25729H12.1227L6.30072 14.0793C6.08584 14.2941 5.96512 14.5856 5.96512 14.8895C5.96512 15.1934 6.08584 15.4848 6.30072 15.6997C6.51561 15.9146 6.80706 16.0353 7.11095 16.0353C7.41484 16.0353 7.70629 15.9146 7.92118 15.6997L13.7431 9.87774L13.7431 13.5931C13.7431 13.7436 13.7728 13.8926 13.8304 14.0317C13.888 14.1707 13.9724 14.297 14.0788 14.4034C14.1852 14.5099 14.3115 14.5943 14.4506 14.6519C14.5896 14.7095 14.7386 14.7391 14.8891 14.7391C15.0396 14.7391 15.1886 14.7095 15.3277 14.6519C15.4667 14.5943 15.593 14.5099 15.6995 14.4034C15.8059 14.297 15.8903 14.1707 15.9479 14.0317C16.0055 13.8926 16.0351 13.7436 16.0351 13.5931L16.0351 7.1113Z"
                            fill="#34FF67" />
                        </svg>
                      </a>
                    </div>
                    <!-- single slide end -->
                  </div>
              <?php
                }
              }
              ?>
            </div>

            <!-- Navigation buttons -->
            <div class="swiper-button-next categorySwiper-next">
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
            <div class="swiper-button-prev categorySwiper-prev">
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
    </div>
  </section>

  <!-- Success Metrics -->
  <section class="success">
    <div class="container overflow-hide">
      <div class="inner-success">
        <div class="mertrics">
          <h2 class="text-h2">Success Metrics</h2>
          <!-- Success Metrics multi box -->
          <div class="success-boxs">
            <?php
            if ($stats) {
              foreach ($stats as $row) {
            ?>
                <!-- single box start-->
                <div class="success-single-box">
                  <svg width="32" height="32" xmlns="http://www.w3.org/2000/svg">
                    <image href="<?= base_url('assets/uploads/superadmin/success-metrics/' . $row['web_successIcon']) ?>" width="32" height="32" />
                  </svg>
                  <span><?= $row['web_successDes'] ?></span>
                  <p class="text-para"><?= $row['web_successName'] ?></p>
                </div>
                <!-- single box end-->
            <?php
              }
            }
            ?>
          </div>
        </div>
        <div class="company">
          <h2 class="text-h2">Our Company Partners</h2>

          <!-- Swiper -->
          <div dir="rtl" class="swiper company-swiper main-company-box">
            <div class="swiper-wrapper company-list">
              <?php
              if ($logos) {
                foreach ($logos as $row) {
              ?>
                  <div class="swiper-slide company-slide">
                    <svg width="120" height="60" xmlns="http://www.w3.org/2000/svg">
                      <image href="<?= base_url('assets/uploads/superadmin/partner/' . $row['web_companyIcon']) ?>" />
                    </svg>
                  </div>
              <?php
                }
              }
              ?>
            </div>
          </div>
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
            <?php
            if ($testimonials) {
              foreach ($testimonials as $row) {
            ?>
                <div class="swiper-slide">
                  <!-- testimoni single start -->
                  <div class="testimoni-single-card">
                    <div class="rating">
                      <?php
                      $rating = (int)($row['web_testimonialRating'] ?? 0);
                      $rating = max(0, min(5, $rating));

                      for ($i = 0; $i < $rating; $i++) {
                        echo '<i class="bi bi-star-fill text-warning"></i>'; // filled star
                      
                      ?>
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
                      <?php
                      }
                      ?>
                    </div>
                    <p class="text-para text-white fix-height">
                      <?= $row['web_testimonialDesp'] ?>
                    </p>
                    <div class="client-info">
                      <img
                        src="<?= base_url() ?>assets/uploads/superadmin/testimonial/<?= $row['web_testimonialImg']  ?>"
                        alt="client" />
                      <div>
                        <h4 class="text-h4"> <?= $row['web_testimonialName'] ?></h4>
                        <span> <?= $row['web_testimonialLocation'] ?></span>
                      </div>
                    </div>
                  </div>
                  <!-- testimoni single end -->
                </div>
            <?php
              }
            }
            ?>
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

  <!-- LATEST BLOGS -->
  <section class="blog">
    <div class="container">
      <div class="inner-blog">
        <div class="title">
          <div>
            <span class="sub-heading">LATEST BLOGS</span>
            <h2 class="text-h2">Articles & blog posts</h2>
          </div>
          <a href="#" class="btn-dark-green">VIEW ALL BLOGS</a>
        </div>

        <!-- all in one blogs -->
        <div class="all-blogs">
          <div class="single-blog">
            <img
              src="<?= base_url() ?>assets/website/img/a8fb0faf6cb005ea88c490e3bb75944c28387f6d.webp"
              alt="blog img" />
            <div>
              <span class="text-para">Manufacturing</span>
              <svg
                width="6"
                height="6"
                viewBox="0 0 6 6"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <circle cx="3" cy="3" r="3" fill="#1E1E1E" />
              </svg>

              <span class="text-para">Jan 18, 2025</span>
            </div>
            <h4 class="text-h4-blog text-gray-black">
              Top Manufacturing Trends Shaping Industry’s Future
            </h4>
            <p class="text-para">
              Lorem Ipsum is simply dummy text of the printing and typesetting
              industry. Lorem Ip sum has been the industry's standard Lorem
              Ipsum.
            </p>
          </div>
          <div class="multi-blog">
            <!-- multi-btn-single start -->
            <div class="multi-blog-list">
              <div>
                <div>
                  <span class="text-para">Manufacturing</span>
                  <svg
                    width="6"
                    height="6"
                    viewBox="0 0 6 6"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <circle cx="3" cy="3" r="3" fill="#1E1E1E" />
                  </svg>

                  <span class="text-para">Jan 18, 2025</span>
                </div>
                <h4 class="text-h4-blog text-gray-black">
                  5 Key Strategies for Efficient Industrial Operation
                </h4>
              </div>
              <div>
                <img
                  src="<?= base_url() ?>assets/website/img/50193dfd83f81eb22382fa2ba9a23ec1995409de.webp"
                  alt="blog img" />
              </div>
            </div>
            <!-- multi-btn-single end -->
            <!-- multi-btn-single start -->
            <div class="multi-blog-list">
              <div>
                <div>
                  <span class="text-para">INDUSTRY</span>
                  <svg
                    width="6"
                    height="6"
                    viewBox="0 0 6 6"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <circle cx="3" cy="3" r="3" fill="#1E1E1E" />
                  </svg>

                  <span class="text-para">Jan 18, 2025</span>
                </div>
                <h4 class="text-h4-blog text-gray-black">
                  Exploring the Future of Aerospace: What Lies Ahead?
                </h4>
              </div>
              <div>
                <img
                  src="<?= base_url() ?>assets/website/img/3eb0df2ad59770f6c9e0df37622b7ec8c3295330.webp"
                  alt="blog img" />
              </div>
            </div>
            <!-- multi-btn-single end -->
            <!-- multi-btn-single start -->
            <div class="multi-blog-list">
              <div>
                <div>
                  <span class="text-para">Manufacturing</span>
                  <svg
                    width="6"
                    height="6"
                    viewBox="0 0 6 6"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <circle cx="3" cy="3" r="3" fill="#1E1E1E" />
                  </svg>

                  <span class="text-para">Jan 18, 2025</span>
                </div>
                <h4 class="text-h4-blog text-gray-black">
                  Boosting Manufacturing Efficiency with Top Innovation
                </h4>
              </div>
              <div>
                <img
                  src="<?= base_url() ?>assets/website/img/cadab4537c0fef374c0b9268e36c86fd52c2eaee.webp"
                  alt="blog img" />
              </div>
            </div>
            <!-- multi-btn-single end -->
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="cta">
    <div class="container">
      <div class="inner-cta">
        <div class="social">
          <h3 class="text-h3 text-white">FOLLOW US</h3>
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

        <div class="cta-section-top">
          <h2 class="text-h2 text-dark-green">
            Ready to Earn More from Your Idle Equipment And Workforce?
          </h2>
          <div>
            <a href="#" class="btn-dark-green">LIST ON MARKETPLACE</a>
            <a href="#" class="btn-dark-green-trans">Register Your Company</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="faq">
    <div class="container">
      <div class="inner-faq">
        <span class="sub-heading">FAQS</span>
        <h2 class="text-h2">Frequently Asked Questions</h2>

        <ul class="accordion-list">
          <li>
            <h3>How do I list my equipment?</h3>
            <div class="answer">
              <p class="text-para">
                Lorem Ipsum is simply dummy text of the printing and
                typesetting industry. Lorem Ipsum has been the industry's
                standard dummy text ever since the 1500s, when an unknown
                printer took a galley of type and scrambled it to make a type
                specimen book. It has survived not only five centuries, but
                also the leap into electronic typesetting, remaining
                essentially unchanged.
              </p>
            </div>
          </li>
          <li>
            <h3>Who can rent?</h3>
            <div class="answer">
              <p class="text-para">
                Lorem Ipsum is simply dummy text of the printing and
                typesetting industry. Lorem Ipsum has been the industry's
                standard dummy text ever since the 1500s, when an unknown
                printer took a galley of type and scrambled it to make a type
                specimen book. It has survived not only five centuries, but
                also the leap into electronic typesetting, remaining
                essentially unchanged.
              </p>
            </div>
          </li>
          <li>
            <h3>Are payments secure?</h3>
            <div class="answer">
              <p class="text-para">
                Lorem Ipsum is simply dummy text of the printing and
                typesetting industry. Lorem Ipsum has been the industry's
                standard dummy text ever since the 1500s, when an unknown
                printer took a galley of type and scrambled it to make a type
                specimen book. It has survived not only five centuries, but
                also the leap into electronic typesetting, remaining
                essentially unchanged.
              </p>
            </div>
          </li>
          <li>
            <h3>How does workforce hiring work?</h3>
            <div class="answer">
              <p class="text-para">
                Lorem Ipsum is simply dummy text of the printing and
                typesetting industry. Lorem Ipsum has been the industry's
                standard dummy text ever since the 1500s, when an unknown
                printer took a galley of type and scrambled it to make a type
                specimen book. It has survived not only five centuries, but
                also the leap into electronic typesetting, remaining
                essentially unchanged.
              </p>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </section>

  <?php $this->load->view('components/websiteFooter'); ?>
</body>

<script src="<?= base_url() ?>assets/website/js/testimonial.js"></script>
<script type="module" src="<?= base_url() ?>assets/website/js/main.js"></script>
<script src="<?= base_url() ?>assets/website/js/home.js"></script>

</html>