function swalbeerdialog(formurl,amount)
{		

	CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

	Swal.fire({
	  title: 'Are you sure?',
	   html:
    'Do you really want to buy ' + amount + ' beers? You can not undo this.'+ 
	'<form id="createform" method="POST" action="' + formurl + '" accept-charset="UTF-8"><input name="_token" type="hidden" value="' + CSRF_TOKEN +'">' +
	'<input name="count" type="hidden" value="' + amount +'">'+ 
	'</form>',
	  icon: 'question',
	  showCancelButton: true,
	  confirmButtonText: 'Yes, I need it!',
	  backdrop: `
			url("/img/nyan-cat.gif")
			left top
			no-repeat
		  `
	}).then((result) => {
	  if (result.value) {
		   $( "#createform" ).submit();
	  }
	});
	
						
					
}

function swaladminswapdialog(ajaxurl,sender)
{		
	Swal.fire({
	  title: 'Are you sure?',
	  text: "You will change the admin status of this user.",
	  icon: 'question',
	  showCancelButton: true,
	  confirmButtonText: 'Yes, do it!',
	  backdrop: `
			url("/img/nyan-cat.gif")
			left top
			no-repeat
		  `
	}).then((result) => {
	  if (result.value) {
		  var ajaxData = {};
		   $.ajax({
		  url: ajaxurl,
		  type: 'Post',
		  dataType: 'json',
		  success: function (xhr, ajaxOptions, thrownError) {
				toastr.success(xhr.msg, '');
				if (xhr.admin)
				{
				$(sender).addClass('btn-primary').removeClass('btn-secondary');
				}
				else
				$(sender).addClass('btn-secondary').removeClass('btn-primary');	
				},
		  error: function (xhr, ajaxOptions, thrownError) {
				toastr.error('Status '+xhr.responseJSON.msg, 'Error');
				}
			});
		
	  }
	});
}



 function submitrecieptdialog(formurl,sender)
{
	CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	
	Swal.fire({
  title: 'How much has been paid?',
   html:
    'Please enter the amount in € and use negative values if you got money from the beer community.'+ 
	'<form id="paidform" method="POST" action="' + formurl + '" accept-charset="UTF-8"><input name="_token" type="hidden" value="' + CSRF_TOKEN +'">' +
	'<input autocapitalize="off" class="swal2-input" name="amount" placeholder="amount" type="number" step="0.01" style="display: flex; max-width: 50em;">'+ 
	'<input autocapitalize="off" class="swal2-input" name="description" placeholder="description" type="text" style="display: flex;">' + 
	'</form>',
  inputAttributes: {
    autocapitalize: 'off'
  },
  showCancelButton: true,
  confirmButtonText: 'Insert',
  showLoaderOnConfirm: true,
  allowOutsideClick: () => !Swal.isLoading()
}).then((result) => {
	  if (result.value) {
		   $( "#paidform" ).submit();
	  }
	});
	
}