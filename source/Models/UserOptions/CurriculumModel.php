<?php

namespace Source\Models\UserOptions;

use Source\Models\UserOptions\DataTransferObjects\CurriculumDTO;

class CurriculumModel {    
    private $contentPDF;
    private $htmlCourses;
    private $htmlProfessionalExperiences;
    private $htmlQualificacoes;
    private $htmlInformacoesAdicionais;

    public function generatePDF(CurriculumDTO $curriculumDTO) {
        if (!empty($curriculumDTO->courses)) {
            $this->htmlCourses = "<h3>Formação</h3><ul>";
            foreach ($curriculumDTO->courses as $course) {
                $this->htmlCourses .= "<li>{$course->instituicao}</li>";
                $this->htmlCourses .= "<li>{$course->conclusaoCurso}</li>";
                $this->htmlCourses .= "<li>{$course->anoDeConclusaoCurso}</li>";
            }
            $this->htmlCourses .= "</ul>";
        }
        
        if (!empty($curriculumDTO->professionalExperiences)) {
            $this->htmlProfessionalExperiences = "<h3>Experiência Profissional</h3><ul>";
            foreach ($curriculumDTO->professionalExperiences as $experience) {
                $this->htmlProfessionalExperiences .= "<li>{$experience->empresa}</li>";
                $this->htmlProfessionalExperiences .= "<li>{$experience->anoDeEntrada}</li>";
                $this->htmlProfessionalExperiences .= "<li>{$experience->anoDeSaida}</li>";
                $this->htmlProfessionalExperiences .= "<li>{$experience->cargo}</li>";
                $this->htmlProfessionalExperiences .= "<li>{$experience->principaisAtividades}</li>";
            }
            $this->htmlProfessionalExperiences .= "</ul>";
        }
        
        if (!empty($curriculumDTO->qualificacoes)) {
            $this->htmlQualificacoes = "<h3>Qualificações e Atividades Complementares</h3><ul>";
            foreach ($curriculumDTO->qualificacoes as $qualification) {
                $this->htmlQualificacoes .= "<li>{$qualification}</li>";
            }
            $this->htmlQualificacoes .= "</ul>";
        }
        
        if (!empty($curriculumDTO->informacoesAdicionais)) {
            $this->htmlInformacoesAdicionais = "<h3>Informações Adicionais</h3><ul>";
            foreach ($curriculumDTO->informacoesAdicionais as $info) {
                $this->htmlInformacoesAdicionais .= "<li>{$info}</li>";
            }
            $this->htmlInformacoesAdicionais .= "</ul>";
        }        
        // Montar o HTML do currículo
        $this->contentPDF = "
            <html>
            <head>
                <style>
                </style>
            </head>
            <body>
                <h1>{$curriculumDTO->nomeCompleto}</h1>
                " . (!empty($curriculumDTO->nacionalidade) || !empty($curriculumDTO->estadoCivil) || !empty($curriculumDTO->idade)
                ? "<p>{$curriculumDTO->nacionalidade}, {$curriculumDTO->estadoCivil}, {$curriculumDTO->idade} anos</p>"
                : ""
                ) . "
                " . (!empty($curriculumDTO->endereco) ? "<p>{$curriculumDTO->endereco}</p>" : "") . "
                " . (!empty($curriculumDTO->cidade) || !empty($curriculumDTO->estado)
                ? "<p>{$curriculumDTO->cidade} - {$curriculumDTO->estado}</p>"
                : ""
                ) . "
                " . (!empty($curriculumDTO->telefone1) || !empty($curriculumDTO->telefone2)
                ? "<p>Telefone 1: {$curriculumDTO->telefone1} / {$curriculumDTO->telefone2}</p>"
                : ""
                ) . "
                " . (!empty($curriculumDTO->email) ? "<p>E-mail: {$curriculumDTO->email}</p>" : "") . "
                <h3>Objetivo</h3>
                <hr />
                <p>{$curriculumDTO->objetivoProfissional}</p>
                {$this->htmlCourses}
                {$this->htmlProfessionalExperiences}
                {$this->htmlQualificacoes}
                {$this->htmlInformacoesAdicionais}                
                <h3>Rede social</h3>
                " . (!empty($curriculumDTO->linkedin) ? "<p>Linkedin: {$curriculumDTO->linkedin}</p>" : "") . "
                " . (!empty($curriculumDTO->instagram) ? "<p>Instagram: {$curriculumDTO->instagram}</p>" : "") . "
                " . (!empty($curriculumDTO->github) ? "<p>GitHub: {$curriculumDTO->github}</p>" : "") . "
            </body>
            </html>
        ";
        return $this->contentPDF;
    }
}
?>
