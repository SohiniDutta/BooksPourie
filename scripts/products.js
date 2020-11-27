$('#mastercategorylist').on('click','.edit_info',function (e) {
	let row = $($(this)).closest('tr'); 
    let data = $("#mastercategorylist").dataTable().fnGetData(row);
    if (data.id) {
    	window.location.href=localurl+"products/edit-master-category/"+btoa(data.id);
    }
});

$('#subcategorylist').on('click','.edit_info',function (e) {
	let row = $($(this)).closest('tr'); 
    let data = $("#subcategorylist").dataTable().fnGetData(row);
    if (data.id) {
    	window.location.href=localurl+"products/edit-sub-category/"+btoa(data.id);
    }
});

$('#brandlist').on('click','.edit_info',function (e) {
	let row = $($(this)).closest('tr'); 
    let data = $("#brandlist").dataTable().fnGetData(row);
    if (data.id) {
    	window.location.href=localurl+"products/edit-brand/"+btoa(data.id);
    }
});

$('#mastercategorylist').on('click','.change_status',function(e){
	let row = $($(this)).closest('tr'); 
    let data = $("#mastercategorylist").dataTable().fnGetData(row);
    if(data.id == null) {
		alert("Something went wrong.Please try again");
		e.preventDefault();
	} else {
		
	    let url = localurl+"products/changeStatus";
		let postData = {"id" : btoa(data.id), "type" : "mastercategory"};
		let successCb = function(response) {
			if(response != '') {
				if(response.status) {
					let table = $('#mastercategorylist').DataTable();
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

$(document.body).on('change','.master_category_id',function(e){
	let master_category_id = $(this).val();
    if(master_category_id == '') {
		alert("Something went wrong.Please try again");
		e.preventDefault();
	} else {
		
	    let url = localurl+"products/getSubCategoriesFromMaster_ajax";
		let postData = {"id" : master_category_id};
		let successCb = function(response) {
			if (response) {
				if (response.status) {
					let html = '';
					html += '<option value="" selected>Select sub category</option>';
					if (response.data && !($.isEmptyObject(response.data))) {
						for (var i = response.data.length - 1; i >= 0; i--) {
							html += '<option value="'+response.data[i]['id']+'">'+response.data[i]['category_name']+'</option>';
						}
						if (html) {
							$('.sub_category_id').html(html);
						}
					} else {
						$('.sub_category_id').html(html);
					}
				}
			}
		};
		let errorCb = function(error) {
			console.log('error ',error);
			alert("Something went wrong. Please try again later");
		};
		ajaxCallJson(postData,url,successCb,errorCb);
	}
});

$('#subcategorylist').on('click','.change_status',function(e){
	let row = $($(this)).closest('tr'); 
    let data = $("#subcategorylist").dataTable().fnGetData(row);
    if(data.id == null) {
		alert("Something went wrong.Please try again");
		e.preventDefault();
	} else {
	    let url = localurl+"products/changeStatus";
		let postData = {"id" : btoa(data.id), "type" : "subcategory"};
		let successCb = function(response) {
			if(response != '') {
				if(response.status) {
					let table = $('#subcategorylist').DataTable();
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

$('#brandlist').on('click','.change_status',function(e){
	let row = $($(this)).closest('tr'); 
    let data = $("#brandlist").dataTable().fnGetData(row);
    if(data.id == null) {
		alert("Something went wrong.Please try again");
		e.preventDefault();
	} else {
		
	    let url = localurl+"products/changeStatus";
		let postData = {"id" : btoa(data.id), "type" : "brand"};
		let successCb = function(response) {
			if(response != '') {
				if(response.status) {
					let table = $('#brandlist').DataTable();
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

$('#productslist').on('click','.price_info', function(e) {
	let row = $($(this)).closest('tr'); 
    let data = $("#productslist").dataTable().fnGetData(row);
    if (data.id) {
  	  window.location.href = localurl + 'products/price/'+data.id;
    }
});

$('#productslist').on('click','.edit_info', function(e) {
	let row = $($(this)).closest('tr'); 
    let data = $("#productslist").dataTable().fnGetData(row);
    if (data.id) {
  	  window.location.href = localurl + 'products/edit/'+data.id;
    }
});

$('#productslist').on('click','.change_status',function(e){
	let row = $($(this)).closest('tr'); 
    let data = $("#productslist").dataTable().fnGetData(row);
    if(data.id == null) {
		alert("Something went wrong.Please try again");
		e.preventDefault();
	} else {
		
	    let url = localurl+"products/changeStatus";
		let postData = {"id" : btoa(data.id), "type" : "product"};
		let successCb = function(response) {
			if(response != '') {
				if(response.status) {
					let table = $('#productslist').DataTable();
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

$('#productslist').on('click','.delete_product',function(e){
	let row = $($(this)).closest('tr'); 
    let data = $("#productslist").dataTable().fnGetData(row);
    if(data.id == null) {
		alert("Something went wrong.Please try again");
		e.preventDefault();
	} else {
		
	    let url = localurl+"products/deleteProduct";
		let postData = {"id" : btoa(data.id), "type" : "product"};
		let successCb = function(response) {
			if(response != '') {
				if(response.status) {
					let table = $('#productslist').DataTable();
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