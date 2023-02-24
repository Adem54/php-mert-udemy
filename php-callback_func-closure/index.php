<?php 
//usage of use  keyword in callback(anonym functions inside)

function remove_lowest_half($arr) {
	$half = array_sum($arr) / count($arr); // Calculate the average value.
 
	return array_filter($arr, function($v) use ($half) {
	  return ($v > $half);
	});
 }
 
 // 8 elements which sum up to 40.
 // So half will be 5.
 $input = array(1,2,3,4,6,7,8,9);
 
 var_dump(remove_lowest_half($input));



//PHP DE CLOSURE MANTIGI... 

function counter($start) {
	$value = $start;
 
	return function() use (&$value) {
	  return $value++;
	};
 }
 
 $counter = counter(6);
 //$counter counter fonksiyonu icerisinde return edilen fonksiyona esittir
 /*
 return function() use (&$value) {
	  return $value++;
	};
Bu fonksiyonu iki kez art arda calisiyor ve $value degeri ilk once 6 oluyor sonra bu 6 degerini ayni fonksiyon 2 .kez calisirken ona devrediyor cunku referanst tipli seklinde davraniyor artik yani mutable davraniyor artik, referans tipli yani.. 	
 */
 echo $counter() . "\n";//6
 echo $counter() . "\n";//7



 echo "********************************";


 $global_var = 5;

$arrow_func = fn( $param ) => $param + $global_var;

echo $arrow_func( 5 ); // displays 10 since 5 + 5 = 10

$global_var = 10;

echo $arrow_func( 5 ); // still displays 10
?>


<?php 
	
	//GLOBAL KEYWORD VE USE KEYWORD UNUN KULLANIM FARKLILIKLARI

//Anonymous Functions Can Inherit Variables From the Parent Scope
//In one of our previous articles called Understanding Variable Scope in PHP, we covered variable scope in detail. Basically, PHP has a global scope and a function-level scope. You cannot access variables defined somewhere else inside your functions. Similarly, variables defined inside a function won't be accessible outside it.
//One way to access outside variables inside a function is to use the global keyword. However, this approach has some disadvantages as it can make code maintenance harder in the long term.
//PHP also has a special use keyword that allows you to access variables from the parent scope inside an anonymous function. Let's understand the difference between global and use with some examples

//AYNI ISLEMI HEM GLOBAL KEYWORDU ILE HEM DE ANONYM FONKS ILE USE KEYWORDU ILE KULLANALIM... 
//USE-KEYWRODU ANONIM FONKSIYON DA PARAMETRE DE DISARDAN ALINACAK BIR DEGERIN KULLANILABILEMESI ICIN KULLANILIR



	// Global Scope 
	$pad = '@';
	$full_length = 20;
	function parent_function() {
		// Parent Scope 
		$pad = '#';
		$full_length = 16;
		function padding($word) {
			global $pad;
			global $full_length;
			echo str_pad($word, $full_length, $pad, STR_PAD_BOTH);
			$full_length = 40;
		};
		padding('banana');
	}
	parent_function();
	// @@@@@@@banana@@@@@@@ 
	echo $full_length;
	// 40

/*
In the above example, we have defined the variables $pad and $full_length twice. They are part of the global scope when defined at the top. We define those two variables again inside the function parent_function(). However, they are not related to variables defined in the global scope because functions have their own scope in PHP.

When we use these variables inside our padding() function with the help of the global keyword, we are actually accessing the global values. This is apparent from the output of parent_function(). We were also able to change the value of global $full_length inside our function.
*/

//We can rewrite the above code to use anonymous functions and the use keyword. It will look like the snippet below:

	// Global Scope 
	$pad2 = '@';
	$full_length2 = 20;
	function parent_function2() {
		// Parent Scope 
		$pad2 = '#';
		$full_length2 = 16;
		$padding = function($word) use ($pad2, $full_length2) {
			echo str_pad($word, $full_length2, $pad2, STR_PAD_BOTH);
			$full_length2 = 40;
		};
		$padding('banana');
		echo $full_length2;
		// 16 
	}
	parent_function2();
	// #####banana##### 
	echo $full_length2;
	// 20

	//This time, we made our padding function anonymous and accessed $pad and $full_length with the help of the use keyword. The value of these variables was taken from the parent scope. Removing the variables from the parent scope will give you errors about undefined variables.
	//Also note that the anonymous function is actually working with the copies of variables in the parent scope. That's why the value of $full_length did not change outside the anonymous function.
	//ISTE BURASI COK KRITIK EGER SADECE USE KEYWORDU KULLANARAK DISARDAN BIR DEGISKENI ANONIM FONKSYON PARAMETRESINE ALIR ISEK O ZAMAN, DISARDAKI SCOPE DAN ALINAN DEGISKENIN KOPYASI ANONIM FONKSIYON PARAMETRESINE ALINACAKTIR USE KEYWORDU SAYESINDE KI, BU DA SU DEMEK ARTIK BIZ ANONIM FONKSIYON ICINDE USE KEYWORDU ILE ALDIGMIZ DEGISKENIMIZI ISTEDGIMZ GIBI DEGISTIREBILIRIZ BUNUN DISARDAN ALDIGMIZ PARENT SCOPE DAN ALDIGMIZ DEGER ILE ARTIK BIR ILISKISI KALMAMISTIR(BU MANTIK GLOBAL KEYWORDU ILE BU SEKILDE CALISMIYOR...BUNU BILELIM GLOBAL KEYWORDUNDE BIZ ASLINDA DISARDAKI DEGISKENIN AYNISINI ICERIA ALIYORUZ DOLAYSI ILE ICERDEKI DEGISIKLIK DISARYI ETKILEYECEKTIR) BIZIM ANONIM FONKSIYHON ICINDE YAPACAGIMIZ DEGISIKLIKLER PARENT SCOPE DA BULUNA BU DEGISKENI ETKILEMEYECEKTIR....BURASI COOK ONEMLILLL

?>

<?php
$numbers = [12, 18, 5, 11, 10, 95, 3];
$factors = [2, 3, 5];
foreach($factors as $factor) {
    $multiples = array_filter($numbers, function($n) use ($factor) {
        return $n%$factor == 0;
    });
    echo "Multiples of $factor\n";
    print_r($multiples);
}
/* 

Multiples of 2 
Array 
( 
[0] => 12 
[1] => 18 
[4] => 10 
) 
Multiples of 3 
Array 
( 
[0] => 12 
[1] => 18 
[6] => 3 
) 
Multiples of 5 
Array 
( 
[2] => 5 
[4] => 10 
[5] => 95 
) 

*/
?>


<?php

//Arrow Functions in PHP
/*Arrow functions are basically a shorter way of writing simple anonymous functions. They were introduced in PHP 7.4. The keyword function is replaced with fn and the return keyword is completely omitted when defining arrow functions. They only contain one expression and that expression is the return value of the arrow function.

One more feature of arrow functions is that variables defined in the parent scope are implicitly available to them without adding the use keyword. */

$numbers = [12, 18, 5, 11, 10, 95, 3];
$factors = [2, 3, 5];
foreach($factors as $factor) {
    $multiples = array_filter($numbers, fn($n) => $n%$factor == 0);
    echo "Multiples of $factor\n";
    print_r($multiples);
}
/* 

Multiples of 2 
Array 
( 
[0] => 12 
[1] => 18 
[4] => 10 
) 
Multiples of 3 
Array 
( 
[0] => 12 
[1] => 18 
[6] => 3 
) 
Multiples of 5 
Array 
( 
[2] => 5 
[4] => 10 
[5] => 95 
) 

*/
?>

<?php 

//PHP Call By Reference
//In case of PHP call by reference, actual value is modified if it is modified inside the function. In such case, you need to use & (ampersand) symbol with formal arguments. The & represents reference of the variable.

//BURDA COK ACIK ANLATILMIS...
//https://www.webcebir.com/265-php-anonim-fonksiyonlarda-closure-kapaklar-dersi.html
?>