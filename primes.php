<?php include('includes.php'); ?>
<?php
  // show errors
  if (!defined('E_STRICT')) { define('E_STRICT', 2048); } // E_STRICT isn't defined in PHP 4
  error_reporting(E_ALL | E_STRICT);
  ini_set('display_errors', '1');         //
  ini_set('display_startup_errors', '1'); //
  ini_set('track_errors', '1');           // store last error in $php_errormsg
  ini_set('html_errors', '0');            // don't output html links in error messages
  ini_set('log_errors', '1');
  ini_set('error_log', dirname(__FILE__) . '/_php_error.log');
  // end: show errors
?>
<h1>Find the Prime Factors of any integer</h1>
<p>Enter any integer and click "Find Prime Factors". (Do not include commas)</p>
<form action="primes.php" method="POST">
  <input type="text" name="number" value="<?php if (!empty($_POST['number'])) { print $_POST['number'];} ?>" />
  <input type="submit" value="Find Prime Factors" />
</form>
<p><em>Numbers longer than 7 digits might exhaust available memory.</em></p>

<?php
if (!empty($_POST['number'])) {
if (!is_numeric($_POST['number'])) {
  echo '<p>Your entry was non-numeric. <a href="' . $base_path . '/primes.php">Click here to try again.</a></p>';
  return;
}

function find_factors($number) {
  $factors = array();
  for ($i=$number; $i>1; $i--) {
    if (($number%$i) == 0) {
      $factors[] = $i;
      $adam = 'foo';
    }
  }
  return $factors;
}

function divide($number, $divisor) {
  $iterations = count($divisor);
  $match = FALSE;
  for($i=($iterations-1); $i>=0; $i--) {
    $remainder = ($number%$divisor[$i]);
    if ($remainder == 0) {
      $match = $divisor[$i];
      return $match;
    }
  }
}

$input = $_POST['number'];

$factors = find_factors($input);

foreach ($factors as $factor) {
  if (count(find_factors($factor)) == 1) {
    $prime_factors[] = $factor;
  }
}

$divided = $input;
$i = 0;
while($i<100) {
  $step[$i] = divide($divided, $prime_factors);
  if ($i == 0) {
    $divided = ($input/$step[$i]);
  }
  else {
    $divided = ($divided/$step[$i]);
  }
  if (array_product($step) == $input) {
    break;
  }
  $i++;
}


  echo '<pre><h2>';
  if (count($step) == 1) {
    print $input . ' is prime. <br />';
  }
  $steps = implode(' * ', $step);
  print $steps . ' = ' . number_format($input);
  echo '</h2></pre>';
}
?>
<a href="<?php print $base_path; ?>">&laquo;Back</a>
