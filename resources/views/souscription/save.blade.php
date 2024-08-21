@extends('layouts.app')

@section('title', $title)

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">{{$title}}</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Souscription</a></li>
                                    <li class="breadcrumb-item active">{{$title}}</li>
                                </ol>
                            </div>
 
                        </div>
                    </div>
                </div>

                <form action="{{route('souscription.save')}}" class="add_souscription">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class="form-label">Fichier</label>
                                            <input type="file" name="file_souscriptions" class="dropify" required>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="row g-3">

                                                <div class="col-lg-6">
                                                    <div>
                                                        <label class="form-label">Numero</label>
                                                        <input type="text" name="number_souscriptions" value="" class="form-control rounded-end" required />
                                                    </div>

                                                    <div class="mt-3">
                                                        <label class="form-label">Client</label>
                                                        <select name="customer_id" id="customer_id" class="form-control select2">
                                                            @foreach($customers as $customer)
                                                                <option value="{{ $customer->id }}" 
                                                                    {{ isset($souscription) && $customer->id == $souscription->customer_id ? 'selected' : '' }}>
                                                                    {{ $customer->first_name }} {{ $customer->last_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
        
                                                </div>
                                                
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label class="form-label">Formule</label>
                                                        <input type="text" name="formule" value="" class="form-control rounded-end" required />
                                                    </div>

                                                    <div  class="mt-3">
                                                        <label class="form-label">Date d'expiration </label>
                                                        <input type="date" name="date_of_expiration" value="" class="form-control rounded-end" required />
                                                    </div>
        
                                                    <br>
                                                </div>

                                                <div class="col-lg-12 row mt-2">
                                                    <h4><small>Paiement</small></h4>
                                                    <hr>
                                                    <div class="col-lg-6">
                                                        <label class="form-label"> Référence du paiement </label>
                                                        <input type="text" name="ref_payment" class="form-control rounded-end" required />
                                                    </div>
                                                    
                                                    <div class="col-lg-6">
                                                        <label class="form-label">Mode de paiement</label>
                                                        <select name="mode_payment" id="mode_payment" class="form-control select2">
                                                                <option value="En ligne"> En ligne </option>
                                                                <option value="En espèce"> En espèce </option>
                                                        </select>
                                                    </div>

                                                    <div class="col-lg-6 mt-3">
                                                        <label class="form-label">Date de paiement </label>
                                                        <input type="date" name="date_payment" value="" class="form-control rounded-end" required />
                                                    </div>

                                                    <div class="col-lg-6 mt-3">
                                                        <label class="form-label"> Montant </label>
                                                        <input type="text" name="amount" value="" class="form-control rounded-end" required />
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <button id="add_souscription" class="btn btn-primary btn-block" style="width:100%">Enregistrer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                </form>


            </div>
            <!-- container-fluid -->
        </div>

@endsection

@section('css-link')
    
@endsection



@section('script')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>

        var data;

        function popup(self){
            data = $(self);
            var input_data =  data.parent().find('.data');
            $('#summernote').summernote('code',input_data.val());
        }

        function save_data(){
            var input_data =  data.parent().find('.data');
            $('.bs-example-modal-center').modal('hide');
            input_data.val($("#summernote").val());
        }

        $(document).ready(function() {
            $('.summernote').summernote({height: 600});
        });

        $('.add_souscription').submit(function(e){

            e.preventDefault();

            var form = new FormData($(this)[0]);

            var buttonDefault = $('#add_souscription').text();
            var button = $('#add_souscription');

            button.attr('disabled',true);
            button.text('Veuillez patienter ...');

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: form,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (result){

                    button.attr('disabled',false);
                    button.text(buttonDefault);

                    if(result.status=="success"){

                        Toastify({
                            text: result.message,
                            duration: 3000, // 3 seconds
                            gravity: "top", // "top" or "bottom"
                            position: 'right', // "left", "center", "right"
                            backgroundColor: "#4CAF50", // green
                        }).showToast();

                        window.location='{{route("souscription.index")}}'
                    }else{
                        Toastify({
                            text: result.message,
                            duration: 3000, // 3 seconds
                            gravity: "top", // "top" or "bottom"
                            position: 'right', // "left", "center", "right"
                            backgroundColor: "red", // red
                        }).showToast();
                    }
                    
                },
                error: function(result){

                    button.attr('disabled',false);
                    button.text(buttonDefault);

                    if(result.responseJSON.message){
                        Toastify({
                            text: result.responseJSON.message,
                            duration: 3000, // 3 seconds
                            gravity: "top", // "top" or "bottom"
                            position: 'right', // "left", "center", "right"
                            backgroundColor: "red", // red
                        }).showToast();
                    }else{
                        Toastify({
                            text: "Une erreur c'est produite",
                            duration: 3000, // 3 seconds
                            gravity: "top", // "top" or "bottom"
                            position: 'right', // "left", "center", "right"
                            backgroundColor: "red", // red
                        }).showToast();
                    }

                }
            });
        });

    </script>
   
@endsection