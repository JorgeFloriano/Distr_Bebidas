<?php
    
    abstract class Pessoa {
        private $id_pessoa;
        private $nome;
        private $d_nasc;
        private $lograd;
        private $num;
        private $bairr;
        private $complem;
        private $cidade;
        private $uf;
        private $cep;
        private $tel1;
        private $tel2;
        private $cnpj;
        private $cpf;
        private $email;
        private $usuario;
        private $senha;
		
        function __construct ($id_pessoa, $nome, $d_nasc, $lograd, $num, $bairr, $complem, $cidade, $uf, $cep, $tel1, $tel2, $cnpj, $cpf, $email, $usuario, $senha ) {
            $this->id_pessoa = $id_pessoa;
            $this->nome = $nome;
            $this->d_nasc = $d_nasc;
            $this->lograd = $lograd;
            $this->num = $num;
            $this->bairr = $bairr;
            $this->complem = $complem;
            $this->cidade = $cidade;
            $this->uf = $uf;
            $this->cep = $cep;
            $this->tel1 = $tel1;
            $this->tel2 = $tel2;
            $this->cpf = $cpf;
            $this->cnpj = $cnpj;
            $this->email = $email;
            $this->usuario = $usuario;
            $this->senha = $senha;
        }


        public function getIdPessoa() {
            return $this->id_pessoa;
        }
        public function setIdPessoa($id_pessoa): self {
            $this->id_pessoa = $id_pessoa;

            return $this;
        }
        public function getNome() {
            return $this->nome;
        }
        public function setNome($nome): self {
            $this->nome = $nome;
            return $this;
        }
        public function getD_nasc() {
            return $this->d_nasc;
        }
        public function setD_nasc($d_nasc): self {
            $this->d_nasc = $d_nasc;
            return $this;
        }
        public function getLograd() {
            return $this->lograd;
        }
        public function setLograd($lograd): self {
            $this->lograd = $lograd;
            return $this;
        }
        public function getNum() {
            return $this->num;
        }
        public function setNum($num): self {
            $this->num = $num;
            return $this;
        }
        public function getBairr() {
            return $this->bairr;
        }
        public function setBairr($bairr): self {
            $this->bairr = $bairr;
            return $this;
        }
        public function getComplem() {
            return $this->complem;
        }
        public function setComplem($complem): self {
            $this->complem = $complem;
            return $this;
        }
        public function getCidade() {
            return $this->cidade;
        }
        public function setCidade($cidade): self {
            $this->cidade = $cidade;
            return $this;
        }
        public function getUf() {
            return $this->uf;
        }
        public function setUf($uf): self {
            $this->uf = $uf;
            return $this;
        }
        public function getCep() {
            return $this->cep;
        }
        public function setCep($cep): self {
            $this->cep = $cep;
            return $this;
        }
        public function getTel1() {
            return $this->tel1;
        }
        public function setTel1($tel1): self {
            $this->tel1 = $tel1;
            return $this;
        }
        public function getTel2() {
            return $this->tel2;
        }
        public function setTel2($tel2): self {
            $this->tel2 = $tel2;
            return $this;
        }
        public function getCnpj() {
            return $this->cnpj;
        }
        public function setCnpj($cnpj): self {
            $this->cnpj = $cnpj;
            return $this;
        }
        public function getCpf() {
            return $this->cpf;
        }
        public function setCpf($cpf): self {
            $this->cpf = $cpf;
            return $this;
        }
        public function getEmail() {
            return $this->email;
        }
        public function setEmail($email): self {
            $this->email = $email;
            return $this;
        }
        public function getUsuario() {
            return $this->usuario;
        }
        public function setUsuario($usuario): self {
            $this->usuario = $usuario;
            return $this;
        }
        public function getSenha() {
            return $this->senha;
        }
        
        public function setSenha($senha): self {

            $this->senha = $senha;
            return $this;
        }
            
        public function excluir() {
            $db = new database();
                $params = [
                    ':id' => $this->id_pessoa
                ];
                $sql = "DELETE FROM pessoa WHERE id_pessoa = :id;";
                $result = $db->query($sql, $params);
            return $result;
        }
        
        public function editar($nome,$data_nasc,$logradouro,$numero,$bairro, $compl, $cidade,$uf,$cep,$telefone1 ,$telefone2,$cnpj, $cpf,$email,$usuario,$senha) {
            $db = new database();
        
            $sql = "UPDATE pessoa SET nome = '$nome', data_nasc = $data_nasc, logradouro = '$logradouro', numero = '$numero', bairro = '$bairro', complemento = '$compl', cidade = '$cidade', uf = '$uf', cep = '$cep', telefone1 = '$telefone1', telefone2 = '$telefone2', cnpj = '$cnpj', cpf = '$cpf', email = '$email', usuario = '$usuario', senha = '$senha' WHERE id_pessoa = $this->id_pessoa;";
            $result = $db->query($sql);
            return $result;
        }
    
	
        public function listarClientes() {
            require 'conexaoBD.php';
            $sql ="SELECT  cl.id_cliente, p.*  FROM pessoa p INNER JOIN clientes cl ON cl.id_pessoa_cliente = p.id_pessoa;";
            $object = $conecta->prepare($sql);
            $object->execute();
            $resultado = $object->fetchAll(PDO::FETCH_ASSOC);
            if ($resultado != null) {
                return $resultado;
            } else {
                return "Não existem clientes cadastrados";
            }
        }
    }
