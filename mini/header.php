<nav class="d-flex p-0">
  <div class="container-fluid p-0">
    <div class="nav-bar d-flex flex-column justify-content-between align-items-center left-nav-buttons fixed-top  m-0 m-md-4 flex-shrink-1 col-12" style="">
      <div class="d-flex flex-row g-0 w-100 align-items-center justify-content-between">
        <button class="menu-button border-0 p-0" type="button" data-bs-toggle="collapse" data-bs-target="#menuCollapse" aria-expanded="false" aria-controls="menuCollapse">
          <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="white" class="bi bi-list" viewBox="0 0 16 16" id="menu-collapse-icon">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
          </svg>
        </button>
        <p class="nav-logo px-0 px-md-3 d-flex align-items-center m-0">Tairāwhiti Uncovered</p>
        <div class="mobile-header-spacer"></div>
      </div>
      <div class="collapse menu-box-main flex-grow-1" id="menuCollapse">
        <div class="pt-3 menu-box-inner">
          <button type="button" class="menu-main-button py-4">
            <div class="d-flex flex-direction-row align-items-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="me-2 bi bi-info-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
              </svg>
              About
            </div>
            <div class="menu-main-button-rect"></div>
          </button>
          <button type="button" class="menu-main-button py-4" id="toggleMapLayerButton">
            <div class="d-flex flex-direction-row align-items-center">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="me-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
              </svg>
              Map Layer
            </div>
          </button>
        </div>
      </div>
      <script>

        const myCollapsible = document.getElementById('menuCollapse');
        const menuCollapseIcon = document.getElementById('menu-collapse-icon');

        myCollapsible.addEventListener('show.bs.collapse', event => {
          menuCollapseIcon.style.transform = 'rotate(90deg)';
          menuCollapseIcon.style.border = '1px solid white';
        });

        myCollapsible.addEventListener('hide.bs.collapse', event => {
          menuCollapseIcon.style.transform = 'rotate(0deg)';
          menuCollapseIcon.style.border = 'none';
        });
      </script>
    </div>
  </div>
</nav> 