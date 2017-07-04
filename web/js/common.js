//Common & Login JS functions

$( document ).ready(function() {
    
    var url = _teespring_param.baseUrl;
    var csrftoken = _teespring_param.csrftoken;
    
    $("#login").click(function(){
        var username = $("#username").val();
        var password = $("#password").val();
        $("#username").css("border-color","");
        $("#password").css("border-color","");
        if(username==''){
            $("#username").css("border-color","red");
            return false;
        } else if(password==''){
            $("#password").css("border-color","red");
            return false;
        } else{            
            $("#password").val('');
            $.ajax({
            url: url+'site/login',
            type: 'post',
            data: {username: username , userpass:password, _csrf:csrftoken},
            success: function (data) {                
                if (data=='success'){   
					adduserlog();				
                    window.location.href = url;
                } else{
                    console.log("Login Error");
                }
            }
            });
        }
    });
	
	function adduserlog()
	{
        $.ajax({
        url: url+'user/logfunction',
        type: 'get',
        success: function (data) {                
            if (data=='success'){                                    
                console.log("Login log success");
            } else{
                console.log("Login log Error");
            }	
        }
        });
	}
    
    $("#cancelbtn").click(function() {
       var path = $(this).attr('data-url');
        window.location.href = url+path;
    });

});   

