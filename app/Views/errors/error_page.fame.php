<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $code ?? 'Error' ?> - <?= $message ?? '' ?></title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #2c3e50;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
    }
    .error-container {
        text-align: center;
        background-color: #ffffff;
        padding: 80px 60px;          /* bigger padding */
        border-radius: 10px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1); /* subtle but bigger shadow */
        max-width: 600px;            /* wider container */
        width: 90%;                  /* responsive on small screens */
    }
    .error-container h1 {
        font-size: 96px;             /* bigger error code */
        margin-bottom: 10px;
        color: #00008B;              /* red for error */
    }
    .error-container h2 {
        font-size: 28px;
        margin-top: 0;
        margin-bottom: 20px;
        font-weight: 500;
    }
    .error-container p {
        font-size: 16px;
        color: #555;
        margin-bottom: 30px;
    }
    a.button {
        background-color: #00008B;
        color: #fff;
        padding: 14px 30px;          /* larger button */
        border-radius: 6px;
        text-decoration: none;
        font-weight: bold;
        font-size: 16px;
        transition: 0.3s ease;
    }
    a.button:hover {
        background-color: darkblue;
        transform: translateY(-2px);
    }
</style>
</head>
<body>
    <div class="error-container">
        <h1><?= $code ?? 'Error' ?></h1>
        <h2><?= $message ?? 'Something went wrong.' ?></h2>
        <p><?= $details ?? 'Please check the URL or go back to the homepage.' ?></p>
        <a href="<?= url('/') ?>" class="button">Go Home</a>
    </div>
</body>
</html>
