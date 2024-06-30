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