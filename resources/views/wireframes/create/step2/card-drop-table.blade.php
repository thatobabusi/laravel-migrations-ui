<div class="card shadow-sm mt-3">
    <h6 class="card-header bg-secondary text-white">
        <div class="float-right" style="margin: -6px 0;">
            <button class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Move Up">
                <i class="fas fa-fw fa-arrow-alt-circle-up" aria-hidden="true"></i>
            </button>
            <button class="btn btn-sm btn-dark mr-2" data-toggle="tooltip" data-placement="top" title="Move Down">
                <i class="fas fa-fw fa-arrow-alt-circle-down" aria-hidden="true"></i>
            </button>
            <button class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="Delete Group">
                <i class="fas fa-fw fa-trash" aria-hidden="true"></i>
            </button>
        </div>
        Drop Table
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
                <select class="custom-select">
                    <option>password_resets</option>
                    <option selected>users</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="custom-control-label" for="defaultCheck1">
                        If exists
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
