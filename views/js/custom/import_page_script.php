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

    $('.fileLink_std').each(function() {
        this.submitting = false;
    }).click(function() {
        if (!this.submitting) {
            this.submitting = true;
            var self = this;
            spinner.spin(target);
            $.post( "models/functions/importGeneralFile_std.php", { file:$(this).text(),semester:$('#semester').val()},function( data ) {
                $( ".result" ).html( data );
                spinner.stop(target);
            });  
        }
    });
    $('.fileLink_crs').each(function() {
        this.submitting = false;
    }).click(function() {
        if (!this.submitting) {
            this.submitting = true;
            var self = this;
            spinner.spin(target);
            $.post( "models/functions/importGeneralFile_crs.php", { file:$(this).text(),semester:$('#semester').val()},function( data ) {
                $( ".result" ).html( data );
                spinner.stop(target);
            });  
        }
    });
    $('.fileLink_grd').each(function() {
        this.submitting = false;
    }).click(function() {
        if (!this.submitting) {
            this.submitting = true;
            var self = this;
            spinner.spin(target);
            $.post( "models/functions/importGeneralFile_grd.php", { file:$(this).text(),semester:$('#semester').val()},function( data ) {
                $( ".result" ).html( data );
                spinner.stop(target);
            });  
        }
    });
    $('.fileLink_cls').each(function() {
        this.submitting = false;
    }).click(function() {
        if (!this.submitting) {
            this.submitting = true;
            var self = this;
            spinner.spin(target);
            $.post( "models/functions/importGeneralFile_cls.php", { file:$(this).text(),semester:$('#semester').val()},function( data ) {
                $( ".result" ).html( data );
                spinner.stop(target);
            });  
        }
    });   
    $('.fileLink_courses').each(function() {
        this.submitting = false;
    }).click(function() {
        if (!this.submitting) {
            this.submitting = true;
            var self = this;
            spinner.spin(target);
            $.post( "models/functions/importCoursesFile.php", { file:$(this).text(),semester:$('#semester').val()},function( data ) {
                $( ".result" ).html( data );
                spinner.stop(target);
            });  
        }
    });    
});
</script>   
