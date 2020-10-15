/*
* @Author: dell
* @Date:   2020-10-15 17:23:01
* @Last Modified by:   dell
* @Last Modified time: 2020-10-15 17:25:18
*/

$('#search_data').keyup(function(event)
{
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            searchConnection($(this).val());
        }
        if (keycode=='8')
        {
            $('#search_data').val('');
            PoundShopApp.commonClass.table.search($('#search_data').val()).draw() ;  
        }
});