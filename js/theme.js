// Initialize colorTheme in localStorage if not already set
if (!localStorage.getItem('colorTheme')) {
    localStorage.setItem('colorTheme', 'light');
  }

document.getElementById('toggle').addEventListener('change', function() {
    if (this.checked) { //set darkmode
      localStorage.setItem('colorTheme', 'dark');
      changeColors('dark');
    } else { //set lightmode
      localStorage.setItem('colorTheme', 'light');
      changeColors('light');
    }
  });

function changeColors(newTheme) {
if (newTheme == 'dark') { //darkmode
    $('.leaflet-container').css('background-color', 'rgb(23, 58, 77)');
    $('.leaflet-tile-pane').addClass('dark-map');
    $('body').css('--background', 'rgb(24, 26, 37)');
    $('body').css('--text', 'rgb(233, 233, 233)');
    $('body').css('--color', 'rgb(48, 52, 75)');
} else { //lightmode
    $('.leaflet-container').css('background-color', 'rgb(170, 211, 223)');
    $('.leaflet-tile-pane').removeClass('dark-map');
    $('body').css('--background', 'rgb(255, 250, 250)');
    $('body').css('--text', 'rgb(0, 0, 0)');
    $('body').css('--color', 'rgb(220, 227, 230)');
}
}

function setInitialColorTheme() {
savedColorTheme = localStorage.getItem('colorTheme');
changeColors(savedColorTheme);
}

function initThemeSwitch(theme) {
const switchElement = document.getElementById('toggle');
switchElement.checked = !switchElement.checked; // Toggle the checked state
if (savedColorTheme == 'dark') {
    switchElement.checked = true;
} else {
    switchElement.checked = false;
}
}

$(document).ready(function() {
setInitialColorTheme();
initThemeSwitch();
});