<div class="node<?php if ($sticky) { print " sticky"; } ?><?php if (!$status) { print " node-unpublished"; } ?>" id="node-<?php print $node->nid; ?>">
  <?php if ($page == 0): ?>
    <h2 class="title">
      <a href="<?php print $node_url ?>"><?php print $title ?></a>
    </h2>
  <?php endif; ?>

  <?php if ($picture) print $picture ?>  
  
  <?php if ($submitted or $has_terms): ?>
  <div class="meta<?php if ($has_terms) : ?> with-taxonomy<?php endif; ?>">
  
    <?php if ($submitted): ?>
      <div class="submitted"><?php print t('Posted !date by !name', array('!date' => format_date($node->created, 'custom', "F jS, Y"), '!name' => theme('username', $node))); ?></div> 
    <?php endif; ?>
    
    <?php if ($has_terms) : ?> 
      <div class="taxonomy"><?php print $terms ?></div>
    <?php endif; ?>
    
  </div>
  <?php endif; ?>
  
  <div class="content">
    <?php print $content?>
  </div>
  
  <?php if ($links): ?>
    <div class="links">
      <?php print $links ?>
    </div>
  <?php endif; ?>
  
</div>
