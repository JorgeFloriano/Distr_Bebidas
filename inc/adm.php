<?php
    class Adm extends Pessoa {
        private $id;

        public function __construct($id_us) {
            $db = new database();
            $params = [
                ':id_us' => $id_us
            ];
            $sql = "SELECT  a.id_adm, p.*  FROM pessoa p INNER JOIN adm a ON a.id_pessoa_adm = p.id_pessoa WHERE a.id_adm = :id_us OR p.usuario = :id_us;";
            $result = $db->query($sql, $params);
            if(isset($result['data'][0])) {
                $id = $result['data'][0]->id_adm;
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
                $senha = $result['data'][0]->senha;
            }
            parent::__construct($id_pessoa, $nome, $d_nasc, $lograd, $num, $bairr, $complem, $cidade, $uf, $cep, $tel1, $tel2, $cnpj, $cpf, $email, $usuario, $senha);
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
        public function listarPed () {
            $db = new database();          
            $sql = "SELECT ped.id_pedido, ped.date, ped.pago, cli.id_cliente, pes.*  
            FROM pessoa pes 
            INNER JOIN cliente cli 
            ON cli.id_pessoa_cliente = pes.id_pessoa
            INNER JOIN pedido ped
            ON ped.id_cliente = cli.id_cliente
            WHERE ped.id_adm = $this->id ORDER BY ped.id_pedido;";
            $result = $db->query($sql);
            return $result;
        }
        public function getOpenPed() {
            $db = new database();
            $params = [
                ':id' => $this->id
            ];
            $sql = "SELECT * FROM pedido WHERE id_adm = :id AND pago = 0 ORDER BY id_pedido DESC LIMIT 1;";
            $result = $db->query($sql, $params);
            return $result;
        }
        public function getListClosedPed() {
            $db = new database();
            $params = [
                ':id' => $this->id
            ];
            $sql = "SELECT id_pedido FROM pedido WHERE id_adm = :id AND pago = 1;";
            $result = $db->query($sql, $params);
            return $result;
        }
    }
