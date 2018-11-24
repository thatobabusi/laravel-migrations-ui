<div class="card shadow-sm mt-3">
    <h6 class="card-header bg-secondary text-white">
        <div class="float-right" style="margin: -6px 0;">
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
        Modify Table
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
                <small class="form-text text-muted">
                    <i class="fas fa-exclamation-triangle mx-1"></i>
                    This will only work if the database name is the same in all environments.
                </small>
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">
                Table
                <span class="text-danger" title="Required Field">*</span>
            </label>
            <div class="col-sm-10">
                <div class="row" style="align-items: center;">
                    <div class="col pr-1">
                        <select class="custom-select">
                            <option></option>
                            <option>password_resets</option>
                            <option selected>users</option>
                        </select>
                    </div>
                    <div class="col flex-grow-0 pl-1">
                        <a href="#" class="text-muted" data-toggle="tooltip" data-placement="top" title="Rename Table" onclick="$('#renameTable').show().find('input').focus(); return false;">
                            <i class="fas fa-fw fa-pencil-alt"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row" style="display: none;" id="renameTable">
            <label for="staticEmail" class="col-sm-2 col-form-label">Rename To</label>
            <div class="col-sm-10">
                <div class="row" style="align-items: center;">
                    <div class="col pr-1">
                        <input type="text" class="form-control" value="">
                    </div>
                    <div class="col flex-grow-0 pl-1">
                        <a href="#" class="text-muted" data-toggle="tooltip" data-placement="top" title="Cancel Rename" onclick="$('#renameTable').hide(); return false;">
                            <i class="fas fa-fw fa-times"></i>
                        </a>
                    </div>
                </div>
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
            <td colspan="5">...</td>
        </tbody>
    </table>
</div>
