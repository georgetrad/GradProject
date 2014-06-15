<script>
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
                    markSuggestedCourses();                    
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
    
    $(document).ready(function () {  
        $('#available_courses_table').jtable({
            title: '<?php echo COURSES;?>',
            paging: false,
            columnResizable: false,
            columnSelectable: false,
            saveUserPreferences: false,
            sorting: true,                    
            selecting: false,                   //Enable selecting
            multiselect: false,                 //Allow multiple selecting
            selectingCheckboxes: false,         //Show checkboxes on first column
            selectOnRowClick: false,             //Enable this to only select using checkboxes
            totalRecordCount: 'RecordCount',            
            actions: {
                listAction: 'models/jTableFunctions/list_stu_ava_crs.php'        
            },
            fields: {
                course_id: {
                    key: true,
                    list: true,
                    title: '<?php echo COURSE_CODE;?>',
                    width: '5%',
                    listClass: 'left_data'
                },
                name_ar: {
                    title: '<?php echo COURSE_NAME;?>',                            
                    width: '10%',
                    visibility: 'fixed' //This column always will be shown,                            
                },                
                ct_name: {
                    title: '<?php echo COURSE_TYPE;?>',
                    width: '10%'
                },
                course_level: {
                    title: '<?php echo LEVEL;?>',
                    width: '2%',
                    listClass: 'center_data'
                },
                req_name: {
                    title: '<?php echo REQ_COURSE;?>',
                    width: '10%'
                },
                credits: {
                    title: '<?php echo CREDITS;?>',
                    width: '8%',
                    listClass: 'center_data'
                },                
                status: {
                    title: '<?php echo STATUS;?>',
                    width: '7%',
                    listClass: 'center_data'
                },
                grade: {
                    title: '<?php echo FINAL_GRADE;?>',
                    width: '8%',
                    listClass: 'center_data'
                },
                added: {
                    visibility: 'visible',
                    width: '4%',
                    listClass: 'center_data',
                    display: function (data) {
                        return '<a class="add" id="<?php echo COURSE_CODE;?>">Add</a>';                    
                    }
                }
            },
            recordsLoaded: function (event, data) { 
                getSuggCourse();
                getSuggCoursesNum();
                getBelowStuNum();
                markSuggestedCourses();
            }
        });
        $('#available_courses_table').jtable('load');
                
        //Re-load records when user click 'load records' button.
        $('#search_button').click(function (e) {
            e.preventDefault();
            $('#available_courses_table').jtable('load', {
                searchText: $('#search_text').val(),
                searchId: $('#search_id').val()
            });
        });
        // to top 
        $("#toTop").scrollToTop();
        //header freeze
        $('.jtable').stickyTableHeaders();
    });  
</script>