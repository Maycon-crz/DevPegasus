<?php $v->layout("_theme"); ?>

<section class='row'>
	<article class='col-12 border shadow-lg my-3'>
		<h1>Contador de Caracteres</h1>
		<p>Cole seu texto para que possamos retornar a quantidade de Caracteres e Palavras.</p>
	</article>
	<article class='col-12 border shadow-lg my-3'>
		<textarea id='textContadorDeCaracteres' class='form-control my-3' placeholder="Digite ou cole seu texto aqui..."></textarea>
		<p>Caracteres: <span id='qtdCaracteres'>0</span> | Palavras: <span id='qtdPalavras'>0</span></p>
	</article>

<!-- --------------------------------------------------------- -->

	<article class='col-12 border shadow-lg my-3' name='ENCriptador de Textos'>
		<h2>ENCriptador de Textos</h2>
		<h2>Aqui Você Consegue Criptografar E Descriptografar Textos Palavras Frases Com Uma Chave De Criptografia.</h2>
	</article>
	<article class='col-12 border shadow-lg mt-3' name='ENCriptador'>
		<textarea class='form-control my-3' rows='9' id='TextoParaCriptografar'></textarea>
		<label class='form-control text-center mt-3'>Chave De Criptografia:</label>
		<input class='form-control mt-1 mb-3' type='text' id='ChaveParaCriptografar' value='' placeholder='Digite aqui a chave de Criptografia:' />
	</article>
	<article class='col-12 border shadow-lg' name='ENCriptador'>
		<h3 class='text-center'>Resultado</h3>
		<textarea class='col-12 border shadow-lg my-3' id='TextoCriptografado'></textarea>
	</article>
	<article class='col-6'>
		<button type='button' class='form-control btn btn-lg btn-outline-dark' id='BotaoCriptografar'>Criptografar</button>
	</article>
	<article class='col-6'>
		<button type='button' class='form-control btn btn-lg btn-outline-dark' id='BotaoDescriptografar'>Descriptografar</button>
	</article>
	<article class='col-12 border shadow-lg my-3'><p><strong>Atenção:</strong> Fique Ciente De Que Esta É Uma Criptografia Simples De Mão Dupla! Mas Posteriormente Estaremos Aprimorando Todas As Nossas Funções E Com Isso Virão Mais Opções De Criptografia De Texto Também!</p></article>
<!-- --------------------------------------------------------- -->
	<article class='col-12 border shadow-lg my-3'>
		<h2>Conversor de texto</h2>
		<p>Converta textos e palavras para Maiúsculo, Minúsculo ou Primeira Letra de Cada Palavra em Maiúsculo</p>
	</article>
	<article class='col-12 border shadow-lg my-3'>
		<textarea id='textoParaSerConvertido' class='form-control my-3' placeholder="Digite ou cole seu texto ou palavras aqui..."></textarea>
	</article>
	<article class='col-6'>
		<button type='button' id='botaoTudoMaiusculo' class='form-control btn btn-lg btn-outline-dark'>Tudo Maiúsculo</button>
	</article>
	<article class='col-6'>
		<button type='button' id='botaoTudoMinusculo' class='form-control btn btn-lg btn-outline-dark'>Tudo Minúsculo</button>
	</article>
	<article class='col-12 border shadow-lg my-3'>
		<button type='button' id='botaoPrimeiraLetraMaiuscula' class='form-control btn btn-lg btn-outline-dark'>Primeira Letra de Cada Palavra Maiúscula</button>
	</article>
</section>