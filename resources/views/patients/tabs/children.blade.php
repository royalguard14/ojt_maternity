            <!-- Child Profile Tab -->
            <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                @if ($profile_clinic->relationshipAsMother && $profile_clinic->relationshipAsMother->children->isNotEmpty())
                <h5>Children</h5>
                <table class="table table-head-fixed text-nowrap" id="example3">
                    <thead>
                        <tr>
                            <th style="width: 10px">No.</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($profile_clinic->relationshipAsMother->children as $index => $child)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $child->full_name }}</td>
                            <td>{{ $child->age }}</td>
                            <td>
                                <button class="btn btn-info btn-sm" onclick="viewChild({{ $child->id }})">View</button>
                                <button class="btn btn-warning btn-sm" onclick="editChild({{ $child->id }})">Edit</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <h5>No children data found.</h5>
                <table class="table table-head-fixed text-nowrap" id="example3">
                    <thead>
                        <tr>
                            <th style="width: 10px">No.</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4" class="text-center">No children records to display.</td>
                        </tr>
                    </tbody>
                </table>
                @endif
                @if($profile_clinic->husband && $profile_clinic->husband->exists)
                <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#addChildModal">
                    Add Child
                </button>
                @endif
            </div>