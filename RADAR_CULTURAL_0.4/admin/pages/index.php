<?php include("../../path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/pages.php"); 
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

        <title>Admin Section - Manage Pages</title>
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
                    <a href="create.php" class="btn btn-big">Add Page</a>
                    <a href="index.php" class="btn btn-big">Manage Pages</a>
                </div>


                <div class="content">

                    <h2 class="page-title">Manage Pages</h2>

                    <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>

                    <table>
                        <thead>
                            <th>SN</th>
                            <th>Title</th>
                            <th colspan="2">Action</th>
                        </thead>
                        <tbody>
                            <?php foreach ($pages as $key => $page): ?>
                               <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $page['titulo']; ?></td>
                                    <td><a href="edit.php?id_pagina=<?php echo $page['id_pagina']; ?>" class="edit">edit</a></td>
                                    <td><a href="index.php?del_id=<?php echo $page['id_pagina']; ?>" class="delete">delete</a></td>
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