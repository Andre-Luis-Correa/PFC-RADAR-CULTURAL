<?php 

include("path.php");
include(ROOT_PATH . "/app/controllers/topics.php");

$posts = array();
$postsTitle = 'Recente Posts';

if (isset($_GET['t_id'])) {
  $postsTitle = "Você pesquisou por posts na categoria '" . $_GET['nome'] . "'";
  $posts = getPostsByTopic($_GET['t_id']);

} elseif (isset($_POST['search-term'])) {
  $postsTitle = "Você pesquisou por '" . $_POST['search-term'] . "'";
  $posts = searchPosts($_POST['search-term']);
  
} else {
  $posts = getPublishedPosts();
}

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

  <title>RADAR CULTURAL</title>
  <link rel="shortcut icon" type="imagex/png" href="assets/images/logo.ico">
</head>

<style type="text/css">

.post .post-topic {
  position: static;
  display: block;
  width: 25%;
  height: 25px;
  color: white;
  font-size: bold;
  border-radius: 8px;
  margin-left: 15px;
  margin-top: 10px;
  text-align: center;
  padding-top: 1px;
}

.post .post-topic .btn-topic {
  font-size: bold;
  color: white;
}

.post .post-topic .btn-topic h5 {
  color: white;
}

.post .post-topic .btn-topic:hover {
  color: white;
}

.content .main-content .post .post-topic {
  position: static;
  display: block;
  width: 25%;
  height: 25px;
  color: white;
  font-size: bold;
  border-radius: 8px;
  margin-left: 5px;
  margin-top: 10px;
  margin-bottom: 10px;
  text-align: center;
  padding-top: 1px;
}


</style>

<body>
  
  <?php include(ROOT_PATH . "/app/includes/header.php"); ?>
  <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>

  <!-- Page Wrapper -->
  <div class="page-wrapper">

    <!-- Post Slider -->
    <div class="post-slider">
      <h1 class="slider-title">Trending Posts</h1>
      <i class="fas fa-chevron-left prev"></i>
      <i class="fas fa-chevron-right next"></i>

      <div class="post-wrapper">

        <?php foreach ($posts as $post): ?>

          <div class="post">
            <img src="<?php echo BASE_URL . '/assets/images/' . $post['imagem_capa']; ?>" alt="" class="slider-image">

            <?php foreach ($topics as $key => $topic): ?>

              <?php if ($post['fk_id_categoria'] == $topic['id_categoria']): ?>

                <div style="background-color: <?php echo $topic['cor'] ?>" class="post-topic">
                  <a href="<?php echo BASE_URL . '/index.php?t_id=' . $post['fk_id_categoria'] . '&nome=' . $topic['nome']; ?>" class="btn-topic"><h5><?php echo $topic['nome']; ?></h5></a>
                </div>

              <?php endif; ?>

            <?php endforeach; ?>

            <div class="post-info">
              <h4><a href="single.php?id_publicacao=<?php echo $post['id_publicacao']; ?>"><?php echo $post['titulo']; ?></a></h4>
              <i class="far fa-user"> <?php echo $post['nome_usuario']; ?></i>
              &nbsp;
              <i class="far fa-calendar"> <?php echo date('d-m-Y', strtotime($post['data_hora'])); ?></i>
            </div>
          </div>

        <?php endforeach; ?>

      </div>

    </div>
    <!-- // Post Slider -->

    <!-- Content -->
    <div class="content clearfix">

      <!-- Main Content -->
      <div class="main-content">
        <h1 class="recent-post-title"><?php echo $postsTitle; ?></h1>

        <?php foreach ($posts as $post): ?>

        <div class="post clearfix">
          <img src="<?php echo BASE_URL . '/assets/images/' . $post['imagem_capa']; ?>" alt="" class="post-image">
          <div class="post-preview">
            <?php foreach ($topics as $key => $topic): ?>

              <?php if ($post['fk_id_categoria'] == $topic['id_categoria']): ?>

                <div style="background-color: <?php echo $topic['cor'] ?>" class="post-topic">
                  <a href="<?php echo BASE_URL . '/index.php?t_id=' . $post['fk_id_categoria'] . '&nome=' . $topic['nome']; ?>" class="btn-topic"><h5><?php echo $topic['nome']; ?></h5></a>
                </div>

              <?php endif; ?>

            <?php endforeach; ?>
            <h2><a href="single.php?id_publicacao=<?php echo $post['id_publicacao']; ?>"><?php echo $post['titulo']; ?></a></h2>
            <i class="far fa-user"> <?php echo $post['nome_usuario']; ?></i>
            &nbsp;
            <i class="far fa-calendar"> <?php echo date('d-m-Y', strtotime($post['data_hora'])); ?></i>
            <p class="preview-text">
              <?php echo html_entity_decode(substr($post['resumo'], 0, 140) . '...'); ?>
            </p>
            <a href="single.php?id_publicacao=<?php echo $post['id_publicacao']; ?>" class="btn read-more">Read More</a>
          </div>
        </div>

        <?php endforeach; ?>

      </div>
      <!-- // Main Content -->

      <div class="sidebar">

        <div class="section search">
          <h2 class="section-title">Search</h2>
          <form action="index.php" method="post">
            <input type="text" name="search-term" class="text-input" placeholder="Search...">
          </form>
        </div>


        <div class="section topics">
          <h2 class="section-title">Topics</h2>
          <ul>

            <?php foreach ($topics as $key => $topic): ?>
               <li><a href="<?php echo BASE_URL . '/index.php?t_id=' . $topic['id_categoria'] . '&nome=' . $topic['nome']; ?>"><?php echo $topic['nome']; ?></a></li>
            <?php endforeach; ?>

          </ul>
        </div>

      </div>

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