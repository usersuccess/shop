var id;
$(function(){
		$("li").each(function(index){
			$(this).mouseover(function(){
				var this_li =$(this);
				id=setTimeout(function(){
					$("li.tab").removeClass('tab');
					$(this).addClass("tab");
					this_li.addClass("tab");
					$("div.show").removeClass('show');
					$("#tab1 div:eq("+index+")").addClass('show');
					},300);
				}).mouseout(function(){
					clearTimeout(id);
				});
		});
	});