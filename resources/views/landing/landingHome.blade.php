@extends('landing.tamplateLanding')



@section('content')
  <div id="container">
    <div id="map"></div>

    <div id="sidebar" class="leaflet-sidebar collapsed">
      <!-- nav tabs -->
      <div class="leaflet-sidebar-tabs">
        <!-- top aligned tabs -->
        <ul role="tablist">
          <li>
            <a href="#layers" role="tab"><i class="fas fa-sliders-h"></i></a>
          </li>
          <li>
            <a href="#home" role="tab"><i class="fa fa-bars"></i></a>
          </li>
          <li>
            <a href="#autopan" role="tab"><i class="fa fa-info-circle"></i></a>
          </li>
        </ul>

        <!-- bottom aligned tabs -->
        <ul role="tablist">
          <li>
            <a id="full-extent-btn"><i style="transform: rotate(45deg);" class="fa fa-arrows-alt"></i></a>
          </li>
        </ul>
      </div>

      <!-- panel content -->
      <div class="leaflet-sidebar-content">
        <div class="leaflet-sidebar-pane" id="layers">
          <h1 class="leaflet-sidebar-header">
            Layer
            <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
          </h1>
        </div>

        <div class="leaflet-sidebar-pane" id="home">
          <h1 class="leaflet-sidebar-header">
            Legenda
            <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
          </h1>
          <!-- lokasi menulis keterangan -->
          <br />

          <h6><strong>Pola Ruang</strong></h6>

          <div class="row ms-2  mt-2 d-flex align-items-center">
            <div class='col-1 box' style="background-color: #ff070f;"></div>
            <div class='col-10 '>
              <span>Kawasan Perdagangan dan Jasa</span>
            </div>
          </div>

          <div class="row ms-2 mt-2 d-flex align-items-center">
            <div class='col-1 box' style="background-color: #9101ff;"></div>
            <div class='col-10 '>
              <span> Kawasan Peruntukan Pemerintahan</span>
            </div>
          </div>
          <div class="row ms-2 mt-2 d-flex align-items-center">
            <div class='col-1 box' style="background-color: #ce981a;"></div>
            <div class='col-10 '>
              <span> Kawasan Peruntukan Permukiman</span>
            </div>
          </div>
          <div class="row ms-2 mt-2 d-flex align-items-center">
            <div class='col-1 box' style="background-color: #aae30c;"></div>
            <div class='col-10 '>
              <span> Kawasan Peruntukan Pertanian Lahan Kering </span>
            </div>
          </div>
          <div class="row ms-2 mt-2 d-flex align-items-center">
            <div class='col-1 box' style="background-color: #01ff16;"></div>
            <div class='col-10 '>
              <span> Kawasan Ruang Terbuka Hijau</span>
            </div>
          </div>
          <div class="row ms-2 mt-2 d-flex align-items-center">
            <div class='col-1 box' style="background-color: #3ab5f7;"></div>
            <div class='col-10 '>
              <span> Kawasan Sawah Irigasi</span>
            </div>
          </div>
          <div class="row ms-2 mt-2 d-flex align-items-center">
            <div class='col-1 box' style="background-color: #01ffea;"></div>
            <div class='col-10 '>
              <span> Kawasan Sawah Non Irigasi</span>
            </div>
          </div>

          <hr>
          <h6><strong>Persil</strong> </h6>

          <div class="row ms-2 mt-2 d-flex align-items-center">
            <div class='col-1 box' style="background-color: #fbff076c;"></div>
            <div class='col-10 '>
              <span>Blok Persil</span>
            </div>
          </div>
          <hr>

          <h6><strong>Administrasi</strong> </h6>
          <div class="row ms-2 mt-2 d-flex align-items-center">
            <div class='col-1 line-border' style="border: 2px dashed #000;"></div>
            <div class='col-10 '>
              <span>Batas Dusun</span>
            </div>
          </div>
          <hr>
          <h6><strong>Jaringan</strong> </h6>
          <div class="row ms-2 mt-2 d-flex align-items-center">
            <div class='col-1 line-border' style="border: 2px solid blue;"></div>
            <div class='col-10 '>
              <span>Sungai</span>
            </div>
          </div>
          <div class="row ms-2 mt-2 d-flex align-items-center">
            <div class='col-1 line-border' style="border: 2px solid red;"></div>
            <div class='col-10 '>
              <span>Jaringan Jalan</span>
            </div>
          </div>
          <hr>

          <h6><strong>Lahan Terbangun</strong></h6>
          <div class="row ms-2 mt-2 d-flex align-items-center">
            <div class='col-1 box' style="background-color: #0000009c;"></div>
            <div class='col-10 '>
              <span>Blok Bangunan</span>
            </div>
          </div>

        </div>
        <div class="leaflet-sidebar-pane" id="autopan">
          <h1 class="leaflet-sidebar-header">
            Info
            <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
          </h1>
          <br />
          <h5>Sumber Informasi peta</h5>
          <p style="text-align: justify;">&emsp; peta ini di buat dan disusun oleh desa dengan keperluan untuk informasi persil ke masyarakat Desa Gandulan, Kec Kaloran, Kab Temanggung</p>
        </div>
      </div>
    </div>
  </div>

  <div id="loading">
    <div class="loading-indicator">
      <div class="progress progress-striped active">
        <div class="progress-bar progress-bar-info progress-bar-full"></div>
      </div>
    </div>
  </div>

  <!-- Modal Data -->
  <div class="modal fade" id="modalDataPersil" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="datapersil_judul">No Wajib pajak</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="datapersil_isi">
          <table class="table table-striped table-bordered table-condensed">
            <tbody>
              <tr>
                <th>Nama</th>
                <td id="datapersil_nama">Kirman</td>
              </tr>
              <tr>
                <th>Lokasi</th>
                <td id="datapersil_lokasi">Dusun Kedon, Desa Pasuruhan, Kec. Mertoyudan</td>
              </tr>
              <tr>
                <th>Luas Tanah</th>
                <td id="datapersil_ltanah">500 Meter</td>
              </tr>
              <tr>
                <th>Luas Banguan</th>
                <td id="datapersil_lbangunan">150 Meter</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')

<script src="./src/js/app.js"></script>

@endsection
