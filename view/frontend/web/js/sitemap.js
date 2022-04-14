function initialize() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };

    // Display a map on the page
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
    map.setTilt(45);

    // Multiple Markers
    var markers = [];
    var address = [];
    jQuery('.map-data').each(function(i, obj) {
        address[i] = jQuery(this).attr('data-address');
        var lattitude = jQuery(this).attr('data-lattitude');
        var longitude = jQuery(this).attr('data-longitude');
        markers[i] = [address[i], parseFloat(lattitude).toFixed(6), parseFloat(longitude).toFixed(6)];
    });

    // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow(), marker, i;

    // Loop through our array of markers & place each one on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map
        });

        //Display Infowindow for markers
        var content = address[i];
        google.maps.event.addListener(marker,'click', (function(marker,content,infoWindow){ 
            return function() {
               infoWindow.setContent(content);
               infoWindow.open(map,marker);
            };
        })(marker,content,infoWindow));
    }

    if(markers.length){
        // Automatically center the map fitting all markers on the screen
        map.fitBounds(bounds);
    }

    // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
    if(markers.length == '1'){
        var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
            this.setZoom(14);
            google.maps.event.removeListener(boundsListener);
        });
    }

}

function highlightStore(address, lat, long){
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };

    // Display a map on the page
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
    map.setTilt(45);

    var markers = [];
    markers[0] = [address, parseFloat(lat).toFixed(6), parseFloat(long).toFixed(6)];

    // Loop through our array of markers & place each one on the map  
    var position = new google.maps.LatLng(markers[0][1], markers[0][2]);
    var infowindow = new google.maps.InfoWindow({
      content: address
    });
    bounds.extend(position);
    marker = new google.maps.Marker({
        position: position,
        map: map
    });

    //Display infowindow
    google.maps.event.addListener(marker, 'click', function() {
      infowindow.open(map,marker);
    });

    map.fitBounds(bounds);
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    });
}