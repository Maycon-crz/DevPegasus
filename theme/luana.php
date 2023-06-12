<?php $v->layout("_theme"); $hoje = date('d/m/Y'); ?>

<h1 class="text-center">Luana IA</h1>

<?php require_once("include/luana_components/content_generator.php"); ?>

<?php $v->start("js"); ?>
	<script src="<?= url("theme/assets/js/luana_js/content_generator/title_generator.js"); ?>"></script>
	<script src="<?= url("theme/assets/js/luana_js/content_generator/text_generator.js"); ?>"></script>

	<script>		
		var formDataOpenaiGPTRapidapi = "app_key=xZy6U/ttRcevPu9bwHqOy3j0se+sj3KONu/bEMgL5IlXT3f/i9Q7kEX5IDj22nNIoKX+1+mQF0dyCYKA8v5SjoDKnkG1d8pLa7YUx7NKeJXMVaoVdUjNFeRIbSHeLlIdiw/8jQj2tvQ1de59yYZ8W44RdtKt7P9JVgFqqrQPzy/K2RD9UhtTpz7JLhw6mxENHQcW/2TcbNJkg9w6IV3HMyLz8aozgzCMhnlqSWbjttsqUOisDV38CANveNkKRjjxNqLRfhlDdYn0cOU26xXv1w==&system=external&hierarchy=3&subject=Sustentabilidade&keywords=Reciclagem, Meio ambiente";
		$.ajax({
			url: "https://www.devpegasus.com/luana/api/title_generator_openai_gpt_rapidapi",
			// url: "http://localhost/HOMOLOGACAO_WEB/DevPegasus/luana/api/title_generator_openai_gpt_rapidapi",			
			type: 'POST',
			data: formDataOpenaiGPTRapidapi,
			dataType: 'json',
			// headers: {
			// 	"Authorization": "Bearer seu_token_aqui"
			// },
			success: function(response){
				console.log(response);
				// console.log("---------------------------------------------------------");
				// console.log(response.data.choices[0].message.content);



				// var dataOpenaiGPTRapidapi = response.openaiGPTRapidapi.data;
				// var dataTextcortex = response.textcortex;
				// // Agora você pode tratar os dados como quiser aqui
				// console.log(dataOpenaiGPTRapidapi);
				// console.log(dataTextcortex);
			}
		});	
	</script>
<?php $v->end(); ?>