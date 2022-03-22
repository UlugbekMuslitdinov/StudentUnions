 <div class="col-sm-12">
  <img src="img/hub_header.png" style="margin-bottom: 20px; padding-top: 10px;">
  <hr />
</div>
<div class="col-sm-12">
  <!-- Nav pills -->
  <ul class="nav nav-pills nav-justified" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Events</a></li>
    <li role="presentation"><a href="#progress" aria-controls="progress" role="tab" data-toggle="tab">Progress</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <?php include_once($events); ?>
    <?php include_once($progress); ?>
  </div>
</div>