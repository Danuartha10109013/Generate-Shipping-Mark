@extends('layout.pegawai.main')
@section('title')
Dashboard || Pegawai 
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
       <div class="col-sm-6 col-md-6 col-lg-3">
          <div class="iq-card iq-card-block iq-card-stretch ">
             <div class="iq-card-body">
                     <div class="d-flex d-flex align-items-center justify-content-between">
                        <div>
                            <h2>{{$a_count}}</h2>
                            <p class="fontsize-sm m-0">Total Ship A</p>
                        </div>
                        <div class="rounded-circle iq-card-icon dark-icon-light iq-bg-primary "> <i class="fill">A</i></div>
                     </div>
             </div>
          </div>
       </div>
       <div class="col-sm-6 col-md-6 col-lg-3">
          <div class="iq-card iq-card-block iq-card-stretch ">
             
             <div class="iq-card-body">
                <div class="d-flex d-flex align-items-center justify-content-between">
                   <div>
                    <h2>{{$b_count}}</h2>
                    <p class="fontsize-sm m-0">Total Ship B</p>
                   </div>
                   <div class="rounded-circle iq-card-icon iq-bg-danger"><i >B</i></div>
                </div>
              </div>
          </div>
       </div>
       <div class="col-sm-6 col-md-6 col-lg-3">
          <div class="iq-card iq-card-block iq-card-stretch ">
             <div class="iq-card-body">
                <div class="d-flex d-flex align-items-center justify-content-between">
                   <div>
                    <h2>{{$c_count}}</h2>
                    <p class="fontsize-sm m-0">Total Ship C</p>
                   </div>
                   <div class="rounded-circle iq-card-icon iq-bg-warning "><i>C</i></div>
                </div>
            </div>
          </div>
       </div>
       <div class="col-sm-6 col-md-6 col-lg-3">
          <div class="iq-card iq-card-block iq-card-stretch ">
             <div class="iq-card-body">
                <div class="d-flex d-flex align-items-center justify-content-between">
                   <div>
                    <h2>{{$d_count}}</h2>
                    <p class="fontsize-sm m-0">Total Ship D</p>
                   </div>
                   <div class="rounded-circle iq-card-icon iq-bg-info "><i>D</i></div>
                </div>
            </div>
          </div>
       </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <a href="{{route('pegawai.shipment-a')}}">
            <div class="iq-card iq-card-block iq-card-stretch ">
                <div class="iq-card-body">
                   <div class="d-flex d-flex align-items-center justify-content-between">
                      <div>
                        <img width="50%" src="{{asset('A.png')}}" alt="">
                          <h2>Shippment A</h2>
                          <p class="fontsize-sm m-0">Generate Shippping Mark Type A</p>
                      </div>
                      <div class="rounded-circle iq-card-icon iq-bg-primary "><i class="ri-refund-line"></i></div>
                   </div>
               </div>
             </div>
             </a>    
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="{{route('pegawai.shipment-b')}}">
            <div class="iq-card iq-card-block iq-card-stretch ">
                <div class="iq-card-body">
                   <div class="d-flex d-flex align-items-center justify-content-between">
                      <div>
                        <img width="50%" src="{{asset('B.png')}}" alt="">
                          <h2>Shippment B</h2>
                          <p class="fontsize-sm m-0">Generate Shippping Mark Type B</p>
                      </div>
                      <div class="rounded-circle iq-card-icon iq-bg-danger "><i class="ri-refund-line"></i></div>
                   </div>
               </div>
             </div>
             </a>    
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="{{route('pegawai.shipment-c')}}">
            <div class="iq-card iq-card-block iq-card-stretch ">
                <div class="iq-card-body">
                   <div class="d-flex d-flex align-items-center justify-content-between">
                      <div>
                        <img width="50%" src="{{asset('C.png')}}" alt="">
                          <h2>Shippment C</h2>
                          <p class="fontsize-sm m-0">Generate Shippping Mark Type C</p>
                      </div>
                      <div class="rounded-circle iq-card-icon iq-bg-warning "><i class="ri-refund-line"></i></div>
                   </div>
               </div>
             </div>
             </a>    
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="{{route('pegawai.shipment-d')}}">
            <div class="iq-card iq-card-block iq-card-stretch ">
                <div class="iq-card-body">
                   <div class="d-flex d-flex align-items-center justify-content-between">
                      <div>
                        <img width="50%" src="{{asset('D.png')}}" alt="">

                          <h2>Shippment D</h2>
                          <p class="fontsize-sm m-0">Generate Shippping Mark Type D</p>
                      </div>
                      <div class="rounded-circle iq-card-icon iq-bg-info "><i class="ri-refund-line"></i></div>
                   </div>
               </div>
             </div>
             </a>    
        </div>
    </div>
   
</div>
@endsection
 