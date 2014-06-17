<script>    
    function getSuggCourse(){
        $('#sugg_courses_Table').jtable('load', undefined, function(){
            $('.add').bind('click', function() {
                var courseCode = $(this).parents('tr').find('td:first').text();

                if($(this).hasClass('add')){
                    var action = 'add';
                    var src = 'style/img/remove.png';
                    $(this).attr('src', src);
                    $(this).removeClass('add');
                    $(this).addClass('remove');
                }
                else{
                    action = 'remove';
                    var src = 'style/img/add.png';
                    $(this).attr('src', src);
                    $(this).removeClass('remove');
                    $(this).addClass('add');                    
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
            var source = 'style/img/remove.png';
            for (i=0;i<data.length;i++){
                $('*[data-record-key="'+data[i]['COURSE_ID']+'"]').find('img.icon').attr('src', source).bind('click', function() {
                    var courseCode = $(this).parents('tr').find('td:first').text();

                    if($(this).hasClass('add')){
                        var action = 'add';
                        var src = 'style/img/remove.png';
                        $(this).attr('src', src);
                        $(this).removeClass('add');
                        $(this).addClass('remove');
                    }
                    else{
                        action = 'remove';
                        var src = 'style/img/add.png';
                        $(this).attr('src', src);
                        $(this).removeClass('remove');
                        $(this).addClass('add');
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
    function getCheckboxFilter(){
        $.post('models/functions/_global_ajax.php', {case: 'getCheckboxFilter'}, function(data){
            $('#checkboxFilterContainer').html(data);
        }, "JSON");
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
                    width: '9%'
                },
                course_level: {
                    title: '<?php echo LEVEL;?>',
                    width: '2%',
                    listClass: 'center_data'
                },
                req_name: {
                    title: '<?php echo REQ_COURSE;?>',
                    width: '8%',                    
                },
                credits: {
                    title: '<?php echo CREDITS;?>',
                    width: '8%',
                    listClass: 'center_data'
                },                
                classA: {
                    title: '<?php echo CLASS_A;?>',
                    width: '6%',
                    listClass: 'center_data'
                },
                classB: {
                    title: '<?php echo CLASS_B;?>',
                    width: '6%',
                    listClass: 'center_data'
                },
                classC: {
                    title: '<?php echo CLASS_C;?>',
                    width: '8%',
                    listClass: 'center_data'
                },
                classD: {
                    title: '<?php echo CLASS_E;?>',
                    width: '7%',
                    listClass: 'center_data'
                },
                wanting_num: {
                    title: '<?php echo WANTING_NUM;?>',
                    width: '5%',
                    listClass: 'center_data',
                    sorting: false
                },
                added: {
                    visibility: 'visible',
                    width: '4%',
                    listClass: 'center_data',
                    display: function (data) {
                        return '<img class="add icon" src="style/img/add.png" style="cursor: pointer" id="<?php echo COURSE_CODE;?>"/>';
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
                searchId: $('#search_id').val(),
                filter: $('#checkboxFilter').serializeArray()
            });            
        });
        // to top 
        $("#toTop").scrollToTop();
        //header freeze
        $('.jtable').stickyTableHeaders();
        //getCheckboxFilter
        getCheckboxFilter();        
    });  
</script>
