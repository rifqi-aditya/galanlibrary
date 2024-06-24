<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Love Checkbox</title>
    <style>
        .love-checkbox {
            display: none;
        }

        .love-label {
            display: inline-block;
            width: 50px;
            height: 50px;
            position: relative;
            cursor: pointer;
            user-select: none;
        }

        .love-label::before,
        .love-label::after {
            content: "";
            width: 25px;
            height: 40px;
            background: #ccc;
            position: absolute;
            border-radius: 25px 25px 0 0;
            transition: all 0.3s ease;
        }

        .love-label::before {
            left: 25px;
            top: 0;
            transform: rotate(-45deg);
            transform-origin: 0 100%;
        }

        .love-label::after {
            left: 0;
            top: 0;
            transform: rotate(45deg);
            transform-origin: 100% 100%;
        }

        .love-checkbox:checked + .love-label::before,
        .love-checkbox:checked + .love-label::after {
            background: red;
        }

        .love-checkbox:checked + .love-label {
            animation: heartbeat 0.5s ease-in-out;
        }

        @keyframes heartbeat {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.2);
            }
        }
    </style>
</head>
<body>
    <input type="checkbox" id="love" class="love-checkbox">
    <label for="love" class="love-label"></label>
</body>
</html>