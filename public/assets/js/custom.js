/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

function deleteConfirmation(ev) {
  ev.preventDefault();
  let urlToRedirect = ev.currentTarget.getAttribute('href');

  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'No, cancel!',
    reverseButtons: true
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = urlToRedirect;
    }
  })
}
$('.datefilter').daterangepicker({
  autoUpdateInput: false,
  locale: {
    cancelLabel: 'Clear'
  }
});

// $('.datefilter').on('apply.daterangepicker', function (ev, picker) {
//   $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
// });
// $('.datefilter').on('cancel.daterangepicker', function (ev, picker) {
//   $(this).val('');
// });

$('.datefilter').daterangepicker({
  autoUpdateInput: false,
  locale: {
      cancelLabel: 'Clear',
      format: 'YYYY-MM-DD'
  }
});

$('.datefilter').on('apply.daterangepicker', function(ev, picker) {
  $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
});

$('.datefilter').on('cancel.daterangepicker', function(ev, picker) {
  $(this).val('');
});


// $('.datefilter').daterangepicker({
//   autoUpdateInput: false,
//   opens: 'right',
//   locale: {
//     format: 'YYYY-MM-DD'
//   }
// }, function(start, end, label) {

// });