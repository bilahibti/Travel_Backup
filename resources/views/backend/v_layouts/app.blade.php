<!doctype html>

<html
  lang="en"
  class="layout-menu-fixed layout-compact"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="robots" content="noindex, nofollow" />

    <title>TravelTime</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('backend/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('backend/vendor/fonts/iconify-icons.css') }}" />

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css -->

    <link rel="stylesheet" href="{{ asset('backend/vendor/libs/node-waves/node-waves.css') }}" />

    <link rel="stylesheet" href="{{ asset('backend/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/css/demo.css') }}" />

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="{{ asset('backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- endbuild -->

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('backend/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Config: Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file. -->

    <script src="{{ asset('backend/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo me-1">
                <span class="text-primary">
                  <svg width="30" height="24" viewBox="0 0 250 196" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M12.3002 1.25469L56.655 28.6432C59.0349 30.1128 60.4839 32.711 60.4839 35.5089V160.63C60.4839 163.468 58.9941 166.097 56.5603 167.553L12.2055 194.107C8.3836 196.395 3.43136 195.15 1.14435 191.327C0.395485 190.075 0 188.643 0 187.184V8.12039C0 3.66447 3.61061 0.0522461 8.06452 0.0522461C9.56056 0.0522461 11.0271 0.468577 12.3002 1.25469Z"
                      fill="currentColor" />
                    <path
                      opacity="0.077704"
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M0 65.2656L60.4839 99.9629V133.979L0 65.2656Z"
                      fill="black" />
                    <path
                      opacity="0.077704"
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M0 65.2656L60.4839 99.0795V119.859L0 65.2656Z"
                      fill="black" />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M237.71 1.22393L193.355 28.5207C190.97 29.9889 189.516 32.5905 189.516 35.3927V160.631C189.516 163.469 191.006 166.098 193.44 167.555L237.794 194.108C241.616 196.396 246.569 195.151 248.856 191.328C249.605 190.076 250 188.644 250 187.185V8.09597C250 3.64006 246.389 0.027832 241.935 0.027832C240.444 0.027832 238.981 0.441882 237.71 1.22393Z"
                      fill="currentColor" />
                    <path
                      opacity="0.077704"
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M250 65.2656L189.516 99.8897V135.006L250 65.2656Z"
                      fill="black" />
                    <path
                      opacity="0.077704"
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M250 65.2656L189.516 99.0497V120.886L250 65.2656Z"
                      fill="black" />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z"
                      fill="currentColor" />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z"
                      fill="white"
                      fill-opacity="0.15" />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z"
                      fill="currentColor" />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z"
                      fill="white"
                      fill-opacity="0.3" />
                  </svg>
                </span>
              </span>
              <span class="app-brand-text demo menu-text fw-semibold ms-2">TravelTime</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <i class="menu-toggle-icon d-xl-inline-block align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboards -->
            <li class="menu-item">
              <a href="{{ route('v1.backend.dashboard.dashboard') }}" class="menu-link">
                <i class="menu-icon icon-base ri ri-home-smile-line"></i>
                <div data-i18n="Dashboards">Dashboards</div>
              </a>
            </li>

            <!-- Menu -->
            <li class="menu-header mt-7">
              <span class="menu-header-text">Menu&amp; Travel</span>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ri ri-file-copy-line"></i>
                <div data-i18n="Menu">Menu</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{ route('v1.backend.user.index') }}" class="menu-link">
                    <div data-i18n="Analytics">Users</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('v1.backend.destination.index') }}" class="menu-link">
                    <div data-i18n="Analytics">Destination</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('v1.backend.hotel.index') }}" class="menu-link">
                    <div data-i18n="Analytics">Hotel</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('v1.backend.hotel-room.index') }}" class="menu-link">
                    <div data-i18n="Analytics">Hotel Rooms</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('v1.backend.transportation.index') }}" class="menu-link">
                    <div data-i18n="Analytics">Transportation</div>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Pages -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ri ri-layout-left-line"></i>
                <div data-i18n="Menu Travel">Packages</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{ route('v1.backend.travel-packages.index') }}" class="menu-link">
                    <div data-i18n="Paket Travel">Travel Packages</div>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Laporan -->
            <li class="menu-header mt-7">
              <span class="menu-header-text">Report</span>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ri ri-layout-left-line"></i>
                <div data-i18n="Laporan">Report</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{ route('v1.backend.user.report.formuser') }}" class="menu-link">
                    <div data-i18n="Report User">User</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('v1.backend.booking.report.formbooking') }}" class="menu-link">
                    <div data-i18n="Report Booking">Booking</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('v1.backend.travel-packages.report.formtravelpackages') }}" class="menu-link">
                    <div data-i18n="Report Travel Package">Travel Package</div>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </aside>
        <!-- / Menu -->

        

        
        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                <i class="icon-base ri ri-menu-line icon-md"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
              <ul class="navbar-nav flex-row align-items-center ms-md-auto">
                <!-- User -->
                 <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a 
                    class="nav-link dropdown-toggle hide-arrow p-0"
                    href=""
                    data-bs-toggle="dropdown">
                    @auth
                      @if (Auth::user()->foto) 
                      <img src="{{ asset('storage/img-user/' . Auth::user()->foto) }}" alt="user" class="rounded-circle"  width="31"> 
                      @else 
                      <img src="{{ asset('storage/img-user/1.png') }}" alt="user" class="rounded-circle"  width="31"> 
                      @endif 
                      <h6>{{ Auth::user()->nama }}</h6>
                    @endauth
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              @auth
                                @if (Auth::user()->foto)
                                <img src="{{ asset('storage/img-user/' . Auth::user()->foto) }}" alt="user" class="rounded-circle"  width="31">
                                @else
                                <img src="{{ asset('storage/img-user/1.png') }}" alt="user" class="w-px-40 h-auto rounded-circle" width="31"/>
                                @endif
                                <h6>{{ Auth::user()->nama }}</h6>
                              @endauth
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-0">{{ Auth::user()?->nama }}</h6>
                            <small class="text-body-secondary">
                              {{ ucfirst(Auth::user()?->role->name) }}
                          </small>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider my-1"></div>
                    </li>
                    <li>
                      <div class="dropdown-divider my-1"></div>
                    </li>
                    <li>
                      <div class="d-grid px-4 pt-2 pb-1">
                        <a class="btn btn-danger d-flex" href="javascript:void(0);">
                          <small class="align-middle">Logout</small>
                          <i class="ri ri-logout-box-r-line ms-2 ri-xs"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
                <!-- / User -->
              </ul>
            </div> 
          </nav>
          <!-- @yieldAwal --> 
          <!-- Content wrapper -->
            <div class="content-wrapper">
              <div class="container-xxl flex-grow-1 container-p-y">
                @yield('content')
              </div>
            </div>
<!-- / Content wrapper --> 
          <!-- @yieldAkhir-->
        </div>
          <!-- Navbar -->
        <!-- / Layout page -->
      </div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->

    <script src="{{ asset('backend/vendor/libs/jquery/jquery.js') }}"></script>

    <script src="{{ asset('backend/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('backend/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('backend/vendor/libs/node-waves/node-waves.js') }}"></script>

    <script src="{{ asset('backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('backend/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->

    <script src="{{ asset('backend/js/main.js') }}"></script>

    @stack('scripts')

    <!-- Page JS -->

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async="async" defer="defer" src="https://buttons.github.io/buttons.js"></script>

    <!-- sweetalert --> 
    <script src="{{ asset('sweetalert/sweetalert2.all.min.js') }}"></script> 
    <!-- sweetalert End --> 
    <!-- konfirmasi success--> 
    @if (session('success')) 
    <script> 
        Swal.fire({ 
            icon: 'success', 
            title: 'Success!', 
            text: "{{ session('success') }}" 
        }); 
    </script> 
    @endif 
    <!-- konfirmasi success End-->
     
    <script type="text/javascript"> 
      //Konfirmasi delete 
      $('.show_confirm').click(function(event) { 
        var form = $(this).closest("form"); 
        var konfdelete = $(this).data("konf-delete"); 
        event.preventDefault(); 
        Swal.fire({ 
          title: 'Confirm Delete Data?', 
          html: "Data that is deleted <strong>" + konfdelete + "</strong> cannot be recovered!", 
          icon: 'warning', 
          showCancelButton: true, 
          confirmButtonColor: '#3085d6', 
          cancelButtonColor: '#d33', 
          confirmButtonText: 'Yes, delete it', 
          cancelButtonText: 'Cancel' 
        }).then((result) => { 
          if (result.isConfirmed) { 
            Swal.fire('Deleted!', 'Data has been deleted.', 'success') 
              .then(() => { 
                form.submit(); 
              }); 
          } 
        }); 
      }); 
    </script> 
  </body>
</html>
