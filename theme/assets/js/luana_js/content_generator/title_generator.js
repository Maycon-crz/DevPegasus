$(".btTitleOptions").click(function(){
	$("#lineReturnedTitlesApiSEOrapidapi").html("<h1 class='text-secondary'>Carregando...</h1>");
	findTitles($(this).val());
});
$("#btTitleSearchEngine").click(function(){
	$("#lineReturnedTitlesApiSEOrapidapi").html("<h1 class='text-secondary'>Carregando...</h1>");
	findTitles($("#inputToGenerateTitle").val());
});

/* ------------------------------------------------------------------------------ */
/* ------------------------------------------------------------------------------ */
/* ------------------------------------------------------------------------------ */
/* Seo-api.p.rapidapi - Não é específica para criar títulos mais estou usando para isso
Link: 
*/
function findTitles(key){	
	const settings = {
		"async": true,
		"crossDomain": true,
		"url": "https://seo-api.p.rapidapi.com/v1/search/q="+key,
		"method": "GET",
		"headers": {
			"X-Proxy-Location": "BR",
			"X-User-Agent": "desktop",
			"X-RapidAPI-Key": "779e5ba4d0msh6af6a84a49d5cd9p11a3f6jsn0d7f19295d41",
			"X-RapidAPI-Host": "seo-api.p.rapidapi.com"
		}
	};
	
	$.ajax(settings).done(function (response) {
		console.log(response);
        var bodyResults = "";
        if(response.results.length > 0){
            for(let i=0; i < response.results.length; i++){			
                bodyResults += "<div class='col-4'><p class='form-control'>"+response.results[i].title+"</p><button value='"+response.results[i].title+"' class='form-control btn-primary'>Criar</button></div>";
            }    
        }else{
            bodyResults = "<div class='col-12'><h4>Nada encontrado</h4></div>";
        }		
		$("#lineReturnedTitlesApiSEOrapidapi").html(bodyResults);
		
	});
}

/* ------------------------------------------------------------------------------ */
/* ------------------------------------------------------------------------------ */
/* ------------------------------------------------------------------------------ */
/* Nlpcloud - 
Link: https://nlpcloud.com/home/token
*/
// 0ffd104c1554eb5875cf9f2b774c14677f9bd44e


$(".btNlpcloud").click(function(){	
	const formDataNlpcloud = new FormData();
	formDataNlpcloud.append("system", "web");
	var urlSite = $("#urlSite").val();
	$.ajax({
		url: urlSite+"/luana/api/title_generator_nlp_cloud_api",
		type: 'POST',
		data: '{}',
		dataType: 'json',
		success: function(response){
			console.log(response);
		}
	});
	
});

$(".btOpenaiGPTRapidapi").click(function(){	
	const formDataOpenaiGPTRapidapi = new FormData();
	formDataOpenaiGPTRapidapi.append("system", "web");
	var urlSite = $("#urlSite").val();
	$.ajax({
		url: urlSite+"/luana/api/title_generator_openai_gpt_rapidapi",
		type: 'POST',
		data: '{}',
		dataType: 'json',
		success: function(response){
			// console.log(response);
			// console.log("---------------------------------------------------------");
			// console.log(response.data.choices[0].message.content);



			var dataOpenaiGPTRapidapi = response.openaiGPTRapidapi.data;
			var dataTextcortex = response.textcortex;
			// Agora você pode tratar os dados como quiser aqui
			console.log(dataOpenaiGPTRapidapi);
			console.log(dataTextcortex);
		}
	});	
});