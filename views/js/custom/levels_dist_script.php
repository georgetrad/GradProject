<script>
$(function(){    
    $('#jTable').jtable({
        title: '<?php echo LEVELS_DIST;?>',
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
            listAction: 'models/jTableFunctions/list_levels_dist.php',            
            updateAction: 'models/jTableFunctions/update_levels_dist.php'  
        },
        fields: {
            id: {
                key: true,
                list: false
            },
            name: {
                title: '<?php echo LEVEL;?>',                            
                width: '30%',
                visibility: 'fixed',
                edit: false
            },
            value: {
                title: '<?php echo NUM_COMP_HRS;?>',
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