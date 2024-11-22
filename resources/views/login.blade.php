<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Login</title>
    <style>
        body {
            background-image: url('img/fondo.png');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        .container {
            width: 360px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 6px 20px 20px rgba(0, 0, 0, 0.4);
            text-align: center;
        }
        .container img {
            width: 100%;
            height: auto;
        }
        .container p {
            color: rgb(15, 15, 83);
            font-size: 50px;
            margin: 10px 0;
        }
        .container input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            font-size: large;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: rgb(221, 221, 221);
        }
        .container input:focus {
            outline: none;
            border-color: #007bff;
        }
        .container a {
            font-size: small;
            color: #007bff;
            text-decoration: none;
        }
        .container a:hover {
            text-decoration: underline;
        }
        .button {
            width: 100%;
            padding: 10px;
            background-color: red;
            color: yellow;
            font-size: larger;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: darkred;
        }
    </style>
</head>

<body style="">
    @error('message')
        <div>
        <script>
            Swal.fire
            ({
                icon: 'error',
                title: "Error!\n The user or password are wrong!",
                text: '',
                confirmButtonColor: '#d32f2f'

            });
        </script>
        </div>
    @enderror
    <div class="container">
        <img src="img/logo.png" alt="Logo">
        <p><b>Software</b></p>
        <hr>
        <form action="{{route('login')}}">
            @csrf
            <label for="email" class="sr-only">Email Address</label>
            <input required placeholder="✉️ Email address" type="email" id="email" name="email" class="email" aria-label="Email address" />

            <label for="password" class="sr-only">Password</label>
            <input required placeholder="🔒 Password" type="password" id="password" name="password" class="password" aria-label="Password" />

            <a href="#">Forgot password?</a>
            <br><br>
            <button id="login" type="submit" class="button">LOGIN</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
