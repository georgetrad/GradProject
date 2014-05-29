<script>    
$(function(){    
    $('#jTable').jtable({        
        title: '<?php echo SEMESTERS;?>',
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
            listAction: 'models/jTableFunctions/list_semester.php',
            createAction: 'models/jTableFunctions/create_semester.php',
            updateAction: 'models/jTableFunctions/update_semester.php'    
        },
        fields: {
            id: {
                key: true,
                list: true,           
                visibility: 'hidden'
            },
            name: {
                title: '<?php echo NAME;?>',                            
                width: '10%',
                visibility: 'fixed'                
            },
            start_date: {
                title: '<?php echo START_DATE;?>',
                width: '10%',
                type: 'date',
                listClass: 'left_data'
            },
            end_date: {
                title: '<?php echo END_DATE;?>',
                width: '10%',
                type: 'date',
                listClass: 'left_data'
            },
            min_req_hrs: {
                title: '<?php echo MIN_REQ_HRS;?>',
                width: '10%',
                listClass: 'left_data'
            },
            max_req_hrs: {
                title: '<?php echo MAX_REQ_HRS;?>',
                width: '10%',
                listClass: 'left_data'
            },
            exc_gpa: {
                title: '<?php echo EXC_GPA;?>',
                width: '10%',
                listClass: 'left_data'
            },
            exc_gpa_hrs: {
                title: '<?php echo EXC_GPA_HRS;?>',
                width: '10%',
                listClass: 'left_data'
            },
            max_grad_stu_hrs: {
                title: '<?php echo MAX_GRAD_STU_HRS;?>',
                width: '10%',
                listClass: 'left_data'
            },
            dummyColumn: {              
                visibility: 'hidden',
                edit: false,
                create: false
            }        
        }
    });
    $('#jTable').jtable('load');
});
</script>