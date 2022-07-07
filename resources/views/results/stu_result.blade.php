@extends('layouts.student_layout')
@section('css')
<style type="text/css">
.loading{
position:fixed;
top:0;
left:0;
width:100%;
height:100%;
display:flex;
justify-content:center;
align-items:center;
background:rgba(0,0,0,.7);

}
/*body{
filter: blur(8px);
  -webkit-filter: blur(8px);
}*/
</style>
@endsection
@section('meta')
<title>Anshu Memorial Academy 2021-22 Result</title>
@endsection

@php
$classes = array(
	'Play','LKG','UKG','Nursery','Std.1','Std.2','Std.3','Std.4','Std.5'
);
@endphp
@section('content')
	
	<!-- instruction -->
	<div class="container mt-4" >
		<div class="card" >
			<div class="card-header" >
			Instruction / निर्देश
			</div>
			<div class="card-body" >
				<ul class="nav" >
					<li class="nav-item" ><a href="javascript:void(0)" class="nav-link"  id="engBtn" >Read in english.</a></li>
					<li class="nav-item" ><a href="javascript:void(0)" class="nav-link"  id="hinBtn" >हिंदी में पढ़ें।</a></li>
				</ul>
				<ol id="eng" >
					<li>First of all select the class from the "Select Class"  dropdown-menu at the bottom.</li>
					<li>After selecting the "Class" you will see the another dropdown menu of "Select Roll No.".</li>
					<li>Now select "Roll No."</li>
					<li>After selecting the "Roll No." a new window will be open with result page.</li>
					<li>After opening the result page you can print page or, Save as PDF.</li>
					<li>If you have any problem in viewing the result then <a href="https://wa.me/919973757920" >click here</a> to whatsapp.
				</ol>
				<ol id="hin" >
					<li>सबसे पहले नीचे दिए गए "Select Class" ड्रॉपडाउन मेन्यू से क्लास को सेलेक्ट करें।।</li>
					<li>"Class" का चयन करने के बाद आपको "Select Roll No." का एक और ड्रॉपडाउन मेनू दिखाई देगा।</li>
					<li>अब "Roll No." चुनें।</li>
					<li>"Roll No." का चयन करने के बाद रिजल्ट पेज के साथ एक नई विंडो खुलेगी।</li>
					<li>रिजल्ट पेज खोलने के बाद आप पेज प्रिंट कर सकते हैं या पीडीएफ के रूप में सेव कर सकते हैं।</li>
					<li>अगर आपको रिजल्ट देखने में कोई परेशानी हो तो व्हाट्सएप करने के लिए <a href="https://wa.me/919973757920">यहाँ क्लिक करें</a>।</li>
				</ol>
			</div>
		</div>
	</div>
	
	<div class="res p-4 row" >
		<div class="col-md-6 mx-auto" >
			<div class="row gy-2" >
				<div class="col-6" >
					<select id="class" class="form-select" >
					<option value="" >Select Class</option>
					@foreach($classes as $c)
						<option value="{{$c}}" >{{$c}}</option>
					@endforeach
					</select>
				</div>
				<div class="col-6"  id="select-roll-wrap" ></div>
			</div>
		</div>
	</div>
	<!-- on page marksheet -->
	<div id="ms" ></div>
	<!-- loading -->
	<div class="loading" >
		<div class="pb-2 pt-3 px-3 rounded shadow bg-light" >
			<div class="spinner-border" role="status">
			<span class="visually-hidden">Loading...</span>
			</div>
		</div>
	</div>
@endsection
@section('btm-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
"use strict";

$(function(){
$('.loading').hide();

    const CLS = $('#class');
	CLS.on('change',function(){
		$('#ms').html('');
		$('#select-roll').html('');
		$.ajax({
			url:'{{route("student.roll")}}',
			type:'post',
			data:{
				_token:'{{csrf_token()}}',
				stu_class:CLS.val()
			},
			success:function(data){
				$('#select-roll-wrap').html(data);
				roll();
			},
			error:function(err){
				console.log(JSON.stringify(err));
				alert('err: '+JSON.stringify(err));
				$('#loading').removeClass('d-block').addClass('d-none');
			$('#loading').removeClass('d-block').addClass('d-none');
			},
		});
	});
	function roll(){
	
	$("#select-roll").on('change',function(){
		let resultId = this.value;
		let w=window.open('{{url("student/")}}/'+resultId+'?_token={{csrf_token()}}','','fulscreen=yes,width=735,heigjt=1040');
		w.document.close();
		w.focus();
		//w.print();
		
		//on page result
		/*$.ajax({
			url:'{{route("student.marksheet")}}',
			type:'post',
			data:{
				_token:'{{csrf_token()}}',
				id:resultId,
			},
			dataType:'html',
			success:function(data){
				$('#ms').html(data);
			//window.focus();
			//window.print();
			},
			error:function(err){
				console.log(JSON.stringify(err));
				alert('err: '+JSON.stringify(err));
			$('#loading').removeClass('d-block').addClass('d-none');
			},
		});*/
	});
	}
	$(document).ajaxStart(function(){
		$('.loading').show();//removeClass('d-none').addClass('d-block');
	});
	$(document).ajaxStop(function(){ 
		$('.loading').hide();//removeClass('d-block').addClass('d-none');
	});  
	
	eng();
	$('#hinBtn').on('click', hindi);
	function hindi(){
		$('#hinBtn').hide();
		$('#engBtn').show();
		$('#hin').show();
		$('#eng').hide();
	};
$('#engBtn').on('click', eng);
function eng(){
	$('#engBtn').hide();
	$('#hinBtn').show();
	$('#eng').show();
	$('#hin').hide();
};

});
</script>
@endsection