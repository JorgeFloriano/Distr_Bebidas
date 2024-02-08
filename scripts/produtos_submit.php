<?php

    // Editar cadastro de produto
    if (isset($_POST['txtId']) && $_POST['txtId'] != 0 && isset($_POST['Editar'])) {
        $produto = new Produto($_POST['txtId']);
        if ($produto->editar($_POST['txtDes'], $_POST['txtPre'], $_POST['txtQtd'])['status'] == 'succes') {
            $msg = 'Cadatro Editado com Sucesso !';
        } else {
            $msg = 'Erro ao editar cadastro !';
        }

    // Deleter Cadastro de produto
    } elseif (isset($_POST['txtId']) && $_POST['txtId'] != 0 && isset($_POST['Deletar'])) {
        $produto = new Produto($_POST['txtId']);
        if ($produto->excluir()['status'] == 'succes') {
            $msg = 'Cadastro Excluído com Sucesso !';
        } else {
            $msg = 'Erro ao excluir o cadastro !';
        }

    // Novo Cadastro de produto
    } elseif (isset($_POST['txtId']) && $_POST['txtId'] == 0 && isset($_POST['Novo'])) {
        if (cadastrarProduto($_POST['txtDes'], $_POST['txtPre'], $_POST['txtQtd'])['status'] == 'succes') {
            $msg = 'Produto Cadastrado com Sucesso !';
        } else {
            $msg = 'Erro ao cadastrar produto !';
        }
    } else {
        $msg = 'Erro !!';
    }
?>
<div class="center">
    <h3 style="text-align: center;"><?=$msg?></h3>
    <a href="?rota=ger_produtos">   
        <button name="btn" style="width:97%;">OK</button>
    </a>
</div>
