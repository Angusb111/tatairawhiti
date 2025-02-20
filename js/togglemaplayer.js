function toggleMapLayer (mapLayer) {
    console.log(mapLayer);
    
    
}

// Map Layer Toggle
document.getElementById('mapLayerToggle').addEventListener('change', function() {
    if (this.checked) { 
        localStorage.setItem('mapLayer', 'sat');

        window.location.reload();
        
    } else { 
        localStorage.setItem('mapLayer', 'map');

        window.location.reload();

    }
  });