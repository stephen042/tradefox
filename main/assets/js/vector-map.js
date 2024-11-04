$(function() {
	'use strict';
	$('#vmap').vectorMap({
		map: 'world_en',
		backgroundColor: 'transparent',
		color: '#FFFFFF',
		hoverOpacity: 0.7,
		selectedColor: '#77778e33',
		enableZoom: true,
		showTooltip: true,
		scaleColors: ['#1199FA', '#6c4dc5'],
		values: sample_data,
		normalizeFunction: 'polynomial'
	});
	$('#vmap2').vectorMap({
		map: 'usa_en',
		color: '#1199FA',
		showTooltip: true,
		backgroundColor: 'transparent',
		hoverColor: '#6c4dc5'
	});
	 $('#vmap3').vectorMap({
		map: 'canada_en',
		backgroundColor: null,
		color: '#1199FA',
		hoverColor: '#6c4dc5',
		showTooltip: false
	});

});