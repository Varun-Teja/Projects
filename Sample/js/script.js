$(function() {
	$("#menu").blur(function(event){
		var width = window.innerWidth;
		if(width < 768){
			$("#collapse-menu").collapse('hide');
		}
	});
});

