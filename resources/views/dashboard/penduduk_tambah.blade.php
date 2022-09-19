@extends('dashboard.tamplate')

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <div class="d-flex">
            <h4 class="me-auto">Tambah Data KK</h6>
          </div>
        </div>
        <div class="card-body px-4 pt-0 pb-2">
          <form action="{{ url('dashboard/data-penduduk') }}" method="post">
            @csrf
            <div class="modal-body">
              <div class="d-flex justify-content-center">
                <p class="text-uppercase text-sm fw-bolder">Informasi KK</p>
              </div>
              <div class="row d-flex justify-content-center">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Nama KK</label>
                    <input name="namaKK" class="form-control  @error('namaKK') is-invalid  @enderror" type="text"
                      value="{{ old('namaKK') }}">
                    @error('namaKK')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Nomer KK</label>
                    <input class="form-control @error('nomerKK') is-invalid  @enderror" type="text"
                      value="{{ old('nomerKK') }}" name="nomerKK">
                    @error('nomerKK')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Jumlah Anggota</label>
                    <input type="number" name="jumlahAnggota"
                      class="form-control @error('jumlahAnggota') is-invalid  @enderror"
                      value="{{ old('jumlahAnggota') }}">
                    @error('jumlahAnggota')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
              </div>
              <hr>
              <div class="d-flex justify-content-center mt-4">
                <p class="text-uppercase text-sm fw-bolder">Informasi Alamat</p>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">RT</label>
                    <input type="number" name="rt"class="form-control @error('rt') is-invalid  @enderror"
                      value="{{ old('rt') }}">
                    @error('rt')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Koordinat X</label>
                    <input type="text" id="koordinatx" name="koordinatx"
                      value="{{ old('koordinatx') }}"class="form-control @error('koordinatx') is-invalid  @enderror">
                    @error('koordinatx')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Koordinat Y</label>
                    <input type="text" id="koordinaty" name="koordinaty"
                      value="{{ old('koordinaty') }}"class="form-control @error('koordinaty') is-invalid  @enderror">
                    @error('koordinaty')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
              </div>
              <p class="text-sm m-0">Geser Marker untuk mengubah koordinat</p>
              <div class="row">
                <div class="col">
                  <div class="map" id="map" style="height: 400px;"></div>
                </div>
              </div>
              <hr>
            </div>
            <div class="modal-footer mt-4">
              <button type="button" class="btn btn-secondary btn-sm m-1 p-2" data-bs-dismiss="modal"><i
                  class="fa fa-close" aria-hidden="true"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-sm m-1 p-2"><i class="fa fa-save" aria-hidden="true"></i>
                Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection


{{-- section CSS --}}
@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.8.0/leaflet.css"
    integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    hr {
      border: 1px solid #000;
    }

    .styleLabel {
      background: rgba(255, 255, 255, 0);
      border: 0;
      border-radius: 0px;
      box-shadow: 0 0px 0px;
      font-size: 10pt;
      color: white;
      text-shadow: 2px 2px 5px white;
    }
  </style>
@endsection


{{-- section Javascript --}}
@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.8.0/leaflet.js"
    integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Leaflet Label JS Library -->
  <script src="https://unpkg.com/rbush@2.0.2/rbush.min.js"></script>
  <script src="https://unpkg.com/labelgun@6.1.0/lib/labelgun.min.js"></script>
  <script src="{{ url('src/js/labels.js') }}"></script>

  <script>
    const map = L.map('map').setView([-7.970333784748009, 110.26063287978587], 16);

    let google_satelite = L.tileLayer(
      "http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}", {
        maxZoom: 22,
        subdomains: ["mt0", "mt1", "mt2", "mt3"],
      }
    ).addTo(map);
    // Layer Peta

    /* GeoJSON Polygon Batas RT Dusun */
    map.createPane("BatasDusun")
    map.getPane("BatasDusun").style.zIndex = 500
    var BatasDusun = L.geoJson(null, {
      /* Style polygon */
      style: function(feature) {
        //Fungsi style polygon
        return {
          fillColor: feature.properties.fillColor || "red", //Warna tengah polygon
          fillOpacity: 0.01, //Transparansi tengah polygon
          color: "white", //Warna garis tepi polygon
          weight: 1, //Tebal garis tepi polygon
          opacity: 1, //Transparansi garis tepi polygon
          pane: "BatasDusun"
        }
      },
      /* Highlight & Popup */
      onEachFeature: function(feature, layer) {
        // Labeling
        layer.bindTooltip(layer.feature.properties.Batas_RT, {
          direction: 'center',
          permanent: true,
          className: 'styleLabel'
        });
      }
    })
    /* memanggil data geojson polygon */

    fetch("{{ url('src/geojson/BatasDusun.geojson') }}")
      .then(response => response.json())
      .then(data => {
        BatasDusun.addData(data)
        map.addLayer(BatasDusun)
        map.fitBounds(BatasDusun.getBounds())
      })
    /* end GeoJSON Polygon Batas RT Dusun */

    // dragable lokasi
    let marker = L.marker(new L.LatLng(-7.970333784748009, 110.26063287978587), {
      draggable: true
    }).addTo(map);
    marker.on('dragend', function(e) {
      document.getElementById('koordinaty').value = marker.getLatLng().lat;
      document.getElementById('koordinatx').value = marker.getLatLng().lng;
      map.panTo(new L.LatLng(marker.getLatLng().lat, marker.getLatLng().lng));
    });

    // set koordinat marker
    const markerset = () => {
      let lat = (document.getElementById('koordinaty').value) ? document.getElementById('koordinaty').value :
        '-7.970333784748009';
      let lng = (document.getElementById('koordinatx').value) ? document.getElementById('koordinatx').value :
        '110.26063287978587';

      marker.setLatLng([lat, lng]);
      map.panTo(new L.LatLng(lat, lng));
    }

    document.addEventListener('DOMContentLoaded', function() {
      markerset();
    });


    // Reset labels
    resetLabels([BatasDusun]);
    map.on("move", function() {
      resetLabels([BatasDusun]);
    });
    map.on("zoomend", function() {
      resetLabels([BatasDusun]);
    });
    map.on("layeradd", function() {
      resetLabels([BatasDusun]);
    });
    map.on("layerremove", function() {
      resetLabels([BatasDusun]);
    });
  </script>
@endsection
