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
    <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/landlords-and-user.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/website/css/resopnsive.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <!-- Link Swiper's CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  </head>
  <body>
    <!-- header section-->
  <?php $this->load->view('components/websiteHeader'); ?>

    <!-- hero section start -->
    <section class="reg-page">
      <div class="container">
        <div class="inner-login">
          <div class="form">
            <div class="main-box">
              <div class="img">
                <svg
                  width="72"
                  height="72"
                  viewBox="0 0 72 72"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M72 36C72 55.8889 55.8889 72 36 72C27.9444 72 20.5 69.3611 14.4722 64.8611L19 60.3333C19.5833 59.75 20.5 59.6667 21.1944 60.1111C25.6111 62.9167 30.8611 64.5278 36.4722 64.5278C52.3333 64.5278 65.1667 51.6944 65.1667 35.8333C65.1667 35.25 65.1389 34.6389 65.1111 34.0556C65.0556 33.1389 64.2778 32.4167 63.3611 32.4167H58.3611C57.3611 32.4167 56.5278 33.2778 56.6111 34.3056C56.6667 34.8611 56.6667 35.4167 56.6667 36C56.6667 47.25 47.5556 56.3611 36.3056 56.3611C32.4722 56.3611 28.8889 55.3056 25.8333 53.4722C23.1389 51.8611 20.8333 49.6111 19.1667 46.9722C17.1389 43.8056 15.9722 40.0278 15.9722 36C15.9722 34.7778 16.0833 33.6111 16.2778 32.4444C17.9722 22.8889 26.3056 15.6389 36.3333 15.6389C39.4722 15.6389 42.4722 16.3611 45.1389 17.6389C46.2222 18.1667 46.4722 19.6111 45.6389 20.4444L40.6111 25.5L33.6944 32.4444L26.75 39.3889C26.1944 39.9444 26.0833 40.8056 26.4722 41.4722C27.6111 43.5 29.3333 45.1667 31.4444 46.1667C32.1111 46.5 32.9167 46.3611 33.4445 45.8333L46.8333 32.4167L47.0278 32.2222L53.7778 25.4444L58.8611 20.3611C59.4722 19.7222 59.5556 18.7222 59 18.0278C57.3889 16 55.5 14.1667 53.4167 12.6389C48.6667 9.16667 42.8333 7.11111 36.5 7.11111C21.8056 7.11111 9.69444 18.1667 8 32.3889C7.86111 33.5 7.80556 34.6389 7.80556 35.8056C7.80556 41.6667 9.55556 47.1111 12.5556 51.6389C13 52.3333 12.9167 53.25 12.3333 53.8333L7.94445 58.2222C7.88889 58.2778 7.86111 58.3333 7.80556 58.3889C2.91667 52.25 0 44.4722 0 36C0 16.1111 16.1111 0 36 0C55.8889 0 72 16.1111 72 36Z"
                    fill="#34FF67"
                  />
                </svg>
              </div>
              <h1 class="text-h1-upp text-center">
                How Equip Manager Works for Owners & Renters
              </h1>
              <p class="text-para text-white text-center">
                Whether you own valuable equipment or provide workforce
                services, or you’re looking to rent or hire EquipManager makes
                it simple, secure, and transparent.
              </p>
              <div class="dual-btn">
                <a href="#" class="btn-parrot-green">Start Listing Now</a>
                <a href="#" class="btn-white-transparent"> Find Equipment</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- hero section end -->

    <!-- Step-by-Step Process -->
    <section class="setp-process">
      <div class="container">
        <div class="inner-setp-process">
          <h2 class="text-h2 text-center">Step-by-Step Process</h2>

          <!-- top box -->
          <div class="workforce">
            <div class="for-equip-info">
              <h3 class="text-h3 text-gray-black">
                For Equipment & Workforce Owners:
              </h3>

              <!-- timeline -->
              <div class="timeline">
                <!-- timeline card start-->
                <div class="timeline-card">
                  <img src="<?= base_url() ?>assets/website/img/create-comp.svg" alt="Register" />
                  <div>
                    <span>1 . Create Your Company Account</span>
                    <p class="text-para">Sign up in minutes.</p>
                  </div>
                </div>
                <!-- line -->
                <div class="timeline-line">
                  <img src="<?= base_url() ?>assets/website/img/circle-line.svg" alt="line" />
                </div>
                <!-- timeline card end-->

                <!-- timeline card start-->
                <div class="timeline-card">
                  <img src="<?= base_url() ?>assets/website/img/list-eqip.svg" alt="Register" />
                  <div>
                    <span>2 . List Equipment</span>
                    <p class="text-para">
                      Upload details, photos, and availability.
                    </p>
                  </div>
                </div>
                <!-- line -->
                <div class="timeline-line">
                  <img src="<?= base_url() ?>assets/website/img/circle-line.svg" alt="line" />
                </div>
                <!-- timeline card end-->

                <!-- timeline card start-->
                <div class="timeline-card">
                  <img src="<?= base_url() ?>assets/website/img/manage.svg" alt="Register" />
                  <div>
                    <span>3 . Manage Requests</span>
                    <p class="text-para">
                      Accept, reject, or negotiate rentals and contracts.
                    </p>
                  </div>
                </div>
                <!-- line -->
                <div class="timeline-line">
                  <img src="<?= base_url() ?>assets/website/img/circle-line.svg" alt="line" />
                </div>
                <!-- timeline card end-->

                <!-- timeline card start-->
                <div class="timeline-card">
                  <img src="<?= base_url() ?>assets/website/img/earn.svg" alt="Register" />
                  <div>
                    <span>4 . Earn Revenue</span>
                    <p class="text-para">
                      Get paid securely for every successful transaction.
                    </p>
                  </div>
                </div>
                <!-- timeline card end-->
              </div>
            </div>
            <div class="for-equip-img">
              <img
                src="<?= base_url() ?>assets/website/img/b8db7165d2edea8a33ded6cae06c9adaa9b6b393.webp"
                alt="Equipment img"
              />
            </div>
          </div>

          <!-- top box -->
          <div class="workforce col-reverse">
            <div class="for-equip-img">
              <img
                src="<?= base_url() ?>assets/website/img/266c9e79fed8c531bd0e4827a8ade06a9b9a2298.webp"
                alt="Equipment img"
              />
            </div>
            <div class="for-equip-info">
              <h3 class="text-h3 text-gray-black">For Renters & Users:</h3>

              <!-- timeline -->
              <div class="timeline">
                <!-- timeline card start-->
                <div class="timeline-card">
                  <img src="<?= base_url() ?>assets/website/img/browser.svg" alt="Register" />
                  <div>
                    <span>1 . Browse Listings</span>
                    <p class="text-para">
                      Search equipment or workforce services near you.
                    </p>
                  </div>
                </div>
                <!-- line -->
                <div class="timeline-line">
                  <img src="<?= base_url() ?>assets/website/img/circle-line.svg" alt="line" />
                </div>
                <!-- timeline card end-->

                <!-- timeline card start-->
                <div class="timeline-card">
                  <img src="<?= base_url() ?>assets/website/img/rent-or.svg" alt="Register" />
                  <div>
                    <span>2 . Rent or Purchase</span>
                    <p class="text-para">
                      Book equipment or hire services with clear terms.
                    </p>
                  </div>
                </div>
                <!-- line -->
                <div class="timeline-line">
                  <img src="<?= base_url() ?>assets/website/img/circle-line.svg" alt="line" />
                </div>
                <!-- timeline card end-->

                <!-- timeline card start-->
                <div class="timeline-card">
                  <img src="<?= base_url() ?>assets/website/img/track-use.svg" alt="Register" />
                  <div>
                    <span>3 . Track Usage</span>
                    <p class="text-para">
                      Monitor bookings, timelines, and costs in your dashboard.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Feature Highlights -->
    <section class="feature">
      <div class="container">
        <div class="inner-feature">
          <div class="feature-info">
            <h2 class="text-h2">Feature Highlights</h2>
            <div class="feature-info-list">
              <!-- single list start -->
              <div class="feature-single-list">
                <svg
                  width="39"
                  height="39"
                  viewBox="0 0 39 39"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <foreignObject x="-22" y="-22" width="83" height="83"
                    ><div
                      xmlns="http://www.w3.org/1999/xhtml"
                      style="
                        backdrop-filter: blur(11px);
                        clip-path: url(#bgblur_0_2718_211_clip_path);
                        height: 100%;
                        width: 100%;
                      "
                    ></div
                  ></foreignObject>
                  <rect
                    data-figma-bg-blur-radius="22"
                    width="39"
                    height="39"
                    rx="8"
                    fill="white"
                  />
                  <path
                    d="M28.7659 13L16.5518 26.3244L11 20.2679"
                    stroke="#0F2F2C"
                    stroke-width="2.96098"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <defs>
                    <clipPath
                      id="bgblur_0_2718_211_clip_path"
                      transform="translate(22 22)"
                    >
                      <rect width="39" height="39" rx="8" />
                    </clipPath>
                  </defs>
                </svg>
                <div>
                  <h4 class="text-h4-blog text-gray-black">Secure Payments</h4>
                  <p class="text-para">
                    Safe and reliable transactions every time.
                  </p>
                </div>
              </div>
              <!-- single list end -->
              <!-- single list start -->
              <div class="feature-single-list">
                <svg
                  width="39"
                  height="39"
                  viewBox="0 0 39 39"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <foreignObject x="-22" y="-22" width="83" height="83"
                    ><div
                      xmlns="http://www.w3.org/1999/xhtml"
                      style="
                        backdrop-filter: blur(11px);
                        clip-path: url(#bgblur_0_2718_211_clip_path);
                        height: 100%;
                        width: 100%;
                      "
                    ></div
                  ></foreignObject>
                  <rect
                    data-figma-bg-blur-radius="22"
                    width="39"
                    height="39"
                    rx="8"
                    fill="white"
                  />
                  <path
                    d="M28.7659 13L16.5518 26.3244L11 20.2679"
                    stroke="#0F2F2C"
                    stroke-width="2.96098"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <defs>
                    <clipPath
                      id="bgblur_0_2718_211_clip_path"
                      transform="translate(22 22)"
                    >
                      <rect width="39" height="39" rx="8" />
                    </clipPath>
                  </defs>
                </svg>
                <div>
                  <h4 class="text-h4-blog text-gray-black">
                    Verified Profiles
                  </h4>
                  <p class="text-para">
                    Owners and renters are authenticated for trust.
                  </p>
                </div>
              </div>
              <!-- single list end -->
              <!-- single list start -->
              <div class="feature-single-list">
                <svg
                  width="39"
                  height="39"
                  viewBox="0 0 39 39"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <foreignObject x="-22" y="-22" width="83" height="83"
                    ><div
                      xmlns="http://www.w3.org/1999/xhtml"
                      style="
                        backdrop-filter: blur(11px);
                        clip-path: url(#bgblur_0_2718_211_clip_path);
                        height: 100%;
                        width: 100%;
                      "
                    ></div
                  ></foreignObject>
                  <rect
                    data-figma-bg-blur-radius="22"
                    width="39"
                    height="39"
                    rx="8"
                    fill="white"
                  />
                  <path
                    d="M28.7659 13L16.5518 26.3244L11 20.2679"
                    stroke="#0F2F2C"
                    stroke-width="2.96098"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <defs>
                    <clipPath
                      id="bgblur_0_2718_211_clip_path"
                      transform="translate(22 22)"
                    >
                      <rect width="39" height="39" rx="8" />
                    </clipPath>
                  </defs>
                </svg>
                <div>
                  <h4 class="text-h4-blog text-gray-black">
                    Transparent Contracts
                  </h4>
                  <p class="text-para">Clear terms protect both parties.</p>
                </div>
              </div>
              <!-- single list end -->
            </div>
          </div>
          <div class="feature-img">
            <img
              src="<?= base_url() ?>assets/website/img/b2a73ad1e2da5e77fa330832c94a7ec692d85882.webp"
              alt="Laptop"
            />
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
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
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
                      alt="client"
                    />
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
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
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
                      alt="client"
                    />
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
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
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
                      alt="client"
                    />
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
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
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
                      alt="client"
                    />
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
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
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
                      alt="client"
                    />
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
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
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
                      alt="client"
                    />
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
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
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
                      alt="client"
                    />
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
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
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
                      alt="client"
                    />
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
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16L6.71043 19.28L8.20043 13.24L3.44043 9.22L9.65043 8.76L12.0004 3Z"
                        fill="#34FF67"
                      />
                      <path
                        d="M12.0004 3L9.65043 8.76L3.44043 9.22L8.20043 13.24L6.71043 19.28L12.0004 16M12.0004 3L14.3504 8.76L20.5604 9.22L15.8004 13.24L17.2904 19.28L12.0004 16"
                        stroke="#34FF67"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
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
                      alt="client"
                    />
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
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M0.334579 6.53965C0.1203 6.3244 2.63713e-07 6.03304 2.50436e-07 5.72932C2.3716e-07 5.42559 0.1203 5.13423 0.334579 4.91898L4.91791 0.335651C5.02433 0.229237 5.15066 0.144824 5.2897 0.0872328C5.42873 0.0296417 5.57775 -2.43811e-07 5.72824 -2.5039e-07C6.03218 -2.63675e-07 6.32366 0.120737 6.53858 0.335651C6.75349 0.550565 6.87423 0.84205 6.87423 1.14598C6.87423 1.44992 6.75349 1.7414 6.53858 1.95632L3.91141 4.58348L12.1449 4.58348C12.4488 4.58348 12.7403 4.7042 12.9551 4.91909C13.17 5.13398 13.2907 5.42542 13.2907 5.72932C13.2907 6.03321 13.17 6.32466 12.9551 6.53954C12.7403 6.75443 12.4488 6.87515 12.1449 6.87515L3.91141 6.87515L6.53858 9.50232C6.64499 9.60873 6.72941 9.73507 6.787 9.8741C6.84459 10.0131 6.87423 10.1622 6.87423 10.3127C6.87423 10.4631 6.84459 10.6122 6.787 10.7512C6.72941 10.8902 6.64499 11.0166 6.53858 11.123C6.43216 11.2294 6.30583 11.3138 6.16679 11.3714C6.02776 11.429 5.87874 11.4586 5.72825 11.4586C5.57775 11.4586 5.42873 11.429 5.2897 11.3714C5.15066 11.3138 5.02433 11.2294 4.91791 11.123L0.334579 6.53965Z"
                  fill="#34FF67"
                ></path>
              </svg>
            </div>
            <div class="swiper-button-prev mySwiper-prev">
              <svg
                width="14"
                height="12"
                viewBox="0 0 14 12"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M0.334579 6.53965C0.1203 6.3244 2.63713e-07 6.03304 2.50436e-07 5.72932C2.3716e-07 5.42559 0.1203 5.13423 0.334579 4.91898L4.91791 0.335651C5.02433 0.229237 5.15066 0.144824 5.2897 0.0872328C5.42873 0.0296417 5.57775 -2.43811e-07 5.72824 -2.5039e-07C6.03218 -2.63675e-07 6.32366 0.120737 6.53858 0.335651C6.75349 0.550565 6.87423 0.84205 6.87423 1.14598C6.87423 1.44992 6.75349 1.7414 6.53858 1.95632L3.91141 4.58348L12.1449 4.58348C12.4488 4.58348 12.7403 4.7042 12.9551 4.91909C13.17 5.13398 13.2907 5.42542 13.2907 5.72932C13.2907 6.03321 13.17 6.32466 12.9551 6.53954C12.7403 6.75443 12.4488 6.87515 12.1449 6.87515L3.91141 6.87515L6.53858 9.50232C6.64499 9.60873 6.72941 9.73507 6.787 9.8741C6.84459 10.0131 6.87423 10.1622 6.87423 10.3127C6.87423 10.4631 6.84459 10.6122 6.787 10.7512C6.72941 10.8902 6.64499 11.0166 6.53858 11.123C6.43216 11.2294 6.30583 11.3138 6.16679 11.3714C6.02776 11.429 5.87874 11.4586 5.72825 11.4586C5.57775 11.4586 5.42873 11.429 5.2897 11.3714C5.15066 11.3138 5.02433 11.2294 4.91791 11.123L0.334579 6.53965Z"
                  fill="#34FF67"
                ></path>
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
            <span class="cta-heading">Ready to get started?</span>
            <div class="cta-btn">
              <a href="#" class="btn-dark-green"> I want to list equipment</a>
              <a href="#" class="btn-dark-green-trans">
                I want to rent equipment</a
              >
            </div>
          </div>
          <img src="<?= base_url() ?>assets/website/img/grow-tex.svg" alt="Grow" />
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
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M43.4637 21.7319C43.4637 33.7381 33.738 43.4637 21.7319 43.4637C16.869 43.4637 12.3751 41.8707 8.73635 39.1542L11.4696 36.421C11.8217 36.0689 12.3751 36.0186 12.7943 36.2869C15.4605 37.9805 18.6297 38.953 22.0169 38.953C31.5917 38.953 39.3387 31.206 39.3387 21.6313C39.3387 21.2791 39.3219 20.9102 39.3052 20.5581C39.2716 20.0047 38.8021 19.5687 38.2488 19.5687H35.2304C34.6268 19.5687 34.1237 20.0886 34.174 20.709C34.2076 21.0444 34.2076 21.3797 34.2076 21.7319C34.2076 28.5231 28.7075 34.0231 21.9163 34.0231C19.6023 34.0231 17.4392 33.3859 15.5946 32.2792C13.9681 31.3066 12.5763 29.9484 11.5702 28.3554C10.3461 26.4438 9.64184 24.1633 9.64184 21.7319C9.64184 20.9941 9.70891 20.2898 9.82629 19.5855C10.8492 13.8172 15.8797 9.44062 21.9331 9.44062C23.8279 9.44062 25.6389 9.8766 27.2487 10.6479C27.9026 10.9665 28.0536 11.8385 27.5505 12.3416L24.5154 15.3934L20.3401 19.5855L16.148 23.7776C15.8126 24.113 15.7455 24.6328 15.9803 25.0352C16.6678 26.2593 17.7074 27.2654 18.9818 27.8691C19.3843 28.0703 19.8706 27.9865 20.1892 27.6679L28.2715 19.5687L28.3889 19.4514L32.4636 15.3599L35.5323 12.2912C35.9012 11.9056 35.9515 11.3019 35.6161 10.8827C34.6436 9.65861 33.5033 8.55189 32.2457 7.62963C29.3783 5.53358 25.8569 4.29272 22.0337 4.29272C13.1632 4.29272 5.85217 10.9665 4.8293 19.552C4.74546 20.2227 4.71193 20.9102 4.71193 21.6145C4.71193 25.1526 5.76834 28.4392 7.57933 31.1725C7.84762 31.5917 7.79731 32.1451 7.44518 32.4972L4.79577 35.1466C4.76223 35.1801 4.74546 35.2137 4.71193 35.2472C1.76068 31.5414 0 26.8462 0 21.7319C0 9.72568 9.72568 0 21.7319 0C33.738 0 43.4637 9.72568 43.4637 21.7319Z"
                  fill="#34FF67"
                />
                <path
                  d="M57.1895 26.9928V12.6006H67.4881V14.6751H59.5233V18.6946H67.1547V20.8062H59.5233V24.8997H67.4881V26.9928H57.1895Z"
                  fill="#34FF67"
                />
                <path
                  d="M73.9158 25.2333C75.8051 25.2333 76.8424 24.3998 76.8424 22.6216V20.7137C76.8424 18.9356 75.8051 18.102 73.9158 18.102C71.8598 18.102 71.0077 19.0467 71.0077 21.6954C71.0077 24.3442 71.8598 25.2333 73.9158 25.2333ZM68.6924 21.6584C68.6924 18.2687 70.3224 16.1016 73.3231 16.1016C75.1754 16.1016 76.3979 16.824 76.9165 18.0835H77.0091V16.3238H79.1392V30.716H76.8424V25.3444H76.7683C76.3052 26.3076 75.1013 27.2152 73.249 27.2152C70.2483 27.1967 68.6924 25.0295 68.6924 21.6584Z"
                  fill="#34FF67"
                />
                <path
                  d="M81.3428 22.8988V16.3047H83.6581V22.4913C83.6581 24.3992 84.3805 25.1956 86.2328 25.1956C88.0851 25.1956 89.0297 24.4177 89.0297 22.3246V16.3047H91.3451V26.9738H89.1964V24.8437H89.1038C88.5852 26.0662 87.4553 27.1776 85.3622 27.1776C82.5838 27.1961 81.3428 25.3438 81.3428 22.8988Z"
                  fill="#34FF67"
                />
                <path
                  d="M93.4941 26.9928V16.2495H95.8095V26.9928H93.4941ZM93.4941 14.9529L93.4756 12.582H95.7909V14.9529H93.4941Z"
                  fill="#34FF67"
                />
                <path
                  d="M103.089 25.2333C105.126 25.2333 105.997 24.2886 105.997 21.6769C105.997 19.0652 105.163 18.0835 103.089 18.0835C101.199 18.0835 100.162 18.917 100.162 20.6952V22.603C100.162 24.3812 101.199 25.2333 103.089 25.2333ZM97.8652 30.6975V16.3053H99.9768V18.0649H100.088C100.588 16.8239 101.811 16.083 103.644 16.083C106.645 16.083 108.312 18.2502 108.312 21.6398C108.312 25.0295 106.701 27.1782 103.793 27.1782C101.885 27.1782 100.699 26.2891 100.236 25.3074H100.162V30.679H97.8652V30.6975Z"
                  fill="#34FF67"
                />
                <path
                  d="M114.333 26.9928V12.6006H117.63L120.909 20.4913L122.168 23.9365H122.353L123.594 20.4913L126.817 12.6006H130.096V26.9928H127.799V18.4723L127.892 16.0829H127.744L126.836 18.4723L123.613 26.1222H120.816L117.574 18.4723L116.722 16.0829H116.519L116.648 18.4723V26.9928H114.333Z"
                  fill="#34FF67"
                />
                <path
                  d="M136.116 25.363C137.616 25.363 139.265 24.7702 139.265 22.6216V22.4364L135.875 22.955C134.653 23.1217 134.227 23.3995 134.227 24.196C134.227 25.011 134.764 25.363 136.116 25.363ZM131.967 24.3442C131.967 22.5845 133.263 21.6584 135.523 21.3435L139.265 20.7878V20.2136C139.265 18.6207 138.542 18.1576 136.857 18.1576C135.171 18.1576 134.486 18.6948 134.486 20.121V20.4359H132.245V20.2136C132.245 17.8242 134.115 16.1016 136.968 16.1016C139.82 16.1016 141.45 17.8983 141.45 20.51V26.993H139.302V25.3259H139.191C138.561 26.3447 137.338 27.2152 135.319 27.2152C133.449 27.1967 131.967 26.215 131.967 24.3442Z"
                  fill="#34FF67"
                />
                <path
                  d="M143.691 26.993V16.3239H145.822V18.3243H145.914C146.414 17.1759 147.544 16.1201 149.637 16.1201C152.416 16.1201 153.657 17.8798 153.657 20.3063V27.0115H151.341V20.8249C151.341 18.9171 150.749 18.1206 148.785 18.1206C146.822 18.1206 146.044 18.843 146.044 20.8434V27.0115H143.691V26.993Z"
                  fill="#34FF67"
                />
                <path
                  d="M159.491 25.363C160.991 25.363 162.64 24.7702 162.64 22.6216V22.4364L159.25 22.955C158.028 23.1217 157.602 23.3995 157.602 24.196C157.602 25.011 158.139 25.363 159.491 25.363ZM155.342 24.3442C155.342 22.5845 156.638 21.6584 158.898 21.3435L162.64 20.7878V20.2136C162.64 18.6207 161.917 18.1576 160.232 18.1576C158.546 18.1576 157.861 18.6948 157.861 20.121V20.4359H155.62V20.2136C155.62 17.8242 157.49 16.1016 160.343 16.1016C163.195 16.1016 164.825 17.8983 164.825 20.51V26.993H162.677V25.3259H162.566C161.936 26.3447 160.713 27.2152 158.694 27.2152C156.824 27.1967 155.342 26.215 155.342 24.3442Z"
                  fill="#34FF67"
                />
                <path
                  d="M171.845 24.0108C173.587 24.0108 174.754 23.1773 174.754 21.362V20.6952C174.754 18.917 173.587 18.0835 171.808 18.0835C169.808 18.0835 168.937 18.8615 168.937 21.0472C168.937 23.2328 169.826 23.9923 171.845 24.0108ZM166.604 21.0472C166.604 18.0465 168.252 16.1016 171.271 16.1016C172.994 16.1016 174.328 16.824 174.828 18.0835H174.92V16.3238H177.05V26.2335C177.05 29.4009 175.198 30.8827 172.086 30.8827C168.974 30.8827 167.159 29.438 167.159 26.8633H169.456C169.456 28.3266 169.993 28.8267 172.142 28.8267C174.29 28.8267 174.735 28.234 174.735 26.2521V24.1219H174.642C174.142 25.1592 172.901 26.0113 171.16 26.0113C168.234 25.9742 166.604 24.0478 166.604 21.0472Z"
                  fill="#34FF67"
                />
                <path
                  d="M180.978 20.6582H186.627C186.72 18.8244 185.719 18.065 183.904 18.065C181.867 18.0465 181.089 18.9911 180.978 20.6582ZM178.773 21.6399C178.773 18.3243 180.755 16.1016 183.923 16.1016C186.794 16.1016 188.813 17.8242 188.813 20.7508C188.813 21.3065 188.739 21.8807 188.683 22.2141H180.922C181.015 24.159 181.719 25.1592 183.941 25.1592C185.719 25.1592 186.405 24.5665 186.405 23.5848V23.4181H188.702V23.6033C188.702 25.789 186.794 27.2152 183.904 27.2152C180.44 27.1967 178.773 24.974 178.773 21.6399Z"
                  fill="#34FF67"
                />
                <path
                  d="M190.684 26.993V16.2497H192.814V17.9538H192.925C193.351 16.9721 194.333 16.1016 195.907 16.1016C198.148 16.1016 199 17.7316 199 19.732V20.4359H196.685V20.0099C196.685 18.6021 196.277 18.0835 194.925 18.0835C193.573 18.0835 193.017 18.6207 193.017 20.0284V26.993H190.684Z"
                  fill="#34FF67"
                />
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
                  placeholder="Enter Email Address"
                />
                <button type="submit" class="btn-submit">
                  <svg
                    width="28"
                    height="28"
                    viewBox="0 0 28 28"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M17.2204 13.9998H7.97111C7.97111 13.6789 7.90461 13.3581 7.77278 13.0571L4.99961 6.78278C4.11294 4.77611 6.23394 2.76711 8.18928 3.75995L24.2671 11.9196C25.9704 12.7829 25.9704 15.2166 24.2671 16.0799L8.19044 24.2396C6.23394 25.2324 4.11294 23.2223 4.99961 21.2168L7.77044 14.9424C7.9014 14.6454 7.96895 14.3244 7.96878 13.9998"
                      stroke="#34FF67"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
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
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M17.5 3.75H2.5C2.16848 3.75 1.85054 3.8817 1.61612 4.11612C1.3817 4.35054 1.25 4.66848 1.25 5V15C1.25 15.3315 1.3817 15.6495 1.61612 15.8839C1.85054 16.1183 2.16848 16.25 2.5 16.25H17.5C17.8315 16.25 18.1495 16.1183 18.3839 15.8839C18.6183 15.6495 18.75 15.3315 18.75 15V5C18.75 4.66848 18.6183 4.35054 18.3839 4.11612C18.1495 3.8817 17.8315 3.75 17.5 3.75ZM16.125 5L10 9.2375L3.875 5H16.125ZM2.5 15V5.56875L9.64375 10.5125C9.74837 10.5851 9.87267 10.624 10 10.624C10.1273 10.624 10.2516 10.5851 10.3562 10.5125L17.5 5.56875V15H2.5Z"
                  fill="#34FF67"
                />
              </svg>
              <a href="#">info@gmail.com</a>
            </div>
            <div class="icon-list">
              <svg
                width="20"
                height="20"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M4.64202 6.57296C4.40389 5.00171 5.51264 3.58796 7.20639 3.06921C7.50712 2.97717 7.83164 3.00332 8.11375 3.14234C8.39586 3.28137 8.6143 3.52278 8.72452 3.81734L9.26764 5.26734C9.35496 5.50058 9.37062 5.75459 9.3126 5.99679C9.25459 6.239 9.12554 6.45835 8.94202 6.62671L7.32639 8.10859C7.24656 8.18168 7.18708 8.27425 7.15377 8.37723C7.12047 8.48022 7.11448 8.59009 7.13639 8.69609L7.15077 8.76109L7.19077 8.92421C7.22639 9.06171 7.28014 9.25546 7.35577 9.48671C7.50577 9.94609 7.74514 10.5636 8.10139 11.1805C8.45764 11.7973 8.87264 12.3136 9.19514 12.673C9.36325 12.8599 9.5388 13.0401 9.72139 13.213L9.77139 13.2592C9.8522 13.3308 9.95017 13.3802 10.0558 13.4027C10.1613 13.4251 10.2709 13.4198 10.3739 13.3873L12.4651 12.7292C12.7027 12.6545 12.9572 12.6525 13.196 12.7235C13.4347 12.7944 13.6469 12.935 13.8051 13.1273L14.7945 14.3286C15.207 14.8286 15.1583 15.5636 14.6839 16.0055C13.3876 17.2136 11.6051 17.4617 10.3651 16.4642C8.84559 15.238 7.56432 13.7429 6.58514 12.0536C5.59878 10.3648 4.93956 8.50591 4.64202 6.57296ZM8.44577 8.77796L9.78702 7.54796C10.1541 7.21123 10.4122 6.77253 10.5282 6.28813C10.6442 5.80372 10.6129 5.2957 10.4383 4.82921L9.89452 3.37921C9.67269 2.78679 9.23327 2.30127 8.66585 2.02163C8.09843 1.74198 7.44571 1.68926 6.84077 1.87421C4.73764 2.51859 3.04889 4.40421 3.40639 6.75984C3.72731 8.84852 4.43911 10.858 5.50452 12.683C6.56064 14.5047 7.94255 16.1169 9.58139 17.4392C11.4408 18.933 13.9245 18.4236 15.5364 16.9205C15.9979 16.4907 16.2779 15.9011 16.3194 15.2719C16.3609 14.6427 16.1606 14.0214 15.7595 13.5348L14.7701 12.3336C14.4535 11.9488 14.0292 11.6675 13.5516 11.5256C13.0739 11.3837 12.5648 11.3878 12.0895 11.5373L10.3539 12.0836C10.2762 12.0037 10.2001 11.9222 10.1258 11.8392C9.76894 11.4447 9.45335 11.0147 9.18389 10.5561C8.92128 10.0933 8.70662 9.60497 8.54327 9.09859C8.50857 8.9926 8.47607 8.88591 8.44577 8.77859"
                  fill="#34FF67"
                />
              </svg>
              <a href="#">+92 3046787889</a>
            </div>
            <div class="icon-list">
              <svg
                width="20"
                height="20"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M5.33325 3.96627C6.57518 2.74918 8.24725 2.07138 9.98611 2.08016C11.725 2.08894 13.3901 2.7836 14.6197 4.01317C15.8493 5.24275 16.5439 6.90789 16.5527 8.64674C16.5615 10.3856 15.8837 12.0577 14.6666 13.2996L11.1782 16.7879C10.8657 17.1004 10.4419 17.2759 9.99991 17.2759C9.55797 17.2759 9.13413 17.1004 8.82158 16.7879L5.33325 13.2996C4.09565 12.0619 3.40039 10.3832 3.40039 8.63294C3.40039 6.88263 4.09565 5.20399 5.33325 3.96627Z"
                  stroke="#34FF67"
                  stroke-width="1.5"
                  stroke-linejoin="round"
                />
                <path
                  d="M10 11.1328C11.3807 11.1328 12.5 10.0135 12.5 8.63281C12.5 7.2521 11.3807 6.13281 10 6.13281C8.61929 6.13281 7.5 7.2521 7.5 8.63281C7.5 10.0135 8.61929 11.1328 10 11.1328Z"
                  stroke="#34FF67"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
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
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M12.1711 2.46387C11.1198 2.46387 10.1114 2.88153 9.36798 3.62498C8.62453 4.36843 8.20686 5.37676 8.20686 6.42815V8.6353H6.08544C5.97915 8.6353 5.89258 8.72101 5.89258 8.82815V11.7424C5.89258 11.8487 5.97829 11.9353 6.08544 11.9353H8.20686V17.9139C8.20686 18.0202 8.29258 18.1067 8.39972 18.1067H11.314C11.4203 18.1067 11.5069 18.021 11.5069 17.9139V11.9353H13.6471C13.7354 11.9353 13.8126 11.8753 13.834 11.7896L14.5626 8.8753C14.5697 8.84686 14.5703 8.81716 14.5643 8.78846C14.5583 8.75976 14.5458 8.73282 14.5277 8.70967C14.5097 8.68653 14.4867 8.66781 14.4603 8.65492C14.434 8.64203 14.405 8.63532 14.3757 8.6353H11.5069V6.42815C11.5069 6.34092 11.524 6.25454 11.5574 6.17394C11.5908 6.09335 11.6397 6.02012 11.7014 5.95843C11.7631 5.89675 11.8363 5.84782 11.9169 5.81443C11.9975 5.78105 12.0839 5.76387 12.1711 5.76387H14.3997C14.506 5.76387 14.5926 5.67815 14.5926 5.57101V2.65672C14.5926 2.55044 14.5069 2.46387 14.3997 2.46387H12.1711Z"
                  fill="#34FF67"
                />
              </svg>
            </a>
            <a href="">
              <svg
                width="21"
                height="21"
                viewBox="0 0 21 21"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M12.986 7.20022C12.329 7.19797 11.6781 7.32528 11.0704 7.57486C10.4627 7.82445 9.91013 8.19141 9.4444 8.65475C8.97866 9.1181 8.60887 9.66873 8.35616 10.2751C8.10345 10.8816 7.9728 11.5318 7.97168 12.1888V17.2288C7.97168 17.4334 8.05296 17.6296 8.19763 17.7743C8.3423 17.919 8.53851 18.0002 8.74311 18.0002H10.5431C10.7477 18.0002 10.9439 17.919 11.0886 17.7743C11.2333 17.6296 11.3145 17.4334 11.3145 17.2288V12.1888C11.3144 11.9551 11.3634 11.7241 11.4586 11.5107C11.5537 11.2972 11.6927 11.1063 11.8666 10.9502C12.0405 10.7941 12.2453 10.6764 12.4677 10.6048C12.6901 10.5332 12.9251 10.5092 13.1574 10.5345C13.574 10.587 13.9568 10.7905 14.2333 11.1065C14.5098 11.4225 14.6607 11.8289 14.6574 12.2488V17.2288C14.6574 17.4334 14.7387 17.6296 14.8833 17.7743C15.028 17.919 15.2242 18.0002 15.4288 18.0002H17.2288C17.4334 18.0002 17.6296 17.919 17.7743 17.7743C17.919 17.6296 18.0003 17.4334 18.0003 17.2288V12.1888C17.9991 11.5318 17.8685 10.8816 17.6158 10.2751C17.3631 9.66873 16.9933 9.1181 16.5275 8.65475C16.0618 8.19141 15.5093 7.82445 14.9016 7.57486C14.2939 7.32528 13.6429 7.19797 12.986 7.20022Z"
                  fill="#34FF67"
                />
                <path
                  d="M5.657 7.97168H3.34272C2.91667 7.97168 2.57129 8.31706 2.57129 8.74311V17.2288C2.57129 17.6549 2.91667 18.0003 3.34272 18.0003H5.657C6.08305 18.0003 6.42843 17.6549 6.42843 17.2288V8.74311C6.42843 8.31706 6.08305 7.97168 5.657 7.97168Z"
                  fill="#34FF67"
                />
                <path
                  d="M4.49986 6.42843C5.56498 6.42843 6.42843 5.56498 6.42843 4.49986C6.42843 3.43474 5.56498 2.57129 4.49986 2.57129C3.43474 2.57129 2.57129 3.43474 2.57129 4.49986C2.57129 5.56498 3.43474 6.42843 4.49986 6.42843Z"
                  fill="#34FF67"
                />
              </svg>
            </a>
            <a href="">
              <svg
                width="21"
                height="21"
                viewBox="0 0 21 21"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M12.8571 3H7.71429C5.11066 3 3 5.11066 3 7.71429V12.8571C3 15.4608 5.11066 17.5714 7.71429 17.5714H12.8571C15.4608 17.5714 17.5714 15.4608 17.5714 12.8571V7.71429C17.5714 5.11066 15.4608 3 12.8571 3Z"
                  stroke="#34FF67"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
                <path
                  d="M10.2862 13.377C11.9932 13.377 13.377 11.9932 13.377 10.2862C13.377 8.57914 11.9932 7.19531 10.2862 7.19531C8.57914 7.19531 7.19531 8.57914 7.19531 10.2862C7.19531 11.9932 8.57914 13.377 10.2862 13.377Z"
                  stroke="#34FF67"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
                <path
                  d="M14.4805 6.97372C14.9681 6.97372 15.3634 6.57845 15.3634 6.09086C15.3634 5.60328 14.9681 5.20801 14.4805 5.20801C13.9929 5.20801 13.5977 5.60328 13.5977 6.09086C13.5977 6.57845 13.9929 6.97372 14.4805 6.97372Z"
                  fill="#34FF67"
                />
              </svg>
            </a>
            <a href="">
              <svg
                width="21"
                height="21"
                viewBox="0 0 21 21"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M18.6941 5.33725C18.7438 5.26868 18.6701 5.17868 18.5913 5.20953C18.0261 5.42863 17.4358 5.57634 16.8341 5.64925C17.5026 5.24995 18.0208 4.6414 18.3084 3.91782C18.3375 3.8441 18.257 3.7781 18.1884 3.81668C17.5653 4.16039 16.8941 4.4081 16.1955 4.55125C16.1812 4.55414 16.1663 4.55329 16.1523 4.54879C16.1384 4.54429 16.1258 4.53628 16.1158 4.52553C15.5901 3.97086 14.8979 3.60266 14.1442 3.47674C13.3904 3.35083 12.6161 3.47406 11.9387 3.82775C11.2612 4.18144 10.7175 4.74633 10.39 5.4368C10.0624 6.12727 9.96891 6.90569 10.1235 7.65411C10.1263 7.66714 10.126 7.68062 10.1228 7.69354C10.1195 7.70646 10.1134 7.71846 10.1048 7.72863C10.0962 7.7388 10.0854 7.74687 10.0732 7.75223C10.061 7.75758 10.0477 7.76008 10.0344 7.75953C8.67793 7.67529 7.35298 7.31479 6.14082 6.70016C4.92865 6.08553 3.85484 5.22973 2.98526 4.18525C2.97658 4.17438 2.96534 4.16584 2.95254 4.16039C2.93974 4.15495 2.92579 4.15276 2.91194 4.15404C2.89809 4.15531 2.88477 4.16001 2.87319 4.1677C2.8616 4.17539 2.8521 4.18584 2.84555 4.1981C2.57492 4.71149 2.43369 5.28318 2.43412 5.86353C2.43302 6.44158 2.57488 7.01092 2.84705 7.52087C3.11923 8.03083 3.51328 8.46557 3.99412 8.78639C3.4847 8.77254 2.98458 8.64671 2.52926 8.41782C2.47098 8.38782 2.40069 8.42982 2.40326 8.49496C2.43747 9.26733 2.71768 10.0085 3.20298 10.6104C3.7186 11.2349 4.43408 11.6621 5.2284 11.8198C4.92245 11.9121 4.60509 11.9611 4.28555 11.9655C4.11178 11.9632 3.93832 11.9503 3.76612 11.927C3.70183 11.9184 3.64955 11.9784 3.67183 12.0384C3.91734 12.703 4.35752 13.2781 4.93491 13.6886C5.5123 14.0992 6.20006 14.3261 6.90841 14.3398C5.54068 15.4156 3.82325 15.9471 2.08698 15.8321C1.99612 15.8261 1.95412 15.947 2.03212 15.9932C3.56745 16.9043 5.32025 17.3841 7.10555 17.3818C8.42521 17.3955 9.73438 17.1461 10.9566 16.6483C12.1788 16.1504 13.2896 15.4139 14.224 14.482C15.1584 13.55 15.8978 12.4412 16.3989 11.2203C16.9 9.99944 17.1529 8.69094 17.1427 7.37125V6.95982C17.1427 6.94651 17.1458 6.93339 17.1517 6.92149C17.1577 6.90958 17.1663 6.89923 17.177 6.89125C17.7584 6.45294 18.2699 5.92898 18.6941 5.33725Z"
                  fill="#34FF67"
                />
              </svg>
            </a>
          </div>
        </div>
      </div>
    </section>
  </body>
  <script src="<?= base_url() ?>assets/website/js/testimonial.js"></script>
</html>
