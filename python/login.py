#!C:/Program Files/Python312/python
print("Content-Type:text/html")
print()
import cgi

form=cgi.FieldStorage()

bankNumber=form.getvalue("bankNumber")
password=form.getvalue("password")

import mysql.connector

con=mysql.connector.connect(user="root", password="", host="localhost", database="bankdb")
query=con.cursor()

statement = "SELECT userId FROM users WHERE bankNumber=%s AND password=%s"
query.execute(statement, (bankNumber, password))
account = query.fetchone()

if not account:
    print(f"""
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Login</title>
                <link rel="stylesheet" href="../css/login.css">
                <style>
                    main {{
                        height: 80vh;
                    }}
                    .link{{
                        text-align: center;
                    }}
                    .link a {{
                        color: white;
                        text-decoration: none;
                        font-size: 1em;
                    }}
                    .link a:hover {{
                        text-decoration: underline;
                    }}
                </style>
            </head>
            <body>
                <main>
                    <section>
                        <div class="loginform">
                                <h1> Invalid Credentials. </h1>
                                <div class="links">
                                    <a href="../html/login.html">Return to Login Page</a>
                                </div>
                        </div>
                    </section>
                </main>
            </body>
            </html>
          """)
else:
    userAccount = account[0]
    print(f"""
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Login</title>
                <link rel="stylesheet" href="../css/login.css">
                <style>
                    main {{
                        height: 80vh;
                    }}
                    .link{{
                        display: flex;
                        justify-content: space-around;
                    }}
                    .link a {{
                        color: white;
                        text-decoration: none;
                        font-size: 1em;
                    }}
                    .link a:hover {{
                        text-decoration: underline;
                    }}
                </style>
            </head>
            <body>
                <main>
                    <section>
                        <div class="loginform">
                                <h1> Successful Log In </h1>
                                <div class="link">
                                    <a href='../html/home.php?userId={userAccount}'> Go to Homepage</a>
                                    <a href="../html/login.html">Logout</a>
                                </div>
                        </div>
                    </section>
                </main>
            </body>
            </html>
          """)

query.close()
con.close()