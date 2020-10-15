/*
* @Author: dell
* @Date:   2020-10-15 17:23:01
* @Last Modified by:   Kinjal
* @Last Modified time: 2020-10-15 17:51:16
*/

$('#search_data').keyup(function(event)
{
       $.ajax({
        type: "GET",
        url: $("#search_url").val(),
        data: {'search':$(this).val()},
        //processData: false,
        contentType: false,
        cache: false,
        headers: {
           'X-Requested-With': 'XMLHttpRequest'
        },
        success: function (response) {
                
               $('#searched_data tbody').html(response);
                
        },
        error: function (data) {
                $('.submit').attr('disabled', false);
                var errorText='';
            var errors = data.responseJSON.errors;
            console.log(errors);
                $.each(errors, function (key, value) {
                        errorText+=value[0]+'\n';
                    
                });
                alert(errorText);
           
        }
    });
        
});