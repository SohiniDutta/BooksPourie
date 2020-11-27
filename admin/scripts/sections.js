$(document.body).on('click','.banner_edit', function() {
	let edit_id = $(this).attr('data-id');

	console.log('edit_id ',localurl+'sections/edit-banner/'+edit_id);
	if (edit_id) {
		window.location.href = localurl+'sections/edit-banner/'+edit_id;
	} else {
		alert('Something went wrong');
	}
	event.preventDefault();
});

$(document.body).on('click','.banner_delete', function() {
	let delete_id = $(this).attr('data-id');
	if (delete_id) {
	    let url = localurl+"sections/delete";
		let postData = {"id" : delete_id, "type" : "banner"};
		let successCb = function(response) {
			location.reload();
		};
		let errorCb = function(error) {
			console.log('error ',error);
			alert("Something went wrong. Please try again later");
		};
		ajaxCallJson(postData,url,successCb,errorCb);		
	}

});