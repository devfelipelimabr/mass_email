<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envio de E-mails em Massa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Ocultar o spinner inicialmente */
        #spinner {
            display: none;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: scale(2);
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>Envio de E-mails em Massa</h2>

        <!-- Spinner -->
        <div id="spinner" class="text-center">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only"></span>
            </div>
        </div>

        <form id="emailForm" action="send_emails.php" method="POST">
            <button type="submit" id="submitButton" class="btn btn-primary">Enviar E-mails</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#emailForm').on('submit', function() {
                // Desativar o botão de enviar
                $('#submitButton').prop('disabled', true);
                // Mostrar o spinner
                $('#spinner').show();
            });
        });
    </script>
</body>

</html>