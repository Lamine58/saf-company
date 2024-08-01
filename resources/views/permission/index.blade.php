@extends('layouts.app')

@section('title', 'Liste des permissions')

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Liste des permissions</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Permissions</a></li>
                                    <li class="breadcrumb-item active">Liste des permissions</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    @if(Auth::user()->permission('AJOUT PERMISSION'))
                        <div class="col-lg-12 py-3">
                            <a class="btn btn-primary" href="{{route('permission.add',['ajouter'])}}">Ajouter une permission <i class="ri-add-line"></i></a>
                        </div>
                    @endif
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="table" class="table table-bordered dt-responsive table-striped align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Permission</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissions as $permission)
                                            <tr>
                                                <td>{{$permission->name}}</td>
                                                <td style="text-align:end">
                                                    <div class="dropdown d-inline-block">
                                                        @if(Auth::user()->permission('EDITION PERMISSION') || Auth::user()->permission('SUPPRESSION PERMISSION'))
                                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="ri-more-fill align-middle"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                @if(Auth::user()->permission('EDITION PERMISSION'))
                                                                    <li>
                                                                        <a class="dropdown-item edit-item-btn" href="{{route('permission.add',[$permission->id])}}"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Modifier</a>
                                                                    </li>
                                                                @endif
                                                                @if(Auth::user()->permission('SUPPRESSION PERMISSION'))
                                                                    <li>
                                                                        <a href="javascript:void(0);" onclick="deleted('{{$permission->id}}','{{route('permission.delete')}}')" class="dropdown-item remove-item-btn">
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
                                    @if ($permissions->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a href="{{ $permissions->previousPageUrl() }}" class="page-link" rel="prev"><i class="mdi mdi-chevron-left"></i></a>
                                        </li>
                                    @endif
                        
                                    @foreach ($permissions->getUrlRange(1, $permissions->lastPage()) as $page => $url)
                                        @if ($page == $permissions->currentPage())
                                            <li class="page-item active">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                        
                                    @if ($permissions->hasMorePages())
                                        <li class="page-item">
                                            <a href="{{ $permissions->nextPageUrl() }}" class="page-link" rel="next"><i class="mdi mdi-chevron-right"></i></a>
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