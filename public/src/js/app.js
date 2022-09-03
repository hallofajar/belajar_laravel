// loading
document.addEventListener("DOMContentLoaded", function (event) {
  var element = document.getElementById("loading")
  element.parentNode.removeChild(element)
})

let map, featureList

$("#about-btn").click(function () {
  $("#aboutModal").modal("show")
  $(".navbar-collapse.in").collapse("hide")
  return false
})

$("#full-extent-btn").click(function () {
  map.fitBounds(extent_maps.getBounds())
  $(".navbar-collapse.in").collapse("hide")
  return false
})

/* Basemap Layers */
let cartoLight = L.tileLayer(
  "https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}.png",
  {
    maxZoom: 22,
    attribution: "Carto-basemaps"
  }
)

let google_satelite = L.tileLayer(
  "http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}",
  {
    maxZoom: 22,
    subdomains: ["mt0", "mt1", "mt2", "mt3"]
  }
)

let google_terain = L.tileLayer(
  "http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}",
  {
    maxZoom: 22,
    subdomains: ["mt0", "mt1", "mt2", "mt3"]
  }
)

let crstbig = L.tileLayer(
  "https://portal.ina-sdi.or.id/arcgis/rest/services/CITRASATELIT/JawaBaliNusra_2015_ImgServ1/ImageServer/tile/{z}/{y}/{x}",
  {
    attribution: "CSRT | BIG",
    maxZoom: 19
  }
)

/* Overlay Layers */
let highlight = L.geoJson(null)
let highlightStyle = {
  stroke: false,
  fillColor: "#00FFFF",
  fillOpacity: 0.7,
  radius: 10
}

/* Single marker cluster layer to hold all clusters */
let markerClusters = new L.MarkerClusterGroup({
  spiderfyOnMaxZoom: true,
  showCoverageOnHover: false,
  zoomToBoundsOnClick: true,
  disableClusteringAtZoom: 16
})

/* Map Center */
map = L.map("map", {
  zoom: 12,
  center: [-7.305817, 110.204826],
  layers: [google_satelite],
  zoomControl: false,
  attributionControl: false
  // measureControl: true
})

map.options.minZoom = 9
map.options.maxZoom = 22

/* GeoJSON Polygon PolaRuang Desa */
map.createPane("polaDesa")
map.getPane("polaDesa").style.zIndex = 500
var polaDesa = L.geoJson(null, {
  /* Style polygon */
  style: function (feature) {
    //Fungsi style polygon
    return {
      fillColor: feature.properties.fillColor || "red", //Warna tengah polygon
      fillOpacity: 0.5, //Transparansi tengah polygon
      color: "black", //Warna garis tepi polygon
      weight: 1, //Tebal garis tepi polygon
      opacity: 1, //Transparansi garis tepi polygon
      pane: "polaDesa"
    }
  },
  /* Highlight & Popup */
  onEachFeature: function (feature, layer) {
    layer.on({
      mouseover: function (e) {
        //Fungsi ketika mouse berada di atas obyek
        var layer = e.target //variabel layer
        layer.setStyle({
          //Highlight style
          weight: 2, //Tebal garis tepi polygon
          color: "#00FFFF", //Warna garis tepi polygon
          opacity: 1, //Transparansi garis tepi polygon
          fillColor: "cyan", //Warna tengah polygon
          fillOpacity: 1 //Transparansi tengah polygon
        })
      },
      mouseout: function (e) {
        //Fungsi ketika mouse keluar dari area obyek
        polaDesa.resetStyle(e.target) //Mengembalikan style polygon ke style awal
        map.closePopup() //Menutup popup
      },
      click: function (e) {
        //Fungsi ketika obyek di-klik
        polaDesa.bindPopup(`Pola Ruang: <br> ${feature.properties.Keterangan}`) //Popup
      }
    })
  }
})
/* memanggil data geojson polygon */

fetch("src/geojson/PolaRuang_Desa.geojson")
  .then(response => response.json())
  .then(data => {
    polaDesa.addData(data)
    map.addLayer(polaDesa)
  })
/* end GeoJSON Polygon PolaRuang Desa */

map.createPane("persilDesa")
map.getPane("persilDesa").style.zIndex = 501

var persilDesa = L.vectorGrid
  .slicer(data_persildesa, {
    rendererFactory: L.svg.tile,

    // setting geojson VT style
    maxZoom: 22,
    pane: "persilDesa",
    vectorTileLayerStyles: {
      sliced: function (properties, zoom) {
        return {
          fill: true,
          fillColor: "yellow", //Warna tengah polygon
          fillOpacity: 0.1, //Transparansi tengah polygon
          color: "black", //Warna garis tepi polygon
          weight: 1, //Tebal garis tepi polygon
          opacity: 1 //Transparansi garis tepi polygon
        }
      }
    },
    interactive: true,
    getFeatureId: function (f) {
      return f.properties.FID
    }
  })
  .on("mouseover", function (e) {
    var properties = e.layer.properties

    L.popup()
      .setContent(
        `Nama Wajib Pajak <br> 
      ${properties.NAMA_WAJIB}`
      )
      .setLatLng(e.latlng)
      .openOn(map)

    //Fungsi ketika mouse berada di atas obyek
    let style_h = {
      //Highlight style
      fill: true,
      weight: 2, //Tebal garis tepi polygon
      color: "#00FFFF", //Warna garis tepi polygon
      opacity: 1, //Transparansi garis tepi polygon
      fillColor: "cyan", //Warna tengah polygon
      fillOpacity: 0.3 //Transparansi tengah polygon
    }
    persilDesa.setFeatureStyle(properties.FID, style_h)
  })
  .on("mouseout", function (e) {
    // Fungsi ketika mouse keluar dari area obyek
    var properties = e.layer.properties
    persilDesa.resetFeatureStyle(properties.FID) //Mengembalikan style polygon ke style awal
    map.closePopup() //Menutup popup
  })
  .on("click", function (e) {
    document.querySelector("#datapersil_judul").innerHTML = `NOP: ${e.layer.properties.NOP}`;
    document.querySelector("#datapersil_nama").innerHTML = `${e.layer.properties.NAMA_WAJIB}`;
    document.querySelector("#datapersil_lokasi").innerHTML = `Kabupaten Temanggung, Kecamatan Kaloran, Desa ${e.layer.properties.DESA}`;
    document.querySelector("#datapersil_ltanah").innerHTML = `${e.layer.properties.LBUMIm2} Meter<sup>2</sup>`;
    document.querySelector("#datapersil_lbangunan").innerHTML = `${e.layer.properties.LBANGm2} Meter<sup>2</sup>`;

    var myModal = new bootstrap.Modal(
      document.getElementById("modalDataPersil"),
      {
        keyboard: false
      }
    );

    myModal.show();
  });
// .addTo(map)


/* GeoJSON Polygon PolaRuang Desa */
map.createPane("adminDusun")
map.getPane("adminDusun").style.zIndex = 503
var adminDusun = L.geoJson(null, {
  /* Style polygon */
  style: function (feature) {
    //Fungsi style polygon
    return {
      dashArray: "5, 10",
      fillColor: feature.properties.fillColor || "red", //Warna tengah polygon
      fillOpacity: 0, //Transparansi tengah polygon
      color: "black", //Warna garis tepi polygon
      weight: 3, //Tebal garis tepi polygon
      opacity: 1, //Transparansi garis tepi polygon
      pane: "adminDusun"
    }
  },
  /* Highlight & Popup */
  onEachFeature: function (feature, layer) {
    layer.on({
      // mouseover: function (e) {
      //   //Fungsi ketika mouse berada di atas obyek
      //   var layer = e.target //variabel layer
      //   layer.setStyle({
      //     //Highlight style
      //     weight: 2, //Tebal garis tepi polygon
      //     color: "#00FFFF", //Warna garis tepi polygon
      //     opacity: 1, //Transparansi garis tepi polygon
      //     fillColor: "cyan", //Warna tengah polygon
      //     fillOpacity: 1 //Transparansi tengah polygon
      //   })
      // },
      // mouseout: function (e) {
      //   //Fungsi ketika mouse keluar dari area obyek
      //   adminDusun.resetStyle(e.target) //Mengembalikan style polygon ke style awal
      //   map.closePopup() //Menutup popup
      // },
      click: function (e) {
        //Fungsi ketika obyek di-klik
        adminDusun.bindPopup(`Dusun: <br> ${feature.properties.Dusun}`) //Popup
      }
    })
  }
})
/* memanggil data geojson polygon */
fetch("src/geojson/admin_dusun.geojson")
  .then(response => response.json())
  .then(data => {
    adminDusun.addData(data)
    // map.addLayer(adminDusun)
  });



/* GeoJSON Polyline Sungai */
map.createPane("sungai_ln")
map.getPane("sungai_ln").style.zIndex = 521
var sungai_ln = L.geoJson(null, {
  /* Style polygon */
  style: function (feature) {
    //Fungsi style polygon
    return {
      color: "blue", //Warna garis tepi polygon
      weight: 7, //Tebal garis tepi polygon
      opacity: 0.3, //Transparansi garis tepi polygon
      pane: "sungai_ln"
    }
  },
  /* Highlight & Popup */
  // onEachFeature: function (feature, layer) {
  //   layer.on({
  //     mouseover: function (e) {
  //       //Fungsi ketika mouse berada di atas obyek
  //       var layer = e.target //variabel layer
  //       layer.setStyle({
  //         //Highlight style
  //         weight: 2, //Tebal garis tepi polygon
  //         color: "#00FFFF", //Warna garis tepi polygon
  //         opacity: 1, //Transparansi garis tepi polygon
  //         fillColor: "cyan", //Warna tengah polygon
  //         fillOpacity: 1 //Transparansi tengah polygon
  //       })
  //     },
  //     mouseout: function (e) {
  //       //Fungsi ketika mouse keluar dari area obyek
  //       sungai_ln.resetStyle(e.target) //Mengembalikan style polygon ke style awal
  //       map.closePopup() //Menutup popup
  //     },
  //     click: function (e) {
  //       //Fungsi ketika obyek di-klik
  //       sungai_ln.bindPopup(`Dusun: <br> ${feature.properties.Dusun}`) //Popup
  //     }
  //   })
  // }
})
/* memanggil data geojson polygon */
fetch("src/geojson/sungai.geojson")
  .then(response => response.json())
  .then(data => {
    sungai_ln.addData(data)
    // map.addLayer(sungai_ln)
  });


map.createPane("jalan_ln")
map.getPane("jalan_ln").style.zIndex = 521
var jalan_ln = L.geoJson(null, {
  /* Style polygon */
  style: function (feature) {
    //Fungsi style polygon
    return {
      color: "red", //Warna garis tepi polygon
      weight: 3, //Tebal garis tepi polygon
      opacity: 0.7, //Transparansi garis tepi polygon
      pane: "jalan_ln"
    }
  },
  /* Highlight & Popup */
  // onEachFeature: function (feature, layer) {
  //   layer.on({
  //     mouseover: function (e) {
  //       //Fungsi ketika mouse berada di atas obyek
  //       var layer = e.target //variabel layer
  //       layer.setStyle({
  //         //Highlight style
  //         weight: 2, //Tebal garis tepi polygon
  //         color: "#00FFFF", //Warna garis tepi polygon
  //         opacity: 1, //Transparansi garis tepi polygon
  //         fillColor: "cyan", //Warna tengah polygon
  //         fillOpacity: 1 //Transparansi tengah polygon
  //       })
  //     },
  //     mouseout: function (e) {
  //       //Fungsi ketika mouse keluar dari area obyek
  //       jalan_ln.resetStyle(e.target) //Mengembalikan style polygon ke style awal
  //       map.closePopup() //Menutup popup
  //     },
  //     click: function (e) {
  //       //Fungsi ketika obyek di-klik
  //       jalan_ln.bindPopup(`Dusun: <br> ${feature.properties.Dusun}`) //Popup
  //     }
  //   })
  // }
})
/* memanggil data geojson polygon */
fetch("src/geojson/jalan.geojson")
  .then(response => response.json())
  .then(data => {
    jalan_ln.addData(data)
    // map.addLayer(jalan_ln)
  });


map.createPane("blok_bangunan")
map.getPane("blok_bangunan").style.zIndex = 505

var blok_bangunan = L.vectorGrid
  .slicer(data_blok_bangunan, {
    rendererFactory: L.svg.tile,

    // setting geojson VT style
    maxZoom: 22,
    pane: "blok_bangunan",
    vectorTileLayerStyles: {
      sliced: function (properties, zoom) {
        return {
          fill: true,
          fillColor: "black", //Warna tengah polygon
          fillOpacity: 0.8, //Transparansi tengah polygon
          color: "black", //Warna garis tepi polygon
          weight: 1, //Tebal garis tepi polygon
          opacity: 0,//Transparansi garis tepi polygon

        }
      }
    },
    interactive: true,
    getFeatureId: function (f) {
      return f.properties.FID
    }
  });
// .on("mouseover", function (e) {
//   var properties = e.layer.properties

//   L.popup()
//     .setContent(
//       `Nama Wajib Pajak <br> 
//       ${properties.NAMA_WAJIB}`
//     )
//     .setLatLng(e.latlng)
//     .openOn(map)

//   //Fungsi ketika mouse berada di atas obyek
//   let style_h = {
//     //Highlight style
//     fill: true,
//     weight: 2, //Tebal garis tepi polygon
//     color: "#00FFFF", //Warna garis tepi polygon
//     opacity: 1, //Transparansi garis tepi polygon
//     fillColor: "cyan", //Warna tengah polygon
//     fillOpacity: 0.3 //Transparansi tengah polygon
//   }
//   blok_bangunan.setFeatureStyle(properties.FID, style_h)
// })
// .on("mouseout", function (e) {
//   // Fungsi ketika mouse keluar dari area obyek
//   var properties = e.layer.properties
//   blok_bangunan.resetFeatureStyle(properties.FID) //Mengembalikan style polygon ke style awal
//   map.closePopup() //Menutup popup
// })
// .on("click", function (e) {
//   document.querySelector("#datapersil_judul").innerHTML = `NOP: ${e.layer.properties.NOP}`;

//   var myModal = new bootstrap.Modal(
//     document.getElementById("modalDataPersil"),
//     {
//       keyboard: false
//     }
//   );

//   myModal.show();
// });




map.createPane("pane_extent_maps")
map.getPane("pane_extent_maps").style.zIndex = 1
let extent_maps = L.geoJson(null, {
  pane: "pane_extent_maps"
})
$.getJSON("src/geojson/outline.geojson", function (data) {
  extent_maps.addData(data)
  // map.addLayer(extent_maps);
  map.fitBounds(extent_maps.getBounds())
})

/* Clear feature highlight when map is clicked */
map.on("click", function (e) {
  highlight.clearLayers()
})

/* Attribution control */
function updateAttribution(e) {
  $.each(map._layers, function (index, layer) {
    if (layer.getAttribution) {
      $("#attribution").html(layer.getAttribution())
    }
  })
}
map.on("layeradd", updateAttribution)
map.on("layerremove", updateAttribution)

let attributionControl = L.control({
  position: "bottomright"
})
attributionControl.onAdd = function (map) {
  let div = L.DomUtil.create("div", "leaflet-control-attribution")
  div.innerHTML =
    "Leaflet | Desa Gandul | <a href='https://github.com/hallofajar'>M.FAJAR.S</a>"
  return div
}
map.addControl(attributionControl)

let zoomControl = L.control
  .zoom({
    position: "topright"
  })
  .addTo(map)

/* GPS enabled geolocation control set to follow the user's location */
let locateControl = L.control
  .locate({
    position: "topright",
    drawCircle: true,
    follow: true,
    setView: true,
    keepCurrentZoomLevel: true,
    markerStyle: {
      weight: 1,
      opacity: 0.8,
      fillOpacity: 0.8
    },
    circleStyle: {
      weight: 1,
      interactive: false
    },
    icon: "fa fa-location-arrow",
    metric: false,
    strings: {
      title: "My location",
      popup: "You are within {distance} {unit} from this point",
      outsideMapBoundsMsg: "You seem located outside the boundaries of the map"
    },
    locateOptions: {
      maxZoom: 18,
      watch: true,
      enableHighAccuracy: true,
      maximumAge: 10000,
      timeout: 10000
    }
  })
  .addTo(map)

// menambahkan Control
var measureControl = L.control
  .measure({
    position: "topright",
    primaryLengthUnit: "meters",
    secondaryLengthUnit: "kilometers",
    primaryAreaUnit: "sqmeters",
    secondaryAreaUnit: "hectares"
  })
  .addTo(map)

// Menambahkan Skala
L.control
  .scale({
    position: "bottomright",
    imperial: false,
    maxWidth: 300
  })
  .addTo(map)

//control layer
var baseTree = [
  {
    label: "<b>BaseMaps</b>",
    children: [
      {
        label: "Open Street Maps",
        layer: cartoLight,
        name: "Street Map"
      },
      {
        label: "Google Satelite",
        layer: google_satelite,
        name: "Google Satelite"
      },
      {
        label: "Google Terrain",
        layer: google_terain,
        name: "Google Terrain"
      },
      {
        label: "CSRT BIG",
        layer: crstbig,
        name: "CSRT BIG"
      }
    ]
  }
]

var overlaysTree = [
  {
    label: ' <b>LAYERS <i class="fa fa-map" style="font-size:18px"></i></b>',
    // selectAllCheckbox: 'Un/select all',
    children: [
      {
        label: "<b>Tata Ruang</b>",
        // selectAllCheckbox: true,
        children: [
          {
            label: "Pola Ruang",
            layer: polaDesa
          }
        ]
      },
      {
        label: "<b>Data Pertanahan</b>",
        // selectAllCheckbox: true,
        children: [
          {
            label: "Persil Desa",
            layer: persilDesa
          }
        ]
      },
      {
        label: "<b>Administrasi</b>",
        // selectAllCheckbox: true,
        children: [
          {
            label: "Batas Dusun",
            layer: adminDusun
          }
        ]
      },
      {
        label: "<b>Jaringan</b>",
        // selectAllCheckbox: true,
        children: [
          {
            label: "Sungai",
            layer: sungai_ln
          },
          {
            label: "Jaringan Jalan",
            layer: jalan_ln
          },
        ]
      },
      {
        label: "<b>Lahan Terbangun</b>",
        // selectAllCheckbox: true,
        children: [
          {
            label: "Blok Bangunan",
            layer: blok_bangunan
          },
        ]
      }
    ],
  }
]

var options = {
  collapsed: false
}

//memasukkan side bar ke dalam peta **** penting ****
// create the sidebar instance and add it to the map
var sidebar = L.control
  .sidebar({
    container: "sidebar",
    position: "left",
    autoPan: true
  })
  .addTo(map)

/* Larger screens get expanded layer control and visible sidebar */
if (document.body.clientWidth >= 767) {
  sidebar.open("layers")
}

// be notified when a panel is opened
sidebar.on("content", function (ev) {
  switch (ev.id) {
    case "layers":
      sidebar.options.autopan = true
    case "home":
      sidebar.options.autopan = true
    case "autopan":
      sidebar.options.autopan = true
      break
    default:
      sidebar.options.autopan = false
  }
})

//// Use the custom grouped layer control, not "L.control.layers"
var layerControl = L.control.layers.tree(baseTree, overlaysTree, options)

layerControl.addTo(map)

var htmlObject = layerControl.getContainer()
var a = document.getElementById("layers")

function setParent(el, newParent) {
  newParent.appendChild(el)
}
setParent(htmlObject, a)
