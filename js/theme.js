// Initialize colorTheme and mapLayer in localStorage if not already set
if (!localStorage.getItem('colorTheme')) {
  localStorage.setItem('colorTheme', 'light');
}
if (!localStorage.getItem('mapLayer')) {
  localStorage.setItem('mapLayer', 'map');
}

// Dark Mode Toggle
document.getElementById('darkModeToggle').addEventListener('change', function() {
  if (this.checked) { 
      localStorage.setItem('colorTheme', 'dark');
      changeColors('dark');
  } else { 
      localStorage.setItem('colorTheme', 'light');
      changeColors('light');
  }
});

function changeColors(newTheme) {
  if (newTheme === 'dark') {
      $('body').css('--background', 'rgb(24, 26, 37)');
      $('body').css('--text', 'rgb(233, 233, 233)');
      $('body').css('--color', 'rgb(48, 52, 75)');
      if (localStorage.getItem('mapLayer') == 'map'){ //map
        $('.leaflet-tile-pane').addClass('dark-map'); //map dark background
        $('.leaflet-container').css('background-color', 'rgb(23, 58, 77)');
      } else { //sat
        $('.leaflet-tile-pane').removeClass('dark-map');
        $('.leaflet-container').css('background-color', '#141f35'); //sat background
      }
  } else {
      $('body').css('--background', 'rgb(255, 250, 250)');
      $('body').css('--text', 'rgb(0, 0, 0)');
      $('body').css('--color', 'rgb(220, 227, 230)');
      if (localStorage.getItem('mapLayer') == 'map'){ //map
        $('.leaflet-tile-pane').removeClass('dark-map');
        $('.leaflet-container').css('background-color', 'rgb(170, 211, 223)'); //map light background
      } else { //sat
        $('.leaflet-tile-pane').removeClass('dark-map');
        $('.leaflet-container').css('background-color', '#141f35'); //sat background
      }
  }
}

function setInitialStates() {
  const savedColorTheme = localStorage.getItem('colorTheme');
  const savedMapLayer = localStorage.getItem('mapLayer');

  changeColors(savedColorTheme);

  document.getElementById('darkModeToggle').checked = savedColorTheme === 'dark';
  document.getElementById('mapLayerToggle').checked = savedMapLayer === 'sat';
}

$(document).ready(function() {
  setInitialStates();
});
