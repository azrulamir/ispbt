<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax {

	function load()
	{

		$output = "
		<script type=\"text/javascript\">
		$(document).ready(function() {

			$('.modal-trigger').click(function(e) {

				e.preventDefault();

				var id = $(this).attr('rel');
				var url = $(this).attr('href');
				var newurl = url + '/' + id;

				$.ajax({
					type: 'POST',
					url: newurl,
					success: function(html) {
						$('#modal-dialog').empty();
						$('#modal-dialog').append(html);

						var dialogH = $('#modal-dialog').height();
						var dialogW = $('#modal-dialog').width();
						$('#modal-dialog').css({ 'width' : dialogW, 'height' : dialogH });

						var maskHeight = $(document).height();
						var maskWidth = $(window).width();
						$('#modal-mask').css({'width' : maskWidth, 'height' : maskHeight});
						$('#modal-mask').fadeTo(\"fast\",0.6);

						var winH = $(window).height();
						var winW = $(window).width();
						var winS = $(window).scrollTop();

						$('#modal-dialog').css('top',  winH/2 - dialogH / 2 + winS);
						$('#modal-dialog').css('left', winW/2 - dialogW / 2);
						$('#modal-dialog').fadeIn(300);

					}

				});

			});

			$('.modal-button-trigger').click(function() {

				var url = $(this).attr('alt');
				var id = $(this).attr('id');
				var newurl = url;

				$.ajax({
					type: 'POST',
					url: newurl,
					success: function(html) {
						$('#modal-dialog').empty();
						$('#modal-dialog').append(html);

						var dialogH = $('#modal-dialog').height();
						var dialogW = $('#modal-dialog').width();
						$('#modal-dialog').css({ 'width' : dialogW, 'height' : dialogH });

						var maskHeight = $(document).height();
						var maskWidth = $(window).width();
						$('#modal-mask').css({'width' : maskWidth, 'height' : maskHeight});
						$('#modal-mask').fadeTo(\"fast\",0.6);

						var winH = $(window).height();
						var winW = $(window).width();
						var winS = $(window).scrollTop();

						$('#modal-dialog').css('top',  winH/2 - dialogH / 2 + winS);
						$('#modal-dialog').css('left', winW/2 - dialogW / 2);
						$('#modal-dialog').fadeIn(300);

					}

				});

			});

			$('#modal-mask').click(function() {
				$('#modal-dialog').hide();
				$('#modal-dialog').empty();
				$('#modal-dialog').css({ 'width' : 'auto', 'height' : 'auto' });
				$(this).hide();
				$('#modal-dialog').append('Loading...');
			});

		});
		</script>
		";

		return $output;
	}

}
