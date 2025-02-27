<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #000, #333, #555);
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #333;
        }

        .card {
            width: 100%;
            max-width: 460px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            background: #fff;
        }

        .form-control {
            background: #f5f5f5;
            border: none;
            padding: 10px;
        }

        .form-control:focus {
            background: #eaeaea;
            box-shadow: none;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            color: #0056b3;
        }
    </style>
</head>

<body>

    <h2 class="text-center mb-4 text-white">EZZASTORY</h2>

    <div class="card">
        <h4 class="text-center mb-3">Register</h4>
        <form>
            <div class="mb-3">
                <label for="regUsername" class="form-label">Username</label>
                <input type="text" class="form-control" id="regUsername" placeholder="Choose a username" required>
            </div>
            <div class="mb-3">
                <label for="regEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="regEmail" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label for="regPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="regPassword" placeholder="Create a password" required>
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" placeholder="Repeat password" required>
            </div>
            <button type="submit" class="btn btn-dark w-100">Register</button>
        </form>
        <p class="text-center mt-3">Already have an account? <a href="/login">Login</a></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>