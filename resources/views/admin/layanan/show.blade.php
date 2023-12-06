@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row mb-4">
        <!-- Basic Alerts -->
        <div class="col-md mb-4 mb-md-0">
          <div class="card">
            <h5 class="card-header">Laporan</h5>
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
    <div class="content-backdrop fade"></div>
  </div>
@endsection
@push('js')
    <script>
        var search = '';
        var page = 1;
        $(document).ready(function() {
            loadTable();

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
    </script>
@endpush