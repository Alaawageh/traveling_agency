function initMap() {
    var mapProp= {
        center:new google.maps.LatLng(33.71636819154695,36.57208782564046),
        zoom:15,
    };
    var map = new google.maps.Map(document.getElementById("map"),mapProp);

    google.maps.event.addListener(map, 'click', function(event) {
        place_Marker(map, event.latLng);
    });
}
var marker;
function place_Marker(map, location) {
    $('#lat').val(location.lat())
    $('#lng').val(location.lng())
    if (marker) {
        marker.setPosition(location);
    } else {
        marker = new google.maps.Marker({
            draggable: true,
            position: location,
            animation: google.maps.Animation.DROP,
            map: map
        });
    }
}