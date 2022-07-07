<?php
//$r = (array) $result;echo json_encode($r);exit;

function numToText($num)
{

    $ones = array(
        0 => "zero",
        1 => "one",
        2 => "two",
        3 => "three",
        4 => "four",
        5 => "five",
        6 => "six",
        7 => "seven",
        8 => "eight",
        9 => "nine",
        10 => "ten",
        11 => "eleven",
        12 => "twelve",
        13 => "thirteen",
        14 => "fourteen",
        15 => "fifteen",
        16 => "sixteen",
        17 => "seventeen",
        18 => "eighteen",
        19 => "nineteen",
        "014" => "fourteen"
    );
    $tens = array(
        0 => "zero",
        1 => "ten",
        2 => "twenty",
        3 => "thirty",
        4 => "forty",
        5 => "fifty",
        6 => "sixty",
        7 => "seventy",
        8 => "eighty",
        9 => "ninety"
    );
    $hundreds = array(
        "hundred",
        "thousand",
        "million",
        "billion",
        "trillion",
        "quardrillion"
    ); /*limit t quadrillion */
    if ($num == 0)
    {
        return $ones[0];
    }
    else
    {

        $num = number_format($num, 2, ".", ",");
        $num_arr = explode(".", $num);
        $wholenum = $num_arr[0];
        $decnum = $num_arr[1];
        $whole_arr = array_reverse(explode(",", $wholenum));
        krsort($whole_arr, 1);
        $rettxt = "";
        foreach ($whole_arr as $key => $i)
        {

            while (substr($i, 0, 1) == "0") $i = substr($i, 1, 5);
            if ($i < 20)
            {
                /* echo "getting:".$i; */
                $rettxt .= $ones[$i];
            }
            elseif ($i < 100)
            {
                if (substr($i, 0, 1) != "0") $rettxt .= $tens[substr($i, 0, 1) ];
                if (substr($i, 1, 1) != "0") $rettxt .= " " . $ones[substr($i, 1, 1) ];
            }
            else
            {
                if (substr($i, 0, 1) != "0") $rettxt .= $ones[substr($i, 0, 1) ] . " " . $hundreds[0];
                if (substr($i, 1, 1) != "0") $rettxt .= " " . $tens[substr($i, 1, 1) ];
                if (substr($i, 2, 1) != "0") $rettxt .= " " . $ones[substr($i, 2, 1) ];
            }
            if ($key > 0)
            {
                $rettxt .= " " . $hundreds[$key] . " ";
            }
        }
        if ($decnum > 0)
        {
            $rettxt .= " and ";
            if ($decnum < 20)
            {
                $rettxt .= $ones[$decnum];
            }
            elseif ($decnum < 100)
            {
                $rettxt .= $tens[substr($decnum, 0, 1) ];
                $rettxt .= " " . $ones[substr($decnum, 1, 1) ];
            }
        }
        return $rettxt;

    }
}
?>



<?php 

  function res($m){
		 if ($m>90) {
			return [
        "g"=> "A+",
        "r"=>"Result is excellent. Keep it up.",
        "c" => "success text-light"
      ];
		} else if ($m>80) {
			return [
        "g" => "A",
        "r" => "Result is best but need keep it up.",
        "c" => "success text-light"
      ];
		} else if ($m>70) {
			return [
        "g" => "B+",
        "r" => "Result is better Need improve & keep it up.",
        "c" => "success text-light"
      ];
		} else if ($m>60) {
			return [
        "g" => "B",
        "r" => "Result is good but not fair. Increase hard work.",
        "c" => "warning"
      ];
		} else if ($m>50) {
			return [
        "g" => "C+",
        "r" => "Result is average! Increase hard work.",
        "c" => "warning"
    ];
		} else if ($m>40) {
			return [
        "g" => "C",
        "r" => "Result is below to average. Do hard work to improve it.",
        "c" => "warning"
      ];
		} else if ($m>30) {
			return [
        "g" => "D",
        "r" => "Result is poor. Need much hard work to improve it.",
        "c" => "danger text-light"
    ];
		} else{
			return [
        "g" => "E",
        "r" => "Result is very poor. Need very much hard work to improve it.",
        "c" => "danger text-light"
      ];
		}
	}
	
	
	//var_dump($result);
	$qr;
	$qr = 
	"Name: {$stu->name}, Father's Name: {$stu->father}, Mother: {$stu->mother}, 
	Session: {$result->session}, 
	Class: {$stu->class}, Roll: {$stu->roll},
	Obtained Marks: {$result->total}/{$result->full_marks}, 
	marks:";
	$marks = (array) $result->marks;
	$qr.= json_encode($marks);
	
  ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=750, initial-scale=1.0" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <title>AMA Student Marksheet</title>
    <style type="text/css">
      @media print {
        * {
          -webkit-print-color-adjust: exact !important;
          /*Chrome, Safari */
          color-adjust: exact !important;
          /*Firefox*/
          margin: 0;
        }
      }
      *{
      margin:0;
      padding:0;
      box-sizing:border-box;
      }

      .main-table {
        border: 1px solid black;
        border-collapse: collapse;
        width: 735px;
	      background: linear-gradient(rgba(250, 250, 250, 0.85),
	      rgba(255, 255, 255, 0.85)),
	      url("https://v1.anshumemorial.in/assets/static/img/ama/ama-128x128.png") center/60px 60px round;
      }
      
      .table, .table > td, .table > th{
      margin:0 !important;
      }
      a{text-decoration:none;}
      
    </style>
  <body>
  
  <table class="table table-sm" >
	  <tr>
		  <th>Name</th><td><strong>:</strong>{{$stu->name}}</td>
	  </tr>
	  <tr>
	  		  <th>Mother'svName</th><td><strong>:</strong>{{$stu->name}}</td>
	  </tr>
	  <tr>
	  		  <th>Father's Name</th><td><strong>:</strong>{{$stu->name}}</td>
	  </tr>
	  <tr>
	  		  <th>Name</th><td><strong>:</strong>{{$stu->name}}</td>
	  </tr>
	  
  </table>
  </body>
</html>