<div class="card shadow-sm mt-3">
    <h6 class="card-header bg-secondary text-white">
        <div class="float-right" style="margin: -6px 0;">
            <button class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Move Up" disabled>
                <i class="fas fa-fw fa-arrow-alt-circle-up" aria-hidden="true"></i>
            </button>
            <button class="btn btn-sm btn-dark mr-2" data-toggle="tooltip" data-placement="top" title="Move Down">
                <i class="fas fa-fw fa-arrow-alt-circle-down" aria-hidden="true"></i>
            </button>
            <button class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Delete Group">
                <i class="fas fa-fw fa-trash" aria-hidden="true"></i>
            </button>
        </div>
        Create Table
    </h6>
    <div class="card-body">
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Connection</label>
            <div class="col-sm-10">
                <select class="custom-select">
                    <option>mysql</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Database</label>
            <div class="col-sm-10">
                <select class="custom-select">
                    <option>forge</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">
                Table
                <span class="text-danger" title="Required Field">*</span>
            </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="users">
            </div>
        </div>
        <div class="form-group row mb-0">
            <label for="recipient-name" class="col-sm-2 col-form-label">Comment</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="recipient-name" rows="2" maxlength="2048"></textarea>
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
                    <i class="fas fa-grip-vertical text-muted mr-1" aria-hidden="true"></i>
                    id
                </td>
                <td class="align-middle">auto increment</td>
                <td class="align-middle"></td>
                <td class="align-middle pr-0" nowrap></td>
                <td class="align-middle text-right" nowrap>
                    <span data-toggle="modal" data-target="#exampleModal1">
                        <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="fas fa-fw fa-pencil-alt" aria-hidden="true"></i>
                        </button>
                    </span>
                    <span data-toggle="modal" data-target="#exampleModal1">
                        <button class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Clone">
                            <i class="far fa-fw fa-clone" aria-hidden="true"></i>
                        </button>
                    </span>
                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remove" onclick="$(this).tooltip('dispose').closest('tr').remove();">
                        <i class="fas fa-fw fa-trash" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>
            <tr>
                <td class="align-middle">
                    <i class="fas fa-grip-vertical text-muted mr-1" aria-hidden="true"></i>
                    name
                </td>
                <td class="align-middle">string</td>
                <td class="align-middle"></td>
                <td class="align-middle pr-0" nowrap>
                    <i class="far fa-fw fa-keyboard text-muted mr-1" aria-hidden="true" data-toggle="popover" data-trigger="hover" data-placement="top" title="Default Value" data-content="New user"></i>
                    <i class="fas fa-fw fa-font text-muted mr-1" aria-hidden="true" data-toggle="popover" data-trigger="hover" data-placement="top" title="Custom Encoding" data-content="charset=utf-8, collation=utf8_unicode_ci"></i>
                </td>
                <td class="align-middle text-right" nowrap>
                    <span data-toggle="modal" data-target="#exampleModal2">
                        <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="fas fa-fw fa-pencil-alt" aria-hidden="true"></i>
                        </button>
                    </span>
                    <span data-toggle="modal" data-target="#exampleModal2">
                        <button class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Clone">
                            <i class="far fa-fw fa-clone" aria-hidden="true"></i>
                        </button>
                    </span>
                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remove" onclick="$(this).tooltip('dispose').closest('tr').remove();">
                        <i class="fas fa-fw fa-trash" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>
            <tr>
                <td class="align-middle">
                    <i class="fas fa-grip-vertical text-muted mr-1" aria-hidden="true"></i>
                    account_id
                </td>
                <td class="align-middle">integer</td>
                <td class="align-middle">unsigned, foreign</td>
                <td class="align-middle pr-0" nowrap>
                    <i class="far fa-fw fa-comment text-muted mr-1" aria-hidden="true" data-toggle="popover" data-trigger="hover" data-placement="top" title="Comment" data-content="Each user can only belong to one account."></i>
                </td>
                <td class="align-middle text-right" nowrap>
                    <span data-toggle="modal" data-target="#exampleModal3">
                        <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="fas fa-fw fa-pencil-alt" aria-hidden="true"></i>
                        </button>
                    </span>
                    <span data-toggle="modal" data-target="#exampleModal3">
                        <button class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Clone">
                            <i class="far fa-fw fa-clone" aria-hidden="true"></i>
                        </button>
                    </span>
                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remove" onclick="$(this).tooltip('dispose').closest('tr').remove();">
                        <i class="fas fa-fw fa-trash" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>
            <tr>
                <td class="align-middle">
                    <i class="fas fa-grip-vertical text-muted mr-1" aria-hidden="true"></i>
                    email
                </td>
                <td class="align-middle">string</td>
                <td class="align-middle">unique</td>
                <td class="align-middle pr-0" nowrap>
                    <i class="fas fa-fw fa-magic text-muted mr-1" aria-hidden="true" data-toggle="popover" data-trigger="hover" data-placement="top" title="Virtual Column" data-content="1 + 2"></i>
                </td>
                <td class="align-middle text-right" nowrap>
                    <span data-toggle="modal" data-target="#exampleModal1">
                        <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="fas fa-fw fa-pencil-alt" aria-hidden="true"></i>
                        </button>
                    </span>
                    <span data-toggle="modal" data-target="#exampleModal1">
                        <button class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Clone">
                            <i class="far fa-fw fa-clone" aria-hidden="true"></i>
                        </button>
                    </span>
                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remove" onclick="$(this).tooltip('dispose').closest('tr').remove();">
                        <i class="fas fa-fw fa-trash" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>
            <tr>
                <td class="align-middle">
                    <i class="fas fa-grip-vertical text-muted mr-1" aria-hidden="true"></i>
                    email_verified_at
                </td>
                <td class="align-middle">timestamp</td>
                <td class="align-middle">nullable</td>
                <td class="align-middle pr-0" nowrap></td>
                <td class="align-middle text-right" nowrap>
                    <span data-toggle="modal" data-target="#exampleModal1">
                        <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="fas fa-fw fa-pencil-alt" aria-hidden="true"></i>
                        </button>
                    </span>
                    <span data-toggle="modal" data-target="#exampleModal1">
                        <button class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Clone">
                            <i class="far fa-fw fa-clone" aria-hidden="true"></i>
                        </button>
                    </span>
                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remove" onclick="$(this).tooltip('dispose').closest('tr').remove();">
                        <i class="fas fa-fw fa-trash" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>
            <tr>
                <td class="align-middle">
                    <i class="fas fa-grip-vertical text-muted mr-1" aria-hidden="true"></i>
                    password
                </td>
                <td class="align-middle">string</td>
                <td class="align-middle"></td>
                <td class="align-middle pr-0" nowrap></td>
                <td class="align-middle text-right" nowrap>
                    <span data-toggle="modal" data-target="#exampleModal1">
                        <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="fas fa-fw fa-pencil-alt" aria-hidden="true"></i>
                        </button>
                    </span>
                    <span data-toggle="modal" data-target="#exampleModal1">
                        <button class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Clone">
                            <i class="far fa-fw fa-clone" aria-hidden="true"></i>
                        </button>
                    </span>
                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remove" onclick="$(this).tooltip('dispose').closest('tr').remove();">
                        <i class="fas fa-fw fa-trash" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>
            <tr>
                <td class="align-middle text-muted font-italic">
                    <i class="fas fa-grip-vertical text-muted mr-1" aria-hidden="true"></i>
                    remember_token
                </td>
                <td class="align-middle">remember token</td>
                <td class="align-middle"></td>
                <td class="align-middle pr-0" nowrap></td>
                <td class="align-middle text-right" nowrap>
                    <span data-toggle="modal" data-target="#exampleModal1">
                        <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="fas fa-fw fa-pencil-alt" aria-hidden="true"></i>
                        </button>
                    </span>
                    <span data-toggle="modal" data-target="#exampleModal1">
                        <button class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Clone">
                            <i class="far fa-fw fa-clone" aria-hidden="true"></i>
                        </button>
                    </span>
                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remove" onclick="$(this).tooltip('dispose').closest('tr').remove();">
                        <i class="fas fa-fw fa-trash" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>
            <tr>
                <td class="align-middle text-muted font-italic">
                    <i class="fas fa-grip-vertical text-muted mr-1" aria-hidden="true"></i>
                    created_at, updated_at
                </td>
                <td class="align-middle">timestamps</td>
                <td class="align-middle"></td>
                <td class="align-middle pr-0" nowrap></td>
                <td class="align-middle text-right" nowrap>
                    <span data-toggle="modal" data-target="#exampleModal1">
                        <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="fas fa-fw fa-pencil-alt" aria-hidden="true"></i>
                        </button>
                    </span>
                    <span data-toggle="modal" data-target="#exampleModal1">
                        <button class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Clone">
                            <i class="far fa-fw fa-clone" aria-hidden="true"></i>
                        </button>
                    </span>
                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remove" onclick="$(this).tooltip('dispose').closest('tr').remove();">
                        <i class="fas fa-fw fa-trash" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>
            <tr>
                <td class="align-middle text-muted font-italic">
                    <i class="fas fa-grip-vertical text-muted mr-1" aria-hidden="true"></i>
                    deleted_at
                </td>
                <td class="align-middle">soft delete</td>
                <td class="align-middle"></td>
                <td class="align-middle pr-0" nowrap></td>
                <td class="align-middle text-right" nowrap>
                    <span data-toggle="modal" data-target="#exampleModal1">
                        <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="fas fa-fw fa-pencil-alt" aria-hidden="true"></i>
                        </button>
                    </span>
                    <span data-toggle="modal" data-target="#exampleModal1">
                        <button class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Clone">
                            <i class="far fa-fw fa-clone" aria-hidden="true"></i>
                        </button>
                    </span>
                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remove" onclick="$(this).tooltip('dispose').closest('tr').remove();">
                        <i class="fas fa-fw fa-trash" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>
            <tr>
                <td class="align-middle" colspan="5">
                    <button class="btn btn-sm btn-success">
                        <i class="fas fa-fw fa-plus" aria-hidden="true"></i>
                        Add Column
                    </button>
                    <small class="ml-3 mr-1">
                        <strong class="text-muted" style="font-weight: 500;">Presets:</strong>
                        <a href="#">id</a>
                        <span class="text-muted" style="font-weight: 500;">&middot;</span>
                        <a href="#">name</a>
                        <span class="text-muted" style="font-weight: 500;">&middot;</span>
                        <a href="#">timestamps</a>
                        <span class="text-muted" style="font-weight: 500;">&middot;</span>
                        <a href="#">soft delete</a>
                    </small>
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
                    <span data-toggle="modal" data-target="#indexModal">
                        <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="fas fa-fw fa-pencil-alt" aria-hidden="true"></i>
                        </button>
                    </span>
                    <span data-toggle="modal" data-target="#indexModal">
                        <button class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Clone">
                            <i class="far fa-fw fa-clone" aria-hidden="true"></i>
                        </button>
                    </span>
                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remove" onclick="$(this).tooltip('dispose').closest('tr').remove();">
                        <i class="fas fa-fw fa-trash" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>
            <tr>
                <td class="align-middle" colspan="5">
                    <span data-toggle="modal" data-target="#indexModal">
                        <button class="btn btn-sm btn-success">
                            <i class="fas fa-fw fa-plus" aria-hidden="true"></i>
                            Add Index
                        </button>
                    </span>
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
                    <span data-toggle="modal" data-target="#foreignKeyModal">
                        <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="fas fa-fw fa-pencil-alt" aria-hidden="true"></i>
                        </button>
                    </span>
                    <span data-toggle="modal" data-target="#foreignKeyModal">
                        <button class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Clone">
                            <i class="far fa-fw fa-clone" aria-hidden="true"></i>
                        </button>
                    </span>
                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remove" onclick="$(this).tooltip('dispose').closest('tr').remove();">
                        <i class="fas fa-fw fa-trash" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>
            <tr>
                <td class="align-middle" colspan="5">
                    <span data-toggle="modal" data-target="#foreignKeyModal">
                        <button class="btn btn-sm btn-success">
                            <i class="fas fa-fw fa-plus" aria-hidden="true"></i>
                            Add Foreign Key
                        </button>
                    </span>
                </td>
            </tr>
        </tbody>
    </table>
</div>
