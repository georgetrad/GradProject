<script>
    function getGraduationStudents(){
        $.post('models/functions/_global_ajax.php', {case: 'getGraduationStudents'}, function(data){
                $.each(data, function(key, value) {
                    $('*[data-record-key="'+value[0]+'"]').css('background-color', 'mistyrose');
                });    
            },'json');
    }       
    function markSuggestedCourses(){
        $.post('models/functions/_global_ajax.php', {case: 'getSuggestedCourses'}, function(data){
                $.each(data, function(key, value) {
                    $('*[data-record-key="'+value[0]+'"]').css('background-color', 'rgb(167, 229, 167)');
                });    
            },'json');
    }
    $(function(){
        $('#below_stu_Table').jtable({
            title: '<?php echo STUDENTS;?>',
            paging: true,                    
            columnResizable: false, //Actually, no need to set true since it's default
            columnSelectable: false, //Actually, no need to set true since it's default
            saveUserPreferences: false, //Actually, no need to set true since it's default
            sorting: true,                    
            selecting: false, //Enable selecting
            multiselect: false, //Allow multiple selecting
            selectingCheckboxes: false, //Show checkboxes on first column
            selectOnRowClick: false, //Enable this to only select using checkboxes
            totalRecordCount: 'RecordCount',
            openChildAsAccordion: true,
            actions: {
                listAction: 'models/jTableFunctions/list_below_stu.php'                      
            },
            recordsLoaded: function (event, data) { 
                getGraduationStudents();
                markSuggestedCourses();
            },
            fields: {
                id: {
                    key: true,
                    list: true,
                    title: '<?php echo COLLEGE_ID;?>',
                    width: '10%',
                    listClass: 'left_data'
                },
                name: {
                    title: '<?php echo NAME;?>',                            
                    width: '20%',
                    visibility: 'fixed' //This column always will be shown,                            
                },
                depName: {
                    title: '<?php echo DEP;?>',                            
                    width: '13%'                    
                },
                level: {
                    title: '<?php echo LEVEL;?>',
                    width: '8%',
                    listClass: 'center_data'
                },
                hours: {
                    title: '<?php echo COMPLETED_HRS;?>',
                    width: '15%',
                    listClass: 'center_data'
                },
                num_of_crs: {
                    title: '<?php echo NUM_OF_CRS;?>',
                    width: '20%',
                    listClass: 'center_data'
                }, 
               hrs: {
                    title: '<?php echo SUGG_HRS;?>',
                    width: '12%',
                    listClass: 'center_data'
                },                
                    //CHILD TABLE DEFINITION FOR "PHONE NUMBERS"
                    courses: {
                        title: '',
                        width: '2%',
                        sorting: false,
                        display: function (data) {
                                //Create an image that will be used to open child table
                                var $img = $('<img src="style/img/list_metro.png" style="cursor: pointer"/>');
                                //Open child table when user clicks the image
                                $img.click(function () {
                                    $('#below_stu_Table').jtable('openChildTable',
                                        $img.closest('tr'),
                                        {                                                     
                                            recordsLoaded: function (event, data) { 
                                                markSuggestedCourses();
                                            },
                                            title: '<?php echo AVAILABLE_CRS;?>',
                                            actions: {
                                                listAction: 'models/jTableFunctions/list_stu_sugg_crs.php?studentId=' + data.record.id
                                            },
                                            fields: {
                                                id: {
                                                    type: 'hidden',
                                                    defaultValue: data.record.id
                                                },
                                                course_id: {
                                                    key: true,
                                                    title: '<?php echo COURSE_CODE;?>',
                                                    width: '25%',
                                                    listClass: 'left_data'
                                                },
                                                name_ar: {
                                                    title: '<?php echo COURSE_NAME;?>',
                                                    width: '35%'
                                                },
                                                status: {
                                                    title: '<?php echo STATUS;?>',
                                                    width: '20%'
                                                },
                                                grade: {
                                                    title: '<?php echo FINAL_GRADE;?>',
                                                    width: '20%',
                                                    listClass: 'center_data'
                                                },
                                                dummyColumn: {
                                                    visibility: 'hidden'
                                                }
                                            }
                                        }, function (data) { //opened handler
                                            data.childTable.jtable('load');
                                        });
                                });
                                //Return image to show on the person row
                                return $img;
                            }
                    }
            }
        });        

        $('#below_stu_Table').jtable('load');  
        //header freeze
        $('.jtable').stickyTableHeaders();      
    });
</script>
