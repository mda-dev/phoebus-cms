<?php 
	// deny any direct access to the file
    if(!defined("PH_VER")){ die(); }

    $blogCategories = $ph->database->getTable("blog_categories");

?>

<div id="hero-container" class="full">
    <div class="container">
        <div class="page-header">
        	<h1><?php echo $title ?>
			<small>Witten by [<?php echo $author ?>], <?php echo $date ?></small>
			</h1>
        </div>

    </div>
</div>

<div class="container after-hero">
	<div class="row">
		<aside class="span3">
			<div  class="well sidebar-nav ">
				<ul class="nav nav-list">
					<li class="nav-header">Categories</li>
					<?php if($blogCategories):?>
						<?php foreach ($blogCategories as $key => $category):?>

						<li class="<?php echo sidebarActive($category["slug"])?>">
							<a href="<?php $ph->href("blog/categories/" . $category["slug"]) ?>">
								<?php echo $category["title"] ?>
							</a>
						</li>

						<?php endforeach; ?>
					<?php endif; ?>
				</ul>
			</div><!--/.well -->
		</aside>

		<div class="span9">
			
			<article class="well stack">
				<section class="atricle-title">
					<br>
				</section>

				<section class="article-image thumbnail">
					<a href="http://placehold.it/900x350" target="_blank" data-type="colorbox">
						<img src="http://placehold.it/900x350" alt="##">
					</a>
				</section>
				<hr>
				<section class="article-content">
					<?php echo $content ?>				
				</section>
			</article>

			<hr class="soft">

		</div>
	</div>
</div>