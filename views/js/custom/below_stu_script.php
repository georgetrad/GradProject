<script>    
    $(function(){
        $('#below_stu_Table').jtable({
            title: '<?php echo STUDENTS;?>',
            paging: true,                    
            columnResizable: false, //Actually, no need to set true since it's default
            columnSelectable: false, //Actually, no need to set true since it's default
            saveUserPreferences: false, //Actually, no need to set true since it's default
            sorting: true,                    
            selecting: false, //Enable selecting
            multiselect: false, //Allow multiple selecting
            selectingCheckboxes: false, //Show checkboxes on first column
            selectOnRowClick: false, //Enable this to only select using checkboxes
            totalRecordCount: 'RecordCount',
            actions: {
                listAction: 'models/jTableFunctions/list_below_stu.php'                      
            },
            fields: {
                id: {
                    key: true,
                    list: true,
                    title: '<?php echo COLLEGE_ID;?>',
                    width: '10%'
                },
                name: {
                    title: '<?php echo NAME;?>',                            
                    width: '20%',
                    visibility: 'fixed' //This column always will be shown,                            
                },
                depName: {
                    title: '<?php echo DEP;?>',                            
                    width: '15%',
                    visibility: 'fixed' //This column always will be shown,                            
                },
                level: {
                    title: '<?php echo LEVEL;?>',
                    width: '6%'
                },
                hours: {
                    title: '<?php echo COMPLETED_HRS;?>',
                width: '15%'
                },
                num_of_crs: {
                    title: '<?php echo NUM_OF_CRS;?>',
                    width: '20%'
                }, 
               hrs: {
                    title: '<?php echo SUGG_HRS;?>',
                    width: '14%'
                },
                dummyColumns: {
                    visibility: 'hidden'            
                }            
            }
        });        

        $('#below_stu_Table').jtable('load');        
    });
</script>
