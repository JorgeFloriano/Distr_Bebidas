<?php 
    Class Loja extends Pessoa{
        private $id;
        private $descricao;
        private $caixa;
    
        function __construct($id) {
            $db = new database();
            $params = [
                ':id' => $id
            ];
            $sql = "SELECT  l.id_loja, l.descricao, l.caixa, p.*  FROM pessoa p INNER JOIN loja l ON l.id_pessoa_loja = p.id_pessoa WHERE l.id_pessoa_loja = :id;";
            $result = $db->query($sql, $params);
            if(isset($result['data'][0])) {
                $caixa = $result['data'][0]->caixa;
                $descricao = $result['data'][0]->descricao;
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
            $this->descricao = $descricao;
            $this->caixa = $caixa;
        }
           
	public function getId() {
		return $this->id;
	}
	public function setId($id): self {
		$this->id = $id;
		return $this;
	}
	public function getDescr() {
		return $this->descricao;
	}
	public function setDescr($descricao): self {
		$this->descricao = $descricao;
		return $this;
	}	
	public function getCaixa() {

        // falta arrumar
        require 'conexaoBD.php';
        $sqlc = "SELECT * FROM caixa WHERE id = $this->id;";
        $resp = $conecta->query($sqlc);
        $lin = $resp->fetch(PDO::FETCH_BOTH);
        if($lin != null) {
            $this->setCaixa(number_format($lin['valor'], 2, '.', ''));
        }
		return $this->caixa;
	}		
	public function setCaixa($caixa): self {

        //falta arrumar
        require 'conexaoBD.php';
		$sql = "UPDATE caixa SET valor = ".$caixa." WHERE id = ".$this->id.";";
        try{
            $resultado = $conecta->query($sql);
        }catch(PDOException $e){
            echo 'setvalor erro';
        }
		$this->caixa = $caixa;
		return $this;
	}
    public function receber($add): self {

        //falta arrumar
        $caixa = $this->getCaixa() + $add;
        require 'conexaoBD.php';
		$sql = "UPDATE caixa SET valor = ".$caixa." WHERE id = ".$this->id.";";
        try{
            $resultado = $conecta->query($sql);
        }catch(PDOException $e){
            echo 'receber erro';
        }
		$this->setCaixa($caixa);
		return $this;
	}
    public function Pagar($sub): self {

        // falta arrumar
        $caixa = $this->getCaixa() - $sub;
        require 'conexaoBD.php';
		$sql = "UPDATE caixa SET valor = ".$caixa." WHERE id = ".$this->id.";";
        try{
            $resultado = $conecta->query($sql);
        }catch(PDOException $e){
            echo 'pagar erro';
        }
		$this->setCaixa($caixa);
		return $this;
	}
    public function produtos() {

        $db = new database();
        $sql = "SELECT * FROM produto ORDER BY descricao;";
        $result = $db->query($sql);
        return $result;
        
    }
    public function listarClientes() {
        $db = new database();
        $sql ="SELECT  cl.id_cliente, p.*  FROM pessoa p INNER JOIN cliente cl ON cl.id_pessoa_cliente = p.id_pessoa;";
        $result = $db->query($sql);
        return $result;
    }
	}

