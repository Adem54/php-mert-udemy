<?php 

//Eger biz session data sini require etmiyorsak session icindeki datayi bu  sekilde alabilriz
session_start();

print_r($_SESSION);

/*
{
my_arr: {
0: "email",
1: "password",
2: "username"
},
name: "Zehra",
show: "Data is added successfully"
},

*/

?>