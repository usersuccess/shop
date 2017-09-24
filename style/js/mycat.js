
function SetCookie(name,value)//设置名称name，值value的cookie
{
	var expdate=new Date();
	expdate.setTime(expdate.getTime()+30*60*1000);
	document.cookie=name+"="+value+";expires="+expdate.toGMTString()+";path=/";
	alert("添加商品"+name+"成功!");
	var
	cat=window.open("show_cat.php","cat","toolbar=no,menubar=no,location=no,status=no,width=420,height=280");//打开新窗口
	
		}
		function Deletcookie(name)//删除name的名称
		{
			var exp=new Date();
			exp.setTime(exp.geTime()-1);
			var cval=GetCookie(name);
			document.cookie=name+"="+cval+";expires="+exp.toGMTString();
			}
			function Clearcookie()//清除Cookie
			{
				var temp=document.cookie.split(";");
				var loop3;
				var ts;
				for(loop3=0;loop3<temp.length;loop3++)
				{
					ts=temp[loop3].split("=")[0];
					if(ts.indexOf('mycat')!=-1)
					DeleteCookie(ts);
					}
		
				}
				function getCookieVal(offset){//获取项名称为offset的Cookie的值
				var endstr=document.cookie.indexOf(";",offset);
				if(endstr=-1)
				endstr=document.cookie.length;
				return unescape(document.cookie.substring(offset,endstr));
				
					}
					function GetCookie(name){//取得名称name的cookie的值
					var arg=name+"=";
					var alen=arg.length;
					var clen=document.cookie.length;
					var i=0;
					while(i<clen){
						var j=i+alen;
						if(document.cookie.substring(i,j)==arg)
						return getCookieVal(j);
						i=document.cookie.indexOf(" ",j)+1;
						if(i==0)break;
						}
						return null;
						}