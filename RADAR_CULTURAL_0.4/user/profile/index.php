<?php include("../../path.php"); ?>
<?php 
    include(ROOT_PATH . "/app/controllers/users.php"); 
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
    </head>

    <body>

    <?php include(ROOT_PATH . "/app/includes/header.php"); ?>

        <!-- Admin Page Wrapper -->
        <div class="admin-wrapper">


            <!-- Admin Content -->
            <div class="admin-content">
                <div class="content">

                    <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>

                    <h1> Usuário </h1>

                    <table>
                        <thead>
                            <th>SN</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th colspan="2">Action</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php  echo  1; ?></td>
                                <td><?php echo $_SESSION['nome_usuario']; ?></td>
                                <td><?php echo $_SESSION['email']; ?></td>
                                <td><a href="edit.php?edit_id_usuario=<?php echo $_SESSION['id_usuario']; ?>" class="edit">edit</a></td>
                                <td><a href="index.php?delete_id_usuario=<?php echo $_SESSION['id_usuario']; ?>" class="delete">delete</a></td>
                            </tr>
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