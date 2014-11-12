$(document).ready(function(){
	var container = $("#phrase");

	$.ajax({
		tipe: "POST",
		url : "server.php",
		success: function(response){
			container.html(response);
		} 
	});

});
