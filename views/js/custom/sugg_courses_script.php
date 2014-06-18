<script>
    $(function(){
        $('#sugg_courses_Table').jtable({
            title: '<?php echo SUGGESTED_COURSES;?>',
            paging: false,                    
            columnResizable: false, //Actually, no need to set true since it's default
            columnSelectable: false, //Actually, no need to set true since it's default
            saveUserPreferences: false, //Actually, no need to set true since it's default
            sorting: true,                    
            selecting: false, //Enable selecting
            multiselect: false, //Allow multiple selecting
            selectingCheckboxes: false, //Show checkboxes on first column
            selectOnRowClick: true, //Enable this to only select using checkboxes
            totalRecordCount: 'RecordCount',
            openChildAsAccordion: true,
            actions: {
                listAction: 'models/jTableFunctions/list_sugg_courses.php'                      
            },
            fields: {
                id: {
                    key: true,
                    list: true,
                    title: '<?php echo COURSE_CODE;?>',
                    width: '15%',
                    listClass: 'left_data'
                },
                name_ar: {
                    title: '<?php echo COURSE_NAME;?>',                            
                    width: '20%',
                    visibility: 'fixed'
                },                
                ct_name: {
                    title: '<?php echo COURSE_TYPE;?>',
                    width: '20%'
                },
                course_level: {
                    title: '<?php echo LEVEL;?>',
                    width: '10%',
                    listClass: 'center_data'
                },
                req_course: {
                    title: '<?php echo REQ_COURSE;?>',
                    width: '18%'                  
                }, 
               credits: {
                    title: '<?php echo CREDITS;?>',
                    width: '15%',
                    listClass: 'center_data'
                },
                    //CHILD TABLE DEFINITION FOR "PHONE NUMBERS"
                    courses: {
                        title: '',
                        width: '5%',
                        sorting: false,
                        display: function (data) {
                                //Create an image that will be used to open child table
                                var $img = $('<img src="style/img/list_metro.png" style="cursor: pointer"/>');
                                //Open child table when user clicks the image
                                $img.click(function () {
                                    $('#below_stu_Table').jtable('openChildTable',
                                        $img.closest('tr'),
                                        {
                                            title: '<?php echo STUDENTS;?>',
                                            actions: {
                                                listAction: 'models/jTableFunctions/list_sugg_crs_stu.php?coursetId=' + data.record.id
                                            },
                                            recordsLoaded: function (event, data) { 
                                                $('.jtable-child-table-container').stickyTableHeaders();
                                            },
                                            fields: {
                                                id: {
                                                    type: 'hidden',
                                                    defaultValue: data.record.id
                                                },                                                
                                                student_id: {
                                                    key: true,
                                                    title: '<?php echo COLLEGE_ID;?>',
                                                    width: '10%',
                                                    listClass: 'left_data'
                                                },
                                                name: {
                                                    title: '<?php echo NAME;?>',
                                                    width: '20%'
                                                },
                                                level: {
                                                    title: '<?php echo LEVEL;?>',
                                                    width: '10%',
                                                    listClass: 'center_data'
                                                },
                                                tot_hrs: {
                                                    title: '<?php echo COMPLETED_HRS;?>',
                                                    width: '15%',
                                                    listClass: 'center_data'
                                                },
                                                gpa: {
                                                    title: '<?php echo GPA;?>',
                                                    width: '10%',
                                                    listClass: 'center_data'
                                                },
                                                status: {
                                                    title: '<?php echo STATUS;?>',
                                                    width: '10%'
                                                },
                                                grade: {
                                                    title: '<?php echo FINAL_GRADE;?>',
                                                    width: '10%',
                                                    listClass: 'center_data'
                                                },
                                                adviserName: {
                                                    title: '<?php echo ADVISOR;?>',
                                                    width: '15%'                                                    
                                                },
                                                dummyColumn: {
                                                    visibility: 'hidden',
                                                    edit:false
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

        $('#sugg_courses_Table').jtable('load');        
    });
</script>
