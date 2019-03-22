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
        <router-link to="/purchase-requisition" class="nav-link" data-toggle="pill">Purchase Requisition</router-link>
        <router-link to="/quotation-evaluation" class="nav-link" data-toggle="pill">Quotation Evaluation</router-link>
        <router-link to="/gate-entry" class="nav-link" data-toggle="pill">Gate Entry</router-link>
        <router-link to="/yarn-store" class="nav-link" data-toggle="pill">Yarn Store</router-link>
        <router-link to="/grey-fabric-store" class="nav-link" data-toggle="pill">Grey Fabric Store</router-link>
        <router-link to="/finish-fabric-store" class="nav-link" data-toggle="pill">Finish Fabric Store</router-link>
        <router-link to="/dyes-and-chemical-store" class="nav-link" data-toggle="pill">Dyes and Chemical Store</router-link>
        <router-link to="/trims-store" class="nav-link" data-toggle="pill">Trims Store</router-link>
        <router-link to="/general-store" class="nav-link" data-toggle="pill">General Store</router-link>
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
