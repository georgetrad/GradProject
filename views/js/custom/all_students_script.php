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
            listAction: 'models/jTableFunctions/list_student.php',
            updateAction: 'models/jTableFunctions/update_stu_status.php',
        },
        fields: {
            id: {
                key: true,
                list: true,
                title: '<?php echo COLLEGE_ID;?>',
                width: '15%',
                edit:false,
                listClass: 'left_data'
            },
            name: {
                title: '<?php echo NAME;?>',                            
                width: '15%',
                visibility: 'fixed',
                edit:false
            },            
            status: {
                visibility: 'hidden',    
                title: '<?php echo STATUS;?>',
                width: '15%',
                edit:true
            },
            birth_date: {
                title: '<?php echo BIRTH_DATE;?>',
                width: '15%',
                edit:false                            
            },
            dummyColumn: {
                visibility: 'hidden',
                edit:false
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
    // to top 
    /* set variables locally for increased performance */
    var scroll_timer;
    var displayed = false;
    var $message = $('#message a');
    var $window = $(window);
    var top = $(document.body).children(0).position().top;

    /* react to scroll event on window */
    $window.scroll(function () {
        window.clearTimeout(scroll_timer);
        scroll_timer = window.setTimeout(function () {
            if($window.scrollTop() <= top)
            {
                displayed = false;
                $message.fadeOut(500);
            }
            else if(displayed == false)
            {
                displayed = true;
                $message.stop(true, true).show().click(function () { $message.fadeOut(500); });
            }
        }, 100);
    });
});
</script>