<? @header("Content-Type: text/html; charset=UTF-8"); ?>
<?php
	include('functions.php');
	include('config.php');
	
	$link = connectToDB();

	$id = 0;
	$title = '';
	$content = '';
	$comments = array();

	if(isset($_GET['id'])){
		$id = $_GET['id'];
	}
	
	if($id){
		$res = @mysqli_query($link, "select * from articles where id='$id'");
		if(!$res){
			die("Error while retrieving article. Try again later!");
		}
		
		if($row = mysqli_fetch_assoc($res)){
			$title = $row['title'];
			$content = $row['content'];
		}
		
		$res = @mysqli_query($link, "select * from comments where articleID='$id'");
		if(!$res){
			die("Error while retrieving comments. Try again later!");
		}
		
		while($row = mysqli_fetch_assoc($res)){
			$comments[] = $row['comment'];
		}
	}else{
		@header("Location: blog-home.php");
		exit;
	}
?>

<!DOCTYPE html public "-//W3C//DTD html 4.0 //en">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo $title; ?></title>

		<!-- load js libs -->
		<script src="jquery.min.js"></script>
		
		<!-- load css -->
		<link href="" rel="stylesheet" type="text/css"/>

		<!-- some page-specific js -->
		<script>
			$(function(){
				$('#sendComment').click(function(){
					$.ajax({
						url: "blog-comment.php",
						type: "POST",
						data: {
							comment: $('#comment').val(),
							articleID: <?php echo $id; ?>
						},
						success: function(resp){
							$('#comments-section').html(resp);
							$('#comment').val('');
						}
					});
				});
			});
		</script>

		<!-- some page-specific styling -->
		<style>
			.comment{
				border: solid 1px silver; 
				margin: 10px; 
				padding: 10px;	
			}
		</style>
	</head>
	<body>
		<h1><?php echo $title; ?></h1>
		<div><?php echo $content; ?></div>
		<hr>
		<h2>Comments</h2>
		<div id="comments-section">
		<?php
			foreach($comments as $comment){
				echo "<div class=\"comment\">$comment</div>";
			}
		?>
		</div>
		<hr>
		<h2>Post new comment</h2>
		<form>
			<textarea id="comment" name="comment" cols="50" rows="3"></textarea><br>
			<input type="hidden" name="articleID" value="<?php echo $id; ?>">
			<input type="button" id="sendComment" value="Send comment">
		</form>
	</body>
</html>