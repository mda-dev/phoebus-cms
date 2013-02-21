<?php if(!defined("PH_VER")){ die(); } ?>

<div id="gallery-container">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="page-header">
                    <h1>New gallery<small>Create a new gallery</small></h1>
                </div>
                <form id="gal_form" method="POST" action="" class="form-horizontal">
                    <div class="control-group">
                        <label for="gallery_title" class="control-label">Gallery Ttitle</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-align-right"></i></span>
                                <input type="text" class="span5" id="gallery_title" name="gallery_title" placeholder="Gallery title...">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="gallery_slug" class="control-label">Gallery Slug</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-tag"></i></span>
                                <input type="text" class="span5" id="gallery_slug" name="gallery_slug" placeholder="Gallery slug...">
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label"></label>
                        <div class="controls">
                            <input class="btn btn-ph" type="submit" name="new_gallery" value="Save">
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

                        
                    <!-- start item1 -->
                    <div class="control-group block1">
                        <label class="control-label">Item #1</label>
                        <div class="controls">
                            <div class="input-prepend input-append">
                                <span class="add-on"><i class="icon-edit"></i></span>
                                <input type="text" name="gallery_items[0][title]" class="span5" placeholder="Item title...">
                                <a href="#" class="btn remove-item" data-toggle="tooltip" title="Remove Item" data-placement="right" ><i class="icon-remove"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="control-group block2">
                        <label></label>
                        <div class="controls">
                            <div class="input-prepend input-append">
                                <span class="add-on"><i class="icon-picture"></i></span>
                                <input type="text" name="gallery_items[0][url]" class="span5" placeholder="Item url...">
                                <a href="#" class="btn select-img" data-toggle="tooltip" title="Select Image" data-placement="right"><i class="icon-plus"></i></a>
                            </div>
                        </div>

                    </div> <!-- end item1 -->

                    <hr class="soft small">
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