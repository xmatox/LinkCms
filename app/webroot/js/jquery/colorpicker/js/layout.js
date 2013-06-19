(function($){
	var initLayout = function() {
		$('#zp_fondcolor').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val("#"+hex);
				$(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				$('#zp_fondcolor').ColorPickerSetColor(this.value);
			},
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#zp_fondcolor').val("#"+hex);
			}
		})
		.bind('keyup', function(){
			$('#zp_fondcolor').ColorPickerSetColor(this.value);
		});
		$('#zpe_fondcolor').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val("#"+hex);
				$(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				$('#zpe_fondcolor').ColorPickerSetColor(this.value);
			},
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#zpe_fondcolor').val("#"+hex);
			}
		})
		.bind('keyup', function(){
			$('#zpe_fondcolor').ColorPickerSetColor(this.value);
		});
		$('#zpe_border2').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val("#"+hex);
				$(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				$('#zpe_border2').ColorPickerSetColor(this.value);
			},
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#zpe_border2').val("#"+hex);
			}
		})
		.bind('keyup', function(){
			$('#zpe_border2').ColorPickerSetColor(this.value);
		});
		$('#zpe_textcolor').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val("#"+hex);
				$(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				$('#zpe_textcolor').ColorPickerSetColor(this.value);
			},
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#zpe_textcolor').val("#"+hex);
			}
		})
		.bind('keyup', function(){
			$('#zpe_textcolor').ColorPickerSetColor(this.value);
		});
		$('.textcolor').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val("#"+hex);
				$(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor(this.value);
			},
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$(this).val("#"+hex);
				console.log(this);
			}
		})
		.bind('keyup', function(){
			$(this).ColorPickerSetColor(this.value);
		});
	};
	
	
	EYE.register(initLayout, 'init');
})(jQuery)