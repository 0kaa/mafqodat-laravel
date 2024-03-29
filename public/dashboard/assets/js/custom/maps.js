$(document).ready(function () {
    initAutocomplete();
});
// This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.
// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
function initAutocomplete() {
    var latt = $("#latitude").val() ? $("#latitude").val() : 24.740691;

    var lngg = $("#longitude").val() ? $("#longitude").val() : 46.6528521;

    var myLatLong = {
        lat: parseFloat($("#latitude").val()),
        lng: parseFloat($("#longitude").val()),
    };

    const map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: parseFloat(latt), lng: parseFloat(lngg) },
        zoom: 8,
        mapTypeId: "roadmap",
    });

    if ($("#latitude").val() != null && $("#longitude").val() != null) {
        new google.maps.Marker({
            map,
            // icon,
            // title: place.name,
            // draggable:true,
            position: myLatLong,
        });
    }



/*
    // creates a draggable marker to the given coords
    var vMarker = new google.maps.Marker({
        position: new google.maps.LatLng(24.740691, 46.6528521),
        draggable: true
    });
    // adds a listener to the marker
    // gets the coords when drag event ends
    // then updates the input with the new coords
    google.maps.event.addListener(vMarker, 'dragend', function (evt) {
        $("#latitude").val(evt.latLng.lat().toFixed(6));
        $("#longitude").val(evt.latLng.lng().toFixed(6));
        map.panTo(evt.latLng);
    });
    // centers the map on markers coords
    map.setCenter(vMarker.position);
    // adds the marker on the map
    vMarker.setMap(map);


 */


    // Create the search box and link it to the UI element.
    const input = document.getElementById("pac-input");
    const searchBox = new google.maps.places.SearchBox(input);

    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    // Bias the SearchBox results towards current map's viewport.
    map.addListener("bounds_changed", () => {
        searchBox.setBounds(map.getBounds());
        console.log(map);
    });

    let markers = [];

    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener("places_changed", () => {
        const places = searchBox.getPlaces();

        if (places.length == 0) {
            return;
        }

        // Clear out the old markers.
        markers.forEach((marker) => {
            marker.setMap(null);
        });
        markers = [];

        // For each place, get the icon, name and location.
        const bounds = new google.maps.LatLngBounds();

        places.forEach((place) => {
            if (!place.geometry || !place.geometry.location) {
                console.log("Returned place contains no geometry");
                return;
            }

            const icon = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25),
            };

            // Create a marker for each place.
            markers.push(
                new google.maps.Marker({
                    map,
                    icon,
                    title: place.name,
                    // draggable:true,
                    position: place.geometry.location,
                })
            );
            if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }

            $("#latitude").val(place.geometry.location.lat());
            $("#longitude").val(place.geometry.location.lng());
        });
        map.fitBounds(bounds);
    });
}
