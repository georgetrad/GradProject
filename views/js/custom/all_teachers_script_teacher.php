<script>
$(function(){    
    $('#teachers_table').jtable({
        title: '<?php echo TEACHERS;?>',
        paging: true,                    
        columnResizable: false, //Actually, no need to set true since it's default
        columnSelectable: false, //Actually, no need to set true since it's default
        saveUserPreferences: false, //Actually, no need to set true since it's default
        sorting: true,                    
        selecting: true, //Enable selecting
        multiselect: true, //Allow multiple selecting
        selectingCheckboxes: true, //Show checkboxes on first column
        selectOnRowClick: true, //Enable this to only select using checkboxes
        totalRecordCount: 'RecordCount',
        actions: {
            listAction:   'models/jTableFunctions/list_teacher.php'            
        },
        fields: {
            id: {
                key: true,
                list: false
            },
            name: {
                title: '<?php echo NAME;?>',                            
                width: '23%',                
            },
            dep_name: {
                title: '<?php echo DEP;?>',
                width: '15%',
                edit: false,
                create: false
            },            
            degree: {
                title: '<?php echo DEGREE;?>',
                width: '15%',
                edit: false,
                create: false
            },            
            phone_number: {
                title: '<?php echo PHONE_NUM;?>',
                width: '15%',            
                listClass: 'left_data',
                inputClass: 'left_data'
            },
            email: {
                title: '<?php echo EMAIL;?>',
                width: '45%',            
                listClass: 'left_data',
                inputClass: 'left_data'
            },
            dummyColumn: {              
                visibility: 'hidden',
                edit: false,
                create: false
            }
        }
    }); 
    //Re-load records when user click 'load records' button.
    $('#search_button').click(function (e) {
        e.preventDefault();
        $('#teachers_table').jtable('load', {
            searchText: $('#search_text').val(),
            searchId: $('#search_id').val()
        });
    });

    $('#teachers_table').jtable('load');   
});
</script>