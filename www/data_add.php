<?php include('server.php') ?>

  <?php include('header.php') ?>
  <title>Add data</title>
</head>
<body>
  <?php include('navbar.php') ?>
  <div class="text-center" style="max-width: 33%; margin: auto">
    <div class="row">
      <h2>Add data</h2>
    </div>

    <?php if (isset($_SESSION['added'])){ ?>
      <div class="row">
        <h3><?php echo $_SESSION['added']; ?></h3>
    <?php } ?>
  <!-- form for sending data to DB -->
    <form method="post" action="data_add.php">
      <?php include('errors.php'); ?>
      <div class="form-group">
        <label for="fuel">Fuel, l</label>
        <input class="form-control" type="text" name="fuel"
          onkeypress="return isNumberKey(event)"
          value="<?php echo $fuel; ?>" />
      </div>
      <div class="form-group">
        <label for="distance">Distance, km</label>
        <input class="form-control" type="text" name="distance"
          3onkeypress="return isNumberKey(event)"
          value="<?php echo $distance; ?>" />
      </div>
        <button type="submit" class="btn btn-default" name="add_data">Add data</button>
    </form>
  </div>
</div>

<script>
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || (charCode > 57 && charCode != 190)))
        return false;
    return true;
}
</script>
