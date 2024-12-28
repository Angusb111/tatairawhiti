<div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog m-0 h-100">
        <div class="modal-content m-0 border-0">
            <div class="modal-header">
                <h5 class="modal-title" id="feedbackModalLabel">Give Feedback</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex flex-column justify-content-center">
                <!-- User Box and Sign-In/Out Area -->
                <div id="modal-account"></div>

                <!-- Feedback Form -->
                <form id="feedback-form" class="d-flex flex-column align-items-end" action="scripts/submit_feedback.php" method="POST">
                    <input type="text" id="user_name" name="name" placeholder="Your Name">
                    <input type="email" id="user_email" name="email" placeholder="Your Email">
                    <textarea id="feedback" name="message" placeholder="Your Feedback"></textarea>
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const openModalButton = document.getElementById('openFeedbackModal');
    openModalButton.addEventListener('click', () => {
        const myModal = new bootstrap.Modal(document.getElementById('feedbackModal'), {
            backdrop: false // No backdrop
        });
        myModal.show();
    });
function handleModalUserBox() {
    // Retrieve user data from localStorage
    const persistentUserData = JSON.parse(localStorage.getItem('user'));

    // Locate modal elements
    const modalAccountDiv = document.getElementById('modal-account');
    const userNameInput = document.getElementById('user_name');
    const userEmailInput = document.getElementById('user_email');

    // Create user box for modal
    const modalUserBox = document.createElement('div');
    modalUserBox.id = 'modal-user-box';
    modalUserBox.style.display = 'flex';
    modalUserBox.style.alignItems = 'center';
    modalUserBox.style.marginBottom = '1rem';

    if (persistentUserData) {
        // User is signed in - display user info and remove unnecessary fields
        modalUserBox.innerHTML = `
            <img src="${persistentUserData.picture}" referrerPolicy="no-referrer" alt="User Avatar" 
                onError="this.onerror=null; this.src='media/googlelogo.png';" 
                style="border: 1px solid grey; width: 40px; height: 40px; border-radius: 25%; margin-right: 10px;"/>
            <p style="margin:0;">${persistentUserData.name}</p>
        `;

        // Remove name and email fields from the feedback form

        userNameInput.type = 'hidden';
        userNameInput.value = persistentUserData.name;

        userEmailInput.type = 'hidden';
        userEmailInput.value = persistentUserData.email;

        // Replace the modal account div content
        if (modalAccountDiv) {
            modalAccountDiv.innerHTML = ''; // Clear previous content
            modalAccountDiv.appendChild(modalUserBox);
        }

    } else {
        // User is not signed in - ensure name and email fields are visible
        if (userNameInput) userNameInput.style.display = 'block';
        if (userEmailInput) userEmailInput.style.display = 'block';

        // Ensure modal account div is cleared
        if (modalAccountDiv) modalAccountDiv.innerHTML = '';
    }
}

// Call this function when the modal is shown
document.addEventListener('DOMContentLoaded', () => {
    handleModalUserBox();
});
</script>