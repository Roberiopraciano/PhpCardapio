(function(A) {

	if (!Array.prototype.forEach)
		A.forEach = A.forEach || function(action, that) {
			for (var i = 0, l = this.length; i < l; i++)
				if (i in this)
					action.call(that, this[i], i, this);
			};

		})(Array.prototype);

		var
		mapObject,
		markers = [],
		markersData = {
			'Chinese': [
			{
				name: 'Golden Bowl',
				location_latitude: 48.865633, 
				location_longitude: 2.321236,
				map_image_url: 'img/thumb_restaurant_map.png',
				name_point: 'Golden Bowl',
				type_point: 'Chinese/Japanese',
				description_point: '135 Newtownards Road, Belfast, BT4<br><strong>Opening time</strong>: 09am-10pm.',
				url_point: 'detail_page.html'
			},
			{
				name: 'Oriental Chinese',
				location_latitude: 48.854183,
				location_longitude: 2.354808,
				map_image_url: 'img/thumb_restaurant_map.png',
				name_point: 'Oriental Chinese',
				type_point: 'Chinese/Japanese',
				description_point: '135 Newtownards Road, Belfast, BT4<br><strong>Opening time</strong>: 09am-10pm.',
				url_point: 'detail_page.html'
			},
			{
				name: 'Dragon Tower',
				location_latitude: 48.852729, 
				location_longitude: 2.350564,
				map_image_url: 'img/thumb_restaurant_map.png',
				name_point: 'Dragon Tower',
				type_point: 'Chinese/Japanese',
				description_point: '135 Newtownards Road, Belfast, BT4<br><strong>Opening time</strong>: 09am-10pm.',
				url_point: 'detail_page.html'
			}
			],
			'Pizza': [
			{
				name: 'O Sole mio',
				location_latitude: 48.860819, 
				location_longitude: 2.354507,
				map_image_url: 'img/thumb_restaurant_map.png',
				name_point: 'O Sole mio',
				type_point: 'Pizza/Italian',
				description_point: '135 Newtownards Road, Belfast, BT4<br><strong>Opening time</strong>: 09am-10pm.',
				url_point: 'detail_page.html'
			},
			{
				name: 'Naples Pizza',
				location_latitude: 48.853798,
				location_longitude: 2.333328,
				map_image_url: 'img/thumb_restaurant_map.png',
				name_point: 'Naples Pizza',
				type_point: 'Pizza/Italian',
				description_point: '135 Newtownards Road, Belfast, BT4<br><strong>Opening time</strong>: 09am-10pm.',
				url_point: 'detail_page.html'
			}
			],
			'Sushi': [
			{
				name: 'New Hong Kong',
				location_latitude: 48.865784,
				location_longitude: 2.307314,
				map_image_url: 'img/thumb_restaurant_map.png',
				name_point: 'New Hong Kong',
				type_point: 'Sushi',
				description_point: '135 Newtownards Road, Belfast, BT4<br><strong>Opening time</strong>: 09am-10pm.',
				url_point: 'detail_page.html'
			}
			]
		};

			var mapOptions = {
				zoom: 14,
				center: new google.maps.LatLng(48.865633, 2.321236),
				mapTypeId: google.maps.MapTypeId.ROADMAP,

				mapTypeControl: false,
				mapTypeControlOptions: {
					style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
					position: google.maps.ControlPosition.LEFT_CENTER
				},
				panControl: false,
				panControlOptions: {
					position: google.maps.ControlPosition.TOP_RIGHT
				},
				zoomControl: true,
				zoomControlOptions: {
					style: google.maps.ZoomControlStyle.LARGE,
					position: google.maps.ControlPosition.RIGHT_BOTTOM
				},
				scrollwheel: false,
				scaleControl: false,
				scaleControlOptions: {
					position: google.maps.ControlPosition.TOP_LEFT
				},
				streetViewControl: true,
				streetViewControlOptions: {
					position: google.maps.ControlPosition.RIGHT_BOTTOM
				},
				styles: 
				[{"featureType":"landscape","stylers":[{"hue":"#FFBB00"},{"saturation":43.400000000000006},{"lightness":37.599999999999994},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#FFC200"},{"saturation":-61.8},{"lightness":45.599999999999994},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":51.19999999999999},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":52},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#0078FF"},{"saturation":-13.200000000000003},{"lightness":2.4000000000000057},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#00FF6A"},{"saturation":-1.0989010989011234},{"lightness":11.200000000000017},{"gamma":1}]}]

			};
			var
			marker;
			mapObject = new google.maps.Map(document.getElementById('map_listing'), mapOptions);
			for (var key in markersData)
				markersData[key].forEach(function (item) {
					marker = new google.maps.Marker({
						position: new google.maps.LatLng(item.location_latitude, item.location_longitude),
						map: mapObject,
						icon: 'img/pins/' + key + '.png',
					});

					if ('undefined' === typeof markers[key])
						markers[key] = [];
					markers[key].push(marker);
					google.maps.event.addListener(marker, 'click', (function () {
      closeInfoBox();
      getInfoBox(item).open(mapObject, this);
      mapObject.setCenter(new google.maps.LatLng(item.location_latitude, item.location_longitude));
     }));

	});
	
		function hideAllMarkers () {
			for (var key in markers)
				markers[key].forEach(function (marker) {
					marker.setMap(null);
				});
		};

		function closeInfoBox() {
			$('div.infoBox').remove();
		};

		function getInfoBox(item) {
			return new InfoBox({
				content:
				'<div class="marker_info" id="marker_info">' +
				'<img src="' + item.map_image_url + '" alt=""/>' +
				'<h3>'+ item.name_point +'</h3>' +
				'<em>'+ item.type_point +'</em>' +
				'<span>'+ item.description_point +'</span>' +
				'<a href="'+ item.url_point + '" class="btn_1">Details</a>' +
				'</div>',
				disableAutoPan: false,
				maxWidth: 0,
				pixelOffset: new google.maps.Size(10, 110),
				closeBoxMargin: '5px -20px 2px 2px',
				closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif",
				isHidden: false,
				alignBottom: true,
				pane: 'floatPane',
				enableEventPropagation: true
			});
		};
		function onHtmlClick(location_type, key){
     google.maps.event.trigger(markers[location_type][key], "click");
	 };