<script>   
$(function(){
    $('#sugg_courses_Table').jtable({
    title: '<?php echo COURSES;?>',
    paging: false,                    
    columnResizable: false, //Actually, no need to set true since it's default
    columnSelectable: false, //Actually, no need to set true since it's default
    saveUserPreferences: false, //Actually, no need to set true since it's default
    sorting: true,                    
    selecting: false, //Enable selecting
    multiselect: false, //Allow multiple selecting
    selectingCheckboxes: false, //Show checkboxes on first column
    selectOnRowClick: true, //Enable this to only select using checkboxes
    totalRecordCount: 'RecordCount',
    actions: {
        listAction: 'models/jTableFunctions/list_sugg_courses.php'                      
    },
    fields: {
        id: {
            key: true,
            list: true,
            title: '<?php echo COURSE_CODE;?>',
            width: '15%'
        },
        name_ar: {
            title: '<?php echo COURSE_NAME.' ('.ARABIC.')';?>',                            
            width: '15%',
            visibility: 'fixed' //This column always will be shown,                            
        },
        name_er: {
            title: '<?php echo COURSE_NAME.' ('.ENGLISH.')';?>',                            
            width: '15%',
            visibility: 'fixed' //This column always will be shown,                            
        },
        course_type_id: {
            title: '<?php echo COURSE_TYPE;?>',
            width: '15%'
        },
        level: {
            title: '<?php echo LEVEL;?>',
            width: '15%'
        },
        req_course_id: {
            title: '<?php echo REQ_COURSE;?>',
            width: '15%'
        },
        credits: {
            title: '<?php echo CREDITS;?>',
            width: '15%'
        },
        dummyColumns: {
            visibility: 'hidden'            
        }            
    }
    });        

    $('#sugg_courses_Table').jtable('load');
    
    $('#sugg_courses_Table').jtable('load', undefined, function(){        
       $('.add').bind( "click", function() {
           var courseCode = $(this).parents("tr").find("td:first").text();
                     
            if($(this).text() === 'Add'){
                var action = 'add';
                $(this).text('Remove');
                $(this).css('color','red');
            }
            else{
                action = 'remove';
                $(this).text('Add');
                $(this).css('color','green');
            }
            $.post('models/functions/add_course.php', {action: action, courseCode: courseCode}, function(data){                
            });
            
        });    
    });
    $.post('models/functions/sugg_function.php','', function(data){
        var i = 0;
        for (i=0;i<data.length;i++){
//            alert(data[i]['COURSE_ID']);
            $('*[data-record-key="'+data[i]['COURSE_ID']+'"]').find("td:last").text('Remove').css('color','red').bind( "click", function() {
           var courseCode = $(this).parents("tr").find("td:first").text();
                     
            if($(this).text() === 'Add'){
                var action = 'add';
                $(this).text('Remove');
                $(this).css('color','red');
            }
            else{
                action = 'remove';
                $(this).text('Add');
                $(this).css('color','green');
            }
            $.post('models/functions/add_course.php', {action: action, courseCode: courseCode}, function(data){                
            });
            
        });   
        }
    }, "json");
});
</script>
