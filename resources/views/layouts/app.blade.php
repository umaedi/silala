<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>{{ $title ?? 'Dashboard Silala' }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img') }}/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('vendor') }}/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('vendor') }}/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('vendor') }}/css/theme-default.css" class="template-customizer-theme-css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('vendor') }}/libs/perfect-scrollbar/perfect-scrollbar.css" />


    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('vendor') }}/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('js') }}/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        @include('layouts.sidebar')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

        @include('layouts.navbar')

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            @yield('content')
            <!-- / Content -->

            <!-- Footer -->
            @include('layouts.footer')
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

    <!-- Modal -->
    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
      <form id="storeLayanan">
        @csrf
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="basicModalTitle">Tambah Layanan</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <span id="notif"></span>
              <div class="row">
                <div class="col mb-3">
                  <label for="nameWithTitle" class="form-label">Nama layanan</label>
                  <input
                    name="nama_layanan"
                    type="text"
                    id="namaLayanan"
                    class="form-control"
                    placeholder="Masukan nama layanan"
                    autofocus
                  />
                </div>
              </div>
              <div class="row g-2">
                <div class="col mb-3">
                    <label for="nameWithTitle" class="form-label">Bagian</label>
                        <select name="opd_id" id="opd" class="list_opd form-select">
                          
                        </select>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Batal
              </button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </div>
        </div>
      </form>
    </div>

    <!-- Modal buat layanan-->
    <div class="modal fade" id="layananModal" tabindex="-1" aria-hidden="true">
      <form id="storeLaporan">
        @csrf
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="layananModalTitle">Buat Laporan</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <span id="notifLaporan"></span>
              <div class="row">
                <div class="col mb-3">
                  <label for="nameWithTitle" class="form-label">Nama layanan</label>
                  <select name="layanan_id" id="layanan" onchange="resetInput()" class="form-select" required>
                          
                  </select>
                </div>
              </div>
              <div class="row g-2">
                <div class="col mb-3">
                    <label for="nameWithTitle" class="form-label">Keterangan</label>
                    <input
                      name="keterangan"
                      type="text"
                      id="keterangan"
                      class="form-control"
                      placeholder="Masukan keterangan"
                      autofocus
                      required
                    />
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Batal
              </button>
              @include('layouts._button')
              <button id="btn_submit_laporan" type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </div>
        </div>
      </form>
    </div>
      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('vendor') }}/libs/jquery/jquery.js"></script>
    <script src="{{ asset('vendor') }}/libs/popper/popper.js"></script>
    <script src="{{ asset('vendor') }}/js/bootstrap.js"></script>
    <script src="{{ asset('vendor') }}/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="{{ asset('vendor') }}/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Main JS -->
    <script src="{{ asset('js') }}/main.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
            loadOpd();
            loadLayanan();
        });

      async function transAjax(data) {
          html = null;
          data.headers = {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
          await $.ajax(data).done(function(res) {
              html = res;
          })
              .fail(function() {
                  return false;
              })
          return html
      }

      async function loadOpd()
        {
          var param = {
            url: '/admin/dashboard',
            method: 'GET',
            data: {
              load: 'opd',
            }
          }

          await transAjax(param).then((result) => {
            $('#opd .list_opd').html(result);
          });
        }
        
      async function loadLayanan()
        {
          var param = {
            url: '/oprator/dashboard',
            method: 'GET',
            data: {
              load: 'layanan',
            }
          }

          await transAjax(param).then((result) => {
            $('#layanan').html(result);
          });

        }

      $('#storeLayanan').on('submit', async function store(e) {
          e.preventDefault();

          var form 	= $(this)[0]; 
          var data 	= new FormData(form);
          var param = {
            url: '/admin/layanan/store',
            method: 'POST',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
          }

          await transAjax(param).then((result) => {
            $('#notif').html(`<div class="alert alert-success">${result.data}</div>`);
            loadTable();
          }).catch((err) => {
            $('#notif').html(`<div class="alert alert-warning">${err.message}</div>`);
          });
        });

        $('#namaLayanan').on('click', function() {
          $('#notif').html('');
        });


      $('#storeLaporan').on('submit', async function store(e) {
          e.preventDefault();

          var form 	= $(this)[0]; 
          var data 	= new FormData(form);
          var param = {
            url: '/oprator/laporan/store',
            method: 'POST',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
          }

          action(true);
          await transAjax(param).then((result) => {
            action(false);
            $('#notifLaporan').html(`<div class="alert alert-success">${result.data}</div>`);
            loadLaporan();
          }).catch((err) => {
            action(false);
            $('#notifLaporan').html(`<div class="alert alert-warning">${err.responseJSON.message}</div>`);
          });
        });

        $('#namaLayanan').on('click', function() {
          $('#notif').html('');
        });

        function resetInput()
        {
          $('#notifLaporan').html('');
          $('#keterangan').val('');
        }

        function action(state)
        {
            if(state) {
                $('#btn_loading').removeClass('d-none');
                $('#btn_submit_laporan').addClass('d-none');
            } else {
                $('#btn_loading').addClass('d-none');
                $('#btn_submit_laporan').removeClass('d-none');
            }
        }

      </script>
      @stack('js')
  </body>
</html>
