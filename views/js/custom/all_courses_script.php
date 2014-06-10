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
    function getSuggCoursesNum(){
        $.post('models/functions/_global_ajax.php', {case: 'getSuggCoursesNum'}, function(data){
            $('#sugg_crs_counter').html(' ('+data+')');
        });
    }
    function getBelowStuNum(){ 
	$.post('models/functions/_global_ajax.php',{case: 'getBelowStuNum'},function(data){
            $('#below_stu_counter').html(' ('+data+')'); 
	}); 
    }
    function getSuggCoursesNum(){
        $.post('models/functions/_global_ajax.php', {case: 'getSuggCoursesNum'}, function(data){
            $('#sugg_crs_counter').html(' ('+data+')');
        });
    }
    
    $(document).ready(function () {  
        $('#all_courses_Table').jtable({
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
                listAction: 'models/jTableFunctions/list_courses.php'        
            },
            fields: {
                id: {
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
                    width: '7%'
                },
                course_level: {
                    title: '<?php echo LEVEL;?>',
                    width: '2%',
                    listClass: 'center_data'
                },
                req_name: {
                    title: '<?php echo REQ_COURSE;?>',
                    width: '10%',                    
                },
                credits: {
                    title: '<?php echo CREDITS;?>',
                    width: '5%',
                    listClass: 'center_data'
                },                
                classA: {
                    title: '<?php echo CLASS_A;?>',
                    width: '7%',
                    listClass: 'center_data'
                },
                classC: {
                    title: '<?php echo CLASS_C;?>',
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
        $('#all_courses_Table').jtable('load');

        //on suggested course tab click, re draw the table and get the number of suggested courses
        $('#sugg').click(function (){        
            $('#sugg_courses_Table').jtable('load');
        });
        //on below hours students tab click, re draw the table and get the number of suggested courses
        $('#below').click(function (){        
            $('#below_stu_Table').jtable('load');
        });
        //Re-load records when user click 'load records' button.
        $('#search_button').click(function (e) {
            e.preventDefault();
            $('#all_courses_Table').jtable('load', {
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
