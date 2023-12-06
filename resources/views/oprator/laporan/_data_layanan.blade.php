<option value="">--pilih layanan--</option>
@foreach ($data as $layanan)
<option value="{{ $layanan->id }}">{{ $layanan->nama_layanan }}</option>
@endforeach