<?php

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
		('Red Flower', 'RF1', 32.95),
		('Green Flower', 'GF1', 22.95),
		('Blue Flower', 'BF1', 72.95)
	];
		
	// functions
	
	public function emptyCart(){
		$this->cart = array();
	}

	private function determineDeliveryFee($orderTotal){
		case $orderTotal < 50:
			$fee = 4.95;
			break;
		case $orderTotal < 90:
			$fee = 2.95;
			break;
		default:
			$fee = 0.00;
	}

	private function determineDeal(){
		$redFlower = self::flowers[1];
		var count = 0;
		$cartCount = count($this->cart);
		for($i = 0; $i < $cartCount; $i++){
			//if there are 2 red flowers in the array, one of them is half price
			if($array[$i] == $redFlower){
				//for every second flower, half the price
				if($i % 2 == 0){
					$this->cart[$i]->price = number_format($this->cart[$i]->price / 2, 2, '.', '') ;
				}
			}
		}
		return $cart;
	}

}


public function addToCart($code){
	$flowers = Product::FLOWERS;
	foreach($flowers as $flower){
		if($code == $flower[2]){
			$cart[] = $flower; 
		}
	}
}

public function evaluateCart(){
	// evaluate for deals
	$this->cart = self::determineDeal($this->cart);
	// assess delivery fee
	$this->deliveryFee = self::determineDeliveryFee;

	$total = 0.00;
	foreach($this->cart as $item){
		$total += $item[2];
	}
	return $total;
}
