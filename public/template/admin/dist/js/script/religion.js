$(function(){

    $("#formReligion").submit(function(e) {  
        e.preventDefault();
         
        $('input+small').text('');
        $('input').parent().removeClass('has-error');
         
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
                var input = '#formReligion input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().css({"color":"red"});
            });
        });
    });

});