/**
 * string teacherCode
 *
 */
$(document).ready(function (){
    var validator;
    $.getScript("{{ asset('assets/vendors/jquery-validation/dist/jquery.validate.min.js') }}").done(function(){
        validator = $("form [name = 'new_teacher_form' ]").validate({
            rules: {
                "new_teacher_form[teacherCode]":{required:true, minlength:1}
            },
            messages:{
                "new_teacher_form[teacherCode]":{required:"Ingresa el porcentaje del assessment tool sobre la nota final de la clase", minlength:1}
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