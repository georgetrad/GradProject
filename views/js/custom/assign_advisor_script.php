<script>    
$(function(){    
    $('#jTable').jtable({
        title: '<?php echo ALL_STUDENTS;?>',
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
            listAction: 'models/jTableFunctions/list_stu_adv.php'                      
        },
        fields: {
            id: {
                key: true,
                list: true,
                title: '<?php echo COLLEGE_ID;?>',
                width: '10%'
            },
            studentName: {
                title: '<?php echo STU_NAME;?>',                            
                width: '15%',
                visibility: 'fixed' //This column always will be shown,                            
            },
            advisorName: {
                title: '<?php echo ADVISOR;?>',
                width: '20%'
            },
            dummyColumn: {
                visibility: 'hidden'
            }
        }
    });
    $('#jTable').jtable('load');        
});

$('#save').click(function (){
    var advisorId = $('#advisor_id').val();

    $('td.jtable-selecting-column input').each(function (i){
        if($(this).prop('checked')){
            var selectedVal = [];            
            selectedVal[i] = $('#jTable tr').find('td').eq(i).text();            
            alert(selectedVal[i]);
        }            
    });
});
</script>