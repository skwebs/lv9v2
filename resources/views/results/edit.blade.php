@extends('layouts.student_layout')
@section('css')
<style type="text/css">
	.mandate{
		transform:scale(1.5) translate(2px,0);
		display:inline-block;
	}
</style>
@endsection

@section('js')
	@if(!in_array($stu->class, $classes))
		<script type="text/javascript">
			"use strict";
			function totalMarks() {
		      let eng = parseInt(document.querySelector("#english").value) || 0;
		      let hin = parseInt(document.querySelector("#hindi").value) || 0;
		      let maths = parseInt(document.querySelector("#maths").value) || 0;
		      let sc = parseInt(document.querySelector("#science").value) || 0;
		      let sst = parseInt(document.querySelector("#sst").value) || 0;
		      let comp = parseInt(document.querySelector("#computer").value) || 0;
		      let science_oral = parseInt(document.querySelector("#science_oral").value) || 0;
		      let sst_oral = parseInt(document.querySelector("#sst_oral").value) || 0;
		      
		      document.querySelector("#total").value = eng + hin + maths + sc + sst + comp + science_oral + sst_oral;
		      document.querySelector("#full_marks").value = 600;
		      
		   }
		</script>
	@else
		<script type="text/javascript">
			function totalMarks() {
		      let eng = parseInt(document.querySelector("#english").value) || 0;
		      let hin = parseInt(document.querySelector("#hindi").value) || 0;
		      let maths = parseInt(document.querySelector("#maths").value) || 0;
		      
		      document.querySelector("#total").value = eng + hin + maths;
		      document.querySelector("#full_marks").value = 300;
		   }
		</script>
		
	@endif
@endsection

@php
	$mandate = '<span class="text-danger mandate" >*</span>';
@endphp

@section('content')
<p class="p-2 h2 bg-primary text-light" >Update Result</p>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                
	                <div class="d-flex justify-content-between" >
		                <span><strong>{{$stu->name}}</strong> class <strong>{{ $stu->class}}</strong> roll no. <strong>{{ $stu->roll }}</strong></span>
		                <a class="btn btn-primary"  href="{{ route('admitCard.index')}}" >
			                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
			                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
			                <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
			                </svg>
			                <span class="d-none d-md-inline" > &nbsp; Student List</span>
		                </a>
	                </div>
                </div>

                <div class="card-body">
                
                    @if ($message = Session::get('success'))
	                    <div class="alert alert-success alert-dismissible fade show" role="alert">
		                    <strong>{{ $message }}</strong>
		                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	                    </div>
                    @endif
                    
                    @if ($message = session('warning'))
	                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
	                    <div class="text-center h3" ><strong>Alert!</strong></div>
		                    {{ $message }}
		                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	                    </div>
                    @endif
                    
                     <!-- 
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    --> 
                    
                    <form class="row"  method="POST" action="{{ route('result.update', ['result'=>$result->id,'class'=>$stu->class,'roll'=>$stu->roll, 'session'=>'2021-22','redirect_to'=>url()->previous()]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="admit_card_id" value="{{ $stu->id }}"  >
                        
                        						<!-- maths -->
                        						<div class="mb-3 col-4 col-md-3">
                        						    <label for="maths"
                        						        class="form-label">{{ __('Maths') }} {!! $mandate !!}</label>
                        						
                        						        <input id="maths" type="number" class="form-control @error('maths') is-invalid @enderror"
                        						            onkeyup="totalMarks()" placeholder="Maths" min="0" max="100"  
                        						            name="maths" value="{{ old('maths',$result->marks->maths) }}" required autofocus>
                        						
                        						        @error('maths')
                        						        <span class="invalid-feedback" role="alert">
                        						            <strong>{{ $message }}</strong>
                        						        </span>
                        						        @enderror
                        						</div>
                        						<!-- //name -->
                        <!-- hindi -->
                        <div class="mb-3 col-4 col-md-3">
                            <label for="hindi"
                                class="form-label">{{ __('Hindi') }}{!! $mandate !!}</label>

                                <input id="hindi" type="number"
                                    class="form-control @error('hindi') is-invalid @enderror" name="hindi"
                                    onkeyup="totalMarks()" placeholder="Hindi" min="0" max="100"  
                                    value="{{ old('hindi',$result->marks->hindi) }}" autofocus required>

                                @error('hindi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                        <!-- //hindi -->

                        <!-- english -->
                        <div class="mb-3 col-4 col-md-3">
                            <label for="english"
                                class="form-label">{{ __('English') }}{!! $mandate !!}</label>

                                <input id="english" type="number"
                                    class="form-control @error('english') is-invalid @enderror" name="english"
                                    onkeyup="totalMarks()" placeholder="English" min="0" max="100"  
                                    value="{{ old('english',$result->marks->english) }}" required autofocus>

                                @error('english')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                        <!-- //english -->
                       
                       @if(!in_array($stu->class, $classes))
                        
                        <!-- sst -->
                        <div class="mb-3 col-4 col-md-3">
                            <label for="science"
                                class="form-label">{{ __('Science') }}{!! $mandate !!}</label>
                        
                                <input id="science" type="number" class="form-control @error('science') is-invalid @enderror"
                                    onkeyup="totalMarks()" placeholder="Science" min="0" max="80"  
                                    value="{{ old('science',$result->marks->science) }}" name="science" required>
                        
                                @error('science')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                        <!-- //science -->
                        
                        <!-- science --
                        <div class="mb-3 col-4 col-md-3">
                            <label for="science"
                                class="form-label">{{ __('Science') }} {!! $mandate !!}</label>

                                <input id="science" type="number"
                                    class="form-control @error('science') is-invalid @enderror" name="science"
                                    onkeyup="totalMarks()" placeholder="Science" min="0" max="80"  
                                    value="{{ old('science') }}" pattern="^[0-9]{12}$" autocomplete="science"
                                    autofocus>

                                @error('science')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                        <!-- //science -->
<!-- science_oral -->
<div class="mb-3 col-4 col-md-3">
    <label for="science_oral" class="form-label">{{ __('Sc. Oral') }}{!! $mandate !!}</label>

        <input id="science_oral" type="number" class="form-control @error('science_oral') is-invalid @enderror"
            onkeyup="totalMarks()" placeholder="Sc. Oral" min="0" max="20"  
            value="{{ old('science_oral',$result->marks->science_oral) }}" name="science_oral" pattern="^[0-9]{2}$" required >

        @error('science_oral')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
</div>
<!-- //science_oral -->

                        <!-- sst -->
                        <div class="mb-3 col-4 col-md-3">
                            <label for="sst"
                                class="form-label">{{ __('S.St') }}{!! $mandate !!}</label>

                                <input id="sst" type="number" class="form-control @error('sst') is-invalid @enderror"
                                    onkeyup="totalMarks()" placeholder="S.St" min="0" max="80"  
                                    value="{{ old('sst',$result->marks->sst) }}" name="sst" required>

                                @error('sst')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                        <!-- //sst -->
<!-- sst_oral -->
<div class="mb-3 col-4 col-md-3">
    <label for="sst_oral" class="form-label">{{ __('S.St. Oral') }}{!! $mandate !!}</label>

        <input id="sst_oral" type="number" class="form-control @error('sst_oral') is-invalid @enderror"
            onkeyup="totalMarks()" placeholder="S.St. Oral" min="0" max="20"  
            value="{{ old('sst_oral',$result->marks->sst_oral) }}" name="sst_oral" pattern="^[0-9]{2}$" required >

        @error('sst_oral')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
</div>
<!-- //sst_oral -->

                        <!-- computer -->
                        <div class="mb-3 col-4 col-md-3">
                            <label for="computer" class="form-label">{{ __('Computer') }}{!! $mandate !!}</label>

                                <input id="computer" type="number"
                                    class="form-control @error('computer') is-invalid @enderror" name="computer"
                                    onkeyup="totalMarks()" placeholder="Computer" min="0" max="100"  
                                    value="{{ old('computer',$result->marks->computer) }}" required autocomplete="computer">

                                @error('computer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                        <!-- //computer -->
                        @endif
          
      
      <!-- drawing -->
      <div class="mb-3 col-4 col-md-3">
      <label for="drawing"
      class="form-label">{{ __('Drawing') }}{!! $mandate !!}</label>
      
      <input id="drawing" type="number" class="form-control @error('drawing') is-invalid @enderror"
      onkeyup="totalMarks()" placeholder="Drawing" min="0" max="100"  
      name="drawing" value="{{ old('drawing',$result->marks->drawing) }}" autocomplete="bday" required>
      
      @error('drawing')
      <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
      </span>
      @enderror
      </div>
      <!-- //drawing -->
      
						<!-- total -->
						<div class="mb-3 col-4 col-md-3">
						    <label for="total"
						        class="form-label">{{ __('Total Marks') }}</label>
						
						        <input id="total" type="number" class="form-control @error('total') is-invalid @enderror"
						            placeholder="Total Marks"
						            name="total" value="{{ old('total',$result->total) }}" required readonly>
						
						        @error('total')
						        <span class="invalid-feedback" role="alert">
						            <strong>{{ $message }}</strong>
						        </span>
						        @enderror
						</div>
						
<!-- full_marks -->
<div class="mb-3 col-4 col-md-3">
    <label for="full_marks"
        class="form-label">{{ __('Full Marks') }}</label>

        <input id="full_marks" type="number" class="form-control @error('full_marks') is-invalid @enderror"
            placeholder="Full Marks"
            name="full_marks" value="{{ old('full_marks',$result->full_marks) }}" required readonly>

        @error('full_marks')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
</div>

                     <!-- submit button -->
                        <div class="mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save Result') }}
                                </button>
                            </div>
                        </div>
                        <!-- //submit button -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection