<?php 

/**
 * Description : use to get random unique string 
 * 
 * @param int $length of string random
 * @return string of randomized string
 */
function randomString(int $length):string
{
  return substr(md5(time()), 0, $length);
}


/**
 * Description : use to increase digit number
 * ex : 001 to 002
 * 
 * @param string $number for increase the digit
 * @return string of increased digit
 */
function getIncreasedDigitNumber(string $number ): string
{
  $exploded = explode('-', $number);
  $lastNumber = end($exploded);
  $number = str_pad(intval($lastNumber) + 1, strlen($lastNumber), '0', STR_PAD_LEFT);

  return $number;
}


/**
 * Description : use to format to rupiah
 * 
 * @param float $number value for format
 * @return string 
 */
function formatToRupiah(float $number):string
{
  return "Rp " . number_format($number, 2, ",", ".");
}
?>