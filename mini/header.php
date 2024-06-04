<nav class="navbar navbar-expand-lg py-3 px-3 pe-4 p-lg-0">
  <div class="container-fluid p-lg-0 d-flex">

    <div class="d-flex flex-column justify-content-between align-items-center left-nav-buttons fixed-top rounded-4 m-4 flex-shrink-1" style="max-width: fit-content;">

      <div class="d-flex flex-row g-0 w-100 align-items-center justify-content-between">
        <button class="menu-button border-0 p-0" type="button" data-bs-toggle="collapse" data-bs-target="#menuCollapse" aria-expanded="false" aria-controls="menuCollapse">
          <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16" id="menu-collapse-icon">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
          </svg>
        </button>
        <p class="nav-logo px-3 d-flex align-items-center m-0">Tairāwhiti Uncovered.</p>
      </div>
      <div class="collapse menu-box-main flex-grow-1" id="menuCollapse">
        <div class="pt-3">
          <button type="button" class="menu-main-button py-4">
            <div class="d-flex flex-direction-row align-items-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-2 bi bi-info-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
              </svg>
              About
            </div>
            <div class="menu-main-button-rect"></div></button>
        </div>
        <div class="">
          <button type="button" class="menu-main-button py-4" id="newMarkerLink" data-bs-toggle="modal" data-bs-target="#createMarkerModal" >
            <div class="d-flex flex-direction-row align-items-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-2 bi bi-geo" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 1a3 3 0 1 0 0 6 3 3 0 0 0 0-6M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.3 1.3 0 0 0-.37.265.3.3 0 0 0-.057.09V14l.002.008.016.033a.6.6 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.6.6 0 0 0 .146-.15l.015-.033L12 14v-.004a.3.3 0 0 0-.057-.09 1.3 1.3 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465s-2.462-.172-3.34-.465c-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411"/>
              </svg>
              Create New Place
            </div>
            <div class="menu-main-button-rect"></div>
          </button>
        </div>
        <div class="th">

        </div>

      </div>
      <script>

        const myCollapsible = document.getElementById('menuCollapse');
        const menuCollapseIcon = document.getElementById('menu-collapse-icon');

        myCollapsible.addEventListener('show.bs.collapse', event => {
          menuCollapseIcon.style.transform = 'rotate(90deg)';
          menuCollapseIcon.style.backgroundColor = '#42CAFD';
        });

        myCollapsible.addEventListener('hide.bs.collapse', event => {
          menuCollapseIcon.style.transform = 'rotate(0deg)';
          menuCollapseIcon.style.backgroundColor = 'rgba(0, 0, 0, 0)';
        });
      </script>
    </div>

  </div>
</nav> 