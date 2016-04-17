<?php

require_once __DIR__ . '/vendor/autoload.php';

use TheNileTechTest\Cart;
use TheNileTechTest\Model\Rule\Condition\BuyProductWithOrMoreQty;
use TheNileTechTest\Model\Product;
use TheNileTechTest\Model\Rule\Action\ApplyBuyXGetY;
use TheNileTechTest\Model\Rule\Action\UseFixedPrice;
use TheNileTechTest\Model\Rule\Rule;
use TheNileTechTest\Repository\ProductRepository;
use TheNileTechTest\Repository\RuleRepository;

// Let's assume the products repo is loaded with our products with prices in cents stored in memory and
// indexed by SKU for easy access
$productRepository = new ProductRepository([
    "9325336130810" => new Product("9325336130810", "Game of Thrones: Season 1", 3949),
    "9325336028278" => new Product("9325336028278", "The Fresh Prince of Bel-Air", 1999),
    "9780201835953" => new Product("9780201835953", "The Mythical Man-Month", 3187),
    "9781430219484" => new Product("9781430219484", "Coders at Work", 2872),
    "9780132071482" => new Product("9780132071482", "Artificial Intelligence", 11992),
]);
// And so with the rule repo, with priority in order and nothing would stop them
// For `ApplyBuyXGetY`, we are making the assumption the free item shall already exists in the cart to begin with
// otherwise it won't get factored in for discounting
$ruleRepository = new RuleRepository([
    new Rule(new BuyProductWithOrMoreQty("9780201835953", 10), new UseFixedPrice("9780201835953", 2199)),
    new Rule(new BuyProductWithOrMoreQty("9781430219484", 2), new ApplyBuyXGetY("9781430219484", 2, "9781430219484", 1)),
    new Rule(new BuyProductWithOrMoreQty("9325336130810", 1), new ApplyBuyXGetY("9325336130810", 1, "9325336028278", 1))
]);

function assertTotal(Cart $cart, $expected)
{
    $total = $cart->total() / 100;
    $pass = $total === $expected ? 'WOOT!! :)' : 'NOPE!! :(';
    echo $pass . " - Total: $$total. Expected: $$expected" . PHP_EOL;;
}

// Let's run simple tests
$cart = new Cart($productRepository, $ruleRepository);
$cart->addProduct("9780201835953", 10);
$cart->addProduct("9325336028278");
assertTotal($cart, 239.89);

$cart = new Cart($productRepository, $ruleRepository);
$cart->addProduct("9781430219484", 3);
$cart->addProduct("9780132071482");
assertTotal($cart, 177.36);

$cart = new Cart($productRepository, $ruleRepository);
$cart->addProduct("9325336130810");
$cart->addProduct("9325336028278");
$cart->addProduct("9780201835953");
assertTotal($cart, 71.36);
