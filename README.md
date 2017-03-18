# PHP Elevator

PHP >= 7.0

This library provides a simple way to elevate a map (associative array) 
to a tree or to fold a tree to a map (associative array). The tree's 
node keys are the tokens of the map's materialized path separated by
a delimiter.

This library comes handy to map flat lists like SQL results to
documents. The result's column name could be a materialized path of
the target document. You can pass a result row to `Elevator::up` and
proceed marshalling by passing the elevated tree to a JSON or XML
serializer. On unmarshalling just pass the deserialized array tree
to `Elevator::down` and feed e.g. a SQL statement.

## Usage

### Elevate

Elevate a map with materialized paths to a tree:

```PHP
use PFlorek\Elevator\Elevator;

$flattened = [
    'World.Asia.Afghanistan.0' => '...',
    'World.Africa' => true,
    'World.Antarctica' => -25.2,
    'World.Europe' => new \stdClass(),
    'World.North America' => [],
];

$elevated = Elevator::up($flattened);

var_dump($elevated);

//returns ["World"] => array(5) {
//  ["Asia"] => array(1) {
//    ["Afghanistan"] => array(1) {
//      [0] => string(3) "..."
//    }
//  }
//  ["Africa"] => bool(true)
//  ["Antarctica"] => float(-25.2)
//  ["Europe"]=> object(stdClass)#298 (0) {}
//  ["North America"]=> []
//}
```

### Fold

Folding a tree to a map which keys are the materialized path of the node's keys:


```PHP
use PFlorek\Elevator\Elevator;

$elevated = [
    'World' => [
        'Asia' => [
            'Afghanistan' => [
                '...'
            ]
        ],
        'Africa' => true,
        'Antarctica' => -25.2,
        'Europe' => new \stdClass(),
        'North America' => [],
    ]
];

$flattened = Elevator::down($elevated);

var_dump($flattened);

//returns array(5) {
//  ["World.Asia.Afghanistan.0"] => string(3) "..."
//  ["World.Africa"] => bool(true)
//  ["World.Antarctica"] => float(-25.2)
//  ["World.Europe"] => object(stdClass) (0) { }
//  ["World.North America"] => array(0) { }
//}
```

## Installation

Use [Composer] to install the package:

```bash
composer require pflorek/elevator
```

## License

All contents of this package are licensed under the [MIT license].
