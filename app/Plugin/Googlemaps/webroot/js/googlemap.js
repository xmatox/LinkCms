
	var geocoder;
	var map;

function initialize() {
	geocoder = new google.maps.Geocoder();
	var latlng = new google.maps.LatLng(-34.397, 150.644);
	var myOptions = {
		zoom: 8,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	
	codeAddress();
}
function codeAddress() {
	var address = $("#address").val();
	if(!address) address = $("#address").html();
	if(!address) address="luchon";
	var contenuib = $("#contenuib").val();
	if(!contenuib) contenuib = $("#contenuib").html();
	if(!contenuib) contenuib=address;
	geocoder.geocode( { 'address': address}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			var contentString = contenuib;
			var infowindow = new google.maps.InfoWindow({
				content: contentString
			});
			map.setCenter(results[0].geometry.location);
			var marker = new google.maps.Marker({
				map: map,
				animation: google.maps.Animation.DROP,
				title:"ok",
				position: results[0].geometry.location
			});
			google.maps.event.addListener(marker, 'click', function() {
			  infowindow.open(map,marker);
			});
		} else {
			alert("Geocode was not successful for the following reason: " + status);
		}
	});
}

function loadScript() {
  var script = document.createElement("script");
  script.type = "text/javascript";
  script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyCAW0ydFo-KLgWLivpfk_LubI8i6N_NKO8&sensor=false&callback=initialize";
  document.body.appendChild(script);
}

window.onload = loadScript;