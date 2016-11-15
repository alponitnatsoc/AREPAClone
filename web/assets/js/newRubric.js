function createRubric(){
    var $toolCount = 0 ;
    var $contentCount=new Array();

    $('#create_rubric').on('click',function () {
        $("#new_rubric_form").show();
        if($toolCount == 0){
            $("#add_tool_link").trigger("click");
        }
    });

    RegExp.escape = function(text){
        return text.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&");
    };


    $('#add_tool_link').on('click',function (e) {
        e.preventDefault();
        var ToolList = $("#tool-field-list");
        var newWidget = ToolList.attr('data-prototype');
        var strs =
        newWidget = newWidget.replace(/__name__/g,$toolCount);
        var newLi = $('<tr class="assessment_tool_"'+ $toolCount +'"_"></tr>').html(newWidget);
        $contentCount[$toolCount]=0;
        newLi.appendTo(ToolList);
        $("input[id='new_rubric_outcomeChecked']").prop('checked',false)
        $('input[name="new_rubric[assessmentTool]['+$toolCount+'][contentPercentages]"]').val(100);
        $("#add_content_link_"+$toolCount).on('click',function (e) {
            e.preventDefault();
            var index = $(this).attr('id').split('_')[3];
            var ContentList = $("#content-field-list-"+index);
            var newContentWidget = ContentList.attr('data-prototype');
            var str = "new_rubric_assessmentTool_"+index+"_content_"+index+"_";
            var str2 = "new_rubric_assessmentTool_"+index+'_content_'+$contentCount[index]+'_';
            newContentWidget = newContentWidget.replace(new RegExp(str,"g"),str2);
            var str3 ="[assessmentTool]["+index+"][content]["+index+"][";
            var str4 ="[assessmentTool]["+index+"][content]["+$contentCount[index]+'][';

            newContentWidget = newContentWidget.replace(new RegExp(RegExp.escape(str3),"g"),str4);
            var newDiv = $('<div class="assessment_tool_'+index+'_content_'+$contentCount[index]+'"></div>').html(newContentWidget);
            newDiv.appendTo(ContentList);
            $("input[name='new_rubric[assessmentTool]["+index+"][contentPercentages]']").val(0);
            $("input[id='new_rubric_outcomeChecked']").prop('checked',false)
            $contentCount[index]++;
        });
        $("#remove_content_link_"+$toolCount).on('click',function () {
            $("input[id='new_rubric_outcomeChecked']").prop('checked',false)
            var index = $(this).attr('id').split('_')[3];
            if($contentCount[index]>1){
                $("#content-field-list-"+index).find("div[class*='assessment_tool_"+index+"_content_']").last().remove();
                $contentCount[index]--;
            }else if($contentCount[index]==1){
                $("input[name='new_rubric[assessmentTool]["+index+"][contentPercentages]']").val(100);
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