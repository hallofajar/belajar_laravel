function init() {
  map.on("click", GetFeatureInfoWMS, polaruang);

  function GetFeatureInfoWMS(e) {
    if (statuspola === "add") {
      let content;
      let me = this,
        map = me._map,
        loc = e.latlng,
        xy = e.containerPoint, // xy = map.latLngToContainerPoint(loc,map.getZoom())
        size = map.getSize(),
        bounds = map.getBounds(),
        url = me._url,
        crs = me.options.crs || map.options.crs, // me._crs
        sw = crs.project(bounds.getSouthWest()),
        ne = crs.project(bounds.getNorthEast()),
        params = me.wmsParams,
        obj = {
          service: "WMS", // WMS (default)
          version: params.version,
          request: "GetFeatureInfo",
          layers: params.layers,
          styles: params.styles,
          //bbox: bounds.toBBoxString(), // works only with EPSG4326, but not with EPSG3857
          bbox: sw.x + "," + sw.y + "," + ne.x + "," + ne.y, // works with both EPSG4326, EPSG3857
          width: size.x,
          height: size.y,
          query_layers: params.layers,
          info_format: "application/json", // text/plain (default), application/json for JSON (CORS enabled servers), text/javascript for JSONP (JSONP enabled servers)
          feature_count: 1, // 1 (default)
          //exceptions: 'application/vnd.ogc.se_xml', // application/vnd.ogc.se_xml (default)
          //format_options: 'callback: parseResponse' // callback: parseResponse (default), use only with JSONP enabled servers, when you want to change the callback name
        };
      if (parseFloat(params.version) >= 1.6) {
        obj.crs = crs.code; // params.crs
        obj.i = xy.x;
        obj.j = xy.y;
      } else {
        obj.srs = crs.code; // params.srs
        obj.x = xy.x;
        obj.y = xy.y;
      }

      $.ajax({
        url: urlpeta + L.Util.getParamString(obj, url, true),
        //dataType: 'jsonp', // use only with JSONP enabled servers
        //jsonpCallback: 'parseResponse', // parseResponse (default), use only with JSONP enabled servers, change only when you changed the callback name in request using format_options: 'callback: parseResponse'
        success: function (data, status, xhr) {
          let features = data.features,
            content = "",
            // eslint-disable-next-line no-unused-vars
            popup;
          map.removeLayer(vector);
          //console.log(data);
          if (features.length) {
            vector = L.geoJSON(data).addTo(map); // works only with EPSG4326, but EPSG3857 doesn't highlights geometry, so we used proj4, proj4leaflet to convert geojson from EPSG3857 to EPSG4326
            //vector = L.Proj.geoJson(data).addTo(map); // works with both EPSG4326, EPSG3857
            for (let i in features) {
              let feature = features[i],
                attributes = feature.properties;
              content +=
                "<br/><b>Pola Ruang:</b> " + attributes.pola_iv + "<br/>";
            }
            popup = L.popup(null, me)
              .setLatLng(loc)
              .setContent(content)
              .openOn(map);
            me.on("popupclose", function () {
              map.removeLayer(vector);
              me.off("popupclose", function () {});
            });
          } else {
            content = "No features found.";
            popup = L.popup().setLatLng(loc).setContent(content).openOn(map);
          }
        },
        error: function (xhr, status, err) {
          map.removeLayer(vector);
          content = "Unable to complete the request.: " + err;
          L.popup().setLatLng(loc).setContent(content).openOn(map);
        },
      });
    }
  }
}
