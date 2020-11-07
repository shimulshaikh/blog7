@extends('website.backend.layouts.main')

@section('title','Home')

@section('content')
                            <div class="main-content-part">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a data-toggle="tab" href="#home">Home
                                            <button data-widget="remove" class="btn btn-box-tool" type="button"><i class="fa fa-times"></i></button>
                                        </a>
                                    </li>

                                    <li>
                                        <a data-toggle="tab" href="#accountSetup">Account Setup
                                            <button data-widget="remove" class="btn btn-box-tool" type="button"><i class="fa fa-times"></i></button>
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div id="home" class="tab-pane fade in active">
                                        <p><img class="img-responsive" src="{{asset('backend/dist/img/curentBulb.png')}}" style="width: 100%;"></p>
                                    </div>
                                    
                                    <div id="accountSetup" class="tab-pane fade">
                                        <h3>Account Setup</h3>
                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                </div>
                            </div>
@endsection                            