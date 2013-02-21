<?php 
	if(!defined("PH_VER")){die();}
	$portfolioCategories = $ph->database->getTable("portfolio_categories");
	$portfolioMetas = $ph->database->getTable("portfolio_metas");
	$mediaGalleries = $ph->database->getTable("galleries");
	//var_dump(unserialize($meta_rel));
?>

<div id="new-post-container">
	<div class="container">
		<div class="row">
			<div class="span12">
				<div class="page-header">
					<h1>Edit post: <?php echo $title ?><small>Update specific post data</small></h1>
				</div>
				<form class="form-horizontal" method="POST" action="">
					<div class="control-group">
						<label class="control-label" for="entry_title">Title</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-align-right"></i></span>
								<input id="entry_title" name="entry_title" class="span4" type="text"  placeholder="Entry title..." value="<?php echo $title?>">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label  class="control-label" for="entry_slug">Slug</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-tag"></i></span>
								<input id="entry_slug" name="entry_slug" class="span4" type="text" placeholder="Entry slug..." value="<?php echo $slug?>">
							</div>
						</div>
					</div>

					<?php if($portfolioMetas):?>
					<div class="control-group">
						<label  class="control-label">Meta fileds</label>
						<div class="controls">
							<ul class="unstyled">
							<?php foreach ($portfolioMetas as $key => $meta): ?>
								<?php $relations = unserialize($meta_rel);?>
								<?php $metaValue = $ph->metaValue($meta["id"], $relations); ?>
									<li class="control-group">
										<div class="input-prepend">
											<span class="add-on"><i class="icon-list"></i></span>
											<input id="entry_meta" name="entry_meta[][<?php echo $meta['id']?>]" class="span4" type="text" placeholder="<?php echo $meta["title"]?>..." value=<?php echo $metaValue?>>
										</div>
									</li>
							<?php endforeach;?>
							</ul>
						</div>
					</div>
					<?php endif?>

					<div class="control-group">
						<label class="control-label" >Category</label>
						<div class="controls">
							<div class="">
								<ul id="cat-list" class="unstyled inline span6">
								<?php if($portfolioCategories): ?>

									<?php foreach ($portfolioCategories as $key => $category): ?>

										<?php $relations = unserialize($categ_rel) ?>
										<?php $checkCategory = $ph->checkCategory($category["id"], $relations); ?>

										<li>
												<label class="btn">
													<input value="<?php echo $category["id"]; ?>" <?php echo $checkCategory  ?> name="entry_category[][id]" type="checkbox"> <?php echo $category["title"]?>
												</label>
										</li>
									<?php endforeach; ?>

								<?php endif; ?>
								</ul>
							</div>
						</div>
					</div>

					<div class="control-group">
						<label  class="control-label" for="entry_gallery">Gallery</label>
						<div class="controls">
							<select id="entry_gallery" name="entry_gallery" class="span4">
							<?php if($mediaGalleries):?>

								<?php foreach($mediaGalleries as $gallery): ?>
								<?php if($gallery["id"] == $gallery_rel){ $chk = "selected='selected'";}else{$chk = "";} ?>

									<option <?php echo $chk ?> value="<?php echo $gallery["id"]?>"><?php echo $gallery["title"]?></option>
								
								<?php endforeach;?>
								
							<?php endif;?>
							</select>
						</div>
					</div>


					<div class="control-group">
						<label  class="control-label" for="entry_content">Content</label>
						<div class="controls">
							<textarea id="entry_content" name="entry_content" class="span5" rows="10" placeholder="Entry content Goes in gere">
<?php echo $content ?>
							</textarea>
						</div>
					</div>

					<div class="control-group">
						<label  class="control-label"></label>
						<div class="controls">

							<button class="btn btn-ph" type="submit" name="edit_entry" value="<?php echo $id ?>" >update entry </button>

						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>

