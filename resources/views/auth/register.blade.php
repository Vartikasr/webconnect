<!DOCTYPE html>
<html>
<head>
  <title>Registration Form</title>
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
        $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('#registration-form').validate({
        rules: {
          first_name: {
            required: true
          },
          last_name: {
            required: true
          },
          email: {
            required: true,
            email: true,
          }
        },
        messages: {
          first_name: {
            required: 'Please enter your first name'
          },
           last_name: {
            required: 'Please enter your last name'
          },
          email: {
            required: 'Please enter your email',
            email: 'Please enter a valid email address'
          }
        },
        submitHandler: function(form) {
          $.ajax({
            url: $(form).attr('action'),
            type: 'POST',
            data: $(form).serialize(),
            success: function(response) {
              alert('Registration successful!');
              // Handle any further actions or redirects here
              $(form).trigger('reset');
            },
            error: function(xhr) {
              alert('Registration failed. Please try again.');
              // Handle error or display validation errors if applicable
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
    <h2>Registration Form</h2>
    <form id="registration-form" action="{{ url('store-register') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="name">First Name:</label>
        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter your First name">
      </div>
      <div class="form-group">
        <label for="name">Last Name:</label>
        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter your Last name">
      </div>

      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
      </div>
      <button type="submit" class="btn btn-primary">Register</button>
    </form>
  </div>
</body>
</html>
