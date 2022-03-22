<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');

function corona_start($page_options){
  global $page_options;
  $section_options = [];
  $section_options['header_image'] = '/coronavirus/Coronavirus_WebBanner.jpg';


  if (!isset($page_options['header_image'])){
    $page_options['header_image'] = '/coronavirus/Coronavirus_WebBanner.jpg';
  }
  $page_options = array_merge($section_options, $page_options);

  page_start($page_options);
?>


  <div class="col-md-12 wrap-banner-img">
		<img src="<?php echo $page_options['header_image']; ?>" />
  </div>

  <!-- Left Col -->
  <?php
//   include $_SERVER['DOCUMENT_ROOT'] . "/template/layout/header/routes/about_leftnav.php";
//   print_left_nav($aboutleft_route, $page_options['page'], []);
  ?>
<link rel="stylesheet" type="text/css" href="/coronavirus/index.css">
<aside class="col-sm-3 col-sm-pull-9 left-column" role="complementary">
    <section class="region region-sidebar-first column sidebar">
        <div id="block-bean-coronavirus-resources" class="block block-bean first last odd" role="complementary">
            <div class="entity entity-bean bean-uaqs-related-links clearfix" about="/block/coronavirus-resources">
                <div class="content">
                    <div class="bg-trilines border-top-accent-azurite">
                        <p class="text-blue h2">
                        University of Arizona</p>
                        <p style="font-size: 16px;">Check for updates and guidance from the University of Arizona on the novel coronavirus COVID-19.</p>

                        <a href="https://www.arizona.edu/coronavirus-covid-19-information" class="btn btn-hollow btn-block" target="_blank" rel="noopener noreferrer">University of Arizona</a>  <p class="text-blue h2">

                        <p class="text-blue h2">
                        Campus Health</p>
                        <p style="font-size: 16px;">Check the Campus Health site for up to date information on novel coronavirus (COVID-19).</p>

                        <a href="https://health.arizona.edu/healthalerts" class="btn btn-hollow btn-block" target="_blank" rel="noopener noreferrer">Campus Health</a>  <p class="text-blue h2">
                        Federal, State &amp; Local</p>
                        <p style="font-size: 16px;">Here are some additional resources you may find helpful to keep you informed.</p>
                        <p><a class="btn btn-hollow btn-block" href="https://www.cdc.gov/coronavirus/2019-ncov/index.html" target="_blank" rel="noopener noreferrer">Centers for Disease<br/> Control (CDC)</a></p>
                        <p><a class="btn btn-hollow btn-block" href="https://www.azdhs.gov/preparedness/epidemiology-disease-control/infectious-disease-epidemiology/index.php#novel-coronavirus-home" target="_blank" rel="noopener noreferrer">Arizona Department of<br/> Health Services</a></p>
                        <p><a class="btn btn-hollow btn-block" href="https://webcms.pima.gov/cms/One.aspx?portalId=169&amp;pageId=527452" target="_blank" rel="noopener noreferrer">Pima County</a></p>
                        <p class="text-blue h2">
                        Travel &amp; Study Abroad</p>
                        <p style="font-size: 16px;">At this time, the University of Arizona has suspended all University-sponsored travel to China, South Korea, Iran and Italy. Check back regularly for updates.</p>

                        <a href="https://health.arizona.edu/healthalerts" class="btn btn-hollow btn-block" target="_blank" rel="noopener noreferrer">Travel Health Updates</a>

                    </div>  
                </div>
            </div>
        </div>
    </section>
</aside>

<?php
}

function corona_finish(){
?>
<?php
  page_finish();
}
