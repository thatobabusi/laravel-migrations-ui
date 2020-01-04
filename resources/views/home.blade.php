@extends('migrations-ui::_layout')

@section('title', 'Migrations')

@section('navbar-right')
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}">Back to Application</a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-xl">

                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-secondary text-white" style="line-height: 1.2; padding-left: 0.80em; padding-right: 0.80em;">
                        <a href="https://laravel.com/docs/migrations" target="_blank" class="float-right text-white">
                            <i class="fas fa-question-circle" aria-hidden="true"></i>
                            Laravel Docs
                        </a>
                        <h6 class="m-0">Migrations</h6>
                    </div>
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
                                <tr class="{{ $migration->file ? '' : 'table-danger' }}">
                                    <td class="align-middle">
                                        @if ($migration->date)
                                            {{ $migration->date->format('Y-m-d H:i:s') }}
                                        @else
                                            <span class="text-muted">(Unknown)</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        {{--<a href="#">{{ $migration->title }}</a>--}}
                                        {{ $migration->title }}
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
                            @endforelse
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
            <div class="col-xl-4">

                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white" style="line-height: 1.2; padding-left: 0.80em; padding-right: 0.80em;">
                        {{--<div class="float-right" style="margin: -6px 0;">
                            <span data-toggle="modal" data-target="#exampleModal2">
                                <button class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Switch Database">
                                    <i class="fas fa-fw fa-database" aria-hidden="true"></i>
                                </button>
                            </span>
                        </div>--}}
                        <span data-toggle="modal" data-target="#exampleModal2">
                            <span style="cursor: default;" data-toggle="tooltip" data-placement="top" title="Connection">
                                <i class="fa fa-plug mr-1" aria-hidden="true"></i>
                                {{ $connection }}
                            </span>
                            <span style="cursor: default;" data-toggle="tooltip" data-placement="top" title="Database" class="ml-3">
                                <i class="fa fa-database mr-1" aria-hidden="true"></i>
                                {{ $database }}
                            </span>
                        </span>
                    </div>
                    <table class="table table-hover bg-white mb-0">
                        <thead>
                            <tr>
                                <th scope="col">
                                    Tables
                                </th>
                                {{--<th scope="col" class="align-middle font-weight-normal text-muted text-right">
                                    <button class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="New Migration: Create Table">
                                        <i class="fas fa-fw fa-plus" aria-hidden="true"></i>
                                    </button>
                                </th>--}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tables as $table)
                                <tr>
                                    <td class="align-middle">
                                        {{--<a href="#">{{ $table }}</a>--}}
                                        {{ $table }}
                                    </td>
                                    {{--<td class="align-middle text-right">
                                        <button class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="View Structure">
                                            <i class="fas fa-fw fa-search" aria-hidden="true"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="New Migration: Modify">
                                            <i class="fas fa-fw fa-pen" aria-hidden="true"></i>
                                        </button>
                                        <button class="btn btn-sm btn-secondary" data-toggle="tooltip" data-placement="top" title="New Migration: Rename">
                                            <i class="fas fa-fw fa-i-cursor" aria-hidden="true"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="New Migration: Drop">
                                            <i class="fas fa-fw fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </td>--}}
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="1"><em>No tables found.</em></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
