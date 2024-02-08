<?php 
    //inico da sessão
    session_start();

    //carregamento de rotas permitidas
    $rotas_permitidas = require_once __DIR__ . '/../inc/rotas.php';

    //definição da rota
    $rota = $_GET['rota'] ?? 'home';
    //verifica se o usuario está logado
    if (!isset($_SESSION['usuario']) && $rota !== 'login_submit') {
        $rota = 'login';
    }

    //se o usuario está logado e tenta entrar no login
    if (isset($_SESSION['usuario']) && $rota === 'login') {
        $rota = 'home';
    }

    //se a rota não existe
    if (!in_array($rota, $rotas_permitidas)) {
        $rota = '404;';
    }
    //preparação da pagina
    $script = null;
    switch ($rota) {
        case '404':
            $script = '404.php';
            break;
        
        case 'login':
            $script = 'login.php';
            break;
            
        case 'logout':
            $script = 'logout.php';
            break;
            
        case 'login_submit':
            $script = 'login_submit.php';
            break;
            
        case 'home':
            $script = 'home.php';
            break;  

        case 'cad_prod':
            $script = 'cad_prod.php';
            break;
        case 'cad_cli':
            $script = 'cad_cli.php';
            break;  

        case 'exibir_ped':
            $script = 'exibir_ped.php';
            break;

        case 'home_submit':
            $script = 'home_submit.php';
            break; 

        case 'ger_pedidos':
            $script = 'ger_pedidos.php';
            break;

        case 'ger_produtos':
            $script = 'ger_produtos.php';
            break;

        case 'ger_clientes':
            $script = 'ger_clientes.php';
            break;

        case 'clientes_submit':
            $script = 'clientes_submit.php';
            break;

        case 'produtos_submit':
            $script = 'produtos_submit.php';
            break;
    }
    //carregamento de scripts permanentes
    require_once __DIR__ . "/../inc/pessoa.php";
    require_once __DIR__ . "/../inc/config.php";
    require_once __DIR__ . "/../inc/database.php";
    require_once __DIR__ . "/../inc/produto.php";
    require_once __DIR__ . "/../inc/pedido.php";
    require_once __DIR__ . "/../inc/item.php";
    require_once __DIR__ . "/../inc/loja.php";
    require_once __DIR__ . "/../inc/adm.php";
    require_once __DIR__ . "/../inc/cliente.php";
    require_once __DIR__ . "/../inc/func.php";

    //apresentação da pagina
    require_once __DIR__ . "/../inc/header.php";
    require_once __DIR__ . "/../scripts/$script";
    require_once __DIR__ . "/../inc/footer.php";
