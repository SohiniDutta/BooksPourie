$('#userslist').on('click','.edit_info',function (e) {
	let row = $($(this)).closest('tr'); 
    let data = $("#userslist").dataTable().fnGetData(row);
    if (data.id) {
    	window.location.href=localurl+"users/edit/"+btoa(data.id);
    }
});

$('#userslist').on('click','.change_status',function(e){
	let row = $($(this)).closest('tr'); 
    let data = $("#userslist").dataTable().fnGetData(row);
    if(data.id == null) {
		alert("Something went wrong.Please try again");
		e.preventDefault();
	} else {
		
	    let url = localurl+"users/changeStatus";
		let postData = {"id" : btoa(data.id), "type" : "users"};
		let successCb = function(response) {
			if(response != '') {
				if(response.status) {
					let table = $('#userslist').DataTable();
					table.ajax.reload();
				} else {
					alert(response.message);
					e.preventDefault();
				}
			}
		};
		let errorCb = function(error) {
			alert("Something went wrong. Please try again later");
		};
		ajaxCallJson(postData,url,successCb,errorCb);
	}
});
