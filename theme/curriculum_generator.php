<?php $v->layout("_theme"); ?>

<section class="row">
    <div class="col-12">
        <h1 class="text-center my-5">Gerador de Currículo</h1>
    </div> 
</section>
<section class="row">
    <form id="formularioCurriculo col-12">
        <div class="row">
            <div class="col-6 mb-3">
                <label for="nomeCompleto" class="form-label">Nome Completo:</label>
                <input type="text" class="form-control" id="nomeCompleto" name="nomeCompleto" required>
            </div>
            <div class="col-6 mb-3">
                <label for="nacionalidade" class="form-label">Nacionalidade:</label>
                <input type="text" class="form-control" id="nacionalidade" name="nacionalidade" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-3">
                <label for="sexo">Sexo:</label>
                <select id="sexo" name="sexo" class="form-select" required>
                    <option value="" disabled selected>Selecione o sexo</option>
                    <option value="masculino">Masculino</option>
                    <option value="feminino">Feminino</option>
                    <option value="nao_binario">Não binário</option>
                    <option value="genero_fluido">Gênero fluido</option>
                    <option value="agenero">Agênero</option>
                    <option value="travesti">Travesti</option>
                    <option value="transgenero">Transgênero</option>
                    <option value="nao_informar">Desejo não informar</option>
                </select>
            </div>
            <div class="col-3">
                <label for="">Idade(anos):</label>
                <input type="text" class="form-control" id="" name="" />
            </div>
            <div class="col-3">
                <label for="estadoCivil">Estado Civil:</label>
                <select id="estadoCivil" name="estadoCivil" class="form-select" required>
                    <option value="" disabled selected>Selecione o estado civil</option>
                    <option value="solteiro">Solteiro(a)</option>
                    <option value="casado">Casado(a)</option>
                    <option value="divorciado">Divorciado(a)</option>
                    <option value="viuvo">Viúvo(a)</option>
                    <option value="uniaoestavel">União Estável</option>
                </select>

            </div>
            <div class="col-3">
                <label for="">Tem Filhos(s)?:</label>
                <select name="" id="" class="form-select">
                    <option value="">Sim</option>
                    <option value="">Não</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <label for="estado" class="form-label">Estado:</label>
                <select id="estado" class="form-select">
                    <option value="">Selecione um estado</option>
                </select>
            </div>
            <div class="col-6">
                <label for="cidade" class="form-label">Cidade:</label>
                <select id="cidade" class="form-select">
                    <option value="">Selecione um estado primeiro</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço:</label>
            <input type="text" class="form-control" id="endereco" name="endereco" required>
        </div>
        <div class="row mb-3">
            <div class="col-4">
                <label for="email" class="form-label">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="col-4">
                <label for="telefone1" class="form-label">Telefone 1:</label>
                <input type="tel" class="form-control" id="telefone1" name="telefone1" required>
            </div>
            <div class="col-4">
                <label for="telefone2" class="form-label">Telefone 2:</label>
                <input type="tel" class="form-control" id="telefone2" name="telefone2" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-4">
                <label for="linkedin" class="form-label">Linkedin:</label>
                <input type="text" class="form-control" id="linkedin" name="linkedin" required>
            </div>
            <div class="col-4">
                <label for="instagram" class="form-label">Instagram:</label>
                <input type="text" class="form-control" id="instagram" name="instagram" required>
            </div>
            <div class="col-4">                
                <label for="github" class="form-label">GitHub:</label>
                <input type="text" class="form-control" id="github" name="github" required>
            </div>
        </div>                
        <div class="row mb-3">
            <div class="col-12 mb-3">
                <label for="objetivoProfissional" class="form-label">Objetivo Profissional:</label>
                <input type="text" class="form-control" id="objetivoProfissional" name="objetivoProfissional" rows="4" required>
            </div>            
        </div>
        <div class="row">
            <div class="col-12">
                <h2>FORMAÇÃO ACADÊMICA</h2>
            </div>
            <div class="col-12">
                <label for="curso0" class="form-label">Curso:</label>
                <input type="text" class="form-control" id="curso0" name="curso0" required>
            </div>
            <div class="col-4">
                <label for="instituicao" class="form-label">Instituição:</label>
                <input type="text" class="form-control" id="instituicao" name="instituicao" required>
            </div>
            <div class="col-4">
                <label for="conclusaoCurso0" class="form-label">Conclusão de Curso:</label>
                <select id="conclusaoCurso0" name="conclusaoCurso0" class="form-select" required>
                    <option value="" disabled selected>Selecione a conclusão do curso</option>
                    <option value="concluido">Concluído</option>
                    <option value="cursando">Cursando</option>
                    <option value="interrompido">Interrompido</option>
                    <option value="previsto">Previsto</option>
                </select>
            </div>
            <div class="col-4">
                <label for="anoDeConclusaoCurso0" class="form-label">Ano de Conclusão:</label>
                <input type="text" class="form-control" id="anoDeConclusaoCurso0" name="anoDeConclusaoCurso0" required>
                <input type="hidden" name="qtdCourses" value=0 id="qtdCourses" />
            </div>
        </div>
        <div id="rowAddCourses" class="row"></div>
        <div class="row mb-3">
            <div class="col-3">
                <button type="button" id="btAddCourse" class="form-control btn btn-sm btn-outline-info mt-3">+ Adicionar curso</button>
            </div>
            <div class="col-9">&nbsp;</div>
        </div>
        <div class="row mb-3">
            <div class="col-12 mb-3">
                <h2>EXPERIÊNCIA PROFISSIONAL</h2>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-3 mb-3">
                <label for="empresa" class="form-label">Empresa:</label>
                <input type="text" class="form-control" id="empresa" name="empresa" required>
            </div>
            <div class="col-3 mb-3">
                <label for="anoDeEntrada" class="form-label">Ano de Entrada:</label>
                <input type="text" class="form-control" id="anoDeEntrada" name="anoDeEntrada" required>
            </div>
            <div class="col-3 mb-3">
                <label for="anoDeSaida" class="form-label">Ano de Saída:</label>
                <input type="text" class="form-control" id="anoDeSaida" name="anoDeSaida" required>
            </div>
            <div class="col-3 mb-3">
                <label for="cargo" class="form-label">Cargo:</label>
                <input type="text" class="form-control" id="cargo" name="cargo" required>
            </div>
            <div class="col-12">
                <textarea name="" id="" cols="30" rows="5" placeholder="Principais atividades desempenhadas no cargo:" class="form-control"></textarea>
            </div>
        </div>
        <div id="rowAddProfessionalExperience" class="row"></div>
        <div class="row mb-3">
            <div class="col-3">
            <button type="button" id="btAddProfessionalExperience" class="form-control btn btn-sm btn-outline-info mt-3">+ Adicionar experiência</button>
            </div>
            <div class="col-9">&nbsp;</div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <h2>QUALIFICAÇÕES E ATIVIDADES COMPLEMENTARES</h2>                
                <input type="text" class="form-control" id="cargo" name="cargo" required>
            </div>
        </div>
        <div id="rowAddQualificationsAndComplementaryActivities" class="row"></div>
        <div class="row mb-3">
            <div class="col-6">
                <button type="button" id="btAddQualificationsAndComplementaryActivities" class="form-control btn btn-sm btn-outline-info mt-3">+ Adicionar outra qualificação / atividade complementar</button>
            </div>
            <div class="col-6">&nbsp;</div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <h2>INFORMAÇÕES ADICIONAIS</h2>                
                <input type="text" class="form-control" id="informacoes_adicionais" name="informacoes_adicionais" required>                
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
            <button type="button" id="" class="form-control btn btn-sm btn-outline-info mt-3">+ Adicionar outra informação adicional</button>
            </div>
            <div class="col-6">&nbsp;</div>
        </div>
        <div class="col-12">
            <button type="submit" class="form-control btn btn-outline-primary mt-3">Gerar Currículo</button>
        </div>
    </form>
</section>

<?php $v->start("js"); ?>
    <script src="<?= url('theme/assets/js/curriculumGenerator.js');?>"></script>
<?php $v->end(); ?>