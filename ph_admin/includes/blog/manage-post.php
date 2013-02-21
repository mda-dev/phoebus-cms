<?php 
	if(!defined("PH_VER")){die();}
	$blogCategories = $ph->database->getTable("blog_categories");
?>

<div id="new-post-container">
	<div class="container">
		<div class="row">
			<div class="span12">
				<div class="page-header">
					<h1>Edit post: <?php echo $title ?><small>Update specific post data</small></h1>
				</div>
				<form class="form-horizontal" method="post" action="">
					<div class="control-group">
						<label class="control-label" for="post_title">Title</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-align-right"></i></span>
								<input id="post_title" name="post_title" class="span4"
									 type="text"  placeholder="Post title..." value="<?php echo $title ?>">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label  class="control-label" for="post_slug">Slug</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-tag"></i></span>
								<input id="post_slug" name="post_slug" class="span4"
									 type="text" placeholder="Post slug..." value="<?php echo $slug ?>">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" >Category</label>
						<div class="controls">
							<div class="">
								<ul id="cat-list" class="unstyled inline span6">
								<?php if($blogCategories): ?>

									<?php foreach ($blogCategories as $category): ?>

										<?php $relations = unserialize($categ_rel) ?>
										<?php $checkCategory = $ph->checkCategory($category["id"], $relations); ?>

										<li>
												<label class="btn">
										<input value="<?php echo $category["id"]; ?>" <?php echo $checkCategory; ?> name="post_category[][id]" type="checkbox"> <?php echo $category["title"]?> 
												</label>
										</li>

									<?php endforeach; ?>

								<?php endif; ?>
								</ul>
							</div>
						</div>
					</div>

					<div class="control-group">
						<label  class="control-label" for="post_content">Content</label>
						<div class="controls">
							<textarea id="post_content" name="post_content" class="span5" rows="10" placeholder="Post content Goes in gere">
<?php echo $content ?>
							</textarea>
						</div>
					</div>

					<div class="control-group">
						<label  class="control-label"></label>
						<div class="controls">

							<button class="btn btn-ph" type="submit" name="edit_post" value="<?php echo $id ?>" >save changes</button>

						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>

