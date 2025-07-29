<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>RK Bookstore</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #3f51b5;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header .title h1 {
            margin: 0;
            font-size: 24px;
        }

        header .title p {
            margin: 0;
            font-size: 14px;
            font-style: italic;
        }

        header .logo {
            font-size: 24px;
            font-weight: bold;
        }

        header .socials a {
            margin-left: 10px;
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-weight: 500;
            transition: color 0.3s;
        }

        header .socials a:hover {
            color: #c5cae9;
        }

        header .socials svg {
            width: 18px;
            height: 18px;
            fill: white;
        }

        .container {
            flex: 1;
            display: flex;
            overflow: hidden;
        }

        aside {
            width: 250px;
            background-color: #e0e0e0;
            padding: 20px;
            box-sizing: border-box;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        aside nav a {
            display: block;
            margin: 12px 0;
            padding: 10px;
            background-color: #ffffff;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
        }

        aside nav a:hover {
            background-color: #c5cae9;
        }

        .info-section {
            font-size: 14px;
            margin-top: 30px;
            color: #444;
        }

        main {
            flex: 1;
            padding: 40px;
            color: #333;
            background-image: url('../book-bg.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            overflow-y: auto;
        }

        main img {
            width: 100%;
            border-radius: 10px;
            margin-top: 20px;
        }

        footer {
            background-color: #3f51b5;
            color: white;
            text-align: center;
            padding: 15px;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            aside {
                width: 100%;
                flex-direction: row;
                overflow-x: auto;
            }

            aside nav {
                display: flex;
                flex-direction: row;
                gap: 10px;
                flex-wrap: wrap;
            }

            aside nav a {
                flex-grow: 1;
                text-align: center;
            }

            .info-section {
                display: none;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">📚 RK Bookstore</div>
        <div class="title">
            <h1>RK Bookstore</h1>
            <p>Discover Your Favourite Book</p>
        </div>
        <div class="socials">
            <a href="https://www.facebook.com" target="_blank" aria-label="Facebook">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M22.675 0h-21.35C.6 0 0 .6 0 1.326v21.348C0 23.4.6 24 1.326 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.894-4.788 4.66-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.59l-.467 3.622h-3.123V24h6.116c.727 0 1.326-.6 1.326-1.326V1.326C24 .6 23.4 0 22.675 0z"/></svg>
                Facebook
            </a>
            <a href="https://www.instagram.com" target="_blank" aria-label="Instagram">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm0 2A3.75 3.75 0 004 7.75v8.5A3.75 3.75 0 007.75 20h8.5a3.75 3.75 0 003.75-3.75v-8.5A3.75 3.75 0 0016.25 4h-8.5zM12 7a5 5 0 110 10 5 5 0 010-10zm0 2a3 3 0 100 6 3 3 0 000-6zm4.5-2.75a1.25 1.25 0 11-2.5 0 1.25 1.25 0 012.5 0z"/></svg>
                Instagram
            </a>
            <a href="https://www.twitter.com" target="_blank" aria-label="Twitter">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M23.954 4.569a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723 9.865 9.865 0 01-3.127 1.196 4.92 4.92 0 00-8.384 4.482A13.978 13.978 0 011.671 3.15a4.822 4.822 0 001.523 6.573 4.897 4.897 0 01-2.228-.616c-.054 2.281 1.581 4.415 3.949 4.89a4.935 4.935 0 01-2.224.084 4.928 4.928 0 004.6 3.42A9.867 9.867 0 010 19.54a13.94 13.94 0 007.548 2.209c9.142 0 14.307-7.721 13.995-14.646a9.936 9.936 0 002.411-2.534z"/></svg>
                X
            </a>
        </div>
    </header>

    <div class="container">
        <aside>
            <nav>
                <a href="php/book.php">📘 Go to Book Section</a>
                <a href="php/member.php">👤 Become a Member</a>
                <a href="php/contact.php">📞 & give feedback</a>
                <a href="php/admin.php">🔐 Admin</a>
            </nav>
            <div class="info-section">
                <h4>📬 Contact Info</h4>
                <p>Email: rkbookstore@gmail.com</p>
                <p>Phone: +977-9761779966</p>
                <h4>📌 About Us</h4>
                <p>RK Bookstore is your one-stop shop for discovering and purchasing your favorite books online.</p>
            </div>
        </aside>

        <main>
            <h2>Welcome to RK Bookstore</h2>
            <p>This is the book store designed by Roshan katel. in this book store you can fint the various types of nepali Nobeks book that can refrest you.</p>
            <img src="backimmage.png" alt="Books Background" />
        </main>
    </div>

    <footer>
        &copy; 2025 RK Bookstore. All rights reserved.
    </footer>
</body>
</html>

