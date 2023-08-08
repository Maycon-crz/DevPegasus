class CurriculumGenerator{
    /*URL da API brasileira de estados e cidades*/
    apiUrl = "https://servicodados.ibge.gov.br/api/v1/localidades";
    counterCourses=1;
    counterProfessionalExperience=1;
    counterQualifications=1;
    counterAdditionalInformation=1;
    constructor(session){
        /*Chamar a função para popular o select de estados ao carregar a página*/
        this.getStates(this);
        this.addCourse(this);
        this.generateProfessionalExperience(this);
        this.qualificationsAndComplementaryActivities(this);
        this.additionalInformation(this);
        if (session.checkCookieSession("createsessioncookie") === false){session.createSession();}
        this.generateCurriculo(session);
    }
    /*Função para preencher o select de estados*/
    getStates(obj) {        
        $.getJSON(`${obj.apiUrl}/estados`, function (data) {            
            const $estadoSelect = $("#estado");
            /*Limpar o select antes de preencher*/
            $estadoSelect.empty();
            /*Adicionar a opção padrão*/
            $estadoSelect.append($('<option>', {
                value: "",
                text: "Selecione um estado"
            }));
            /*Preencher o select com os estados*/
            data.forEach(function (estado) {
                $estadoSelect.append($('<option>', {
                value: estado.sigla,
                text: estado.nome
                }));
            });
             /*Evento para popular o select de cidades quando um estado for selecionado*/
            $("#estado").on("change", function () {
                const estadoSigla = $(this).val();
                obj.getCities(obj, estadoSigla);
            });
        });
    }
    /*Função para preencher o select de cidades com base no estado selecionado*/
    getCities(obj, estadoSigla) {
        $.getJSON(`${obj.apiUrl}/estados/${estadoSigla}/municipios`, function (data) {
            const cidadeSelect = $("#cidade");
            /*Limpar o select antes de preencher*/
            cidadeSelect.empty();
            /*Adicionar a opção padrão*/
            cidadeSelect.append($('<option>', {
            value: "",
            text: "Selecione um estado primeiro"
            }));
            /*Preencher o select com as cidades*/
            data.forEach(function (cidade) {
                cidadeSelect.append($('<option>', {
                    value: cidade.nome,
                    text: cidade.nome
                }));
            });
        });
    }
    addCourse(obj){
        $("#btAddCourse").click(function(){
            const courseOptions = [
                { value: "", text: "Selecione a conclusão do curso", disabled: true, selected: true },
                { value: "concluido", text: "Concluído" },
                { value: "cursando", text: "Cursando" },
                { value: "interrompido", text: "Interrompido" },
                { value: "previsto", text: "Previsto" },
            ];
              
            const formGroups = [
                obj.createInputFormGroupCourses("col-12", "text", "Curso:", "curso"+obj.counterCourses, "curso"+obj.counterCourses, true),
                obj.createInputFormGroupCourses("col-4", "text", "Instituição:", "instituicao"+obj.counterCourses, "instituicao"+obj.counterCourses, true),
                obj.createSelectFormGroupCourses("col-4", "Conclusão de Curso:", "conclusaoCurso"+obj.counterCourses, "conclusaoCurso"+obj.counterCourses, true, courseOptions),
                obj.createInputFormGroupCourses("col-4", "text", "Ano de Conclusão:", "anoDeConclusaoCurso"+obj.counterCourses, "anoDeConclusaoCurso"+obj.counterCourses, true),
            ];
            
            formGroups.forEach(group => {
                document.getElementById('rowAddCourses').appendChild(group);
            });
            document.getElementById('qtdCourses').value = obj.counterCourses;
            obj.counterCourses++;
        });
    }
    createInputFormGroupCourses(classNames, inputType, labelText, id, name, isRequired) {
        const groupDiv = document.createElement("div");
        groupDiv.className = classNames;
        
        const label = document.createElement("label");
        label.setAttribute("for", id);
        label.className = "form-label";
        label.textContent = labelText;
        
        const input = document.createElement("input");
        input.type = inputType;
        input.className = "form-control";
        input.id = id;
        input.name = name;
        input.required = isRequired;
        
        groupDiv.appendChild(label);
        groupDiv.appendChild(input);
        return groupDiv;
    }
    
    createSelectFormGroupCourses(classNames, labelText, id, name, isRequired, options) {
        const groupDiv = document.createElement("div");
        groupDiv.className = classNames;
        
        const label = document.createElement("label");
        label.setAttribute("for", id);
        label.className = "form-label";
        label.textContent = labelText;
        
        const select = document.createElement("select");
        select.id = id;
        select.name = name;
        select.className = "form-select";
        select.required = isRequired;
        
        options.forEach(opt => {
            const option = document.createElement("option");
            option.value = opt.value;
            option.textContent = opt.text;
            option.disabled = opt.disabled;
            option.selected = opt.selected;
            select.appendChild(option);
        });
        
        groupDiv.appendChild(label);
        groupDiv.appendChild(select);
        return groupDiv;
    }
    generateProfessionalExperience(obj){
        $("#btAddProfessionalExperience").click(function(){
            const divRow = document.getElementById("rowAddProfessionalExperience");
            const divEmpresa = obj.createElementGeneric("div", "col-3 mb-3");
            divEmpresa.appendChild(obj.createElementGeneric("label", "form-label", "Empresa:"));
            divEmpresa.appendChild(obj.createElementGeneric("input", "form-control", '', { id: "empresa"+obj.counterProfessionalExperience, name: "empresa"+obj.counterProfessionalExperience, required: true }));
        
            const divAnoEntrada = obj.createElementGeneric("div", "col-3 mb-3");
            divAnoEntrada.appendChild(obj.createElementGeneric("label", "form-label", "Ano de Entrada:"));
            divAnoEntrada.appendChild(obj.createElementGeneric("input", "form-control", '', { id: "anoDeEntrada"+obj.counterProfessionalExperience, name: "anoDeEntrada"+obj.counterProfessionalExperience, required: true }));
        
            const divAnoSaida = obj.createElementGeneric("div", "col-3 mb-3");
            divAnoSaida.appendChild(obj.createElementGeneric("label", "form-label", "Ano de Saída:"));
            divAnoSaida.appendChild(obj.createElementGeneric("input", "form-control", '', { id: "anoDeSaida"+obj.counterProfessionalExperience, name: "anoDeSaida"+obj.counterProfessionalExperience, required: true }));
        
            const divCargo = obj.createElementGeneric("div", "col-3 mb-3");
            divCargo.appendChild(obj.createElementGeneric("label", "form-label", "Cargo:"));
            divCargo.appendChild(obj.createElementGeneric("input", "form-control", '', { id: "cargo"+obj.counterProfessionalExperience, name: "cargo"+obj.counterProfessionalExperience, required: true }));
        
            const divAtividades = obj.createElementGeneric("div", "col-12");
            divAtividades.appendChild(obj.createElementGeneric("textarea", "form-control", '', { id: "principaisAtividades"+obj.counterProfessionalExperience, name: "principaisAtividades"+obj.counterProfessionalExperience, cols: "30", rows: "5", placeholder: "Principais atividades desempenhadas no cargo:" })); 
        
            divRow.appendChild(divEmpresa);
            divRow.appendChild(divAnoEntrada);
            divRow.appendChild(divAnoSaida);
            divRow.appendChild(divCargo);
            divRow.appendChild(divAtividades);
            obj.counterProfessionalExperience++;
        });        
    }
    qualificationsAndComplementaryActivities(obj){
        $("#btAddQualificationsAndComplementaryActivities").click(function(){            
            const divRow = document.getElementById("rowAddQualificationsAndComplementaryActivities");
            const divQualifications = obj.createElementGeneric("div", "col-12 mb-3");
            divQualifications.appendChild(obj.createElementGeneric("label", "form-label", "Qualifications:"));
            divQualifications.appendChild(obj.createElementGeneric("input", "form-control", '', { id: "qualificacoes"+obj.counterQualifications, name: "qualificacoes"+obj.counterQualifications, required: true }));
            divRow.appendChild(divQualifications);
            obj.counterQualifications++;
        });
    }
    additionalInformation(obj){
        $("#btAddAdditionalInformation").click(function(){            
            const divRow = document.getElementById("rowAddAdditionalInformation");
            const divAdditionalInformation = obj.createElementGeneric("div", "col-12 mb-3");
            /*divAdditionalInformation.appendChild(obj.createElementGeneric("label", "form-label", "Informacoes Adicionais0:"));*/
            divAdditionalInformation.appendChild(obj.createElementGeneric("input", "form-control", '', { id: "informacoesAdicionais"+obj.counterAdditionalInformation, name: "informacoesAdicionais"+obj.counterAdditionalInformation, required: true }));
            divRow.appendChild(divAdditionalInformation);
            obj.counterAdditionalInformation++;
        });
    }
    createElementGeneric(tag, classe = '', conteudo = '', atributos = {}) {
        const elemento = document.createElement(tag);
        elemento.className = classe;
        elemento.innerHTML = conteudo;
        console.log(atributos);
        for (const atributo in atributos) {
          elemento.setAttribute(atributo, atributos[atributo]);
        }
        return elemento;
    }
    generateCurriculo(session) {
        $("#formGenerateCurriculum").submit(function(ev){		
			ev.preventDefault();
			var formData = new FormData(this);
			const appKey = session.checkCookieSession("createsessioncookie");
            var urlSite = $("#urlSite").val();
            var loadingGif = document.querySelector(".loadingGif");
            loadingGif.innerHTML = "<div class='spinner-border text-success' role='status'><span class='sr-only'></span></div>";
            if (appKey) {
				formData.append("front_end", "web");
				formData.append("app_key", appKey);
				/*DEBUG
                for (const pair of formData.entries()) {
					console.log(pair[0] + ', ' + pair[1]);
				}
                */                
				$.ajax({
					url: urlSite+"/api/curriculum_generator",
					type: 'POST',
					data: formData,
					success: function(response){
						loadingGif.innerHTML = "";
						console.log(response);
						// if(response.status == "success"){
						// 	alert(response.data);
						// 	window.location.href = urlSite;
						// }
						// const triangle = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svgIcons"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480H40c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24V296c0 13.3 10.7 24 24 24s24-10.7 24-24V184c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"/></svg>';
						// $("#smgErrorRegistrationPost").html(triangle+response.data);
					},
					cache: false,
					contentType: false,
					processData: false,
					xhr: function(){  // Custom XMLHttpRequest
						var myXhr = $.ajaxSettings.xhr();
						if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
							myXhr.upload.addEventListener('progress', function(){
								/* faz alguma coisa durante o progresso do upload */
							}, false);
						}
					return myXhr;
					}
				});
			}else{ alert("Erro de autenticação, recarregue a página!"); }
		});
    }
}

const curriculumGenerator = new CurriculumGenerator(new Session());