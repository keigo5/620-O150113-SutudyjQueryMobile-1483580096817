(function(){
	$.ajax({
		url: 'http://localhost/620-O150113-SutudyjQueryMobile-1483580096817/jQueryMobile/tenki.php'
	}).then(
	function(data, status, xhr) {
		$('#forecast').html(data);
	},
	function(xhr, status, error) {
		console.log(error);
	});
})();