/**
 * string studentCode/text
 * float pointAverage/number
 * integer aprovedCredits/integer
 * boolean isMonitor/checkbox
 */

$(document).ready(function (){
    var validator;
    $.getScript("{{ asset('assets/vendors/jquery-validation/dist/jquery.validate.min.js') }}").done(function(){
        validator = $("form [name = 'new_assessment_tool_form' ]").validate({
            rules: {
                "new_student_form[studentCode]":{required:true, minlength:1},
                "new_student_form[pointAverage]":{required:true, min:0},
                "new_student_form[aprovedCredits]":{required:true, min:0, digits:true},
                "new_student_form[isMonitor]":{}
            },
            messages:{
                "new_student_form[studentCode]":{required:"ingresa el codigo del estudiante", minlength:"El código es muy corto"},
                "new_student_form[pointAverage]":{required:"Ingresa el promedio ponderado", min: "El promeio ponderado debe ser positivo"},
                "new_student_form[aprovedCredits]":{
                    required: "ingresa el numero de creditos aprobados",
                    min:"Ingresar numeros positicos",
                    digits:"Ingresar solo numeros"},
                "new_student_form[isMonitor]":{}
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