<script>
    $('#sugg').click(function (){        
        $('#sugg_courses_Table').jtable('load');
        //getSuggCoursesNum();
    }); 
//    $('#all_courses').click(function (){        
//        getSuggCourse();
//    });   
    
    $(function(){
        $('#all_courses_Table').jtable({
            title: '<?php echo COURSES;?>',
            paging: false,                    
            columnResizable: false,             //Actually, no need to set true since it's default
            columnSelectable: false,            //Actually, no need to set true since it's default
            saveUserPreferences: false,         //Actually, no need to set true since it's default
            sorting: true,                    
            selecting: false,                   //Enable selecting
            multiselect: false,                 //Allow multiple selecting
            selectingCheckboxes: false,         //Show checkboxes on first column
            selectOnRowClick: true,             //Enable this to only select using checkboxes
            totalRecordCount: 'RecordCount',            
            actions: {
                listAction: 'models/jTableFunctions/list_courses.php'        
            },
            fields: {
                id: {
                    key: true,
                    list: true,
                    title: '<?php echo COURSE_CODE;?>',
                    width: '5%'
                },
                name_ar: {
                    title: '<?php echo COURSE_NAME;?>',                            
                    width: '10%',
                    visibility: 'fixed' //This column always will be shown,                            
                },                
                ct_name: {
                    title: '<?php echo COURSE_TYPE;?>',
                    width: '8%'
                },
                course_level: {
                    title: '<?php echo LEVEL;?>',
                    width: '2%'
                },
                req_course_id: {
                    title: '<?php echo REQ_COURSE;?>',
                    width: '6%'
                },
                credits: {
                    title: '<?php echo CREDITS;?>',
                    width: '5%'
                },                
                classA: {
                    title: '<?php echo CLASS_A;?>',
                    width: '7%'                   
                },
                classB: {
                    title: '<?php echo CLASS_B;?>',
                    width: '6%'                   
                },
                classC: {
                    title: '<?php echo CLASS_C;?>',
                    width: '8%'                   
                },
                added: {
                    visibility: 'visible',
                    width: '4%',
                    display: function (data) {
                        return '<a class="add" id="<?php echo COURSE_CODE;?>">Add</a>';                    
                    }
                }        
            }
        });

        //Re-load records when user click 'load records' button.
        $('#search_button').click(function (e) {
            e.preventDefault();
            $('#all_courses_Table').jtable('load', {
                searchText: $('#search_text').val(),
                searchId: $('#search_id').val()
            });
            getSuggCourse();
        });
        
        $('#all_courses_Table').jtable('load', undefined, function(){            
            //getSuggCourse();
            getSuggCoursesNum();
            getBelowStuNum();
        });
                
        // to top 
        $("#toTop").scrollToTop();
        //header freeze
        $('.jtable').stickyTableHeaders();
    });        
    
    function getSuggCoursesNum(){
        $.post('models/functions/_global_ajax.php', {case: 'getSuggCoursesNum'}, function(data){                        
            $('#sugg_crs_ounter').html(' ('+data+')');
        });
    }
    
    function getBelowStuNum(){
        $.post('models/functions/_global_ajax.php', {case: 'getBelowStuNum'}, function(data){            
            $('#below_stu_counter').html(' ('+data+')');
        });
    }
    
    function getSuggCourse(){
    $('#sugg_courses_Table').jtable('load', undefined, function(){
            $('.add').bind( "click", function() {
                var courseCode = $(this).parents("tr").find("td:first").text();

                if($(this).text() === 'Add'){
                    var action = 'add';
                    $(this).text('Remove');
                    $(this).css('color','red');                    
                }
                else{
                    action = 'remove';
                    $(this).text('Add');
                    $(this).css('color','green');
                }
                $.post('models/functions/_global_ajax.php', {case:'suggCourse', action: action, courseCode: courseCode}, function(data){
                    getSuggCoursesNum();
                    getBelowStuNum();
                });            
            });    
        });

        $.post('models/functions/_global_ajax.php',{case: 'getSuggCourses'}, function(data){
            var i = 0;
            for (i=0;i<data.length;i++){
                $('*[data-record-key="'+data[i]['COURSE_ID']+'"]').find("td:last").text('Remove').css({'color':'red', 'cursor':'pointer'}).bind( "click", function() {
                    var courseCode = $(this).parents("tr").find("td:first").text();

                    if($(this).text() === 'Add'){
                        var action = 'add';
                        $(this).text('Remove');
                        $(this).css('color','red');                        
                    }
                    else{
                        action = 'remove';
                        $(this).text('Add');
                        $(this).css('color','green');
                    }
                    $.post('models/functions/_global_ajax.php', {case:'suggCourse', action: action, courseCode: courseCode}, function(data){                
                        getSuggCoursesNum();
                        getBelowStuNum();
                    });            
                });   
            }
        }, "json");   
    }     
</script>