@extends('layouts.app')

@section('title', "Liste des types d'assurances")

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Liste des types d'assurances</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Type d'assurance</a></li>
                                    <li class="breadcrumb-item active">Liste des types d'assurances</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @if(Auth::user()->permission('AJOUT TYPE D\'ASSURANCE'))
                                    <form class="row py-2 add" action="{{route('insurance.save')}}">
                                        @csrf
                                        <div class="col-md-2">
                                            <input name="name" required type="text" class="form-control" placeholder="Ajouter un type">
                                        </div>
                                        <div class="col-md-2">
                                            <input name="rate" required type="number" class="form-control" placeholder="Taux">
                                        </div>
                                        <div class="col-md-3">
                                            <button id="add" class="btn btn-primary">Ajouter <i class="ri-add-line"></i></button>
                                        </div>
                                    </form>
                                @endif
                                <table id="table-insurance" class="table table-bordered dt-responsive table-striped align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Type d'assurance</th>
                                            <th>Taux</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($insurances as $insurance)
                                            <tr>
                                                <td>{{$insurance->name}}</td>
                                                <td>{{$insurance->rate}}%</td>
                                                <td>
                                                    @if(Auth::user()->permission('SUPPRESSION TYPE D\'ASSURANCE'))
                                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-fill align-middle"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            @if(Auth::user()->permission('SUPPRESSION TYPE D\'ASSURANCE'))
                                                                <li>
                                                                    <a href="javascript:void(0);" onclick="deleted('{{$insurance->id}}','{{route('insurance.delete')}}')" class="dropdown-item remove-item-btn">
                                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted" ></i> Supprimer
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <table id="table" class="table table-bordered dt-responsive table-striped align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Banière</th>
                                            <th>Maison d'assurance</th>
                                            <th>Type d'assurance</th>
                                            <th>Nombre de formule</th>
                                            <th>Nombre de condition</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($insurance_types as $insurance_type)
                                            <tr>
                                                <td><img width="70" src="{{ $insurance_type->banner!='' ? Storage::url($insurance_type->banner) : asset('/assets/images/post-placeholder.jpg')}}" alt=""></td>
                                                <td>{{$insurance_type->name}}</td>
                                                <td>{{$insurance_type->insurance->name}}</td>
                                                <td>{{count(json_decode($insurance_type->formules))}}</td>
                                                <td>{{count(json_decode($insurance_type->conditions))}}</td>
                                                <td>
                                                    @if(Auth::user()->permission('EDITION TYPE D\'ASSURANCE') || Auth::user()->permission('SUPPRESSION TYPE D\'ASSURANCE'))
                                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-fill align-middle"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            @if(Auth::user()->permission('EDITION TYPE D\'ASSURANCE'))
                                                                <li>
                                                                    <a class="dropdown-item edit-item-btn" href="{{route('insurance-type.add',[$insurance_type->id])}}"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Modifier</a>
                                                                </li>
                                                            @endif
                                                            @if(Auth::user()->permission('SUPPRESSION TYPE D\'ASSURANCE'))
                                                                <li>
                                                                    <a href="javascript:void(0);" onclick="deleted('{{$insurance_type->id}}','{{route('insurance-type.delete')}}')" class="dropdown-item remove-item-btn">
                                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted" ></i> Supprimer
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <ul class="pagination pagination-separated justify-content-center mb-0">
                                    @if ($insurance_types->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a href="{{ $insurance_types->previousPageUrl() }}" class="page-link" rel="prev"><i class="mdi mdi-chevron-left"></i></a>
                                        </li>
                                    @endif
                        
                                    @foreach ($insurance_types->getUrlRange(1, $insurance_types->lastPage()) as $page => $url)
                                        @if ($page == $insurance_types->currentPage())
                                            <li class="page-item active">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                        
                                    @if ($insurance_types->hasMorePages())
                                        <li class="page-item">
                                            <a href="{{ $insurance_types->nextPageUrl() }}" class="page-link" rel="next"><i class="mdi mdi-chevron-right"></i></a>
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


@endsection

@section('script')
    <script>
        new DataTable("#table", {
            dom: "Bfrtip",
            paging:false,
            buttons: ["excel"],
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
            }
        });

        new DataTable("#table-insurance", {
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
    </script>
@endsection 