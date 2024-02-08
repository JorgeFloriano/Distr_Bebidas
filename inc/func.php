<?php
    function cadastrarCliente ($nome,$logradouro,$numero,$bairro, $cidade,$uf,$cep,$telefone1 ,$telefone2,$cnpj, $cpf,$email,$usuario,$senha) {
        $db = new database();
        $sql = "INSERT INTO pessoa (nome, logradouro, numero, bairro, cidade, uf, cep, telefone1, telefone2, cnpj, cpf, email, usuario, senha)
                VALUES ('$nome','$logradouro','$numero','$bairro', '$cidade','$uf','$cep','$telefone1' ,'$telefone2','$cnpj', '$cpf','$email','$usuario','$senha');";
                $result = $db->query($sql);
                $sql = "SELECT id_pessoa FROM `pessoa` WHERE cpf = '$cpf';";
                $result = $db->query($sql);
                $id = $result['data'][0]->id_pessoa;

                $sql = "INSERT INTO cliente (id_pessoa_cliente) VALUES ($id);";
                $result = $db->query($sql);
                return $result;
    }
    function cadastrarProduto ($des, $preco, $qtd) {
        $db = new database();
        $sql = "INSERT INTO produto (descricao, preco_unitario, quant_estoque) VALUES ( '$des', $preco, $qtd);";
        $result = $db->query($sql);
        return $result;

    }