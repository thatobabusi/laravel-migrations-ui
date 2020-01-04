<div class="modal" id="foreignKeyModal" tabindex="-1" role="dialog" aria-labelledby="foreignKeyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="foreignKeyModalLabel">
                    <i class="fas fa-fw fa-pencil-alt small text-muted mr-1" aria-hidden="true"></i>
                    Edit Foreign Key
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group row">
                        <label for="recipient-name" class="col-sm-2 col-form-label">
                            Table
                            <span class="text-danger" title="Required Field">*</span>
                        </label>
                        <div class="col-sm-10">
                            <select class="custom-select">
                                <option>accounts</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-sm-2 col-form-label">
                            Column(s)
                            <span class="text-danger" title="Required Field">*</span>
                        </label>
                        <div class="col-sm-10">
                            <table class="table table-sm table-borderless mb-0">
                                <thead>
                                    <tr>
                                        <th class="border-top-0 font-weight-normal text-muted text-uppercase w-50 pl-0">This Table</th>
                                        <th class="border-top-0 font-weight-normal text-muted text-uppercase w-50 pr-0">Related Table</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="pl-0">
                                            <select class="custom-select">
                                                <option>account_id</option>
                                            </select>
                                        </td>
                                        <td class="pr-0">
                                            <select class="custom-select">
                                                <option>id</option>
                                            </select>
                                        </td>
                                    </tr>
                                    {{--<tr>
                                        <td class="pl-0">
                                            <select class="custom-select">
                                                <option></option>
                                            </select>
                                        </td>
                                        <td class="pr-0">
                                            <select class="custom-select">
                                                <option></option>
                                            </select>
                                        </td>
                                    </tr>--}}
                                </tbody>
                            </table>
                            <a href="#">
                                <small class="text-muted">Add another column...</small>
                            </a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-sm-2 col-form-label">
                            Name
                        </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="recipient-name" value="" placeholder="users_account_id_foreign">
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
            <div class="modal-body" style="border-top: 1px solid #e9ecef;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="offset-sm-2 col-sm-10">
                            <h6 class="text-muted">Advanced</h6>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-sm-2 col-form-label">
                            On Update
                        </label>
                        <div class="col-sm-10">
                            <select class="custom-select">
                                <option></option>
                                <option>RESTRICT (reject the operation)</option>
                                <option>CASCADE (update the related record)</option>
                                <option>SET NULL</option>
                                {{--<option>NO ACTION</option>--}}
                                {{--<option>SET DEFAULT</option>--}}
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-sm-2 col-form-label">
                            On Delete
                        </label>
                        <div class="col-sm-10">
                            <select class="custom-select">
                                <option></option>
                                <option>RESTRICT (reject the operation)</option>
                                <option>CASCADE (delete the related record)</option>
                                <option>SET NULL</option>
                                {{--<option>NO ACTION</option>--}}
                                {{--<option>SET DEFAULT</option>--}}
                            </select>
                        </div>
                    </div>
                    {{--<div class="form-group row">
                        <label for="recipient-name" class="col-sm-2 col-form-label">
                            Generate
                        </label>
                        <div class="col-sm-10 mt-2">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="generate1Auto" name="generate1" class="custom-control-input" checked>
                                <label class="custom-control-label" for="generate1Auto">Auto</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="generate1PHP" name="generate1" class="custom-control-input">
                                <label class="custom-control-label" for="generate1PHP">PHP</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="generate1SQL" name="generate1" class="custom-control-input">
                                <label class="custom-control-label" for="generate1SQL">SQL</label>
                            </div>
                        </div>
                    </div>--}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>
