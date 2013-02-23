<?php if(!defined("PH_VER")){die();}?>
<?php 

if(isset($_GET["for"])){
	$searchResults = array("portfolio" => null, "blog" => null);
	$minQueryLen = 5;

	if(isset($_GET["portfolio"]) && count($_GET["for"]) >= $minQueryLen){
		$searchResults["portfolio"] = $ph->database->searchWebsite("portfolio", $_GET["for"]);
	}
	if(isset($_GET["blog"]) && count($_GET["for"]) >= $minQueryLen){
		$searchResults["blog"] = $ph->database->searchWebsite("blog", $_GET["for"]);
	}
}

?>
<div id="hero-container" class="full">
    <div class="container">
        <div class="page-header">
            <h1>Search the website <small>Looking for something specific? Here is the place to do it.</small></h1>
        </div>

    </div>
</div>

<div id="search-container">
	<div class="container">
		<div class="row">
			<?php if(!isset($searchResults) ): ?>
				<div class="span12">
					<div class="page-header">
						<h1>Manage entries<small>Overview of all existing portfolio posts.</small></h1>
					</div>

					<form class="form-horizontal" method="get">
						<div class="control-group">
							<label class="control-label" for="search">What to search for?</label>
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on"><i class="icon-search"></i></span>
									<input id="search" name="for" class="span4" type="text"  placeholder="Enter keywords..." value="">
								</div>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="search">Where to search?</label>
							<div class="controls">
								<label class="checkbox">
									<input name="portfolio" type="checkbox" value=true >
									Portfolio
								</label>
							</div>
							<div class="controls">
								<label class="checkbox">
									<input name="blog" type="checkbox" value=true >
									Blog
								</label>
							</div>
						</div>

						<div class="control-group">
							<div class="controls">
								<input type="submit" class="btn btn-ph" value="Search" >
							</div>
						</div>

					</form>
				</div>
			<?php else: /*if search query was submitted */ ?>
				<div class="span12">
					<?php if($searchResults["blog"]):?>
						<div class="page-header">
							<h3>Blog Results<small>for: <?php echo urldecode($_GET["for"])?></small></h3>
						</div>
						<?php foreach ($searchResults["blog"] as $post):?>
							<h4><?php echo $post["title"] ?> <small>(in blog)</small></h4>
							<pre class="well stack"><?php htmlentities(var_dump($post))?></pre>
						<?php endforeach; ?>
					<?php endif; ?>

					<?php if($searchResults["portfolio"]): ?>
						<div class="page-header">
							<h1>Portfolio Results<small>for: <?php echo urldecode($_GET["for"])?></small></h1>
						</div>
						<?php foreach ($searchResults["portfolio"] as $entry):?>
							<h4><?php echo $entry["title"] ?> <small>(in portfolio)</small></h4>
							<pre class="well block"><?php htmlentities(var_dump($entry))?></pre>
						<?php endforeach; ?>
					<?php endif;?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>