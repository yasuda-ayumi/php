<?php

$people = [
  ['Taro', 25, 'men'],
  ['Jiro', 20, 'men'],
  ['hanako', 16, 'women']
];

foreach ($people as $person) {
  echo $person[0] . '(' . $person[1] . '歳' . $person[2] . ')'. '<br />';
}
/* foreach ($people as $personで一人分の配列を
＄personに取り出す。
3回繰り返す。
[]内の要素はそれぞれ０、１、２の番号がついている。
