<nav class="d-flex p-0">
  <div class="container-fluid p-0">
    <div class="nav-bar d-flex flex-column justify-content-between align-items-center left-nav-buttons fixed-top  m-0 m-md-4 flex-shrink-1 col-12" style="">
      <div class="d-flex flex-row g-0 w-100 align-items-center justify-content-between">
        <button class="menu-button border-0 p-0" type="button" data-bs-toggle="collapse" data-bs-target="#menuCollapse" aria-expanded="false" aria-controls="menuCollapse">
          <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16" id="menu-collapse-icon">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
          </svg>
        </button>
        <a href="javascript:window.location.href = window.location.origin + window.location.pathname.split('/').slice(0, -1).join('/');" class="nav-logo px-0 px-md-3 d-flex align-items-center m-0">
          Discover Tairāwhiti
        </a>

        <div class="mobile-header-spacer"></div>
      </div>
      <div class="collapse menu-box-main flex-grow-1" id="menuCollapse">
        <div class="py-4 pt-3 menu-box-inner d-flex flex-column align-items-stretch">
          <button type="button" class="menu-main-button py-4" onClick="aboutClick();">
            <div class="d-flex flex-direction-row align-items-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-2 bi bi-info-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
              </svg>
              About
            </div>
            <div class="menu-main-button-rect"></div>
          </button>
          <div id="account" class="d-flex flex-column align-items-center">
            <div id="google-signin-button"></div>
          </div>
          <button type="button" class="menu-main-button py-4" id="openFeedbackModal">
            <div class="d-flex flex-direction-row align-items-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-2 bi bi-chat-left-quote" viewBox="0 0 16 16">
                <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                <path d="M7.066 4.76A1.665 1.665 0 0 0 4 5.668a1.667 1.667 0 0 0 2.561 1.406c-.131.389-.375.804-.777 1.22a.417.417 0 1 0 .6.58c1.486-1.54 1.293-3.214.682-4.112zm4 0A1.665 1.665 0 0 0 8 5.668a1.667 1.667 0 0 0 2.561 1.406c-.131.389-.375.804-.777 1.22a.417.417 0 1 0 .6.58c1.486-1.54 1.293-3.214.682-4.112z"/>
              </svg>
                Feedback
            </div>
            <div class="menu-main-button-rect"></div>
          </button>
          <?php include 'mini/feedbackmodal.php'; ?>

          <div class="d-flex flex-row align-items-center px-5">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="grey" width="24" height="24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
            <div class="settings-bar ms-4"></div>
          </div>

          <div class="d-flex flex-row justify-content-evenly menu-main-button py-4 px-5">
            Dark Mode
            <div class="switch">
              <input type="checkbox" id="toggle" class="switch-input"/>
              <label for="toggle" class="slider"></label>
            </div>
          </div>
          
        </div>
      </div>
      <script>

        const myCollapsible = document.getElementById('menuCollapse');
        const menuCollapseIcon = document.getElementById('menu-collapse-icon');

        myCollapsible.addEventListener('show.bs.collapse', event => {
          menuCollapseIcon.style.transform = 'rotate(90deg)';
          menuCollapseIcon.style.color = 'var(--accent)';
        });

        myCollapsible.addEventListener('hide.bs.collapse', event => {
          menuCollapseIcon.style.transform = 'rotate(0deg)';
          menuCollapseIcon.style.color = 'var(--text)';
        });

      </script>
    </div>
  </div>
</nav> 