<?php 
    class Produto {
        private $id;
        private $descr;
        private $preco;
        private $qtd;
        function __construct ($id) {
            $db = new database();
            $params = [
                ':id' => $id
            ];
            $sql = "SELECT * FROM produto WHERE id_produto = :id;";
            $result = $db->query($sql, $params);
            if(isset($result['data'][0])) {
                $this->id = $result['data'][0]->id_produto;
                $this->descr = $result['data'][0]->descricao;
                $this->preco = $result['data'][0]->preco_unitario;
                $this->qtd = $result['data'][0]->quant_estoque;
            } else {
                $this->id = 0;
                $this->descr = '';
                $this->preco = '';
                $this->qtd = '';
            }
        }
	public function getId() {
		return $this->id;
	}
	public function setId($id): self {
		$this->id = $id;
		return $this;
	}
	public function getDescr() {
		return $this->descr;
	}
	public function setDescr($descr): self {
		$this->descr = $descr;
		return $this;
	}
	public function getPreco() {
		return $this->preco;
	}
	public function setPreco($preco): self { 
		$this->preco = $preco;
		return $this;
	}
	public function getQtd() {
		return $this->qtd;
	}
	public function setQtd($qtd) {
        $db = new database();
            $params = [
                ':qtd' => $qtd,
                ':id' => $this->id
            ];
            $sql = "UPDATE produto SET quant_estoque = :qtd WHERE id_produto = :id;";
            $result = $db->query($sql, $params);
		$this->qtd = $qtd;
		return $result;
	}
    public function excluir() {
        $db = new database();
            $params = [
                ':id' => $this->id
            ];
            $sql = "DELETE FROM item_pedido WHERE id_produto = :id;
            DELETE FROM produto WHERE id_produto = :id;";
            $result = $db->query($sql, $params);
		return $result;
	}
	public function editar($descr,$preco,$qtd) {
        $db = new database();
        $params = [
            ':id' => $this->id,
            ':descr' => $descr,
            ':preco' => $preco,
            ':qtd' => $qtd
        ];
        $sql = "UPDATE produto SET descricao = :descr, preco_unitario = :preco, quant_estoque = :qtd WHERE id_produto = :id;";
        $result = $db->query($sql, $params);
        return $result;
	}
} 
