<?php include('path.php'); ?>
<?php include(ROOT_PATH . "/app/controllers/users.php"); 
guestsOnly();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Candal|Lora" rel="stylesheet">

  <!-- Custom Styling -->
  <link rel="stylesheet" href="assets/css/style.css">

  <title>Recuperar senha</title>
</head>

<body>
  
  <?php include(ROOT_PATH . "/app/includes/header.php"); ?>

  <div class="auth-content">

    <form action="forgotPassword.php" method="post">
      <h2 class="form-title">Recupere sua senha</h2>

      <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>

      <div>
        <label>Email</label>
        <input type="email" name="email" value="<?php echo $email; ?>" class="text-input">
      </div>
      <div>
        <button type="submit" name="forgot-password-btn" class="btn btn-big">Enviar e-mail</button>
      </div>
    </form>

  </div>


  <!-- JQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- Custom Script -->
  <script src="assets/js/scripts.js"></script>

</body>

</html>