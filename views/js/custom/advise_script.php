<script>
           
    function markSuggestedCourses(){
        $.post('models/functions/_global_ajax.php', {case: 'getSuggestedCourses'}, function(data){
                $.each(data, function(key, value) {
                    $('*[data-record-key="'+value[0]+'"]').css( "background-color", "rgb(167, 229, 167)");
                });    
            },"json");
    }
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
        $('#show').click(function (){
            if($(this).text() === 'طلابي'){
                $('#myStudents').show();
                $('#show').text('إخفاء');                    
            }
            else{
                $('#myStudents').hide();
                $('#show').text('طلابي'); 
            }
        
        });
        $('input').focus(function (){
            $(this).attr("placeholder", "");
            $(this).css("direction", "ltr"); 
        });
        $('#search_button').click(function (){            
            var stuId = $('#search_text').val();
            if (stuId === ''){
                $('#wrong').show();
                $('#wrong').html('<?php echo ENTER_STU_ID;?>');
            }
            getStuData(stuId);
            
            $.post("models/functions/_global_ajax.php", {case:'getStuGrades', id:stuId},function(data){
                $('#table').html(data);
            });
            
            $('#jTable').jtable('load', {
                stuId:$('#search_text').val()                
            });
        });
        $("#search_text").keypress(function(key) {
            if (key.which === 13)
            $('#search_button').click();            
        });
        
        $('#jTable').jtable({
            title: '<?php echo AVAILABLE_CRS;?>',
            paging: false,                    
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
                listAction: 'models/jTableFunctions/list_stu_sugg.php'                      
            },                                              
            recordsLoaded: function (event, data) { 
                markSuggestedCourses();
            },
            fields: {
                course_id: {
                    key: true,
                    list: true,
                    title: '<?php echo COURSE_CODE;?>',
                    width: '15%',
                    listClass: 'left_data'
                },
                name_ar: {
                    title: '<?php echo COURSE_NAME;?>',                            
                    width: '20%',
                    visibility: 'fixed' //This column always will be shown,                            
                },                
                course_level: {
                    title: '<?php echo LEVEL;?>',                            
                    width: '10%',
                    visibility: 'fixed',
                    listClass: 'left_data'
                },
                req_name: {
                    title: '<?php echo REQ_COURSE;?>',                            
                    width: '15%',
                    visibility: 'fixed'                    
                },
                credits: {
                    title: '<?php echo CREDITS;?>',
                    width: '15%',
                    listClass: 'left_data'
                },
                status: {
                    title: '<?php echo STATUS;?>',
                    width: '15%'                    
                },
                grade: {
                    title: '<?php echo FINAL_GRADE;?>',
                    width: '15%',
                    listClass: 'left_data'
                },
                dummyColumn: {
                    visibility: 'hidden'
                }        
            }
        });        
    });
    
    function getStuData(id){
        var target = document.getElementById('spinner');
        var spinner = new Spinner(options);
        
        $.post('models/functions/_global_ajax.php', {case:'getStuData', id: id}, function(data){                
            spinner.spin(target);            
            var result = JSON.parse(data);
            var success = result.success;            
            if(success === true){                
                $('#wrong').hide();
                $('#contents').show();
                var id          = result.id;
                var name        = result.name;
                var gender      = result.gender;
                var birthDate   = result.birthDate;
                var nationalId  = result.nationalId;
                var address     = result.address;
                var phone       = result.phone;
                var email       = result.email;
                var gpa         = result.gpa;
                var comHrs      = result.comHrs;
                var level       = result.level;
                var depName     = result.depName;
                var depHrs      = result.depHrs;
                var regDate     = result.regDate;
                var failedCrs   = result.failedCrs;
                
                $('#stu_id').html(id);
                $('#name').html(name);
                $('#gender').html(gender);
                $('#birth_date').html(birthDate);
                $('#national_id').html(nationalId);
                $('#address').html(address);
                $('#phone').html(phone);
                $('#email').html(email);
                $('#dep_name').html(depName);
                $('#dep_hrs').html(depHrs);
                $('#level').html(level);
                $('#com_hrs').html(comHrs);
                $('#reg_date').html(regDate);
                $('#gpa').html(gpa);
                $('#failed_crs').html(failedCrs);
                spinner.stop(target);
            }
            else if (success === false) {
                $('#wrong').css('visibility', 'visible');
            }
        });
    }
</script>