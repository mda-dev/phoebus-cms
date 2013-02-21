<?php if(!defined("PH_VER")){ die(); } 
$items = unserialize($items);

?>

<div id="gallery-container">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="page-header">
                    <h1>Updating: <?php echo $title ?><small>Create a new gallery</small></h1>
                </div>
                <form id="gal_form" method="POST" action="" class="form-horizontal">
                    <div class="control-group">
                        <label for="gallery_title" class="control-label">Gallery Ttitle</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-align-right"></i></span>
                                <input type="text" class="span5" id="gallery_title" name="gallery_title" placeholder="Gallery title..." value="<?php echo $title ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="gallery_slug" class="control-label">Gallery Slug</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-tag"></i></span>
                                <input type="text" class="span5" id="gallery_slug" name="gallery_slug" placeholder="Gallery slug..." value="<?php echo $slug ?>">
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label"></label>
                        <div class="controls">
                            <button class="btn btn-ph" type="submit" name="edit_gallery" value="<?php echo $id ?>">Update gallery</button>
                        </div>
                    </div>
                    
                    <hr class="soft small">
                    <div class="control-group">
                        <label for="gallery_slug" class="control-label">
                            <a href="#" id="add-gallery-item" class="btn">Add new item</a>
                        </label>
                        <div class="controls">
                            <h4>Gallery items</h4>
                        </div>
                    </div>

                        
            <?php if($items): ?>
                <?php foreach($items as $key => $item):?>
                    <div class="control-group block1">
                        <label class="control-label">Item #<?php echo $key+1 ?></label>
                        <div class="controls">
                            <div class="input-prepend input-append">
                                <span class="add-on"><i class="icon-edit"></i></span>
                                <input type="text" name="gallery_items[<?php echo $key ?>][title]" class="span5" placeholder="Item title..." value="<?php echo $item["title"] ?>">
                                <a href="#" class="btn remove-item" ata-toggle="tooltip" title="Remove Item" data-placement="right"><i class="icon-remove"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="control-group block2">
                        <label></label>
                        <div class="controls">
                            <div class="input-prepend input-append">
                                <span class="add-on"><i class="icon-picture"></i></span>
                                <input type="text" name="gallery_items[<?php echo $key ?>][url]" class="span5" placeholder="Item url..." value="<?php echo $item["url"]?>">
                                <a href="#" class="btn select-img" data-toggle="tooltip" title="Select Image" data-placement="right"><i class="icon-plus"></i></a>
                            </div>
                        </div>

                    </div>
                    <hr class="soft small">
                <?php endforeach; ?>
            <?php endif; ?>
                </form>

                <div id="temp" class="hidden">
                    <!-- start item2 -->
                    <div class="control-group block1 hidden">
                        <label class="control-label">Item 2</label>
                        <div class="controls">
                            <div class="input-prepend input-append">
                                <span class="add-on"><i class="icon-edit"></i></span>
                                <input type="text" name="gallery_items[0][title]" class="span5" placeholder="Item title...">
                                <a href="#" class="btn remove-item" data-toggle="tooltip" title="Remove Item" data-placement="right" ><i class="icon-remove"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="control-group block2 hidden">
                        <label></label>
                        <div class="controls">
                            <div class="input-prepend input-append">
                                <span class="add-on"><i class="icon-picture"></i></span>
                                <input type="text" name="gallery_items[0][url]" class="span5" placeholder="Item url...">
                                <a href="#" class="btn select-img" data-toggle="tooltip" title="Select Image" data-placement="right" ><i class="icon-plus"></i></a>
                            </div>
                        </div>
                    </div> <!-- end item2 -->
                </div>
            </div>
        </div> <!-- /container -->

        <?php $ph->admin->loadSubView("gallery/image-picker-modal")?>
    </div>
</div>