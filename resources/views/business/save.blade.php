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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Fournisseurs</a></li>
                                <li class="breadcrumb-item active">{{$title}}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{route('business.save')}}" class="add_business">
                @csrf
                <input type="hidden" name="id" value="{{$business->id}}">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="file" name="logo" class="dropify-logo" data-default-file="{{$business->logo!=null ? Storage::url($business->logo) : ''}}">
                                    </div>
                                    <div class="col-md-10">
                                        <div class="row g-3">
                                            <div class="col-lg-6">
                                                <div>
                                                    <label class="form-label">Raison sociale</label>
                                                    <input type="text" name="legal_name" value="{{$business->legal_name}}" required class="form-control rounded-end" />
                                                </div>
                                                <div class="mt-1">
                                                    <label class="form-label">Téléphone</label>
                                                    <input type="text" name="phone" value="{{$business->phone}}" class="form-control phone rounded-end" />
                                                </div>
                                                <div class="mt-2">
                                                    <label class="form-label">Email</label>
                                                    <input type="text" name="email" value="{{$business->email}}" class="form-control rounded-end" />
                                                </div>
                                                <div class="mt-2">
                                                    <label class="form-label">Localisation</label>
                                                    <input type="text" name="location" value="{{$business->location}}" class="form-control rounded-end" />
                                                </div>
                                                <div class="mt-2">
                                                    <label class="form-label">Nom et prénom de l'opérateur</label>
                                                    <input type="text" name="name_of_operator" value="{{$business->name_of_operator}}" class="form-control rounded-end" />
                                                </div>
                                                <div class="mt-2">
                                                    <label class="form-label">Date de naissance</label>
                                                    <input type="date" name="date_of_birth" value="{{$business->date_of_birth}}" class="form-control rounded-end" />
                                                </div>
                                                <div class="mt-2">
                                                    <label class="form-label">Lieu de naissance</label>
                                                    <input type="text" name="place_of_birth" value="{{$business->place_of_birth}}" class="form-control rounded-end" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div>
                                                    <label class="form-label">Filière</label>
                                                    <select id="filiere_id" class="form-control select2" name="filiere_id">
                                                        <option value="">Sélectionner la filière</option>
                                                        @foreach($filieres as $filiere)
                                                            <option value="{{$filiere->id}}" {{$filiere->id==$business->filiere_id ? 'selected' : ''}}>{{$filiere->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mt-1 hidden">
                                                    <label class="form-label">Sélectionner les type pour la filière</label>
                                                    <select id="filiere_ids" multiple class="form-control select-2-popup" name="filiere_ids[]"> 
                                                        @foreach([] as $type_filiere)
                                                            <option value="{{$type_filiere->id}}"  selected >{{$type_filiere->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mt-2">
                                                    <label class="form-label">Région</label>
                                                    <select id="region_id" class="form-control select2" name="region_id">
                                                        <option value="">Sélectionner la région</option>
                                                        @foreach($regions as $region)
                                                            <option value="{{$region->id}}" {{$region->id==$business->region_id ? 'selected' : ''}}>{{$region->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mt-2">
                                                    <label class="form-label">Département</label>
                                                    <select id="departement_id" class="form-control select2" name="departement_id">
                                                        <option value="">Sélectionner le département</option>
                                                        @foreach(($business->region->departements ?? $departements) as $departement)
                                                            <option value="{{$departement->id}}" {{$departement->id==$business->departement_id ? 'selected' : ''}}>{{$departement->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mt-3">
                                                    <label class="form-label">Sous-préfecture</label>
                                                    <select id="sous_prefecture_id" class="form-control select2" name="sous_prefecture_id">
                                                        <option value="">Sélectionner la sous-préfecture</option>
                                                        @foreach(($business->departement->sous_prefectures ?? []) as $sous_prefecture)
                                                            <option value="{{$sous_prefecture->id}}" {{$sous_prefecture->id==$business->sous_prefecture_id ? 'selected' : ''}}>{{$sous_prefecture->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mt-3">
                                                    <label class="form-label">Localité</label>
                                                    <input type="text" name="localite" value="{{$business->localite}}" class="form-control rounded-end" />
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <button id="add_business" class="btn btn-primary btn-block" style="width:100%">Enregistrer</button>
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
</div>

@endsection

@section('css-link')

@endsection

@section('script')

<script>
    
    $('#filiere_id').on('change',function(){

        var filiere_id = $(this).val();

        if(filiere_id!=''){

            $.ajax({
                url: '/filieres/' + filiere_id,
                type: 'GET',
                success: function(response) {

                    $('#filiere_ids').select2('destroy');

                    var options = '<option value=""><option>';
                    $.each(response, function(index, filiere) {
                        options += '<option value="' + filiere.id + '">' + filiere.name + '</option>';
                    });

                    $('#filiere_ids').html(options);
                    $('#filiere_ids').select2();

                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
        
    });

    $('#region_id').on('change', function() {
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
                $('#departement_id').select2();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
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
                $('#sous_prefecture_id').select2();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    $('.add_business').submit(function(e){

        e.preventDefault();

        var form = new FormData($(this)[0]);

        var buttonDefault = $('#add_business').text();
        var button = $('#add_business');

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

                    window.location='{{route("business.index")}}'
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