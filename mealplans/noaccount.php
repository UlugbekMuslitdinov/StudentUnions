<?php
require_once('template/mp.inc');
$page_options['page'] = 'No Account';
mp_start('No Account', 0, 0,0);
?>
<div style="display:none;">
    <pre>
    <?php
        var_dump($_SESSION);
    ?>
    </pre>
</div>

We're sorry but we can't seem to find you in our system. This is usually caused by one of two reasons:<br /><br /> 
<ul>
<li>You are a new student and haven't received your CatCard yet. Once you receive your CatCard you can return and signup.</li>
<li>There's an error with your account. Please contact the Meal Plans Office  at (520) 621-7043 or (800) 374-7379 for assistance.</li>
</ul>
<br />
<a href="index.php?logout=1">Click here to logout</a>
<?php mp_finish();?>
