<script>
    var options = {            
        lines: 13, // The number of lines to draw
        length: 6, // The length of each line
        width: 2, // The line thickness
        radius: 6, // The radius of the inner circle
        corners: 1, // Corner roundness (0..1)
        rotate: 0, // The rotation offset
        direction: 1, // 1: clockwise, -1: counterclockwise
        color: '#000', // #rgb or #rrggbb or array of colors
        speed: 1, // Rounds per second
        trail: 60, // Afterglow percentage
        shadow: false, // Whether to render a shadow
        hwaccel: false, // Whether to use hardware acceleration
        className: 'spinner', // The CSS class to assign to the spinner
        zIndex: 2e9, // The z-index (defaults to 2000000000)
        top: '35%', // Top position relative to parent
        left: '5%' // Left position relative to parent
    };
    
    function assign(advisorId, selectedStudents){                
        var target = document.getElementById('spinner');
        var spinner = new Spinner(options);
        spinner.spin(target);        
        $.post( "models/functions/_global_ajax.php", {case:'updateAdvisor', advisorId: advisorId, selectedStudents: selectedStudents },function(data) {       
            $('#jTable').jtable('load');
            spinner.stop(target);
        });
    }
        
    $(function(){
        $("#search_text").keypress(function(key) {
            if (key.which === 13)
            $('#search_button').click();
        });
        
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
                    width: '15%',
                    listClass: 'left_data'
                },
                studentName: {
                    title: '<?php echo STU_NAME;?>',                            
                    width: '30%',
                    visibility: 'fixed' //This column always will be shown,                            
                },
                dep_name: {
                    title: '<?php echo DEP;?>',                            
                    width: '20%',
                    visibility: 'fixed' //This column always will be shown,                            
                },
                current_level: {
                    title: '<?php echo LEVEL;?>',                            
                    width: '15%',
                    visibility: 'fixed',
                    listClass: 'center_data'
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
        
        $('#search_button').click(function (e) {
            e.preventDefault();
            $('#jTable').jtable('load', {
                searchText: $('#search_text').val(),
                searchId: $('#search_id').val(),
                depSearchId: $('input[name=dep]:checked').val()
            });
        });
    });

    $('#save').click(function (){
        var advisorId = $('#advisor_id').val();
        var selectedStudents = [];
        $('td.jtable-selecting-column input').each(function(){
            if($(this).prop('checked')){
                var t = $(this).parents().parents().data('record-key');            
                selectedStudents.push(t);
            } 
        });
        assign(advisorId, selectedStudents);
    });   
</script>
