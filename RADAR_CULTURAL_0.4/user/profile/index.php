<?php include("../../path.php"); ?>
<?php 
    include(ROOT_PATH . "/app/controllers/users.php"); 
    $posts = selectAll('tb_publicacao');
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

        <title>User Section - Manage Profile</title>
        <link rel="shortcut icon" type="imagex/png" href="../../assets/images/logo.ico">
    </head>

    <body>

    <?php include(ROOT_PATH . "/app/includes/header.php"); ?>

        <div class="page-wrapper">

            <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>

          <!-- Content -->
          <div class="content clearfix">

            <!-- Main Content Wrapper -->
            <div class="main-content-wrapper">
              <div class="main-content single">
                <h1 class="post-title"><?php echo $_SESSION['nome_usuario']; ?></h1>

                <?php foreach ($users as $key => $user): ?>

                  <?php if ($user['id_usuario'] == $_SESSION['id_usuario']): ?>
                      <img src="<?php echo BASE_URL . '/assets/images/' . $user['foto_perfil']; ?>" alt="" class="profile-image">

                  <?php endif; ?>
                    
                <?php endforeach; ?>

                    <br>
                    <br>

                      <h1 class="post-title">Informações pessoais:</h1>

                      <div class="post-content">
                         Nome de usuário: <?php echo $_SESSION['nome_usuario']; ?>
                      </div>
                      <br>
                      <div class="post-content">
                         Nome completo: <?php echo $_SESSION['nome_completo']; ?>
                      </div>
                      <br>
                      <div class="post-content">
                         E-mail: <?php echo $_SESSION['email']; ?>
                      </div>
                      <br>
                      <br>
                      <div class="post-content">
                         <a href="edit.php?edit_id_usuario=<?php echo $_SESSION['id_usuario']; ?>" class="btn read-more" class="edit">Editar</a>
                         <a onclick="javascript: if (confirm('Você realmente deseja excluir sua conta?'))location.href='index.php?delete_id_usuario=<?php echo $_SESSION['id_usuario']; ?>'" class="btn read-more"  class="delete">Deletar</a>
                      </div>

            </div>

            <!-- // Main Content -->

            <!-- Sidebar -->
            <div class="sidebar single">

              <div class="section popular">

                <h2 class="section-title">Continue navegando!</h2>

                <?php foreach ($posts as $p): ?>

                    <div class="post clearfix">
                      <img src="<?php echo BASE_URL . '/assets/images/' . $p['imagem_capa']; ?>" alt="">
                      <a href="<?php echo BASE_URL ?>/single.php?id_publicacao=<?php echo $p['id_publicacao']; ?>" class="title">
                        <h4><?php echo $p['titulo']; ?></h4>
                      </a>
                    </div>

                <?php endforeach; ?>

              </div>
              
            </div>
            <!-- // Sidebar -->

          </div>
          <!-- // Content -->

        </div>
        <!-- // Page Wrapper -->

        <!-- Include Footer -->
        <?php include(ROOT_PATH . "/app/includes/footer.php"); ?>


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