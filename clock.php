<?php include('includes.php'); ?>
<h1>PHP Clock</h1>
<p>Include a URL param "?time=hh:mm" to set the clock's time, or leave the param blank for the clock to display the current server time</p>
<pre>
<?php
if (!empty($_GET['time'])) {
  print "You entered: " . check_plain($_GET['time']) . ' as the time you want displayed<br />';
  $time = explode(':', $_GET['time']);
  if ((!is_numeric($time[0])) || (!is_numeric($time[1]))) {
    echo 'The time you entered was not in the correct format.<br /><a href="' . $base_path . '/clock.php">Click here to try again</a>.';
    break;
  }
}
else {
  $time = date('G:i');
  print 'The current time is: ' . $time . '<br />';
  $time = explode(':', $time);
}

$hour = $time[0];
$minute = $time[1];
$minute_fd = substr($minute, 0, 1);
$minute_sd = substr($minute, 1);
if ($minute_sd >= '5') {
  $minute_sd = '5';
}
else {
  $minute_sd = '0';
}

$minute = $minute_fd . $minute_sd;

$i = '0';
$num = array();
while ($i <= 11) {
 
 if ($i%2 == '') {
 $num[] = $i/2;
 }
 else {
   $num[] = $i;
 }
 $i++;
}

$num[11] = '6';
$num[9] = '7';
$num[7] = '8';
$num[5] = '9';
$num[3] = '10';
$num[1] = '11';
$num[0] = '12';

if ($hour > 12) {
  $hour = $hour-12;
}
$count1 = count($num);
for($i = 0; $i < $count1; $i++) {
  if (($num[$i] == $hour) && (($num[$i] * '5') == $minute)) {
    $num[$i] = 'x';
  }
  elseif ($num[$i] == $hour) {
    $num[$i] = 'h';
  }
  elseif (($num[$i] * '5') == $minute) {
    $num[$i] = 'm';
  }
  else {
    $num[$i] = 'o';
  }
}
if (($minute == '00') && ($hour == '12')) {
  $num[0] = 'x';
}
elseif ($minute == '00') {
  $num[0] = 'm';
}

$num[0] = '        ' . $num[0] . '<br />';
$num[1] = '    ' . $num[1];
$num[2] = '       ' . $num[2] . '<br /><br />';
$num[3] = ' ' . $num[3];
$num[4] = '             ' . $num[4] . '<br /><br />';
$num[5] = $num[5];
$num[6] = '               ' . $num[6] . '<br /><br />';
$num[7] = ' ' . $num[7];
$num[8] = '             ' . $num[8] . '<br /><br />';
$num[9] = '    ' . $num[9];
$num[10] = '       ' . $num[10] . '<br />';
$num[11] = '        ' . $num[11];

foreach($num as $clockpos) {
  print $clockpos;
}

?>
</pre>
<p>Criteria:</p>
<ul>
  <li>Each hour mark  is drawn with '<tt>o</tt>' (Lower-case O).</li>
  <li>The hour mark representing the hour given in the input is drawn with an '<tt>h</tt>'.</li>
  <li>The hour mark representing the minute given in the input is drawn with an '<tt>m</tt>'.</li>
  <li>If the hour and the minute both fall on the same mark, then it is drawn with an '<tt>x</tt>'.</li>
  <li>Minutes past the hour are rounded down to the nearest 5 for the purposes of marking it on the clock (so 23 becomes 20, 39 becomes 35).</li>
</ul>
<p>Inspired by: <a href="http://codegolf.com/saving-time">http://codegolf.com/saving-time</a></p>
<a href = "<?php print $base_path; ?>">&laquoBack</a>
