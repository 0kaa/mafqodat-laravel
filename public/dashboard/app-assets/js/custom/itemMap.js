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

    const input = document.getElementById("selectStation");

    var latt = $("#stationLat").val() ? $("#stationLat").val() : 24.740691;

    var lngg = $("#stationLng").val() ? $("#stationLng").val() : 46.6528521;

    var myLatLong = { lat: parseFloat(latt), lng: parseFloat(lngg) };

    const map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: parseFloat(latt), lng: parseFloat(lngg) },
        zoom: 8,
        mapTypeId: "roadmap",
    });

    new google.maps.Marker({
        map,
        position: myLatLong,
    });

    $(input).change(function (e) {
        e.preventDefault();

        initAutocomplete();

        // get lat value from station selected
        var lat = $(this).find(":selected").data("lat");

        // get lng value from station selected
        var lng = $(this).find(":selected").data("lng");

        $("#stationLat").val(lat);
        $("#stationLng").val(lng);

    });

}
