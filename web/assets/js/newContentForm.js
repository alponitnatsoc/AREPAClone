/**
 * float percentageGrade
 * float percentageAssessmentTool
 * boolean contributeOutcome/ checkbox
 */
$(document).ready(function (){
    var validator;
    $.getScript("{{ asset('assets/vendors/jquery-validation/dist/jquery.validate.min.js') }}").done(function(){
        validator = $("form [name = 'new_content_form' ]").validate({
            rules: {
                "new_content_form[percentageGrade]":{required:true, minlength:1, maxlength:2},
                "new_content_form[contributeOutcome]":{},
                "new_content_form[percentageAssessmentTool]":{required:true, minlength:1, maxlength:2}
            },
            messages:{
                "new_content_form[percentageGrade]":{
                    required:"Ingresa el porcentaje del contenido sobre la nota de la clase",
                    minlength:"El porcentaje es muy pequeño",
                    maxlength:"El porcentaje es muy grande"},
                "new_content_form[contributeOutcome]":{},
                "new_content_form[percentageAssessmentTool]":{
                    required:"Ingresa el porcentaje del contenido sobre el assessment tool",
                    minlength:"El porcentaje es muy pequeño",
                    maxlength:"El porcentaje es muy grande"}
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