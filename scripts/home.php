<?php
    $loja = new loja(1);
    $adm = new Adm($_SESSION['usuario']);

    // Verifica se existe a variável de sessão id_ped
    if (isset($_SESSION['id_ped'])) {

        // Lista de pedidos concluídos
        $list = $adm->getListClosedPed()['data'];

        // atribui valor nulo se a variável de sessão id_ped for um pedido já concluído
        foreach ($list as $id) {
            if ($id->id_pedido == $_SESSION['id_ped']) {
                $_SESSION['id_ped'] = null;
            }
        }
    }

    // seleciona o ultimo pedido aberto de acordo com o usuário
    $linha = $adm->getOpenPed();

    // se não encontrar nenhum pedido aberto ou foi clicado anteriormente no botão NOVO
    if (count($linha['data']) == 0 || $linha['data'] == null || isset($_GET['novo'])) {
        
        // variável de sessão id_ped recebe 0 para criar um novo pedido
        $_SESSION['id_ped'] = 0;

    // Se houver pedido aberto e não foi clicado em NOVO
    } else {

        // Verifica se algum pedido foi selecionado para ser editado na tela de gerenciamento
        if (isset($_GET['id_edit_ped'])) {

            //Se sim, variável de sessão id_ped recebe o número do pedido
            $_SESSION['id_ped'] = $_GET['id_edit_ped'];

        // Se não, se não existir variável de sessão id_ped
        } elseif (!isset($_SESSION['id_ped']) || $_SESSION['id_ped'] == null) {

            // A mesma é iniciada e recebe o id do ultimo pedido aberto pelo usuario
            $_SESSION['id_ped'] = $linha['data'][0]->id_pedido;
        }
    }
    // Pedido instanciado
    $pedido = new Pedido($_SESSION['id_ped']);
    
    $clientes = $loja->listarClientes();
    $produtos = $loja->produtos();
?>
<script src="func.js"></script>
<title>Bebidas</title>
<form id="formulario" action="?rota=home_submit&id_ped=<?=$pedido->getId()?>"  method='post'>
    <main>
        <!-- botoes mais e menos -->
        <!-- <div class="gerQtd">
            <button type="button" onclick="menos()" class="a">-</button>
            <input class="qtd" min=0 id="total" type="number">
            <button type="button" onclick="mais()" class="b">+</button>
        </div> -->
        <header>
            <button name="home" class="link" type="submit" ><i class="fa fa-home"></i> Início </button>
            <button name="ger_pedidos" class="link" type="submit" ><i class="fa fa-history"></i> Histórico </button>
            <button name="ger_clientes" class="link" type="submit" ><i class="fa fa-user"></i> Clientes </button>
            <button name="ger_produtos" class="link" type="submit" ><i class="fa fa-beer"></i> Produtos </button>
            <button style="float:right;" name="logout" class="link" type="submit" ><i class="fa fa-sign-out"></i> Sair </button>
        </header>
        <h3>Bem vindo(a) <?=$adm->getUsuario()?></h3>
        <p>Os pedidos são salvos automáticamente mesmo que ainda não estejam concluídos, posteriormente serão gerenciados no histórico. Escolha um produto para acrescentar na lista e gerencie as quantidades nos campos abaixo do carrinho, para remover um ítem basta colocar valor 0 e prosseguir normalmente.
            Pedido Número <?=$pedido->getId()?></p>
        <div class="search">
            <i class="fa fa-search w3-text-gray"></i>
            <select onchange="atualizar()" class="search" style="width: 94%" id="cliente" name="cliente">
                <option selected value="NULL">Selecionar Cliente</option>
                <?php foreach( $clientes['data'] as $linha):?>
                    <?php
                        if ($linha->id_cliente === $pedido->getCliente()) {
                            $sel = 'selected';
                        } else {
                            $sel = '';
                    }?>
                    <option <?=$sel?> value="<?=$linha->id_cliente?>"><?=$linha->id_cliente?> - <?=$linha->nome?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="search">
            <i class="fa fa-search w3-text-gray"></i>
            <select onchange="atualizar()" class="search" style="width: 94%"; id="prodaddlist" name="prodaddlist">
                <option selected value="">Selecionar Produto</option>
                <?php foreach($produtos['data'] as $produto):?>
                    <option value="<?=$produto->id_produto?>"><?=$produto->descricao?> - R$ <?=$produto->preco_unitario?> - Est.: <?=$produto->quant_estoque?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <table class="w3-table-all">
            <thead>   
                <tr>
                    <th>Descrição</th>
                    <th>Preço (R$)</th>
                    <th><i class="fa fa-cart-plus w3-xlarge"></i></th>
                </tr>
            <thead>
            <?php 
                for ($i = 0; count($pedido->getItem()) > $i; $i++):?>
                    <input id="Prod<?=$i?>Preco" type="hidden" value="<?=$pedido->getItem()[$i]->getPreco_un()?>">
                    <tr><td style="padding: 2px 15px;"><?=$pedido->getItem()[$i]->getProd()?></td>
                    <td style="padding: 2px 8px;"><?=$pedido->getItem()[$i]->getPreco_un()?></td>
                    <td style="padding: 2px;">   
                        <input class="qtd" name="Prod<?=$pedido->getItem()[$i]->getId_pr()?>" id="Prod<?=$i?>" type="number" 
                        value="<?=$pedido->getItem()[$i]->getQuant()?>" min="0" max="<?=$pedido->getItem()[$i]->getQ_est()?>" onchange="alteraTotal()">  
                    </td>
                    <?php $totalprod = ($totalprod ?? 0) + $pedido->getItem()[$i]->getQuant();
                endfor;?>
            <input id="nprod" type="hidden" value="<?=$i?>">
            <tr class="w3-center">
                <th>Total: <em id="idLinha"><?=$i?></em> Produtos </th>
                <th>R$ <em id="idVTotal"><?=number_format($pedido->getValor(), 2, '.', '')?></em></th>
                <th><em id="idTotProd"><?=$totalprod ?? 0?></em> Ítens</th>
            </tr>
        </table>
        <button name="btnConcluir" id="Concluir" onclick="msgConcluir()" type="submit"><i class="fa fa-check" aria-hidden="true"></i> Concluir </button>
        <button name="btnNovo" ><i  class="fa fa-file-text-o" aria-hidden="true"></i> Novo </button>
        </div>
    </main>
</form>
