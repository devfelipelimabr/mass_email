<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envio de E-mails em Massa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Envio de E-mails em Massa</h2>
        <form action="send_emails.php" method="POST">
            <button type="submit" class="btn btn-primary">Enviar E-mails</button>
        </form>
    </div>
</body>

</html>