<!DOCTYPE html>

<html>
<head>
    <style>
        /* panes */
        #welcome_pane {
            position: absolute;
            top: 0;
            width:100%;
            height: 100px;
        }
		
		#button_pane {
			position: absolute;
			top: 100px;
			width: 100%
		}
		
        #content_pane {
			background-image: url(pol-14.jpg);
			background-size: cover;
			background-position: center center;
            position: absolute;
            top: 160px;
            width:100%;
            height: calc(100% - 100px);
        }
        
        /* blanket and modal windows */       
        #blanket {
            display:none;
            position:absolute;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background-color: LightGrey;
            opacity: 0.5;
            z-index: 888;
        }
        
        .modal-window {
            display: none;
            background-color: White;
            width: 300px; height: 250px; border: 1px solid black;
            position: absolute; top: 50px; left: calc(50% - 150px);
            z-index: 999;
            padding: 10px;
        }
		
        .modal-label {
            display: inline-block;
            width: 80px;
        }
    </style>
</head>

<body>
    <div id='welcome_pane'>
        <h1 style='text-align:center'>Welcome To Game Talk</h1>
        <hr>
    </div> 
	
	<div id='button_pane'>
		<button type="button" id = "login_button" class="btn btn-default" style = "padding: 15px 32px; margin-left: 400px">Log In</button>
		<button type="button" id = "signup_button" class="btn btn-default" style = "padding: 15px 32px; margin-left: 500px">Sign Up</button>
	</div>
    
    <div id='content_pane'>
        <!-- blanket for modal windows -->
        <div id='blanket'>
        </div>

        <!-- Log In modal window-->
        <div id='login-box' class='modal-window'>
            <h2 style='text-align:center'>Log In</h2>
            <br>
            <form method='post' action='GameTalk_controller.php'>
                <input type='hidden' name='page' value='StartPage'>
                <input type='hidden' name='command' value='LogIn'>
                <label class='modal-label'>Username:</label>
                <input type='text' name='username' required> <?php if (!empty($error_msg_username)) echo $error_msg_username; ?><br>
                <br>
                <label class='modal-label'>Password:</label>
                <input type='password' name='password' required> <?php if (!empty($error_msg_password)) echo $error_msg_password; ?><br>
                <br>
                <input type='submit'>&nbsp;&nbsp;
                <input id='cancel-login-button' type='button' value='Cancel'>&nbsp;&nbsp;
                <input type='reset'>
            </form>
        </div>
        
        <!-- Sign Up modal window-->
        <div id='signup-box' class='modal-window'>
            <h2 style='text-align:center'>Sign Up</h2>
            <br>
            <form method='post' action='GameTalk_controller.php'>
                <input type='hidden' name='page' value='StartPage'>
                <input type='hidden' name='command' value='SignUp'>
                <label class='modal-label'>Username:</label>
                <input type='text' name='username' required> <?php if (!empty($join_error_msg_username)) echo $join_error_msg_username; ?><br>
                <br>
                <label class='modal-label'>Password:</label>
                <input type='password' name='password' required><br>
                <br>
                <label class='modal-label'>Email:</label>
                <input type='text' name='email' required><br>
                <br>
                <input type='submit'>&nbsp;&nbsp;
                <input id='cancel-signup-button' type='button' value='Cancel'>&nbsp;&nbsp;
                <input type='reset'>
            </form>
        </div>
    </div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    <?php 
        if ($display_type == 'login')
            echo 'show_login();';
        else if ($display_type == 'signup')
            echo 'show_signup();';
        else
           ;
    ?>
        
    function show_login() {
        $('#blanket').css('display', 'block');
        $('#login-box').css('display', 'block');
    };
    
    function show_signup() {
        $('#blanket').css('display', 'block');
        $('#signup-box').css('display', 'block');
    };
    
    $('#login_button').click(function() {
        $('#blanket').css('display', 'block');
        $('#login-box').css('display', 'block');
    });
	
    $('#signup_button').click(function() {
        $('#blanket').css('display', 'block');
        $('#signup-box').css('display', 'block');
    });
	
    $('#blanket').click(function() {
        $('#blanket').css('display', 'none');
        $('#login-box').css('display', 'none');
        $('#signup-box').css('display', 'none');
    });
	
    $('#cancel-login-button').click(function() {
        $('#blanket').css('display', 'none');
        $('#login-box').css('display', 'none');
        $('#signup-box').css('display', 'none');
    });
	
    $('#cancel-signup-button').click(function() {
        $('#blanket').css('display', 'none');
        $('#login-box').css('display', 'none');
        $('#signup-box').css('display', 'none');
    });
</script>