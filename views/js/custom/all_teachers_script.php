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
        listAction: 'models/jTableFunctions/list_teacher.php'                      
    },
    fields: {
        id: {
            key: true,
            list: false
        },
        name: {
            title: '<?php echo NAME;?>',                            
            width: '15%',
            visibility: 'fixed' //This column always will be shown,                            
        },
        dep_name: {
            title: '<?php echo DEP;?>',
            width: '20%'                            
        },
        degree: {
            title: '<?php echo DEGREE;?>',
            width: '18%'                            
        },
        phone_number: {
            title: '<?php echo PHONE_NUM;?>',
            width: '20%',            
            listClass: 'left_data'
        },
        dummyColumn: {
            visibility: 'hidden'
        }        
    }
    }); 
    //Re-load records when user click 'load records' button.
    $('#search_button').click(function (e) {
        e.preventDefault();
        $('#jTable').jtable('load', {
            searchText: $('#search_text').val(),
            searchId: $('#search_id').val()
        });
    });

    $('#jTable').jtable('load');

    $('#jTable').jtable('load', undefined, function(){
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