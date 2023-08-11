<?php

namespace Source\Models\UserOptions;

use Source\Models\UserOptions\DataTransferObjects\CurriculumDTO;

class CurriculumModel {    
    private $contentPDF;

    public function generatePDF(CurriculumDTO $curriculumDTO) {
        // Montar o HTML do currículo
        $this->contentPDF = "
            <html>
            <head>
                <style>
                    /* Estilos CSS aqui */
                    h1 {
                        text-align: center;
                        margin-top: 20px;
                    }
                    h2 {
                        margin-top: 20px;
                    }
                    p {
                        margin-bottom: 10px;
                    }
                    strong {
                        margin-right: 5px;
                    }
                    .header {
                        font-size: 24px;
                        margin-bottom: 10px;
                    }
                    .subheader {
                        font-size: 18px;
                        margin-top: 10px;
                        margin-bottom: 5px;
                    }
                </style>
            </head>
            <body>
                <h1 class=\"header\">Curriculum Vitae</h1>
                <div class=\"subheader\">Dados Pessoais</div>
                <p><strong>Nome Completo:</strong> {$curriculumDTO->nomeCompleto}</p>
                <p><strong>Nacionalidade:</strong> {$curriculumDTO->nacionalidade}</p>
                <p><strong>Sexo:</strong> {$curriculumDTO->sexo}</p>
                <p><strong>Idade:</strong> {$curriculumDTO->idade} anos</p>
                <p><strong>Estado Civil:</strong> {$curriculumDTO->estadoCivil}</p>
                <p><strong>Tem Filhos:</strong> {$curriculumDTO->temFilhos}</p>
                <p><strong>Estado:</strong> {$curriculumDTO->estado}</p>
                <p><strong>Cidade:</strong> {$curriculumDTO->cidade}</p>
                <p><strong>Endereço:</strong> {$curriculumDTO->endereco}</p>
                <p><strong>E-mail:</strong> {$curriculumDTO->email}</p>
                <p><strong>Telefone 1:</strong> {$curriculumDTO->telefone1}</p>
                <p><strong>Telefone 2:</strong> {$curriculumDTO->telefone2}</p>
                <p><strong>Linkedin:</strong> {$curriculumDTO->linkedin}</p>
                <p><strong>Instagram:</strong> {$curriculumDTO->instagram}</p>
                <p><strong>GitHub:</strong> {$curriculumDTO->github}</p>
                
                <!-- Restante do HTML aqui, incluindo cursos, experiências, qualificações e informações adicionais -->
                
            </body>
            </html>
        ";

        return $this->contentPDF;
    }
}
?>
