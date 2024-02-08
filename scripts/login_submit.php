<?php 

    //verificar se aconteceu um post
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: index.php?rota=login');
        exit();
    }

    //vai buscar os dados do POST
    $usuario = $_POST['text_usuario'] ?? null;
    $senha = $_POST['text_senha'] ?? null;

    //verifica se os dados estão preenchidos
    if (empty($usuario) || empty($senha)) {
        header('Location: index.php?rota=loguin');
        die();
    }
    //a classe da base de dados já está carregada no index.php
    $db = new database();
    $params = [
        ':usuario' => $usuario
    ];
    $sql ="SELECT * FROM pessoa WHERE usuario = :usuario";
    $result = $db->query($sql, $params);

    //verifica se aconteceu um erro
    if ($result['status'] === 'error') {
        header('Location: index.php?rota=404');
        exit;
    }

    //verifica se o usuario existe
    if (count($result['data']) === 0) {

        //erro na sessão
        $_SESSION['error'] = 'Usuário ou Senha inválidos !';
        header('Location: index.php?rota=loguin');
        exit;
    }

     //verifica se a senha está correta
     if (!password_verify($senha, $result['data'][0]->senha)) {

        //erro na sessão
        $_SESSION['error'] = 'Usuário ou Senha inválidos !';
        header('Location: index.php?rota=loguin');
        exit;
     }

     //define a sessão do usuário como o objeto $_SESSION['usuario']
     $user = new Adm($result['data'][0]->usuario);
     $_SESSION['usuario'] = $user->getId();

     echo $_SESSION['usuario'];

     //redirecionar para a pagina inicial
        header('Location: index.php?rota=home');
        exit;
