<?php

class Product
{
	public float $price;
	public string $name;
	public string $code;
	public array $cart;
	
	// values only used within class methods
	protected float $deliveryFee;

	const FLOWERS = [
		['Red Flower', 'RF1', 32.95],
		['Green Flower', 'GF1', 22.95],
		['Blue Flower', 'BF1', 72.95]
	];
		
	// functions
	
	public function emptyCart(){
		$this->cart = array();
	}

	private function determineDeliveryFee($orderTotal){
		switch($orderTotal){
			case $orderTotal < 50:
			$fee = 4.95;
			break;
			case $orderTotal < 90:
				$fee = 2.95;
				break;
			default:
				$fee = 0.00;
		}
		return $fee;		
	}

	private function determineDeal($cart){
		$redFlower = 'Red Flower';//self::FLOWERS[0][0];
		$count = 0;
		$cartCount = count($cart);
		for($i = 1; $i < $cartCount; $i++){
			//if there are 2 red flowers in the array, one of them is half price
			if($cart[$i][0] == $redFlower){
				//for every second flower, half the price
				if(($i +1) % 2 == 0){
					$cart[$i][2] = number_format($cart[$i][2] / 2, 2, '.', '') ;
				}
			}
		}
		return $cart;
	}

	function addToCart($codes){
		$cart = array();
		$flowers = Product::FLOWERS;
		foreach($codes as $code){
			foreach($flowers as $flower){
				if($code == $flower[1]){
					$cart[] = $flower; 
				}
			}
		}
		self::evaluateCart($cart);
		return $cart;
	}

function evaluateCart($cart){
		// evaluate for deals
		$cart = self::determineDeal($cart);
		
		$total = 0.00;
		foreach($cart as $item){
			$total += $item[2];
			echo "Item Name: ". $item[0] ." Item Price: ". $item[2] . "\n";
		}
		
		// assess delivery fee
		$deliveryFee = self::determineDeliveryFee($total);
		echo "deliveryFee: ". $deliveryFee . "\n";
		$total = number_format($total + $deliveryFee, 2);
		echo "Total: ". $total . "\n";
		
		return $total;
		$cart = self::emptyCart($cart); // empty the array
	}

}

// test cases
$cart = Product::addToCart(array('BF1', 'GF1'));
//$total = Product::evaluateCart($cart);

$cart = Product::addToCart(array ('RF1', 'RF1'));
//$total = Product::evaluateCart($cart);

$cart = Product::addToCart(array ('RF1', 'GF1'));
//$total = Product::evaluateCart($cart);

$cart = Product::addToCart(array ('BF1', 'BF1', 'RF1', 'RF1', 'RF1' ));
//$total = Product::evaluateCart($cart);
