<script>
$(function(){    
    $('#jTable').jtable({
        title: '<?php echo GRADES;?>',
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
        actions: {
            listAction: 'models/jTableFunctions/list_grades_dist.php',
            createAction: 'models/jTableFunctions/create_grades_dist.php',
            updateAction: 'models/jTableFunctions/update_grades_dist.php'  
        },
        fields: {
            id: {
                key: true,
                list: false
            },
            grade_from_up: {
                title: '<?php echo GRADE_FROM;?>',                            
                width: '30%',
                visibility: 'fixed',
                listClass: 'left_data'
            },
            applies_to: {
                title: '<?php echo APPLIES_TO;?>',
                width: '30%',
                type: 'year',
                listClass: 'left_data'
            },
            points: {
                title: '<?php echo POINTS;?>',
                width: '30%',
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