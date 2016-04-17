# THE NILE TECH TEST

## PROBLEM

The Nile wants to offer a wide variety of discounts to our customers.

Your task is to develop a system to allow for discounts to be applied
to a customers cart. The system should be flexible, allowing
for the creation of new discount types easily.

Given these products:

SKU           | Name                         | Price
--------------|------------------------------|----------
9325336130810 | Game of Thrones: Season 1    | $39.49
9325336028278 | The Fresh Prince of Bel-Air  | $19.99
9780201835953 | The Mythical Man-Month       | $31.87
9781430219484 | Coders at Work               | $28.72
9780132071482 | Artificial Intelligence      | $119.92
--------------|------------------------------|----------

Initially we would like to offer our customers these discounts:

* Buy 10 or more copies of The Mythical Man-Month, and receive them at the discounted price of $21.99
* We would like to offer a 3 for the price of 2 deal on Coders at Work. (Buy 3 get 1 free);
* Customers who purchase Game of Thrones: Season 1, will get The Fresh Prince of Bel-Air free.


Examples:

Products in cart: 9780201835953 x 10, 9325336028278
Expected total: $239.89

Products in cart: 9781430219484 x 3, 9780132071482
Expected total: $177.36

Products in cart: 9325336130810, 9325336028278, 9780201835953
Expected total: $71.36


Example interface:

$cart = new Cart($pricingRules);
$cart->addProduct("9780201835953");
$cart->addProduct("9781430219484");
$cart->total();


* use any language you wish
* do not use any external libraries (Zend etc.)
* do not use a database
* do not create a GUI (we are only interested in your implementation)
* try not to spend more than two hours on this, we don't want you working all day!


## SOLUTION

See comments on runner.php, to run:

`php runner.php`
