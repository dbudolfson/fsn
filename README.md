# fsn
fsn assessment

How it was made:
1) Made with PHP

Assumptions:
1) no validation was asked for. Assigned types for the variables.


How it works:
Functions:
1) emptyCart - empties cart array.
2) addToCart - adds an array to a multidimensional array based on item code.
3) evaluate cart - iterates thru array and totals price after assessing the cart for deals and then assessing delivery fee
  1) determineDeal - protected - determines price of even numbered red flower purchases. Every even flower is half price.
  2) determineDelivery fee - protected - determines delivery fee based on cart total after deals assessed
  
