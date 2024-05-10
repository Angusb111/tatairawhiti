<div class="modal fade" id="imageviewer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content" style="background-color:var(--foreground-grey)">
      <div class="modal-header py-3 border border-0 bg-main">
        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close-white btn-close px-3" data-bs-dismiss="modal" aria-label="Close" style=""></button>
      </div>
      <div class="modal-body p-0">
        <img class="modal-image" style="width:100%;">
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  const exampleModal = document.getElementById('imageviewer')
  exampleModal.addEventListener('show.bs.modal', event => {
    // Button that triggered the modal
    const button = event.relatedTarget
    // Extract info from data-bs-* attributes
    const path = button.getAttribute('data-bs-path')
    const title = button.getAttribute('data-bs-title')

    const modalTitle = exampleModal.querySelector('.modal-title')
    const imageTarget = exampleModal.querySelector('.modal-image')
    modalTitle.textContent = `${title}`
    imageTarget.src = `${path}.jpg`
    imageTarget.alt = `${title}`
  })
</script>
