//GLOBALS
var $toolCount = 0,//variable for assessment tools count
    $contentCount = new Array(),//array for assessment contents count
    $outcomes = new Array(),//array for outcomes values
    $outcomeCount =0;//variable for outomes count
var $eMTP = $("#evaluation_model_assessmentPercentage"),//entity model total percentage selector
    $aATL = $('#add_tool_link'),//add assessment tool button selector,
    $rATL = $('#remove_tool_link'),//remove assessment tool button selector
    $eATP = $("input[name^='evaluation_model[assessmentTools]['][name$='][percentage]']").not($("input[name*='][content][']")),//each assessment tool Percentage selector
    $aTTCP = $("input[name='evaluation_model[assessmentTools]["+$toolCount+"][contentPercentages]']"),//assessment tool content total percentage
    $1=0;

//set total evaluation model percentage
function setTotalAssessmentToolPercentage()
{
    var totalPercentage = parseInt(0,10);
    $("input[name^='evaluation_model[assessmentTools]['][name$='][percentage]']").not($("input[name*='][content][']")).each(function () {
        if(!isNaN(parseInt($(this).val(),10))) {
            $(this).validate();
            totalPercentage += parseInt($(this).val(), 10);
        }
    });
    $("#evaluation_model_assessmentPercentage").val(totalPercentage);

}

function validateOutcomes()
{
    $response = new Array();
    for(var i = 0; i< $outcomes.length; i++) { $response[i]=0;}
    $("input[name^='evaluation_model[assessmentTools]['][name$='][outcomes][]']").each(function (index, elem) {
        for(var i = 0; i< $outcomes.length; i++) {
            if ($outcomes[i] === $(this).val() && $(this).prop('checked') === true)
                $response[i] += 1;
        }
    });
    for (var i = 0; i< $outcomes.length; i++){
        if($response[i]==0){
            $("input[name='evaluation_model[outcomeChecked]']").prop('checked',false);
            return false;
        }

    }
    if($("#evaluation_model_assessmentPercentage").val()!=100){
        $("input[name='evaluation_model[outcomeChecked]']").prop('checked',false);
        return false;
    }
    $("input[name^='evaluation_model[assessmentTools]['][name$='][contentPercentages]']").each(function (index, elem) {
        if($(this).val()!=100){
            $("input[name='evaluation_model[outcomeChecked]']").prop('checked',false);
            return false;
        }
    });
    if(!$('form[name="evaluation_model"]').valid()){
        $("input[name='evaluation_model[outcomeChecked]']").prop('checked',false);
        return false;
    }
    $("input[name='evaluation_model[outcomeChecked]']").prop('checked',true);
    return true;
}

function setContentsPercentageValue($index)
{
    var $contentVal = parseInt(0,10);
    $("input[name^='evaluation_model[assessmentTools]["+$index+"][content]['][name$='][percentage]']").each(function (index, elem) {
        if(!isNaN(parseInt($(this).val(),10))){
            $(this).validate();
            $contentVal += parseInt($(this).val(),10);
        }
    });
    $("input[name='evaluation_model[assessmentTools]["+$index+"][contentPercentages]']").val($contentVal);
}


function checkOutcomeBox2($outcomes,index)
{
    $response = new Array();
    for (var i = 0; i< $outcomes.length; i++){
        $response[$outcomes[i]]=0;
    }
    $("input[name^='evaluation_model[assessmentTools]["+index+"'][name$='][outcomes][]']").each(function (index, elem) {
        for (var i = 0; i< $outcomes.length; i++){
            if($outcomes[i]==$(this).val() && $(this).prop('checked')==true){
                $response[$outcomes[i]]+=1;
            }
        }
    });
    return $response;
}

function createRubric(){

    //ON LOAD DISABLE TOTAL PERCENTAGE
    $eMTP.parent().append('<label id="'+$eMTP.attr('id')+'-error" class="error" for="'+$eMTP.attr('id')+'"></label>');
    $eMTP.attr('disabled',true);
    RegExp.escape = function(text){
        return text.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&");
    };

    $("button[id^='add_content_link_']").each(function (index, elem) {
        var index = $(this).attr('id').split('_')[3];
        $(this).on('click',function () {
           alert(index);
        });
    });

    //ON ADD ASSESSMENT TOOL CLICK
    $aATL.on('click',function (e) {
        e.preventDefault();
        var ToolList = $("#tool-field-list");//listing container
        var newWidget = ToolList.attr('data-prototype');//getting the prototype
        var strs = newWidget = newWidget.replace(/__name__/g, $toolCount);//replacing __name__
        var newLi = $('<tr class="assessment_tool_' + $toolCount + '_"></tr>').html(newWidget);//creating new list item
        $contentCount[$toolCount] = 0;//initializing contentCount for the actual AssessmentTool
        newLi.appendTo(ToolList);//adding the prototype to the list item

        //ON ADD CONTENT CLICK
        $("#add_content_link_" + $toolCount).on('click', function (e) {
            var index = $(this).attr('id').split('_')[3];
            // console.log(index);
            e.preventDefault();

            var ContentList = $("#content-field-list-" + index);//listing contents container
            var newContentWidget = ContentList.attr('data-prototype');//getting content prototype
            var str = "evaluation_model_assessmentTools_" + index + "_content_" + index + "_";//replacin all __name__
            var str2 = "evaluation_model_assessmentTools_" + index + '_content_' + $contentCount[index] + '_';//creating comparison string
            newContentWidget = newContentWidget.replace(new RegExp(str, "g"), str2); //replacing content to match names
            var str3 = "[assessmentTools][" + index + "][content][" + index + "][";//creating second comparison strings
            var str4 = "[assessmentTools][" + index + "][content][" + $contentCount[index] + '][';//creating second comparison strings
            newContentWidget = newContentWidget.replace(new RegExp(RegExp.escape(str3), "g"), str4);//final content form
            var newDiv = $('<tr class="assessment_tool_' + index + '_content_' + $contentCount[index] + '"></tr>').html(newContentWidget);//creating new list content item
            newDiv.appendTo(ContentList);//adding content to the list container

            //CREATING ERROR LABEL FOR TOTAL PERCENTAGE
            var $CTP =$("input[name='evaluation_model[assessmentTools]["+index+"][contentPercentages]']");
            $CTP.parent().append('<label id="'+$CTP.attr('id')+'-error" class="error" for="'+$CTP.attr('id')+'"></label>');
            //SHOWING CONTENT TABLE FOR THE ASSESMENT TOOL AND SETTING PERCENTAGE TO 0
            if ($contentCount[index] == 0) {
                $("input[name='evaluation_model[assessmentTools]["+index+"][contentPercentages]']").val(parseInt(0))//ON NEW ASSESSMENT CONTENT SET CONTENTS TOTAL PERCENTAGE TO 0%
                $("#content-field-list-table-" + index).show();
            }
            //ON CONTENT PERCENTAGE CHANGE
            $("input[name='evaluation_model[assessmentTools]["+index+"][content]["+$contentCount[index]+"][percentage]']").on('change',function () {
                setContentsPercentageValue(index);
            });
            $("input[name='evaluation_model[assessmentTools]["+index+"][content]["+$contentCount[index]+"][outcomes][]']").on('change',function () {
                elemCh = $(this);
                $("input[name^='evaluation_model[assessmentTools]["+index+"][outcomes][]']").each(function () {
                    if($(this).prop('checked')==false && elemCh.prop('checked') && parseInt(elemCh.val())==parseInt($(this).val()))
                        $(this).prop('checked',true);
                    if(parseInt(elemCh.val())==parseInt($(this).val()) && elemCh.prop('checked')!= $(this).prop('checked')){
                        console.log(checkOutcomeBox2($outcomes,index)[elemCh.val()]);
                        if(checkOutcomeBox2($outcomes,index)[elemCh.val()]<2){
                            $(this).prop('checked',elemCh.prop('checked'));
                        }
                    }
                });
                validateOutcomes();
            });
            $("input[name='evaluation_model[assessmentTools]["+index+"][outcomes][]']").each(function (index2, elem) {
                elemv = $(this);
                $("input[name^='evaluation_model[assessmentTools]["+index+"][content]['][name$='][outcomes][]']").each(function (index, elem) {
                    if($(this).val()==elemv.val() && elemv.prop('checked'))
                        $(this).prop('checked',true);
                });
            });
            $contentCount[index]++;
        });
        $("#remove_content_link_" + $toolCount).on('click', function () {
            var index = $(this).attr('id').split('_')[3];
            if ($contentCount[index] > 1) {
                $("#content-field-list-" + index).find("tr[class*='assessment_tool_" + index + "_content_']").last().remove();
                $contentCount[index]--;
                validateOutcomes();
                setContentsPercentageValue(index);
            } else if ($contentCount[index] == 1) {
                $("#content-field-list-" + index).find("tr[class*='assessment_tool_" + index + "_content_']").last().remove();
                $("#content-field-list-table-" + index).hide();
                validateOutcomes();
                if(setContentsPercentageValue(index) == 0){
                    $("input[name='evaluation_model[assessmentTools][" + index + "][contentPercentages]']").val(parseInt(100,10));
                }
                $contentCount[index]--;
            }
        });

        $("input[name='evaluation_model[assessmentTools]["+$toolCount+"][outcomes][]']").on('change',function () {
            var index = $(this).attr('id').split('_')[3];
            elemv = $(this);
            $("input[name^='evaluation_model[assessmentTools]["+index+"][content]['][name$='][outcomes][]']").each(function (index, elem) {
                if(elemv.prop('checked')!=true && $(this).val()==elemv.val())
                    $(this).prop('checked',false);
                else if(elemv.prop('checked')==true && $(this).val()==elemv.val())
                    $(this).prop('checked',true);
            });
            validateOutcomes();
        });

        $("input[name='evaluation_model[assessmentTools]["+$toolCount+"][contentPercentages]']").val(parseInt(100,10));//ON NEW ASSESSMENT TOOL SET aTTCP 100%
        // $("input[name='evaluation_model[assessmentTools]["+$toolCount+"][contentPercentages]']").attr('disabled',true);//ON NEW ASSESSMENT TOOL DISABLE TOTAL CONTENT PERCENTAGE
        //ON ASSESSMENT TOOL PERCENTAGE CHANGE CALCULATE TOTAL PERCENTAGE
        $("input[name^='evaluation_model[assessmentTools]["+$toolCount+"][percentage]']").on('change',function(){
            setTotalAssessmentToolPercentage();
        });

        $toolCount++;

    });

    //ON REMOVE CLICK EVENT
    $rATL.on('click',function () {
        if($toolCount>1){//If at least one assessment tool
            $("#tool-field-list").find("tr[class='assessment_tool_"+($toolCount-1)+"_']").first().remove();
            $toolCount--;
            setTotalAssessmentToolPercentage();
            validateOutcomes();
        }
    });


    //IF NO ASSESSMENT TOOLS ADDING ONE BY DEFAULT
    if($toolCount == 0){
        $("#add_tool_link").trigger("click");
        $("input[name^='evaluation_model[assessmentTools][0][outcomes]").each(function (index, elem) {
            exist = false;
            for( var i = 0; i< $outcomeCount; i++){
                if($outcomes[i]==$(this).val())
                    exist = true;
            }
            if(!exist){
                $outcomes[$outcomeCount] = $(this).val();
                $outcomeCount++;
            }
        });
    }
    //
    $("input[name='evaluation_model[outcomeChecked]']").on('change',function () {
        if(!validateOutcomes()){
            $(this).prop('checked',false);
        }

    });
}