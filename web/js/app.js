//console.log("Hi this is web folder of E: tshirtbomb");
//Application JS functions

var url = _teespring_param.baseUrl;
var csrftoken = _teespring_param.csrftoken;

function setapproles(elm){
    var roleid    =    $(elm).attr('data-roleid');
    var roleappid =    $(elm).attr('data-roleappid');
    var appid =    $(elm).attr('data-appid');
    var roleappstatus = 0;
    if($(elm).prop("checked") == true){    
        roleappstatus = 1;
    }
    var mode = 'update';
    if(roleappid == 0){
        mode = 'insert';
    }
    $.ajax({
        url: url+'roles/setapproles',
        data: {'mode':mode,'roleid':roleid,'roleappid':roleappid,'status':roleappstatus,'appid':appid, _csrf:csrftoken},
        type: "post",
        dataType: "json",            
        success: function(data){
            
        }
    });      
}


function setdefaultrole(elm){
    var roleid    =    $(elm).attr('data-roleid');
    var rolestatus    =    1;        
    $.ajax({
        url: url+'roles/update-default-role',
        data: {'roleid': roleid,'status': rolestatus, _csrf:csrftoken},
        type: "post",
        dataType: "json",            
        success: function(data){
            
        }
    });
}

function redirect(){
    var path = $('#cltaction').attr('data-url');
    path = url+path;    
    window.location = path;
}


function setuserrole(elm){
    var clturl = '';
    var userroleid = $(elm).attr('data-userroleid');
    var userid = $(elm).attr('data-userid');
    var roleid = $(elm).val();
    if(userroleid>0){
        clturl = url+'roles/update-user-role';
    } else{
        clturl = url+'roles/add-user-role';
    }
    $.ajax({
        url: clturl,
        data: {'roleid': roleid,'userid': userid,'userroleid':userroleid, _csrf:csrftoken},
        type: "post",                 
        success: function(data){
            
        }
    });
}