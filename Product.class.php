<?php

class Product
{
	public int $price,
	public string $name,
	public string $code,

	protected int $deliveryFee;


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
	
}