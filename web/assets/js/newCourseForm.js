/**
 * string academicGrade/ choice
 * string courseCode
 * integer credits
 * string nameCourse
 * string shortNameCourse
 * string component/ choice
 */
$(document).ready(function (){
    var validator;
    alert("hola");
    $.getScript("{{ asset('assets/vendors/jquery-validation/dist/jquery.validate.min.js') }}").done(function(){
        validator = $("form [name = 'new_course_form' ]").validate({
            rules: {
                "new_course_form[academicGrade]":{required:true},
                "new_course_form[courseCode]":{required:true, minlength:1, maxlength:8},
                "new_course_form[credits]":{required:true, min:1, maxlength:2, digits:true},
                "new_course_form[nameCourse]":{required:true, minlength:1,maxlength:150},
                "new_course_form[shortNameCourse]":{required:true, minlength:1, maxlength:150},
                "new_course_form[component]":{required:true}
            },
            messages:{
                "new_course_form[academicGrade]":{
                    required:"Elegir una opción"},
                "new_course_form[courseCode]":{
                    required:"Ingresar el código",
                    minlength:"El cófdigo es muy corto",
                    maxlength:"El código es muy largo"},
                "new_course_form[credits]":{
                    required:"Imgresar los creditos",
                    min:"El número de creditos es muy pequeño",
                    maxlength:"El número de creditos es muy largo",
                    digits:"Ingrese un solo números"},
                "new_course_form[nameCourse]":{
                    required:"Ingresar el nombre",
                    minlength:"El nombre es muy corto",
                    maxlength:"El nombre es muy largo"},
                "new_course_form[shortNameCourse]":{
                    required:"Ingresar el nombre abreviado",
                    minlength:"El nombre abreviado es muy corto",
                    maxlength:"El nombre abreviado es muy largo"},
                "new_course_form[component]":{
                    required:"Elegir una opcion",
                    }
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
