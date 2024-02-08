<?php
    if (isset($_GET['id'])) {
        $cliente = new Cliente($_GET['id']);
    } else {
        $cliente = new Cliente(0);
    }
?>
<script src="func.js"></script>
<style>
    input {
        margin-bottom: 5px;
    }
    label {
        text-decoration:dotted;
    }
</style>
<main style="width: 430px;">
    
    <form action="?rota=clientes_submit" method="post" autocomplete="on">
        <i onclick="history.back()" class="fa fa-chevron-left link" aria-hidden="true"></i>
        <div class="w3-center">
            <h2><?=$_GET['msg']?> Cadastro de Cliente</h2>
        </div>
        <input type="hidden" value="<?=$cliente->getId() ?? 0?>" name="txtId" id="txtId">
        <label for="txtNome">Nome do Comércio:</label>
        <input <?=$_GET['disabled']?> type="text" placeholder="Ex.: Adega Silva" value="<?=$cliente->getNome() ?? ''?>" name="txtNome" id="txtNome" required>

        <label for="txtUsuario" >Nome do Responsável:</label>
        <input <?=$_GET['disabled']?> type="text" placeholder="Ex.: João da Silva" value="<?=$cliente->getUsuario() ?? ''?>" name="txtUsuario" id="txtUsuario" required autocomplete="on">

        <label for="txtEmail">E-mail:</label>
        <input <?=$_GET['disabled']?> type="text" placeholder="Ex.: João@gmail.com" value="<?=$cliente->getEmail() ?? ''?>" name="txtEmail" id="txtEmail" required>

        <label for="txtCnpj" >CNPJ:</label>
        <input <?=$_GET['disabled']?> type="text" placeholder="Ex.: 34569708567" value="<?=$cliente->getCnpj() ?? ''?>" name="txtCnpj" id="txtCnpj" required>

        <label for="txtCpf" >CPF:</label>
        <input <?=$_GET['disabled']?> type="text" placeholder="Ex.: 34569708567" value="<?=$cliente->getCpf() ?? ''?>" name="txtCpf" id="txtCpf">

        Telefones para contato:
        <div>
            <div class="w3-col" style="width:35px;"><label for="idFone">01:</label></div>
            <div class="w3-col" style="width:160px;"><input <?=$_GET['disabled']?> type="text" placeholder="Ex.: (15) 984567345" value="<?=$cliente->getTel1() ?? ''?>" name="txtFone" id="idFone" required></div>
            <div class="w3-col" style="width:50px;"><label style="margin-left: 12px;" for="idFone2">02:</label></div>
            <div class="w3-rest"><input <?=$_GET['disabled']?> type="text" placeholder="Ex.: (15) 984567345" value="<?=$cliente->getTel2() ?? ''?>" name="txtFone2" id="idFone2"></div>
        </div>

        <label for="idCep">CEP:</label>
        <input <?=$_GET['disabled']?> type="text" placeholder="Digite o CEP para buscar o endereço" value="<?=$cliente->getCep() ?? ''?>" name="txtCep" id="idCep" required onchange="consultaEndereco()">

       <label for="idLograd" >Endereço:</label>

        <div>
            <div class="w3-col" style="width:280px;"><input <?=$_GET['disabled']?> type="text" placeholder="Ex.: Rua João Nogueira da Silva" value="<?=$cliente->getLograd() ?? ''?>" name="txtLograd" id="idLograd" required></div>
            <div class="w3-col" style="width:50px;"><label style="margin-left: 12px;" for="idNumero" >Nº:</label></div>
            <div class="w3-rest"><input <?=$_GET['disabled']?> type="text" placeholder="Ex.: 243" value="<?=$cliente->getNum() ?? ''?>" name="txtNumero" id="idNumero"></div>
        </div>

        <label for="idBairro">Bairro:</label> 
        <input <?=$_GET['disabled']?> type="text" placeholder="Ex.: Jadim Zumbi dos Palmares" value="<?=$cliente->getBairr() ?? ''?>" name="txtBairro" id="idBairro">
        

        <label for="idCidade" >Cidade:</label>

        <div>
            <div class="w3-col" style="width:280px;"><input <?=$_GET['disabled']?> type="text" placeholder="Ex.: Sorocaba" value="<?=$cliente->getCidade() ?? ''?>" name="txtCidade" id="idCidade" required></div>
            <div class="w3-col" style="width:50px;"><label style="margin-left: 12px;" for="idUf">UF:</label></div>
            <div class="w3-rest"><input <?=$_GET['disabled']?> type="text" placeholder="Ex.: SP" value="<?=$cliente->getUf() ?? ''?>" name="txtUf"  id="idUf" required></div>
        </div>
        <button name="<?=$_GET['msg']?>" id="<?=$_GET['msg']?>" onclick="msgDelete()" type="submit"><i class="fa fa-check" aria-hidden="true"></i> Confirma </button>
    </form>
</main>

