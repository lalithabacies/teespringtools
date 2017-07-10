//Common & Login JS functions

$( document ).ready(function() {
    
    var url = _teespring_param.baseUrl;
    var csrftoken = _teespring_param.csrftoken;
    
    $("#login").click(function(){
        var username = $("#username").val();
        var password = $("#password").val();
		$('#loading').show();
        $("#username").css("border-color","");
        $("#password").css("border-color","");
        if(username==''){
            $("#username").css("border-color","red");
			$('#loading').hide();
            return false;
        } else if(password==''){
            $("#password").css("border-color","red");
			$('#loading').hide();
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
					$('#loading').hide();
					$('#loginerror').hide();
                } else{
                    console.log("Invalid Login Credential");
					$('#loginerror').show();
					$('#loading').hide();
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
                //console.log("Login log success");
                window.location.href = url;
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
	
	/* 
	* Starts for access settings 
	* Getting the userid,appid,accid,flag,status
    * Ajax post data are handling in site/ajax
	* 
	*/
	
	var keys = [];
	$(".details").hide();
	
	$(".app_Stat").each(function(){
		
		var appId	=	$(this).closest('td').find("input.hid_app").val();
		
		if($.inArray(appId, keys)== -1) 
		{
			keys.push(appId);
			var mode	=	0;
			$("input[name*='app_status"+appId+"[]']").each(function(){
			   if($(this).attr('checked')!='checked')
			   {
				   mode=1;
			   }
			});
			if(mode==0)
			$('#'+appId).attr('checked',true);
		}
	});
	
	$(".app_all_Stat").change(function(){
		var app_id=$(this).attr('id');
		if($(this).attr('checked'))
		{
			var status	=	1;
		}
		else
			var status	=	0;
		
		$(".app_Stat").each(function(){
			if($(this).attr('id')=='app_status'+app_id)
			{
				if(status	==	1)
					$(this).attr('checked',true);
				else
					$(this).attr('checked',false);
				var userid	=	$(this).attr('userId');
				var appid	=	$(this).closest('td').find("input.hid_app").val();
				var accid	=	$(this).closest('td').find("input.hid_acc").val();
				setAccess(userid,appid,accid,status);
			}
		});
	});
	$(".app_Stat").change(function(){
		var userid	=	$(this).attr('userId');
		var appid	=	$(this).closest('td').find("input.hid_app").val();
		var accid	=	$(this).closest('td').find("input.hid_acc").val();
		if($(this).attr('checked'))
		{
			var status	=	1;
		}
		else
			var status	=	0;
		
		setAccess(userid,appid,accid,status);
		var mode	=	0;
			$("input[name*='app_status"+appid+"[]']").each(function(){
			   if($(this).attr('checked')!='checked')
			   {
				   mode=1;
			   }
			});
			if(mode==0)
				$('#'+appid).attr('checked',true);
			else
				$('#'+appid).attr('checked',false);
		
	});
	$('#input_search').on('keypress', function(e) {
		var code = (e.keyCode ? e.keyCode : e.which);
		if (code == 13) {
			e.preventDefault();
			var username = $("#input_search").val();
			window.location='access?search='+$(this).val();       
		}
	});	
	
	function setAccess(userid,appid,accid,status)
	{
		if(accid)
				var flag	=	"update";
			else
				var flag	=	"add";
			$.ajax({
			 url: 'ajax',
			 data: {'userid': userid,'appid': appid,'accid': accid,'flag': flag,'status': status },
			 type: "post",
			 datatype: 'json',
			 success: function(data){
				if(data) 
				{
					$('#acc_'+userid+appid).val(data);
				}
			  }
			  }); 
	}
	
    //End of access settings
	
	//Ticket System 
	$( "#app_filter" ).change(function() {
		$id = $(this).val();
		window.location = url+"ticket/index?id="+$id ;
	});
	
	
});   

