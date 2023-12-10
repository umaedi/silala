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
              Tutup
            </button>
            @include('layouts._button')
            <button id="btn_submit_laporan" type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </div>
    </form>
  </div>