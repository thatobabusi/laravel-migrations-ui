<div class="modal" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModal1Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModal1Label">Warning</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Not all migrations have been applied. Creating a migration now may result in an inconsistent database state.
            </div>
            <div class="modal-footer">
                <a href="{{ route('migrations-ui.wireframes.create') }}" class="btn btn-secondary">Continue Anyway</a>
                <button type="button" class="btn btn-primary font-weight-bold" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
