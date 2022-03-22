<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
  $page_options['title'] = 'Shopping & Services';
  $page_options['nav']['Shopping & Services']['Arizona Primary Eye Care & Optical']['link'] = 'http://arizonaprimaryeyecare.com/locations/ua';
  $page_options['nav']['Shopping & Services']['Career Services']['link'] = 'http://career.arizona.edu/';
  $page_options['nav']['Shopping & Services']['CatCard Office']['link'] = 'http://www.catcard.arizona.edu';
  $page_options['nav']['Shopping & Services']['Event Services']['link'] = '/rooms';
  $page_options['nav']['Shopping & Services']['Fast Copy &amp; Design']['link'] = '/fastcopy/index.php';

  // $page_options['nav']['Shopping & Services']['Kaplan']['link'] = 'http://www.kaplan.com';
  $page_options['nav']['Shopping & Services']['Off-Campus Housing']['link'] = 'http://offcampus.arizona.edu';
  $page_options['nav']['Shopping & Services']['Transfer Student Center']['link'] = 'http://transfer.arizona.edu/';
  $page_options['nav']['Shopping & Services']['UA Bookstore']['link'] = 'http://www.uofabookstores.com';
  $page_options['nav']['Shopping & Services']['US Post Office']['link'] = '/shopping/usps/index.php';
  $page_options['nav']['Shopping & Services']['Wells Fargo']['link'] = 'http://www.wellsfargo.com';
  $page_options['header_image'] = '/template/images/banners/retail_services.png';
  page_start($page_options);
?>
<p>The Arizona Student Unions offer several convenient services right inside the Student Union Memorial Center. So you never have to leave campus.</p>
<style>
	table.shopping td.icon
	{
		text-align: center;
		padding: 0px 10px 0px 0px;
		width: 120px;
		height: 65px
	}

	table.shopping td.description
	{
		font-size: 11px;
	}
</style>
<table class="shopping">
	<tr>
		<td class="icon">
			<a href="/fastcopy/index.php"><img src="/template/images/logos/fastcopy_logo.gif" alt="Fast Copy" height="37" width="67" border="0"></a>
		</td>
		<td class="description">
			<b>Fast Copy</b><br />
			Fast Copy provides fast, quality copy service, that is competitively priced and in a manner that meets or exceeds our customer expectations.<br />
			(520) 621-5306
		</td>
	</tr>
	<tr>
		<td class="icon">
			<a href="/involvement/gamesroom/"><img src="/template/images/logos/gamesroom.png" alt="Games Room" width="80px" height="auto"/></a>
		</td>
		<td class="description">
			<b>Cellar Games Room</b><br />
			You go to class. You study all day. Ever have fun?<br/>
			(520) 621-1450
		</td>
	</tr>
	<tr>
		<td class="icon">
			<a href="http://www.uofabookstores.com" target="_blank"><img src="/template/images/logos/bookstore_logo.gif" alt="U of A Bookstores" height="41" width="65" border="0"></a>
		</td>
		<td class="description">
			<b>UA Bookstore</b><br />
			Your srouce for textbooks, school supplies, apparel and computers.<br />
			(520) 621-2426
		</td>
	</tr>
	<tr>
		<td class="icon">
			<a href="http://www.catcard.arizona.edu/"><img src="/template/images/logos/catcard.png" alt="Catcard" width="85px" height="auto"/></a>
		</td>
		<td class="description">
			<b>Catcard Office</b><br />
			Your access and identification to the University.<br />
			(520) 626-9162
		</td>
	</tr>
	<tr>
		<td class="icon">
			<a href="https://www.usps.com/"><img src="/template/images/logos/usps.png" alt="USPS" width="60px" height="auto"/></a>
		</td>
		<td class="description">
			<b>USPS</b><br />
			Express and priority shipping available as well as mailboxes for rent.<br />
			(520) 626-6245
		</td>
	</tr>
	<tr>
		<td class="icon">
			<a href="https://www.wellsfargo.com/"><img src="/template/images/logos/wellsfargo_logo.gif" alt="Wells Fargo" width="60px" height="auto"/></a>
		</td>
		<td class="description">
			<b>Wells Fargo</b><br />
			One of the nation's largest banks comes to the union.<br />
		</td>
	</tr>
	<tr>
		<td class="icon">
			<a href="http://arizonaprimaryeyecare.com/locations/ua"><img src="/template/images/logos/az_primary_eyecare.jpg" alt="Arizona Primary Eye Care" width="60px" height="auto"/></a>
		</td>
		<td class="description">
			<b>Arizona Primary Eye Care & Optical</b><br />
			Your optometrist on campus.<br />
			(520) 621-3253 
		</td>
	</tr>
</table>
</div>
<?php page_finish() ?>
