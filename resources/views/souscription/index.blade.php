@extends('layouts.app')

@section('title', 'Liste des souscriptions')

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Liste des souscriptions</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">souscriptions</a></li>
                                    <li class="breadcrumb-item active">Liste des souscriptions</li>
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
                                            <th>  Numero </th>
                                            <th> Client </th>
                                            <th> Date d'Expiration </th>
                                            <th> Montant de la souscription </th>
                                            <th>Payé</th>
                                            <th>Reste à payé </th>
                                            <th> Fichier  </th>
                                            <th>Action</th>
                                            <th> Email </th>
                                            <th> Téléphone </th>
                                            <th> Formule </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($souscriptions as $souscription)
                                            <tr>
                                                <td>{{$souscription->number_souscriptions}} </td>
                                                <td>
                                                    {{ $souscription->customer->first_name}} 
                                                    {{ $souscription->customer->last_name}}
                                                </td>
                                                <td>{{ date('d/m/Y',strtotime ($souscription->date_of_expiration))}}</td>
                                                <td>{{$souscription->amount_souscription}}</td>
                                                <td>{{$souscription->paid}}</td>
                                                <td>{{$souscription->stay_paid}}</td>
                                                <td>
                                                    @if($souscription->file_souscriptions)
                                                        <a href="{{ route('souscription.downloadFile', $souscription->id) }}" class="btn btn-info btn-sm">
                                                            <i class="ri-download-fill align-middle"></i> 
                                                        </a>
                                                    @endif
                                                </td>

                                                
                                                <td>
                                                    @if(Auth::user()->permission('AJOUT PAIEMENT') || Auth::user()->permission('EDITION SOUSCRIPTION') || Auth::user()->permission('SUPPRESSION SOUSCRIPTION'))
                                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-fill align-middle"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            @if(Auth::user()->permission('AJOUT PAIEMENT'))  
                                                                <li>
                                                                    <a class="dropdown-item edit-item-btn" href="{{route("payment.add",['id' => $souscription->id])}}">
                                                                        <i class="ri-add-circle-line align-bottom me-2 text-muted"></i> 
                                                                        Ajouter un paiement
                                                                    </a>
                                                                </li>
                                                            @endif
                                                            @if(Auth::user()->permission('EDITION SOUSCRIPTION'))  
                                                                <li>
                                                                    <a class="dropdown-item edit-item-btn" href="{{route('souscription.edit',[$souscription->id])}}">
                                                                        <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> 
                                                                        Modifier
                                                                    </a>
                                                                </li>
                                                            @endif

                                                            @if(Auth::user()->permission('SUPPRESSION SOUSCRIPTION'))   
                                                                <li>
                                                                    <a href="javascript:void(0);" onclick="deleted('{{$souscription->id}}','{{route('souscription.delete')}}')" class="dropdown-item remove-item-btn">
                                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted" ></i> Supprimer
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    @endif
                                                </td>
                                                <td>{{$souscription->customer->email}}</td>
                                                <td>{{$souscription->customer->phone_number}}</td>
                                                <td>{{$souscription->formule}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <ul class="pagination pagination-separated justify-content-center mb-0">
                                    @if ($souscriptions->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a href="{{ $souscriptions->previousPageUrl() }}" class="page-link" rel="prev"><i class="mdi mdi-chevron-left"></i></a>
                                        </li>
                                    @endif
                        
                                    @foreach ($souscriptions->getUrlRange(1, $souscriptions->lastPage()) as $page => $url)
                                        @if ($page == $souscriptions->currentPage())
                                            <li class="page-item active">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                        
                                    @if ($souscriptions->hasMorePages())
                                        
                                        <li class="page-item">
                                            <a href="{{ $souscriptions->nextPageUrl() }}" class="page-link" rel="next"><i class="mdi mdi-chevron-right"></i></a>
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