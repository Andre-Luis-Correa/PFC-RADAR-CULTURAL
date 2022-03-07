<?php include("../../path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/comments.php");
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

        <title> Sessão do Administrador - Gerenciar Comentários</title>
        <link rel="shortcut icon" type="imagex/png" href="../../assets/images/logo.ico">
    </head>

    <body>
        
    <?php include(ROOT_PATH . "/app/includes/adminHeader.php"); ?>

        <!-- Admin Page Wrapper -->
        <div class="admin-wrapper">

        <?php include(ROOT_PATH . "/app/includes/adminSidebar.php"); ?>


            <!-- Admin Content -->
            <div class="admin-content">


                <div class="content">

                    <h2 class="page-title"> Gerenciar Comentários</h2>

                    <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>

                    <table>
                        <thead>
                            <th> Índice</th>
                            <th>Conteúdo</th>
                            <th>Publicação</th>
                            <th>Autor</th>
                            <th>Ação</th>
                        </thead>
                        <tbody>
                            <?php foreach ($comments as $key => $comment): ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $comment['conteudo'] ?></td>

                                    <?php foreach ($posts as $key => $post): ?>

                                    <?php if ($post['id_publicacao'] == $comment['fk_id_publicacao']): ?>
                                        <td>
                                            <?= $post['titulo']; ?>
                                        </td>

                                    <?php endif; ?>
                                        
                                    <?php endforeach; ?>

                                    <?php foreach ($users as $key => $user): ?>

                                    <?php if ($user['id_usuario'] == $comment['fk_id_usuario']): ?>
                                        <td>
                                            <?= $user['nome_usuario']; ?>
                                        </td>

                                    <?php endif; ?>
                                        
                                    <?php endforeach; ?>

                                    <td><a href="index.php?delete_id=<?php echo $comment['id_comentario']; ?>" class="delete">Deletar</a></td>
                                    
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>

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