/* ------------------------------------------------------------------------------ */
/* ------------------------------------------------------------------------------ */
/* ------------------------------------------------------------------------------ */
/* Smodin - API QUE REESCREVE O TEXTO OU VERIFICA SINÔNIMOS DE PALAVRAS 
- Encontrada na Rapidapi
- LINK: https://rapidapi.com/ContentAI/api/contentai-net-text-generation/
*/
// const settings = {
//     async: true,
//     crossDomain: true,
//     url: 'https://rewriter-paraphraser-text-changer-multi-language.p.rapidapi.com/rewrite',
//     method: 'POST',
//     headers: {
//         'content-type': 'application/json',
//         'X-RapidAPI-Key': 'fc29db6f34mshdf0a3198f1baa2dp1dbc25jsnec150c975184',
//         'X-RapidAPI-Host': 'rewriter-paraphraser-text-changer-multi-language.p.rapidapi.com'
//     },
//     processData: false,
//     data: '{\r\n    "language": "en",\r\n    "strength": 3,\r\n    "text": "lets do this"\r\n}'
//     };
    
    // $.ajax(settings).done(function (response) {
    // console.log(response);
    // });
    /* ------------------------------------------------------------------------------ */
    /* ------------------------------------------------------------------------------ */
    /* ------------------------------------------------------------------------------ */
    /* Smodin - Remoção de detecção de IA e recriação de endpoint 
    - Encontrada na Rapidapi
    - Link: https://rapidapi.com/smodin/api/ai-content-detection-remover
    */
    // const settings_detection_ia_text_and_reformulation = {
    //     async: true,
    //     crossDomain: true,
    //     url: 'https://ai-content-detection-remover.p.rapidapi.com/recreate',
    //     method: 'POST',
    //     headers: {
    //         'content-type': 'application/json',
    //         'X-RapidAPI-Key': 'fc29db6f34mshdf0a3198f1baa2dp1dbc25jsnec150c975184',
    //         'X-RapidAPI-Host': 'ai-content-detection-remover.p.rapidapi.com'
    //     },
    //     processData: false,
    //     data: '{\r\n    "text": "Acreditamos que os robôs devem ser os que reescrevem o texto. Reescrever texto é útil para otimização de mecanismos de busca (SEO), fazer cópias de livros ou papéis, para duplicar conteúdo de novas maneiras e para economizar horas de trabalho humano. As máquinas de reescrita automática no mercado atualmente custam uma fortuna, e não acreditamos que devam. Portanto, oferecemos nossa máquina de reescrita proprietária em mais de 100 idiomas diferentes para garantir que todos tenham acesso aos recursos de reescrita de texto.",\r\n    "language": "pt",\r\n    "recreateType": "aiDetection"\r\n}'
    // };
    
    // $.ajax(settings_detection_ia_text_and_reformulation).done(function (response) {
    // 	console.log(response);
    // });
    
    
    /* ------------------------------------------------------------------------------ */
    /* ------------------------------------------------------------------------------ */
    /* ------------------------------------------------------------------------------ */
    /* Textcortex - Plataforma com que parece ser muito bom com várias opções de IA
    Link: https://pt.docs.textcortex.com/api/paths/texts-blogs/post
    */
    const apiKey = "gAAAAABkgG3hycetteQDOOagPWlzqFrgA5kYTyweNi-HH_hzRl1ZkObw1L9mX4ObqkTQHxTz8iPjZXeIdDUj8GnWfiiTd46H3o6bQEaZfZdcTNqWXx0J2PmwoIO0GK7WB5mOlgEuDGjK";
    const data = '{'+
        '"context": "Sustentabilidade",'+
        '"keywords": ['+
          '"Meio ambiente",'+
          '"Sustentabilidade"'+
        '],'+
        '"max_tokens": 512,'+
        '"model": "sophos-1",'+
        '"n": 1,'+
        '"source_lang": "pt",'+
        '"target_lang": "pt-br",'+
        '"temperature": 0.65,'+
        '"title": "Descubra como a sustentabilidade pode transformar positivamente o seu negócio e o meio ambiente"'+
    '}';
    /*
    CORPO DA REQUISIÇÃO
    {
      "context": "Reciclagem",
      "keywords": [
        "Meio ambiente",
        "Sustentabilidade"
      ],
      "max_tokens": 512,
      "model": "sophos-1",
      "n": 1,
      "source_lang": "pt",
      "target_lang": "pt-br",
      "temperature": 0.65,
      "title": "Reciclagem no Brasil"
    }
    */
    const settings_textcortex = {
      "async": true,
      "crossDomain": true,
      "url": "https://api.textcortex.com/v1/texts/blogs",
      "method": "POST",
      "headers": {
        "Content-Type": "application/json",
        "Authorization": "Bearer "+apiKey,
      },
      "processData": false,
      "data": data,
    };
    
    // $.ajax(settings_textcortex).done(function (response) {
    //   console.log(response);
    // });