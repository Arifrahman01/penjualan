"use strict";

function spinner() {
  return '<div class="modal-header">' +
      '     <h4 class="modal-title">Please Wait</h4>' +
      '     <button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
      '         <span aria-hidden="true">&times;</span>' +
      '     </button>' +
      ' </div>' +
      ' <div class="modal-body">' +
      ' <div class="text-center">' +
      '<i class="fa fa-spinner fa-spin fa-5x"></i>' +
      '<h5>Please Wait...</h5>' +
      ' </div>' +
      ' </div>' +
      ' <div class="modal-footer float-right">' +
      '     <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>' +
      ' </div>'

}

function error_page(status) {
  return '<div class="modal-header">' +
      '     <h4 class="modal-title">Error</h4>' +
      '     <button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
      '         <span aria-hidden="true">&times;</span>' +
      '     </button>' +
      ' </div>' +
      ' <div class="modal-body">' +
      '<p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Ada kegagalan proses, silahkan cek kembali data anda</p>' +
      ' </div>' +
      ' <div class="modal-footer float-right">' +
      '     <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>' +
      ' </div>'
}
$(document).keydown(function (event) {
  if (event.keyCode == 27) {
      // close modal on ESC
      $('.modal').modal('hide');
  }
});

function modalForm(url) {
  var modal_id = $(".modal-button").attr('data-target');
  $('.modal-dialog').draggable({ handle: ".modal-header" });
  var date = new Date();
  $(modal_id).find(".modal-content").html(spinner());
  $.getJSON(url, function (data, status) {
      console.log(status  )
      if (status == 'success') {
          if (data.indexOf("A PHP Error") > -1) {
              $(modal_id).find(".modal-content").html(error_page("Ada kegagalan proses. Silahkan hubungi Supervisor Area Anda"));
          } else {
              $(modal_id).find(".modal-content").html(data);
          }
          // console.log(data);
          // load jquery date and time
          date.setDate(date.getDate());

          $("input.disabled-action[type=text]").attr('tabindex', '-1');
          $("input.disabled-action[type=number]").attr('tabindex', '-1');
          $('.disabled-action').find('input, textarea, select').attr('tabindex', '-1');




          // load jquery form vaidation
          $(".submit-btn").on('click', function (event) {
              var formId = '#' + $(this).closest('form').attr('id');
              var btnId = '#' + this.id;
              $(formId).valid();

              $(formId).validate({
                  focusInvalid: false,
                  invalidHandler: function (form, validator) {

                      if (!validator.numberOfInvalids())
                          return;

                      $('html, body').animate({
                          scrollTop: $(validator.errorList[0].element).offset().top
                      }, 1000);

                  }
              });



              if (jQuery(formId).valid()) {
                  // Do something
                  event.preventDefault();

                  addValid(formId, btnId);

              }
          });


      } else if (status == "timeout") {
          $(modal_id).find(".modal-content").html(error_page("Ada kegagalan koneksi server.Silahkan Coba lagi beberapa saat"));
      } else if (status == "error" || status == "parsererror") {
          $(modal_id).find(".modal-content").html(error_page("Ada kegagalan proses.Silahkan Coba lagi beberapa saat"));
      } else {
          $(modal_id).find(".modal-content").html(error_page("Ada kegagalan proses.Silahkan Coba lagi beberapa saat"));
      }
  })
      .fail(function (jqXHR, textStatus, errorThrown) {
          $(modal_id).find(".modal-content").html(error_page("Ada kegagalan proses.Silahkan Coba lagi beberapa saat\n\r" + textStatus));
      });
}
function showModalJs(url = '', tipe_modal = 'modal-lg', data_ = Array()) {
    let token = $('form').find('input[name="_token"]').val()
  $('#' + tipe_modal).find(".modal-content").html(spinner());
  $('#' + tipe_modal).modal('show');
  $.ajax({
      url: url,
      type: "GET",
      dataType: "json",
      data: { data : JSON.stringify(data_)} ,
      headers: {'X-CSRF-TOKEN': token},
      success: function (data, status) {
          if (status) {
              if (data.indexOf("A PHP Error") > -1) {
                  $('#' + tipe_modal).find(".modal-content").html(error_page("Ada kegagalan proses. Silahkan hubungi Supervisor Area Anda"));
              } else {
                  $('#' + tipe_modal).find(".modal-content").html(data);
              }
              // date.setDate(date.getDate());
              $("input.disabled-action[type=text]").attr('tabindex', '-1');
              $("input.disabled-action[type=number]").attr('tabindex', '-1');
              $('.disabled-action').find('input, textarea, select').attr('tabindex', '-1');
              $(".submit-btn").on('click', function (event) {
                  var formId = '#' + $(this).closest('form').attr('id');
                  var btnId = '#' + this.id;
                  $(formId).valid();
                  $(formId).validate({
                      focusInvalid: false,
                      invalidHandler: function (form, validator) {
                          if (!validator.numberOfInvalids())  
                              return;
                          $('html, body').animate({
                              scrollTop: $(validator.errorList[0].element).offset().top
                          }, 1000);
                      }
                  });
                  if (jQuery(formId).valid()) {
                      // Do something
                      event.preventDefault();
                      addValid(formId, btnId);
                  }
              });
        
      } else if (status == "timeout") {
          $('#' + tipe_modal).find(".modal-content").html(error_page("Ada kegagalan koneksi server.Silahkan Coba lagi beberapa saat"));
      } else if (status == "error" || status == "parsererror") {
            $('#' + tipe_modal).find(".modal-content").html(error_page("Ada kegagalan proses.Silahkan Coba lagi beberapa saat"));
      } else {
            $('#' + tipe_modal).find(".modal-content").html(error_page("Ada kegagalan proses.Silahkan Coba lagi beberapa saat"));
      }}
  })
      .fail(function (jqXHR, textStatus, errorThrown) {
            $('#' + tipe_modal).find(".modal-content").html(error_page("Ada kegagalan proses. Silahkan hubungi Supervisor Area Anda\n\r" + textStatus));
      });
}