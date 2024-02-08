<main>
    <?php  require_once __DIR__ . "/../inc/sidebar.php"?>
    <h3>Lista de Produtos !</h3>
    <table class="w3-table-all">
        <thead>   
            <tr class="w3-center">
                <th>Descrição</th>
                <th>Preço</th>
                <th>Qtd</th>
                <th>Edit</th>
                <th>Del</th>
            </tr>
        <thead>
        <?php
            $adm = new adm($_SESSION['usuario']);
            $loja = new loja(1);
            foreach($loja->produtos()['data'] as $produto) : ?>
                <tr><td><?=$produto->descricao?></td>
                <td>R$ <?=$produto->preco_unitario?></td>
                <td><?=$produto->quant_estoque?></td>
                <td><a href="index.php?rota=cad_prod&msg=Editar&id=<?=$produto->id_produto?>&disabled=''"><i style="color: rgb(55, 20, 126);" class="fa fa-edit"></i></a></td>
                <td><a href="index.php?rota=cad_prod&msg=Deletar&id=<?=$produto->id_produto?>&disabled=disabled"><i style="color: rgb(55, 20, 126);" class="fa fa-trash"></i></a></td></tr>
            <?php endforeach?>
    </table>
    <a href="index.php?rota=cad_prod&msg=Novo&disabled=''"><button name="Novo"></i> Novo Cadastro </button></a>
</main>