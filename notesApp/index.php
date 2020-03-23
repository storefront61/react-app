 <?php 
    session_start();
    include('connection.php');
    
   //logout
   include('logout.php');
    //rememberme code
  include('rememberme.php');
  ?>
 
 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Online Notes</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="style.css">
       

    <link href="https://fonts.googleapis.com/css?family=Arvo&display=swap" rel="stylesheet">

    
  </head>
  <body>
           <!-- Navigation Bar -->
           <nav role="navigation" class="navbar navbar-custom navbar-fixed-top">
             <div class="container-fluid">
               <div class="navbar-header">
                 <a href="#" class="navbar-brand">Online Notes</a>
                 <button type="button" class="navbar-toggle" data-target="#navbar-collapse" data-toggle="collapse">
                  <span class="sr-only">Toggle Navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                   
                 </button>
               </div>
               <div class="navbar-collapse collapse" id="navbar-collapse">
                 <ul class="nav navbar-nav">
                   <li class="active"><a href="#">Home</a></li>
                   <li><a href="#">Help</a></li>
                   <li><a href="#">Contact</a></li>
                 </ul>
                 <ul class="nav navbar-nav navbar-right">
                   <li><a href="#loginModal" data-toggle="modal">Login</a></li>
                 </ul>
               </div>
             </div>
           </nav>

           <!-- Jumbotron with sign up button -->
           <div class="jumbotron" id="myContainer">
             <h1>Online Note Pad</h1>
              <p>Take Your Notes with you wherever you go.</p>
             <p>Easy to use, protects all your notes.</p>
             <button type="button" class="btn btn-lg green signup" data-target="#signupModal" data-toggle="modal">Sign up-It's Free</button>
           </div>

           <!-- Login Form -->

           <form method="post" id="loginform">
              <div class="modal" id="loginModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                      <div class="modal-header">
                         <button class="close" data-dismiss="modal">
                           &times;
                         </button> 
                         <h4 id="myModalLabel">Login:</h4>
                      </div>

                      <div class="modal-body">
                        
                        <!-- login message from php file -->
                        <div id="loginmessage"></div>

                        

                        <div class="form-group">
                          <label for="loginemail" class="sr-only">Email</label>
                          <input class="form-control" type="email" name="loginemail" id="loginemail"  placeholder="Email" maxlength="50">
                        </div>

                        <div class="form-group">
                          <label for="loginpassword" class="sr-only">Password</label>
                          <input class="form-control" type="password" name="loginpassword" id="loginpassword"  placeholder="Password" maxlength="30">
                        </div>

                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="rememberme" id="rememberme">
                            Remember me:
                          </label>

                          <a class="pull-right" style="cursor: pointer"data-dismiss="modal" data-target="#forgotpasswordModal" data-toggle="modal">Forgot Password?</a>

                        </div><!-- end checkbox div-->


                        
                      </div><!--end modal body div-->

                           <!-- modal footer -->
                      <div class="modal-footer">
                         <input class="btn green" name="login"  type="submit"  value="Login">
                         <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                         <button type="button" class="btn btn-default pull-left" data-dismiss="modal" data-target="#signupModal" data-toggle="modal">
                           Register
                         </button>
                       </div>
                      </div>
                    </div>
                  </div>
           </form>
           <!--end login form tag -->


           <!-- sign up form -->
           <form method="post" id="signupform">
              <div class="modal" id="signupModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                      <div class="modal-header">
                         <button class="close" data-dismiss="modal">
                           &times;
                         </button> 
                         <h4 id="myModalLabel">Sign up today and Start using our Online Notes App!</h4>         
                      </div>
                      <div class="modal-body">
                        
                        <!-- signup message from php file -->
                        <div id="signupmessage"></div>

                        <div class="form-group">
                          <label for="username" class="sr-only">Username</label>
                          <input type="text" name="username" id="username" class="form-control" placeholder="Username" maxlength="30">
                        </div>

                        <div class="form-group">
                          <label for="email" class="sr-only">Email</label>
                          <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" maxlength="50">
                        </div>

                        <div class="form-group">
                          <label for="password" class="sr-only">Choose a password</label>
                          <input type="password" name="password" id="password" class="form-control" placeholder="Choose a password" maxlength="30">
                        </div>

                        <div class="form-group">
                          <label for="password2" class="sr-only">Confirm password</label>
                          <input type="password" name="password2" id="password2" class="form-control" placeholder="Confirm password" maxlength="30">
                        </div>
                      </div><!--end modal body div-->

                           <!-- modal footer -->
                      <div class="modal-footer">
                         <input type="submit" name="signup" class="btn green" value="Sign up">
                         <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                       </div>
                      </div>
                    </div>
                  </div>
           </form><!--end sign up form tag -->

           <!-- Forgot password form -->
            <form method="post" id="forgotpasswordform">
              <div class="modal" id="forgotpasswordModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                      <div class="modal-header">
                         <button class="close" data-dismiss="modal">
                           &times;
                         </button> 
                         <h4 id="myModalLabel">Forgot Password? Enter your email address:</h4>
                      </div>

                      <div class="modal-body">
                        
                        <!-- forgot password message from php file -->
                        <div id="forgotpasswordmessage"></div>

                        <div class="form-group">
                          <label for="forgotemail" class="sr-only">Email</label>
                          <input type="email" name="forgotemail" id="forgotemail" class="form-control" placeholder="Email" maxlength="50">
                        </div>

                      </div><!--end modal body div-->

                           <!-- modal footer -->
                      <div class="modal-footer">
                         <input type="submit" name="forgotpassword" class="btn green" value="Submit">
                         <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                         <button type="button" class="btn btn-default pull-left" data-dismiss="modal" data-target="#signupModal" data-toggle="modal">
                           Register
                         </button>
                       </div>
                      </div>
                    </div>
                  </div>
           </form><!--end forgot password form tag -->



           <!-- Footer -->
           <div class="footer">
             <div class="container">
               <p>Website Design: &nbsp;<i>Steven A. Greene</i> &nbsp;Copyright &copy; 2017-<?php $today = date("Y"); echo $today; ?></p>
             </div>
           </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    
    <script src="index.js"></script>
  </body>
</html>
