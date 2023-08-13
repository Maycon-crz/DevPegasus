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
                { value: "Concluído em", text: "Concluído" },
                { value: "Conclusão em", text: "Em andamento" },
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
        for (const atributo in atributos) {
          elemento.setAttribute(atributo, atributos[atributo]);
        }
        return elemento;
    }
    generateCurriculo(session) {
        $("#formGenerateCurriculum").submit(function(ev){		
            ev.preventDefault();
            var formData = new FormData(this);  // 'this' é um objeto jQuery
            const appKey = session.checkCookieSession("createsessioncookie");
            var urlSite = $("#urlSite").val();
            var loadingGif = document.querySelector(".loadingGif");
            loadingGif.innerHTML = "<div class='spinner-border text-success' role='status'><span class='sr-only'></span></div>";
            if (appKey) {
                alert("Já tentei fazer direto não deu certo, DEVO USAR o exemplo do phpTips lá tem como fazer!");
                // formData.append("front_end", "web");
                // formData.append("app_key", appKey);
                // $.ajax({
                //     url: urlSite+"/api/curriculum_generator",
                //     type: "POST",
                //     data: formData,  // Use o elemento HTMLFormElement
                //     dataType: "json",
                //     processData: false,  // Evita que o jQuery processe os dados
                //     contentType: false,  // Evita que o jQuery defina o tipo de conteúdo
                //     success: function(response){
                //         loadingGif.innerHTML = "";
                //         console.log(response);
                //         // Decodifica o PDF Base64 e cria um link de download
                //         var pdfData = atob(response.pdfBase64);
                //         var blob = new Blob([pdfData], { type: 'application/pdf' });
                //         var link = document.createElement('a');
                //         link.href = window.URL.createObjectURL(blob);
                //         link.download = 'curriculo.pdf';
                //         link.click();
                //     }
                // });
            } else {
                alert("Erro de autenticação, recarregue a página!");
            }
        });
    }    
}

const curriculumGenerator = new CurriculumGenerator(new Session());