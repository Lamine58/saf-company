@extends('layouts.app')

@section('title', 'Liste des filières')

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Liste des filières</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Liste des filières</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                @if(Auth::user()->permission('AJOUT FILIERE'))
                                    <form class="row py-2 add" action="{{route('filiere.save')}}">
                                        @csrf
                                        <div class="col-md-3">
                                            <input name="name" required type="text" class="form-control" placeholder="Libellé">
                                        </div>
                                        <div class="col-md-3">
                                            <button id="add" class="btn btn-primary">Ajouter <i class="ri-add-line"></i></button>
                                        </div>
                                    </form>
                                @endif
                        
                                <table id="table" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Filière</th>
                                            <th>Type</th>
                                            <th>Administrateur</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($filieres as $filiere)
                                            <tr>
                                                <td>{{$filiere->name}}</td>
                                                <td>
                                                    <table class="table table-bordered dt-responsive nowrap table-striped align-middle">
                                                        @foreach(($filiere->categories ?? []) as $category)
                                                            <tr>
                                                                <td>{{$category->name}}</td>
                                                                <td>
                                                                    @if(Auth::user()->permission("LISTE CHAINE DE VALEUR D'UNE CATEGORIE"))
                                                                        <a href="{{route('quizze.index',[$category->id])}}" class="btn btn-primary btn-sm">Chaînes de valeur</a>
                                                                    @endif
                                                                   @if(Auth::user()->permission('SUPPRESSION CATEGORIE')) 
                                                                        <div class="dropdown d-inline-block">
                                                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                <i class="ri-more-fill align-middle"></i>
                                                                            </button>
                                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                                <li>
                                                                                    <a href="javascript:void(0);" onclick="deleted('{{$category->id}}','{{route('category.delete')}}')" class="dropdown-item remove-item-btn">
                                                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted" ></i> Supprimer
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </td>
                                                <td>{{$filiere->user->first_name}} {{$filiere->user->last_name}}</td>
                                                <td>
                                                    @if(Auth::user()->permission('SUPPRESSION TYPE FILIERE') || Auth::user()->permission('AJOUT TYPE FILIERE'))
                                                        <div class="dropdown d-inline-block">
                                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="ri-more-fill align-middle"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                @if(Auth::user()->permission('AJOUT CATEGORIE'))
                                                                    <li>
                                                                        <a href="javascript:void(0);" data-bs-toggle="modal" onclick="filiere_select('{{$filiere->id}}')" data-bs-target=".bs-modal-center" class="dropdown-item remove-item-btn">
                                                                            <i class="ri-add-fill align-bottom me-2 text-muted" ></i> Ajouter un type
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                                @if(Auth::user()->permission('SUPPRESSION METHODE'))
                                                                    <li>
                                                                        <a href="javascript:void(0);" onclick="deleted('{{$filiere->id}}','{{route('filiere.delete')}}')" class="dropdown-item remove-item-btn">
                                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted" ></i> Supprimer
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <ul class="pagination pagination-separated justify-content-center mb-0">
                                    @if ($filieres->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a href="{{ $filieres->previousPageUrl() }}" class="page-link" rel="prev"><i class="mdi mdi-chevron-left"></i></a>
                                        </li>
                                    @endif
                        
                                    @foreach ($filieres->getUrlRange(1, $filieres->lastPage()) as $page => $url)
                                        @if ($page == $filieres->currentPage())
                                            <li class="page-item active">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                        
                                    @if ($filieres->hasMorePages())
                                        <li class="page-item">
                                            <a href="{{ $filieres->nextPageUrl() }}" class="page-link" rel="next"><i class="mdi mdi-chevron-right"></i></a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="mdi mdi-chevron-right"></i></span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <br>
                        </div>
                    </div><!--end col-->
                    
                </div><!--end row-->

            </div>
            <!-- container-fluid -->
            
        </div>
        <!-- End Page-content -->
        

        @if(Auth::user()->permission('AJOUT TYPE FILIERE'))
            <div class="modal fade bs-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <form class="modal-dialog  modal-lg modal-dialog-centered add_category" action="{{route('category.save')}}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>Ajouter un type</h3>
                        </div>
                        <div class="modal-body" style="padding:2rem!important">
                            <input type="hidden" name="filiere_id" id="filiere_id">
                            <div class="col-md-12">
                                <div class="row g-3">
                                    <div class="col-lg-12">
                                        <div>
                                            <label class="form-label">Libellé</label>
                                            <input type="text" name="name" placeholder="Libellé" class="form-control rounded-end" />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div>
                                            <label class="form-label">Description</label>
                                            <textarea name="description" id="description" class="form-control rounded-end" name="description" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="hstack gap-2 justify-content-center">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                                    <button class="btn btn-primary" id="add_category">Enregister</button>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </form><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        @endif

@endsection

@section('script')
    <script>

        function filiere_select(id){
            $('#filiere_id').val(id);
        }

        new DataTable("#table", {
            dom: "Bfrtip",
            paging:false,
            buttons: ["excel"],
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
            }
        });
        
        $('.add').submit(function(e){

            e.preventDefault();

            var form = new FormData($(this)[0]);

            var buttonDefault = $('#add').text();
            var button = $('#add');

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


        $('.add_category').submit(function(e){

            e.preventDefault();

            var form = new FormData($(this)[0]);

            var buttonDefault = $('#add_category').text();
            var button = $('#add_category');

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

    </script>
@endsection 