<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type="text/css" src="{{ asset('css/common.css') }}"></style>
</head>
<body>
     <h2>Sign Up</h2>

     <a href="{{ route('login') }}">Login</a>
    <form method="POST" id="signUpForm" action="{{ route('user.signup') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">First Name:</label>
            <input type="text" class="form-control" id="first_name" name="first_name">
        </div>

        <div class="form-group">
            <label for="name">Last Name:</label>
            <input type="text" class="form-control" id="last_name" name="last_name">
        </div>

        <div class="form-group">
            <label for="name">Phone Number:</label>
            <input type="text" class="form-control" id="phone" name="phone">
        </div>

        <div class="form-group" id="technologiesDiv">
            <label for="name">Technologies:</label>
            <input type="text" class="form-control" id="tech_1" name="technologies[]">
            <button type="button" id="add_more_technologies">Add More</button>
        </div>
        
       
 
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
 
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="form-group">
            <label for="password">Confirm Password:</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
        </div>
 
        <div class="form-group">
            <button style="cursor:pointer" type="submit" class="btn btn-primary submit">Submit</button>
        </div>
       
    </form>
</body>
<script type="text/javascript" src="{{ asset('js/jquery-2.2.4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.validate.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/sign-up.js') }}"></script>
</html>
 
   
 
