$(document).on('pageshow', '#main', function(){
	$.ajax({
		url: './tenki.php'
	}).then(
	function(data, status, xhr) {
		$('#forecast').html(data);
	},
	function(xhr, status, error) {
		console.log(error);
	});
});