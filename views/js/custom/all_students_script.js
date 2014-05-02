$(function(){    
    $('#jTable').jtable({
    title: 'جدول الطلاب',
    paging: true,                    
    columnResizable: true, //Actually, no need to set true since it's default
    columnSelectable: true, //Actually, no need to set true since it's default
    saveUserPreferences: false, //Actually, no need to set true since it's default
    sorting: true,                    
    selecting: false, //Enable selecting
    multiselect: true, //Allow multiple selecting
    selectingCheckboxes: true, //Show checkboxes on first column
    selectOnRowClick: true, //Enable this to only select using checkboxes
    totalRecordCount: 'RecordCount',
    actions: {
        listAction: 'models/jTableFunctions/list_student.php',
        //createAction: 'GettingStarted/CreatePerson.php',
        updateAction: 'GettingStarted/UpdatePerson.php',
        deleteAction: 'GettingStarted/DeletePerson.php',                        
    },
    fields: {
        id: {
            key: true,
            list: true,
            title: 'الرقم الجامعي',
            width: '25%'
        },
        first_name: {
            title: 'الاسم',                            
            width: '25%',
            visibility: 'fixed' //This column always will be shown,                            
        },
        middle_name: {
            title: 'اسم الأب',
            width: '25%'
        },
        last_name: {
            title: 'النسبة',
            width: '25%'                            
        },
        TestColumn: {
            sorting: false,
            display: function (data) {
                return '<a class="add">Add</a>';                    
            }
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


