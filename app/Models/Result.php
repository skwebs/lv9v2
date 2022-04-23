<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Result extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
	    'admit_card_id',
	    'session',
	    'class',
	    'roll',
	    /*'hindi',
	    'english',
	    'maths',
	    'drawing',
	    'science',
	    'sst',
	    'computer',
	    'gk',
	    'orals',*/
	    'marks',
	    'total',
	    'total_text',
	    'full_marks',
	    'grade',
	    'remarks',
	    'position',
	    'uploaded_by_id',
	    
    ];
    
    
	protected function totalText(): Attribute
	{
	    return Attribute::make(
	      //  get: fn ($value) => ucfirst($value),
	        set: fn ($value) => ucfirst($this->num_to_text($value)),
	    );
	}
	
	protected function marks():Attribute
	{
		return Attribute::make(
			get: fn($value)=>json_decode($value),
			set: fn($value)=>json_encode($value),
		);
	}

    public function admitCard(){
	    return $this->belongsTo(AdmitCard::class);
    }
    
	function num_to_text($num)
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

    
}