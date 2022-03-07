<?php include("path.php"); ?>
<?php include(ROOT_PATH . '/app/controllers/comments.php'); ?>

<?php

    if (isset($_GET['id_publicacao'])) 
    {
      $post = selectOne('tb_publicacao', ['id_publicacao' => $_GET['id_publicacao']]);
      $topic_color = selectOne('tb_categoria', ['id_categoria' => $post['fk_id_categoria']]);
      $comments = getCommentsByPost($_GET['id_publicacao']);
    } 

    $topics = selectAll('tb_categoria');

    $posts = selectAll('tb_publicacao', ['publicado' => 1]);

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

    <title><?php echo $post['titulo']; ?> | RADAR CULTURAL</title>
    <link rel="shortcut icon" type="imagex/png" href="assets/images/logo.ico">

</head>

<body>
    <!-- Facebook Page Plugin SDK -->
    <div id="fb-root"></div>

    <script async defer crossorigin="anonymous"
      src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2&appId=285071545181837&autoLogAppEvents=1">
    </script>

    <?php include(ROOT_PATH . "/app/includes/header.php"); ?>
    <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>

    <!-- Page Wrapper -->
    <div class="page-wrapper">

      <!-- Content -->
      <div class="content clearfix">

        <!-- Main Content Wrapper -->
        <div class="main-content-wrapper">
          <div class="main-content single">
            <h1 class="post-title"><?php echo $post['titulo']; ?></h1>

            <div style="font-size: 25px; color: #838485; text-align: center;" class="post-content">
               <?php echo $post['resumo']; ?>
            </div>

            <br>
            <br>

            <div class="post-content">

              <img src="<?php echo BASE_URL . '/assets/images/' . $post['imagem_capa']; ?>" alt="" class="capa-image">
            </div>

            <br>
            <br>
            <br>

            <div class="post-content">
               <?php echo html_entity_decode($post['conteudo']); ?>
            </div>

            <!-- Comments -->

              <div class="content">


                  <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>


                  <form action="single.php?id_publicacao=<?php echo $post['id_publicacao']; ?>" method="post" enctype="multipart/form-data">

                      <div>
                          <label> Deixe sua opinião!</label>
                          <br>
                          <br>
                          <textarea name="conteudo" class="text-input"><?php echo $conteudo_comment ?></textarea> 
                      </div>

                      <br>

                      <div>
                          <button type="submit" name="add-comment" class="btn btn-big">Adicionar Comentário</button>
                      </div>

                  </form>

                  <br>
                  <br>

                  <div>

                      <?php foreach ($comments as $key => $comment): ?>

                      <div class="comment clearfix">

                        <?php foreach ($users as $key => $user): ?>

                          <?php if ($user['id_usuario'] == $comment['fk_id_usuario']): ?>
                              <img src="<?php echo BASE_URL . '/assets/images/' . $user['foto_perfil']; ?>" alt="" class="comment-image">

                              <div class="comment-preview">
                                <h2><?php echo $user['nome_usuario']; ?></a></h2>

                                <br>

                                <i class="far fa-calendar"> <?php echo date('d-m-Y', strtotime($comment['data_hora'])); ?></i>

                                <p class="preview-text-comment">
                                  <?php echo $comment['conteudo']; ?>
                                </p>

                                <?php if (isset($_SESSION['id_usuario'])): ?>

                                  <?php if ($comment['fk_id_usuario'] == $_SESSION['id_usuario']): ?>

                                    <a href="single.php?id_publicacao=<?php echo $post['id_publicacao']; ?>&delete_id=<?php echo $comment['id_comentario']; ?>" class="comment-delete">Deletar</a>

                                  <?php endif; ?>

                                <?php endif; ?>

                              </div>

                          <?php endif; ?>
                            
                        <?php endforeach; ?>

                      </div>

                      <?php endforeach; ?>

                  </div>

              </div>

            <!-- END Comments -->

          </div>
        </div>

        <!-- // Main Content -->

        <!-- Sidebar -->
        <div class="sidebar single">

          <div class="section popular">

            <h2 class="section-title">Popular</h2>

            <?php foreach ($posts as $p): ?>

                <div class="post clearfix">
                  <img src="<?php echo BASE_URL . '/assets/images/' . $p['imagem_capa']; ?>" alt="">
                  <a href="single.php?id_publicacao=<?php echo $p['id_publicacao']; ?>" class="title">
                    <h4><?php echo $p['titulo']; ?></h4>
                  </a>
                </div>

            <?php endforeach; ?>

          </div>

          <div class="section topics">
            <h2 class="section-title"> Categorias</h2>
            <ul>

              <?php foreach ($topics as $topic): ?>
              <li><a href="<?php echo BASE_URL . '/index.php?t_id=' . $topic['id_categoria'] . '&nome=' . $topic['nome']; ?>"><?php echo $topic['nome']; ?></a></li>
              <?php endforeach; ?>
            </ul>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Slick Carousel -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <!-- Custom Script -->
    <script src="assets/js/scripts.js"></script>

</body>

</html>