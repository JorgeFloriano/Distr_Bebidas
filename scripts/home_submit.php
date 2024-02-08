<?php
    // instancia pedido
    $pedido = new Pedido($_GET['id_ped']);

    // Se o pedido já estiver concluido volta para a tela inicial
    if ($pedido->getPago() == 1) {
        header("Location: index.php?rota=home");
        die();
    }

    // Atualiza cliente no pedido
    $pedido->setCliente($_POST['cliente']);
  
    // Adicionar item novo no pedido com 1 unidade
    if (isset($_POST['prodaddlist']) && $_POST['prodaddlist'] != '') {
        $pedido->addItem($_POST['prodaddlist'], 1);
    }
   
    // Atualizar quantidade dos itens conforme tabela em home.php
    for ($i = 0; count($pedido->getItem()) > $i; $i++) {
        $qtd = $_POST['Prod'.$pedido->getItem()[$i]->getId_pr()];
        if (($qtd) == 0) {
            $pedido->getItem()[$i]->excluir();
        } else {
            $pedido->getItem()[$i]->setQuant($qtd);
        }
    }

    // Rotas dos links do sidebar da tela home
    if (isset($_POST['home'])) {
        header("location:index.php?rota=home");
        die();
    } elseif (isset($_POST['ger_clientes'])) {
        header("location:index.php?rota=ger_clientes");
        die();
    } elseif (isset($_POST['ger_pedidos'])) {
        header("location:index.php?rota=ger_pedidos");
        die();
    } elseif (isset($_POST['ger_produtos'])) {
        header("location:index.php?rota=ger_produtos");
        die();
    } elseif (isset($_POST['logout'])) {
        header("location:index.php?rota=logout");
        die();
    
    // concluir pedido
    } elseif (isset($_POST['btnConcluir']) && $pedido->getValor() > 0 && $pedido->getCliente() !== 'NULL') {
        $pedido->concluir();
        header("location: index.php?rota=exibir_ped&id_ped=".$_GET['id_ped']);
        die();

    // Gerar novo pedido
    } elseif (isset($_POST['btnNovo'])) {
        unset($_SESSION['id_ped']);
        header("Location: index.php?rota=home&novo=true");
        die();

    // Volta para home
    } else {
        header("Location: index.php?rota=home");
        die();
    }

