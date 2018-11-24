@extends('migrations-ui::wireframes.layout')

@section('title', 'Migrations')

@section('navbar-right')
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="#" class="text-light" data-toggle="modal" data-target="#exampleModal3">
                Licensed to
                <strong>Dave James Miller</strong>
                (1 User)
            </a>
        </li>
        {{--<li class="nav-item">
            <a href="#" class="btn btn-danger">
                <strong>Buy Now</strong>
                <i class="fas fa-external-link-alt ml-1"></i>
            </a>
            <a href="#" class="btn btn-success">
                Enter License
            </a>
        </li>--}}
    </ul>
@endsection

@section('content')
    <div class="row mt-3">
        <div class="col-xl">

            <div class="card shadow-sm mb-3">
                <h6 class="card-header bg-secondary text-white" style="padding-left: 0.80em; padding-right: 0.80em;">
                    Migrations
                </h6>
                <table class="table table-hover bg-white mb-0">
                    <thead>
                        <tr class="bg-light">
                            <th scope="col" class="align-middle font-weight-normal text-muted text-uppercase">Date / Time</th>
                            <th scope="col" class="align-middle font-weight-normal text-muted text-uppercase">Name</th>
                            <th scope="col" class="align-middle font-weight-normal text-muted text-uppercase">Status</th>
                            <th scope="col" class="align-middle font-weight-normal text-muted text-right">
                                <a href="{{ route('migrations-ui.wireframes.create') }}" class="btn btn-sm btn-primary font-weight-bold" style="width: 5.5em;" data-toggle="modal" data-target="#exampleModal1">
                                    New
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="align-middle">
                                2018-11-02 23:57:21
                            </td>
                            <td class="align-middle">
                                <a href="#" data-toggle="modal" data-target="#showMigrationModal">create posts table</a>
                            </td>
                            <td class="align-middle">
                                <a href="#" class="badge badge-pill badge-warning">Pending</a>
                            </td>
                            <td class="align-middle text-right">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-success dropdown-toggle" style="width: 5.5em;" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Apply
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton1">
                                        <a class="dropdown-item" href="#">This Migration</a>
                                        <a class="dropdown-item" href="#">All Pending Migrations</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">
                                2014-10-12 10:00:00
                            </td>
                            <td class="align-middle">
                                <a href="#" data-toggle="modal" data-target="#showMigrationModal">create password resets table</a>
                            </td>
                            <td class="align-middle">
                                <a href="#" class="badge badge-pill badge-success">Applied &ndash; Batch 1</a>
                            </td>
                            <td class="align-middle text-right">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-danger dropdown-toggle" style="width: 5.5em;" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Revert
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton2">
                                        <a class="dropdown-item" href="#">This Migration</a>
                                        <a class="dropdown-item" href="#">Batch 1</a>
                                        <a class="dropdown-item" href="#">All Migrations</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="table-danger">
                            <td class="align-middle">
                                2014-10-12 00:00:00
                            </td>
                            <td class="align-middle">
                                create users table
                                <span class="badge badge-danger">File Missing!</span>
                            </td>
                            <td class="align-middle">
                                <a href="#" class="badge badge-pill badge-success">Applied &ndash; Batch 1</a>
                            </td>
                            <td class="align-middle text-right">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-secondary dropdown-toggle" style="width: 5.5em;" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Fix
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton1">
                                        {{--<a class="dropdown-item" href="#">Recreate File</a>--}}
                                        <a class="dropdown-item" href="#">Update Filename</a>
                                        <a class="dropdown-item" href="#">Delete Record</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>

        </div>
        <div class="col-xl-4">

            <div class="card shadow-sm">
                <h6 class="card-header bg-secondary text-white" style="padding-left: 0.80em; padding-right: 0.80em;">
                    <div class="float-right" style="margin: -6px 0;">
                        <span data-toggle="modal" data-target="#exampleModal2">
                            <button class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Switch Database">
                                <i class="fas fa-fw fa-database"></i>
                            </button>
                        </span>
                    </div>
                    <span data-toggle="modal" data-target="#exampleModal2">
                        <span style="cursor: default;" data-toggle="tooltip" data-placement="top" title="Connection">
                            <i class="fa fa-plug mr-1"></i>
                            <tt style="font-size: 1.3rem; line-height: 1.1;">mysql</tt>
                        </span>
                        <span style="cursor: default;" data-toggle="tooltip" data-placement="top" title="Database" class="ml-3">
                            <i class="fa fa-database mr-1"></i>
                            <tt style="font-size: 1.3rem; line-height: 1.1;">forge</tt>
                        </span>
                    </span>
                </h6>
                <table class="table table-hover bg-white mb-0">
                    <thead>
                        <tr class="bg-light">
                            <th scope="col" class="align-middle font-weight-normal text-muted text-uppercase" style="font-weight: 500;">
                                Tables
                            </th>
                            <th scope="col" class="align-middle font-weight-normal text-muted text-right">
                                <a href="{{ route('migrations-ui.wireframes.create.step2') }}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="New Migration: Create Table">
                                    <i class="fas fa-fw fa-plus"></i>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="align-middle">
                                <a href="#">password_resets</a>
                            </td>
                            <td class="align-middle text-right">
                                <button class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="View Structure">
                                    <i class="fas fa-fw fa-search"></i>
                                </button>
                                <a href="{{ route('migrations-ui.wireframes.create.step2') }}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="New Migration: Modify">
                                    <i class="fas fa-fw fa-pencil-alt"></i>
                                </a>
                                <a href="{{ route('migrations-ui.wireframes.create.step2') }}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="New Migration: Drop">
                                    <i class="fas fa-fw fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">
                                <a href="#">users</a>
                            </td>
                            <td class="align-middle text-right">
                                <button class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="View Structure">
                                    <i class="fas fa-fw fa-search"></i>
                                </button>
                                <a href="{{ route('migrations-ui.wireframes.create.step2') }}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="New Migration: Modify">
                                    <i class="fas fa-fw fa-pencil-alt"></i>
                                </a>
                                <a href="{{ route('migrations-ui.wireframes.create.step2') }}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="New Migration: Drop">
                                    <i class="fas fa-fw fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection

@section('footer')
    @include('migrations-ui::wireframes.index.modal-inconsistent-state')
    @include('migrations-ui::wireframes.index.modal-change-database')
    @include('migrations-ui::wireframes.index.modal-license')
    @include('migrations-ui::wireframes.index.modal-show-migration')
@endsection
