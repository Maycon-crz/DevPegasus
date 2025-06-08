<?php

namespace Source\Models\UserOptions\DataTransferObjects;

class CurriculumDTO {
    public $nomeCompleto;
    public $nacionalidade;
    public $sexo;
    public $idade;
    public $estadoCivil;
    public $temFilhos;
    public $estado;
    public $cidade;
    public $endereco;
    public $email;
    public $telefone1;
    public $telefone2;
    public $linkedin;
    public $instagram;
    public $github;
    public $objetivoProfissional;
    public $courses = [];  // Um array para guardar os cursos
    public $professionalExperiences = [];  // Um array para guardar as experiências profissionais
    public $qualificacoes = [];  // Um array para guardar as qualificações e atividades complementares
    public $informacoesAdicionais = [];  // Um array para guardar as informações adicionais

    public function toArray() {
        $dataArray = [
            'nomeCompleto' => $this->nomeCompleto,
            'nacionalidade' => $this->nacionalidade,
            'sexo' => $this->sexo,
            'idade' => $this->idade,
            'estadoCivil' => $this->estadoCivil,
            'temFilhos' => $this->temFilhos,
            'estado' => $this->estado,
            'cidade' => $this->cidade,
            'endereco' => $this->endereco,
            'email' => $this->email,
            'telefone1' => $this->telefone1,
            'telefone2' => $this->telefone2,
            'linkedin' => $this->linkedin,
            'instagram' => $this->instagram,
            'github' => $this->github,
            'objetivoProfissional' => $this->objetivoProfissional,
            'courses' => $this->courses,
            'professionalExperiences' => $this->professionalExperiences,
            'qualificacoes' => $this->qualificacoes,
            'informacoesAdicionais' => $this->informacoesAdicionais,
        ];
        
        return $dataArray;
    }
}


?>