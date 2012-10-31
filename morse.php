<?php include('includes.php'); ?>
<title>Morse Code Generator</title>

<h1>Morse Code Generator</h1>
<p>Enter any string and it will be converted to Morse Code.</p>
<p>Accepts alpha characters (case insensitive), numbers, spaces, and limited punctuation.</p>

<form action="morse.php" method="POST">
  <input type="text" name="string" value="<?php if (!empty($_POST['string'])) { print $_POST['string'];} ?>" />
  <input type="submit" value="Generate Morse Code" />
</form>

<?php
function text2morse($string) {
$maps = array (
  'A' => '.-',
  'B' => '-...',
  'C' => '-.-.',
  'D' => '-..',
  'E' => '.',
  'F' => '..-.',
  'G' => '--.',
  'H' => '....',
  'I' => '..',
  'J' => '.---',
  'K' => '-.-',
  'L' => '.-..',
  'M' => '--',
  'N' => '-.',
  'O' => '---',
  'P' => '.--.',
  'Q' => '--.-',
  'R' => '.-.',
  'S' => '...',
  'T' => '-',
  'U' => '..-',
  'V' => '...-',
  'W' => '.--',
  'X' => '-..-',
  'Y' => '-.--',
  'Z' => '--..',
  '0' => '-----',
  '1' => '.----',
  '2' => '..---',
  '3' => '...--',
  '4' => '....-',
  '5' => '.....',
  '6' => '-....',
  '7' => '--...',
  '8' => '---..',
  '9' => '----.',
  '.' => '.-.-.-',
  ',' => '--..--',
  '?' => '..--..',
  '\'' => '.----.',
  ' ' => '  ',
);

  $string = str_split(check_plain($string));
  $converted = array();
  foreach ($string as $letter) {
    foreach ($maps as $input => $output) {
      if ($letter === $input) {
        $converted[] = $output;
      }
    }
  }
  
  $processed = implode(' ', $converted);

  return $processed;

}

if (!empty($_POST['string'])) {
  echo '<pre><h4><strong>';
  print ' ' . $_POST['string'] . '<br />/';
  $count = count(str_split($_POST['string']));
  for ($i=0; $i<$count; $i++) {
    echo '-';
  }
  echo '\<br />';
  print text2morse(strtoupper($_POST['string']));
  echo '</strong></h4></pre>';
}
?>
<a href="<?php print $base_path; ?>">&laquo;Back</a>
