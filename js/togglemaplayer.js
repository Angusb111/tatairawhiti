function toggleMapLayer (mapLayer) {
    console.log(mapLayer);
}
// Map Layer Toggle
document.getElementById('mapLayerToggle').addEventListener('change', function() {
    if (this.checked) { 
        localStorage.setItem('mapLayer', 'sat');
        $('.leaflet-tile-pane').removeClass('dark-map');
        loadTiles();
    } else { 
        localStorage.setItem('mapLayer', 'map');
        if (localStorage.getItem('colorTheme') === 'dark') {
            $('.leaflet-tile-pane').addClass('dark-map');
        } else {
            $('.leaflet-tile-pane').removeClass('dark-map');
        }
        loadTiles();
    }
  });