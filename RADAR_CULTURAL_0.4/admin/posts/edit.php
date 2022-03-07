<?php include("../../path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/posts.php");
adminOnly();
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

        <title>Sessão do Colaborador - Editar Post</title>
        <link rel="shortcut icon" type="imagex/png" href="../../assets/images/logo.ico">
    </head>

    <body>
        
    <?php include(ROOT_PATH . "/app/includes/adminHeader.php"); ?>

        <!-- Admin Page Wrapper -->
        <div class="admin-wrapper">

        <?php include(ROOT_PATH . "/app/includes/adminSidebar.php"); ?>


            <!-- Admin Content -->
            <div class="admin-content">
                <div class="button-group">
                    <a href="create.php" class="btn btn-big">Adicionar Post</a>
                    <a href="index.php" class="btn btn-big">Gerenciar Posts</a>
                </div>


                <div class="content">

                    <h2 class="page-title">Editar Post</h2>

                    <?php include(ROOT_PATH . '/app/helpers/formErrors.php'); ?>

                    <form action="edit.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_publicacao" value="<?php echo $id ?>">
                        <div>
                            <label>Título</label>
                            <input type="text" name="titulo" value="<?php echo $titulo ?>" class="text-input">
                        </div>
                        <div>
                            <label>Imagem de capa</label>
                            <input type="file" accept="image/png,image/jpeg" name="imagem_capa" class="text-input">
                        </div>
                        <div>
                            <label>Resumo</label>
                            <input type="text" name="resumo" value="<?php echo $resumo ?>" class="text-input">
                        </div>
                        <div>
                            <label>Conteudo</label>
                            <textarea name="conteudo" id="body"><?php echo $conteudo ?></textarea>
                        </div>
                        <div>
                            <label>Categoria</label>
                            <select name="fk_id_categoria" class="text-input">
                                <option value=""></option>
                                <?php foreach ($topics as $key => $topic): ?>
                                    <?php if (!empty($categoria_id) && $categoria_id == $topic['id_categoria']): ?>
                                        <option selected value="<?php echo $topic['id_categoria'] ?>"><?php echo $topic['nome'] ?></option>
                                    <?php else: ?>
                                        <option value="<?php echo $topic['id_categoria'] ?>"><?php echo $topic['nome'] ?></option>
                                    <?php endif; ?>

                                <?php endforeach; ?>

                            </select>
                        </div>
                        <div>
                            <?php if (empty($publicado) && $publicado == 0): ?>
                                <label>
                                    <input type="checkbox" name="publicado">
                                    Público
                                </label>
                            <?php else: ?>
                                <label>
                                    <input type="checkbox" name="publicado" checked>
                                    Público
                                </label>
                            <?php endif; ?>
                           

                        </div>
                        <div>
                            <button type="submit" name="update-post" class="btn btn-big">Atualizar Post</button>
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