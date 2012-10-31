<?php include('includes.php'); ?>
<pre>
<div style="width: 700px; margin: auto;">
<h1>Give me a year, and I'll give you a calendar</h1>
<p>This thing will accept any year from "1" all the way up to infinity...<br />Although the tenses in the 'fun facts' get confused for years beyond 9999.<br />By then, hopefully we'll have a date format that can accept more than four digits for the year.</p> 
<form action="calendar.php" method="get">
  <label for="year">Year:</label>
  <input type="text" name="year" />
  <input type="submit" value="Get Calandar" />
</form>
<?php if (!empty($_GET['year'])) : ?>
<?php if (is_numeric($_GET['year'])) : ?>
<?php
$this_year = $_GET['year'] . '-01-01';
$this_year = new DateTime($this_year);
$flag_day = $_GET['year'] . '-06-14';
$flag_day = new DateTime($flag_day);
?>
<h2>Fun facts about <?php print $_GET['year']; ?></h2>
<ul>
  <li><?php print check_plain($_GET['year']); ?><?php if ((date('Y') < $this_year->format('Y')) && ($this_year->format('L') == '0')) : ?> will not be a leap year<?php elseif ((date('Y') < $this_year->format('Y')) && ($this_year->format('L') == '1')) : ?> will be a leap year<?php endif; ?><?php if ((date('Y') == $this_year->format('Y')) && ($this_year->format('L') == '0')) : ?> is not a leap year<?php elseif ((date('Y') == $this_year->format('Y')) && ($this_year->format('L') == '1')) : ?> is a leap year<?php endif; ?><?php if ((date('Y') > $this_year->format('Y')) && ($this_year->format('L') == '0')) : ?> was not a leap year<?php elseif ((date('Y') > $this_year->format('Y')) && ($this_year->format('L') == '1')) : ?> was a leap year<?php endif; ?></li><li><?php if ((date('Y') > $this_year->format('Y')) && ($this_year->format('Y') >= '1916')) : ?>Flag day was celebrated on a <?php print $flag_day->format('l'); ?><?php elseif ((date('Y') > $this_year->format('Y')) && ($this_year->format('Y') < '1916')) : ?>Flag day would have been celebrated on a <?php print $flag_day->format('l'); ?>, but it didn't exist yet<?php elseif (date('Y') < $this_year->format('Y')) : ?>Flag day will be celebrated on a <?php print $flag_day->format('l'); ?>, if it still exists.<?php elseif (date('Y') == $this_year->format('Y')) : ?>Flag day is celebrated on a <?php print $flag_day->format('l'); ?> this year<?php endif; ?>
  </li>
</ul>

<?php
$year = check_plain($_GET['year']);

$month = array();
$m = '1';
while ($m <= 12) {
  if ($m < '10') {
    $month[$m] = $year . '-0' . $m . '-01';
  }
  else {
    $month[$m] = $year . '-' . $m . '-01';
  }
  $m++;
}

$month_count = '1';
foreach ($month as $this_month) {
  echo '<div style="width: 200px; float: left;">';
  $date = new DateTime($this_month);
  print '<br />' . $date->format('F') . '<br />';
  echo 'Su Mo Tu We Th Fr Sa<br />';
  $i = '1';
  $start_day = $date->format('w');
  $skip = '0';
  while ($skip < $start_day) {
    echo '   ';
    $skip++;
  }
  while ($i <= $date->format('t')) {
    if ($i < '10') {
      print ' ' . $i . ' ';
    }
    else {
      print $i . ' ';
    }
    if (($skip + $i)%7 == '0') {
      echo '<br />';
    }
    $i++;
  }
  echo '<br />';
  echo '</div>';
  if ($month_count%3 == '0') {
    echo '<div style="clear: both;"></div>';
  }
  $month_count++;
}
?>
</div>
<?php else : ?>
<h3>Error: Input was non numeric. Please enter a year</h3>
<?php endif; ?>
<?php endif; ?>
</div>
</pre>
<a href="<?php print $base_path; ?>">&laquo;Back</a>
