var map;
var markerData = {address:'' , name: '', tel:'', index:''};
function initialize(event){
    var mapOptions = {
        zoom: 16,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var icon = {
        url: base_url+"assets/home/img/icons/ico-pin.png", // url
        scaledSize: new google.maps.Size(30, 30), // scaled size
        origin: new google.maps.Point(0,0), // origin
        anchor: new google.maps.Point(0, 0) // anchor
    };

    if($(".store-modal-wrap").is(":visible")){
       var map = new google.maps.Map(document.getElementById("map-canvas"),mapOptions);
    }
    else if($("#cs_map").is(":visible")){
        var map = new google.maps.Map(document.getElementById("cs_map"),mapOptions);
    }
    else{
        $("#mapPreview").addClass('active');
        var map = new google.maps.Map(document.getElementById("map-canvas-1"),mapOptions);
    }

    var geocoder = new google.maps.Geocoder();

    geocoder.geocode( { 'address':markerData.address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            marker = new google.maps.Marker({
                map: map,
                icon: icon, // 마커로 사용할 이미지(변수)
                title: markerData.name,
                position: results[0].geometry.location
            });

            var content = markerData.name+"<br/><br/>Tel :  "+markerData.tel; // 마커 누르면 보여지는 박스
            var infowindow = new google.maps.InfoWindow({ content: content});

            google.maps.event.addListener(marker, "click", function() {infowindow.open(map,marker);});
        } 
        // else{ // 1025 주석처리 : IE
        //  alert("Geocode was not successful for the following reason: " + status);
        // }
    });
};
