@extends('layouts.student_layout')

@section('css')

<style>
    td{white-space:nowrap;}
</style>

@endsection

@section('content')
<div class="container-fluid">
    <a class="btn btn-primary mt-2"  href="{{ route('admitCard.index')}}" >Student List</a>
    <a class="btn btn-primary mt-2"  href="{{ route('admitCard.create')}}" >Add New Student</a>
    <a class="btn btn-primary mt-2"  href="{{ route('admitCard.admit_cards')}}" >View All Admit Cards</a>
    
</div>
@endsection