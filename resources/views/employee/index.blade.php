

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
    <div class="admin-container">
        <div class="header">
            <h2 class="fw-bold"><img class="" src="img/logo.png" width="120">Employee Interface</h2>
            <div class="welcome-logout">
                <h2 class="me-3">Welcome <strong>{{ auth()->user()->name }} </strong> Role: <strong>{{ auth()->user()->role }}</strong></h2>
                <a href="{{ route('login.destroy') }}"><button class="logout-btn h2 fw-bold">Logout</button></a>
            </div>
        </div>
        <div class="table-container">
            <div class="table-container">
                <div class="d-flex flex-column align-items-center p-4 bg-light rounded">
                    <!-- Employee Header -->
                    <div class="text-center">
                        <img src="img/pic.jpeg" alt="Employee Avatar" class="rounded-circle mb-2" style="width: 300px; height: 250px">
                        <h5 class="mt-2 fs-1 fw-bold">{{ auth()->user()->name }} - {{ auth()->user()->nationality }} <span class="ms-2">
                        @php
                        $flag = "";
                            if (auth()->user()->nationality == 'Colombia'){
                                $flag = "/img/colombia.png";
                            }else if(auth()->user()->nationality == 'Canada'){
                                $flag = "/img/canada.png";
                            }else if(auth()->user()->nationality == 'Ecuador'){
                                $flag = "/img/ecuador.png";
                            }else if(auth()->user()->nationality == 'Peru'){
                                $flag = "/img/peru.webp";
                            }else if(auth()->user()->nationality == 'Japan'){
                                $flag = "/img/japan.png";
                            }
                        @endphp
                        <img src="{{$flag}}" alt="" width="50px" height="30px"></span></h5>
                        @if(auth()->user()->employmonth == 1)
                            <p class="mb-1">Employee of the month <strong>({{ auth()->user()->month }})</strong></p>
                            <a href="https://websaver.ca/en_ca/coupons/" target="_blank"><button class="btn btn-warning fw-bold p-2 fs-2">Coupons <i class="fas fa-percent"></i></button></a>
                        @else
                        @endif
                    </div>

                    <!-- Salary and Bonus Info -->
                    <div class="d-flex justify-content-between w-100 mt-3 px-3">
                        <div><strong>Grade:
                        @php
                            $performance = auth()->user()->performance;

                            if ($performance >= 90 && $performance <= 100) {
                                $grade = 'S+';
                            } elseif ($performance >= 80 && $performance < 90) {
                                $grade = 'A';
                            } elseif ($performance >= 70 && $performance < 80) {
                                $grade = 'B';
                            } elseif ($performance >= 60 && $performance < 70) {
                                $grade = 'C';
                            } elseif ($performance >= 50 && $performance < 60) {
                                $grade = 'D';
                            } else {
                                $grade = 'F';
                            }
                        @endphp

                        (Grade: {{ $grade }})</strong></div>
                        <div><strong>Salary:</strong> {{ auth()->user()->salary }} / H</div>
                        <div><strong>Bonus:</strong> {{ auth()->user()->bonus }} CAD</div>
                    </div>
                    <div class="d-flex justify-content-between w-100 px-3">
                        <div><strong>Total hours worked:</strong> {{ auth()->user()->hoursworked }}</div>
                        <div><strong>Total:</strong> {{ (auth()->user()->salary * auth()->user()->hoursworked) + auth()->user()->bonus }} CAD</div>
                    </div>

                    <!-- Schedule Table -->
                    <div class="mt-4 w-100">
                        <h1 class="text-center fw-bold">SCHEDULE</h1>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>Mon</th>
                                        <th>Tue</th>
                                        <th>Wed</th>
                                        <th>Thu</th>
                                        <th>Fri</th>
                                        <th class="table-danger">Sat</th>
                                        <th class="table-danger">Sun</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>10 am<br>-<br>4 pm</td>
                                        <td>10 am<br>-<br>4 pm</td>
                                        <td>10 am<br>-<br>4 pm</td>
                                        <td>10 am<br>-<br>4 pm</td>
                                        <td>10 am<br>-<br>4 pm</td>
                                        <td class="bg-danger"></td>
                                        <td class="bg-danger"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/v/bs4/dt-2.1.8/datatables.min.js"></script>

</body>
</html>

