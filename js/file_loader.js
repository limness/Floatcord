
$('body').ready(function() {
	$("#load_file").on("change", function(e) {
		var files = $(this)[0].files;
		var filename = e.target.value.split('\\').pop();

		$("#label_span").text(filename);
		$("#submit_load").visible();
	});
	(function($) {
	    $.fn.invisible = function() {
	        return this.each(function() {
	            $(this).css("visibility", "hidden");
	        });
	    };
	    $.fn.visible = function() {
	        return this.each(function() {
	            $(this).css("visibility", "visible");
	        });
	    };
	}(jQuery));
});
