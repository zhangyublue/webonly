$(function(){
	//点击切换下载类型
	$(".memberTitle a").each(function(_index){	
		$(".tab:eq(0)").addClass("highlight");
		$(this).click(function(){
			if(_index==3){
				$(".tab canvas").css({"display":"block"});
			}else{
				$(".tab canvas").css({"display":"none"});
			}
			$(".tab").removeClass("highlight").eq(_index).addClass("highlight");									
		});
	});
	//前台下载
	$(".downloadBar").click(function(){
		$.ajax({
			'type':"post",
			'url':"/download/updateNum",
			'data':{"url":$(this).attr("href")},
			success:function(response){
				console.log(response);
			}
		});
		return true;
	});
	////////////////
	$("#changeBtn").click(function(){
		$("#newpic").click();			
	});
	$("#submitBtn").click(function(){		
		$("#tid").change(function(){
			$(".glyphicon-asterisk").html("必须是zip格式");
		});
		if($("#tid").val()=="0"){
			$(".glyphicon-asterisk").html("必须要选择一个主题");
			return false;
		}
		return true;
	});	
});