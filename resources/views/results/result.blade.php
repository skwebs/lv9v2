<?php
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
  ?>
  
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
   <title>AMA Student Marksheet</title>
   <style>
   @media screen,
   print {
      * {
         -webkit-print-color-adjust: exact !important;
         /*Chrome, Safari */
         color-adjust: exact !important;
         /*Firefox*/
      }
   }

   * {
      margin-bottom: 0;
      padding: 0;
      box-sizing: border-box;
   }

   .marksheet {
      display: table;
      /* width: 743px;
        height: 510px; */
      width: 720px;
      height: 500px;

      /* margin-bottom: 10px; */
      background: linear-gradient(rgba(250, 250, 250, 0.85),
            rgba(255, 255, 255, 0.85)),
         url("https://v1.anshumemorial.in/assets/static/img/ama/ama-128x128.png") center/60px 60px round;
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
   }

   .marksheet>table {
      width: 720px;
      /* height: 1000px; */
      border: thin solid;
   }

   .page-break {
      page-break-after: always;
      margin: 0px 0px 0px 0px;
      padding: 0px 0px 0px 0px;
      /* border-bottom: thin solid; */
   }

   .draw-line {
      width: 100%;
      border-bottom: thin solid;
      margin-top: 5px;
      margin-bottom: 5px;
   }

   td table th {
      padding-left: 25px;
      padding-right: 25px;
   }

   td table td {
      padding-left: 5px;
      padding-right: 5px;
   }

   .nowrap {
      white-space: nowrap;
   }

   .marks td {
      text-align: center;
   }

   /* .marks td,
      .marks th {
        border: thin solid; 
        padding-top: 2.5px;
        padding-bottom: 2.5px;
      } */
   table a {
      text-decoration: none;
   }

   .text-purple {
      color: var(--bs-purple);
   }

   .text-indigo {
      color: var(--bs-indigo);
   }
   </style>
</head>

<body>

  
   <!-- marksheet main div -->
   <table class="pt-3">
      <tr>
         <td>&nbsp;</td>
      </tr>
   </table>
   <div class="marksheet mx-auto mt-2">
      <!-- marksheet table form -->
      <table>
         <tbody>
            <!-- header part -->
            <tr>
               <td>
                  <!-- estd. and registration number section -->
                  <div class="d-flex justify-content-between pt-2">
                     <p class="ps-4 mb-0"><strong>Estd. : 2017</strong></p>
                     <p class="pe-4 mb-0"><strong>Reg. No. 281184/18</strong></p>
                  </div>
                  <!-- school details table -->
                  <table class="mx-auto" style="width: 100%">
                     <tr>
                        <!-- school logo part left side -->
                        <td class="pt-2" style="width: 15%">
                           <img class="float-end" width="75px" height="75px"
                              src="https://v1.anshumemorial.in/assets/static/img/ama/ama-128x128.png" alt=""
                              srcset="" />
                        </td>
                        <!-- school name, address and other details -->
                        <td style="width: 70%">
                           <table style="width: 100%">
                              <!-- school name -->
                              <tr>
                                 <td>
                                    <h1 class="text-center">Anshu Memorial Academy</h1>
                                 </td>
                              </tr>
                              <!-- school address -->
                              <tr>
                                 <td>
                                    <p class="h6 text-center">
                                       <a class="text-dark" href="https://maps.app.goo.gl/25zkJr8u8qVxau1G9"
                                          target="_blank">Bhatha Chowk, Bhatha Dasi, Rajapakar, Vaishali</a>
                                    </p>
                                 </td>
                              </tr>
                              <!-- school other details -->
                              <tr>
                                 <td>
                                    <p class="h6 text-center">Run & Managed by AnitaBindeshwar Foundation</p>
                                 </td>
                              </tr>
                           </table>
                        </td>
                        <!--// school name, address and other details -->
                        <!-- beti bachao beti padhao right side logo -->
                        <td style="width: 15%">
                           <img class="float-start" width="75px" height="75px"
                              src="https://v1.anshumemorial.in/assets/static/img/bbbp512.png" alt="" srcset="" />
                        </td>
                     </tr>
                  </table>
               </td>
            </tr>
            <!-- // header part -->
            <!-- draw-line -->
            <tr>
               <td>
                  <div class="draw-line"></div>
               </td>
            </tr>
            <!-- report card details -->
            <tr>
               <td>
                  <table class="mx-auto" style="width: 100%">
                     <tr>
                        <td>
                           <h6 class="text-center">
                              REPORT CARD [ANNUAL EXAMINATION]
                           </h6>
                        </td>
                     </tr>
                     <tr>
                        <td>
                           <h6 class="text-center">ACADEMIC SESSION : 2021-22</h6>
                        </td>
                     </tr>
                  </table>
               </td>
            </tr>

            <tr>
               <td>
                  <table class="table mx-auto border-0" style="width: 100%">
                     <!-- student details row -->
                     <tr>
                        <!-- student personal details -->
                        <td class="" style="width: 75%">
                           <table class="table" style="width: 100%">
                              <tr>
                                 <th>Name</th>
                                 <td><strong>:</strong></td>
                                 <td>{{ $stu->name }}</td>
                              </tr>
                              <tr>
                                 <th>Father's Name</th>
                                 <td><strong>:</strong></td>
	                              <td>{{ $stu->father }}</td>
                              </tr>
                              <tr>
                                 <th>Mother's Name</th>
                                 <td><strong>:</strong></td>
	                              <td>{{ $stu->mother }}</td>
                              </tr>

                              <tr>
                                 <th>Date of Birth</th>
                                 <td><strong>:</strong></td>
                                 <td>{{ date("d-m-Y",strtotime($stu->dob)) }}</td>

                              </tr>

                              <tr>
                                 <th>Address</th>
                                 <td><strong>:</strong></td>
	                              <td>{{ $stu->address }}</td>
                              </tr>
                           </table>
                        </td>
                        <!-- // student details row -->
                        <td></td>
                        <!-- student school details -->
                        <td style="width: 20%">
                           <table style="width: 100%" class="table">
                              <tr>
                                 <th>Class</th>
                                 <td><strong>:</strong></td>
	                              <td>{{ $stu->class }}</td>
                              </tr>
                              <tr>
                                 <th>Roll</th>
                                 <td><strong>:</strong></td>
	                              <td>{{ $stu->roll }}</td>
                              </tr>
                              <tr class="bg-{{res(($result->total*100)/$result->full_marks)['c']}}">
                                 <th>Grade</th>
                                 <td><strong>:</strong></td>
                                 <td class="fw-bold">{{res(($result->total*100)/$result->full_marks)["g"]}}</td>
                              </tr>
                           </table>
                        </td>
                        <!-- // student school details -->
                        <td></td>
                     </tr>
                  </table>
               </td>
            </tr>

            <!-- student subject marks and grade -->

            <tr>
               <td>
                  <table class="table table-striped mx-auto marks" style="width: 80%">
                     <!-- marks table heder part -->
                     <thead>
                        <tr>
                           <th scope="col" class="">Subject</th>
                           <th scope="col" class=" text-center">Full Marks</th>
                           <th scope="col" class=" text-center">Obtained Marks</th>
                           <th scope="col" class=" text-center">Marks %</th>
                           <th scope="col" class=" text-center">Grade</th>
                        </tr>
                     </thead>

                     <tr>
                        <th scope="row">English</th>
                        <td>100</td>
                        <td>{{ $result->english }}</td>
                        <td>{{ res($result->english)["g"] }}</td>
                     </tr>
                     <tr>
                        <th scope="row">Hindi</th>
                        <td>100</td>
                     <td>{{ $result->hindi }}</td>
                     <td>{{ res($result->hindi)["g"] }}</td>
                     </tr>
                     <tr>
                        <th scope="row">Math</th>
                        <td>100</td>
                     <td>{{ $result->math }}</td>
                     <td>{{ res($result->math)["g"] }}</td>
                     </tr>
                     <tr>
                        <th scope="row">Drawing</th>
                        <td>100</td>
                     <td>{{ $result->drawing }}</td>
                     <td>{{ res($result->drawing)["g"] }}</td>
                     </tr>
                     <tr>
                        <th scope="row">Total</th>
                        <th class="text-center">{{ $result->full_marks }}</th>
                        <th class="text-center">{{ $result->total }}</th>
                        <th class="text-center">{{ res($result->total/4)["g"] }}</th>
                     </tr>

                  </table>
                  <p class="px-5"><strong>Marks in word : </strong>{{ ucwords(numToText($result->total)) }}</p>
                  <div class="d-flex justify-content-center">
                     <p style="font-size: 11px;" class="bg-light border-bottom d-inline-block border-secondary">
                        <strong>Grading Scale :</strong> A+(91%-100%), A(81%-90%), B+(71%-80%), B(61%-70%), C+(51%-60%),
                        C(41%-50%), D(31%-40%), E(30% & Below)</p>
                  </div>
               </td>
            </tr>
            <!-- draw-line -->
            <!-- <tr>
            <td>
              <div class="draw-line"></div>
            </td>
          </tr> -->
            <!-- draw-line -->
            <tr>
               <td>
                  <div class="draw-line"></div>
               </td>
            </tr>
            <!-- // student subject marks and grade -->
            <tr>
               <td>
                  <table class="mx-auto" style="width: 100%">
                     <tr>
                        <td class="px-5"><strong>Remarks :</strong> {{ res($result->total/4)["r"] }}</td>
                     </tr>
                  </table>
               </td>
            </tr>
            <!-- draw-line -->
            <tr>
               <td>
                  <div class="draw-line"></div>
               </td>
            </tr>

            <!-- Date, signature of class teacher and principal -->
            <tr>
               <td style="width: 100%">
                  <table class="text-center h6 mt-2 pt-5" style="width: 100%">
                     <tr>
                        <td style="width: 33.3%">
                           <table class="mx-auto mt-4">
                              <tr>
                                 <td>{{ date("d-m-Y") }}</td>
                              </tr>
                              <tr>
                                 <th>Date</th>
                              </tr>
                           </table>
                        </td>
                        <td style="width: 33.3%">
                           <table class="mx-auto">
                              <tr>
                                 <td>&nbsp;</td>
                              </tr>
                              <tr>
                                 <th>Class Teacher</th>
                              </tr>
                           </table>
                        </td>
                        <td style="width: 33.3%">
                           <table class="mx-auto">
                              <tr>
                                 <td>&nbsp;</td>
                              </tr>
                              <tr>
                                 <th>Principal</th>
                              </tr>
                           </table>
                        </td>
                     </tr>
                  </table>
               </td>
            </tr>
            <!-- draw-line -->

            <tr>
               <td class="pt-3">
                  <table>
                     <tr>
                        <td class="bg-success text-light vw-100">
                           <div class="d-flex justify-content-around">
                              <a class="text-light" href="tel:9128289100">9128289100</a>
                              <a class="text-light" href="tel:9709582920">9709582920</a>

                              <a class="text-light" href="mailto:anshumemorial@gmail.com">anshumemorial@gmail.com</a>

                              <a class="text-light" href="http://anshumemorial.in"
                                 target="_blank">www.anshumemorial.in</a>
                           </div>
                        </td>
                     </tr>
                  </table>
               </td>
            </tr>
         </tbody>
      </table>
   </div>
   <p class="text-center text-muted">
      Designed & Developed by
      <a href="http://twitter.com/AnshuMemorial" target="_blank">Anshu Memorial Academy</a>
      (IT Team).
   </p>

   <div class="page-break"></div>


<script>
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  });
      </script>
</body>

</html>