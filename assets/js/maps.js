function initialize() {
  var mapOptions = {
    // center: new google.maps.LatLng(41.69445,-70.334687),
    // zoom: 6,
    mapTypeId: google.maps.MapTypeId.TERRAIN
  };
  var map = new google.maps.Map(document.getElementById('map-canvas'),
    mapOptions);




// google.maps.event.addListener(kmlLayer, 'click', function(kmlEvent) {
//     var text = kmlEvent.featureData.description;
//     // showInContentWindow(text);
//     infowindow.setContent(text);
//   });

  // google.maps.event.addListener(kmlLayer, 'click', function(kmlEvent) {
  //   var text = kmlEvent.featureData.description;
  //   showInContentWindow(text);
  // });

  // function showInContentWindow(text) {
  //   var sidediv = document.getElementById('content-window');
  //   sidediv.innerHTML = text;
  // }


  // if(navigator.geolocation) {
  //   navigator.geolocation.getCurrentPosition(function(position) {
  //     var pos = new google.maps.LatLng(position.coords.latitude,
  //                                      position.coords.longitude);

  //     var infowindow = new google.maps.InfoWindow({
  //       map: map,
  //       position: pos,
  //       content: 'Current Location'
  //     });

  //     map.setCenter(pos);
  //   }, function() {
  //     // handleNoGeolocation(true);
  //   });
  // } else {
  //   // Browser doesn't support Geolocation
   
  //   var pos = google.maps.LatLng(41.69445,-70.334687);
  //   map.setCenter(pos);
  //      var infowindow = new google.maps.InfoWindow({
  //       map: map,
  //       position: pos,
  //       content: 'Center of Cape Cod'
  //     });
  //  // handleNoGeolocation(false);
  // }

var defaultBounds = new google.maps.LatLngBounds(
  // new google.maps.LatLng(42.064587,-70.719209),
  new google.maps.LatLng(41.95949,-70.664277),
  new google.maps.LatLng(41.584634,-69.991364));
  // new google.maps.LatLng(41.511662,-69.921327));

 var input = /** @type {HTMLInputElement} */(document.getElementById('searchTextField'));

  var options = {
    bounds: defaultBounds,
    types: ['geocode'],
    componentRestrictions: {country: 'us'},
    zoom: 6
  };
  
  var autocomplete = new google.maps.places.Autocomplete(input, options);
  autocomplete.setBounds(defaultBounds);
  autocomplete.bindTo('bounds', map);

  var iconimg = 'http://watershed.20miletech.net/Build/assets/img/ico-map-marker-home.png';

  var infowindow = new google.maps.InfoWindow();
  var marker = new google.maps.Marker({
    map: map,
    icon: iconimg
  });

  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    input.className = '';
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      // Inform the user that the place was not found and return.
      input.className = 'notfound';
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17);  // Why 17? Because it looks good.
    }
    marker.setIcon(/** @type {google.maps.Icon} */({
      url: iconimg,
      size: new google.maps.Size(71, 71),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(17, 34)
      // ,
      // scaledSize: new google.maps.Size(35, 35)
    }));
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);
     // google.maps.event.trigger(KmlLayer ,'click',"blah",place.geometry.location); 

    var address = '';
    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
    }

    // infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
    // infowindow.open(map, marker);
  });

  // Sets a listener on a radio button to change the filter type on Places
  // Autocomplete.
  // function setupClickListener(id, types) {
  //   var radioButton = document.getElementById(id);
  //   google.maps.event.addDomListener(radioButton, 'click', function() {
  //     autocomplete.setTypes(types);
  //   });
  // }

  // setupClickListener('changetype-all', []);
  // setupClickListener('changetype-establishment', ['establishment']);
  // setupClickListener('changetype-geocode', ['geocode']);

// document.getElementById('map-img').setAttribute("style", "display:none");
 var kmlLayer = new google.maps.KmlLayer({
    url: 'http://watershed.20miletech.net/Build/assets/gis/Cape-Cod-Watersheds.kmz',
    // suppressInfoWindows: true,
    map: map
  });
 

}

document.getElementById('map-img').onclick = initialize();
// document.getElementById('map-img').onclick = console.log('clicked');

google.maps.event.addDomListener(window, 'load', initialize);