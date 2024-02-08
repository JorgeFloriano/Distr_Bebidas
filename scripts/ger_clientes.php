<main>
    <?php  require_once __DIR__ . "/../inc/sidebar.php"?>
    <h3>Lista de Clientes !</h3>
    <table class="w3-table-all">
        <thead>   
            <tr class="w3-center">
                <th>Nº</th>
                <th>Descrição</th>
                <th>Edit</th>
                <th>Del</th>
            </tr>
        <thead>
        <?php
            $adm = new adm($_SESSION['usuario']);
            $loja = new loja(1);
            foreach($loja->listarClientes()['data'] as $cliente) : ?>
                <tr><td><?=$cliente->id_cliente?></td>
                <td><?=$cliente->nome?></td>
                <td><a href="index.php?rota=cad_cli&msg=Editar&id=<?=$cliente->id_cliente?>&disabled=''"><i style="color: rgb(55, 20, 126);" class="fa fa-edit"></i></a></td>
                <td><a href="index.php?rota=cad_cli&msg=Deletar&id=<?=$cliente->id_cliente?>&disabled=disabled"><i style="color: rgb(55, 20, 126);" class="fa fa-trash"></i></a></td></tr>
            <?php endforeach?>
    </table>
    <a href="index.php?rota=cad_cli&msg=Novo&disabled=''"><button name="Novo"></i> Novo Cadastro </button></a>
</main>