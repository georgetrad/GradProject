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
                listAction: 'models/jTableFunctions/list_my_students.php'                
            },
            recordsLoaded: function (event, data) { 
                getGraduationStudents();
            },
            fields: {
                id: {
                    key: true,
                    list: true,
                    title: '<?php echo COLLEGE_ID;?>',
                    width: '15%',
                    edit:false,
                    listClass: 'left_data'
                },
                name: {
                    title: '<?php echo NAME;?>',                            
                    width: '29%',                    
                    edit:false
                },
                dep_name: {
                    title: '<?php echo DEP;?>',                            
                    width: '13%',                    
                    edit:false
                },                
                level: {
                    title: '<?php echo LEVEL;?>',
                    width: '11%',
                    edit:false,
                    listClass: 'center_data'
                },
                hrs: {
                    title: '<?php echo COMPLETED_HRS;?>',
                    width: '15%',
                    edit:false,
                    listClass: 'center_data'
                },
                link: {
                    visibility: 'visible',
                    width: '2%',
                    edit:false,
                    sorting: false,
                    listClass: 'center_data',
                    display: function (data) {
                        return '<a href="views/scripts/teacher/advise.php?studentId='+data.record.id+'"'+'><img src="style/img/view.png" style="cursor: pointer; padding-right:4px"/></a>';                                        }                
                },
                    //CHILD TABLE DEFINITION FOR "FOR "PERSONAL INFORMATION"
                    personal_info: {
                        title: '',
                        width: '10%',
                        sorting: false,
                        listClass: 'center_data',
                        display: function (data) {
                                //Create an image that will be used to open child table
                                var $img = $('<img src="style/img/personal.png" style="cursor: pointer; padding-bottom:2px"/>');
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
        
        $("#search_text").keypress(function(key) {
            if (key.which === 13)
            $('#search_button').click();
        });
    });
</script>
