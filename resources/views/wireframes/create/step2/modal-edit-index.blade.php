<div class="modal" id="indexModal" tabindex="-1" role="dialog" aria-labelledby="indexModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="indexModalLabel">
                    <i class="fas fa-fw fa-pencil-alt small text-muted mr-1" aria-hidden="true"></i>
                    Edit Index
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
                            <div class="custom-control custom-radio custom-control-inline mt-2">
                                <input type="radio" id="indexTypePrimary" name="indexType" class="custom-control-input">
                                <label class="custom-control-label" for="indexTypePrimary">primary</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline mt-2">
                                <input type="radio" id="indexTypeUnique" name="indexType" class="custom-control-input" checked>
                                <label class="custom-control-label" for="indexTypeUnique">unique</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline mt-2">
                                <input type="radio" id="indexTypeIndex" name="indexType" class="custom-control-input">
                                <label class="custom-control-label" for="indexTypeIndex">index</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline mt-2">
                                <input type="radio" id="indexTypeFullText" name="indexType" class="custom-control-input">
                                <label class="custom-control-label" for="indexTypeFullText">full text</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline mt-2">
                                <input type="radio" id="indexTypeSpatial" name="indexType" class="custom-control-input">
                                <label class="custom-control-label" for="indexTypeSpatial">spatial</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-sm-2 col-form-label">
                            Column(s)
                            <span class="text-danger" title="Required Field">*</span>
                        </label>
                        <div class="col-sm-10">
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex" style="align-items: center;">
                                    <select class="custom-select">
                                        <option>email</option>
                                    </select>
                                    {{--<i class="fas fa-fw fa-grip-vertical text-muted ml-1"></i>--}}
                                </li>
                                {{--<li class="d-flex mt-1" style="align-items: center;">
                                    <select class="custom-select">
                                        <option></option>
                                    </select>
                                    <i class="fas fa-fw fa-grip-vertical text-muted ml-1"></i>
                                </li>--}}
                            </ul>
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
                            <input type="text" class="form-control" id="recipient-name" value="" placeholder="users_email_unique">
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
