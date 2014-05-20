<script>
$(function(){    
    $('#jTable').jtable({
        title: '<?php echo ALL_STUDENTS;?>',
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
            listAction: 'models/jTableFunctions/list_student.php'                      
        },
        fields: {
            id: {
                key: true,
                list: true,
                title: '<?php echo COLLEGE_ID;?>',
                width: '15%'
            },
            name: {
                title: '<?php echo NAME;?>',                            
                width: '15%',
                visibility: 'fixed' //This column always will be shown,                            
            },            
            gender: {
                title: '<?php echo GENDER;?>',
                width: '15%'                            
            },
            birth_date: {
                title: '<?php echo BIRTH_DATE;?>',
                width: '15%'                            
            },
            dummyColumn: {
                visibility: 'hidden'
            }        
        }
    });            

    $('#jTable').jtable('load');   
});
</script>