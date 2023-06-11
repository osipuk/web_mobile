@extends('layout.admin.header')
@section('title', 'Afdal Analytics Customer Support')
@section('content')
<div class="page-wrapper wrap10">
   <div class="container-fluid">
      <div class="row page-titles">
         <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Currency Converter</h4>
         </div>
      </div>
      @if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
         <button type="button" class="close" data-dismiss="alert">×</button>    
         <strong>{{ $message }}</strong>
      </div>
      @endif
      @if ($message = Session::get('error'))
      <div class="alert alert-danger alert-block">
         <button type="button" class="close" data-dismiss="alert">×</button>    
         <strong>{{ $message }}</strong>
      </div>
      @endif
      <div class="row">
         <div class="col-12">
            <div class="card rounded-5 shadow">
               <div class="card-body">
                  <div class="row">
                     <div class="col-12">
                        <div class="email-form">
                           <form action="{{ url('currency-rate') }}" method="post" enctype="multipart/form-data" class="mainform">
                              @csrf
                              <div class="row">
                                 <div class="col-md-6 col-12">
                                    <div class="form-group">
                                       <label class="control-label font-weight-bold">From Currency</label>
                                       <input type="text" id="from_currency" name="from_currency" value="USD" class="form-control" readonly>
                                    </div>
                                 </div>
                                 <div class="col-md-6 col-12">
                                    <div class="form-group">
                                       <label class="control-label font-weight-bold">To Currency</label>
                                       <select name="to_currency" id="to_currency" class="form-control" required>
                                          <option selected disabled>Select Currency</option>
                                          <?php foreach($currencyrates as $val){ ?>
                                          <option value="{{$val->current_value}}">{{$val->currency_name}}</option>
                                          <?php } ?>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-6 col-12">
                                    <div class="form-group">
                                       <label class="control-label font-weight-bold">Amount</label>
                                       <input type="number" id="amount" name="amount" class="form-control" required>
                                    </div>
                                 </div>
                                 <div class="col-md-6 col-12">
                                    <div class="form-group">
                                       <label class="control-label font-weight-bold">Converted Amount</label>
                                       <input type="text" id="converted_amount" name="converted_amount" class="form-control">
                                    </div>
                                 </div>
                              </div>
                              <div class="text-right">
                                 <button type="button" class="btn btn-success" onclick="convert()">Convert</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   function convert(){
   
       var to_currency = $("#to_currency").val();
   
       var amount = $("#amount").val();
   
       if(amount){
   
           if(to_currency){
   
               var amount_converted = to_currency * amount;
   
               var converted = amount_converted.toFixed(2);
   
               //alert(amount_converted);
   
               document.getElementById('converted_amount').value = converted;
   
           }
   
       }
   
       
   
   }
   
</script>
@endsection