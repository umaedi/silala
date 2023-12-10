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
                      <select name="opd_id" id="list_opd" class="list_opd form-select">
                        
                      </select>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
              Tutup
            </button>
            @include('layouts._button')
            <button id="btn_submit_layanan" type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </div>
    </form>
  </div>