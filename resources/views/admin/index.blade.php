

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin.css">
    <link href="https://cdn.datatables.net/v/bs4/dt-2.1.8/datatables.min.css" rel="stylesheet">

    <title>Admin Interface</title>
</head>
<body class="fs-4">
    @if (session("correcto"))
        <div>
            <script>
                Swal.fire
                ({
                    icon: 'success',
                    title: "{{session('correcto')}}",
                    text: '',
                    confirmButtonColor: '#d32f2f',
                });
            </script>
        </div>
    @endif

    @if (session("incorrecto"))
        <div>
            <script>
                Swal.fire
                ({
                    icon: 'error',
                    title: "{{session('incorrecto')}}",
                    text: '',
                    confirmButtonColor: '#d32f2f',
                });
            </script>
        </div>
    @endif
    <div class="admin-container">
        <div class="header">
            <h2 class="fw-bold"><img class="" src="img/logo.png" width="120">Admin Interface</h2>
            <div class="welcome-logout">
                <h2 class="me-3">Welcome <strong>{{ auth()->user()->name }}</strong></h2>
                <a href="{{ route('login.destroy') }}"><button class="logout-btn h2 fw-bold">Logout</button></a>
            </div>
        </div>
        <div class="table-container">
            <h3 class="fw-bold">McDonald's Employees</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Salary/H</th>
                        <th>Hours Worked</th>
                        <th>Bonus</th>
                        <th>Performance</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="">
                    @foreach ($employees as $employee)
                        <tr class="">
                                <td>{{$employee->id}}</td>
                                <td><span id="name_{{$employee->id}}">{{$employee->name}}</span> @if ($employee->employmonth == 1) <button class="ms-2 btn btn-success fw-bold  pe-none">⭐EoM <span>🤵‍♂️{{$employee->month}}⭐</span></button> @endif</td>
                                <td>{{$employee->email}}</td>
                                <td>{{$employee->role}}</td>
                                <td><strong>{{$employee->salary}}</strong></td>
                                <td>{{$employee->hoursworked}}</td>
                                <td>{{$employee->bonus}}</td>
                                <td><strong>{{ $employee->performance ? $employee->performance : 'N/A' }}
                                </strong></td>
                                <td>
                                    @if ($employee->employmonth == 0) <a href="{{route('month', [$employee->id,$employee->name])}}"><button class="action-btn green" style="width: 30%">&#128100;</button></a>  @else @endif
                                    <button class="action-btn yellow edit-btn w-25" data-id="{{$employee->id}}" onclick="openEditModal(this)">&#9998;</button>
                                    <a href="{{route('delete', [$employee->id,$employee->name])}}"><button class="action-btn red  w-25">&#128465;</button></a>
                                </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button class="add-btn fw-bold" title="Add User" onclick="openAddModal()">+ Add User</button>
        </div>
    </div>

    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeEditModal()">&times;</span>
            <h3 class="fw-bold">Edit Employee</h3>
            <form id="editForm" onsubmit="updateEmployee(event)" method="POST">
                @csrf
                <label for="editId">ID:</label>
                <input type="text" id="editId" name="editId" readonly><br>
                <label for="editName">Name:</label>
                <input type="text" id="editName" name="editName"><br>
                <label for="editEmail">Email:</label>
                <input type="email" id="editEmail" name="editEmail"><br>
                <label for="editRole">Role:</label>
                <input type="text" id="editRole" name="editRole" list="roles" autocomplete="off"><br>
                <label for="editSalary">Salary:</label>
                <input type="number" id="editSalary" name="editSalary"><br>
                <label for="">Hours Worked:</label>
                <input type="number" id="editHoursWorked" name="editHoursWorked"><br>
                <label for="">Bonus:</label>
                <input type="number" id="editBonus" name="editBonus"><br>
                <label for="editPerformance">Performance:</label>
                <input type="number" id="editPerformance" name="editPerformance" placeholder="0-100" min="0" max="100"><br>
                <button type="submit" style="font-size: 25px">Save</button>
            </form>

            <datalist id="roles">
                <option value="Chef"></option>
                <option value="Server"></option>
                <option value="Busboy"></option>
            </datalist>

        </div>
    </div>

    <div id="addModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeAddModal()">&times;</span>
            <h3>Add New Employee</h3>
            <form id="addForm" action="{{route('create')}}">
                @csrf
                <label for="addName">Name:</label>
                <input type="text" id="addName" name="addName" required><br>
                <label for="addEmail">Email:</label>
                <input type="email" id="addEmail" name="addEmail" required><br>
                <label for="addPassword">Password:</label>
                <input type="password" id="addPassword" name="addPassword" required><br>
                <label for="addRole">Role:</label>
                <select id="addRole" name="addRole" class="form" required>
                    <option value="">Select</option>
                    <option value="Chef">Chef</option>
                    <option value="Server">Server</option>
                    <option value="Busboy">Busboy</option>
                    <option value="Admin">Admin</option>
                </select>
                <br>
                <label for="addSalary">Salary:</label>
                <input type="number" id="addSalary" name="addSalary" required><br>
                <label for="addSalary">Nationality:</label>
                <select id="addNationality" name="addNationality" class="form" required>
                    <option value="">Select</option>
                    <option value="Colombia">Colombia</option>
                    <option value="Canada">Canada</option>
                    <option value="Ecuador">Ecuador</option>
                    <option value="Japan">Japan</option>
                </select><br>
                <button type="submit">Add Employee</button>
            </form>
        </div>
    </div>

    <script>
        function updateEmployee(event) {
            event.preventDefault();


            let employeeId = document.getElementById("editId").value;


            let form = document.getElementById("editForm");
            form.action = `/adminindex/edit/${employeeId}`;


            form.submit();
        }




        function openEditModal(button) {
            const row = button.parentElement.parentElement;
            let id = button.getAttribute('data-id');
            document.getElementById('editId').value = row.cells[0].textContent;
            document.getElementById('editName').value = document.getElementById('name_' + id).textContent;
            document.getElementById('editEmail').value = row.cells[2].textContent;
            document.getElementById('editRole').value = row.cells[3].textContent;
            document.getElementById('editSalary').value = row.cells[4].textContent;
            document.getElementById('editHoursWorked').value = row.cells[5].textContent;
            document.getElementById('editBonus').value = row.cells[6].textContent;
            document.getElementById('editPerformance').value = row.cells[7].textContent;
            document.getElementById('editModal').style.display = 'block';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        function saveChanges() {
            const id = document.getElementById('editId').value;
            const name = document.getElementById('editName').value;
            const email = document.getElementById('editEmail').value;
            const role = document.getElementById('editRole').value;
            const salary = document.getElementById('editSalary').value;
            const hoursworked = document.getElementById('editHoursWorked').value;
            const bonus = document.getElementById('editBonus').value;
            const performance = document.getElementById('editPerformance').value;

            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                if (row.cells[0].textContent === id) {
                    row.cells[1].textContent = name;
                    row.cells[2].textContent = email;
                    row.cells[3].textContent = role;
                    row.cells[4].textContent = salary;
                    row.cells[5].textContent = hoursworked;
                    row.cells[6].textContent = bonus;
                    row.cells[7].textContent = performance;
                }
            });

            closeEditModal();
        }
        window.onclick = function(event) {
            const editModal = document.getElementById('editModal');
            const addModal = document.getElementById('addModal');
            if (event.target == editModal) {
                closeEditModal();
            }
            if (event.target == addModal) {
                closeAddModal();
            }
        }

        function openAddModal() {
            document.getElementById('addModal').style.display = 'block';
        }

        function closeAddModal() {
            document.getElementById('addModal').style.display = 'none';
        }

    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/v/bs4/dt-2.1.8/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            $("table").DataTable({
                order: [0, 'asc'],
            })
        })
    </script>
</body>
</html>

