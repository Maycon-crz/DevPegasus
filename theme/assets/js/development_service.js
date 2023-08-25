class DevelopmentService{
    toggleWebsiteDevelopmentLabelButton=0;
    constructor(){
        this.toggleWebsiteDevelopment(this);
    }
    toggleWebsiteDevelopment(obj){
        $("#btknowMoreWebsiteDevelopment").click(function(){
            $("#rowWebsiteDevelopment").toggle();
            if(obj.toggleWebsiteDevelopmentLabelButton === 0){
                $("#btknowMoreWebsiteDevelopment").text("Mostrar menos -");
                obj.toggleWebsiteDevelopmentLabelButton = 1;
            }else{
                $("#btknowMoreWebsiteDevelopment").text("Saiba mais +");
                obj.toggleWebsiteDevelopmentLabelButton = 0;
            }
        });
    }
}

const developmentService = new DevelopmentService();