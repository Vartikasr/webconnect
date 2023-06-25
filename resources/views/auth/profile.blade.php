<!DOCTYPE html>
<html>
<head>
    <title>Profile Page Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .profile-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .error {
      color: red;
    }
        .profile-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h2>Profile Form</h2>
        <form id="profileForm" action="{{ url('update_profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name"  value="{{ $user->first_name ?? '' }}"placeholder="Enter your First name">
            </div>
            <div class="form-group">
                <label for="name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name ?? '' }}" placeholder="Enter your Last name">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" readonly name="email" value="{{ $user->email ?? '' }}" placeholder="Enter your email">
            </div>
            <div class="form-group">
                <label for="profileImage">Profile Image</label>
                @if(isset($user->image))
                <img src="{{ asset('storage/' . $user->image) }}" alt="Profile Image">
                @else
                 <img src="{{ asset('avatars/avatar.png') }}" alt="Profile Image">
                 @endif
                <input type="file" class="form-control-file" id="profileImage" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#profileForm').validate({
                rules: {
                    first_name: 'required',
                    last_name: 'required',
                    email: {
                        required: true,
                        email: true
                    },
                    profileImage: 'required'
                },
                messages: {
                    first_name: 'Please enter your first name',
                    last_name: 'Please enter your last name',
                    email: {
                        required: 'Please enter your email',
                        email: 'Please enter a valid email address'
                    },
                    profileImage: 'Please select a profile image'
                },
                submitHandler: function(form) {
                    // Form submission logic here
                    // You can use AJAX to submit the form data to the server
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>
