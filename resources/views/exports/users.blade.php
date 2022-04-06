<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Date of Birth</th>
            <th>Gender</th>
            <th>Blood Group</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->date_of_birth }}</td>
                <td>{{ $user->gender }}</td>
                <td>{{ $user->blood_group }}</td>
                <td>{{ $user->getRoleNames()->first() }}</td>
            </tr>
        @endforeach
    </tbody>
</table>