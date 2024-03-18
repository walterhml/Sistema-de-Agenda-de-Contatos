<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone'])) {

        $contatos = json_decode(file_get_contents('contatos.json'), true);


        $contato = [
            'id' => uniqid(),
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone']
        ];

        $contatos[] = $contato;


        file_put_contents('contatos.json', json_encode($contatos));


        header('Location: index.php');
        exit;
    }
}


$contatos = json_decode(file_get_contents('contatos.json'), true);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Contatos</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h1>Agenda de Contatos</h1>
        <div id="contact-list">
            <?php foreach ($contatos as $contato) : ?>
                <div class="contact">
                    <div>
                        <h3><?php echo $contato['name']; ?></h3>
                        <p>Email: <?php echo $contato['email']; ?></p>
                        <p>Telefone: <?php echo $contato['phone']; ?></p>
                    </div>
                    <div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button id="add-contact-btn">Adicionar Contato</button>
    </div>

    <div id="contact-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="modal-title">Adicionar Contato</h2>
            <form id="contact-form" method="post">
                <input type="hidden" id="contact-id">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" required>
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
                <label for="phone">Telefone:</label>
                <input type="text" id="phone" name="phone" required>
                <button type="submit" id="save-contact-btn">Salvar</button>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>