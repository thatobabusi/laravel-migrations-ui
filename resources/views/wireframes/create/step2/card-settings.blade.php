<div class="card shadow-sm my-3">
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
                <input type="text" class="form-control" id="staticEmail" placeholder="create users table" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">
                    <code>{{ now()->format('Y_m_d_His') }}_create_users_table.php</code><br>
                </small>
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-3 col-form-label">Down Action</label>
            <div class="col-sm-9">
                <select class="custom-select">
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
