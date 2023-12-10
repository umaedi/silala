@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-lg-8 mb-4 order-0">
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-sm-8">
              <div class="card-body">
                <h5 class="card-title text-primary">Selamat datang di dashboard SILALA 🎉</h5>
                <p class="mb-4">
                  Sistem Informasi Layanan Dinas PMPTSP Kabupaten Tulang Bawang
                </p>
              </div>
            </div>
            <div class="col-sm-4 text-center text-sm-left">
              <div class="card-body pb-0 px-0 px-md-4">
                <img loading="lazy"
                  src="{{ asset('img') }}/illustrations/man-with-laptop-light.png"
                  height="140"
                  alt="View Badge User"
                  data-app-dark-img="illustrations/man-with-laptop-dark.png"
                  data-app-light-img="illustrations/man-with-laptop-light.png"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 order-1">
        <div class="row">
          <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img loading="lazy"
                      src="{{ asset('img') }}/avatars/1.png"
                      alt="chart success"
                      class="rounded"
                    />
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Jenis Layanan</span>
                <h3 class="card-title mb-2">{{ $jenis_layanan }}</h3>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img loading="lazy"
                      src="{{ asset('img') }}/avatars/1.png"
                      alt="chart success"
                      class="rounded"
                    />
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Pelayanan hari ini</span>
                <h3 class="card-title mb-2">{{ $laporan_harian }}</h3>
              </div>
            </div>
          </div>
     
        </div>
      </div>
      <!-- Total Revenue -->
      <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
          <div class="col-md mb-4 mb-md-0">
            <div class="card">
              <h5 class="card-header">LAYANAN {{ auth()->user()->opd->nama_opd }}</h5>
              <div class="card-body">
                  @include('layouts._loading')
                  <div class="table-responsive text-nowrap" id="dataTable">
                      
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @include('layouts._modal_laporan')
    </div>
  </div>
@endsection
@push('js')
    <script type="text/javascript">
    var page = 1;
    var search = '';
      $(document).ready(function() {
        loadLaporan();
        loadLayanan();
        $('#search').on('keypress', function(e) {
            if(e.which == 13) {
                filterTable();
                return false;
            }
          });
      });

      function filterTable()
      {
        search = $('#search').val();
        loadLaporan();
      }
      async function loadLaporan() {
          var param = {
          url: '/oprator/laporan',
          method: 'GET',
          data: {
            load: 'table',
            page: page,
            search: search
          }
        }

        loading(true);
        await transAjax(param).then((result) => {
          loading(false);
          $('#dataTable').html(result);
        }).catch((err) => {
          loading(false);
        });
      }

      function loading(state) {
            if(state) {
                $('#loading').removeClass('d-none');
            } else {
                $('#loading').addClass('d-none');
          }
      }

      function loadPaginate(to) {
      page = to
      loadLaporan();
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

          action(true, 'btn_submit_laporan');
          await transAjax(param).then((result) => {
            action(false, 'btn_submit_laporan');
            $('#notifLaporan').html(`<div class="alert alert-success">${result.data}</div>`);
            loadLaporan();
          }).catch((err) => {
            action(false, 'btn_submit_laporan');
            $('#notifLaporan').html(`<div class="alert alert-warning">${err.responseJSON.message}</div>`);
          });
        });

        $('#namaLayanan').on('click', function() {
          $('#notif').html('');
        });

        function action(state, id)
        {
            if(state) {
                $('#btn_loading').removeClass('d-none');
                $('#'+id).addClass('d-none');
            } else {
                $('#btn_loading').addClass('d-none');
                $('#'+id).removeClass('d-none');
            }
        }

        function resetInput()
        {
          $('#notifLaporan').html('');
          $('#keterangan').val('');
        }
    </script>
@endpush