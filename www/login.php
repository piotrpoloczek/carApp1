<?php include('server.php') ?>
<?php include('header.php') ?>
  <title>Login Car Combustion</title>
</head>
<body>
  <div class="header" style="margin: auto; text-align: center;">
    <h2>Login</h2>
  </div>

<div class="text-center" style="max-width: 33%; margin: auto;">
  <form method="post" action="login.php">
    <?php include('errors.php'); ?>
    <div class="form-group">
      <label for="username">Username</label>
      <input class="form-control" type="text" name="username" >
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input class="form-control" type="password" name="password">
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-default" name="login_user">Login</button>
    </div>
    <p>
      Not yet a member? <a href="register.php">Sign up</a>
    </p>
  </form>
</div>

</body>
</html>
