
<!DOCTYPE html>
<html>

<head>
  <title>Chat App</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="wrapper-create-account">
    <section class="form Signup">
      <h1>Create Account</h1>
      <div class="error-txt"></div>
      <form action="register.php" method="post" >
        <div class="field input">
          <label for="first_name">First Name</label>
          <input type="text" placeholder="First Name" name="first_name">
        </div>
        <div class="field input">
          <label for="last_name">Last Name</label>
          <input type="text" placeholder="Last Name" name="last_name">
        </div>
        <div class="field input">
          <label for="id">ID</label>
          <input type="number" placeholder="Enter your ID" min="231000" max="231200" name="userid">
        </div>
        <div class="field input">
          <label for="password">Password</label>
          <input type="password" placeholder="Enter new password" name="password">
        </div>
        <!-- <div class="field">
          <label>Select Image</label>
          <input type="file" name="image">
        </div> -->
        <div class="field button">
          <input type="Submit" value="Signup" name ="save">
        </div>
      </form>
      <div class="link">
        Already Signed Up? <a href="login.php">LogIn Now</a>
      </div>
    </section>
  </div>
</body>

</html>
