<script>
    $(function() {  
        var opts = {
            lines: 13, // The number of lines to draw
            length: 20, // The length of each line
            width: 2, // The line thickness
            radius: 15, // The radius of the inner circle
            corners: 1, // Corner roundness (0..1)
            rotate: 0, // The rotation offset
            direction: 1, // 1: clockwise, -1: counterclockwise
            color: '#000', // #rgb or #rrggbb or array of colors
            speed: 1, // Rounds per second
            trail: 60, // Afterglow percentage
            shadow: false, // Whether to render a shadow
            hwaccel: false, // Whether to use hardware acceleration
            className: 'spinner', // The CSS class to assign to the spinner
            zIndex: 2e9, // The z-index (defaults to 2000000000)
            top: '50%', // Top position relative to parent
            left: '50%' // Left position relative to parent
        };
        var spinner = new Spinner(opts);
        var target = document.getElementById('spin');    
    /** student Import **********************************************************************************/
        $('#studentImportButton').click(function() {
            this.submitting = false;
        }).click(function() {
            if (!this.submitting) {
                this.submitting = true;
                var self = this;
                spinner.spin(target);
                var formData = $('#studentImportForm').serialize();
                formData += '&case=importStudent';
                $.post('models/functions/_global_ajax.php', formData ,function( data ) {
                    if (data.result){
                        $('.result').show();
                        setTimeout(function() {
                             $('.result').hide();
                         }, 1000);
                    }else{
                        $('.result2').show();
                        setTimeout(function() {
                             $('.result2').hide();
                         }, 1000);
                    };
                    spinner.stop(target);
                },"JSON");  
            }
        });    
    /** course Import **********************************************************************************/
        $('#courseImportButton').click(function() {
            this.submitting = false;        
        }).click(function() {        
            if (!this.submitting) {
                this.submitting = true;
                var self = this;
                spinner.spin(target);
                var formData = $('#courseImportForm').serialize();
                formData += '&case=courseImport';
                $.post( "models/functions/_global_ajax.php", formData ,function( data ) {
                    if (data.result){
                        $('.result').show();
                        setTimeout(function() {
                             $('.result').hide();
                         }, 1000);
                    }else{
                        $('.result2').show();
                        setTimeout(function() {
                             $('.result2').hide();
                         }, 1000);
                    };
                    spinner.stop(target);
                },"JSON");  
            }
        });    
    /** Class Import **********************************************************************************/
        $('#classImportButton').click(function() {
            this.submitting = false;
        }).click(function() {
            if (!this.submitting) {
                this.submitting = true;
                var self = this;
                spinner.spin(target);
                var formData = $('#classImportForm').serialize();
                formData += '&case=classImport';
                $.post( "models/functions/_global_ajax.php", formData ,function( data ) {
                    if (data.result){
                        $('.result').show();
                        setTimeout(function() {
                             $('.result').hide();
                         }, 1000);
                    }else{
                        $('.result2').show();
                        setTimeout(function() {
                             $('.result2').hide();
                         }, 1000);
                    };
                    spinner.stop(target);
                },"JSON");  
            }
        });    
    /** grade Import **********************************************************************************/
        $('#gradeImportButton').click(function() {
            this.submitting = false;
        }).click(function() {
            if (!this.submitting) {
                this.submitting = true;
                var self = this;
                spinner.spin(target);
                var formData = $('#gradeImportForm').serialize();
                formData += '&case=gradeImport';
                $.post( "models/functions/_global_ajax.php", formData ,function( data ) {
                    if (data.result){
                        $('.result').show();
                        setTimeout(function() {
                             $('.result').hide();
                         }, 1000);
                    }else{
                        $('.result2').show();
                        setTimeout(function() {
                             $('.result2').hide();
                         }, 1000);
                    };
                    spinner.stop(target);
                },"JSON");  
            }
        });   
    /** course File Import **********************************************************************************/
        $('#courseFileImportButton').click(function() {
            this.submitting = false;
        }).click(function() {
            if (!this.submitting) {
                this.submitting = true;
                var self = this;
                spinner.spin(target);
                var formData = $('#courseFileImportForm').serialize();
                formData += '&case=courseFileImport';
                $.post( "models/functions/_global_ajax.php", formData ,function( data ) {
                    if (data.result){
                        $('.result').show();
                        setTimeout(function() {
                             $('.result').hide();
                         }, 1000);
                    }else{
                        $('.result2').show();
                        setTimeout(function() {
                             $('.result2').hide();
                         }, 1000);
                    };
                    spinner.stop(target);
                },"JSON");  
            }
        });   
    /** student File Import **********************************************************************************/
        $('#studentFileImportButton').click(function() {
            this.submitting = false;
        }).click(function() {
            if (!this.submitting) {
                this.submitting = true;
                var self = this;
                spinner.spin(target);
                var formData = $('#studnetFileImportForm').serialize();
                formData += '&case=studentFileImport';
                $.post( "models/functions/_global_ajax.php", formData ,function( data ) {
                    if (data.result){
                        $('.result').show();
                        setTimeout(function() {
                             $('.result').hide();
                         }, 1000);
                    }else{
                        $('.result2').show();
                        setTimeout(function() {
                             $('.result2').hide();
                         }, 1000);
                    };
                    spinner.stop(target);
                },"JSON");  
            }
        }); 
    /** Class Grades File Import **********************************************************************************/
        $('#classGradesFileImportButton').click(function() {
            this.submitting = false;
        }).click(function() {
            if (!this.submitting) {
                this.submitting = true;
                var self = this;
                spinner.spin(target);
                var formData = $('#classGradesForm').serialize();
                formData += '&case=classGradeImport';
                $.post( "models/functions/_global_ajax.php", formData ,function( data ) {
                    if (data.result){
                        $('.result').show();
                        setTimeout(function() {
                             $('.result').hide();
                         }, 1000);
                    }else{
                        $('.result2').show();
                        setTimeout(function() {
                             $('.result2').hide();
                         }, 1000);
                    };
                    spinner.stop(target);
                },"JSON");  
            }
        });
    /** Class Grades File Import **********************************************************************************/
        $('#importStudentStatus').click(function() {
            this.submitting = false;
        }).click(function() {
            if (!this.submitting) {
                this.submitting = true;
                var self = this;
                spinner.spin(target);
                var formData = $('#studentStatusForm').serialize();
                formData += '&case=importStudentStatus';
                $.post( "models/functions/_global_ajax.php", formData ,function( data ) {
                    if (data.result){
                        $('.result').show();
                        setTimeout(function() {
                             $('.result').hide();
                         }, 1000);
                    }else{
                        $('.result2').show();
                        setTimeout(function() {
                             $('.result2').hide();
                         }, 1000);
                    };
                    spinner.stop(target);
                },"JSON");  
            }
        });
    });
</script>   