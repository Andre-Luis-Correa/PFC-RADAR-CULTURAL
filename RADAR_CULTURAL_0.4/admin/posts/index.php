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

        <title>Sessão do Colaborador - Gerenciar Posts</title>
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

                    <h2 class="page-title">Gerenciar Posts</h2>

                    <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>

                    <table>
                        <thead>
                            <th>índice</th>
                            <th>Título</th>
                            <th>Autor</th>
                            <th colspan="3">Ação</th>
                        </thead>
                        <tbody>
                            <?php foreach ($posts as $key => $post): ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $post['titulo'] ?></td>

                                    <?php foreach ($users as $key => $user): ?>
                                    

                                    <?php if ($user['id_usuario'] == $post['fk_id_usuario']): ?>
                                        <td>
                                        <?= $user['nome_usuario']; ?>
                                        </td>

                                    <?php endif; ?>
                                        
                                    <?php endforeach; ?>



                                    <td><a href="edit.php?id_publicacao=<?php echo $post['id_publicacao']; ?>" class="edit"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                    width="24" height="24"
                                    viewBox="0 0 172 172"
                                    style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#2ecc71"><path d="M131.96744,14.33333c-1.83467,0 -3.66956,0.70211 -5.06706,2.09961l-14.33333,14.33333l-10.13411,10.13411l-80.93294,80.93294v28.66667h28.66667l105.40039,-105.40039c2.80217,-2.80217 2.80217,-7.33911 0,-10.13412l-18.53255,-18.53255c-1.3975,-1.3975 -3.23239,-2.09961 -5.06706,-2.09961zM131.96744,31.63411l8.39844,8.39844l-9.26628,9.26628l-8.39844,-8.39844zM112.56706,51.03451l8.39844,8.39844l-76.73372,76.73372h-8.39844v-8.39844z"></path></g></g></svg></a></td>

                                    <td><a href="edit.php?delete_id=<?php echo $post['id_publicacao']; ?>" class="delete"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                    width="24" height="24"
                                    viewBox="0 0 172 172"
                                    style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#e74c3c"><path d="M71.66667,14.33333l-7.16667,7.16667h-43v14.33333h7.95052l12.77962,109.33366v0.05599c0.939,7.07108 7.07882,12.44368 14.20736,12.44368h59.111c7.12853,0 13.26835,-5.37269 14.20736,-12.44368l0.014,-0.05599l12.77962,-109.33366h7.95052v-14.33333h-43l-7.16667,-7.16667zM43.89583,35.83333h84.20833l-12.55566,107.5h-59.111z"></path></g></g></svg></a></td>


                                    <?php if ($post['publicado']): ?>
                                        <td><a href="edit.php?publicado=0&p_id=<?php echo $post['id_publicacao'] ?>" class="unpublish"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                        width="49" height="49"
                                        viewBox="0 0 172 172"
                                        style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#3498db"><path d="M51.6,34c-28.45167,0 -51.6,23.10347 -51.6,51.5c0,28.39653 23.14833,51.5 51.6,51.5h68.8c28.45167,0 51.6,-23.10347 51.6,-51.5c0,-28.39653 -23.14833,-51.5 -51.6,-51.5zM51.6,39.72222h45.26758c-16.6396,8.55671 -28.06758,25.84499 -28.06758,45.77778c0,19.93279 11.42798,37.22107 28.06758,45.77778h-45.26758c-25.2926,0 -45.86667,-20.53706 -45.86667,-45.77778c0,-25.24072 20.57407,-45.77778 45.86667,-45.77778zM120.4,39.72222c25.2926,0 45.86667,20.53706 45.86667,45.77778c0,25.24072 -20.57407,45.77778 -45.86667,45.77778c-25.2926,0 -45.86667,-20.53706 -45.86667,-45.77778c0,-25.24072 20.57407,-45.77778 45.86667,-45.77778zM120.4,45.44444c-22.13067,0 -40.13333,17.96778 -40.13333,40.05556c0,22.08778 18.00267,40.05556 40.13333,40.05556c22.13067,0 40.13333,-17.96778 40.13333,-40.05556c0,-1.57933 -1.28427,-2.86111 -2.86667,-2.86111c-1.5824,0 -2.86667,1.28178 -2.86667,2.86111c0,18.93197 -15.43127,34.33333 -34.4,34.33333c-18.96873,0 -34.4,-15.40136 -34.4,-34.33333c0,-18.93197 15.43127,-34.33333 34.4,-34.33333c1.5824,0 2.86667,-1.28178 2.86667,-2.86111c0,-1.57933 -1.28427,-2.86111 -2.86667,-2.86111z"></path></g></g></svg></a></td>

                                    <?php else: ?>
                                        <td><a href="edit.php?publicado=1&p_id=<?php echo $post['id_publicacao'] ?>" class="publish"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                        width="49" height="49"
                                        viewBox="0 0 172 172"
                                        style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#050505"><path d="M51.6,34c-28.45167,0 -51.6,23.10347 -51.6,51.5c0,28.39653 23.14833,51.5 51.6,51.5h68.8c28.45167,0 51.6,-23.10347 51.6,-51.5c0,-28.39653 -23.14833,-51.5 -51.6,-51.5zM51.6,39.72222c25.2926,0 45.86667,20.53706 45.86667,45.77778c0,25.24072 -20.57407,45.77778 -45.86667,45.77778c-25.2926,0 -45.86667,-20.53706 -45.86667,-45.77778c0,-1.57755 0.07829,-3.13472 0.23516,-4.67166c2.35296,-23.05398 21.9197,-41.10612 45.63151,-41.10612zM75.13242,39.72222h45.26758c25.2926,0 45.86667,20.53706 45.86667,45.77778c0,25.24072 -20.57407,45.77778 -45.86667,45.77778h-45.26758c16.6396,-8.55671 28.06758,-25.84499 28.06758,-45.77778c0,-19.93279 -11.42798,-37.22107 -28.06758,-45.77778zM51.6,45.44444c-22.13067,0 -40.13333,17.96778 -40.13333,40.05556c0,22.08778 18.00267,40.05556 40.13333,40.05556c22.13067,0 40.13333,-17.96778 40.13333,-40.05556c0,-1.57933 -1.28427,-2.86111 -2.86667,-2.86111c-1.5824,0 -2.86667,1.28178 -2.86667,2.86111c0,18.93197 -15.43127,34.33333 -34.4,34.33333c-18.96873,0 -34.4,-15.40136 -34.4,-34.33333c0,-18.93197 15.43127,-34.33333 34.4,-34.33333c1.5824,0 2.86667,-1.28178 2.86667,-2.86111c0,-1.57933 -1.28427,-2.86111 -2.86667,-2.86111z"></path></g></g></svg></a></td>
                                    <?php endif; ?>
                                    
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