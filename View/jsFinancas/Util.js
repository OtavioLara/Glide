function Util() {}
;

Util.soma = function (a, b) {
    var resultado = a + b;
    resultado = parseFloat(resultado.toFixed(2));
    return resultado;
}

Util.multiplica = function (a, b) {
    var resultado = a * b;
    resultado = parseFloat(resultado.toFixed(2));
    return resultado;
}

Util.somaInputsJQuerry = function (inputs) {
    var somatorio = 0;
    for (var i = 0; i < inputs.length; i++) {
        somatorio = Util.soma(somatorio, inputs[i].value);
    }
    return somatorio;
}

Util.round = function (valor) {
    var retorno = (valor * 100).toFixed(2);
    var retorno = Math.floor(retorno);
    var retorno = (retorno / 100).toFixed(2);
    return parseFloat(retorno);
}

Util.geraDistribuicao = function (valor, totalPessoas, posInicial) {
    var distribuicao = [];
    if (totalPessoas > 0) {
        var divisao = valor / totalPessoas;
        divisao = Util.round(divisao);
        var resto = valor - parseFloat((divisao * totalPessoas).toFixed(2));
        resto = parseFloat(resto.toFixed(2));
        for (var i = 0; i < totalPessoas; i++) {
            distribuicao[i] = divisao;
        }
        var pos = posInicial % totalPessoas;
        while (resto > 0) {
            pos = pos % totalPessoas;
            distribuicao[pos] = Util.soma(distribuicao[pos], 0.01);
            resto = Util.soma(resto, -0.01);
            pos++;
        }
    }
    return distribuicao;
}