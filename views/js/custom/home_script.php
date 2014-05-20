<script>
    $(function(){
        date_time('date', 'time');
    });           
   function date_time(date, time){       
        date = new Date;
        year = date.getFullYear();
        month = date.getMonth();
        months = new Array('كانون الثاني', 'شباط', 'آذار', 'نيسان', 'أيار', 'حزيران', 'تموز', 'آب', 'أيلول', 'تشرين الأول', 'نشرين الثاني', 'كانون الأول');
        d = date.getDate();
        day = date.getDay();
        days = new Array('الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت');
        h = date.getHours();
        if(h<10)
        {
                h = "0"+h;
        }
        m = date.getMinutes();
        if(m<10)
        {
                m = "0"+m;
        }
        s = date.getSeconds();
        if(s<10)
        {
                s = "0"+s;
        }
        dateResult = ''+days[day]+' '+d+' '+months[month]+' '+year;
        timeResult = ''+h+':'+m+':'+s;
        $('#date').html(dateResult);
        $('#time').html(timeResult);
        setTimeout('date_time("'+date+'");','1000');
        return true;
    }
</script>

