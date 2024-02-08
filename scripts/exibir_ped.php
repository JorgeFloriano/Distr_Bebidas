<?php
    $pedido = new Pedido($_GET['id_ped']);
?>
<main style="width: 650px;">
    <i onclick="history.back()" class="fa fa-chevron-left link" aria-hidden="true"></i>
    <h2>Pedido Número <?=$pedido->getId()?></h2>
    <?php
        $loja = new Loja(1);
        $cliente = new Cliente ($pedido->getCliente());
        $date = date_create($pedido->getDate());
        echo "Data - ".date_format($date, 'd / m / Y');
        
        ?>
        <h3><?=$loja->getNome()?></h3>
        <p><strong>CNPJ:</strong> <?=$loja->getCnpj()?><br>
        <strong>Endereço:</strong> <?=$loja->getLograd()?>, <?=$loja->getNum()?> - <?=$loja->getBairr()?>, <?=$loja->getCidade()?> - <?=$loja->getUf()?><br>
        <strong>Tel 01:</strong> <?=$loja->getTel1()?> &emsp; - &emsp; <strong>Tel 02:</strong> <?=$loja->getTel2()?> &emsp; - &emsp; <strong>E-mail:</strong> <?=$loja->getEmail()?><br>
        </p>
        <h3>Dados do Cliente</h3>
        <p><strong>Nome:</strong> <?=$cliente->getUsuario()?> &emsp; - &emsp; <strong>CPF:</strong> <?=$cliente->getCpf()?><br>
        <strong>Nome do Comércio:</strong> <?=$cliente->getNome()?> &emsp; - &emsp; <strong>CNPJ:</strong> <?=$cliente->getCnpj()?><br>
        <strong>Endereço:</strong> <?=$cliente->getLograd()?>, <?=$cliente->getNum()?> - <?=$cliente->getBairr()?>, <?=$cliente->getCidade()?> - <?=$cliente->getUf()?><br>
        <strong>Tel 01:</strong> <?=$cliente->getTel1()?> &emsp; - &emsp; <strong>Tel 02:</strong> <?=$cliente->getTel2()?> &emsp; - &emsp; <strong>E-mail:</strong> <?=$cliente->getEmail()?><br>
        </p>
        <table class="w3-table-all">
                <thead>   
                    <tr class="w3-center">
                    <th>Nº</th>
                    <th>Descrição</th>
                    <th>Qtd</th>
                    <th>Preço un.</th>
                    <th>Total</th>
                </tr>
            <thead>
            <?php
            $qtd = 0;
            $total = 0;
            for ($i = 0; count($pedido->getItem()) > $i; $i++) : ?>
                <?php 
                $v_item = $pedido->getItem()[$i]->getPreco_un() * $pedido->getItem()[$i]->getQuant() ?>
                <tr><td><?=$i + 1?></td>
                <td><?=$pedido->getItem()[$i]->getProd()?></td>
                <td><?=$pedido->getItem()[$i]->getQuant()?></td>
                <td>R$ <?=number_format($pedido->getItem()[$i]->getPreco_un(), 2, '.', '')?></td>
                <td>R$ <?=number_format($v_item, 2, '.', '')?></td></tr>
                <?php
                $qtd = $qtd + $pedido->getItem()[$i]->getQuant();
                $total = $total + $v_item; ?>
            <?php endfor ?>
            <tr class="w3-center">
                <th><?=$i?></th>
                <th>Total</th>
                <th><?=$qtd?></th>
                <th>-------------</th>
                <th> R$ <?=number_format($total, 2, '.', '')?></th>
            </tr>
        </table>
    </main>