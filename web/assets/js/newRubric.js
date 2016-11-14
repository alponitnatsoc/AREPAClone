function createRubric(){
    var $toolCount = 0 ;
    var $contentCount=new Array();

    $('#create_rubric').on('click',function () {
        $("#new_rubric_form").show();
        if($toolCount == 0){
            $("#add_tool_link").trigger("click");
        }
    });

    $('#add_tool_link').on('click',function (e) {
        e.preventDefault();
        var ToolList = $("#tool-field-list");
        var newWidget = ToolList.attr('data-prototype');
        newWidget = newWidget.replace(/__name__/g,$toolCount);
        var newLi = $('<tr class="assessment_tool_"+$toolCount+"_"></tr>').html(newWidget);
        $contentCount[$toolCount]=0;
        newLi.appendTo(ToolList);
        $("#add_content_link_"+$toolCount).on('click',function (e) {
            e.preventDefault();
            var index = $(this).attr('id').split('_')[3];
            var ContentList = $("#content-field-list-"+index);
            var newContentWidget = ContentList.attr('data-prototype');
            var $str = index+'_content_'+index+'_';
            newContentWidget = newContentWidget.replace(/$str/g,index+'_content_'+$contentCount[index]+'_');
            var newDiv = $('<div class="assessment_tool_'+index+'_content_'+$contentCount[index]+'"></div>').html(newContentWidget);
            newDiv.appendTo(ContentList);
            $contentCount[index]++;
        });
        $("#remove_content_link_"+$toolCount).on('click',function () {
            var index = $(this).attr('id').split('_')[3];
            if($contentCount[index]>0){
                $("#content-field-list-"+index).find("div[class*='assessment_tool_"+index+"_content_']").last().remove();
                $contentCount[index]--;
            }
        });
        $toolCount++;
    });

    $('#remove_tool_link').on('click',function () {
        if($toolCount>1){
            $("#tool-field-list").find("tr[class*=assessment_tool]").last().remove();
            $toolCount--;
        }

    });



}