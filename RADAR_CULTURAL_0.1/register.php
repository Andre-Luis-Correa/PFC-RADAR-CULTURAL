<?php include("path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/users.php");
//guestsOnly();
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

  <title>Registre-se</title>
</head>

<body>
  
  <?php include(ROOT_PATH . "/app/includes/header.php"); ?>

  <div class="auth-content">

    <form action="register.php" method="post" enctype="multipart/form-data">
      <h2 class="form-title">Registre-se</h2>

      <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>


      <div>
        <label>Nome Completo </label>
        <input type="text" name="nome_completo" value="<?php echo $nome_completo; ?>" class="text-input">
      </div>
      <div>
        <label>Nome de usuário </label>
        <input type="text" name="nome_usuario" value="<?php echo $nome_usuario; ?>" class="text-input">
      </div>
      <div>
        <label>Email</label>
        <input type="email" name="email" value="<?php echo $email; ?>" class="text-input">
      </div>
      <div>
        <label>Senha</label>
        <input type="password" name="senha" value="<?php echo $senha; ?>" class="text-input">
      </div>
      <div>
        <label>Confirmação de senha</label>
        <input type="password" name="senhaConf" value="<?php echo $senhaConf; ?>" class="text-input">
      </div>
      <div>
        <label>Foto de perfil</label>
        <input type="file" name="foto_perfil" class="text-input">
      </div>
      <div>
        <button type="submit" name="register-btn" class="btn btn-big">Register</button>
      </div>
      <p>Or <a href="<?php echo BASE_URL . '/login.php' ?>">Sign In</a></p>
    </form>

  </div>


  <!-- JQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- Custom Script -->
  <script src="assets/js/scripts.js"></script>

</body>

</html>