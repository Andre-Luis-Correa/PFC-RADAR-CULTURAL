<?php // include(ROOT_PATH . "/app/controllers/topics.php");
//adminOnly();
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

        <!-- Admin Styling -->
        <link rel="stylesheet" href="../../assets/css/admin.css">

        <title>Admin Section - Edit Post</title>
    </head>

    <body>
        
    <?php include("../../app/includes/adminHeader.php"); ?>

        <!-- Admin Page Wrapper -->
        <div class="admin-wrapper">

        <?php include("../../app/includes/adminSidebar.php"); ?>


            <!-- Admin Content -->
            <div class="admin-content">
                <div class="button-group">
                    <a href="create.php" class="btn btn-big">Add Post</a>
                    <a href="index.php" class="btn btn-big">Manage Posts</a>
                </div>


                <div class="content">

                    <h2 class="page-title">Edit Post</h2>

                    <?php //include(ROOT_PATH . '/app/helpers/formErrors.php'); ?>

                    <form action="create.php" method="post" enctype="multipart/form-data">
                        <div>
                            <label>Título</label>
                            <input type="text" name="titulo" value="<?php //echo $titulo ?>" class="text-input">
                        </div>
                        <div>
                            <label>Resumo</label>
                            <input type="text" name="resumo" value="<?php //echo $titulo ?>" class="text-input">
                        </div>
                        <div>
                            <label>Conteudo</label>
                            <textarea name="conteudo" id="body"><?php //echo $conteudo ?></textarea>
                        </div>
                        <div>
                            <label>Imagem de capa</label>
                            <input type="file" name="imagem_capa" class="text-input">
                        </div>
                        <div>
                            <label>Categoria</label>
                            <select name="fk_id_categoria" class="text-input">
                                <option value=""></option>
                                <?php /*foreach ($topics as $key => $topic): ?>
                                    <?php if (!empty($topic_id) && $topic_id == $topic['id'] ): ?>
                                        <option selected value="<?php echo $topic['id'] ?>"><?php echo $topic['name'] ?></option>
                                    <?php else: ?>
                                        <option value="<?php echo $topic['id'] ?>"><?php echo $topic['name'] ?></option>
                                    <?php endif; ?>

                                <?php endforeach; */?>

                            </select>
                        </div>
                        <div>
                            <label>Tag</label>
                            <select name="fk_id_tag" class="text-input">
                                <option value=""></option>
                                <?php /*foreach ($topics as $key => $topic): ?>
                                    <?php if (!empty($topic_id) && $topic_id == $topic['id'] ): ?>
                                        <option selected value="<?php echo $topic['id'] ?>"><?php echo $topic['name'] ?></option>
                                    <?php else: ?>
                                        <option value="<?php echo $topic['id'] ?>"><?php echo $topic['name'] ?></option>
                                    <?php endif; ?>

                                <?php endforeach; */?>

                            </select>
                        </div>
                        <div>
                            <?php /*if (empty($published)): ?>
                                <label>
                                    <input type="checkbox" name="published">
                                    Publish
                                </label>
                            <?php else: ?>
                                <label>
                                    <input type="checkbox" name="published" checked>
                                    Publish
                                </label>
                            <?php endif; */?>
                           

                        </div>
                        <div>
                            <button type="submit" name="add-post" class="btn btn-big">Update Post</button>
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