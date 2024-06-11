@extends('layouts.app')

@section('title', 'Liste des enquêtes '.$type)

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Liste des enquêtes  {{$type}}</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Fournisseurs</a></li>
                                    <li class="breadcrumb-item active">Liste des enquêtes {{$type}}</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="table" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Raison sociale</th>
                                            <th>Catégorire</th>
                                            <th>Chaîne de valeur</th>
                                            <th>Collecteur</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($collections as $collection)
                                            <tr>
                                                <td>{{$collection->business->legal_name}}</td>
                                                <td>{{$collection->category->name}}</td>
                                                <td>{{$collection->value_chain->name}}</td>
                                                <td>{{$collection->user->first_name}} {{$collection->user->last_name}}</td>
                                                <td>
                                                    <div class="dropdown d-inline-block">
                                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-fill align-middle"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            @if(Auth::user()->permission('VOIR ENQUETE'))
                                                                <li>
                                                                    <a class="dropdown-item edit-item-btn" href="{{route('collection.data',[$collection->id])}}"><i class="ri-eye-line align-bottom me-2 text-muted"></i> Voir les données</a>
                                                                </li>
                                                            @endif
                                                            @if($collection->state=='pending')
                                                                @if(Auth::user()->permission('VALIDATION ENQUETE'))
                                                                    <li>
                                                                        <a href="javascript:void(0);" onclick="validate('{{$collection->id}}','{{route('collection.state',['success'])}}')" class="dropdown-item remove-item-btn">
                                                                            <i class="ri-check-line align-bottom me-2 text-muted" ></i> Valider la collecte
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                                @if(Auth::user()->permission('VALIDATION ENQUETE'))
                                                                    <li>
                                                                        <a href="javascript:void(0);" onclick="refund('{{$collection->id}}','{{route('collection.state',['faild'])}}')" class="dropdown-item remove-item-btn">
                                                                            <i class="ri-close-fill align-bottom me-2 text-muted" ></i> Réfuser la collecte
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <ul class="pagination pagination-separated justify-content-center mb-0">
                                    @if ($collections->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a href="{{ $collections->previousPageUrl() }}" class="page-link" rel="prev"><i class="mdi mdi-chevron-left"></i></a>
                                        </li>
                                    @endif
                        
                                    @foreach ($collections->getUrlRange(1, $collections->lastPage()) as $page => $url)
                                        @if ($page == $collections->currentPage())
                                            <li class="page-item active">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                        
                                    @if ($collections->hasMorePages())
                                        <li class="page-item">
                                            <a href="{{ $collections->nextPageUrl() }}" class="page-link" rel="next"><i class="mdi mdi-chevron-right"></i></a>
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

        function validate(id,link){

            Swal.fire({
                html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/cgzlioyf.json" trigger="loop" colors="primary:#30e8bd,secondary:#30e8bd" style="width:100px;height:100px"></lord-icon><div class="mt-4 pt-2 fs-15 mx-5"><h4>Êtes-vous sûr?</h4><p class="text-muted mx-4 mb-0">Voulez vous vraiment valider cette enquête?</p></div></div>',
                showCancelButton: !0,
                confirmButtonClass: "btn btn-primary w-xs me-2 mb-1",
                confirmButtonText: "Oui",
                cancelButtonText: "Non",
                cancelButtonClass: "btn btn-danger w-xs mb-1",
                buttonsStyling: !1,
                showCloseButton: !0
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'GET',
                        url: link,
                        data: {id:id},
                        dataType: 'json',
                        success: function (result){
                            if(result.status=="success"){
                                Toastify({
                                        text: result.message,
                                        duration: 3000, // 3 seconds
                                        gravity: "top", // Position at the top of the screen
                                        backgroundColor: "#0ab39c", // Background color for success
                                        close: true, // Show a close button
                                    }).showToast();
                                setTimeout(() => {
                                window.location.reload();
                                }, 2000);
                            }else{
                                Toastify({
                                    text: result.message,
                                    duration: 3000, // 3 seconds
                                    gravity: "top", // Position at the top of the screen
                                    backgroundColor: "#e75050", // Background color for success
                                    close: true, // Show a close button
                                }).showToast();
                            }
                        },error: function(){
                            Toastify({
                                text: "Une erreur c'est produite",
                                duration: 3000, // 3 seconds
                                gravity: "top", // Position at the top of the screen
                                backgroundColor: "#e75050", // Background color for success
                                close: true, // Show a close button
                            }).showToast();
                        }
                    });
                }
            });
        }

        function refund(id,link){

            Swal.fire({
                html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/usownftb.json" trigger="loop" colors="primary:#30e8bd,secondary:#30e8bd" style="width:100px;height:100px"></lord-icon><div class="mt-4 pt-2 fs-15 mx-5"><h4>Êtes-vous sûr?</h4><p class="text-muted mx-4 mb-0">Voulez vous vraiment rejeter cette enquête?</p></div></div>',
                showCancelButton: !0,
                confirmButtonClass: "btn btn-primary w-xs me-2 mb-1",
                confirmButtonText: "Oui",
                cancelButtonText: "Non",
                cancelButtonClass: "btn btn-danger w-xs mb-1",
                buttonsStyling: !1,
                showCloseButton: !0
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'GET',
                        url: link,
                        data: {id:id},
                        dataType: 'json',
                        success: function (result){
                            if(result.status=="success"){
                                Toastify({
                                        text: result.message,
                                        duration: 3000, // 3 seconds
                                        gravity: "top", // Position at the top of the screen
                                        backgroundColor: "#0ab39c", // Background color for success
                                        close: true, // Show a close button
                                    }).showToast();
                                setTimeout(() => {
                                window.location.reload();
                                }, 2000);
                            }else{
                                Toastify({
                                    text: result.message,
                                    duration: 3000, // 3 seconds
                                    gravity: "top", // Position at the top of the screen
                                    backgroundColor: "#e75050", // Background color for success
                                    close: true, // Show a close button
                                }).showToast();
                            }
                        },error: function(){
                            Toastify({
                                text: "Une erreur c'est produite",
                                duration: 3000, // 3 seconds
                                gravity: "top", // Position at the top of the screen
                                backgroundColor: "#e75050", // Background color for success
                                close: true, // Show a close button
                            }).showToast();
                        }
                    });
                }
            });
        }
    </script>
@endsection 