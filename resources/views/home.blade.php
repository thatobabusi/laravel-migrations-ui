@extends('migrations-ui::_layout')

<?php
/**
 * @var \Illuminate\Support\Collection|\DaveJamesMiller\MigrationsUI\Migration[] $migrations
 */
?>

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
        @include('migrations-ui::_flash')
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
                                <th scope="col" class="align-middle font-weight-normal text-muted text-right">
                                    {{--<a href="#" class="btn btn-sm btn-primary font-weight-bold" style="width: 6em;">
                                        New
                                    </a>--}}
                                    <div class="btn-group">
                                        <a class="btn btn-sm btn-warning" style="width: 5em;" data-method="post" href="{{ route('migrations-ui.fresh', ['seed' => true]) }}">
                                            Fresh
                                        </a>
                                        <button class="btn btn-sm btn-warning dropdown-toggle dropdown-toggle-split" type="button" id="new-migration-dropdown-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="new-migration-dropdown-button">
                                            <a class="dropdown-item" data-method="post" href="{{ route('migrations-ui.fresh') }}">
                                                Fresh
                                                <small class="d-block text-muted">Drop tables &amp; apply all migrations</small>
                                            </a>
                                            <a class="dropdown-item" data-method="post" href="{{ route('migrations-ui.fresh', ['seed' => true]) }}">
                                                Fresh + Seed
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" data-method="post" href="{{ route('migrations-ui.refresh') }}">
                                                Refresh
                                                <small class="d-block text-muted">Rollback &amp; apply all migrations</small>
                                            </a>
                                            <a class="dropdown-item" data-method="post" href="{{ route('migrations-ui.refresh', ['seed' => true]) }}">
                                                Refresh + Seed
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" data-method="post" href="{{ route('migrations-ui.seed') }}">
                                                Seed Only
                                            </a>
                                        </div>
                                    </div>
                                </th>
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
                                        <span data-toggle="tooltip" data-placement="top" title="{{ $migration->relPath() }}">
                                            @if ($migration->file)
                                                <a href="{{ route('migrations-ui.migration-details', $migration) }}" data-toggle="modal" data-target="#migration-popup" data-path="{{ $migration->relPath() }}">
                                                    {{ $migration->title }}
                                                </a>
                                            @else
                                                {{ $migration->title }}
                                                <span class="badge badge-danger">File Missing!</span>
                                            @endif
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        @if ($migration->isApplied())
                                            <span class="badge badge-pill badge-success">Applied &ndash; Batch {{ $migration->batch }}</span>
                                        @else
                                            <span class="badge badge-pill badge-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-right">
                                        <div class="btn-group">
                                            @if ($migration->isMissing())
                                                {{--<a class="btn btn-sm btn-secondary" style="width: 5em;" data-method="post" href="#">
                                                    Fix
                                                </a>
                                                <button class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split" type="button" id="migration-dropdown-button-{{ $loop->index }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="migration-dropdown-button-{{ $loop->index }}">
                                                    <a class="dropdown-item" data-method="post" href="#">Recreate File</a>
                                                    <a class="dropdown-item" data-method="post" href="#">Update Filename</a>
                                                    <a class="dropdown-item" data-method="post" href="#">Delete Record</a>
                                                </div>--}}
                                            @elseif ($migration->isApplied())
                                                <a class="btn btn-sm btn-danger" style="width: 5em;" data-method="post" href="{{ route('migrations-ui.rollback', $migration) }}">
                                                    Rollback
                                                </a>
                                                <button class="btn btn-sm btn-danger dropdown-toggle dropdown-toggle-split" type="button" id="migration-dropdown-button-{{ $loop->index }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton2">
                                                    <a class="dropdown-item" data-method="post" href="{{ route('migrations-ui.rollback', $migration) }}">
                                                        Rollback This Migration
                                                    </a>
                                                    <a class="dropdown-item" data-method="post" href="{{ route('migrations-ui.rollback-batch', $migration->batch) }}">
                                                        Rollback Batch {{ $migration->batch }}
                                                    </a>
                                                    <a class="dropdown-item" data-method="post" href="{{ route('migrations-ui.rollback-all') }}">
                                                        Rollback All
                                                    </a>
                                                </div>
                                            @else
                                                <a class="btn btn-sm btn-success" style="width: 5em;" data-method="post" href="{{ route('migrations-ui.apply', $migration) }}">
                                                    Apply
                                                </a>
                                                <button class="btn btn-sm btn-success dropdown-toggle dropdown-toggle-split" type="button" id="migration-dropdown-button-{{ $loop->index }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="migration-dropdown-button-{{ $loop->index }}">
                                                    <a class="dropdown-item" data-method="post" href="{{ route('migrations-ui.apply', $migration) }}">
                                                        Apply This Migration
                                                    </a>
                                                    <a class="dropdown-item" data-method="post" href="{{ route('migrations-ui.apply-all') }}">
                                                        Apply All
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <em>No migrations found.</em>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

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
                        {{--<span data-toggle="modal" data-target="#exampleModal2">--}}
                        <span style="cursor: default;" data-toggle="tooltip" data-placement="top" title="Connection">
                            <i class="fa fa-plug mr-1" aria-hidden="true"></i>
                            {{ $connection }}
                        </span>
                        <span style="cursor: default;" data-toggle="tooltip" data-placement="top" title="Database" class="ml-3">
                            <i class="fa fa-database mr-1" aria-hidden="true"></i>
                            {{ $database }}
                        </span>
                        {{--</span>--}}
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

@push('footer')
    <div class="modal fade" id="migration-popup" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="migration-popup-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <pre id="migration-popup-code" class="m-0 p-3 language-php"></pre>
                </div>
            </div>
        </div>
    </div>
@endpush
