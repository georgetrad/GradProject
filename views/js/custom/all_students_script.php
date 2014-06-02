<script>
function getGraduationStudents(){
    $.post('models/functions/_global_ajax.php', {case: 'getGraduationStudents'}, function(data){
            $.each(data, function(key, value) {
                $('*[data-record-key="'+value[0]+'"]').css( "background-color", "mistyrose");
            });    
        },"json");
}    
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
        recordsLoaded: function (event, data) { 
            getGraduationStudents();
        },
        fields: {
            id: {
                key: true,
                list: true,
                title: '<?php echo COLLEGE_ID;?>',
                width: '17%',
                edit:false,
                listClass: 'left_data'
            },
            name: {
                title: '<?php echo NAME;?>',                            
                width: '30%',
                visibility: 'fixed',
                edit:false
            },
            dep_name: {
                title: '<?php echo DEP;?>',                            
                width: '20%',
                visibility: 'fixed',
                edit:false
            },
            status: {
                visibility: 'hidden',
                title: '<?php echo STATUS;?>',                
                edit:true,
                options: { 'G': '<?php echo GRADUATED;?>', 'A': '<?php echo ACTIVE;?>' }
            },
            level: {
                title: '<?php echo LEVEL;?>',
                width: '11%',
                edit:false,
                listClass: 'left_data'
            },
            hrs: {
                title: '<?php echo COMPLETED_HRS;?>',
                width: '20%',
                edit:false,
                listClass: 'left_data'
            },
            link: {
                visibility: 'visible',
                width: '4%',
                display: function (data) {
                    return '<a href="views/scripts/dean/advise.php?studentId='+data.record.id+'"'+'>View</a>';                    
                }
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
    //header freeze
    $('.jtable').stickyTableHeaders();
});
</script>
