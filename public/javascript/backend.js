/**
 * Created by Administrator on 2017/7/11.
 */
function checkMenu(){
    var m_name =document.getElementById('m_name').value;
    var str = "<label class='glyphicon glyphicon-remove'></label>";
    if(m_name == ""){
        document.getElementById('show').style.display="block";
        document.getElementById('error').innerHTML=str+" 菜单名称必须填写！";
        return false;
    }

    return true;
}

function checkMsg(){
    var title =document.getElementById('title').value;
    var source =document.getElementById('source').value;
    //var content =document.getElementById('content').value;

    var str = "<label class='glyphicon glyphicon-remove'></label>";
    if(title == ""){
        document.getElementById('show').style.display="block";
        document.getElementById('error').innerHTML=str+" 新闻标题必须填写！";
        return false;
    }
    if(source == ""){
        document.getElementById('show').style.display="block";
        document.getElementById('error').innerHTML=str+" 新闻来源必须填写！";
        return false;
    }
    /*if(content == ""){
        document.getElementById('show').style.display="block";
        document.getElementById('error').innerHTML=str+" 新闻内容必须填写！";
        return false;
    }*/

    return true;
}

function checkConfig(){
    var sysname =document.getElementById('sysname').value;
    var keyword =document.getElementById('keyword').value;
   var description =document.getElementById('description').value;
    var address =document.getElementById('address').value;
    var copy =document.getElementById('copy').value;
    var phone =document.getElementById('phone').value;
    var author =document.getElementById('author').value;
    var str = "<label class='glyphicon glyphicon-remove'></label>";
    if(sysname == ""){
        document.getElementById('show').style.display="block";
        document.getElementById('error').innerHTML=str+" 系统名称必须填写！";
        return false;
    }
    if(keyword == ""){
        document.getElementById('show').style.display="block";
        document.getElementById('error').innerHTML=str+" 关键字必须填写！";
        return false;
    }
    if(description == ""){
     document.getElementById('show').style.display="block";
     document.getElementById('error').innerHTML=str+" 系统描述必须填写！";
     return false;
     }
    if(address == ""){
        document.getElementById('show').style.display="block";
        document.getElementById('error').innerHTML=str+" 地址必须填写！";
        return false;
    }
    if(copy == ""){
        document.getElementById('show').style.display="block";
        document.getElementById('error').innerHTML=str+" 版权信息必须填写！";
        return false;
    }
    if(phone == ""){
        document.getElementById('show').style.display="block";
        document.getElementById('error').innerHTML=str+" 联系电话必须填写！";
        return false;
    }
    if(author == ""){
        document.getElementById('show').style.display="block";
        document.getElementById('error').innerHTML=str+" 设计者必须填写！";
        return false;
    }

    return true;
}
function checkLogin(){
    var user = document.getElementById('username').value;
    var pass = document.getElementById('password').value;
    var str="<label class='glyphicon glyphicon-remove'></label>";
    if(user == ""){
        document.getElementById('show').style.display="block";
        document.getElementById('error').innerHTML=str+" 用户名不能为空！";
        return false;
    }

    if(pass == ""){
        document.getElementById('show').style.display="block";
        document.getElementById('error').innerHTML=str+" 密码不能为空！";
        return false;
    }
    return true;
}
