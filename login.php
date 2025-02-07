<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat App</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://kit.fontawesome.com/efaae23df7.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="wrapper">
    <section class="form Signup">
      <header>LogIn</header>
      <form action="register.php" method="POST">
        <div class="error-txt">This is an error message!</div>
        
        <div class="field input">
          <label>ID</label>
          <input type="number" name="userid" placeholder="ID" required>
        </div>

        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Password" required>
          <i class="fa-solid fa-eye" id="togglePassword"></i>
        </div>

        <div class="field button">
          <input type="submit" value="LogIn" name="login">
        </div>

        <div class="field button2">
          <a href="index.php" class="create_acc">Create Account</a>
        </div>

        <div class="link"><a href="#">Forget password?</a></div>
      </form>
    </section>
  </div>

  <script>
    // JavaScript to toggle password visibility
    const togglePassword = document.querySelector('#togglePassword');
    const passwordField = document.querySelector('input[name="password"]');

    togglePassword.addEventListener('click', function () {
      // Toggle the type attribute
      const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordField.setAttribute('type', type);
      // Toggle the eye icon
      this.classList.toggle('fa-eye-slash');
    });
  </script>
</body>
</html>
