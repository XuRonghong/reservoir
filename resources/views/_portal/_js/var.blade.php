<script>
    //delay
    var delay_time = 1000;
    //Email格式檢查
    var reg_Email = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
    //電話格式檢查
    var reg_phoneTel = /^[\+]?[0-9\-\s]+$/;
    //pickadate
    var custom_set_pickadate = {
        monthsFull: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
        monthsShort: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
        weekdaysFull: ['日', '一', '二', '三', '四', '五', '六'],
        weekdaysShort: ['日', '一', '二', '三', '四', '五', '六'],
        today: '',
        clear: '',
        close: '',
        format: 'yyyy-mm-dd',
        formatSubmit: 'yyyy-mm-dd'
    }
</script>