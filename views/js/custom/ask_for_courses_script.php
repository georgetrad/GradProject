<script>
    function getSuggCourse(){        
        $('.icon').bind( "click", function() {            
            var courseCode = $(this).parents("tr").find("td:first").text();
            var credits = $(this).parents("tr").find("td:first").next().next().next().next().next().text();
            
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
            $.post('models/functions/_global_ajax.php', {case:'askForCourse', action: action, courseCode: courseCode, credits:credits}, function(data){
                getAskCoursesNum();                
            });            
        });       
        
        $.post('models/functions/_global_ajax.php',{case: 'getAskedCourses'}, function(data){
            var i = 0;
            var source = 'style/img/remove.png';
            for (i=0;i<data.length;i++){
                $('*[data-record-key="'+data[i]['COURSE_ID']+'"]').find('img.icon').attr('src', source).bind('click', function() {
                    var courseCode = $(this).parents("tr").find("td:first").text();
                    var credits = $(this).parents("tr").find("td:first").next().next().next().next().next().text();
                    
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
                    $.post('models/functions/_global_ajax.php', {case:'askForCourse', action: action, courseCode: courseCode, credits:credits}, function(data){                
                        getAskCoursesNum();                        
                    });            
                });   
            }
        }, "json");
    }
    
    function getAskCoursesNum(){
        $.post('models/functions/_global_ajax.php', {case: 'getAskCoursesNum'}, function(data){
            var result = JSON.parse(data);
            var num = result.num;
            var hrs = result.hrs;            
            $('#num_ask_crs').html(num + ' مقرر');
            if (hrs === null){
                $('#num_ask_hrs').html('0' + ' ساعة');
            }
            else{
                $('#num_ask_hrs').html(hrs + ' ساعة');
            }            
        });        
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
                    width: '6%',
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
                    width: '3%',
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
                    width: '6%'
                },
                grade: {
                    title: '<?php echo FINAL_GRADE;?>',
                    width: '7%',
                    listClass: 'center_data'
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
                getAskCoursesNum();
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