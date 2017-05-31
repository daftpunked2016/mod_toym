$(document).ready(function() {
  $(document).on('click', '.browse', function(){
    var file = $(this).parent().parent().parent().find('.file');
    file.trigger('click');
  });

  $(document).on('change', '.file', function(){
      var errors = 0;
      var val = $(this).val();
      var file_size =  parseFloat(this.files[0].size/1024/1024).toFixed(2);
      var allowed_file_types = $(this).data('allowed');
      var file_type = val.substring(val.lastIndexOf('.') + 1).toLowerCase();

      if( !allowed_file_types.includes(file_type) ) {
        errors++;
        $(this).val('');
        alert("Invalid File Format! Please select a valid file again.");
      } 

      if(file_size > 3) {
        errors++
        $(this).val('');
        alert("The image you are trying to upload exceeds the Maximum file size (3MB) limit.")
      }

      if(errors == 0) {
        $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
      }
  });

  $('.delete-supporting-image').click(function() {
    if(confirm('Are you sure you want to delete this image uploaded?')) {
      var formData = new FormData();
      formData.append('fid', $(this).data('fid'));
      formData.append('attribute', $(this).data('attribute'));
      

      $.ajax({
         url: site_url + '/'+module+'/portfolio/deletesupportingimage',
         method: "POST",
         data: formData,
         processData: false,  // tell jQuery not to process the data
         contentType: false,  // tell jQuery not to set contentType
         success: function(response) {
              result = JSON.parse(response);
         },
         complete: function() {

              if(result.type) {
                alert(result.message);
                location.reload();
              } else {
                launchAlert(result.message, 'danger');
              }

         },
         error: function() {
              alert("ERROR in running requested function. Page will now reload.");
              location.reload();
         }
      });
    }
  });

  $('.delete-file').click(function() {
    if(confirm('Are you sure you want to delete this file uploaded?')) {
      var formData = new FormData();
      formData.append('fid', $(this).data('fid'));
      formData.append('attribute', $(this).data('attribute'));
      
      $.ajax({
         url: site_url + '/'+module+'/portfolio/deletefile',
         method: "POST",
         data: formData,
         processData: false,  // tell jQuery not to process the data
         contentType: false,  // tell jQuery not to set contentType
         success: function(response) {
              result = JSON.parse(response);
         },
         complete: function() {

              if(result.type) {
                alert(result.message);
                location.reload();
              } else {
                launchAlert(result.message, 'danger');
              }

         },
         error: function() {
              alert("ERROR in running requested function. Page will now reload.");
              location.reload();
         }
      });
    }
  });

  $(document).on('click', '#btn-save, .btn-pager', function() {
    for ( instance in CKEDITOR.instances )
     CKEDITOR.instances[instance].updateElement();

    var $btn = $(this).button('loading');
    var form = $('#portfolio-form');
    var formData = new FormData();
    var formSerialized = form.serializeArray();
    var inputs = form.find('input, select:not([disabled=""]), button, textarea, .btn');
    var page = $(this).data('page');

    $.each(formSerialized,function(key,input){
      formData.append(input.name,input.value);
    });

    $(".file").each(function( index ) {
      if($(this).get(0).files.length != 0) {
        formData.append($(this).attr('name'), $(this)[0].files[0]);
      }
    });

    if(page) {
      formData.append('change_page','1');
    }

    inputs.prop("disabled", true);
    $('.field-error').remove();

    $.ajax({
         url: site_url + '/'+module+'/portfolio/save',
         method: "POST",
         data: formData,
         processData: false,  // tell jQuery not to process the data
         contentType: false,  // tell jQuery not to set contentType
         success: function(response) {
              result = JSON.parse(response);
         },
         complete: function() {
              inputs.prop("disabled", false);
              $btn.button('reset');

              if(result.type) {
                if(result.hasOwnProperty("message"))
                  alert(result.message);
                  
                if(page) {
                  window.location.href = site_url + '/'+module+'/portfolio/build?page='+page;
                } else {
                  location.reload();
                }
              } else {
                launchAlert(result.message, 'danger');
                $("html, body").animate({ scrollTop: 0 }, "slow");

                if(result.hasOwnProperty("field_error_messages")) {
                  launchFieldError(result.field_error_messages);                    
                }
              }

         },
         error: function() {
              alert("ERROR in running requested function. Page will now reload.");
              location.reload();
         }
      });
  });

  $(document).on('click', '#btn-submit', function() {
    var $btn = $(this).button('loading');
    var form = $('#portfolio-form');
    var formData = new FormData();
    var formSerialized = form.serializeArray();
    var inputs = form.find('input, select:not([disabled=""]), button, textarea, .btn');

    $(".file").each(function( index ) {
      if($(this).get(0).files.length != 0) {
        formData.append($(this).attr('name'), $(this)[0].files[0]);
      }
    });

    inputs.prop("disabled", true);

    $.ajax({
         url: site_url + '/'+module+'/portfolio/submit',
         method: "POST",
         data: formData,
         processData: false,  // tell jQuery not to process the data
         contentType: false,  // tell jQuery not to set contentType
         success: function(response) {
              result = JSON.parse(response);
         },
         complete: function() {
              inputs.prop("disabled", false);
              $btn.button('reset');

              if(result.type) {
                if(result.hasOwnProperty("message"))
                  alert(result.message);

                location.reload();
              } else {
                launchAlert(result.message, 'danger');
                $("html, body").animate({ scrollTop: 0 }, "slow");
                
                if(result.hasOwnProperty("field_error_messages")) {
                  launchFieldError(result.field_error_messages);                    
                }
              }

         },
         error: function() {
              alert("ERROR in running requested function. Page will now reload.");
              location.reload();
         }
      });
  });

  $(document).on('click', '#waiver-agree', function() {
    if($(this).is(':checked')) {
      $('#btn-submit').prop('disabled', false).attr('data-original-title', 'Click to SUBMIT Porfolio').attr('data-agree', 1);
    } else {
      $('#btn-submit').prop('disabled', true).attr('data-original-title', 'You must AGREE first with the waiver statements.').attr('data-agree', 0);
    }
  });
   
});



function launchFieldError(field_messages)
{
  var page = $('#page_num').val();

  for (var field in field_messages) {
    var message_str = "";
    var messages = field_messages[field];
    messages.forEach(function(error) {
        message_str += "- "+error+"<br />"
    });

    switch(page) {
      case '1':
        $('#'+field).parent().append('<div class="row"><div class="col-md-12 text-red field-error">'+message_str+'</div></div>').fadeIn();
        break;
      case '2':
        $('#'+field).parent().append('<div class="row"><div class="col-sm-offset-2 col-sm-10 text-red field-error">'+message_str+'</div></div>').fadeIn();
        break;
      case '3':
        $('#'+field).parent().find('.input-group').after('<div class="row"><div class="col-sm-offset-3 col-sm-9 text-red field-error">'+message_str+'</div></div>').fadeIn();
        break;
    }
    
  }
}