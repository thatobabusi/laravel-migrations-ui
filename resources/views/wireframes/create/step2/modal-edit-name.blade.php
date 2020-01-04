<div class="modal" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModal2Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModal2Label">
                    <i class="fas fa-fw fa-pencil-alt small text-muted mr-1"></i>
                    Edit Column
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-0">
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
                                    <option>integer</option>
                                    <option>soft delete</option>
                                    <option>timestamps</option>
                                    <option selected>string (VARCHAR)</option>
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
                                <input class="custom-control-input" type="checkbox" value="" id="nullable">
                                <label class="custom-control-label" for="nullable">
                                    nullable
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-sm-2 col-form-label">
                            Size (Chars)
                            <span class="text-danger" title="Required Field">*</span>
                        </label>
                        <div class="col-sm-10">
                            <input type="number" step="1" min="0" max="65535" class="form-control" id="recipient-name" value="" placeholder="default (191)">
                            {{--<small class="form-text text-muted">
                                Overhead is 1 byte.
                                <a href="https://dev.mysql.com/doc/refman/8.0/en/char.html" target="_blank">More Details</a>
                            </small>--}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-sm-2 col-form-label">
                            Name
                            <span class="text-danger" title="Required Field">*</span>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="recipient-name" value="name">
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
                                        <input class="custom-control-input" type="checkbox" value="" name="index11" id="index11">
                                        <label class="custom-control-label" for="index11">
                                            unique
                                        </label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline mt-2">
                                        <input class="custom-control-input" type="checkbox" value="" name="index12" id="index12">
                                        <label class="custom-control-label" for="index12">
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
                                                <option>accounts</option>
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
                                            <select class="custom-select" disabled>
                                                <option></option>
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
            <div class="modal-body" style="border-top: 1px solid #e9ecef;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="offset-sm-2 col-sm-10">
                            <h6 class="text-muted">Advanced</h6>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-sm-2 col-form-label">
                            Charset
                        </label>
                        <div class="col-sm-10">
                            <div class="row" style="align-items: center;">
                                <div class="col pr-1">
                                    <select class="custom-select">
                                        <option>Default (utf8)</option>
                                    </select>
                                </div>
                                <div class="col flex-grow-0 pl-1">
                                    <a href="https://mariadb.com/kb/en/library/character-set-and-collation-overview/" target="_blank" class="text-muted">
                                        <i class="fas fa-fw fa-question-circle" data-toggle="tooltip" data-placement="top" title="MariaDB Documentation"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-sm-2 col-form-label">
                            Collation
                        </label>
                        <div class="col-sm-10">
                            <div class="row" style="align-items: center;">
                                <div class="col pr-1">
                                    <select class="custom-select">
                                        <option>Default (utf8_unicode_ci)</option>
                                    </select>
                                </div>
                                <div class="col flex-grow-0 pl-1">
                                    <a href="https://mariadb.com/kb/en/library/character-set-and-collation-overview/" target="_blank" class="text-muted">
                                        <i class="fas fa-fw fa-question-circle" data-toggle="tooltip" data-placement="top" title="MariaDB Documentation"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-sm-2 col-form-label">
                            Generated
                        </label>
                        <div class="col-sm-10">
                            <div class="row" style="align-items: center;">
                                <div class="col pr-1">
                                    <select class="custom-select">
                                        <option>No</option>
                                        <option>Yes: Virtual</option>
                                        <option>Yes: Stored</option>
                                    </select>
                                </div>
                                <div class="col flex-grow-0 pl-1">
                                    <a href="https://mariadb.com/kb/en/library/generated-columns/" target="_blank" class="text-muted">
                                        <i class="fas fa-fw fa-question-circle" data-toggle="tooltip" data-placement="top" title="MariaDB Documentation"></i>
                                    </a>
                                </div>
                            </div>
                            {{--<textarea class="form-control mt-1" id="recipient-name" rows="2" maxlength="1024" placeholder="Enter expression &ndash; e.g. DAYNAME(order_date)"></textarea>--}}
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
