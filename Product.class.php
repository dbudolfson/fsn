<?php

class Product
{
	public array $cart;
	
	// values only used within class methods
	protected float $deliveryFee;
	protected float $total;

	const FLOWERS = [
		['Red Flower', 'RF1', 32.95],
		['Green Flower', 'GF1', 24.95],
		['Blue Flower', 'BF1', 7.95]
	];
		
	public function __construct(){
		
	}


	function addToCart($codes){
		if(!is_array($codes)){
			$codes = array($codes);
		}
		$cart = array();
		$flowers = Product::FLOWERS;
		foreach($codes as $code){
			foreach($flowers as $flower){
				if($code == $flower[1]){
					$this->cart[] = array(
						"name" => $flower[0],
						"code" => $code,
						'price' => $flower[2]
					); //$flower; 
				}
			}
		}
		$this->evaluateCart();
		return $cart;
	}

	function evaluateCart(){
		// evaluate for deals
		$this->cart = self::determineRedFlowerDeal();
		$this->total = 0.00;
		foreach($this->cart as $item){
			$this->total += $item['price'];
			echo "Item Name: ". $item['name'] ." Item Price: $". $item['price'] . "\n";
		}
		
		// assess delivery fee
		$this->deliveryFee = self::determineDeliveryFee();
		echo "deliveryFee: $". $this->deliveryFee . "\n";
		$this->total = number_format($this->total + $this->deliveryFee, 2);
		echo "Total: $". number_format($this->total,2) . "\n";
		
		return $this;
	}

	private function determineDeliveryFee(){
		$total = $this->total;
		switch($total){
			case $total < 50:
				$this->deliveryFee = 4.95;
			break;
			case $total < 90:
				$this->deliveryFee = 2.95;
				break;
			default:
				$this->deliveryFee = 0.00;
		}
		return $this->deliveryFee;		
	}

	private function determineRedFlowerDeal(){
		$redFlower = self::FLOWERS[0][0];
		$count = 0;
		$cartCount = count($this->cart);
		for($i = 1; $i < $cartCount; $i++){
			//if there are 2 red flowers in the array, one of them is half price
			if($this->cart[$i]['name'] == $redFlower){
				//for every second flower, half the price
				if(($i +1) % 2 == 0){
					$this->cart[$i]['price'] = (floor((((float)$this->cart[$i]['price']) / 2)*100)/100 );
				}
			}
		}
		return $this->cart;
	}


}

// cases
/*$x = new Product();
$x->addToCart('RF1');*/

$x = new Product();
$x->addToCart(array('BF1', 'GF1'));

$x = new Product();
$x->addToCart(array('RF1', 'RF1'));

$x = new Product();
$x->addToCart(array('RF1', 'GF1'));

$x = new Product();
$x->addToCart(['BF1', 'BF1','RF1','RF1', 'RF1']);
