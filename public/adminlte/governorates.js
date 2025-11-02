// governorates.js
$(function() {
	if (typeof $ === 'undefined') return;
	$('[data-toggle="tooltip"]').tooltip();
});

document.addEventListener('click', function(e) {
	// Delete button (delegated)
	const deleteBtn = e.target.closest('.delete-btn');
	if (deleteBtn) {
		e.preventDefault();
		Swal.fire({
			title: 'Are you sure?',
			text: 'You will not be able to recover this governorate!',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#c0392b',
			cancelButtonColor: '#6c757d',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {
				deleteBtn.closest('form').submit();
			}
		});
		return;
	}

	// Save (edit) button (delegated)
	const saveBtn = e.target.closest('.save-btn');
	if (saveBtn) {
		e.preventDefault();
		Swal.fire({
			title: 'Confirm Edit',
			text: 'Are you sure you want to save changes to this governorate?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#e74c3c',
			cancelButtonColor: '#6c757d',
			confirmButtonText: 'Yes, save it!'
		}).then((result) => {
			if (result.isConfirmed) {
				saveBtn.closest('form').submit();
			}
		});
		return;
	}

	// Create (AJAX) button (delegated)
	const createBtn = e.target.closest('.create-btn');
	if (createBtn) {
		e.preventDefault();
		const form = createBtn.closest('form');
		if (!form) return;
		const input = form.querySelector("input[name='name']");
		if (!input || !input.value.trim()) {
			if (input) input.classList.add('is-invalid');
			Swal.fire({ icon: 'warning', title: 'Input Required', text: 'Please enter a governorate name before saving.' });
			return;
		}

		const fd = new FormData(form);
		const action = form.getAttribute('action') || window.location.pathname;
		// Get CSRF token from form
		const tokenInput = form.querySelector("input[name='_token']");
		const csrfToken = tokenInput ? tokenInput.value : document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

		fetch(action, {
			method: 'POST',
			headers: {
				'X-Requested-With': 'XMLHttpRequest',
				'X-CSRF-TOKEN': csrfToken
			},
			body: fd,
			credentials: 'same-origin'
		}).then(r => r.json()).then(data => {
			if (data.success) {
				Swal.fire({ icon: 'success', title: 'Created', text: data.message, timer: 1200, showConfirmButton: false });
				// Redirect to last page to show the new record
				const last = data.lastPage || 1;
				window.location.href = '/admin/governorates?page=' + last;
			} else {
				Swal.fire({ icon: 'error', title: 'Error', text: data.message || 'Unable to create governorate' });
			}
		}).catch(err => {
			console.error(err);
			Swal.fire({ icon: 'error', title: 'Error', text: 'Server error' });
		});
		return;
	}
});
