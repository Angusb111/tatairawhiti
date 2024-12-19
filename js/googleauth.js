window.onload = () => {
    google.accounts.id.initialize({
      client_id: "203422421120-om6gdhhid2dhpca3848c26f21p0lk08p.apps.googleusercontent.com",
      callback: handleSignIn,
    });
    google.accounts.id.renderButton(
      document.getElementById("google-signin-button"),
      { theme: "outline", size: "large" }
    );
};
  
// Callback function to handle the user's sign-in process
function handleSignIn(response) {
    const token = response.credential;
    const user = parseJwt(token); // Decode the JWT to extract user information
    
    console.log(user); // Log user details for debugging

    // Send the user information to the server for first-time login
    fetch('scripts/save_user.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            email: user.email,
            name: user.name,
            avatar: user.picture
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Handle successful response (e.g., update UI with user info)
            localStorage.setItem('user', JSON.stringify(user)); // Save user info to localStorage
            window.location.reload(); // Reload the page to reflect the signed-in state
        } else {
            console.error('Error saving user data');
        }
    })
    .catch(error => console.error('Error:', error));
}

// Handle the credential response when the user logs in
function handleCredentialResponse(response) {
    const token = response.credential;
    const persistentUserData = parseJwt(token); // Decode JWT to extract user data
    user = persistentUserData;
    console.log(user.name); // Debug: check if name is correctly parsed
    console.log(user.email); // Debug: check if email is correctly parsed
    document.getElementById("user_name").value = user.name;
    document.getElementById("user_email").value = user.email;
}

// Helper function to parse a JWT token and extract user data
function parseJwt(token) {
    const base64Url = token.split('.')[1];
    const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    const jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));
    return JSON.parse(jsonPayload);
}

// Function to check if the user is signed in and update the UI accordingly
function checkUserSignIn() {
    // Retrieve user data from localStorage
    const persistentUserData = JSON.parse(localStorage.getItem('user'));

    const accountDiv = document.getElementById('account');
    const googleSignInButton = document.getElementById('google-signin-button');
    const signOutButton = document.createElement('button');
    signOutButton.id = 'sign-out-button';
    signOutButton.textContent = 'Log Out';

    const signedInAs = document.createElement('p');
    signedInAs.style.fontSize = '0.8rem';
    signedInAs.innerHTML = 'Signed in as:';

    const userInfoDiv = document.createElement('div');
    userInfoDiv.id = 'user-info';
    userInfoDiv.classList.add('signedin-chit', 'flex-grow-1');
    document.getElementById("user_name").value = persistentUserData.name;
    document.getElementById("user_email").value = persistentUserData.email;

    if (persistentUserData) {
        // User is signed in, hide the sign-in button and display user info
        googleSignInButton.style.display = 'none';

        // Create and populate user info div
        userInfoDiv.innerHTML = `
            <img src="${persistentUserData.picture}" referrerPolicy="no-referrer" alt="User Avatar" onError="this.onerror=null; this.src='media/googlelogo.png';" style="width: 32px; height: 32px; margin:0px; border-radius: 8.5px; "/>
            <p style="margin:0px 10px;">${persistentUserData.name}</p>
        `;
        
        // Display sign-out button and set event listener
        signOutButton.addEventListener('click', logout);
        
        // Append the user info and sign-out button to the account div
        accountDiv.appendChild(signedInAs);
        accountDiv.appendChild(userInfoDiv);
        accountDiv.appendChild(signOutButton);
    } else {
        // User is not signed in, display the sign-in button
        googleSignInButton.style.display = 'block';
    }
}

// Function to log out the user
function logout() {
    // Remove user data from localStorage
    localStorage.removeItem('user');

    // Reload the page to reflect the changes
    window.location.reload();
}

// Check user sign-in status when the page loads
document.addEventListener('DOMContentLoaded', checkUserSignIn);
