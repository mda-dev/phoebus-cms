<?php 
	if(!defined("PH_VER")){die();}
?>

<div id="manage-container">
	<div class="container">
		<div class="row">
			<div class="span12">
				<div class="page-header">
					<h1>Edit meta: <?php echo $title ?><small>Update specific blog category</small></h1>
				</div>
				<div>
					<form class="form-horizontal" method="post" action="">
						<div class="control-group">
							<label class="control-label" for="meta_title">Title</label>
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on"><i class="icon-align-right"></i></span>
									<input id="meta_title" name="meta_title" class="span4" type="text"  placeholder="Meta title..." value="<?php echo $title ?>">
								</div>
							</div>
						</div>


						<div class="control-group">
							<label  class="control-label"></label>
							<div class="controls">
								<button class="btn btn-ph" type="submit" name="edit_meta" value="<?php echo $id ?>" >save changes</button>
							</div>
						</div>
					</form>
				</div>
				<hr class="soft">
			</div>
		</div>
	</div>
</div>