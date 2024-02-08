<?php 
    Class Pedido {
        private $id;
        private $item = [];
        private $date;
        private $id_adm;
        private $id_cliente;
        private $id_f_p;
        private $id_stat;
        private $entr;
        private $pago;
        private $valor;
        function __construct($num) {
            
            // se for um novo pedido
            if ($num === 0) {

                //cria o novo pedido com o id do usuário se não existir (pago = 0)
                $dbped = new database();
                $paramsped = [
                    ':id' => $_SESSION['usuario'],
                    ':date' => date("Y-m-d")
                ];
                $sqlped = "INSERT INTO pedido ( date, id_adm, id_f_pag, id_status_ped, pago)
                VALUES (:date, :id, 1, 1, 0);";
                $resultped = $dbped->query($sqlped, $paramsped);

                //seleciona o pedido recem criado 
                $db = new database();
                $params = [
                    ':id' => $_SESSION['usuario']
                ];
                $sql = "SELECT * FROM pedido WHERE id_adm = :id AND pago = 0 ORDER BY id_pedido DESC LIMIT 1;";
                $result = $db->query($sql, $params);
                
            // se for um pedido já existente
            } else {

                // seleciona o pedido pelo id atravéz da variável $num
                $db = new database();
                $params = [
                    ':num' => $num
                ];
                $sql = "SELECT * FROM pedido WHERE id_pedido = :num;";
                $result = $db->query($sql, $params);
            }
            if($result != null) {
                $this->id = $result['data'][0]->id_pedido;

                // gerar lista de itens do pedido
                $db = new database();
                $params = [
                    ':id' => $this->id
                ];
                $sql = "SELECT id_item_pedido FROM item_pedido WHERE id_pedido = :id;";
                $res = $db->query($sql, $params);
                if($res != null) {
                    foreach ( $res['data'] as $linha ) {
                        $this->item[] = new Item($linha->id_item_pedido);
                    }
                }

                $this->date = $result['data'][0]->date;
                $this->id_adm = $result['data'][0]->id_adm;
                $this->id_cliente = $result['data'][0]->id_cliente;
                $this->id_f_p = $result['data'][0]->id_f_pag;
                $this->id_stat = $result['data'][0]->id_status_ped;
                $this->pago = $result['data'][0]->pago;

                //calcular valor do pedido e salvar no banco de dados
                $this->valor = 0;
                for ($i = 0; count($this->item) > $i ; $i++) {
                    $this->valor += $this->item[$i]->getValor();
                };
                $db = new database();
                $params = [
                    ':valor' => $this->valor,
                    ':id' => $this->id
                ];
                $sql = "UPDATE pedido SET valor = :valor WHERE id_pedido = :id;";
                $result = $db->query($sql, $params);
                return $result;
            }
        }
	public function getId() {
		return $this->id;
	}
	public function setId($id): self {
		$this->id = $id;
		return $this;
	}

    public function getDate() {
		return $this->date;
	}		
	public function setDate($date) {
        $db = new database();
        $params = [
            ':date' => $date,
            ':id' => $this->id
        ];
        $sql = "UPDATE pedido SET date = :date WHERE id_pedido = :id;";
        $result = $db->query($sql, $params);
        return $result;
	}
    public function getAdm() {
		return $this->id_adm;
	}
	public function setAdm($id_adm): self {
		$this->id_adm = $id_adm;
		return $this;
	}
    public function getCliente() {
		return $this->id_cliente;
	}		
	public function setCliente($id_cliente) {
        $db = new database();
        if ($id_cliente != 'NULL') {
        $params = [
            ':id_cliente' => $id_cliente
        ];
            $sql = "UPDATE pedido SET id_cliente = :id_cliente WHERE id_pedido = $this->id;";
            $result = $db->query($sql, $params);
        } else {
            $sql = "UPDATE pedido SET id_cliente = $id_cliente WHERE id_pedido = $this->id;";
            $result = $db->query($sql);
        }
        $this->id_cliente = $id_cliente;
        return $result;
    }
	
    public function getFpag() {
		return $this->id_f_p;
	}		
	public function setFpag($id_f_p): self {
        //falta arrumar
        require 'conexaoBD.php';
		$sql = "UPDATE pedido SET id_f_pag = ".$id_f_p." WHERE id_pedido = ".$this->id.";";
        try{
            $resultado = $conecta->query($sql);
        }catch(PDOException $e){
            echo 'setFpag erro';
        }
		$this->id_f_p = $id_f_p;
		return $this;
	}
    public function getStatus() {
		return $this->id_stat;
	}		
	public function setStatus($id_stat) {
        $db = new database();
        $params = [
            ':id_stat' => $id_stat,
            ':id' => $this->id
        ];
        $sql = "UPDATE pedido SET id_status_ped = :id_stat WHERE id_pedido = :id;";
        $result = $db->query($sql, $params);
        return $result;
	}
	public function getPago() {
		return $this->pago;
	}		
	public function setPago($pago) {
        $db = new database();
        $params = [
            ':pago' => $pago,
            ':id' => $this->id
        ];
        $sql = "UPDATE pedido SET pago = :pago WHERE id_pedido = :id;";
        $result = $db->query($sql, $params);
        $this->pago = $pago;
        return $result;
	}
    public function getValor() {
        return $this->valor;
    }
   
    public function listarItens() {
        $db = new database();
        $params = [
            ':id' => $this->id
        ];
        $sql = "SELECT pr.id_produto, pr.descricao, pr.preco_unitario, pr.quant_estoque, it.quantidade
        FROM produto pr INNER JOIN item_pedido it
        on pr.id_produto = it.id_produto
        WHERE it.id_pedido = :id ;";
        $result = $db->query($sql, $params);
        return $result;
    }

    public function concluir () {
        if ($this->pago == 0) {
            $this->setDate(date("Y-m-d"));
            foreach ($this->item as $item) {
                $produto = new Produto($item->getId_pr());
                $qtd = $produto->getQtd() - $item->getQuant();
                $produto->setQtd($qtd);
            }
            $this->setPago(1);
            $_SESSION['id_ped'] = null;
        }
    }

    public function addItem ($idprod, $qtd) {
        for ($i = 0; count($this->item) > $i ; $i++) {
            $list_id_prod[] = $this->item[$i]->getId_pr();
        };
        if (($list_id_prod == null) || ($qtd > 0 && !in_array($idprod, $list_id_prod))) {
            $db = new database();
            $params = [
                ':idprod' => $idprod,
                ':qtd' => $qtd,
                ':idped' => $this->id
            ];
            $sql = "INSERT INTO item_pedido (id_produto, id_pedido, quantidade) VALUES (:idprod, :idped, :qtd);";
            $result = $db->query($sql, $params);
        }
    }
    public function getItem()
    {
        return $this->item;
    }
}
