<script>    
    $(function(){    
        $('#my_grades_table').jtable({        
            title: '<?php echo MY_GRADES;?>',
            paging: true,                    
            columnResizable: false, //Actually, no need to set true since it's default
            columnSelectable: false, //Actually, no need to set true since it's default
            saveUserPreferences: false, //Actually, no need to set true since it's default
            sorting: true,                    
            selecting: false, //Enable selecting
            multiselect: false, //Allow multiple selecting
            selectingCheckboxes: false, //Show checkboxes on first column
            selectOnRowClick: true, //Enable this to only select using checkboxes
            totalRecordCount: 'RecordCount',
            resizable:false,
            actions: {
                listAction: 'models/jTableFunctions/list_my_grades.php'            
            },
            fields: {
                course_id: {
                    key: true,
                    title: '<?php echo COURSE_CODE;?>',
                    width: '15%',
                    listClass: 'left_data'                
                },
                course_name: {
                    title: '<?php echo COURSE_NAME;?>',                            
                    width: '36%'                    
                },
                course_level: {
                    title: '<?php echo LEVEL;?>',                            
                    width: '10%',
                    listClass: 'center_data'
                },
                credits: {
                    title: '<?php echo CREDITS;?>',
                    width: '10%',                    
                    listClass: 'center_data'
                },
                grade: {
                    title: '<?php echo FINAL_GRADE;?>',
                    width: '10%',                    
                    listClass: 'center_data'
                },
                point: {
                    title: '<?php echo POINTS;?>',
                    width: '10%',
                    listClass: 'center_data'
                },
                letter_grade: {
                    title: '<?php echo LETTER;?>',
                    width: '15%',
                    listClass: 'left_data'
                },
                dummyColumn: {              
                    visibility: 'hidden',
                    edit: false,
                    create: false
                }        
            }
        });
        $('#my_grades_table').jtable('load');
    });
</script>