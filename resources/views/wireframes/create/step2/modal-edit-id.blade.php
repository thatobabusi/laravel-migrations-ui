<div class="modal" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModal1Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModal1Label">
                    <i class="fas fa-fw fa-pencil-alt small text-muted mr-1" aria-hidden="true"></i>
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
                                        <th class="border-top-0 font-weight-normal text-muted text-uppercase">Max Records</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio11" name="customRadio1" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio11">tiny</label>
                                            </div>
                                        </td>
                                        <td><label for="customRadio11" class="mb-0">1 byte</label></td>
                                        <td><label for="customRadio11" class="mb-0">255</label></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio12" name="customRadio1" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio12">small</label>
                                            </div>
                                        </td>
                                        <td><label for="customRadio12" class="mb-0">2 bytes</label></td>
                                        <td><label for="customRadio12" class="mb-0">~65 thousand</label></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio13" name="customRadio1" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio13">medium</label>
                                            </div>
                                        </td>
                                        <td><label for="customRadio13" class="mb-0">3 bytes</label></td>
                                        <td><label for="customRadio13" class="mb-0">~16 million</label></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio14" name="customRadio1" class="custom-control-input" checked>
                                                <label class="custom-control-label" for="customRadio14">integer</label>
                                            </div>
                                        </td>
                                        <td><label for="customRadio14" class="mb-0">4 bytes</label></td>
                                        <td><label for="customRadio14" class="mb-0">~4 billion</label></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio15" name="customRadio1" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio15">big</label>
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
                        <label for="recipient-name" class="col-sm-2 col-form-label">
                            Name
                            <span class="text-danger" title="Required Field">*</span>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="recipient-name" value="id">
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
                        <label for="recipient-name" class="col-sm-2 col-form-label">Start Value</label>
                        <div class="col-sm-10">
                            <input type="number" step="1" min="0" max="4294967295" class="form-control" id="recipient-name" value="" placeholder="1">
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
