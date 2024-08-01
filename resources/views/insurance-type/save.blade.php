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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Type d'assurance</a></li>
                                    <li class="breadcrumb-item active">{{$title}}</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <form action="{{route('insurance-type.save')}}" class="add_insurance_type">
                    @csrf
                    <input type="hidden" name="id" value="{{$insurance_type->id}}">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class="form-label">Logo</label>
                                            <input type="file" name="banner" class="dropify" data-default-file="{{$insurance_type->banner!=null ? Storage::url($insurance_type->banner) : ''}}">
                                        </div>
                                        <div class="col-md-4">
                                            <div>
                                                <label for="care_network" class="form-label">Réseau</label>
                                                <input class="form-control" type="file" name="care_network">
                                            </div>
                                            <div class="mt-2">
                                                <label for="file_description" class="form-label">Brochure</label>
                                                <input class="form-control" type="file" name="file_description">
                                            </div>
                                            <div class="mt-2">
                                                <label for="newsletter" class="form-label">Bulletin d’adhésion</label>
                                                <input class="form-control" type="file" name="newsletter">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2 hidden">
                        					<textarea class="summernote" name="text">{{htmlspecialchars_decode($insurance_type->text)}}</textarea>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="row g-3">
                                                <div class="col-lg-12">
                                                    <div>
                                                        <label class="form-label">Type l'assurance</label>
                                                        <select name="insurance_id" required id="" class="form-control rounded-end">
                                                            <option value="">Sélectionner</option>
                                                            @foreach($insurances as $insurance)
                                                                <option value="{{$insurance->id}}" {{$insurance->id==$insurance_type->insurance_id ? 'selected' : ''}}>{{$insurance->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
        
                                                <div class="col-lg-12">
                                                    <div>
                                                        <label class="form-label">Maison l'assurance</label>
                                                        <input type="text" name="name" value="{{$insurance_type->name}}" class="form-control rounded-end" />
                                                    </div>
                                                </div>
        
                                                <div class="col-lg-12">
                                                    <div>
                                                        <label class="form-label">Description</label>
                                                        <textarea name="description" class="form-control rounded-end" cols="30" rows="3">{{$insurance_type->description}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 row mt-4 div-formule">
                                                    <h4><small>Formules</small> <button id="add-formule" type="button" class="btn btn-block btn-primary btn-sm"><i class="ri-add-fill"></i> Ajouter une formule</button></h4>
                                                    <hr>
                                                    @foreach(json_decode($insurance_type->formules) ?? [] as $formule)
                                                        <div class="row mt-1">
                                                            <div class="col-md-2">
                                                                <input placeholder="Nom de la formule" class="form-control rounded-end mt-1" value="{{$formule->formule_name}}" name="formule_name[]" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input placeholder="Prime nette annuelle" class="form-control rounded-end mt-1" value="{{$formule->formule_prime ?? 0}}" name="formule_prime[]" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input placeholder="Coût de pièce" class="form-control rounded-end mt-1" value="{{$formule->formule_piece}}" name="formule_piece[]" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input placeholder="Taxe d'enregistrement" class="form-control rounded-end mt-1" value="{{$formule->formule_rate}}" name="formule_rate[]" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input placeholder="Prime frais funéraire" class="form-control rounded-end mt-1" value="{{$formule->formule_death}}" name="formule_death[]" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input placeholder="Montant ajouter" class="form-control rounded-end mt-1" value="{{$formule->formule_amount}}" name="formule_amount[]" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input placeholder="Plafond" class="form-control rounded-end mt-1" value="{{$formule->formule_limit ?? 0}}" name="formule_limit[]" required>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="mt-2 mb-2">
                                                                    <textarea class="data hidden" name="formule_data[]">{!!$formule->formule_data!!}</textarea>
                                                                    <button type="button" style="width: 100%;" onclick="popup(this)" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center" class="btn btn-block btn-primary" > Renseigner les information de la formule <i class="ri-file-word-2-line"></i></button>  
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <button onclick="remove_item(this)" type="button" class="btn btn-danger mt-2"><i class="ri-delete-bin-fill"></i></button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="col-lg-12 row mt-4 div-condition">
                                                    <h4><small>Conditions</small> <button id="add-condition" type="button" class="btn btn-block btn-primary btn-sm"><i class="ri-add-fill"></i> Ajouter une condition</button></h4>
                                                    <hr>
                                                    @foreach(json_decode($insurance_type->conditions) ?? [] as $condition)
                                                        <div class="row mt-1">
                                                            <div class="col-md-4">
                                                                <input placeholder="Condition" class="form-control rounded-end mt-1" name="condition_name[]" value="{{$condition->condition_name}}" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <select name="have_right[]" class="form-control rounded-end mt-1">
                                                                    <option value="all"  {{$condition->condition_type=='all' ? 'selected' : ''}}> Tout </option>
                                                                    <option value="single"  {{$condition->condition_type=='single' ? 'selected' : ''}}> Individuel </option>
                                                                    <option value="have_right"  {{$condition->condition_type=='have_right' ? 'selected' : ''}}> Ayant droit </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <select name="condition_option[]" class="form-control rounded-end mt-1">
                                                                    <option value="option_value" {{$condition->condition_option=='option_value' ? 'selected' : ''}}> Valeur </option>
                                                                    <option value="option_unique" {{$condition->condition_option=='option_unique' ? 'selected' : ''}}> Unique </option>
                                                                    <option value="option_mutiple" {{$condition->condition_option=='option_mutiple' ? 'selected' : ''}}> Multiple </option>
                                                                    <option value="option_age" {{$condition->condition_option=='option_age' ? 'selected' : ''}}> Age </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select name="condition_condition[]" class="form-control rounded-end mt-1">
                                                                    <option value="percente_plus" {{$condition->condition_condition=='percente_plus' ? 'selected' : ''}}> Ajouter un pourcentage de : </option>  
                                                                    <option value="percente_minus" {{$condition->condition_condition=='percente_minus' ? 'selected' : ''}}> Retirer un pourcentage de : </option>  
                                                                    <option value="amount_plus" {{$condition->condition_condition=='amount_plus' ? 'selected' : ''}}> Ajouter un montant de : </option>  
                                                                    <option value="amount_minus" {{$condition->condition_condition=='amount_minus' ? 'selected' : ''}}> Retirer un montant de : </option> 
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input placeholder="Valeur" class="form-control rounded-end mt-1" name="condition_value[]" value="{{$condition->condition_value}}" required>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <button onclick="remove_item(this)" type="button" class="btn btn-danger mt-1"><i class="ri-delete-bin-fill"></i></button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="col-lg-12">
                                                    <button id="add_insurance_type" class="btn btn-primary btn-block" style="width:100%">Enregistrer</button>
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

        <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <textarea class="summernote" id="summernote"></textarea>
                        <div class="mt-4">
                            <div class="hstack gap-2 justify-content-center">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                                <a href="javascript:void(0);" onclick="save_data()" class="btn btn-primary">Enregistrer</a>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
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

        $('.add_insurance_type').submit(function(e){

            e.preventDefault();

            var form = new FormData($(this)[0]);

            var buttonDefault = $('#add_insurance_type').text();
            var button = $('#add_insurance_type');

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

                        window.location='{{route("insurance-type.index")}}'
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

        $('#add-formule').on('click',function(){
            $('.div-formule').append(`
                <div class="row mt-1">
                    <div class="col-md-2">
                        <input placeholder="Nom de la formule" class="form-control rounded-end mt-1" name="formule_name[]" required>
                    </div>
                    <div class="col-md-2">
                        <input placeholder="Prime nette annuelle" class="form-control rounded-end mt-1" name="formule_prime[]" required>
                    </div>
                    <div class="col-md-2">
                        <input placeholder="Coût de pièce" class="form-control rounded-end mt-1" name="formule_piece[]" required>
                    </div>
                    <div class="col-md-2">
                        <input placeholder="Taxe d'enregistrement" class="form-control rounded-end mt-1" name="formule_rate[]" required>
                    </div>
                    <div class="col-md-2">
                        <input placeholder="Prime frais funéraire" class="form-control rounded-end mt-1" name="formule_death[]" required>
                    </div>
                    <div class="col-md-2">
                        <input placeholder="Montant ajouter" class="form-control rounded-end mt-1" name="formule_amount[]" required>
                    </div>
                    <div class="col-md-2">
                        <input placeholder="Plafond" class="form-control rounded-end mt-1" name="formule_limit[]" required>
                    </div>
                    <div class="col-md-3">
                        <div class="mt-2 mb-2">
                            <textarea class="data hidden" name="formule_data[]"></textarea>
                            <button type="button" style="width: 100%;" onclick="popup(this)" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center" class="btn btn-block btn-primary" > Renseigner les information de la formule <i class="ri-file-word-2-line"></i></button>  
                        </div>
                    </div>
                    <div class="col-md-1 mt-2 mb-2">
                        <button onclick="remove_item(this)" type="button" class="btn btn-danger mt-2"><i class="ri-delete-bin-fill"></i></button>
                    </div>
                    <hr>
                </div>
            `);
        });

        $('#add-condition').on('click',function(){
            $('.div-condition').append(`
                <div class="row mt-1">
                    <div class="col-md-4">
                        <input placeholder="Condition" class="form-control rounded-end mt-1" name="condition_name[]" required>
                    </div>
                    <div class="col-md-2">
                        <select name="have_right[]" class="form-control rounded-end mt-1">
                            <option value="all"> Tout </option>
                            <option value="single"> Individuel </option>
                            <option value="have_right"> Ayant droit </option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="condition_option[]" class="form-control rounded-end mt-1">
                            <option value="option_value"> Valeur </option>
                            <option value="option_unique"> Unique </option>
                            <option value="option_mutiple"> Multiple </option>
                            <option value="option_age"> Age </option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="condition_condition[]" class="form-control rounded-end mt-1">
                            <option value="percente_plus"> Ajouter un pourcentage de : </option>  
                            <option value="percente_minus"> Retirer un pourcentage de : </option>  
                            <option value="amount_plus"> Ajouter un montant de : </option>  
                            <option value="amount_minus"> Retirer un montant de : </option> 
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input placeholder="Valeur" class="form-control rounded-end mt-1" name="condition_value[]" required>
                    </div>
                    <div class="col-md-1">
                        <button onclick="remove_item(this)" type="button" class="btn btn-danger mt-1"><i class="ri-delete-bin-fill"></i></button>
                    </div>
                </div>
            `);
        });

        function remove_item(self){
            $(self).parent().parent().remove();
        }

    </script>
   
@endsection