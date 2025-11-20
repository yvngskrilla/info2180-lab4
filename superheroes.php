<?php

$superheroes = [
  [
      "id" => 1,
      "name" => "Steve Rogers",
      "alias" => "Captain America",
      "biography" => "Recipient of the Super-Soldier serum, World War II hero Steve Rogers fights for American ideals as one of the world’s mightiest heroes and the leader of the Avengers.",
  ],
  [
      "id" => 2,
      "name" => "Tony Stark",
      "alias" => "Ironman",
      "biography" => "Genius. Billionaire. Playboy. Philanthropist. Tony Stark's confidence is only matched by his high-flying abilities as the hero called Iron Man.",
  ],
  [
      "id" => 3,
      "name" => "Peter Parker",
      "alias" => "Spiderman",
      "biography" => "Bitten by a radioactive spider, Peter Parker’s arachnid abilities give him amazing powers he uses to help others, while his personal life continues to offer plenty of obstacles.",
  ],
  [
      "id" => 4,
      "name" => "Carol Danvers",
      "alias" => "Captain Marvel",
      "biography" => "Carol Danvers becomes one of the universe's most powerful heroes when Earth is caught in the middle of a galactic war between two alien races.",
  ],
  [
      "id" => 5,
      "name" => "Natasha Romanov",
      "alias" => "Black Widow",
      "biography" => "Despite super spy Natasha Romanoff’s checkered past, she’s become one of S.H.I.E.L.D.’s most deadly assassins and a frequent member of the Avengers.",
  ],
  [
      "id" => 6,
      "name" => "Bruce Banner",
      "alias" => "Hulk",
      "biography" => "Dr. Bruce Banner lives a life caught between the soft-spoken scientist he’s always been and the uncontrollable green monster powered by his rage.",
  ],
  [
      "id" => 7,
      "name" => "Clint Barton",
      "alias" => "Hawkeye",
      "biography" => "A master marksman and longtime friend of Black Widow, Clint Barton serves as the Avengers’ amazing archer.",
  ],
  [
      "id" => 8,
      "name" => "T'challa",
      "alias" => "Black Panther",
      "biography" => "T’Challa is the king of the secretive and highly advanced African nation of Wakanda - as well as the powerful warrior known as the Black Panther.",
  ],
  [
      "id" => 9,
      "name" => "Thor Odinson",
      "alias" => "Thor",
      "biography" => "The son of Odin uses his mighty abilities as the God of Thunder to protect his home Asgard and planet Earth alike.",
  ],
  [
      "id" => 10,
      "name" => "Wanda Maximoff",
      "alias" => "Scarlett Witch",
      "biography" => "Notably powerful, Wanda Maximoff has fought both against and with the Avengers, attempting to hone her abilities and do what she believes is right to help the world.",
  ], 
];

$query = '';
if (isset($_GET['query'])) {
    $query = trim((string) $_GET['query']);
}

if ($query === '') {
    header('Content-Type: text/html; charset=utf-8');
    echo "<ul>\n";
    foreach ($superheroes as $superhero) {
        echo "  <li>" . htmlspecialchars($superhero['alias'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . "</li>\n";
    }
    echo "</ul>\n";
    exit;
}
$found = null;
$lowerQuery = mb_strtolower($query, 'UTF-8');
foreach ($superheroes as $hero) {
    $alias = mb_strtolower($hero['alias'], 'UTF-8');
    $name = mb_strtolower($hero['name'], 'UTF-8');
    if (mb_strpos($alias, $lowerQuery) !== false || mb_strpos($name, $lowerQuery) !== false) {
        $found = $hero;
        break;
    }
}

header('Content-Type: text/html; charset=utf-8');
if ($found) {
    echo '<h3>' . htmlspecialchars($found['alias'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</h3>' . "\n";
    echo '<h4>' . htmlspecialchars($found['name'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</h4>' . "\n";
    echo '<p>' . htmlspecialchars($found['biography'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</p>' . "\n";
} else {
    echo 'Superhero not Found';
}

?>