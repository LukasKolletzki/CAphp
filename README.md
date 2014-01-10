#CAphp
CAphp is a simple cellular automaton, written in PHP.

##Properties

###width
_**(int)**_ Amount of cells per row
```php
$width = 13;
```

###height
_**(int)**_ Amount of rows the automaton contains
```php
$height = 37;
```

###generations
_**(int)**_ Amount of generations the automaton should live
```php
$generations = 42;
```

###rules
_**(array)**_ Defines, on which amount of living neighbor cells, the current cell survives, gets born or dies, where `0` means surviving, `1` means birth and `2` means dead:
```php
$rules = [
	0 => 0,  //when zero neighbor cells live, the current cell  will survive, in this case it will stay dead
	1 => 1,  //when one neighbor cell lives, the current cell will get born
	2 => 2,  //when two neighbor cells live, the current cell will die
	3 => 0,  //
	4 => 1,  //  .
	5 => 2,  //  .
	6 => 0,  //  .
	7 => 1,  //  .
	8 => 2   //
];

$rules_short = [0, 1, 2, 0, 1, 2, 0, 1, 2];
```

###start configuration
_**(array)**_ Defines cells, that should live from begin
```php
$startconf = [
	13,  //cell with ID 13 = 14th cell
	37,  //cell with ID 37 = 38th cell
	42,  //cell with ID 42 = 43th cell
	299  //cell with ID 299  = 300th cell
];

$startconf_short = [13, 37, 42, 299];
```

###neighborhood type _[optional]_
_**(int)**_ Defines, which neighborhood should be used, either Moore neighborhood (`0`, default) or Von Neumann neighborhood (`1`):
```php
$neighborhood = 0; //moore neighborhood
```

##Methods

###constructor
```php
void __construct(int $width, int $height, int $generations, array $rules, array $startconf [, int $neighborhood])
```

Main constructor, paramater explanation see above

###live
```php
void live([int $generations])
```

Let the automaton live, if `$generations` is submitted, the automaton will live as many generations as in it, otherwise it will run all the amount of generations, submitted to the constructor.

###get*
Getter methods.

###set*
Setter methods.

##Example
Live all generations an dump it out if finished:
```php
<?php
include "caphp.php";

$width = 13;
$height = 37;
$generations = 42;
$rules = [0, 1, 2, 0, 1, 2, 0, 1, 2];
$startconf = [13, 37, 42, 299];
$neighborhood = 1;

$ca = new CAphp($width, $height, $generations, $rules, $startconf, $neighborhood);

$ca->live();

var_dump($ca->getAutomaton());
```

Print each generation:
```php
<?php
include "caphp.php";

$width = 13;
$height = 37;
$generations = 42;
$rules = [0, 1, 2, 0, 1, 2, 0, 1, 2];
$startconf = [13, 37, 42, 299];

$ca = new CAphp($width, $height, $generations, $rules, $startconf);

for($i = 0; $i < $generations; $i++) {
	$ca->live(1);
	var_dump($ca->getAutomaton());
}
```

##License
CAphp provides basic functions of a cellular automaton.
Copyright (C) 2014 Lukas Kolletzki

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see http://www.gnu.org/licenses/.