<div class="tab-pane fade active show" id="role-654" role="tabpanel">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Permissions & Detalies</h3>
        </div>
        <div class="card-body">
            <form class="row g-3">
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" data-csrf-token >
                <div class="col-md-6">
                    <label class="form-label" for="settings-name"> Full name </label>
                    <input type="text" class="form-control" id="settings-name" value="Jane Doe">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="settings-email"> Email </label>
                    <input type="email" class="form-control" id="settings-email" value="jane@example.com">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="settings-tz"> Time zone </label>
                    <select class="form-select" id="settings-tz">
                        <option>UTC</option>
                        <option selected="">America/Los_Angeles</option>
                        <option>Europe/London</option>
                        <option>Asia/Tokyo</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="settings-lang"> Language </label>
                    <select class="form-select" id="settings-lang">
                        <option selected="">English</option>
                        <option>Español</option>
                        <option>Français</option>
                        <option>Deutsch</option>
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>