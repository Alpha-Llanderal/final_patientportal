// public/js/profile.js
$(document).ready(function() {
    // Profile Picture Upload Handling
    $('#uploadButton').click(function() {
        $('#profilePictureInput').click();
    });

    $('#profilePictureInput').change(function() {
        if (this.files && this.files[0]) {
            // Show preview immediately
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#profilePicture').attr('src', e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Save Changes (Including Profile Picture)
    $('#saveChangesButton').click(function() {
        const formData = new FormData();
        formData.append('firstName', $('#firstName').val());
        formData.append('lastName', $('#lastName').val());
        formData.append('birthDate', $('#birthDate').val());
        formData.append('email', $('#email').val());
        
        // Add profile picture if selected
        if ($('#profilePictureInput')[0].files[0]) {
            formData.append('profilePicture', $('#profilePictureInput')[0].files[0]);
        }

        // Show loading state
        $('#saveChangesButton').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...');

        $.ajax({
            url: '/profile/update',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                showAlert('success', 'Profile updated successfully');
            },
            error: function(xhr) {
                showAlert('danger', 'Error updating profile: ' + (xhr.responseJSON?.message || 'Unknown error'));
            },
            complete: function() {
                // Reset button state
                $('#saveChangesButton').prop('disabled', false).html('Save Changes');
            }
        });
    });

    // Separate Profile Picture Upload (if needed)
    function uploadProfilePicture() {
        if ($('#profilePictureInput')[0].files[0]) {
            var formData = new FormData();
            formData.append('profile_picture', $('#profilePictureInput')[0].files[0]);

            // Show loading state
            $('#uploadButton').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Uploading...');

            $.ajax({
                url: '/profile/upload-picture',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        $('#profilePicture').attr('src', response.path);
                        showAlert('success', 'Profile picture updated successfully!');
                    } else {
                        showAlert('danger', 'Error: ' + response.message);
                    }
                },
                error: function(xhr) {
                    showAlert('danger', 'Error uploading profile picture: ' + (xhr.responseJSON?.message || 'Unknown error'));
                },
                complete: function() {
                    // Reset button state
                    $('#uploadButton').prop('disabled', false).html('<i class="bi bi-upload me-1"></i>Upload Photo');
                }
            });
        }
    }

    // Add Address
    $('#saveAddressButton').click(function() {
        $.ajax({
            url: '/profile/address',
            method: 'POST',
            data: {
                address: $('#newAddress').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                showAlert('success', 'Address added successfully');
                // Refresh address list or add to DOM
            },
            error: function(xhr) {
                showAlert('danger', 'Error adding address: ' + (xhr.responseJSON?.message || 'Unknown error'));
            }
        });
    });

    // Utility function for showing alerts
    function showAlert(type, message) {
        const alertHtml = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`;
        
        // Remove existing alerts
        $('.alert').remove();
        
        // Add new alert
        $('#alertContainer').html(alertHtml);
        
        // Auto-dismiss after 5 seconds
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);
    }
});