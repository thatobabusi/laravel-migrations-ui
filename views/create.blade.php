@extends('migrations-ui::layout')

@section('title', 'New Migration')

@section('navbar-right')
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <button class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="Undo">
                <i class="fas fa-fw fa-undo"></i>
            </button>
            <button class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="Redo" disabled>
                <i class="fas fa-fw fa-redo"></i>
            </button>
        </li>
        <li class="nav-item ml-3">
            <button class="btn btn-success font-weight-bold">Next Step <i class="fas fa-caret-right ml-1"></i></button>
        </li>
    </ul>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl">

                <div class="card shadow-sm my-3" style="overflow: hidden;">
                    <div class="card-header bg-secondary">
                        <div class="float-right mt-1">
                            <button class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Move Up" disabled>
                                <i class="fas fa-fw fa-arrow-alt-circle-up"></i>
                            </button>
                            <button class="btn btn-sm btn-dark mr-2" data-toggle="tooltip" data-placement="top" title="Move Down">
                                <i class="fas fa-fw fa-arrow-alt-circle-down"></i>
                            </button>
                            <button class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Delete Group">
                                <i class="fas fa-fw fa-trash"></i>
                            </button>
                        </div>
                        <div class="form-inline">
                            <div class="form-group">
                                <select class="form-control border-dark mr-2" style="font-weight: 500;">
                                    <option selected>Create Table</option>
                                    <option>Modify Table</option>
                                    <option>Rename Table</option>
                                    <option>Drop Table</option>
                                    <option>Custom PHP Code</option>
                                    <option>Custom SQL</option>
                                </select>
                                <input type="text" class="form-control border-dark inline" placeholder="enter table name">
                            </div>
                        </div>
                    </div>
                    <table class="table table-hover mb-0 border-bottom">
                        <thead>
                            <tr class="bg-light">
                                <th class="align-middle font-weight-normal text-muted text-uppercase">Column</th>
                                <th class="align-middle font-weight-normal text-muted text-uppercase">Type</th>
                                <th class="align-middle font-weight-normal text-muted text-uppercase">Attributes</th>
                                <th class="align-middle font-weight-normal text-muted text-uppercase" width="1"></th>
                                <th class="align-middle font-weight-normal text-muted text-uppercase text-right" width="1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="align-middle">
                                    <i class="fas fa-grip-vertical text-muted mr-1"></i>
                                    id
                                </td>
                                <td class="align-middle">auto increment</td>
                                <td class="align-middle"></td>
                                <td class="align-middle pr-0" nowrap></td>
                                <td class="align-middle text-right" nowrap>
                                    <span data-toggle="tooltip" data-placement="top" title="Edit">
                                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModal">
                                            <i class="fas fa-fw fa-pen"></i>
                                        </button>
                                    </span>
                                    <button class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Clone">
                                        <i class="far fa-fw fa-clone"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remove">
                                        <i class="fas fa-fw fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle">
                                    <i class="fas fa-grip-vertical text-muted mr-1"></i>
                                    name
                                </td>
                                <td class="align-middle">string</td>
                                <td class="align-middle"></td>
                                <td class="align-middle pr-0" nowrap>
                                    <i class="far fa-fw fa-keyboard text-muted mr-1" data-toggle="popover" data-trigger="hover" data-placement="top" title="Default Value" data-content="New user"></i>
                                    <i class="fas fa-fw fa-font text-muted mr-1" data-toggle="popover" data-trigger="hover" data-placement="top" title="Custom Encoding" data-content="charset=utf-8, collation=utf8_unicode_ci"></i>
                                </td>
                                <td class="align-middle text-right" nowrap>
                                    <span data-toggle="tooltip" data-placement="top" title="Edit">
                                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModal">
                                            <i class="fas fa-fw fa-pen"></i>
                                        </button>
                                    </span>
                                    <button class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Clone">
                                        <i class="far fa-fw fa-clone"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remove">
                                        <i class="fas fa-fw fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle">
                                    <i class="fas fa-grip-vertical text-muted mr-1"></i>
                                    account_id
                                </td>
                                <td class="align-middle">integer</td>
                                <td class="align-middle">unsigned, foreign</td>
                                <td class="align-middle pr-0" nowrap>
                                    <i class="far fa-fw fa-comment text-muted mr-1" data-toggle="popover" data-trigger="hover" data-placement="top" title="Comment" data-content="Each user can only belong to one account."></i>
                                </td>
                                <td class="align-middle text-right" nowrap>
                                    <span data-toggle="tooltip" data-placement="top" title="Edit">
                                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModal">
                                            <i class="fas fa-fw fa-pen"></i>
                                        </button>
                                    </span>
                                    <button class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Clone">
                                        <i class="far fa-fw fa-clone"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remove">
                                        <i class="fas fa-fw fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle">
                                    <i class="fas fa-grip-vertical text-muted mr-1"></i>
                                    email
                                </td>
                                <td class="align-middle">string</td>
                                <td class="align-middle">unique</td>
                                <td class="align-middle pr-0" nowrap>
                                    <i class="fas fa-fw fa-magic text-muted mr-1" data-toggle="popover" data-trigger="hover" data-placement="top" title="Virtual Column" data-content="1 + 2"></i>
                                </td>
                                <td class="align-middle text-right" nowrap>
                                    <span data-toggle="tooltip" data-placement="top" title="Edit">
                                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModal">
                                            <i class="fas fa-fw fa-pen"></i>
                                        </button>
                                    </span>
                                    <button class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Clone">
                                        <i class="far fa-fw fa-clone"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remove">
                                        <i class="fas fa-fw fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle">
                                    <i class="fas fa-grip-vertical text-muted mr-1"></i>
                                    email_verified_at
                                </td>
                                <td class="align-middle">timestamp</td>
                                <td class="align-middle">nullable</td>
                                <td class="align-middle pr-0" nowrap></td>
                                <td class="align-middle text-right" nowrap>
                                    <span data-toggle="tooltip" data-placement="top" title="Edit">
                                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModal">
                                            <i class="fas fa-fw fa-pen"></i>
                                        </button>
                                    </span>
                                    <button class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Clone">
                                        <i class="far fa-fw fa-clone"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remove">
                                        <i class="fas fa-fw fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle">
                                    <i class="fas fa-grip-vertical text-muted mr-1"></i>
                                    password
                                </td>
                                <td class="align-middle">string</td>
                                <td class="align-middle"></td>
                                <td class="align-middle pr-0" nowrap></td>
                                <td class="align-middle text-right" nowrap>
                                    <span data-toggle="tooltip" data-placement="top" title="Edit">
                                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModal">
                                            <i class="fas fa-fw fa-pen"></i>
                                        </button>
                                    </span>
                                    <button class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Clone">
                                        <i class="far fa-fw fa-clone"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remove">
                                        <i class="fas fa-fw fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle text-muted font-italic">
                                    <i class="fas fa-grip-vertical text-muted mr-1"></i>
                                    remember_token
                                </td>
                                <td class="align-middle">remember token</td>
                                <td class="align-middle"></td>
                                <td class="align-middle pr-0" nowrap></td>
                                <td class="align-middle text-right" nowrap>
                                    <span data-toggle="tooltip" data-placement="top" title="Edit">
                                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModal">
                                            <i class="fas fa-fw fa-pen"></i>
                                        </button>
                                    </span>
                                    <button class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Clone">
                                        <i class="far fa-fw fa-clone"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remove">
                                        <i class="fas fa-fw fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle text-muted font-italic">
                                    <i class="fas fa-grip-vertical text-muted mr-1"></i>
                                    created_at, updated_at
                                </td>
                                <td class="align-middle">timestamps</td>
                                <td class="align-middle"></td>
                                <td class="align-middle pr-0" nowrap></td>
                                <td class="align-middle text-right" nowrap>
                                    <span data-toggle="tooltip" data-placement="top" title="Edit">
                                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModal">
                                            <i class="fas fa-fw fa-pen"></i>
                                        </button>
                                    </span>
                                    <button class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Clone">
                                        <i class="far fa-fw fa-clone"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remove">
                                        <i class="fas fa-fw fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle text-muted font-italic">
                                    <i class="fas fa-grip-vertical text-muted mr-1"></i>
                                    deleted_at
                                </td>
                                <td class="align-middle">soft delete</td>
                                <td class="align-middle"></td>
                                <td class="align-middle pr-0" nowrap></td>
                                <td class="align-middle text-right" nowrap>
                                    <span data-toggle="tooltip" data-placement="top" title="Edit">
                                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModal">
                                            <i class="fas fa-fw fa-pen"></i>
                                        </button>
                                    </span>
                                    <button class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Clone">
                                        <i class="far fa-fw fa-clone"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remove">
                                        <i class="fas fa-fw fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle" colspan="5">
                                    <button class="btn btn-sm btn-success">
                                        <i class="fas fa-fw fa-plus"></i>
                                        Add Column
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                        <thead>
                            <tr class="bg-light">
                                <th class="align-middle font-weight-normal text-muted text-uppercase">Index</th>
                                <th class="align-middle font-weight-normal text-muted text-uppercase">Type</th>
                                <th class="align-middle font-weight-normal text-muted text-uppercase" colspan="2">Column(s)</th>
                                <th class="align-middle font-weight-normal text-muted text-uppercase text-right" width="1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="align-middle text-muted font-italic">email_unique</td>
                                <td class="align-middle">unique</td>
                                <td class="align-middle" colspan="2">email</td>
                                <td class="align-middle text-right" nowrap>
                                    <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="fas fa-fw fa-pen"></i>
                                    </button>
                                    <button class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Clone">
                                        <i class="far fa-fw fa-clone"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remove">
                                        <i class="fas fa-fw fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle" colspan="5">
                                    <button class="btn btn-sm btn-success">
                                        <i class="fas fa-fw fa-plus"></i>
                                        Add Index
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                        <thead>
                            <tr class="bg-light">
                                <th class="align-middle font-weight-normal text-muted text-uppercase">Foreign Key</th>
                                <th class="align-middle font-weight-normal text-muted text-uppercase">Column(s)</th>
                                <th class="align-middle font-weight-normal text-muted text-uppercase" colspan="2">References</th>
                                <th class="align-middle font-weight-normal text-muted text-uppercase text-right" width="1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="align-middle text-muted font-italic">account_id_foreign</td>
                                <td class="align-middle">account_id</td>
                                <td class="align-middle" colspan="2">accounts.id</td>
                                <td class="align-middle text-right" nowrap>
                                    <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="fas fa-fw fa-pen"></i>
                                    </button>
                                    <button class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Clone">
                                        <i class="far fa-fw fa-clone"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remove">
                                        <i class="fas fa-fw fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle" colspan="5">
                                    <button class="btn btn-sm btn-success">
                                        <i class="fas fa-fw fa-plus"></i>
                                        Add Foreign Key
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card shadow-sm my-3" style="overflow: hidden;">
                    <div class="card-header bg-secondary">
                        <div class="float-right mt-1">
                            <button class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Move Up">
                                <i class="fas fa-fw fa-arrow-alt-circle-up"></i>
                            </button>
                            <button class="btn btn-sm btn-dark mr-2" data-toggle="tooltip" data-placement="top" title="Move Down">
                                <i class="fas fa-fw fa-arrow-alt-circle-down"></i>
                            </button>
                            <button class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Delete Group">
                                <i class="fas fa-fw fa-trash"></i>
                            </button>
                        </div>
                        <div class="form-inline">
                            <div class="form-group">
                                <select class="form-control border-dark mr-2" style="font-weight: 500;">
                                    <option>Create Table</option>
                                    <option selected>Modify Table</option>
                                    <option>Rename Table</option>
                                    <option>Drop Table</option>
                                    <option>Custom PHP Code</option>
                                    <option>Custom SQL</option>
                                </select>
                                <select class="form-control border-dark">
                                    <option>password_resets</option>
                                    <option selected>users</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        ...
                    </div>
                </div>

                <div class="card shadow-sm my-3" style="overflow: hidden;">
                    <div class="card-header bg-secondary">
                        <div class="float-right mt-1">
                            <button class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Move Up">
                                <i class="fas fa-fw fa-arrow-alt-circle-up"></i>
                            </button>
                            <button class="btn btn-sm btn-dark mr-2" data-toggle="tooltip" data-placement="top" title="Move Down">
                                <i class="fas fa-fw fa-arrow-alt-circle-down"></i>
                            </button>
                            <button class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Delete Group">
                                <i class="fas fa-fw fa-trash"></i>
                            </button>
                        </div>
                        <div class="form-inline">
                            <div class="form-group">
                                <select class="form-control border-dark mr-2" style="font-weight: 500;">
                                    <option>Create Table</option>
                                    <option>Modify Table</option>
                                    <option selected>Rename Table</option>
                                    <option>Drop Table</option>
                                    <option>Custom PHP Code</option>
                                    <option>Custom SQL</option>
                                </select>
                                <select class="form-control border-dark">
                                    <option>password_resets</option>
                                    <option selected>users</option>
                                </select>
                                <span class="text-white mx-2">to</span>
                                <input type="text" class="form-control border-dark inline" placeholder="enter table name">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm my-3" style="overflow: hidden;">
                    <div class="card-header bg-secondary">
                        <div class="float-right mt-1">
                            <button class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Move Up">
                                <i class="fas fa-fw fa-arrow-alt-circle-up"></i>
                            </button>
                            <button class="btn btn-sm btn-dark mr-2" data-toggle="tooltip" data-placement="top" title="Move Down">
                                <i class="fas fa-fw fa-arrow-alt-circle-down"></i>
                            </button>
                            <button class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Delete Group">
                                <i class="fas fa-fw fa-trash"></i>
                            </button>
                        </div>
                        <div class="form-inline">
                            <div class="form-group">
                                <select class="form-control border-dark mr-2" style="font-weight: 500;">
                                    <option>Create Table</option>
                                    <option>Modify Table</option>
                                    <option>Rename Table</option>
                                    <option selected>Drop Table</option>
                                    <option>Custom PHP Code</option>
                                    <option>Custom SQL</option>
                                </select>
                                <select class="form-control border-dark">
                                    <option selected>password_resets</option>
                                    <option>users</option>
                                </select>
                                <span class="custom-control custom-checkbox text-white ml-3">
                                    <input class="custom-control-input" type="checkbox" value="" id="defaultCheck1" checked>
                                    <label class="custom-control-label" for="defaultCheck1">
                                        If exists
                                    </label>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm my-3" style="overflow: hidden;">
                    <div class="card-header bg-secondary">
                        <div class="float-right mt-1">
                            <button class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Move Up">
                                <i class="fas fa-fw fa-arrow-alt-circle-up"></i>
                            </button>
                            <button class="btn btn-sm btn-dark mr-2" data-toggle="tooltip" data-placement="top" title="Move Down" disabled>
                                <i class="fas fa-fw fa-arrow-alt-circle-down"></i>
                            </button>
                            <button class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Delete Group">
                                <i class="fas fa-fw fa-trash"></i>
                            </button>
                        </div>
                        <div class="form-inline">
                            <div class="form-group">
                                <select class="form-control border-dark mr-2" style="font-weight: 500;">
                                    <option>Create Table</option>
                                    <option>Modify Table</option>
                                    <option>Rename Table</option>
                                    <option>Drop Table</option>
                                    <option selected>Custom PHP Code</option>
                                    <option>Custom SQL</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md">
                                <label class="form-label">Up</label>
                                <textarea class="form-control" rows="8"></textarea>
                            </div>
                            <div class="form-group col-md">
                                <label class="form-label">Down</label>
                                <textarea class="form-control" rows="8"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="my-3">
                    <button class="btn btn-sm btn-primary">Add Group</button>
                </div>

            </div>
            <div class="col-xl-4">

                <div class="card shadow-sm my-3" style="overflow: hidden;">
                    <h6 class="card-header bg-secondary text-white">
                        Settings
                    </h6>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Date</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="staticEmail" placeholder="{{ now() }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="staticEmail" placeholder="create sample table" aria-describedby="emailHelp">
                                <small id="emailHelp" class="form-text text-muted">
                                    <code>{{ now()->format('Y_m_d_His') }}_create_sample_table.php</code><br>
                                </small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Down Action</label>
                            <div class="col-sm-9">
                                <select class="form-control">
                                    <option>Revert changes</option>
                                    <option>Throw exception</option>
                                    <option>Do nothing</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Foreign Keys</label>
                            <div class="col-sm-9">
                                <div class="custom-control custom-checkbox mt-2">
                                    <input class="custom-control-input" type="checkbox" value="" id="defaultCheck1">
                                    <label class="custom-control-label" for="defaultCheck1">
                                        Disable foreign key checks during migration
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm my-3" style="overflow: hidden;">
                    <h6 class="card-header bg-secondary text-white">
                        Preview
                    </h6>
                    <pre class="card-body mb-0">&lt;?php<br><br>class CreateSampleTable<br>{<br>    //<br>}</pre>
                </div>

                {{--<div class="my-3">
                    <button class="btn btn-danger"><i class="fas fa-caret-left"></i> Revert</button>
                </div>--}}

            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <i class="fas fa-fw fa-pen small text-muted mr-1"></i>
                        Edit Column
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group row">
                            <label for="recipient-name" class="col-sm-2 col-form-label">Type</label>
                            <div class="col-sm-10">
                                <select class="form-control">
                                    <optgroup label="Common">
                                        <option selected>auto increment</option>
                                        <option>boolean</option>
                                        <option>datetime</option>
                                        <option>integer</option>
                                        <option>soft delete</option>
                                        <option>timestamps</option>
                                        <option>string (VARCHAR)</option>
                                        <option>text</option>
                                    </optgroup>
                                    <optgroup label="All Types (A-Z)">
                                        <option>auto increment</option>
                                        <option>binary (BLOB)</option>
                                        <option>boolean</option>
                                        <option>char (fixed length)</option>
                                        <option>date</option>
                                        <option>datetime</option>
                                        <option>decimal</option>
                                        <option>enum</option>
                                        <option>float (double)</option>
                                        <option>geometry</option>
                                        <option>geometry collection</option>
                                        <option>integer</option>
                                        <option>IP address</option>
                                        <option>JSON</option>
                                        <option>line string</option>
                                        <option>MAC address</option>
                                        <option>morphs</option>
                                        <option>multi-line string</option>
                                        <option>multi-point</option>
                                        <option>multi-polygon</option>
                                        <option>point</option>
                                        <option>polygon</option>
                                        <option>remember token</option>
                                        <option>soft delete</option>
                                        <option>string (VARCHAR)</option>
                                        <option>text</option>
                                        <option>time</option>
                                        <option>timestamp</option>
                                        <option>timestamps</option>
                                        <option>uuid</option>
                                        <option>year</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-sm-2 col-form-label">Size</label>
                            <div class="col-sm-10">
                                <table class="table table-sm border-top-0">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0 font-weight-normal text-muted text-uppercase"></th>
                                            <th class="border-top-0 font-weight-normal text-muted text-uppercase">Storage</th>
                                            <th class="border-top-0 font-weight-normal text-muted text-uppercase">Max Records</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customRadio11" name="customRadio" class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadio11">TINYINT</label>
                                                </div>
                                            </td>
                                            <td><label for="customRadio11" class="mb-0">1 byte</label></td>
                                            <td><label for="customRadio11" class="mb-0">255</label></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customRadio12" name="customRadio" class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadio12">SMALLINT</label>
                                                </div>
                                            </td>
                                            <td><label for="customRadio12" class="mb-0">2 bytes</label></td>
                                            <td><label for="customRadio12" class="mb-0">~65 thousand</label></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customRadio13" name="customRadio" class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadio13">MEDIUMINT</label>
                                                </div>
                                            </td>
                                            <td><label for="customRadio13" class="mb-0">3 bytes</label></td>
                                            <td><label for="customRadio13" class="mb-0">~16 million</label></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customRadio14" name="customRadio" class="custom-control-input" checked>
                                                    <label class="custom-control-label" for="customRadio14">INTEGER</label>
                                                </div>
                                            </td>
                                            <td><label for="customRadio14" class="mb-0">4 bytes</label></td>
                                            <td><label for="customRadio14" class="mb-0">~4 billion</label></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customRadio15" name="customRadio" class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadio15">BIGINT</label>
                                                </div>
                                            </td>
                                            <td><label for="customRadio15" class="mb-0">8 bytes</label></td>
                                            <td><label for="customRadio15" class="mb-0">~18 quintillion</label></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <small class="form-text text-muted">
                                    This is an alias for <tt>INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY</tt>.
                                </small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="recipient-name" value="id">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-sm-2 col-form-label">Starts At</label>
                            <div class="col-sm-10">
                                <input type="number" step="1" min="0" max="4294967295" class="form-control" id="recipient-name" value="1">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-sm-2 col-form-label">Comment</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="recipient-name" rows="2" maxlength="1024"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
