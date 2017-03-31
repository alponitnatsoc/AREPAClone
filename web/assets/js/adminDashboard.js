function startAdmin() {


    $("#help_courses_import").on('click',function () {
        $("#courses_step_1").show();
        $("#courses_step_2").hide();
        $("#courses_step_3").hide();
        $("#courses_step_4").hide();
        $("#courses_step_5").hide();
        $("#courses_step_6").hide();
        $("#courses_step_7").hide();
        $("#courses_step_8").hide();

    });
    $("#courses_step_1_next").on('click',function () {
        $("#courses_step_2").show();
        $("#courses_step_1").hide();
    });
    $("#courses_step_2_prev").on('click',function () {
        $("#courses_step_1").show();
        $("#courses_step_2").hide();
    });
    $("#courses_step_2_next").on('click',function () {
        $("#courses_step_3").show();
        $("#courses_step_2").hide();
    });
    $("#courses_step_3_prev").on('click',function () {
        $("#courses_step_2").show();
        $("#courses_step_3").hide();
    });
    $("#courses_step_3_next").on('click',function () {
        $("#courses_step_4").show();
        $("#courses_step_3").hide();
    });
    $("#courses_step_4_prev").on('click',function () {
        $("#courses_step_3").show();
        $("#courses_step_4").hide();
    });
    $("#courses_step_4_next").on('click',function () {
        $("#courses_step_5").show();
        $("#courses_step_4").hide();
    });
    $("#courses_step_5_prev").on('click',function () {
        $("#courses_step_4").show();
        $("#courses_step_5").hide();
    });
    $("#courses_step_5_next").on('click',function () {
        $("#courses_step_6").show();
        $("#courses_step_5").hide();
    });
    $("#courses_step_6_prev").on('click',function () {
        $("#courses_step_5").show();
        $("#courses_step_6").hide();
    });
    $("#courses_step_6_next").on('click',function () {
        $("#courses_step_7").show();
        $("#courses_step_6").hide();
    });
    $("#courses_step_7_prev").on('click',function () {
        $("#courses_step_6").show();
        $("#courses_step_7").hide();
    });
    $("#courses_step_7_next").on('click',function () {
        $("#courses_step_8").show();
        $("#courses_step_7").hide();
    });
    $("#courses_step_8_prev").on('click',function () {
        $("#courses_step_7").show();
        $("#courses_step_8").hide();
    });
    $("#courses_step_8_next").on('click',function () {
        $("#courses_step_9").show();
        $("#courses_step_8").hide();
    });
}