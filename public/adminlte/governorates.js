// // governorates.js
// $(function() {
//     $('[data-toggle="tooltip"]').tooltip();
// });

// document.addEventListener('DOMContentLoaded', function() {
//     // SweetAlert for Delete
//     document.querySelectorAll('.delete-btn').forEach(function(btn) {
//         btn.addEventListener('click', function(e) {
//             e.preventDefault();
//             Swal.fire({
//                 title: 'Are you sure?',
//                 text: 'You will not be able to recover this governorate!',
//                 icon: 'warning',
//                 showCancelButton: true,
//                 confirmButtonColor: '#c0392b',
//                 cancelButtonColor: '#6c757d',
//                 confirmButtonText: 'Yes, delete it!'
//             }).then((result) => {
//                 if (result.isConfirmed) {
//                     btn.closest('form').submit();
//                 }
//             });
//         });
//     });
//     // SweetAlert for Save (Edit)
//     document.querySelectorAll('.save-btn').forEach(function(btn) {
//         btn.addEventListener('click', function(e) {
//             e.preventDefault();
//             Swal.fire({
//                 title: 'Confirm Edit',
//                 text: 'Are you sure you want to save changes to this governorate?',
//                 icon: 'question',
//                 showCancelButton: true,
//                 confirmButtonColor: '#e74c3c',
//                 cancelButtonColor: '#6c757d',
//                 confirmButtonText: 'Yes, save it!'
//             }).then((result) => {
//                 if (result.isConfirmed) {
//                     btn.closest('form').submit();
//                 }
//             });
//         });
//     });
// });
