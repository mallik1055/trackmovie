<html>
<head>

  <meta charset="UTF-8">
  <link rel="shortcut icon" href='./logo.png'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.css">
  <link rel='shortcut icon' href='./images/logo.png'>
  <link rel='stylesheet' href='/js/login.js'>

  <title>TrackMovies-keep track of movies you saw</title>

    <link rel="stylesheet" href="css/temp.css">
    <link rel="stylesheet" href="css/login_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  
</head>

<body style="background-image:url(images/home_bg.jpg);min-width:1100px; min-height:670px; background-size: cover;" >
 
  
  <form class = 'login-form' id= 'login-form' method='POST'  >
    <input type='hidden' name='type'  value='login'>
    <input class="login-field" name="username" placeholder="Enter your username" id="login-name" type="text" required maxlength=10>
    <input class="login-field" name="password" placeholder="Password" type="password" required  maxlength=15>
    <input type="submit" onclick="validorno()"id ="login-button" value="Login" class="login-button" >
  </form>  
  

  <form method='POST' id = 'signup-form' class="sign-up"  style="margin-top: 68px; margin-left: 70%;">
    <h1 class="sign-up-title">Sign up in seconds !</h1>
    <input type='hidden' name='type'  value='signup'>
    <input type="text" class="sign-up-input" placeholder="Enter your First name" name='firstName' autofocus required  maxlength=50>
    <input type="text" class="sign-up-input" placeholder="Enter your Last name" name='lastName' required maxlength=10>
    <input type="text" class="sign-up-input" placeholder="Choose an username" name='username' required  maxlength=10>
    <input type="password" class="sign-up-input" placeholder="Choose a password" name='password'required  maxlength=15> 
    <input type="submit" id = "signup-button" value="Sign me up!" class="sign-up-button" >
  </form>

  <div class = 'login-banner'>
    <div style="text-align:center;color:white;font-size:49px;margin-bottom:30px;">
      <img src='images/logo.png' height="36" width='45'> &nbsp TrackMovies <br>
    </div>     
    <div style="text-align:center;color:white;font-size:26px">
      A perfect place for movie buffs to organise, share and keep track of movies.
    </div>
  </div>

<script>
  $("#login-button").click(function() {
    $("#login-button").innerHTML = 'Logging..';
    var url = "authenticate.php";

    $.ajax({
           type: "POST",
           url: url,
           data: $("#login-form").serialize(), // serializes the form's elements.
           success: function(response){
              response = JSON.parse(response);
              if(response.status == 'pass'){
                location.reload();

              }
              else{
                $("#login-button").innerHTML = 'Login';
                alert(response.message);
              }
               
           }
    });
    return false; // avoid to execute the actual submit of the form.
  });

  $("#signup-button").click(function() {
    $("#signup-button").innerHTML = 'Signing you up..';
    var url = "authenticate.php";
    $.ajax({
           type: "POST",
           url: url,
           data: $("#signup-form").serialize(), // serializes the form's elements.
           success: function(response){
              response = JSON.parse(response);
              if(response.status == 'pass'){
                  //alert(response.status);
                  location.reload();
              }
              else{
                $("#signup-button").innerHTML = 'Sign me up!';
                alert(response.message);
              }
           }
    });
    return false; // avoid to execute the actual submit of the form.
  });

</script>
  


</body>

</html>
