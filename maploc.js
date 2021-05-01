let map;

var markers = [ // pull from database later
{"title": 'Zilker',
"lat": '30.3089256',
"lng": '-97.8004624',
"description": 'Zilker Park',
"img": 'logo.jpg'},
{"title": 'Aaa',
"lat": '30.2881647',
"lng": '-97.7921992',
"description": 'AAAA',
"img": 'hamburger.png'},
{"title": 'Bbb',
"lat": '30.2930608',
"lng": '-97.7872553',
"description": 'BBBB',
"img": './chairs/mainimg.jpg'},
];

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(30.2881647,-97.7921992),
        zoom: 12,
        //maptypeid
    });
    // define icons
    const iconBase =
        "https://developers.google.com/maps/documentation/javascript/examples/full/images/";
    const icons = {
        //to be replaced with own picture
        info: {
        icon: iconBase + "info-i_maps.png",
        },
    };
    var infoWindow = new google.maps.InfoWindow();

    for (var i = 0; i < markers.length; i++) {
        var data = markers[i];
        var myLatlng = new google.maps.LatLng(data.lat, data.lng);
        var marker = new google.maps.Marker({
            position: myLatlng,
            //icon: iconBase + "info-i_maps.png",
            map: map,
            title: data.title
        });

        //Attach click event to the marker.
        (function (marker, data) {
            google.maps.event.addListener(marker, "click", function (e) {
                //Wrap the content inside an HTML DIV in order to set height and width of InfoWindow.
                infoWindow.setContent("<div style = 'width:200px;min-height:40px'>" + data.description + "</div>" + 
                                        "<img src="+data.img+" alt="+data.img+">");
                infoWindow.open(map, marker);
            });
        })(marker, data);
        console.log(i, data);
    }
}