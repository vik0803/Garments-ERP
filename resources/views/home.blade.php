@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-2">
      <div class="nav flex-column nav-pills text-left" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        @if(Gate::check('isAdmin') || Gate::check('isUser'))
        <a class="nav-link active"  href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
        @endif
        @can ('isAdmin')
          <router-link to="/users" class="nav-link" data-toggle="pill"><i class="fas fa-users nav-icon"></i> Usres</router-link>
        @endcan
        <router-link to="/gate-entry" class="nav-link" data-toggle="pill"><i class="fas fa-torii-gate orange"></i> Gate Entry</router-link>
        <router-link to="/yarn-store" class="nav-link" data-toggle="pill"><i class="fab fa-yarn roblue"></i> Yarn Store</router-link>
        <router-link to="/grey-fabric-store" class="nav-link" data-toggle="pill"><i class="fas fa-store darkslategray"></i> Grey Fabric Store</router-link>
        <router-link to="/finish-fabric-store" class="nav-link" data-toggle="pill"><i class="fas fa-store red"></i> Finish Fabric Store</router-link>
        <router-link to="/dyes-and-chemical-store" class="nav-link" data-toggle="pill"><i class="far fa-object-group "></i> Dyes and Chemical Store</router-link>
        <router-link to="/trims-store" class="nav-link" data-toggle="pill"><i class="fas fa-stream teal"></i> Trims Store</router-link>
        <router-link to="/general-store" class="nav-link" data-toggle="pill"><i class="fas fa-store green"></i> General Store</router-link>
        <router-link to="/report" class="nav-link" data-toggle="pill">Report</router-link>
      </div>
    </div>
    <div class="col-10" >
      <div class="tab-content" id="v-pills-tabContent">
        <router-view></router-view>
        <vue-progress-bar></vue-progress-bar>
      </div>
    </div>
  </div>

@endsection
