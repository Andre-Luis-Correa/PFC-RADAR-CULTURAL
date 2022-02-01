<?php include("path.php"); ?>
<?php include(ROOT_PATH . '/app/controllers/posts.php'); 

if (isset($_GET['id_publicacao'])) {
  $post = selectOne('tb_publicacao', ['id_publicacao' => $_GET['id_publicacao']]);
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
</head>

<body>
  <!-- Facebook Page Plugin SDK -->
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous"
    src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2&appId=285071545181837&autoLogAppEvents=1">
  </script>

  <?php include(ROOT_PATH . "/app/includes/header.php"); ?>

  <!-- Page Wrapper -->
  <div class="page-wrapper">

    <!-- Content -->
    <div class="content clearfix">

      <!-- Main Content Wrapper -->
      <div class="main-content-wrapper">
        <div class="main-content single">
          <h1 class="post-title"><?php echo $post['titulo']; ?></h1>

          <div class="post-content">
             <?php echo html_entity_decode($post['conteudo']); ?>
          </div>

        </div>
      </div>
      <!-- // Main Content -->

      <!-- Sidebar -->
      <div class="sidebar single">

        <!-- <div class="fb-page" data-href="https://web.facebook.com/codingpoets/" data-small-header="false"
          data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
          <blockquote cite="https://web.facebook.com/codingpoets/" class="fb-xfbml-parse-ignore"><a
              href="https://web.facebook.com/codingpoets/">Coding Poets</a></blockquote>
        </div> -->


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
          <h2 class="section-title">Topics</h2>
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