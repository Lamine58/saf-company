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
                            <h4 class="mb-sm-0">{{$title}} : {{$quizze->value_chain->name}} {{$quizze->category->name}}</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Question</a></li>
                                    <li class="breadcrumb-item active">{{$title}} : {{$quizze->value_chain->name}} {{$quizze->category->name}}</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <form action="{{route('indicator.save')}}" class="add_indicator">
                    @csrf
                    <input type="hidden" name="id" value="{{$indicator->id}}">
                    <input type="hidden" name="quizze_id" value="{{$quizze->id}}">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row g-3">
    
                                                <div class="col-lg-12">
                                                    <label class="form-label">Question</label>
                                                    <textarea id="question" class="form-control rounded-end" name="question" rows="2">{{$indicator->question}}</textarea>
                                                </div>
                                                <div class="col-lg-6">
                                                    <select name="method_id" id="method_id" class="form-control rounded-end mt-1">
                                                        <option value="">Méthode de collecte de donnée</option>
                                                        @foreach(App\Models\Method::all() as $data):
                                                            <option {{$indicator->method_id==$data->id ? 'selected' : ''}} value="{{$data->id}}">{{$data->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <select name="unity_id" id="unity_id" class="form-control rounded-end mt-1">
                                                        <option value="">Unité</option>
                                                        @foreach(App\Models\Unity::all() as $data):
                                                            <option {{$indicator->unity_id==$data->id ? 'selected' : ''}} value="{{$data->id}}">{{$data->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <select name="periodicity_id" id="periodicity_id" class="form-control rounded-end mt-1">
                                                        <option value="">Periodicité</option>
                                                        @foreach(App\Models\Periodicity::all() as $data):
                                                            <option {{$indicator->periodicity_id==$data->id ? 'selected' : ''}} value="{{$data->id}}">{{$data->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <select name="type" id="type" class="form-control rounded-end mt-1">
                                                        <option {{$indicator->type=='Nombre' ? 'selected' : ''}} >Nombre</option>
                                                        <option {{$indicator->type=='Text' ? 'selected' : ''}} >Text</option>
                                                        <option {{$indicator->type=='Long text' ? 'selected' : ''}} >Long text</option>
                                                        <option {{$indicator->type=='Question à choix unique' ? 'selected' : ''}} >Question à choix unique</option>
                                                        <option {{$indicator->type=='Question à choix multiple' ? 'selected' : ''}} >Question à choix multiple</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6"></div>
                                                <div class="col-lg-4 choice choice-class {{($indicator->type=='Question à choix unique' || $indicator->type=='Question à choix multiple') ? '' : 'hidden'}} ">
                                                    @foreach(json_decode($indicator->data ?? '[]') as $choice)
                                                        <div class="row">
                                                            <div class="col-md-10">
                                                                <input placeholder="Option de reponse" value='{{$choice}}' class="form-control rounded-end mt-1" name="data[]">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <button onclick="remove_item(this)" class="btn btn-danger"><i class="ri-delete-bin-fill"></i></button>
                                                            </div>
                                                        </div>
                                                    @endforeach()
                                                </div>
                                                <div class="col-lg-2 choice-class {{($indicator->type=='Question à choix unique' || $indicator->type=='Question à choix multiple') ? '' : 'hidden'}} "><button id="add-choice" type="button"  style="width:100%" class="btn btn-block btn-primary btn-sm"><i class="ri-add-fill"></i> Ajouter une option</button></div>
                                                <div class="col-lg-12">
                                                    <button id="add_indicator" class="btn btn-primary btn-block" style="width:100%">Enregistrer</button>
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

    <script>

        $('#type').on('change',()=>{

            if($('#type').val()=='Question à choix unique' || $('#type').val()=='Question à choix multiple'){
                $('.choice-class').removeClass('hidden');
            }else{
                $('.choice-class').addClass('hidden');
            }
        });

        $('#add-choice').on('click',function(){
            $('.choice').append(`
                <div class="row">
                    <div class="col-md-10">
                        <input placeholder="Option de reponse" class="form-control rounded-end mt-1" name="data[]">
                    </div>
                    <div class="col-md-2">
                        <button onclick="remove_item(this)" class="btn btn-danger"><i class="ri-delete-bin-fill"></i></button>
                    </div>
                </div>
            `);
        });

        function remove_item(self){
            $(self).parent().parent().remove();
        }

        $('.add_indicator').submit(function(e){

            e.preventDefault();

            var form = new FormData($(this)[0]);

            var buttonDefault = $('#add_indicator').text();
            var button = $('#add_indicator');

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

                        window.location='{{route('indicator.index',[$quizze->id])}}'
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