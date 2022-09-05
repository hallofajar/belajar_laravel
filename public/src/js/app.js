let map, featureList;

$("#about-btn").click(function () {
	$("#aboutModal").modal("show");
	$(".navbar-collapse.in").collapse("hide");
	return false;
});

$("#full-extent-btn").click(function () {
	map.fitBounds(extent_maps.getBounds());
	$(".navbar-collapse.in").collapse("hide");
	return false;
});

/* Basemap Layers */
let cartoLight = L.tileLayer(
	"https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}.png",
	{
		maxZoom: 22,
		attribution: "Carto-basemaps",
	}
);

let google_satelite = L.tileLayer(
	"http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}",
	{
		maxZoom: 22,
		subdomains: ["mt0", "mt1", "mt2", "mt3"],
	}
);

let google_terain = L.tileLayer(
	"http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}",
	{
		maxZoom: 22,
		subdomains: ["mt0", "mt1", "mt2", "mt3"],
	}
);

let crstbig = L.tileLayer(
	"https://portal.ina-sdi.or.id/arcgis/rest/services/CITRASATELIT/JawaBaliNusra_2015_ImgServ1/ImageServer/tile/{z}/{y}/{x}",
	{
		attribution: "CSRT | BIG",
		maxZoom: 19,
	}
);

/* Overlay Layers */
let highlight = L.geoJson(null);
let highlightStyle = {
	stroke: false,
	fillColor: "#00FFFF",
	fillOpacity: 0.7,
	radius: 10,
};

/* Single marker cluster layer to hold all clusters */
let markerClusters = new L.MarkerClusterGroup({
	spiderfyOnMaxZoom: true,
	showCoverageOnHover: false,
	zoomToBoundsOnClick: true,
	disableClusteringAtZoom: 16,
});

/* Map Center */
map = L.map("map", {
	zoom: 12,
	center: [-7.305817, 110.204826],
	layers: [google_satelite],
	zoomControl: false,
	attributionControl: false,
	// measureControl: true
});

map.options.minZoom = 9;
map.options.maxZoom = 22;

map.createPane("pane_extent_maps");
map.getPane("pane_extent_maps").style.zIndex = 1;
let extent_maps = L.geoJson(null, {
	pane: "pane_extent_maps",
});
$.getJSON("src/geojson/outline.geojson", function (data) {
	extent_maps.addData(data);
	// map.addLayer(extent_maps);
	map.fitBounds(extent_maps.getBounds());
});

/* Clear feature highlight when map is clicked */
map.on("click", function (e) {
	highlight.clearLayers();
});

/* Attribution control */
function updateAttribution(e) {
	$.each(map._layers, function (index, layer) {
		if (layer.getAttribution) {
			$("#attribution").html(layer.getAttribution());
		}
	});
}
map.on("layeradd", updateAttribution);
map.on("layerremove", updateAttribution);

let attributionControl = L.control({
	position: "bottomright",
});
attributionControl.onAdd = function (map) {
	let div = L.DomUtil.create("div", "leaflet-control-attribution");
	div.innerHTML = "<a href='https://github.com/hallofajar'>MFS</a>";
	return div;
};
map.addControl(attributionControl);

let zoomControl = L.control
	.zoom({
		position: "topright",
	})
	.addTo(map);

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
			fillOpacity: 0.8,
		},
		circleStyle: {
			weight: 1,
			interactive: false,
		},
		icon: "fa fa-location-arrow",
		metric: false,
		strings: {
			title: "My location",
			popup: "You are within {distance} {unit} from this point",
			outsideMapBoundsMsg: "You seem located outside the boundaries of the map",
		},
		locateOptions: {
			maxZoom: 18,
			watch: true,
			enableHighAccuracy: true,
			maximumAge: 10000,
			timeout: 10000,
		},
	})
	.addTo(map);

// menambahkan Control
var measureControl = L.control
	.measure({
		position: "topright",
		primaryLengthUnit: "meters",
		secondaryLengthUnit: "kilometers",
		primaryAreaUnit: "sqmeters",
		secondaryAreaUnit: "hectares",
	})
	.addTo(map);

// Menambahkan Skala
L.control
	.scale({
		position: "bottomright",
		imperial: false,
		maxWidth: 300,
	})
	.addTo(map);

//control layer
var baseTree = [
	{
		label: "<b>BaseMaps</b>",
		children: [
			{
				label: "Open Street Maps",
				layer: cartoLight,
				name: "Street Map",
			},
			{
				label: "Google Satelite",
				layer: google_satelite,
				name: "Google Satelite",
			},
			{
				label: "Google Terrain",
				layer: google_terain,
				name: "Google Terrain",
			},
			{
				label: "CSRT BIG",
				layer: crstbig,
				name: "CSRT BIG",
			},
		],
	},
];

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
						layer: extent_maps,
					},
				],
			},
			{
				label: "<b>Data Pertanahan</b>",
				// selectAllCheckbox: true,
				children: [
					{
						label: "Persil Desa",
						layer: extent_maps,
					},
				],
			},
			{
				label: "<b>Administrasi</b>",
				// selectAllCheckbox: true,
				children: [
					{
						label: "Batas Dusun",
						layer: extent_maps,
					},
				],
			},

		],
	},
];

var options = {
	collapsed: false,
};

//memasukkan side bar ke dalam peta **** penting ****
// create the sidebar instance and add it to the map
var sidebar = L.control
	.sidebar({
		container: "sidebar",
		position: "left",
		autoPan: true,
	})
	.addTo(map);

/* Larger screens get expanded layer control and visible sidebar */
if (document.body.clientWidth >= 767) {
	sidebar.open("layers");
}

// be notified when a panel is opened
sidebar.on("content", function (ev) {
	switch (ev.id) {
		case "layers":
			sidebar.options.autopan = true;
		case "home":
			sidebar.options.autopan = true;
		case "autopan":
			sidebar.options.autopan = true;
			break;
		default:
			sidebar.options.autopan = false;
	}
});

//// Use the custom grouped layer control, not "L.control.layers"
var layerControl = L.control.layers.tree(baseTree, overlaysTree, options);

layerControl.addTo(map);

var htmlObject = layerControl.getContainer();
var a = document.getElementById("layers");

function setParent(el, newParent) {
	newParent.appendChild(el);
}
setParent(htmlObject, a);
