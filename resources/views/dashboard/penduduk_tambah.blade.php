@extends('dashboard.tamplate')

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <div class="d-flex">
            <h4 class="me-auto">Tambah Data KK</h6>
              <button id="tomboTambah" type="button" class="btn btn-primary btn-sm shadow-lg">Tambah KK</button>
          </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="modal-body">
            <p class="text-uppercase text-sm">Informasi KK</p>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Nama KK</label>
                  <input name="namaKK" class="form-control" type="text">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Nomer KK</label>
                  <input class="form-control" type="text" name="nomerKK" >
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Jumlah Anggota</label>
                  <input class="form-control" type="number" name="jumlahAnggota">
                </div>
              </div>
            </div>
            <p class="text-uppercase text-sm">Alamat</p>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">RT</label>
                  <input class="form-control" type="number" name="rt" >
                </div>
              </div>
              <div class="col-md-6"></div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Koordinat X</label>
                  <input class="form-control" type="text" name="koordinatx">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Koordinat Y</label>
                  <input class="form-control" type="text"  name="koordinaty">
                </div>
              </div>
            </div>
						<p class="text-sm">Geser Peta untuk mengubah koordinat</p>
            <div class="row">
              <div class="col">
                <div class="map" id="map" style="height: 400px;"></div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-close"
                aria-hidden="true"></i></button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i></button>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection


{{-- section CSS --}}
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.8.0/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection


{{-- section Javascript --}}
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.8.0/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
	const map = L.map('map').setView([-7.7956, 110.3695], 13);
	var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 19,
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(map);
</script>
@endsection
