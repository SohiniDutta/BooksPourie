function ajaxCallFileUpload(postData,apiurl,successCb,errorCb) {
	$.ajax({
		type: 'POST',
		context:this,
		url: apiurl,
		data: postData,
		processData: false,
		contentType: false,
		success: successCb,
		error: errorCb
	});
}

function ajaxCallJson(postData,apiurl,successCb,errorCb,dataType='json') {
    $.ajax({
        type: 'POST',
        dataType: dataType,
        context:this,
        url: apiurl,
        data: postData,
        success: successCb,
        error: errorCb
    });
}