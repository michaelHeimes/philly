<div class="row">
	<div class="small-12 columns">

		<h1 class="section-title"><? the_title()?></h1>
		<? the_content()?>
			
		<? $programs = get_terms('program', array('hide_empty'=> false))?>
		<? if($programs){?>
			<? foreach($programs as $program){ ?>
				<div class="row program">
					<div class="small-4 columns">
						<? $img = get_field('logo','program_'.$program->term_id);?>
						<a href="<? the_field('link','program_'.$program->term_id); ?>" title="<?= $program->name?>">
							<img src="<?=$img['url']?>" alt="<?= $program->name?>">
						</a>
					</div>
					<div class="small-8 columns">
						<h2 style="color:<? the_field('color','program_'.$program->term_id); ?>"><?= $program->name?></h2>
						<?= $program->description?>
						<a href="<? the_field('link','program_'.$program->term_id); ?>" title="<?= $program->name?>">
							Learn More
						</a>
					</div>
				</div>
			<? } ?>
		<? } ?>

	</div>
</div>

