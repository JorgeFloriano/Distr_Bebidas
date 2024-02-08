<?php
    class Cliente extends Pessoa {
        private $id;

        public function __construct($id) {
            $db = new database();
            $params = [
                ':id' => $id
            ];
            $sql = "SELECT  c.id_cliente, p.*  FROM pessoa p INNER JOIN cliente c ON c.id_pessoa_cliente = p.id_pessoa WHERE c.id_cliente = :id;";
            $result = $db->query($sql, $params);
            if(isset($result['data'][0])) {
                $id_pessoa = $result['data'][0]->id_pessoa;
                $nome = $result['data'][0]->nome;
                $d_nasc = $result['data'][0]->data_nasc;
                $lograd = $result['data'][0]->logradouro;
                $num = $result['data'][0]->numero;
                $bairr = $result['data'][0]->bairro;
                $complem = $result['data'][0]->complemento;
                $cidade = $result['data'][0]->cidade;
                $uf = $result['data'][0]->uf;
                $cep = $result['data'][0]->cep;
                $tel1 = $result['data'][0]->telefone1;
                $tel2 = $result['data'][0]->telefone2;
                $cpf = $result['data'][0]->cpf;
                $cnpj = $result['data'][0]->cnpj;
                $email = $result['data'][0]->email;
                $usuario = $result['data'][0]->usuario;
                $senha = $result['data'][0]->id_pessoa; //cliente ainda não tem senha, chave unica não pode ficar null
            }
            parent::__construct($id_pessoa ?? '', $nome ?? '', $d_nasc ?? '', $lograd ?? '', $num ?? '', $bairr ?? '', $complem ?? '', $cidade ?? '', $uf ?? '', $cep ?? '', $tel1 ?? '', $tel2 ?? '', $cnpj ?? '', $cpf ?? '', $email ?? '', $usuario ?? '', $senha ?? '');
            $this->id = $id;
        }
        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }
        public function delete () {
            $this->excluir();
            $db = new database();
                $params = [
                    ':id' => $this->id
                ];
                $sql = "DELETE FROM cliente WHERE id_cliente = :id;";
                $result = $db->query($sql, $params);
            return $result;
        }
    }
