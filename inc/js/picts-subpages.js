(function($){
    $(document).on('click', '.dropDown', function(e){
	e.preventDefault();
	$(this).next('.children').slideToggle('fast');
	$(this).next('.sub-menu').slideToggle('fast');
    });
})(jQuery);
