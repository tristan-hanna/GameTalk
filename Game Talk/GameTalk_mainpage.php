<?php
    if (!isset($_SESSION['LogIn'])) {
        ('GameTalk_startpage.php');
        exit();
    }
?>

<!DOCTYPE html>

<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></link>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>		
</head>

<body>
    <div class='container'>
		<div class="row">
			<!-- Management Section -->
			<div class='col-sm-2' id= 'management_pane' style='background-color:lavender; text-align:center'>
				<h2 style='text-align:center; padding-bottom: 10px; margin-top: 170px'>Hello <?php echo $_SESSION['username']; ?>!</h2>
				<h3 style='text-align:center; padding-bottom: 10px;'>User Management</h3>
					
				<form method='post' action='GameTalk_controller.php' id='form-sign-out' style='display:none'>
					<input type='hidden' name='page' value='MainPage'>
					<input type='hidden' name='command' value='SignOut'>
				</form>
				
				<form method='post' action='GameTalk_controller.php' id='form-unsubscribe' style='display:none'>
					<input type='hidden' name='page' value='MainPage'>
					<input type='hidden' name='command' value='Unsubscribe'>
				</form>
				
				<button class='btn btn-sm btn-default' style = "margin-bottom: 5px;" id='sign-out'>Sign Out</button><br>
				<button class='btn btn-sm btn-default' style = "margin-bottom: 5px;" id='change-username' data-toggle='modal' data-target='#modal-update-username'>Change Username</button><br>	
				<button class='btn btn-sm btn-default' style = "margin-bottom: 5px;" id='change-password' data-toggle='modal' data-target='#modal-update-password'>Change Password</button><br>	
				<button class='btn btn-sm btn-default' style = "margin-bottom: 5px;" id='unsubscribe'>Unsubscribe</button><br>	

			</div>
				
			<!-- Discussion Section -->
			<div class='col-sm-8' id= 'discussion_pane' style= 'text-align:center'>
				<h1 style='text-align:center; padding-top: 10px;'>Welcome to Game Talk's Discussion Forum!</h1>
				
				<div class='modal-body'>
					<input type='hidden' name='page' value='MainPage'>
					<input type='hidden' name='command' value='SearchReviews'>
					<div class='form-group'>
						<label class="control-label" for="search-term"></label> 
						<input type="text" class="form-control" id="search-term" name='search-term' placeholder="Enter a Game Review to search!">
					</div>
				</div>
				<div class='modal-footer' style= 'text-align:center'>
					<div class="form-group"> 
						<button type="button" id = "search-sub" class="btn btn-default">Submit</button>
					</div>
				</div>
								
				<div id= 'result-pane'>
					<?php
						if (!empty($result)) {
							echo $result;
						}
						else
					?>
				</div>
			</div>			
				
			<!-- Options Section -->
			<div class='col-sm-2' id= 'option_pane' style='background-color:lavender; text-align:center'>
				<button class='btn btn-sm btn-default' style = "margin-bottom: 5px; margin-top: 170px" id='post-a-review' data-toggle='modal' data-target='#modal-post-a-review'>Post a Review</button><br>
				<button class='btn btn-sm btn-default' style = "margin-bottom: 5px;" id='update-review' data-toggle='modal' data-target='#modal-update-review'>Update Previous Review</button><br>	
				<button class='btn btn-sm btn-default' style = "margin-bottom: 5px;" id='delete-review'>Delete a Review</button><br>	
				<h4 style = "margin-bottom: 5px;" id='view-popular'>View Games</h4><br>
				<button class='btn btn-sm btn-default' style = "margin-bottom: 5px;" id='view-all'>View All Games</button><br>
				<button class='btn btn-sm btn-default' style = "margin-bottom: 5px;" id='view-high-ratings'>View Games with Highest Ratings</button><br>
				<button class='btn btn-sm btn-default' style = "margin-bottom: 5px;" id='view-high-sales'>View Games with Highest Sales</button><br>
				<button class='btn btn-sm btn-default' style = "margin-bottom: 5px;" id='view-latest'>View Latest Games</button><br>
			</div>
		</div>
    </div>
	
	<!-- Modal Window for UpdateUsername -->
    <div class='modal fade' id='modal-update-username'>
        <div class='modal-dialog'>
            <div class='modal-content'>
				<div class='modal-header'>
					<h2 class='modal-title'>Update Username</h2>
				</div>
				<div class='modal-body'>
					<input type='hidden' name='page' value='MainPage'>
					<input type='hidden' name='command' value='UpdateUsername'>
					<div class='form-group'>
						<label class="control-label" for="u-username">New Username:</label> 
						<input type="text" class="form-control" id="u-username" name='u-username' placeholder="Enter your new username!">
					</div>
				</div>
				<div class='modal-footer'>
					<div class="form-group"> 
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<button type="button" id = "updateusername-sub" class="btn btn-default" data-dismiss="modal">Submit</button>
					</div>
				</div>
            </div>
        </div>
    </div>
	
	<!-- Modal Window for UpdatePassword -->
    <div class='modal fade' id='modal-update-password'>
        <div class='modal-dialog'>
            <div class='modal-content'>
				<div class='modal-header'>
					<h2 class='modal-title'>Update Password</h2>
				</div>
				<div class='modal-body'>
					<input type='hidden' name='page' value='MainPage'>
					<input type='hidden' name='command' value='UpdatePassword'>
					<div class='form-group'>
						<label class="control-label" for="u-password">New Password:</label> 
						<input type="text" class="form-control" id="u-password" name='u-password' placeholder="Enter your new password!">
					</div>
				</div>
				<div class='modal-footer'>
					<div class="form-group"> 
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<button type="button" id = "updatepassword-sub" class="btn btn-default" data-dismiss="modal">Submit</button>
					</div>
				</div>
            </div>
        </div>
    </div>
    
    <!-- Modal Window for PostAReview -->
    <div class='modal fade' id='modal-post-a-review'>
        <div class='modal-dialog'>
            <div class='modal-content'>
				<div class='modal-header'>
					<h2 class='modal-title'>Post A Review</h2>
				</div>
				<div class='modal-body'>
					<input type='hidden' name='page' value='MainPage'>
					<input type='hidden' name='command' value='PostAReview'>
					<div class='form-group'>
						<label class="control-label" for="title">Game Title:</label> 
						<input type="text" class="form-control" id="title" name='title' placeholder="Enter the game's title!">
						
						<label class="control-label" for="rating">Rating:</label> 
						<input type="text" class="form-control" id="rating" name='rating' placeholder="Enter a Rating!">
						
						<label class="control-label" for="review">Review:</label> 
						<input type="text" class="form-control" id="review" name='review' placeholder="Enter a Review!">
					</div>
				</div>
				<div class='modal-footer'>
					<div class="form-group"> 
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<button type="button" id = "post-sub" class="btn btn-default"data-dismiss="modal">Submit</button>
					</div>
				</div>
            </div>
        </div>
    </div>
	
	<!-- Modal Window for UpdateReview -->
    <div class='modal fade' id='modal-update-review'>
        <div class='modal-dialog'>
            <div class='modal-content'>
				<div class='modal-header'>
					<h2 class='modal-title'>Update Review</h2>
				</div>
				<div class='modal-body'>
					<input type='hidden' name='page' value='MainPage'>
					<input type='hidden' name='command' value='UpdateReview'>
					<div class='form-group'>
						<label class="control-label" for="game-id">Game ID:</label> 
						<input type="text" class="form-control" id="game-id" name='game-id' placeholder="Enter the game's ID!">
													
						<label class="control-label" for="u-review">Update Rating:</label> 
						<input type="text" class="form-control" id="u-rating" name='u-rating' placeholder="Enter a Rating!">
						
						<label class="control-label" for="u-review">Update Review:</label> 
						<input type="text" class="form-control" id="u-review" name='u-review' placeholder="Enter a Review!">
					</div>
				</div>
				<div class='modal-footer'>
					<div class="form-group"> 
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<button type="button" id = "update-sub" class="btn btn-default" data-dismiss="modal">Submit</button>
					</div>
				</div>
            </div>
        </div>
    </div>	
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $('#sign-out').click(function() {
        timeout();
    })
    
    function timeout() {
        $('#form-sign-out').submit();
    }
	
	$('#unsubscribe').click(function() {
        timeout2();
    })
    
    function timeout2() {
        $('#form-unsubscribe').submit();
    }
	
	$('#updateusername-sub').click(update_username);
	function update_username() {
		var controller = "GameTalk_controller.php"; 
		var txt7 = $("#u-username").val();
		var query = {page: "MainPage", command: "UpdateUsername", "u-username": txt7};  
		$.post(controller, query, function(data) {
			$('#result-pane').html(data);  // display it in '#result-pane'
		});
	}
	
	$('#updatepassword-sub').click(update_password);
	function update_password() {
		var controller = "GameTalk_controller.php"; 
		var txt8 = $("#u-password").val();
		var query = {page: "MainPage", command: "UpdatePassword", "u-password": txt8};  
		$.post(controller, query, function(data) {
			$('#result-pane').html(data);  // display it in '#result-pane'
		});
	}

	$('#post-sub').click(post_post);
	function post_post() {
		var controller = "GameTalk_controller.php";
		var txt = $("#review").val();
		var txt2 = $("#title").val();
		var txt3 = $("#rating").val();
		var query = {page: "MainPage", command: "PostAReview", review: txt, title: txt2, rating: txt3};
		$.post(controller, query, function(data) {
			$('#result-pane').html(data);  // display it in '#result-pane'
		});
	}
	
	$('#search-sub').click(search_post);
	function search_post() {
		var controller = "GameTalk_controller.php"; 
		var txt4 = $("#search-term").val();
		var query = {page: "MainPage", command: "SearchReviews", "search-term": txt4};  
		$.post(controller, query, function(data) {
			var rows = JSON.parse(data);  // convert a JSON string to an object 
									   
			var t = "<table>";
				t += '<tr>';
				for (var p in rows[0])
						t += '<th>' + p + '</th>';
				t += '</tr>';
				for (var i = 0; i < rows.length; i++) {  // for each row
					t += "<tr>";
						for (var p in rows[i])  // for each property
							t += "<td>" + rows[i][p] + "</td>";  // the property value, not the property name 
						t += "<td>";
							t += "<img src='Arrows-Up-icon.png' data-up-id='" + rows[i]['ID'] + "'>"
							t += "<img src='Arrows-Down-icon.png' data-down-id='" + rows[i]['ID'] + "'>"
						t += "</td>";
					t += "</tr>";
				}
			t += "</table>";
			$('#result-pane').html(t);  
			
			$('td > img[data-up-id]').click(function() {  				
				var upvoteid = $(this).attr('data-up-id');
				var query2 = {page: "MainPage", command: "Upvote", "ID": upvoteid};
				$.post(controller, query2, function(data) {
					$('#result-pane').html(data);
				});
			});
			
			$('td > img[data-down-id]').click(function() { 
				var downvoteid = $(this).attr('data-down-id');
				var query3 = {page: "MainPage", command: "Downvote", "ID": downvoteid};
				$.post(controller, query3, function(data) {
					$('#result-pane').html(data);
				});
			});
		});
	}

	$('#update-sub').click(update_post);
	function update_post() {
		var controller = "GameTalk_controller.php"; 
		var txt5 = $("#game-id").val();
		var txt9 = $("#u-rating").val();
		var txt6 = $("#u-review").val();
		var query = {page: "MainPage", command: "UpdateReview", "game-id": txt5, "u-rating": txt9, "u-review": txt6};  
		$.post(controller, query, function(data) {
			$('#result-pane').html(data);  // display it in '#result-pane'
		});
	}
	
	$('#delete-review').click(delete_post);
	function delete_post() {
		var controller = "GameTalk_controller.php";  
		var query = {page: "MainPage", command: "ListReviews"};

		$.post(controller, query, function(data) {			
			var rows = JSON.parse(data);  // convert a JSON string to an object 
									   
			var t = "<table>";
				t += '<tr>';
				for (var p in rows[0])
						t += '<th>' + p + '</th>';
				t += '</tr>';
				for (var i = 0; i < rows.length; i++) {  // for each row
					t += "<tr>";
						for (var p in rows[i])  // for each property
							t += "<td>" + rows[i][p] + "</td>";  // the property value, not the property name 
						t += "<td>";
							t += "<button type='button' data-q-id='" + rows[i]['ID'] + "'>Delete</button>";  
						t += "</td>";
					t += "</tr>";
				}
			t += "</table>";
			$('#result-pane').html(t);
			
			$('td > button[data-q-id]').click(function() {  
				var deleteid = $(this).attr('data-q-id');
				var query2 = {page: "MainPage", command: "DeleteReview", "ID": deleteid};
				$.post(controller, query2, function(data) {
					$('#result-pane').html(data);
				});
			});
		});
	}
	
	$('#view-all').click(show_all);
	function show_all() {
		var controller = "GameTalk_controller.php";
		var query = {page: "MainPage", command: "ShowAll"};
		$.post(controller, query, function(data) {
			var rows = JSON.parse(data);  // convert a JSON string to an object 
									   
			var t = "<table>";
				t += '<tr>';
				for (var p in rows[0])
						t += '<th>' + p + '</th>';
				t += '</tr>';
				for (var i = 0; i < rows.length; i++) {  // for each row
					t += "<tr>";
					for (var p in rows[i])  // for each property
						t += "<td>" + rows[i][p] + "</td>";  // the property value, not the property name 
					t += "</tr>";
				}
			t += "</table>";
			$('#result-pane').html(t);  
		});
	}
	
	$('#view-high-ratings').click(show_highest_ratings);
	function show_highest_ratings() {
		var controller = "GameTalk_controller.php";
		var query = {page: "MainPage", command: "ShowHighestRatings"};
		$.post(controller, query, function(data) {
			var rows = JSON.parse(data);  // convert a JSON string to an object 
									   
			var t = "<table>";
				t += '<tr>';
				for (var p in rows[0])
						t += '<th>' + p + '</th>';
				t += '</tr>';
				for (var i = 0; i < rows.length; i++) {  // for each row
					t += "<tr>";
					for (var p in rows[i])  // for each property
						t += "<td>" + rows[i][p] + "</td>";  // the property value, not the property name 
					t += "</tr>";
				}
			t += "</table>";
			$('#result-pane').html(t);  
		});
	}
	
	$('#view-high-sales').click(show_highest_sales);
	function show_highest_sales() {
		var controller = "GameTalk_controller.php";
		var query = {page: "MainPage", command: "ShowHighestSales"};
		$.post(controller, query, function(data) {
			var rows = JSON.parse(data);  // convert a JSON string to an object 
									   
			var t = "<table>";
				t += '<tr>';
				for (var p in rows[0])
						t += '<th>' + p + '</th>';
				t += '</tr>';
				for (var i = 0; i < rows.length; i++) {  // for each row
					t += "<tr>";
					for (var p in rows[i])  // for each property
						t += "<td>" + rows[i][p] + "</td>";  // the property value, not the property name 
					t += "</tr>";
				}
			t += "</table>";
			$('#result-pane').html(t);  
		});
	}
	
	$('#view-latest').click(show_latest);
	function show_latest() {
		var controller = "GameTalk_controller.php";
		var query = {page: "MainPage", command: "ShowLatest"};
		$.post(controller, query, function(data) {
			var rows = JSON.parse(data);  // convert a JSON string to an object 
									   
			var t = "<table>";
				t += '<tr>';
				for (var p in rows[0])
						t += '<th>' + p + '</th>';
				t += '</tr>';
				for (var i = 0; i < rows.length; i++) {  // for each row
					t += "<tr>";
					for (var p in rows[i])  // for each property
						t += "<td>" + rows[i][p] + "</td>";  // the property value, not the property name 
					t += "</tr>";
				}
			t += "</table>";
			$('#result-pane').html(t);  
		});
	}
</script>