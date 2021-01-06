//função calcular parcela da page cadContas
function calculaParc(){
    var valorTotal = 0;
    var qtdParcelas = 0;
    
    valorTotal = parseFloat(document.getElementById("valorTotal").value);

    qtdParcelas = parseInt(document.getElementById("parcelamento").value);

    var teste = document.getElementById("telCliente2").value;

    var valorParcela = (valorTotal/qtdParcelas).toFixed(2);

    if (qtdParcelas>0 && valorTotal>0) {
        document.getElementById("xParcelas").innerHTML = 'x Vezes de R$ ' + valorParcela;
    }else{
        document.getElementById("xParcelas").innerHTML = 'x Vezes de R$ 0,00';
    }

}

//Funções da Pagina ListDeve
var linkPag = "Padrao";
function definirDadosModal(titulo, desc, link){
    document.getElementById("exampleModalLabel").innerHTML = titulo;
    document.getElementById("modal-body").innerHTML = desc;
    linkPag = link;
}
function linkAtual(){
    return linkPag;
}

