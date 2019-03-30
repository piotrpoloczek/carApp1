<?php include('server.php') ?>

<!-- HEAD -->
  <?php include('header.php') ?>
  <title>Show data</title>
</head>
<body>
  <?php include('navbar.php') ?>

  <div class="header" style="margin: auto; text-align: center;">
    <h2>Your data</h2>
  </div>

  <?php
      // connect to the database
      $db = mysqli_connect('172.21.0.2', 'root', 'tiger', 'registration');

      // get the user id
      $username = $_SESSION['username'];
      $query = "SELECT id FROM users WHERE username='$username'";
      $results = mysqli_query($db, $query);
      $user_array = mysqli_fetch_assoc($results);
      $user_id = $user_array['id'];


      // get every data for the user from db
      $query_show = "SELECT * FROM data WHERE user_id='$user_id'";
      $result_show = mysqli_query($db, $query_show);


      if (mysqli_num_rows($result_show) > 0){
      ?>

      <div class="class-center" style="max-width: 50%; margin: auto;">
        <table class="table table-hover">
          <tr>
            <th>Fuel, l</th>
            <th>Distance, km</th>
            <th>Date</th>
            <th>Combustion, l/100km</th>
          </tr>

      <?php
        while($row = mysqli_fetch_assoc($result_show)) {
      ?>
        <tr>
          <td><?php echo $row['fuel']; ?></td>
          <td><?php echo $row['distance']; ?></td>
          <td><?php echo $row['date']; ?></td>
          <td><?php echo $row['combustion']; ?></td>
      <?php
        }
      ?>
        </table>
      </div>
      <?php
      }else {
        echo "0 results";
      }
  ?>
