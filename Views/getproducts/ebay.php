<div class="mt-5 pb-3" id="search_box">
    <?foreach($items->item as $item):?>
<?
    // echo"<pre>"; print_r($item); echo "</pre>"; exit;
?>
        <div class="row  mt-1 ml-1 mr-1 border-top border-info shadow-sm">
            <div class="mr-5"><img src="<?=$item->galleryURL;?>" style="width: 100px;"></div>
            <div>
                <span class="d-table-cell font-weight-bold py-2"><?=$item->primaryCategory->categoryName;?></span>
                <a href="<?=$item->viewItemURL;?>" target="_blank">
                    <?=$item->title?> 
                </a>
            </div>
        </div>
    <?endforeach;?>
</div>
<!-- <div class="row justify-content-md-center pb-3">
    <button type="button" class="btn btn-info">More</button>
</div> -->