<?php include('includes.php'); ?>
<h1>The sounds-like machine</h1>
<p>Enter a word, and I'll try to determine if it's a phonetic misspelling of any of the words below</p>
<h2>Description of method used</h2>
<p>We're searching for words that sound alike using the <a href="http://en.wikipedia.org/wiki/Soundex">Soundex</a> phonetic algorithm</p>
<p>In short, each search word is converted to a four-character string <em>Xn1n2n3</em>. To determine a word's string:</p>
<ol>
  <li>X = the first letter of the word</li>
  <li>Drop all remaining occurrences of a, e, h, i, o, u, w and y</li>
  <li>Replace consonants with digits as follows:
    <ul>
      <li>b, f, p, v => 1</li>
      <li>c, g, j, k, q, s, x, z => 2</li>
      <li>d, t => 3</li>
      <li>l => 4</li>
      <li>m, n => 5</li>
      <li>r => 6</li>
    </ul>
    <li>Two adjacent letters with the same number are coded as a single number.</li>
    <li>Continue until you have one letter and three numbers. If you run out of letters, fill in 0s until there are three numbers.</li>
  </li>
</ol>
<p>If the soundex string for any of the words you entered matches any of the soundex strings in our word list, we treat it as a match.</p>
<h2>Search for similar words</h2>
<form method="POST">
<input type="text" name="q" />
<input type="submit" value="check" />
</form>
<p><em>Try "pear" or "heard".</em></p>
<?php
$titles = "ad|add|allowed|aloud|ant|aunt|ate|eight|ball|bawl|band|banned|bear|bare|be|bee|billed|build|blew|blue|board|bored|boy|buoy|brake|break|by|bye|buy|beach|beech|bolder|boulder|bread|bred|brouse|brows|capital|capitol|caret|carrot|carat|karat|cell|sell|cent|scent|sent|census|senses|cereal|serial|chews|choose|choral|coral|chute|shoot|clothes|close|colonel|kernel|creak|creek|crews|cruise|cymbal|symbol|days|daze|dear|deer|dew|do|due|die|dye|disc|disk|discreet|discrete|discussed|disgust|doe|dough|doughs|doze|earn|urn|ewe|you|eye|I|fare|fair|feat|feet|find|fined|fir|fur|flea|flee|flew|flu|flue|flower|flour|for|four|fore|forth|fourth|foul|fowl|frees|freeze|gneiss|nice|gnu|knew|new|gored|gourd|gorilla|guerrilla|grays|graze|grate|great|guessed|guest|gym|Jim|hale|hail|hall|haul|hare|hair|heal|heel|he'll|heard|herd|hew|hue|hi|high|higher|hire|him|hymm|hair|hare|hoarse|horse|hole|whole|hour|our|idle|idol|idle|idol|idyl|in|inn|incite|insight|its|it's|jam|jamb|jeans|genes|knead|need|kneed|knight|night|knows|nose|no's|lead|led|leased|least|lessen|lesson|lie|lye|links|lynx|load|lode|lowed|loan|lone|locks|lox|loot|lute|maid|made|mail|male|maize|maze|meet|meat|medal|meddle|mince|mints|miner|minor|missed|mist|mooed|mood|morning|mourning|muscle|mussel|mussed|must|nays|neighs|no|know|none|nun|nose|knows|no's|not|knot|naught|one|won|or|oar|ore|overdo|overdue|paced|paste|pail|pale|pain|pane|pair|pare|pear|pain|pane|passed|past|patience|patients|pause|paws|peace|piece|peak|peek|pique|peal|peel|pedal|peddle|peer|pier|pi|pie|plain|plane|plum|plumb|praise|prays|preys|presence|presents|principal|principle|prince|prints|quarts|quartz|quince|quints|rain|reign|rein|raise|rays|raze|rap|wrap|read|reed|read|red|real|reel|reek|wreak|rest|wrest|review|revue|right|rite|write|ring|wring|road|rode|rowed|roe|row|role|roll|root|route|rose|rows|rote|wrote|roux|rue|rye|wry|sacks|sax|sail|sale|sawed|sod|scene|seen|sea|see|seam|seem|seas|sees|seize|serf|surf|serge|surge|sew|so|sow|shoe|shoo|side|sighed|sighs|size|sign|sine|sight|site|cite|slay|sleigh|soar|sore|soared|sword|sole|soul|son|sun|some|sum|spade|spayed|staid|stayed|stair|stare|stake|steak|stationary|stationery|steal|steel|straight|strait|suede|swayed|summary|summery|sundae|Sunday|tacks|tax|tail|tale|taut|taught|tea|tee|teas|tease|tees|tents|tense|tern|turn|there|their|they're|threw|through|throne|thrown|thyme|time|tide|tied|tighten|titan|to|too|two|toad|toed|towed|toe|tow|told|tolled|tracked|tract|trussed|trust|use|ewes|vein|vane|verses|versus|vial|vile|vice|vise|wade|weighed|wail|whale|waist|waste|wait|weight|waive|wave|Wales|whales|war|wore|ware|wear|where|warn|worn|wax|whacks|way|weigh|whey|we|wee|weather|whether|we'd|weed|weld|welled|we'll|wheel|wen|when|we've|weave|weak|week|which|witch|whirled|world|whirred|word|whine|wine|whoa|woe|who's|whose|wood|would|worst|wurst|yoke|yolk|you'll|yule|your|you're|yore";

$titles = explode('|', $titles);
$i = '0';
foreach ($titles as $title) {
  $words = explode(' ', $title);
  foreach ($words as $word) {
    $search_words = explode(' ', check_plain($_POST['q']));
    foreach ($search_words as $search_word) {
      if (soundex($search_word) == soundex($word)) {
        if ($search_word != $word) {
          if ($i == '0') {
            echo "<h3>I found the following similar words:</h3><br />";
          }
            print '<li><em>' . $search_word . '</em> might be a homonym for <em>' . $word . '</em><br /></li>';
          $i++;
        }
      }
    }
  } 
}
if (($i == '0') && (!empty($_POST['q']))) {
  echo 'Sorry, I couldn\'t find any words that sound like <em>' . $_POST['q'] . '</em><p>Note that this method will not return results that don\'t start with the same letter';
}
?>
<p><a href="<?php print $base_path; ?>">&laquoBack</a></p>
<?php
echo '<h2>Word List</h2>';
foreach ($titles as $title) {
  $words = explode(' ', $title);
  foreach ($words as $word) {
    print $word . '<br />';
  }
}
?>
