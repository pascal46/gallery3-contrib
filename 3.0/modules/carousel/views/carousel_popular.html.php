<?php defined("SYSPATH") or die("No direct script access.") ?>
<?php 
	$circular 	= module::get_var("carousel", "circular", "false");
	$autoscroll = module::get_var("carousel", "autoscroll", "false");
	$auto 		= module::get_var("carousel", "autostart", "800");
	$speed 		= module::get_var("carousel", "speed", "1000");
	$quantity	= module::get_var("carousel", "quantity3", "1");
	$visible	= module::get_var("carousel", "visible3", "1");
	$thumbsize	= module::get_var("carousel", "thumbsize3");
    $photos		= ORM::factory("item")->viewable()
        ->where("type", "!=", "album")
		->order_by("view_count", "DESC")
		->find_all($quantity);
?>
<? if (module::get_var("carousel", "mousewheel") == true) : ?>
<script type="text/javascript" src="<?= url::file("modules/carousel/js/jquery.mousewheel.min.js") ?>"></script>
<? endif ?>
<script type="text/javascript">
$(function() {
    $(".carouselpop").jCarouselLite({
		circular: <?= $circular ?>,
              mouseWheel: true,
		visible: <?= $visible ?>,
        vertical: true,
<? if (module::get_var("carousel", "autoscroll") == true) : ?>
        hoverPause: true,
		auto: <?= $auto ?>,
    	speed: <?= $speed ?>
<? endif ?>
    });
});
</script>
<div class="carouselpop" id="pop">
	<ul>
<? foreach ($photos as $photo):
	if (module::get_var("carousel", "mousewheel") == true) {
		$ctitle = "Use mouse wheel to scroll!";
		} else {
		$ctitle = $photo->title;
	}
 ?>
	<li><a href="<?= $photo->abs_url() ?>">
		<?= $photo->thumb_img(array("class" => "g-thumbnail", "title" => $ctitle), $thumbsize) ?></a>
	</li>
<? endforeach ?>
  	</ul>
</div>