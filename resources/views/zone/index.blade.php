@extends('layouts.app')

@section('title', 'Liste des zones')

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Liste des zones</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Zones</a></li>
                                    <li class="breadcrumb-item active">Liste des zones</li>
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
                                            <th>Zone</th>
                                            <th>Departement</th>
                                            <th>Description</th>
                                            <th>Administrateur</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($zones as $zone)
                                            <tr>
                                                <td>{{$zone->name}}</td>
                                                <td>{{$zone->departement}}</td>
                                                <td>{{$zone->description}}</td>
                                                <td>{{$zone->user->first_name}} {{$zone->user->last_name}}</td>
                                                <td>
                                                    
                                                    <div class="dropdown d-inline-block">
                                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-fill align-middle"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li>
                                                                <a class="dropdown-item edit-item-btn" href="{{route('zone.add',[$zone->id])}}"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Modifier</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" onclick="deleted('{{$zone->id}}','{{route('zone.delete')}}')" class="dropdown-item remove-item-btn">
                                                                    <i class="ri-delete-bin-fill align-bottom me-2 text-muted" ></i> Supprimer
                                                                </a>
                                                            </li>
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
                                    @if ($zones->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a href="{{ $zones->previousPageUrl() }}" class="page-link" rel="prev"><i class="mdi mdi-chevron-left"></i></a>
                                        </li>
                                    @endif
                        
                                    @foreach ($zones->getUrlRange(1, $zones->lastPage()) as $page => $url)
                                        @if ($page == $zones->currentPage())
                                            <li class="page-item active">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                        
                                    @if ($zones->hasMorePages())
                                        <li class="page-item">
                                            <a href="{{ $zones->nextPageUrl() }}" class="page-link" rel="next"><i class="mdi mdi-chevron-right"></i></a>
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