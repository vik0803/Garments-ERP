@extends('layouts.masterApp')

@section('title','Inventory')

@section('content')

    <section class="cat-area section-gap" id="feature">
      <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <div class="btn-group" role="group">
                        <router-link to="/purchase-requisition" class="btn btn-secondary text-light">Purchase Requisition</router-link>
                        <router-link to="/quotation-evaluation" class="btn btn-secondary text-light">Quotation Evaluation</router-link>
                        <router-link to="/gate-entry" class="btn btn-secondary text-light">Gate Entry</router-link>
                        <router-link to="/yarn-store" class="btn btn-secondary text-light">Yarn Store</router-link>
                        <router-link to="/grey-fabric-store" class="btn btn-secondary text-light">Grey Fabric Store</router-link>
                        <router-link to="/finish-fabric-store" class="btn btn-secondary text-light">Finish Fabric Store</router-link>
                        <router-link to="/dyes-and-chemical-store" class="btn btn-secondary text-light">Dyes and Chemical Store</router-link>
                        <router-link to="/trims-store" class="btn btn-secondary text-light">Trims Store</router-link>
                        <router-link to="/general-store" class="btn btn-secondary text-light">General Store</router-link>
                        <router-link to="/report" class="btn btn-secondary text-light">Report</router-link>
                      </div>
                    </div>

                    <div class="card-body">
                      <router-view></router-view>
                    </div>
                </div>
            </div>
        </div>

      </div>
    </section>



@endsection
