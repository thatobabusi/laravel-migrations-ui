@extends('migrations-ui::_layout')

@section('title', 'Migrations')

@section('content')
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-xl">

                <div class="card shadow-sm mb-3">
                    <h6 class="card-header bg-secondary text-white" style="padding-left: 0.80em; padding-right: 0.80em;">
                        Migrations
                    </h6>
                    <table class="table table-hover bg-white mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Date / Time</th>
                                <th scope="col">Name</th>
                                <th scope="col">Status</th>
                                {{--<th scope="col" class="align-middle font-weight-normal text-muted text-right">
                                    <a href="#" class="btn btn-sm btn-primary font-weight-bold" style="width: 5.5em;">
                                        New
                                    </a>
                                </th>--}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($migrations as $migration)
                                <tr>
                                    <td class="align-middle">
                                        @if ($migration->date)
                                            {{ $migration->date->format('Y-m-d H:i:s') }}
                                        @else
                                            <span class="text-muted">(Unknown)</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        {{--<a href="#">{{ $migration->name }}</a>--}}
                                        {{ $migration->name }}
                                        @if (!$migration->file)
                                            <span class="badge badge-danger">File Missing!</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        @if ($migration->batch)
                                            <span class="badge badge-pill badge-success">Applied &ndash; Batch {{ $migration->batch }}</span>
                                        @else
                                            <span class="badge badge-pill badge-warning">Pending</span>
                                        @endif
                                    </td>
                                    {{--<td class="align-middle text-right">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-success dropdown-toggle" style="width: 5.5em;" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Apply
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton1">
                                                <a class="dropdown-item" href="#">Single Migration</a>
                                                <a class="dropdown-item" href="#">All New Migrations</a>
                                            </div>
                                        </div>
                                    </td>--}}
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <em>No migrations found.</em>
                                    </td>
                                </tr>
                            @endif
                            {{--<tr>
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
                            </tr>--}}
                        </tbody>
                    </table>
                </div>

                {{--<nav aria-label="Page navigation example">
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
                </nav>--}}

            </div>
            {{--<div class="col-xl-4">

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
                            <tr>
                                <th scope="col" style="font-weight: 500;">
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
                                    <a href="#">password_resets</a>
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
                                    <a href="#">users</a>
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

            </div>--}}
        </div>
    </div>
@endsection
