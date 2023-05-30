@if($stockist == 1 || $stockist == 2)
<p class="mb-2">{{ ($stockist == 1) ? "Mobile" : "Center" }} Stockist Assignment</p>
<div class="row mb-4 px-2">
    <div class="col-lg-5 mb-2 mb-lg-0 px-1">
        <select type="number" class="form-select form-control-1 stockist-forms" id="assignable-accounts">
            <option value="-1">Select an account...</option>
            @foreach($users as $user)
                @if($user["stockist"] != $stockist)
            <option value="{{ $user["id"] }}">{{ fullName($user) }} ({{ ranks()[$user["rank"]] }})</option>
                @endif
            @endforeach
        </select>
    </div>

    @if($stockist == 1)
    <div class="col-lg-5 mb-2 mb-lg-0 px-1">
        <select type="number" class="form-select form-control-1 stockist-forms" id="assignable-center-stockists">
            <option value="-1">Select Center Stockist to be assigned to...</option>
            @foreach($users as $user)
                @if($user["stockist"] == 2)
            <option value="{{ $user["id"] }}">{{ fullName($user) }} ({{ ranks()[$user["rank"]] }})</option>
                @endif
            @endforeach
        </select>
    </div>
    @endif

    <div class="col-lg-2 px-1">
        <button class="btn btn-custom-2 set-stockist-confirm w-100" data-stockist="{{ $stockist }}">Assign</button>
    </div>
</div>

<p class="mb-2">{{ ($stockist == 1) ? "Mobile" : "Center" }} Stockist Removal</p>
<div class="row mb-4 px-2">
    <div class="col-lg-5 mb-2 mb-lg-0 px-1">
        <select type="number" class="form-select form-control-1 stockist-forms" id="removable-accounts">
            <option value="-1">Select an account...</option>
            @foreach($users as $user)
                @if($user["stockist"] == $stockist) { ?>
            <option value="{{ $user["id"] }}">{{ fullName($user) }} ({{ ranks()[$user["rank"]] }})</option>
                @endif
            @endforeach
        </select>
    </div>

    <div class="col-lg-2 px-1">
        <button class="btn btn-custom-4 set-stockist-confirm w-100" data-stockist="0">Remove</button>
    </div>
</div>

<hr class="my-5">
@endif

<div class="table-responsive font-size-90 mt-4 mb-5" id="accounts-table-container">
    <p class="text-center my-5 py-5 loading-text">Loading...</p>
    <table class="table table-bordered data-table" style="display:none; font-size:0.9em">
        <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Email Address</th>
                <th>Contact Number</th>
                <th>Username</th>
                <th>Rank Status</th>
                <th>Referral Code</th>
                @if($stockist == 1)
                <th>Center Stockist</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                @if($stockist == -1 || ($user["stockist"] == $stockist))
            <tr>
                <td class="text-center"><a href="{{ route('admin.users.accessUser', $user['id']) }}" class="btn btn-custom-2 btn-sm access-account"><i class="fas fa-sign-in-alt font-size-90"></i></a></td>
                <td>{{ fullName($user) }}</td>
                <td>{{ $user["email"] }}</td>
                <td>{{ $user["contact_number"] }}</td>
                <td>{{ $user["username"] }}</td>
                <td>{{ ranks()[$user["rank"]] }}</td>
                <td>{{ $user["referral_code"] }}</td>
                @if($stockist == 1)
                <td>{{ fullName($user["centerStockist"]) }}</td>
                @endif
            </tr>
                @endif
          @endforeach
        </tbody>
    </table>
</div>
