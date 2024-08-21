@extends('layouts.app')

@section('title', 'Liste des paiements')

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Liste des paiements</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">paiements</a></li>
                                    <li class="breadcrumb-item active">Liste des paiements</li>
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
                                            <th>  Référence </th>
                                            <th>  Mode de Paiement  </th>
                                            <th> Clients </th>
                                            <th> Email  </th>
                                            <th> Date du paiement  </th>
                                            <th>Montant </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payments as $payment)
                                            <tr>
                                                <td>{{$payment->ref_payment}} </td>
                                                <td>{{$payment->mode_payment}}</td>
                                                <td>
                                                    {{ $payment->customer->first_name}} 
                                                    {{ $payment->customer->last_name}}
                                                </td>
                                                <td>{{$payment->customer->email}}</td>
                                                <td>{{date('d/m/Y',strtotime ($payment->date_payment))}}</td>
                                                <td>{{$payment->amount}} FCFA </td>
                                                
                                                <td>
                                                    @if(Auth::user()->permission('EDITION PAIEMENT') || Auth::user()->permission('SUPPRESSION PAIEMENT'))
                                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-fill align-middle"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end"> 
                                                            @if(Auth::user()->permission('EDITION PAIEMENT'))      
                                                                <li>
                                                                    <a class="dropdown-item edit-item-btn" href="{{route('payment.edit',[$payment->id])}}"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Modifier</a>
                                                                </li>
                                                            @endif

                                                            @if(Auth::user()->permission('SUPPRESSION PAIEMENT')) 
                                                                <li>
                                                                    <a href="javascript:void(0);" onclick="deleted('{{$payment->id}}','{{route('souscription.delete')}}')" class="dropdown-item remove-item-btn">
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
                                    @if ($payments->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a href="{{ $payments->previousPageUrl() }}" class="page-link" rel="prev"><i class="mdi mdi-chevron-left"></i></a>
                                        </li>
                                    @endif
                        
                                    @foreach ($payments->getUrlRange(1, $payments->lastPage()) as $page => $url)
                                        @if ($page == $payments->currentPage())
                                            <li class="page-item active">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                        
                                    @if ($payments->hasMorePages())
                                        <li class="page-item">
                                            <a href="{{ $payments->nextPageUrl() }}" class="page-link" rel="next"><i class="mdi mdi-chevron-right"></i></a>
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