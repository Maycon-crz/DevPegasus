class ConversorDeTexto{
  constructor(){
    this.tudoMaiusculo();
    this.tudoMinusculo();
    this.primeiraLetraMaiuscula();
  }
  tudoMaiusculo(){
    let textoParaSerConvertido = document.getElementById("textoParaSerConvertido");
    let botaoTudoMaiusculo = document.getElementById("botaoTudoMaiusculo");
    if(botaoTudoMaiusculo){
      botaoTudoMaiusculo.addEventListener("click", () => {
        let textoMaiusculo = textoParaSerConvertido.value.toUpperCase();
        textoParaSerConvertido.value = textoMaiusculo;
      });
    }
  }
  tudoMinusculo(){
    let textoParaSerConvertido = document.getElementById("textoParaSerConvertido");
    let botaoTudoMinusculo = document.getElementById("botaoTudoMinusculo");
    if(botaoTudoMinusculo){
      botaoTudoMinusculo.addEventListener("click", () => {
        let textoMinusculo = textoParaSerConvertido.value.toLowerCase();
        textoParaSerConvertido.value = textoMinusculo;
      });
    }
  }
  titleize(text){
    var words = text.toLowerCase().split(" ");
    for (var a = 0; a < words.length; a++) {
        var w = words[a];
        words[a] = w[0].toUpperCase() + w.slice(1);
    }
    return words.join(" ");
}
  primeiraLetraMaiuscula(){
    let textoParaSerConvertido = document.getElementById("textoParaSerConvertido");
    let botaoPrimeiraLetraMaiuscula = document.getElementById("botaoPrimeiraLetraMaiuscula");
    if(botaoPrimeiraLetraMaiuscula){
      botaoPrimeiraLetraMaiuscula.addEventListener("click", () => {
        let cadaletra = this.titleize(textoParaSerConvertido.value);
        textoParaSerConvertido.value = cadaletra;
      });
    }
  }
}
var conversorDeTexto = new ConversorDeTexto();
