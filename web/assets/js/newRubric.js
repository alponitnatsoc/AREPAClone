function createRubric(){
    var toolCount = 0 ;

    $('#create_rubric').on('click',function () {
        $("#new_rubric_form").show();
        if(toolCount == 0){
            $("#add_tool_link").trigger("click");
        }
    });

    $('#add_tool_link').on('click',function (e) {
        e.preventDefault();
        var ToolList = $("#tool-field-list");
        var newWidget = ToolList.attr('data-prototype');
        newWidget = newWidget.replace(/__name__/g,toolCount);
        var newLi = $('<li class="col-md-12 assessment_tool__name__" style="list-style-type: none; padding:0;margin: 0 -40px"></li>').html(newWidget);
        toolCount++;
        newLi.appendTo(ToolList);
    });

    $('#remove_tool_link').on('click',function (e) {
        if(toolCount>1){
            $("#tool-field-list").find("li[class*=assessment_tool]").last().remove();
            toolCount--;
        }

    });

}