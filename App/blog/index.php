<?php
//We are going to work on the table "post"
$bdd->setActiveTable("post");
?>
<!DOCTYPE html>
<html>

	<head>
		<?php 
		//Lets include jquery
		$html->jquery(); 
		//And add an HTML5 ie tweaker
		$html->ieHtml5();
		?>
		<script>
		function showPost(layer) {
			var i = $(layer).attr("rel");
			$("#"+i).fadeIn();
		}
		function hidePost(i) {
			$("#"+i).fadeOut();
		}
		</script>
	</head>

	<body>

		<center>
			<h1>My awsome blog</h1>
			<?php
			//Lets get those posts
			//We are asking the framework to get all posts, without any arguments, and without fetching them
			$posts = $bdd->get("-all", array(), 0);
			//For each post, we are going to show some stuff
			// we are only going to show 5 posts per pages
			$i = 0;
			while($post = $posts->fetch()):
			?>
				<h4><?php echo $post["title"]; ?></h4>
				<button onclick="javascript:showPost(this);" rel="<?php echo $i; ?>">Show me !</button><br />
				<p id="<?php echo $i; ?>" style="display:none;">
					<?php echo $post["content"]; ?>
					<button onclick="javascript:hidePost(<?php echo $i; ?>);"/>Hide me !</button>
				</p>
				<br /><br />
			<?php $i++; endwhile; ?>
		</center>

	</body>
</html>