<?php include('server.php') ?>
<?php include('header.php') ?>
  <title>Registration</title>
</head>
<body>
  <div class="header" style="margin: auto; text-align: center;">
    <h2>Register</h2>
  </div>

<div class="text-center" style="max-width: 33%; margin: auto;">
  <form method="post" action="register.php">
    <?php include('errors.php'); ?>

    <div class="form-group">
      <label for="username">Username</label>
      <input class="form-control" type="text" name="username" value="<?php echo $username; ?>">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input class="form-control" type="email" name="email" value="<?php echo $email; ?>">
    </div>
    <div class="form-group">
      <label for="password_1">Password</label>
      <input class="form-control" type="password" name="password_1">
    </div>
    <div class="form-group">
      <label for="password_2">Confirm password</label>
      <input class="form-control" type="password" name="password_2">
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-default" name="reg_user">Register</button>
    </div>
    <p>
      Already a member? <a href="login.php">Sign in</a>
    </p>
  </form>
</div>

</body>
</html>
