@extends('layouts.app')

@section('title', "Détails $business->legal_name")

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Détails {{$business->legal_name}}</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Fournisseur</a></li>
                                    <li class="breadcrumb-item active">Détails {{$business->legal_name}}</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>      
                
                <div class="row">
                    <div class="col-xxl-6">
                        <div class="card">
                            <div class="card-body">

                                <div class="live-preview">
                                    <p><img src="{{ Storage::url($business->logo) }}" style="width:100px" alt=""></p>
                                    <hr>
                                    <p>Raison sociale: {{ $business->legal_name }}</p>
                                    <hr>
                                    <p>Région: {{ $business->region->name }}</p>
                                    <hr>
                                    <p>Département: {{ $business->departement->name }}</p>
                                    <hr>
                                    <p>Sous-prefecture: {{ $business->sous_prefecture->name }}</p>
                                    <hr>
                                    <p>Localité: {{ $business->localite }}</p>
                                    <hr>
                                    <p>Localisation: {{ $business->location }}</p>
                                    <hr>
                                    <p>Téléphone: {{ $business->phone }}</p>
                                    <hr>
                                    <p>Email: {{ $business->email }}</p>
                                    <hr>
                                    <p>Nom et prénom de l'opérateur: {{ $business->name_of_operator }}</p>
                                    <hr>
                                    <p>Date de naissance: {{ $business->date_of_birth }}</p>
                                    <hr>
                                    <p>Lieu de naissance: {{ $business->place_of_birth }}</p>
                                    <hr>
                                    @if(Auth::user()->permission('EDITION FOURNISSEUR'))
                                        <a class="btn btn-primary" href="{{ route('business.add', [$business->id]) }}"><i class="ri-pencil-fill align-bottom me-2"></i> Modifier le fournisseur</a>
                                    @endif
                                </div>
                                

                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    </div>

                    <div class="col-xxl-6">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Liste des exploitations</h4>
                                @if(Auth::user()->permission('AJOUT EXPLOITATION'))
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bs-modal-center">Ajouter une exploitation <i class="ri-add-line"></i></button>
                                @endif
                            </div><!-- end card header -->

                            <div class="card-body">

                                <table id="table" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Region</th>
                                            <th>Departement</th>
                                            <th>Catégorie</th>
                                            <th>Superficie</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($business->exploitations as $exploitation)
                                            <tr>
                                                <td>{{$exploitation->type_exploitation->name}}</td>
                                                <td>{{$exploitation->region->name}}</td>
                                                <td>{{$exploitation->departement->name}}</td>
                                                <td>{{App\Models\Category::find($exploitation->business_category()->first()->category_id)->name}}</td>
                                                <td>{{$exploitation->area}}</td>
                                                <td>
                                                    <div class="dropdown d-inline-block">
                                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-fill align-middle"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            @if(Auth::user()->permission('EDITION EXPLOITATION'))
                                                                <li>
                                                                    <a class="dropdown-item edit-item-btn" href="{{route('business.exploitation',[$exploitation->id])}}"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Modifier</a>
                                                                </li>
                                                            @endif
                                                            @if(Auth::user()->permission('SUPPRESSION EXPLOITATION'))
                                                                <li>
                                                                    <a href="javascript:void(0);" onclick="deleted('{{$exploitation->id}}','{{route('business.delete-exploitation')}}')" class="dropdown-item remove-item-btn">
                                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted" ></i> Supprimer
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    </div>
                </div>

            </div>
            <!-- container-fluid -->
            
        </div>
        <!-- End Page-content -->
        @if(Auth::user()->permission('AJOUT EXPLOITATION'))
            <div class="modal fade bs-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <form class="modal-dialog  modal-lg modal-dialog-centered add_exploitation" action="{{route('business.save-exploitation')}}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>Ajouter une exploitation</h3>
                        </div>
                        <div class="modal-body" style="padding:2rem!important">
                            <input type="hidden" name="business_id" value="{{$business->id}}">
                            <div class="col-md-12">
                                <div class="row g-3">

                                    <div class="col-lg-6">

                                        <div>
                                            <label class="form-label">Filière</label>
                                            <select id="filiere_id" class="form-control select-2-popup" name="filiere_id">
                                                <option value="">Sélectionner la filière</option>
                                                @foreach($filieres as $filiere)
                                                    <option value="{{$filiere->id}}">{{$filiere->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mt-2 hidden">
                                            <label class="form-label">Sélectionner les type pour la filière</label>
                                            <select id="filiere_ids" multiple class="form-control select-2-popup" name="filiere_ids[]"> 
                                            </select>
                                        </div>

                                        <div class="mt-2">
                                            <label class="form-label">Nom et prénom de l'opérateur</label>
                                            <input type="text" name="name_of_operator" class="form-control rounded-end" />
                                        </div>
                                        <div class="mt-2">
                                            <label class="form-label">Date de naissance</label>
                                            <input type="date" name="date_of_birth" class="form-control rounded-end" />
                                        </div>
                                        <div class="mt-2">
                                            <label class="form-label">Lieu de naissance</label>
                                            <input type="text" name="place_of_birth" class="form-control rounded-end" />
                                        </div>
                                        <div class="mt-2">
                                            <label class="form-label">Téléphone</label>
                                            <input type="text" name="phone" class="form-control phone rounded-end" />
                                        </div>

                                        <div class="mt-2">
                                            <label class="form-label">Sélectionner le type pour la filière</label>
                                            <select id="category_id" class="form-control select2 select-2-popup" name="category_id" required> 
                                                {{-- @foreach($categories as $category)
                                                    <option value="{{$category->id}}" >{{$category->name}}</option>
                                                @endforeach --}}
                                            </select>
                                        </div>

                                        <div class="mt-2">
                                            <label class="form-label">Sélectionner les chaîne de valeur de l'exploitation</label>
                                            <select id="quizze_id" multiple class="form-control select-2-popup" name="quizze_id[]" required> 
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-lg-6">

                                        <div >
                                            <label class="form-label">Type</label>
                                            <select id="type_exploitation_id" class="form-control select-2-popup" name="type_exploitation_id" required> 
                                                @foreach($type_exploitations as $type_exploitation)
                                                    <option value="{{$type_exploitation->id}}" {{ $business->type_exploitation_id==$type_exploitation->id ? 'selected' : '' }} >{{$type_exploitation->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mt-2">
                                            <label class="form-label">Région</label>
                                            <select id="region_id" class="form-control select-2-popup" name="region_id">
                                                <option value="">Selectionner la région</option>
                                                @foreach($regions as $region)
                                                    <option value="{{$region->id}}" >{{$region->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div  class="mt-2">
                                            <label class="form-label">Département</label>
                                            <select id="departement_id" class="form-control select-2-popup" name="departement_id"> 
                                                <option value="">Sélectionner le département</option>
                                            </select>
                                        </div>

                                        <div class="mt-2">
                                            <label class="form-label">Sous-préfecture</label>
                                            <select id="sous_prefecture_id" class="form-control select2" name="sous_prefecture_id">
                                                <option value="">Sélectionner la sous-préfecture</option>
                                            </select>
                                        </div>
                                        <div class="mt-2">
                                            <label class="form-label">Localité</label>
                                            <input type="text" name="localite" class="form-control rounded-end" />
                                        </div>
                                        <div class="mt-2">
                                            <label class="form-label">Adresse</label>
                                            <input type="text" name="location" class="form-control rounded-end" />
                                        </div>

                                        <div class="mt-2">  
                                            <label class="form-label">Superficie</label>
                                            <input type="number" name="area" class="form-control rounded-end" />
                                        </div>

                                        <div class="mt-2">  
                                            <label class="form-label">Coordonées GPS</label>
                                            <input type="text" name="location" class="form-control rounded-end" />
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="hstack gap-2 justify-content-center">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                                    <button class="btn btn-primary" id="add_exploitation">Enregister</button>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </form><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        @endif

@endsection

@section('css-link')
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

@endsection


@section('script')
    <script>
        new DataTable("#table", {
            dom: "Bfrtip",
            buttons: ["excel"],
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
            }
        });

        $('#region_id').on('change',function(){

            var regionId = $(this).val();

            $.ajax({
                url: '/regions/' + regionId + '/departements',
                type: 'GET',
                success: function(response) {

                    $('#departement_id').select2('destroy');

                    var options = '<option value="">Sélectionner le département</option>';
                    $.each(response, function(index, departement) {
                        options += '<option value="' + departement.id + '">' + departement.name + '</option>';
                    });
                    $('#departement_id').html(options);
                    $('#departement_id').select2({
                        dropdownParent: $(".bs-modal-center")
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

        });

        $(document).ready(function() {
            $(".select-2-popup").select2({
                dropdownParent: $(".bs-modal-center")
            });
        });


        $('#category_id').on('change',function(){

            var category_id = $(this).val();

            if(category_id!=''){

                $.ajax({
                    url: '/categories/' + category_id,
                    type: 'GET',
                    success: function(response) {

                        $('#quizze_id').select2('destroy');

                        var options = '<option value="">Sélectionner</option>';
                        $.each(response, function(index, quizze) {
                            options += '<option value="' + quizze.id + '">' + quizze.name + '</option>';
                        });

                        $('#quizze_id').html(options);
                        $("#quizze_id").select2({
                            dropdownParent: $(".bs-modal-center")
                        });

                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
            
        });

        $('#departement_id').on('change', function() {
            var departementId = $(this).val();
            $.ajax({
                url: '/departements/' + departementId + '/sous-prefectures',
                type: 'GET',
                success: function(response) {
                    $('#sous_prefecture_id').select2('destroy');
                    var options = '<option value="">Sélectionner la sous-préfecture</option>';
                    $.each(response, function(index, sous_prefecture) {
                        options += '<option value="' + sous_prefecture.id + '">' + sous_prefecture.name + '</option>';
                    });
                    $('#sous_prefecture_id').html(options);
                    $("#sous_prefecture_id").select2({
                        dropdownParent: $(".bs-modal-center")
                    });

                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        $('.add_exploitation').submit(function(e){

            e.preventDefault();

            var form = new FormData($(this)[0]);

            var buttonDefault = $('#add_exploitation').text();
            var button = $('#add_exploitation');

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

                        window.location.reload();
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


    $('#filiere_id').on('change',function(){

        var filiere_id = $(this).val();

        if(filiere_id!=''){

            $.ajax({
                url: '/filieres/' + filiere_id,
                type: 'GET',
                success: function(response) {

                    $('#category_id').select2('destroy');

                    var options = '<option value="">Sélectionner</option>';
                    $.each(response, function(index, filiere) {
                        options += '<option value="' + filiere.id + '">' + filiere.name + '</option>';
                    });

                    $('#category_id').html(options);
                    $("#category_id").select2({
                        dropdownParent: $(".bs-modal-center")
                    });

                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
        
    });

    </script>
    
@endsection 