function toggleChecked(status) {
	
	$(".checkbox").each(function() {
	
		var disabled = $(this).attr("disabled");
		var checked = $(this).attr("checked");
		
		if (disabled != "disabled")
		{
			$(this).attr("checked", status);
		}
		
	});
	
	$(".damagebooks").each(function() {
		
		var fixed = $(this).attr("alt");
			
		if ((status == true) && (fixed != "fixed"))
		{
			$(this).attr("disabled", false);
		}
		else
		{
			$(this).attr("disabled", true);
		}
		
	});
	
}

function outDamageToggle(status, id) {

	$(".damagebooks").each(function() {
		
		if ($(this).attr("value") == id)
		{
			if (status == true)
			{
				$(this).attr("disabled", false);
			}
			else
			{
				$(this).attr("disabled", true);
				$(this).attr("checked", false);
			}
		}
	});
}

function inDamageToggle(status, id) {

	$(".damagebooks").each(function() {
		
		if ($(this).attr("value") == id)
		{
			var fixed = $(this).attr("alt");

			if ((status == false) && (fixed != "fixed"))
			{
				$(this).attr("disabled", true);
				$(this).attr("checked", false);
			}
			else if ((status == true) && (fixed != "fixed"))
			{
				$(this).attr("disabled", false);
			}
		}
		
	});
}

function toggleConfirm() {
	$('#modal-confirmlink').fadeIn('300');
	$('#confirm').css({'border' : '1px solid #E8E8E8'});
}
