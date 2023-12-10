@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row mb-4">
        <!-- Basic Alerts -->
        <div class="col-md mb-4 mb-md-0">
            <span id="alert"></span>
            <button data-bs-toggle="modal" data-bs-target="#basicModal" class="btn btn-primary mb-3">Tambah Layanan</button>
          <div class="card">
            <h5 class="card-header">Layanan </h5>
            <div class="card-body">
                @include('layouts._loading')
                <div class="table-responsive text-nowrap" id="dataTable">
                    
                </div>
            </div>
          </div>
        </div>
        <!--/ Basic Alerts -->
      </div>
    </div>
    @include('layouts._modal_layanan')
    <div class="content-backdrop fade"></div>
  </div>
@endsection
@push('js')
    <script>
        var search = '';
        var page = 1;
        $(document).ready(function() {
            loadTable();
            loadOpd();

            $('#search').on('keypress', function(e) {
                if(e.which == 13) {
                    filterTable();
                    return false;
                }
            });
        });

        function filterTable() {
            search = $('#search').val();
            loadTable();
        }

        async function loadTable()
        {
            var param = {
                url: '{{ url()->current() }}',
                method: 'GET',
                data: {
                    load: 'table',
                    search: search,
                    page: page,
                }
            }
            
            loading(true);
            await transAjax(param).then((result) => {
                loading(false);
                $('#dataTable').html(result);
            }).catch((err) => {
                loading(false);
                console.log(err);
            })
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
        filterTable()
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
            $('.list_opd').html(result);
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

          action(true, 'btn_submit_layanan');
          await transAjax(param).then((result) => {
            action(false, 'btn_submit_layanan');
            $('#notif').html(`<div class="alert alert-success">${result.data}</div>`);
            loadTable();
          }).catch((err) => {
            action(false, 'btn_submit_layanan');
            $('#notif').html(`<div class="alert alert-warning">${err.message}</div>`);
          });
        });

        $('#namaLayanan').on('click', function() {
          $('#notif').html('');
        });

        $('#namaLayanan').on('click', function() {
          $('#notif').html('');
        });

        function resetInput()
        {
          $('#notifLaporan').html('');
          $('#keterangan').val('');
        }

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
      
        function deleteLayanan(id)
        {
            var param = {
                url: '/admin/layanan/delete/'+id,
                method: 'GET',
            }

            transAjax(param).then((res) => {
                $('#alert').html(`<div class="alert alert-danger">${res.data}</div>`);
                loadTable();
            }).catch((err) => {
                loadTable();
                $('#alert').html(`<div class="alert alert-danger">${err.responseJSON.message}</div>`);
            });
        }
    </script>
@endpush