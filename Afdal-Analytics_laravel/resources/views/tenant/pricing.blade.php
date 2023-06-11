@section('title', 'Home')
@extends('layout.header')
@section('content')

<div class="pricing-card-row">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <h1 class="text-center">Right plan for your growth</h1>
            <p class="text-center">Start trying Afdal Analytics for free and we'll be with you as you grow</p>
         </div>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="card-group">
               <div class="card pricing-card mt-5 price-one">
                  <div class="card-body ">
                     <div class="text-center">
                        <p>Enterprise</p>
                        <h3>$1465</h3>
                        <p>per month/</p>
                        <p>Unified marketing reporting for <br>international brands, or teams. Robust <br>support with enterprise security</p>
                     </div>
                     <div class="text-right w-75 mx-auto">
                        <p>Everything In Plus <i class="fas fa-check text-warning ml-2"></i></p>
                        <p>Advertising <i class="fas fa-check text-warning ml-2"></i></p>
                        <p>Connections <i class="fas fa-check text-warning ml-2"></i></p>
                        <p>Team Members <i class="fas fa-check text-warning ml-2"></i></p>
                        <p>Data Sources <i class="fas fa-check text-warning ml-2"></i></p>
                     </div>
                  </div>
                  <div class="text-center card-footer border-0 pt-0">
                     <button class="btn ml-0 btn-warning">FREE TRIAL</button>
                  </div>
               </div>
               <div class="card pricing-card mt-5 price-two">
                  <div class="card-body ">
                     <div class="text-center">
                        <p>Plus</p>
                        <h3>$715</h3>
                        <p>per month/</p>
                        <p>Comprehensive data collection and <br>transformation for teams to connect to <br>any platform, anywhere.</p>
                     </div>
                     <div class="text-right w-75 mx-auto">
                        <p>Everything In Essential <i class="fas fa-check theme-color ml-2"></i></p>
                        <p>Advertising <i class="fas fa-check theme-color ml-2"></i></p>
                        <p>Connections <i class="fas fa-check theme-color ml-2"></i></p>
                        <p>Team Members <i class="fas fa-check theme-color ml-2"></i></p>
                        <p>Data Sources <i class="fas fa-check theme-color ml-2"></i></p>
                     </div>
                  </div>
                  <div class="text-center card-footer border-0 pt-0">
                     <button class="btn ml-0 btn-white theme-color">FREE TRIAL</button>
                  </div>
               </div>
               <div class="card pricing-card mt-5 ">
                  <div class="card-body ">
                     <div class="text-center">
                        <p class="theme-color">Essentials</p>
                        <h3>$300</h3>
                        <p class="theme-color">per month/</p>
                        <p class="theme-color">Everything you need as a marketer to <br>quickly analyze marketing data from all <br>common marketing apps and platforms.</p>
                     </div>
                     <div class="text-right w-75 mx-auto">
                        <p>Insights <i class="fas fa-check text-warning ml-2"></i></p>
                        <p>Advertising <i class="fas fa-check text-warning ml-2"></i></p>
                        <p>Connections <i class="fas fa-check text-warning ml-2"></i></p>
                        <p>Team Members <i class="fas fa-check text-warning ml-2"></i></p>
                        <p>Data Sources <i class="fas fa-check text-warning ml-2"></i></p>
                     </div>
                  </div>
                  <div class="text-center card-footer border-0 pt-0">
                     <button class="btn ml-0 btn-warning">FREE TRIAL</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="container mt-5">
   <div class="row">
      <div class="col-12">
         <h3 class="text-center">Compare Plans</h3>
         <p class="text-center">Start trying Afdal Analytics for free and we'll be with you as you grow</p>
      </div>
   </div>

   <div class="row">
      <div class="col-lg-8 col-sm-10 col-12 mx-auto">
         <div class="card card-table-pricing">
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-pricing-list">
                     <thead>
                        <tr>
                           <th class="text-center">Enterprise</th>
                           <th class="text-center">Plus</th>
                           <th class="text-center">Essentials</th>
                           <th class="text-right"></th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td class="text-center">Unlimited</td>
                           <td class="text-center">5</td>
                           <td class="text-center">3</td>
                           <td class="text-right">Number of Connections</td>
                        </tr>

                        <tr>
                           <td class="text-center"><i class="fas fa-check text-warning"></i></td>
                           <td class="text-center"><i class="fas fa-check text-warning"></i></td>
                           <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                           <td class="text-right">Data Guarante</td>
                        </tr>

                        <tr>
                           <td class="text-center"><i class="fas fa-check text-warning"></i></td>
                           <td class="text-center"><i class="fas fa-check text-warning"></i></td>
                           <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                           <td class="text-right">Unlimited Data Volume</td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection