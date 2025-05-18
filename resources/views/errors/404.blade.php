<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan - Perpustakaan SMA 39</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --primary: #443627;
            --secondary: #D98324;
            --accent: #F9B572;
            --light: #f8f9fa;
            --dark: #212529;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            margin: 0;
            padding: 0;
            color: var(--dark);
            overflow-x: hidden;
        }

        .error-container {
            position: relative;
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            /* padding: 2rem; */
            z-index: 1;
        }

        .error-content {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
            padding: 3rem;
            text-align: center;
            max-width: 700px;
            width: 100%;
            position: relative;
            z-index: 2;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .error-code {
            font-size: 10rem;
            font-weight: 700;
            color: var(--accent);
            margin-bottom: 1rem;
            line-height: 1;
            text-shadow: 3px 3px 0 rgba(0, 0, 0, 0.1);
            position: relative;
            display: inline-block;
        }

        .error-code::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: var(--primary);
            border-radius: 2px;
        }

        .error-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--secondary);
        }

        .error-message {
            font-size: 1.2rem;
            margin-bottom: 2.5rem;
            color: #6c757d;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-home {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.8rem 2.5rem;
            font-size: 1.1rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(144, 120, 2, 0.4);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-home:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(144, 120, 2, 0.4);
            color: white;
        }

        .btn-home::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--secondary);
            z-index: -1;
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease;
            border-radius: 50px;
        }

        .btn-home:hover::before {
            transform: scaleX(1);
            transform-origin: left;
        }

        /* Decorative Elements */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.4;
            z-index: 0;
        }

        .orb-1 {
            width: 300px;
            height: 300px;
            background: var(--accent);
            top: 10%;
            left: 5%;
            animation: float 8s ease-in-out infinite;
        }

        .orb-2 {
            width: 400px;
            height: 400px;
            background: var(--primary);
            bottom: 5%;
            right: 5%;
            animation: float 10s ease-in-out infinite reverse;
        }

        .orb-3 {
            width: 200px;
            height: 200px;
            background: #4cc9f0;
            top: 60%;
            left: 20%;
            animation: float 7s ease-in-out infinite 2s;
        }

        .book-icon {
            position: absolute;
            opacity: 0.1;
            z-index: 0;
        }

        .book-1 {
            top: 15%;
            right: 10%;
            font-size: 8rem;
            transform: rotate(15deg);
            animation: float 6s ease-in-out infinite;
        }

        .book-2 {
            bottom: 20%;
            left: 10%;
            font-size: 6rem;
            transform: rotate(-10deg);
            animation: float 7s ease-in-out infinite reverse;
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(5deg);
            }

            100% {
                transform: translateY(0) rotate(0deg);
            }
        }

        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: var(--accent);
            opacity: 0;
            z-index: 1;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .error-code {
                font-size: 6rem;
            }

            .error-title {
                font-size: 2rem;
            }

            .error-message {
                font-size: 1rem;
            }

            .orb {
                display: none;
            }

            .book-icon {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="error-container">
        <!-- Decorative Orbs -->
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>

        <!-- Book Icons -->
        <div class="book-icon book-1">
            📚
        </div>
        <div class="book-icon book-2">
            📖
        </div>

        <!-- Main Content -->
        <div class="error-content animate__animated animate__fadeInUp">
            <div class="error-code animate__animated animate__bounceIn">404</div>
            <h1 class="error-title animate__animated animate__fadeIn animate__delay-1s">Hilang di Perpustakaan Digital
            </h1>


            <p class="error-message animate__animated animate__fadeIn animate__delay-1s">
                Sepertinya halaman yang Anda cari telah dipinjam atau belum dikatalogkan. Mari kita temukan jalan
                kembali ke koleksi utama.
            </p>

            <a href="{{ url('/') }}" class="btn btn-home animate__animated animate__fadeIn animate__delay-2s">
                Kembali ke Beranda
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Create confetti effect on load
        document.addEventListener('DOMContentLoaded', function() {
            const colors = ['#4361ee', '#3f37c9', '#f72585', '#4cc9f0', '#7209b7'];
            const container = document.querySelector('.error-container');

            for (let i = 0; i < 50; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.top = -10 + 'px';
                confetti.style.transform = `rotate(${Math.random() * 360}deg)`;
                confetti.style.width = Math.random() * 8 + 5 + 'px';
                confetti.style.height = Math.random() * 8 + 5 + 'px';
                container.appendChild(confetti);

                // Animate confetti
                setTimeout(() => {
                    confetti.style.opacity = '0.7';
                    confetti.style.transition = `all ${Math.random() * 3 + 2}s ease`;
                    confetti.style.top = '100vh';
                    confetti.style.left = parseFloat(confetti.style.left) + (Math.random() * 200 - 100) +
                        'px';
                }, i * 100);

                // Remove confetti after animation
                setTimeout(() => {
                    confetti.remove();
                }, 5000);
            }
        });
    </script>
</body>

</html>
