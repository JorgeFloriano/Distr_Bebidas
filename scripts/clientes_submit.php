<?php

    // Editar cadastro de cliente
    if (isset($_POST['txtId']) && $_POST['txtId'] != 0 && isset($_POST['Editar'])) {
        $cliente = new Cliente($_POST['txtId']);
        if ($cliente->editar($_POST['txtNome'],$_POST['txtData'] ?? 'NULL',$_POST['txtLograd'] ?? "rua 123",$_POST['txtNumero'] ?? "00",$_POST['txtBairro'] ?? "123",$_POST['txtCompl'] ?? "123",$_POST['txtCidade'] ?? "123",$_POST['txtUf'] ?? "Indefinido",$_POST['txtCep'] ?? "1234",$_POST['txtFone'] ?? "1234",$_POST['txtFone2'] ?? "1234",$_POST['txtCnpj'] ?? $_POST['txtId'],$_POST['txtCpf'] ?? $_POST['txtId'],$_POST['txtEmail'] ?? $_POST['txtId'],$_POST['txtUsuario'] ?? $_POST['txtId'],$_POST['txtId'])['status'] == 'succes') {
            $msg = 'Cadatro Editado com Sucesso !';
        } else {
            $msg = 'Erro, sistema não pode conter nome, cpf, cnpj ou email em duplicidade !';
        }

    // Deleter Cadastro de Cliente
    } elseif (isset($_POST['txtId']) && $_POST['txtId'] != 0 && isset($_POST['Deletar'])) {
        $cliente = new Cliente($_POST['txtId']);
        if ($cliente->delete()['status'] == 'succes') {
            $msg = 'Cadastro Excluído com Sucesso !';
        } else {
            $msg = 'Erro ao excluir o cadastro !';
        }

    // Novo Cadastro de Cliente
    } elseif (isset($_POST['txtId']) && $_POST['txtId'] == 0 && isset($_POST['Novo'])) {
        if (cadastrarCliente($_POST['txtNome'],$_POST['txtLograd'] ?? "Indefinido",$_POST['txtNumero'] ?? "0000",$_POST['txtBairro'] ?? "Indefinido",$_POST['txtCidade'] ?? "Indefinido",$_POST['txtUf'] ?? "Indefinido",$_POST['txtCep'] ?? "Indefinido",$_POST['txtFone'] ?? "Indefinido",$_POST['txtFone2'] ?? "Indefinido",$_POST['txtCnpj'] ?? $_POST['txtEmail'],$_POST['txtCpf'] ?? $_POST['txtEmail'],$_POST['txtEmail'],$_POST['txtUsuario'] ?? $_POST['txtEmail'],$_POST['txtEmail'])['status'] == 'succes') {
            $msg = 'Cliente Cadastrado com Sucesso !';
        } else {
            $msg = 'Erro, sistema não pode conter nome, cpf, cnpj ou email em duplicidade !';
        }
    } else {
        $msg = 'Erro !!';
    }
?>
<div class="center">
    <h3 style="text-align: center;"><?=$msg?></h3>
    <a href="?rota=ger_clientes">   
        <button name="btn" style="width:97%;">OK</button>
    </a>
</div>
