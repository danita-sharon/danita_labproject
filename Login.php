<?php
session_start();

// If user is already logged in, redirect them to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | Attendance Portal</title>

  <style>
    /* Reset */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

/* Page */
body {
    font-family: 'Poppins', 'Segoe UI', sans-serif;
    background: #ffffff;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    color: #111827;
}

/* Header */
header {
    background: #8A2B2B;
    border-bottom: 1px solid #e5e7eb;
    padding: 24px 0;
    text-align: center;
}

header img {
    height: 60px;
    opacity: 0.9;
}

/* Login Card */
.login-container {
    width: 100%;
    max-width: 420px;
    background: #ffffff;
    margin: 60px auto;
    padding: 36px 32px;
    border-radius: 16px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.06);
}

/* Title */
.login-container h2 {
    text-align: center;
    font-size: 26px;
    font-weight: 600;
    margin-bottom: 8px;
    color: #111827;
}

/* Subtitle */
.login-container p {
    text-align: center;
    font-size: 14px;
    color: #6b7280;
    margin-bottom: 28px;
}

/* Inputs */
.login-container input {
    width: 100%;
    padding: 12px 14px;
    margin-bottom: 16px;
    border-radius: 10px;
    border: 1px solid #d1d5db;
    font-size: 14px;
    transition: border 0.25s ease, box-shadow 0.25s ease;
}

.login-container input:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
}

/* Button */
.login-container button {
    width: 100%;
    padding: 12px;
    background: #8A2B2B; /* Rich wine color */
    color: #ffffff; /* White text for contrast */
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-size: 15px;
    font-weight: 500;
    transition: background 0.25s ease, transform 0.25s ease;
}

.login-container button:hover {
    background: #5c2230; /* Darker wine for hover */
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(123, 44, 63, 0.3); /* Optional wine-tinted shadow */
}
/* Footer */
footer {
    margin-top: auto;
    text-align: center;
    padding: 20px;
    font-size: 13px;
    color: #6b7280;
}

  </style>
</head>

<body>

  <!-- Header with Ashesi Logo -->
  <header>
    <img src="ashesilogo.png" alt="Ashesi University Logo" />
  </header>

  <!-- Login Form -->
  <div class="login-container">
    <h2>Welcome Back</h2>
    <p>Log in to the Attendance Management Portal</p>

    <form id="loginForm">
      <input type="text" name="user_id" placeholder="Enter User ID" required />
      <input type="password" name="password" placeholder="Enter Password" required />

      <button type="submit">Login</button>
      <p>Don't have an account?<a href="signup.php">Sign Up</a></p>
    </form>
  </div>

  <footer>
    © 2025 Ashesi University — Attendance Management System
  </footer>

  <script>
    document.getElementById("loginForm").addEventListener("submit", async function (e) {
      e.preventDefault();

      try {
        const response = await fetch("processLogin.php", {
          method: "POST",
          body: new FormData(document.getElementById("loginForm"))
        });

        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }

        const result = await response.json();

        if (result.success) {
          alert("Login successful! Welcome " + result.first_name);
          window.location.href = result.redirect;
        } else {
          if (result.reason === "not_found") {
            alert("Account not found.");
          } else if (result.reason === "wrong_password") {
            alert("Incorrect password.");
          } else {
            alert("Login failed.");
          }
        }
      } catch (error) {
        console.error("Login error:", error);
        alert("An error occurred while logging in. Please check the console for details.");
      }
    });
  </script>

</body>
</html>


