@extends('migrations-ui::layout')

@section('title', 'Migrations')

@section('content')
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-xl">

                <div class="card shadow-sm mb-3">
                    <table class="table table-hover bg-white mb-0">
                        <thead>
                            <tr class="bg-light">
                                <th scope="col" class="align-middle font-weight-normal text-muted text-uppercase">Date / Time</th>
                                <th scope="col" class="align-middle font-weight-normal text-muted text-uppercase">Name</th>
                                <th scope="col" class="align-middle font-weight-normal text-muted text-uppercase">Status</th>
                                <th scope="col" class="align-middle font-weight-normal text-muted text-right">
                                    <a href="{{ route('migrations-ui.create') }}" class="btn btn-sm btn-primary font-weight-bold" style="width: 5.5em;">
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
                                    <a href="#">create posts table</a>
                                </td>
                                <td class="align-middle">
                                    <span class="badge badge-pill badge-warning">New</span>
                                </td>
                                <td class="align-middle text-right">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-success dropdown-toggle" style="width: 5.5em;" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Apply
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton1">
                                            <a class="dropdown-item" href="#">Single Migration</a>
                                            <a class="dropdown-item" href="#">All New Migrations</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle">
                                    2014-10-12 10:00:00
                                </td>
                                <td class="align-middle">
                                    <a href="#">create password resets table</a>
                                </td>
                                <td class="align-middle">
                                    <span class="badge badge-pill badge-success">Applied &ndash; Batch 1</span>
                                </td>
                                <td class="align-middle text-right">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-danger dropdown-toggle" style="width: 5.5em;" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Revert
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton2">
                                            <a class="dropdown-item" href="#">Single Migration</a>
                                            <a class="dropdown-item" href="#">Batch 1</a>
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
                                    <span class="badge badge-pill badge-success">Applied &ndash; Batch 1</span>
                                </td>
                                <td class="align-middle text-right">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" style="width: 5.5em;" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Fix
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton1">
                                            <a class="dropdown-item" href="#">Recreate File</a>
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
                    <table class="table table-hover bg-white mb-0">
                        <thead>
                            <tr class="bg-light">
                                <th scope="col" class="align-middle" style="font-weight: 500;">
                                    Tables
                                </th>
                                <th scope="col" class="align-middle font-weight-normal text-muted text-right">
                                    <button class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="New Migration: Create Table">
                                        <i class="fas fa-fw fa-plus"></i>
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="align-middle">
                                    password_resets
                                </td>
                                <td class="align-middle text-right">
                                    <button class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="View Structure">
                                        <i class="fas fa-fw fa-search"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="New Migration: Modify">
                                        <i class="fas fa-fw fa-pen"></i>
                                    </button>
                                    <button class="btn btn-sm btn-secondary" data-toggle="tooltip" data-placement="top" title="New Migration: Rename">
                                        <i class="fas fa-fw fa-i-cursor"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="New Migration: Drop">
                                        <i class="fas fa-fw fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle">
                                    users
                                </td>
                                <td class="align-middle text-right">
                                    <button class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="View Structure">
                                        <i class="fas fa-fw fa-search"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="New Migration: Modify">
                                        <i class="fas fa-fw fa-pen"></i>
                                    </button>
                                    <button class="btn btn-sm btn-secondary" data-toggle="tooltip" data-placement="top" title="New Migration: Rename">
                                        <i class="fas fa-fw fa-i-cursor"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="New Migration: Drop">
                                        <i class="fas fa-fw fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
