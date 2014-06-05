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
        var target = document.getElementById('spinner');    

        $('#update_button').click(function() {
            this.submitting = false;
        }).click(function() {
            if (!this.submitting) {
                this.submitting = true;
                var self = this;
                var formData = $('#updateDataForm').serialize();
                formData += '&case=updateData';
                spinner.spin(target);
                $.post("models/functions/_global_ajax.php", formData, function( data ) {                    
                    if (data.result){
                        $('.result').show();
                        setTimeout(function() {
                             $('.result').hide();
                         }, 3000);
                    }else{
                        $('.result2').show();
                        setTimeout(function() {
                             $('.result2').hide();
                         }, 3000);
                    }                    
                    spinner.stop(target);
                },"JSON"); 
            }
        });
    });
</script>   