$(document).ready(function (){
    var validator;
    $.getScript("{{ asset('assets/vendors/jquery-validation/dist/jquery.validate.min.js') }}").done(function(){
        validator = $("form [name = 'new_assessment_tool_form' ]").validate({
            rules: {
                "new_assessment_tool_form[contributeOutcome]":{},
                "new_assessment_tool_form[percentageGrade]":{required:true, min:0, maxlength:2}
            },
            messages:{
                "new_assessment_tool_form[contributeOutcome]":{},
                "new_assessment_tool_form[percentageGrade]":{
                    required:"Ingresa el porcentaje del assessment tool sobre la nota final de la clase",
                    min:" El porcentaje no puede ser negativo",
                    max: "El porcentaje no puede pasar de 2 cifras"}
            }
        });
    });
    $("#form").on('submit',function (e) {
        e.preventDefault();
        var form = $("form");
        var flagValid = true;
        if (!form.valid()) {
            return;
        }
    })
});