<script>
    function getGraduationStudents(){
        $.post('models/functions/_global_ajax.php', {case: 'getGraduationStudents'}, function(data){
                $.each(data, function(key, value) {
                    $('*[data-record-key="'+value[0]+'"]').css( "background-color", "mistyrose");
                });    
            },"json");
    }    
    $(function(){  
        $('#students_table').jtable({
            title: '<?php echo STUDENTS;?>',
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
                listAction: 'models/jTableFunctions/list_student.php',
                updateAction: 'models/jTableFunctions/update_stu_status.php'                
            },
            recordsLoaded: function (event, data) { 
                getGraduationStudents();
            },
            fields: {
                id: {
                    key: true,
                    list: true,
                    title: '<?php echo COLLEGE_ID;?>',
                    width: '13%',
                    edit:false,
                    listClass: 'left_data'
                },
                name: {
                    title: '<?php echo NAME;?>',                            
                    width: '31%',                    
                    edit:false
                },
                dep_name: {
                    title: '<?php echo DEP;?>',                            
                    width: '18%',                   
                    edit:false
                },
                status: {
                    visibility: 'hidden',
                    title: '<?php echo STATUS;?>',                
                    edit:true,
                    options: { 'G': '<?php echo GRADUATED;?>', 'A': '<?php echo ACTIVE;?>', 'B': '<?php echo BANNED;?>', 'L': '<?php echo LEFT;?>', 'P': '<?php echo POSTPONED;?>' }
                },
                level: {
                    title: '<?php echo LEVEL;?>',
                    width: '11%',
                    edit:false,
                    listClass: 'center_data'
                },
                hrs: {
                    title: '<?php echo COMPLETED_HRS;?>',
                    width: '20%',
                    edit:false,
                    listClass: 'center_data'
                },
                link: {
                    visibility: 'visible',
                    width: '4%',
                    edit:false,
                    sorting: false,
                    display: function (data) {
                        return '<a href="views/scripts/dean/advise.php?studentId='+data.record.id+'"'+'>View</a>';                    
                    }
                },
                    //CHILD TABLE DEFINITION FOR "PERSONAL INFORMATION"
                    personal_info: {
                        title: '',
                        width: '3%',
                        sorting: false,
                        edit:false,                        
                        display: function (data) {
                                //Create an image that will be used to open child table
                                var $img = $('<img src="style/img/personal.png" style="cursor: pointer; padding-right:2px; padding-bottom:4px"/>');
                                //Open child table when user clicks the image
                                $img.click(function () {
                                    $('#students_table').jtable('openChildTable',
                                        $img.closest('tr'),
                                        {
                                            title: '<?php echo PERSONAL_INFO;?>',
                                            actions: {
                                                listAction: 'models/jTableFunctions/list_student_info.php?studentId=' + data.record.id,
                                                updateAction: 'models/jTableFunctions/update_student_info.php?studentId=' + data.record.id
                                            },
                                            fields: {
                                                id: {
                                                    type: 'hidden',
                                                    defaultValue: data.record.id
                                                },
                                                gender: {
                                                    visibility: 'hidden',
                                                    title: '<?php echo GENDER;?>',                
                                                    edit:true,
                                                    options: { 'M': '<?php echo MALE;?>', 'F': '<?php echo FEMALE;?>' }
                                                },
                                                birth_date: {
                                                    title: '<?php echo BIRTH_DATE;?>',
                                                    width: '10%',
                                                    type: 'date',
                                                    list_class: 'left_data'
                                                },
                                                address: {
                                                    title: '<?php echo ADDRESS;?>',
                                                    width: '40%',
                                                    list_class: 'right_data'
                                                },
                                                phone_number: {
                                                    title: '<?php echo PHONE_NUM;?>',
                                                    width: '15%',
                                                    listClass: 'left_data'
                                                },
                                                email: {
                                                    title: '<?php echo EMAIL;?>',
                                                    width: '35%',
                                                    listClass: 'left_data'
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
        //Re-load records when user click 'load records' button.
        $('#search_button').click(function (e) {
            e.preventDefault();            
            $('#students_table').jtable('load', {
                searchText: $('#search_text').val(),
                searchId: $('#search_id').val(),
                depSearchId: $('input[name=dep]:checked').val()
            });
        });               

        $('#students_table').jtable('load');  
        // to top 
        /* set variables locally for increased performance */
        var scroll_timer;
        var displayed = false;
        var $message = $('#message a');
        var $window = $(window);
        var top = $(document.body).children(0).position().top;

        /* react to scroll event on window */
        $window.scroll(function () {
            window.clearTimeout(scroll_timer);
            scroll_timer = window.setTimeout(function () {
                if($window.scrollTop() <= top)
                {
                    displayed = false;
                    $message.fadeOut(500);
                }
                else if(displayed === false)
                {
                    displayed = true;
                    $message.stop(true, true).show().click(function () { $message.fadeOut(500); });
                }
            }, 100);
        });
        //header freeze
        $('.jtable').stickyTableHeaders();
    });
</script>
