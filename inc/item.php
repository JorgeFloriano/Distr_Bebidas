<?php 
    Class Item {
        private $id;
        private $id_pr;
        private $prod;
        private $id_ped;
        private $quant;
        private $q_est;
        private $preco_un;
        private $valor;
        function __construct($id) {
            $db = new database();
            $params = [
                ':id_item' => $id,
            ];
            $sql = "SELECT p.*, i.* FROM item_pedido i 
            INNER JOIN produto p on p.id_produto = i.id_produto WHERE i.id_item_pedido = :id_item;";
            
            $result = $db->query($sql, $params);
            if($result != null && isset($result['data'][0]->id_item_pedido)) {
                $this->id = $result['data'][0]->id_item_pedido;
                $this->id_pr = $result['data'][0]->id_produto;
                $this->prod = $result['data'][0]->descricao;
                $this->id_ped = $result['data'][0]->id_pedido;
                $this->quant = $result['data'][0]->quantidade;
                $this->q_est = $result['data'][0]->quant_estoque;
                $this->preco_un = $result['data'][0]->preco_unitario;
                $this->valor = $result['data'][0]->quantidade * $result['data'][0]->preco_unitario;
            } else {
                $this->id = '';
            }
        }

	public function getId() {
		return $this->id;
	}
	public function setId($id): self {
		$this->id = $id;
		return $this;
	}
	public function getId_pr() {
		return $this->id_pr;
	}
	public function setId_pr($id_pr): self {
		$this->id_pr = $id_pr;
		return $this;
	}	
	public function getId_ped() {
		return $this->id_ped;
	}		
	public function setId_ped($id_ped): self {
		$this->id_ped = $id_ped;
		return $this;
	}	
    public function getQ_est()
    {
        return $this->q_est;
    }
    public function setQ_est($q_est)
    {
        $this->q_est = $q_est;

        return $this;
    }	
    public function getProd()
    {
        return $this->prod;
    }
    public function setProd($prod)
    {
        $this->prod = $prod;

        return $this;
    }
    public function getPreco_un()
    {
        return $this->preco_un;
    }
    public function setPreco_un($preco_un)
    {
        $this->preco_un = $preco_un;

        return $this;
    }
    public function getValor()
    {
        return $this->valor;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }
    public function getQuant() {
		return $this->quant;
	}
	public function setQuant($qtd) {
        $db = new database();
            $params = [
                ':qtd' => $qtd,
                ':id' => $this->id
            ];
            $sql = "UPDATE item_pedido SET quantidade = :qtd WHERE id_item_pedido = :id;";
            $result = $db->query($sql, $params);
		$this->quant = $qtd;
		return $result;
	}
    public function excluir() {
        $db = new database();
            $params = [
                ':id' => $this->id
            ];
            $sql = "DELETE FROM item_pedido  WHERE id_item_pedido = :id;";
            $result = $db->query($sql, $params);
		return $result;
	}
}
