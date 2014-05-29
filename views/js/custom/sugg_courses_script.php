<script>
    $(function(){
        $('#sugg_courses_Table').jtable({
            title: '<?php echo SUGGESTED_COURSES;?>',
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
                    width: '15%',
                    listClass: 'left_data'
                },
                name_ar: {
                    title: '<?php echo COURSE_NAME.' ('.ARABIC.')';?>',                            
                    width: '15%',
                    visibility: 'fixed'
                },                
                course_type_id: {
                    title: '<?php echo COURSE_TYPE;?>',
                    width: '15%'
                },
                level: {
                    title: '<?php echo LEVEL;?>',
                    width: '15%',
                    listClass: 'left_data'
                },
                req_course_id: {
                    title: '<?php echo REQ_COURSE;?>',
                    width: '15%',
                    listClass: 'left_data'
                }, 
               credits: {
                    title: '<?php echo CREDITS;?>',
                    width: '15%',
                    listClass: 'left_data'
                },
                dummyColumns: {
                    visibility: 'hidden'            
                }            
            }
        });        

        $('#sugg_courses_Table').jtable('load');
        //getSuggCourse();
    });
</script>
