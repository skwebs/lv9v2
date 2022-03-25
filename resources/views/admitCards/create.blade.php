@extends('layouts.student_layout')
@section('css')
<style type="text/css">
.form-control:required ~ label:after,
    .form-select:required ~ label:after{
    content:"*";
    position:relative;
    color:var(--bs-danger);
    transform:scale(1.2)translateX(.2rem); 
    display:inline-block;
    font-style:normal;
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                
                <div class="d-flex justify-content-between" >
	                <span>{{ __('Add New Student\'s Details') }}</span>
		                <a class="btn btn-primary"  href="{{ route('admitCard.index')}}" >Go Back</a>
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
                    
                    <form method="POST" action="{{ route('admitCard.store') }}" enctype="multipart/form-data">
                        @csrf



                        <!-- name -->
                        <div class="row mb-3">
                            <label for="name"
                                class="col-md-4 col-form-label text-md-end">{{ __('Student\'s Name*') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!-- //name -->

                        <!-- mother -->
                        <div class="row mb-3">
                            <label for="mother"
                                class="col-md-4 col-form-label text-md-end">{{ __('Mother\'s Name') }}</label>

                            <div class="col-md-6">
                                <input id="mother" type="text"
                                    class="form-control @error('mother') is-invalid @enderror" name="mother"
                                    value="{{ old('mother') }}" autofocus>

                                @error('mother')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!-- //mother -->

                        <!-- father -->
                        <div class="row mb-3">
                            <label for="father"
                                class="col-md-4 col-form-label text-md-end">{{ __('Father\'s Name*') }}</label>

                            <div class="col-md-6">
                                <input id="father" type="text"
                                    class="form-control @error('father') is-invalid @enderror" name="father"
                                    value="{{ old('father') }}" required autofocus>

                                @error('father')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!-- //father -->

                        <!-- gender -->
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Gender*') }}</label>

                            <div class="col-md-6 mt-md-2">

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('gender') is-invalid @enderror" type="radio"
                                        @if( old('gender')=='Male') checked @endif name="gender" name="gender" id="male" value="Male" required autofocus>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('gender') is-invalid @enderror" type="radio"
                                              @if( old('gender')=='Female') checked @endif name="gender" id="female" value="Female" required autofocus>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>

                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!-- //gender -->

                        <!-- date of birth -->
                        <div class="row mb-3">
                            <label for="dob"
                                class="col-md-4 col-form-label text-md-end">{{ __('Date of Birth') }}</label>

                            <div class="col-md-6">
                                <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror"
                                    name="dob" value="{{ old('dob') }}" autocomplete="bday">

                                @error('dob')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!-- //date of birth -->

                        <!-- aadhaar -->
                        <div class="row mb-3">
                            <label for="aadhaar"
                                class="col-md-4 col-form-label text-md-end">{{ __('Aadhaar No.') }}</label>

                            <div class="col-md-6">
                                <input id="aadhaar" type="number"
                                    class="form-control @error('aadhaar') is-invalid @enderror" name="aadhaar"
                                    value="{{ old('aadhaar') }}" pattern="^[0-9]{12}$" autocomplete="aadhaar">

                                @error('aadhaar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!-- //aadhaar -->

                        <!-- mobile -->
                        <div class="row mb-3">
                            <label for="mobile"
                                class="col-md-4 col-form-label text-md-end">{{ __('Contact No.*') }}</label>

                            <div class="col-md-6">
                                <input id="mobile" type="tel" class="form-control @error('mobile') is-invalid @enderror"
                                    value="{{ old('mobile') }}" name="mobile" pattern="^[6-9][0-9]{9}$" required
                                    autocomplete="tel">

                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!-- //mobile -->

                        <!-- address -->
                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address*') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text"
                                    class="form-control @error('address') is-invalid @enderror" name="address"
                                    value="{{ old('address') }}" required autocomplete="address">

                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!-- //address -->

                        <hr>

                        <!-- class -->
                        <div class="row mb-3">
                            <label for="class" class="col-md-4 col-form-label text-md-end">{{ __('Class*') }}</label>

                            <div class="col-md-6">

                                <select class="form-select @error('class') is-invalid @enderror" name="class" required
                                    aria-label="Select Standard">
                                    <option value="">Select Class <span>*</span></option>
                                    <option @if( old('class')=='Nursery') selected @endif value="Nursery" >Nursery</option>
                                    <option @if( old('class')=='LKG') selected @endif value="LKG">LKG</option>
                                    <option @if( old('class')=='UKG') selected @endif value="UKG">UKG</option>
                                    <option @if( old('class')=='Std.1') selected @endif value="Std.1">Std. 1</option>
                                    <option @if( old('class')=='Std.2') selected @endif value="Std.2">Std. 2</option>
                                    <option @if( old('class')=='Std.3') selected @endif value="Std.3">Std. 3</option>
                                    <option @if( old('class')=='Std.4') selected @endif value="Std.4">Std. 4</option>
                                    <!-- <option value="Std.5">Std. 5</option>
                                    <option value="Std.6">Std. 6</option>
                                    <option value="Std.7">Std. 7</option>
                                    <option value="Std.8">Std. 8</option>
                                    <option value="Std.9">Std. 9</option>
                                    <option value="Std.10">Std. 10</option>
                                    <option value="Std.11">Std. 11</option>
                                    <option value="Std.12">Std. 12</option> -->
                                </select>

                                <!-- <input id="class" type="number"
                                    class="form-control @error('class') is-invalid @enderror" name="class" required
                                    autocomplete="class"> -->

                                @error('class')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!-- //class -->

                        <!-- roll no. -->
                        <div class="row mb-3">
                            <label for="roll" class="col-md-4 col-form-label text-md-end">{{ __('Roll No.*') }}</label>

                            <div class="col-md-6">
                                <input id="roll" type="number" class="form-control @error('roll') is-invalid @enderror"
                                    value="{{ old('roll') }}" name="roll" pattern="^[0-9]{2}$" required
                                    autocomplete="roll">

                                @error('roll')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!-- //roll no. -->

                        <!-- student type -->
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Student Type*') }}</label>

                            <div class="col-md-6 pt-md-2">

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('student_type') is-invalid @enderror"
                                         @if( old('student_type')=='Existing') checked @endif type="radio" name="student_type" id="existing" value="Existing" required
                                        autofocus>
                                    <label class="form-check-label" for="existing">Existing</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('student_type') is-invalid @enderror"
                                         @if( old('student_type')=='New') checked @endif type="radio" name="student_type" id="new" value="New" required autofocus>
                                    <label class="form-check-label" for="new">New</label>
                                </div>

                                @error('student_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" name="created_by"  value="{{ auth()->user()->name }}" >
                        <!-- //student type -->

                        <!-- image 
                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Image*') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror"
                                    name="image" aria-label="file example" accept="image/jpeg, image/png" required>

                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                         //image -->

                        <!-- submit button -->
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Student') }}
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