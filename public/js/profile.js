$(document).ready(function() {
    // Save Changes
    $('#saveChangesButton').click(function() {
        const formData = new FormData();
        formData.append('firstName', $('#firstName').val());
        formData.append('lastName', $('#lastName').val());
        formData.append('birthDate', $('#birthDate').val());
        formData.append('email', $('#email').val());
        
        if ($('#profilePictureInput')[0].files[0]) {
            formData.append('profilePicture', $('#profilePictureInput')[0].files[0]);
        }

        $.ajax({
            url: '/profile/update',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert('Profile updated successfully');
            },
            error: function(xhr) {
                alert('Error updating profile');
            }
        });
    });

    // Add Address
    $('#saveAddressButton').click(function() {
        $.ajax({
            url