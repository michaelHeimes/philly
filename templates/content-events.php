<? 
  $program = get_field('related_program');
  $program_color = (get_field('color', 'program_'.$program->term_id))?get_field('color', 'program_'.$program->term_id):'';
?>
<a href="<? the_permalink()?>" class="event <?=$program->name?>" style="background:<?=$program_color?>;">
  <div class="date"><? the_field('date')?></div>
  <? the_title();?>
  <div class="meta">
    <span class="loc"><?=(get_field('location'))?get_field('location'):''?></span>
    <span class="program"><?=($program->name)?' - '.$program->name:'';?></span>
  </div>
</a>


