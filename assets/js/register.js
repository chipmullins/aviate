$(document).ready(function() {
	$("#register").click(function() {
		$("#loginDiv").slideUp("slow", function(){
			$("#regDiv").slideDown("slow");
		});
	});


	$("#login").click(function() {
		$("#regDiv").slideUp("slow", function(){
			$("#loginDiv").slideDown("slow");
		});
	});
});