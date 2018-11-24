<div class="modal" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModal3Label">
                    <i class="fas fa-fw fa-pencil-alt small text-muted mr-1"></i>
                    Edit Column
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group row">
                        <label for="recipient-name" class="col-sm-2 col-form-label">
                            Type
                            <span class="text-danger" title="Required Field">*</span>
                        </label>
                        <div class="col-sm-10">
                            <select class="custom-select">
                                <optgroup label="Common">
                                    <option>auto increment</option>
                                    <option>boolean</option>
                                    <option>datetime</option>
                                    <option selected>integer</option>
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
                            <div class="custom-control custom-checkbox custom-control-inline mt-2">
                                <input class="custom-control-input" type="checkbox" value="" id="unsigned2">
                                <label class="custom-control-label" for="unsigned2">
                                    unsigned
                                </label>
                            </div>
                            <div class="custom-control custom-checkbox custom-control-inline mt-2">
                                <input class="custom-control-input" type="checkbox" value="" id="nullable3">
                                <label class="custom-control-label" for="nullable3">
                                    nullable
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-sm-2 col-form-label">
                            Size
                            <span class="text-danger" title="Required Field">*</span>
                        </label>
                        <div class="col-sm-10">
                            <table class="table table-sm border-top-0">
                                <thead>
                                    <tr>
                                        <th class="border-top-0 font-weight-normal text-muted text-uppercase"></th>
                                        <th class="border-top-0 font-weight-normal text-muted text-uppercase">Storage</th>
                                        <th class="border-top-0 font-weight-normal text-muted text-uppercase text-right">Min</th>
                                        <th class="border-top-0 font-weight-normal text-muted text-uppercase text-right">Max</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio11" name="customRadio" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio31">tiny</label>
                                            </div>
                                        </td>
                                        <td><label for="customRadio31" class="mb-0">1 byte</label></td>
                                        <td class="text-right"><label for="customRadio31" class="mb-0">-128</label></td>
                                        <td class="text-right"><label for="customRadio31" class="mb-0">127</label></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio32" name="customRadio" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio32">small</label>
                                            </div>
                                        </td>
                                        <td><label for="customRadio32" class="mb-0">2 bytes</label></td>
                                        <td class="text-right"><label for="customRadio32" class="mb-0">-32,768</label></td>
                                        <td class="text-right"><label for="customRadio32" class="mb-0">32,767</label></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio33" name="customRadio" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio33">medium</label>
                                            </div>
                                        </td>
                                        <td><label for="customRadio33" class="mb-0">3 bytes</label></td>
                                        <td class="text-right"><label for="customRadio33" class="mb-0">-8,388,608</label></td>
                                        <td class="text-right"><label for="customRadio33" class="mb-0">8,388,607</label></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio34" name="customRadio" class="custom-control-input" checked>
                                                <label class="custom-control-label" for="customRadio34">integer</label>
                                            </div>
                                        </td>
                                        <td><label for="customRadio34" class="mb-0">4 bytes</label></td>
                                        <td class="text-right"><label for="customRadio34" class="mb-0">-2,147,483,648</label></td>
                                        <td class="text-right"><label for="customRadio34" class="mb-0">2,147,483,647</label></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio35" name="customRadio" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio35">big</label>
                                            </div>
                                        </td>
                                        <td><label for="customRadio35" class="mb-0">8 bytes</label></td>
                                        <td class="text-right"><label for="customRadio35" class="mb-0">-9,223,372,036,854,775,808</label></td>
                                        <td class="text-right"><label for="customRadio35" class="mb-0">9,223,372,036,854,775,807</label></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-sm-2 col-form-label">
                            Name
                            <span class="text-danger" title="Required Field">*</span>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="recipient-name" value="account_id">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-sm-2 col-form-label">Default Value</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="text" class="form-control" id="recipient-name" value="">
                                <div class="input-group-append">
                                    <label for="nullcheck" class="input-group-text">
                                        <input type="checkbox" class="mr-1" id="nullcheck" disabled>
                                        NULL
                                    </label>
                                </div>
                            </div>
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
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Index</label>
                        <div class="col-sm-10">
                            <div class="row" style="align-items: center;">
                                <div class="col pr-1">
                                    <div class="custom-control custom-checkbox custom-control-inline mt-2">
                                        <input class="custom-control-input" type="checkbox" value="" name="index41" id="index41">
                                        <label class="custom-control-label" for="index41">
                                            unique
                                        </label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline mt-2">
                                        <input class="custom-control-input" type="checkbox" value="" name="index42" id="index42">
                                        <label class="custom-control-label" for="index42">
                                            index
                                        </label>
                                    </div>
                                </div>
                                <div class="col flex-grow-0 pl-1">
                                    <a href="#" class="text-muted" data-toggle="tooltip" data-placement="top" title="Advanced Index Options">
                                        <i class="fas fa-fw fa-pencil-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Foreign Key</label>
                        <div class="col-sm-10">
                            <div class="row" style="align-items: center;">
                                <div class="col pr-1">
                                    <div class="row">
                                        <div class="col-sm pr-1">
                                            <select class="custom-select">
                                                <option></option>
                                                <option selected>accounts</option>
                                                <option>password_resets</option>
                                                <option>users</option>
                                                <option></option>
                                                <option>other database...</option>
                                            </select>
                                        </div>
                                        <div class="col-sm d-none d-sm-block flex-grow-0 px-0">
                                            .
                                        </div>
                                        <div class="col-sm pl-1">
                                            <select class="custom-select">
                                                <option></option>
                                                <option selected>id</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col flex-grow-0 pl-1">
                                    <a href="#" class="text-muted" data-toggle="tooltip" data-placement="top" title="Advanced FK Options">
                                        <i class="fas fa-fw fa-pencil-alt"></i>
                                    </a>
                                </div>
                            </div>
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
