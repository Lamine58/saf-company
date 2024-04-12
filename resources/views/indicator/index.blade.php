@extends('layouts.app')

@section('title', "Liste des indicateurs")

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Liste des quesions : {{$quizze->value_chain->name}} {{$quizze->category->name}}</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Indicateurs</a></li>
                                    <li class="breadcrumb-item active">Liste des indicateurs</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @if(Auth::user()->permission('AJOUT QUESTION'))
                                    <a class="btn btn-primary" href="{{route('indicator.add',['ajouter',$quizze->id])}}"><i class="ri-add-fill"></i> Ajouter une question</a>
                                @endif
                                <table id="table" class="table table-bordered dt-responsive  table-striped align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Question</th>
                                            <th>Type de reponse</th>
                                            <th>Méthode de collect</th>
                                            <th>Unité</th>
                                            <th>Periodicité</th>
                                            <th>Administrateur</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($indicators as $indicator)
                                            <tr>
                                                <td>{{$indicator->question}}</td>
                                                <td>{{$indicator->type}}</td>
                                                <td>{{$indicator->method->name}}</td>
                                                <td>{{$indicator->unity->name}}</td>
                                                <td>{{$indicator->periodicity->name}}</td>
                                                <td>{{$indicator->user->first_name}} {{$indicator->user->last_name}}</td>
                                                <td>
                                                    
                                                    <div class="dropdown d-inline-block">
                                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-fill align-middle"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                             @if(Auth::user()->permission('EDITION QUESTION'))
                                                                <li>
                                                                    <a class="dropdown-item edit-item-btn" href="{{route('indicator.add',[$indicator->id,$indicator->quizze_id])}}"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Modifier</a>
                                                                </li>
                                                            @endif
                                                            @if(Auth::user()->permission('SUPPRESSION QUESTION'))
                                                                <li>
                                                                    <a href="javascript:void(0);" onclick="deleted('{{$indicator->id}}','{{route('indicator.delete')}}')" class="dropdown-item remove-item-btn">
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
                            </div>
                            <div>
                                <ul class="pagination pagination-separated justify-content-center mb-0">
                                    @if ($indicators->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a href="{{ $indicators->previousPageUrl() }}" class="page-link" rel="prev"><i class="mdi mdi-chevron-left"></i></a>
                                        </li>
                                    @endif
                        
                                    @foreach ($indicators->getUrlRange(1, $indicators->lastPage()) as $page => $url)
                                        @if ($page == $indicators->currentPage())
                                            <li class="page-item active">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                        
                                    @if ($indicators->hasMorePages())
                                        <li class="page-item">
                                            <a href="{{ $indicators->nextPageUrl() }}" class="page-link" rel="next"><i class="mdi mdi-chevron-right"></i></a>
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
    </script>
@endsection 