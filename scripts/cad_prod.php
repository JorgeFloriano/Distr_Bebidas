<?php
    if (isset($_GET['id'])) {
        $prod = new Produto($_GET['id']);
       
    } else {
        $prod = new Produto(0);
    }
?>
<script src="func.js"></script>
<title>Atualizar Produtos</title>
<main>
    <form action="?rota=produtos_submit" method="post" autocomplete="on">
        <i onclick="history.back()" class="fa fa-chevron-left link" aria-hidden="true"></i>
        <div class="w3-center">
            <h2><?=$_GET['msg']?> Cadastro de Produto</h2>
        </div>
        <input name="txtId" Id="txtId" type="hidden" value="<?=$prod->getId() ?? 0 ?>">
        <label for="inpdescr" >Descrição do Produto: </label>
        <input id="inpdescr" type="text" value="<?=$prod->getDescr() ?? ''?>" <?=$_GET['disabled']?> placeholder="Ex.: Brama lata (fardo)" name="txtDes" required>
        <label for="inppreco" >Preço Unitário (R$): </label>
        <input id="inppreco" min="0" step="0.01" type="number" value="<?=$prod->getPreco() ?? ''?>" <?=$_GET['disabled']?> placeholder="Ex.: 28.90" name="txtPre" required>
        <label for="inpqtd" >Quantidade em Estoque: </label>
        <input type="number" placeholder="Ex.: 45" value="<?=$prod->getQtd() ?? ''?>" <?=$_GET['disabled']?> min="0" name="txtQtd" id="inpqtd">
        <button name="<?=$_GET['msg']?>" id="<?=$_GET['msg']?>" onclick="msgDelete()" type="submit">Confirma</button>
    </form>
</main>