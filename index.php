<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bienvenue</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #4facfe, #00f2fe);
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
        }
        .card {
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            padding: 40px;
            text-align: center;
            width: 90%;
            max-width: 400px;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        p {
            color: #666;
            font-size: 18px;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #aaa;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>👋 Bonjour !</h1>
        <p>Bienvenue sur mon site PHP tournant dans Docker Moubarak Yampa 🚀</p>
        <div class="footer">
            <?php echo "Page générée le " . date("d/m/Y à H:i:s"); ?>
        </div>
    </div>
</body>
</html>
