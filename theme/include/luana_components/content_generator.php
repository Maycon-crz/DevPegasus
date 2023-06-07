<section>
	<div class="row">
		<h2>Gerador de conteúdos</h2>
	</div>
	<div class='row border py-3'>
		<div class='col-12 text-center'>
			<h3>Gerar de títulos</h3>
			<button class="btn btn-primary btTitleOptions" value="meio%20ambiente">Meio ambiente</button>
			<button class="btn btn-primary btTitleOptions" value="reciclagem">Reciclagem</button>
			<button class="btn btn-primary btTitleOptions" value="artesanato%20com%20reciclagem">Artesanato com Reciclagem</button>
			<button class="btn btn-primary btTitleOptions" value="upcycle">Upcycle</button>
			<button class="btn btn-primary btTitleOptions" value="plástico">Plástico</button>
			<button class="btn btn-primary btTitleOptions" value="Água">Água</button>
			<button class="btn btn-primary btTitleOptions" value="Arvores">Arvores</button>
			<button class="btn btn-primary btTitleOptions" value="Arvores">Sol</button>
			<button class="btn btn-primary btTitleOptions" value="Compostagem">Compostagem</button>
			<input type="text" class="p-1 border rounded" id="inputToGenerateTitle" />		
			<!-- <button class="btn btn-primary" id="btBuscadorAPISEO">Buscar</button> -->
			<button class="btn btn-primary" id="btTitleSearchEngine">Buscar</button>			
		</div>
	</div>
	<div class="row border">
		<div class="col-12 border rounded mt-3 mb-3">
			<h3 class="text-center">Resultados API ( seo-api.p.rapidapi.com/v1/search )</h3>
			<div id="lineReturnedTitlesApiSEOrapidapi" class="row"></div>
		</div>		
	</div>
	<div class="row border">
		<div class="col-12 border rounded mt-3 mb-3">
			<h3 class="text-center">Resultados API ( textcortex.com/api )</h3>
			<div id="lineReturnedTitlesApiSEOrapidapi" class="row"></div>
		</div>		
	</div>
	<div class="row border">
		<div class="col-12 border rounded mt-3 mb-3">
			<button type="button" class="btNlpcloud">API Nlpcloud</button>
			<button type="button" class="btOpenaiGPTRapidapi">API OpenaiGPT Pela Rapidapi</button>			
		</div>
	</div>
	
</section>
