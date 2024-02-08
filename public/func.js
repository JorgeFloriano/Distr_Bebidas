function consultaEndereco() {
    let cep = document.querySelector('#idCep').value
    if (cep.length !== 8) {
        alert('Cep inválido !')
        return
    }
    let url = `https://viacep.com.br/ws/${cep}/json/`
    fetch(url).then(function(response){
        response.json().then(mostrarEndereco)  
    })
}
function mostrarEndereco(dados) {
    console.log(dados)
    if (dados.erro) {
        window.alert("Cep não encontrado")
        return
    }
    document.querySelector('#idLograd').value = dados.logradouro
    document.querySelector('#idBairro').value = dados.bairro
    document.querySelector('#idCidade').value = dados.localidade
    document.querySelector('#idUf').value = dados.uf
   
}
function alteraTotal() {
    total = 0
    vtotal = 0
    let nlinha = document.querySelector(`#nprod`).value
    for (i=0;i<nlinha;i++) {
        let prod = document.querySelector(`#Prod${i}`).value
        let preco = document.querySelector(`#Prod${i}Preco`).value
        var nprod = Number(prod)
        var npreco = Number(preco)
        total += nprod
        pitem = npreco * nprod
        vtotal += pitem
        console.log()
        console.log(vtotal)
        console.log(document.querySelector(`#Prod${i}Preco`).value)
    }
    document.querySelector('#idTotProd').innerHTML = total
    document.querySelector('#idVTotal').innerHTML = vtotal.toFixed(2)
}
function atualizar() {
    document.getElementById("formulario").submit();
}
function msgDelete() {
    if ( window.document.getElementById('Deletar').name == 'Deletar') {
        if (confirm("Todos os dados deste cadastro e dos pedidos vinculados a ele serão perdidos, clique em OK para prosseguir.") === true) {
            window.document.getElementById('Deletar').type = "submit"
        } else {
            window.document.getElementById('Deletar').type = "button"
        }
    }
}
function msgConcluir() {
    if (confirm("Pedidos concluídos não poderão ser editados posteriormente, clique em OK para prosseguir se o pedido já foi pago e entregue.") === true) {
        window.document.getElementById('Concluir').type = "submit"
    } else {
        window.document.getElementById('Concluir').type = "button"
    }
}


/*'<figure>
<figcaption class="rosa">'.$linha['descricao'].'</figcaption>
<img src="imagens/img'.$i.'.jpeg" class="w3-round-xxlarge"  style="width: 220px;" alt="imagem">
<figcaption class="p">R$ '.$linha['preco_unitario'].' - Add: <input class="qtd" name="Prod'.$linha['id_produto'].'" id="Prod'.$linha['id_produto'].'" type="number" value="'.$linha['quantidade'].'" min="0" max="'.$linha['quant_estoque'].'"></figcaption>
</figure>';
$totalprod = ($totalprod ?? 0) + $linha['quantidade'];
$i++;*/