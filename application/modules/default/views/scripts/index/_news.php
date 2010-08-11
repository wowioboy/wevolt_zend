<? 
$results = Wevolt_Factory::table('news')->getNews($this->type);
var_dump($results);
?>
<div class="panel_holder" style="width:412px;">
  <div class="panel_top">
    <div class="table fill">
      <div class="cell left middle">Latest</div>
      <div class="cell right middle"><span id="latestnavs"></span></div>
    </div>
  </div>
  <div class="panel_body" style="height:230px;">
  </div>
</div>