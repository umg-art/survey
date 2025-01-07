@extends('layout.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-end mb-3">
        <a href="/surveys/create" class="btn btn-primary">Create</a>
    </div>
    <table id="surveyTable" class="display table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Questions</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function () {
        $('#surveyTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('surveys.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'age', name: 'age' },
                { data: 'gender', name: 'gender' },
                { data: 'questions', name: 'questions', orderable: false, searchable: false,
                  render: function (data, type, row) {
                    if (data.length > 100) {
                        return data.substring(0, 100) + '...';
                    }
                    return data;
                 }
                },
                { data: 'action', name: 'action', orderable: false, searchable: false,  },
            ]
        });
    });
</script>

@endsection
