<?php
if (empty($_POST['page'])) {  
                                
    $display_type = 'none';  
                              
    $error_message_username = "";
    $error_message_password = "";
    include ('GameTalk_startpage.php');
    exit();
}

require('GameTalk_model.php');  

session_start();

// When commands come from StartPage
if ($_POST['page'] == 'StartPage')
{
    $command = $_POST['command'];
    switch($command) {  
        case 'LogIn':  
            // if (there is an error in username and password) {
            if (!check_validity($_POST['username'], $_POST['password'])) {
                $error_msg_username = '* Wrong username, or';
                $error_msg_password = '* Wrong password'; 
                                                        
                $display_type = 'login';  
                                           
                include('GameTalk_startpage.php');
            } 
            else {
                $_SESSION['LogIn'] = 'Yes';
                $_SESSION['username'] = $_POST['username'];
                include('GameTalk_mainpage.php');
            }
            exit();

        case 'SignUp':  
            // if (there is an error in username and password) {
            if (check_existence($_POST['username'])) {
                $join_error_msg_username = '* Username exists';
                $display_type = 'signup';  
                                           
                include('GameTalk_startpage.php');
            } 
            else if (signup($_POST['username'], $_POST['password'], $_POST['email'])) {
                $error_msg_username = '';
                $error_msg_password = ''; 
                $display_type = 'login';
                include('GameTalk_startpage.php');
            } 
            else {
                $join_error_msg_username = '* Something wrong';
                $display_type = 'signup';  
                                           
                include('GameTalk_startpage.php');
            }
            exit();
        //...
    }
}

// When commands come from 'MainPage'
else if ($_POST['page'] == 'MainPage') 
{
    if (!isset($_SESSION['LogIn'])) {
        $display_type = 'none';
        include('GameTalk_startpage.php');
        exit();
    }
    
    $command = $_POST['command'];
    switch($command) {	
		case 'UpdateUsername':
			$userid = get_user_id($_SESSION['username']);
			$result = update_username($userid, $_POST['u-username']);
			
			if ($result)
			{
				echo "Username Changed!";
			}
			else
			{
				echo "Username Change Failed";
			}
			break;
		case 'UpdatePassword':
			$userid = get_user_id($_SESSION['username']);
			$result = update_password($userid, $_POST['u-password']);
			
			if ($result)
			{
				echo "Password Changed!";
			}
			else
			{
				echo "Password Change Failed";
			}
			break;
		case 'Unsubscribe':
            $display_type = 'none';
			$userid = get_user_id($_SESSION['username']);
			$result = unsubscribe($userid);
			session_unset();
            session_destroy();  
			
			if($result)
			{
				include('GameTalk_startpage.php');
			}
			else
			{
				echo "Termination Failed";
			}
			break;
        case 'PostAReview':
            $result = post_a_review($_POST['title'], $_POST['rating'], $_POST['review'], $_SESSION['username']);			
			if ($result)
			{
				echo "Post Successful!";
			}
			else
			{
				echo "Post Unsuccessful!";
			}
            break;
        case 'SearchReviews':
            $data = search_reviews($_POST['search-term']);
			$myJSON = json_encode($data);
			echo $myJSON;			
            break;
		case 'Upvote':
			$result = upvote($_POST['ID']);
			
			if ($result)
			{
				echo "Upvote Successful!";
			}
			else
			{
				echo "Upvote Unsuccessful!";
			}
			break;
		case 'Downvote':
			$result = downvote($_POST['ID']);
			
			if ($result)
			{
				echo "Downvote Successful!";
			}
			else
			{
				echo "Downvote Unsuccessful!";
			}
			break;
		case 'UpdateReview':
            $result = update_review($_POST['game-id'], $_POST['u-rating'], $_POST['u-review']);
			
			if ($result)
			{
				echo "Update Successful!";
			}
			else
			{
				echo "Update Unsuccessful!";
			}
            break;
		case 'ListReviews':
			$userid = get_user_id($_SESSION['username']);
			$data = list_reviews($userid);
			$myJSON = json_encode($data);
			echo $myJSON;
			
			break;			
		case 'DeleteReview':
            $result = delete_review($_POST['ID']);
			
			if ($result)
			{
				echo "Deletion Successful!";
			}
			else
			{
				echo "Deletion Unsuccessful!";
			}

            break;
		case 'ShowHighestRatings':
			$result = show_high_ratings();
			$myJSON = json_encode($result);
			echo $myJSON;
			break;
		case 'ShowHighestSales':
			$result = show_high_sales();
			$myJSON = json_encode($result);
			echo $myJSON;
			break;
		case 'ShowLatest':
			$result = show_latest();
			$myJSON = json_encode($result);
			echo $myJSON;
			break;
		case 'ShowAll':
			$result = show_all();
			$myJSON = json_encode($result);
			echo $myJSON;
			break;

        case 'SignOut':  
            session_unset();
            session_destroy();  
            $display_type = 'none';
            include ('GameTalk_startpage.php');
            break;
    }
}

else {
    //...
}
?>   