<?php if(!defined("PH_VER")){die();}?>
<?php 

if(isset($_GET["for"])){
	$queryString = $_GET["for"];
	$searchResults = array(); //array("portfolio" => null, "blog" => null);
	$minQueryLen = 5;

	$queryString = trim($queryString);

	var_dump(gettype(29));
	if( strlen($queryString) >= $minQueryLen){

		$searchResults["portfolio"] = $ph->database->searchWebsite("portfolio", $queryString);
		$searchResults["blog"] = $ph->database->searchWebsite("blog", $queryString);
	}else{
		$searchResults["portfolio"] = NULL;
		$searchResults["blog"] = NULL;
	}
}

?>
<div id="hero-container" class="full">
    <div class="container">
        <div class="page-header">
            <h1>Search the website <small>Looking for something specific? This is the place to do it.</small></h1>
        </div>

    </div>
</div>

<div id="search-container">
	<div class="container after-hero">
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
							<div class="controls">
								<input type="submit" class="btn btn-ph" value="Search" >
							</div>
						</div>

					</form>
				</div>

			<?php else: /*if search query was submitted */ ?>

				<aside class="span3">
					<div  class="well sidebar-nav ">
						<ul class="nav nav-list" id="myTab">
							<li class="active">
								<a href="#blog">Blog Results
									<span class="pull-right">
										<?php echo $ph->leadingZero($searchResults["blog"]) ?>
									</span>
								</a>
							</li>
							<li>
								<a href="#portfolio">Portfolio Results
									<span class="pull-right">
										<?php echo $ph->leadingZero($searchResults["portfolio"]) ?>
									</span>
								</a>
							</li>
						</ul>
					</div><!--/.well -->
				</aside>

				<div class="span9">

					<div class="tab-content">
						<div class="tab-pane active" id="blog">
							<ul class="unstyled stack-list">
								<?php if($searchResults["blog"]):?>
									<?php foreach ($searchResults["blog"] as $post):?>
										<li class="well stack">
											<h4><a href="<?php $ph->href("blog/". $post["slug"] . "/" )?>"> <?php echo $post["title"] ?> </a></h4>
											<section class="article-content">
												<?php echo $ph->justExerp($post["content"]) ?>				
											</section>			
										</section>
										</li>
									<?php endforeach; ?>
								<?php else:?>
									<li>
										<h1><small>No results were found matching your search criteria.</small></h1>
									</li>
								<?php endif;?>
							</ul>
						</div><!-- .end tab -->


						<div class="tab-pane" id="portfolio">
							<ul class="unstyled stack-list">
								<?php if($searchResults["portfolio"]):?>
									<?php foreach ($searchResults["portfolio"] as $entry):?>
										<li class="well stack">
											<h4><a class="portfolio-link" href="<?php $ph->href("portfolio/". $entry["slug"] . "/" )?>"> <?php echo $entry["title"] ?> </a></h4>
											<section class="article-content">
												<?php echo $entry["content"] ;?>				
											</section>			
										</section>
										</li>
									<?php endforeach; ?>
								<?php else: ?>
									<li>
										<h1><small>No results were found matching your search criteria.</small></h1>
									</li>
								<?php endif; ?>
							</ul>

						</div><!-- .end tab -->

					</div><!-- .end tabs container -->

					

				</div>
			<?php endif; ?>


		</div>
	</div>
</div>