document.getElementById('healthForm').addEventListener('submit', function(e) {
    e.preventDefault();
    var form = e.target;
    var formData = new FormData(form);
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', form.action, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            alert('Form submitted successfully!');
            form.reset();
        } else {
            alert('Error submitting form.');
        }
    };
    xhr.send(formData);
});
