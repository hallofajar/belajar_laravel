<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width" />
  <meta name="mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="theme-color" content="#000000" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="icon" href="src/img/logo_tmg.png" />
  <title>SIDUS {{$title ?? ''}}
  </title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.3.0/MarkerCluster.css" />
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.3.0/MarkerCluster.Default.css" />
  <link rel="stylesheet"
    href="https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.css" />
  <link rel="stylesheet" href="src/css/leaflet.groupedlayercontrol.css" />

  <link rel="stylesheet" href="src/css/leaflet-measure.css" />

  <link rel="stylesheet" href="src/css/leaflet-sidebar.css" />
  <link rel="stylesheet" href="src/css/L.Control.Layers.Tree.css" />

  <link rel="stylesheet" href="src/css/app.css" />

  <style>
    .leaflet-sidebar-pane {
      overflow-x: auto;
      min-width: 200px;
    }
  </style>
</head>

<body>




  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img src="src/img/logo_tmg.png" alt="Logo" class="navbar-logo" /> <span
          class="brand-title align-middle">SIDUS Bongoskenti </span></a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#infoModal"><i
                class="fas fa-info-circle"></i>
              Info</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{url('Login')}}" target="_blank">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>



  <!-- Modal Info -->
  <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header alert-dark">


          <h5 class="modal-title" id="exampleModalCenterTitle">
            <i class="fas fa-info-circle"></i> Info
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
          <p>&emsp; Dalam menghadapi tantangan otonomi desa menuju desa yang maju dan mandiri maka masyarakat Desa
            Gandulan
            melalui para pemangku kepentingan pembangunan desa mempunyai harapan untuk mewujudkan masyarakat yang lebih
            sejahtera. Harapan ini dirumuskan dalam Visi Desa Gandulan tahun 2020-2026 yaitu <br><br> <strong><em>“DESA
                GANDULAN
                YANG AGRARIS, AGAMIS, BERBUDAYA, SEJAHTERA, AMAN </em></strong><strong><em>DENGAN PEMERINTAHAN YANG
                BERSIH DAN BERWIBAWA SERTA GANDEM”</em></strong>.</p>
          .<br /><br />
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
            Tutup
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- End of Modal Info -->


  @yield('content')






	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.10.5/typeahead.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.3/handlebars.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/1.1.1/list.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.3.0/leaflet.markercluster.js"></script>
  <script src="https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.min.js">
  </script>
  <script src="src/js/leaflet.groupedlayercontrol.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.6.2/proj4.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/proj4leaflet/1.0.2/proj4leaflet.min.js"></script>
  <script src="src/js/leaflet-measure.js"></script>

  <script src="src/js/leaflet-sidebar.js"></script>
  <script src="src/js/L.Control.Layers.Tree.js"></script>

  <!-- geojson vt  -->
  <!-- <script src="src/js/geojson-vt.js"></script>
                    <script src="src/js/leaflet-geojson-vt.js"></script> -->

  <script src="https://unpkg.com/leaflet.vectorgrid@latest/dist/Leaflet.VectorGrid.bundled.js"></script>
  <script src="https://unpkg.com/leaflet.vectorgrid@latest/dist/Leaflet.VectorGrid.js"></script>

<script>
	// loading
document.addEventListener("DOMContentLoaded", function (event) {
  var element = document.getElementById("loading")
  element.parentNode.removeChild(element)
})

</script>

  @yield('script')



</body>

</html>
