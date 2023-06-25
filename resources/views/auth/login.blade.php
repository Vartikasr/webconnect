<!DOCTYPE html>
<html>
<head>
  <title>Login Form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style>
    .container {
      max-width: 400px;
      margin: 50px auto;
    }

    .error {
      color: red;
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#login-form').validate({
        errorElement: 'div',
        errorClass: 'error',
        rules: {
          email: {
            required: true,
            email: true
          }
        },
        messages: {
          email: {
            required: 'Please enter your email',
            email: 'Please enter a valid email address'
          },
          password: {
            required: 'Please enter your password'
          }
        },
        submitHandler: function(form) {
          $.ajax({
            url: $(form).attr('action'),
            type: 'POST',
            data: $(form).serialize(),
            success: function(response) {
              // Handle successful login
              alert('Login successful!');

        if (response.redirect_url) {

            window.location.href = response.redirect_url;
        }
    }
            },
            error: function(xhr) {
              // Handle login errors
              alert('Login failed. Please check your credentials.');
              // Display error message or perform other actions
            }
          });
          return false; // Prevent form submission
        }
      });
    });
  </script>
</head>
<body>
  <div class="container">
    <h2>Login Form</h2>
    <form id="login-form" action="{{ url('checklogin') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
  </div>
</body>
</html>
