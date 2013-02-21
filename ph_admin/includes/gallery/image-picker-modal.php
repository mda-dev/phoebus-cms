<?php 
    if(!defined("PH_VER")){die();}
    $images = $ph->media->itemsIn("images");
?>

<!-- Modal -->
<div id="imageModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Media folder</h3>
    </div>
    <div class="modal-body">
        <ul id="gal-image-pick" class="unstyled inline">
        <?php if($images):?>
            <?php foreach($images as $key => $image): ?>
            <?php ?>
            <li class="grid-view">
                <div class="img-block">
                    <label class="">
                        <div class="thumbnail">
                            <img src="<?php $ph->media->thumbHref($image) ?>" alt="#">
                        </div>
                        <div class="img-details" > 
                            <input type="radio" name="imageRadios"  value="<?php echo $image ?>">
                            <span>Size: <?php echo $ph->formatSizeUnits(filesize($ph->media->getImage($image, true))); ?></span> 
                        </div>
                    </label>
                </div>
            </li>
            <?php endforeach;?>
        <?php endif; ?>
        </ul>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button id="img-select-save" class="btn btn-ph" data-dismiss="modal" aria-hidden="true" >Select image</button>
    </div>
</div>