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
            top: '50%', // Top position relative to parent
            left: '53%' // Left position relative to parent
        };
    //****************On Page Load *****************************
    $(function(){
        $('input').focus(function (){
            $(this).attr("placeholder", "");
            $(this).css("direction", "ltr"); 
        });
        $('#search_button').click(function (){
            var stuId = $('#search_text').val();
            if (stuId === ''){
                $('#wrong').css('visibility', 'visible');
                $('#wrong').html('<?php echo ENTER_STU_ID;?>');
            }
            getStuData(stuId);
        });        
    });
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
                listAction: 'models/jTableFunctions/list_student.php'                      
            },
            fields: {
                id: {
                    key: true,
                    list: true,
                    title: '<?php echo COLLEGE_ID;?>',
                    width: '15%'
                },
                name: {
                    title: '<?php echo NAME;?>',                            
                    width: '15%',
                    visibility: 'fixed' //This column always will be shown,                            
                },            
                gender: {
                    title: '<?php echo GENDER;?>',
                    width: '15%'                            
                },
                birth_date: {
                    title: '<?php echo BIRTH_DATE;?>',
                    width: '15%'                            
                },
                dummyColumn: {
                    visibility: 'hidden'
                }        
            }
        });
        $('#jTable').jtable('load');   
    });
    
    function getStuData(id){
        var target = document.getElementById('spinner');
        var spinner = new Spinner(options);
        
        $.post('models/functions/_global_ajax.php', {case:'getStuData', id: id}, function(data){                
            spinner.spin(target);            
            var result = JSON.parse(data);
            var success = result.success;
            if(success === true){
                $('#wrong').css('visibility', 'hidden');
                $('#contents').css('visibility', 'visible');
                var id = result.id;
                var name = result.name;
                var gender = result.gender;
                var birthDate = result.birthDate;
                var nationalId = result.nationalId;
                var address = result.address;
                var phone = result.phone;
                var email = result.email;

                $('#stu_id').html(id);
                $('#name').html(name);
                $('#gender').html(gender);
                $('#birth_date').html(birthDate);
                $('#national_id').html(nationalId);
                $('#address').html(address);
                $('#phone').html(phone);
                $('#email').html(email);
                spinner.stop(target);
            }
            else if (success === false){                
                $('#wrong').css('visibility', 'visible');
            }
        });
    }
</script>