$(function(){

    $("#formGenre").submit(function(e) {  
        e.preventDefault();
         
        $('input+small').text('');
         
        $.ajax({
            method: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json"
        })
        .done(function(data) {
            window.location.reload();
        })
        .fail(function(data) { 
            console.log(data);
            $.each(data.responseJSON.errors, function (key, value) {
                var input = '#formGenre input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().css({"color":"red"});
            });
        });
    });

});