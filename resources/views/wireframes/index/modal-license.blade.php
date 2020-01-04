<div class="modal" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModal3Label">
                    License Key
                    {{--<i class="fas fa-cog fa-spin ml-1 text-muted" aria-hidden="true"></i>--}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container-fluid">
                {{--<div class="row">
                    <div class="col">
                        <div class="alert alert-danger">License key not valid (invalid format).</div>
                    </div>
                </div>--}}
                <div class="row">
                    <div class="col-lg">
                        <div class="form-group">
                                <textarea class="form-control" id="recipient-name" rows="14" style="color: #212529; font-family: SFMono-Regular,Menlo,Monaco,Consolas,'Liberation Mono','Courier New',monospace; font-size: 0.875rem" placeholder="Paste license key here..." oninput="$('#licenseFooter').show();">----- BEGIN LICENSE KEY --------------------------
eyJhbGciOiJFUzI1NiJ9.ZXlBS0lDQWdJQ0FnSUNBaVpuSnZiU
0k2ZXdvZ0lDQWdJQ0FnSUNBZ0lDQWlibUZ0WlNJNklDSlVhVzB
nV1hObGQzbHVJaXdLSUNBZ0lDQWdJQ0FnSUNBZ0ltRmpZMjkxY
m5RaU9pQWlRMmhsWTJ0cGJtY2dZV05qYjNWdWRDSUtJQ0FnSUN
BZ0lDQjlMQW9nSUNBZ0lDQWdJQ0owYnlJNmV3b2dJQ0FnSUNBZ
0lDQWdJQ0FpYm1GdFpTSTZJQ0pVYVcwZ1dYTmxkM2x1SWl3S0l
DQWdJQ0FnSUNBZ0lDQWdJbUZqWTI5MWJuUWlPaUFpVTJGMmFXN
W5jeUJoWTJOdmRXNTBJZ29nSUNBZ0lDQWdJSDBzQ2lBZ0lDQWd
JQ0FnSW1GdGIzVnVkQ0k2SURJMU1Bb2dJQ0FnSUNBZ0lDSmpkW
Ep5Wlc1amVTSTZJQ0pGVlZJaUNpQWdJQ0I5.MEYCIQCcwunLBi
uHu2z_SlDVJyZuQv0NU8X4VYoOFN1EuIvObQIhAJeZuTeZw9k5
uhpBc60iT13s3yb01ItSB2MhEd5pUSqC
----- END LICENSE KEY ----------------------------</textarea>
                        </div>
                        {{--<div class="form-group">
                            <div class="custom-control custom-checkbox mt-2">
                                <input class="custom-control-input" type="checkbox" value="" id="savelicensekey">
                                <label class="custom-control-label" for="savelicensekey">
                                    Add the license key to the Git repository
                                    <i class="fas fa-fw fa-question-circle" aria-hidden="true" data-toggle="popover" data-trigger="hover" data-placement="right" title="Add to Git" data-content="Only tick this if (1) the repository is private (not public), and (2) all developers working on this project are authorised to use the same license."></i>
                                </label>
                            </div>
                        </div>--}}
                    </div>
                    <div class="col-lg-5">
                        {{--<p class="mt-3">
                            <a href="#">Buy a license online</a>, then paste your
                            license key into the box on the left to unlock all
                            features.
                        </p>
                        <p>
                            Student? Building open source software? Can't afford
                            a license?
                            <a href="#">Contact us</a> to discuss alternatives.
                        </p>
                        <p>
                            Having trouble activating your license?
                            <a href="#">Contact us</a> for help.
                        </p>--}}
                        <dl>
                            <dt>License Number</dt>
                            <dd>0556-3781-4313</dd>
                            <dt>Licensed To</dt>
                            <dd>
                                Dave James Miller<br>
                                dave@davejamesmiller.com
                            </dd>
                            <dt>Versions</dt>
                            <dd>1.x and all major versions released<br>before 10 Nov 2019.</dd>
                            <dt>Restrictions</dt>
                            <dd>
                                1 user only (unlimited projects).
                                <a href="#">
                                    <small>Upgrade</small>
                                </a>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="display: none;" id="licenseFooter">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary font-weight-bold">Save Changes</button>
            </div>
        </div>
    </div>
</div>
