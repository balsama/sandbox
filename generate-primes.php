<?php include('includes.php'); ?>
<h1>Find all the prime numbers lower than x.</h1>
<p>Enter any integer and click "Find Prime Factors". (Do not include commas)</p>
<form action="generate-primes.php" method="POST">
  <input type="text" name="number" value="<?php if (!empty($_POST['number'])) { print $_POST['number'];} ?>" />
  <input type="submit" value="Find Primes" />
</form>
<p><em>Numbers longer than 7 digits might exhaust available memory.</em></p>
<a href="<?php print $base_path; ?>">&laquo;Back</a>
<pre>
<?php

if (!empty($_POST['number'])) {
if (!is_numeric($_POST['number'])) {
  echo 'Your input was non-numeric. <a href="' . $base_path . '/generate-primes.php">Click here to try again.</a>';
  break;
}
function find_factors($number) {
  $factors = array();
  for ($i=$number; $i>1; $i--) {
    if (($number%$i) == 0) {
      $factors[] = $i;
    }
  }
  return $factors;
}


  function check_prime($num) {
    $prime = TRUE;
    for ($i=($num-1); $i>1; $i--) {
      if (($num%$i) == 0) {
        $prime = FALSE;
      }
    }
    return $prime;
  }

  $input = $_POST['number'];
  
  for ($i=$input; $i>1; $i--) {
    if (check_prime($i)) {
      $primes[] = $i;
    }
  }
  echo '<ol>';
  foreach ($primes as $prime) {
    print '<li>' . $prime . '</li>';
  }
  echo '</ol>';
}
?>
</pre>

