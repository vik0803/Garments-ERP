@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-2">
      <div class="nav flex-column nav-pills text-left" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a class="nav-link active" href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
        <router-link to="/Usres" class="nav-link" data-toggle="pill"><i class="fas fa-users nav-icon"></i> Usres</router-link>
        <router-link to="/quotation-evaluation" class="nav-link" data-toggle="pill">Quotation Evaluation</router-link>

      </div>
    </div>
    <div class="col-10">
      <div class="tab-content" id="v-pills-tabContent">
        <router-view></router-view>
      </div>
    </div>
  </div>

@endsection
