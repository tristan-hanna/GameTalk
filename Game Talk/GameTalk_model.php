<?php
$conn = mysqli_connect('localhost', 'thannaf20', 'Izzawild22', 'C354_thannaf20');

function check_validity($u, $p) 
{
    global $conn;
    
    $sql = "select * from GameUsers where Username = '$u' and Password = '$p'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
        return true;
    else
        return false;
}

function signup($u, $p, $email) 
{
    global $conn;
    
    $date = date("Ymd");
    
    $sql = "Insert into GameUsers values (NULL, '$u', '$p', '$email', $date)";
    $result = mysqli_query($conn, $sql);
    
    return $result;
}

function check_existence($u) 
{
    global $conn;
    
    $sql = "select * from GameUsers where Username = '$u'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
        return true;
    else
        return false;
}

function get_user_id($u) 
{
    global $conn;
    
    $sql = "select * from GameUsers where Username = '$u'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['ID'];
    } else
        return -1;
}

function get_user_name($uid)
{
    global $conn;
    
    $sql = "select * from GameUsers where ID = $uid";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0)
        return "";
    else {
        $row = mysqli_fetch_assoc($result);
        return($row['Username']);
    }
}

function update_username($uid, $un)
{
	global $conn;
	
	$sql = "update GameUsers set Username = '$un' where ID = '$uid'";
	$result = mysqli_query($conn, $sql);
	if ($result)
		return true;
	else
		return false;
}

function update_password($uid, $ps)
{
	global $conn;
	
	$sql = "update GameUsers set Password = '$ps' where ID = '$uid'";
	$result = mysqli_query($conn, $sql);
	if ($result)
		return true;
	else
		return false;
}

function unsubscribe($id)
{
	global $conn;
	
	$sql = "delete from GameUsers where ID = '$id'";
	$result = mysqli_query($conn, $sql);
	
	if($result)
		return true;
	else
		return false;
}	

function post_a_review($t, $ra, $r, $u) 
{
    global $conn;
    
    $uid = get_user_id($u);
    $current_date = date("Ymd");
	$sql = "INSERT INTO GameReviews (ID, Title, Rating, Review, UserID, Date, Upvotes, Downvotes) VALUES (NULL, '$t', '$ra', '$r', '$uid', '$current_date', 0, 0)";
    $result = mysqli_query($conn, $sql);
    if ($result)
        return true;
    else
        return false;
}

function search_reviews($term) 
{
    global $conn;
    
	$sql = "SELECT * FROM GameReviews WHERE Title LIKE '%$term%'";

    $result = mysqli_query($conn, $sql);
    $data = [];
    while($row = mysqli_fetch_assoc($result))
        $data[] = $row;
    return $data;
}

function upvote($gid)
{
	global $conn;
	
	$sql = "update GameReviews set Upvotes = Upvotes + 1 where ID = '$gid'";
	$result = mysqli_query($conn, $sql);
	if ($result)
		return true;
	else
		return false;
}

function downvote($gid)
{
	global $conn;
	
	$sql = "update GameReviews set Downvotes = Downvotes + 1 where ID = '$gid'";
	$result = mysqli_query($conn, $sql);
	if ($result)
		return true;
	else
		return false;
}

function update_review($gid, $ura, $ur)
{
	global $conn;
	
	$sql = "update GameReviews set Rating = '$ura', Review = '$ur' where ID = '$gid'";
	$result = mysqli_query($conn, $sql);
	if ($result)
		return true;
	else
		return false;
}

function list_reviews($uid)
{
	global $conn;
	
	$sql = "select ID, Title, Rating, Review from GameReviews where UserID = '$uid'";
	$result = mysqli_query($conn, $sql);
	$data = [];
	while($row = mysqli_fetch_assoc($result))
		$data[] = $row;
	return $data;
}

function delete_review($id)
{
	global $conn;
	
	$sql = "delete from GameReviews where ID = '$id'";
	$result = mysqli_query($conn, $sql);
	if ($result)
		return true;
	else
		return false;
}

function show_high_ratings()
{
	global $conn;
	
	$sql = "select Title, Rating from GameList ORDER BY `Rating` DESC LIMIT 10";
	$result = mysqli_query($conn, $sql);
	$data = [];
	while($row = mysqli_fetch_assoc($result))
		$data[] = $row;
	return $data;
}

function show_high_sales()
{
	global $conn;
	
	$sql = "select Title, UnitsSold from GameList order by UnitsSold DESC limit 10";
	$result = mysqli_query($conn, $sql);
	$data = [];
	while($row = mysqli_fetch_assoc($result))
		$data[] = $row;
	return $data;
}

function show_latest()
{
	global $conn;
	
	$sql = "select Title, ReleaseDate from GameList order by ReleaseDate DESC limit 10";
	$result = mysqli_query($conn, $sql);
	$data = [];
	while($row = mysqli_fetch_assoc($result))
		$data[] = $row;
	return $data;
}

function show_all()
{
	global $conn;
	
	$sql = "select * from GameList order by ID";
	$result = mysqli_query($conn, $sql);
	$data = [];
	while($row = mysqli_fetch_assoc($result))
		$data[] = $row;
	return $data;
}
?>   