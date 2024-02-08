<main>
    <?php  require_once __DIR__ . "/../inc/sidebar.php"?>
    <h3>Lista de Pedidos !</h3>
    <p><i class="fa fa-edit w3-text-red"></i> - Pedidos concluídos, não podem ser alterados.</p>
    <table class="w3-table-all">
        <thead>   
            <tr class="w3-center">
                <th>Nº</th>
                <th>Cliente</th>
                <th>Data</th>
                <th>Editar</th>
                <th>Exibir</th>
            </tr>
        <thead>
        <?php
            $adm = new adm($_SESSION['usuario']);
            $loja = new loja(1);
            foreach($adm->listarPed()['data'] as $pedido) : ?>
                <?php 
                    $date = date_create($pedido->date);
                    $data = date_format($date, 'd/m/Y');
                    if ($pedido->pago == 0) {
                        $rota = "home";
                        $color = "color: rgb(55, 20, 126);";
                    } else {
                        $rota = "ger_pedidos";
                        $color = "color : red;";
                    }
                ?>
                <tr><td><?=$pedido->id_pedido?></td>
                <td><?=$pedido->nome?></td>
                <td><?=$data?></td>
                <td style="text-align: center;" ><a style="<?=$color?>" href="index.php?rota=<?=$rota?>&id_edit_ped=<?=$pedido->id_pedido?>"><i class="fa fa-edit"></i></a></td>
                <td style="text-align: center;" ><a href="index.php?rota=exibir_ped&id_ped=<?=$pedido->id_pedido?>"><i class="fa fa-file-text"></i></a></td></tr>
            <?php endforeach?>
    </table>
</main>