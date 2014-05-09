<script>    
$(function(){
    $('#jTable').jtable({
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
        listAction: 'models/jTableFunctions/list_courses.php'                      
    },
    fields: {
        id: {
            key: true,
            list: true,
            title: '<?php echo COURSE_CODE;?>',
            width: '10%'
        },
        name_ar: {
            title: '<?php echo COURSE_NAME.' ('.ARABIC.')';?>',                            
            width: '10%',
            visibility: 'fixed' //This column always will be shown,                            
        },
        name_er: {
            title: '<?php echo COURSE_NAME.' ('.ENGLISH.')';?>',                            
            width: '10%',
            visibility: 'fixed' //This column always will be shown,                            
        },
        course_type_id: {
            title: '<?php echo COURSE_TYPE;?>',
            width: '10%'
        },
        level: {
            title: '<?php echo LEVEL;?>',
            width: '10%'
        },
        req_course_id: {
            title: '<?php echo REQ_COURSE;?>',
            width: '10%'
        },
        credits: {
            title: '<?php echo CREDITS;?>',
            width: '10%'
        },
        class_hours: {
            title: '<?php echo CLASS_HRS;?>',
            width: '10%'                         
        },
        lab_hours: {
            title: '<?php echo LAB_HRS;?>',
            width: '10%'                     
        },
        fees: {
            title: '<?php echo FEES;?>',
            width: '10%'                   
        },
        added: {
            visibility: 'visible',
            display: function (data) {
                return '<a class="add" id="<?php echo COURSE_CODE;?>">Add</a>';                    
            }
        }        
    }
    });
    
    //Re-load records when user click 'load records' button.
    $('#search_button').click(function (e) {
        e.preventDefault();
        $('#jTable').jtable('load', {
            searchText: $('#search_text').val(),
            searchId: $('#search_id').val()
        });
    });

    $('#jTable').jtable('load');
    
    $('#jTable').jtable('load', undefined, function(){        
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
