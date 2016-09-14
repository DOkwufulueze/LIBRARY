$(document).ready(function()
{
	$('.cat').slick({
		arrows:false,
		autoplay:true,
		draggable:true,
		centerMode:false,
		slidesToShow:1,
		slidesToScroll:1,
		vertical: true,
		swipeToSlide:1
	});
});

function clear(){
	document.login.uname.value="";
	document.login.pword.value="";
}

function popSubfields(field,affected){
	var xhr;
	var msg;
	if(window.XMLHttpRequest){
		xhr=new XMLHttpRequest();
	}
	else if(window.ActiveXObject){
		xhr=new ActiveXObject("Microsoft.XMLHTTP");
	}
	if(xhr){
		xhr.onreadystatechange=function(){//alert(xhr.status);
			if(xhr.readyState==4&&xhr.status==200){
				msg=xhr.responseText;//alert(msg);
				document.getElementById(affected).innerHTML=msg;
			}
		}
		xhr.open("GET","getSubfieldsFromFields.php?field="+field,true);
		xhr.send();
	}
}

function showBooks(affected){
	var xhr;
	var msg;
	var field=document.getElementById("field").options[document.getElementById("field").selectedIndex].value;
	var sbf=document.getElementById("sbf").options[document.getElementById("sbf").selectedIndex].value;
	if(document.getElementById("book")){
		$("#book").hide(1000);
		document.getElementById("book").innerHTML="";
	}
	if(window.XMLHttpRequest){
		xhr=new XMLHttpRequest();
	}
	else if(window.ActiveXObject){
		xhr=new ActiveXObject("Microsoft.XMLHTTP");
	}
	if(xhr){
		xhr.onreadystatechange=function(){//alert(xhr.status);
			if(xhr.readyState==4&&xhr.status==200){
				msg=xhr.responseText;//alert(msg);
				document.getElementById(affected).innerHTML=msg;
				$("#"+affected).show(1000);
			}
		}
		xhr.open("GET","showBooks.php?field="+field+"&sbf="+sbf,true);
		xhr.send();
	}
}

function showFile(id,bookName,affected){
	document.getElementById(affected).innerHTML="<iframe src='books/"+bookName+"' style='width:100%;height:498px;' ></iframe>";
	$("#"+affected).show(1000);
}