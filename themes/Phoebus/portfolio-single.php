<?php
	if(!defined("PH_VER")){ die();}

	$portfolioMetas = $ph->database->getTable("portfolio_metas");
	$meta_rel = unserialize($meta_rel);

	$gallery = $ph->database->getRow("galleries", $gallery_rel);
	$gallery["items"] = unserialize($gallery["items"]);
?>
<div id="hero-container" class="full">
	<div class="container">
		<div class="page-header">
			<h1>Portfolio Page <small>Get yourself up to date with my work</small></h1>
		</div>

	</div>
</div>


<!-- start .ajax-container -->
<div id="ajax-container" class="active">
	<div class="container">
		<div id="ajax-main" class="row" style="">
			<div id="ajax-hidden" class="span12" style="">
				<!-- start first-row -->

				<div class="row" style="postion:relative">
					<!-- start .ajax-sidebar -->
					<div class="span4">
						<div id="ajax-sidebar" class="ajax-padding">

							<div class="page-header">
								<h2><?php echo $title ?></h2>
								<hr class="soft">
							</div>

							<ul id="item-details">
								<?php if($portfolioMetas): ?>

									<?php foreach ($portfolioMetas as $meta):?>
									<?php $metaValue = $ph->metaValue($meta["id"], $meta_rel);?>
										<?php if($metaValue) :?>

											<?php if(substr($metaValue, 0, 3) !== "http"):?>
												<li>
													<?php echo $meta["title"] ?>: <span class="color"><?php echo $metaValue; ?></span>
												</li>
											<?php else:?>
												<li>
													<?php echo $meta["title"] ?>: <a href="<?php echo $metaValue ?>"><?php echo $metaValue; ?></a>
												</li>
											<?php endif;?>

										<?php endif;?>

									<?php endforeach; ?>

							<?php endif;?>
							</ul>

						</div>
					</div><!-- #end ajax-sidebar -->


					<!-- start ajax-carousel -->
					<div class="span8">
					<div id="ajax-slider-container" class="ajax-padding">
						<div class="flex-container">
							<?php if($gallery_rel):  ?>
							<div class="flexslider">
								<ul class="slides">
									<?php foreach($gallery["items"] as $key => $item): ?>
									<li class="<?php if($key == 0){echo "main-slide"; } ?>">
										<a class="image" target="blank" data-type="colorbox" href="<?php $ph->media->imageHref($item["url"]) ?>">
											<img src="<?php $ph->media->thumbHref($item["url"]) ?>" alt="<?php echo $item["title"] ?>"/>
										</a>
										<h5 class="flex-caption"><?php echo $item["title"] ?></h5>
									</li>
									<?php endforeach; ?>
								</ul>
							</div>
							<?php endif;?>
						</div>

					</div>
					</div><!-- #end ajax-arousel -->

					<div class="span12">
						<div id="ajax-content" class="ajax-padding">
							<hr class="soft" >
							<?php echo $content ?>

						</div>
					</div>

				</div><!-- #end first-row -->

			</div>
		</div>
	</div>
</div>