@extends('layouts.app')

@section('title', 'Liste des rôles')

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Liste des rôles</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Rôles</a></li>
                                    <li class="breadcrumb-item active">Liste des rôles</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    @if(Auth::user()->permission('AJOUT ROLE'))
                        <div class="col-lg-12 py-3">
                            <a class="btn btn-primary" href="{{route('role.add',['ajouter'])}}">Ajouter un rôle <i class="ri-add-line"></i></a>
                        </div>
                    @endif
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="table" class="table table-bordered dt-responsive table-striped align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Rôle</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $role)
                                            <tr>
                                                <td>{{$role->name}}</td>
                                                <td style="text-align:end">
                                                    
                                                    @if(Auth::user()->permission('AJOUT ROLE'))
                                                        <a href="{{route('role.permissions',[$role->id])}}" class="btn btn-primary btn-sm">Permissions</a>
                                                    @endif
                                                    
                                                    <div class="dropdown d-inline-block">
                                                        @if(Auth::user()->permission('EDITION ROLE') || Auth::user()->permission('SUPPRESSION ROLE'))
                                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="ri-more-fill align-middle"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                @if(Auth::user()->permission('EDITION ROLE'))
                                                                    <li>
                                                                        <a class="dropdown-item edit-item-btn" href="{{route('role.add',[$role->id])}}"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Modifier</a>
                                                                    </li>
                                                                @endif
                                                                @if(Auth::user()->permission('SUPPRESSION ROLE'))
                                                                    <li>
                                                                        <a href="javascript:void(0);" onclick="deleted('{{$role->id}}','{{route('role.delete')}}')" class="dropdown-item remove-item-btn">
                                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted" ></i> Supprimer
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <ul class="pagination pagination-separated justify-content-center mb-0">
                                    @if ($roles->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a href="{{ $roles->previousPageUrl() }}" class="page-link" rel="prev"><i class="mdi mdi-chevron-left"></i></a>
                                        </li>
                                    @endif
                        
                                    @foreach ($roles->getUrlRange(1, $roles->lastPage()) as $page => $url)
                                        @if ($page == $roles->currentPage())
                                            <li class="page-item active">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                        
                                    @if ($roles->hasMorePages())
                                        <li class="page-item">
                                            <a href="{{ $roles->nextPageUrl() }}" class="page-link" rel="next"><i class="mdi mdi-chevron-right"></i></a>
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