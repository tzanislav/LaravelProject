<!DOCTYPE html> <html lang="en"> <head> <meta charset="UTF-8"> <meta name="viewport"
    content="width=device-width, initial-scale=1.0">
<title>Contacts</title>
</head>

<body>


    <style>
        .card {
            margin: 0 auto;
            width: 50%;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }

        .card-header {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
        }

        .contact-info {
            margin-top: 20px;
        }

        .contact-info h4 {
            margin-bottom: 10px;
        }

        .contact-info p {
            margin-bottom: 5px;
        }
    </style>

    <x-Header data="Contacts" />
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Contact Us</div>

                    <div class="card-body">
                        <div class="contact-info">
                            <h4>Phone</h4>
                            <p>(123) 456-7890</p>
                            <h4>Email</h4>
                            <p>contact@example.com</p>
                            <h4>Address</h4>
                            <p>123 Main St<br>Anytown, USA 12345</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>