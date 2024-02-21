

$(".latest-proc-tab").click(function(){
	$(".latest-proc-tab").removeClass("active");
	var id = $(this).closest('li').attr('id');
	$('#' + id).addClass("active");
});
