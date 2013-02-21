<?php 
	// deny any direct access to the file
    if(!defined("PH_VER")){ die(); }
    $subView = $ph->url->viewRequest(2);
    

    function sidebarActive($arg, $class = "active"){
    	global $ph;
    	$lvl2 = $ph->url->viewRequest(2);
    	$lvl3 = $ph->url->viewRequest(3);

    	if($lvl2 == "categories" && $lvl3 == $arg){
    		return $class;
    	}else{
    		return "";
    	}
    }

if($subView):
	switch ($subView) {
		case 'categories':
			$ph->template->loadSubView("blog-categories");
			break;
		
		default:
			$item = $ph->database->getRow("blog", $subView);
			if($item){
				$ph->template->loadSubView("blog-single", $item);
			}else{
				$ph->template->loadView("404");
			}
			break;
	}
else:

	
    $blogPosts = $ph->database->getTable("blog");
    $blogCategories = $ph->database->getTable("blog_categories");
?>
<div id="hero-container" class="full">
    <div class="container">
        <div class="page-header">
        	<h1>Blog Page <small>Subtext for header</small></h1>
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
			<?php if($blogPosts): ?>

			<?php foreach($blogPosts as $key => $post): ?>

				<article class="well stack">
					<section class="article-image thumbnail">
						<a href="http://placehold.it/900x350" target="_blank" data-type="colorbox">
							<img src="http://placehold.it/900x350" alt="##">
						</a>
					</section>

					<section class="atricle-title">
						<h2><?php echo $post["title"] ?></h2>
						<p>Witten by [<?php echo $post["author"] ?>], <?php echo $post["date"]?></p>
					</section>

					<hr>
					
					<section class="article-content">
						<?php echo $ph->justExerp($post["content"])?>
						<p>
							<a href="<?php $ph->href("blog/". $post["slug"]) ?>" class="btn">Read More &raquo;</a>
						</p>					
					</section>
				</article>

				<?php if($key != (count($blogPosts)-1)):?>
					<hr class="soft">
				<?php endif;?>

			<?php endforeach; ?>
			<?php endif;?>
			


			<div class="pagination pull-right">
				<ul>
				<li><a href="#">Prev</a></li>
				<li><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">Next</a></li>
				</ul>
			</div>
		</div>

		

	</div>
</div>
<?php endif; ?>   	