class CurriculumGenerator{
    /*URL da API brasileira de estados e cidades*/
    apiUrl = "https://servicodados.ibge.gov.br/api/v1/localidades";
    counterCourses=1;
    counterProfessionalExperience=1;
    counterQualifications=1;
    constructor(){
        /*Chamar a função para popular o select de estados ao carregar a página*/
        this.getStates(this);
        this.addCourse(this);
        this.generateProfessionalExperience(this);
        this.qualificationsAndComplementaryActivities(this);
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
            divQualifications.appendChild(obj.createElementGeneric("input", "form-control", '', { id: "qualifications"+obj.counterQualifications, name: "qualifications"+obj.counterQualifications, required: true }));
            divRow.appendChild(divQualifications);
            obj.counterQualifications++;
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
}

const curriculumGenerator = new CurriculumGenerator();