<script>
$(function(){    
    $('#teachers_table').jtable({
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
            listAction:   'models/jTableFunctions/list_teacher.php',
            updateAction: 'models/jTableFunctions/update_teacher.php',
            deleteAction: 'models/jTableFunctions/delete_teacher.php',
            createAction: 'models/jTableFunctions/create_teacher.php'
        },
        fields: {
            id: {
                key: true,
                list: false
            },
            name: {
                title: '<?php echo NAME;?>',                            
                width: '15%',
                edit: false,
                create: false
            },
            first_name: {
                list: false,
                edit: false,
                title: '<?php echo NAME;?>',            
                input: function () {                
                    return '<input type="text" name="first_name" style="width:200px" value="<?=NAME?>" />';                
                }
            },
            middle_name: {
                list: false,
                edit: false,
                title: '<?php echo MIDDLE_NAME;?>',            
                input: function () {                
                    return '<input type="text" name="middle_name" style="width:200px" value="<?=MIDDLE_NAME?>" />';                
                }
            },
            last_name: {
                list: false,
                edit: false,
                title: '<?php echo LAST_NAME;?>',            
                input: function () {                
                    return '<input type="text" name="last_name" style="width:200px" value="<?=LAST_NAME?>" />';                
                }
            },
            dep_name: {
                title: '<?php echo DEP;?>',
                width: '20%',
                edit: false,
                create: false
            },
            dep: {
                title: '<?php echo DEP;?>',            
                list: false,
                options: { '1': '<?php echo ICT;?>', '2': '<?php echo ARC;?>' }
            },
            degree: {
                title: '<?php echo DEGREE;?>',
                width: '18%',
                edit: false,
                create: false
            },
            deg: {
                title: '<?php echo DEGREE;?>',            
                list: false,
                options: { 'P': '<?php echo DOCTOR;?>', 'E': '<?php echo ENGINEER;?>' }
            },
            phone_number: {
                title: '<?php echo PHONE_NUM;?>',
                width: '15%',            
                listClass: 'left_data',
                inputClass: 'left_data'
            },
            email: {
                title: '<?php echo EMAIL;?>',
                width: '25%',            
                listClass: 'left_data',
                inputClass: 'left_data'
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

    $('#teachers_table').jtable('load', undefined, function(){
       $('.add').bind( "click", function() {
            if($(this).text() === 'Add'){
                $(this).text('Remove');
                $(this).css('color','red');
            }
            else{        
                $(this).text('Add');
                $(this).css('color','green');
            }
        });    
    });
});
</script>