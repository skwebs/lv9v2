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
<script type="text/javascript">
function _(el){
	return document.querySelector(el);
};

function totalMarks() {
      let eng = parseInt(document.querySelector("#english").value) || 0;
      let hin = parseInt(document.querySelector("#hindi").value) || 0;
      let maths = parseInt(document.querySelector("#math").value) || 0;
      let draw = parseInt(document.querySelector("#drawing").value) || 0;
      let sc = parseInt(document.querySelector("#science").value) || 0;
      let ssc = parseInt(document.querySelector("#social_science").value) || 0;
      let comp = parseInt(document.querySelector("#computer").value) || 0;
      let gk = parseInt(document.querySelector("#gk").value) || 0;
      
      document.querySelector("#total").value = eng + hin + maths + draw + sc + ssc + comp + gk;
   }
</script>
@endsection

@php
	$mandate = '<span class="text-danger mandate" >*</span>';
@endphp

@section('content')
<p class="p-2 h2 bg-primary text-light" >Upload Result</p>
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
                    
                    <form class="row"  method="POST" action="{{ route('result.update',$result->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- hindi -->
                        <div class="mb-3 col-4 col-md-3">
                            <label for="hindi"
                                class="form-label">{{ __('Hindi') }}{!! $mandate !!}</label>

                                <input id="hindi" type="number"
                                    class="form-control @error('hindi') is-invalid @enderror" name="hindi"
                                    onkeyup="totalMarks()" placeholder="Hindi" min="0" max="100"  
                                    value="{{ old('hindi', $result->hindi) }}" autofocus required>

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
                                    value="{{ old('english', $result->english) }}" required autofocus>

                                @error('english')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                        <!-- //english -->
                        
<!-- math -->
<div class="mb-3 col-4 col-md-3">
    <label for="math"
        class="form-label">{{ __('Maths') }} {!! $mandate !!}</label>

        <input id="math" type="number" class="form-control @error('math') is-invalid @enderror"
            onkeyup="totalMarks()" placeholder="Maths" min="0" max="100"  
            name="math" value="{{ old('math', $result->math) }}" required autofocus>

        @error('math')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
</div>
<!-- //name -->
                        <!-- date of birth -->
                        <div class="mb-3 col-4 col-md-3">
                            <label for="drawing"
                                class="form-label">{{ __('Drawing') }}{!! $mandate !!}</label>

                                <input id="drawing" type="number" class="form-control @error('drawing') is-invalid @enderror"
                                    onkeyup="totalMarks()" placeholder="Drawing" min="0" max="100"  
                                    name="drawing" value="{{ old('drawing', $result->drawing) }}" autocomplete="bday" required>

                                @error('drawing')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                        <!-- //date of birth -->

                        <!-- science -->
                        <div class="mb-3 col-4 col-md-3">
                            <label for="science"
                                class="form-label">{{ __('Science') }} {!! $mandate !!}</label>

                                <input id="science" type="number"
                                    class="form-control @error('science') is-invalid @enderror" name="science"
                                    onkeyup="totalMarks()" placeholder="Science" min="0" max="100"  
                                    value="{{ old('science', $result->science) }}" pattern="^[0-9]{12}$" autocomplete="science">

                                @error('science')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                        <!-- //science -->

                        <!-- social_science -->
                        <div class="mb-3 col-4 col-md-3">
                            <label for="social_science"
                                class="form-label">{{ __('Soc. Science') }}{!! $mandate !!}</label>

                                <input id="social_science" type="number" class="form-control @error('social_science') is-invalid @enderror"
                                    onkeyup="totalMarks()" placeholder="Social Science" min="0" max="100"  
                                    value="{{ old('social_science', $result->social_science) }}" name="social_science" required>

                                @error('social_science')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                        <!-- //social_science -->

                        <!-- computer -->
                        <div class="mb-3 col-4 col-md-3">
                            <label for="computer" class="form-label">{{ __('Computer') }}{!! $mandate !!}</label>

                                <input id="computer" type="number"
                                    class="form-control @error('computer') is-invalid @enderror" name="computer"
                                    onkeyup="totalMarks()" placeholder="Computer" min="0" max="100"  
                                    value="{{ old('computer', $result->computer) }}" required autocomplete="computer">

                                @error('computer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                        <!-- //computer -->

          
                        <!-- gk -->
                        <div class="mb-3 col-4 col-md-3">
                            <label for="gk" class="form-label">{{ __('G.K.') }}{!! $mandate !!}</label>

                                <input id="gk" type="number" class="form-control @error('gk') is-invalid @enderror"
                                    onkeyup="totalMarks()" placeholder="GK" min="0" max="100"  
                                    value="{{ old('gk', $result->gk) }}" name="gk" pattern="^[0-9]{2}$" required >

                                @error('gk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                        <!-- //gk no. -->
<!-- math -->
<div class="mb-3 col-4 col-md-3">
    <label for="total"
        class="form-label">{{ __('Total') }}</label>

        <input id="total" type="number" class="form-control @error('total') is-invalid @enderror"
            placeholder="Total Marks"
            name="total" value="{{ old('total', $result->total) }}" required readonly>

        @error('total')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
</div>
<!-- //name -->


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