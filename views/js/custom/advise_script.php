<script>
    function getStuData(id){        
        $.post('models/functions/_global_ajax.php', {case:'getStuData', id: id}, function(data){                                        
            var result = JSON.parse(data);
            var success = result.success;            
            
            if(success === true){                
                $('#wrong').hide();
                $('#contents').show();
                
                var sId          = result.id;
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
                
                $('#stu_id').html(sId);
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
                
                $.post("models/functions/_global_ajax.php", {case:'getStuGrades', id:id},function(data){
                    $('#table').html(data);
                });
                
                $('#jTable').jtable('load', {
                    stuId:id           
                });                
            }
            else if (success === false) {
                $('#wrong').show();
            }
        });
    }
    
    function markSuggestedCourses(){
        $.post('models/functions/_global_ajax.php', {case: 'getSuggestedCourses'}, function(data){
                $.each(data, function(key, value) {
                    $('*[data-record-key="'+value[0]+'"]').css( "background-color", "rgb(167, 229, 167)");
                });    
            },"json");
    }
    
    //****************On Page Load *****************************    
    $(function(){                
        $('input').focus(function (){
            $(this).attr("placeholder", "");
            $(this).css("direction", "ltr"); 
        });
        
        $("#search_text").keypress(function(key) {
            if (key.which === 13)
            $('#search_button').click();            
        });
        
        $('#search_button').click(function (){            
            var stuId = $('#search_text').val();           
            if (stuId === ''){
                $('#wrong').show();
                $('#wrong').html('<?php echo ENTER_STU_ID;?>');
            }
            else{
                getStuData(stuId);                                
            }            
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
        $(".printBtn").click(function(){

            var print = "div.PrintArea.area0";
            $("input.selPA:checked").each(function(){
                print += (print.length > 0 ? "," : "") + "div.PrintArea." + $(this).val();
            });
			
            $( print ).printArea();
			
        });
    });    
</script>