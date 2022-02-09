<?php include("../../path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/users.php"); 
usersOnly();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Font Awesome -->
        <link rel="stylesheet"
            href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
            integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
            crossorigin="anonymous">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Candal|Lora"
            rel="stylesheet">

        <!-- Custom Styling -->
        <link rel="stylesheet" href="../../assets/css/style.css">

        <title>User Section - Edit User</title>
    </head>

    <body>
        
    <?php include(ROOT_PATH . "/app/includes/header.php"); ?>

        <!-- Admin Page Wrapper -->
        <div class="admin-wrapper">



            <!-- Admin Content -->
            <div class="admin-content">


                <div class="content">

                    <h2 class="page-title">Edit User</h2>

                    <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>

                    <form action="edit.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_usuario" value="<?php echo $id; ?>" class="text-input">

                        <div>
                          <label>Nome Completo </label>
                          <input type="text" name="nome_completo" value="<?php echo $nome_completo; ?>" class="text-input">
                        </div>
                        <div>
                            <label>Nome de Usuário </label>
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
                          <input type="file" accept="image/png,image/jpeg" name="foto_perfil" class="text-input">
                        </div>
                        <br>
                        <div>
                            <button type="submit" name="update-user-profile" class="btn btn-big">Update User</button>
                        </div>
                    </form>

                </div>

            </div>
            <!-- // Admin Content -->

        </div>
        <!-- // Page Wrapper -->



        <!-- JQuery -->
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Ckeditor -->
        <script
            src="https://cdn.ckeditor.com/ckeditor5/12.2.0/classic/ckeditor.js"></script>
        <!-- Custom Script -->
        <script src="../../assets/js/scripts.js"></script>

    </body>

</html>