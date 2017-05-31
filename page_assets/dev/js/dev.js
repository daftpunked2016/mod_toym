if (typeof location.origin === 'undefined') location.origin = location.protocol + '//' + location.host;
//site_url = location.origin
var link = document.location.href.split('/');
site_url = location.origin + '/' + link[3];

function launchAlert(message, type, alert_elem_container)
{	
	if(alert_elem_container == null) {
		alert_elem_container = $('#alert-message-container');
	}

	var alert_message = "<div class='alert alert-dismissible alert-"+type+"' role='alert' style='display:none'>" +
        "<span type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></span>"+
        message+
        "</div>";

	alert_elem_container.html(alert_message).find('.alert').fadeIn();
}

function replaceTextareaToCkeditor(element, max_word_count) {
  CKEDITOR.replace(element,{
    wordcount:{
      maxWordCount: max_word_count,
    }
  });
}