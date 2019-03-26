@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-2">
      <div class="nav flex-column nav-pills text-left" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        @if(Gate::check('isAdmin'))
          <a class="nav-link active"  href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
          <router-link to="/users" class="nav-link" data-toggle="pill"><i class="fas fa-users nav-icon"></i> Usres</router-link>
        @endif  @if(Gate::check('isAdmin') || Gate::check('isGateEntry'))
          <router-link to="/gateEntry" class="nav-link" data-toggle="pill"><i class="fas fa-torii-gate orange"></i> Gate Entry</router-link>
        @endif  @if(Gate::check('isAdmin') || Gate::check('isYarnStore'))
          <router-link to="/yarnStore" class="nav-link" data-toggle="pill"><i class="fab fa-yarn roblue"></i> Yarn Store</router-link>
        @endif  @if(Gate::check('isAdmin') || Gate::check('isGreyFabric'))
          <router-link to="/greyFabric" class="nav-link" data-toggle="pill"><i class="fas fa-store darkslategray"></i> Grey Fabric Store</router-link>
        @endif  @if(Gate::check('isAdmin') || Gate::check('isFinishFabric'))
          <router-link to="/finishFabric" class="nav-link" data-toggle="pill"><i class="fas fa-store red"></i> Finish Fabric Store</router-link>
        @endif  @if(Gate::check('isAdmin') || Gate::check('isDyesAndChemical'))
          <router-link to="/dyesAndchemical" class="nav-link" data-toggle="pill"><i class="far fa-object-group "></i> Dyes and Chemical Store</router-link>
        @endif  @if(Gate::check('isAdmin') || Gate::check('isTrimsStore'))
          <router-link to="/trimsStore" class="nav-link" data-toggle="pill"><i class="fas fa-stream teal"></i> Trims Store</router-link>
        @endif
      </div>
    </div>
    <div class="col-10" >
      <div class="tab-content" id="v-pills-tabContent">

            <router-view></router-view>
            <vue-progress-bar></vue-progress-bar>

            @if (Request::is('dashboard'))
              @yield('dash')
            @endif


      </div>
    </div>
  </div>

@endsection
