<script>
    $('#sugg').click(function (){
        $('#sugg_courses_Table').jtable('load');
        getSuggCoursesNum();
    });
    
    $(function(){        
        $('#all_courses_Table').jtable({
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
            $('#all_courses_Table').jtable('load', {
                searchText: $('#search_text').val(),
                searchId: $('#search_id').val()
            });            
        });

        $('#all_courses_Table').jtable('load');
        getSuggCoursesNum();                
    });       
    
    function getSuggCoursesNum(){
        $.post('models/functions/_global_db.php', {case: 'getSuggCoursesNum'}, function(data){
            $('#counter').html(' ('+data+')');
        });
    }
</script>
