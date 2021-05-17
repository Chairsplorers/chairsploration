let map;

function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(30.2849185,-97.7340567),
        zoom: 16,
        //maptypeid
    });
    //optional: add icon
    const geocoder = new google.maps.Geocoder();

    //populate markers array
    updateMarkers(addMarkers, geocoder, map);
}
//pull addresses from sql table
function updateMarkers(callBack, geocoder, map){
	//use ajax
	var xhttp;
	xhttp = new XMLHttpRequest();
	var chairMarkers = {};
	xhttp.onreadystatechange = function() {
		if(xhttp.readyState == 4) {
			//process responseText
			datastream = xhttp.responseText.split('%');
			for(i=0; i<datastream.length-1; i++){
				chair = datastream[i].split("^");
				if(chair[1].length == 0) continue;
				if(!(chair[1] in chairMarkers)){
					chairMarkers[chair[1]] = [{
						title:chair[0],
						description:chair[2],
						rating:chair[3],
						id:chair[4]
					}];
				} else {
					chairMarkers[chair[1]].push({
						title:chair[0],
						description:chair[2],
						rating:chair[3],
						id:chair[4]
					});
				}
			}
			//sort chairs at each location
			for(marker in chairMarkers){
				chairMarkers[marker].sort(function(a,b){return b['rating'] - a['rating']});
			}

			//feed into geolocator/placer function
			callBack(chairMarkers,geocoder,map);
		}
	}
	xhttp.open("GET", "getmarkers.php", true);
	xhttp.send(null);
}

function formatContent(info){
	retstr = "<div style= 'width:200px;min-height:40px;max-height:60px;overflow-y:scroll;'>";
	for(i=0; i<info.length; i++){
		curr = info[i];//should be {title, desc} dictionary
		retstr += "<div style = 'text-align: center; font-weight: bold; font-size: 1em;'>";
		retstr += "<a href='./chairs/chair.php?cid=" + curr.id + "'>" + curr.title + "</a></div>";
		//retstr += "<div>" + curr.rating + "</div>";
	}
	return retstr;
}

function addMarkers(dict, geocoder, map){
	for(key in dict){
		addMarker(key,dict[key],geocoder,map);
	}
}

// convert address to latlng and add to gmaps
function addMarker(addr, info, geocoder, cMap) {
	geocoder.geocode({address: addr}, (results, status) => {
		if (status === "OK") {
			//compute latitude and longitude
			cMarker = new google.maps.Marker({
				map: cMap,
				position: results[0].geometry.location,
				title: info["title"],
			});

			//make the infowindow
			var infoWindow = new google.maps.InfoWindow();

			(function (marker, data) {
				google.maps.event.addListener(marker, "click", function (e) {
					//Wrap the content inside an HTML DIV in order to set height and width of InfoWindow.
					infoWindow.setContent(formatContent(data));
					infoWindow.open(map, marker);
				});
			})(cMarker, info);
		} else {
	       		//alert("Geocode was not successful for the following reason: " + status);
		}
	});
}
