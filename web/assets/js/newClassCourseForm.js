/**
* string classCode
* string cicloelectivo
*/

$(document).ready(function (){
    var validator;
    $.getScript("{{ asset('assets/vendors/jquery-validation/dist/jquery.validate.min.js') }}").done(function(){
        validator = $("form [name = 'new_class_course_form' ]").validate({
            rules: {
                "new_class_course_form[classCode]":{required:true, minlength:1, maxlength:8, digits:true},
                "new_class_course_form[ciclolectivo]":{required:true, minlength:1, maxlength:7}
            },
            messages:{
                "new_class_course_form[classCode]":{
                    requires: 'Ingresa el código de la clase',
                    minlength: 'El código es muy corto',
                    maxlength: 'El código es muy largo'},
                "new_class_course_form[ciclolectivo]":{
                    required:"Ingresa el porcentaje del assessment tool sobre la nota final de la clase",
                    minlength:"El ciclo lectivo es muy corto",
                    maxlength: "El ciclo lectivo es muy largo"}
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