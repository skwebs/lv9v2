@extends('layouts.student_layout')

@section('css')
<style>
    td{white-space:nowrap;}
</style>

@endsection

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="d-flex flex-column justify-content-center">
        @if ($message = session('success'))
	        <div class="alert alert-success alert-dismissible fade show" role="alert">
	        <div class="text-center h3" ><strong>Success!</strong></div>
	            {{ $message }}
	            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	        </div>
        @endif
        
            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between">
                    <a href="{{ route('admitCard.create') }}" class=" btn btn-primary">
	                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
		                    <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
		                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
	                    <span class="d-none d-md-inline" > &nbsp; Add Student</span>
	                    </svg>
                    </a>
                    
                    <h2 class="text-center" >Students List</h2>
                    
                    <a href="{{ route('admitCard.admit_cards') }}" class=" btn btn-primary">
	                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-columns-reverse" viewBox="0 0 16 16">
	                    <path fill-rule="evenodd" d="M0 .5A.5.5 0 0 1 .5 0h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 .5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10A.5.5 0 0 1 4 .5Zm-4 2A.5.5 0 0 1 .5 2h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 4h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 6h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 8h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Z"/>
	                    </svg>
                    <span class="d-none d-md-inline" > &nbsp; All Admit Cards</span>
                    </a>
                    </div>
                </div>

                <div class="card-body  overflow-auto" style="max-height:70vh">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">

                            <thead>
                                <tr>
                                    <th class="text-nowrap" scope="col">S.N.</th>
                                    <th class="text-nowrap" scope="col">Id</th>
                                    <th class="text-nowrap" scope="col">Images</th>
                                    <th class="text-nowrap" scope="col">Name</th>
                                    <th class="text-nowrap" scope="col">Class</th>
                                    <th class="text-nowrap" scope="col">Roll No.</th>
                                    <th class="text-nowrap" scope="col">Father's Name</th>
                                    <th class="text-nowrap" scope="col">Mother's Name</th>
                                    <th class="text-nowrap" scope="col">Gender</th>
                                    <th class="text-nowrap" scope="col">D.O.B</th>
                                    <th class="text-nowrap" scope="col">Mobile</th>
                                    <th class="text-nowrap" scope="col">Address</th>
                                    <th class="text-nowrap" scope="col">Added By</th>
                                    <th class="text-nowrap" scope="col">Edited By</th>
                                    <th class="text-nowrap text-center" scope="col">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($admitCards as $admitCard)
                                <tr>
                                    <th scope="row">{{$loop->index+1}}</th>
                                    <td>{{$admitCard->id}}</td>
									<td>
		                                @if($admitCard->image==null)
			                                <a href="{{route('admitCard.upload_image',$admitCard->id)}}" type="button"
			                                class="btn btn-outline-primary">
				                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16">
					                                <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z"/>
				                                </svg>
			                                </a>
		                                @else
		                                    <a href="{{route('admitCard.upload_image',$admitCard->id)}}" type="button"
		                                    class="link">
			                                    <img height="50" src="{{asset('uploads/images/students/thumbnail/'.$admitCard->image)}}"
			                                    alt="{{$admitCard->image}}">
		                                    </a>
		                                @endif
									</td>
                                    <td>{{$admitCard->name}}</td>
                                    <td>{{$admitCard->class}}</td>
                                    <td>{{$admitCard->roll}}</td>
                                    <td>{{$admitCard->father}}</td>
                                    <td>{{$admitCard->mother}}</td>
                                    <td>{{$admitCard->gender}}</td>
                                    <td>{{$admitCard->dob}}</td>
                                    <td>{{$admitCard->mobile}}</td>
                                    <td>{{$admitCard->address}}</td>
                                    <td>{{$admitCard->created_by}}</td>
                                    <td>{{$admitCard->updated_by}}</td>
                                    <td>
	                                        <div class="btn-group" role="group" aria-label="Basic example">
		                                    
			                                    <a href="{{route('admitCard.show',$admitCard->id)}}" type="button"
			                                    class="btn btn-outline-primary">
				                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-text-fill" viewBox="0 0 16 16">
					                                    <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zm0 2h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1z"/>
				                                    </svg>
			                                    </a>
			                                    <a href="{{route('admitCard.edit',$admitCard->id)}}" type="button"
			                                    class="btn btn-outline-warning">
				                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
					                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
				                                    </svg>
			                                    </a>
		                                    </div>
		                                    <form class="d-none"  action="{{ route('admitCard.destroy',$admitCard->id) }}" method="POST">
			                                    @csrf
			                                    @method('DELETE')
			                                    <button type="submit" onclick="return confirm('Are you sure to delete this item?')" class="btn btn-outline-danger">
				                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
			                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
				                                    </svg>
			                                    </button>
		                                    
	                                    </form>
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection