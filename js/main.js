var jQuery_1_8_2 = $.noConflict();
(function ($, undefined) {
	$(function () {
		var form = $('#login-form');
			
		if (form.length > 0) {
			form.validate({
				errorPlacement: function (error, element) {
					error.insertAfter(element.parent());
				},
				onkeyup: false,
				errorClass: "err",
				wrapper: "em"
			});
		}
		
		var groups = $('.group', form).filter(function(){
			return !$(this).hasClass('submit');
		}).click(function(){
			$(groups).removeClass('active');
			$(this).addClass('active');
		});
		$('#name').trigger('click').trigger('focus');
		
	});
})(jQuery_1_8_2);
