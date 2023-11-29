<option value="">--pilih bagian--</option>
@foreach ($data as $opd)
<option value="{{ $opd->id }}">{{ $opd->nama_opd }}</option>
@endforeach