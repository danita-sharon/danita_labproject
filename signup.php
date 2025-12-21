
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up | Attendance Portal</title>

  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #f4f4f4;
    }

    /* Header */
    header {
      background: #8A2B2B;
      padding: 20px 0;
      text-align: center;
    }

    header img {
      height: 75px;
    }

    /* Sign Up Container */
    .signup-container {
      width: 500px;
      background: white;
      margin: 50px auto;
      padding: 30px 35px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .signup-container h2 {
      text-align: center;
      color: #8A2B2B;
      margin-bottom: 15px;
    }

    .signup-container p {
      text-align: center;
      color: #444;
      margin-bottom: 25px;
    }

    /* Labels */
    .signup-container label {
      display: block;
      margin-bottom: 5px;
      color: #333;
      font-weight: bold;
    }

    /* Input Fields */
    .signup-container input,
    .signup-container select {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 15px;
    }

    /* Button */
    .signup-container button {
      width: 100%;
      padding: 12px;
      background: #8A2B2B;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
      transition: 0.3s ease;
    }

    .signup-container button:hover {
      background: #732323;
    }

    /* Links */
    .signup-container a {
      color: #8A2B2B;
      text-decoration: none;
    }

    .signup-container a:hover {
      text-decoration: underline;
    }

    .error {
      color: red;
      font-size: 0.9em;
      margin-bottom: 10px;
      text-align: left;
    }

    /* Footer */
    footer {
      text-align: center;
      margin-top: 40px;
      color: #777;
      font-size: 14px;
    }
  </style>
</head>

<body>

  <!-- Header with Ashesi Logo -->
  <header>
    <img src="ashesilogo.png" alt="Ashesi University Logo" />
  </header>

  <!-- Sign Up Form -->
  <div class="signup-container">
    <h2>Create Account</h2>
    <p>Join the Attendance Management Portal</p>

    <form id="signupForm">
      <label for="first_name">First Name:</label>
      <input type="text" id="first_name" name="first_name" required>
      
      <label for="last_name">Last Name:</label>
      <input type="text" id="last_name" name="last_name" required>
      
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
      <div id="emailError" class="error"></div>

      <label for="school-id">School ID:</label>
      <input type="text" id="school-id" name="school_id" required>
      <div id="idError" class="error"></div>

      <label for="dob">Date of Birth:</label>
      <input type="date" id="dob" name="dob" required>
      <div id="dobError" class="error"></div>

      <label for="role">Role:</label>
      <select id="role" name="role" required>
        <option value="">Select Role</option>
        <option value="student">Student</option>
        <option value="faculty">Faculty</option>
      </select>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
      <div id="passwordError" class="error"></div>

      <label for="confirm-password">Confirm Password:</label>
      <input type="password" id="confirm-password" name="confirmpassword" required>
      <div id="confirmError" class="error"></div>

      <button type="submit">Sign Up</button>
      <p>Already have an account? <a href="Login.php">Log In</a></p>
    </form>
  </div>

  <footer>
    © 2025 Ashesi University — Attendance Management System
  </footer>

  <!-- Validation -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
document.getElementById("signupForm").addEventListener("submit", async function(e) {
    e.preventDefault();
    document.querySelectorAll(".error").forEach(el => el.textContent = "");

    const first_name = document.getElementById("first_name").value.trim();
    const last_name = document.getElementById("last_name").value.trim();
    const email = document.getElementById("email").value.trim();
    const schoolId = document.getElementById("school-id").value.trim();
    const dob = document.getElementById("dob").value;
    const role = document.getElementById("role").value;
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm-password").value;

    let valid = true;

    // First name validation
    const nameRegex = /^[A-Za-z\s]+$/;
    if (!nameRegex.test(first_name)) {
        alert("First name should contain only letters and spaces.");
        valid = false;
    }

    // Last name validation
    if (!nameRegex.test(last_name)) {
        alert("Last name should contain only letters and spaces.");
        valid = false;
    }

    // Email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        document.getElementById("emailError").textContent = "Please enter a valid email address.";
        valid = false;
    }

    // School ID validation (8 digits)
    const idRegex = /^\d{8}$/;
    if (!idRegex.test(schoolId)) {
        document.getElementById("idError").textContent = "School ID must be exactly 8 digits.";
        valid = false;
    }

    // DOB validation
    if (!dob) {
        document.getElementById("dobError").textContent = "Please enter your date of birth.";
        valid = false;
    }

    // Role validation
    if (!role) {
        alert("Please select a role.");
        valid = false;
    }

    // Password validation
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{8,}$/;
    if (!passwordRegex.test(password)) {
        document.getElementById("passwordError").textContent =
          "Password must be at least 8 characters, contain uppercase, lowercase, number, and special character.";
        valid = false;
    }

    // Confirm password match
    if (password !== confirmPassword) {
        document.getElementById("confirmError").textContent = "Passwords do not match.";
        valid = false;
    }

    if (!valid) {
        Swal.fire({
            icon: "error",
            title: "Oops!",
            text: "Please fix the highlighted errors before continuing."
        });
        return;
    }

    // Submit via fetch to backend PHP
    const response = await fetch("processSignup.php", {
        method: "POST",
        body: new FormData(document.getElementById("signupForm"))
    });

    const result = await response.json();

    if (result.success) {
        Swal.fire({
            icon: "success",
            title: "Sign-up successful!",
            text: "Welcome, " + first_name
        }).then(() => {
            window.location.href = result.redirect;
        });
    } else {
        Swal.fire({
            icon: "error",
            title: "Sign-up failed!",
            text: result.message
        });
    }
});
</script>


  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Ashesi University | Attendance Management System</p>
  </footer>
  <!-- Validation -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
document.getElementById("signupForm").addEventListener("submit", async function(e) {
    e.preventDefault();
    document.querySelectorAll(".error").forEach(el => el.textContent = "");

    const first_name = document.getElementById("first_name").value.trim();
    const last_name = document.getElementById("last_name").value.trim();
    const email = document.getElementById("email").value.trim();
    const schoolId = document.getElementById("school-id").value.trim();
    const dob = document.getElementById("dob").value;
    const role = document.getElementById("role").value;
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm-password").value;

    let valid = true;

    // First name validation
    const nameRegex = /^[A-Za-z\s]+$/;
    if (!nameRegex.test(first_name)) {
        alert("First name should contain only letters and spaces.");
        valid = false;
    }

    // Last name validation
    if (!nameRegex.test(last_name)) {
        alert("Last name should contain only letters and spaces.");
        valid = false;
    }

    // Email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        document.getElementById("emailError").textContent = "Please enter a valid email address.";
        valid = false;
    }

    // School ID validation (8 digits)
    const idRegex = /^\d{8}$/;
    if (!idRegex.test(schoolId)) {
        document.getElementById("idError").textContent = "School ID must be exactly 8 digits.";
        valid = false;
    }

    // DOB validation
    if (!dob) {
        document.getElementById("dobError").textContent = "Please enter your date of birth.";
        valid = false;
    }

    // Role validation
    if (!role) {
        alert("Please select a role.");
        valid = false;
    }

    // Password validation
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{8,}$/;
    if (!passwordRegex.test(password)) {
        document.getElementById("passwordError").textContent =
          "Password must be at least 8 characters, contain uppercase, lowercase, number, and special character.";
        valid = false;
    }

    // Confirm password match
    if (password !== confirmPassword) {
        document.getElementById("confirmError").textContent = "Passwords do not match.";
        valid = false;
    }

    if (!valid) {
        Swal.fire({
            icon: "error",
            title: "Oops!",
            text: "Please fix the highlighted errors before continuing."
        });
        return;
    }

    // Submit via fetch to backend PHP
    const response = await fetch("processSignup.php", {
        method: "POST",
        body: new FormData(document.getElementById("signupForm"))
    });

    const result = await response.json();

    if (result.success) {
        Swal.fire({
            icon: "success",
            title: "Sign-up successful!",
            text: "Welcome, " + first_name
        }).then(() => {
            window.location.href = result.redirect;
        });
    } else {
        Swal.fire({
            icon: "error",
            title: "Sign-up failed!",
            text: result.message
        });
    }
});
</script>
</body>
</html>
