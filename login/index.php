<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register & Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right,rgb(245, 239, 236),rgb(103, 101, 98));
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 1rem;
    }

    .container {
      background: #fff;
      background: linear-gradient(to right,rgb(246, 213, 173),rgb(239, 174, 116));
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
    }

    .form-title {
      font-size: 1.8rem;
      margin-bottom: 1.5rem;
      text-align: center;
      color: #333;
    }

    .input-group {
      position: relative;
      margin-bottom: 1.2rem;
    }

    .input-group i {
      position: absolute;
      top: 12px;
      left: 10px;
      color: #888;
    }

    .input-group input {
      width: 100%;
      padding: 0.75rem 0.75rem 0.75rem 2.5rem;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 1rem;
    }

    .input-group label {
      position: absolute;
      top: -10px;
      left: 35px;
      background: #fff;
      font-size: 0.8rem;
      padding: 0 5px;
      color: #555;
    }

    .btn {
      width: 100%;
      padding: 0.75rem;
      border: none;
      background-color: #007bff;
      color: white;
      font-size: 1rem;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s;
      margin-top: 0.5rem;
    }

    .btn:hover {
      background-color: #0056b3;
    }

    .or {
      
      text-align: center;
      margin: 1.2rem 0;
      color: #999;
    }

    .icons {
      text-align: center;
      margin-bottom: 1rem;
    }

    .icons i {
      font-size: 1.5rem;
      margin: 0 10px;
      cursor: pointer;
      color: #333;
    }

    .links {
      text-align: center;
      font-size: 0.9rem;
    }

    .links button {
      background: none;
      border: none;
      color: #007bff;
      cursor: pointer;
      font-weight: bold;
    }

    .recover {
      text-align: right;
      font-size: 0.85rem;
    }

    .recover a {
      color: #007bff;
      text-decoration: none;
    }

    @media screen and (max-width: 480px) {
      .form-title {
        font-size: 1.5rem;
      }

      .icons i {
        font-size: 1.3rem;
      }
    }
  </style>
</head>
<body>

<div class="container" id="signup" style="display: none;">
  <h1 class="form-title">Register</h1>
  <form method="post" action="register.php">
    <div class="input-group">
      <i class="fas fa-user"></i>
      <input type="text" name="fName" id="fName" placeholder="First Name" required>
      <label for="fName"></label>
    </div>
    <div class="input-group">
      <i class="fas fa-user"></i>
      <input type="text" name="lName" id="lName" placeholder="Last Name" required>
      <label for="lName"></label>
    </div>
    <div class="input-group">
      <i class="fas fa-envelope"></i>
      <input type="email" name="email" id="email" placeholder="Email" required>
      <label for="email"></label>
    </div>
    <div class="input-group">
    
    <input type="password" name="password" id="registerPassword" placeholder="Password" required oninput="checkPasswordStrength(this.value)">
    <i class="fas fa-eye" id="toggleRegisterPassword" style="position:absolute; right:10px; top:12px; cursor:pointer; color:#888;"></i>
    <label for="registerPassword"></label>
</div>
<p id="strengthMessage" style="font-size: 0.9rem; margin-bottom: 0.5rem; color: #333;"></p>

    <input type="submit" class="btn" value="Sign Up" name="signUp">
  </form>
  <p class="or">---------- or ----------</p>
  <div class="icons">
    <i class="fab fa-google"></i>
    <i class="fab fa-facebook"></i>
  </div>
  <div class="links">
    <p>Already have an account?</p>
    <button id="signInButton">Sign In</button>
  </div>
</div>




<div class="container" id="signIn">
  <h1 class="form-title">Sign In</h1>
  <form method="post" action="register.php">
    <div class="input-group">
      <i class="fas fa-envelope"></i>
      <input type="email" name="email" id="email" placeholder="Email" required>
      <!-- label removed -->
    </div>
    <div class="input-group">
    
    <input type="password" name="signInPassword" id="signInPassword" placeholder="Password" required>
    <i class="fas fa-eye" id="toggleSignInPassword" style="position:absolute; right:10px; top:12px; cursor:pointer; color:#888;"></i>
    <!-- label removed -->
</div>

    <p class="recover"><a href="#">Recover Password</a></p>
    <input type="submit" class="btn" value="Sign In" name="signIn">
  </form>
  <p class="or">---------- or ----------</p>
  <div class="icons">
    <i class="fab fa-google"></i>
    <i class="fab fa-facebook"></i>
  </div>
  <div class="links">
    <p>Don't have an account yet?</p>
    <button id="signUpButton">Sign Up</button>
  </div>
</div>

<script>
  const signUp = document.getElementById('signup');
  const signIn = document.getElementById('signIn');
  const signUpBtn = document.getElementById('signUpButton');
  const signInBtn = document.getElementById('signInButton');

  signUpBtn.addEventListener('click', () => {
    signIn.style.display = 'none';
    signUp.style.display = 'block';
  });

  signInBtn.addEventListener('click', () => {
    signUp.style.display = 'none';
    signIn.style.display = 'block';
  });

  function checkPasswordStrength(password) {
    const strengthMsg = document.getElementById("strengthMessage");
    const strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[!@#$%^&*]).{8,}$");
    const mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*\\d))).{8,}$");

    if (password.length === 0) {
      strengthMsg.innerText = "";
    } else if (password.length < 8) {
      strengthMsg.innerText = "Too short (minimum 8 characters)";
      strengthMsg.style.color = "red";
    } else if (strongRegex.test(password)) {
      strengthMsg.innerText = "Strong password";
      strengthMsg.style.color = "green";
    } else if (mediumRegex.test(password)) {
      strengthMsg.innerText = "Moderate password";
      strengthMsg.style.color = "orange";
    } else {
      strengthMsg.innerText = "Weak password!!!";
      strengthMsg.style.color = "red";
    }
  }
  // Toggle Register Password Visibility
const toggleRegister = document.getElementById('toggleRegisterPassword');
const registerPassword = document.getElementById('registerPassword');
toggleRegister.addEventListener('click', function () {
  const type = registerPassword.getAttribute('type') === 'password' ? 'text' : 'password';
  registerPassword.setAttribute('type', type);
  this.classList.toggle('fa-eye');
  this.classList.toggle('fa-eye-slash');
});

// Toggle Sign In Password Visibility
const toggleSignIn = document.getElementById('toggleSignInPassword');
const signInPassword = document.getElementById('signInPassword');
toggleSignIn.addEventListener('click', function () {
  const type = signInPassword.getAttribute('type') === 'password' ? 'text' : 'password';
  signInPassword.setAttribute('type', type);
  this.classList.toggle('fa-eye');
  this.classList.toggle('fa-eye-slash');
});

  
</script>

</body>
</html>
