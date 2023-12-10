@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold">Pengaturan Akun</h4>
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <h5 class="card-header">Detail Profil</h5>
          <!-- Account -->
          <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-4">
              <img
                src="{{ asset('img') }}/avatars/1.png"
                alt="user-avatar"
                class="d-block rounded"
                height="100"
                width="100"
                id="uploadedAvatar"
              />
            </div>
          </div>
          <hr class="my-0" />
          <div class="card-body">
            <form id="formAccountSettings" action="/user/profile-information" method="POST" onsubmit="return false">
                @method('PUT')
                @csrf
              <div class="row">
                <div class="mb-3 col-md-12">
                  <label for="firstName" class="form-label">Nama Lengkap</label>
                  <input
                    class="form-control"
                    type="text"
                    id="firstName"
                    name="name"
                    value="{{ auth()->user()->name }}"
                  />
                </div>
                <div class="mb-3 col-md-12">
                  <label for="firstName" class="form-label">Email</label>
                  <input
                    class="form-control"
                    type="email"
                    id="firstName"
                    name="email"
                    value="{{ auth()->user()->email }}"
                  />
                </div>
              </div>
              <div class="mt-2">
                <button id="btn_loading_update" class="btn_loading btn btn-primary d-none" type="button" disabled>
                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                  Loading...
                </button>
                <button id="btn_update" type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
              </div>
            </form>
          </div>
          <!-- /Account -->
        </div>
        <span id="notif"></span>
        <form id="formPassword">
        @method('PUT')
        @csrf
        <div class="card">
          <h5 class="card-header">Password</h5>
          <div class="card-body">
            <div class="mb-3 col-md-12">
              <label for="firstName" class="form-label">Password saat ini</label>
              <input
                class="form-control"
                type="password"
                id="firstName"
                name="password_lama"
              />
            </div>
            <div class="mb-3 col-md-12">
              <label for="firstName" class="form-label">Password baru</label>
              <input
                class="form-control"
                type="password"
                id="firstName"
                name="password_baru"
              />
            </div>
            <div class="mt-2">
              <button id="btn_loading_account" class="btn_loading btn btn-primary d-none" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
              </button>
              <button id="btn_deactivation" type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
            </div>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
@endsection
@push('js')
    <script type="text/javascript">
        $('#formAccountSettings').on('submit', async function(e) {
            e.preventDefault();
            
            var form = $(this)[0];
            var data = new FormData(form);

            var param = {
                url: '/admin/profile/update',
                method: 'POST',
                data: data,
                processData: false,
                contentType: false,
            }
            loading(true, 'btn_update' , 'btn_loading_update');
            await transAjax(param).then((result) => {
              loading(false, 'btn_update', 'btn_loading_update');
              $('#notif').html(`<div class="alert alert-success">${result.data}</div>`);
            }).catch((err) => {
              loading(false, 'btn_update', 'btn_loading_update');
              $('#notif').html(`<div class="alert alert-success">${err.responseJSON.message}</div>`);
            })
        });

        $('#formPassword').on('submit', async function(e) {
            e.preventDefault();
            
            var form = $(this)[0];
            var data = new FormData(form);

            var param = {
                url: '/admin/profile/update/password',
                method: 'POST',
                data: data,
                processData: false,
                contentType: false,
            }
            loading(true, 'btn_deactivation', 'btn_loading_account');
            await transAjax(param).then((result) => {
              loading(false, 'btn_deactivation','btn_loading_account');
              $('#notif').html(`<div class="alert alert-success">${result.data}</div>`);
            }).catch((err) => {
              loading(false, 'btn_deactivation', 'btn_loading_account');
              $('#notif').html(`<div class="alert alert-success">${err.responseJSON.message}</div>`);
            })
        });

        function loading(state, btn, spinner)
        {
          if(state) {
            $('#'+btn).addClass('d-none');
            $('#'+spinner).removeClass('d-none');
          }else {
            $('#'+btn).removeClass('d-none');
            $('#'+spinner).addClass('d-none');
          }
        }
    </script>
@endpush