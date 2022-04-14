<?php if (!empty($title)): ?>
  <h3><?php print $title ?></h3>
<?php endif ?>

<div id="views-bootstrap-accordion-<?php print $id ?>" class="<?php print $classes ?>"
  role="tablist">
  <?php foreach ($rows as $key => $row): ?>
    <?php if (isset($titles[$key])): ?>
      <div class="panel panel-default">
        <div class="panel-heading panel-title h4"
          id="heading-<?php print $id . '-' . $key ?>">
          <a class="accordion-toggle collapsed"
            aria-expanded="false"
            aria-controls="collapse-<?php print $id . '-' . $key ?>"
            type="button"
            data-toggle="collapse"
            data-parent="#views-bootstrap-accordion-<?php print $id ?>"
            href="#collapse-<?php print $id . '-' . $key ?>"
            role="tab">
            <?php print $titles[$key] ?>
          </a>
        </div>
  
        <div id="collapse-<?php print $id . '-' . $key ?>" class="panel-collapse collapse"
          aria-labelledby="heading-<?php print $id . '-' . $key ?>"
          role="tabpanel">
          <div class="panel-body">
            <?php print $row ?>
          </div>
        </div>
      </div>
    <?php endif ?>
  <?php endforeach ?>
</div>
