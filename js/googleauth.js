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
  
  function handleSignIn(response) {
    const token = response.credential;
    const user = parseJwt(token); // Decode the JWT to get user info
    
    console.log(user); // Display user details

    // Send the user info to the server for the first time login
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
            // Handle success (e.g., update UI with user details)
            localStorage.setItem('user', JSON.stringify(user)); // Store user info in localStorage
            window.location.reload(); // Reload the page to reflect the signed-in state
        } else {
            console.error('Error saving user data');
        }
    })
    .catch(error => console.error('Error:', error));
}


  
// Google Sign-In button callback
function handleCredentialResponse(response) {
    const token = response.credential;
    const userData = parseJwt(token); // Parse JWT to extract user data
    user = userData;
    console.log(user.name); // Debug: check if name is correctly parsed
    console.log(user.email); // Debug: check if email is correctly parsed
    document.getElementById("user_name").value = user.name;
    document.getElementById("user_email").value = user.email;
}

function parseJwt(token) {
    const base64Url = token.split('.')[1];
    const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    const jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));
    return JSON.parse(jsonPayload);
}

// Function to check if the user is signed in and display their info
function checkUserSignIn() {
    // Retrieve user data from localStorage
    const userData = JSON.parse(localStorage.getItem('user'));

    const accountDiv = document.getElementById('account');
    const googleSignInButton = document.getElementById('google-signin-button');
    const signOutButton = document.createElement('button');
    signOutButton.id = 'sign-out-button';
    signOutButton.textContent = 'Sign Out';

    const userInfoDiv = document.createElement('div');
    userInfoDiv.id = 'user-info';
    userInfoDiv.classList.add('signedin-chit', 'col-6', 'flex-grow-1', 'p-2', 'rounded');

    if (userData) {
        // User is signed in, hide the sign-in button and display user info
        googleSignInButton.style.display = 'none';

        // Create and populate user info div
        userInfoDiv.innerHTML = `

            <p style="font-size: 0.8rem;">Signed in as:</p>
            <div class="d-flex flex-row justify-content-start align-items-center">
            
            <img src="${userData.picture}" alt="User Avatar" onError="this.onerror=null; this.src='media/googlelogo.png';" style="width: 30px; height: 30px; margin:10px; border-radius: 50%;"/>
            <p>${userData.name}</p>
            </div>
            
        `;

        // Display sign-out button
        signOutButton.style.display = 'inline-block';
        signOutButton.addEventListener('click', logout);

        // Append the user info and sign-out button to the account div
        accountDiv.appendChild(userInfoDiv);
        accountDiv.appendChild(signOutButton);
    } else {
        // User is not signed in, display the sign-in button
        googleSignInButton.style.display = 'block';
    }
}

// Function to handle sign out
function logout() {
    // Clear the user data from localStorage
    localStorage.removeItem('user');

    // Reload the page to reflect the changes
    window.location.reload();
}

// Call this function when the page loads
document.addEventListener('DOMContentLoaded', checkUserSignIn);

