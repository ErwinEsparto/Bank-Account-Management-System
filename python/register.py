#!C:/Program Files/Python312/python
print("Content-Type:text/html")
print()
import cgi
import cgitb
cgitb.enable(display=1)

form=cgi.FieldStorage()

firstName=form.getvalue("firstName")
lastName=form.getvalue("lastName")
address=form.getvalue("address")
contactNumber=form.getvalue("contactNumber")
emailAddress=form.getvalue("emailAddress")
birthDate=form.getvalue("birthDate")
gender=form.getvalue("gender")
bankNumber=form.getvalue("bankNumber")
password=form.getvalue("password")

import mysql.connector

con=mysql.connector.connect(user="root", password="", host="localhost", database="bankdb")
query=con.cursor()

statement = "INSERT INTO users (firstName, lastName, address, emailAddress, contactNumber, birthDate, gender, bankNumber, password, savings, accountType, dateCreated) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, now())"
query.execute(statement, (firstName, lastName, address, emailAddress, contactNumber, birthDate, gender, bankNumber, password, 0.0, 2))
con.commit()

print("""
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Successful</title>
        <link rel="stylesheet" href="../css/register.css">
        <style>
            main {
                height: 80vh;
            }
            .box {
                background-color: rgba(255, 255, 255, 0.25);
                border-radius: 20px;
                text-align: center;
                padding: 50px;
                margin: 50px;
                width: 45%;
            }
            .link{
                display: flex;
                justify-content: center;
            }
            .link a {
                color: white;
                text-decoration: none;
                font-size: 1em;
            }
            .link a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <main>
            <section class='box'>
                <h1> Signed Up Successfully </h1>
                <div class="link">
                    <a href="../html/login.html">Go to Login</a>
                </div>
            </section>
        </main>
    </body>
    </html>
    """)

query.close()
con.close()