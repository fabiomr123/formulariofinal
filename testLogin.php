<?php
    session_start();

    if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
        // Conectar com o banco de dados
        include_once('projeto1.php'); // Aqui você inclui o arquivo que faz a conexão com o banco

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Consulta ao banco para verificar o usuário
        $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        $result = $conexao->query($sql);

        // Verifica se o usuário foi encontrado
        if ($result->num_rows < 1) {
            // Usuário não encontrado
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            header('Location: login.php');
            exit;
        } else {
            // Usuário encontrado
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('Location: sistema.php');
            exit;
        }
    } else {
        // Caso o formulário não tenha sido preenchido corretamente
        header('Location: login.php');
        exit;
    }
?>
