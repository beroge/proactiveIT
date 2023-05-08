$(document).ready(function(){
    $('#username').blur(function() {
        var username = $(this).val();
        $.ajax({
            url: '../action/checker.php',
            method: "POST",
            data: {username:username},
            dataType: "text",
            beforeSend:function() {
                $('#usernameChecking').text('Checking Username..')
            },
            success:function(html) {
                $('#usernameAvailability').html(html);
                $('#usernameChecking').css('display', 'none')
            }
        });
    });


    $('#email').blur(function() {
    var email = $(this).val();
    $.ajax({
        url: '../action/checker.php',
        method: "POST",
        data: {email:email},
        dataType: "text",
        beforeSend:function() {
            $('#emailChecking').text('Checking Email Address..')
        },
        success:function(html) {
            $('#emailAvailability').html(html);
            $('#emailChecking').css('display', 'none')
        }
    });
  });
});