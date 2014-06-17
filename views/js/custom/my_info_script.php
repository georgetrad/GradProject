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
                $('.name').html(name);
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
            }
            else if (success === false) {
                $('#wrong').show();
            }
        });
    }
    
    $(function(){
        getStuData();
    });
</script>
