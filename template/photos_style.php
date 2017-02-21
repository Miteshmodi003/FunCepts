<article id="page">
    <section id="content">
    	<div class="bloc">
    		<form method="post" action="" id="form_photo">
				<input type="radio" id="origin" name="style_photo" value="origin" checked="checked"><label for="origin"><img src="<?php echo $style->file; ?>" alt=""/><span>&#8730;</span></label>
				<input type="radio" id="sepia" name="style_photo" value="sepia"><label for="sepia"><img src="<?php echo $style->file; ?>" alt="" class="sepia"/><span>&#8730;</span></label>
				<input type="radio" id="grayscale" name="style_photo" value="grayscale"><label for="grayscale"><img src="<?php echo $style->file; ?>" alt="" class="grayscale"/><span>&#8730;</span></label>
				<input type="radio" id="saturate" name="style_photo" value="saturate"><label for="saturate"><img src="<?php echo $style->file; ?>" alt="" class="saturate"/><span>&#8730;</span></label>
				<input type="radio" id="hue45" name="style_photo" value="hue45"><label for="hue45"><img src="<?php echo $style->file; ?>" alt="" class="hue45"/><span>&#8730;</span></label>
				<input type="radio" id="hue120" name="style_photo" value="hue120"><label for="hue120"><img src="<?php echo $style->file; ?>" alt="" class="hue120"/><span>&#8730;</span></label>
				<input type="radio" id="hue240" name="style_photo" value="hue240"><label for="hue240"><img src="<?php echo $style->file; ?>" alt="" class="hue240"/><span>&#8730;</span></label>
				<input type="radio" id="invert" name="style_photo" value="invert"><label for="invert"><img src="<?php echo $style->file; ?>" alt="" class="invert"/><span>&#8730;</span></label>
				<input type="radio" id="brightness" name="style_photo" value="brightness"><label for="brightness"><img src="<?php echo $style->file; ?>" alt="" class="brightness"/><span>&#8730;</span></label>
				<input type="radio" id="contrast" name="style_photo" value="contrast"><label for="contrast"><img src="<?php echo $style->file; ?>" alt="" class="contrast"/><span>&#8730;</span></label>
				<div class="clear"></div><button class="btn btn_green right"><?php echo $photo->sokial('P04'); ?></button><div class="clear"></div>
			</form>
    	</div>
	</section>
</article>