function initMap() {
    
    var location = { lat: 31.794525, lng: -7.0849336 };
    
    var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 5,
        center: location,
        
    });
    var marker = new google.maps.Marker({
        position: location,
        map: map,
        icon:"http://maps.google.com/mapfiles/ms/icons/blue-dot.png" ,
        draggable:true

    })
    google.maps.event.addListener(map, 'click', function(event) {
        marker.setPosition(event.latLng);
        document.getElementById("Marker_p").value=marker.getPosition().lat()+","+marker.getPosition().lng();
    });
    
    marker.style.color="blue";
}