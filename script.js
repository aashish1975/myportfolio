function sendMail(event) {
    event.preventDefault();  // Prevent form refresh on submit
    
    // Create the params object to be passed to emailjs
    let params = {
        to_name: 'Aashish Sharma', // Change this if needed
        from_name: document.getElementById("name").value,
        from_email: document.getElementById("email").value,
        subject: document.getElementById("subject").value,
        message: document.getElementById("message").value
    };

    // Show loading message while sending the email
    document.querySelector('.loading').style.display = 'block';

    // Use EmailJS to send the email
    emailjs.send("service_6zwydd8", "template_4b6632g", params)
        .then(function(response) {
            // Hide the loading message
            document.querySelector('.loading').style.display = 'none';
            // Show the success message
            document.querySelector('.sent-message').style.display = 'block';
            console.log('SUCCESS!', response.status, response.text);
        }, function(error) {
            // Hide the loading message
            document.querySelector('.loading').style.display = 'none';
            // Show the error message
            document.querySelector('.error-message').innerText = "Failed to send email: " + error.text;
            document.querySelector('.error-message').style.display = 'block';
            console.log('FAILED...', error);
        });
}
